<?php


/**
 * This class defines the structure of the 'meal' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct  7 04:37:02 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MealTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MealTableMap';

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
		$this->setName('meal');
		$this->setPhpName('Meal');
		$this->setClassname('Meal');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PLACE_ID', 'PlaceId', 'INTEGER', 'place', 'ID', false, null, null);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', true, 9, null);
		$this->addColumn('VOTING_STOPPED', 'VotingStopped', 'BOOLEAN', false, null, false);
		$this->addColumn('ORDERING_STOPPED', 'OrderingStopped', 'BOOLEAN', false, null, false);
		$this->addColumn('SCHEDULED_AT', 'ScheduledAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Place', 'Place', RelationMap::MANY_TO_ONE, array('place_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('MealOrder', 'MealOrder', RelationMap::ONE_TO_MANY, array('id' => 'meal_id', ), 'CASCADE', null);
    $this->addRelation('MealPlace', 'MealPlace', RelationMap::ONE_TO_MANY, array('id' => 'meal_id', ), 'CASCADE', null);
    $this->addRelation('Vote', 'Vote', RelationMap::ONE_TO_MANY, array('id' => 'meal_id', ), 'CASCADE', null);
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

} // MealTableMap
