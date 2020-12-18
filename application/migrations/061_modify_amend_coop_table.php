<?php
class Migration_modify_amend_coop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'ho'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'default' => 0
                    )
                  )
        );
        $this->dbforge->add_column('amend_coop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'ho'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amend_coop DROP COLUMN ho"); 
        }

     
      
    }
}
?>