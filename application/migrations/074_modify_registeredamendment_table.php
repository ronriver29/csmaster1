<?php
class Migration_modify_registeredamendment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'amendment_id'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'id'
                      // 'null' => TRUE
                    ),
                     'amendment_no'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'cooperative_id'
                      // 'null' => TRUE
                    )
                  )
        );
      

        $this->dbforge->add_column('registeredamendment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `registeredamendment` LIKE 'amendment_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE registeredamendment DROP COLUMN amendment_id"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `registeredamendment` LIKE 'amendment_no'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE registeredamendment DROP COLUMN amendment_no"); 
        }
    }
}
?>