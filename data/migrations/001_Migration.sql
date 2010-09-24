
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- meal_order
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `meal_order`;


CREATE TABLE `meal_order`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`meal_id` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `meal_order_FI_1` (`meal_id`),
	CONSTRAINT `meal_order_FK_1`
		FOREIGN KEY (`meal_id`)
		REFERENCES `meal` (`id`)
		ON DELETE CASCADE,
	INDEX `meal_order_FI_2` (`item_id`),
	CONSTRAINT `meal_order_FK_2`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`)
		ON DELETE CASCADE,
	INDEX `meal_order_FI_3` (`sf_guard_user_id`),
	CONSTRAINT `meal_order_FK_3`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- meal
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `meal`;


CREATE TABLE `meal`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER,
	`type` VARCHAR(9)  NOT NULL,
	`voting_stopped` TINYINT default 0,
	`ordering_stopped` TINYINT default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `meal_FI_1` (`place_id`),
	CONSTRAINT `meal_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;


CREATE TABLE `item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER  NOT NULL,
	`name` VARCHAR(150)  NOT NULL,
	`description` TEXT,
	`price` FLOAT  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `item_FI_1` (`place_id`),
	CONSTRAINT `item_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- place
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place`;


CREATE TABLE `place`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150)  NOT NULL,
	`description` TEXT,
	`contact` VARCHAR(15),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- vote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `vote`;


CREATE TABLE `vote`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`meal_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `vote_FI_1` (`place_id`),
	CONSTRAINT `vote_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE,
	INDEX `vote_FI_2` (`sf_guard_user_id`),
	CONSTRAINT `vote_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `vote_FI_3` (`meal_id`),
	CONSTRAINT `vote_FK_3`
		FOREIGN KEY (`meal_id`)
		REFERENCES `meal` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(20),
	`last_name` VARCHAR(20),
	`birthday` DATE,
	PRIMARY KEY (`id`),
	INDEX `sf_guard_user_profile_FI_1` (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_guard_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group`;


CREATE TABLE `sf_guard_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_group_U_1` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_permission`;


CREATE TABLE `sf_guard_permission`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_permission_U_1` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_group_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group_permission`;


CREATE TABLE `sf_guard_group_permission`
(
	`group_id` INTEGER  NOT NULL,
	`permission_id` INTEGER  NOT NULL,
	PRIMARY KEY (`group_id`,`permission_id`),
	CONSTRAINT `sf_guard_group_permission_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_guard_group_permission_FI_2` (`permission_id`),
	CONSTRAINT `sf_guard_group_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user`;


CREATE TABLE `sf_guard_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(128)  NOT NULL,
	`algorithm` VARCHAR(128) default 'sha1' NOT NULL,
	`salt` VARCHAR(128)  NOT NULL,
	`password` VARCHAR(128)  NOT NULL,
	`created_at` DATETIME,
	`last_login` DATETIME,
	`is_active` TINYINT default 1 NOT NULL,
	`is_super_admin` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_user_U_1` (`username`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_permission`;


CREATE TABLE `sf_guard_user_permission`
(
	`user_id` INTEGER  NOT NULL,
	`permission_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`permission_id`),
	CONSTRAINT `sf_guard_user_permission_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_guard_user_permission_FI_2` (`permission_id`),
	CONSTRAINT `sf_guard_user_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_group`;


CREATE TABLE `sf_guard_user_group`
(
	`user_id` INTEGER  NOT NULL,
	`group_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`group_id`),
	CONSTRAINT `sf_guard_user_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_guard_user_group_FI_2` (`group_id`),
	CONSTRAINT `sf_guard_user_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_remember_key
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_remember_key`;


CREATE TABLE `sf_guard_remember_key`
(
	`user_id` INTEGER  NOT NULL,
	`remember_key` VARCHAR(32),
	`ip_address` VARCHAR(50)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`ip_address`),
	CONSTRAINT `sf_guard_remember_key_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
