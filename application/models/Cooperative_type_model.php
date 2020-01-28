<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperative_Type_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function all_cooperative_types(){
    $this->db->order_by('name', 'ASC');
    $query = $this->db->get('cooperative_type');
    return $query->result_array();
  }
  public function get_cooperative_type($act_subtype_id){
    $this->db->select('cooperative_type.name as coop_name');
    $this->db->from('cooperative_type');
    $this->db->join('business_activity_subtype', 'cooperative_type.id = business_activity_subtype.cooperative_type_id');
    $this->db->where('business_activity_subtype.id', $act_subtype_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function get_cooperative_type_name_by_id($type_id){
    $type_id = $this->security->xss_clean($type_id);
    $query = $this->db->get_where('cooperative_type',array('id'=>$type_id));
    return $query->row();
  }
}
