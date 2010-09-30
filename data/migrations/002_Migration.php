<?php

/**
 * Migrations between versions 001 and 002.
 */
class Migration002 extends sfMigration
{
    /**
     * Migrate up to version 002.
     */
    public function up() {
        $this->executeSQL('ALTER TABLE meal ADD scheduled_at datetime DEFAULT \'' . date('Y-m-d'). '\' NOT NULL AFTER ordering_stopped;');
    }

    /**
     * Migrate down to version 001.
     */
    public function down() {
        $this->executeSQL('ALTER TABLE meal DROP scheduled_at;');
    }
}
