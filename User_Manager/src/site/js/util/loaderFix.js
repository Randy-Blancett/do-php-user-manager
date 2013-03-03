/**
 * 
 */

Ext.Loader.setPath = function(str_Name, str_Path, str_Extention)
{
	var isNonBrowser = typeof window === 'undefined';
	var isNodeJS = isNonBrowser && (typeof require === 'function');

	if (!str_Extention)
	{
		str_Extention = "js";
	}

	if (!this.config.extentions)
	{
		this.config.extentions = new Array();
	}

	if (isNonBrowser)
	{
		if (isNodeJS)
		{
			str_Path = require('fs').realpathSync(str_Path);
		}
	}
	// </if>
	this.config.paths[str_Name] = str_Path;
	this.config.extentions[str_Name] = str_Extention;

	return this;
}

Ext.Loader.getPath = function(className, str_Extention)
{

	var path = '', paths = this.config.paths, extentions = this.config.extentions, prefix = this
	        .getPrefix(className);

	if (prefix.length > 0)
	{
		if (prefix === className)
		{
			return paths[prefix];
		}

		path = paths[prefix];
		if (!str_Extention)
		{
			if (extentions[prefix])
			{
				str_Extention = extentions[prefix];
			}
		}
		className = className.substring(prefix.length + 1);
	}

	if (path.length > 0)
	{
		path += '/';
	}

	if (!str_Extention)
	{
		str_Extention = "js";
	}

	return path.replace(/\/\.\//g, '/') + className.replace(/\./g, "/") + '.'
	        + str_Extention;
}

Ext.Loader.require = function(expressions, fn, scope, excludes, str_Extention)
{
	var filePath, expression, exclude, className, excluded = {},extentions = this.config.extentions, Manager = Ext.ClassManager, isNonBrowser = typeof window === 'undefined', excludedClassNames = [], possibleClassNames = [], possibleClassName, classNames = [], i, j, ln, subLn;
	var isNodeJS = isNonBrowser && (typeof require === 'function');

	expressions = Ext.Array.from(expressions);
	excludes = Ext.Array.from(excludes);

	fn = fn || Ext.emptyFn;

	scope = scope || Ext.global;

	for (i = 0, ln = excludes.length; i < ln; i++)
	{
		exclude = excludes[i];

		if (typeof exclude === 'string' && exclude.length > 0)
		{
			excludedClassNames = Manager.getNamesByExpression(exclude);

			for (j = 0, subLn = excludedClassNames.length; j < subLn; j++)
			{
				excluded[excludedClassNames[j]] = true;
			}
		}
	}

	for (i = 0, ln = expressions.length; i < ln; i++)
	{
		expression = expressions[i];

		if (typeof expression === 'string' && expression.length > 0)
		{
			possibleClassNames = Manager.getNamesByExpression(expression);

			for (j = 0, subLn = possibleClassNames.length; j < subLn; j++)
			{
				possibleClassName = possibleClassNames[j];

				if (!excluded.hasOwnProperty(possibleClassName)
				        && !Manager.isCreated(possibleClassName))
				{
					Ext.Array.include(classNames, possibleClassName);
				}
			}
		}
	}

	// If the dynamic dependency feature is not being used, throw an error
	// if the dependencies are not defined
	if (!this.config.enabled)
	{
		if (classNames.length > 0)
		{
			Ext.Error
			        .raise(
			        {
			            sourceClass : "Ext.Loader",
			            sourceMethod : "require",
			            msg : "Ext.Loader is not enabled, so dependencies cannot be resolved dynamically. "
			                    + "Missing required class"
			                    + ((classNames.length > 1) ? "es" : "")
			                    + ": "
			                    + classNames.join(', ')
			        });
		}
	}

	if (classNames.length === 0)
	{
		fn.call(scope);
		return this;
	}

	this.queue.push(
	{
	    requires : classNames,
	    callback : fn,
	    scope : scope
	});

	classNames = classNames.slice();

	for (i = 0, ln = classNames.length; i < ln; i++)
	{
		className = classNames[i];

		if (!this.isFileLoaded.hasOwnProperty(className))
		{
			this.isFileLoaded[className] = false;

			filePath = this.getPath(className);//, str_Extention);

			this.classNameToFilePathMap[className] = filePath;

			this.numPendingFiles++;

			// <if nonBrowser>
			if (isNonBrowser)
			{
				if (isNodeJS)
				{
					require(filePath);
				}
				// Temporary support for hammerjs
				else
				{
					var f = fs.open(filePath), content = '', line;

					while (true)
					{
						line = f.readLine();
						if (line.length === 0)
						{
							break;
						}
						content += line;
					}

					f.close();
					eval(content);
				}

				this.onFileLoaded(className, filePath);

				if (ln === 1)
				{
					return Manager.get(className);
				}

				continue;
			}
			// </if>
			this.loadScriptFile(filePath, Ext.Function.pass(this.onFileLoaded,
			[ className, filePath ], this), Ext.Function.pass(
			        this.onFileLoadError,
			        [ className, filePath ]), this, this.syncModeEnabled);
		}
	}

	return this;
}