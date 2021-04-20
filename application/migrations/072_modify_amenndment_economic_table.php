<?php
class Migration_modify_amenndment_economic_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'strategistic_support_members_desc'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>150,
                      'null' => TRUE
                    ),
                     'procure_equipments_etc_desc'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>150,
                      'null' => TRUE
                    ),
                     'transact_business_with_desc'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>150,
                      'null' => TRUE
                    ),
                     'generate_capital_desc'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>150,
                      'null' => TRUE
                    )
                     ,'investments_desc'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>150,
                      'null' => TRUE
                    )

                  )
        ); 
        $this->dbforge->add_column('amendment_economic_survey',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_economic_survey` LIKE 'strategistic_support_members_desc'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amendment_economic_survey DROP COLUMN strategistic_support_members_desc"); 
        }

         $result2 = $this->db->query("SHOW COLUMNS FROM `amendment_economic_survey` LIKE 'procure_equipments_etc_desc'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry1 = $this->db->query("ALTER TABLE amendment_economic_survey DROP COLUMN procure_equipments_etc_desc"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `amendment_economic_survey` LIKE 'transact_business_with_desc'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry2 = $this->db->query("ALTER TABLE amendment_economic_survey DROP COLUMN transact_business_with_desc"); 
        }

         $result4 = $this->db->query("SHOW COLUMNS FROM `amendment_economic_survey` LIKE 'generate_capital_desc'");
        // $exists = ($result)?TRUE:FALSE;
        if($result4->num_rows()>0)
        {
           $qry4 = $this->db->query("ALTER TABLE amendment_economic_survey DROP COLUMN generate_capital_desc"); 
        }

         $result5 = $this->db->query("SHOW COLUMNS FROM `amendment_economic_survey` LIKE 'investments_desc'");
        // $exists = ($result)?TRUE:FALSE;
        if($result5->num_rows()>0)
        {
           $qry5 = $this->db->query("ALTER TABLE amendment_economic_survey DROP COLUMN investments_desc"); 
        }

    }
}
?>