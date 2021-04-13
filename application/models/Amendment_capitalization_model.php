<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_capitalization_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
//    $this->load->database();
  }
  public function get_capitalization_by_coop_id($coop_id,$amendment_id){
    $data_coop_id = $this->security->xss_clean($coop_id);
     $data_amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_capitalization',array('cooperatives_id'=>$data_coop_id,'amendment_id'=>$data_amendment_id));
    return $query->row();
  }
  public function amend_get_capitalization_by_coop_id($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('amendment_capitalization',array('cooperatives_id'=>$data));
    return $query->row();
  }
  public function amend_get_capitalization_by_coop_id_count($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('amendment_capitalization',array('cooperatives_id'=>$data));
    return $query->num_rows();
  }
  //  public function get_capitalization_by_coop_id($amendment_id){
  //   $data = $this->security->xss_clean($amendment_id);
  //   $query = $this->db->get_where('amendment_capitalization',array('amendment_id'=>$data));
  //   return $query->row();
  // }
  // public function update_capitalization($capitalization_coop_id,$capitalization_info){
  //     $capitalization_coop_id = $this->security->xss_clean($capitalization_coop_id);
  //     $capitalization_info = $this->security->xss_clean($capitalization_info);
  //     $query = $this->db->where('cooperatives_id', $capitalization_coop_id)->get('amendment_capitalization');
  //     if($query->num_rows()>0) {
  //       $this->db->trans_begin();
  //       $this->db->where('cooperatives_id', $capitalization_coop_id);
  //       $this->db->update('amendment_capitalization',$capitalization_info);
  //     } else {
  //        $capitalization_info['cooperatives_id'] = $capitalization_coop_id;
  //       $this->db->trans_begin();
  //       $this->db->insert('amendment_capitalization',$capitalization_info);
  //     }
  //       if($this->db->trans_status() === FALSE){
  //         $this->db->trans_rollback();
  //         return false;
  //       }else{
  //         $this->db->trans_commit();
  //         return true;
  //       }
  // }
  public function update_capitalization($amendment_id,$capitalization_coop_id,$capitalization_info){
      $capitalization_coop_id = $this->security->xss_clean($capitalization_coop_id);
      $capitalization_info = $this->security->xss_clean($capitalization_info);
        $amendment_id = $this->security->xss_clean($amendment_id);
      $query= $this->db->get_where('amendment_capitalization',array('cooperatives_id'=>$capitalization_coop_id,'amendment_id'=>$amendment_id));
      if($query->num_rows()>0)
       {
        $this->db->trans_begin();
        $this->db->where('cooperatives_id', $capitalization_coop_id);
        $this->db->where('amendment_id',$amendment_id);
        $this->db->update('amendment_capitalization',$capitalization_info);
      } 
      // return $capitalization_info;
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }
  }
  public function check_capitalization_primary_complete($capitalization_coop_id,$amendment_id){
    $counter = 0;
    $query_bylaws = $this->db->get_where('amendment_bylaws',array('cooperatives_id'=>$capitalization_coop_id,'amendment_id'=>$amendment_id));
    $data_bylaws = $query_bylaws->row();
    $query = $this->db->get_where('amendment_capitalization',array('cooperatives_id'=>$capitalization_coop_id,'amendment_id'=>$amendment_id));
    if($query->num_rows()>0) {
     $data = $query->row();
        $required_fields = array(
            "regular_members",
            "authorized_share_capital",
            "par_value",
            "common_share",
            "total_amount_of_subscribed_capital",
            "total_no_of_subscribed_capital",
            "total_amount_of_paid_up_capital",
            "total_no_of_paid_up_capital",
            "minimum_subscribed_share_regular",
            "minimum_paid_up_share_regular",
            );
        if($data_bylaws->kinds_of_members==2){
            $required_fields[] = "associate_members";
            $required_fields[] = "preferred_share";
            $required_fields[] = "minimum_subscribed_share_associate";
            $required_fields[] = "minimum_paid_up_share_associate";
        }
        foreach ($required_fields as $field){
          if($data->$field=="") $counter++;
        }
        if($counter==0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
  }
 
  public function check_minimum_regular_subscription($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $amendment_id = $this->encryption->decrypt(decrypt_custom($ajax['amendment_id']));
    $this->db->select('minimum_subscribed_share_regular,total_no_of_subscribed_capital');
    $this->db->from('amendment_capitalization');
    // $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id,'amendment_id'=>$amendment_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_subscribed_share_regular <= $ajax['fieldValue'] && $data->total_no_of_subscribed_capital * 0.10 >= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function check_minimum_regular_pay($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['amendment_id']));
    $this->db->select('amendment_capitalization.minimum_paid_up_share_regular');
    $this->db->from('amendment_capitalization');
    // $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('amendment_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_paid_up_share_regular<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_subscription($ajax){
    // $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('minimum_subscribed_share_associate');
    $this->db->from('amendment_capitalization');
    // $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$ajax['cooperative_id'],'amendment_id'=>$ajax['amendment_id']));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_subscribed_share_associate <= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_pay($ajax){
    $this->db->select('minimum_paid_up_share_associate');
    $this->db->from('amendment_capitalization');
    // $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$ajax['cooperative_id'],'amendment_id'=>$ajax['amendment_id']));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_paid_up_share_associate<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  
}
