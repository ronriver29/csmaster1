<?php
class Migration_modify_amendment_bylaws_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'member_invest_per_month'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    ),
                     'member_percentage_annual_interest'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    ),
                     'member_percentage_service'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    )

                  )
        );



        $this->dbforge->modify_column('amendment_bylaws',$field);
    }

    public function down()
    { 
       
        
           $qry = $this->db->query("ALTER TABLE amendment_bylaws  MODIFY member_invest_per_month INT(11) default null, MODIFY member_percentage_annual_interest INT(11) default null,  MODIFY member_percentage_service INT(11) default null"); 
    }
}
?>