
<?php
class Migration_add_columns_amd_coop_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'migrated'=>array(
                      'type'=>'INT',
                      'constraint'=>5,
                       'default' => 0
                    )
                  )
        );
        $this->dbforge->add_column('amend_coop',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amend_coop` LIKE 'migrated'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amend_coop DROP COLUMN migrated"); 
        }
    }
}
?>