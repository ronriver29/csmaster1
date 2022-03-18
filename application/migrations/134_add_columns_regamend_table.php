<?php
class Migration_add_columns_regamend_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'migrated'=>array(
                      'type'=>'INT',
                      'constraint'=>5,
                       'default' => 0
                    )
                  )
        );
        $this->dbforge->add_column('registeredamendment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `registeredamendment` LIKE 'migrated'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredamendment DROP COLUMN migrated"); 
        }
    }
}
?>