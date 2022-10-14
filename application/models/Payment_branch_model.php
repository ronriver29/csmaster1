<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_branch_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function pay_offline($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('branches',array('status'=>19));
    
    return true;
  }

  public function pay_offline_conversion($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('branches',array('status'=>66));
    
    return true;
  }

  public function pay_offline_transfer($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('branches',array('status'=>52));
    
    return true;
  }

  public function pay_online($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('branches',array('status'=>19));
    
    return true;
  }

  public function update_payment_online($bns_id,$merchantrefno){

    $bns_id = $this->security->xss_clean($bns_id);
    $merchantrefno = $this->security->xss_clean($merchantrefno);

    $this->db->where('bns_id',$bns_id);
    $this->db->update('payment',array('merchantrefno' => $merchantrefno));
    return true;

  }

  public function update_payment_online_lab($lab_id,$merchantrefno){

    $lab_id = $this->security->xss_clean($lab_id);
    $merchantrefno = $this->security->xss_clean($merchantrefno);

    $this->db->where('lab_id',$lab_id);
    $this->db->update('payment',array('merchantrefno' => $merchantrefno));
    return true;

  }

  public function check_payment_not_exist($data){
    $data = $this->security->xss_clean($data);
    $this->db->select ('*');
    $this->db->from ('payment');
    $this->db->where('payor',$data['payor']);
    $this->db->where('nature',$data['nature']);
    $this->db->where('amount',$data['amount']);
    $this->db->where('bns_id',$data['bns_id']);
    
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

    public function save_payment($data,$rCode){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('payment',$data);
    
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
    $this->db->trans_commit();

    return true;
  }

  public function update_payment($data,$data2){
    $data = $this->security->xss_clean($data);
    $this->db->where('payor',$data['payor']);
    $this->db->where('nature',$data['nature']);
    $this->db->where('amount',$data['amount']);
    
    $this->db->update('payment',$data2);
    
    return true;
  }
  
  public function pay_offline_laboratories($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('laboratories',array('status'=>19));
    
    return true;
  }
  
  public function pay_online_laboratories($branch_id){
    $branch_id = $this->security->xss_clean($branch_id);
    $this->db->where('id',$branch_id);
    $this->db->update('laboratories',array('status'=>19));
    
    return true;
  }

  public function check_payment_not_exist_laboratories($data){
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
}
