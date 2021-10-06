<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
    $this->load->library('email');
  }

  public function get_api_config_info(){
    // $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('api_settings');
    $row = $query->row();
    return $row;
  }

  public function update_api($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->update('api_settings',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function get_sms_primary(){
    $this->db->select('*');
    $this->db->from('sms_actions_allowed');
    $this->db->where(array('category =' => 'primary'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_sms_bns_inside(){
    $this->db->select('*');
    $this->db->from('sms_actions_allowed');
    $this->db->where(array('category =' => 'branch_inside'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_sms_bns_outside(){
    $this->db->select('*');
    $this->db->from('sms_actions_allowed');
    $this->db->where(array('category =' => 'branch_outside'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_sms_laboratories(){
    $this->db->select('*');
    $this->db->from('sms_actions_allowed');
    $this->db->where(array('category =' => 'laboratories'));
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_sms_amendment(){
    $this->db->select('*');
    $this->db->from('sms_actions_allowed');
    $this->db->where(array('category =' => 'amendment'));
    $query = $this->db->get();
    return $query->result_array();
  }
  
  public function get_all_messages(){
    $this->db->select('*');
    $this->db->from('sms_messages');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_all_blocked_no(){
    $this->db->select('*');
    $this->db->from('sms_blocked_no');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function update_sms_allowed_actions_primary($data,$id){
    $data = $this->security->xss_clean($data);
    $id = $this->security->xss_clean($id);
    $this->db->trans_begin();
    $this->db->where('actionid',$id);
    $this->db->update('sms_actions_allowed',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function add_blocked_no($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('sms_blocked_no',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function edit_blocked_no($data,$id){
    $data = $this->security->xss_clean($data);
    $id = $this->security->xss_clean($id);
    $this->db->trans_begin();
    $this->db->where('id',$id);
    $this->db->update('sms_blocked_no',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function delete_blocked_no($aid){
    $aid = $this->security->xss_clean($aid);
    $this->db->trans_begin();
    $this->db->delete('sms_blocked_no',array('id' => $aid));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

}
?>