<?php
class Migration_add_column_regcoo_cooperative extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'migrated'=>array(
                      'type'=>'INT',
                      'constraint'=>11,
                       'default' => 0
                    )
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
         $this->dbforge->add_column('registeredcoop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'migrated'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN migrated"); 
        }

         $result2 = $this->db->query("SHOW COLUMNS FROM `registeredcoop` LIKE 'migrated'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE registeredcoop DROP COLUMN migrated"); 
        }
    }
}
?>