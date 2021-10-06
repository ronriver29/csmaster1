<?php
class Migration_modify_cooperatives_table extends CI_Migration
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
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'date_for_payment'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN date_for_payment"); 
        }
    }
}
?>