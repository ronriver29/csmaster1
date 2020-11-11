<?php
class Migration_modify_composition_of_members_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'major_id'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('composition_of_members',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `composition_of_members` LIKE 'major_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE composition_of_members DROP COLUMN major_id"); 
        }

     
      
    }
}
?>