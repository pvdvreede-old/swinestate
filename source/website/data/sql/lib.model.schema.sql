
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
	`listing_type_id` INTEGER  NOT NULL,
	`action_type_id` INTEGER  NOT NULL,
	`address_id` INTEGER  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`description` VARCHAR(2000)  NOT NULL,
	`bedrooms` INTEGER,
	`bathrooms` INTEGER,
	`garage` INTEGER,
	`asking_price` DECIMAL  NOT NULL,
	`actual_price` DECIMAL,
	`listing_status_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `listing_FI_1` (`listing_type_id`),
	CONSTRAINT `listing_FK_1`
		FOREIGN KEY (`listing_type_id`)
		REFERENCES `listing_type` (`id`),
	INDEX `listing_FI_2` (`action_type_id`),
	CONSTRAINT `listing_FK_2`
		FOREIGN KEY (`action_type_id`)
		REFERENCES `action_type` (`id`),
	INDEX `listing_FI_3` (`address_id`),
	CONSTRAINT `listing_FK_3`
		FOREIGN KEY (`address_id`)
		REFERENCES `address` (`id`),
	INDEX `listing_FI_4` (`listing_status_id`),
	CONSTRAINT `listing_FK_4`
		FOREIGN KEY (`listing_status_id`)
		REFERENCES `listing_status` (`id`)
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
#-- action_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `action_type`;


CREATE TABLE `action_type`
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
#-- address
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `address`;


CREATE TABLE `address`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`suburb_id` INTEGER  NOT NULL,
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
	`country` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_profile`;


CREATE TABLE `user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(20),
	`last_name` VARCHAR(20),
	`email` VARCHAR(355),
	PRIMARY KEY (`id`),
	INDEX `user_profile_FI_1` (`user_id`),
	CONSTRAINT `user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
