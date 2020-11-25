<?php
class Migration_modify_amendment_cooperators_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'proof_date_issued'=>array(
                      'type'=>'VARCHAR',
                      'constraint' =>50,
                      'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->modify_column('amendment_cooperators',$field);
    }

    public function down()
    { 
       
        $result = $this->db->query("SHOW COLUMNS FROM `amendment_cooperators` LIKE 'proof_date_issued'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE amendment_cooperators  MODIFY proof_date_issued DATE default null"); 
        }
    }
}
?>