<?php
class Migration_create_charter_cities_table extends CI_Migration
{
    public function up()
    {
      $this->dbforge->add_field(array(
                        'd' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'city_code' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '50',
                        ),
                        'city_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '150',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('charter_cities');
    }

    public function down()
    { 
      $this->dbforge->drop_table('charter_cities');
    }
}
?>