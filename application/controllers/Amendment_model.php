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
    $this->db->select('registeredcoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,cooperatives.proposed_name, cooperatives.category_of_cooperative, cooperatives.grouping,cooperative_type.id as type_id');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');

    $this->db->where('regNo', $regNo);
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
    $query = $this->db->get();

    return $query->result();
  }
  public function get_payment_info($coop){
    $this->db->select('*');
    $this->db->from('payment');
    $this->db->where('payor',$coop);
    $this->db->where('nature','Name Registration');
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
    $this->db->where('amend_coop.users_id', $user_id);
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
  public function get_all_cooperatives_by_senior($regcode){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where_in('status',array('2','4','5','6','12','13','14','15'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperatives_by_director($regcode){
    $this->db->select('amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where_in('status',array('7','8','9'));
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
  public function get_all_business_activities($coop_id){
    $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
    $this->db->from('business_activities_cooperative_amendment');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative_amendment.cooperatives_id',$coop_id);
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
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('amend_coop.users_id'=>$user_id,'amend_coop.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_cooperative_info_by_admin($coop_id){
    $this->db->select('amend_coop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('amend_coop.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function add_amendment($major_industry)
  {
    return $major_industry;
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
    $this->db->insert('amend_coop',$data);
    $id = $this->db->insert_id();

    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'cooperatives_id'=> $id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_cooperative_amendment', $batch_subtype);
//    $this->db->insert_batch('business_activities_cooperative', $batch_subtype);


    $this->db->select('id');
    $this->db->where_in('composition',$members_composition);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $members = $query->result_array();

    $batch_composition = array();
    foreach($members as $composition){
      array_push($batch_composition, array(
        'coop_id'=> $id,
        'composition'=>$composition['id'])
      );
    }
    $this->db->insert_batch('amendment_members_composition_of_cooperative', $batch_composition);

    $temp_purpose = array(
        'cooperatives_id' => $id,
        'content'  => $this->get_purpose_content($coop_type->name)
      );
    $this->db->insert('amendment_purposes',$temp_purpose);
//    $this->db->insert('amendment_bylaws', array('cooperatives_id'=>$id));
//    $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$id));
//    $this->db->insert('amendment_economic_survey', array('cooperatives_id'=>$id));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
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
    
    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
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
    
    $this->db->select('id');
    $this->db->where_in('composition',$members);
    $this->db->from('composition_of_members');
    $query = $this->db->get();
    $member = $query->result_array();

    $this->db->delete('members_composition_of_cooperative',array('coop_id'=>$coop_id));
    $batch_composition = array();
    foreach($member as $composition){
      array_push($batch_composition, array(
        'coop_id'=> $coop_id,
        'composition'=>$composition['id'])
      );
    }
    $this->db->insert_batch('members_composition_of_cooperative', $batch_composition);
    
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
public function delete_cooperative($coop_id){
  $this->db->trans_begin();
  $this->db->delete('amend_coop',array('id' => $coop_id));
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
  $this->db->update('amend_coop',array('status'=>2,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
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
  $this->db->update('amend_coop',array('status'=>6));
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
  $this->db->update('amend_coop',array('status'=>3,'evaluated_by'=>$specialist_id));
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
      $this->db->trans_commit();
      return true;
//    if($this->email_model->sendEmailToSpecialist($admin_info,$coop_full_name)){
//      $this->db->trans_commit();
//      return true;
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
//      $this->db->trans_commit();
//      return true;
  }
}
public function approve_by_specialist($admin_info,$coop_id,$coop_full_name){
  $coop_id = $this->security->xss_clean($coop_id);
  $temp = $this->get_cooperative_info_by_admin($coop_id);
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>6,'evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  $senior_emails = $this->admin_model->get_emails_of_senior_by_region($temp->rCode);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
//    if($this->email_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
//      return true;
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
      $this->db->trans_commit();
      return true;
  }
}
public function approve_by_senior($admin_info,$coop_id,$coop_full_name){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>9,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
//    if($this->email_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
//      $this->db->trans_commit();
//      return true;
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
      $this->db->trans_commit();
      return true;
  }
}
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
  $this->db->update('amend_coop',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  $supervisor_emails = $this->admin_model->get_emails_of_supervisor_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
//    if($this->admin_model->sendEmailToDirectorApprovedBySupervisor($admin_info,$supervisor_emails,$coop_full_name)){
//      if($this->admin_model->sendEmailToClientApprove($client_info)){
//        $this->db->trans_commit();
//        return true;
//      }else{
//        $this->db->trans_rollback();
//        return false;
//      }
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
        $this->db->trans_commit();
        return true;
  }
}
public function approve_by_director($admin_info,$coop_id){
  $coop_id = $this->security->xss_clean($coop_id);
  $this->db->select('amend_coop.proposed_name, amend_coop.type_of_cooperative, amend_coop.regNo, users.*');
  $this->db->from('amend_coop');
  $this->db->join('users' , 'users.id = amend_coop.users_id','inner');
  $this->db->where('amend_coop.id', $coop_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $regNo = $client_info->regNo;
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('amend_coop',array('status'=>12,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  $no_of_amendments = 1;
  $query_amendments = $this->db->where(array("regNo"=>$regNo))->get("amend_coop");
  if($query_amendments->num_rows()>0) {
      $no_of_amendments = $query_amendments->num_rows();
  }
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
//    if($this->email_model->sendEmailToClientApprove($client_info->proposed_name,$client_info->email)){
//      $this->db->trans_commit();
//      return true;
//    }else{
//      $this->db->trans_rollback();
//      return false;
//    }
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
public function defer_by_admin($admin_id,$coop_id,$reason_commment,$step){
  
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
public function check_own_cooperative($coop_id,$user_id){
    $query2 = $this->db->get_where('amend_coop', array('users_id' => $user_id,'id'=> $coop_id));
    return $query2->num_rows() > 0 ? true : false;
}
// public function check_cooperative_exist($user_id){
//     $query2 = $this->db->get_where('cooperatives', array('users_id' => $user_id));
//     return $query2->num_rows() > 0 ? true : false;
// }
public function check_expired_reservation($coop_id,$user_id){
  $query = $this->db->get_where('amend_coop',array('users_id' => $user_id,'id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_expired_reservation_by_admin($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function check_submitted_for_evaluation($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status > 1){
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
  if($coop_status>=4){
    return true;
  }else{
    return false;
  }
}
public function check_second_evaluated($coop_id){
  $query = $this->db->get_where('amend_coop',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=7){
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

  public function get_purpose_content($coop_type){
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
      'Education' => 'To attain increased income, savings, investments, productivity, and purchasing power, and promote among themselves equitable distribution of net surplus through maximum utilization of economies of scale, costsharing and risk-sharing;'.
        'To provide optimum social and economic benefits to its members;'.
        'To teach members efficient ways of doing things in a Cooperative manner;'.
        'To propagate Cooperative practices and innovative ideas in business undertakings and management;'.
        'To empower through provision of access, ownership, control and opportunities to the poor, vulnerable, lower income and less privileged groups to increase their ownership in the wealth of the nation;'.
        'To actively support the government, other Cooperatives and people oriented organizations, both local and foreign, in promoting Cooperatives as a practical means towards sustainable socio-economic development under a truly just and democratic society;'.
        'To develop a dynamic savings mobilization and capital build-up schemes to sustain its developmental activities and long-term investments, thereby ensuring optimum economic benefits to the members, their families and the communities;'.
        'To adopt membership expansion mechanism/scheme, thereby ensuring growth of the Cooperative movement;'.
        'To implement policy guidelines that will ensure transparency, accountability and equitable access to its resources and services, and promote the interests of the members;'.
        'To adopt such other plans as may help foster the welfare of the members, their families and the community;'.
        'To advance the competitiveness and innovativeness of the industry;'.
        'To coordinate with other Cooperatives on learning exchanges, coop trade, and information exchanges in fostering sustainable development;'.
        'To advocate legal framework and enabling policies appropriate for the development of education Cooperatives;'.
        'To be the voice and the institution of the poor and the excluded in resisting the growth-centered development aggression and instead promote people-centered development.',
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
      'Producer' => 'Manufacturing/Processing of raw materials into finished or processed products;'.
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
      'Small Scale Mining' => 'Extracting and removing of minerals or ore-bearing materials from the ground.'.
        'Promoting and advancing the economic and social status of the members;'.
        'Coordinating and facilitating the activities of cooperatives;'.
        'Advocating for the cause of the cooperative movements;'.
        'Ensuring the viability of cooperatives through the utilization of new technologies;'.
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
      'Transport' => 'Provide public transport services primarily to members and the commuting public (land and sea/water transportation services, and is limited to small vessels, for the safe conveyance of passengers and/or cargoes);'.
        'Engage in allied services or businesses such as: importation, distribution and marketing of marketing of spare parts, supplies and petroleum products in accordance with existing laws, operation of gasoline stations and transportation service centers, and marketing of vehicle/drivers insurance policies;'.
        'Promoting and advancing the economic and social status of the members;'.
        'Coordinating and facilitating the activities of cooperatives;'.
        'Advocating for the cause of the cooperative movements;'.
        'Ensuring the viability of cooperatives through the utilization of new technologies;'.
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
      'Water' => 'Operation and Management of Water Supply System;'.
        'Distribution of Potable Water;'.
        'Promoting and advancing the economic and social status of the members;'.
        'Coordinating and facilitating the activities of cooperatives;'.
        'Advocating for the cause of the cooperative movements;'.
        'Ensuring the viability of cooperatives through the utilization of new technologies;'.
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.',
      'Workers' => 'Undertaking labor and production of commodities or services jointly carried out without the limitations of individual work, or under the rules of conventional wage-based labor.'.
        'Promoting and advancing the economic and social status of the members;'.
        'Coordinating and facilitating the activities of cooperatives;'.
        'Advocating for the cause of the cooperative movements;'.
        'Ensuring the viability of cooperatives through the utilization of new technologies;'.
        'Encouraging and promoting self-help or self-employment as an engine for economic growth and poverty alleviation.'
    );
      return $data[$coop_type];
  }

}
