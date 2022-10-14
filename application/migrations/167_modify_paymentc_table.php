<?php
class Migration_modify_paymentc_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'cooperatives_id'=> array(
                      'type' => 'INT',
                      'after' => 'bns_id',
                      'null'=> TRUE,
                    ),
                    'lab_id'=> array(
                      'type' => 'INT',
                      'after' => 'cooperatives_id',
                      'null'=> TRUE,
                    ),
                    'merchantrefno'=> array(
                      'type' => 'VARCHAR',
                      'constraint' =>250,
                      'after' => 'lab_id',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'merchantrefno'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE payment DROP COLUMN merchantrefno"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'cooperatives_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE payment DROP COLUMN cooperatives_id"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'lab_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE payment DROP COLUMN lab_id"); 
        }
    }
}
?>