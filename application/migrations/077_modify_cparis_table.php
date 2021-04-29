<?php
class Migration_modify_cparis_table extends CI_Migration
{
    public function up()
    {
      $this->db->query("ALTER TABLE `cparis` 
      ADD COLUMN `answers` TEXT DEFAULT NULL AFTER `ynAnswer`,
      ADD COLUMN `scores` TEXT DEFAULT NULL AFTER `score`;");
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'answers'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE paquestion DROP COLUMN answers"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'scores'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE paquestion DROP COLUMN scores"); 
        }
    }
}
?>