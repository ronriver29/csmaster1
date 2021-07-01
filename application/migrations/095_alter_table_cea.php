<?php
class Migration_alter_table_cea extends CI_Migration
{
    
    public function up()
    {
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `id` INT(11) PRIMARY KEY AUTO_INCREMENT FIRST");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `ceaNo` VARCHAR(50) AFTER `no`;");
        $this->db->query("ALTER TABLE `cea` DROP COLUMN `no`;");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `cea` DROP COLUMN `id`;");
        $this->db->query("ALTER TABLE `cea` DROP COLUMN `ceaNo`;");
        $this->db->query("ALTER TABLE `cea` ADD COLUMN `no` INT(11) FIRST");
    }
}