<?php
class Migration_modify_transportroute_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'route_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('transportroute',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `transportroute` LIKE 'route_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE transportroute DROP COLUMN route_year"); 
        }

      
    }
}
?>