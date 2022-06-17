<?php
class Migration_add_column_branches extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                    (
                     'evaluator_for_closure_1'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'evaluator5',
                      'null' => TRUE
                    ),
                     'evaluator_for_closure_2'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'evaluator_for_closure_1',
                      'null' => TRUE
                    ),
                     'evaluator_for_transfer_1'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'evaluator_for_closure_2',
                      'null' => TRUE
                    ),
                     'evaluator_for_transfer_2'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'evaluator_for_transfer_1',
                      'null' => TRUE
                    ),
                     'evaluator_for_transfer_3'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'evaluator_for_transfer_2',
                      'null' => TRUE
                    ),
                     'transferred_region'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>255,
                      'after' => 'regCode',
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('branches',$field);
    }

    public function down()
    { 
        $result2 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_closure_1'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_closure_1"); 
        }

        $result = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_closure_2'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_closure_2"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'transferred_region'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN transferred_region"); 
        }

        $result4 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_transfer_1'");
        // $exists = ($result)?TRUE:FALSE;
        if($result4->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_transfer_1"); 
        }

        $result5 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_transfer_2'");
        // $exists = ($result)?TRUE:FALSE;
        if($result5->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_transfer_2"); 
        }

        $result6 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_transfer_3'");
        // $exists = ($result)?TRUE:FALSE;
        if($result6->num_rows()>0)
        {
         $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_transfer_3"); 
        }

      
    }
}
?>