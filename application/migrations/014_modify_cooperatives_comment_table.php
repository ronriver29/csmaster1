<?php
class Migration_modify_cooperatives_comment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'status'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('cooperatives_comment',$field);
    }

    public function down()
    { 
       if($this->db->field_exists('cooperatives_comment', 'status'))
       {
       $this->dbforge->drop_column('cooperatives_comment', 'status');
       }
       
    }
}
?>