
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
		REFERENCES `meal` (`id`),
	INDEX `meal_order_FI_2` (`item_id`),
	CONSTRAINT `meal_order_FK_2`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`),
	INDEX `meal_order_FI_3` (`sf_guard_user_id`),
	CONSTRAINT `meal_order_FK_3`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
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
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `meal_FI_1` (`place_id`),
	CONSTRAINT `meal_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;


CREATE TABLE `item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`menu_id` INTEGER  NOT NULL,
	`name` VARCHAR(150)  NOT NULL,
	`description` TEXT,
	`price` FLOAT  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `item_FI_1` (`menu_id`),
	CONSTRAINT `item_FK_1`
		FOREIGN KEY (`menu_id`)
		REFERENCES `menu` (`id`)
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
#-- menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;


CREATE TABLE `menu`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `menu_FI_1` (`place_id`),
	CONSTRAINT `menu_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
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
		REFERENCES `place` (`id`),
	INDEX `vote_FI_2` (`sf_guard_user_id`),
	CONSTRAINT `vote_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `vote_FI_3` (`meal_id`),
	CONSTRAINT `vote_FK_3`
		FOREIGN KEY (`meal_id`)
		REFERENCES `meal` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
