<?php
class Migration_amendment_list_document_type extends CI_Migration
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
               'cooperative_type_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'title'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 // 'null' => TRUE,
              ),
              'description'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 // 'null' => TRUE,
              ),
              'document_num' => array(
                'type'=>'INT',
                'constraint' =>11,
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('amendment_coop_type_upload');
    }

    public function down()
    {
      $this->dbforge->drop_table('amendment_coop_type_upload');
    }
}
?>