<?php
class Migration_update_cais_user extends CI_Migration
{
    
    public function up()
    {
        $this->db->query("UPDATE ca_user SET regNo = REPLACE(regNo, '9520','9520-') WHERE LOCATE("-", regNo) = 0;");
    }
    
    public function down()
    {


    }
}