<?php
class Migration_alter_temp_registeredcoop_addkey extends CI_Migration
{
    public function up()
    {
     
      $this->db->query("ALTER TABLE `temp_registeredcoop` ADD temp_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY after id");
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `temp_registeredcoop` LIKE 'temp_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
            $this->dbforge->drop_column('temp_registeredcoop', 'temp_id');
        }

    }
}
?>