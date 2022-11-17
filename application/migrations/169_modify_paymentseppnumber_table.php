<?php
class Migration_modify_paymentseppnumber_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'epp_number'=> array(
                      'type' => 'LONGTEXT',
                      'after' => 'merchantrefno',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    {
        $result = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'epp_number'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE payment DROP COLUMN epp_number");
        }
    }
}
?>
