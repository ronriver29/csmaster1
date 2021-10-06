<?php
class Migration_modify_affiliators_table2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'cooperatives_id'=>array(
                      'type'=>'INT',
                      'constraint'=>12,
                      'after' => 'application_id',
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('affiliators',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'cooperatives_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN cooperatives_id"); 
        }
    }
}
?>