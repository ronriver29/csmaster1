<?php
class Migration_modify_ca_user_service_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'service_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('ca_user_service',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `ca_user_service` LIKE 'service_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE ca_user_service DROP COLUMN service_year"); 
        }
    }
}
?>