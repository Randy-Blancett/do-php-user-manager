<?php



/**
 * This class defines the structure of the 'users2groups' table.
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
class cTableUsers2GroupsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'database.map.cTableUsers2GroupsTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('users2groups');
		$this->setPhpName('cTableUsers2Groups');
		$this->setClassname('cTableUsers2Groups');
		$this->setPackage('database');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 36, null);
		$this->addColumn('USER_ID', 'userId', 'VARCHAR', true, 36, null);
		$this->addColumn('GROUP_ID', 'groupId', 'VARCHAR', true, 36, null);
		$this->addColumn('COMMENT', 'Comment', 'BLOB', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // cTableUsers2GroupsTableMap
