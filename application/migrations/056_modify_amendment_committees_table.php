<?php
class Migration_modify_amendment_committees_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'cooperative_id'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('amendment_committees',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_committees` LIKE 'cooperative_id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amendment_committees DROP COLUMN cooperative_id"); 
        }

     
      
    }
}
?>