<?php
class Migration_modify_payment_table extends CI_Migration
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
                    'default' => 0.00
                    )
                  )
        );



        $this->dbforge->add_column('payment',$field);
    }

    public function down()
    {
       $this->dbforge->modify_column('payment', 'total');
    }
}
?>