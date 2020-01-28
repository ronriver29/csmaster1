<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function add_member($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('members',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function edit_member($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->replace('members',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_member($data){
    $this->db->trans_begin();
    $this->db->delete('members',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
    }else{
      echo 'success';
      $this->db->trans_commit();
    }
  }
  public function get_all_member(){
    $query = $this->db->get('members');
    $data = $query->result();
    return $data;
  }
}
