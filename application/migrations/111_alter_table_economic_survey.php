<?php
class Migration_alter_table_economic_survey extends CI_Migration
{
    
    public function up()
    {

        $this->db->query("ALTER TABLE `economic_survey` MODIFY `strategy_capital_build_up` LONGTEXT");
        $this->db->query("ALTER TABLE `economic_survey` MODIFY `education_programs_members` LONGTEXT");
        $this->db->query("ALTER TABLE `economic_survey` MODIFY `education_programs_officers` LONGTEXT");
        $this->db->query("ALTER TABLE `economic_survey` MODIFY `education_programs_staff` LONGTEXT");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `economic_survey` DROP COLUMN `strategy_capital_build_up`;
            ALTER TABLE `economic_survey` DROP COLUMN `education_programs_members`;
            ALTER TABLE `economic_survey` DROP COLUMN `education_programs_officers`;
            ALTER TABLE `economic_survey` DROP COLUMN `education_programs_staff`;");
    }
}