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
use MidnightPublishing\User_Manager\database\cTableUsers;
use MidnightPublishing\User_Manager\database\cTableUsersPeer;
use MidnightPublishing\User_Manager\database\cTableUsersQuery;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method cTableUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method cTableUsersQuery orderByuserName($order = Criteria::ASC) Order by the user_name column
 * @method cTableUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method cTableUsersQuery orderByfirstName($order = Criteria::ASC) Order by the first_name column
 * @method cTableUsersQuery orderBymiddleName($order = Criteria::ASC) Order by the middle_name column
 * @method cTableUsersQuery orderBylastName($order = Criteria::ASC) Order by the last_name column
 * @method cTableUsersQuery orderBypersonalTitle($order = Criteria::ASC) Order by the personal_title column
 * @method cTableUsersQuery orderByprofessionalTitle($order = Criteria::ASC) Order by the professional_title column
 * @method cTableUsersQuery orderByphoneNum1($order = Criteria::ASC) Order by the phone_num_1 column
 * @method cTableUsersQuery orderByphoneNum2($order = Criteria::ASC) Order by the phone_num_2 column
 * @method cTableUsersQuery orderByEmail1($order = Criteria::ASC) Order by the email1 column
 * @method cTableUsersQuery orderByEmail2($order = Criteria::ASC) Order by the email2 column
 * @method cTableUsersQuery orderByassignedOrg($order = Criteria::ASC) Order by the assigned_org column
 * @method cTableUsersQuery orderByOrg($order = Criteria::ASC) Order by the org column
 * @method cTableUsersQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method cTableUsersQuery orderByAffiliation($order = Criteria::ASC) Order by the affiliation column
 * @method cTableUsersQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method cTableUsersQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method cTableUsersQuery orderBySuite($order = Criteria::ASC) Order by the suite column
 * @method cTableUsersQuery orderBylastLogin($order = Criteria::ASC) Order by the last_login column
 * @method cTableUsersQuery orderBylastUpdated($order = Criteria::ASC) Order by the last_updated column
 * @method cTableUsersQuery orderByaccountCreation($order = Criteria::ASC) Order by the account_creation column
 * @method cTableUsersQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method cTableUsersQuery groupById() Group by the id column
 * @method cTableUsersQuery groupByuserName() Group by the user_name column
 * @method cTableUsersQuery groupByPassword() Group by the password column
 * @method cTableUsersQuery groupByfirstName() Group by the first_name column
 * @method cTableUsersQuery groupBymiddleName() Group by the middle_name column
 * @method cTableUsersQuery groupBylastName() Group by the last_name column
 * @method cTableUsersQuery groupBypersonalTitle() Group by the personal_title column
 * @method cTableUsersQuery groupByprofessionalTitle() Group by the professional_title column
 * @method cTableUsersQuery groupByphoneNum1() Group by the phone_num_1 column
 * @method cTableUsersQuery groupByphoneNum2() Group by the phone_num_2 column
 * @method cTableUsersQuery groupByEmail1() Group by the email1 column
 * @method cTableUsersQuery groupByEmail2() Group by the email2 column
 * @method cTableUsersQuery groupByassignedOrg() Group by the assigned_org column
 * @method cTableUsersQuery groupByOrg() Group by the org column
 * @method cTableUsersQuery groupByCompany() Group by the company column
 * @method cTableUsersQuery groupByAffiliation() Group by the affiliation column
 * @method cTableUsersQuery groupByType() Group by the type column
 * @method cTableUsersQuery groupByLocation() Group by the location column
 * @method cTableUsersQuery groupBySuite() Group by the suite column
 * @method cTableUsersQuery groupBylastLogin() Group by the last_login column
 * @method cTableUsersQuery groupBylastUpdated() Group by the last_updated column
 * @method cTableUsersQuery groupByaccountCreation() Group by the account_creation column
 * @method cTableUsersQuery groupByComment() Group by the comment column
 *
 * @method cTableUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method cTableUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method cTableUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method cTableUsers findOne(PropelPDO $con = null) Return the first cTableUsers matching the query
 * @method cTableUsers findOneOrCreate(PropelPDO $con = null) Return the first cTableUsers matching the query, or a new cTableUsers object populated from the query conditions when no match is found
 *
 * @method cTableUsers findOneByuserName(string $user_name) Return the first cTableUsers filtered by the user_name column
 * @method cTableUsers findOneByPassword(string $password) Return the first cTableUsers filtered by the password column
 * @method cTableUsers findOneByfirstName(string $first_name) Return the first cTableUsers filtered by the first_name column
 * @method cTableUsers findOneBymiddleName(string $middle_name) Return the first cTableUsers filtered by the middle_name column
 * @method cTableUsers findOneBylastName(string $last_name) Return the first cTableUsers filtered by the last_name column
 * @method cTableUsers findOneBypersonalTitle(string $personal_title) Return the first cTableUsers filtered by the personal_title column
 * @method cTableUsers findOneByprofessionalTitle(string $professional_title) Return the first cTableUsers filtered by the professional_title column
 * @method cTableUsers findOneByphoneNum1(string $phone_num_1) Return the first cTableUsers filtered by the phone_num_1 column
 * @method cTableUsers findOneByphoneNum2(string $phone_num_2) Return the first cTableUsers filtered by the phone_num_2 column
 * @method cTableUsers findOneByEmail1(string $email1) Return the first cTableUsers filtered by the email1 column
 * @method cTableUsers findOneByEmail2(string $email2) Return the first cTableUsers filtered by the email2 column
 * @method cTableUsers findOneByassignedOrg(string $assigned_org) Return the first cTableUsers filtered by the assigned_org column
 * @method cTableUsers findOneByOrg(string $org) Return the first cTableUsers filtered by the org column
 * @method cTableUsers findOneByCompany(string $company) Return the first cTableUsers filtered by the company column
 * @method cTableUsers findOneByAffiliation(string $affiliation) Return the first cTableUsers filtered by the affiliation column
 * @method cTableUsers findOneByType(string $type) Return the first cTableUsers filtered by the type column
 * @method cTableUsers findOneByLocation(string $location) Return the first cTableUsers filtered by the location column
 * @method cTableUsers findOneBySuite(string $suite) Return the first cTableUsers filtered by the suite column
 * @method cTableUsers findOneBylastLogin(string $last_login) Return the first cTableUsers filtered by the last_login column
 * @method cTableUsers findOneBylastUpdated(string $last_updated) Return the first cTableUsers filtered by the last_updated column
 * @method cTableUsers findOneByaccountCreation(string $account_creation) Return the first cTableUsers filtered by the account_creation column
 * @method cTableUsers findOneByComment(resource $comment) Return the first cTableUsers filtered by the comment column
 *
 * @method array findById(string $id) Return cTableUsers objects filtered by the id column
 * @method array findByuserName(string $user_name) Return cTableUsers objects filtered by the user_name column
 * @method array findByPassword(string $password) Return cTableUsers objects filtered by the password column
 * @method array findByfirstName(string $first_name) Return cTableUsers objects filtered by the first_name column
 * @method array findBymiddleName(string $middle_name) Return cTableUsers objects filtered by the middle_name column
 * @method array findBylastName(string $last_name) Return cTableUsers objects filtered by the last_name column
 * @method array findBypersonalTitle(string $personal_title) Return cTableUsers objects filtered by the personal_title column
 * @method array findByprofessionalTitle(string $professional_title) Return cTableUsers objects filtered by the professional_title column
 * @method array findByphoneNum1(string $phone_num_1) Return cTableUsers objects filtered by the phone_num_1 column
 * @method array findByphoneNum2(string $phone_num_2) Return cTableUsers objects filtered by the phone_num_2 column
 * @method array findByEmail1(string $email1) Return cTableUsers objects filtered by the email1 column
 * @method array findByEmail2(string $email2) Return cTableUsers objects filtered by the email2 column
 * @method array findByassignedOrg(string $assigned_org) Return cTableUsers objects filtered by the assigned_org column
 * @method array findByOrg(string $org) Return cTableUsers objects filtered by the org column
 * @method array findByCompany(string $company) Return cTableUsers objects filtered by the company column
 * @method array findByAffiliation(string $affiliation) Return cTableUsers objects filtered by the affiliation column
 * @method array findByType(string $type) Return cTableUsers objects filtered by the type column
 * @method array findByLocation(string $location) Return cTableUsers objects filtered by the location column
 * @method array findBySuite(string $suite) Return cTableUsers objects filtered by the suite column
 * @method array findBylastLogin(string $last_login) Return cTableUsers objects filtered by the last_login column
 * @method array findBylastUpdated(string $last_updated) Return cTableUsers objects filtered by the last_updated column
 * @method array findByaccountCreation(string $account_creation) Return cTableUsers objects filtered by the account_creation column
 * @method array findByComment(resource $comment) Return cTableUsers objects filtered by the comment column
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableUsersQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasecTableUsersQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'user_manager', $modelName = 'MidnightPublishing\\User_Manager\\database\\cTableUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new cTableUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   cTableUsersQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return cTableUsersQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof cTableUsersQuery) {
            return $criteria;
        }
        $query = new cTableUsersQuery();
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
     * @return   cTableUsers|cTableUsers[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = cTableUsersPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 cTableUsers A model object, or null if the key is not found
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
     * @return                 cTableUsers A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `user_name`, `password`, `first_name`, `middle_name`, `last_name`, `personal_title`, `professional_title`, `phone_num_1`, `phone_num_2`, `email1`, `email2`, `assigned_org`, `org`, `company`, `affiliation`, `type`, `location`, `suite`, `last_login`, `last_updated`, `account_creation`, `comment` FROM `users` WHERE `id` = :p0';
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
            $obj = new cTableUsers();
            $obj->hydrate($row);
            cTableUsersPeer::addInstanceToPool($obj, (string) $key);
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
     * @return cTableUsers|cTableUsers[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|cTableUsers[]|mixed the list of results, formatted by the current formatter
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
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(cTableUsersPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(cTableUsersPeer::ID, $keys, Criteria::IN);
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
     * @return cTableUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(cTableUsersPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByuserName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByuserName('%fooValue%'); // WHERE user_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByuserName($userName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userName)) {
                $userName = str_replace('*', '%', $userName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::USER_NAME, $userName, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByfirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByfirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByfirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the middle_name column
     *
     * Example usage:
     * <code>
     * $query->filterBymiddleName('fooValue');   // WHERE middle_name = 'fooValue'
     * $query->filterBymiddleName('%fooValue%'); // WHERE middle_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $middleName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBymiddleName($middleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $middleName)) {
                $middleName = str_replace('*', '%', $middleName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::MIDDLE_NAME, $middleName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterBylastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterBylastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBylastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the personal_title column
     *
     * Example usage:
     * <code>
     * $query->filterBypersonalTitle('fooValue');   // WHERE personal_title = 'fooValue'
     * $query->filterBypersonalTitle('%fooValue%'); // WHERE personal_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $personalTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBypersonalTitle($personalTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personalTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $personalTitle)) {
                $personalTitle = str_replace('*', '%', $personalTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::PERSONAL_TITLE, $personalTitle, $comparison);
    }

    /**
     * Filter the query on the professional_title column
     *
     * Example usage:
     * <code>
     * $query->filterByprofessionalTitle('fooValue');   // WHERE professional_title = 'fooValue'
     * $query->filterByprofessionalTitle('%fooValue%'); // WHERE professional_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $professionalTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByprofessionalTitle($professionalTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($professionalTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $professionalTitle)) {
                $professionalTitle = str_replace('*', '%', $professionalTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::PROFESSIONAL_TITLE, $professionalTitle, $comparison);
    }

    /**
     * Filter the query on the phone_num_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByphoneNum1('fooValue');   // WHERE phone_num_1 = 'fooValue'
     * $query->filterByphoneNum1('%fooValue%'); // WHERE phone_num_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNum1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByphoneNum1($phoneNum1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNum1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneNum1)) {
                $phoneNum1 = str_replace('*', '%', $phoneNum1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::PHONE_NUM_1, $phoneNum1, $comparison);
    }

    /**
     * Filter the query on the phone_num_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByphoneNum2('fooValue');   // WHERE phone_num_2 = 'fooValue'
     * $query->filterByphoneNum2('%fooValue%'); // WHERE phone_num_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNum2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByphoneNum2($phoneNum2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNum2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneNum2)) {
                $phoneNum2 = str_replace('*', '%', $phoneNum2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::PHONE_NUM_2, $phoneNum2, $comparison);
    }

    /**
     * Filter the query on the email1 column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail1('fooValue');   // WHERE email1 = 'fooValue'
     * $query->filterByEmail1('%fooValue%'); // WHERE email1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByEmail1($email1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email1)) {
                $email1 = str_replace('*', '%', $email1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::EMAIL1, $email1, $comparison);
    }

    /**
     * Filter the query on the email2 column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail2('fooValue');   // WHERE email2 = 'fooValue'
     * $query->filterByEmail2('%fooValue%'); // WHERE email2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByEmail2($email2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email2)) {
                $email2 = str_replace('*', '%', $email2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::EMAIL2, $email2, $comparison);
    }

    /**
     * Filter the query on the assigned_org column
     *
     * Example usage:
     * <code>
     * $query->filterByassignedOrg('fooValue');   // WHERE assigned_org = 'fooValue'
     * $query->filterByassignedOrg('%fooValue%'); // WHERE assigned_org LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assignedOrg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByassignedOrg($assignedOrg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assignedOrg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assignedOrg)) {
                $assignedOrg = str_replace('*', '%', $assignedOrg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::ASSIGNED_ORG, $assignedOrg, $comparison);
    }

    /**
     * Filter the query on the org column
     *
     * Example usage:
     * <code>
     * $query->filterByOrg('fooValue');   // WHERE org = 'fooValue'
     * $query->filterByOrg('%fooValue%'); // WHERE org LIKE '%fooValue%'
     * </code>
     *
     * @param     string $org The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByOrg($org = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($org)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $org)) {
                $org = str_replace('*', '%', $org);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::ORG, $org, $comparison);
    }

    /**
     * Filter the query on the company column
     *
     * Example usage:
     * <code>
     * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
     * $query->filterByCompany('%fooValue%'); // WHERE company LIKE '%fooValue%'
     * </code>
     *
     * @param     string $company The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByCompany($company = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($company)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $company)) {
                $company = str_replace('*', '%', $company);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::COMPANY, $company, $comparison);
    }

    /**
     * Filter the query on the affiliation column
     *
     * Example usage:
     * <code>
     * $query->filterByAffiliation('fooValue');   // WHERE affiliation = 'fooValue'
     * $query->filterByAffiliation('%fooValue%'); // WHERE affiliation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $affiliation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByAffiliation($affiliation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($affiliation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $affiliation)) {
                $affiliation = str_replace('*', '%', $affiliation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::AFFILIATION, $affiliation, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%'); // WHERE location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $location)) {
                $location = str_replace('*', '%', $location);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the suite column
     *
     * Example usage:
     * <code>
     * $query->filterBySuite('fooValue');   // WHERE suite = 'fooValue'
     * $query->filterBySuite('%fooValue%'); // WHERE suite LIKE '%fooValue%'
     * </code>
     *
     * @param     string $suite The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBySuite($suite = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($suite)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $suite)) {
                $suite = str_replace('*', '%', $suite);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::SUITE, $suite, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterBylastLogin('2011-03-14'); // WHERE last_login = '2011-03-14'
     * $query->filterBylastLogin('now'); // WHERE last_login = '2011-03-14'
     * $query->filterBylastLogin(array('max' => 'yesterday')); // WHERE last_login > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastLogin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBylastLogin($lastLogin = null, $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(cTableUsersPeer::LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(cTableUsersPeer::LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::LAST_LOGIN, $lastLogin, $comparison);
    }

    /**
     * Filter the query on the last_updated column
     *
     * Example usage:
     * <code>
     * $query->filterBylastUpdated('2011-03-14'); // WHERE last_updated = '2011-03-14'
     * $query->filterBylastUpdated('now'); // WHERE last_updated = '2011-03-14'
     * $query->filterBylastUpdated(array('max' => 'yesterday')); // WHERE last_updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastUpdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterBylastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(cTableUsersPeer::LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(cTableUsersPeer::LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query on the account_creation column
     *
     * Example usage:
     * <code>
     * $query->filterByaccountCreation('2011-03-14'); // WHERE account_creation = '2011-03-14'
     * $query->filterByaccountCreation('now'); // WHERE account_creation = '2011-03-14'
     * $query->filterByaccountCreation(array('max' => 'yesterday')); // WHERE account_creation > '2011-03-13'
     * </code>
     *
     * @param     mixed $accountCreation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByaccountCreation($accountCreation = null, $comparison = null)
    {
        if (is_array($accountCreation)) {
            $useMinMax = false;
            if (isset($accountCreation['min'])) {
                $this->addUsingAlias(cTableUsersPeer::ACCOUNT_CREATION, $accountCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountCreation['max'])) {
                $this->addUsingAlias(cTableUsersPeer::ACCOUNT_CREATION, $accountCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(cTableUsersPeer::ACCOUNT_CREATION, $accountCreation, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * @param     mixed $comment The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {

        return $this->addUsingAlias(cTableUsersPeer::COMMENT, $comment, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   cTableUsers $cTableUsers Object to remove from the list of results
     *
     * @return cTableUsersQuery The current query, for fluid interface
     */
    public function prune($cTableUsers = null)
    {
        if ($cTableUsers) {
            $this->addUsingAlias(cTableUsersPeer::ID, $cTableUsers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
