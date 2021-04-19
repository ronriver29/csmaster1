<?php
class Migration_modify_chairman_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'effectivity_date'=>array(
                      'type'=>'DATE',
                      // 'constraint'=>50
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('chairman',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `chairman` LIKE 'effectivity_date'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE chairman DROP COLUMN effectivity_date"); 
        }
    }
}
?>