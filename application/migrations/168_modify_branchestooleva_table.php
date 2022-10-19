<?php
class Migration_modify_branchestooleva_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'evaluator_for_conversion_1'=> array(
                      'type' => 'INT',
                      'after' => 'evaluator_for_transfer_3',
                      'null'=> TRUE,
                    ),
                    'evaluator_for_conversion_2'=> array(
                      'type' => 'INT',
                      'after' => 'evaluator_for_conversion_1',
                      'null'=> TRUE,
                    ),
                    'evaluator_for_conversion_3'=> array(
                      'type' => 'INT',
                      'after' => 'evaluator_for_conversion_2',
                      'null'=> TRUE,
                    ),
                    'tool_yn_answer_conv'=> array(
                      'type' => 'MEDIUMTEXT',
                      'after' => 'tool_comment',
                      'null'=> TRUE,
                    ),
                    'tool_remark_conv'=> array(
                      'type' => 'MEDIUMTEXT',
                      'after' => 'tool_yn_answer_conv',
                      'null'=> TRUE,
                    ),
                    'tool_yn_answer_trans'=> array(
                      'type' => 'MEDIUMTEXT',
                      'after' => 'tool_remark_conv',
                      'null'=> TRUE,
                    ),
                    'tool_remark_trans'=> array(
                      'type' => 'MEDIUMTEXT',
                      'after' => 'tool_yn_answer_trans',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('branches',$field);
    }

    public function down()
    {
        $result = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_conversion_1'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_conversion_1");
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_conversion_2'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_conversion_2");
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'evaluator_for_conversion_3'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN evaluator_for_conversion_3");
        }

        $result4 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'tool_yn_answer_conv'");
        // $exists = ($result)?TRUE:FALSE;
        if($result4->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN tool_yn_answer_conv");
        }

        $result5 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'tool_remark_conv'");
        // $exists = ($result)?TRUE:FALSE;
        if($result5->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN tool_remark_conv");
        }

        $result6 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'tool_yn_answer_trans'");
        // $exists = ($result)?TRUE:FALSE;
        if($result6->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN tool_yn_answer_trans");
        }

        $result7 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'tool_remark_trans'");
        // $exists = ($result)?TRUE:FALSE;
        if($result7->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN tool_remark_trans");
        }
    }
}
?>
