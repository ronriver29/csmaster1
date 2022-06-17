<?php
class Migration_create_amendment_affiliators_table extends CI_Migration
{
    public function up()
    {
      
        $this->dbforge->add_field(
          array(
            'id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'amendment_fed_id'=> array(
            'type' => 'INT',
            'constraint' =>11
            // 'unsigned' => true,
            ),
            'amendment_id'=> array(
            'type' => 'INT',
            'constraint' =>11
            // 'null' => TRUE
            ),
            'cooperative_id'=> array(
            'type' => 'INT',
            'constraint' =>11
            // 'null' => TRUE
            ),
            'registered_id'=> array(
            'type' => 'INT',
            'constraint' =>11
            ),
            'regNo'=> array(
            'type' => 'VARCHAR',
            'constraint' =>50
            // 'null' => TRUE
            ),
            'source'=> array(
            'type' => 'VARCHAR',
            'constraint' =>50
            // 'null' => TRUE
            ),
            'coopName'=> array(
            'type' => 'VARCHAR',
            'constraint' =>200
            // 'null' => TRUE
            ),
            'type'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            // 'null' => TRUE
            ),
            'commonBond'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            // 'null' => TRUE
            ),
            'dateRegistered'=> array(
            'type' => 'DATE'
            ),
            'addrCode'=> array(
            'type' => 'VARCHAR',
            'constraint' =>50
            // 'null' => TRUE
            ),
            'Street'=> array(
            'type' => 'VARCHAR',
            'constraint' =>100
            ),
            'noStreet'=> array(
            'type' => 'VARCHAR',
            'constraint' =>100
            ),
            'brgy'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            ),
            'city'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            ),
            'province'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            ),
            'region'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150
            ),
            'user_id'=> array(
            'type' => 'INT',
            'constraint' =>11
            ),
            'number_of_subscribed_shares'=> array(
            'type' => 'INT',
            'constraint' =>11,
            'null' => TRUE
            ),
            'number_of_paid_up_shares'=> array(
            'type' => 'INT',
            'constraint' =>11,
            'null' => TRUE
            ),
            'position'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150,
            'null' => TRUE
            ),
            'representative'=> array(
            'type' => 'VARCHAR',
            'constraint' =>150,
            'null' => TRUE
            ),
            'proof_of_identity'=> array(
            'type' => 'VARCHAR',
            'constraint' =>100,
            'null' => TRUE
            )
            ,
            'valid_id'=> array(
            'type' => 'VARCHAR',
            'constraint' =>50,
            'null' => TRUE
            )
            ,
            'date_issued'=> array(
            'type' => 'DATETIME',
            // 'constraint' =>100,
            'null' => TRUE
            )
            ,
            'place_of_issuance'=> array(
            'type' => 'TEXT',
            'constraint' =>150,
            'null' => TRUE
            )
            ,
            'type_of_member'=> array(
            'type' => 'VARCHAR',
            'constraint' =>100,
            'null' => TRUE
            )
          )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('amendment_affiliators',TRUE);

    }

    public function down()
    { 
      $this->dbforge->drop_table('amendment_affiliators');
    }
}
?> 