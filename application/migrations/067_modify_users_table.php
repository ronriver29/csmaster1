<?php
class Migration_modify_users_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'regno'=>array(
                      'type'=>'LONGTEXT',
                      // 'null' => TRUE
                    ),
                     'files'=>array(
                      'type'=>'LONGTEXT',
                      // 'null' => TRUE
                    ),
                      'is_taken'=>array(
                      'type'=>'TINYINT',
                      'constraint' => 4,
                      // 'null' => TRUE
                    ),
                  )
        );
        $this->dbforge->add_column('users',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `users` LIKE 'regno'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE users DROP COLUMN regno"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `users` LIKE 'files'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $this->db->query("ALTER TABLE users DROP COLUMN files"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `users` LIKE 'is_taken'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
            $this->db->query("ALTER TABLE users DROP COLUMN is_taken"); 
        }
    }
}
?>