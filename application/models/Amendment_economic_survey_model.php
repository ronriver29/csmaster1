<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_economic_Survey_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_economic_survey_by_coop_id($amendment_id){
    $data = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_economic_survey',array('amendment_id'=>$data));
    return $query->row();
  }
  public function get_economic_survey_by_coop_id_amend($amendment_id){
    $data = $this->security->xss_clean($amendment_id);
    $query = $this->db->where('amendment_id',$data)
    ->from('amendment_economic_survey');
    return $query->count_all_results();
  }

  public function insert_economic_survey($amendment_id,$survey_info){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $survey_info = $this->security->xss_clean($survey_info);
    $this->db->trans_begin();
    $this->db->where('amendment_id', $amendment_id);
    $this->db->insert('amendment_economic_survey',$survey_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function update_economic_survey($amendment_id,$survey_info){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $survey_info = $this->security->xss_clean($survey_info);
    $this->db->trans_begin();
    $this->db->where('amendment_id', $amendment_id);
    $this->db->update('amendment_economic_survey',$survey_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function check_survey_complete($amendment_id){
    $counter = 0;
    $query = $this->db->get_where('amendment_economic_survey',array('amendment_id'=>$amendment_id));
    if($query->num_rows()>0) {
        $data = $query->row();
        foreach ($data as $key => $value){
          if(empty($value)) $counter++;
        }
        if($counter<=14){
          return true;
        }else{
          return false;
        }
    } else {
        return false;
    }
  }
}
