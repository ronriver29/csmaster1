<?php
class Migration_insert_islands_table extends CI_Migration
{
    public function up()
    {
      $data = array(
        array(
           'island_id'=>"1",
           'region_code'=>'013',
           'regDesc'=>'National Capital Region (NCR)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'014',
           'regDesc'=>'Cordillera Administrative Region (CAR)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'001',
           'regDesc'=>'Region I (Ilocos Region)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'002',
           'regDesc'=>'Region II (Cagayan Valley)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'003',
           'regDesc'=>'Region III (Central Luzon)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'004',
           'regDesc'=>'Region IV-A (CALABARZON)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'005',
           'regDesc'=>'Region V (Bicol Region)'
          ),
        array(
           'island_id'=>"1",
           'region_code'=>'017',
           'regDesc'=>'Region IV-B (MIMAROPA)'
          ),
        array(
           'island_id'=>"2",
           'region_code'=>'006',
           'regDesc'=>'Region VI (Western Visayas)'
          ),
        array(
           'island_id'=>"2",
           'region_code'=>'007',
           'regDesc'=>'Region VII (Central Visayas)'
          ),
        array(
           'island_id'=>"2",
           'region_code'=>'008',
           'regDesc'=>'Region VIII (Eastern Visayas)'
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'009',
           'regDesc'=>'Region IX (Zamboanga Peninsula)'
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'010',
           'regDesc'=>'Region X (Northern Mindanao)'
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'011',
           'regDesc'=>'Region XI (Davao Region) '
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'012',
           'regDesc'=>'Region XII (SOCCSKSARGEN)'
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'016',
           'regDesc'=>'Region XIII (Caraga)'
          ),
        array(
           'island_id'=>"3",
           'region_code'=>'015',
           'regDesc'=>'Autonomous Region in Muslim Mindanao (ARMM)'
          ),
        );

      $this->db->insert_batch('islands',$data);
    }

    public function down()
    { 
      $this->db->delete('islands',array('region_code'=>"013"));
      $this->db->delete('islands',array('region_code'=>"014"));
      $this->db->delete('islands',array('region_code'=>"001"));
      $this->db->delete('islands',array('region_code'=>"002"));
      $this->db->delete('islands',array('region_code'=>"003"));
      $this->db->delete('islands',array('region_code'=>"004"));
      $this->db->delete('islands',array('region_code'=>"005"));
      $this->db->delete('islands',array('region_code'=>"017"));
      $this->db->delete('islands',array('region_code'=>"006"));
      $this->db->delete('islands',array('region_code'=>"007"));
      $this->db->delete('islands',array('region_code'=>"008"));
      $this->db->delete('islands',array('region_code'=>"009"));
      $this->db->delete('islands',array('region_code'=>"010"));
      $this->db->delete('islands',array('region_code'=>"011"));
      $this->db->delete('islands',array('region_code'=>"012"));
      $this->db->delete('islands',array('region_code'=>"016"));
      $this->db->delete('islands',array('region_code'=>"015"));
    }
}
?>