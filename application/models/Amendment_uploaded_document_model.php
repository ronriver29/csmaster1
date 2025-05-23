<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_uploaded_document_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function add_document_info($branchID,$coopid,$docnum,$filename,$status){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->delete('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum));
    $this->db->insert('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum,'filename'=>$filename,'status'=>$status));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function add_document_info_amendment($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
     // $this->db->delete('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum));

    $this->db->insert('amendment_uploaded_documents',$data);
   //  $last_id = $this->db->insert_id() ;
   // $new_file_name = $last_id.'_'.$filename;
   //  $data_new= array('filename'=>$new_file_name);
   //  $this->db->update('uploaded_documents',$data_new,array('id'=>$last_id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  //modify json
  public function upload_lab_document($coopID,$labID,$doc_num,$filename)
  {
      $data= array(
                    'cooperatives_id'=>$coopID,
                    'laboratory_id'=>$labID,
                    'branch_id'=>0,
                    'document_num'=>$doc_num,
                    'filename' =>$filename,
                    'status'=>1,
                    'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))
      );

      $this->db->trans_begin();
      $this->db->insert('uploaded_documents',$data);

      if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
  }

   //modify by json
  public function add_document_info_($branchID,$coopid,$docnum,$filename,$status){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
     // $this->db->delete('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum));

    $this->db->insert('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$docnum,'filename'=>$filename,'status'=>$status,'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))));
   //  $last_id = $this->db->insert_id() ;
   // $new_file_name = $last_id.'_'.$filename;
   //  $data_new= array('filename'=>$new_file_name);
   //  $this->db->update('uploaded_documents',$data_new,array('id'=>$last_id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function check_is_uploaded($amendment_id,$doc_num)
  {
     $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>$doc_num));
     if($query->num_rows() >= 1)
     {
      return true;
     }
     else
     {
      return false;
     }
  }

  public function get_document_info($amendment_id,$doc_num)
  {
    $data =NULL;
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>$doc_num));
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data[] = $row;
      }
    }
    return $data;
  }
  public function get_document_one_info($amendment_id){
    $amendment_id= $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>1));
    $data = $query->row();
    return $data;
  }

  public function get_document_two_info($amendment_id){
   $amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>2));
    $data = $query->row();
    return $data;
  }
  public function get_document_5_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>5));
    $data = $query->row();
    return $data;
  }
  public function get_document_6_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>6));
    $data = $query->row();
    return $data;
  }
  public function get_document_7_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>7));
    $data = $query->row();
    return $data;
  }
  public function get_document_8_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>8));
    $data = $query->row();
    return $data;
  }
  public function get_document_9_info($branchID,$coopid){
    $coopid = $this->security->xss_clean($coopid);
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>9));
    $data = $query->row();
    return $data;
  }
  
  public function check_document_of_cooperative($branchID,$coopid,$document_num,$filename){
    $coopid = $this->security->xss_clean($coopid);
    $filename = $this->security->xss_clean($filename);
    $this->db->where(array('branch_id'=>$branchID,'cooperatives_id'=>$coopid,'document_num'=>$document_num,'filename'=>$filename));
    $this->db->from('uploaded_documents');
    $count = $this->db->count_all_results();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }
  ///modify
  public function check_document_of_cooperative_2($branchID,$labID,$document_num,$filename){
    $labID = $this->security->xss_clean($labID);
    $filename = $this->security->xss_clean($filename);
    $this->db->where(array('branch_id'=>$branchID,'laboratory_id'=>$labID,'document_num'=>$document_num,'filename'=>$filename));
    $this->db->from('uploaded_documents');
    $count = $this->db->count_all_results();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }
}
