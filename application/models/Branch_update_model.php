<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_update_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function edit_bns_cert($aid,$data,$regno){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where(array('id'=>$aid,'regNo'=>$regno));
    $this->db->update('branches',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function get_all_updated_branch_info_count_registered($regcode,$coopname){
    // Get Coop Type for HO
    // End Get Coop Type for HO
    // $this->db->limit($limit);
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName as RcoopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('branches.status = 81 AND branches.status != 80 AND branches.status != 21 AND branches.migrated = 1 AND branches.migrated < 25 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    return $this->db->count_all_results();
  }

  public function get_all_updated_branch_info_count($regcode,$coopname){
    // Get Coop Type for HO
    // End Get Coop Type for HO
    // $this->db->limit($limit);
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName as RcoopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('branches.status = 80 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    return $this->db->count_all_results();
  }

  public function get_all_updated_branch_info_count_outside($regcode,$coopname){
    // Get Coop Type for HO
    // End Get Coop Type for HO
    // $this->db->limit($limit);
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName as RcoopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('registeredcoop.addrCode', $regcode);
    $this->db->where('branches.status = 80 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    return $this->db->count_all_results();
  }

  public function get_all_updated_Branch_info2_registered_ho($regcode,$coopname,$limit,$start,$typearray){
    $this->db->limit($limit,$start);
    $this->db->select('branches.*,branches.status as bstatus, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode,users.first_name,users.last_name');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('cooperatives', ' cooperatives.id = registeredcoop.application_id','inner');
    $this->db->join('users', ' users.id = cooperatives.users_id','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('registeredcoop.type IN ("'.$typearray.'")');
    $this->db->where('(branches.status = 81 OR branches.status > 25) AND branches.status != 80 AND branches.status != 21 AND branches.migrated = 1 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_updated_Branch_info2_registered($regcode,$coopname,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('branches.*,branches.status as bstatus, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode,users.first_name,users.last_name');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('cooperatives', ' cooperatives.id = registeredcoop.application_id','inner');
    $this->db->join('users', ' users.id = cooperatives.users_id','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('(branches.status = 81 OR branches.status > 25) AND branches.status != 80 AND branches.status != 21 AND branches.migrated = 1 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_updated_Branch_info_outside($regcode,$coopname,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('SUBSTRING(registeredcoop.addrCode,1,2)', $regcode);
    $this->db->where('branches.status = 80 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_updated_Branch_info2($regcode,$coopname,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('branches.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode,registeredcoop.type as reg_type');
    $this->db->from('branches');
    $this->db->join('registeredcoop', ' branches.regNo = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = branches.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('branches.status = 80 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('branches.regNo,branches.certNo,branches.branchName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function approve_by_admin2($admin_info,$branch_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name){
  $this->db->trans_begin();
  $this->db->where('id',$branch_id);
  $now = date('Y-m-d H:i:s');

  $this->db->update('branches',array('status'=>81,'lastUpdated'=>date('Y-m-d h:i:s',(now('Asia/Manila')))));
  // echo $this->db->last_query();
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    $this->db->trans_commit();
    return true;
  }
}

}