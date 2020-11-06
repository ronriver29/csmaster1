<?php
class Migration_amendment_document extends CI_Migration
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
              'cooperative_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'amendment_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'document_num'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
              'filename'=> array(
                'type' => 'VARCHAR',
                'constraint' =>150,
                 // 'null' => TRUE,
              ),
              'status' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '20',
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
        $this->dbforge->create_table('amendment_uploaded_documents');
    }

    public function down()
    {
        $this->dbforge->drop_table('amendment_uploaded_documents');
    }
}
?>