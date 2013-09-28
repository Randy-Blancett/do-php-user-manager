<?php

namespace MidnightPublishing\User_Manager\database\map;

use \RelationMap;
use \TableMap;


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
        $this->setClassname('MidnightPublishing\\User_Manager\\database\\cTableUsers');
        $this->setPackage('database');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'VARCHAR', true, 36, null);
        $this->addColumn('user_name', 'userName', 'VARCHAR', true, 25, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 40, null);
        $this->addColumn('first_name', 'firstName', 'VARCHAR', false, 20, null);
        $this->addColumn('middle_name', 'middleName', 'VARCHAR', false, 20, null);
        $this->addColumn('last_name', 'lastName', 'VARCHAR', false, 50, null);
        $this->addColumn('personal_title', 'personalTitle', 'VARCHAR', false, 10, null);
        $this->addColumn('professional_title', 'professionalTitle', 'VARCHAR', false, 10, null);
        $this->addColumn('phone_num_1', 'phoneNum1', 'VARCHAR', false, 30, null);
        $this->addColumn('phone_num_2', 'phoneNum2', 'VARCHAR', false, 30, null);
        $this->addColumn('email1', 'Email1', 'VARCHAR', false, 30, null);
        $this->addColumn('email2', 'Email2', 'VARCHAR', false, 30, null);
        $this->addColumn('assigned_org', 'assignedOrg', 'VARCHAR', false, 30, null);
        $this->addColumn('org', 'Org', 'VARCHAR', false, 30, null);
        $this->addColumn('company', 'Company', 'VARCHAR', false, 30, null);
        $this->addColumn('affiliation', 'Affiliation', 'VARCHAR', false, 30, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 10, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, 100, null);
        $this->addColumn('suite', 'Suite', 'VARCHAR', false, 20, null);
        $this->addColumn('last_login', 'lastLogin', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_updated', 'lastUpdated', 'TIMESTAMP', false, null, null);
        $this->addColumn('account_creation', 'accountCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('comment', 'Comment', 'BLOB', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // cTableUsersTableMap
