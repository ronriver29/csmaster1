<?php
class Migration_modify_amendment_committees_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'orig_cooperators_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    ),
                    'amendment_cooperators_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    ),
                    'amendment_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('amendment_committees',$field);
    }

    public function down()
    {
       if($this->db->field_exists('amendment_committees', 'orig_cooperators_id'))
       {
       $this->dbforge->drop_column('amendment_committees', 'orig_cooperators_id');
       }
       if($this->db->field_exists('amendment_committees', 'amendment_cooperators_id'))
       {
       $this->dbforge->drop_column('amendment_committees', 'amendment_cooperators_id');
       }
       if($this->db->field_exists('amendment_committees', 'amendment_id'))
       {
       $this->dbforge->drop_column('amendment_committees', 'amendment_id');
       }
    }
}
?>