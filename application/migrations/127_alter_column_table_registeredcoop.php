<?php
class Migration_alter_column_table_registeredcoop extends CI_Migration
{
    public function up()
    {
       $this->db->query("ALTER TABLE registeredcoop RENAME COLUMN dateRegistered TO date_printed");
       $this->db->query("ALTER TABLE registeredcoop ADD COLUMN dateRegistered VARCHAR(10) DEFAULT NULL AFTER date_printed");

        $this->db->query("UPDATE registeredcoop JOIN cooperatives ON registeredcoop.application_id = cooperatives.id SET registeredcoop.dateRegistered = cooperatives.date_of_or");
     $this->db->query("UPDATE registeredcoop SET dateRegistered=date_printed WHERE char_length(dateRegistered) = 0 OR dateRegistered is NULL");
    }

    public function down()
    {
         $this->db->query("ALTER TABLE registeredcoop DROP COLUMN dateRegistered");
        $this->db->query("ALTER TABLE registeredcoop RENAME COLUMN date_printed TO dateRegistered ");
       
    }
}
?>
