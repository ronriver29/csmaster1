<?php
class Migration_modify_cooperativessrcdsreceived_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                      'senior_received_the_app'=> array(
                      'type' => 'DATETIME',
                      'after' => 'senior_submit_at',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'senior_received_the_app'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN senior_received_the_app"); 
        }
    }
}
?>