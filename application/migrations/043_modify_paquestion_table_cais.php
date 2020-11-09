<?php
class Migration_modify_paquestion_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'applicable'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('paquestion',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'applicable'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE paquestion DROP COLUMN applicable"); 
        }

      
    }
}
?>