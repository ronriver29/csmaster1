<?php
class Migration_add_column_amd_cooperators extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'new'=>array(
                      'type'=>'INT',
                      'constraint'=>5,
                      'default' =>0  
                    )
                  )
        );
        $this->dbforge->add_column('amendment_cooperators',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_cooperators` LIKE 'new'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amendment_cooperators DROP COLUMN new"); 
        }

       
    }
}
?>