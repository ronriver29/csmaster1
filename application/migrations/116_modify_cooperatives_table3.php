<?php
class Migration_modify_cooperatives_table3 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'capital_contribution'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'temp_evaluation_comment',
                      // 'null' => TRUE
                      'default' => 0
                    )
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'capital_contribution'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN capital_contribution"); 
        }

    }
}
?>