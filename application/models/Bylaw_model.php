<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bylaw_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_bylaw_by_coop_id($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('bylaws',array('cooperatives_id'=>$data));
    return $query->row();
  }
  public function update_bylaw_primary($bylaw_coop_id,$bylaw_info){
    $bylaw_coop_id = $this->security->xss_clean($bylaw_coop_id);
    $bylaw_info = $this->security->xss_clean($bylaw_info);
    $this->db->trans_begin();
    $this->db->where('cooperatives_id', $bylaw_coop_id);
    $this->db->update('bylaws',$bylaw_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_bylaw_primary_complete($bylaw_coop_id){
    $counter = 0;
    $query = $this->db->get_where('bylaws',array('cooperatives_id'=>$bylaw_coop_id));
    $data = $query->row();
    foreach ($data as $key => $value){
      if(empty($value)) $counter++;
    }
    if($data->kinds_of_members==1){
      if($counter<=13){
        return true;
      }else{
        return false;
      }
    }else{
      if($counter<=11){
        return true;
      }else{
        return false;
      }
    }
  }
  public function check_minimum_regular_subscription_amendment($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.regular_percentage_shares_subscription');
    $this->db->from('bylaws');
    $this->db->join('amend_coop','amend_coop.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->regular_percentage_shares_subscription <= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_regular_subscription($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.regular_percentage_shares_subscription');
    $this->db->from('bylaws');
    $this->db->join('cooperatives','cooperatives.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->regular_percentage_shares_subscription <= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_regular_pay_amendment($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.regular_percentage_shares_pay');
    $this->db->from('bylaws');
    $this->db->join('amend_coop','amend_coop.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->regular_percentage_shares_pay<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_regular_pay($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.regular_percentage_shares_pay');
    $this->db->from('bylaws');
    $this->db->join('cooperatives','cooperatives.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->regular_percentage_shares_pay<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_subscription($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.associate_percentage_shares_subscription');
    $this->db->from('bylaws');
    $this->db->join('cooperatives','cooperatives.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->associate_percentage_shares_subscription <= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_subscription_amendment($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.associate_percentage_shares_subscription');
    $this->db->from('bylaws');
    $this->db->join('amend_coop','amend_coop.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->associate_percentage_shares_subscription <= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_minimum_associate_pay($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('bylaws.associate_percentage_shares_pay');
    $this->db->from('bylaws');
    $this->db->join('cooperatives','cooperatives.id = bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$decoded_id));
    $query = $this->db->get();
    $data = $query->row();
    if($data->associate_percentage_shares_pay<= $ajax['fieldValue']){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function update_bylaw_union($bylaw_coop_id,$bylaw_info){
    $bylaw_id = $this->security->xss_clean($bylaw_coop_id);
    $bylaw_info = $this->security->xss_clean($bylaw_info);
    $this->db->trans_begin();
    $this->db->where('cooperatives_id', $bylaw_coop_id);
    $this->db->update('bylaws',$bylaw_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
