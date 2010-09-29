<?php


/**
 * This class defines the structure of the 'country' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Sep 29 12:56:48 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class CountryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CountryTableMap';

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
		$this->setName('country');
		$this->setPhpName('Country');
		$this->setClassname('Country');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('ISO', 'Iso', 'VARCHAR', false, 2, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 80, null);
		$this->addColumn('DISPLAY_NAME', 'DisplayName', 'VARCHAR', false, 80, null);
		$this->addColumn('ISO3', 'Iso3', 'VARCHAR', false, 3, null);
		$this->addColumn('NUMCODE', 'Numcode', 'INTEGER', false, null, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Suburb', 'Suburb', RelationMap::ONE_TO_MANY, array('iso' => 'country_id', ), null, null);
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

} // CountryTableMap
