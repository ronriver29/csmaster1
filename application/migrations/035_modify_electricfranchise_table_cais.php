<?php
class Migration_modify_electricfranchise_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'elec_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('electricfranchise',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `electricfranchise` LIKE 'elec_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE electricfranchise DROP COLUMN elec_year"); 
        }

      
    }
}
?>