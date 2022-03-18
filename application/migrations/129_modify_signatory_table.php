<?php
class Migration_modify_signatory_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'effectivity_date'=>array(
                      'type'=>'DATE',
                      // 'constraint'=>12,
                      'after' => 'region_code',
                      // 'null' => TRUE
                      // 'default' => 1
                    )
                  )
        );
        $this->dbforge->add_column('signatory',$field);

    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `signatory` LIKE 'effectivity_date'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE signatory DROP COLUMN effectivity_date"); 
        }

    }
}
?>