<?php
class Migration_capris_add_branch_sattelite_info extends CI_Migration
{
    
    public function up()
    {
        $this->db->query("ALTER TABLE `main`.`capris` ADD COLUMN `numberOfBranches` INT(5) DEFAULT NULL AFTER `fAmount`;");
        $this->db->query("ALTER TABLE `main`.`capris` ADD COLUMN `numberOfSatellites` INT(5) DEFAULT NULL AFTER `numberOfBranches`;");
        $this->db->query("ALTER TABLE `main`.`capris` ADD COLUMN `branches` TEXT DEFAULT NULL AFTER `numberOfSatellites`;");
        $this->db->query("ALTER TABLE `main`.`capris` ADD COLUMN `satellites` TEXT DEFAULT NULL AFTER `branches`;");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `main`.`capris` DROP COLUMN `numberOfBranches`;");
        $this->db->query("ALTER TABLE `main`.`capris` DROP COLUMN `numberOfSatellites`;");
        $this->db->query("ALTER TABLE `main`.`capris` DROP COLUMN `branches`;");
        $this->db->query("ALTER TABLE `main`.`capris` DROP COLUMN `satellites`;");
    }
}