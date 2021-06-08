<?php
class Migration_add_report_date_deferred_and_approved extends CI_Migration
{
    
    public function up()
    {
        $this->db->query("ALTER TABLE `main`.`report` ADD COLUMN `dateDeferred` DATETIME DEFAULT NULL AFTER `dateofSubmission`;");
        $this->db->query("ALTER TABLE `main`.`report` ADD COLUMN `dateApproved` DATETIME DEFAULT NULL AFTER `dateDeferred`;");
        $this->db->query("ALTER TABLE `main`.`report` MODIFY COLUMN `dateSubmitted` DATETIME DEFAULT NULL;");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `main`.`report` DROP COLUMN `dateDeferred`;");
        $this->db->query("ALTER TABLE `main`.`report` DROP COLUMN `dateApproved`;");
        $this->db->query("ALTER TABLE `main`.`report` MODIFY COLUMN `dateSubmitted` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;");
    }
}