<?php
class Migration_amendment_comment extends CI_Migration
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
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'amendment_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'access_level'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'status' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '20',
              ),
              'comment' => array(
                 'type' => 'TEXT',
                 'null' => TRUE,
              ),
              'created_at' => array(
                 'type' => 'timestamp',
              ),
              'author'=> array(
                'type'=>  'INT',
                'constraint'=>'11',
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('amendment_comment');
    }

    public function down()
    {
        $this->dbforge->drop_table('amendment_comment');
    }
}
?>