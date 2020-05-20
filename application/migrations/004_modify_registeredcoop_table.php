<?php
class Migration_modify_registeredcoop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'amendment_id'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );

        $this->dbforge->add_column('registeredcoop',$field);
    }

    public function down()
    {
       $this->dbforge->modify_column('registeredcoop', 'amendment_id');
    }
}
?>