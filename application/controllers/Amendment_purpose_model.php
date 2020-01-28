<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_purpose_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_all_purposes($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id));
    $data = $query->row();
    return $data;
  }
  public function edit_purposes($coop_id,$data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('cooperatives_id', $coop_id);
    $this->db->update('amendment_purposes',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_not_null($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id));
    $data = $query->row();
    if(strlen($data->content) > 0){
      return true;
    }else{
      return false;
    }
  }
  public function check_blank_not_exists($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id));
    $data = $query->row();
    if(strpos($data->content,'_') === false){
      return true;
    }else{
      return false;
    }
  }
  public function check_purpose_complete($cooperatives_id){
    if($this->check_not_null($cooperatives_id) && $this->check_blank_not_exists($cooperatives_id)){
      return true;
    }else{
      return false;
    }
  }
}
