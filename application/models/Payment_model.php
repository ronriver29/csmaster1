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

  public function check_payment_not_exist_amendment($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->select ('*');
    $this->db->from ('payment');
    // $this->db->where('payor',$data['payor']);
    // $this->db->where('nature',$data['nature']);
    // $this->db->where('amount',$data['amount']);
    $this->db->where('amendment_id',$amendment_id);

    
    $query = $this->db->get();

    if ($query->num_rows()>0) 
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
   public function get_payment_info_amendment($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $data =null;
    $this->db->select ('*');
    $this->db->from ('payment');
    // $this->db->where('payor',$data['payor']);
    // $this->db->where('nature',$data['nature']);
    // $this->db->where('amount',$data['amount']);
    $this->db->where('amendment_id',$amendment_id);
    
    $query = $this->db->get();
    if($query->num_rows()>0)
    {
      $data=$query->row();
    }
    return $data;
    
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

  public function update_payment_amendment($data,$rCode,$amendment_id){
    $data = $this->security->xss_clean($data);
    
    // return $this->db->last_query();
    $x=$this->get_payment_info_amendment($amendment_id)->id;
    
    $j=$rCode;
        $year = date('y');
    $month = date('m');
    $day = date('d');
    for($a=strlen($x);$a<5;$a++)
      $j=$j.'0';
    $j=$year.$month.$day.$j.$x;

    $data2=array('transactionNo'=>$j);
    $this->db->trans_begin();
    $this->db->update('payment',$data,array('amendment_id' =>$amendment_id));
     $this->db->update('payment',$data2,array('amendment_id'=>$amendment_id));
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

  public function orderPaymentNo($amendment_id)
  {
    $ref_no ='';
    //check first if exist
    $query = $this->db->query("select refNo from payment where amendment_id = '$amendment_id' and refNo IS NOT NULL and refNo<>'' order by id desc limit 1");
    if($query->num_rows() == 1)
    {
      foreach($query->result() as $row)
      {
        $ref_no = $row->refNo;
        
      }
    }
    else
    {
        $refNo_last='';
        $amendment_info = $this->amendment_model->get_cooperative_info_by_admin($amendment_id);
        $query= $this->db->query("SELECT * FROM `payment` WHERE refNo IS NOT NULL and refNo<>'' order by id desc limit 1");
        foreach($query->result() as $row)
        {
           if(strlen($row->refNo)>0)
           {
              $refNo_last = $row->refNo;
             $last_ref = substr($row->refNo, 11) +1;//strpos($row->refNo, '-');
           }
           else
           {
            $last_ref =1;
           }
        }
          $region_code =substr($amendment_info->rCode,1);
          $present_year =  date('Y',now('Asia/Manila'));
          $last_ref_year =substr($refNo_last,3,-7); //2020;
          if($present_year != $last_ref_year)
          {
            $ref_no = $region_code.'-'.date('Y-m',now('Asia/Manila')).'-1';
          } 
          else
          {
             $ref_no =$region_code.'-'.date('Y-m',now('Asia/Manila')).'-'.$last_ref;
          }
    }  
      return  $ref_no;
  }
}
