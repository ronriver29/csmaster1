<?php
class Migration_modify_branchesl_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                      'lapse_time'=> array(
                      'type' => 'DATETIME',
                      'after' => 'date_of_or',
                      'null'=> TRUE,
                    ),
                  
                      'sent_lapse_notif'=> array(
                      'type' => 'TINYINT',
                      'after' => 'lapse_time',
                      'default'=> 0,
                    )
                  )
        );
        $this->dbforge->add_column('branches',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'lapse_time'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN lapse_time"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'sent_lapse_notif'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry2 = $this->db->query("ALTER TABLE branches DROP COLUMN sent_lapse_notif"); 
        }
    }
}
?>