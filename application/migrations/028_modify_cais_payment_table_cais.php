<?php
class Migration_modify_cais_payment_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'payment_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('cais_payment',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cais_payment` LIKE 'payment_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cais_payment DROP COLUMN payment_year"); 
        }
    }
}
?>