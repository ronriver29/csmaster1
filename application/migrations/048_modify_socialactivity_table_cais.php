<?php
class Migration_modify_socialactivity_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'socialactivity_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('socialactivity',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `socialactivity` LIKE 'socialactivity_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE socialactivity DROP COLUMN socialactivity_year"); 
        }

      
    }
}
?>