<?php
class Migration_alter_tables_charset extends CI_Migration
{
    
    public function up()
    {
        $tables = $this->db->list_tables();

        foreach ($tables as $table)
        {
            $this->db->query("ALTER TABLE $table CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        }

        $this->db->query("UPDATE cooperatives SET proposed_name = REPLACE(REPLACE(proposed_name, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), acronym_name = REPLACE(REPLACE(acronym_name, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), street = REPLACE(REPLACE(street, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE proposed_name LIKE '%ÃƒÆ’Ã‚Â±%' OR proposed_name LIKE '%Ãƒâ€˜%' OR acronym_name LIKE '%ÃƒÆ’Ã‚Â±%' OR acronym_name LIKE '%Ãƒâ€˜%' OR street LIKE '%ÃƒÆ’Ã‚Â±%' OR street LIKE '%Ãƒâ€˜%';");
        $this->db->query("UPDATE registeredcoop SET coopName = REPLACE(REPLACE(coopName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), acronym = REPLACE(REPLACE(acronym, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), Street = REPLACE(REPLACE(Street, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE coopName LIKE '%ÃƒÆ’Ã‚Â±%' OR coopName LIKE '%Ãƒâ€˜%' OR acronym LIKE '%ÃƒÆ’Ã‚Â±%' OR acronym LIKE '%Ãƒâ€˜%' OR Street LIKE '%ÃƒÆ’Ã‚Â±%' OR Street LIKE '%Ãƒâ€˜%';");
        $this->db->query("UPDATE branches SET coopName = REPLACE(REPLACE(coopName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), branchName = REPLACE(REPLACE(branchName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), street = REPLACE(REPLACE(street, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE coopName LIKE '%ÃƒÆ’Ã‚Â±%' OR coopName LIKE '%Ãƒâ€˜%' OR branchName LIKE '%ÃƒÆ’Ã‚Â±%' OR branchName LIKE '%Ãƒâ€˜%' OR street LIKE '%ÃƒÆ’Ã‚Â±%' OR street LIKE '%Ãƒâ€˜%';");
        $this->db->query("UPDATE laboratories SET labName = REPLACE(REPLACE(labName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), laboratoryName = REPLACE(REPLACE(laboratoryName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), streetName = REPLACE(REPLACE(streetName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE labName LIKE '%ÃƒÆ’Ã‚Â±%' OR labName LIKE '%Ãƒâ€˜%' OR laboratoryName LIKE '%ÃƒÆ’Ã‚Â±%' OR laboratoryName LIKE '%Ãƒâ€˜%' OR streetName LIKE '%ÃƒÆ’Ã‚Â±%' OR streetName LIKE '%Ãƒâ€˜%';");
        $this->db->query("UPDATE report SET coopName = REPLACE(REPLACE(coopName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), addr = REPLACE(REPLACE(addr, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE coopName LIKE '%ÃƒÆ’Ã‚Â±%' OR coopName LIKE '%Ãƒâ€˜%' OR addr LIKE '%ÃƒÆ’Ã‚Â±%' OR addr LIKE '%Ãƒâ€˜%';");
        $this->db->query("UPDATE ca_user SET coopName = REPLACE(REPLACE(coopName, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ'), fullname = REPLACE(REPLACE(fullname, 'ÃƒÆ’Ã‚Â±', 'ñ'),'Ãƒâ€˜','Ñ') WHERE coopName LIKE '%ÃƒÆ’Ã‚Â±%' OR coopName LIKE '%Ãƒâ€˜%' OR fullname LIKE '%ÃƒÆ’Ã‚Â±%' OR fullname LIKE '%Ãƒâ€˜%';");
    }
    
    public function down()
    {

        $this->db->query("UPDATE cooperatives SET proposed_name = REPLACE(REPLACE(proposed_name, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), acronym_name = REPLACE(REPLACE(acronym_name, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), street = REPLACE(REPLACE(street, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE proposed_name LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR proposed_name LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR acronym_name LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR acronym_name LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR street LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR street LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
        $this->db->query("UPDATE registeredcoop SET coopName = REPLACE(REPLACE(coopName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), acronym = REPLACE(REPLACE(acronym, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), Street = REPLACE(REPLACE(Street, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE coopName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR coopName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR acronym LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR acronym LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR Street LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR Street LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
        $this->db->query("UPDATE branches SET coopName = REPLACE(REPLACE(coopName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), branchName = REPLACE(REPLACE(branchName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), street = REPLACE(REPLACE(street, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE coopName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR coopName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR branchName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR branchName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR street LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR street LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
        $this->db->query("UPDATE laboratories SET labName = REPLACE(REPLACE(labName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), laboratoryName = REPLACE(REPLACE(laboratoryName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜'), streetName = REPLACE(REPLACE(streetName, 'ñ', 'ÃƒÆ’Ã‚Â±' ),'Ñ','Ãƒâ€˜') WHERE labName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR labName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR laboratoryName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR laboratoryName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR streetName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR streetName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
         $this->db->query("UPDATE report SET coopName = REPLACE(REPLACE(coopName, 'ñ', 'ÃƒÆ’Ã‚Â±'),'Ñ','Ãƒâ€˜'), addr = REPLACE(REPLACE(addr, 'ñ', 'ÃƒÆ’Ã‚Â±'),'Ñ','Ãƒâ€˜') WHERE coopName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR coopName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR addr LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR addr LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");
        $this->db->query("UPDATE ca_user SET coopName = REPLACE(REPLACE(coopName, 'ñ', 'ÃƒÆ’Ã‚Â±'),'Ñ','Ãƒâ€˜'), fullname = REPLACE(REPLACE(fullname, 'ñ', 'ÃƒÆ’Ã‚Â±'),'Ñ','Ãƒâ€˜') WHERE coopName LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR coopName LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci  OR fullname LIKE '%ñ%' COLLATE utf8mb4_spanish_ci  OR fullname LIKE '%Ñ%' COLLATE utf8mb4_spanish_ci ;");

        $tables = $this->db->list_tables();

        foreach ($tables as $table)
        {
            $this->db->query("ALTER TABLE $table CONVERT TO CHARACTER SET latin1 COLLATE latin1_bin;");
        }


    }
}