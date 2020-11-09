<?php
class Migration_modify_report_table_cais extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'report_year'=>array(
                      'type'=>'INT',
                      'constraint' =>11,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->add_column('report',$field);
    }

    public function down()
    { 
       
        $result = $this->db->query("SHOW COLUMNS FROM `report` LIKE 'report_year'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE report DROP COLUMN report_year"); 
        }
    }
}
?>