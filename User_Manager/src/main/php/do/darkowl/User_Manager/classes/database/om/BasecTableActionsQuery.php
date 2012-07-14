<?php


/**
 * Base class that represents a query for the 'actions' table.
 *
 * 
 *
 * @method     cTableActionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     cTableActionsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     cTableActionsQuery orderByApplication($order = Criteria::ASC) Order by the application column
 * @method     cTableActionsQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     cTableActionsQuery groupById() Group by the id column
 * @method     cTableActionsQuery groupByName() Group by the name column
 * @method     cTableActionsQuery groupByApplication() Group by the application column
 * @method     cTableActionsQuery groupByComment() Group by the comment column
 *
 * @method     cTableActionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     cTableActionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     cTableActionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     cTableActions findOne(PropelPDO $con = null) Return the first cTableActions matching the query
 * @method     cTableActions findOneOrCreate(PropelPDO $con = null) Return the first cTableActions matching the query, or a new cTableActions object populated from the query conditions when no match is found
 *
 * @method     cTableActions findOneById(string $id) Return the first cTableActions filtered by the id column
 * @method     cTableActions findOneByName(string $name) Return the first cTableActions filtered by the name column
 * @method     cTableActions findOneByApplication(string $application) Return the first cTableActions filtered by the application column
 * @method     cTableActions findOneByComment(resource $comment) Return the first cTableActions filtered by the comment column
 *
 * @method     array findById(string $id) Return cTableActions objects filtered by the id column
 * @method     array findByName(string $name) Return cTableActions objects filtered by the name column
 * @method     array findByApplication(string $application) Return cTableActions objects filtered by the application column
 * @method     array findByComment(resource $comment) Return cTableActions objects filtered by the comment column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableActionsQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BasecTableActionsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'user_manager', $modelName = 'cTableActions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new cTableActionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     cTableActionsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return cTableActionsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof cTableActionsQuery) {
            return $criteria;
        }
        $query = new cTableActionsQuery();
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
     * @param mixed $key Primary key to use for the query 
     * @param     PropelPDO $con an optional connection object
     *
     * @return   cTableActions|cTableActions[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = cTableActionsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(cTableActionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   cTableActions A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `APPLICATION`, `COMMENT` FROM `actions` WHERE `ID` = :p0';
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
            $obj = new cTableActions();
            $obj->hydrate($row);
            cTableActionsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return cTableActions|cTableActions[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|cTableActions[]|mixed the list of results, formatted by the current formatter
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
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(cTableActionsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(cTableActionsPeer::ID, $keys, Criteria::IN);
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
     * @return cTableActionsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(cTableActionsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableActionsPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the application column
     *
     * Example usage:
     * <code>
     * $query->filterByApplication('fooValue');   // WHERE application = 'fooValue'
     * $query->filterByApplication('%fooValue%'); // WHERE application LIKE '%fooValue%'
     * </code>
     *
     * @param     string $application The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function filterByApplication($application = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($application)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $application)) {
                $application = str_replace('*', '%', $application);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableActionsPeer::APPLICATION, $application, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * @param     mixed $comment The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {

        return $this->addUsingAlias(cTableActionsPeer::COMMENT, $comment, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   cTableActions $cTableActions Object to remove from the list of results
     *
     * @return cTableActionsQuery The current query, for fluid interface
     */
    public function prune($cTableActions = null)
    {
        if ($cTableActions) {
            $this->addUsingAlias(cTableActionsPeer::ID, $cTableActions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BasecTableActionsQuery