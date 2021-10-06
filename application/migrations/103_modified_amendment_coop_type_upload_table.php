<?php
class Migration_modified_amendment_coop_type_upload_table extends CI_Migration
{
    public function up()
    {
      $data = array(
        'description' => 'Certification of Cooperative Education & Transport Operation Seminar (CETOS) / Letter of Undertaking'
      );
        $this->db->update('amendment_coop_type_upload',$data,array('id'=>5));
    }

    public function down()
    { 
        $data = array(
        'description' => 'Certification of Cooperative Education & Transport Operation Seminar (CETOS) By Office of Transport Cooperatives OTC'
      );
        $this->db->update('amendment_coop_type_upload',$data,array('id'=>5));
    }
}
?>