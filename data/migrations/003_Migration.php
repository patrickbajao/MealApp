<?php

/**
 * Migrations between versions 002 and 003.
 */
class Migration003 extends sfMigration
{
    /**
     * Migrate up to version 003.
     */
    public function up() {
        $this->executeSQL('ALTER TABLE meal_order ADD comments text, ADD quantity integer DEFAULT 1 AFTER sf_guard_user_id;');
    }

    /**
     * Migrate down to version 002.
     */
    public function down() {
        $this->executeSQL('ALTER TABLE meal_order DROP comments, DROP quantity;');
    }
}
