<?php



/**
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.database.map
 */
class cTableUsersTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'database.map.cTableUsersTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('users');
        $this->setPhpName('cTableUsers');
        $this->setClassname('cTableUsers');
        $this->setPackage('database');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 36, null);
        $this->addColumn('USER_NAME', 'userName', 'VARCHAR', true, 25, null);
        $this->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 40, null);
        $this->addColumn('FIRST_NAME', 'firstName', 'VARCHAR', false, 20, null);
        $this->addColumn('MIDDLE_NAME', 'middleName', 'VARCHAR', false, 20, null);
        $this->addColumn('LAST_NAME', 'lastName', 'VARCHAR', false, 50, null);
        $this->addColumn('PERSONAL_TITLE', 'personalTitle', 'VARCHAR', false, 10, null);
        $this->addColumn('PROFESSIONAL_TITLE', 'professionalTitle', 'VARCHAR', false, 10, null);
        $this->addColumn('PHONE_NUM_1', 'phoneNum1', 'VARCHAR', false, 30, null);
        $this->addColumn('PHONE_NUM_2', 'phoneNum2', 'VARCHAR', false, 30, null);
        $this->addColumn('EMAIL1', 'Email1', 'VARCHAR', false, 30, null);
        $this->addColumn('EMAIL2', 'Email2', 'VARCHAR', false, 30, null);
        $this->addColumn('ASSIGNED_ORG', 'assignedOrg', 'VARCHAR', false, 30, null);
        $this->addColumn('ORG', 'Org', 'VARCHAR', false, 30, null);
        $this->addColumn('COMPANY', 'Company', 'VARCHAR', false, 30, null);
        $this->addColumn('AFFILIATION', 'Affiliation', 'VARCHAR', false, 30, null);
        $this->addColumn('TYPE', 'Type', 'VARCHAR', false, 10, null);
        $this->addColumn('LOCATION', 'Location', 'VARCHAR', false, 100, null);
        $this->addColumn('SUITE', 'Suite', 'VARCHAR', false, 20, null);
        $this->addColumn('LAST_LOGIN', 'lastLogin', 'TIMESTAMP', false, null, null);
        $this->addColumn('LAST_UPDATED', 'lastUpdated', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACCOUNT_CREATION', 'accountCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('COMMENT', 'Comment', 'BLOB', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // cTableUsersTableMap
