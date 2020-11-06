<?php
class Migration_coop_type_upload extends CI_Migration
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
              'coop_type_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'coop_title'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                 'null' => TRUE,
              ),
              'coop_desc' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '200',
                'null' => TRUE,
              ),
              'document_num'=> array(
                'type'=>  'INT',
                'constraint'=>'11',
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('coop_type_upload');
    }

    public function down()
    {
        $this->dbforge->drop_table('coop_type_upload');
    }
}
?>