<?php

namespace MidnightPublishing\User_Manager\database\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'keybox' table.
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
class cTableKeyboxTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'database.map.cTableKeyboxTableMap';

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
        $this->setName('keybox');
        $this->setPhpName('cTableKeybox');
        $this->setClassname('MidnightPublishing\\User_Manager\\database\\cTableKeybox');
        $this->setPackage('database');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'VARCHAR', true, 36, null);
        $this->addColumn('action_id', 'actionId', 'VARCHAR', true, 36, null);
        $this->addColumn('link_type', 'linkType', 'INTEGER', true, 1, null);
        $this->addColumn('link_id', 'linkId', 'VARCHAR', true, 50, null);
        $this->addColumn('comment', 'Comment', 'BLOB', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // cTableKeyboxTableMap
