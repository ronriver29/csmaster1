<?php
class Migration_mvg_table extends CI_Migration
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
               'year'=> array(
                'type' => 'INT',
                'constraint' =>11,
                 'null' => TRUE,
              ),
              'mission'=> array(
                'type' => 'TEXT',
                // 'constraint' =>150,
                 'null' => TRUE,
              ),
              'vision'=> array(
                'type' => 'TEXT',
                 'null' => TRUE,
              ),
              'core' => array(
                'type' => 'TEXT',
                 'null' => TRUE,
              ),
              'goals' => array(
               'type' => 'TEXT',
                 'null' => TRUE,
              ),
              'user_id' => array(
                'type'=>'INT',
                'constraint' =>11,
              ),

           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mvg');
    }

    public function down()
    {
      $this->dbforge->drop_table('mvg');
    }
}
?>