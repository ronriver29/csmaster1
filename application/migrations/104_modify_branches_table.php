<?php
class Migration_modify_branches_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'date_for_payment'=>array(
                      'type'=>'DATE',
                      // 'constraint'=>50
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('branches',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `branches` LIKE 'date_for_payment'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE branches DROP COLUMN date_for_payment"); 
        }
    }
}
?>