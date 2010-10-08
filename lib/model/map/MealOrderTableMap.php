<?php


/**
 * This class defines the structure of the 'meal_order' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Oct  8 18:09:39 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MealOrderTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MealOrderTableMap';

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
		$this->setName('meal_order');
		$this->setPhpName('MealOrder');
		$this->setClassname('MealOrder');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('MEAL_ID', 'MealId', 'INTEGER', 'meal', 'ID', true, null, null);
		$this->addForeignKey('ITEM_ID', 'ItemId', 'INTEGER', 'item', 'ID', true, null, null);
		$this->addForeignKey('SF_GUARD_USER_ID', 'SfGuardUserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addColumn('COMMENTS', 'Comments', 'LONGVARCHAR', false, null, null);
		$this->addColumn('QUANTITY', 'Quantity', 'INTEGER', false, null, 1);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Meal', 'Meal', RelationMap::MANY_TO_ONE, array('meal_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('Item', 'Item', RelationMap::MANY_TO_ONE, array('item_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('sf_guard_user_id' => 'id', ), 'CASCADE', null);
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // MealOrderTableMap
