<?php
class Migration_modify_bylaws_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'directors_term'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50,
                      'after' => 'director_hold_term',
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('bylaws',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `bylaws` LIKE 'directors_term'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE bylaws DROP COLUMN directors_term"); 
        }
    }
}
?>