<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory_update_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function edit_lab_cert($aid,$data,$regno){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where(array('id'=>$aid,'coop_id'=>$regno));
    $this->db->update('laboratories',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function get_all_updated_lab_info_count_registered($regcode,$coopname){
    // Get Coop Type for HO
    // End Get Coop Type for HO
    // $this->db->limit($limit);
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode');
    $this->db->from('laboratories');
    $this->db->join('registeredcoop', ' laboratories.coop_id = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('laboratories.status = 31 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    return $this->db->count_all_results();
  }

  public function get_all_updated_lab_info_count($regcode,$coopname){
    // Get Coop Type for HO
    // End Get Coop Type for HO
    // $this->db->limit($limit);
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode');
    $this->db->from('laboratories');
    $this->db->join('registeredcoop', ' laboratories.coop_id = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('laboratories.status = 30 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    return $this->db->count_all_results();
  }

  public function get_all_updated_Lab_info2_registered($regcode,$coopname,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode,users.first_name,users.last_name');
    $this->db->from('laboratories');
    $this->db->join('registeredcoop', ' laboratories.coop_id = registeredcoop.regNo','left');
    $this->db->join('cooperatives', ' cooperatives.id = registeredcoop.application_id','inner');
    $this->db->join('users', ' users.id = cooperatives.users_id','inner');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('laboratories.status = 31 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('laboratories.coop_id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_updated_Lab_info2($regcode,$coopname,$limit,$start){
    $this->db->limit($limit,$start);
    $this->db->select('laboratories.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region, registeredcoop.coopName, refcitymun.citymunCode as cCode');
    $this->db->from('laboratories');
    $this->db->join('registeredcoop', ' laboratories.coop_id = registeredcoop.regNo','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('laboratories.status = 30 AND registeredcoop.coopName LIKE "%'.$coopname.'%"');
    $this->db->group_by('laboratories.coop_id');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

}