<?php
class Migration_modify_user_composition_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'composition_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    ),
                     'major_composition' =>array(
                     'type' => "VARCHAR",
                     'constraint' =>50,
                     'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('user_composition',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `user_composition` LIKE 'composition_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE user_composition DROP COLUMN composition_year"); 
        }

        $result1 = $this->db->query("SHOW COLUMNS FROM `user_composition` LIKE 'major_composition'");
        // $exists = ($result)?TRUE:FALSE;
        if($result1->num_rows()>0)
        {
           $qry1 = $this->db->query("ALTER TABLE user_composition DROP COLUMN major_composition"); 
        }

      
    }
}
?>