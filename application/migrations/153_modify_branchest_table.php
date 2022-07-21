<?php
class Migration_modify_branchest_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                      'transferred_street'=> array(
                      'type' => 'varchar',
                      'constraint' =>250,
                      'after' => 'transferred_region',
                      'null'=> TRUE,
                    ),
                  
                      'transferred_houseblk'=> array(
                      'type' => 'varchar',
                      'constraint' =>250,
                      'after' => 'transferred_street',
                      'null'=> TRUE,
                    ),
                      'date_closure'=> array(
                        'type' => 'DATE'
                    ),
                      'date_transferred'=> array(
                        'type' => 'DATE'
                    ),
                      'date_convert'=> array(
                        'type' => 'DATE'
                    ),
                      'ok_for_closure'=> array(
                        'type' => 'DATE'
                    ),
                      'ok_for_transfer'=> array(
                        'type' => 'DATE'
                    ),
                      'ok_for_conversion'=> array(
                        'type' => 'DATE'
                    ),
                      'reason'=> array(
                      'type' => 'LONGTEXT',
                      'after' => 'addrCode',
                      'null'=> TRUE,
                    ),
                      'migrated'=> array(
                      'type' => 'TINYINT',
                      // 'after' => 'addrCode',
                      'default'=> 0,
                    ),
                  )
        );
        $this->dbforge->add_column('branches',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'transferred_street'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN transferred_street"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'transferred_houseblk'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry2 = $this->db->query("ALTER TABLE branches DROP COLUMN transferred_houseblk"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'date_closure'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry3 = $this->db->query("ALTER TABLE branches DROP COLUMN date_closure"); 
        }

        $result4 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'ok_for_closure'");
        // $exists = ($result)?TRUE:FALSE;
        if($result4->num_rows()>0)
        {
           $qry4 = $this->db->query("ALTER TABLE branches DROP COLUMN ok_for_closure"); 
        }

        $result5 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'date_transferred'");
        // $exists = ($result)?TRUE:FALSE;
        if($result5->num_rows()>0)
        {
           $qry5 = $this->db->query("ALTER TABLE branches DROP COLUMN date_transferred"); 
        }

        $result6 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'date_convert'");
        // $exists = ($result)?TRUE:FALSE;
        if($result6->num_rows()>0)
        {
           $qry6 = $this->db->query("ALTER TABLE branches DROP COLUMN date_convert"); 
        }

        $result7 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'ok_for_transfer'");
        // $exists = ($result)?TRUE:FALSE;
        if($result7->num_rows()>0)
        {
           $qry7 = $this->db->query("ALTER TABLE branches DROP COLUMN ok_for_transfer"); 
        }

        $result8 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'ok_for_conversion'");
        // $exists = ($result)?TRUE:FALSE;
        if($result8->num_rows()>0)
        {
           $qry8 = $this->db->query("ALTER TABLE branches DROP COLUMN ok_for_conversion"); 
        }

        $result9 = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'reason'");
        // $exists = ($result)?TRUE:FALSE;
        if($result9->num_rows()>0)
        {
           $qry9 = $this->db->query("ALTER TABLE branches DROP COLUMN reason"); 
        }
    }
}
?>