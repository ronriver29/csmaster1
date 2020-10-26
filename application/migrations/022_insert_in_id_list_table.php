<?php
class Migration_insert_in_id_list_table extends CI_Migration
{
    public function up()
    {
      $data = array(
           'id_name'=>"Pag-IBIG"
         );

      $this->db->insert('id_list',$data);
    }

    public function down()
    { 
       
      $this->db->delete('id_list',array('id_name'=>"Pag-IBIG"));
    }
}
?>