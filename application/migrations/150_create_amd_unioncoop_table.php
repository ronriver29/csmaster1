<?php
class Migration_create_amd_unioncoop_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `amendment_unioncoop` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `amd_union_id` INT(11) NOT NULL,
        `amendment_id` INT(11) NULL DEFAULT NULL,
        `reg_amendment_id` INT(11) NULL DEFAULT NULL,
        `cooperative_id` INT(11) NULL DEFAULT NULL,
        `registeredcoop_id` INT(11) NULL DEFAULT NULL,
        `types` VARCHAR(50) NOT NULL ,
        `regNo` VARCHAR(50) NOT NULL ,
        `coopName` VARCHAR(150) NOT NULL ,
        `user_id` INT(11) NOT NULL,
        `representative` VARCHAR(255) NULL DEFAULT NULL ,
        `capital_contribution` INT(255) NULL DEFAULT NULL,
        `position` VARCHAR(50) NULL DEFAULT NULL ,
        `proof_of_identity` VARCHAR(50) NULL DEFAULT NULL ,
        `valid_id` VARCHAR(50) NULL DEFAULT NULL,
        `date_issued` DATETIME NULL DEFAULT NULL,
        `place_of_issuance` LONGTEXT NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE
      )");
    }

    public function down()
    { 
       $this->db->query("DROP TABLE amendment_unioncoop");
    }
}
?>