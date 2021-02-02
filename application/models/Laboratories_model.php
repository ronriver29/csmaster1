<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laboratories_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function check_last_evaluated($coop_id){
  $query = $this->db->get_where('laboratories',array('id'=>$coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=10){
    return false;
  }else{
    return true;
  }
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

	//modify by json
  public function get_coopID($reg_no)
  {
    $qry = $this->db->get_where('registeredcoop',array('regNo'=>$reg_no));
    if($qry->num_rows()>0)
    {
      foreach($qry->result() as $row)
      {
        return $row->application_id;
      }
    }
    else
    {
      return "No cooperative id found.";
    }
  }
  //modify
  public function get_lab_info($id)
  {
    $lab_query = $this->db->get_where('laboratories',array('id'=>$id));
    if($lab_query->num_rows()>0)
    {
      $data = $lab_query->row();
    }
    else
    {
      $data = "No Data Found.";
    }
    return $data;
  }
	
  //modify by json
  public function check_submitted_doc($coopID,$labID,$docType)
  {
    $qry = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coopID,'laboratory_id'=>$labID,'document_num'=>$docType,'status'=>1));
    if($qry->num_rows()>0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
   
  }

 // start modify sss
public function approve_by_director_laboratories($admin_info,$laboratory_id){
  $coop_id = $this->security->xss_clean($laboratory_id);
  $this->db->select('laboratories.labName, users.*');
  $this->db->from('laboratories');
  $this->db->join('users' , 'users.id = laboratories.user_id','inner');
  $this->db->where('laboratories.id', $laboratory_id);
  $query = $this->db->get();
  $client_info = $query->row_array();
  $this->db->trans_begin();
  $this->db->where('id',$laboratory_id);
  $this->db->update('laboratories',array('status'=>18,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'dateRegistered'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
  
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
// end modify

  public function check_own_branch($branch_id,$user_id){
    $query2 = $this->db->get_where('laboratories', array('user_id' => $user_id,'id'=> $branch_id));
    return $query2->num_rows() > 0 ? true : false;
  }
  public function get_all_laboratories($user_id){
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, coopName');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=laboratories.coop_id','inner');
    $this->db->where('laboratories.user_id', $user_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_laboratories_by_specialist($regcode,$admin_id){
   $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, coopName');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=laboratories.coop_id','inner');
    $this->db->where('laboratories.user_id', $admin_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  
  public function add_branch($data,$BAC){

    $data = $this->security->xss_clean($data);
    $BAC = $this->security->xss_clean($BAC);
    $batch_subtype = array();
   
    $this->db->trans_begin();
    $this->db->insert('laboratories',$data);
    $id = $this->db->insert_id();
//    foreach($BAC as $industry_subclasses_id){
//      array_push($batch_subtype, array(
//        'branch_id'=> $id,
//        'business_subclass'=>$industry_subclasses_id)
//      );
//    }
//    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function update_laboratory($data,$id){

    $data = $this->security->xss_clean($data);
    // $BAC = $this->security->xss_clean($BAC);
    // $batch_subtype = array();
   
    $this->db->trans_begin();
    $this->db->update('laboratories',$data,array('id'=>$id));
    
  
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  //modify
  public function check_lab_membername_exist($name,$mname,$lname,$lab_id)
  {
    // $check_qry = $this->db->get_where('laboratories_cooperators',array('full_name'=>$name,'last_name'=>$lname));
    $this->db->select('*');
    $this->db->from('laboratories_cooperators');
    $this->db->where(array('laboratory_id'=>$lab_id,'full_name'=>$name,'middle_name'=>$mname,'last_name'=>$lname));
    $lab = $this->db->get();
    if($lab->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function add_lab_members($data)
  {
     $this->db->trans_begin();
     $insert = $this->db->insert('laboratories_cooperators',$data);
      if($this->db->trans_status() === FALSE)
      {
        $this->db->trans_rollback();
         return array('success'=>false,'message'=>'Unable to save laboratory member');
      }
      else
      {
          $this->db->trans_commit();
         return array('success'=>true,'message'=>'Member/Cooperator has been successfully saved.');
      }
  }

  //modify json
   public function generate_certNo($laboratoryID){

    $this->db->select('laboratories.*,refregion.regCode as regCode');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('laboratories.id'=>$laboratoryID,'status'=>21));
    $lab = $this->db->get();
    if($lab->num_rows()>0)
    {
      foreach($lab->result() as $row)
      {
        // $addrCode = $row->addCode
        $rCode = $row->regCode;
      }
     
      //check if there already registered with the same region 
      $last_digit=$this->check_laboratory_exist($rCode)+1;
      $zeros='0000000';
      $pst = 1; // Primary
      $grtd_cert='CR-'.$pst.$rCode.$zeros.$last_digit;
     
      if($this->db->update('laboratories',array('certNo'=>$grtd_cert),array('id'=>$laboratoryID)))
      {
         // $c =$this->db->get_where('laboratories',array('id'=>$laboratoryID));
         // echo json_encode($c->result());
         // echo"<br>". $this->db->last_query();
        return true;
      }
     
    }
    else
    {
      return false; //no records found.
    }
     
  
    // $this->db->update('laboratories', array('branchName'=>$branchName,'status'=>21,'certNo'=>$j,'dateRegistered'=>date('Y-m-d',now('Asia/Manila'))),array('id'=>$branch_id));

    // if($this->db->trans_status() === FALSE){
    //   $this->db->trans_rollback();
    //   return array('success'=>false,'message'=>'Failed to generate Certification No.');
    // }else{
    //   $this->db->trans_commit();
    //   return array('success'=>true,'message'=>'Certification No. has been successfully generated.');
    // }
  }
  //end modify

  public function check_laboratory_exist($regionalCode)
  {
        $this->db->select('laboratories.*,refregion.regCode');
        $this->db->from('laboratories');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where(array('refregion.regCode'=>$regionalCode));
        $qry = $this->db->get();
        if($qry->num_rows()>0)
        {
            $data = count($qry->result());
           
        }
        else
        {
            $data =NULL;
        }
        return $data;

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
    $query=$this->db->query('select * from laboratories where coop_id="'.$regNo.'" and addrCode like "'.$munCode.'%" and labName like "%'.$type.'%"');

    return ($query->num_rows()>=1)? $query->num_rows()+1:'';
  }
  
  public function count_cooperators($cooperatives_id){
    $query=$this->db->query('select COUNT(*) as CountCooperators from laboratories_cooperators where laboratory_id ="'.$cooperatives_id.'"');

    return $query->row();
  }

  public function get_payment_info($branch){
    $query = $this->db->query('select * from payment where payor="'.$branch.'"');
    // return $this->db->last_query();
    return $query->row();
  }
  public function save_OR($where, $data, $id,$date_of_or){
    $this->db->trans_begin();
    $this->db->update('laboratories', array('status'=>21),array('id'=>$id));
    $this->db->update('payment', $data, $where);
    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }

  }

  //modify
  public function check_second_evaluated_laboratories($coop_id)
  {
    $query = $this->db->get_where('laboratories',array('id'=>$coop_id));
    $data = $query->row();
    $coop_status = $data->status;
    if($coop_status==12){
      return true;
    }else{
      return false;
    }
  }
  

  // public function get_all_laboratories_by_specialist($regcode,$admin_id){
  //   $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //   $this->db->from('laboratories');
  //   $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
  //   $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //   $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //   $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  //   $this->db->like('refregion.regCode', $regcode);
  //   $this->db->where(array('status'=>9,'evaluator3'=>$admin_id));
  //   $query = $this->db->get();
  //   $data = $query->result_array();
  //   return $data;
  // }
  public function get_all_laboratories_by_specialist_central_office($regcode){
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>9,'evaluator3 >'=>0));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_laboratories_by_senior($regcode){
    $query = $this->db->query('select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and laboratories.status in (2)
UNION
select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and laboratories.status in (8,10,11,12,18,19,20,24)');
    $data = $query->result_array();
    return $data;
  }

  public function get_all_laboratories_by_director($regcode){
    $query = $this->db->query('select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and laboratories.status in (5)
UNION
select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and laboratories.status in (12,13,14,15,24)');
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
    $this->db->select('major_industry.id,major_industry.description');
    $this->db->from('business_activities_branch');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_branch.business_subclass','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    //$this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
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
//  public function get_branch_info($user_id,$branch_id){
//    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr');
//    $this->db->from('laboratories');
//    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
//    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
//    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
//    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
//    $this->db->join('registeredcoop','registeredcoop.regNo=laboratories.regNo','inner');
//    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
//    $this->db->where(array('laboratories.user_id'=>$user_id,'laboratories.id'=>$branch_id));
//    $query = $this->db->get();
//    return $query->row();
//  }
  public function get_branch_info($user_id,$laboratory_id){
    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,  registeredcoop.application_id,registeredcoop.addrCode as mainAddr,registeredcoop.coopName');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=laboratories.coop_id','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','left');
    $this->db->where(array('laboratories.user_id'=>$user_id,'laboratories.id'=>$laboratory_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_info_by_admin($branch_id){
    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=laboratories.regNo','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->join('refbrgy as x' , 'x.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun as y', 'y.citymunCode = x.citymunCode','inner');
    $this->db->join('refprovince as z', 'z.provCode = y.provCode','inner');
    $this->db->join('refregion as w', 'w.regCode = z.regCode');

    $this->db->where(array('laboratories.id'=>$branch_id));
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
    $this->db->update('laboratories',$data);
    $this->db->delete('business_activities_branch',array('laboratories_id'=>$branch_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'laboratories_id'=> $branch_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    $temp_purpose = array(
        'laboratories_id' => $branch_id,
        'content'  => $this->get_purpose_content($coop_type->name)
      );
    $this->db->where('laboratories_id',$branch_id);
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
    $this->db->update('laboratories',$data);
    $this->db->delete('business_activities_branch',array('laboratories_id'=>$branch_id));
    foreach($industry_subclasses_id_array as $industry_subclasses_id){
      array_push($batch_subtype, array(
        'laboratories_id'=> $branch_id,
        'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
      );
    }
    $this->db->insert_batch('business_activities_branch', $batch_subtype);
    $temp_purpose = array(
        'laboratories_id' => $branch_id,
        'content'  => $this->get_purpose_content($coop_type->name)
      );
    $this->db->where('laboratories_id',$branch_id);
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
  //     $this->db->update('laboratories');
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
  $this->db->delete('laboratories',array('id' => $branch_id));
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
    $this->db->update('laboratories',array('first_evaluated_by'=>$sa->id,'status'=>2,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('laboratories',array('status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));

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
    $this->db->update('laboratories',array('evaluator1'=>$sa->id,'evaluator2'=>$dir->id, 'status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('laboratories',array('status'=>$same,'dateApplied'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));

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
  $this->db->update('laboratories',array('status'=>9,'evaluator3'=>$specialist_id));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($this->admin_model->sendEmailToSpecialist($admin_info,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    }else{
      $this->db->trans_rollback();
      return false;
    }
  }
}
public function approve_by_specialist($admin_info,$branch_id,$coop_full_name){
  $branch_id = $this->security->xss_clean($branch_id);
  $temp = $this->get_branch_info_by_admin($branch_id);
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('laboratories',array('status'=>5,'evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
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
  $this->db->update('laboratories',array('status'=>7,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL));
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
  $this->db->select('laboratories.proposed_name, laboratories.type_of_branch, users.*');
  $this->db->from('laboratories');
  $this->db->join('users' , 'users.id = laboratories.user_id','inner');
  $this->db->where('laboratories.id', $branch_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('laboratories',array('status'=>9,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
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
  $this->db->select('laboratories.proposed_name, laboratories.type_of_branch, users.*');
  $this->db->from('laboratories');
  $this->db->join('users' , 'users.id = laboratories.user_id','inner');
  $this->db->where('laboratories.id', $branch_id);
  $query = $this->db->get();
  $client_info = $query->row();
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $this->db->update('laboratories',array('status'=>9,'third_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(10*24*60*60)))));
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

public function approve_by_admin($admin_info,$branch_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('laboratories',array('evaluator1'=>$admin_info->id,'status'=>5,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('laboratories',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==3)
    $this->db->update('laboratories',array('evaluator3'=>$admin_info->id,'status'=>12,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else if($step==4)
    $this->db->update('laboratories',array('evaluator4'=>$admin_info->id,'status'=>15,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('laboratories',array('evaluator5'=>$admin_info->id,'status'=>18,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
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
      $this->db->select('laboratories.coopName, laboratories.branchName, users.*');
      $this->db->from('laboratories');
      $this->db->join('users' , 'users.id = laboratories.user_id','inner');
      $this->db->where('laboratories.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($this->admin_model->sendEmailToClientApprove($client_info->coopName.'-'.$client_info->branchName,$client_info->email)){
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

public function deny_by_admin($admin_info,$branch_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('laboratories',array('evaluator1'=>$admin_info->id,'status'=>3,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==2)
    $this->db->update('laboratories',array('evaluator2'=>$admin_info->id,'status'=>6,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==3)
    $this->db->update('laboratories',array('evaluator3'=>$admin_info->id,'status'=>10,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==4)
    $this->db->update('laboratories',array('evaluator4'=>$admin_info->id,'status'=>13,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('laboratories',array('evaluator5'=>$admin_info->id,'status'=>16,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==5){
      $this->db->select('laboratories.coopName, laboratories.branchName, users.*');
      $this->db->from('laboratories');
      $this->db->join('users' , 'users.id = laboratories.user_id','inner');
      $this->db->where('laboratories.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($this->admin_model->sendEmailToClientDeny($client_info->fullname,$client_info->coopName.'-'.$client_info->branchName,$client_info->email,$reason_commment)){
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

public function defer_by_admin($admin_info,$branch_id,$reason_commment,$step){
  
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('laboratories',array('evaluator1'=>$admin_info->id,'status'=>4,'lastUpdated'=>date('Y-m-d h:i:s',(now('A sia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==2)
    $this->db->update('laboratories',array('evaluator2'=>$admin_info->id,'status'=>7,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==3)
    $this->db->update('laboratories',array('evaluator3'=>$admin_info->id,'status'=>11,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  elseif($step==4)
    $this->db->update('laboratories',array('evaluator4'=>$admin_info->id,'status'=>14,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('laboratories',array('evaluator5'=>$admin_info->id,'status'=>17,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==5){
      $this->db->select('laboratories.coopName, laboratories.branchName, users.*');
      $this->db->from('laboratories');
      $this->db->join('users' , 'users.id = laboratories.user_id','inner');
      $this->db->where('laboratories.id', $branch_id);
      $query = $this->db->get();
      $client_info = $query->row();
      if($this->admin_model->sendEmailToClientDefer($client_info->fullname,$client_info->coopName.'-'.$client_info->branchName,$client_info->email,$reason_commment)){
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

// public function check_branch_exist($user_id){
//     $query2 = $this->db->get_where('laboratories', array('user_id' => $user_id));
//     return $query2->num_rows() > 0 ? true : false;
// }

// public function check_submitted_for_evaluation($branch_id){
//   $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
//   $data = $query->row();
//   $branch_status = $data->status;
//   if(($branch_status > 1) && ($branch_status <= 17)  ||  ($branch_status === 24)){
//     return true;
//   }else{
//     return false;
//   }
// }
//modify
public function check_submitted_for_evaluation($labID){
  $query = $this->db->get_where('laboratories',array('id'=>$labID));
  foreach($query->result_array() as $row)
  {
    $status = $row['status'];
  }

  
  if($status==2){
    return true;

  }
  elseif($status ==3)
  {
      return true;
  }
  elseif($status ==4)
  {
      return true;
  }
  elseif($status ==5)
  {
      return true;
  }
  elseif($status ==6)
  {
      return true;
  }
  elseif($status ==7)
  {
      return true;
  }
  elseif($status ==8)
  {
      return true;
  }
  elseif($status ==9)
  {
      return true;
  }
  elseif($status ==10)
  {
      return true;
  }
  elseif($status ==11)
  {
      return true;
  }
  elseif($status ==12)
  {
      return true;
  }
  elseif($status ==13)
  {
      return true;
  }
  elseif($status ==14)
  {
      return true;
  }
  elseif($status ==15)
  {
      return true;
  }
  elseif($status ==16)
  {
      return true;
  }
  elseif($status ==17)
  {
      return true;
  }
   elseif($status ==18)
  {
      return true;
  }
    elseif($status ==24)
  {
      return true;
  }
  else{
    return false;
  }
}

//modify to allow 24/deferred status for laboratory
public function check_submitted_for_evaluation_2($labID){
  $query = $this->db->get_where('laboratories',array('id'=>$labID));
  foreach($query->result_array() as $row)
  {
    $status = $row['status'];
  }

  if($status==1){
    return true;

  }
  elseif($status ==24)
  {
      return true;
  }
  else
  {
    return false;
  }
}
//end modify
public function check_if_deferred($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
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
  $this->db->from('laboratories');
  if($this->db->count_all_results() == 0){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator1($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=3){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator2($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=6){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator3($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=10){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator4($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=13){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator5($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status>=16){
    return true;
  }else{
    return false;
  }
}

public function check_if_denied($branch_id){
  $query = $this->db->get_where('laboratories',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==4 || $coop_status==6 || $coop_status==8){
    return true;
  }else{
    return false;
  }
}

public function get_coop($regNo){
  $this->db->select('registeredcoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
  $this->db->from('registeredcoop');
  $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
  $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  $this->db->where('regNo', $regNo);
  $query = $this->db->get();
  
  return $query->row();
}
public function check_own_cooperative($coop_id,$user_id){
    $query2 = $this->db->get_where('laboratories', array('user_id' => $user_id,'id'=> $coop_id));
    return $query2->num_rows() > 0 ? true : false;
}
public function check_expired_reservation($coop_id,$user_id){
  $query = $this->db->get_where('laboratories',array('user_id' => $user_id,'id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function get_cooperative_info($user_id,$coop_id){
  $this->db->select('laboratories.*,cooperatives.area_of_operation as area_of_operation, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
  $this->db->from('laboratories');
  $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
  $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
  $this->db->join('cooperatives','laboratories.cooperative_id = cooperatives.id');
  $this->db->where(array('laboratories.user_id'=>$user_id,'laboratories.id'=>$coop_id));
  $query = $this->db->get();
  return $query->row();
}
public function check_expired_reservation_by_admin($coop_id){
  $query = $this->db->get_where('laboratories',array('id'=> $coop_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status==0){
    return true;
  }else{
    return false;
  }
}
public function get_cooperative_info_by_admin_laboratories(){
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('laboratories');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->laboratories_model->get_cooperative_info_by_admin_laboratories($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
public function get_cooperative_info_by_admin($coop_id){
    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('laboratories.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
//public function get_laboratories_info($coop_id){
//    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
//    $this->db->from('laboratories');
//    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
//    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
//    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
//    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
//    $this->db->where(array('laboratories.id'=>$coop_id));
//    $query = $this->db->get();
//    return $query->row();
//  }
  
  public function get_laboratories_info_by_admin($coop_id){
    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,registeredcoop.coopName as coopName');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = laboratories.coop_id','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('laboratories.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  
  public function get_registered_laboratories($regcode){
    $query = $this->db->query('select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and laboratories.status in (21)
UNION
select laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName as coopName from laboratories 
  inner join refbrgy on refbrgy.brgyCode = laboratories.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on laboratories.coop_id = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and laboratories.status in (21)');
    $data = $query->result_array();
    return $data;
  }

  //modify by json
  // public function labratory_comment($laboratory_id)
  // {
  //   $qry = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$laboratory_id));
  //   if($qry->num_rows()>0)
  //   {
  //     return $qry->row();
  //   }
  // }

  //modify by json
public function deny_by_director($id,$user_id,$user_access_level,$comment)
{
    $this->db->trans_begin();
    if($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();
      return false;
    }
    else
    {
      //check if already denied
      $check_query=$this->db->query("select status,lastUpdated,labName as coopname,laboratoryName,user_id as lab_userid from laboratories where id ='$id'");
      if($check_query->num_rows()>0){
        foreach($check_query->result() as $row)
        {
          $coopname = $row->coopname;
          $labname = $row->laboratoryName;
          $lab_user_id = $row->lab_userid;
          //get email 
          $email_query = $this->db->query("select email from users where id='$lab_user_id'");
          if($email_query->num_rows()>0)
          {
            foreach($email_query->result() as $rowm)
            {
              $email = $rowm->email;
            }//endforeach
          }
          if($row->status ==25)
          {  
              $lab_data = array(
              'status'=>25,
              'third_evaluated_by'=>$user_id,
              'evaluation_comment'=> "Denied by Director",
              'lastUpdated' => $row->lastUpdated //get last updated date
              );  
              $comment_data = array(
                'user_id'=>$user_id,
                'user_access_level'=>$user_access_level,
                'laboratory_id'=>$id,
                'comment'=> $comment,
                'created_at' =>date('Y-m-d h:i:s',(now('Asia/Manila')))
              );
              $this->db->update('laboratories',$lab_data,array('id'=>$id));
              
              if(!$this->db->update('laboratory_comment',$comment_data,array('user_id'=>$user_id,'user_access_level'=>$user_access_level,'laboratory_id'=>$id,'laboratory_status'=>25)))
              {
                return json_encode("failed to updated existing denied laboratory commit");
              }

              $this->sendEmailToClientDenyLaboratory($email,$coopname,$labname,$comment);
              $this->db->trans_commit();
              return true;  
          }
          else
          {
              $lab_data = array(
              'status'=>25,
              'third_evaluated_by'=>$user_id,
              'evaluation_comment'=> "Denied by Director",
              'lastUpdated' => date('Y-m-d h:i:s',(now('Asia/Manila')))
              );  
              $comment_data = array(
                'user_id'=>$user_id,
                'user_access_level'=>$user_access_level,
                'laboratory_id'=>$id,
                'laboratory_status'=>25,
                'comment'=> $comment,
                'created_at' =>date('Y-m-d h:i:s',(now('Asia/Manila')))
              );
              $this->db->update('laboratories',$lab_data,array('id'=>$id));
              $this->db->insert('laboratory_comment',$comment_data); 
              $this->sendEmailToClientDenyLaboratory($email,$coopname,$labname,$comment);//send email to client 
              $this->db->trans_commit();
              return true;    
              }//end if status 25
        }//end foreach
      }//end of if check    
    } //end tras status
}


  //modify by json
public function defer_by_director($id,$user_id,$user_access_level,$comment)
{
    $this->db->trans_begin();
    if($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();
      return false;
    }
    else
    {
      //check if already denied
      $check_query=$this->db->query("select status,lastUpdated,labName as coopname,laboratoryName,user_id as lab_userid from laboratories where id ='$id'");
      if($check_query->num_rows()>0){
        foreach($check_query->result() as $row)
        {
          $coopname = $row->coopname;
          $labname = $row->laboratoryName;
          $lab_user_id = $row->lab_userid;
          //get email 
          $email_query = $this->db->query("select email from users where id='$lab_user_id'");
          if($email_query->num_rows()>0)
          {
            foreach($email_query->result() as $rowm)
            {
              $email = $rowm->email;
            }//endforeach
          }
          if($row->status ==24)
          {  
              $lab_data = array(
              'status'=>24,
              'third_evaluated_by'=>$user_id,
              'evaluation_comment'=> "Deferred by Director",
              'lastUpdated' => $row->lastUpdated //get last updated date
              );  
              $comment_data = array(
                'user_id'=>$user_id,
                'user_access_level'=>$user_access_level,
                'laboratory_id'=>$id,
                'laboratory_status'=>24,
                'comment'=> $comment,
                'created_at' =>date('Y-m-d h:i:s',(now('Asia/Manila')))
              );
              $this->db->update('laboratories',$lab_data,array('id'=>$id));
              
              // if(!$this->db->update('laboratory_comment',$comment_data,array('user_id'=>$user_id,'user_access_level'=>$user_access_level,'laboratory_id'=>$id,'laboratory_status'=>24)))
              // {
              //   return json_encode("failed to updated existing deferred laboratory commit");
              // }
              if(!$this->db->insert('laboratory_comment',$comment_data))
              {
                return json_encode("failed to updated existing deferred laboratory commit");
              }

              $this->sendEmailToClientDeferLaboratory($email,$coopname,$labname,$comment);
              $this->db->trans_commit();
              return true;  
          }
          else
          {
              $lab_data = array(
              'status'=>24,
              'third_evaluated_by'=>$user_id,
              'evaluation_comment'=> "Denied by Director",
              'lastUpdated' => date('Y-m-d h:i:s',(now('Asia/Manila')))
              );  
              $comment_data = array(
                'user_id'=>$user_id,
                'user_access_level'=>$user_access_level,
                'laboratory_id'=>$id,
                'laboratory_status'=>24,
                'comment'=> $comment,
                'created_at' =>date('Y-m-d h:i:s',(now('Asia/Manila')))
              );
              $this->db->update('laboratories',$lab_data,array('id'=>$id));
              $this->db->insert('laboratory_comment',$comment_data); 
              $this->sendEmailToClientDeferLaboratory($email,$coopname,$labname,$comment);//send email to client 
              $this->db->trans_commit();
              return true;    
              }//end if status 25
        }//end foreach
      }//end of if check    
    } //end tras status
}


  //modify by json
    public function sendEmailToClientDenyLaboratory($email,$coopname,$labname,$comment){

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coopname.'-'.$labname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry Your application <b>".$coopname.'-'.$labname." Laboratory</b> failed the evaluation. This laboratory has been denied because of the following reason/s:<br><pre>".$comment."</pre>";
    $this->email->from($from,'CoopRIS Administrator');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  //modify by json
    public function sendEmailToClientDeferLaboratory($email,$coopname,$labname,$comment){

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coopname.'-'.$labname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry Your application <b>".$coopname.'-'.$labname." Laboratory</b> failed the evaluation. This laboratory has been deffered because of the following reason/s:<br><pre>".$comment."</pre>";
    $this->email->from($from,'CoopRIS Administrator');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function getCoopRegNo($user_id){
    $this->db->select('registeredcoop.regNo as regNo, articles_of_cooperation.guardian_cooperative as gc');
    $this->db->from('registeredcoop');
    $this->db->join('cooperatives','registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('articles_of_cooperation','cooperatives.id = articles_of_cooperation.cooperatives_id','inner');
    $this->db->where(array('cooperatives.users_id'=> $user_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function admin_comment($laboratory_id,$user_level)
  {
    
   if($user_level==2)
   {
  
      $qry = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$laboratory_id,'user_access_level'=>$user_level));
          if($qry->num_rows()>0)
          {
                foreach($qry->result_array() as $row)
                {
                  $row['comment_by']='Senior Comment';
                  $data[]=$row;
                }
              
          }
          else
          {
            $data= NULL;
          }
          return $data;
   }
   else
   {
      $check_query = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$laboratory_id,'user_access_level'=>3));
      if($check_query->num_rows()>0)
      {
        foreach($check_query->result_array() as $row)
        {
          $row['comment_by']='Director Comment';  
          $data[]=$row;
        }

         // $qry = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$laboratory_id));
         // if($qry->num_rows()>0)
         //  {
         //    foreach($qry->result_array() as $row)
         //    {
         //      if($row['user_access_level']==2)
         //      {
         //        $row['comment_by']='Senior Comment';
         //      }
         //      if($row['user_access_level']==3)
         //      {
         //        $row['comment_by']='Director Comment';  
         //      }
              
         //      $data[]=$row;
         //    }
         //  }
         //  else
         //  {
         //    $data =  NULL;
         //  }
        return $data;
      }
      else
      {
        $data =NULL;
      }
     return $data;
   }
    
    // if($qry->num_rows()>0)
    // {
    //   foreach($qry->result_array() as $row)
    //   {
    //     if($row['user_access_level']==2)
    //     {
    //       $row['comment_by']='Senior Comment';
    //     }
    //     if($row['user_access_level']==3)
    //     {
    //       $row['comment_by']='Director Comment';
    //     }
    //     $data[]=$row;
    //   }
    // }
    // else
    // {
    //   $data =  NULL;
    // }
 
  }

  public function get_cooperatve_types($cooperative_type_id)
    {
      $cooptype_array  =explode(',',$cooperative_type_id);
      $qry=$this->db->where_in('cooperative_type_id',$cooptype_array)->get('amendment_coop_type_upload');
     $data = $qry->result_array();
     return $data;

    }
    
  public function coop_dtl($cooperative_id)
  {
    $qry =$this->db->get_where('cooperatives',array('id'=>$cooperative_id));
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }
    else
    {
      return NULL;
    }
  }

  public function get_coop_id($laboratory_id)
  {
   $qry= $this->db->get_where('laboratories',array('id'=>$laboratory_id));
   if($qry->num_rows()>0)
   {
    return $qry->row();
   }
   else
   {
    return NULL;
   }
  }
  public function debug($array)
  {
    echo"<pre>";
    print_r($array);
    echo"</pre>";
  }
  
}