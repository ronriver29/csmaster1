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
    if($query->num_rows()>0)
    {
       return $query->row();
    }else{return null;}
   
  }

  public function get_selected_regions($data){
      // $query= $this->db->get_where('islands', array('island_id' => $data));
      $query = $this->db->query("SELECT * FROM refregion WHERE regCode IN (".$data.") ORDER BY regDesc ASC");
      return $query->result_array();
  }

  public function get_selected_islands($data){
      // $query= $this->db->get_where('islands', array('island_id' => $data));
      if(strlen($data)>0)
      {
         $query = $this->db->query("SELECT * FROM islands WHERE island_id IN (".$data.") ORDER BY regDesc ASC");
      }
      else
      {
         $query = $this->db->query("SELECT * FROM islands ORDER BY regDesc ASC");
      }
     
      return $query->result_array();
  }

}
