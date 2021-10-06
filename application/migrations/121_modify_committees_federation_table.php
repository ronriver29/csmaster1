<?php
class Migration_modify_committees_federation_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'func_and_respons'=>array(
                      'type'=>'LONGTEXT',
                      // 'constraint'=>12,
                      'after' => 'name',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('committees_federation',$field);

        $this->dbforge->add_field(
           $field = array
                  (
                     'func_and_respons'=>array(
                      'type'=>'LONGTEXT',
                      // 'constraint'=>12,
                      'after' => 'name',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('committees_union',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `committees_federation` LIKE 'func_and_respons'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE committees_federation DROP COLUMN func_and_respons"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `committees_union` LIKE 'func_and_respons'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry2 = $this->db->query("ALTER TABLE committees_union DROP COLUMN func_and_respons"); 
        }
    }
}
?>