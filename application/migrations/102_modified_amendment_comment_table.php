<?php
class Migration_modified_amendment_comment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'tool_findings'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'rec_action',
                      'null' => TRUE
                    ),
                     'other_findings'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'tool_findings',
                      'null' => TRUE
                    )
                  )
        );
      

        $this->dbforge->add_column('amendment_comment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_comment` LIKE 'tool_findings'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amendment_comment DROP COLUMN tool_findings"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `amendment_comment` LIKE 'other_findings'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amendment_comment DROP COLUMN other_findings"); 
        }
    }
}
?>