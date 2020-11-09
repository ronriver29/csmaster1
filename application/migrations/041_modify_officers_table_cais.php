<?php
class Migration_modify_officers_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'officers_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('officers',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `officers` LIKE 'officers_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE officers DROP COLUMN officers_year"); 
        }

      
    }
}
?>