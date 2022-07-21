<?php
class Migration_create_tempbranch_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `stored_branch` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `branch_id` int(11) NOT NULL,
          `branchName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `certNo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `coopName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `regNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `area_of_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `common_bond` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `house_blk_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `addrCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `regCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
          `transferred_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `transferred_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `transferred_houseblk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `user_id` int(11) NOT NULL,
          `status` int(11) NOT NULL,
          `evaluator1` int(11) DEFAULT NULL,
          `evaluator2` int(11) DEFAULT NULL,
          `evaluator3` int(11) DEFAULT NULL,
          `evaluator4` int(11) DEFAULT NULL,
          `evaluator5` int(11) DEFAULT NULL,
          `evaluator_for_closure_1` int(11) DEFAULT NULL,
          `evaluator_for_closure_2` int(11) DEFAULT NULL,
          `evaluator_for_transfer_1` int(11) DEFAULT NULL,
          `evaluator_for_transfer_2` int(11) DEFAULT NULL,
          `evaluator_for_transfer_3` int(11) DEFAULT NULL,
          `tool_yn_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
          `tool_remark` mediumtext COLLATE utf8mb4_unicode_ci,
          `tool_findings` mediumtext COLLATE utf8mb4_unicode_ci,
          `tool_comment` mediumtext COLLATE utf8mb4_unicode_ci,
          `evaluation_comment` mediumtext COLLATE utf8mb4_unicode_ci,
          `temp_evaluation_comment` mediumtext COLLATE utf8mb4_unicode_ci,
          `comment_by_specialist` mediumtext COLLATE utf8mb4_unicode_ci,
          `comment_by_senior` mediumtext COLLATE utf8mb4_unicode_ci,
          `evaluated_by` mediumtext COLLATE utf8mb4_unicode_ci,
          `comment_by_senior_level1` mediumtext COLLATE utf8mb4_unicode_ci,
          `comment_by_director_level1` mediumtext COLLATE utf8mb4_unicode_ci,
          `dateApplied` datetime NOT NULL,
          `date_approved_cds` datetime NOT NULL,
          `date_approved_senior` datetime NOT NULL,
          `date_approved_director` datetime NOT NULL,
          `lastUpdated` datetime NOT NULL,
          `dateRegistered` date DEFAULT NULL,
          `date_of_or` date DEFAULT NULL,
          `lapse_time` datetime DEFAULT NULL,
          `sent_lapse_notif` tinyint(4) DEFAULT '0',
          `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
          `date_for_payment` date DEFAULT NULL,
          `date_closure` date DEFAULT NULL,
          `date_transferred` date DEFAULT NULL,
          `date_convert` date DEFAULT NULL,
          `ok_for_closure` date DEFAULT NULL,
          `ok_for_transfer` date DEFAULT NULL,
          `ok_for_conversion` date DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `certNo` (`certNo`),
          KEY `regNo` (`regNo`),
          KEY `addrCode` (`addrCode`),
          KEY `regCode` (`regCode`),
          KEY `user_id` (`user_id`),
          KEY `evaluator1` (`evaluator1`),
          KEY `evaluator2` (`evaluator2`),
          KEY `evaluator3` (`evaluator3`),
          KEY `evaluator4` (`evaluator4`),
          KEY `evaluator5` (`evaluator5`)
      )");
    }

    public function down()
    { 
       $this->db->query("DROP TABLE stored_branch");
    }
}
?>