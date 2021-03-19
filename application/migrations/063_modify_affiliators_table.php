<?php
class Migration_modify_affiliators_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'number_of_subscribed_shares'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    ),
                     'number_of_paid_up_shares'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    ),
                  )
        );
        $this->dbforge->add_column('affiliators',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'number_of_subscribed_shares'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE affiliators DROP COLUMN number_of_subscribed_shares"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `affiliators` LIKE 'number_of_paid_up_shares'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry2 = $this->db->query("ALTER TABLE affiliators DROP COLUMN number_of_paid_up_shares"); 
        }
    }
}
?>