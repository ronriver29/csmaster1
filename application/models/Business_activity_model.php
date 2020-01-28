<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_Activity_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_business_activities(){
    $this->db->order_by('name', 'ASC');
    $query = $this->db->get('business_activity');
    return $query->result_array();
  }
}
