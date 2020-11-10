<?php
class Migration_modify_secterceft_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'sectercetf_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('sectercetf',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `sectercetf` LIKE 'sectercetf_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE sectercetf DROP COLUMN sectercetf_year"); 
        }

     
      
    }
}
?>