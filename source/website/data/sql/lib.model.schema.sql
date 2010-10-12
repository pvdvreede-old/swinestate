
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- listing
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing`;


CREATE TABLE `listing`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`listing_type_id` INTEGER  NOT NULL,
	`property_type_id` INTEGER  NOT NULL,
	`listing_status_id` INTEGER  NOT NULL,
	`address_id` INTEGER  NOT NULL,
	`sale_details_id` INTEGER,
	`rent_details_id` INTEGER,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`bedrooms` INTEGER  NOT NULL,
	`bathrooms` INTEGER  NOT NULL,
	`car_spaces` INTEGER  NOT NULL,
	`alert_activated` TINYINT default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_FI_1` (`user_id`),
	CONSTRAINT `listing_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `listing_FI_2` (`listing_type_id`),
	CONSTRAINT `listing_FK_2`
		FOREIGN KEY (`listing_type_id`)
		REFERENCES `listing_type` (`id`),
	INDEX `listing_FI_3` (`property_type_id`),
	CONSTRAINT `listing_FK_3`
		FOREIGN KEY (`property_type_id`)
		REFERENCES `property_type` (`id`),
	INDEX `listing_FI_4` (`listing_status_id`),
	CONSTRAINT `listing_FK_4`
		FOREIGN KEY (`listing_status_id`)
		REFERENCES `listing_status` (`id`),
	INDEX `listing_FI_5` (`address_id`),
	CONSTRAINT `listing_FK_5`
		FOREIGN KEY (`address_id`)
		REFERENCES `address` (`id`),
	INDEX `listing_FI_6` (`sale_details_id`),
	CONSTRAINT `listing_FK_6`
		FOREIGN KEY (`sale_details_id`)
		REFERENCES `sale_details` (`id`),
	INDEX `listing_FI_7` (`rent_details_id`),
	CONSTRAINT `listing_FK_7`
		FOREIGN KEY (`rent_details_id`)
		REFERENCES `rent_details` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_type`;


CREATE TABLE `listing_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- property_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `property_type`;


CREATE TABLE `property_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_status`;


CREATE TABLE `listing_status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- country
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;


CREATE TABLE `country`
(
	`iso` VARCHAR(2),
	`name` VARCHAR(80),
	`display_name` VARCHAR(80),
	`iso3` VARCHAR(3),
	`numcode` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `I_referenced_suburb_FK_1_1` (`iso`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- address
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `address`;


CREATE TABLE `address`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`suburb_id` INTEGER  NOT NULL,
	`unit_number` VARCHAR(10),
	`street_number` VARCHAR(10)  NOT NULL,
	`street_name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `address_FI_1` (`suburb_id`),
	CONSTRAINT `address_FK_1`
		FOREIGN KEY (`suburb_id`)
		REFERENCES `suburb` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- suburb
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `suburb`;


CREATE TABLE `suburb`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100)  NOT NULL,
	`postcode` INTEGER  NOT NULL,
	`state` VARCHAR(3)  NOT NULL,
	`country_id` VARCHAR(2)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `suburb_FI_1` (`country_id`),
	CONSTRAINT `suburb_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `country` (`iso`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_time
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_time`;


CREATE TABLE `listing_time`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`listing_id` INTEGER  NOT NULL,
	`start_date` DATETIME,
	`end_date` DATETIME,
	`payment_status` VARCHAR(10)  NOT NULL,
	`total_paid` FLOAT default 0,
	`payer_account_name` VARCHAR(100),
	`payment_date` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_time_FI_1` (`user_id`),
	CONSTRAINT `listing_time_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `listing_time_FI_2` (`listing_id`),
	CONSTRAINT `listing_time_FK_2`
		FOREIGN KEY (`listing_id`)
		REFERENCES `listing` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_photos
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_photos`;


CREATE TABLE `listing_photos`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`listing_id` INTEGER  NOT NULL,
	`path` VARCHAR(1000)  NOT NULL,
	`caption` VARCHAR(500),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_photos_FI_1` (`listing_id`),
	CONSTRAINT `listing_photos_FK_1`
		FOREIGN KEY (`listing_id`)
		REFERENCES `listing` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_videos
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_videos`;


CREATE TABLE `listing_videos`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`listing_id` INTEGER  NOT NULL,
	`url` VARCHAR(1000)  NOT NULL,
	`caption` VARCHAR(500),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_videos_FI_1` (`listing_id`),
	CONSTRAINT `listing_videos_FK_1`
		FOREIGN KEY (`listing_id`)
		REFERENCES `listing` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_profile`;


CREATE TABLE `user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`email_address` VARCHAR(255)  NOT NULL,
	`phone_number` VARCHAR(20),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_profile_U_1` (`email_address`),
	INDEX `user_profile_FI_1` (`user_id`),
	CONSTRAINT `user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sale_details
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sale_details`;


CREATE TABLE `sale_details`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`asking_price` FLOAT  NOT NULL,
	`actual_price` FLOAT,
	`auction_date` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rent_details
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rent_details`;


CREATE TABLE `rent_details`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`lease_period_until` DATETIME,
	`amount_month_price` FLOAT  NOT NULL,
	`renting_date` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- alert
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `alert`;


CREATE TABLE `alert`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`listing_type_id` INTEGER  NOT NULL,
	`bedrooms` INTEGER,
	`bathrooms` INTEGER,
	`car_spaces` INTEGER,
	`suburb` VARCHAR(100),
	`postcode` INTEGER,
	`min_price` FLOAT,
	`max_price` FLOAT,
	`alert_property_type_id` INTEGER,
	`amount_alerted` INTEGER default 0,
	`active` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `alert_FI_1` (`user_id`),
	CONSTRAINT `alert_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `alert_FI_2` (`listing_type_id`),
	CONSTRAINT `alert_FK_2`
		FOREIGN KEY (`listing_type_id`)
		REFERENCES `listing_type` (`id`),
	INDEX `alert_FI_3` (`alert_property_type_id`),
	CONSTRAINT `alert_FK_3`
		FOREIGN KEY (`alert_property_type_id`)
		REFERENCES `alert_property_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- alert_property_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `alert_property_type`;


CREATE TABLE `alert_property_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`alert_id` INTEGER  NOT NULL,
	`property_type_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `alert_property_type_FI_1` (`alert_id`),
	CONSTRAINT `alert_property_type_FK_1`
		FOREIGN KEY (`alert_id`)
		REFERENCES `alert` (`id`),
	INDEX `alert_property_type_FI_2` (`property_type_id`),
	CONSTRAINT `alert_property_type_FK_2`
		FOREIGN KEY (`property_type_id`)
		REFERENCES `property_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- interest
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `interest`;


CREATE TABLE `interest`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`listing_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`interest_status` VARCHAR(10) default 'Pending',
	`new_marker` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `interest_FI_1` (`listing_id`),
	CONSTRAINT `interest_FK_1`
		FOREIGN KEY (`listing_id`)
		REFERENCES `listing` (`id`),
	INDEX `interest_FI_2` (`user_id`),
	CONSTRAINT `interest_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- settings
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;


CREATE TABLE `settings`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(50),
	`name` VARCHAR(50),
	`value` VARCHAR(1000),
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
