<?php
class Migration_modify_capris_cais_table extends CI_Migration
{
    public function up()
    {
        // $this->dbforge->add_field(
        //    $field = array
        //           (
        //             'id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY'
        //           )
        // );
        // // $this->dbforge->add_field('id INT(11) NOT NULL AUTO_INCREMENT');
        // // $this->dbforge->add_key('id', TRUE);
        // $this->dbforge->add_column('capris',$field);
      $this->db->query("ALTER TABLE `capris` ADD id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY");
    }

    public function down()
    { 
        $result = $this->db->query("SHOW COLUMNS FROM `capris` LIKE 'id'");
        // $exists = ($result)?TRUE:FALSE;
        if($result->num_rows()>0)
        {
            $this->dbforge->drop_column('capris', 'id');
        }

    }
}
?>