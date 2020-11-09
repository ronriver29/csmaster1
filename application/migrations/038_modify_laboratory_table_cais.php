<?php
class Migration_modify_laboratory_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'lab_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('laboratory',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `laboratory` LIKE 'lab_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE laboratory DROP COLUMN lab_year"); 
        }

      
    }
}
?>