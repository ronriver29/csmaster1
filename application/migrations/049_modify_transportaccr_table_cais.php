<?php
class Migration_modify_transportaccr_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'transport_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('transportaccr',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `transportaccr` LIKE 'transport_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE transportaccr DROP COLUMN transport_year"); 
        }

      
    }
}
?>