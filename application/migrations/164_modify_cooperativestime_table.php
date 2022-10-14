<?php
class Migration_modify_cooperativestime_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'received_trans_receipt'=> array(
                      'type' => 'DATETIME',
                      'after' => 'date_for_payment',
                      'null'=> TRUE,
                    ),
                    'date_cor_printed'=> array(
                      'type' => 'DATETIME',
                      'after' => 'received_trans_receipt',
                      'null'=> TRUE,
                    ),
                  )
        );
        $this->dbforge->add_column('cooperatives',$field);
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'received_trans_receipt'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN received_trans_receipt"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'date_cor_printed'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
           $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN date_cor_printed"); 
        }
    }
}
?>