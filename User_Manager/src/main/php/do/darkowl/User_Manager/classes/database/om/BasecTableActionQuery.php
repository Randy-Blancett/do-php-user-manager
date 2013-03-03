<?php


/**
 * Base class that represents a query for the 'action' table.
 *
 * 
 *
 * @method     cTableActionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     cTableActionQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     cTableActionQuery orderByISBN($order = Criteria::ASC) Order by the isbn column
 * @method     cTableActionQuery orderByPublisherId($order = Criteria::ASC) Order by the publisher_id column
 * @method     cTableActionQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 *
 * @method     cTableActionQuery groupById() Group by the id column
 * @method     cTableActionQuery groupByTitle() Group by the title column
 * @method     cTableActionQuery groupByISBN() Group by the isbn column
 * @method     cTableActionQuery groupByPublisherId() Group by the publisher_id column
 * @method     cTableActionQuery groupByAuthorId() Group by the author_id column
 *
 * @method     cTableActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     cTableActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     cTableActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     cTableAction findOne(PropelPDO $con = null) Return the first cTableAction matching the query
 * @method     cTableAction findOneOrCreate(PropelPDO $con = null) Return the first cTableAction matching the query, or a new cTableAction object populated from the query conditions when no match is found
 *
 * @method     cTableAction findOneById(string $id) Return the first cTableAction filtered by the id column
 * @method     cTableAction findOneByTitle(string $title) Return the first cTableAction filtered by the title column
 * @method     cTableAction findOneByISBN(string $isbn) Return the first cTableAction filtered by the isbn column
 * @method     cTableAction findOneByPublisherId(int $publisher_id) Return the first cTableAction filtered by the publisher_id column
 * @method     cTableAction findOneByAuthorId(int $author_id) Return the first cTableAction filtered by the author_id column
 *
 * @method     array findById(string $id) Return cTableAction objects filtered by the id column
 * @method     array findByTitle(string $title) Return cTableAction objects filtered by the title column
 * @method     array findByISBN(string $isbn) Return cTableAction objects filtered by the isbn column
 * @method     array findByPublisherId(int $publisher_id) Return cTableAction objects filtered by the publisher_id column
 * @method     array findByAuthorId(int $author_id) Return cTableAction objects filtered by the author_id column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableActionQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasecTableActionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'bookstore', $modelName = 'cTableAction', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new cTableActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    cTableActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof cTableActionQuery) {
			return $criteria;
		}
		$query = new cTableActionQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    cTableAction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = cTableActionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(cTableActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    cTableAction A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `TITLE`, `ISBN`, `PUBLISHER_ID`, `AUTHOR_ID` FROM `action` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new cTableAction();
			$obj->hydrate($row);
			cTableActionPeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    cTableAction|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(cTableActionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(cTableActionPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById('fooValue');   // WHERE id = 'fooValue'
	 * $query->filterById('%fooValue%'); // WHERE id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $id The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($id)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $id)) {
				$id = str_replace('*', '%', $id);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(cTableActionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(cTableActionPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the isbn column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByISBN('fooValue');   // WHERE isbn = 'fooValue'
	 * $query->filterByISBN('%fooValue%'); // WHERE isbn LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $iSBN The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByISBN($iSBN = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($iSBN)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $iSBN)) {
				$iSBN = str_replace('*', '%', $iSBN);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(cTableActionPeer::ISBN, $iSBN, $comparison);
	}

	/**
	 * Filter the query on the publisher_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPublisherId(1234); // WHERE publisher_id = 1234
	 * $query->filterByPublisherId(array(12, 34)); // WHERE publisher_id IN (12, 34)
	 * $query->filterByPublisherId(array('min' => 12)); // WHERE publisher_id > 12
	 * </code>
	 *
	 * @param     mixed $publisherId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByPublisherId($publisherId = null, $comparison = null)
	{
		if (is_array($publisherId)) {
			$useMinMax = false;
			if (isset($publisherId['min'])) {
				$this->addUsingAlias(cTableActionPeer::PUBLISHER_ID, $publisherId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($publisherId['max'])) {
				$this->addUsingAlias(cTableActionPeer::PUBLISHER_ID, $publisherId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(cTableActionPeer::PUBLISHER_ID, $publisherId, $comparison);
	}

	/**
	 * Filter the query on the author_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAuthorId(1234); // WHERE author_id = 1234
	 * $query->filterByAuthorId(array(12, 34)); // WHERE author_id IN (12, 34)
	 * $query->filterByAuthorId(array('min' => 12)); // WHERE author_id > 12
	 * </code>
	 *
	 * @param     mixed $authorId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function filterByAuthorId($authorId = null, $comparison = null)
	{
		if (is_array($authorId)) {
			$useMinMax = false;
			if (isset($authorId['min'])) {
				$this->addUsingAlias(cTableActionPeer::AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($authorId['max'])) {
				$this->addUsingAlias(cTableActionPeer::AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(cTableActionPeer::AUTHOR_ID, $authorId, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     cTableAction $cTableAction Object to remove from the list of results
	 *
	 * @return    cTableActionQuery The current query, for fluid interface
	 */
	public function prune($cTableAction = null)
	{
		if ($cTableAction) {
			$this->addUsingAlias(cTableActionPeer::ID, $cTableAction->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasecTableActionQuery