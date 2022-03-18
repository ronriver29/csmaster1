<?php
class Migration_modify_registeredcoopupdate_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'grouping'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>255,
                      'after' => 'category',
                      'null' => TRUE
                      // 'default' => 1
                    )
                  )
        );
        $this->dbforge->add_column('registeredcoop',$field);

    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `registeredcoop` LIKE 'grouping'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredcoop DROP COLUMN grouping"); 
        }

    }
}
?>