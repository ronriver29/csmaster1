<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class amendment_update_model extends CI_Model{

  public $last_query = null;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  // public function get_coop($regNo){
  //   $this->db->select('registeredcoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,cooperatives.proposed_name, cooperatives.category_of_cooperative, cooperatives.grouping,cooperative_type.id as type_id,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,cooperatives.interregional,cooperatives.regions,cooperatives.acronym_name');
  //   $this->db->from('registeredcoop');
  //   $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
  //   $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //   $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //   $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  //   $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
  //   $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');
  //   $this->db->where('registeredcoop.regNo', $regNo);
  //   $query = $this->db->get();

  // return $query->row();
  // }

   public function check_date_registered($regNo)
  {
    $query = $this->db->query("select regNo, DATE(CASE WHEN LOCATE('-', dateRegistered) = 3 THEN STR_TO_DATE(dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', dateRegistered) = 5 THEN STR_TO_DATE(dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(dateRegistered, '%d/%m/%Y') END) as dateRegistered from registeredcoop where regNo = '$regNo' and migrated=0 and dateRegistered >=DATE('2020-09-30') AND migrated =1 order by id asc limit 1");
    if($query->num_rows()==1)
    {
      return false;
    }
    else
    {
      return true;
    }

  }
  
  public function get_coop_info($regNo)
  {
    
    $query = $this->db->query("select * from registeredcoop where regNo = '$regNo' ");
     return $query->result_array();
  }
  // public function check_if_has_registered($user_id)
  // {
  //   $query = $this->db->get_where('cooperatives',array('users_id'=>$user_id,'status'=>15));
  //   if($query->num_rows() ==1)
  //   {
  //     return true;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }
 
  public function get_regNo_by_user_id($user_id)
  {
    $data = null;
    $query = $this->db->query("select regNo from users where id='$user_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data = $row['regNo'];
      }
    }
    return $data;
  }
  public function get_all_cooperatives_registration($regcode){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status = 15 AND ho=0');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  //done updating process
   public function get_all_registered_amendment($regcode,$limit,$start,$coopName,$regNo){
     $ho=0;
    if($regcode=='00')
    {
      $ho=1;
    }
    $coopName = (strlen($coopName)>0 ? " AND amend_coop.proposed_name like '%".$coopName."%'" : '');
    $regNo = (strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'"  : '');
    $this->db->limit($limit, $start);
    $this->db->select('amend_coop.*,registeredamendment.dateRegistered as dateRegistered,registeredamendment.coopName, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    ($regcode !=='00' ? $this->db->like('refregion.regCode', $regcode) : '');
    $this->db->where('status = 41 AND ho='.$ho.' AND amend_coop.migrated=1'.$coopName.$regNo);
    $query = $this->db->get();
    $data = $query->result_array();
    unset($query);
    return $data;
  }

   public function get_all_registered_amendment_count($regcode,$coopName,$regNo){
    $ho=0;
    if($regcode=='00')
    {
      $ho=1;
    }
     $coopName = (strlen($coopName)>0 ? " AND amend_coop.proposed_name like '%".$coopName."%'" : '');
      $regNo = (strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'"  : '');
    $this->db->select('amend_coop.*,registeredamendment.dateRegistered as dateRegistered,registeredamendment.coopName, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
     ($regcode !=='00' ? $this->db->like('refregion.regCode', $regcode) : '');
    $this->db->where('status = 41 AND ho='.$ho.' AND amend_coop.migrated=1'.$coopName.$regNo);
    return $this->db->count_all_results();
    unset($coopName);
    unset($regNo);
    unset($ho);
  }


  public function get_all_registered_amendment_ho($regcode){
    $this->db->select('amend_coop.*,registeredamendment.dateRegistered as dateRegistered,registeredamendment.coopName, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('amend_coop.status = 41 AND amend_coop.ho=1 AND amend_coop.migrated =1');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_debydefer($regcode){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    // $this->db->where('status = 10 OR status =11 AND ho=0');
    $this->db->where('ho =0 AND status IN(10,11)');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }


  public function get_all_cooperatives_by_ho_senior($regioncode,$amendment_id){
    $amendment_id = implode(',', $amendment_id);
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regioncode);
    $this->db->where('status IN ("6","12","13","14") AND amend_coop.id IN('.$amendment_id.') AND ho=1');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

    public function get_all_cooperatives_by_ho_senior2($regioncode){
    // $amendment_id = implode(',', $amendment_id);
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regioncode);
    $this->db->where('status IN ("6","12","13","14") AND ho=1');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_amendment($amendment_id){
    $this->db->select('registeredamendment.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,amend_coop.proposed_name, amend_coop.category_of_cooperative, amend_coop.grouping,amend_coop.cooperative_type_id as type_id,amend_coop.common_bond_of_membership,amend_coop.field_of_membership,amend_coop.name_of_ins_assoc,amend_coop.acronym as acronym_name,amend_coop.type as coopTypes');
    $this->db->from('registeredamendment');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredamendment.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('amend_coop','amend_coop.id=registeredamendment.amendment_id','inner');
    // $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');
    $this->db->where('registeredamendment.amendment_id', $amendment_id);
    $query = $this->db->get();

  return $query->row();
  }


  public function get_business_activity_coop($regNo){
    $this->db->select('business_activities_cooperative.industry_subclass_by_coop_type_id as BAC_id, major_industry.description as mdesc, subclass.description as sdesc');
    $this->db->from('registeredcoop');
    $this->db->join('business_activities_cooperative','business_activities_cooperative.cooperatives_id = registeredcoop.application_id','inner');
    $this->db->join('industry_subclass_by_coop_type','industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry','major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass','subclass.id = industry_subclass_by_coop_type.subclass_id');
    $this->db->where('regNo',$regNo);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function get_coop_composition($amendment_id){
    // $this->db->select('composition_of_members.id,composition_of_members.composition');
    // $this->db->from('amendment_members_composition_of_cooperative');
    // $this->db->join('composition_of_members','amendment_members_composition_of_cooperative.composition=composition_of_members.id','inner');
    // $this->db->where('amendment_members_composition_of_cooperative.amendment_id',$amendment_id);
    // $query = $this->db->get();
    $query = $this->db->query("select * From amendment_members_composition_of_cooperative where amendment_id=".$amendment_id);
    return $query->result_array();
  }

  public function amendment_composition($amendment_id)
  {
    $data = null;
       $this->db->select('composition_of_members.id,composition_of_members.composition');
    $this->db->from('amendment_members_composition_of_cooperative');
    $this->db->join('composition_of_members','amendment_members_composition_of_cooperative.composition=composition_of_members.id','inner');
    $this->db->where('amendment_members_composition_of_cooperative.amendment_id',$amendment_id);
    $query = $this->db->get();
    if($query->num_rows()>0)
    {
      $data =$query->result_array();
    }
    return $data;
  }
  public function get_composition(){
    // $this->db->from('composition_of_members');
     $query=$this->db->query('select * from composition_of_members order by composition asc');
    // $query = $this->db->get();

    return $query->result(); 
  }
  public function name_coop_primary($regNo)
  {
    $query = $this->db->query("select coopName from registeredcoop where regNo='$regNo' order by id asc limit 1");
    return $query->row();
  }
  public function get_payment_info($amendment_id){
    $this->db->select('*');
    $this->db->from('payment');
    $this->db->where('amendment_id',$amendment_id);
    $this->db->where('nature','Amendment');
    $query = $this->db->get();
    return $query->row();
  }
  public function save_OR($where, $data, $di){
    $this->db->trans_begin();
    $this->db->update('amend_coop', array('status'=>14),array('id'=>$di));
    $this->db->update('payment', $data, $where);
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }
  }

  public function get_all_cooperatives($user_id){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('amend_coop.users_id', $user_id)->order_by('amend_coop.id','desc');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_specialist($regcode,$admin_id){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>3,'evaluated_by'=>$admin_id));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_specialist_central_office($regcode){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>3,'evaluated_by >'=>0));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_senior($regcode,$amendment_id){

      $amendment_id_arr = implode(',', $amendment_id);
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("2","3","4","5","6","12","13","14","16")  AND amend_coop.id IN ('.$amendment_id_arr.') AND ho=0');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_ho_director($regcode,$amendment_id){
      $amendment_id_arr = implode(',', $amendment_id);
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->like('refregion.regCode', $regcode);  
    $this->db->where('status IN ("9") AND amend_coop.id IN('.$amendment_id_arr.') AND ho=1');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_not_ho_list_of_coop($amendment_id)
  {
    $amendment_id_arr = implode(',',$amendment_id);
     $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('status IN ("9") AND amend_coop.id IN('.$amendment_id_arr.') AND ho=1');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_director($regcode,$amendment_id){
      $amendment_id_arr = implode(',', $amendment_id);
    // End Get Coop Type for HO
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status IN ("7","8","9","17") AND amend_coop.id IN ('.$amendment_id_arr.') AND ho=0');
    // $this->db->where_in('status',array('7','8','9'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
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
  public function get_all_business_activities($amendment_id){
    $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
    $this->db->from('business_activities_cooperative_amendment');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative_amendment.amendment_id',$amendment_id);
    $query = $this->db->get();
    $data =null;
    if($query->num_rows()>0)
    {
       $data = $query->result_array();
    }
   
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
  public function get_cooperative_info($cooperative_id,$amendment_id){
    $this->db->select('amend_coop.*,registeredamendment.coopName,registeredamendment.dateRegistered, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment' ,'registeredamendment.cooperative_id = amend_coop.cooperative_id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->order_by('registeredamendment.id desc');
    $this->db->limit(1);
    $this->db->where(array('amend_coop.cooperative_id'=>$cooperative_id,'amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function coop_info_in_evaluate_function($amendment_id)
  {
    $this->db->select('amend_coop.type_of_cooperative,refregion.regCode as rCode');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment' ,'registeredamendment.cooperative_id = amend_coop.cooperative_id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->order_by('registeredamendment.id desc');
    $this->db->limit(1);
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function coop_info_to_email($amendment_id)
  {
    $this->db->select('amend_coop.amendmentNo,amend_coop.house_blk_no,amend_coop.street,amend_coop.regNo,registeredamendment.coopName, refbrgy.brgyDesc as brgy,refcitymun.citymunDesc as city,refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment' ,'registeredamendment.cooperative_id = amend_coop.cooperative_id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->order_by('registeredamendment.id desc');
    $this->db->limit(1);
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_coop_info2($amendment_id)
  {
    $data =null;
    $query = $this->db->query("select amend_coop.*,registeredamendment.coopName,registeredamendment.Street from amend_coop left join registeredamendment on amend_coop.regNo = registeredamendment.regNo where amend_coop.id='$amendment_id' order by registeredamendment.id desc limit 1");
    if($query->num_rows()==1)
    {
      $data = $query->row();
    }
    return $data;
  }

  public function get_cooperative_info23($cooperative_id,$amendment_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('amend_coop.cooperative_id'=>$cooperative_id,'amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_amendment_info($amendment_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_amendment_info_byreg($regNo){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredamendment', 'registeredamendment.regNo = amend_coop.regNo');
    $this->db->where(array('registeredamendment.regNo'=>$regNo));
    $this->db->where("amend_coop.status IN (15,41)");
   $this->db->order_by('id', 'DESC');
   $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
  }


  // public function get_cooperative_info_by_admin($amendment_id){
  //   $this->db->select('amend_coop.*,amend_coop.acronym, amend_coop.proposed_name,registeredcoop.dateRegistered,registeredcoop.noStreet,registeredcoop.addrCode,registeredcoop.application_id,registeredcoop.qr_code, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,amend_coop.regNo');
  //   $this->db->from('amend_coop');
  //   $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //   $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //   $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //   $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  //   $this->db->join('registeredcoop','amend_coop.cooperative_id = registeredcoop.application_id');
  //   $this->db->where(array('amend_coop.id'=>$amendment_id));
  //   $this->db->limit(1);
  //   $query = $this->db->get();
  //   return $query->row();
  // }

  public function get_cooperative_info_by_admin($amendment_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,amend_coop.type_of_cooperative');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->join('payment', 'amend_coop.id = payment.amendment_id');
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_last_amendment_info($regNo)
  {
    $query = $this->db->query("select * from amend_coop where regNo='$regNo' and status=15  order by id desc limit 1");
     return $query->row();
  }

  public function amendment_info_by_regno($regno)
  {
    $query = $this->db->query("select comp_of_membership from amend_coop where regNo='$regno' and status=15 order by id desc limit 1 ");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        return $row['comp_of_membership'];
      }
    }
  }
  public function coop_info_by_regno($regno)
  {
    $query = $this->db->query("select application_id from registeredcoop where regNo='$regno' order by id desc limit 1");
    return $query->row();
  }

  public function get_composition_of_members_by_coop($coop_id)
  {
    $data = NULL;
    $query = $this->db->query("select coop_mem.coop_id,composition_of_members.* from members_composition_of_cooperative as coop_mem left join composition_of_members on coop_mem.composition = composition_of_members.id  where coop_mem.coop_id='$coop_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data[] = $row['composition'];
      }
    }
    return $data;
  }
  public function get_composition_of_members_by_amendment($coop_id,$amendment_id)
  {
    $data= NULL;
    $query = $this->db->query("select coop_mem.coop_id,composition_of_members.* from amendment_members_composition_of_cooperative as coop_mem left join composition_of_members on coop_mem.composition = composition_of_members.id  where coop_mem.coop_id='$coop_id' and coop_mem.amendment_id ='$amendment_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data[] = $row['composition'];
      }
    }
    // $data = implode(',',$data);
    return $data;
  }

  public function get_cooperative_id_by_regNo($regNo)
  {
    $query = $this->db->query("select application_id from registeredcoop where regNo = '$regNo'");
    $data =null;
    if($query->num_rows()==1)
    {
      foreach($query->result_array() as $row)
      {
        $data = $row['application_id'];
      }
    }
    return $data;
  }  
  public function get_cooperative_info_by_admin_payment($amendment_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,amend_coop.type_of_cooperative, payment.date_of_or as dateRegistered');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('payment', 'amend_coop.id = payment.amendment_id');
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }


  public function get_cooperative_info_by_admin_amendment($amendment_id){
    $this->db->select('amend_coop.*,amend_coop.acronym, amend_coop.proposed_name,registeredcoop.dateRegistered,registeredcoop.noStreet,registeredcoop.addrCode,registeredcoop.application_id,registeredcoop.qr_code, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,amend_coop.regNo');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','amend_coop.id = registeredcoop.amendment_id');
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
  }


  public function if_had_amendment($regNo,$amendment_id)
  {
    $qry = $this->db->query("select amend_coop.regNo,amend_coop.amendmentNo,reg.amendment_no  from amend_coop 
left join registeredamendment as reg ON reg.regNo = amend_coop.regNo
where amend_coop.regNo ='$regNo' and amend_coop.status =15 and amend_coop.id <> '$amendment_id'  order by amend_coop.id desc limit 1");
    if($qry->num_rows()>0)
    {
          return true;
    }
    else
    {
      return false;
    }
  }

   public function if_had_amendment_new($regNo)
  {
    $qry = $this->db->query("select amend_coop.regNo,amend_coop.amendmentNo,reg.amendment_no  from amend_coop 
left join registeredamendment as reg ON reg.regNo = amend_coop.regNo
where amend_coop.regNo ='$regNo' and amend_coop.status =15  order by amend_coop.id desc limit 1");
    if($qry->num_rows()>0)
    {
          return true;
    }
    else
    {
      return false;
    }
  }

  public function if_had_amendment_for_cor($regNo,$current_amendment_id)
  {
//     $qry = $this->db->query("select amend_coop.regNo,amend_coop.amendmentNo,reg.amendment_no  from amend_coop 
// left join registeredamendment as reg ON reg.regNo = amend_coop.regNo
// where amend_coop.regNo ='$regNo' and amend_coop.id !='$current_amendment_id' and amend_coop.status =15 order by amend_coop.id desc limit 1");
    $qry = $this->db->query("select * from registeredamendment where regNo ='$regNo' and amendment_id <> '$current_amendment_id' order by id desc");
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }
    else
    {
      return false;
    }
  }

  public function add_amendment($data_amendment,$major_industry,$subtypes_array,$members_composition,$type_of_coop_id_array,$data_bylaws)
  {
    $data = $this->security->xss_clean($data_amendment);

    $major_industry = $this->security->xss_clean($major_industry);
    $subtypes_array = $this->security->xss_clean($subtypes_array);
    $batch_subtype = array();

    $cooperative_ID=$data_amendment['cooperative_id'];
    $last_amendment_dtl = $this->amendment_dtl($cooperative_ID);
    // return $amendment_dtl->id;
    $this->db->trans_begin();
    $this->db->insert('amend_coop',$data_amendment);
    $id = $this->db->insert_id();


// return  $major_industry;
    $major_data= array_combine($major_industry,$subtypes_array);
    foreach($major_data as $major => $subclasses)
    {
      $qrys = $this->db->query("select id,cooperative_type_id from industry_subclass_by_coop_type where major_industry_id='$major' and subclass_id='$subclasses'");
      foreach($qrys->result() as $r)
      {
        $cooperative_typeID = $r->cooperative_type_id;
        $industry_subclassID = $r->id;
      }
      $data_major_and_subclasses[] = array('cooperatives_id'=> $cooperative_ID,'amendment_id'=>$id,'industry_subclass_by_coop_type_id'=>$industry_subclassID,'cooperative_type_id'=>$cooperative_typeID,'major_industry_id'=>$major,'subclass_id'=>$subclasses);
    }
    // return  $data_major_and_subclasses;
    $this->db->insert_batch('business_activities_cooperative_amendment', $data_major_and_subclasses);

    //capitalization
     $qry_capitalization = $this->db->get_where('amendment_capitalization',array('amendment_id'=>$last_amendment_dtl->id));
    if($qry_capitalization->num_rows()>0)
    {
      foreach($qry_capitalization->result_array() as $cap_rows)
      {
        $cap_rows['amendment_id'] = $id;
        unset($cap_rows['id']);
        $data_capitalization = $cap_rows;
      }
    }
    $this->db->insert('amendment_capitalization',$data_capitalization);
    //end capitalization


    //amendment cooperator
    $qry_cooperator = $this->db->get_where('amendment_cooperators',array('amendment_id'=>$last_amendment_dtl->id));
    if($qry_cooperator->num_rows()>0)
    {
      foreach($qry_cooperator->result_array() as $coop_rows)
      {
        // unset($coop_rows['orig_cooperator_id']);
        $coop_rows['orig_cooperator_id'] = $coop_rows['id'];
        // // unset($coop_rows['amendment_id']);
        $coop_rows['amendment_id']=$id;
        unset($coop_rows['id']);
        $coop_rows['created_at'] = date('Y-m-d h:i:s',now('Asia/Manila'));
        $coop_rows['updated_at'] = date('Y-m-d h:i:s',now('Asia/Manila'));
        // $data_cooperators[]= $coop_rows;
        $original_cooperators_id[]=$coop_rows['orig_cooperator_id'];//coopetive cooperators
        $data_cooperators[]= $coop_rows;
      }
    }
   
    $this->db->insert_batch('amendment_cooperators',$data_cooperators);
    //end amendment cooperators
  // return $original_cooperators_id;
    //committees 
    foreach($original_cooperators_id as $cooperators_ID)
    {
    
      $query_comittees=$this->db->get_where('amendment_committees',array('amendment_cooperators_id'=>$cooperators_ID));
       
      if($query_comittees->num_rows()>0)
      {
        foreach($query_comittees->result_array() as $row_committees)
        {
          $row_committees['amendment_id']=$id;
          //get the updated amendment cooeprators id 
          $row_committees['amendment_cooperators_id'] = $this->get_amendment_cooperators_id($row_committees['amendment_cooperators_id']);
       
          $row_committees['orig_committee_id'] = $row_committees['id'];
          $row_committees['orig_cooperators_id'] = $row_committees['amendment_cooperators_id'];
          // unset($row_committees['cooperators_id']);
          unset($row_committees['id']);
          $data_committiees[] = $row_committees;
        }
      }   
    }
    // return $data_committiees;
    $this->db->insert_batch('amendment_committees',$data_committiees);


    //  //economic survey
    // $qry_economic_survey = $this->db->get_where('amendment_economic_survey',array('amendment_id'=>$last_amendment_dtl->id));
    // if($qry_economic_survey->num_rows()>0)
    // {
    //   foreach($qry_economic_survey->result_array() as $row_economic)
    //   {
    //     $row_economic['cooperatives_id'] = $cooperative_ID;
    //     $row_economic['amendment_id'] = $id;
    //     unset($row_economic['id']);
    //     $data_economic = $row_economic;
    //   }
    // }
    // // return $data_economic;
    // $this->db->insert('amendment_economic_survey',$data_economic);
     // end economic survey

     //Staff
    // $qry_staff = $this->db->get_where('amendment_staff',array('amendment_id'=>$last_amendment_dtl->id));
    // if($qry_staff->num_rows()>0)
    // {
    //   foreach($qry_staff->result_array() as $row_staff)
    //   {
    //     $row_staff['amendment_id'] = $id;
    //     $row_staff['orig_staff_id']= $row_staff['id'];
    //     unset($row_staff['id']);
    //     $data_staff[]=$row_staff;
    //   }
    // }
    // // return $data_staff;
    // $this->db->insert_batch('amendment_staff',$data_staff);
    //end Staff

    //articles of cooperation
    $qry_articles_cooperation=$this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$last_amendment_dtl->id));
    if($qry_articles_cooperation->num_rows()>0)
    {
      foreach($qry_articles_cooperation->result_array() as $article_rows)
      {
        unset($article_rows['id']);
        $article_rows['amendment_id'] = $id;
        $data_articles_cooperation = $article_rows;
      }
    }
    // return $data_articles_cooperation;
    $this->db->insert('amendment_articles_of_cooperation',$data_articles_cooperation);

    $compo = explode(',',$members_composition);
    $this->db->select('id');
    $this->db->where_in('id',$compo);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $members = $query->result_array();
    // return $this->db->last_query();
    // return $members;
    if($query->num_rows()>0)
    {
       $batch_composition = array();
      foreach($members as $composition){
        array_push($batch_composition, array(
          'coop_id'=> $cooperative_ID,
          'amendment_id' =>$id,
          'composition'=>$composition['id'])
        );
      }
    // return  $batch_composition;
    $this->db->insert_batch('amendment_members_composition_of_cooperative', $batch_composition);
    }

    // $this->db->select('id');
    // $this->db->where_in('id',$members_composition);
    // $this->db->from('composition_of_members');
    // $query = $this->db->get();
    // $members = $query->result_array();

    // $batch_composition = array();
    // foreach($members as $composition){
    //   array_push($batch_composition, array(
    //     'coop_id'=> $cooperative_ID,
    //     'amendment_id' =>$id,
    //     'composition'=>$composition['id'])
    //   );
    // }

    // $this->db->insert_batch('amendment_members_composition_of_cooperative', $batch_composition);
   

    //amendment purposes
      if(strcasecmp($data_amendment['type_of_cooperative'], $last_amendment_dtl->type_of_cooperative)==0)
      {

          $query_purposes = $this->db->query("SELECT cooperative_type,content FROM amendment_purposes WHERE amendment_id='$last_amendment_dtl->id'");
          foreach($query_purposes->result() as $p)
          {
             $data_p = array(
                'cooperatives_id' => $cooperative_ID,
                'amendment_id' => $id,
                'cooperative_type' => $p->cooperative_type,
                'content' => $p->content
             );
              $this->db->insert('amendment_purposes',$data_p);
          }
         
        
        
      }
      else
      {
        //if there's a changes
        $type_coop = explode(',',$data_amendment['type_of_cooperative']);
       // $original_type_coop = explode(',',$last_amendment_dtl->type_of_cooperative);
       foreach($type_coop as $key => $rowcoop_type)
       {
      
         $temp_purpose[] = array(
        'cooperatives_id' => $cooperative_ID,
        'amendment_id' => $id,
        'cooperative_type'=>$rowcoop_type,
        'content'  => $this->get_purpose_content($rowcoop_type)
         );
          
       }
      $this->db->insert_batch('amendment_purposes',$temp_purpose);
      }
       
     //end of purposes
     
 
      //amendment_bylaws
    $bylaws_coop_info = $this->amendment_by_laws($last_amendment_dtl->id,$id);
    $bylaws_amendment = array_filter($bylaws_coop_info);
    // unset($bylaws_amendment['annual_regular_meeting_day']);
    unset($bylaws_amendment['annual_regular_meeting_day_venue']);
    // unset($bylaws_amendment['annual_regular_meeting_day_date']);
    // return   $bylaws_amendment;
    $this->db->insert('amendment_bylaws',$bylaws_amendment);
    //amendmnet_bylaws

    
    $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$id));
    // $process =0;
    // $success=0;
    //  $qry_file = $this->db->query("SELECT * FROM uploaded_documents WHERE cooperatives_id='$cooperative_ID' AND document_num NOT IN(1,2)");
    // if($qry_file->num_rows()>0)
    // {
      
    //   foreach($qry_file->result_array() as $row_file)
    //   {

        
    //     $row_file['amendment_id']=$id;
    //     // $row_file['cooperative_id'] = $row_file['cooperatives_id'];
    //     unset($row_file['id']);
    //     unset($row_file['cooperatives_id']);  
    //     unset($row_file['laboratory_id']); 
    //     unset($row_file['branch_id']);
    //     $new_name =$id.'_'.$row_file['filename'];
    //     $row_file['created_at']=date('Y-m-d h:i:s',now('Asia/Manila'));
    //     $row_file['author'] = $this->session->userdata('user_id');
    //     $row_file['filename'] = $new_name;
    //     if(file_exists(APPPATH.'../uploads/amendment/'.$row_file['filename']))
    //     {
    //       $process++;
    //       if(copy(APPPATH.'../uploads/amendment/'.$row_file['filename'],APPPATH.'../uploads/amendment/'.$new_name))
    //       {
    //         if($this->db->insert('amendment_uploaded_documents',$row_file))
    //         {
    //             $success++;
    //         }
          
    //       }
    //     }
    //     // $row_file['filename'] = $new_name;
    //     //  $data_file[]=$row_file;
    //   }
    // }

        // if($process>0 && $success ==$process)
        if($success ==$process)
        {
        // if($this->db->insert_batch('amendment_uploaded_documents',$data_file)){
        }
        else
        {
          $this->db->trans_rollback();
          return false;
        }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }

  }

  // public function get_regNo_by_user($user_id)
  // {
  //   $data =null;
  //   $query = $this->db->query("select regno from users where id = '$user_id'");
  //   if($query->num_rows()>0)
  //   {
  //     $data = $query->row();
  //   }
  //   return $data;
  // }
  public function add_cooperative($data,$major_industry,$subtypes_array,$members_composition,$type_of_coop_id_array,$data_bylaws){
    $data = $this->security->xss_clean($data);
    $major_industry = $this->security->xss_clean($major_industry);
    $subtypes_array = $this->security->xss_clean($subtypes_array);
    $members_composition = $this->security->xss_clean($members_composition);
    $batch_subtype = array();
    
    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$type_of_coop_id_array));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subtypes_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();
    $industry_subclasses_id_array = $query->result_array();

    // $data['type_of_cooperative'] = $coop_type->name;
    $cooperative_ID=$data['cooperative_id'];
    $this->db->trans_begin();
    $this->db->insert('amend_coop',$data);
    $id = $this->db->insert_id();
    // $array_cooptype_id =   explode(",",$type_of_coop_id_array);
    // foreach($industry_subclasses_id_array as $industry_subclasses_id){
    //   foreach($array_cooptype_id as $cip)
    //   {
        

    //     $qry = $this->db->query("select id from industry_subclass_by_coop_type where cooperative_type_id='$cip'");
    //     foreach($qry->result_array() as $arow)
    //     {
    //       $industry_subclassID = $arow['id'];
    //     }

    //     array_push($batch_subtype, array(
    //     'cooperatives_id'=> $cooperative_ID,
    //     'cooperative_type_id'=> $cip,
    //     'amendment_id' => $id,
    //     'industry_subclass_by_coop_type_id'=>$industry_subclassID)
    //    );
    //   }
      
    // }
    // foreach($major_industry as $key=>$major)
    // {
    //   $major =3;// $subtypes_array[$key];
    //   $major_data[] = $major;
    // }
    $major_data= array_combine($major_industry,$subtypes_array); 
    foreach($major_data as $major => $subclasses)
    {
      $qrys = $this->db->query("select id,cooperative_type_id from industry_subclass_by_coop_type where major_industry_id='$major' and subclass_id='$subclasses'");
      // return $this->db->last_query();
      foreach($qrys->result() as $r)
      {
        $cooperative_typeID = $r->cooperative_type_id;
        $industry_subclassID = $r->id;
      }
      $data_major_and_subclasses[] = array('cooperatives_id'=> $cooperative_ID,'amendment_id'=>$id,'industry_subclass_by_coop_type_id'=>$industry_subclassID,'cooperative_type_id'=>$cooperative_typeID,'major_industry_id'=>$major,'subclass_id'=>$subclasses);
    }
    
    $this->db->insert_batch('business_activities_cooperative_amendment', $data_major_and_subclasses);

      //capitalization
    $qry_capitalization = $this->db->get_where('capitalization',array('cooperatives_id'=>$cooperative_ID));
    if($qry_capitalization->num_rows()>0)
    {
      foreach($qry_capitalization->result_array() as $cap_rows)
      {
        $cap_rows['amendment_id'] = $id;
        unset($cap_rows['id']);
        $data_capitalization = $cap_rows;
      }
    }
    $this->db->insert('amendment_capitalization',$data_capitalization);

    //amendment cooperator
    $qry_cooperator = $this->db->get_where('cooperators',array('cooperatives_id'=>$cooperative_ID));
    if($qry_cooperator->num_rows()>0)
    {
      foreach($qry_cooperator->result_array() as $coop_rows)
      {
        $coop_rows['orig_cooperator_id'] = $coop_rows['id'];
        $coop_rows['amendment_id']=$id;
        unset($coop_rows['id']);
        $data_cooperators[]= $coop_rows;
        $original_cooperators_id[]=$coop_rows['orig_cooperator_id'];//coopetive cooperators
      }
        $this->db->insert_batch('amendment_cooperators',$data_cooperators);
    } 
    // return $data_cooperators;
  
    //end amendment cooperators
    // return $original_cooperators_id;
    //committees
    if(count($original_cooperators_id)>0)
    {
        foreach( $original_cooperators_id as $cooperatorsID)
        {
          $query_comittees=$this->db->get_where('committees',array('cooperators_id'=>$cooperatorsID));
          if($query_comittees->num_rows()>0)
          {
            foreach($query_comittees->result_array() as $row_committees)
            {
              $row_committees['amendment_id']=$id;
              //get the updated amendment cooeprators id 
              $row_committees['amendment_cooperators_id'] = $this->get_amendment_cooperators_id($row_committees['cooperators_id']);

              $row_committees['orig_committee_id'] = $row_committees['id'];
              $row_committees['orig_cooperators_id'] = $row_committees['cooperators_id'];
              unset($row_committees['cooperators_id']);
              unset($row_committees['id']);
              unset($row_committees['committees_year']);
              $data_committiees[] = $row_committees;
            }
          }   
        }
        $this->db->insert_batch('amendment_committees',$data_committiees);  
    }
    
    //end committees 

    //economic survey
    // $qry_economic_survey = $this->db->get_where('economic_survey',array('cooperatives_id'=>$cooperative_ID));
    // if($qry_economic_survey->num_rows()>0)
    // {
    //   foreach($qry_economic_survey->result_array() as $row_economic)
    //   {
    //     $row_economic['cooperatives_id'] = $cooperative_ID;
    //     $row_economic['amendment_id'] = $id;
    //     unset($row_economic['id']);
    //     $data_economic[] = $row_economic;
    //   }
    // }
    // $this->db->insert_batch('amendment_economic_survey',$data_economic);
     // end economic survey

    //Staff
    // $qry_staff = $this->db->get_where('staff',array('cooperatives_id'=>$cooperative_ID));
    // if($qry_staff->num_rows()>0)
    // {
    //   foreach($qry_staff->result_array() as $row_staff)
    //   {
    //     $row_staff['amendment_id'] = $id;
    //     $row_staff['orig_staff_id']= $row_staff['id'];
    //     unset($row_staff['id']);
    //     $data_staff[]=$row_staff;
    //   }
    // }
    // // return $data_staff;
    // $this->db->insert_batch('amendment_staff',$data_staff);
    //end Staff

    //articles of cooperation
    $qry_articles_cooperation=$this->db->get_where('articles_of_cooperation',array('cooperatives_id'=>$cooperative_ID));
    if($qry_articles_cooperation->num_rows()>0)
    {
      foreach($qry_articles_cooperation->result_array() as $article_rows)
      {
        unset($article_rows['id']);
        $article_rows['amendment_id'] = $id;
        $data_articles_cooperation = $article_rows;
      }
    }

    $this->db->insert('amendment_articles_of_cooperation',$data_articles_cooperation);

    $compo = explode(',',$members_composition);
    $this->db->select('id');
    $this->db->where_in('id',$compo);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $members = $query->result_array();
    // return $this->db->last_query();
    // return $members;
    if($query->num_rows()>0)
    {
       $batch_composition = array();
      foreach($members as $composition){
        array_push($batch_composition, array(
          'coop_id'=> $cooperative_ID,
          'amendment_id' =>$id,
          'composition'=>$composition['id'])
        );
      }
    // return  $batch_composition;
    $this->db->insert_batch('amendment_members_composition_of_cooperative', $batch_composition);
    }
   
    //amendment purposes
       $qry_purposes = $this->db->get_where('cooperatives',array('id'=>$cooperative_ID));
        if($qry_purposes->num_rows()>0)
        {
         foreach($qry_purposes->result_array() as $row)
         {
          $coop_types = $row['type_of_cooperative'];
         } 
        }

      $type_coop = explode(',',$data['type_of_cooperative']);
      foreach($type_coop as $pkey=> $rowcoop_type)
      {
        if($coop_types == $rowcoop_type)
        {
          //get purposes of cooperative
          $q_p = $this->db->get_where('purposes',array('cooperatives_id'=>$cooperative_ID));
          if($q_p->num_rows()>0)
          {
            foreach($q_p->result_array() as $prows)
            {
                 $existing_coop_purposes= $prows['content'];
            }
           // return $existing_coop_purposes;
            $temp_purpose[] = array(
            'cooperatives_id' => $cooperative_ID,
            'amendment_id' => $id,
            'cooperative_type'=>$rowcoop_type,
            'content'  => $existing_coop_purposes
             );
          }
        }
        else
        {
           $temp_purpose[] = array(
          'cooperatives_id' => $cooperative_ID,
          'amendment_id' => $id,
          'cooperative_type'=>$rowcoop_type,
          'content'  => $this->get_purpose_content($rowcoop_type)
           );
        }  
      }
      // return $temp_purpose;
      $this->db->insert_batch('amendment_purposes',$temp_purpose);
      // return $this->db->last_query();
   

    $bylaws_coop_info = $this->cooperative_by_laws($cooperative_ID,$id);
    $bylaws_amendment = array_filter($bylaws_coop_info);
    unset($bylaws_amendment['annual_regular_meeting_day_date']);
    $this->db->insert('amendment_bylaws',$bylaws_amendment);
    $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$id));
    //document upload
    // $this->db->where('cooperatives_id',$cooperative_ID);
    // $this->db->where_in('document_num',array(1,2));
    // $qry_file = $this->db->get('uploaded_documents');
    // $qry_file = $this->db->query("select * from uploaded_documents where cooperatives_id='$cooperative_ID' and document_num >=1 and document_num<=18");
     $qry_file = $this->db->query("SELECT * FROM uploaded_documents WHERE cooperatives_id='$cooperative_ID' AND document_num NOT IN(1,2)");
    // if($qry_file->num_rows()>0)
    // {
    //   $process =0;
    //   $success=0;
    //   foreach($qry_file->result_array() as $row_file)
    //   {

        
    //     $row_file['amendment_id']=$id;
    //     $row_file['cooperative_id'] = $row_file['cooperatives_id'];
    //     unset($row_file['id']);
    //     unset($row_file['cooperatives_id']);  
    //     unset($row_file['laboratory_id']); 
    //     unset($row_file['branch_id']);
    //     $new_name =$id.'_'.$row_file['filename'];
    //     $row_file['created_at']=date('Y-m-d h:i:s',now('Asia/Manila'));
    //     $row_file['author'] = $this->session->userdata('user_id');
    //     $row_file['filename'] = $new_name;
    //     // if(copy(APPPATH.'../uploads/'.$row_file['filename'],APPPATH.'../uploads/amendment/'.$new_name))
    //     if(file_exists(UPLOAD_DIR.$row_file['filename'] ))
    //     { $process++;
    //       if(copy(UPLOAD_DIR.$row_file['filename'],UPLOAD_AMD_DIR.$new_name))
    //       {
    //         if( $this->db->inser('amendment_uploaded_documents',$row_file))
    //         {
    //           $success++;
    //         }
    //       }
    //     }//end of file exist 
    //     // $success++;
    //     // $row_file['filename'] = $new_name;
    //     // $data_file[]=$row_file;
    //   }
    // }
    // return  $data_file;
        // if($process>0 && $success ==$process)
       // if($success ==$process)
       //  {
       //     // $this->db->insert_batch('amendment_uploaded_documents',$data_file);
       //  }
       //  else
       //  {
       //    $this->db->trans_rollback();
       //    return false;
       //  }
   
    //end document

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  
  public function get_amendment_cooperators_id($orig_cooperator_id)
  {
    $qry = $this->db->query("select id from amendment_cooperators where orig_cooperator_id='$orig_cooperator_id' order by id desc limit 1");
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        return $row['id'];
      }
    }
  }

  //amend bylaws 
  public function amendment_by_laws($last_amendment_id,$amendment_id)
  {
    $qry= $this->db->get_where("amendment_bylaws",array('amendment_id'=>$last_amendment_id));
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        $row['amendment_id'] = $amendment_id;
        unset($row['composition_of_bod']);
        unset($row['id']);
        $data =$row;
      }
    }
    else
    {
      $data = NULL;
    }
    return $data;
  }

  //end amndment bylaws

  //modified by json
  public function cooperative_by_laws($coop_id,$amendID)
  {
    $qry= $this->db->get_where("bylaws",array('cooperatives_id'=>$coop_id));
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        $row['amendment_id'] = $amendID;
        unset($row['composition_of_bod']);
        unset($row['id']);
        $data =$row;
      }
    }
    else
    {
      $data = NULL;
    }
    return $data;
  }
  // public function update_not_expired_cooperative($user_id,$amendment_id,$field_data,$subclass_array,$major_industry,$members){
  public function update_not_expired_cooperative($user_id,$amendment_id,$field_data,$major_industry,$data_bylaws){
    $data = $this->security->xss_clean($field_data);
    $coop_id = $data['cooperative_id'];
    $param1 = $data['cooperative_type_id'];
     // $major_industry = implode(",",$major_industry);
    $coopertiveTypeID=explode(",",$data['cooperative_type_id']);
    $amendment_info = $this->get_cooperative_info23($coop_id,$amendment_id);

   $this->db->trans_begin();

   //check if have bylaws
    if($data['type_of_cooperative'] != 'Union')
    { 
      $business_info_coop = $this->business_activities_cooperative_by_coop_id($coop_id);
       $business_data = array();
      if($business_info_coop!=NULL)
      {
        
          foreach($business_info_coop as $bsrow)
          {
            $bsrow['cooperatives_id'] = $coop_id;
            $bsrow['amendment_id'] = $amendment_id;
            $business_data = array($bsrow);
          }
          unset($bsrow);
           $this->db->delete('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
           if($this->db->insert_batch('business_activities_cooperative_amendment',$business_data))
           {
              if(count($major_industry)>0)
              {
                foreach($major_industry as $major_row)
                {
                  $major_row['industry_subclass_by_coop_type_id'] = $this->industry_subclass_by_coop_type_amd($major_row['major_id'],$major_row['subclass_id']);
                  // $major_row['cooperative_type_id'] = $data['cooperative_type_id'];
                  $major_row['cooperatives_id'] = $coop_id;
                  $major_row['amendment_id'] = $amendment_id;
                  $major_row['major_industry_id'] = $major_row['major_id'];
                  unset($major_row['major_id']);
                  $final_business_data[] = $major_row;
                }
                unset($major_row);
                if($this->db->delete('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id)))
                {
                  $this->db->insert_batch('business_activities_cooperative_amendment',$final_business_data);
                }
              }
           }
      
      }
      elseif($this->business_activities_cooperative_amendment($amendment_id))
      {
          if(!empty($major_industry)>0)
          {
                $this->db->delete('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
                foreach($major_industry as $major_row)
                {
                  $major_row = array_filter($major_row);
                  if(!empty($major_row))
                  {
                     $major_row['industry_subclass_by_coop_type_id'] = $this->industry_subclass_by_coop_type_amd($major_row['major_id'],$major_row['subclass_id']);
                  
                    $major_row['cooperatives_id'] = $coop_id;
                    $major_row['amendment_id'] = $amendment_id;
                    $major_row['major_industry_id'] = $major_row['major_id'];
                    unset($major_row['major_id']);
                     $final_business_data = $major_row;
                      $this->db->insert('business_activities_cooperative_amendment',$final_business_data);
                  }           
                }     
          }
      }
      else
      {  
              if(!empty($major_industry))
              {
                foreach($major_industry as $major_row)
                {
                  $major_row = array_filter($major_row);
                  if(!empty($major_row))
                  {
                    
                    $major_row['industry_subclass_by_coop_type_id'] = $this->industry_subclass_by_coop_type_amd($major_row['major_id'],$major_row['subclass_id']);
                     
                      $major_row['cooperatives_id'] = $coop_id;
                      $major_row['amendment_id'] = $amendment_id;
                       // $major_row['cooperative_type_id'] = $data['cooperative_type_id'];
                      $major_row['major_industry_id'] = $major_row['major_id'];
                      unset($major_row['major_id']);
                      $final_business_data = $major_row;
                       $this->db->insert('business_activities_cooperative_amendment',$final_business_data);
                  }
                }
              }
      }
    }
  
    // update amendment
    if(!$this->db->update('amend_coop',$data,array('id'=>$amendment_id)))
    {
      return false;
    }
    //update registeredamendment
      $array_reginfo= array(
      'amendment_id'=>$amendment_id,
      'amendment_no' => $data['amendmentNo'],
      'cooperative_id' => $data['cooperative_id'],
      // 'dateRegistered'=> $this->input->post('dateRegistered'),
      'type'=> $data['type_of_cooperative'],
      'grouping' =>$data['grouping'],
      'category'=> $data['category_of_cooperative'],
      'areaOfOperation' => $data['area_of_operation'],
      'commonBond' => $data['common_bond_of_membership'],
      // 'addrCode' =>$this->input->post('barangay_'),
      'noStreet' => $data['house_blk_no'],
      'Street' => $data['street'],
      // 'interregional' => $interregional,
      'regions' => $data['regions'],
      );
    $this->update_reg_info($data['regNo'],$array_reginfo);
    unset($array_reginfo);

   //if Common bond of memebship is occupation
    if($data['common_bond_of_membership'] == 'Occupational')
    {
      $composition_input = explode(',',$data['comp_of_membership']);
      foreach($composition_input as $composition_id){
          $data_composition[] =array(
                      'amendment_id'=> $amendment_id,
                      'composition'=>$composition_id, 
                      'coop_id'=>$coop_id
                  );
      
      } 
       $data_composition = array_filter($data_composition);
       $this->db->delete('amendment_members_composition_of_cooperative',array('amendment_id'=>$amendment_id));
       $this->db->insert_batch('amendment_members_composition_of_cooperative', $data_composition);
       unset($data_composition);
    }
    else
    {
      //delete if not occupational
      $this->db->delete('amendment_members_composition_of_cooperative',array('amendment_id'=>$amendment_id));
    }
    unset($amendment_id);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function update_reg_info($regNo,$data)
  {
    $query = $this->db->query("select id,regNo,coopName from registeredamendment where regNo='$regNo' order by id desc limit 1");
    if($query->num_rows()==1)
    {
      foreach($query->result() as $row)
      {
        if($this->db->update('registeredamendment',$data,array('id'=>$row->id)))
        {
          unset($row);
          unset($query);
          unset($data);
        }
        else
        {
          return false;
        }
      }
    }
  }
  public function check_purposes($amendment_id)
  {
    $data = false;
    $check_purposes = $this->db->get_where('amendment_purposes',array('amendment_id'=>$amendment_id));
    if($check_purposes->num_rows()>0)
    {
      $data =true;
    }
    return $data;
  }
  public function check_has_bylaws($amendment_id)
  {
    $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$amendment_id));
    if($query->num_rows() ==1)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function business_activities_cooperative_by_coop_id($coop_id)
  {
    $data =null;
    $query = $this->db->get_where('business_activities_cooperative',array('cooperatives_id'=>$coop_id));
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        unset($row['id']);
        $data[] = $row;
      }
    }
    return $data;
  }
  public function industry_subclass_by_coop_type($id)
  {
    $data = null;
    $query = $this->db->get_where('industry_subclass_by_coop_type',array('id'=>$id));
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        // unset($row['id']);
        $data[] = $row;
      }
    }
    return $data;
  }

   public function business_activities_cooperative_amendment($amendment_id)
  {
    $data =false;
    $query = $this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
    if($query->num_rows()>0)
    {
     $data = true;
    }
    return $data;
  }
  public function industry_subclass_by_coop_type_amd($major_id,$subclass_id)
  {
    $data = 0;
    $query = $this->db->get_where('industry_subclass_by_coop_type',array('major_industry_id'=>$major_id,'subclass_id'=>$subclass_id));
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data = $row['id'];
      }
    }
    return $data;
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
    $this->db->select('name');
    $this->db->where('id',$data['type_of_cooperative']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();
    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->where(array('id'=>$coop_id));
    $this->db->update('amend_coop',$data);
    $this->db->delete('business_activities_cooperative',array('cooperatives_id'=>$coop_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'cooperatives_id'=> $coop_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
    $temp_purpose = array(
        'cooperatives_id' => $coop_id,
        'content'  => $this->get_purpose_content($coop_type->name)
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
public function delete_cooperative($amendment_id){
  $this->db->trans_begin();
  $this->db->delete('amend_coop',array('id' => $amendment_id));
  $this->db->delete('amendment_purposes',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('amendment_cooperators',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('amendment_bylaws',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('amendment_capitalization',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('amendment_articles_of_cooperation',array('amendment_id'=>$amendment_id)); 
  $this->db->delete('amendment_economic_survey',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('amendment_staff',array('amendment_id'=>$amendment_id)); //modified by json
  $this->db->delete('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
  $this->db->delete('amendment_committees',array('amendment_id'=>$amendment_id));//modified by json
  $this->db->delete('amendment_members_composition_of_cooperative',array('amendment_id'=>$amendment_id));
  $this->db->delete('amendment_uploaded_documents',array('amendment_id'=>$amendment_id));
  $this->db->delete('registeredcoop',array('amendment_id'=>$amendment_id));

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}

 public function coop_info_reg($amendment_id)
  {

    $query =$this->db->query("select amend_coop.id,amend_coop.area_of_operation,amend_coop.refbrgy_brgyCode,amend_coop.type_of_cooperative,amend_coop.amendmentNo,amend_coop.grouping,registeredamendment.coopName,registeredamendment.amendment_id,registeredamendment.id as reg_id,registeredamendment.dateRegistered from amend_coop left join registeredamendment ON registeredamendment.cooperative_id = amend_coop.cooperative_id where amend_coop.id='$amendment_id'");
    // return $this->db->last_query();
    if($query->num_rows() == 1)
    {
       foreach($query->result_array() as $row)
       {
          if($row['amendment_id'] == NULL)
          {
               if($this->db->update('registeredamendment',array('amendment_id'=>$row['id']),array('id'=>$row['reg_id'])))
              {
                $data = $query->row();
              }
          }
          else
          {
            $data = $query->row();
          }
         
       }
    }
    return $data;
  }

public function submit_to_authorized_user($amendment_id,$region_code,$user_id){
  $this->load->model('email_model');
  $user_id = $this->security->xss_clean($user_id);
  $amendment_id = $this->security->xss_clean($amendment_id);
  $coop_info = $this->coop_info_to_email($amendment_id);
  $client_qry = $this->db->get_where('users',array('id'=>$user_id));
  $client_info = $client_qry->row();
  
  $ho =0;
  if($region_code =='00')
  {
    $ho =1;
  }
  $this->db->trans_begin();
  $this->db->where(array('id'=>$amendment_id));
  $this->db->update('amend_coop',array('status'=>40,'ho'=>$ho,'updated_at'=>date('Y-m-d h:i:s')));

  $auth_info =$this->authorized_user($region_code);
   $this->email_model->sendEmailtoClientupdate($client_info);
   foreach($auth_info as $row)
      {
        // $process++;
          $admin_authorized_email =  $row['email'];
          // echo $senior_email;
          
             if($this->email_model->sendEmailtoAuthorized($admin_authorized_email,$coop_info,$client_info)){
             $this->db->trans_commit();
             // $success++;
             // return true;
            }else{
             $this->db->trans_rollback();
             return false;
            }
      }
      unset($row);
          
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      return true;
    }
  
 
  //  
  //    if($this->db->trans_status() === FALSE){
  //     $this->db->trans_rollback();
  //     return false;
  //   }else{
  //     foreach($auth_info as $row)
  //     {
  //       $process++;
  //         $senior_email =  $row['email'];
  //         // echo $senior_email;
  //          if($this->email_model->sendEmailfirstSubmissionAmendment($client_info,$senior_email,$amendment_info)){
  //          $this->db->trans_commit();
  //          $success++;
  //          // return true;
  //         }else{
  //          $this->db->trans_rollback();
  //          return false;
  //         }
  //     }
  //   }
}

public function submit_by_authorized_user($amendment_id,$region_code){
 $this->load->model('email_model');
  $amendment_id = $this->security->xss_clean($amendment_id);
  $cooperative_id = $this->coop_dtl($amendment_id);
  $amendment_info = $this->get_cooperative_info($cooperative_id,$amendment_id);//$this->get_cooperative_info23($cooperative_id,$amendment_id);
  // $reg_coop_name = $amendment_info->coopName;

  $client_qry = $this->db->get_where('users',array('id'=>$amendment_info->users_id));
  $client_info = $client_qry->row();

  // $this->db->trans_begin();
  $ho =0;
  if($region_code=='00')
  {
    $ho =1;
  }

  $this->db->where(array('id'=>$amendment_id));
  if($this->db->update('amend_coop',array('status'=>41,'ho'=>$ho,'updated_at'=>date('Y-m-d h:i:s'))))
  {

     $array_reg_data= array(
          'amendment_id'=>$amendment_id,
          'amendment_no' => $amendment_info->amendmentNo,
          'type'=> $amendment_info->type_of_cooperative,
          'grouping' =>$amendment_info->grouping,
          'category'=> $amendment_info->category_of_cooperative,
          'areaOfOperation' => $amendment_info->area_of_operation,
          'commonBond' => $amendment_info->common_bond_of_membership,
          'addrCode' => $amendment_info->refbrgy_brgyCode,
          'noStreet' => $amendment_info->house_blk_no,
          'Street' => $amendment_info->street,
          'interregional' => $amendment_info->interregional,
          'regions' => $amendment_info->regions,
     );
     // return $array_reg_data;
        $qry_reg = $this->db->query("select id from registeredamendment where regNo='$amendment_info->regNo' order by id desc limit 1");
        foreach($qry_reg->result_array() as $reg_amd)
        {
          $reg_amd_id = $reg_amd['id'];
        }
       if($this->db->update('registeredamendment',$array_reg_data,array('id'=>$reg_amd_id)))
       {
        // return true;
        // $auth_info =$this->authorized_user($region_code);
        //  foreach($auth_info as $row)
        // {
        //     $admin_authorized_email =  $row['email'];            
              
        // }
         
          if($this->email_model->sendEmailsubmitAll($amendment_info,$client_info)){
               $this->db->trans_commit();
               // $success++;
               return true;
              }else{
               $this->db->trans_rollback();
               return false;
              }
       }
       else
       {
        return false;
       }
  }
  else
  {
    return false;
  }

         if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
          }else{
            return true;
          }
}

 public function authorized_user($region_code)
    {
      $data = null;
      $query= $this->db->get_where('admin',array('region_code'=>$region_code,'access_level'=>6,'active'=>1));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        unset($row);
      }
      return $data;
    }

public function submit_for_reevaluation($user_id,$amendment_id,$region_code){
   $user_id = $this->security->xss_clean($user_id);
  $amendment_id = $this->security->xss_clean($amendment_id);
  $cooperative_id = $this->coop_dtl($amendment_id);
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amendment_id);
  $client_qry = $this->db->get_where('users',array('id'=>$user_id));
  $client_info = $client_qry->row();
  $admin_info = $this->admin_info_by_region($region_code);
  $senior_info =$this->senior_info($region_code);
  $this->db->trans_begin();
  $this->db->where(array('users_id'=>$user_id,'id'=> $amendment_id));
  $this->db->update('amend_coop',array('status'=>6));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
      $success = 0;
     $process = 0;
      foreach($senior_info as $row)
      {
        $process++;
          $senior_email =  $row['email'];
            if($this->email_model->sendEmailDefferedtoSenior($client_info,$senior_email,$amendment_info)){
             $this->db->trans_commit();
            $success++;
             // return true;
            }else{
             $this->db->trans_rollback();
             return false;
            }
      }   
      // return $process.':'.$success;
       if($process == $success && $this->email_model->sendEmailtoClientResubmission($client_info))
        {
          return true;
        }
        else
        {
          return false;
        } 
     // if($this->email_model->sendEmailDefferedtoSenior($client_info,$admin_info,$amendment_info)){
     //   $this->db->trans_commit();
     //   return true;
     //  }else{
     //   $this->db->trans_rollback();
     //   return false;
     //  }
  }
}
public function assign_to_specialist($amendment_id,$specialist_id){
  $specialist_id = $this->security->xss_clean($specialist_id);
  $amendment_id = $this->security->xss_clean($amendment_id);

  $cooperative_id = $this->coop_dtl($amendment_id);
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amendment_id);
  // return $amendment_info;
  $client_qry = $this->db->get_where('users',array('id'=>$amendment_info->users_id));
  $client_info = $client_qry->row();
  // return $client_info;
  $this->db->trans_begin();
  $query = $this->db->get_where('admin',array('id'=>$specialist_id));
  $admin_info = $query->row();
// return $admin_info;
  $this->db->where(array('id'=>$amendment_id));
  $this->db->update('amend_coop',array('status'=>3,'evaluated_by'=>$specialist_id));
 
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
       return false; 
  }else{

    // return $this->email_model->sendEmailToSpecialistAmendment($admin_info,$client_info,$amendment_info);
     if($this->email_model->sendEmailToSpecialistAmendment($admin_info,$client_info,$amendment_info)){
       $this->db->trans_commit();
       return true;
     }else{
       $this->db->trans_rollback();
       return false;  
     }
  }
} 
public function approve_by_specialist($admin_info,$coop_id,$coop_full_name,$coop_type,$specialist_info){
  $amentmentID =  $this->security->xss_clean($coop_id);
  $temp = $this->get_cooperative_info_by_admin($coop_id);
                $ho =0;
               $amendment_id_ho = array();
               $amendment_id  = array();
             
                 $types_coop = explode(',',$coop_type);
                 // return $types_coop; 

                 $ho_arr = $this->get_ho_list();
                 $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
                 if($result)
                 { // ho coop
                    $ho =1;
                 }
                 // else
                 // { //no ho coop
                    
                 // }
  $cooperative_id = $this->coop_dtl($amentmentID);
           
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amentmentID);
  $client_qry = $this->db->get_where('users',array('id'=>$amendment_info->users_id));
  $client_info = $client_qry->row();

  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if($this->db->update('amend_coop',array('status'=>6,'evaluated_by'=>$specialist_info->id,'evaluation_comment'=>NULL,'ho'=>$ho)))
  {
     $this->db->trans_commit();
     return true;
  }else{
     $this->db->trans_rollback();
     return false;
  }

  // return $this->email_model->sendEmailToSeniorAmendment($admin_info,$client_info,$amendment_info,$specialist_info);
   // if($this->email_model->sendEmailToSeniorAmendment($admin_info,$client_info,$amendment_info,$specialist_info)){
   //   $this->db->trans_commit();
   //   return true;
   // }else{
   //   $this->db->trans_rollback();
   //   return false;
   // }
      
  
}
public function approve_by_senior($admin_info,$coop_id,$coop_full_name,$data_comment){
  $amentmentID = $this->security->xss_clean($coop_id);
  $already_deffered = false;
  $cds_fullname =  $this->get_cds_by_amendment($amentmentID);
  // return $cds_fullname;
  if($this->check_if_has_deffered($amentmentID))
  {
    $already_deffered = true;
  }
 
 
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>9,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  
  $cooperative_id = $this->coop_dtl($amentmentID);    
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amentmentID);
  $client_qry = $this->db->get_where('users',array('id'=>$amendment_info->users_id));
  $client_info = $client_qry->row();

  $director_info = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
  // return $director_info;
  foreach($director_info as $director)
  {
    $director_email = $director['email'];
  }
 
  //if comment is not empty
  if(strlen($data_comment['comment'])>0)
  {
    $this->db->insert('amendment_comment',$data_comment); //insert comment
  }
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    

   if($this->email_model->sendEmailToDirectorAmendment($admin_info,$client_info,$amendment_info,$director_email,$cds_fullname)){
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

// public function approve_by_senior_ho($admin_info,$coop_id,$coop_full_name,$data_comment){
//   $coop_id = $this->security->xss_clean($coop_id);
//   $this->db->trans_begin();
//   $this->db->where('id',$coop_id);
//   $this->db->update('amend_coop',array('status'=>9,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
//   $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
//   $this->db->insert('amendment_comment',$data_comment); //insert comment
//   if($this->db->trans_status() === FALSE){
//     $this->db->trans_rollback();
//     return false;
//   }else{
//     // return $director_emails;
//     foreach($director_emails as $demail)
//     {
//       $director_email = $demail['email'];
//     }

//    if($this->email_model->sendEmailToDirectorAmendment($admin_info,$director_email,$coop_full_name)){
//      $this->db->trans_commit();
//      return true;
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
//       $this->db->trans_commit();
//       return true;
//   }
// }
public function approve_by_supervisor($admin_info,$coop_id,$coop_full_name){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, users.*');
  $this->db->from('amend_coop');
  $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
  $this->db->where('amend_coop.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
  $supervisor_emails = $this->admin_model->get_emails_of_supervisor_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
   if($this->admin_model->sendEmailToDirectorApprovedBySupervisor($admin_info,$supervisor_emails,$coop_full_name)){
     if($this->admin_model->sendEmailToClientApprove($client_info->proposed_name,$client_info->email)){
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
        $this->db->trans_commit();
        return true;
  }
}
public function approve_by_director($admin_info,$coop_id,$comment){
  $coop_id = $this->security->xss_clean($coop_id);

  $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative,amend_coop.acronym, amend_coop.regNo, users.*');
  $this->db->from('amend_coop');
  $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
  $this->db->where('amend_coop.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row();

  if(strlen($client_info->acronym)>0)
  {
    $acronym_ = ' ('.$client_info->acronym.')';
  }
  else
  {
     $acronym_='';
  }
  if(count(explode(',',$client_info->type_of_cooperative))>1)
  {
     $proposedName = $client_info->proposed_name.' Multipurpose Cooperative'.$acronym_;
  }
  else
  {
    $proposedName =$client_info->proposed_name.' '.$client_info->type_of_cooperative. ' Cooperative'.$acronym_;
  }
 
  $regNo = $client_info->regNo;
  $this->db->trans_begin();
  // $this->db->insert('amendment_comment',$comment);

  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
  $no_of_amendments = 1;
  $query_amendments = $this->db->where(array("regNo"=>$regNo))->get("amend_coop");
  if($query_amendments->num_rows()>0) {
      $no_of_amendments = $query_amendments->num_rows();
  }
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
   
   
   if($this->email_model->sendEmailToClientAmendmentApprove($proposedName,$client_info->email,$coop_id)){
     $this->db->trans_commit();
     return true;
   }else{
     $this->db->trans_rollback();
     return false;
   }
      $amendmentNo = $regNo.'-'.$no_of_amendments;
      $this->db->trans_commit();
        $this->db->where("(CHAR_LENGTH(amendmentNo)=0 OR amendmentNo IS NULL) AND id = '$coop_id'")->update("amend_coop",array("amendmentNo"=>$amendmentNo));
        $this->db->trans_commit();
      return true;
  }
}

public function deny_by_admin($admin_id,$coop_id,$data_comment,$step,$admin_info){
    $cooperative_id = $this->coop_dtl($coop_id);  
   $amendment_info =$this->get_cooperative_info23($cooperative_id,$coop_id);
    $this->db->insert('amendment_comment',$data_comment); //insert comment
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('amend_coop',array('evaluated_by'=>$admin_id,'status'=>4,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60)))));
  else if($step==2)
    $this->db->update('amend_coop',array('second_evaluated_by'=>$admin_id,'status'=>7,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60)))));
  else 
    $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>10,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60)))));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, amend_coop.grouping, users.*');
      $this->db->from('amend_coop');
      $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
      $this->db->where('amend_coop.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // return $client_info;
      if($this->admin_model->sendEmailToClientDenyAmendment($client_info,$amendment_info,$data_comment,$admin_info)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}
public function defer_by_admin($admin_id,$coop_id,$reason_commment,$step,$data_comment){
  $amentmentID = $this->security->xss_clean($coop_id);
  $admin_info = $this->admin_model->get_admin_info($admin_id);
  // return $this->acbl($amentmentID);
  $cooperative_id = $this->coop_dtl($amentmentID);    
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amentmentID);
  $this->db->trans_begin();
// return $reason_commment;
  if($step ==4)
  { 
    $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>17,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60)))),array('id'=>$coop_id));
  }elseif ($step==3){
      $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60)))),array('id'=>$coop_id));
  }
  
      // return $admin_id.' '.$coop_id.' '.$reason_commment.' '.$step.' '.$data_comment;
        $query3  = $this->db->get_where('regional_officials',array('region_code'=>$admin_info->region_code));
        if($query3->num_rows()>0)
        {
          $reg_officials_info = $query3->row_array(); 
        }
        else
        {
             $reg_officials_info = array(
              'email' => 'head_office@mail.com',
              'contact' => '00000000'
             );
        }
    
        $this->db->insert('amendment_comment',$data_comment);
        $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, amend_coop.grouping, users.*');
        $this->db->from('amend_coop');
        $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
        $this->db->where('amend_coop.id', $coop_id);
        $query = $this->db->get();
        $client_info = $query->row();
        if($step ==4)
        {
          $director_info = $this->admin_model->get_director_info($admin_info->region_code);
          // return $director_info;
          if($this->admin_model->sendEmailToDirectorRevertAmendment($amendment_info,$director_info))
           {
            $this->db->trans_commit();
            return true;
            }else{
              $this->db->trans_rollback();
              return false;
            }
        }
        else
        {
          // return $this->admin_model->sendEmailToClientDeferAmendment($client_info,$data_comment,$amendment_info,$reg_officials_info);
           if($this->admin_model->sendEmailToClientDeferAmendment($client_info,$data_comment,$amendment_info,$reg_officials_info)){
          $this->db->trans_commit();
          return true;
          }else{
            $this->db->trans_rollback();
            return false;
          }
        }
       
  // if ($step==1)
  //   $this->db->update('amend_coop',array('evaluated_by'=>$admin_id,'status'=>5,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  // else if($step==2)
  //   $this->db->update('amend_coop',array('second_evaluated_by'=>$admin_id,'status'=>8,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  // else 
  //   $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  // if($this->db->trans_status() === FALSE){
  //   $this->db->trans_rollback();
  //   return false;
  // }else{
    // if ($step==3){
    //   $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
    //   // return $admin_id.' '.$coop_id.' '.$reason_commment.' '.$step.' '.$data_comment;
    //     $query3  = $this->db->get_where('regional_officials',array('region_code'=>$admin_info->region_code));
    //     if($query3->num_rows()>0)
    //     {
    //       $reg_officials_info = $query3->row_array();
          

    //     }
    //     else
    //     {
    //          $reg_officials_info = array(
    //           'email' => 'head_office@mail.com',
    //           'contact' => '00000000'
    //          );
    //     }
    
    //     $this->db->insert('amendment_comment',$data_comment);
    //     $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, amend_coop.grouping, users.*');
    //     $this->db->from('amend_coop');
    //     $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
    //     $this->db->where('amend_coop.id', $coop_id);
    //     $query = $this->db->get();
    //     $client_info = $query->row();
    //     // return $client_info;
    //     if($this->admin_model->sendEmailToClientDeferAmendment($client_info,$reason_commment,$amendment_info,$reg_officials_info)){
    //       $this->db->trans_commit();
    //       return true;
    //     }else{
    //       $this->db->trans_rollback();
    //       return false;
    //     }
    // }else{
    //   $this->db->trans_commit();
    //   return true;
    // }
  // }
}
public function check_own_cooperative($cooperative_id,$amendment_id,$user_id){
  $cooperative_id = $this->security->xss_clean($cooperative_id);
    $query2 = $this->db->get_where('amend_coop', array('users_id' => $user_id,'cooperative_id'=>$cooperative_id,'id'=> $amendment_id));
   return $query2->num_rows() > 0 ? true : false;

}
// public function check_cooperative_exist($user_id){
//     $query2 = $this->db->get_where('cooperatives', array('users_id' => $user_id));
//     return $query2->num_rows() > 0 ? true : false;
// }
public function check_expired_reservation($cooperative_id,$coop_id,$user_id){
  $query = $this->db->get_where('amend_coop',array('cooperative_id'=>$cooperative_id,'users_id' => $user_id,'id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_expired_reservation_by_admin($cooperative_id,$amendment_id){
  $query = $this->db->get_where('amend_coop',array('id'=> $amendment_id,'cooperative_id'=>$cooperative_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_submitted_for_evaluation($cooperative_id,$amendment_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$amendment_id,'cooperative_id'=>$cooperative_id));
  $data = $query->row();
  $coop_status = $data->status;
  $accepted_status = array(2,3,6,9,10,11,12,13,16,14,15,17);
  // return $coop_status;
  if(in_array($coop_status,$accepted_status)){
    return true;
  }else{
    return false;
  }
}
public function check_submitted_for_evaluation_client($cooperative_id,$amendment_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$amendment_id,'cooperative_id'=>$cooperative_id));
  $data = $query->row();
  $coop_status = $data->status;
  $accepted_status = array(2,3,6,9,10,12,13,16,14,15,17);
  // return $coop_status;
  if(in_array($coop_status,$accepted_status)){
    return true;
  }else{
    return false;
  }
}

public function check_if_deferred($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id,'status'=>11));
  $data = $query->num_rows();
  if($data != 0){
    return true;
  }else{
    return false;
  }
}

