<?php
class Migration_modify_amendment_committees_add_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    
                    'func_and_respons'=>array(
                      'type'=>'TEXT',
                      // 'constraint' =>50,
                      'null' => TRUE,
                    ),
                    'type'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>20,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('amendment_committees',$field);
    }

    public function down()
    { 
        $qry = $this->db->query("ALTER TABLE amendment_committees DROP COLUMN func_and_respons, type"); 
    }
}
?>