<?php
class Migration_modify_ca_user_product_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'product_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('ca_user_product',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `ca_user_product` LIKE 'product_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE ca_user_product DROP COLUMN product_year"); 
        }
    }
}
?>