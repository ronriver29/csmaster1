<?php
class Migration_modify_amendment_staff_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'amendment_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('amendment_staff',$field);
    }

    public function down()
    { 
       if($this->db->field_exists('amendment_staff', 'amendment_id'))
       {
       $this->dbforge->drop_column('amendment_staff', 'amendment_id');
       }
       
    }
}
?>