<?php


/**
 * Base static class for performing query and update operations on the 'users' table.
 *
 *
 *
 * @package propel.generator.database.om
 */
abstract class BasecTableUsersPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'user_manager';

    /** the table name for this class */
    const TABLE_NAME = 'users';

    /** the related Propel class for this table */
    const OM_CLASS = 'cTableUsers';

    /** the related TableMap class for this table */
    const TM_CLASS = 'cTableUsersTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 23;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 23;

    /** the column name for the id field */
    const ID = 'users.id';

    /** the column name for the user_name field */
    const USER_NAME = 'users.user_name';

    /** the column name for the password field */
    const PASSWORD = 'users.password';

    /** the column name for the first_name field */
    const FIRST_NAME = 'users.first_name';

    /** the column name for the middle_name field */
    const MIDDLE_NAME = 'users.middle_name';

    /** the column name for the last_name field */
    const LAST_NAME = 'users.last_name';

    /** the column name for the personal_title field */
    const PERSONAL_TITLE = 'users.personal_title';

    /** the column name for the professional_title field */
    const PROFESSIONAL_TITLE = 'users.professional_title';

    /** the column name for the phone_num_1 field */
    const PHONE_NUM_1 = 'users.phone_num_1';

    /** the column name for the phone_num_2 field */
    const PHONE_NUM_2 = 'users.phone_num_2';

    /** the column name for the email1 field */
    const EMAIL1 = 'users.email1';

    /** the column name for the email2 field */
    const EMAIL2 = 'users.email2';

    /** the column name for the assigned_org field */
    const ASSIGNED_ORG = 'users.assigned_org';

    /** the column name for the org field */
    const ORG = 'users.org';

    /** the column name for the company field */
    const COMPANY = 'users.company';

    /** the column name for the affiliation field */
    const AFFILIATION = 'users.affiliation';

    /** the column name for the type field */
    const TYPE = 'users.type';

    /** the column name for the location field */
    const LOCATION = 'users.location';

    /** the column name for the suite field */
    const SUITE = 'users.suite';

    /** the column name for the last_login field */
    const LAST_LOGIN = 'users.last_login';

    /** the column name for the last_updated field */
    const LAST_UPDATED = 'users.last_updated';

    /** the column name for the account_creation field */
    const ACCOUNT_CREATION = 'users.account_creation';

    /** the column name for the comment field */
    const COMMENT = 'users.comment';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of cTableUsers objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array cTableUsers[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. cTableUsersPeer::$fieldNames[cTableUsersPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'userName', 'Password', 'firstName', 'middleName', 'lastName', 'personalTitle', 'professionalTitle', 'phoneNum1', 'phoneNum2', 'Email1', 'Email2', 'assignedOrg', 'Org', 'Company', 'Affiliation', 'Type', 'Location', 'Suite', 'lastLogin', 'lastUpdated', 'accountCreation', 'Comment', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userName', 'password', 'firstName', 'middleName', 'lastName', 'personalTitle', 'professionalTitle', 'phoneNum1', 'phoneNum2', 'email1', 'email2', 'assignedOrg', 'org', 'company', 'affiliation', 'type', 'location', 'suite', 'lastLogin', 'lastUpdated', 'accountCreation', 'comment', ),
        BasePeer::TYPE_COLNAME => array (cTableUsersPeer::ID, cTableUsersPeer::USER_NAME, cTableUsersPeer::PASSWORD, cTableUsersPeer::FIRST_NAME, cTableUsersPeer::MIDDLE_NAME, cTableUsersPeer::LAST_NAME, cTableUsersPeer::PERSONAL_TITLE, cTableUsersPeer::PROFESSIONAL_TITLE, cTableUsersPeer::PHONE_NUM_1, cTableUsersPeer::PHONE_NUM_2, cTableUsersPeer::EMAIL1, cTableUsersPeer::EMAIL2, cTableUsersPeer::ASSIGNED_ORG, cTableUsersPeer::ORG, cTableUsersPeer::COMPANY, cTableUsersPeer::AFFILIATION, cTableUsersPeer::TYPE, cTableUsersPeer::LOCATION, cTableUsersPeer::SUITE, cTableUsersPeer::LAST_LOGIN, cTableUsersPeer::LAST_UPDATED, cTableUsersPeer::ACCOUNT_CREATION, cTableUsersPeer::COMMENT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'USER_NAME', 'PASSWORD', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'PERSONAL_TITLE', 'PROFESSIONAL_TITLE', 'PHONE_NUM_1', 'PHONE_NUM_2', 'EMAIL1', 'EMAIL2', 'ASSIGNED_ORG', 'ORG', 'COMPANY', 'AFFILIATION', 'TYPE', 'LOCATION', 'SUITE', 'LAST_LOGIN', 'LAST_UPDATED', 'ACCOUNT_CREATION', 'COMMENT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'user_name', 'password', 'first_name', 'middle_name', 'last_name', 'personal_title', 'professional_title', 'phone_num_1', 'phone_num_2', 'email1', 'email2', 'assigned_org', 'org', 'company', 'affiliation', 'type', 'location', 'suite', 'last_login', 'last_updated', 'account_creation', 'comment', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. cTableUsersPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'userName' => 1, 'Password' => 2, 'firstName' => 3, 'middleName' => 4, 'lastName' => 5, 'personalTitle' => 6, 'professionalTitle' => 7, 'phoneNum1' => 8, 'phoneNum2' => 9, 'Email1' => 10, 'Email2' => 11, 'assignedOrg' => 12, 'Org' => 13, 'Company' => 14, 'Affiliation' => 15, 'Type' => 16, 'Location' => 17, 'Suite' => 18, 'lastLogin' => 19, 'lastUpdated' => 20, 'accountCreation' => 21, 'Comment' => 22, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userName' => 1, 'password' => 2, 'firstName' => 3, 'middleName' => 4, 'lastName' => 5, 'personalTitle' => 6, 'professionalTitle' => 7, 'phoneNum1' => 8, 'phoneNum2' => 9, 'email1' => 10, 'email2' => 11, 'assignedOrg' => 12, 'org' => 13, 'company' => 14, 'affiliation' => 15, 'type' => 16, 'location' => 17, 'suite' => 18, 'lastLogin' => 19, 'lastUpdated' => 20, 'accountCreation' => 21, 'comment' => 22, ),
        BasePeer::TYPE_COLNAME => array (cTableUsersPeer::ID => 0, cTableUsersPeer::USER_NAME => 1, cTableUsersPeer::PASSWORD => 2, cTableUsersPeer::FIRST_NAME => 3, cTableUsersPeer::MIDDLE_NAME => 4, cTableUsersPeer::LAST_NAME => 5, cTableUsersPeer::PERSONAL_TITLE => 6, cTableUsersPeer::PROFESSIONAL_TITLE => 7, cTableUsersPeer::PHONE_NUM_1 => 8, cTableUsersPeer::PHONE_NUM_2 => 9, cTableUsersPeer::EMAIL1 => 10, cTableUsersPeer::EMAIL2 => 11, cTableUsersPeer::ASSIGNED_ORG => 12, cTableUsersPeer::ORG => 13, cTableUsersPeer::COMPANY => 14, cTableUsersPeer::AFFILIATION => 15, cTableUsersPeer::TYPE => 16, cTableUsersPeer::LOCATION => 17, cTableUsersPeer::SUITE => 18, cTableUsersPeer::LAST_LOGIN => 19, cTableUsersPeer::LAST_UPDATED => 20, cTableUsersPeer::ACCOUNT_CREATION => 21, cTableUsersPeer::COMMENT => 22, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'USER_NAME' => 1, 'PASSWORD' => 2, 'FIRST_NAME' => 3, 'MIDDLE_NAME' => 4, 'LAST_NAME' => 5, 'PERSONAL_TITLE' => 6, 'PROFESSIONAL_TITLE' => 7, 'PHONE_NUM_1' => 8, 'PHONE_NUM_2' => 9, 'EMAIL1' => 10, 'EMAIL2' => 11, 'ASSIGNED_ORG' => 12, 'ORG' => 13, 'COMPANY' => 14, 'AFFILIATION' => 15, 'TYPE' => 16, 'LOCATION' => 17, 'SUITE' => 18, 'LAST_LOGIN' => 19, 'LAST_UPDATED' => 20, 'ACCOUNT_CREATION' => 21, 'COMMENT' => 22, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_name' => 1, 'password' => 2, 'first_name' => 3, 'middle_name' => 4, 'last_name' => 5, 'personal_title' => 6, 'professional_title' => 7, 'phone_num_1' => 8, 'phone_num_2' => 9, 'email1' => 10, 'email2' => 11, 'assigned_org' => 12, 'org' => 13, 'company' => 14, 'affiliation' => 15, 'type' => 16, 'location' => 17, 'suite' => 18, 'last_login' => 19, 'last_updated' => 20, 'account_creation' => 21, 'comment' => 22, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = cTableUsersPeer::getFieldNames($toType);
        $key = isset(cTableUsersPeer::$fieldKeys[$fromType][$name]) ? cTableUsersPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(cTableUsersPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, cTableUsersPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return cTableUsersPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. cTableUsersPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(cTableUsersPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(cTableUsersPeer::ID);
            $criteria->addSelectColumn(cTableUsersPeer::USER_NAME);
            $criteria->addSelectColumn(cTableUsersPeer::PASSWORD);
            $criteria->addSelectColumn(cTableUsersPeer::FIRST_NAME);
            $criteria->addSelectColumn(cTableUsersPeer::MIDDLE_NAME);
            $criteria->addSelectColumn(cTableUsersPeer::LAST_NAME);
            $criteria->addSelectColumn(cTableUsersPeer::PERSONAL_TITLE);
            $criteria->addSelectColumn(cTableUsersPeer::PROFESSIONAL_TITLE);
            $criteria->addSelectColumn(cTableUsersPeer::PHONE_NUM_1);
            $criteria->addSelectColumn(cTableUsersPeer::PHONE_NUM_2);
            $criteria->addSelectColumn(cTableUsersPeer::EMAIL1);
            $criteria->addSelectColumn(cTableUsersPeer::EMAIL2);
            $criteria->addSelectColumn(cTableUsersPeer::ASSIGNED_ORG);
            $criteria->addSelectColumn(cTableUsersPeer::ORG);
            $criteria->addSelectColumn(cTableUsersPeer::COMPANY);
            $criteria->addSelectColumn(cTableUsersPeer::AFFILIATION);
            $criteria->addSelectColumn(cTableUsersPeer::TYPE);
            $criteria->addSelectColumn(cTableUsersPeer::LOCATION);
            $criteria->addSelectColumn(cTableUsersPeer::SUITE);
            $criteria->addSelectColumn(cTableUsersPeer::LAST_LOGIN);
            $criteria->addSelectColumn(cTableUsersPeer::LAST_UPDATED);
            $criteria->addSelectColumn(cTableUsersPeer::ACCOUNT_CREATION);
            $criteria->addSelectColumn(cTableUsersPeer::COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_name');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.middle_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.personal_title');
            $criteria->addSelectColumn($alias . '.professional_title');
            $criteria->addSelectColumn($alias . '.phone_num_1');
            $criteria->addSelectColumn($alias . '.phone_num_2');
            $criteria->addSelectColumn($alias . '.email1');
            $criteria->addSelectColumn($alias . '.email2');
            $criteria->addSelectColumn($alias . '.assigned_org');
            $criteria->addSelectColumn($alias . '.org');
            $criteria->addSelectColumn($alias . '.company');
            $criteria->addSelectColumn($alias . '.affiliation');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.suite');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.last_updated');
            $criteria->addSelectColumn($alias . '.account_creation');
            $criteria->addSelectColumn($alias . '.comment');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(cTableUsersPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            cTableUsersPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(cTableUsersPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 cTableUsers
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = cTableUsersPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return cTableUsersPeer::populateObjects(cTableUsersPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            cTableUsersPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(cTableUsersPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      cTableUsers $obj A cTableUsers object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            cTableUsersPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A cTableUsers object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof cTableUsers) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or cTableUsers object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(cTableUsersPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   cTableUsers Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(cTableUsersPeer::$instances[$key])) {
                return cTableUsersPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (cTableUsersPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        cTableUsersPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to users
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (string) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = cTableUsersPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = cTableUsersPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = cTableUsersPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                cTableUsersPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (cTableUsers object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = cTableUsersPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = cTableUsersPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + cTableUsersPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = cTableUsersPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            cTableUsersPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(cTableUsersPeer::DATABASE_NAME)->getTable(cTableUsersPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BasecTableUsersPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BasecTableUsersPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new cTableUsersTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return cTableUsersPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a cTableUsers or Criteria object.
     *
     * @param      mixed $values Criteria or cTableUsers object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from cTableUsers object
        }


        // Set the correct dbName
        $criteria->setDbName(cTableUsersPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a cTableUsers or Criteria object.
     *
     * @param      mixed $values Criteria or cTableUsers object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(cTableUsersPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(cTableUsersPeer::ID);
            $value = $criteria->remove(cTableUsersPeer::ID);
            if ($value) {
                $selectCriteria->add(cTableUsersPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(cTableUsersPeer::TABLE_NAME);
            }

        } else { // $values is cTableUsers object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(cTableUsersPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(cTableUsersPeer::TABLE_NAME, $con, cTableUsersPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            cTableUsersPeer::clearInstancePool();
            cTableUsersPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a cTableUsers or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or cTableUsers object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            cTableUsersPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof cTableUsers) { // it's a model object
            // invalidate the cache for this single object
            cTableUsersPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(cTableUsersPeer::DATABASE_NAME);
            $criteria->add(cTableUsersPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                cTableUsersPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(cTableUsersPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            cTableUsersPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given cTableUsers object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      cTableUsers $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(cTableUsersPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(cTableUsersPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(cTableUsersPeer::DATABASE_NAME, cTableUsersPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      string $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return cTableUsers
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = cTableUsersPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(cTableUsersPeer::DATABASE_NAME);
        $criteria->add(cTableUsersPeer::ID, $pk);

        $v = cTableUsersPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return cTableUsers[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(cTableUsersPeer::DATABASE_NAME);
            $criteria->add(cTableUsersPeer::ID, $pks, Criteria::IN);
            $objs = cTableUsersPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BasecTableUsersPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BasecTableUsersPeer::buildTableMap();

