<?php
class Migration_modify_paquestion_table extends CI_Migration
{
    public function up()
    {
    //     $this->dbforge->add_field(
    //        $field =  array
    //               (
    //                'id' => array(
    //                'type' => 'INT',
    //                'constraint' => 11,
    //                'unsigned' => true,
    //                'auto_increment' => true
    //                ),
    //                 'isOther'=>array(
    //                 'type'=>'TINYINT',
    //                 'constraint'=>1,
    //                 'after' => 'applicable',
    //                 'default' => '0'
    //                 ),
    //                 'category'=>array(
    //                 'type'=>'VARCHAR',
    //                 'constraint'=>50,
    //                 'after' => 'isOther',
    //                 'default' => '1,2'
    //                 )
    //               )
    //     );
    //     $this->dbforge->add_key('id', TRUE);
    //     $this->dbforge->add_column('paquestion',$field);
    //     $this->db->query("UPDATE `paquestion` SET `isOther` = 1 WHERE `num` IN (131,151,212)");
    //     $this->db->query("UPDATE `paquestion` SET `category` = '1' WHERE `num` BETWEEN 12 AND 17");
    //     $this->db->query("UPDATE `paquestion` SET `category` = '2' WHERE `num` BETWEEN 18 AND 25");
      $this->db->query("ALTER TABLE `paquestion` ADD COLUMN `id` INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT FIRST, ADD COLUMN `isOther` TINYINT(1) DEFAULT '0' AFTER `applicable`, ADD COLUMN `category` VARCHAR(50) DEFAULT '1,2' AFTER `isOther`");
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
         $this->db->query("ALTER TABLE paquestion DROP COLUMN id"); 
        }

        $result2 = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'isOther'");
        // $exists = ($result)?TRUE:FALSE;
        if($result2->num_rows()>0)
        {
         $this->db->query("ALTER TABLE paquestion DROP COLUMN isOther"); 
        }

        $result3 = $this->db->query("SHOW COLUMNS FROM `paquestion` LIKE 'category'");
        // $exists = ($result)?TRUE:FALSE;
        if($result3->num_rows()>0)
        {
         $this->db->query("ALTER TABLE paquestion DROP COLUMN category"); 
        }
    }
}
?>