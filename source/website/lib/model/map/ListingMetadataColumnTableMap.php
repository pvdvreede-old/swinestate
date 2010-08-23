<?php


/**
 * This class defines the structure of the 'listing_metadata_column' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Aug 23 13:10:28 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ListingMetadataColumnTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ListingMetadataColumnTableMap';

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
		$this->setName('listing_metadata_column');
		$this->setPhpName('ListingMetadataColumn');
		$this->setClassname('ListingMetadataColumn');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('LISTING_TYPE_ID', 'ListingTypeId', 'INTEGER', 'listing_type', 'ID', true, null, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', true, 25, null);
		$this->addColumn('LABEL', 'Label', 'VARCHAR', true, 255, null);
		$this->addColumn('VALUE_TYPE', 'ValueType', 'VARCHAR', true, 255, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ListingType', 'ListingType', RelationMap::MANY_TO_ONE, array('listing_type_id' => 'id', ), null, null);
    $this->addRelation('ListingMetadataValue', 'ListingMetadataValue', RelationMap::ONE_TO_MANY, array('id' => 'metadata_column_id', ), null, null);
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

} // ListingMetadataColumnTableMap
