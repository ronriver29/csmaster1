<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class amendment_model extends CI_Model{

  public $last_query = null;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function get_coop($regNo){
    $this->db->select('registeredcoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,cooperatives.proposed_name, cooperatives.category_of_cooperative, cooperatives.grouping,cooperative_type.id as type_id,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,,cooperatives.acronym_name');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');
    $this->db->where('registeredcoop.regNo', $regNo);
    $query = $this->db->get();

  return $query->row();
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
    $this->db->select('registeredcoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,amend_coop.proposed_name, amend_coop.category_of_cooperative, amend_coop.grouping,amend_coop.cooperative_type_id as type_id,amend_coop.common_bond_of_membership,amend_coop.field_of_membership,amend_coop.name_of_ins_assoc,amend_coop.acronym as acronym_name,amend_coop.type as coopTypes');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('amend_coop','amend_coop.id=registeredcoop.amendment_id','inner');
    // $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');
    $this->db->where('registeredcoop.amendment_id', $amendment_id);
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
    $this->db->select('composition_of_members.composition');
    $this->db->from('amendment_members_composition_of_cooperative');
    $this->db->join('composition_of_members','amendment_members_composition_of_cooperative.composition=composition_of_members.id','inner');
    $this->db->where('amendment_members_composition_of_cooperative.amendment_id',$amendment_id);
    $query = $this->db->get();

    return $query->result_array();
  }
  public function get_composition(){
    // $this->db->from('composition_of_members');
     $query=$this->db->query('select * from composition_of_members order by composition asc');
    // $query = $this->db->get();

    return $query->result(); 
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
    $this->db->like('refregion.regCode', $regcode);  
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
    $this->db->where('status IN ("7","8","9") AND amend_coop.id IN ('.$amendment_id_arr.') AND ho=0');
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
  public function get_cooperative_info($cooperative_id,$user_id,$amendment_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('amend_coop.cooperative_id'=>$cooperative_id,'amend_coop.users_id'=>$user_id,'amend_coop.id'=>$amendment_id));
    $query = $this->db->get();
    return $query->row();
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


  public function if_had_amendment($cooperative_id)
  {
    $qry = $this->db->query("select * from amend_coop where cooperative_id ='$cooperative_id' and status =15 order by id desc limit 1");
    if($qry->num_rows()==1)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function add_amendment($data_amendment,$major_industry,$subtypes_array,$members_composition,$type_of_coop_id_array)
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
    // return $data_cooperators;
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


     //economic survey
    $qry_economic_survey = $this->db->get_where('amendment_economic_survey',array('amendment_id'=>$last_amendment_dtl->id));
    if($qry_economic_survey->num_rows()>0)
    {
      foreach($qry_economic_survey->result_array() as $row_economic)
      {
        $row_economic['cooperatives_id'] = $cooperative_ID;
        $row_economic['amendment_id'] = $id;
        unset($row_economic['id']);
        $data_economic = $row_economic;
      }
    }
    // return $data_economic;
    $this->db->insert('amendment_economic_survey',$data_economic);
     // end economic survey

     //Staff
    $qry_staff = $this->db->get_where('amendment_staff',array('amendment_id'=>$last_amendment_dtl->id));
    if($qry_staff->num_rows()>0)
    {
      foreach($qry_staff->result_array() as $row_staff)
      {
        $row_staff['amendment_id'] = $id;
        $row_staff['orig_staff_id']= $row_staff['id'];
        unset($row_staff['id']);
        $data_staff[]=$row_staff;
      }
    }
    // return $data_staff;
    $this->db->insert_batch('amendment_staff',$data_staff);
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
       $type_coop = explode(',',$data_amendment['type_of_cooperative']);
       foreach($type_coop as $rowcoop_type)
       {
         $temp_purpose[] = array(
        'cooperatives_id' => $cooperative_ID,
        'amendment_id' => $id,
        'cooperative_type'=>$rowcoop_type,
        'content'  => $this->get_purpose_content($rowcoop_type)
         );
          
       }
      $this->db->insert_batch('amendment_purposes',$temp_purpose);
     //end of purposes
     

      //amendment_bylaws
    $bylaws_coop_info = $this->amendment_by_laws($last_amendment_dtl->id,$id);
    $bylaws_amendment = array_filter($bylaws_coop_info);
    // return   $bylaws_amendment;
    $this->db->insert('amendment_bylaws',$bylaws_amendment);
    //amendmnet_bylaws

    //amendment_documents
    $qry_file = $this->db->query("select * from amendment_uploaded_documents where amendment_id='$last_amendment_dtl->id' and document_num >=1 and document_num<=18");
    if($qry_file->num_rows()>0)
    {
      $process =0;
      $success=0;
      foreach($qry_file->result_array() as $row_file)
      {

        $process++;
        $row_file['amendment_id']=$id;
        // $row_file['cooperative_id'] = $row_file['cooperatives_id'];
        unset($row_file['id']);
        unset($row_file['cooperatives_id']);  
        unset($row_file['laboratory_id']); 
        unset($row_file['branch_id']);
        $new_name =$id.'_'.$row_file['filename'];
        $row_file['created_at']=date('Y-m-d h:i:s',now('Asia/Manila'));
        $row_file['author'] = $this->session->userdata('user_id');
        if(file_exists(APPPATH.'../uploads/amendment/'.$row_file['filename']))
        {
        if(copy(APPPATH.'../uploads/amendment/'.$row_file['filename'],APPPATH.'../uploads/amendment/'.$new_name))
        {
          $success++;
        }
        }
        $row_file['filename'] = $new_name;
         $data_file[]=$row_file;
      }
    }
    // return  $data_file;
        // if($process>0 && $success ==$process)
        // {
           if($this->db->insert_batch('amendment_uploaded_documents',$data_file)){
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

  public function add_cooperative($data,$major_industry,$subtypes_array,$members_composition,$type_of_coop_id_array){
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
    }
    $this->db->insert_batch('amendment_cooperators',$data_cooperators);
    //end amendment cooperators
    // return $original_cooperators_id;
    //committees
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
    //end committees 

    //economic survey
    $qry_economic_survey = $this->db->get_where('economic_survey',array('cooperatives_id'=>$cooperative_ID));
    if($qry_economic_survey->num_rows()>0)
    {
      foreach($qry_economic_survey->result_array() as $row_economic)
      {
        $row_economic['cooperatives_id'] = $cooperative_ID;
        $row_economic['amendment_id'] = $id;
        unset($row_economic['id']);
        $data_economic[] = $row_economic;
      }
    }
    $this->db->insert_batch('amendment_economic_survey',$data_economic);
     // end economic survey

    //Staff
    $qry_staff = $this->db->get_where('staff',array('cooperatives_id'=>$cooperative_ID));
    if($qry_staff->num_rows()>0)
    {
      foreach($qry_staff->result_array() as $row_staff)
      {
        $row_staff['amendment_id'] = $id;
        $row_staff['orig_staff_id']= $row_staff['id'];
        unset($row_staff['id']);
        $data_staff[]=$row_staff;
      }
    }
    // return $data_staff;
    $this->db->insert_batch('amendment_staff',$data_staff);
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
    $this->db->insert('amendment_bylaws',$bylaws_amendment);

    //document upload
    // $this->db->where('cooperatives_id',$cooperative_ID);
    // $this->db->where_in('document_num',array(1,2));
    // $qry_file = $this->db->get('uploaded_documents');
    $qry_file = $this->db->query("select * from uploaded_documents where cooperatives_id='$cooperative_ID' and document_num >=1 and document_num<=18");
    if($qry_file->num_rows()>0)
    {
      $process =0;
      $success=0;
      foreach($qry_file->result_array() as $row_file)
      {

         $process++;
        $row_file['amendment_id']=$id;
        $row_file['cooperative_id'] = $row_file['cooperatives_id'];
        unset($row_file['id']);
        unset($row_file['cooperatives_id']);  
        unset($row_file['laboratory_id']); 
        unset($row_file['branch_id']);
        $new_name =$id.'_'.$row_file['filename'];
        $row_file['created_at']=date('Y-m-d h:i:s',now('Asia/Manila'));
        $row_file['author'] = $this->session->userdata('user_id');
        // if(copy(APPPATH.'../uploads/'.$row_file['filename'],APPPATH.'../uploads/amendment/'.$new_name))
        if(file_exists(UPLOAD_DIR.$row_file['filename'] ))
        {

          if(copy(UPLOAD_DIR.$row_file['filename'],UPLOAD_AMD_DIR.$new_name))

          {
            
          }

        
        }//end of file exist 
        $success++;
        $row_file['filename'] = $new_name;
        $data_file[]=$row_file;
      }
    }
    // return  $data_file;
        if($process>0 && $success ==$process)
        {
           $this->db->insert_batch('amendment_uploaded_documents',$data_file);
        }
        else
        {
          $this->db->trans_rollback();
          return false;
        }
   
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
  public function update_not_expired_cooperative($user_id,$amendment_id,$field_data,$subclass_array,$major_industry){
    $data = $this->security->xss_clean($field_data);
    $coop_id = $data['cooperative_id'];
    $subclass_array = $this->security->xss_clean($subclass_array);
    $subclass_array = implode(",",$subclass_array);
    $param1 = $data['cooperative_type_id'];
     $major_industry = implode(",",$major_industry);
    $coopertiveTypeID=explode(",",$data['cooperative_type_id']);
      // return $data;
     $query_type = $this->db->query("select * from industry_subclass_by_coop_type where cooperative_type_id IN({$param1}) AND major_industry_id IN($major_industry) AND subclass_id IN($subclass_array)");
      // return $this->db->last_query();
     if($query_type->num_rows()>0){
      foreach($query_type->result_array() as $row)
      {
      
        $row['cooperatives_id'] =$data['cooperative_id'];
        $row['amendment_id'] = $amendment_id;
        $row['industry_subclass_by_coop_type_id'] = $row['id'];

        unset($row['id']);
        $data_r[]= $row;
      }
     }
     // return $data_r;
       $this->db->delete('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
       $this->db->insert_batch('business_activities_cooperative_amendment', $data_r);
    // foreach($coopertiveTypeID as $key=> $coopType_row)
    // {
      
    //   // return $a++;

    //   $this->db->trans_begin();
    //   $this->db->select('id');
    //   $this->db->where(array('cooperative_type_id'=>$coopType_row));
    //   $this->db->where_in('major_industry_id',$major_industry);
    //   $this->db->where_in('subclass_id',$subclass_array);
    //   $this->db->from('industry_subclass_by_coop_type');
    //   // return $this->db->last_query();
    //   // $query = $this->db->get();
    //   // foreach($query->result_array() as $row_type)
    //   // {
    //   //   $row_data[] = $row_type;
    //   // }
    // }
   //  $batch_subtype = array();
      
 
    // $data['type_of_cooperative'] = $coop_type->name;
    $this->db->where(array('users_id'=>$user_id,'id'=>$amendment_id));
    $this->db->update('amend_coop',$data);
    // return $this->db->last_query();  
  

    // $temp_purpose = array(
    //     'cooperatives_id' => $coop_id,
    //     'content'  => $this->get_purpose_content($data['type_of_cooperative'])
    //   );

   $cooptypess = explode(',',$data['type_of_cooperative']); 
    foreach($cooptypess as $type_coop)
    {
       $temp_purpose = array(
        'amendment_id' => $amendment_id,
        'content'  => $this->get_purpose_content($type_coop),
        'cooperative_type' => $type_coop
      ); 
       // return  $temp_purpose;
       $this->db->where('amendment_id',$amendment_id);
      $this->db->update('amendment_purposes',$temp_purpose);

    } 
   
   
    $composition_input = explode(',',$data['comp_of_membership']);
    
    foreach($composition_input as $composition_id){
        $data_composition[] =array(
                    'amendment_id'=> $amendment_id,
                    'composition'=>$composition_id, 
                    'coop_id'=>$coop_id
                );
    
    }
    // return $data_composition;
    $this->db->delete('amendment_members_composition_of_cooperative',array('amendment_id'=>$amendment_id));
    $this->db->insert_batch('amendment_members_composition_of_cooperative', $data_composition);
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
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
public function submit_for_evaluation($user_id,$amendment_id,$region_code){
  $user_id = $this->security->xss_clean($user_id);
  $amendment_id = $this->security->xss_clean($amendment_id);
  $cooperative_id = $this->coop_dtl($amendment_id);
  $amendment_info =$this->get_cooperative_info23($cooperative_id,$amendment_id);
  $client_qry = $this->db->get_where('users',array('id'=>$user_id));
  $client_info = $client_qry->row();
  $admin_info = $this->admin_info_by_region($region_code);
  $this->db->trans_begin();
  $this->db->where(array('users_id'=>$user_id,'id'=>$amendment_id));
  $this->db->update('amend_coop',array('status'=>2,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
 
  // return $amendment_info;
    //HO checking
    // $type_coop_array = explode(',',$amendment_info->type_of_cooperative);
    // $ho_arr = $this->amendment_model->get_ho_list();
    // $result = count(array_intersect($type_coop_array, $ho_arr)) ? true : false;
    // if($result)
    // {
    //    return "HO";
    // }
    // else
    // {
    //   return "Not HO";
    // }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      if($this->email_model->sendEmailfirstSubmissionAmendment($client_info,$admin_info,$amendment_info)){
       $this->db->trans_commit();
       return true;
      }else{
       $this->db->trans_rollback();
       return false;
      }
    }
}
public function submit_for_reevaluation($user_id,$coop_id){
  $user_id = $this->security->xss_clean($user_id);
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
  $this->db->update('amend_coop',array('status'=>6));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
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
  $this->db->update('amend_coop',array('status'=>6,'evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'ho'=>$ho));

   if($this->email_model->sendEmailToSeniorAmendment($admin_info,$client_info,$amendment_info,$specialist_info)){
     $this->db->trans_commit();
     return true;
   }else{
     $this->db->trans_rollback();
     return false;
   }
      
  
}
public function approve_by_senior($admin_info,$coop_id,$coop_full_name,$data_comment){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>9,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
  $this->db->insert('amendment_comment',$data_comment); //insert comment
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    // return $director_emails;
    foreach($director_emails as $demail)
    {
      $director_email = $demail['email'];
    }

   if($this->email_model->sendEmailToDirectorAmendment($admin_info,$director_email,$coop_full_name)){
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
    $acronym_ = '('.$client_info->acronym.')';
  }
  else
  {
     $acronym_='';
  }
  if(count(explode(',',$client_info->type_of_cooperative))>1)
  {
     $proposedName = $client_info->proposed_name.' Multipurpose Cooperative '.$acronym_;
  }
  else
  {
    $proposedName =$client_info->proposed_name.' '.$client_info->type_of_cooperative. ' Cooperative '.$acronym_;
  }
 
  $regNo = $client_info->regNo;
  $this->db->trans_begin();
  $this->db->insert('amendment_comment',$comment);

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
   
   
   if($this->email_model->sendEmailToClientAmendmentApprove($proposedName,$client_info->email)){
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

public function deny_by_admin($admin_id,$coop_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('amend_coop',array('evaluated_by'=>$admin_id,'status'=>4,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('amend_coop',array('second_evaluated_by'=>$admin_id,'status'=>7,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>10,'updated_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
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
      if($this->admin_model->sendEmailToClientDeny($client_info->fullname, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->groping ,$client_info->email, $reason_commment)){
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
  
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('amend_coop',array('evaluated_by'=>$admin_id,'status'=>5,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('amend_coop',array('second_evaluated_by'=>$admin_id,'status'=>8,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('amend_coop',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->insert('amendment_comment',$data_comment);
      $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, amend_coop.grouping, users.*');
      $this->db->from('amend_coop');
      $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
      $this->db->where('amend_coop.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($this->admin_model->sendEmailToClientDeny($client_info->fullname, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->groping ,$client_info->email, $reason_commment)){
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
  if($coop_status > 1 && $coop_status!=11){
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
  if($coop_status>=6 ){
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
  if($coop_status>=10){
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

  public function  get_purpose_content($coop_type){
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
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.'
    );
      return $data[$coop_type];
  }
// ANJURY START
//     private $_table = "coop_type";  
//     public function get_type_of_coop($type_of_coop)
//     {
//         $type_of_coop = $this->security->xss_clean($type_of_coop);
//         $this->db->select('coop_type_upload.*')
//                  ->from($this->_table)
//                  ->join("coop_type_upload",$this->_table.".id = coop_type_upload.coop_type_id",'left')
//                  ->where($this->_table.".coop_name = '$type_of_coop' ORDER BY coop_type_upload.coop_type_id DESC");
// //        $query = $this->db->get();
// //        return $query->row();
//         $query = $this->db->get();
//         $data = $query->result_array();
//         return $data;
//     }
//     public function get_type_of_coop_single($type_of_coop,$coop_id)
//     {
//         $type_of_coop = $this->security->xss_clean($type_of_coop);
//         $this->db->select('*')
//                  ->from("coop_type_upload")
//                  ->where("id = '$coop_id'");
//         $query = $this->db->get();
//         return $query->row();
// //        $query = $this->db->get();
// //        $data = $query->result_array();
// //        return $data;
//     }
// ANJURY END

//json
    public function get_cooperatve_types($cooperative_type_id)
    {
      $cooptype_array  =explode(',',$cooperative_type_id);
      $qry=$this->db->where_in('cooperative_type_id',$cooptype_array)->get('amendment_coop_type_upload');
     $data = $qry->result_array();
     return $data;

    }
//json
    public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
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
      $query = $this->db->get_where('amendment_comment',array('amendment_id'=>$amendment_id,'access_level'=>$access_level));
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
}
