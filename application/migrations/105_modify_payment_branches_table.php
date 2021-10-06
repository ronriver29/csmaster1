<?php
class Migration_modify_payment_branches_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'bns_id'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'bns_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE payment DROP COLUMN bns_id"); 
        }
    }
}
?>