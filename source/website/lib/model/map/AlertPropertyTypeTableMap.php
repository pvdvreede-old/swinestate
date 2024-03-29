<?php


/**
 * This class defines the structure of the 'alert_property_type' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 10/24/10 17:01:38
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AlertPropertyTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AlertPropertyTypeTableMap';

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
		$this->setName('alert_property_type');
		$this->setPhpName('AlertPropertyType');
		$this->setClassname('AlertPropertyType');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ALERT_ID', 'AlertId', 'INTEGER', 'alert', 'ID', true, null, null);
		$this->addForeignKey('PROPERTY_TYPE_ID', 'PropertyTypeId', 'INTEGER', 'property_type', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Alert', 'Alert', RelationMap::MANY_TO_ONE, array('alert_id' => 'id', ), null, null);
    $this->addRelation('PropertyType', 'PropertyType', RelationMap::MANY_TO_ONE, array('property_type_id' => 'id', ), null, null);
    $this->addRelation('Alert', 'Alert', RelationMap::ONE_TO_MANY, array('id' => 'alert_property_type_id', ), null, null);
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

} // AlertPropertyTypeTableMap
