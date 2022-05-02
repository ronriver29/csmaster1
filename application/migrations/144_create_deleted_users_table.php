<?php
class Migration_create_deleted_users_table extends CI_Migration
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
              'user_id'=> array(
                'type' => 'INT',
                'constraint' =>11
                // 'default' =>'0'
              ),
                'full_name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150
              ),
                'regNo'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                'null' => TRUE
              ),
                'email'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150
              ),
                'date_deleted'=> array(
                'type' => 'DATETIME',
                // 'constraint' =>11,
                // 'null'=> TRUE,
              ),
                'deleted_by'=> array(
                'type' => 'INT',
                'constraint' =>11,
                'null'=> TRUE,
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('deleted_users',TRUE);

    }

    public function down()
    {
      $this->dbforge->drop_table('deleted_users');
    }
    
}
?>