<?php
class Migration_add_column_registeredamendement_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'grouping'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                       'after' => 'type',
                        'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('registeredamendment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `registeredamendment` LIKE 'grouping'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredamendment DROP COLUMN grouping"); 
        }

       
    }
}
?>