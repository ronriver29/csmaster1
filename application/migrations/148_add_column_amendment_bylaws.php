<?php
class Migration_add_column_amendment_bylaws extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                    (
                     'composition_of_bod'=>array(
                      'type'=>'INT',
                      'constraint'=>'11',
                      'after' => 'primary_consideration',
                      'null' => TRUE
                    ),
          
                  )
        );
        $this->dbforge->add_column('amendment_bylaws',$field);
    }

    public function down()
    { 
        $result2 = $this->db->query("SHOW COLUMNS FROM `amendment_bylaws` LIKE 'composition_of_bod'");
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amendment_bylaws DROP COLUMN composition_of_bod"); 
        }
      
    }
}
?>