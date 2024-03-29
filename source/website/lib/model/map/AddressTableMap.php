<?php


/**
 * This class defines the structure of the 'address' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 10/24/10 17:01:36
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AddressTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AddressTableMap';

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
		$this->setName('address');
		$this->setPhpName('Address');
		$this->setClassname('Address');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SUBURB_ID', 'SuburbId', 'INTEGER', 'suburb', 'ID', true, null, null);
		$this->addColumn('UNIT_NUMBER', 'UnitNumber', 'VARCHAR', false, 10, null);
		$this->addColumn('STREET_NUMBER', 'StreetNumber', 'VARCHAR', true, 10, null);
		$this->addColumn('STREET_NAME', 'StreetName', 'VARCHAR', true, 255, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Suburb', 'Suburb', RelationMap::MANY_TO_ONE, array('suburb_id' => 'id', ), null, null);
    $this->addRelation('Listing', 'Listing', RelationMap::ONE_TO_MANY, array('id' => 'address_id', ), null, null);
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

} // AddressTableMap
