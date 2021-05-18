<?php
class Migration_modify_abylasw_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'type'=>array(
                      'type'=>'VARCHAR',
                      'constraint' => 50,
                      // 'null' => TRUE
                    ),
                  )
        );
        $this->dbforge->add_column('amendment_bylaws',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_bylaws` LIKE 'type'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE amendment_bylaws DROP COLUMN type"); 
        }
    }
}
?>