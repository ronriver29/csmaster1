<?php
class Migration_modify_workerclient_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'worker_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('workerclient',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `workerclient` LIKE 'worker_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE workerclient DROP COLUMN worker_year"); 
        }

     
      
    }
}
?>