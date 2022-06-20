<?php
class Migration_modify_amend_coop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'capital_contribution'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'after' => 'type',
                      'default' => 0,
                      
                    )
                  )
        );
        $this->dbforge->add_column('amend_coop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'capital_contribution'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amend_coop DROP COLUMN capital_contribution"); 
        }

      
    }
}
?>