<?php
class Migration_create_sms_blocked_no_table extends CI_Migration
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
              'mobile'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50
                // 'default' =>'0'
              ),
               'reason'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50
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
        $this->dbforge->create_table('sms_blocked_no',TRUE);

    }

    public function down()
    {
      $this->dbforge->drop_table('sms_blocked_no');
    }
    
}
?>