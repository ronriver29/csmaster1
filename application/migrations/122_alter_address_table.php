<?php
class Migration_alter_address_table extends CI_Migration
{
    
    public function up()
    {
      

        $this->db->query("UPDATE refbrgy SET brgyDesc = REPLACE(REPLACE(brgyDesc, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE brgyDesc LIKE '%ÃƒÆ’Ã‚Â±%' OR brgyDesc LIKE '%Ãƒâ€˜%'");
        // $this->db->query("UPDATE refcitymun SET citymunDesc = REPLACE(REPLACE(citymunDesc, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE citymunDesc LIKE '%ÃƒÆ’Ã‚Â±%' OR citymunDesc LIKE '%Ãƒâ€˜%'");
        // $this->db->query("UPDATE refprovince SET provDesc = REPLACE(REPLACE(provDesc, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE provDesc LIKE '%ÃƒÆ’Ã‚Â±%' OR provDesc LIKE '%Ãƒâ€˜%'");
    }
    
    public function down()
    {

        // $this->db->query("UPDATE refbrgy SET  brgyDesc = REPLACE(REPLACE( brgyDesc, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE  brgyDesc LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR  brgyDesc LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
         $this->db->query("UPDATE refbrgy SET  brgyDesc = REPLACE(REPLACE( brgyDesc, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE  brgyDesc LIKE '%ñ%' OR  brgyDesc LIKE '%Ñ%' ");

        // $this->db->query("UPDATE refcitymun SET  citymunDesc = REPLACE(REPLACE( citymunDesc, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE citymunDesc LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR  citymunDesc LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci;");
        // $this->db->query("UPDATE refprovince SET  provDesc = REPLACE(REPLACE( provDesc, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE  provDesc LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR  provDesc LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci;");
       


    }
}