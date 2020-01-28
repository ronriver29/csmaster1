<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function all_cities(){
    $query = $this->db->get('refcitymun');
    return $query->result_array();
  }

  public function get_cities($data){
      $query= $this->db->get_where('refcitymun', array('provCode' => $data));
      return $query->result_array();
  }

}
