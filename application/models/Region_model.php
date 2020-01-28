<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_regions(){
    $this->db->select('regDesc,regCode');
    $query = $this->db->get('refregion');
    return $query->result_array();
  }
  public function get_region_by_code($regCode){
    $this->db->select('regDesc,regCode');
    $this->db->where('regCode',$regCode);
    $query = $this->db->get('refregion');
    return $query->row();
  }

}
