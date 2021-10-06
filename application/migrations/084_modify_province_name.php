<?php
class Migration_modify_province_name extends CI_Migration
{
    private $_table = "refprovince";
    
    public function up()
    {
        $this->db->where('provDesc','Compostela Valley')->update($this->_table,['provDesc'=>'Davao de Oro']);
    }
    
    public function down()
    {
        $this->db->where('provDesc','Davao de Oro')->update($this->_table,['provDesc'=>'Compostela Valley']);
    }
}