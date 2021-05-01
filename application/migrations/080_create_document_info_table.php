<?php
class Migration_create_document_info_table extends CI_Migration
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
              'amendment_id'=> array(
                'type' => 'INT',
                'constraint' =>11,
                // 'default' =>'0'
              ),
               'name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50
                 // 'null' => TRUE
              ),
              'total_pages'=> array(
                'type' => 'INT',
                'constraint' =>5
              )
           )
        );



        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('document_info',TRUE);
    }

    public function down()
    {
      $this->dbforge->drop_table('document_info');
    }
    
}
?>