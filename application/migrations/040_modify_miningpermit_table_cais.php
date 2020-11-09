<?php
class Migration_modify_miningpermit_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'mining_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('miningpermit',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `miningpermit` LIKE 'mining_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE miningpermit DROP COLUMN mining_year"); 
        }

      
    }
}
?>