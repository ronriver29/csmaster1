<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unioncoop_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
 
  public function get_registered_fed_coop($area_of_operation,$addresscode,$type_of_cooperative){
    if($area_of_operation == 'Barangay'){
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id,cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%"');
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
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%"');
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
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%"');
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
        $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%"');
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
        $this->db->where('(cooperatives.status = 15)');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
    }

    public function get_registered_interregion($regions){
      // if($area_of_operation == 'Interregional'){
        $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('cooperatives');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','right');
        $this->db->where('(cooperatives.status = 15) AND refregion.regCode IN ('.$regions.')');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        // }
    }
    public function add_unioncoop($data){
        $this->db->insert('unioncoop',$data);
    }
    
    public function existing_unioncoop($user_id,$registeredno){
        $this->db->select('*');
        $this->db->from('unioncoop');
        $this->db->where('user_id = '.$user_id.' AND regNo ="'.$registeredno.'"');
//        $query = $this->db->get();
        $data = $this->db->count_all_results();
        return $data;
    }
    
    public function get_applied_coop($user_id){
        // $this->db->select('unioncoop.*, unioncoop.id AS aff_id, registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        // $this->db->from('unioncoop');
        // $this->db->join('cooperatives', 'unioncoop.application_id = cooperatives.id','left');
        // $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
        // $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        // $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        // $this->db->join('registeredcoop','registeredcoop.regNo = unioncoop.regNo','inner');
        // $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        // $this->db->where('user_id ='.$user_id);
        // $query = $this->db->get();
        // $data = $query->result_array();
        // return $data;
        $this->db->select('unioncoop.*,unioncoop.capital_contribution as cc, unioncoop.id AS aff_id, registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName');
        $this->db->from('unioncoop');
        $this->db->join('cooperatives', 'unioncoop.application_id = cooperatives.id','left');
        $this->db->join('registeredcoop','registeredcoop.id = unioncoop.registeredcoop_id','right');
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
        $this->db->from('unioncoop');
        $this->db->where('user_id ='.$user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function delete_affiliators($data){
    $this->db->trans_begin();
    $this->db->delete('unioncoop',array('id' => $data));
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }

    }
    
    public function is_requirements_complete($user_id){
      // $this->db->where('user_id =',$user_id);
      // $this->db->from('unioncoop');

      if($this->check_no_of_directors($user_id) && $this->check_chairperson($user_id) && $this->check_vicechairperson($user_id) && $this->check_treasurer($user_id) && $this->check_secretary($user_id) && $this->check_directors_odd_number($user_id)){
            if($this->check_total_coop($user_id)){
                return true;
            }else{
              return false;
            }
        } else {
            return false;
        }
      // $this->db->where('user_id =',$user_id);
      // $this->db->from('unioncoop');
      // if($this->db->count_all_results()<=9){
      //   return false;
      // }else{
      //   return true;
      // }
    }
    
    public function check_total_coop($user_id){
        $this->db->where('user_id =',$user_id);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()>=10 && $this->db->count_all_results()<=15){
          return true;
        }else{
          return false;
        }
    }

    public function check_no_of_directors($cooperatives_id){
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()>=5 && $this->db->count_all_results()<=15){
          return true;
        }else{
          return false;
        }
    }

    public function check_directors_odd_number($cooperatives_id){
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        $count = $this->db->count_all_results();
        if($count%2==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_chairperson($cooperatives_id){
        $position = array('Chairperson');
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_vicechairperson($cooperatives_id){
        $position = array('Vice-Chairperson');
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_treasurer($cooperatives_id){
        $position = array('Treasurer');
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_secretary($cooperatives_id){
        $position = array('Secretary');
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->where('user_id',$cooperatives_id);
        $this->db->where_in('position', $position);
        $this->db->from('unioncoop');
        if($this->db->count_all_results()==1){
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

  public function get_all_cooperator_of_coop($cooperatives_id){
        $cooperatives_id = $this->security->xss_clean($cooperatives_id);
        $this->db->select('unioncoop.*');
        $this->db->from('unioncoop');
        $this->db->where('user_id', $cooperatives_id);
        $this->db->order_by('representative','asc');
        $query=$this->db->get();
        $this->last_query = $this->db->last_query();
        $data = $query->result_array();
        return $data;
      }

  public function no_of_directors($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('user_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('unioncoop');
    return $this->db->count_all_results();
  }

  public function get_list_of_directors($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('user_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $query = $this->db->get('unioncoop');
    $data = $query->result_array();
    return $data;
  }

  public function get_treasurer_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('unioncoop',array('user_id' => $cooperatives_id,'position'=>'Treasurer'));
    $data = $query->row();
    return $data;
  }

  public function get_total_cc($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->select('SUM(capital_contribution) as total_cc');
    $query = $this->db->get_where('unioncoop',array('user_id' => $user_id));
    $data = $query->row();
    
    return $data;
  }

  public function get_total_number_of_cooperators($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('user_id',$cooperatives_id);
    $this->db->from('unioncoop');
    return $this->db->count_all_results();
  }

  public function get_total_regular($user_id,$cooperatives_id){
    $user_id = $this->security->xss_clean($user_id);
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->select('SUM(capital_contribution) as total_cc');
    $query = $this->db->get_where('unioncoop',array('user_id' => $user_id));
    $data = $query->row();

    // print_r($data);
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
    $totalcc = 0;
    
    $totalcc = ($data->total_cc==null) ? 0 : $data->total_cc;
    // $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
//    $totalSubscribed = $data->total_subscribed;
//    $totalPaid = $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalcc, 'capitalization_no_of_subscribed'=>$capitalization_no_of_subscribed, 'capitalization_no_of_paid'=>$capitalization_no_of_paid);
  }

  public function get_chairperson_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('unioncoop',array('user_id' => $cooperatives_id,'position'=>'Chairperson'));
    $data = $query->row();
    return $data;
  }

  public function get_vicechairperson_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('unioncoop',array('user_id' => $cooperatives_id,'position'=>'Vice-Chairperson'));
    $data = $query->row();
    return $data;
  }

  public function get_all_board_of_director_only($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('unioncoop',array('user_id' => $cooperatives_id,'position'=>'Board of Director'));
    $data = $query->result_array();
    return  $data;
  }

}
