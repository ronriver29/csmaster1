<?php
class Migration_cooperatives_status_change_audit extends CI_Migration
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
              'from'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'to'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'edited_by'=> array(
                'type' => 'VARCHAR',
                'constraint' =>45,
                 // 'null' => TRUE,
              ),
              'cooperative_id'=> array(
                'type' => 'VARCHAR',
                'constraint' =>45,
                 // 'null' => TRUE,
              ),
              'module_type' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '45'
              ),
              'date_modified datetime default current_timestamp',
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('cooperatives_change_status_audit');
    }

    public function down()
    {
        $this->dbforge->drop_table('cooperatives_change_status_audit');
    }
}
?>