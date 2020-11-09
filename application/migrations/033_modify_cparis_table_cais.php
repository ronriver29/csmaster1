<?php
class Migration_modify_cparis_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'cparis_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    ),
                     'applicable' => array(
                      'type'=>"TEXT",
                      'null' =>TRUE
                    )
                  )
        );
        $this->dbforge->add_column('cparis',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cparis` LIKE 'cparis_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cparis DROP COLUMN cparis_year"); 
        }

         $result1 = $this->db->query("SHOW COLUMNS FROM `cparis` LIKE 'applicable'");
        // $exists = ($result)?TRUE:FALSE;
        if($result1->num_rows()>0)
        {
           $qry1 = $this->db->query("ALTER TABLE cparis DROP COLUMN applicable"); 
        }
    }
}
?>