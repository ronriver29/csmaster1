<?php
class Migration_modify_cooperatives_tool_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'tool_yn_answer'=>array(
                      'type'=>'LONGTEXT'
                      // 'constraint' =>5,
                    ),
                     'tool_remark'=>array(
                      'type'=>'LONGTEXT'
                      // 'constraint' =>5,
                      // 'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->modify_column('cooperatives',$field);
    }

    public function down()
    { 
        // $qry = $this->db->query(" ALTER TABLE admin DROP COLUMN tool_yn_answer,tool_remark"); 
    }
}
?>