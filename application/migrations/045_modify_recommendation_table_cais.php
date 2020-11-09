<?php
class Migration_modify_recommendation_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'rec_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );
        $this->dbforge->add_column('recommendation',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `recommendation` LIKE 'rec_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE recommendation DROP COLUMN rec_year"); 
        }

      
    }
}
?>