<?php
class Migration_modify_agriproject_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'agri_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('agriproject',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `agriproject` LIKE 'agri_year  '");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE agriproject DROP COLUMN agri_year"); 
        }
    }
}
?>