<?php
class Migration_modify_cooperatives_comment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'revert_tool'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'rec_action',
                      'null' => TRUE
                    ),
                     'tool_comments'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'revert_tool',
                      'null' => TRUE
                    )
                  )
        );
      

        $this->dbforge->add_column('cooperatives_comment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives_comment` LIKE 'revert_tool'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE cooperatives_comment DROP COLUMN revert_tool"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `cooperatives_comment` LIKE 'tool_comments'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE cooperatives_comment DROP COLUMN tool_comments"); 
        }
    }
}
?>