<?php
class Migration_modify_housingproject_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'house_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('housingproject',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `housingproject` LIKE 'house_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE housingproject DROP COLUMN house_year"); 
        }

      
    }
}
?>