<?php
class Migration_modify_bylaws_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'additional_requirements_for_membership'=>array(
                      'type'=>'TEXT',
                      // 'constraint' =>50,
                      'null' => TRUE,
                    ),
                    'additional_conditions_to_vote'=>array(
                      'type'=>'TEXT',
                      // 'constraint' =>20,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->modify_column('bylaws',$field);
    }

    public function down()
    { 
        // $qry = $this->db->query(" ALTER TABLE amendment_committees DROP COLUMN func_and_respons, type"); 
    }
}
?>