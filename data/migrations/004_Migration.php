<?php

/**
 * Migrations between versions 003 and 004.
 */
class Migration004 extends sfMigration
{
    /**
     * Migrate up to version 004.
     */
    public function up() {
        $this->executeSQL('ALTER TABLE item ADD image VARCHAR(255) AFTER price;');
        $this->executeSQL('ALTER TABLE place ADD image VARCHAR(255) AFTER contact;');
    }

    /**
     * Migrate down to version 003.
     */
    public function down() {
        $this->executeSQL('ALTER TABLE item DROP image;');
        $this->executeSQL('ALTER TABLE place DROP image;');
    }
}
