<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_uploaded_document_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function add_document_info($branchID,$coopid,$docnum,$filename){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->delete('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum));
    $this->db->insert('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum,'filename'=>$filename));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function get_document_one_info($coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('cooperatives_id'=>$coopid,'document_num'=>1));
    $data = $query->row();
    return $data;
  }
  public function get_document_two_info($coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('cooperatives_id'=>$coopid,'document_num'=>2));
    $data = $query->row();
    return $data;
  }
  public function get_document_5_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>5));
    $data = $query->row();
    return $data;
  }
  public function get_document_6_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>6));
    $data = $query->row();
    return $data;
  }
  public function get_document_7_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>7));
    $data = $query->row();
    return $data;
  }
  public function get_document_8_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>8));
    $data = $query->row();
    return $data;
  }
  public function get_document_9_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('amendment_uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>9));
    $data = $query->row();
    return $data;
  }
  
  public function check_document_of_cooperative($branchID,$coopid,$document_num,$filename){
    $coopid = $this->security->xss_clean($coopid);
    $filename = $this->security->xss_clean($filename);
    $this->db->where(array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$document_num,'filename'=>$filename));
    $this->db->from('amendment_uploaded_documents');
    $count = $this->db->count_all_results();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }
}
