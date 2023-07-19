<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperatives_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_coop_composition($id){
    $this->db->select('composition_of_members.composition');
    $this->db->from('members_composition_of_cooperative');
    $this->db->join('composition_of_members','members_composition_of_cooperative.composition=composition_of_members.id','inner');
    $this->db->where('members_composition_of_cooperative.coop_id',$id);
    $query = $this->db->get();

    return $query->result_array();
  }
  public function get_composition(){
    $this->db->from('composition_of_members');
    $this->db->order_by('composition ASC');
    $query = $this->db->get();

    return $query->result();
  }
  public function get_payment_info($coop){
    $this->db->select('*');
    $this->db->from('payment');
    $this->db->where('payor',$coop);
    $this->db->where('nature','Registration');
    $this->db->order_by('id','DESC');
    $query = $this->db->get();
    return $query->row();
  }
  // start modify
public function approve_by_supervisor_laboratories($admin_info,$coop_id,$coop_full_name){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('laboratories.laboratoryName, users.*');
  $this->db->from('laboratories');
  $this->db->join('users' , 'users.id = laboratories.user_id','inner');
  $this->db->where('laboratories.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row();
//  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $update = $this->db->update('laboratories',array('status'=>12,'first_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));

  if($update){
    return true;
  }
  else
  {
    return false;
  }
}
// end modify

  public function save_OR($where, $data, $di,$date_of_or){
    $this->db->trans_begin();
    $this->db->update('cooperatives', array('status'=>14,'date_of_or'=>$date_of_or,'received_trans_receipt'=>date('Y-m-d H:i:s')),array('id'=>$di));
    $this->db->update('payment', $data, $where);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }

  }
  public function fedpayment($payorname){
    $this->db->select('*');
    $this->db->from('payment');
    $this->db->where('payor', $payorname);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_registeredcoop($user_id){
    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where('regNo', $user_id);
    $this->db->limit('1');
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_registeredcoop_coc($user_id){
    $this->db->select('registeredcoop.*,refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,payment.date_of_or');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('payment', 'registeredcoop ON payment.payor = registeredcoop.coopName','inner');
    $this->db->where('registeredcoop.application_id', $user_id);
    $this->db->order_by('registeredcoop.id','DESC');
    $query = $this->db->get();
    return $query->row();
  }

  public function get_all_cooperatives($user_id){
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,payment.payment_option');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('payment' , 'cooperatives.id = payment.cooperatives_id','left');
    $this->db->where('cooperatives.users_id', $user_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_senior_count($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("2","3","4","5","6","16") OR (status = 6 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 12 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 13 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 14 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%")');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    return $this->db->count_all_results();
  }

  public function get_all_cooperatives_ho(){
    $this->db->select('cooperatives.id,cooperatives.proposed_name,cooperatives.type_of_cooperative,cooperatives.acronym_name,cooperatives.grouping, cooperatives.third_evaluated_by,
      cooperatives.house_blk_no,cooperatives.street,cooperatives.status, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('cooperatives.status NOT IN (1,15)');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_ho2($coopName,$limit){
    $this->db->limit($limit);
    $this->db->select('cooperatives.id,cooperatives.proposed_name,cooperatives.type_of_cooperative,cooperatives.acronym_name,cooperatives.grouping, cooperatives.third_evaluated_by,
      cooperatives.house_blk_no,cooperatives.street,cooperatives.status, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('cooperatives.status NOT IN (1,15,39,40) AND cooperatives.proposed_name LIKE "%'.$coopName.'%"');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_ho_count($coopName){
    $this->db->select('cooperatives.id,cooperatives.proposed_name,cooperatives.type_of_cooperative,cooperatives.acronym_name,cooperatives.grouping, cooperatives.third_evaluated_by,
      cooperatives.house_blk_no,cooperatives.street,cooperatives.status, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('cooperatives.status NOT IN (1,15) AND cooperatives.proposed_name LIKE "%'.$coopName.'%"');

    return $this->db->count_all_results();
  }

  public function get_count_cooperatives($user_id){
    $this->db->select('COUNT(*) AS coop_count');
    $this->db->from('cooperatives');
    $this->db->where('users_id', $user_id);
    $query = $this->db->get();
    $data = $query->row();
    return $data;
  }
  public function get_all_cooperatives_by_specialist_count($regcode,$admin_id){
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>3,'evaluated_by'=>$admin_id));

    return $this->db->count_all_results();
  }
  public function get_all_cooperatives_by_specialist2($regcode,$admin_id,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>3,'evaluated_by'=>$admin_id));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_specialist($regcode,$admin_id){
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>3,'evaluated_by'=>$admin_id));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_inquiry($regcode,$trans_number,$epp_number){
    $epp_number = '%"EPPREFNO":"%'.$epp_number.'"%';

    if($epp_number != ''){
      $and_epp = " AND payment.epp_number LIKE '".$epp_number."'";
    } else {
      $and_epp = '';
    }

    if($trans_number != ''){
      $and_trans = ' AND payment.epp_number LIKE "%TransactionNo='.$trans_number.'%"';
    } else {
      $and_trans = '';
    }

    $this->db->select('payment.payor,payment.epp_number');
    $this->db->from('cooperatives');
    $this->db->join('payment' , 'cooperatives.id = payment.cooperatives_id','inner');
    $this->db->like('SUBSTRING(cooperatives.refbrgy_brgyCode,1,2)', substr($regcode,1,2));
    $this->db->where("payment_option = 'online'".$and_epp.$and_trans);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_bns_inquiry($regcode,$trans_number,$epp_number){
    $epp_number = '%"EPPREFNO":"%'.$epp_number.'"%';

    if($epp_number != ''){
      $and_epp = " AND payment.epp_number LIKE '".$epp_number."'";
    } else {
      $and_epp = '';
    }

    if($trans_number != ''){
      $and_trans = ' AND payment.epp_number LIKE "%TransactionNo='.$trans_number.'%"';
    } else {
      $and_trans = '';
    }

    $this->db->select('payment.payor,payment.epp_number');
    $this->db->from('branches');
    $this->db->join('payment' , 'branches.id = payment.bns_id','inner');
    $this->db->where("payment_option = 'online'".$and_epp.$and_trans);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_laboratory_inquiry($regcode,$trans_number,$epp_number){
    $epp_number = '%"EPPREFNO":"%'.$epp_number.'"%';

    if($epp_number != ''){
      $and_epp = " AND payment.epp_number LIKE '".$epp_number."'";
    } else {
      $and_epp = '';
    }

    if($trans_number != ''){
      $and_trans = ' AND payment.epp_number LIKE "%TransactionNo='.$trans_number.'%"';
    } else {
      $and_trans = '';
    }

    $this->db->select('payment.payor,payment.epp_number');
    $this->db->from('laboratories');
    $this->db->join('payment' , 'laboratories.id = payment.lab_id','inner');
    $this->db->where("payment_option = 'online'".$and_epp.$and_trans);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_amendment_inquiry($regcode,$trans_number,$epp_number){
    $epp_number = '%"EPPREFNO":"%'.$epp_number.'"%';

    if($epp_number != ''){
      $and_epp = " AND payment.epp_number LIKE '".$epp_number."'";
    } else {
      $and_epp = '';
    }

    if($trans_number != ''){
      $and_trans = ' AND payment.epp_number LIKE "%TransactionNo='.$trans_number.'%"';
    } else {
      $and_trans = '';
    }

    $this->db->select('payment.payor,payment.epp_number');
    $this->db->from('amend_coop');
    $this->db->join('payment' , 'amend_coop.id = payment.amendment_id','inner');
    $this->db->where("payment_option = 'online'".$and_epp.$and_trans);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_specialist_central_office_count($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("3") AND type_of_cooperative IN ('.$typeofcoopimp.')');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    // $query = $this->db->get();
    // $data = $query->result_array();
    return $this->db->count_all_results();
  }
  public function get_all_cooperatives_by_specialist_central_office($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("3") AND type_of_cooperative IN ('.$typeofcoopimp.')');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_account_info_by_senior($user_id){
    $this->db->select('users.*,users.id as usersid,registeredcoop.*');
    $this->db->from('users');
    $this->db->join('registeredcoop' , 'users.regNo = registeredcoop.regNo','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = users.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->where(array('users.id'=>$user_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_all_account_approval_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('users.*,users.id as usersid,registeredcoop.*');
    $this->db->from('users');
    $this->db->join('registeredcoop' , 'users.regNo = registeredcoop.regNo','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = users.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('(users.is_taken IS NULL OR users.is_taken = 0 AND users.files IS NOT NULL) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $this->db->group_by('registeredcoop.regNo');
    $this->db->order_by('registeredcoop.id','asc');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_account_approval($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('users.*,users.id as usersid,registeredcoop.*');
    $this->db->from('users');
    $this->db->join('registeredcoop' , 'users.regNo = registeredcoop.regNo','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = users.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('(users.is_taken IS NULL OR users.is_taken = 0 AND users.files IS NOT NULL) AND registeredcoop.type NOT IN ('.$typeofcoopimp.')');
    $this->db->group_by('registeredcoop.regNo');
    $this->db->order_by('registeredcoop.id','asc');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_senior2($regcode,$coopname,$limit,$start){

    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    $coopname = (strlen($coopname)>0 ? " AND cooperatives.proposed_name LIKE '%".$coopname."%'" : '');
    // End Get Coop Type for HO
    $this->db->limit($limit, $start);
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('(status IN ("2","3","4","5","6","16") OR (status = 6 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 12 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 13 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 14 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%"))'.$coopname);
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_senior($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("2","3","4","5","6","16") OR (status = 6 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 12 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 13 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%") OR (status = 14 AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%")');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_senior_defer_deny_count($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("11",10) AND third_evaluated_by > 0');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));

    return $this->db->count_all_results();
  }

  public function get_all_cooperatives_by_senior_defer_deny2($regcode,$limit,$start){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->limit($limit, $start);
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("11",10) AND third_evaluated_by > 0');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_senior_defer_deny($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("11",10) AND third_evaluated_by > 0');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_ho_senior_defer_deny($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("11",10) AND third_evaluated_by > 0 AND type_of_cooperative IN ('.$typeofcoopimp.')');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_ho_senior($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("6","12","13","14") AND type_of_cooperative IN ('.$typeofcoopimp.')');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_ho_director($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("9,17") AND type_of_cooperative IN ('.$typeofcoopimp.')');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_director_count($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("7","8") OR ((status = 9 OR status = 17) AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%")');
    // $this->db->where_in('status',array('7','8','9'));
    // $query = $this->db->get();
    // $data = $query->result_array();
    return $this->db->count_all_results();
  }

  public function get_all_cooperatives_by_director2($regcode,$coopname,$limit,$start){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }
    $coopname = (strlen($coopname)>0 ? " AND cooperatives.proposed_name LIKE '%".$coopname."%'" : '');
    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->limit($limit,$start);
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('(status IN ("7","8") OR ((status = 9 OR status = 17) AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%"))'. $coopname);
    // $this->db->where_in('status',array('7','8','9'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_director($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("7","8") OR ((status = 9 OR status = 17) AND type_of_cooperative NOT IN ('.$typeofcoopimp.') AND refregion.regCode LIKE "%'.$regcode.'%")');
    // $this->db->where_in('status',array('7','8','9'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_registration_count($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('registeredcoop.*,cooperatives.*,payment.date_of_or, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('cooperatives.status = 15 AND cooperatives.type_of_cooperative NOT IN ('.$typeofcoopimp.') AND second_evaluated_by != 0');

    return $this->db->count_all_results();
  }

  public function get_all_registration_report($started_date,$end_date){
    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    // $this->db->limit(10);
    $this->db->select('registeredcoop.coopName,registeredcoop.regNo,registeredcoop.dateRegistered,refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.noStreet,registeredcoop.Street,registeredcoop.category,registeredcoop.type,users.first_name,users.last_name,users.contact_number');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('users','users.id = cooperatives.users_id','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('((cooperatives.status = 15 AND registeredcoop.addrCode != "") OR cooperatives.status = 39) AND second_evaluated_by != 0 AND DATE(registeredcoop.dateRegistered) >= DATE("'.$started_date.'") AND DATE(registeredcoop.dateRegistered) <= DATE("'.$end_date.'")');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_registration2($regcode,$coopname,$limit,$start){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $coopname = (strlen($coopname)>0 ? " AND registeredcoop.coopName LIKE '%".$coopname."%'" : '');

    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    $this->db->limit($limit, $start);
    $this->db->select('registeredcoop.*,cooperatives.*,payment.date_of_or, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('cooperatives.status = 15 AND cooperatives.type_of_cooperative NOT IN ('.$typeofcoopimp.') AND second_evaluated_by != 0'.$coopname);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

    public function get_all_cooperatives_registration($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('registeredcoop.*,cooperatives.*,payment.date_of_or, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('cooperatives.status = 15 AND cooperatives.type_of_cooperative NOT IN ('.$typeofcoopimp.')');
    $this->db->order_by('regNo', 'ASC');
    $this->db->group_by('coopName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  // Registered Coop List Process by Head Office - Query
    public function get_all_cooperatives_registration_by_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('registeredcoop.*,cooperatives.*,payment.date_of_or, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','left');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('cooperatives.status = 15 AND cooperatives.type_of_cooperative IN ('.$typeofcoopimp.')');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  // End Registered Coop List Process by Head Office - Query

  // public function get_all_business_activity($coop_id){
  //   $this->db->select('business_activity.id as bactivity_id, business_activity.name as bactivity_name, business_activity_subtype.id as bactivitysubtype_id, business_activity_subtype.name as bactivitysubtype_name');
  //   $this->db->from('business_activities_of_cooperatives');
  //   $this->db->join('business_activity_subtype' , 'business_activity_subtype.id = business_activities_of_cooperatives.business_activity_subtype_id','inner');
  //   $this->db->join('business_activity', 'business_activity.id = business_activity_subtype.business_activity_id','inner');
  //   $this->db->where('business_activities_of_cooperatives.cooperatives_id',$coop_id);
  //   $query = $this->db->get();
  //   $data = $query->result_array();
  //   return $data;
  // }
  public function get_all_business_activities($coop_id){
    $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
    $this->db->from('business_activities_cooperative');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_major_industry($coop_id){
    // $this->db->distinct();
    $this->db->select('major_industry.id,major_industry.description');
    $this->db->from('business_activities_cooperative');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_subclasses($coop_id){
    // $this->db->distinct();
    $this->db->select('subclass.id,subclass.description');
    $this->db->from('business_activities_cooperative');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_cooperative_info($user_id,$coop_id){
    $this->db->select('cooperatives.*, cooperatives.category_of_cooperative as cofc, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,users.first_name,users.last_name,users.email');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('users', 'users.id = cooperatives.users_id','inner');
    $this->db->where(array('cooperatives.users_id'=>$user_id,'cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function cooperatives_comments($coop_id){
    // $this->db->select('*');
    // $this->db->from('cooperatives_comment');
    // $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>3));
     // $query = $this->db->get();
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status IN (11,17) and user_level IN(3,4) ORDER BY id DESC");
    return $query->result_array();
  }
  public function cooperatives_comments_director($coop_id){
    // $this->db->select('*');
    // $this->db->from('cooperatives_comment');
    // $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>3));
     // $query = $this->db->get();
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=11 and user_level IN(3,4) AND status = 11");
    return $query->result_array();
  }
  public function supervising_cds_comments($coop_id){
    // $this->db->select('*');
    // $this->db->from('cooperatives_comment');
    // $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>3));
     // $query = $this->db->get();
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=11 and user_level=4 ");
    return $query->result_array();
  }
  public function admin_supervising_cds_comments_revert($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and user_level=4 and status = 17");
    if($query->num_rows()>0){
       return $query->result_array();
    }

  }
   public function admin_supervising_cds_comments($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and user_level=4 and status IS NULL");
    if($query->num_rows()>0){
       return $query->result_array();
    }

  }
  public function director_comments($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=11 and (user_level=3 or user_level=4) order by id desc");
    if($query->num_rows()>0){
      return $query->result_array();
    }

  }
  public function director_comments_defer($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=11 and (user_level=3 or user_level=4) order by id desc limit 1");
    if($query->num_rows()>0){
      return $query->result_array();
    }

  }
  public function director_comments_defer_revert($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=17 and (user_level=3 or user_level=4) order by id desc limit 1");
    if($query->num_rows()>0){
      return $query->result_array();
    }

  }
  public function director_comments_revert($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and status=17 and (user_level=3) order by id desc limit 1");
    if($query->num_rows()>0){
      return $query->result_array();
    }

  }
  //json
  public function denied_comments($coop_id){
    $query = $this->db->query("select * from cooperatives_comment where cooperatives_id='$coop_id' and user_level IN(3,4,2) AND status = 10");
    return $query->result_array();
  }
  public function cooperatives_comments_cds($coop_id){
    $this->db->select('*');
    $this->db->from('cooperatives_comment');
    $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function cooperatives_comments_snr($coop_id){
    $this->db->select('*');
    $this->db->from('cooperatives_comment');
    $this->db->where(array('user_level = 2 AND (status != 17 OR status IS NULL) AND cooperatives_id ='=>$coop_id));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function cooperatives_comments_snr_defer($coop_id){
    $this->db->select('*');
    $this->db->from('cooperatives_comment');
    $this->db->where(array('user_level = 2 AND (status != 17 OR status IS NULL) AND cooperatives_id ='=>$coop_id));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function cooperatives_comments_snr_revert($coop_id){
    $this->db->select('*');
    $this->db->from('cooperatives_comment');
    $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>2,'status'=>17));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function cooperatives_comments_snr_revert_defer($coop_id){
    $this->db->select('*');
    $this->db->from('cooperatives_comment');
    $this->db->where(array('cooperatives_id'=>$coop_id,'user_level'=>2,'status'=>17));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_cooperative_expiration($user_id){
    $this->db->select('expire_at,id,status,grouping');
    $this->db->from('cooperatives');
    $this->db->where(array('users_id'=>$user_id));
    $query = $this->db->get();
    return $query->row();
  }

   public function get_cooperative_migrated_info($user_regno){

    $this->db->select('cooperatives.*');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id');
    $this->db->where('registeredcoop.regNo', $user_regno);
    $this->db->limit('1');
    $this->db->order_by('cooperatives.id','ASC');
    $query = $this->db->get();
    return $query->row();

  }

  public function get_cooperative_info_branch($user_id,$coop_id){
    $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('branches', 'cooperatives.users_id = branches.user_id','inner');
    $this->db->where(array('cooperatives.users_id'=>$user_id,'branches.user_id'=>$user_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_common_bond($amendment_info)
  {
    $cooperative_id = $this->amendment_model->amendment_dtl($amendment_info->id);
    $openTag ='';
    $closeTag ='';
    $data = '';
    $members_composition = $this->amendment_model->get_coop_composition($amendment_info->id);
    if($amendment_info->common_bond_of_membership == 'Associational')
    {
      $name_ins_assoc = explode(',',$amendment_info->name_of_ins_assoc);
          $data .= $amendment_info->field_of_membership;
          $data .= ' of ';
          $count= count($name_ins_assoc) -1;
          foreach($name_ins_assoc as $key => $ins_assoc)
          {

             $data .= $ins_assoc;
             if($key<$count)
             {
              $data .= ', ';
             }
          }
    }
  }
  public function get_cooperative_info_branch_amend($user_id,$coop_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('branches', 'amend_coop.users_id = branches.user_id','inner');
    $this->db->where(array('amend_coop.users_id'=>$user_id,'branches.user_id'=>$user_id,'amend_coop.status'=>15));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_cooperative_info_by_admin($coop_id){
    $this->db->select('cooperatives.*, cooperatives.category_of_cooperative as cofc, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,cooperatives.type_of_cooperative');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_cooperative_info_by_admin_branch($coop_id){
    $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('branches', 'cooperatives.users_id = branches.user_id','inner');
    $this->db->where(array('cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function insert_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('cooperatives_comment',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function insert_coc_report($data_field){
        $this->db->trans_begin();
        $this->db->insert('coopris_report',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function update_coc_report($regno,$coop_name,$field_data){
    $this->db->where(array('regNo'=>$regno,'coopName'=>$coop_name));
    $this->db->update('coopris_report',$field_data);
  }

  public function add_cooperative($data,$major_industry,$subtypes_array,$members_composition){
    $data = $this->security->xss_clean($data);
    $major_industry = $this->security->xss_clean($major_industry);
    $subtypes_array = $this->security->xss_clean($subtypes_array);
    $batch_subtype = array();

    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$data['type_of_cooperative']));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subtypes_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();
    $industry_subclasses_id_array = $query->result_array();

    $this->db->select('name');
    $this->db->where('id',$data['type_of_cooperative']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();

    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->trans_begin();
    $this->db->insert('cooperatives',$data);
    $id = $this->db->insert_id();

    if($data['type_of_cooperative'] == 'Union' && $data['grouping'] == 'Union'){
      $audit = array('name'=> 'Audit','user_id' => $data['users_id']);
      $gad = array('name'=> 'Gender and Development','user_id' => $data['users_id']);
      $election = array('name'=> 'Election','user_id' => $data['users_id']);
      $mac = array('name'=> 'Mediation and Conciliation','user_id' => $data['users_id']);
      $ethics = array('name'=> 'Ethics','user_id' => $data['users_id']);

      $this->db->insert('committees_union',$audit);
      $this->db->insert('committees_union',$gad);
      $this->db->insert('committees_union',$election);
      $this->db->insert('committees_union',$mac);
      $this->db->insert('committees_union',$ethics);

      // return $return;
    } else if($data['grouping'] == 'Federation' || $data['type_of_cooperative'] == 'Technology Service'){
      $audit = array('name'=> 'Audit','user_id' => $data['users_id']);
      $gad = array('name'=> 'Gender and Development','user_id' => $data['users_id']);
      $election = array('name'=> 'Election','user_id' => $data['users_id']);
      $mac = array('name'=> 'Mediation and Conciliation','user_id' => $data['users_id']);
      $ethics = array('name'=> 'Ethics','user_id' => $data['users_id']);

      $this->db->insert('committees_federation',$audit);
      $this->db->insert('committees_federation',$gad);
      $this->db->insert('committees_federation',$election);
      $this->db->insert('committees_federation',$mac);
      $this->db->insert('committees_federation',$ethics);

    }

    if(count($industry_subclasses_id_array)!=0){
      foreach($industry_subclasses_id_array as $industry_subclasses_id){
        array_push($batch_subtype, array(
          'cooperatives_id'=> $id,
          'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
        );
      }
      $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
    } else {
      // foreach($industry_subclasses_id_array as $industry_subclasses_id){
        array_push($batch_subtype, array(
          'cooperatives_id'=> $id,
          'industry_subclass_by_coop_type_id'=>1)
        );
      // }
      $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
    }

    $this->db->select('id');
    $this->db->where_in('composition',$members_composition);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $members = $query->result_array();
    $count = count($members);
    if($count!=0){
        $batch_composition = array();
        foreach($members as $composition){
          array_push($batch_composition, array(
            'coop_id'=> $id,
            'composition'=>$composition['id'])
          );
        }
        $this->db->insert_batch('members_composition_of_cooperative', $batch_composition);
    }
    $temp_purpose = array(
        'cooperatives_id' => $id,
        'content'  => $this->get_purpose_content($coop_type->name,$data['grouping'],$data['is_youth'])
      );
    $this->db->insert('purposes',$temp_purpose);
    $this->db->insert('bylaws', array('cooperatives_id'=>$id));
    $this->db->insert('articles_of_cooperation', array('cooperatives_id'=>$id));
    $this->db->insert('economic_survey', array('cooperatives_id'=>$id));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function update_expire_at($user_id,$coop_id,$field_data){
    $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
    $this->db->update('cooperatives',$field_data);
  }

  public function update_not_expired_cooperative($user_id,$coop_id,$field_data,$subclass_array,$major_industry,$members){
    $data = $this->security->xss_clean($field_data);
    $subclass_array = $this->security->xss_clean($subclass_array);

    $batch_subtype = array();
    $this->db->trans_begin();
    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$data['type_of_cooperative']));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subclass_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();

    $industry_subclasses_id_array = $query->result_array();
    $this->db->select('name');
    $this->db->where('id',$data['type_of_cooperative']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();

    $this->db->select('type_of_cooperative,category_of_cooperative');
    $this->db->where('id',$coop_id);
    $this->db->from('cooperatives');
    $query3 = $this->db->get();
    $coop_type_of_coop = $query3->row();

    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
    $this->db->update('cooperatives',$data);

    if($data['type_of_cooperative'] == 'Union' && $data['grouping'] == 'Union'){
      $audit = array('name'=> 'Audit','user_id' => $data['users_id']);
      $gad = array('name'=> 'Gender and Development','user_id' => $data['users_id']);
      $election = array('name'=> 'Election','user_id' => $data['users_id']);
      $mac = array('name'=> 'Mediation and Conciliation','user_id' => $data['users_id']);
      $ethics = array('name'=> 'Ethics','user_id' => $data['users_id']);

      $committee_exist = $this->db->where(array('name'=>'Audit','user_id'=>$data['users_id']))->get('committees_union');
        if($committee_exist->num_rows()>0){
            // $this->setMessage(array('type' => 'warning', 'heading' => 'Warning', 'content' => 'Record already exist!'));
        } else {
          $this->db->insert('committees_union',$audit);
          $this->db->insert('committees_union',$gad);
          $this->db->insert('committees_union',$election);
          $this->db->insert('committees_union',$mac);
          $this->db->insert('committees_union',$ethics);
        }

      // return $return;
    } else if($data['grouping'] == 'Federation' || $data['type_of_cooperative'] == 'Technology Service'){
      $audit = array('name'=> 'Audit','user_id' => $data['users_id']);
      $gad = array('name'=> 'Gender and Development','user_id' => $data['users_id']);
      $election = array('name'=> 'Election','user_id' => $data['users_id']);
      $mac = array('name'=> 'Mediation and Conciliation','user_id' => $data['users_id']);
      $ethics = array('name'=> 'Ethics','user_id' => $data['users_id']);
      $committee_exist = $this->db->where(array('name'=>'Audit','user_id'=>$data['users_id']))->get('committees_federation');
        if($committee_exist->num_rows()>0){
            // $this->setMessage(array('type' => 'warning', 'heading' => 'Warning', 'content' => 'Record already exist!'));
        } else {
          $this->db->insert('committees_federation',$audit);
          $this->db->insert('committees_federation',$gad);
          $this->db->insert('committees_federation',$election);
          $this->db->insert('committees_federation',$mac);
          $this->db->insert('committees_federation',$ethics);
        }

    }

    $this->db->delete('business_activities_cooperative',array('cooperatives_id'=>$coop_id));

    if(count($industry_subclasses_id_array)!=0){
      foreach($industry_subclasses_id_array as $industry_subclasses_id){
        array_push($batch_subtype, array(
          'cooperatives_id'=> $coop_id,
          'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
        );
      }
      $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
    }  else {
      // foreach($industry_subclasses_id_array as $industry_subclasses_id){
        array_push($batch_subtype, array(
          'cooperatives_id'=> $coop_id,
          'industry_subclass_by_coop_type_id'=>1)
        );
      // }
      $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
    }


    $temp_purpose = array(
        'cooperatives_id' => $coop_id,
        'content'  => $this->get_purpose_content($coop_type->name,$data['grouping'],$data['is_youth'])
      );

    $this->db->select('id');
    $this->db->where_in('composition',$members);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $member = $query->result_array();
    if($members[0] != ""){
        $this->db->delete('members_composition_of_cooperative',array('coop_id'=>$coop_id));
        $batch_composition = array();
        foreach($member as $composition){
          array_push($batch_composition, array(
            'coop_id'=> $coop_id,
            'composition'=>$composition['id'])
          );
        }
        $this->db->insert_batch('members_composition_of_cooperative', $batch_composition);
    }

    if($coop_type_of_coop->type_of_cooperative != $coop_type->name || $coop_type_of_coop->category_of_cooperative != $data['category_of_cooperative']){
      $temp_purpose = array(
          'cooperatives_id' => $coop_id,
          'content'  => $this->get_purpose_content($coop_type->name,$data['grouping'],$data['is_youth'])
        );
      $this->db->where('cooperatives_id',$coop_id);
      $this->db->update('purposes',$temp_purpose);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
    } else {
      $this->db->trans_commit();
      return true;
    }
  }
  public function update_not_expired_cooperative_by_admin($coop_id,$field_data,$subclass_array,$major_industry){
    $data = $this->security->xss_clean($field_data);
    $subclass_array = $this->security->xss_clean($subclass_array);
    $batch_subtype = array();
    $this->db->trans_begin();
    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$data['type_of_cooperative']));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subclass_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();
    $industry_subclasses_id_array = $query->result_array();

    $this->db->select('type_of_cooperative,category_of_cooperative');
    $this->db->where('id',$coop_id);
    $this->db->from('cooperatives');
    $query3 = $this->db->get();
    $coop_type_of_coop = $query3->row();

    $this->db->select('name');
    $this->db->where('id',$data['type_of_cooperative']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();
    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->where(array('id'=>$coop_id));
    $this->db->update('cooperatives',$data);
    $this->db->delete('business_activities_cooperative',array('cooperatives_id'=>$coop_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'cooperatives_id'=> $coop_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_cooperative', $batch_subtype);

    if($coop_type_of_coop->type_of_cooperative != $coop_type->name || $coop_type_of_coop->category_of_cooperative != $data['category_of_cooperative']){
      $temp_purpose = array(
          'cooperatives_id' => $coop_id,
          'content'  => $this->get_purpose_content($coop_type->name,$data['grouping'],$data['is_youth'])
        );
      $this->db->where('cooperatives_id',$coop_id);
      $this->db->update('purposes',$temp_purpose);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
    } else {
      $this->db->trans_commit();
      return true;
    }
  }

  // public function update_cooperative($id,$data){
  //     $id = $this->security->xss_clean($id);
  //     $data = $this->security->xss_clean($data);
  //     $this->db->trans_begin();
  //     $this->db->set($data);
  //     $this->db->where('id', $id);
  //     $this->db->update('cooperatives');
  //     if($this->db->trans_status() === FALSE){
  //       $this->db->trans_rollback();
  //       return false;
  //     }else{
  //       $this->db->trans_commit();
  //       return true;
  //     }
  // }

public function remove_file($coop_id)
{
  $query_file = $this->db->get_where("uploaded_documents",array('cooperatives_id'=>$coop_id));
  if($query_file->num_rows()>0)
  {
    foreach($query_file->result_array() as $rowf)
    {
      $config['upload_path'] = UPLOAD_DIR;
      $config['file_name'] = $rowf['filename'];
      $file = $config['upload_path'].$config['file_name'];

      if(is_readable($file)){
         if(unlink($file))
          {
             if($this->db->delete('uploaded_documents',array('cooperatives_id'=>$coop_id)))
             {
              return true;
             }
             else
             {
              return false;
             }
          }
      }
      else
      {
        if($this->db->delete('uploaded_documents',array('cooperatives_id'=>$coop_id)))
        {
          return true;
        }
        else
        {
          return false;
        }
      }

    }

  }
  else
  {
    return true;//no file upload
  }
}

public function change_status_cooperatives($decoded_id,$status){
  $decoded_id = $this->security->xss_clean($decoded_id);
  $status = $this->security->xss_clean($status);

  $this->db->trans_begin();
  $this->db->where(array('id'=>$decoded_id));

  if($status == 1 || $status == 2){
    $this->db->update('cooperatives',array('status'=>$status, 'third_evaluated_by'=>0, 'second_evaluated_by'=>0, 'evaluated_by'=>0));
  } else if ($status == 3){
    $this->db->update('cooperatives',array('status'=>$status, 'third_evaluated_by'=>0, 'second_evaluated_by'=>0));
  } else if ($status == 9){
    $this->db->update('cooperatives',array('status'=>$status, 'third_evaluated_by'=>0));
  } else {
    $this->db->update('cooperatives',array('status'=>$status));
  }

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}


public function delete_cooperative($coop_id,$status,$user_id){

 if($this->remove_file($coop_id))
 {
    $this->db->trans_begin();
    if($this->db->delete('committees',array('user_id'=>$user_id)))
    {
      if($this->db->delete('capitalization',array('cooperatives_id'=>$coop_id)))
      {
        if($this->db->delete('bylaws',array('cooperatives_id'=>$coop_id)))
        {
          if($this->db->delete('cooperators',array('cooperatives_id'=>$coop_id)))
          {
            if($this->db->delete('purposes',array('cooperatives_id'=>$coop_id)))
            {
              if($this->db->delete('articles_of_cooperation',array('cooperatives_id'=>$coop_id)))
              {
                if($this->db->delete('economic_survey',array('cooperatives_id'=>$coop_id)))
                {
                  if($this->db->delete('staff',array('cooperatives_id'=>$coop_id)))
                  {
                    if($this->db->delete('uploaded_documents',array('cooperatives_id'=>$coop_id)))
                    {
                      $this->db->delete('cooperatives',array('id' => $coop_id));
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
  }
}
public function delete_cooperative_federation($coop_id,$status,$user_id){

  if($this->remove_file($coop_id))
 {
    $this->db->trans_begin();
    if($this->db->delete('committees_federation',array('user_id'=>$user_id)))
    {
      if($this->db->delete('capitalization',array('cooperatives_id'=>$coop_id)))
      {
        if($this->db->delete('bylaws',array('cooperatives_id'=>$coop_id)))
        {
          if($this->db->delete('affiliators',array('user_id'=>$user_id)))
          {
            if($this->db->delete('purposes',array('cooperatives_id'=>$coop_id)))
            {
              // if($this->db->delete('articles_of_cooperation',array('cooperatives_id'=>$coop_id)))
              // {
                // if($this->db->delete('economic_survey',array('cooperatives_id'=>$coop_id)))
                // {
                  if($this->db->delete('staff',array('cooperatives_id'=>$coop_id)))
                  {
                    if($this->db->delete('uploaded_documents',array('cooperatives_id'=>$coop_id)))
                    {
                      $this->db->delete('cooperatives',array('id' => $coop_id));
                    }
                  }
                // }
              // }
            }
          }
        }
      }
    }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
  }
}

public function delete_cooperative_union($coop_id,$status,$user_id){

  if($this->remove_file($coop_id))
 {
    $this->db->trans_begin();
    if($this->db->delete('committees_union',array('user_id'=>$user_id)))
    {
      // if($this->db->delete('capitalization',array('cooperatives_id'=>$coop_id)))
      // {
        if($this->db->delete('bylaws',array('cooperatives_id'=>$coop_id)))
        {
          if($this->db->delete('unioncoop',array('user_id'=>$user_id)))
          {
            if($this->db->delete('purposes',array('cooperatives_id'=>$coop_id)))
            {
              // if($this->db->delete('articles_of_cooperation',array('cooperatives_id'=>$coop_id)))
              // {
                // if($this->db->delete('economic_survey',array('cooperatives_id'=>$coop_id)))
                // {
                  if($this->db->delete('staff',array('cooperatives_id'=>$coop_id)))
                  {
                    if($this->db->delete('uploaded_documents',array('cooperatives_id'=>$coop_id)))
                    {
                      $this->db->delete('cooperatives',array('id' => $coop_id));
                    }
                  }
                // }
              // }
            }
          }
        }
      // }
    }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      }
  }
}

public function delete_committees($user_id){
  $this->db->trans_begin();
  $this->db->delete('committees',array('user_id' => $user_id));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function submit_for_evaluation($user_id,$coop_id){
  $user_id = $this->security->xss_clean($user_id);
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
  $this->db->update('cooperatives',array('status'=>2,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60))),'senior_received_the_app'=>date('Y-m-d H:i:s')));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function submit_for_reevaluation($user_id,$coop_id){
  $user_id = $this->security->xss_clean($user_id);
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
  $this->db->update('cooperatives',array('status'=>6));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function assign_to_specialist($coop_id,$specialist_id,$coop_full_name){
  $specialist_id = $this->security->xss_clean($specialist_id);
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $query = $this->db->get_where('admin',array('id'=>$specialist_id));
  $admin_info = $query->row();
  $this->db->where(array('id'=>$coop_id));
  //$this->db->update('cooperatives',array('senior_assign_to_cds' =>date('Y-m-d H:i:s'),'status'=>3,'evaluated_by'=>$specialist_id));
  $this->db->update('cooperatives',array('status'=>3,'evaluated_by'=>$specialist_id));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    // if($this->admin_model->sendEmailToSpecialist($admin_info,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    // }else{
    //   $this->db->trans_rollback();
    //   return false;
    // }
  }
}
public function approve_by_specialist($admin_info,$coop_id,$coop_full_name,$comment_by_specialist_senior){
  $coop_id = $this->security->xss_clean($coop_id);
  $comment_by_specialist_senior = $this->security->xss_clean($comment_by_specialist_senior);
  $temp = $this->get_cooperative_info_by_admin($coop_id);
  $now = date('Y-m-d H:i:s');
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('cooperatives',array('status'=>6,'evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'comment_by_specialist'=>$comment_by_specialist_senior,'specialist_submit_at'=>$now));
  // Get Count Coop Type for HO
    $this->db->where(array('name'=>$temp->type_of_cooperative,'active'=>1));
    $this->db->from('head_office_coop_type');
  // End Get Count Coop
  if($this->db->count_all_results()>0){
    $senior_emails = $this->admin_model->get_emails_of_senior_by_region("00");
  } else {
    $senior_emails = $this->admin_model->get_emails_of_senior_by_region($temp->rCode);
  }
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    // if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    // }else{
    //   $this->db->trans_rollback();
    //   return false;
    // }
  }
}
public function approve_by_senior($admin_info,$coop_id,$coop_full_name,$comment_by_specialist_senior){
  $coop_id = $this->security->xss_clean($coop_id);
  $comment_by_specialist_senior = $this->security->xss_clean($comment_by_specialist_senior);
  $now = date('Y-m-d H:i:s');
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('cooperatives',array('status'=>9,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'comment_by_senior'=>$comment_by_specialist_senior,'senior_submit_at'=>$now));
  $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
    foreach($director_emails as $email){
      if($email['is_director_active'] == 0){
        $director_emails = $this->admin_model->get_emails_of_revoke_director_by_region($admin_info->region_code);
      }
    }

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    // }else{
    //   $this->db->trans_rollback();
    //   return false;
    // }
  }
}
public function approve_by_supervisor($admin_info,$coop_id,$coop_full_name){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, users.*');
  $this->db->from('cooperatives');
  $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
  $this->db->where('cooperatives.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('cooperatives',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'director_approved'=>date('Y-m-d H:i:s'),'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  $supervisor_emails = $this->admin_model->get_emails_of_supervisor_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToDirectorApprovedBySupervisor($admin_info,$supervisor_emails,$coop_full_name)){
      if($this->admin_model->sendEmailToClientApprove($client_info->proposed_name,$client_info->email)){ //json
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}
public function approve_by_director($admin_info,$coop_id){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, cooperatives.grouping, cooperatives.house_blk_no, cooperatives.street, users.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  $this->db->from('cooperatives');
  $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
  $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
  $this->db->where('cooperatives.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row_array();
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('cooperatives',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'director_approved'=>date('Y-m-d H:i:s'),'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($client_info['grouping'] == 'Federation'){
      $data['admin_info'] = $this->admin_model->get_admin_info($admin_info->id);

      if(!empty($client_info['acronym_name'])){
          $acronym_name = '('.$client_info['acronym_name'].') ';
      } else {
          $acronym_name = '';
      }

      $coopname = ucwords($client_info['proposed_name'].' Federation of '.$client_info['type_of_cooperative'] .' Cooperative '.$acronym_name);

      if($client_info['house_blk_no']==null && $client_info['street']==null) $x=''; else $x=', ';
      $addresscoop = $client_info['house_blk_no'].' '.$client_info['street'].$x.' '.$client_info['brgy'].', '.$client_info['city'].', '.$client_info['province'].' '.$client_info['region'];

      if($this->admin_model->sendEmailToClientApproveFederation($client_info['proposed_name'],$client_info['email'],$data['admin_info'],$coopname,$addresscoop)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    } else if($client_info['grouping'] == 'Union'){
      $data['admin_info'] = $this->admin_model->get_admin_info($admin_info->id);

      if(!empty($client_info['acronym_name'])){
          $acronym_name = '('.$client_info['acronym_name'].') ';
      } else {
          $acronym_name = '';
      }

      $coopname = ucwords($client_info['proposed_name'].' '.$client_info['type_of_cooperative'] .' Cooperative '.$acronym_name);

      if($client_info['house_blk_no']==null && $client_info['street']==null) $x=''; else $x=', ';
      $addresscoop = $client_info['house_blk_no'].' '.$client_info['street'].$x.' '.$client_info['brgy'].', '.$client_info['city'].', '.$client_info['province'].' '.$client_info['region'];

      if($this->admin_model->sendEmailToClientApproveUnion($client_info['proposed_name'],$client_info['email'],$data['admin_info'],$coopname,$addresscoop)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    } else {
      if($this->admin_model->sendEmailToClientApprove($client_info['proposed_name'],$client_info['email'])){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }

      $this->db->trans_commit();
      return true;

  }
}

public function deny_by_admin($admin_id,$coop_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('cooperatives',array('evaluated_by'=>$admin_id,'status'=>4,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('cooperatives',array('second_evaluated_by'=>$admin_id,'status'=>7,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else
    $this->db->update('cooperatives',array('third_evaluated_by'=>$admin_id,'status'=>10,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, cooperatives.grouping, users.*');
      $this->db->from('cooperatives');
      $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
      $this->db->where('cooperatives.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // return $client_info;
      $fullname= $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;
      // if($this->admin_model->sendEmailToClientDeny($fullname, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->grouping ,$client_info->email, $reason_commment)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
public function defer_by_admin($admin_id,$coop_id,$reason_commment,$step){

  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('cooperatives',array('evaluated_by'=>$admin_id,'status'=>5,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('cooperatives',array('second_evaluated_by'=>$admin_id,'status'=>41,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else
    $this->db->update('cooperatives',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, cooperatives.grouping, users.*');
      $this->db->from('cooperatives');
      $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
      $this->db->where('cooperatives.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      $full_name= $client_info->first_name.' '.$client_info->last_name; // modified by json
      // if($this->admin_model->sendEmailToClientDefer($full_name, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->grouping ,$client_info->email, $reason_commment)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}

public function revert_by_senior($admin_id,$coop_id,$reason_commment,$step){

  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('cooperatives',array('evaluated_by'=>$admin_id,'status'=>5,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('cooperatives',array('second_evaluated_by'=>$admin_id,'status'=>8,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else
    $this->db->update('cooperatives',array('third_evaluated_by'=>$admin_id,'status'=>17,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, cooperatives.grouping, users.*');
      $this->db->from('cooperatives');
      $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
      $this->db->where('cooperatives.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      $full_name= $client_info->first_name.' '.$client_info->last_name; // modified by json
      // if($this->admin_model->sendEmailToClientDefer($full_name, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->grouping ,$client_info->email, $reason_commment)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
public function check_own_cooperative($coop_id,$user_id){
    $query2 = $this->db->get_where('cooperatives', array('users_id' => $user_id,'id'=> $coop_id));
    return $query2->num_rows() > 0 ? true : false;
}
// public function check_cooperative_exist($user_id){
//     $query2 = $this->db->get_where('cooperatives', array('users_id' => $user_id));
//     return $query2->num_rows() > 0 ? true : false;
// }
public function check_expired_reservation($coop_id,$user_id){
  $query = $this->db->get_where('cooperatives',array('users_id' => $user_id,'id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_expired_reservation_by_admin($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_expired_reservation_by_admin_lab($lab_id){
  $query = $this->db->get_where('laboratories',array('id'=> $lab_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_submitted_for_evaluation($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  // if($coop_status > 1 && $coop_status <11){
  if($coop_status > 1 && $coop_status <=16 && $coop_status != 11 || $coop_status == 17 ){ //modify by json
    return true;
  }else if($coop_status == 11){
    return false;
  } else {
    return false;
  }
}
public function check_if_revert($coop_id){
  $query = $this->db->get_where('cooperatives_comment',array('cooperatives_id'=>$coop_id,'status'=>17));
  $data = $query->num_rows();
  if($data != 0){
    return true;
  }else{
    return false;
  }
}
public function check_if_deferred($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id,'status'=>11));
  $data = $query->num_rows();
  if($data != 0){
    return true;
  }else{
    return false;
  }
}

public function check_not_yet_assigned($coop_id){
  $this->db->where(array('id'=>$coop_id,'status'=>2,'evaluated_by !='=>0));
  $this->db->from('cooperatives');
  if($this->db->count_all_results() == 0){
    return true;
  }else{
    return false;
  }
}
public function check_first_evaluated($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=4 || $coop_status==17){
    return true;
  }else{
    return false;
  }
}
public function check_second_evaluated($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=7){
    return true;
  }else{
    return false;
  }
}
public function check_last_evaluated($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=10 || $coop_status == 17){
    return true;
  }else{
    return false;
  }
}
public function check_last_evaluated_revert($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=13){
    return true;
  }else{
    return false;
  }
}
public function check_if_denied($coop_id){
  $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==4 || $coop_status==7 || $coop_status==10){
    return true;
  }else{
    return false;
  }
}
  public function is_name_unique($ajax){
    $ajax = $this->security->xss_clean($ajax);
    $uniq = true;
    $temp = strtolower(str_replace(' ', '', $ajax['fieldValue']));
    $this->db->select('cooperatives.proposed_name, cooperative_type.id as type_id');
    $this->db->from('cooperatives');
    $this->db->join('cooperative_type','cooperatives.type_of_cooperative=cooperative_type.name','inner');
    // $this->db->where(array('status !=', 0));
    $this->db->where_not_in('status', array('0','4','7','10'));
    $query = $this->db->get();
    $data = $query->result_array();

    //$query2 = $this->db->get_where('cooperative_type',array('id'=>$ajax['typeOfCooperative']));

    foreach($data as $coop){
      $coop_name = strtolower(str_replace(' ', '', $coop['proposed_name']));
      if(strcasecmp($temp,$coop_name)==0 && $coop['type_id'] == $ajax['typeOfCooperative']){
        $uniq = false;
        break;
      }
    }
    if($uniq){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function is_name_update_unique($ajax){
    $ajax = $this->security->xss_clean($ajax);
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativeID']));
    $uniq = true;
    $temp = strtolower(str_replace(' ', '', $ajax['fieldValue']));
    $this->db->select('cooperatives.proposed_name, cooperative_type.id as type_id');
    $this->db->from('cooperatives');
    $this->db->join('cooperative_type','cooperatives.type_of_cooperative=cooperative_type.name','inner');
    $this->db->where(array('cooperatives.id !='=>$decoded_id)); //,'status !=' => 0)
    $this->db->where_not_in('status', array('0','4','7','10'));
    $query = $this->db->get();
    $data = $query->result_array();

    //$query2 = $this->db->get_where('cooperative_type',array('id'=>$ajax['typeOfCooperative']));

    foreach($data as $coop){
      $coop_name = strtolower(str_replace(' ', '', $coop['proposed_name']));
      if(strcasecmp($temp,$coop_name)==0 && $coop['type_id'] == $ajax['typeOfCooperative']){
        $uniq = false;
        break;
      }
    }
    if($uniq){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function generateCode(){
    $tryAgain = true;
    while($tryAgain){
      $token = "";
      $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);
      if(true){
        $tryAgain = false;
      }
    }
    return $token;
  }

  public function get_purpose_content($coop_type,$grouping,$is_youth){
    if($grouping == 'Federation'){
      $data = array('Advocacy' => '_________________________________________________________________________________________________',
        'Agrarian Reform' => '_________________________________________________________________________________________________',
        'Agriculture' => '_________________________________________________________________________________________________',
        'Consumers' => '_________________________________________________________________________________________________',
        'Credit' => '_________________________________________________________________________________________________',
        'Dairy' => '_________________________________________________________________________________________________',
        'Education' => '_________________________________________________________________________________________________',
        'Electric' => '_________________________________________________________________________________________________',
        'Financial Service' => '_________________________________________________________________________________________________',
        'Fishermen' => '_________________________________________________________________________________________________',
        'Health Service' => '_________________________________________________________________________________________________',
        'Housing' => '_________________________________________________________________________________________________',
        'Labor Service' => '_________________________________________________________________________________________________',
        'Marketing' => '_________________________________________________________________________________________________',
        'Producers' => '_________________________________________________________________________________________________',
        'Professionals' => '_________________________________________________________________________________________________',
        'Service' => '_________________________________________________________________________________________________',
        'Small Scale Mining' => '_________________________________________________________________________________________________',
        'Transport' => '_________________________________________________________________________________________________',
        'Water Service' => '_________________________________________________________________________________________________',
        'Workers' => '_________________________________________________________________________________________________'
      );
    } else {
      $data = array(
        'Advocacy'=> 'Promoting and advocating cooperativism among its members and the public through socially oriented projects, education and training, research and communication and other similar activities to reach out to its intended beneficiaries;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of Cooperatives;'.
          'Advocating for the cause of the Cooperative movements;'.
          'Ensuring the viability of Cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Agriculture' => 'Raising or culturing __________________ (specify whether what plants or animals);'.
          'Facilitating the procurement of ______________ (specify farm inputs/implements) for the members;'.
          'Processing and marketing of the members ___________ (specify products/produce);'.
          'Storing and transporting of members __________ (specify products/produce);'.
          'Providing credit facility for __________ (specify what agricultural production);'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the Cooperative movements;'.
          'Ensuring the viability of Cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation;'.
          'Any other activities that lead to the reduction of cost and/or addition in value of outputs.',
        'Agrarian Reform'=> 'Facilitating the development of an appropriate system of land tenure, land development, land consolidation or land management in areas covered by agrarian reform;'.
          'Coordinating and facilitating the dissemination of scientific methods of production;'.
          'Promoting sustainable agriculture through organic farming;'.
          'The business of production, processing, storage, transport, and marketing of farm products for Agrarian Reform Beneficiaries and their immediate families;'.
          'Providing financial facilities to beneficiaries for provident or productive purposes at the least possible costs;'.
          'Arranging and facilitating the expeditious transfer of appropriate and suitable technology to beneficiaries and marginal farmers at the lowest possible costs;'.
          'Providing social security, health, medical and social insurance benefits and other social and economic benefits that promote the general welfare of the agrarian reform beneficiaries and marginal farmers;'.
          'Providing a non-formal education, vocational/technical training and livelihood program to beneficiaries and marginal farmers;'.
          'Acting as channels for external assistance and services to the beneficiaries and marginal farmers;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the Cooperative movements;'.
          'Ensuring the viability of Cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation;'.
          'Promoting the maintenance of sustainable farming and ecological  balance in the agrarian reform community.',
        // 'Bank' => '___________________________________________________________;',
          // 'Promoting and advancing the economic and social status of the members;'.
          // 'Coordinating and facilitating the activities of cooperatives;'.
          // 'Advocating for the cause of the cooperative movements;'.
          // 'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          // 'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Consumers' => 'Procurement and distribution of commodities to members and nonmembers such as (retail, wholesale, restaurant/canteen operation, water refilling and etc.),_____________ and other basic commodities;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Credit' => 'Encouraging thrift and savings mobilization among the members;'.
          'Generating funds and extending credit to the members for productive and provident purposes;'.
          'Encouraging and supporting members the systematic production, value addition and marketing activities;'.
          'Developing expertise and skills among its members;'.
          'Providing protection to the loans and funds of the members;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Dairy' => 'Production of fresh milk, for business and human consumption;'.
          'Processing of milk to dairy products including, milk variants and cheese for business and human consumption;'.
          'Assisting its members a guaranteed market outlet, to bargain for the best price terms possible in the market place, including over-order premiums in milk marketing orders, and to market the milk efficiently, i.e. balancing plant needs, diverting milk surpluses and assembling producer milk and to have the highest quality producer milk possible in the market;'.
          'Providing services for the research and development for the production and processing of dairy products including fresh milk, milk variants and cheese;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Education' => 'School Operations;'.
          'Training Center;'.
          'Review Center;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Electric' => 'The distribution and supply of electricity within its franchise area;'.
          'Power generation utilizing new and renewable energy sources, including hybrid systems;'.
          'Operation and acquisition of sub-transmission of electricity;'.
          'Venturing into any other purpose or other related business endeavors allowed by law, rules, regulations, and its own By-laws as long as it is related to or may enhance the primary purpose/service and objective of the Cooperative;'.
          'The implementation of the Rural Electrification Program in its respective areas of coverage in consonance with the terms and conditions appurtenant to its Certificate of Franchise;'.
          'The exercise of the power of eminent domain in furtherance of the Rural Electrification Program, which shall not be diminished, subject to the requirements of the Constitution and existing relevant laws;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Financial Service' => 'The functions of credit cooperatives and other Cooperatives, including multipurpose Cooperatives that provide savings and credit to their members;'.
          'Other financial services subject to regulation by the BSP;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Fishermen' => 'Processing and marketing of Aquatic Products of the members;'.
          'Seaweeds harvesting, processing and marketing;'.
          'Assisting in the development of marine sanctuaries, parks and reservations;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Health Service' => 'Increasing the access of community to the health and medical services;'.
          'Providing health and medical services at reduced cost;'.
          'Promoting herbal and alternative medicines;'.
          'Production and manufacturing of medicines;'.
          'Helping to upgrade the health and medical facilities in the community;'.
          'Increase income, savings, investments, productivity, and purchasing power, and promote among themselves equitable distribution of net surplus through maximum utilization of economies of scale, cost-sharing and risk-sharing;'.
          'Providing optimum social and economic benefits to its members;'.
          'Teaching the members efficient ways of doing things in a cooperative manner;'.
          'Propagating cooperative practices and new ideas in business and management;'.
          'Allowing the lower income and less privileged groups to increase their ownership in the wealth of the nation;'.
          'Actively supporting the government, other cooperatives and people oriented organizations, both local and foreign, in promoting cooperatives as a practical means towards sustainable socio-economic development under a truly just and democratic society;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Housing' => 'Providing affordable and decent housing to its members;'.
          'Procurement and distribution of housing materials to its members;'.
          'Acquisition of land, construction of houses or buildings, site development and/or property management of housing projects for its members;'.
          'Undertaking socio-economic activities to augment the family income to ensure repayment of the amortization (for socialized housing);'.
          'Facilitating access to land and/or housing loans from commercial banks and government financial institutions or national government agencies;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation;'.
          'To provide goods and services to members.',
        'Insurance' => 'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Labor Service' => 'To ensure and provide continuous employment opportunities to its members;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of Cooperatives;'.
          'Advocating for the cause of the Cooperative movements;'.
          'Ensuring the viability of Cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Marketing'=> 'To engage in the supply of production inputs to members and market their products;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Multi-Purpose'=> 'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Producers' => 'Manufacturing/Processing of raw materials into finished or processed products;'.
          'Selling of the processed/manufactured products;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Professionals' => 'The practice of their profession as: _______________________________________________;'.
          'Capital Formation;'.
          'Undertake such other economic or social activities as may be necessary or incidental in the pursuit of the foregoing purposes;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Service' => '____________________________________________________;'.
          '____________________________________________________;'.
          '____________________________________________________;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Small Scale Mining' => 'Extracting and removing of minerals or ore-bearing materials from the ground;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Transport' => 'Provide public transport services primarily to members and the commuting public (land and sea/water transportation services, and is limited to small vessels, for the safe conveyance of passengers and/or cargoes);'.
          'Engage in allied services or businesses such as: <ul type="a"> <li> importation, distribution and marketing of marketing of spare parts, supplies and petroleum products in accordance with existing laws </li><li> operation of gasoline stations and transportation service centers </li> <li> Importation, distribution and marketing of spare parts and supplies </li> <li> Marketing of vehicle/drivers insurance policies. </li> </ul>;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Water Service' => 'Operation and Management of Water Supply System;'.
          'Distribution of Potable Water;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Workers' => 'Undertaking labor and production of commodities or services jointly carried out without the limitations of individual work, or under the rules of conventional wage-based labor;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movements;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies;'.
          'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
        'Union' => '___________________________________________________________;',
        'Federation' => 'That the purpose(s) for which this Cooperative is organized is/are to engage in:;'.
          '_________________________________________________________________________________________________',
        'Bank' => 'To provide a wide range of financial services primarily to cooperative organizations and their members, and to the general public; and'.
          'To Perform any or all transactions and banking services offered by other types of banks subject to applicable laws, rules and regulations',
        'Technology Service' => 'Developing expertise and skills among its members;'.
          'Promoting and advancing the economic and social status of the members;'.
          'Coordinating and facilitating the activities of cooperatives;'.
          'Advocating for the cause of the cooperative movement;'.
          'Ensuring the viability of cooperatives through the utilization of new technologies; and'.
          ' Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.'
      );
    }

    if($is_youth == 1){
      $data = 'Promoting the sustainable development of young entrepreneurs and encourage the entrepreneurial spirit among the youth.;'.
              'Promoting and advancing the economic and social status of the members;'.
              'Coordinating and facilitating the activities of cooperatives;'.
              'Advocating for the cause of the cooperative movements;'.
              'Ensuring the viability of cooperatives through the utilization of new technologies; and '.
              'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.';
      return $data;
    }

      return $data[$coop_type];
  }
public function check_second_evaluated_laboratories($coop_id){
  $query = $this->db->get_where('laboratories',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=7 || $coop_status==17){
    return true;
  }else{
    return false;
  }
}
public function check_if_denied_laboratories($coop_id){
  $query = $this->db->get_where('laboratories',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==4 || $coop_status==7 || $coop_status==10){
    return true;
  }else{
    return false;
  }
}
// public function approve_by_supervisor_laboratories($admin_info,$coop_id,$coop_full_name){
//   $coop_id = $this->security->xss_clean($coop_id);
//   $this->db->select('laboratories.labName, users.*');
//   $this->db->from('laboratories');
//   $this->db->join('users' , 'users.id = laboratories.user_id','inner');
//   $this->db->where('laboratories.id', $coop_id);
//   $query = $this->db->get();
//   $client_info = $query->row();
// //  $this->db->trans_begin();
//   $this->db->where('id',$coop_id);
//   $this->db->update('laboratories',array('status'=>12,'first_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
//   $supervisor_emails = $this->admin_model->get_emails_of_supervisor_by_region($admin_info->region_code);
//   if($this->db->trans_status() === FALSE){
//     $this->db->trans_rollback();
//     return false;
//   }else{
//     if($this->admin_model->sendEmailToDirectorApprovedBySupervisor($admin_info,$supervisor_emails,$coop_full_name)){
//       if($this->admin_model->sendEmailToClientApprove($supervisor_emails,$coop_full_name)){
//         $this->db->trans_commit();
//         return true;
//       }else{
//         $this->db->trans_rollback();
//         return false;
//       }
//     }else{
//       $this->db->trans_rollback();
//       return false;
//     }
//   }
// }

public function check_last_evaluated_laboratories($coop_id){
  $query = $this->db->get_where('laboratories',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=13){
    return true;
  }else{
    return false;
  }
}

public function approve_by_director_laboratories($admin_info,$coop_id){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('laboratories.labName, users.*');
  $this->db->from('laboratories');
  $this->db->join('users' , 'users.id = laboratories.user_id','inner');
  $this->db->where('laboratories.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row_array();
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('laboratories',array('status'=>18,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToClientApproveLaboratories($client_info['labName'],$client_info['email'])){
      $this->db->trans_commit();
      return true;
    }else{
      $this->db->trans_rollback();
      return false;
    }

      $this->db->trans_commit();
      return true;

  }
}
// ANJURY START
    private $_table = "coop_type";
    public function get_type_of_coop($type_of_coop)
    {
        $type_of_coop = $this->security->xss_clean($type_of_coop);
        $this->db->select('coop_type_upload.*')
                 ->from($this->_table)
                 ->join("coop_type_upload",$this->_table.".id = coop_type_upload.coop_type_id",'left')
                 ->where($this->_table.".coop_name = '$type_of_coop' ORDER BY coop_type_upload.coop_type_id DESC");
//        $query = $this->db->get();
//        return $query->row();
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function get_type_of_coop_single($type_of_coop,$coop_id)
    {
        $type_of_coop = $this->security->xss_clean($type_of_coop);
        $this->db->select('*')
                 ->from("coop_type_upload")
                 ->where("id = '$coop_id'");
        $query = $this->db->get();
        return $query->row();
//        $query = $this->db->get();
//        $data = $query->result_array();
//        return $data;
    }

    public function insert_audit_log_cooperatives_change_status($data_field){
        $this->db->trans_begin();
        $this->db->insert('cooperatives_status_change_audit',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function get_provinces($regCode){
    $this->db->select('provDesc,provCode,regCode');
    $this->db->where(array('regCode'=>$regCode));
    $query = $this->db->get('refprovince');
    return $query->result_array();
  }
  public function get_cities($provCode){
    $this->db->select('citymunDesc,citymunCode,provCode,regCode');
    $this->db->where(array('provCode'=>$provCode));
    $query = $this->db->get('refcitymun');
    return $query->result_array();
  }
   public function get_brgys($cityCode){
    $this->db->select('brgyCode,brgyDesc,citymunCode,provCode');
     // $this->db->select('brgyCode,brgyDesc');
    $this->db->where(array('citymunCode'=>$cityCode));
    $query = $this->db->get('refbrgy');
    return $query->result_array();
  }
// ANJURY END
}
