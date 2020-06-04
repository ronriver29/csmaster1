<?php
class Migration_modify_payment_table2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                   'total' => array(
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                    'null' => FALSE,
                    'default' => 0.00,
                    )
                  )
        );



        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    {
       if($this->db->field_exists('payment', 'total'))
       {
       $this->dbforge->drop_column('payment', 'total');
      }
    }
}
?>