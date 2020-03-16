<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capitalization_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
//    $this->load->database();
  }
  public function get_capitalization_by_coop_id($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('capitalization',array('cooperatives_id'=>$data));
    return $query->row();
  }
  public function update_capitalization($capitalization_coop_id,$capitalization_info){
      $capitalization_coop_id = $this->security->xss_clean($capitalization_coop_id);
      $capitalization_info = $this->security->xss_clean($capitalization_info);
      $query = $this->db->where('cooperatives_id', $capitalization_coop_id)->get('capitalization');
      if($query->num_rows()>0) {
        $this->db->trans_begin();
        $this->db->where('cooperatives_id', $capitalization_coop_id);
        $this->db->update('capitalization',$capitalization_info);
      } else {
         $capitalization_info['cooperatives_id'] = $capitalization_coop_id;
        $this->db->trans_begin();
        $this->db->insert('capitalization',$capitalization_info);
      }
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }
  }
  public function check_capitalization_primary_complete($capitalization_coop_id){
    $counter = 0;
    $query_bylaws = $this->db->get_where('bylaws',array('cooperatives_id'=>$capitalization_coop_id));
    $data_bylaws = $query_bylaws->row();
    $query = $this->db->get_where('capitalization',array('cooperatives_id'=>$capitalization_coop_id));
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
    $this->db->select('capitalization.minimum_subscribed_share_regular,capitalization.total_no_of_subscribed_capital');
    $this->db->from('capitalization');
    $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_subscribed_share_regular <= $ajax['fieldValue'] && $data->total_no_of_subscribed_capital * 0.10 >= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_regular_pay($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('capitalization.minimum_paid_up_share_regular');
    $this->db->from('capitalization');
    $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_paid_up_share_regular<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_subscription($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('capitalization.minimum_subscribed_share_associate,capitalization.total_no_of_subscribed_capital');
    $this->db->from('capitalization');
    $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_subscribed_share_associate <= $ajax['fieldValue'] && $data->total_no_of_subscribed_capital*0.10 >= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  
  public function check_minimum_associate_pay($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('capitalization.minimum_paid_up_share_associate');
    $this->db->from('capitalization');
    $this->db->join('cooperatives','cooperatives.id = capitalization.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->minimum_paid_up_share_associate<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  
    public function update_capitalization_member($coop_id,$field_data){
    $this->db->where(array('cooperatives_id'=>$coop_id));
    $this->db->update('capitalization',$field_data);
  }
  
}
