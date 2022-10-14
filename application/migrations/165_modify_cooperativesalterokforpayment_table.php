<?php
class Migration_modify_cooperativesalterokforpayment_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                    'date_for_payment'=> array(
                      'type' => 'DATETIME',
                    ),
                  )
        );
        $this->dbforge->modify_column('cooperatives',$field);
    }

    // public function down()
    // { 
    //     $result = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'received_trans_receipt'");
    //     // $exists = ($result)?TRUE:FALSE;
    //     if($result->num_rows()>0)
    //     {
    //        $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN received_trans_receipt"); 
    //     }

    //     $result3 = $this->db->query("SHOW COLUMNS FROM `cooperatives` LIKE 'date_cor_printed'");
    //     // $exists = ($result)?TRUE:FALSE;
    //     if($result3->num_rows()>0)
    //     {
    //        $qry = $this->db->query("ALTER TABLE cooperatives DROP COLUMN date_cor_printed"); 
    //     }
    // }
}
?>