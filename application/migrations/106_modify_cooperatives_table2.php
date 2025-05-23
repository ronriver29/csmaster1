<?php
class Migration_modify_cooperatives_table2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'interregional'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'refbrgy_brgyCode',
                      // 'null' => TRUE
                    ),
                     'regions'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'interregional',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'interregional'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN interregional"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'regions'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN regions"); 
        }
    }
}
?>