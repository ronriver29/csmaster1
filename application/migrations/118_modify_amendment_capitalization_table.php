<?php
class Migration_modify_amendment_capitalization_table extends CI_Migration
{
    public function up()
    {
        //previous data type is VARCHAR 20
        // [5] => authorized_share_capital
        // [6] => par_value
        // [7] => common_share
        // [8] => preferred_share
        // [9] => total_amount_of_subscribed_capital
        // [10] => total_no_of_subscribed_capital
        // [11] => total_amount_of_paid_up_capital
        // [12] => total_no_of_paid_up_capital
        //previos data type is VARCHAr 255
        // [13] => minimum_subscribed_share_regular
        // [14] => minimum_paid_up_share_regular
        // [15] => minimum_subscribed_share_associate
        // [16] => minimum_paid_up_share_associate
        // [17] => amount_of_common_share_subscribed
        // [18] => amount_of_common_share_subscribed_pervalue
        // [19] => amount_of_preferred_share_subscribed
        // [20] => amount_of_preferred_share_subscribed_pervalue
        // [21] => amount_of_common_share_paidup
        // [22] => amount_of_common_share_paidup_pervalue
        // [23] => amount_of_preferred_share_paidup
        // [24] => amount_of_preferred_share_paidup_pervalue

        $this->dbforge->add_field(
           $field = array
                  (
                    'authorized_share_capital'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'par_value'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'common_share'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'preferred_share'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'total_amount_of_subscribed_capital'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'total_no_of_subscribed_capital'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'total_amount_of_paid_up_capital'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'total_no_of_paid_up_capital'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'minimum_subscribed_share_regular'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'minimum_paid_up_share_regular'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'minimum_subscribed_share_associate'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'minimum_paid_up_share_associate'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_common_share_subscribed'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_common_share_subscribed_pervalue'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_preferred_share_subscribed'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_preferred_share_subscribed_pervalue'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_common_share_paidup'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_common_share_paidup_pervalue'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_preferred_share_paidup'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    ),
                    'amount_of_preferred_share_paidup_pervalue'=>array(
                    'type'=>'FLOAT',
                    'constraint' =>20,
                    'null' => TRUE,
                    )
                  )
        );



        $this->dbforge->modify_column('amendment_capitalization',$field);
    }

    public function down()
    { 
       
        // [5] => authorized_share_capital
        // [6] => par_value
        // [7] => common_share
        // [8] => preferred_share
        // [9] => total_amount_of_subscribed_capital
        // [10] => total_no_of_subscribed_capital
        // [11] => total_amount_of_paid_up_capital
        // [12] => total_no_of_paid_up_capital
        $qry = $this->db->query("ALTER TABLE amendment_capitalization  MODIFY authorized_share_capital VARCHAR(20) default null, MODIFY par_value VARCHAR(20) default null,  MODIFY common_share VARCHAR(20) default null, MODIFY preferred_share VARCHAR(20) default null,MODIFY total_amount_of_subscribed_capital VARCHAR(20) default null,MODIFY total_no_of_subscribed_capital VARCHAR(20) default null,MODIFY total_amount_of_paid_up_capital VARCHAR(20) default null,MODIFY total_no_of_paid_up_capital VARCHAR(20) default null");

        // [13] => minimum_subscribed_share_regular
        // [14] => minimum_paid_up_share_regular
        // [15] => minimum_subscribed_share_associate
        // [16] => minimum_paid_up_share_associate
        // [17] => amount_of_common_share_subscribed
        // [18] => amount_of_common_share_subscribed_pervalue
        // [19] => amount_of_preferred_share_subscribed
        // [20] => amount_of_preferred_share_subscribed_pervalue
        // [21] => amount_of_common_share_paidup
        // [22] => amount_of_common_share_paidup_pervalue
        // [23] => amount_of_preferred_share_paidup
        // [24] => amount_of_preferred_share_paidup_pervalue
         $qry = $this->db->query("ALTER TABLE amendment_capitalization  MODIFY  minimum_subscribed_share_regular VARCHAR(255) default null, MODIFY minimum_paid_up_share_regular VARCHAR(255) default null, MODIFY minimum_subscribed_share_associate VARCHAR(255) default null, MODIFY minimum_paid_up_share_associate VARCHAR(255) default null, MODIFY amount_of_common_share_subscribed VARCHAR(255) default null, MODIFY amount_of_common_share_subscribed_pervalue VARCHAR(255) default null,MODIFY amount_of_preferred_share_subscribed VARCHAR(255) default null,MODIFY amount_of_preferred_share_subscribed_pervalue VARCHAR(255) default null,MODIFY amount_of_common_share_paidup VARCHAR(255) default null,MODIFY amount_of_common_share_paidup_pervalue VARCHAR(255) default null,MODIFY amount_of_preferred_share_paidup VARCHAR(255) default null,MODIFY amount_of_preferred_share_paidup_pervalue VARCHAR(255) default null  
             ");

    }
}
?>