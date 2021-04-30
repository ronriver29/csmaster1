<?php
class Migration_query_paquestion_table extends CI_Migration
{
    public function up()
    {
       $this->db->query("UPDATE `paquestion` SET `isScorable` = 1, `score` = 2 WHERE `num` = 131");
    }

    public function down()
    { 
       $this->db->query("UPDATE `paquestion` SET `isScorable` = 0, `score` = 5 WHERE `num` = 131");
    }
    
}
?>