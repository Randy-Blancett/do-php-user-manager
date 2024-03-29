<?php

namespace Tonic;

/**
 * A Tonic application
 */
class Application
{
	/**
	 * Application configuration options
	 */
	private $options = array();

	/**
	 * Metadata of the loaded resources
	 */
	private $resources = array();

	public function __construct($options = array())
	{
		$this->baseUri = dirname($_SERVER['SCRIPT_NAME']);
		$this->options = $options;

		// load resource metadata passed in via options array
		if (isset($options['resources']) && is_array($options['resources'])) {
			$this->resources = $options['resources'];
		}

		$cache = isset($options['cache']) ? $options['cache'] : NULL;
		if ($cache && $cache->isCached()) { // if we've been given a annotation cache, use it
			$this->resources = $cache->load();
		} else { // otherwise load from loaded resource files
			if (isset($options['load'])) { // load given resource class files
				$this->loadResourceFiles($options['load']);
			}
			$this->loadResourceMetadata();
			if ($cache) { // save metadata into annotation cache
				$cache->save($this->resources);
			}
		}

		// set any URI-space mount points we've been given
		if (isset($options['mount']) && is_array($options['mount'])) {
			foreach ($options['mount'] as $namespaceName => $uriSpace) {
				$this->mount($namespaceName, $uriSpace);
			}
		}
	}

	/**
	 * Include PHP files containing resources in the given filename globs
	 * @paramstr[] $filenames Array of filename globs
	 */
	private function loadResourceFiles($filenames)
	{
		if (!is_array($filenames)) {
			$filenames = array($filenames);
		}

		foreach ($filenames as $glob) {
			foreach (glob($glob) as $filename) {
				require_once $filename;
			}
		}
	}

	/**
	 * Load the metadata for all loaded resource classes
	 * @param str $uriSpace Optional URI-space to mount the resources into
	 */
	public function loadResourceMetadata($uriSpace = NULL)
	{
		foreach (get_declared_classes() as $className) {
			if (
					!isset($this->resources[$className]) &&
					is_subclass_of($className, 'Tonic\Resource')
			) {
				$this->resources[$className] = $this->readResourceAnnotations($className);
				if ($uriSpace) {
					$this->resources[$className]['uri'][0] = '|^'.$uriSpace.substr($this->resources[$className]['uri'][0], 2);
				}
				$this->resources[$className]['methods'] = $this->readMethodAnnotations($className);
			}
		}
	}

	/**
	 * Add a namespace to a specific URI-space
	 *
	 * @param str $namespaceName
	 * @param str $uriSpace
	 */
	public function mount($namespaceName, $uriSpace)
	{
		foreach ($this->resources as $className => $metadata) {
			if ($metadata['namespace'][0] == $namespaceName) {
				foreach ($metadata['uri'] as $index => $uri) {
					$this->resources[$className]['uri'][$index][0] = '|^'.$uriSpace.substr($uri[0], 2);
				}
			}
		}
	}

	/**
	 * Get the URL for the given resource class
	 *
	 * @param  str   $className
	 * @param  str[] $params
	 * @return str
	 */
	public function uri($className, $params = array())
	{
		if (is_object($className)) {
			$className = get_class($className);
		}
		if (isset($this->resources[$className])) {
			if ($params && !is_array($params)) {
				$params = array($params);
			}
			foreach ($this->resources[$className]['uri'] as $uri) {
				if (count($params) == count($uri) - 1) {
					$parts = explode('([^/]+)', $uri[0]);
					$path = '';
					foreach ($parts as $key => $part) {
						$path .= $part;
						if (isset($params[$key])) {
							$path .= $params[$key];
						}
					}

					return $this->baseUri.substr($path, 2, -2);
				}
			}
		}
	}

	/**
	 * Given the request data and the loaded resource metadata, pick the best matching
	 * resource to handle the request based on URI and priority.
	 *
	 * @param  Request  $request
	 * @return Resource
	 */
	public function getResource($request = NULL)
	{
		$matchedResource = NULL;
		if (!$request) {
			$request= new Request();
		}
		foreach ($this->resources as $className => $resourceMetadata) {
			if (isset($resourceMetadata['uri'])) {
				if (!is_array($resourceMetadata['uri'])) {
					$resourceMetadata['uri'] = array($resourceMetadata['uri']);
				}
				foreach ($resourceMetadata['uri'] as $uri) {

					if (!is_array($uri)) {
						$uri = array($uri);
					}
					$uriRegex = $uri[0];
					if (!isset($resourceMetadata['priority'])) {
						$resourceMetadata['priority'] = 1;
					}
					if (!isset($resourceMetadata['class'])) {
						$resourceMetadata['class'] = $className;
					}

					if (
							($matchedResource == NULL || $matchedResource[0]['priority'] < $resourceMetadata['priority'])
							&&
							preg_match($uriRegex, $request->uri, $params)
					) {
						if (count($uri) > 1) { // has params within URI
							if(sizeof($uri)>1)
							{
								if($uri[1]=="")
								{
									unset($uri[1]);
								}
							}
							$params = array_combine($uri, $params);
						}
						array_shift($params);
						$matchedResource = array($resourceMetadata, $params);
					}
				}
			}
		}
		if ($matchedResource) {
			if (isset($matchedResource[0]['filename']) && is_readable($matchedResource[0]['filename'])) {
				require_once($matchedResource[0]['filename']);
			}
			return new $matchedResource[0]['class']($this, $request, $matchedResource[1]);
		} else {
			throw new NotFoundException(sprintf('Resource matching URI "%s" not found', $request->uri));
		}
	}

