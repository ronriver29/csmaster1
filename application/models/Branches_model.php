<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class branches_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
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
  public function get_business_activity_coop_amend($regNo){
    $this->db->select('business_activities_cooperative_amendment.industry_subclass_by_coop_type_id as BAC_id, major_industry.description as mdesc, subclass.description as sdesc');
    $this->db->from('registeredamendment');
    $this->db->join('business_activities_cooperative_amendment','business_activities_cooperative_amendment.amendment_id = registeredamendment.amendment_id','inner');
    $this->db->join('industry_subclass_by_coop_type','industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry','major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass','subclass.id = industry_subclass_by_coop_type.subclass_id');
    $this->db->where('regNo',$regNo);
    $query = $this->db->get();

    return $query->result_array();
  }
  public function check_own_branch($branch_id,$user_id){
    $query2 = $this->db->get_where('branches', array('user_id' => $user_id,'id'=> $branch_id));
    return $query2->num_rows() > 0 ? true : false;
  }
  public function get_all_branches_ho(){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, coopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->where('branches.user_id', $user_id);
    $this->db->where('branches.status NOT IN (1,21)');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches($user_id){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, coopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('branches.user_id', $user_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_region_name($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('refregion',array('regCode'=>$data));
    $row = $query->row();
    return $row;
  }
  public function add_branch($data,$BAC){

    $data = $this->security->xss_clean($data);
    $BAC = $this->security->xss_clean($BAC);
    $batch_subtype = array();
   
    $this->db->trans_begin();
    $this->db->insert('branches',$data);
    $id = $this->db->insert_id();
    foreach($BAC as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'branch_id'=> $id,
        'business_subclass'=>$industry_subclasses_id)
      );
    }
    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function prov($pCode){
    $this->db->select('provDesc');
    $this->db->from('refprovince');
    $this->db->where('provCode',$pCode);
    $query=$this->db->get();

    return $query->row();
  }
  public function city($cCode){
    $this->db->select('citymunDesc');
    $this->db->from('refcitymun');
    $this->db->where('citymunCode',$cCode);
    $query=$this->db->get();

    return $query->row();
  }
  public function branch_count($regNo,$munCode,$type){
    $query=$this->db->query('select * from branches where regNo="'.$regNo.'" and addrCode like "'.$munCode.'%" and branchName like "%'.$type.'%" AND status = 21');

    return ($query->num_rows()>=1)? $query->num_rows()+1:'';
  }



  public function get_payment_info($coop){
//original  $query = $this->db->query('select * from payment where payor="'.$branch.'" and (nature= "Branch Registration" or nature= "Satellite Registration")');
    $query = $this->db->query('select * from payment where bns_id = "'.$coop.'"');

    return $query->row();
  }
  public function save_OR($where, $data, $id, $date_of_or){
    $this->db->trans_begin();
    $this->db->update('branches', array('status'=>20,'date_of_or'=>$date_of_or),array('id'=>$id));
    $this->db->update('payment', $data, $where);
    
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }

  }
  
  public function get_all_branches_by_specialist($regcode,$admin_id){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>9,'evaluator3'=>$admin_id));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_specialist_central_office($regcode){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>9,'evaluator3 >'=>0));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $regcode2 = substr($regcode, '1');
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.status IN (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.status in (24) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $regcode2 = substr($regcode, '1');
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status IN (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status in (2,8,9,10,11,12,17,18,19,20,22)');
    $data = $query->result_array();
    return $data;
  }

  public function get_all_branches_by_director($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (5)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (13,14,15)');
    $data = $query->result_array();
    return $data;   
  }
 
  public function get_all_business_activities($branch_id){
    $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
    $this->db->from('business_activities_branch');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_branch.business_subclass','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_branch.branch_id',$branch_id);

    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_major_industry($branch_id){
    // $this->db->distinct();
    $this->db->select('major_industry.id,major_industry.description,subclass.id as subclassid,subclass.description as subclassdesc');
    $this->db->from('business_activities_branch');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_branch.business_subclass','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_branch.branch_id',$branch_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_subclasses($branch_id){
    // $this->db->distinct();
    $this->db->select('subclass.id,subclass.description');
    $this->db->from('business_activities_branch');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_branch.business_subclass','inner');
    //$this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_branch.branch_id',$branch_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function check_expired_reservation($coop_id,$user_id){
  $query = $this->db->get_where('branches',array('user_id' => $user_id,'id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
  public function get_branch_info($user_id,$branch_id){
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.areaOfOperation as aoo,registeredcoop.type as registeredtype,cooperatives.area_of_operation,cooperatives.regions,registeredcoop.regNo');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=branches.regNo','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->where(array('branches.user_id'=>$user_id,'branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_coop_region($regno){
    $this->db->select('refregion.regDesc as region');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('registeredcoop.regNo'=>$regno));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_branch_info_amend($user_id,$branch_id){
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, amend_coop.category_of_cooperative, amend_coop.type_of_cooperative, amend_coop.grouping, registeredamendment.amendment_id,registeredamendment.addrCode as mainAddr, registeredamendment.areaOfOperation as aoo,registeredamendment.type as registeredtype, registeredcoop.application_id, amend_coop.id as ammend_id, branches.id as branch_id');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredamendment','registeredamendment.regNo=branches.regNo','inner');
    $this->db->join('amend_coop','amend_coop.id=registeredamendment.amendment_id','inner');
    $this->db->join('registeredcoop','registeredcoop.application_id=amend_coop.cooperative_id','inner');
    $this->db->where(array('branches.user_id'=>$user_id,'branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_branch_info_document($branch_id){
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=branches.regNo','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->where(array('branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_info_document_amend($branch_id){
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, amend_coop.category_of_cooperative, amend_coop.type_of_cooperative, amend_coop.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, branches.id as branch_id');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredamendment','registeredamendment.regNo=branches.regNo','inner');
    $this->db->join('amend_coop','amend_coop.id=registeredamendment.amendment_id','inner');
    $this->db->join('registeredcoop','registeredcoop.application_id=amend_coop.cooperative_id','inner');
    $this->db->where(array('branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_info_by_admin($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun,registeredcoop.type as registeredtype');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=branches.regNo','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->join('refbrgy as x' , 'x.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun as y', 'y.citymunCode = x.citymunCode','inner');
    $this->db->join('refprovince as z', 'z.provCode = y.provCode','inner');
    $this->db->join('refregion as w', 'w.regCode = z.regCode');

    $this->db->where(array('branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_info_amend_by_admin($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, amend_coop.category_of_cooperative, amend_coop.type_of_cooperative, amend_coop.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun,registeredcoop.type as registeredtype, branches.id as branch_id');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredamendment','registeredamendment.regNo=branches.regNo','inner');
    $this->db->join('amend_coop','amend_coop.id=registeredamendment.amendment_id','inner');
    $this->db->join('registeredcoop','registeredcoop.application_id=amend_coop.cooperative_id','inner');
    $this->db->join('refbrgy as x' , 'x.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun as y', 'y.citymunCode = x.citymunCode','inner');
    $this->db->join('refprovince as z', 'z.provCode = y.provCode','inner');
    $this->db->join('refregion as w', 'w.regCode = z.regCode');

    $this->db->where(array('branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_addcode($branch_id){
    $this->db->select('SUBSTR(addrCode, 1, 6) As subaddcode');
    $this->db->from('branches');
    $this->db->where(array('id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  
  public function update_not_expired_branch($user_id,$branch_id,$field_data,$subclass_array,$major_industry){
    $data = $this->security->xss_clean($field_data);
    $subclass_array = $this->security->xss_clean($subclass_array);
    $batch_subtype = array();
    $this->db->trans_begin();
    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$data['type_of_branch']));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subclass_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();
    $industry_subclasses_id_array = $query->result_array();
    $this->db->select('name');
    $this->db->where('id',$data['type_of_branch']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();
    $data['type_of_branch'] = $coop_type->name;
    $this->db->where(array('user_id'=>$user_id,'id'=>$branch_id));
    $this->db->update('branches',$data);
    $this->db->delete('business_activities_branch',array('branches_id'=>$branch_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'branches_id'=> $branch_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    $temp_purpose = array(
        'branches_id' => $branch_id,
        'content'  => $this->get_purpose_content($coop_type->name)
      );
    $this->db->where('branches_id',$branch_id);
    $this->db->update('purposes',$temp_purpose);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function update_not_expired_branch_by_admin($branch_id,$field_data,$subclass_array,$major_industry){
    $data = $this->security->xss_clean($field_data);
    $subclass_array = $this->security->xss_clean($subclass_array);
    $batch_subtype = array();
    $this->db->trans_begin();
    $this->db->select('id');
    $this->db->where(array('cooperative_type_id'=>$data['type_of_branch']));
    $this->db->where_in('major_industry_id',$major_industry);
    $this->db->where_in('subclass_id',$subclass_array);
    $this->db->from('industry_subclass_by_coop_type');
    $query = $this->db->get();
    $industry_subclasses_id_array = $query->result_array();
    $this->db->select('name');
    $this->db->where('id',$data['type_of_branch']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();
    $data['type_of_branch'] = $coop_type->name;
    $this->db->where(array('id'=>$branch_id));
    $this->db->update('branches',$data);
    $this->db->delete('business_activities_branch',array('branches_id'=>$branch_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'branches_id'=> $branch_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    $temp_purpose = array(
        'branches_id' => $branch_id,
        'content'  => $this->get_purpose_content($coop_type->name)
      );
    $this->db->where('branches_id',$branch_id);
    $this->db->update('purposes',$temp_purpose);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  // public function update_branch($id,$data){
  //     $id = $this->security->xss_clean($id);
  //     $data = $this->security->xss_clean($data);
  //     $this->db->trans_begin();
  //     $this->db->set($data);
  //     $this->db->where('id', $id);
  //     $this->db->update('branches');
  //     if($this->db->trans_status() === FALSE){
  //       $this->db->trans_rollback();
  //       return false;
  //     }else{
  //       $this->db->trans_commit();
  //       return true;
  //     }
  // }
public function delete_branch($branch_id){
  $this->db->trans_begin();
  $this->db->delete('branches',array('id' => $branch_id));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function submit_for_evaluation($user_id,$branch_id,$same,$rCode){
  $user_id = $this->security->xss_clean($user_id);
  $branch_id = $this->security->xss_clean($branch_id);
  if ($same==8){
    $this->db->select('id');
    $this->db->from('admin');
    $this->db->where('region_code',$rCode);
    $this->db->where('access_level',2);
    $query=$this->db->get();
    $sa = $query->row();
    $this->db->select('id');
    $this->db->from('admin');
    $this->db->where('region_code',$rCode);
    $this->db->where('access_level',3);
    $query2=$this->db->get();
    $dir = $query2->row();
  }

  $this->db->trans_begin();
  $this->db->where(array('user_id'=>$user_id,'id'=>$branch_id));
  if ($same==8)
    $this->db->update('branches',array('evaluator1'=>$sa->id,'evaluator2'=>$dir->id, 'status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('branches',array('status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function submit_for_reevaluation($user_id,$branch_id,$same,$rCode){
  $user_id = $this->security->xss_clean($user_id);
  $branch_id = $this->security->xss_clean($branch_id);
  if ($same==8){
    $this->db->select('id');
    $this->db->from('admin');
    $this->db->where('region_code',$rCode);
    $this->db->where('access_level',2);
    $query=$this->db->get();
    $sa = $query->row();
    $this->db->select('id');
    $this->db->from('admin');
    $this->db->where('region_code',$rCode);
    $this->db->where('access_level',2);
    $query2=$this->db->get();
    $dir = $query2->row();
  }
  $this->db->trans_begin();
  $this->db->where(array('user_id'=>$user_id,'id'=>$branch_id));
  if ($same==8)
    $this->db->update('branches',array('evaluator1'=>$sa->id,'evaluator2'=>$dir->id, 'status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('branches',array('status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}
public function assign_to_specialist($branch_id,$specialist_id,$coop_full_name){
  $specialist_id = $this->security->xss_clean($specialist_id);
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->trans_begin();
  $query = $this->db->get_where('admin',array('id'=>$specialist_id));
  $admin_info = $query->row();
  $this->db->where(array('id'=>$branch_id));
  $this->db->update('branches',array('status'=>9,'evaluator3'=>$specialist_id));
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
public function approve_by_specialist($admin_info,$branch_id,$coop_full_name){
  $branch_id = $this->security->xss_clean($branch_id);
  $temp = $this->get_branch_info_by_admin($branch_id);
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('branches',array('status'=>5,'evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  $senior_emails = $this->admin_model->get_emails_of_senior_by_region($temp->rCode);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}
public function approve_by_senior($admin_info,$branch_id,$coop_full_name){
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('branches',array('status'=>7,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
  $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}
public function approve_by_supervisor($admin_info,$branch_id,$coop_full_name){
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->select('branches.proposed_name, branches.type_of_branch, users.*');
  $this->db->from('branches');
  $this->db->join('users' , 'users.id = branches.user_id','inner');
  $this->db->where('branches.id', $branch_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('branches',array('status'=>9,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  $supervisor_emails = $this->admin_model->get_emails_of_supervisor_by_region($admin_info->region_code);
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToDirectorApprovedBySupervisor($admin_info,$supervisor_emails,$coop_full_name)){
      if($this->admin_model->sendEmailToClientApprove($client_info)){
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
public function approve_by_director($admin_info,$branch_id){
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->select('branches.proposed_name, branches.type_of_branch, users.*');
  $this->db->from('branches');
  $this->db->join('users' , 'users.id = branches.user_id','inner');
  $this->db->where('branches.id', $branch_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('branches',array('status'=>9,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToClientApprove($client_info)){
      $this->db->trans_commit();
      return true;
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}

public function approve_by_admin($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $now = date('Y-m-d H:i:s');
  if ($step==1)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>5,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==3)
    $this->db->update('branches',array('evaluator3'=>$admin_info->id,'status'=>12,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_specialist'=>$comment_by_specialist_senior,'date_approved_cds'=>$now));
  else if($step==4)
    $this->db->update('branches',array('evaluator4'=>$admin_info->id,'status'=>15,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior'=>$comment_by_specialist_senior,'date_approved_senior'=>$now));
  else if($step==6)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>NULL,'date_approved_director'=>$now,'temp_evaluation_comment'=>NULL, 'comment_by_director_level1'=>$comment_by_specialist_senior));
  else if($step==7)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>23,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior_level1'=>$comment_by_specialist_senior,'date_approved_director'=>$now));
  else 
    $this->db->update('branches',array('evaluator5'=>$admin_info->id,'status'=>18,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'date_approved_director'=>$now));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($step==1){
      $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    } 
    elseif($step==2){
      $branch=$this->get_branch_info_by_admin($branch_id);
      $senior_emails = $this->admin_model->get_emails_of_senior_by_region($branch->rCode);
      if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }
    elseif($step==3){
      $senior_emails = $this->admin_model->get_emails_of_senior_by_region($admin_info->region_code);
      if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }
    elseif($step==4){
      $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }
    elseif ($step==5){
      $this->db->select('branches.type,branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($client_info->type == 'Branch'){
        // if($this->admin_model->sendEmailToClientApproveBranch($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
          $this->db->trans_commit();
          return true;
        // }else{
        //   $this->db->trans_rollback();
        //   return false;
        // }
      } else {
        // if($this->admin_model->sendEmailToClientApproveBranch($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
          $this->db->trans_commit();
          return true;
        // }else{
        //   $this->db->trans_rollback();
        //   return false;
        // }
      }
    }
    elseif ($step==6){
      $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // if($this->admin_model->sendEmailToClientApprove($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }elseif ($step==7){
      $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // if($this->admin_model->sendEmailToClientApprove($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}

public function approve_by_admin2($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $now = date('Y-m-d H:i:s');
  // echo '<script>alert('.$coop_full_name.');</script>';
  if ($step==1)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>5,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==3)
    $this->db->update('branches',array('evaluator3'=>$admin_info->id,'status'=>12,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_specialist'=>$comment_by_specialist_senior,'date_approved_cds'=>$now));
  else if($step==4)
    $this->db->update('branches',array('evaluator4'=>$admin_info->id,'status'=>15,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior'=>$comment_by_specialist_senior,'date_approved_senior'=>$now));
  else if($step==6)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>NULL,'date_approved_director'=>$now,'temp_evaluation_comment'=>NULL, 'comment_by_director_level1'=>$comment_by_specialist_senior));
  else if($step==7)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>23,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior_level1'=>$comment_by_specialist_senior,'date_approved_director'=>$now));
  else 
    $this->db->update('branches',array('evaluator5'=>$admin_info->id,'status'=>18,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'date_approved_director'=>$now));
  // echo $this->db->last_query();
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($step==1){
      $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    } 
    elseif($step==2){
      $branch=$this->get_branch_info_by_admin($branch_id);
      $senior_emails = $this->admin_model->get_emails_of_senior_by_region($branch->rCode);
      if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }
    elseif($step==3){
      $senior_emails = $this->admin_model->get_emails_of_senior_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$senior_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }
    elseif($step==4){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }
    elseif ($step==5){
      $this->db->select('branches.type,branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($client_info->type == 'Branch'){
        // if($this->admin_model->sendEmailToClientApproveBranch($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
          $this->db->trans_commit();
          return true;
        // }else{
        //   $this->db->trans_rollback();
        //   return false;
        // }
      } else {
        // if($this->admin_model->sendEmailToClientApproveBranch($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
          $this->db->trans_commit();
          return true;
        // }else{
        //   $this->db->trans_rollback();
        //   return false;
        // }
      }
    }
    elseif ($step==6){
      $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // if($this->admin_model->sendEmailToClientApprove($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }elseif ($step==7){
      $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // if($this->admin_model->sendEmailToClientApprove($client_info->coopName.$client_info->branchName,$client_info->email)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}


public function deny_by_admin($admin_info,$branch_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>3,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==2)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>6,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==3)
    $this->db->update('branches',array('evaluator3'=>$admin_info->id,'status'=>10,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==4)
    $this->db->update('branches',array('evaluator4'=>$admin_info->id,'status'=>13,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('branches',array('evaluator5'=>$admin_info->id,'status'=>16,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==5){
      $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // if($this->sendEmailToClientDeny($client_info->fullname,$client_info->coopName.'-'.$client_info->branchName,$reason_commment,$client_info->email)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}

public function defer_by_admin($admin_info,$branch_id,$reason_commment,$step){
  $this->db->select('branches.coopName, branches.branchName, users.*');
      $this->db->from('branches');
      $this->db->join('users' , 'users.id = branches.user_id','inner');
      $this->db->where('branches.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      // return $this->db->last_query();
      $client_info->fullname = $client_info->first_name.' '.$client_info->last_name;
      // return  $client_info;
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>4,'lastUpdated'=>date('Y-m-d h:i:s',(now('A sia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  elseif($step==2)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>7,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  elseif($step==3)
    $this->db->update('branches',array('evaluator3'=>$admin_info->id,'status'=>11,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  elseif($step==4)
    $this->db->update('branches',array('evaluator4'=>$admin_info->id,'status'=>14,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  elseif($step==6)
    $this->db->update('branches',array('status'=>17,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('branches',array('evaluator5'=>$admin_info->id,'status'=>17,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==5 || $step==6){
      // if($this->admin_model->sendEmailToClientDefer($client_info->fullname,$client_info->coopName.'-'.$client_info->branchName,$client_info->email,$reason_commment)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}

// public function check_branch_exist($user_id){
//     $query2 = $this->db->get_where('branches', array('user_id' => $user_id));
//     return $query2->num_rows() > 0 ? true : false;
// }

public function check_submitted_for_evaluation($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $branch_status = $data->status;
  if($branch_status == 23){
      return true;
  }
  else if($branch_status > 1 && $branch_status < 16){
    return true;
  }else{
    return false;
  }
}
public function check_if_deferred($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $evaluated = $data->evaluated_by;
  if($evaluated != 0){
    return true;
  }else{
    return false;
  }
}
public function check_not_yet_assigned($branch_id){
  $this->db->where(array('id'=>$branch_id,'status'=>9,'evaluator3 !='=>0));
  $this->db->from('branches');
  if($this->db->count_all_results() == 0){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator1($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=3){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator2($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=6){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator3($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=10){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator4($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=13){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator5($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=24){
    return true;
  }else{
    return false;
  }
}

public function check_if_denied($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==4 || $coop_status==6 || $coop_status==8){
    return true;
  }else{
    return false;
  }
}

public function check_if_amended($regNo){
  $this->db->where(array('regNo'=>$regNo));
  $this->db->from('registeredamendment');
  if($this->db->count_all_results() == 0){
    return false;
  }else{
    return true;
  }
}

public function get_coop($regNo){
  $this->db->select('registeredcoop.*,registeredcoop.areaOfOperation,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
  $this->db->from('registeredcoop');
  $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
  $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  $this->db->where('regNo', $regNo);
  $this->db->order_by('registeredcoop.id','desc');
  $query = $this->db->get();
  
  return $query->row();
}

public function get_coop_amend($regNo){
  $this->db->select('registeredamendment.*,registeredamendment.areaOfOperation,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
  $this->db->from('registeredamendment');
  $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredamendment.addrCode','inner');
  $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  $this->db->where('regNo', $regNo);
  $this->db->order_by('registeredamendment.id','desc');
  $query = $this->db->get();
  
  return $query->row();
}

public function check_evaluator5_laboratories($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=16){
    return true;
  }else{
    return false;
  }
}
  public function get_registered_branches($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (2)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (21)');
    $data = $query->result_array();
    return $data;
  }
  public function outside_the_region($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (23)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (23)');
    $data = $query->result_array();
    return $data;
  }
  public function outside_the_region_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.status in (23)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.status in (23) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function outside_the_region_senior($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refcitymun.citymunCode as cCode, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (24)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refcitymun.citymunCode as cCode, refregion.regDesc as region from branches 
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (24)');
    $data = $query->result_array();
    return $data;
  }
  public function get_registered_coop($regNo){
    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where(array('regNo'=>$regNo));
    $query = $this->db->get();
    return $query->row();

  }
  
  public function get_branch_info_bylaws($coop_id){
    $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_branch_info_bylaws_amend($coop_id){
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
  
  public function update_not_expired_branches($user_id,$coop_id,$field_data){
    $data = $this->security->xss_clean($field_data);
    
    $this->db->trans_begin();
    $this->db->where(array('user_id'=>$user_id,'id'=>$coop_id));
    $this->db->update('branches',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function insert_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('branches_comment',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }
  
  public function branches_comments_main($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3,'user_id'=>$user_id));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_director($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3,'user_id'=>$user_id));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_director_level1($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_director_limit($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3,'user_id'=>$user_id));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_client($coop_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where('branches_id = '.$coop_id.' AND user_level = 3 OR user_level = 4');
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3,'user_id'=>$user_id));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_level1_defer($coop_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>3));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_cds($coop_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_snr($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2,'user_id'=>$user_id));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_snr_limit($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2,'user_id'=>$user_id));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_snr_limit_level1($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('branches_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function getCoopRegNo($user_id){
    $this->db->select('registeredcoop.regNo as regNo,registeredcoop.dateRegistered,cooperatives.area_of_operation,cooperatives.regions,registeredcoop.addrCode, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('registeredcoop');
    $this->db->join('cooperatives','ON registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.users_id'=> $user_id));
    $this->db->order_by('registeredcoop.id','DESC');
    $query = $this->db->get();
    return $query->row();
  }

  public function getCoopifExists($user_id){
    $this->db->select('registeredcoop.regNo as regNo,registeredcoop.dateRegistered,cooperatives.area_of_operation,cooperatives.regions,registeredcoop.addrCode, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('registeredcoop');
    $this->db->join('cooperatives','ON registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.users_id'=> $user_id));
    $this->db->order_by('registeredcoop.id','DESC');
    if($this->db->count_all_results() != 0){
      return true;
    }else{
      return false;
    }
  }
  

  public function change_status_branches($decoded_id,$status){
    $decoded_id = $this->security->xss_clean($decoded_id);
    $status = $this->security->xss_clean($status);

    $this->db->trans_begin();
    $this->db->where(array('id'=>$decoded_id));
    $this->db->update('branches',array('status'=>$status));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function sendEmailToSeniorBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application from ".$coop_region." for establishment of ".$type." with the following details has been submitted:<p>

      <ol type='a'> 
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$clientemail."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
          return true;
      }
  }

  public function sendEmailToClientBranch($email,$type,$proposedbranch,$brgyforemail){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Your application for ".$type." with the following details has been submitted and subject for validation and evaluation.<br><br> 

a. Name of proposed ".$type.": ".$proposedbranch."<br>
b. Adress of proposed ".$type.": ".$brgyforemail."";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToSpecialistBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "You are assigned to validate the  application for establishment of ".$type." with the following details: <p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Region of Cooperative:</b>".$coopregion."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToSeniorFromCDSBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coopregion){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "A validated application for establishment of ".$type." with the following details has been submitted for your evaluation:<p>

      <ol type='a'> 
        <b><li> Name of CDS II/Validator:</b>".$fullnamesupervising."</li>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coopregion."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$clientemail."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
      return true;
    }
  }

  public function sendEmailToDirector($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Senior CDS evaluated application for establishment of ".$type." with the following details has been submitted for your evaluation and approval/denial/deferment: <p>

    <ol type='a'> 
      <b><li> Name of CDS II/Validator:</b>".$fullnamecds."</li>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Region of Cooperative:</b>".$coopregion."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
      // echo $this->email->print_debugger();
    }else{
        return false;
    }
  }

  public function sendEmailToClientDeferBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$comment,$region_code,$reg_officials_info,$rdregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "".date('F d, Y')." <br><br>

  Proposed Name of ".$type.": ".$proposedbranch." <br>
  Proposed Address of ".$type." : ".$brgy."<br><br>

  Good Day! <br><br>

  This refers to the application for ".$type." of the proposed ".$proposedname.".<br><br>

    Upon review of the documents submitted online the following are our findings:<p> <br>
    
    <br>".nl2br($comment)."<br>

    <br>Please comply immediately with the above-mentioned findings within 15 days. <br>

    <br>Should you need further information or clarification, please feel free to contact Registration Division/Section at telephone numbers ".ltrim(rtrim($reg_officials_info['contact']))." or email us at ".$reg_officials_info['email'].".   <br><br>


Very truly yours,<br>

<br>Regional Director<br>
".$rdregion."";


    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToSeniorDeferBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$coopregion){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! A deferred application for establishment of ".$type." with the following details has been submitted:<p>

      <ol type='a'> 
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$clientemail."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
      return true;
    }
  }

  public function sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$email,$type,$rdregion){
    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coop_full_name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    // $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> failed the evaluation. This cooperative has been denied because of the following reason/s:<br><pre>".$comment."</pre>";

    $message = "".date('F d, Y')."<br><br>

    Proposed Name of ".$type.": ".$coop_full_name."<br>
    Proposed Address of ".$type.": ".$brgyforemail."<br><br>

    Good Day! <br><br>

    This refers to the application for ".$type." of the proposed ".$coop_full_name.".<br><br>

    Based on the evaluation of the submitted application documents for ".$type.", we regret to inform you that the application is denied due to:<p> <br>
    
    ".trim(preg_replace('/\s\s+/', '<br>', $reason_commment))."<br><br>

    Very truly yours,<br>

    <br>Regional Director<br>
    ".$rdregion."";

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  } 

  public function sendEmailToSeniorBranchApprove($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application from ".$regionname." for establishment of ".$type." with the following details has been submitted:<p>

      <ol type='a'> 
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
          return true;
      }
  }

  public function sendEmailToClientApproveBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";
    if($type == "Satellite"){
      $message="<pre>Proposed Name of Satellite: ".$proposedbranch."
                Proposed Satellite Office Address of Cooperative: ".$brgy."

          Congratulations!
          Your application for establishment of Satellite Office is APPROVED.

          You may now print and submit the following requirements :

          1.Oath of Undertaking signed by the Chairperson of the cooperative for the specific services/activities to be undertaken by the proposed satellite office;

           2. Certification as to available space and manpower to manage the office. 

          Submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
          System (E-CoopRIS).</pre>";
    } else {
      $message="<pre>Proposed Name of Branch: ".$proposedbranch."
                Proposed Branch Office Address of Cooperative: ".$brgy."

          Congratulations!
          Your application for establishment of Branch Office is APPROVED.

      You may now print and submit the following requirements :

      1. Business Plan
      2. General Assembly Resolution
      3. Certification for the presence of Manual of Operation and Addresses of the branch office.

      Submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
      System (E-CoopRIS).</pre>";
    }

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
    }
  }

  public function sendEmailToDirectorHO_OR($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$regionname){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body

    $message = "Good day! An application from ".$regionname." for establishment of ".$type." with the following details has been submitted: <p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
}
