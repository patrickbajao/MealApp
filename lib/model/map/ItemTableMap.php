<?php


/**
 * This class defines the structure of the 'item' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Sep 16 05:25:15 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ItemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ItemTableMap';

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
		$this->setName('item');
		$this->setPhpName('Item');
		$this->setClassname('Item');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('MENU_ID', 'MenuId', 'INTEGER', 'menu', 'ID', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 150, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PRICE', 'Price', 'FLOAT', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Menu', 'Menu', RelationMap::MANY_TO_ONE, array('menu_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('MealOrder', 'MealOrder', RelationMap::ONE_TO_MANY, array('id' => 'item_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // ItemTableMap
