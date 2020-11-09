<?php
class Migration_modify_advocacyservice_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'advocacy_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('advocacyservice',$field);
    }

    public function down()
    { 
       
        $result = $this->db->query("SHOW COLUMNS FROM `advocacyservice` LIKE 'advocacy_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE advocacyservice DROP COLUMN advocacy_year"); 
        }
    }
}
?>