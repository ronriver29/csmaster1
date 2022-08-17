<?php
class Migration_modify_cooperativesyouth_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                      'is_youth'=> array(
                      'type' => 'TINYINT',
                      'constraint' =>2,
                      'after' => 'third_evaluated_by',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'is_youth'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN is_youth"); 
        }
    }
}
?>