	/**
	 * Get the already loaded resource annotation metadata
	 * @param  Tonic/Resource $resource
	 * @return str[]
	 */
	public function getResourceMetadata($resource)
	{
		if (is_object($resource)) {
			$className = get_class($resource);
		} else {
			$className = $resource;
		}

		return isset($this->resources[$className]) ? $this->resources[$className] : NULL;
	}

	/**
	 * Read the annotation metadata for the given class
	 * @return str[] Annotation metadata
	 */
	private function readResourceAnnotations($className)
	{
		$metadata = array();

		// get data from reflector
		$classReflector = new \ReflectionClass($className);

		$metadata['class'] = '\\'.$classReflector->getName();
		$metadata['namespace'] = array($classReflector->getNamespaceName());
		$metadata['filename'] = $classReflector->getFileName();
		$metadata['priority'] = array(1);

		// get data from docComment
		$docComment = $this->parseDocComment($classReflector->getDocComment());

		if (isset($docComment['@uri'])) {
			foreach ($docComment['@uri'] as $uri) {
				$metadata['uri'][] = $this->uriTemplateToRegex($uri);
			}
		}
		if (isset($docComment['@namespace'])) $metadata['namespace'] = $docComment['@namespace'][0];
		if (isset($docComment['@priority'])) $metadata['priority'] = $docComment['@priority'][0];

		return $metadata;
	}

	/**
	 * Turn a URL template into a regular expression
	 * @param  str $uri URL template
	 * @return str Regular expression
	 */
	private function uriTemplateToRegex($uri)
	{
		preg_match_all('#((?<!\?):[^/]+|{[^0-9][^}]*}|\(.+?\))#', $uri[0], $params, PREG_PATTERN_ORDER);
		#$return = array($uri);
		$return = $uri;
		if (isset($params[1])) {
			foreach ($params[1] as $index => $param) {
				if (substr($param, 0, 1) == ':') {
					$return[] = substr($param, 1);
				} elseif (substr($param, 0, 1) == '{' && substr($param, -1, 1) == '}') {
					$return[] = substr($param, 1, -1);
				} else {
					$return[] = $index;
				}
			}
		}

		$return[0] = '|^'.preg_replace('#((?<!\?):[^(/]+|{[^0-9][^}]*})#', '([^/]+)', $return[0]).'$|';

		return $return;
	}

	public function readMethodAnnotations($className)
	{
		if (isset($this->resources[$className]) && isset($this->resources[$className]['methods'])) {
			return $this->resources[$className]['methods'];
		}

		$metadata = array();

		foreach (get_class_methods($className) as $methodName) {
			$methodMetadata = array();

			$methodReflector = new \ReflectionMethod($className, $methodName);

			$docComment = $this->parseDocComment($methodReflector->getDocComment());
			if (isset($docComment['@method'])) {
				foreach ($docComment as $annotationName => $value) {
					$methodName = substr($annotationName, 1);
					if (method_exists($className, $methodName)) {
						$methodMetadata[$methodName] = $value[0];
					}
				}
				$metadata[$methodReflector->getName()] = $methodMetadata;
			}
		}

		return $metadata;
	}

	/**
	 * Parse annotations out of a doc comment
	 * @param  str   $comment Doc comment to parse
	 * @return str[]
	 */
	private function parseDocComment($comment)
	{
		$data = array();
		preg_match_all('/^\s*\*[*\s]*(@.+)$/m', $comment, $items);
		if ($items && isset($items[1])) {
			foreach ($items[1] as $item) {
				$parts = preg_split('/\s+/', $item);
				if ($parts) {
					$key = array_shift($parts);
					if (isset($data[$key])) {
						//$data[$key][] = trim(join(' ', $parts));
						$data[$key][] = $parts;
					} else {
						//$data[$key] = array(trim(join(' ', $parts)));
						$data[$key] = array($parts);
					}
				}
			}
		}

		return $data;
	}

	public function __toString()
	{
		$baseUri = $this->baseUri;

		if (isset($this->options['load']) && is_array($this->options['load'])) {
			$loadPath = join(', ', $this->options['load']);
		} else $loadPath = '';

		$mount = array();
		if (isset($this->options['mount']) && is_array($this->options['mount'])) {
			foreach ($this->options['mount'] as $namespaceName => $uriSpace) {
				$mount[] = $namespaceName.'="'.$uriSpace.'"';
			}
		}
		$mount = join(', ', $mount);

		$cache = isset($this->options['cache']) ? $this->options['cache'] : NULL;

		$resources = array();
		foreach ($this->resources as $resource) {
			$uri = array();
			foreach ($resource['uri'] as $u) {
				$uri[] = $u[0];
			}
			$uri = join(', ', $uri);
			$r = $resource['class'].' '.$uri.' '.$resource['priority'];
			foreach ($resource['methods'] as $methodName => $method) {
				$r .= "\n\t\t".$methodName;
				foreach ($method as $itemName => $item) {
					$r .= ' '.$itemName.'="'.join(', ', $item).'"';
				}
			}
			$resources[] = $r;
		}
		$resources = join("\n\t", $resources);

		return <<<EOF
=================
Tonic\Application
=================
Base URI: $baseUri
Load path: $loadPath
Mount points: $mount
Annotation cache: $cache
Loaded resources:
\t$resources

EOF;
	}

}
