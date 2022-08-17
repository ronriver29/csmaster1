<?php
class Migration_create_conversion_comment_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `conversion_comment` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `branches_id` int(11) DEFAULT '0',
          `comment` longtext COLLATE utf8mb4_unicode_ci,
          `user_id` int(11) DEFAULT '0',
          `user_level` int(11) DEFAULT '0',
          `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `branches_id` (`branches_id`),
          KEY `user_id` (`user_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;");
    }

    public function down()
    { 
       $this->db->query("DROP TABLE conversion_comment");
    }
}
?>

