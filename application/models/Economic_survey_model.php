<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Economic_Survey_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function get_economic_survey_by_coop_id($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('economic_survey',array('cooperatives_id'=>$data));
    return $query->row();
  }

  public function update_economic_survey($survey_coop_id,$survey_info){
    $survey_coop_id = $this->security->xss_clean($survey_coop_id);
    $survey_info = $this->security->xss_clean($survey_info);
    $this->db->trans_begin();
    $this->db->where('cooperatives_id', $survey_coop_id);
    $this->db->update('economic_survey',$survey_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

//modify by json
//  public function check_survey_complete($survey_coop_id){
//    $query = $this->db->get_where('economic_survey',array('cooperatives_id'=>$survey_coop_id));
//    if($query->num_rows()>0) {
//       return true;
//    } else {
//        return false;
//    }
//  } 
   public function check_survey_complete($survey_coop_id){
     $counter = 0;
     $query = $this->db->get_where('economic_survey',array('cooperatives_id'=>$survey_coop_id));
     if($query->num_rows()>0) {
         $data = $query->row();
         foreach ($data as $key => $value){
           if(empty($value)) $counter++;
         }
         if($counter<=11){
           return true;
         }else{
           return false;
         }
     } else {
         return false;
     }
   }
}
