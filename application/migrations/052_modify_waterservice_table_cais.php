<?php
class Migration_modify_waterservice_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'water_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('waterservice',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `waterservice` LIKE 'water_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE waterservice DROP COLUMN water_year"); 
        }

     
      
    }
}
?>