<?php
class Migration_modify_ava_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'ava_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('ava',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `ava` LIKE 'ava_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE ava DROP COLUMN ava_year"); 
        }
    }
}
?>