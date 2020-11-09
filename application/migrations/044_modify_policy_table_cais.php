<?php
class Migration_modify_policy_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'policy_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('policy',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `policy` LIKE 'policy_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE policy DROP COLUMN policy_year"); 
        }

      
    }
}
?>