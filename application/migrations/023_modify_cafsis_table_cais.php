<?php
class Migration_modify_cafsis_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'cafsis_year'=>array(
                      'type'=>'INT',
                      'constraint' =>10,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('cafsis',$field);
    }

    public function down()
    { 
       
        $result = $this->db->query("SHOW COLUMNS FROM `cafsis` LIKE 'cafsis_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cafsis DROP COLUMN cafsis_year"); 
        }
    }
}
?>