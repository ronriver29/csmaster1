<?php
class Migration_unioncoop_table extends CI_Migration
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
              'registeredcoop_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'regNo'=> array(
                'type' => 'VARCHAR',
                'constraint' =>21,
                 // 'null' => TRUE,
              ),
              'coopName'=> array(
                'type' => 'VARCHAR',
                'constraint' =>200,
                 // 'null' => TRUE,
              ),
             'application_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
             'user_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('unioncoop');
    }

    public function down()
    {
        $this->dbforge->drop_table('unioncoop');
    }
}
?>