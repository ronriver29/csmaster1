<?php
class Migration_modify_secteractivity_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'secter_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('secteractivity',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `secteractivity` LIKE 'secter_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE secteractivity DROP COLUMN secter_year"); 
        }

      
    }
}
?>