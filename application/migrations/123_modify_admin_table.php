<?php
class Migration_modify_admin_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'active'=>array(
                      'type'=>'INT',
                      // 'constraint'=>12,
                      // 'after' => 'name',
                      // 'null' => TRUE
                      'default' => 1
                    )
                  )
        );
        $this->dbforge->add_column('admin',$field);

    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `admin` LIKE 'active'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE admin DROP COLUMN active"); 
        }

    }
}
?>