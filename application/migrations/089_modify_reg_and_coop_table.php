<?php
class Migration_modify_reg_and_coop_table extends CI_Migration
{
    public function up()
    {
       
     
        $this->db->query("CREATE INDEX proposed_name_coop ON cooperatives (proposed_name)");
        $this->db->query("CREATE INDEX regNo ON registeredcoop (regNo)");
              
    }

    public function down()
    { 
       
          $this->db->query("DROP INDEX regNo ON registeredcoop");  
           $this->db->query("DROP INDEX proposed_name_coop ON cooperatives");
       
    }
}
?>