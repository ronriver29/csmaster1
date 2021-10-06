<?php
class Migration_create_islands_table extends CI_Migration
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
              'island_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'region_code'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 'null' => TRUE,
              ),
              'regDesc'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 // 'null' => TRUE,
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('islands');
    }

    public function down()
    {
        $this->dbforge->drop_table('islands');
    }
}
?>