<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class coop_tool_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function edit_data($data,$id){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->update('cooperatives', $data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function edit_branch($data,$id){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->update('branches', $data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function edit_data_amendment($data,$id){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->update('amend_coop', $data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
