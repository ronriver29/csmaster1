<?php
class Migration_modify_laborclient_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'labor_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('laborclient',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `laborclient` LIKE 'labor_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE laborclient DROP COLUMN labor_year"); 
        }

      
    }
}
?>