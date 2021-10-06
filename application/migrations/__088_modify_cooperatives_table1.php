<?php
class Migration_modify_cooperatives_table1 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'proposedname_binary'=>array(
                      'type'=>'VARBINARY',
                      'constraint' => 255,
                      'after' => 'acronym_name'
                    ),
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
        $this->db->query("CREATE INDEX proposedname_binary ON cooperatives (proposedname_binary)");
        $this->db->query("CREATE INDEX status ON cooperatives (status)");
        $this->db->query("UPDATE cooperatives set proposedname_binary = LOWER(CONCAT(proposed_name))"); 
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'proposedname_binary'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE cooperatives DROP COLUMN proposedname_binary"); 
        }
        $this->db->query("DROP INDEX status ON cooperatives");
    }
}
?>