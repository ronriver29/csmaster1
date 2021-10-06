<?php
class Migration_modify_cooperatives_comment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'documents'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'comment',
                      'null' => TRUE
                    ),
                     'rec_action'=>array(
                      'type'=>'TEXT',
                      // 'constraint'=>11,
                      'after' => 'documents',
                      'null' => TRUE
                    )
                  )
        );
      

        $this->dbforge->add_column('cooperatives_comment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives_comment` LIKE 'documents'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE cooperatives_comment DROP COLUMN documents"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `cooperatives_comment` LIKE 'rec_action'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE cooperatives_comment DROP COLUMN rec_action"); 
        }
    }
}
?>