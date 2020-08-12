<?php
class Migration_modify_business_activities_cooperative_amendment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'cooperative_type_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    ),
                    'major_industry_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    ),
                    'subclass_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20
                      // 'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('business_activities_cooperative_amendment',$field);
    }

    public function down()
    {
       if($this->db->field_exists('business_activities_cooperative_amendment', 'cooperative_type_id'))
       {
       $this->dbforge->drop_column('business_activities_cooperative_amendment', 'cooperative_type_id');
       }
       if($this->db->field_exists('business_activities_cooperative_amendment', 'major_industry_id'))
       {
       $this->dbforge->drop_column('business_activities_cooperative_amendment', 'major_industry_id');
       }
       if($this->db->field_exists('business_activities_cooperative_amendment', 'subclass_id'))
       {
       $this->dbforge->drop_column('business_activities_cooperative_amendment', 'subclass_id');
       }
    }
}
?>