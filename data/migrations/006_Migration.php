<?php

/**
 * Migrations between versions 005 and 006.
 */
class Migration006 extends sfMigration
{
    /**
     * Migrate up to version 006.
     */
    public function up() {
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=0');
        $this->executeSQL('CREATE TABLE `suggestion` (`id` INTEGER  NOT NULL AUTO_INCREMENT, `place_id` INTEGER, `type` VARCHAR(5)  NOT NULL, `name` VARCHAR(150)  NOT NULL, `description` TEXT, `contact` VARCHAR(15), `price` FLOAT, PRIMARY KEY (`id`), INDEX `suggestion_FI_1` (`place_id`), CONSTRAINT `suggestion_FK_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE)Type=InnoDB;');
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Migrate down to version 005.
     */
    public function down() {
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=0');
        $this->executeSQL('DROP TABLE `suggestion`;');
        $this->executeSQL('SET FOREIGN_KEY_CHECKS=1');
    }
}
