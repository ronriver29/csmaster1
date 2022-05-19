<?php
class Migration_update_cais_user_regno extends CI_Migration
{
    
    public function up()
    {
        $this->db->query("UPDATE ca_user SET regNo = '9520-03002152' WHERE regNo = '9520-0300-2152'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-101400032596' WHERE regNo = '9520 -101400032596'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-06004985' WHERE regNo = '9520-0600-4985'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-12019973' WHERE regNo = '9520-12019973-1'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-11014457' WHERE regNo = '9520-11014457-2'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-07014031' WHERE regNo = '9520-07014031-3'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-08001127' WHERE regNo = '9520-08001127-2'");
        $this->db->query("UPDATE ca_user SET regNo = '9520-03010008' WHERE regNo = '9520-03010008-1'");
    }
    
    public function down()
    {


    }
}