public function if_past_deffered($amendment_id)
{
  $query = $this->db->query(" SELECT * FROM `amendment_comment` WHERE `amendment_id` = '$amendment_id' AND `status` = 11");
  if($query->num_rows()>0)
  {
    return true;
  }
  else
  {
    return false;
  }
}

public function check_not_yet_assigned($coop_id){
  $this->db->where(array('id'=>$coop_id,'status'=>2,'evaluated_by !='=>0));
  $this->db->from('amend_coop');
  if($this->db->count_all_results() == 0){
    return true;
  }else{
    return false;
  }
}
public function check_first_evaluated($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=6){
    return true;
  }else{
    return false;
  }
}
public function check_second_evaluated($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=9 || $coop_status ==11 ){
    return true;
  }else{
    return false;
  }
}
public function check_last_evaluated($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=10 ){
    return true;
  }else{
    return false;
  }
}
public function check_if_denied($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
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
    $this->db->select('amend_coop.proposed_name, cooperative_type.id as type_id');
    $this->db->from('amend_coop');
    $this->db->join('cooperative_type','amend_coop.type_of_cooperative=cooperative_type.name','inner');
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
    $this->db->select('amend_coop.proposed_name, cooperative_type.id as type_id');
    $this->db->from('amend_coop');
    $this->db->join('cooperative_type','amend_coop.type_of_cooperative=cooperative_type.name','inner');
    $this->db->where(array('amend_coop.id !='=>$decoded_id)); //,'status !=' => 0)
    $this->db->where_not_in('status', array('0','4','7','10'));
    $query = $this->db->get();
    $data = $query->result_array();
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

  public function  get_purpose_content($coop_type,$grouping){
  if($grouping =='Primary')
  {  
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
      'Bank' => 'Promoting and advancing the economic and social status of the members;'.
        'Coordinating and facilitating the activities of cooperatives;'.
        'Advocating for the cause of the cooperative movements;'.
        'Ensuring the viability of cooperatives through the utilization of new technologies;'.
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
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
        'Union' => ''
        // 'Federation'=>''
    );
    return $data[$coop_type];
  }elseif ($grouping =='Federation') {
    $data =
      '';
    return $data;
  }
  elseif ($grouping =='Union') {
    $data = array('Union'=>'');
    return $data[$coop_type];
  }

     
  }

  public function get_updated_coop_id($regNo)
  {
    $data =0;
    $query = $this->db->query("select application_id from registeredcoop where regNo='$regNo' order by id asc limit 1");
    if($query->num_rows()==1)
    {
      foreach($query->result() as $row)
      {
        $data = $row->application_id;
      }
    }
    return $data;
  }

    public function get_cooperatve_types($cooperative_type_id)
    {
      $cooptype_array  =explode(',',$cooperative_type_id);
      $qry=$this->db->where_in('cooperative_type_id',$cooptype_array)->get('amendment_coop_type_upload');
     $data = $qry->result_array();
     return $data;

    }

    public function coop_dtl($amendment_id)
    {
      $data =null;
      $this->db->select('cooperative_id');
      $this->db->from('amend_coop');
      $this->db->where(array('id'=>$amendment_id));
      $query = $this->db->get();
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      return $data;
    }

    public function amendment_dtl($cooperative_id)
    {
      $query = $this->db->query("select * from amend_coop where cooperative_id ='$cooperative_id' and status=15 order by id desc limit 1");
      if($query->num_rows()>0)
      {
        $data = $query->row();
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }

    //last amendment detail for print
    public function amendment_info_not_own_id($amendment_id)
    {
      $query = $this->db->query("select * from amend_coop where id <> '$amendment_id' and status =15 and status=14 order by id desc limit 1");
       if($query->num_rows()>0)
      {
        $data = $query->row();
      }
      else
      {
        //no amendment yet get detail in coop
        $data = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
        
      }
      return $data;
    }
    public function amendment_info($amendment_id)
    {
      $query = $this->db->query("select * from amend_coop where id ='$amendment_id'");
      if($query->num_rows()>0)
      {
        $data = $query->row();
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }

    public function admin_comment($amendment_id,$access_level)
    {
      $query = $this->db->query("select * from amendment_comment where amendment_id='$amendment_id' and access_level='$access_level' order by id desc");
      if($query->num_rows()>0)
      {
        $data=$query->result_array();
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }

    public function revert_comment($amendment_id)
    {
      $query = $this->db->query("select * from amendment_comment where amendment_id='$amendment_id' and status =17 order by id desc");
      if($query->num_rows()>0)
      {
        $data=$query->result_array();
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }


    public function get_comment_single($amendment_id, $access_level)
    {
      $data = null;
      $query = $this->db->query("select * from amendment_comment where status = 9 and access_level ='$access_level' and amendment_id = '$amendment_id' order by id desc limit 1");
      if($query->num_rows()>0)
      {
        $data = $query->result_array();
      }
      return $data;
    }

    public function get_comment_single_dir($amendment_id, $access_level)
    {
      $data = null;
      $query = $this->db->query("select * from amendment_comment where access_level ='$access_level' and amendment_id = '$amendment_id' order by id desc limit 1");
      if($query->num_rows()>0)
      {
        $data = $query->result_array();
      }
      return $data;
    }
  
    public function tool_findings($amendment_id)
    {
      $data=null;
      $query = $this->db->query("select tool_findings from amendment_comment where amendment_id='$amendment_id' order by id desc limit 1");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->tool_findings;
        }
      }
      return $data;
    }

     public function senior_tool_findings($amendment_id)
    {
      $data=null;
      $query = $this->db->query("select tool_findings from amendment_comment where amendment_id='$amendment_id' and access_level=2 order by id desc limit 1");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->tool_findings;
        }
      }
      return $data;
    }
      
     public function admin_comment_value($amendment_id,$access_level)
    {
      $query = $this->db->get_where('amendment_comment',array('amendment_id'=>$amendment_id,'access_level'=>$access_level));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row['comment'];
        }
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }

    public function deffered_comments($amendment_id,$access_level)
    {
       $query = $this->db->get_where('amendment_comment',array('amendment_id'=>$amendment_id,'access_level'=>$access_level,'status'=>11));
      if($query->num_rows()>0)
      {
        $data=$query->result_array();
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }

    public function client_diferred_comment($amendment_id)
    {
      $data = null;
      $query = $this->db->query("select * from amendment_comment where status =11 and amendment_id ='$amendment_id' order by id desc");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      return $data;
    }

     public function client_denied_comment($amendment_id)
    {
      $data = null;
      $query = $this->db->query("select * from amendment_comment where status =10 and amendment_id ='$amendment_id' order by id desc");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      return $data;
    }


    public function cooperatives_comments($coop_id){
      $query = $this->db->query("select * from amendment_comment where amendment_id='$coop_id' and status=11 and access_level IN(3,4)");
      return $query->result_array();
    }

    public function get_latest_comment_date($access_level,$amendment_id)
    {
      $data = date('Y-m-d h:i:s',now('Asia/Manila'));
      $query = $this->db->query("select amendment_id ,created_at From amendment_comment where access_level ='$access_level' and amendment_id ='$amendment_id' order by id desc limit 1");
      if($query->num_rows()>0)
      {
        return $query->row();
      }
      return $data;
    }
    public function get_total_count_regular($amendment_id)
    {
      $amendment_id = $this->security->xss_clean($amendment_id);
      $this->db->where('cooperatives_id',$amendment_id);
      $this->db->where('type_of_member',"Regular");
      $this->db->from('amendment_cooperators');
      return $this->db->count_all_results();
    }

    public function admin_info_by_region($region_code)
    {
      $query = $this->db->get_where('admin',array('region_code'=>$region_code,'access_level'=>2));
      return $query->row();
    }

    public function senior_info($region_code)
    {
      $data = null;
      $query= $this->db->get_where('admin',array('region_code'=>$region_code,'access_level'=>2));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      return $data;
    }
    public function get_all_cooperatives_registration_by_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status = 15 AND ho=1');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  //check if type is in HO
  public function checking_ho($coop_types)
  {
    $coop_types = $this->security->xss_clean($coop_types);
    $qry = $this->db->query("select name from head_office_coop_type where name like'%".$coop_types."%'");
    if($qry->num_rows()>0)
    {
      return 'true';
    }
    else
    {
      return 'false';
    }
  }
  public function check_ho_multipurpose_type($regcode)
  {
     //for multipurpose coop
     $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->where('refregion.regCode', $regcode);
    // $this->db->where('amend_coop.ho', 1);
    $qry_multi =$this->db->get();
    return $qry_multi->result_array();
    //end multipurpose
  }
  public function check_if_has_deffered($amendment_id)
  {
    $query = $this->db->get_where('amendment_comment',array('id'=>$amendment_id,'status'=>11));
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function get_ho_list()
  {
    $query = $this->db->query("select name from head_office_coop_type ");
    if($query->num_rows()>0)
    {
        foreach($query->result_array() as $row)
        {
          $data[] = $row['name']; 
        }
    }
    else
    {
      $data = null;
    }
    return $data;
  }
  
  public function get_common_bond($amendment_info)
  {
    $cooperative_id = $this->coop_dtl($amendment_info->id);
    if($this->if_had_amendment($amendment_info->regNo,$amendment_info->id))
    {
       $coop_info_orig = $this->get_last_amendment_info($amendment_info->cooperative_id,$amendment_info->id);
        $members_composition_orig = $this->amendment_model->get_coop_composition($coop_info_orig->id);
    }
    else
    {
      $coop_info_orig= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
       $members_composition_orig = $this->cooperatives_model->get_coop_composition($amendment_info->id);
    }
    
    // return $coop_info_orig;
    $openTag ='';
    $closeTag ='';
    if($coop_info_orig->common_bond_of_membership != $amendment_info->common_bond_of_membership)
    {
      $openTag ='<b>';
      $closeTag ='</b>';
    }
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
           return $openTag.$data.$closeTag;
    }
    else if($amendment_info->common_bond_of_membership == 'Institutional')
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
           return $openTag.$data.$closeTag;
    }
    else if ($amendment_info->common_bond_of_membership == 'Occupational')
    {
      $orig_compo = array();
        $counts= count($members_composition) -1;
        foreach($members_composition_orig as $compo_orig)
        {
          array_push($orig_compo,$compo_orig['composition']);
        }
        // return $orig_compo;
          if(is_array($members_composition)) 
          {
              foreach($members_composition as $keys => $compo)
            { 
              if(in_array($compo['composition'],$orig_compo))
              {
                // $compo['composition']; 
              }
              else
              {
                 $compo['composition'] =   '<b>'.$compo['composition'].'</b>';
              }
                $data .= $compo['composition']; 
                if($keys<$counts)
                {
                  $data .= ', ';
                }
            }
          } 
          return $data; 
    }
   else
   {
         $data .= ' of members working and/or residing in the area of operation'; 
          return $openTag.$data.$closeTag;
   }
  
  }
  

  public function get_composition_of_members()
  {
   $query = $this->db->get('composition_of_members');
   return $query->result_array();
  }

  public function get_all_amendments(){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('amend_coop.status NOT IN (1,15)');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function change_status_amendment($decoded_id,$data){
  $decoded_id = $this->security->xss_clean($decoded_id);
  $data = $this->security->xss_clean($data);

  $this->db->trans_begin();
  $this->db->where('id',$decoded_id);
  $this->db->update('amend_coop',$data);
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
  
   public function get_cooperative_info_by_admin_orig($coop_id){
    $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,cooperatives.type_of_cooperative');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.id'=>$coop_id,'cooperatives.status'=>15));
    $query = $this->db->get();
    return $query->row();
  }

  public function reg_coop_migrated_data($user_id)
  {
     $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'amend_coop.regNo = registeredcoop.regNo');
    $this->db->join('users', 'amend_coop.regNo = users.regNo');
    $this->db->where('amend_coop.status =15 and users.id='.$user_id);
    
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function no_of_doc($amendment_id,$doc_name)
  {
    $query = $this->db->get_where('document_info',array('amendment_id'=>$amendment_id,'name'=>$doc_name));
    if($query->num_rows()>0)
    {
      return $query->row();
    }
    else
    {
      return NULL;
    }
  }

  public function get_cds_by_amendment($amendment_id)
  {
    $query = $this->db->query("select amend_coop.evaluated_by,admin.full_name  from amend_coop left join admin on admin.id = amend_coop.evaluated_by where amend_coop.id='$amendment_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result() as $row)
      {
        $cds_name = $row->full_name;
      }
    }
    else
    {
      $cds_name = 'Unknown';
    }
    return $cds_name;
  }

  public function get_regno_by_amd_id($amendment_id)
  {
      $query = $this->db->query("select regNo from amend_coop where id ='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          return $row->regNo;
        }
      }
  }

  public function insert_tool_findings($data)
  {
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('amendment_comment', $data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function acbl($amendment_id)
  {
    // $cooperative_id = $this->coop_dtl($amendment_id);
    $amendment_info = $this->get_amendment_info($amendment_id);
    $last_amendment_info = $this->get_last_amendment_info($amendment_info->cooperative_id,$amendment_info->id);
    $bylaw_info = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_info->cooperative_id,$amendment_id);
    $capitalization_info= $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_info->cooperative_id,$amendment_id);
    $articles_info = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($amendment_info->cooperative_id,$amendment_id);
    $no_of_bod = $this->amendment_cooperator_model->check_directors_odd_number_amendment($amendment_id);
    $purposes =$this->amendment_purpose_model->get_purposes($amendment_id);
    if($this->if_had_amendment($amendment_info->regNo,$amendment_id))
    {
    //next amendment
      $coop_info_orig= $this->amendment_info_not_own_id($last_amendment_info->id);
      $capitalization_info_orig = $this->amendment_capitalization_model->get_capitalization_by_coop_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
      $no_of_bod_orig = $this->amendment_cooperator_model->check_directors_odd_number($last_amendment_info->cooperative_id,$last_amendment_info->id);
     $purposes_orig=$this->amendment_purpose_model->get_purposes($last_amendment_info->id);
      $articles_info_orig = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
      //BYLAW
      $bylaw_info_orig = $this->amendment_bylaw_model->get_bylaw_by_coop_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
      if($this->charter_model->in_charter_city($coop_info_orig->cCode))
      {
      $in_chartered_cities_orig=true;
      $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);
      }
    }
    else
    {
    //first amendment
      $coop_info_orig= $this->cooperatives_model->get_cooperative_info_by_admin($amendment_info->cooperative_id);
      $capitalization_info_orig = $this->capitalization_model->get_capitalization_by_coop_id($amendment_info->cooperative_id);
      $no_of_bod_orig = $this->cooperator_model->check_directors_odd_number($amendment_info->cooperative_id);
     $articles_info_orig = $this->article_of_cooperation_model->get_article_by_coop_id($amendment_info->cooperative_id);
      $purposes_orig=$this->purpose_model->get_all_purposes2($amendment_info->cooperative_id);
      //BYLAWS
      $bylaw_info_orig = $this->bylaw_model->get_bylaw_by_coop_id($amendment_info->cooperative_id);
      //END BYLAWS
        if($this->charter_model->in_charter_city($coop_info_orig->cCode))
        {
        $in_chartered_cities_orig=true;
        $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);
        }
    }

    if($amendment_info->house_blk_no==null && $amendment_info->street==null) $x=''; else $x=', ';
          if($coop_info_orig->house_blk_no==null && $coop_info_orig->street==null) $x=''; else $x=', ';
          $address = $amendment_info->house_blk_no.' '.ucwords($amendment_info->street).$x.' '.$amendment_info->brgy.' '.$amendment_info->city.', '.$amendment_info->province.' '.$amendment_info->region;
          $address_orig = $coop_info_orig->house_blk_no.' '.ucwords($coop_info_orig->street).$x.' '.$coop_info_orig->brgy.' '.$coop_info_orig->city.', '.$coop_info_orig->province.' '.$coop_info_orig->region;
          //basic info
          $typeOfcoop = $this->compare_param($amendment_info->type_of_cooperative,$coop_info_orig->type_of_cooperative);
          $proposeName = $this->compare_param($amendment_info->proposed_name,$coop_info_orig->proposed_name);
          $acronym_c = $this->compare_param($amendment_info->acronym,$coop_info_orig->acronym_name);
          $common_bond = $this->compare_param($amendment_info->common_bond_of_membership,$coop_info_orig->common_bond_of_membership);
          $areaOf_operation = $this->compare_param($amendment_info->area_of_operation,$coop_info_orig->area_of_operation);
          $fieldOfmemship = $this->compare_param($amendment_info->field_of_membership,$coop_info_orig->field_of_membership);
          //articles of cooperation
          $applicable_to_guardian =$this->compare_param($articles_info->guardian_cooperative,$articles_info_orig->guardian_cooperative);
          //capitalization
          $authorized_share_capital=$this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);
          $common_share= $this->compare_param($capitalization_info->common_share,$capitalization_info_orig->common_share);
          $preferred_share= $this->compare_param($capitalization_info->preferred_share,$capitalization_info_orig->preferred_share,$amendment_id);
          $par_value= $this->compare_param($capitalization_info->par_value,$capitalization_info_orig->par_value);
          $authorized_share_capital= $this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);
          $total_amount_of_subscribed_capital = $this->compare_param($capitalization_info->total_amount_of_subscribed_capital,$capitalization_info_orig->total_amount_of_subscribed_capital);
          // $amount_of_common_share_subscribed= $this->compare_param($capitalization_info->amount_of_common_share_subscribed,$capitalization_info_orig->amount_of_common_share_subscribed);
          $amount_of_preferred_share_subscribed = $this->compare_param($capitalization_info->amount_of_preferred_share_subscribed,$capitalization_info_orig->amount_of_preferred_share_subscribed);
          $total_amount_of_paid_up_capital =  $this->compare_param($capitalization_info->total_amount_of_paid_up_capital,$capitalization_info_orig->total_amount_of_paid_up_capital);
          // $amount_of_common_share_paidup = $this->compare_param($capitalization_info->amount_of_common_share_paidup,$capitalization_info_orig->amount_of_common_share_paidup);
          $amount_of_preferred_share_paidup =$this->compare_param($capitalization_info->amount_of_preferred_share_paidup,$capitalization_info_orig->amount_of_preferred_share_paidup);
          //cooperator
          $no_of_bod = $this->compare_param($no_of_bod,$no_of_bod_orig);
           //BYLAW
          $kinds_of_members = $this->compare_param($bylaw_info->kinds_of_members,$bylaw_info_orig->kinds_of_members);
          $additional_requirements_for_membership = $this->compare_param($bylaw_info->additional_requirements_for_membership,$bylaw_info_orig->additional_requirements_for_membership);
          $regular_qualifications = $this->compare_param($bylaw_info->regular_qualifications,$bylaw_info_orig->regular_qualifications);
          $associate_qualifications = $this->compare_param($bylaw_info->associate_qualifications,$bylaw_info_orig->associate_qualifications);
          $membership_fee = $this->compare_param($bylaw_info->membership_fee,$bylaw_info_orig->membership_fee);

          $act_upon_membership_days = $this->compare_param($bylaw_info->act_upon_membership_days,$bylaw_info_orig->act_upon_membership_days);
          $additional_conditions_to_vote = $this->compare_param($bylaw_info->additional_conditions_to_vote,$bylaw_info_orig->additional_conditions_to_vote);  
          $annual_regular_meeting_day = $this->compare_param($bylaw_info->annual_regular_meeting_day,$bylaw_info_orig->annual_regular_meeting_day);
    
          $members_percent_quorom = $this->compare_param($bylaw_info->members_percent_quorom,$bylaw_info_orig->members_percent_quorom);
          $number_of_absences_disqualification = $this->compare_param($bylaw_info->number_of_absences_disqualification,$bylaw_info_orig->number_of_absences_disqualification);
          $percent_of_absences_all_meettings = $this->compare_param($bylaw_info->percent_of_absences_all_meettings,$bylaw_info_orig->percent_of_absences_all_meettings);
          $director_hold_term = $this->compare_param($bylaw_info->director_hold_term,$bylaw_info_orig->director_hold_term);
          $member_invest_per_month = $this->compare_param($bylaw_info->member_invest_per_month,$bylaw_info_orig->member_invest_per_month);
          $member_percentage_annual_interest = $this->compare_param($bylaw_info->member_percentage_annual_interest,$bylaw_info_orig->member_percentage_annual_interest);
          $member_percentage_service = $this->compare_param($bylaw_info->member_percentage_service,$bylaw_info_orig->member_percentage_service);
          $percent_reserve_fund = $this->compare_param($bylaw_info->percent_reserve_fund,$bylaw_info_orig->percent_reserve_fund);
          $percent_education_fund = $this->compare_param($bylaw_info->percent_education_fund,$bylaw_info_orig->percent_education_fund);
          $percent_community_fund = $this->compare_param($bylaw_info->percent_community_fund,$bylaw_info_orig->percent_community_fund);
          $percent_optional_fund = $this->compare_param($bylaw_info->percent_optional_fund,$bylaw_info_orig->percent_optional_fund);
          $non_member_patron_years = $this->compare_param($bylaw_info->non_member_patron_years,$bylaw_info_orig->non_member_patron_years);
          $amendment_votes_members_with = $this->compare_param($bylaw_info->amendment_votes_members_with,$bylaw_info_orig->amendment_votes_members_with);
          $minimum_subscribed_share_regular =$this->compare_param($capitalization_info->minimum_subscribed_share_regular,$capitalization_info_orig->minimum_subscribed_share_regular);
          $minimum_paid_up_share_regular =$this->compare_param($capitalization_info->minimum_paid_up_share_regular,$capitalization_info_orig->minimum_paid_up_share_regular);
          $minimum_subscribed_share_associate =$this->compare_param($capitalization_info->minimum_subscribed_share_associate,$capitalization_info_orig->minimum_subscribed_share_associate);
          $minimum_paid_up_share_associate =$this->compare_param($capitalization_info->minimum_paid_up_share_associate,$capitalization_info_orig->minimum_paid_up_share_associate);
          $purposes_=false;
          $purposes_ = $this->compare_param($purposes_orig->content,$purposes->content);
          $purposes_ = 'false';
          $committee_others =$this->commitee_others($amendment_id);
          if(strcasecmp($address, $address_orig)!=0)
          {
            $address1 = 'true';
          }
          else
          {
            $address1 = 'false';
          }

    $artilces_array = array($typeOfcoop,
                      $proposeName,
                      $acronym_c,
                      $common_bond,
                      $areaOf_operation,
                      $fieldOfmemship,
                      $address1,
                      $authorized_share_capital,
                      $common_share,
                      $preferred_share,
                      $par_value,
                      $authorized_share_capital,
                      $total_amount_of_subscribed_capital,
                      // $amount_of_common_share_subscribed,
                      $amount_of_preferred_share_subscribed,
                      $total_amount_of_paid_up_capital,
                      // $amount_of_common_share_paidup,
                      $amount_of_preferred_share_paidup,
                      $purposes_,
                      $no_of_bod,
                      $applicable_to_guardian
                     );

    $bylaws_array = array(
                    $no_of_bod,
                    $kinds_of_members,
                    $additional_requirements_for_membership,
                    $regular_qualifications,
                    $associate_qualifications, 
                    $membership_fee,
                    $act_upon_membership_days,
                    $additional_conditions_to_vote,  
                    $annual_regular_meeting_day, 
                     $committee_others,
                    // $annual_regular_meeting_day_date,
                    // $annual_regular_meeting_day_venue, 
                    $members_percent_quorom,
                    $number_of_absences_disqualification,
                    $percent_of_absences_all_meettings, 
                    $director_hold_term,
                    $member_invest_per_month, 
                    $member_percentage_annual_interest, 
                    $member_percentage_service, 
                    $percent_reserve_fund, 
                    $percent_education_fund, 
                    $percent_community_fund,
                    $percent_optional_fund, 
                    $non_member_patron_years, 
                    $amendment_votes_members_with,
                    $minimum_subscribed_share_regular, 
                    $minimum_paid_up_share_regular, 
                    $minimum_subscribed_share_associate,
                    $minimum_paid_up_share_associate, 
        );
          
          $and = '';
          $bylaws = false;
          $articles = false;
          if(in_array('true',$bylaws_array))
          {
            $bylaws = true;
          }
          if(in_array('true',$artilces_array))
          {
            $articles = true;
          }
          if($articles && $bylaws)
          {
            $and=' AND ';
          }  
         

          return $acbl = array('articles'=>$articles,'bylaws'=>$bylaws);                     
  }

  public function compare_param($param1,$param2)
  {   
    if(strcasecmp($param1,$param2)!=0)
    {
          return 'true';
    }
    else
    {
          return 'false';
    } 
  }

  public function year_registered($regNo)
  {
    $query = $this->db->query("select date(now()) as dateNow,dateRegistered,DATEDIFF(date(now()),STR_TO_DATE(dateRegistered,'%m-%d-%Y'))/365 as date_dif from registeredcoop where regNo = '$regNo'");
    if($query->num_rows()>0)
    {
     return $query->row()->date_dif;
    }
  }

  //change to another date format
  public function year_registered2($regNo)
  {
    $query = $this->db->query("select date(now()) as dateNow,dateRegistered,DATEDIFF(date(now()),STR_TO_DATE(dateRegistered,'%Y-%m-%d'))/365 as date_dif from registeredcoop where regNo = '$regNo'");
    if($query->num_rows()>0)
    {
     return $query->row()->date_dif;
    }
  }

  //check if newly registered in ecoopris since deployment
  public function newly_registered_date_of_primary($coop_id)
  {
    $query = $this->db->query("select application_id, STR_TO_DATE(dateRegistered,'%m-%d-%Y') as coop_date_reg,DATEDIFF(STR_TO_DATE(dateRegistered,'%m-%d-%Y'),'2021-08-16')/365 as date_difference from registeredcoop where application_id ='$coop_id'");
    if($query->num_rows()>0)
    {
      return $query->row();
    }
  }
  public function dateRegistered($regNo)
  {
    $data = null;
    $query = $this->db->query("select coop.id,coop.proposed_name,regcoop.dateRegistered,regcoop.application_id   from cooperatives as coop left join registeredcoop as regcoop
on regcoop.application_id = coop.id where regcoop.regNo ='$regNo'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
         $data =$row['dateRegistered'];
      }
    }
    return $data;
  }

  //for ACBL
  public function commitee_others($amendment_id)
  {
    $amendment_info = $this->amendment_model->amendment_info($amendment_id);
    $coop_id = $amendment_info->cooperative_id;
    $array_boolean = array();
    $data_amd =NULL;
    $data_coop =NULL;
    $query = $this->db->query("select name from amendment_committees where type='others' and amendment_id='$amendment_id'");
    if($query->num_rows()>0)
    {
       foreach($query->result_array() as $row)
       {
        $data_amd[] = $row;
       } 
    }
   if($this->amendment_model->if_had_amendment($amendment_info->regNo,$amendment_id))
   {   
    $last_amendment_info = $this->get_last_amendment_info($amendment_info->cooperative_id,$amendment_info->id);
       $last_reg_amendment_id = $last_amendment_info->id;
       $query_coop =  $this->db->query("select name from amendment_committees where type='others' and amendment_id='$last_reg_amendment_id'");
        if($query_coop->num_rows()>0)
        {
          foreach($query_coop->result_array() as $row2)
          {
            $data_coop[] = $row2;
          }
        }
   }
   else
   {
       $query_coop =  $this->db->query("select name from committees where type='others' and cooperative_id='$coop_id'");
        if($query_coop->num_rows()>0)
        {
          foreach($query_coop->result_array() as $row2)
          {
            $data_coop[] = $row2;
          }
        }
   }
  
      if($data_amd ==NULL && ($data_coop ==NULL))
      {
        return 'false';
      }
      else
      {   
         foreach($data_amd as $key => $comm)
         {
          $coop_comm =NULL;
           if(isset($data_coop[$key]))
           {
              $coop_comm = $data_coop[$key];
           }
           else
           {
            $coop_comm['name'] =null;
           }
            
             if(strcasecmp($coop_comm['name'],$comm['name'])!=0)
             {
              array_push($array_boolean, 'true');
             }
         }
         
         if(in_array('true',$array_boolean))
         {
          return 'true';
         }
      }   
  }

  public function check_if_revert($amendment_id)
  {
    $query = $this->db->get_where('amendment_comment',array('amendment_id'=>$amendment_id,'status'=>17));
    $data = $query->num_rows();
    if($data != 0){
      return true;
    }else{
      return false; 
    }
  }

  // public function get_regions(){
  //   $this->db->select('regDesc,regCode');
  //   $query = $this->db->get('refregion');
  //   return $query->result_array();
  // }

  public function existing_province($provCode)
  {
    $this->db->select('provDesc,provCode,regCode');
    $this->db->where(array('provCode'=> $provCode));
    $query = $this->db->get('refprovince');
    return $query->result_array();
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

  public function check_pending($regNo,$user_id)
  {
    $data =[];
    if($regNo !=NULL)
    {
       $query = $this->db->query("select * from amend_coop where regNo = '$regNo' and status NOT IN(10,11,15)");
      if($query->num_rows()>0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    else
    {
      //has registered coop already get the reg number
       $query = $this->db->query("select coop.id as cooperative_id,registeredcoop.regNo from cooperatives as coop 
left join registeredcoop on registeredcoop.application_id = coop.id
where coop.users_id = '$user_id' and coop.status =15");
        foreach($query->result_array() as $row)
        {
            $reg_no = $row['regNo'];
           $query = $this->db->query("select * from amend_coop where regNo = '$reg_no' and status NOT IN(10,11,15)");
            if($query->num_rows()>0)
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

  public function primary_coop_name($coop_id)
  {
    $coop_info_orig= $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);
    
    $acronym='';
    if(strlen($coop_info_orig->acronym_name)>0)
    {
    $acronym='('.$coop_info_orig->acronym_name.')';
    }
    $primary_coop_name = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
    return $primary_coop_name;
  }

   public function load_regNo($user_id)
    {
      $qry_user = $this->db->get_where('cooperatives',array('users_id'=>$user_id));
      if($qry_user->num_rows()>0)
      {
        foreach($qry_user->result_array() as $urow)
        {
          $cooperative_id = $urow['id'];
        }

          $qry = $this->db->get_where('registeredcoop',array('application_id'=>$cooperative_id));
          if($qry->num_rows()>0)
          {
            foreach($qry->result_array() as $row)
            {
              $regno = $row['regNo'];
            }

          }
          else
          {
            $regno = NULL;
          }
          return $regno;
      }   
    }
    public function load_regNo_reg($user_id)
    {
      $query_user_reg = $this->db->query("SELECT regno FROM users where id='$user_id'");
      if($query_user_reg->num_rows()>0)
      {
        foreach($query_user_reg->result_array() as $row)
        {
           $data = $row['regno'];
        }
      }
      else
      {
        $data = NULL;
      }
      return $data;
 
    }

    public function get_last_proposed_name($regNo,$amendmentNo)
    {
      $data = null;
      if($amendmentNo ==1)
      {
        $query = $this->db->query("select coopName from registeredcoop where regNo='$regNo'");
        foreach($query->result_array() as $row)
        {
           $data = $row['coopName'];
        }
      }
      else
      {
        $amendmentNo = $amendmentNo -1;
        $query = $this->db->query("select proposed_name,acronym,type_of_cooperative from amend_coop where regNo='$regNo' and amendmentNo='$amendmentNo'");
        foreach($query->result_array() as $row)
        {
            $acronym='';
            if(strlen($row['acronym'])>0)
            {
            $acronym="(".$row['acronym'].")";
            }

            if(count(explode(',',$row['type_of_cooperative']))>1)
            {
              $proposedName = ltrim(rtrim($row['proposed_name'])).' Multipurpose Cooperative '.$acronym;
            }
            else
            {
              $proposedName = ltrim(rtrim($row['proposed_name'])).' '.$row['type_of_cooperative'].' Cooperative '.$acronym;
            }
            $data = $proposedName;
        }
      }
      return $data;
    }

    public function proposed_name_comparison($regNo,$amendmentNo,$proposed_name)
    {
      $data =null;
      $last_proposed_name = $this->get_last_proposed_name($regNo,$amendmentNo);
      if(strcasecmp(trim(preg_replace('/\s\s+/', ' ',$last_proposed_name)),trim(preg_replace('/\s\s+/', ' ',$proposed_name)))!=0)
      {
        $data = $last_proposed_name;
      }
      else
      {
        $data = $proposed_name;
      }
      return $data;
    }



  public function get_all_updated_coop_info($regcode,$limit,$start,$coopName,$regNo){
    $ho =0;
    if($regcode =='00')
    {
      $ho=1;
     
    }
     $coopName = (strlen($coopName)>0 ? " AND amend_coop.proposed_name like '".$coopName."%'" : '');
      $regNo = (strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'"  : '');
    $this->db->limit($limit, $start);
    $this->db->select('amend_coop.id,amend_coop.cooperative_id,amend_coop.regNo,amend_coop.amendmentNo,amend_coop.users_id,amend_coop.category_of_cooperative,amend_coop.type_of_cooperative,amend_coop.cooperative_type_id,amend_coop.grouping,amend_coop.proposed_name,amend_coop.acronym,amend_coop.common_bond_of_membership,amend_coop.comp_of_membership,amend_coop.field_of_membership,amend_coop.name_of_ins_assoc,amend_coop.type,amend_coop.area_of_operation,amend_coop.refbrgy_brgyCode,amend_coop.interregional,amend_coop.regions,amend_coop.street,amend_coop.house_blk_no,amend_coop.status,amend_coop.evaluated_by,amend_coop.second_evaluated_by,amend_coop.third_evaluated_by,amend_coop.ho,amend_coop.in_change_region,amend_coop.previous_region,amend_coop.migrated,amend_coop.capital_contribution,refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    ($regcode !=='00' ? $this->db->like('refregion.regCode', $regcode) : '');
    $this->db->where('amend_coop.status = 40 AND amend_coop.users_id > 0 AND amend_coop.migrated=1 AND ho='.$ho.$coopName.$regNo);
    $query = $this->db->get();
    $datas=[];
    if($query->num_rows()>0)
    {
      $data = $query->result_array();    
      foreach($data as $row)
      {
        $row['coopName'] = $this->get_coopname_dateRegistered($row['regNo'],'coopName');
        $row['dateRegistered'] =  $this->get_coopname_dateRegistered($row['regNo'],'dateRegistered');
        $datas[] = $row;
      }
      unset($data);
      unset($row);
      unset($query);
      unset($coopName);
      unset($regNo);
      unset($regcode);
    }
   return $datas;
  }
  
  public function get_all_submitted_coop_count($regcode,$coopName,$regNo){
     $coopName = (strlen($coopName)>0 ? " AND amend_coop.proposed_name like '%".$coopName."%'" : '');
      $regNo = (strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'"  : '');
    // Get Coop Type for HO
    // $this->db->select('name');
    // $this->db->from('head_office_coop_type');
    // $query = $this->db->get();
    // $typeofcoop = $query->result_array();
    // foreach($typeofcoop as $typesofcoop){
    //   $cooparray[] = $typesofcoop['name'];
    // }
    // $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // unset($cooparray);
    // // End Get Coop Type for HO
    //  $typeCooperative = " AND amend_coop.type_of_cooperative NOT IN (".$typeofcoopimp.")";
      $ho =0;
     if($regcode =='00')
    {
      $ho=1;
       // $typeCooperative = " AND amend_coop.type_of_cooperative IN (".$typeofcoopimp.")";
    }

    $this->db->select('amend_coop.*,refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    // $this->db->join('registeredamendment', 'registeredamendment.cooperative_id = amend_coop.cooperative_id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('amend_coop.status = 40 AND amend_coop.migrated=1 AND ho='.$ho.$coopName.$regNo);
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    return  $this->db->count_all_results();
  }

  public function get_coopname_dateRegistered($regNo,$column)
  {
    $data ='';
    $query = $this->db->query("select {$column} from registeredamendment where regNo='$regNo' order by id desc limit 1");
    if($query->num_rows()==1)
    {
      foreach($query->result_array() as $row)
      {
        $data=$row[$column];
      }
    }
    return $data;
  }

  public function get_all_updated_coop_info_ho($regcode){
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
    $this->db->select('amend_coop.*,registeredamendment.coopName,registeredamendment.dateRegistered, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment', 'registeredamendment.cooperative_id = amend_coop.cooperative_id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('amend_coop.status = 40 AND amend_coop.migrated=1 AND ho=1');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_updated_registered_coop_ho(){
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
    $this->db->select('amend_coop.*,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.coopName, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('registeredamendment', 'registeredamendment.amendment_id = amend_coop.id','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where('amend_coop.status = 41 AND amend_coop.migrated=1 AND ho=1');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function user_info_by_amendment_id($amendment_id)
  {
    $data =null;
    $query = $this->db->query("select amend_coop.users_id from amend_coop left join users ON users.id=amend_coop.users_id where amend_coop.id='$amendment_id'");
    if($query->num_rows()>0)
    {
      $data = $query->row();
    }
    return $data;
  }

   public function update_user_coop($regNo,$amendment_id)
  {
    $query = $this->db->select('users_id')->from('amend_coop')->where(['regNo'=>$regNo])->order_by('id','asc')->limit(1)->get();
    if($query->num_rows()>0)
    {
      foreach ($query->result_array() as $row) {
       $users_id =  $row['users_id'];
      }
      $this->db->update('amend_coop',['users_id'=>$users_id],['id'=>$amendment_id]);
    }
  }
  public function check_user_($regNo,$current_user_id)
  {
       $query = $this->db->select('users_id')->from('amend_coop')->where(['regNo'=>$regNo])->order_by('id','asc')->limit(1)->get();
    if($query->num_rows()>0)
    {
      foreach ($query->result_array() as $row) {
       $users_id =  $row['users_id'];
      }
      if($users_id !=$current_user_id)
      {
        return true;
      }
    }
    else
    {
      return false;
    }
  }
  public function major_industry_description2($major_id)
    {
      $major_id = (strlen($major_id)>0 ? " where id ='$major_id'" : "");
      $query = $this->db->query("select * from major_industry ".$major_id);// where id=".$major_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

  public function reg_id($regNo)
  {
    $query = $this->db->query("select id from registeredamendment where regNo='$regNo' order by id desc limit 1");
    return $query->row();
  }

   public function add_to_coop($data)
  {
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('cooperatives',$data);
    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        return false;
    }
    else
    {
        $this->db->trans_commit();
        return true;
    }
  }

  public function add_to_Regcoop($data)
  {
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('registeredcoop',$data);
    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        return false;
    }
    else
    {
        $this->db->trans_commit();
        return true;
    }
  }
  public function replicate_to_temp_table($regNo,$user_id)
  { 
     $user_id = $this->security->xss_clean($user_id);
    $regNo = $this->security->xss_clean($regNo);
     $this->db->trans_begin();
    $query = $this->db->query("select * from registeredcoop where regNo='$regNo'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        unset($row['grouping']);
        unset($row['migrated']);
        $data[] = $row;
      }
       
        $this->db->delete('temp_registeredcoop',array('regNo'=>$regNo));
        $this->db->insert_batch('temp_registeredcoop',$data);
        if($this->seed_migration($regNo,$user_id))
        {
          if ($this->db->trans_status() === FALSE)
          {
              $this->db->trans_rollback();
              return false;
          }
          else
          {
              $this->db->trans_commit();
              return true;
          }
        }
        else
        {
          return false;
        }  
    }
    else
    {
      return false;
    }
  }

public function seed_migration($regNo,$user_id)
{
  $regNo = $this->security->xss_clean($regNo);
  $user_id = $this->security->xss_clean($user_id);
   $this->db->trans_begin();
  $qry = $this->db->query("select application_id,coopName,acronym,regNo,category,type,commonBond,areaOfOperation,noStreet,Street,addrCode,compliant, DATE(CASE WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(temp_registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered from temp_registeredcoop  where dateRegistered <> '0000-00-00' AND  regNo='$regNo'");
  $process = 0;
  $success =0;
  if($qry->num_rows()>0)
  {
    foreach($qry->result_array() as $row)
    {
    unset($row['id']);
    $data=Array (
    'cooperative_id' => $row['application_id'],
    // 'amendment_no' => $row['']
    'coopName' =>$row['coopName'],
    'acronym' => $row['acronym'],
    'regNo' => $row['regNo'],
    'category' => $row['category'],
    'type' => $row['type'],
    'date_printed' => $row['dateRegistered'],
    'dateRegistered' =>$row['dateRegistered'],
    'commonBond' =>$row['commonBond'],
    'areaOfOperation' => $row['areaOfOperation'],
    'noStreet' => $row['noStreet'],
    'Street' => $row['Street'],
    'addrCode' => $row['addrCode'],
    'compliant' => $row['compliant'],
    'migrated'=>1
    );
    
      if($row['dateRegistered']!=null)
      {
         $process++;
        if($this->db->insert('registeredamendment',$data))
        {
         $success++;
        }
      }
    }

      //amend coop table
      $query2 = $this->db->query("select registeredamendment.regNo,cooperatives.id,cooperatives.users_id, cooperatives.category_of_cooperative,cooperatives.type_of_cooperative,cooperatives.grouping,cooperatives.proposed_name,cooperatives.acronym_name,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,cooperatives.area_of_operation,cooperatives.refbrgy_brgyCode,cooperatives.interregional,cooperatives.regions,cooperatives.street,cooperatives.house_blk_no,cooperatives.status from registeredamendment left join cooperatives on registeredamendment.cooperative_id = cooperatives.id where registeredamendment.regNo = '$regNo'");
    $process2=0;
    $success2 =0;
      if($query2->num_rows()>0)
      {
          foreach($query2->result_array() as $rows)
          {
          $data_amendment =array(
          'cooperative_id' =>  $rows['id'],
          'regNo'=>$rows['regNo'],
          'amendmentNo' =>'' ,
          'users_id' => $user_id,
          'category_of_cooperative' => $rows['category_of_cooperative'],
          'type_of_cooperative' =>$rows['type_of_cooperative'],
          'cooperative_type_id'=>'',
          'grouping' =>$rows['grouping'],
          'proposed_name' => $rows['proposed_name'],
          'acronym' => $rows['acronym_name'],
          'common_bond_of_membership' => $rows['common_bond_of_membership'],
          // 'comp_of_membership',
          // 'field_of_membership',
          // 'name_of_ins_assoc',
          'area_of_operation' => $rows['area_of_operation'],
          'refbrgy_brgyCode' => $rows['refbrgy_brgyCode'],
          // 'interregional',
          'regions' => $rows['regions'],
          'street' => $rows['street'],
          'house_blk_no'=> $rows['house_blk_no'],
          'status' => 15,
          'created_at' => date('Y-m-d h:i:s',now('Asia/Manila')),
          'ho'=>0,
          'migrated'=>1
          );
          $process2++;
            if($this->db->insert('amend_coop',$data_amendment))
            {
              $success2++;
            }
          }
        $reg_amendment_success = false;
        $amendment_success = false;
        if($success2 == $process2 && ($success == $process))
        {
           $reg_amendment_success = true;
           $amendment_success = true;
           if ($this->db->trans_status() === FALSE)
          {
              $this->db->trans_rollback();
              return false;
          }
          else
          {
              $this->db->trans_commit();
              return true;//array('registeredamendment'=>$reg_amendment_success,'amend_coop'=>$amendment_success);
          }
        }
        else
        {
          return false;
        }
      } //end num rows amendment

  }  //end num rows
  else
  {
  return false;
  }

}

   public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }

}
