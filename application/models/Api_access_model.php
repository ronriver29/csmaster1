<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_access_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
 
  public function update($data)
  {
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->update('api_data_access',$data,array('table'=>$data['table']));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function remove($id)
  {
    $this->db->trans_begin();
    $this->db->update('api_data_access',array('active'=>0),array('id'=>$id));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function get_access()
  {
    $data =null;
    $query  = $this->db->query("select * from api_data_access order by alias asc");
    if($query->num_rows()>0)
    {
      $data= $query->result_array();
    }
    return $data;
  }
}
