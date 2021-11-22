<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
    $this->load->library('email');
  }

  public function getCoop($coopName){
    $this->db->select('regNo');
    $this->db->from('registeredcoop');
    $query= $this->db->where('regNo', $coopName);
    $result = $this->db->get();
	return $result->result_array();
  }

}
?>