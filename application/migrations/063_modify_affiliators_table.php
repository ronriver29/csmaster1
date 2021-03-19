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
        $qry = $this->db->query("ALTER TABLE affiliators  MODIFY number_of_subscribed_shares INT(11) default null, MODIFY number_of_paid_up_shares INT(11) default null"); 
    }
}
?>