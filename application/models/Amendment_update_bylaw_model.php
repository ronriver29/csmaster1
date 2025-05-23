<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_update_bylaw_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_bylaw_by_coop_id($amendment_id){
   $data =null;
    $data_amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$data_amendment_id));
    if($query->num_rows()==1)
    {
      $data = $query->row();
    }
    unset($data_amendment_id);
    unset($query);
    unset($amendment_id);
    return $data;
  }
  public function update_bylaw_primary($bylaw_coop_id,$bylaw_info){
    $bylaw_coop_id = $this->security->xss_clean($bylaw_coop_id);
    $bylaw_info = $this->security->xss_clean($bylaw_info);
   
    /*check record first if existing if not then create*/
    $get_record = $this->db->where("amendment_id",$bylaw_coop_id)->get("amendment_bylaws");
    if($get_record->num_rows()==0) {
        $this->db->insert('amendment_bylaws', array('amendment_id'=>$bylaw_coop_id));
        $this->db->trans_commit();
    }
    $this->db->trans_begin();

    $this->db->where('amendment_id', $bylaw_coop_id);
    $this->db->update('amendment_bylaws',$bylaw_info);
    if( $bylaw_info['kinds_of_members'] ==1)
    {
      $this->db->delete('amendment_cooperators',array('amendment_id'=>$bylaw_coop_id,'type_of_member'=>'Associate'));
      $this->db->where('amendment_id',$bylaw_coop_id);
      $this->db->update('amendment_capitalization',array('associate_members'=>''));
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_bylaw_primary_complete($bylaw_coop_id,$amendment_id){
    $data = array();
    $counter = 0;
    $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$amendment_id,'cooperatives_id'=>$bylaw_coop_id));
    if($query->num_rows()>0) {
        $data = $query->row();
    }
    if(isset($data->id)) {
        foreach ($data as $key => $value){
          if(empty($value)) $counter++;
        }
        if($data->kinds_of_members==1){
          if($counter<=14){
            if($this->ga_venue($amendment_id))
            {
              return true;
            }
            
          }else{
            return false;
          }
        }else{
          if($counter<=14){
            if($this->ga_venue($amendment_id))
            {
              return true;
            }
            
          }else{
            return false;
          }
        }
    } else {
        return false;
    }
  }

  //check if there is GA Venue
  public function ga_venue($amendment_id)
  {
    
    $qry =$this->db->query("select annual_regular_meeting_day_venue from amendment_bylaws where amendment_id='$amendment_id'");
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        $venue = $row['annual_regular_meeting_day_venue'];
      }
      if(strlen($venue)>0)
      {
        $data=true;
      }
      else
      {
        $data=false;
      }
    }
    else
    {
      $data= false;
    }
    return $data; 
  }
  // end GA venue

  public function check_minimum_regular_subscription_amendment($ajax){
    $cooperative_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $amendment_id = $this->encryption->decrypt(decrypt_custom($ajax['amendment_id']));
    $this->db->select('amendment_bylaws.regular_percentage_shares_subscription');
    $this->db->from('amendment_bylaws');
    // $this->db->join('amend_coop','amend_coop.id = amendment_bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$cooperative_id,'amendment_id'=>$amendment_id));
    $query = $this->db->get();
    $data = $query->row();return $data;
    // if($data->regular_percentage_shares_subscription <= $ajax['fieldValue']){
    //   return array($ajax['fieldId'],true);
    // }else{
    //   return array($ajax['fieldId'],false);
    // }
  }
  public function check_minimum_regular_subscription($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['coop_id']));
    $this->db->select('amendment_bylaws.regular_percentage_shares_subscription');
    $this->db->from('amendment_bylaws');
    $this->db->join('cooperatives','cooperatives.id = amendment_bylaws.cooperatives_id','inner');
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
    $this->db->select('amendment_bylaws.regular_percentage_shares_pay');
    $this->db->from('amendment_bylaws');
    $this->db->join('amend_coop','amend_coop.id = amendment_bylaws.cooperatives_id','inner');
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
    $this->db->select('amendment_bylaws.regular_percentage_shares_pay');
    $this->db->from('amendment_bylaws');
    $this->db->join('cooperatives','cooperatives.id = amendment_bylaws.cooperatives_id','inner');
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
    $this->db->select('amendment_bylaws.associate_percentage_shares_subscription');
    $this->db->from('amendment_bylaws');
    $this->db->join('cooperatives','cooperatives.id = amendment_bylaws.cooperatives_id','inner');
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
    $this->db->select('amendment_bylaws.associate_percentage_shares_subscription');
    $this->db->from('amendment_bylaws');
    $this->db->join('amend_coop','amend_coop.id = amendment_bylaws.cooperatives_id','inner');
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
   
    $this->db->select('associate_percentage_shares_pay');
    $this->db->from('amendment_bylaws');
    // $this->db->join('cooperatives','cooperatives.id = amendment_bylaws.cooperatives_id','inner');
    $this->db->where(array('cooperatives_id'=>$ajax['cooperative_id'],'amendment_id'=>$ajax['amendment_id'],'id'=>$ajax['cooperatorID']));
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
    $this->db->update('amendment_bylaws',$bylaw_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
