<?php
class Migration_modify_admins_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'ord'=>array(
                      'type'=>'INT',
                      'constraint' =>5,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('admin',$field);
    }

    public function down()
    { 
       
        $result = $this->db->query("SHOW COLUMNS FROM `admin` LIKE 'ord'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE admin DROP COLUMN ord"); 
        }
    }
}
?>