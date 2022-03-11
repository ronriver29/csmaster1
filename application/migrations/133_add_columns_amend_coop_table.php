<?php
class Migration_add_columns_amend_coop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'in_change_region'=>array(
                      'type'=>'INT',
                      'constraint'=>5,
                       'after' => 'status',
                       'default' => 0
                    ),
                     'previous_region'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                       'after' => 'in_change_region',
                       'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('amend_coop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'in_change_region'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amend_coop DROP COLUMN in_change_region"); 
        }

         $result1 = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'previous_region'");
        // $exists = ($result)?TRUE:FALSE;
        if($result1->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amend_coop DROP COLUMN previous_region"); 
        }

       
    }
}
?>