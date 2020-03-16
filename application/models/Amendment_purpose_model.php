<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_purpose_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_all_purposes($cooperatives_id,$amendment_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
     $amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id));
    foreach($query->result_array() as $row)
    {
      $data[] = $row;
    }
    return $data;
  }
  public function edit_purposes($amendment_id,$id,$data){
    $data = $this->security->xss_clean($data);
    $array_data = array(
                'content'=>$data
    );
    $this->db->trans_begin();
    $this->db->update('amendment_purposes',$array_data,array('amendment_id'=>$amendment_id,'id'=>$id));
    // $this->db->where('amendment_id', $amendment_id);
    // $this->db->where('id',$id);
    // $this->db->update('amendment_purposes',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_not_null($cooperatives_id,$amendment_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $amendment_id = $this->security->xss_clean($amendment_id );
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id));
    $data = $query->row();
    if(strlen($data->content) > 0){
      return true;
    }else{
      return false;
    }
  }
  public function check_blank_not_exists($cooperatives_id,$amendment_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_purposes',array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id));
    $data = $query->row();
    if(strpos($data->content,'_') === false){
      return true;
    }else{
      return false;
    }
  }
  public function check_purpose_complete($cooperatives_id,$amendment_id){
    if($this->check_not_null($cooperatives_id,$amendment_id) && $this->check_blank_not_exists($cooperatives_id,$amendment_id)){
      return true;
    }else{
      return false;
    }
  }
}
