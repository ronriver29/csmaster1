<?php
class Migration_alter_amendment_coop_type_upload_table2 extends CI_Migration
{
    public function up()
    {
        // if($this->db->query("TRUNCATE amendment_coop_type_upload"))
        // {
              $val = Array
                   (
                     Array
                        (
                            'cooperative_type_id' => 0,
                            'title' => 'General Assembly',
                            'description' => 'General Assembly Resolution',
                            'document_num' => 19
                        ),
                     Array
                        (
                            'cooperative_type_id' => 0,
                            'title' => 'BOD and Secretary',
                            'description' => 'BOD and Secretary Certificate',
                            'document_num' => 20
                        )
                );
                $this->db->insert_batch('amendment_coop_type_upload',$val);    
        // }
    }

    public function down()
    { 
       $this->db->query("DELETE FROM  amendment_coop_type_upload WHERE document_num IN(19,20)");
    }
}
?>