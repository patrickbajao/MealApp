<?php

/**
 * Migrations between versions 004 and 005.
 */
class Migration005 extends sfMigration
{
    /**
     * Migrate up to version 005.
     */
    public function up() {
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=0');
        $this->executeSQL('CREATE TABLE `meal_place` (`id` INTEGER  NOT NULL AUTO_INCREMENT,`meal_id` INTEGER  NOT NULL,`place_id` INTEGER NOT NULL, PRIMARY KEY (`id`), INDEX `meal_place_FI_1` (`meal_id`), CONSTRAINT `meal_place_FK_1` FOREIGN KEY (`meal_id`)  REFERENCES `meal` (`id`) ON DELETE CASCADE, INDEX `meal_place_FI_2` (`place_id`), CONSTRAINT `meal_place_FK_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE)Type=InnoDB;');
        $this->executeSQL('ALTER TABLE vote DROP meal_id, DROP place_id, DROP INDEX `vote_FI_1`, DROP INDEX `vote_FI_3`, DROP FOREIGN KEY `vote_FK_1`, DROP FOREIGN KEY `vote_FK_3`;');
        $this->executeSQL('ALTER TABLE vote ADD meal_place_id INTEGER  NOT NULL AFTER id, ADD INDEX `vote_FI_1` (`meal_place_id`), ADD CONSTRAINT `vote_FK_1` FOREIGN KEY (`meal_place_id`)  REFERENCES `meal_place` (`id`) ON DELETE CASCADE;');
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Migrate down to version 004.
     */
    public function down() {
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=0');
        $this->executeSQL('ALTER TABLE vote DROP meal_place_id, DROP INDEX `vote_FI_1`, DROP FOREIGN KEY `vote_FK_1`;');
        $this->executeSQL('ALTER TABLE vote ADD place_id INTEGER  NOT NULL AFTER id, ADD meal_id INTEGER  NOT NULL, ADD INDEX `vote_FI_1` (`place_id`), ADD INDEX `vote_FI_3` (`meal_id`), ADD CONSTRAINT `vote_FK_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE, ADD CONSTRAINT `vote_FK_3` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE CASCADE;');
        $this->executeSQL('DROP TABLE `meal_place`;');
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=1');
    }
}
