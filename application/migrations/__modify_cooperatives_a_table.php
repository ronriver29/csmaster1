<?php
class Migration_modify_cooperatives_a_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
           $field = array
                  (
                     'category_of_cooperative'=>array(
                      'type'=>'LONGTEXT'
                     
                    )
                  )
        );



        $this->dbforge->modify_column('cooperatives',$field);
    }

    public function down()
    { 
        $qry = $this->db->query(" ALTER TABLE cooperatives  MODIFY category_of_cooperative VARCHAR (255);"); 
    }
}
?>