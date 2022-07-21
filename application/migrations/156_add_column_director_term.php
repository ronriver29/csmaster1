<?php
class Migration_add_column_director_term extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                    (
                     'director_term'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>'50',
                      'after' => 'director_hold_term',
                      'null' => TRUE
                    ),
          
                  )
        );
        $this->dbforge->add_column('amendment_bylaws',$field);
    }

    public function down()
    { 
        $result2 = $this->db->query("SHOW COLUMNS FROM `amendment_bylaws` LIKE 'director_term'");
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amendment_bylaws DROP COLUMN director_term"); 
        }
      
    }
}
?>