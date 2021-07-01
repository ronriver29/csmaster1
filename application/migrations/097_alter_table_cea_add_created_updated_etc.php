<?php
class Migration_alter_table_cea_add_created_updated_etc extends CI_Migration
{
    
    public function up()
    {

        $this->db->query("ALTER TABLE `cea` ADD COLUMN `created_by` VARCHAR(50) DEFAULT NULL AFTER `dateValid`");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `created_at` DATETIME DEFAULT NULL AFTER `created_by`");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `updated_by` VARCHAR(50) DEFAULT NULL AFTER `created_at`");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `updated_at` DATETIME DEFAULT NULL AFTER `updated_by`");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `deleted_by` VARCHAR(50) DEFAULT NULL AFTER `updated_at`");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `deleted_at` DATETIME DEFAULT NULL AFTER `deleted_by`;");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `cea` DROP COLUMN `created_by`;
            ALTER TABLE `cea` DROP COLUMN `created_at`;
            ALTER TABLE `cea` DROP COLUMN `updated_by`;
            ALTER TABLE `cea` DROP COLUMN `updated_at`;
            ALTER TABLE `cea` DROP COLUMN `deleted_by`;
            ALTER TABLE `cea` DROP COLUMN `deleted_at`;");
    }
}