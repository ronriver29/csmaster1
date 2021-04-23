<?php
class Migration_create_registeredamendment_table extends CI_Migration
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
              'cooperative_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                'default' =>'0'
              ),
               'coopName'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
                 // 'null' => TRUE
              ),
              'acronym'=> array(
                'type' => 'VARCHAR',
                'constraint' =>225
              ),
              'regNo'=> array(
                'type' => 'VARCHAR',
                'constraint' =>21
              ),
              'category'=> array(
                'type' => 'TEXT'
                // 'constraint' =>21,
              ),
              'type'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
              ),
              'dateRegistered'=> array(
                'type' => 'DATE',
                // 'constraint' =>21,
              ),
              'commonBond'=> array(
                'type' => 'VARCHAR',
                'constraint' =>100
              ),
              'areaOfOperation'=> array(
                'type' => 'VARCHAR',
                'constraint' =>20
              ),
               'noStreet'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                'null' => TRUE
              ),
               'Street'=> array(
                'type' => 'VARCHAR',
                'constraint' =>100
              ),
               'addrCode'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
              ),
                'compliant'=> array(
                'type' => 'VARCHAR',
                'constraint' =>30,
                'null' => TRUE
              ),
               'qr_code'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
              )  
           )
        );



        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('registeredamendment',TRUE);
    }

    public function down()
    {
      $this->dbforge->drop_table('registeredamendment');
    }
    
}
?>