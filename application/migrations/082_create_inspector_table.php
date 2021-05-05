<?php
class Migration_create_inspector_table extends CI_Migration
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
               'signatory'=> array(
                'type' => 'VARCHAR',
                'constraint' => 250
                 // 'null' => TRUE
              ),
              'signatory_designation'=> array(
                'type' => 'VARCHAR',
                'constraint' => 250
              ),
              'region_code'=> array(
                'type' => 'VARCHAR',
                'constraint' => 11
              ),
               'active'=> array(
                'type' => 'TINYINT',
                'constraint' => 2
                 // 'null' => TRUE
              ),
               'date_last_updated'=> array(
                'type' => 'DATETIME',
                // 'constraint' =>250
                 // 'null' => TRUE
              ),
           )
        );



        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('signatory',TRUE);
    }

    public function down()
    {
      $this->dbforge->drop_table('signatory');
    }
    
}
?>