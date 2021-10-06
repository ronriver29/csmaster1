<?php
class Migration_alter_doc_required_table_amendment extends CI_Migration
{
    
    public function up()
    {
      
                $data_field_service = array
                            (
                                'cooperative_type_id' => 15,//3,
                                'title' => 'Favorable Endorsement',
                                'description' => 'Favorable endorsement by Office of Transport Cooperatives (OTC)',
                                'document_num' => 9
                            );



                $data_field_transport = array
                            (
                                'cooperative_type_id' => 17,
                                'title' => "Favorable Endorsement",
                                'description' => "Favorable endorsement by Office of Transport Cooperatives (OTC)",
                                'document_num' => 9
                            );

                          
            $this->db->insert('amendment_coop_type_upload',$data_field_service); 
            $this->db->insert('amendment_coop_type_upload',$data_field_transport);             
    }
    
    public function down()
    {
        $this->db->query("DELETE FROM amendment_coop_type_upload WHERE document_num =9");

    }
}