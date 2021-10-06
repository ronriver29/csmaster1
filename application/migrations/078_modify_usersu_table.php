<?php
class Migration_modify_usersu_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'chairperson'=>array(
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
        $result = $this->db->query("SHOW COLUMNS FROM `users` LIKE 'chairperson'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE users DROP COLUMN chairperson"); 
        }
    }
}
?>