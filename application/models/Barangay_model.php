<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangay_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More\
    $this->load->database();
  }
  public function all_barangays(){
    $query = $this->db->get('refbrgy');
    return $query->result_array();
  }
  public function get_barangays($cities){
    $query= $this->db->get_where('refbrgy', array('citymunCode' => $cities));
    return $query->result_array();
  }
}
