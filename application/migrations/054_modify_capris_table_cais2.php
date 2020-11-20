<?php
class Migration_modify_capris_table_cais2 extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'other_officer'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE
                    )
                  )
        );
        $this->dbforge->add_column('capris',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `capris` LIKE 'other_officer'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE capris DROP COLUMN other_officer"); 
        }

     
      
    }
}
?>