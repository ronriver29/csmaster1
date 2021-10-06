<?php
class Migration_modify_payment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'refNo'=>array(
                      'type'=>'VARCHAR',
                      'constraint' => 100,
                      'after' => 'transactionNo'
                    ),
                  )
        );
        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `payment` LIKE 'refNo'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE payment DROP COLUMN refNo"); 
        }
    }
}
?>