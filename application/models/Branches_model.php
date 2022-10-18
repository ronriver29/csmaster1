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
  public function get_all_branches_regno_ho($regno){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, branches.coopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'branches.regNo = registeredcoop.regNo');
    // $this->db->where('branches.user_id', $user_id);
    $this->db->where('(branches.status >= 21 OR branches.status = 1) AND branches.status != 0 AND branches.regNo = "'.$regno.'" AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $this->db->group_by('branches.branchName,branches.id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_regno($regno,$regioncode){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, coopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->where('branches.user_id', $user_id);
    $this->db->where('(branches.status >= 21 OR branches.status = 1) AND branches.status != 0 AND branches.regNo = "'.$regno.'" AND (SUBSTR(branches.addrCode,1,2) LIKE "%'.substr($regioncode,1,2).'" OR SUBSTR(branches.transferred_region,1,2) LIKE "%'.substr($regioncode,1,2).'")');
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
    $this->db->where('branches.user_id ='.$user_id.' AND branches.status NOT IN (0,80,81) AND branches.migrated = 0');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_branch_info_amend_migrated($branch_id){
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, amend_coop.category_of_cooperative, amend_coop.type_of_cooperative, amend_coop.grouping, registeredamendment.amendment_id,registeredamendment.addrCode as mainAddr, registeredamendment.areaOfOperation as aoo,registeredamendment.type as registeredtype, registeredcoop.application_id, amend_coop.id as ammend_id, branches.id as branch_id');
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

  public function get_branch_info_migrated($branch_id){
    $this->db->select('bc.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, c.category_of_cooperative, c.type_of_cooperative, c.grouping, r.application_id,r.addrCode as mainAddr, r.areaOfOperation as aoo,r.type as registeredtype,c.area_of_operation,c.regions,r.regNo,r.coopName,bc.type as b_type');
    $this->db->from('branches bc');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = bc.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->join('registeredcoop r' , 'bc.regNo = r.regNo ','inner');
    $this->db->join('cooperatives c', 'r.application_id = c.id','inner');
    $this->db->where('bc.id', $branch_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function get_all_branches_migrated($regno){
    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $this->db->distinct();
    $this->db->select('bc.id as b_id,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,bc.status AS stat,bc.sent_lapse_notif,bc.house_blk_no,bc.street,bc.area_of_operation,r.coopName,bc.branchName,bc.status,bc.certNo,bc.dateRegistered');
    $this->db->from('branches bc');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = bc.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->join('registeredcoop r' , 'bc.regNo = r.regNo ','inner');
    $this->db->join('cooperatives c', 'r.application_id = c.id','inner');
    $this->db->group_by('bc.id,r.regNo');
    $this->db->where('bc.regNo = "'.$regno.'" AND bc.migrated = 1');
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

  public function get_payment_info_transfer($coop){
//original  $query = $this->db->query('select * from payment where payor="'.$branch.'" and (nature= "Branch Registration" or nature= "Satellite Registration")');
    $query = $this->db->query('select * from payment where bns_id = "'.$coop.'" AND nature = "Transfer"');

    return $query->row();
  }

  public function get_payment_info_conversion($coop){
//original  $query = $this->db->query('select * from payment where payor="'.$branch.'" and (nature= "Branch Registration" or nature= "Satellite Registration")');
    $query = $this->db->query('select * from payment where bns_id = "'.$coop.'" AND nature = "Conversion"');

    return $query->row();
  }

  public function get_payment_info($coop){
//original  $query = $this->db->query('select * from payment where payor="'.$branch.'" and (nature= "Branch Registration" or nature= "Satellite Registration")');
    $query = $this->db->query('select * from payment where bns_id = "'.$coop.'"');

    return $query->row();
  }

  public function register_branch($branch_info){
    $this->db->trans_begin();


    $branches = array(
      "branch_id" => $branch_info->id,
      "branchName" => $branch_info->branchName,
      "certNo" => $branch_info->certNo,
      "coopName" => $branch_info->coopName,
      "regNo" => $branch_info->regNo,
      "area_of_operation" => $branch_info->area_of_operation,
      "type" => $branch_info->type,
      "common_bond" => $branch_info->common_bond,
      "house_blk_no" => $branch_info->house_blk_no,
      "street" => $branch_info->street,
      "addrCode" => $branch_info->addrCode,
      "regCode" => $branch_info->regCode,
      "transferred_region" => $branch_info->transferred_region,
      "transferred_street" => $branch_info->transferred_street,
      "transferred_houseblk" => $branch_info->transferred_houseblk,
      "user_id" => $branch_info->user_id,
      "status" => $branch_info->status,
      "evaluator1" => $branch_info->evaluator1,
      "evaluator2" => $branch_info->evaluator2,
      "evaluator3" => $branch_info->evaluator3,
      "evaluator4" => $branch_info->evaluator4,
      "evaluator5" => $branch_info->evaluator5,
      "evaluator_for_closure_1" => $branch_info->evaluator_for_closure_1,
      "evaluator_for_closure_2" => $branch_info->evaluator_for_closure_2,
      "evaluator_for_transfer_1" => $branch_info->evaluator_for_transfer_1,
      "evaluator_for_transfer_2" => $branch_info->evaluator_for_transfer_2,
      "evaluator_for_transfer_3" => $branch_info->evaluator_for_transfer_3,
      "tool_yn_answer" => $branch_info->tool_yn_answer,
      "tool_remark" => $branch_info->tool_remark,
      "tool_findings" => $branch_info->tool_findings,
      "tool_comment" => $branch_info->tool_comment,
      "evaluation_comment" => $branch_info->evaluation_comment,
      "temp_evaluation_comment" => $branch_info->temp_evaluation_comment,
      "comment_by_specialist" => $branch_info->comment_by_specialist,
      "comment_by_senior" => $branch_info->comment_by_senior,
      "evaluated_by" => $branch_info->evaluated_by,
      "comment_by_senior_level1" => $branch_info->comment_by_senior_level1,
      "comment_by_director_level1" => $branch_info->comment_by_director_level1,
      "dateApplied" => $branch_info->dateApplied,
      "date_approved_cds" => $branch_info->date_approved_cds,
      "date_approved_senior" => $branch_info->date_approved_senior,
      "date_approved_director" => $branch_info->date_approved_director,
      "lastUpdated" => $branch_info->lastUpdated,
      "dateRegistered" => $branch_info->dateRegistered,
      "date_of_or" => $branch_info->date_of_or,
      "lapse_time" => $branch_info->lapse_time,
      "sent_lapse_notif" => $branch_info->sent_lapse_notif,
      "qr_code" => $branch_info->qr_code,
      "date_for_payment" => $branch_info->date_for_payment,
      "date_closure" => $branch_info->date_closure,
      "date_transferred" => $branch_info->date_transferred,
      "date_convert" => $branch_info->date_convert,
      "ok_for_closure" => $branch_info->ok_for_closure,
      "ok_for_transfer" => $branch_info->ok_for_transfer,
      "ok_for_conversion" => $branch_info->ok_for_conversion,
    );



    // echo print_r($data);
    $this->db->insert('stored_branch', $branches);

    if($branch_info->type == 'Branch'){
      $bns_type = 'Satellite';
      $cert_replace = str_replace("CA","LA",$branch_info->certNo);
      $qrcode_replace = str_replace("CA","LA",$branch_info->qr_code);
    } else {
      $bns_type = 'Branch';
      $cert_replace = str_replace("LA","CA",$branch_info->certNo);
      $qrcode_replace = str_replace("LA","CA",$branch_info->qr_code);
    }

    if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
        $rowarea = $row['brgy'];
    } else if($branch_info->area_of_operation == 'Provincial') {
        $rowarea = $branch_info->city;
    } else if ($branch_info->area_of_operation == 'Regional') {
        if($this->charter_model->in_charter_city($branch_info->cCode)){
          $rowarea = $branch_info->city;
        } else {
          $rowarea = $branch_info->city.', '.$branch_info->province;
        }
    } else if ($branch_info->area_of_operation == 'Interregional') {
        if($this->charter_model->in_charter_city($branch_info->cCode)){
          $rowarea = $branch_info->city;
        } else {
          $rowarea = $branch_info->city.', '.$branch_info->province;
        }
    }else if ($branch_info->area_of_operation == 'National') {
        if($this->charter_model->in_charter_city($branch_info->cCode)){
          $rowarea = $branch_info->city;
        } else {
          $rowarea = $branch_info->city.', '.$branch_info->province;
        }
    }
    $branchNameF = $rowarea.' '.$bns_type;

    $x=$this->registered_branch_count_conv($branch_info->coopName,$branch_info->type,SUBSTR($branch_info->addrCode, 1, 6));
    // echo $this->db->last_query();
    $y=$this->registered_branch_count2();

    if ($branch_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($branch_info->category_of_cooperative =='Secondary')
        $pst="2";
      else
        $pst="3";

    if($y==0){
      $y=1;
    } else {
      $y=$y+1;
    }
    if ($branch_info->type=='Branch'){
      $j='LA-'.$pst.$branch_info->rCode;
      if($x == 0){
            $branchName = 'Branch';
            $x = 1;
      } else {
            $x = $x+1;
            $branchName = 'Branch '.$x;
      }
    } else {
      $j='CA-'.$pst.$branch_info->rCode;
      if($x == 0){
            $branchName = 'Satellite';
            $x = 1;
      } else {
            $x = $x+1;
            $branchName = 'Satellite '.$x;
      }
    }
    $z = 9;
    $stringcount = $z - strlen($y);
    for($a=strlen($x);$a<$stringcount;$a++)
      $j=$j.'0';
    $j=$j.$y;

    $this->db->update('branches', array('branchName'=>$branchNameF,'type'=>$bns_type,'status'=>68,'certNo'=>$j),array('id'=>$branch_info->id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Certification No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'Certification No. has been successfully generated.');
    }
  }

  public function registered_branch_count_conv($coopName,$branchsatellite,$subaddcode){
      $query= $this->db->query("select * from branches where coopName = '".$coopName."' AND type = '".$branchsatellite."' AND (status = 21 OR status = 68) AND addrCode LIKE '".$subaddcode."%'");
      return $query->num_rows();
  }

  public function registered_branch_count2(){
      $query= $this->db->query("select * from branches where status = 21 OR status = 68");
      return $query->num_rows();
  }

  public function register_branch_transfer($branch_info){
    $this->db->trans_begin();


    $branches = array(
      "branch_id" => $branch_info->id,
      "branchName" => $branch_info->branchName,
      "certNo" => $branch_info->certNo,
      "coopName" => $branch_info->coopName,
      "regNo" => $branch_info->regNo,
      "area_of_operation" => $branch_info->area_of_operation,
      "type" => $branch_info->type,
      "common_bond" => $branch_info->common_bond,
      "house_blk_no" => $branch_info->house_blk_no,
      "street" => $branch_info->street,
      "addrCode" => $branch_info->addrCode,
      "regCode" => $branch_info->regCode,
      "transferred_region" => $branch_info->transferred_region,
      "transferred_street" => $branch_info->transferred_street,
      "transferred_houseblk" => $branch_info->transferred_houseblk,
      "user_id" => $branch_info->user_id,
      "status" => $branch_info->status,
      "evaluator1" => $branch_info->evaluator1,
      "evaluator2" => $branch_info->evaluator2,
      "evaluator3" => $branch_info->evaluator3,
      "evaluator4" => $branch_info->evaluator4,
      "evaluator5" => $branch_info->evaluator5,
      "evaluator_for_closure_1" => $branch_info->evaluator_for_closure_1,
      "evaluator_for_closure_2" => $branch_info->evaluator_for_closure_2,
      "evaluator_for_transfer_1" => $branch_info->evaluator_for_transfer_1,
      "evaluator_for_transfer_2" => $branch_info->evaluator_for_transfer_2,
      "evaluator_for_transfer_3" => $branch_info->evaluator_for_transfer_3,
      "tool_yn_answer" => $branch_info->tool_yn_answer,
      "tool_remark" => $branch_info->tool_remark,
      "tool_findings" => $branch_info->tool_findings,
      "tool_comment" => $branch_info->tool_comment,
      "evaluation_comment" => $branch_info->evaluation_comment,
      "temp_evaluation_comment" => $branch_info->temp_evaluation_comment,
      "comment_by_specialist" => $branch_info->comment_by_specialist,
      "comment_by_senior" => $branch_info->comment_by_senior,
      "evaluated_by" => $branch_info->evaluated_by,
      "comment_by_senior_level1" => $branch_info->comment_by_senior_level1,
      "comment_by_director_level1" => $branch_info->comment_by_director_level1,
      "dateApplied" => $branch_info->dateApplied,
      "date_approved_cds" => $branch_info->date_approved_cds,
      "date_approved_senior" => $branch_info->date_approved_senior,
      "date_approved_director" => $branch_info->date_approved_director,
      "lastUpdated" => $branch_info->lastUpdated,
      "dateRegistered" => $branch_info->dateRegistered,
      "date_of_or" => $branch_info->date_of_or,
      "lapse_time" => $branch_info->lapse_time,
      "sent_lapse_notif" => $branch_info->sent_lapse_notif,
      "qr_code" => $branch_info->qr_code,
      "date_for_payment" => $branch_info->date_for_payment,
      "date_closure" => $branch_info->date_closure,
      "date_transferred" => $branch_info->date_transferred,
      "date_convert" => $branch_info->date_convert,
      "ok_for_closure" => $branch_info->ok_for_closure,
      "ok_for_transfer" => $branch_info->ok_for_transfer,
      "ok_for_conversion" => $branch_info->ok_for_conversion,
    );



    // echo print_r($data);
    $this->db->insert('stored_branch', $branches);

    $this->db->update('branches', array('status'=>54,'date_transferred'=>date("Y-m-d")),array('id'=>$branch_info->id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Certification No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'Certification No. has been successfully generated.');
    }
  }

  public function save_OR_conversion($where, $data, $id, $date_of_or){
    $this->db->trans_begin();
    $this->db->update('branches', array('status'=>67,'ok_for_conversion'=>$date_of_or),array('id'=>$id));
    $this->db->update('payment', $data, $where);


    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }

  }

  public function save_OR_transfer($where, $data, $id, $date_of_or){
    $this->db->trans_begin();
    $this->db->update('branches', array('status'=>53,'ok_for_transfer'=>$date_of_or),array('id'=>$id));
    $this->db->update('payment', $data, $where);


    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Unable to save O.R. No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'O.R. No. has been successfully saved.');
    }

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
  public function get_all_branches_by_specialist_for_conversion_ho($regcode,$admin_id){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = branches.regNo','inner');
    $this->db->where('registeredcoop.type IN ('.$typeofcoopimp.')');
    $this->db->where(array('status'=>59,'evaluator_for_transfer_1'=>$admin_id));
    $this->db->group_by('branches.branchName,branches.id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_specialist_for_conversion($regcode,$admin_id){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = branches.regNo','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>59,'evaluator_for_transfer_1'=>$admin_id));
    $this->db->group_by('branches.branchName,branches.id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_specialist_for_transfer_ho($regcode,$admin_id){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.transferred_region','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = branches.regNo','inner');
    $this->db->where('registeredcoop.type IN ('.$typeofcoopimp.')');
    $this->db->where(array('status'=>45,'evaluator_for_transfer_1'=>$admin_id));
    $this->db->group_by('branches.branchName,branches.id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_specialist_for_transfer($regcode,$admin_id){
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.transferred_region','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = branches.regNo','inner');
    // $this->db->like('refregion.regCode', $regcode);
    $this->db->where(array('status'=>45,'evaluator_for_transfer_1'=>$admin_id));
    $this->db->group_by('branches.branchName,branches.id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
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
  public function get_all_branches_by_senior_for_transfer($regcode){
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
    where branches.addrCode like "'.$regcode2.'%" AND branches.regCode != 0
    and branches.status IN (41,48)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.addrCode like "'.$regcode2.'%" AND branches.regCode != 0
    and branches.status in (41,48)');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior_for_conversion_ho($regcode){
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
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status IN (55,57,58,60,63,64,65,66,67,68) AND registeredcoop.type IN ('.$typeofcoopimp.')
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status in (55,57,58,60,63,64,65,66,67,68) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior_for_conversion($regcode){
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
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status IN (55,57,58,60,63,64,65,66,67,68) GROUP BY branches.branchName,branches.certNo,branches.addrCode
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status in (55,57,58,60,63,64,65,66,67,68) GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior_for_closure_ho($regcode){
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
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status IN (30,33,35,37,38,39,29) AND registeredcoop.type IN ('.$typeofcoopimp.')
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    left join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status in (30,33,35,37,38,39,29) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_senior_for_closure($regcode){
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
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status IN (30,33,35,37,38,39,29) group by branches.branchName
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%" and branches.addrCode like "'.$regcode2.'%"
    and branches.status in (30,33,35,37,38,39,29) group by branches.branchName');
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
    and branches.status in (2,8,9,10,11,12,17,18,19,20,22) AND evaluator2 IS NOT NULL');
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
  public function get_all_branches_by_director_for_conversion_ho($regcode){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (56,61) AND registeredcoop.type IN ('.$typeofcoopimp.') GROUP BY branches.branchName,branches.certNo,branches.addrCode
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (56,61) AND registeredcoop.type IN ('.$typeofcoopimp.') GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_director_for_conversion($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (56,61) GROUP BY branches.branchName,branches.certNo,branches.addrCode
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (56,61) GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_director_for_closure_ho($regcode){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (5) AND registeredcoop.type IN ('.$typeofcoopimp.')
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (32,34,36) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_director_for_closure($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (5)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.type as rtype, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (32,34,36) GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }

  public function get_all_branches_by_director_for_transfer_within($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.addrCode like "'.$regcode.'%" AND branches.regCode != 0
    and branches.status in (42,45)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "'.$regcode.'%" AND branches.regCode != 0
    and branches.status in (42,45) GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }

  public function get_all_branches_by_director_for_transfer_ho($regcode){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.transferred_region like "'.$regcode.'%"
    and branches.status in (42,45,47) and registeredcoop.type IN ('.$typeofcoopimp.')
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (42,45,47) and registeredcoop.type IN ('.$typeofcoopimp.') GROUP BY branches.branchName,branches.certNo,branches.addrCode');
    $data = $query->result_array();
    return $data;
  }
  public function get_all_branches_by_director_for_transfer($regcode){
    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.transferred_region like "'.$regcode.'%"
    and branches.status in (42,45,47)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (42,45,47) GROUP BY branches.branchName,branches.certNo,branches.addrCode');
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
    $this->db->select('branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.areaOfOperation as aoo,registeredcoop.type as registeredtype,cooperatives.area_of_operation,cooperatives.regions,registeredcoop.regNo,users.first_name,users.last_name,users.email');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop','registeredcoop.regNo=branches.regNo','inner');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
    $this->db->join('users','users.id = branches.user_id');
    $this->db->where(array('branches.user_id'=>$user_id,'branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_branch_to_be_transferred($user_id,$branch_id){
    $this->db->select('branches.transferred_street,branches.transferred_houseblk,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.transferred_region','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('branches.user_id'=>$user_id,'branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }

  public function get_branch_registered_info($regno){
    $this->db->select('*');
    $this->db->from('branches');
    $this->db->where(array('regNo'=>$regno));
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

  public function get_amendment_info($regno){
    $this->db->limit('1');
    $this->db->select('registeredamendment.addrCode');
    $this->db->from('branches');
    $this->db->join('registeredamendment' , 'registeredamendment.regNo = branches.regNo','inner');
    $this->db->where(array('registeredamendment.regNo'=>$regno));
    $this->db->order_by('registeredamendment.id','DESC');
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
  public function get_branch_info_by_admin_transfer($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun,registeredcoop.type as registeredtype,cooperatives.regions,registeredcoop.dateRegistered as rdr');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.transferred_region','inner');
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
  public function get_branch_info_by_admin($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, cooperatives.category_of_cooperative, cooperatives.type_of_cooperative, cooperatives.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun,registeredcoop.type as registeredtype,cooperatives.regions,registeredcoop.dateRegistered as rdr');
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
  public function get_branch_info_transferred_by_admin($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('branches');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.transferred_region','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');

    $this->db->where(array('branches.id'=>$branch_id));
    $query = $this->db->get();
    return $query->row();
  }
  public function get_branch_info_amend_by_admin($branch_id){
    $this->db->select('branches.addrCode,branches.status,branches.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, amend_coop.category_of_cooperative,amend_coop.id as ammend_id, amend_coop.type_of_cooperative, amend_coop.grouping, registeredcoop.application_id,registeredcoop.addrCode as mainAddr, registeredcoop.noStreet, registeredcoop.street as st, x.brgyDesc as brg, y.citymunDesc as municipality, z.provDesc as provins, w.regDesc as regun,registeredcoop.type as registeredtype, branches.id as branch_id');
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
public function transfer_region($branch_id,$region,$houseblk,$street){
  // $specialist_id = $this->security->xss_clean($specialist_id);
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->trans_begin();
  $this->db->where(array('id'=>$branch_id));
  $this->db->update('branches',array('status'=>40,'transferred_region'=>$region,'transferred_street'=>$street,'transferred_houseblk'=>$houseblk));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
      $this->db->trans_commit();
      return true;
  }
}
public function assign_to_specialist_for_transfer($branch_id,$specialist_id,$coop_full_name){
  $specialist_id = $this->security->xss_clean($specialist_id);
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->trans_begin();
  $query = $this->db->get_where('admin',array('id'=>$specialist_id));
  $admin_info = $query->row();
  $this->db->where(array('id'=>$branch_id));
  $this->db->update('branches',array('status'=>45,'evaluator_for_transfer_1'=>$specialist_id));
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
public function assign_to_specialist_for_conversion($branch_id,$specialist_id,$coop_full_name){
  $specialist_id = $this->security->xss_clean($specialist_id);
  $branch_id = $this->security->xss_clean($branch_id);
  $this->db->trans_begin();
  $query = $this->db->get_where('admin',array('id'=>$specialist_id));
  $admin_info = $query->row();
  $this->db->where(array('id'=>$branch_id));
  $this->db->update('branches',array('status'=>59,'evaluator_for_transfer_1'=>$specialist_id));
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

public function approve_by_admin2_for_closure($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name){
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
    $this->db->update('branches',array('evaluator_for_closure_1'=>$admin_info->id,'status'=>32,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior'=>$comment_by_specialist_senior,'date_approved_senior'=>$now));
  else if($step==6)
    $this->db->update('branches',array('evaluator2'=>$admin_info->id,'status'=>8,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>NULL,'date_approved_director'=>$now,'temp_evaluation_comment'=>NULL, 'comment_by_director_level1'=>$comment_by_specialist_senior));
  else if($step==7)
    $this->db->update('branches',array('evaluator1'=>$admin_info->id,'status'=>23,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'comment_by_senior_level1'=>$comment_by_specialist_senior,'date_approved_director'=>$now));
  else if($step==8)
    $this->db->update('branches',array('status'=>34,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==9)
    $this->db->update('branches',array('status'=>36,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==10)
    $this->db->update('branches',array('evaluator_for_closure_2'=>$admin_info->id,'status'=>37,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('branches',array('status'=>33,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'lapse_time'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'date_approved_senior'=>$now));
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
    }elseif ($step==8){
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
    }elseif ($step==9){
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
    }elseif ($step==10){
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

public function all_bns_lapses(){
  $now_lapse = date('Y-m-d', strtotime("-3 months"));
  $this->db->select('branches.type,users.email,branches.id,branches.status');
  $this->db->from('branches');
  $this->db->join('users' , 'users.id = branches.user_id','inner');
  $this->db->where('branches.lapse_time LIKE "%'.$now_lapse.'%" AND sent_lapse_notif = 0');
  $query = $this->db->get();
  $client_info = $query->result_array();

  if($query->num_rows() != 0){
    foreach($client_info as $ci){
      // return $ci['type'].'asdasd';
        if($this->sendEmailToClientLapseTransfer($ci['type'],$ci['email'])){
          $this->db->trans_begin();
          $this->db->where('id',$ci['id'],'status',43);
          $this->db->update('branches',array('sent_lapse_notif'=>1,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
          $this->db->trans_commit();
          return true;
        }
    }
  } else {
    return false;
  }
}

public function all_bns_lapses_conversion(){
  $now_lapse = date('Y-m-d', strtotime("-1 months"));
  $this->db->select('branches.type,users.email,branches.id,branches.status');
  $this->db->from('branches');
  $this->db->join('users' , 'users.id = branches.user_id','inner');
  $this->db->where('branches.lapse_time LIKE "%'.$now_lapse.'%" AND sent_lapse_notif = 0 AND status = 57');
  $query = $this->db->get();
  $client_info = $query->result_array();

  if($query->num_rows() != 0){
    foreach($client_info as $ci){
        if($this->sendEmailToClientLapseConversion($ci['type'],$ci['email'])){
          $this->db->trans_begin();
          $this->db->where('id',$ci['id'],'status',57);
          $this->db->update('branches',array('sent_lapse_notif'=>1,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
          $this->db->trans_commit();
          return true;
        }

    }
  } else {
    return false;
  }
}

public function sendEmailToClientLapseTransfer($type,$email){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Good day! With regards to your application for transfer of ".$type.", you may now upload the following requirements:<br><br>

a. a copy of the Notice of Transfer<br>
b. a certification by the General Manager/Chairman that the notice was posted, and<br>
c. the original Certificate/Letter of Authority<br>";
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

public function sendEmailToClientLapseConversion($type,$email){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Good day! With regards to your application for conversion of ".$type.", you may now upload the following requirements:<br><br>

a. a copy of the Notice of Transfer<br>
b. a certification by the General Manager/Chairman that the notice was posted, and<br>
c. the original Certificate/Letter of Authority<br>";
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

public function approve_by_admin2_for_transfer($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $now = date('Y-m-d H:i:s');
  // echo '<script>alert('.$coop_full_name.');</script>';
  if($step==10)
    $this->db->update('branches',array('evaluator_for_transfer_1'=>$admin_info->id,'status'=>42,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==11)
    $this->db->update('branches',array('evaluator_for_transfer_2'=>$admin_info->id,'status'=>43,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'lapse_time'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==12)
    $this->db->update('branches',array('status'=>46,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==13)
    $this->db->update('branches',array('evaluator_for_transfer_3'=>$admin_info->id,'status'=>48,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'date_approved_director'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==14)
    $this->db->update('branches',array('status'=>47,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  // echo $this->db->last_query();
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($step==10){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else if($step==11){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else if($step==12 || $step==13 || $step==14){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
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

public function approve_by_admin2_for_conversion($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $now = date('Y-m-d H:i:s');
  // echo '<script>alert('.$coop_full_name.');</script>';
  if($step==1)
    $this->db->update('branches',array('evaluator_for_closure_1'=>$admin_info->id,'status'=>56,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==2)
    $this->db->update('branches',array('evaluator_for_closure_1'=>$admin_info->id,'status'=>57,'lapse_time'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==3)
    $this->db->update('branches',array('status'=>60,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==4)
    $this->db->update('branches',array('evaluator_for_transfer_2'=>$admin_info->id,'status'=>61,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else if($step==5)
    $this->db->update('branches',array('evaluator_for_transfer_3'=>$admin_info->id,'status'=>63,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'date_approved_director'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  // echo $this->db->last_query();
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if($step==1){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else if($step==2){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else if($step==3 || $step==4 || $step==5){
      // $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
      // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
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

public function deny_by_admin_for_transfer($admin_info,$branch_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('branches',array('evaluator_for_transfer_3'=>$admin_info->id,'status'=>50,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
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
    if ($step==1){
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

public function deny_by_admin_for_conversion($admin_info,$branch_id,$reason_commment,$step){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  if ($step==1)
    $this->db->update('branches',array('evaluator_for_transfer_3'=>$admin_info->id,'status'=>62,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment));
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
    if ($step==1){
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
  elseif($step==7)
    $this->db->update('branches',array('status'=>38,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  elseif($step==8)
    $this->db->update('branches',array('status'=>49,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  elseif($step==10)
    $this->db->update('branches',array('evaluator_for_transfer_3'=>$admin_info->id,'status'=>64,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  else
    $this->db->update('branches',array('evaluator5'=>$admin_info->id,'status'=>17,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila'))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));

  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==5 || $step==6 || $step==7 || $step==8 || $step==10){
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
public function check_evaluator_for_closure($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status<=34){
    return true;
  }else{
    return false;
  }
}
public function check_evaluator_for_closure2($branch_id){
  $query = $this->db->get_where('branches',array('id'=>$branch_id));
  $data = $query->row();
  $coop_status = $data->status;
  if($coop_status<=31 || $coop_status==34 || $coop_status!=38){
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
  $this->db->where('regNo ="'.$regNo.'" AND amendment_no IS NOT NULL');
  $this->db->from('registeredamendment');
  if($this->db->count_all_results() == 0){
    return false;
  }else{
    return true;
  }
}

public function check_if_amended_branch_migrate($regNo){
  $this->db->where('regNo = "'.$regNo.'" AND LENGTH(addrCode) = 9');
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
  public function get_registered_branches_ho($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (21,81) AND registeredcoop.type IN ('.$typeofcoopimp.')
    GROUP BY branches.regNo
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (21,81) AND registeredcoop.type IN ('.$typeofcoopimp.') GROUP BY branches.regNo');
    $data = $query->result_array();
    return $data;
  }
  public function get_registered_branches($regcode){
    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where x.regCode like "'.$regcode.'%"
    and branches.status in (21,81)
    GROUP BY branches.regNo
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (21,81) GROUP BY branches.regNo');
    $data = $query->result_array();
    return $data;
  }
  public function outside_the_region_closure($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (32)
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (32)');
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
  public function transferred_region_senior_ho($regcode){
    $this->db->select('name');
    $this->db->from('head_office_coop_type_branch');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';

    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.transferred_region like "'.$regcode.'%"
    and branches.status in (41,43,44,45,46,48,49,51,52,53,54) AND registeredcoop.type IN ('.$typeofcoopimp.')
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (41,43,44,45,46,48,49,51,52,53,54) AND registeredcoop.type IN ('.$typeofcoopimp.')');
    $data = $query->result_array();
    return $data;
  }
  public function transferred_region_senior($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where branches.transferred_region like "'.$regcode.'%"
    and branches.status in (41,43,44,45,46,48,49,51,52,53,54)
    group by branches.branchName
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, refcitymun.citymunCode as cCode,registeredcoop.type as rtype from branches
  inner join refbrgy on refbrgy.brgyCode = branches.transferred_region
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    where refregion.regCode like "'.$regcode.'%"
    and branches.status in (41,43,44,45,46,48,49,51,52,53,54) group by branches.branchName');
    $data = $query->result_array();
    return $data;
  }
  public function outside_the_region_senior_closure($regcode){
    $query = $this->db->query('select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refcitymun.citymunCode as cCode, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    inner join registeredcoop on branches.regNo = registeredcoop.regNo
    inner join refbrgy as x on x.brgyCode = registeredcoop.addrCode
    where branches.regCode like "%'.$regcode.'"
    and branches.status >= 30 AND branches.status <=39
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refcitymun.citymunCode as cCode, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.regCode like "%'.$regcode.'"
    and branches.status >= 30 AND branches.status<=39');
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
    and branches.status in (24,17) AND evaluator5 IS NULL
UNION
select branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refcitymun.citymunCode as cCode, refregion.regDesc as region from branches
  inner join refbrgy on refbrgy.brgyCode = branches.addrCode
    inner join refcitymun on refcitymun.citymunCode = refbrgy.citymunCode
    inner join refprovince on refprovince.provCode = refcitymun.provCode
    inner join refregion on refregion.regCode = refprovince.regCode
    where branches.regCode like "'.$regcode.'%"
    and branches.status in (24,17) AND evaluator5 IS NULL');
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

  public function update_not_branch_reason($user_id,$coop_id,$field_data){
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

  public function update_not_expired_branches_migrated($coop_id,$field_data){
    $data = $this->security->xss_clean($field_data);

    $this->db->trans_begin();
    $this->db->where(array('id'=>$coop_id));
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

  public function insert_closure_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('closure_comment',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function insert_conversion_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('conversion_comment',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function insert_transfer_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('transfer_comment',$data_field);
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
  public function branches_closure_comments_client($coop_id){
    $this->db->select('*');
    $this->db->from('closure_comment');
    $this->db->where('branches_id = '.$coop_id.' AND comment !="" AND user_level = 3 OR user_level = 4');
    $this->db->order_by('id','desc');
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
  public function branches_comments_closure_defer($coop_id){
    $this->db->select('*');
    $this->db->from('closure_comment');
    $this->db->where('branches_id ='.$coop_id.' AND user_level = 3 AND comment !=""');
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
  public function branches_comments_cds_transfer($coop_id){
    $this->db->select('*');
    $this->db->from('transfer_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_cds_conversion($coop_id){
    $this->db->select('*');
    $this->db->from('conversion_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_conversion_comments_snr($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('conversion_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_transfer_comments_snr($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('transfer_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
    $this->db->order_by('id','desc');
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
  public function branches_comments_snr_transfer_limit($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('transfer_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
    $this->db->order_by('id','desc');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function branches_comments_snr_conversion_limit($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('conversion_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
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

  public function branches_comments_snr_closure($coop_id,$user_id){
    $this->db->select('*');
    $this->db->from('closure_comment');
    $this->db->where(array('branches_id'=>$coop_id,'user_level'=>2));
    $this->db->order_by('id','desc');
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

  public function sendEmailToSeniorBranchTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
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
      $message = "Good day! A letter of Intent for transfer of ".$type." with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coop_region."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToSeniorBranchTransferForEva($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
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
      $message = "Good day! An application for transfer of  ".$type." with the following details has been submitted for your evaluation: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coop_region."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToSeniorBranchClosureForEva($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
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
      $message = "Good day! An application for closure of ".$type." with the following details has been submitted for your evaluation: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coop_region."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToClientApproveBranchConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      $message="Good day!  A letter of Intent for conversion of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$regionname."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$email."</li>
      </ol>";


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

  public function sendEmailToClientReceivedBranchTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      $message="Good day!  A letter of Intent for transfer of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$regionname."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$email."</li>
      </ol>";


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

  public function sendEmailToSeniorBranchConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
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
      $message = "Good day!  An application for conversion of ".$type." with the following details has been submitted for your evaluation: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coop_region."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToSeniorBranchClosure($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coop_region){
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
      $message = "Good day!  A letter of Intent for closure of ".$type." with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coop_region."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToClientBranchConversion($email,$type,$proposedbranch,$brgyforemail){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "The Letter of Intent for conversion of ".$type." with the following details has been successfully submitted:<br><br>

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

  public function sendEmailToClientBranchTransfer($email,$type,$proposedbranch,$brgyforemail){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "The Letter of Intent for transfer of ".$type." with the following details has been successfully submitted:<br><br>

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

  public function sendEmailToClientBranchClosure($email,$type,$proposedbranch,$brgyforemail){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "The Letter of Intent for closure of ".$type." with the following details has been successfully submitted:<br><br>

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

  public function sendEmailToSpecialistTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "You are assigned to validate the application for transfer of ".$type." with the following details: <p>

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

  public function sendEmailToSpecialistConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "You are assigned to validate the application for conversion of ".$type." with the following details: <p>

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

  public function sendEmailToSeniorFromCDSBranchTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coopregion){
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
      $message = "A validated application for transfer of ".$type." with the following details has been submitted for your evaluation:<p>

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

  public function sendEmailToSeniorFromCDSBranchConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamesupervising,$coopregion){
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
      $message = "A validated application for conversion of ".$type." with the following details has been submitted for your evaluation:<p>

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

  public function sendEmailToDirectorClosure9($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Senior CDS evaluated application for closure of ".$type." with the following details has been submitted for your evaluation and approval/denial/defermen <p>

    <ol type='a'>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Region of Cooperative:</b>".$coopregion."</li>
      <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToDirectorClosure($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
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
      $message = "Good day!  A letter of Intent for closure of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coopregion."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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
    } else {
      return true;
    }
  }

  public function sendEmailToDirectorTransferForApproval($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$type,$fullnamecds,$coopregion){
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
      $message = "Senior CDS evaluated application for transfer of ".$type." with the following details has been submitted for your evaluation and approval/denial/deferment:  <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$coopregion."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
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
        // echo $this->email->print_debugger();
      }else{
          return false;
      }
    } else {
      return true;
    }
  }

  public function sendEmailToDirectorTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
    // echo print_r($senioremail);
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
        $message = "Good day!  A letter of Intent for transfer of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

        <ol type='a'>
          <b><li> Name of Cooperative:</b>".$proposedname."</li>
          <b><li> Region of Cooperative:</b>".$coopregion."</li>
          <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
          <b><li> Address of ".$type.":</b>".$brgy."</li>
          <b><li> Contact Person:</b> ".$fullname."</li>
          <b><li> Contact Number: </b>".$contactnumber."</li>
          <b><li> Email Address: </b>".$email."</li>
        </ol>";
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()){
            return true;
          // echo $this->email->print_debugger();
        }else{
            return false;
        }
    } else {
      return true;
    }
  }

  public function sendEmailToDirectorConversionForEva($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Senior CDS evaluated application for conversion of ".$type." with the following details has been submitted for your evaluation and approval/denial/deferment: <p>

    <ol type='a'>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Region of Cooperative:</b>".$coopregion."</li>
      <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToDirectorConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds,$coopregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Good day!  A letter of Intent for conversion of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

    <ol type='a'>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Region of Cooperative:</b>".$coopregion."</li>
      <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of ".$type.":</b>".$brgy."</li>
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

  public function sendEmailToClientDeferBranchTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$comment,$region_code,$reg_officials_info,$rdregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "".date('F d, Y')." <br><br>

  Proposed Name of ".$type.": ".$proposedbranch." <br>
  Proposed Address of ".$type." : ".$brgy."<br><br>

  Good Day! <br><br>

  This refers to the application for transfer of ".$type." of the proposed ".$proposedname.".<br><br>

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

  public function sendEmailToClientDeferBranchConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$comment,$region_code,$reg_officials_info,$rdregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "".date('F d, Y')." <br><br>

  Name of Cooperative: ".$proposedname." <br>
  ".$type." Address of Cooperative: ".$brgy."<br><br>

  Good Day! <br><br>

  This refers to the application for conversion of ".$type." office of the proposed ".$proposedname.".<br><br>

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
  public function sendEmailToClientDeferBranchClosure($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$comment,$region_code,$reg_officials_info,$rdregion){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "".date('F d, Y')." <br><br>

  Name of Cooperative: ".$proposedname." <br>
  ".$type." Address of Cooperative: ".$brgy."<br><br>

  Good Day! <br><br>

  This refers to the application for closure of ".$type." office of the proposed ".$proposedbranch.".<br><br>

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

  public function sendEmailToClientDenyTransfer($coop_full_name,$brgyforemail,$reason_commment,$email,$type,$rdregion){
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

    This refers to the application for transfer of ".$type." of the proposed ".$coop_full_name.".<br><br>

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

  public function sendEmailToClientDenyConversion($coop_full_name,$brgyforemail,$reason_commment,$email,$type,$rdregion){
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

    This refers to the application for conversion of ".$type." of the proposed ".$coop_full_name.".<br><br>

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

  public function sendEmailToClientReceivedBranchClosure($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

   $message = "Good day!  A letter of Intent for closure of ".$type." evaluated by Sr. CDS with the following details has been submitted: <p>

      <ol type='a'>
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Region of Cooperative:</b>".$regionname."</li>
        <b><li> Name of ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$email."</li>
      </ol>";


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

  public function sendEmailToSeniorBranchApproveConversion($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

   $message = "Name of Cooperative: ".$proposedname."<br>
   Name of ".$type.": ".$proposedbranch."<br>
".$type." Office Address: ".$brgy."  <br><br>

Good day! <br><br>

Your application for conversion of the Branch/Satellite Office is APPROVED. <br><br>

You may now print and submit the following requirements : <br><br>

a. a copy of the Notice of transfer <br>
b. a certification by the General Manager/Chairman that the notice was posted, and <br>
c. the original Certificate/Letter of Authority <br><br>

Submit the above-required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
System (E-CoopRIS)";

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

  public function sendEmailToClientForClosureApprove($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

   $message = "Name of Cooperative: ".$proposedname."<br>
   Name of Cooperative ".$type.": ".$proposedbranch."<br>
".$type." Office Address: ".$brgy."  <br><br>

Good day! <br><br>

Your application for closure of the Branch/Satellite Office is APPROVED. <br><br>

You may now print and submit the following requirements : <br><br>

a. a copy of the Notice of Closure <br>
b. a certification by the General Manager/Chairman that the notice was posted, and <br>
c. the original Certificate/Letter of Authority <br><br>

Submit the above-required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
System (E-CoopRIS)";

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

  public function sendEmailToClientForUploading($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

   $message = "Good day! With regards to your application for closure of branch/satellite, you may now upload the following requirements:<br><br>

              a. a copy of the Notice of Closure<br>
              b. a certification by the General Manager/Chairman that the notice was posted, and<br>
              c. the original Certificate/Letter of Authority";

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

  public function sendEmailToClientApproveBranchTransfer($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$proposedname.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";
      $message="<pre>Proposed Name of Satellite: ".$proposedbranch."
          Proposed Satellite Office Address of Cooperative: ".$brgy."

          Good day!

          Your application for transfer of the Branch/Satellite Office is APPROVED.

          You may now print and submit the following requirements :

          a. a copy of the Notice of transfer
          b. a certification by the General Manager/Chairman that the notice was posted, and
          c. the original Certificate/Letter of Authority

          Submit the above-required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
          System (E-CoopRIS).";

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

  public function branch_closure($branch_id,$rCode,$branchsatellite,$coopName,$branchName,$subaddcode){
    $this->db->trans_begin();

    $this->db->update('branches', array('status'=>29,'date_closure'=>date('Y-m-d',now('Asia/Manila'))),array('id'=>$branch_id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Certification No.');
    }else{
      $this->db->trans_commit();
      $encoded_id = encrypt_custom($this->encryption->encrypt($branch_id));
      redirect('branches/'.$encoded_id.'/order_of_closure');
    }
  }

  public function get_director($id){

      // $query = $this->db->query('select * from admin where access_level=3 and region_code=(select region_code from admin where id ='.$id.')');

    $query = $this->db->get_where('admin',array('id'=>$id,'active'=>1));
      return $query->row();

  }
}
