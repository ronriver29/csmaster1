<?php
class Migration_create_head_office_coop_type_table extends CI_Migration
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
               'name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                 'null' => TRUE
              ),
              'active'=> array(
                'type' => 'TINYINT',
                'constraint' =>5,
                 'default' =>'1'
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('head_office_coop_type');
    }

    public function down()
    {
      $this->dbforge->drop_table('head_office_coop_type');
    }
}
?>