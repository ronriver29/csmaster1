<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function all_provinces(){
    $query = $this->db->get('refprovince');
    return $query->result_array();
  }

  public function get_provinces($data){
      $query= $this->db->get_where('refprovince', array('regCode' => $data));
      return $query->result_array();
  }
}
