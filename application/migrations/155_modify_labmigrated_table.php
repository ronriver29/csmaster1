<?php
class Migration_modify_labmigrated_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                      'migrated'=> array(
                      'type' => 'TINYINT',
                      // 'after' => 'date_of_or',
                      'default'=> 0,
                    ),
                  )
        );
        $this->dbforge->add_column('laboratories',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `laboratories` LIKE 'migrated'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE laboratories DROP COLUMN migrated"); 
        }

    }
}
?>