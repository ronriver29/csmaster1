<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliators_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
 
  public function get_registered_coop($area_of_operation,$addresscode,$type_of_cooperative){
    if($area_of_operation == 'Barangay'){
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id,cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredcoop.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredcoop.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredcoop.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredcoop.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','right');
        $this->db->where('registeredcoop.type LIKE "'.$type_of_cooperative.'%" AND cooperatives.status = 15 OR registeredcoop.regNo = "9520-01001374"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
    }
    public function add_affiliators($data){
        $this->db->insert('affiliators',$data);
    }
    
    public function existing_affiliators($user_id,$registeredno){
        $this->db->select('*');
        $this->db->from('affiliators');
        $this->db->where('user_id = '.$user_id.' AND regNo ="'.$registeredno.'"');
//        $query = $this->db->get();
        $data = $this->db->count_all_results();
        return $data;
    }
    
    public function get_applied_coop($user_id){
        $this->db->select('affiliators.*, affiliators.id AS aff_id, registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('affiliators');
        $this->db->join('cooperatives', 'affiliators.application_id = cooperatives.id','left');
        $this->db->join('registeredcoop','registeredcoop.regNo = affiliators.regNo','right');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','left');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
        $this->db->where('user_id ='.$user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function get_applied_coop_for_committees($user_id){
        $this->db->select('application_id');
        $this->db->from('affiliators');
        $this->db->where('user_id ='.$user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function delete_affiliators($data){
    $this->db->trans_begin();
    $this->db->delete('affiliators',array('id' => $data));
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }

    }
    
    public function is_requirements_complete($user_id){
    $this->db->where('user_id =',$user_id);
    $this->db->from('affiliators');
    if($this->db->count_all_results()<=4){
      return false;
    }else{
      return true;
    }
  }
  
    public function is_requirements_complete_admin($user_id){
    $this->db->where('affiliators.user_id =',$user_id);
    $this->db->from('affiliators');
    $this->db->join('cooperatives','affiliators.users_id = cooperatives.users_id','inner');
    if($this->db->count_all_results()<=4){
      return false;
    }else{
      return true;
    }
  }
}
