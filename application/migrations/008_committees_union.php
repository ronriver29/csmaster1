<?php
class Migration_committees_union extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'BIGINT',
                 'constraint' => 20,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'cooperators_id'=> array(
                'type' => 'BIGINT',
                'constraint' =>20,
                 // 'null' => TRUE,
              ),
              'user_id'=> array(
                'type' => 'BIGINT',
                'constraint' =>20,
                 // 'null' => TRUE,
              ),
              'name'=> array(
                'type' => 'VARCHAR',
                'constraint' =>200,
                 // 'null' => TRUE,
              ),
              'created_at datetime default current_timestamp',
              'updated_at datetime default current_timestamp on update current_timestamp',

              // 'created_at' => array(
              //    'type' => 'timestamp',
              //    'default' => 'CURRENT_TIMESTAMP',
              // ),
              //  'updated_at' => array(
              //    'type' => 'timestamp',
              //    'default' => 'CURRENT_TIMESTAMP',
              // ),
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('committees_union');
    }

    public function down()
    {
        $this->dbforge->drop_table('committees_union');
    }
}
?>