<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Island_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function all_islands(){
    $query = $this->db->get('islands');
    return $query->result_array();
  }

  public function get_islands($data){
      // $query= $this->db->get_where('islands', array('island_id' => $data));
      $query = $this->db->query("SELECT * FROM islands WHERE island_id IN (".$data.") ORDER BY regDesc ASC");
      return $query->result_array();

  }
}
