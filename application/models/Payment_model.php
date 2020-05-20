<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function pay_offline($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('id',$cooperatives_id);
    $this->db->update('cooperatives',array('expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60))),'status'=>13));
    
    return true;
  }

  public function pay_online($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('id',$cooperatives_id);
    $this->db->update('cooperatives',array('status'=>14));
    
    return true;
  }

  public function check_payment_not_exist($data){
    $data = $this->security->xss_clean($data);
    $this->db->select ('*');
    $this->db->from ('payment');
    $this->db->where('payor',$data['payor']);
    $this->db->where('nature',$data['nature']);
    $this->db->where('amount',$data['amount']);
    
    $query = $this->db->get();

    if ($query->num_rows()==0) 
      return true;
    else
      return false;
            
  }

  public function check_payment_not_exist_amendment($data){
    $data = $this->security->xss_clean($data);
    $this->db->select ('*');
    $this->db->from ('payment');
    // $this->db->where('payor',$data['payor']);
    // $this->db->where('nature',$data['nature']);
    // $this->db->where('amount',$data['amount']);
    $this->db->where('amendment_id',$data['amendment_id']);

    
    $query = $this->db->get();

    if ($query->num_rows()==0) 
      return true;
    else
      return false;
            
  }

  public function get_payment_info($data){
    $data = $this->security->xss_clean($data);
    $this->db->select ('*');
    $this->db->from ('payment');
    $this->db->where('payor',$data['payor']);
    $this->db->where('nature',$data['nature']);
    $this->db->where('amount',$data['amount']);
    
    $query = $this->db->get();

    return $query->row();

            
  }
   public function get_payment_info_amendment($data){
    $data = $this->security->xss_clean($data);
    $this->db->select ('*');
    $this->db->from ('payment');
    // $this->db->where('payor',$data['payor']);
    // $this->db->where('nature',$data['nature']);
    // $this->db->where('amount',$data['amount']);
    $this->db->where('amendment_id',$data['amendment_id']);
    
    $query = $this->db->get();

    return $query->row();
  }


  public function save_payment($data,$rCode){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('payment',$data);
    // return $this->db->last_query();
    $x=$this->get_payment_info($data)->id;
    
    $j=$rCode;
        $year = date('y');
    $month = date('m');
    $day = date('d');
    for($a=strlen($x);$a<5;$a++)
      $j=$j.'0';
    $j=$year.$month.$day.$j.$x;

    $data2=array('transactionNo'=>$j);

    $this->update_payment($data,$data2);
    if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
    }
    else
    {
      $this->db->trans_commit();
      return true;
    }
    
  }

  public function update_payment($data,$data2){
    $data = $this->security->xss_clean($data);
    $this->db->where('payor',$data['payor']);
    $this->db->where('nature',$data['nature']);
    $this->db->where('amount',$data['amount']);
    
    $this->db->update('payment',$data2);
    
    return true;
  }
  
  public function pay_offline_amendment($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('id',$cooperatives_id);
    $this->db->update('amend_coop',array('status'=>13));
    
    return true;
  }

}
