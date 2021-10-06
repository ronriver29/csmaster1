<?php
class Migration_create_api_settings_table extends CI_Migration
{
    public function up()
    {
    	$this->dbforge->add_field(
           array(
              'settingsid' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'url'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
                // 'default' =>'0'
              ),
               'apikey'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255
                 // 'null' => TRUE
              ),
              'senderid'=> array(
                'type' => 'VARCHAR',
                'constraint' =>100
              ),
              'maxchar'=> array(
                'type' => 'INT',
                'constraint' =>5
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
              )
           )
        );

        $this->dbforge->add_key('settingsid', TRUE);
        $this->dbforge->create_table('api_settings',TRUE);

        $data = array(
          array(
          'url' => 'http://cloud.mybusybee.net/app/smsapi/index.php',
          'apikey' => 'b1bb9e63-0f8f-45ad-a652-cb4367dc9731',
          'senderid' => '',
          'maxchar' => 300,
          'userid_last_update' => 'superman',
          'date_last_update' => date('Y-m-d H:i:s')
          )
        );

        $this->db->insert_batch('api_settings',$data);
    }

    public function down()
    {
      $this->dbforge->drop_table('api_settings');
    }
    
}
?>