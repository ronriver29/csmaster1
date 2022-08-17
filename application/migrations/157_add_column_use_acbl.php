<?php
class Migration_add_column_use_acbl extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                    (
                     'custom_acbl'=>array(
                      'type'=>'INT',
                      'constraint'=>'5',
                      'default'=>NULL,
                      'null' => TRUE
                    ),
          
                  )
        );
        $this->dbforge->add_column('amend_coop',$field);
    }

    public function down()
    { 
        $result2 = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'custom_acbl'");
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amend_coop DROP COLUMN custom_acbl"); 
        }
      
    }
}
?>