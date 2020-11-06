<?php
class Migration_modify_committees_add_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'cooperative_id'=>array(
                      'type'=>'BIGINT',
                      'constraint' =>20,
                      // 'null' => TRUE,
                    ),
                    'func_and_respons'=>array(
                      'type'=>'TEXT',
                      // 'constraint' =>50,
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
        $qry = $this->db->query(" ALTER TABLE committees DROP COLUMN cooperative_id,func_and_respons, type"); 
    }
}
?>