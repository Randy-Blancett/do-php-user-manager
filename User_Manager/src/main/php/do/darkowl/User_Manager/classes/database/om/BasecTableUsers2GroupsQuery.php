<?php


/**
 * Base class that represents a query for the 'users2groups' table.
 *
 * 
 *
 * @method     cTableUsers2GroupsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     cTableUsers2GroupsQuery orderByuserId($order = Criteria::ASC) Order by the user_id column
 * @method     cTableUsers2GroupsQuery orderBygroupId($order = Criteria::ASC) Order by the group_id column
 * @method     cTableUsers2GroupsQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     cTableUsers2GroupsQuery groupById() Group by the id column
 * @method     cTableUsers2GroupsQuery groupByuserId() Group by the user_id column
 * @method     cTableUsers2GroupsQuery groupBygroupId() Group by the group_id column
 * @method     cTableUsers2GroupsQuery groupByComment() Group by the comment column
 *
 * @method     cTableUsers2GroupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     cTableUsers2GroupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     cTableUsers2GroupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     cTableUsers2Groups findOne(PropelPDO $con = null) Return the first cTableUsers2Groups matching the query
 * @method     cTableUsers2Groups findOneOrCreate(PropelPDO $con = null) Return the first cTableUsers2Groups matching the query, or a new cTableUsers2Groups object populated from the query conditions when no match is found
 *
 * @method     cTableUsers2Groups findOneById(string $id) Return the first cTableUsers2Groups filtered by the id column
 * @method     cTableUsers2Groups findOneByuserId(string $user_id) Return the first cTableUsers2Groups filtered by the user_id column
 * @method     cTableUsers2Groups findOneBygroupId(string $group_id) Return the first cTableUsers2Groups filtered by the group_id column
 * @method     cTableUsers2Groups findOneByComment(resource $comment) Return the first cTableUsers2Groups filtered by the comment column
 *
 * @method     array findById(string $id) Return cTableUsers2Groups objects filtered by the id column
 * @method     array findByuserId(string $user_id) Return cTableUsers2Groups objects filtered by the user_id column
 * @method     array findBygroupId(string $group_id) Return cTableUsers2Groups objects filtered by the group_id column
 * @method     array findByComment(resource $comment) Return cTableUsers2Groups objects filtered by the comment column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableUsers2GroupsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasecTableUsers2GroupsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'user_manager1', $modelName = 'cTableUsers2Groups', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new cTableUsers2GroupsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    cTableUsers2GroupsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof cTableUsers2GroupsQuery) {
			return $criteria;
		}
		$query = new cTableUsers2GroupsQuery();
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
	 * @return    cTableUsers2Groups|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = cTableUsers2GroupsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(cTableUsers2GroupsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    cTableUsers2Groups A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `GROUP_ID`, `COMMENT` FROM `users2groups` WHERE `ID` = :p0';
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
			$obj = new cTableUsers2Groups();
			$obj->hydrate($row);
			cTableUsers2GroupsPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    cTableUsers2Groups|array|mixed the result, formatted by the current formatter
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
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(cTableUsers2GroupsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(cTableUsers2GroupsPeer::ID, $keys, Criteria::IN);
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
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(cTableUsers2GroupsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByuserId('fooValue');   // WHERE user_id = 'fooValue'
	 * $query->filterByuserId('%fooValue%'); // WHERE user_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $userId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function filterByuserId($userId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userId)) {
				$userId = str_replace('*', '%', $userId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(cTableUsers2GroupsPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the group_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBygroupId('fooValue');   // WHERE group_id = 'fooValue'
	 * $query->filterBygroupId('%fooValue%'); // WHERE group_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $groupId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function filterBygroupId($groupId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($groupId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $groupId)) {
				$groupId = str_replace('*', '%', $groupId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(cTableUsers2GroupsPeer::GROUP_ID, $groupId, $comparison);
	}

	/**
	 * Filter the query on the comment column
	 *
	 * @param     mixed $comment The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function filterByComment($comment = null, $comparison = null)
	{
		return $this->addUsingAlias(cTableUsers2GroupsPeer::COMMENT, $comment, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     cTableUsers2Groups $cTableUsers2Groups Object to remove from the list of results
	 *
	 * @return    cTableUsers2GroupsQuery The current query, for fluid interface
	 */
	public function prune($cTableUsers2Groups = null)
	{
		if ($cTableUsers2Groups) {
			$this->addUsingAlias(cTableUsers2GroupsPeer::ID, $cTableUsers2Groups->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasecTableUsers2GroupsQuery