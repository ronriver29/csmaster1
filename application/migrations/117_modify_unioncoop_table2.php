<?php
class Migration_modify_unioncoop_table2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'capital_contribution'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                      'after' => 'representative',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('unioncoop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `unioncoop` LIKE 'capital_contribution'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE unioncoop DROP COLUMN capital_contribution"); 
        }

    }
}
?>