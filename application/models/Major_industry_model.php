<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_Industry_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_major_industries($coop_type_id){
    $this->db->order_by('description', 'ASC');
    $this->db->distinct();
    $this->db->select('major_industry.id,major_industry.description');
    $this->db->from('industry_subclass_by_coop_type');
    $this->db->join('cooperative_type' , 'cooperative_type.id = industry_subclass_by_coop_type.cooperative_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id');
    $this->db->where('cooperative_type.id', $coop_type_id);
    $query = $this->db->get();
    return $query->result_array();
  }
  
  public function get_major_industries_by_type_name($coop_type){
    $this->db->order_by('description', 'ASC');
    $this->db->distinct();
    $this->db->select('major_industry.id,major_industry.description');
    $this->db->from('industry_subclass_by_coop_type');
    $this->db->join('cooperative_type' , 'cooperative_type.id = industry_subclass_by_coop_type.cooperative_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id');
    $this->db->where('cooperative_type.name', $coop_type);
    $query = $this->db->get();
    return $query->result_array();
  }
}
