<?php
class Migration_alter_column_table_registeredcoopamendment extends CI_Migration
{
    public function up()
    {
    $this->db->query("ALTER TABLE registeredamendment ADD COLUMN date_printed DATE NOT NULL AFTER type");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE registeredamendment DROP COLUMN date_printed");
    }
}
?>
