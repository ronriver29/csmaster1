<?php
class Migration_insert_chairman_table extends CI_Migration
{
    public function up()
    {
      $data = array(
           'id'=>2,
           'chairman'=>"JOSEPH B. ENCABO",
           'active_status'=>1,
           'effectivity_date'=>'2021-04-15'
         );

      $this->db->insert('chairman',$data);
    }

    public function down()
    { 
      $this->db->delete('chairman',array('id'=>2));
      $this->db->delete('chairman',array('chairman'=>"JOSEPH B. ENCABO"));
      $this->db->delete('chairman',array('active_status'=>1));
      $this->db->delete('chairman',array('effectivity_date'=>"2021-04-15"));

    }
}
?>