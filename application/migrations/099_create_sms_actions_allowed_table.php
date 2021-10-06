<?php
class Migration_create_sms_actions_allowed_table extends CI_Migration
{
    public function up()
    {
    	$this->dbforge->add_field(
           array(
              'actionid' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'category'=> array(
                'type' => 'ENUM',
                'constraint' =>'primary', 'branch_inside', 'branch_outside', 'laboratories', 'amendment'
                // 'default' =>'0'
              ),
               'actiondesc'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
                 // 'null' => TRUE
              ),
              'message'=> array(
                'type' => 'TEXT',
                // 'constraint' =>100
              ),
              'allowed'=> array(
                'type' => 'TINYINT',
                'constraint' => 11,
                'default' => '1'
                 // 'null' => TRUE
              ),
              'userid_last_update'=> array(
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

        $this->dbforge->add_key('actionid', TRUE);
        $this->dbforge->create_table('sms_actions_allowed',TRUE);

    }

    public function down()
    {
      $this->dbforge->drop_table('sms_actions_allowed');
    }
    
}
?>