<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_Subclass_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_industry_subclasses($coop_type_id,$major_industry_id){
    $this->db->order_by('description', 'ASC');
    $this->db->distinct();
    $this->db->select('subclass.id,subclass.description');
    $this->db->from('industry_subclass_by_coop_type');
    $this->db->join('cooperative_type' , 'cooperative_type.id = industry_subclass_by_coop_type.cooperative_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id');
    $this->db->where(array('cooperative_type.id'=>$coop_type_id,'major_industry.id'=>$major_industry_id));
    $query = $this->db->get();
    return $query->result_array();
  }

}
