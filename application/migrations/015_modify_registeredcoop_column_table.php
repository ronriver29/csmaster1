<?php
class Migration_modify_registeredcoop_column_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'noStreet'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->modify_column('registeredcoop',$field);
    }

    public function down()
    { 
      
       
    }
}
?>