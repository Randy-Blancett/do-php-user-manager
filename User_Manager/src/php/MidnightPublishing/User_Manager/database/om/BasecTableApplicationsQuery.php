<?php

namespace MidnightPublishing\User_Manager\database\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use MidnightPublishing\User_Manager\database\cTableApplications;
use MidnightPublishing\User_Manager\database\cTableApplicationsPeer;
use MidnightPublishing\User_Manager\database\cTableApplicationsQuery;

/**
 * Base class that represents a query for the 'applications' table.
 *
 *
 *
 * @method cTableApplicationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method cTableApplicationsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method cTableApplicationsQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method cTableApplicationsQuery groupById() Group by the id column
 * @method cTableApplicationsQuery groupByName() Group by the name column
 * @method cTableApplicationsQuery groupByComment() Group by the comment column
 *
 * @method cTableApplicationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method cTableApplicationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method cTableApplicationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method cTableApplications findOne(PropelPDO $con = null) Return the first cTableApplications matching the query
 * @method cTableApplications findOneOrCreate(PropelPDO $con = null) Return the first cTableApplications matching the query, or a new cTableApplications object populated from the query conditions when no match is found
 *
 * @method cTableApplications findOneByName(string $name) Return the first cTableApplications filtered by the name column
 * @method cTableApplications findOneByComment(resource $comment) Return the first cTableApplications filtered by the comment column
 *
 * @method array findById(string $id) Return cTableApplications objects filtered by the id column
 * @method array findByName(string $name) Return cTableApplications objects filtered by the name column
 * @method array findByComment(resource $comment) Return cTableApplications objects filtered by the comment column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableApplicationsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasecTableApplicationsQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'user_manager', $modelName = 'MidnightPublishing\\User_Manager\\database\\cTableApplications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new cTableApplicationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   cTableApplicationsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return cTableApplicationsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof cTableApplicationsQuery) {
            return $criteria;
        }
        $query = new cTableApplicationsQuery();
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
     * @return   cTableApplications|cTableApplications[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = cTableApplicationsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(cTableApplicationsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 cTableApplications A model object, or null if the key is not found
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
     * @return                 cTableApplications A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `comment` FROM `applications` WHERE `id` = :p0';
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
            $obj = new cTableApplications();
            $obj->hydrate($row);
            cTableApplicationsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return cTableApplications|cTableApplications[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|cTableApplications[]|mixed the list of results, formatted by the current formatter
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
     * @return cTableApplicationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(cTableApplicationsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return cTableApplicationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(cTableApplicationsPeer::ID, $keys, Criteria::IN);
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
     * @return cTableApplicationsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(cTableApplicationsPeer::ID, $id, $comparison);
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
     * @return cTableApplicationsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(cTableApplicationsPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * @param     mixed $comment The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableApplicationsQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {

        return $this->addUsingAlias(cTableApplicationsPeer::COMMENT, $comment, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   cTableApplications $cTableApplications Object to remove from the list of results
     *
     * @return cTableApplicationsQuery The current query, for fluid interface
     */
    public function prune($cTableApplications = null)
    {
        if ($cTableApplications) {
            $this->addUsingAlias(cTableApplicationsPeer::ID, $cTableApplications->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
