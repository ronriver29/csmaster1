<?php
class Migration_create_sms_messages_table extends CI_Migration
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
              'actionid'=> array(
                'type' => 'INT',
                'constraint' =>11
                // 'default' =>'0'
              ),
               'recipientid'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50
                 // 'null' => TRUE
              ),
              'mobile'=> array(
                'type' => 'INT',
                'constraint' =>12
              ),
              'message'=> array(
                'type' => 'TEXT',
                // 'constraint' => 11,
                // 'default' => '1'
                 // 'null' => TRUE
              ),
              'status'=> array(
                'type' => 'VARCHAR',
                'constraint' =>100
                 // 'null' => TRUE
              ),
              'errorcode'=> array(
                'type' => 'INT',
                'constraint' =>11
                 // 'null' => TRUE
              ),
              'errordesc'=> array(
                'type' => 'VARCHAR',
                'constraint' =>100
                 // 'null' => TRUE
              ),
              'useridlastupdate'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50
                 // 'null' => TRUE
              ),
              'date_last_update'=> array(
                'type' => 'DATETIME'
                // 'constraint' =>50
                 // 'null' => TRUE
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sms_messages',TRUE);

    }

    public function down()
    {
      $this->dbforge->drop_table('sms_messages');
    }
    
}
?>