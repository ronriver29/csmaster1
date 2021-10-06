<?php
class Migration_modify_registeredamendment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'interregional'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'addrCode',
                      // 'null' => TRUE
                    ),
                     'regions'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'interregional',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('registeredamendment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `registeredamendment` LIKE 'interregional'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredamendment DROP COLUMN interregional"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM registeredamendment` LIKE 'regions'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredamendment DROP COLUMN regions"); 
        }
    }
}
?>