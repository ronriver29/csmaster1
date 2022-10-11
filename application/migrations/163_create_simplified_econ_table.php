<?php
class Migration_create_simplified_econ_table extends CI_Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE `simplified_economic_survey` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `cooperatives_id` int(11) NOT NULL,
          `nature_of_business` longtext NOT NULL,
          `initial_capital` varchar(11) NOT NULL,
          `initial_capital_others` varchar(250) NOT NULL,
          `documents` longtext NOT NULL,
          PRIMARY KEY (`id`),
          KEY `cooperatives_id` (`cooperatives_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
    }

    // public function up()
    // {
    // 	$this->dbforge->add_field(
    //        array(
    //           'id' => array(
    //              'type' => 'INT',
    //              'constraint' => 11,
    //              'unsigned' => true,
    //              'auto_increment' => true
    //           ),
    //           'cooperatives_id'=> array(
    //             'type' => 'INT',
    //             'constraint' =>11,
    //             'null'=> FALSE
    //             // 'default' =>'0'
    //           ),
    //             'nature_of_business'=> array(
    //             'type' => 'LONGTEXT'
    //           ),
    //             'initial_capital'=> array(
    //             'type' => 'VARCHAR',
    //             'constraint' =>11,
    //             'null' => FALSE
    //           ),
    //             'initial_capital_others'=> array(
    //             'type' => 'VARCHAR',
    //             'constraint' =>11,
    //             'null' => FALSE
    //           ),
    //             'documents'=> array(
    //             'type' => 'longtext',
    //             'null' => FALSE
    //             // 'constraint' =>11,
    //             // 'null'=> TRUE,
    //           ),
    //        )
    //     );
    //
    //     $this->dbforge->add_key('id', TRUE);
    //     $this->dbforge->create_table('simplified_economic_survey',TRUE);
    //
    // }

    public function down()
    {
       $this->db->query("DROP TABLE simplified_economic_survey");
    }
}
?>
