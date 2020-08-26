<?php
class Migration_modify_committees_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'func_and_respons'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    ),
                    'type'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>20,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('committees',$field);
    }

    public function down()
    { 
      
       if($this->db->field_exists('committees', 'func_and_respons'))
       {
       $this->dbforge->drop_column('committees', 'func_and_respons');
       }
        if($this->db->field_exists('committees', 'type'))
       {
       $this->dbforge->drop_column('committees', 'type');
       }
       
    }
}
?>