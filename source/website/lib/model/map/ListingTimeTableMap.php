<?php


/**
 * This class defines the structure of the 'listing_time' table.
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
class ListingTimeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ListingTimeTableMap';

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
		$this->setName('listing_time');
		$this->setPhpName('ListingTime');
		$this->setClassname('ListingTime');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('LISTING_ID', 'ListingId', 'INTEGER', 'listing', 'ID', true, null, null);
		$this->addColumn('START_DATE', 'StartDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('END_DATE', 'EndDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('PAYMENT_STATUS', 'PaymentStatus', 'VARCHAR', true, 10, null);
		$this->addColumn('TOTAL_PAID', 'TotalPaid', 'FLOAT', false, null, 0);
		$this->addColumn('PAYER_ACCOUNT_NAME', 'PayerAccountName', 'VARCHAR', false, 100, null);
		$this->addColumn('PAYMENT_DATE', 'PaymentDate', 'TIMESTAMP', false, null, null);
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
    $this->addRelation('Listing', 'Listing', RelationMap::MANY_TO_ONE, array('listing_id' => 'id', ), null, null);
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

} // ListingTimeTableMap
