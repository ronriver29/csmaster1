<?php
class Migration_modify_unioncoop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'representative'=>array(
                      'type'=>'VARCHAR',
                      'constraint' => 255,
                      // 'null' => TRUE
                    ),
                  )
        );
        $this->dbforge->add_column('unioncoop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `unioncoop` LIKE 'representative'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE unioncoop DROP COLUMN representative"); 
        }
    }
}
?>