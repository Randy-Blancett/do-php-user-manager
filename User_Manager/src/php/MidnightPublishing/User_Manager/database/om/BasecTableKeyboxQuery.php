<?php


/**
 * Base class that represents a query for the 'keybox' table.
 *
 *
 *
 * @method cTableKeyboxQuery orderById($order = Criteria::ASC) Order by the id column
 * @method cTableKeyboxQuery orderByactionId($order = Criteria::ASC) Order by the action_id column
 * @method cTableKeyboxQuery orderBylinkType($order = Criteria::ASC) Order by the link_type column
 * @method cTableKeyboxQuery orderBylinkId($order = Criteria::ASC) Order by the link_id column
 * @method cTableKeyboxQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method cTableKeyboxQuery groupById() Group by the id column
 * @method cTableKeyboxQuery groupByactionId() Group by the action_id column
 * @method cTableKeyboxQuery groupBylinkType() Group by the link_type column
 * @method cTableKeyboxQuery groupBylinkId() Group by the link_id column
 * @method cTableKeyboxQuery groupByComment() Group by the comment column
 *
 * @method cTableKeyboxQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method cTableKeyboxQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method cTableKeyboxQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method cTableKeybox findOne(PropelPDO $con = null) Return the first cTableKeybox matching the query
 * @method cTableKeybox findOneOrCreate(PropelPDO $con = null) Return the first cTableKeybox matching the query, or a new cTableKeybox object populated from the query conditions when no match is found
 *
 * @method cTableKeybox findOneByactionId(string $action_id) Return the first cTableKeybox filtered by the action_id column
 * @method cTableKeybox findOneBylinkType(int $link_type) Return the first cTableKeybox filtered by the link_type column
 * @method cTableKeybox findOneBylinkId(string $link_id) Return the first cTableKeybox filtered by the link_id column
 * @method cTableKeybox findOneByComment(resource $comment) Return the first cTableKeybox filtered by the comment column
 *
 * @method array findById(string $id) Return cTableKeybox objects filtered by the id column
 * @method array findByactionId(string $action_id) Return cTableKeybox objects filtered by the action_id column
 * @method array findBylinkType(int $link_type) Return cTableKeybox objects filtered by the link_type column
 * @method array findBylinkId(string $link_id) Return cTableKeybox objects filtered by the link_id column
 * @method array findByComment(resource $comment) Return cTableKeybox objects filtered by the comment column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableKeyboxQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasecTableKeyboxQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'user_manager', $modelName = 'cTableKeybox', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new cTableKeyboxQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   cTableKeyboxQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return cTableKeyboxQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof cTableKeyboxQuery) {
            return $criteria;
        }
        $query = new cTableKeyboxQuery();
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
     * @return   cTableKeybox|cTableKeybox[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = cTableKeyboxPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(cTableKeyboxPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 cTableKeybox A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 cTableKeybox A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `action_id`, `link_type`, `link_id`, `comment` FROM `keybox` WHERE `id` = :p0';
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
            $obj = new cTableKeybox();
            $obj->hydrate($row);
            cTableKeyboxPeer::addInstanceToPool($obj, (string) $key);
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
     * @return cTableKeybox|cTableKeybox[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|cTableKeybox[]|mixed the list of results, formatted by the current formatter
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
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(cTableKeyboxPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(cTableKeyboxPeer::ID, $keys, Criteria::IN);
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
     * @return cTableKeyboxQuery The current query, for fluid interface
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

        return $this->addUsingAlias(cTableKeyboxPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the action_id column
     *
     * Example usage:
     * <code>
     * $query->filterByactionId('fooValue');   // WHERE action_id = 'fooValue'
     * $query->filterByactionId('%fooValue%'); // WHERE action_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $actionId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterByactionId($actionId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actionId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $actionId)) {
                $actionId = str_replace('*', '%', $actionId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableKeyboxPeer::ACTION_ID, $actionId, $comparison);
    }

    /**
     * Filter the query on the link_type column
     *
     * Example usage:
     * <code>
     * $query->filterBylinkType(1234); // WHERE link_type = 1234
     * $query->filterBylinkType(array(12, 34)); // WHERE link_type IN (12, 34)
     * $query->filterBylinkType(array('min' => 12)); // WHERE link_type >= 12
     * $query->filterBylinkType(array('max' => 12)); // WHERE link_type <= 12
     * </code>
     *
     * @param     mixed $linkType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterBylinkType($linkType = null, $comparison = null)
    {
        if (is_array($linkType)) {
            $useMinMax = false;
            if (isset($linkType['min'])) {
                $this->addUsingAlias(cTableKeyboxPeer::LINK_TYPE, $linkType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($linkType['max'])) {
                $this->addUsingAlias(cTableKeyboxPeer::LINK_TYPE, $linkType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(cTableKeyboxPeer::LINK_TYPE, $linkType, $comparison);
    }

    /**
     * Filter the query on the link_id column
     *
     * Example usage:
     * <code>
     * $query->filterBylinkId('fooValue');   // WHERE link_id = 'fooValue'
     * $query->filterBylinkId('%fooValue%'); // WHERE link_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $linkId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterBylinkId($linkId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($linkId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $linkId)) {
                $linkId = str_replace('*', '%', $linkId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableKeyboxPeer::LINK_ID, $linkId, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * @param     mixed $comment The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {

        return $this->addUsingAlias(cTableKeyboxPeer::COMMENT, $comment, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   cTableKeybox $cTableKeybox Object to remove from the list of results
     *
     * @return cTableKeyboxQuery The current query, for fluid interface
     */
    public function prune($cTableKeybox = null)
    {
        if ($cTableKeybox) {
            $this->addUsingAlias(cTableKeyboxPeer::ID, $cTableKeybox->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
