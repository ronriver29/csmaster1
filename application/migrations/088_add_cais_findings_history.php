<?php
class Migration_add_cais_findings_history extends CI_Migration
{
    private $_table = "refprovince";
    
    public function up()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `ca_findings_history`(
            `id` INT(11) unsigned PRIMARY KEY AUTO_INCREMENT,
            `regNo` VARCHAR(100) NOT NULL,
            `report_year` INT(4) NOT NULL,
            `findings` TEXT NOT NULL,
            `remarks` TEXT DEFAULT NULL,
            `created_by_pos` VARCHAR(100) NOT NULL,
            `updated_by_pos` VARCHAR(100) DEFAULT NULL,
            `created_by` VARCHAR(100) DEFAULT NULL,
            `created_at` DATETIME DEFAULT NULL,
            `updated_by` VARCHAR(100) DEFAULT NULL,
            `updated_at` DATETIME DEFAULT NULL
            )"
        );
    }
    
    public function down()
    {
        $this->db->query("DROP TABLE `ca_findings_history`");
    }
}