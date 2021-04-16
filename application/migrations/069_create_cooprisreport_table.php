<?php
class Migration_create_cooprisreport_table extends CI_Migration
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
             'signatory'=> array(
                'type' => 'VARCHAR',
                'constraint' =>21,
                 // 'null' => TRUE,
              ),
             'full_name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                 // 'null' => TRUE,
              ),
             'validity'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 // 'null' => TRUE,
              ),
             'coc_number'=> array(
                'type' => 'VARCHAR',
                'constraint' =>21,
                 // 'null' => TRUE,
              ),
             'addrCode'=> array(
                'type' => 'VARCHAR',
                'constraint' =>255,
                 // 'null' => TRUE,
              ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('coopris_report');
    }

    public function down()
    {
        $this->dbforge->drop_table('coopris_report');
    }
}
?>