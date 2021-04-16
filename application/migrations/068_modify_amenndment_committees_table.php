<?php
class Migration_modify_amenndment_committees_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'fullname'=>array(
                      'type'=>'VARCHAR',
                      'constraint'=>50
                      // 'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('amendment_committees',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_committees` LIKE 'fullname'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amendment_committees DROP COLUMN fullname"); 
        }
    }
}
?>