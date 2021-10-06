<?php
class Migration_modify_users_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'addrCode'=>array(
                      'type'=>'VARCHAR',
                      'constraint' => 255,
                      // 'null' => TRUE
                    ),
                  )
        );
        $this->dbforge->add_column('users',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `users` LIKE 'addrCode'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE users DROP COLUMN addrCode"); 
        }
    }
}
?>