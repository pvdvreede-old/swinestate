<?php


/**
 * This class defines the structure of the 'listing' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sat Oct  2 08:50:11 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ListingTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ListingTableMap';

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
		$this->setName('listing');
		$this->setPhpName('Listing');
		$this->setClassname('Listing');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('LISTING_TYPE_ID', 'ListingTypeId', 'INTEGER', 'listing_type', 'ID', true, null, null);
		$this->addForeignKey('PROPERTY_TYPE_ID', 'PropertyTypeId', 'INTEGER', 'property_type', 'ID', true, null, null);
		$this->addForeignKey('LISTING_STATUS_ID', 'ListingStatusId', 'INTEGER', 'listing_status', 'ID', true, null, null);
		$this->addForeignKey('ADDRESS_ID', 'AddressId', 'INTEGER', 'address', 'ID', true, null, null);
		$this->addForeignKey('SALE_DETAILS_ID', 'SaleDetailsId', 'INTEGER', 'sale_details', 'ID', false, null, null);
		$this->addForeignKey('RENT_DETAILS_ID', 'RentDetailsId', 'INTEGER', 'rent_details', 'ID', false, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
		$this->addColumn('BEDROOMS', 'Bedrooms', 'INTEGER', true, null, null);
		$this->addColumn('BATHROOMS', 'Bathrooms', 'INTEGER', true, null, null);
		$this->addColumn('CAR_SPACES', 'CarSpaces', 'INTEGER', true, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('ListingType', 'ListingType', RelationMap::MANY_TO_ONE, array('listing_type_id' => 'id', ), null, null);
    $this->addRelation('PropertyType', 'PropertyType', RelationMap::MANY_TO_ONE, array('property_type_id' => 'id', ), null, null);
    $this->addRelation('ListingStatus', 'ListingStatus', RelationMap::MANY_TO_ONE, array('listing_status_id' => 'id', ), null, null);
    $this->addRelation('Address', 'Address', RelationMap::MANY_TO_ONE, array('address_id' => 'id', ), null, null);
    $this->addRelation('SaleDetails', 'SaleDetails', RelationMap::MANY_TO_ONE, array('sale_details_id' => 'id', ), null, null);
    $this->addRelation('RentDetails', 'RentDetails', RelationMap::MANY_TO_ONE, array('rent_details_id' => 'id', ), null, null);
    $this->addRelation('ListingTime', 'ListingTime', RelationMap::ONE_TO_MANY, array('id' => 'listing_id', ), null, null);
    $this->addRelation('ListingPhotos', 'ListingPhotos', RelationMap::ONE_TO_MANY, array('id' => 'listing_id', ), null, null);
    $this->addRelation('ListingVideos', 'ListingVideos', RelationMap::ONE_TO_MANY, array('id' => 'listing_id', ), null, null);
    $this->addRelation('Interest', 'Interest', RelationMap::ONE_TO_MANY, array('id' => 'listing_id', ), null, null);
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

} // ListingTableMap
