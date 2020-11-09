<?php
class Migration_modify_coopbusiness_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'business_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('coopbusiness',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `coopbusiness` LIKE 'business_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE coopbusiness DROP COLUMN business_year"); 
        }
    }
}
?>