
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
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`bedrooms` INTEGER default 0,
	`bathrooms` INTEGER default 0,
	`car_spaces` INTEGER default 0,
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
		REFERENCES `address` (`id`)
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
#-- listing_metadata_column
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_metadata_column`;


CREATE TABLE `listing_metadata_column`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`listing_type_id` INTEGER  NOT NULL,
	`code` VARCHAR(25)  NOT NULL,
	`label` VARCHAR(255)  NOT NULL,
	`value_type` VARCHAR(10)  NOT NULL,
	`required` TINYINT,
	`min_length` INTEGER,
	`max_length` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_metadata_column_FI_1` (`listing_type_id`),
	CONSTRAINT `listing_metadata_column_FK_1`
		FOREIGN KEY (`listing_type_id`)
		REFERENCES `listing_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- listing_metadata_value
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `listing_metadata_value`;


CREATE TABLE `listing_metadata_value`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`metadata_column_id` INTEGER  NOT NULL,
	`listing_id` INTEGER  NOT NULL,
	`value` VARCHAR(2000)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_metadata_value_FI_1` (`metadata_column_id`),
	CONSTRAINT `listing_metadata_value_FK_1`
		FOREIGN KEY (`metadata_column_id`)
		REFERENCES `listing_metadata_column` (`id`),
	INDEX `listing_metadata_value_FI_2` (`listing_id`),
	CONSTRAINT `listing_metadata_value_FK_2`
		FOREIGN KEY (`listing_id`)
		REFERENCES `listing` (`id`)
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
	`country` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
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
#-- user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_profile`;


CREATE TABLE `user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`email_address` VARCHAR(355),
	`phone_number` VARCHAR(20),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `user_profile_FI_1` (`user_id`),
	CONSTRAINT `user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
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
	`bedrooms` INTEGER,
	`bathrooms` INTEGER,
	`car_spaces` INTEGER,
	`suburb` VARCHAR(100),
	`postcode` INTEGER,
	`amount_alerted` INTEGER default 0,
	`active` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `alert_FI_1` (`user_id`),
	CONSTRAINT `alert_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
