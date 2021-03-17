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
        $this->db->where('registeredcoop.type LIKE "'.$type_of_cooperative.'%" AND cooperatives.status IS NULL OR cooperatives.status = 15');
        $this->db->limit('10');
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
        $this->db->join('registeredcoop','registeredcoop.id = affiliators.registeredcoop_id','right');
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
    
    public function is_requirements_complete($decoded_id,$user_id){
        if($this->check_all_minimum_regular_subscription($decoded_id,$user_id) && $this->check_all_minimum_regular_pay($decoded_id,$user_id) && $this->check_regular_total_shares_paid_is_correct($this->get_total_regular($user_id,$decoded_id))){
            return true;
        }else{
          return false;
        }
    }
    
    public function check_all_minimum_regular_subscription($decoded_id,$user_id){
        $decoded_id = $this->security->xss_clean($decoded_id);
        $user_id = $this->security->xss_clean($user_id);
    //    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_subscription;
        $temp = $this->get_capitalization_by_coop_id($decoded_id)->minimum_subscribed_share_regular;
        $this->db->where(array('user_id'=>$user_id));
        $this->db->where('number_of_subscribed_shares <', $temp);
        $this->db->from('affiliators');
        if($this->db->count_all_results()==0){
          return true;
        }else{
          return false;
        }
    }

    public function check_all_minimum_regular_pay($decoded_id,$user_id){
        $decoded_id = $this->security->xss_clean($decoded_id);
        $user_id = $this->security->xss_clean($user_id);
    //    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_pay;
        $temp = $this->get_capitalization_by_coop_id($decoded_id)->minimum_paid_up_share_regular;
        $this->db->where(array('user_id'=>$user_id));
        $this->db->where('number_of_paid_up_shares <', $temp);
        $this->db->from('affiliators');
        if($this->db->count_all_results()==0){
          return true;
        }else{
          return false;
        }
    }

    public function get_capitalization_by_coop_id($coop_id){
        $data = $this->security->xss_clean($coop_id);
        $query = $this->db->get_where('capitalization',array('cooperatives_id'=>$data));
        return $query->row();
    }

    public function check_regular_total_shares_paid_is_correct($data){
        $temp = $data;
    //    if($temp['total_paid'] >= ceil($temp['total_subscribed']*0.25)){
        if($temp['total_subscribed']== $temp['capitalization_no_of_subscribed'] && $temp['total_paid'] == $temp['capitalization_no_of_paid']){
          return true;
        }else{
          return false;
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

  public function get_all_affiliators_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('affiliators.*');
    $this->db->from('affiliators');
    $this->db->where('user_id', $cooperatives_id);
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }

  public function get_total_regular($user_id,$cooperatives_id){
    $user_id = $this->security->xss_clean($user_id);
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('affiliators',array('user_id' => $user_id));
    $data = $query->row();
    //    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));
//    $article = $query2->row();
    $query2 = $this->db->get_where('capitalization',array('cooperatives_id' => $cooperatives_id));
    $capitalization_info = $query2->row();
    $capitalization_no_of_subscribed = 0;
    $capitalization_no_of_paid = 0;
    
    // Jiee
        $this->db->where(array('cooperatives_id' => $cooperatives_id));
        $this->db->from('capitalization');
        if($this->db->count_all_results()==0){
          $capitalization_no_of_subscribed = 0;
        $capitalization_no_of_paid = 0;
        }else{
          $capitalization_no_of_subscribed = $capitalization_info->total_no_of_subscribed_capital;
        $capitalization_no_of_paid = $capitalization_info->total_no_of_paid_up_capital;
        }
    //
    
    $totalSubscribed = 0;
    $totalPaid = 0;
    
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
//    $totalSubscribed = $data->total_subscribed;
//    $totalPaid = $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid, 'capitalization_no_of_subscribed'=>$capitalization_no_of_subscribed, 'capitalization_no_of_paid'=>$capitalization_no_of_paid);
  }
}
