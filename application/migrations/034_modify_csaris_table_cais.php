<?php
class Migration_modify_csaris_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'csaris_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('csaris',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `csaris` LIKE 'csaris_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE csaris DROP COLUMN csaris_year"); 
        }

      
    }
}
?>