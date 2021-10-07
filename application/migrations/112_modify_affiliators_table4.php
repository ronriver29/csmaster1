<?php
class Migration_modify_affiliators_table4 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'position'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'representative',
                      // 'null' => TRUE
                    ),
                     'proof_of_identity'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'position',
                      // 'null' => TRUE
                    ),
                     'valid_id'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'proof_of_identity',
                      // 'null' => TRUE
                    ),
                     'date_issued'=>array(
                      'type'=>'DATE',
                      // 'constraint'=>50,
                      'after' => 'valid_id',
                      'null' => TRUE
                    ),
                    'place_of_issuance'=>array(
                      'type'=>'LONGTEXT',
                      // 'constraint'=>50,
                      'after' => 'date_issued',
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('affiliators',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'position'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN position"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'proof_of_identity'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN proof_of_identity"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'valid_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN valid_id"); 
        }

        $result4 = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'date_issued'");
        // $exists = ($result)?TRUE:FALSE;
        if($result4->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN date_issued"); 
        }

        $result5 = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'place_of_issuance'");
        // $exists = ($result)?TRUE:FALSE;
        if($result5->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN place_of_issuance"); 
        }
    }
}
?>