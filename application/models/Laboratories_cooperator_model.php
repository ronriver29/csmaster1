<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratories_cooperator_model extends CI_Model{
public $last_query = "";
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

//modify by json 
  public function get_cooperative_details($user_id,$coop_id)
  {
    $this->db->select("cooperatives.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region");
    $this->db->from('cooperatives');
     $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.id'=>$coop_id,'cooperatives.users_id'=>$user_id));
     $qry =$this->db->get();
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }
    else
    {
      return "No Cooperative details found.";
    }
  }
//modify by jayson
  public function get_cooperative_info_edit($user_id,$labmember_id){
    // $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    // $this->db->from('laboratories_cooperators');
    // $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    // $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    // $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    // $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    // $this->db->where(array('cooperatives.users_id'=>$user_id,'cooperatives.id'=>$labmember_id));

    $this->db->select('labmember.*, refbrgy.brgyCode as brgy_code,refcitymun.citymunCode as city_code,refprovince.provCode as province_code,refprovince.provDesc as province, refregion.regCode as regional_code');
    $this->db->join('refbrgy','labmember.addrCode = refbrgy.brgyCode','inner'); //brgay code
    $this->db->join('refcitymun','refcitymun.citymunCode = refbrgy.citymunCode'); //citymun code
    $this->db->join('refprovince','refprovince.provCode = refcitymun.provCode');//province code
    $this->db->join('refregion','refregion.regCode= refprovince.regCode');//reginal code
    $this->db->from('laboratories_cooperators as labmember');
    $this->db->where(array('labmember.id'=>$labmember_id));
    $query = $this->db->get();
    return $query->row();
  }
//end mofily by jayson 
  public function is_name_unique($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('full_name', $ajax['fieldValue']);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function is_position_available($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('position', $ajax['fieldValue']);
    $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  
  public function is_position_available_laboratories($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('position', $ajax['fieldValue']);
    $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
    $this->db->from('laboratories_cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function edit_is_name_unique($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $cooperator_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatorID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('id !=',$cooperator_id);
    $this->db->where('full_name', $ajax['fieldValue']);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function edit_is_position_available($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $cooperator_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatorID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('id !=',$cooperator_id);
    $this->db->where('position', $ajax['fieldValue']);
    $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

  public function check_name_not_exist($cooperatives_id, $name){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('full_name', $name);
    $this->db->from('laboratories_cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }

  public function add_cooperator($data){
    $data = $this->security->xss_clean($data);
    if(strcmp($data['position'], 'Chairperson')===0){
      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          if($this->check_directors_not_max($data['cooperatives_id'])){
            $this->db->trans_begin();
            $this->db->insert('laboratories_cooperators',$data);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('success'=>false,'message'=>'Unable to add cooperator');
            }else{
              $this->db->trans_commit();
              return array('success'=>true,'message'=>'Cooperator has been successfully added');
            }
          }else{
            return array('success'=>false,'message'=>'Maximum of 15 directors');
          }
        }else{
          return array('success'=>false,'message'=>'Name already exist');
        }    
      }else{
        return array('success'=>false,'message'=>'Only one Chairpeson is allowed');
      }
    }else if(strcmp($data['position'], 'Vice-Chairperson')===0){
      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          if($this->check_directors_not_max($data['cooperatives_id'])){
            $this->db->trans_begin();
            $this->db->insert('laboratories_cooperators',$data);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('success'=>false,'message'=>'Unable to add cooperator');
            }else{
              $this->db->trans_commit();
              return array('success'=>true,'message'=>'Cooperator has been successfully added');
            }
          }else{
            return array('success'=>false,'message'=>'Maximum of 15 directors');
          }
        }else{
          return array('success'=>false,'message'=>'Name already exist');
        }
      }else{
        return array('success'=>false,'message'=>'Only one Vice-Chairpeson is allowed');
      }
    }else if(strcmp($data['position'],'Board of Director')===0){
      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
        if($this->check_directors_not_max($data['cooperatives_id'])){
          $this->db->trans_begin();
          $this->db->insert('laboratories_cooperators',$data);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to add cooperator');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Cooperator has been successfully added');
          }
        }else{
          return array('success'=>false,'message'=>'Maximum of 15 directors');
        }
      }else{
        return array('success'=>false,'message'=>'Name already exist');
      }
    }else if(strcmp($data['position'], 'Treasurer')===0){
      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){    
        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
          $this->db->trans_begin();
          $this->db->insert('laboratories_cooperators',$data);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to add cooperator');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Cooperator has been successfully added');
          }
        }else{
          return array('success'=>false,'message'=>'Only one Treasurer is allowed');
        }
      }else{
        return array('success'=>false,'message'=>'Name already exist');
      }
    }else if(strcmp($data['position'],'Secretary')===0){
      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
          $this->db->trans_begin();
          $this->db->insert('laboratories_cooperators',$data);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to add cooperator');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Cooperator has been successfully added');
          }
        }else{
          return array('success'=>false,'message'=>'Only one Secretary is allowed');
        }
      }else{
        return array('success'=>false,'message'=>'Name already exist');
      }
    }else{
      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
        $this->db->trans_begin();
        $this->db->insert('laboratories_cooperators',$data);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to add cooperator');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Cooperator has been successfully added');
        }
      }else{
        return array('success'=>false,'message'=>'Name already exist');
      }
    }
  }

  public function checkname_not_id($cooperator_id,$name,$coop_id){
    $this->db->where_not_in('id',array($cooperator_id));
    $this->db->where('full_name', $name);
    $this->db->where('cooperatives_id', $coop_id);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }


public function edit_cooperator_laboratories($cooperator_id,$cooperator_info,$current_name){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $cooperator_info = $this->security->xss_clean($cooperator_info);
    $cooperator_id =$this->encryption->decrypt(decrypt_custom($cooperator_id));
    $cooperator_info['id'] =$this->encryption->decrypt(decrypt_custom($cooperator_info['id']));
    $cooperator_info['cooperatives_id'] =$this->encryption->decrypt(decrypt_custom($cooperator_info['cooperatives_id']));

    $firstName = $cooperator_info['full_name'];
    // return $cooperator_info;
    if($firstName == $current_name)
    {
      $this->db->where('id', $cooperator_id);
      $this->db->update('laboratories_cooperators',$cooperator_info);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return array('success'=>false,'message'=>'Unable to updated Member/Cooperator');
      }else{
        $this->db->trans_commit();
        return array('success'=>true,'message'=>'Member/Cooperator has been successfully updated');
      }
    }

    $check_duplicate_query = $this->db->get_where('laboratories_cooperators',array('full_name'=>$firstName));
    if($check_duplicate_query->num_rows()>0)
    {
      return array('success'=>false,'message'=>'Unable to updated Member/Cooperator name already exist.');
    }
    else
    {
       $this->db->where('id', $cooperator_id);
      $this->db->update('laboratories_cooperators',$cooperator_info);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return array('success'=>false,'message'=>'Unable to updated Member/Cooperator');
      }else{
        $this->db->trans_commit();
        return array('success'=>true,'message'=>'Member/Cooperator has been successfully updated');
      } 
    }
    

  
      // $this->db->where('id', $cooperator_id);
      // $this->db->update('laboratories_cooperators',$cooperator_info);
      // if($this->db->trans_status() === FALSE){
      //   $this->db->trans_rollback();
      //   return array('success'=>false,'message'=>'Unable to updated cooperator');
      // }else{
      //   $this->db->trans_commit();
      //   return array('success'=>true,'message'=>'Cooperator has been successfully updated');
      // }
    

}      
  public function edit_cooperator($cooperator_id,$cooperator_info){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $cooperator_info = $this->security->xss_clean($cooperator_info);
    $query = $this->db->get_where('cooperators',array('id'=>$cooperator_id));
    
    $data = $query->row();
 
    if(strcmp($data->position, $cooperator_info['position'])===0 && strcmp($data->full_name, $cooperator_info['full_name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $cooperator_id);
      $this->db->update('cooperators',$cooperator_info);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return array('success'=>false,'message'=>'Unable to updated cooperator');
      }else{
        $this->db->trans_commit();
        return array('success'=>true,'message'=>'Cooperator has been successfully updated');
      }
    }else{
      if ($this->checkname_not_id($cooperator_id, $cooperator_info['full_name'], $data->cooperatives_id)) {
        if(strcmp($cooperator_info['position'], 'Chairperson')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'])){
            if($this->check_directors_not_max($data->cooperatives_id)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('cooperators',$cooperator_info);
              if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('success'=>false,'message'=>'Unable to update cooperator');
              }else{
                $this->db->trans_commit();
                return array('success'=>true,'message'=>'Cooperator has been successfully updated');
              }
            }else{
              return array('success'=>false,'message'=>'Maximum of 15 directors');
            }
          }else{
            return array('success'=>false,'message'=>'Only one Chairpeson is allowed');
          }
        }else if(strcmp($cooperator_info['position'], 'Vice-Chairperson')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'])){
            if($this->check_directors_not_max($data->cooperatives_id)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('cooperators',$cooperator_info);
              if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('success'=>false,'message'=>'Unable to update cooperator');
              }else{
                $this->db->trans_commit();
                return array('success'=>true,'message'=>'Cooperator has been successfully updated');
              }
            }else{
              return array('success'=>false,'message'=>'Maximum of 15 directors');
            }
          }else{
            return array('success'=>false,'message'=>'Only one Vice-Chairpeson is allowed');
          }
        }else if(strcmp($cooperator_info['position'],'Board of Director')===0){
          if($this->check_directors_not_max($data->cooperatives_id)){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('success'=>false,'message'=>'Unable to update cooperator');
            }else{
              $this->db->trans_commit();
              return array('success'=>true,'message'=>'Cooperator has been successfully updated');
            }
          }else{
            return array('success'=>false,'message'=>'Maximum of 15 directors');
          }
        }else if(strcmp($cooperator_info['position'], 'Treasurer')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'])){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('success'=>false,'message'=>'Unable to update cooperator');
            }else{
              $this->db->trans_commit();
              return array('success'=>true,'message'=>'Cooperator has been successfully updated');
            }
          }else{
            return array('success'=>false,'message'=>'Only one Treasurer is allowed');
          }
        }else if(strcmp($cooperator_info['position'],'Secretary')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'])){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('success'=>false,'message'=>'Unable to update cooperator');
            }else{
              $this->db->trans_commit();
              return array('success'=>true,'message'=>'Cooperator has been successfully updated');
            }
          }else{
            return array('success'=>false,'message'=>'Only one Secretary is allowed');
          }
        }else{
          $this->db->trans_begin();
          $this->db->where('id', $cooperator_id);
          $this->db->update('cooperators',$cooperator_info);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to update cooperator');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Cooperator has been successfully updated');
          }
        }

      }else{
        return array('success'=>false,'message'=>'Name already exist');
      }
    }
  }

  public function delete_cooperator($data){
    $this->db->trans_begin();
    $this->db->delete('cooperators',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function get_all_cooperator(){
    $query = $this->db->get('cooperators');
    $data = $query->result();
    return $data;
  }
  public function get_cooperator_info($cooperator_id){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyCode," ",refbrgy.brgyDesc," ",refcitymun.citymunCode," ",refcitymun.citymunDesc," ",refprovince.provCode," ",refprovince.provDesc," ",refregion.regCode," ",refregion.regDesc) AS full_address');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('cooperators.id',$cooperator_id);
    $query=$this->db->get();
    return $query->row();
  
  }
  public function get_all_cooperator_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('laboratories_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('laboratories_cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=laboratories_cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('laboratories_cooperators.cooperatives_id', $cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
    $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  public function get_chairperson_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position'=>'Chairperson'));
    $data = $query->row();
    return $data;
  }
  public function get_all_board_of_director_only($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position'=>'Board of Director'));
    $data = $query->result_array();
    return  $data;
  }
  public function get_vicechairperson_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position'=>'Vice-Chairperson'));
    $data = $query->row();
    return $data;
  }
  public function get_treasurer_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position'=>'Treasurer'));
    $data = $query->row();
    return $data;
  }
  public function get_all_cooperator_of_coop_for_committee($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position !=' => 'Chairperson'));
    $data = $query->result_array();
    return $data;
  }

  public function no_of_directors($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    return $this->db->count_all_results();
  }
  public function get_total_number_of_cooperators($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->from('cooperators');
    return $this->db->count_all_results();
  }
  public function check_no_of_directors($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    if($this->db->count_all_results()>=5 && $this->db->count_all_results()<=15){
      return true;
    }else{
      return false;
    }
  }
  public function check_chairperson($cooperatives_id){
    $position = array('Chairperson');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==1){
      return true;
    }else{
      return false;
    }
  }
  public function check_vicechairperson($cooperatives_id){
    $position = array('Vice-Chairperson');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==1){
      return true;
    }else{
      return false;
    }
  }
  public function check_treasurer($cooperatives_id){
    $position = array('Treasurer');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==1){
      return true;
    }else{
      return false;
    }
  }
  public function check_secretary($cooperatives_id){
    $position = array('Secretary');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==1){
      return true;
    }else{
      return false;
    }
  }
  public function ten_percent($cooperatives_id){
    $res = $this->db->query('select * from cooperators where cooperatives_id='.$cooperatives_id.' and number_of_subscribed_shares>(select sum(number_of_subscribed_shares)*.1 from cooperators where cooperatives_id='.$cooperatives_id.')');
    if ($res->num_rows()>0)
      return false;
    else
      return true;
  }

  public function is_requirements_complete($cooperatives_id){
    if($this->check_no_of_directors($cooperatives_id) && $this->check_chairperson($cooperatives_id) && $this->check_vicechairperson($cooperatives_id) && $this->check_treasurer($cooperatives_id) && $this->check_secretary($cooperatives_id) && $this->check_directors_odd_number($cooperatives_id) && $this->ten_percent($cooperatives_id)){
      if($this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->kinds_of_members==1){
        if($this->check_associate_not_exists($cooperatives_id) && $this->check_all_minimum_regular_subscription($cooperatives_id) && $this->check_all_minimum_regular_pay($cooperatives_id)){
          if($this->check_regular_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id))){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }else{
        if($this->check_all_minimum_regular_subscription($cooperatives_id) && $this->check_all_minimum_regular_pay($cooperatives_id) && $this->check_all_minimum_associate_subscription($cooperatives_id) && $this->check_all_minimum_associate_pay($cooperatives_id)){
          if($this->check_with_associate_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id),$this->get_total_associate($cooperatives_id))){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  }

  public function check_all_minimum_regular_subscription($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_subscription;
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Regular'));
    $this->db->where('number_of_subscribed_shares <', $temp);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_all_minimum_regular_pay($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_pay;
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Regular'));
    $this->db->where('number_of_paid_up_shares <', $temp);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_all_minimum_associate_subscription($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->associate_percentage_shares_subscription;
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Associate'));
    $this->db->where('number_of_subscribed_shares <', $temp);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_all_minimum_associate_pay($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->associate_percentage_shares_pay;
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Associate'));
    $this->db->where('number_of_paid_up_shares <', $temp);
    $this->db->from('cooperators');
    if($this->db->count_all_results()==0){
      return true;
    }else{
      return false;
    }
  }
  public function get_list_of_directors($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $query = $this->db->get('cooperators');
    $data = $query->result_array();
    return $data;
  }
  public function get_total_regular($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Regular'));
    $data = $query->row();
    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = $data->total_subscribed;
    $totalPaid = $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }
  public function get_total_associate($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Associate'));
    $data = $query->row();
    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }
  public function get_all_regular_cooperator_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Regular'));
    $data = $query->result_array();
    return $data;
  }
  public function get_all_associate_cooperator_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Associate'));
    $data = $query->result_array();
    return $data;
  }
  public function check_regular_total_shares_paid_is_correct($data){
    $temp = $data;
    if($temp['total_paid'] >= ceil($temp['total_subscribed']*0.25)){
      return true;
    }else{
      return false;
    }
  }
  public function check_with_associate_total_shares_paid_is_correct($data_reg,$data_assoc){
    $temp = $data_reg;
    $temp_assoc = $data_assoc;
    if(($temp['total_paid'] + $temp_assoc['total_paid']) >= ceil(($temp['total_subscribed'] + $temp_assoc['total_subscribed']) * 0.25)){
      return true;
    }else{
      return false;
    }
  }
  public function check_associate_not_exists($cooperatives_id){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('type_of_member', "Associate");
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_position_not_exists($cooperatives_id,$position){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('position', $position);
    $this->db->from('laboratories_cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_directors_not_max($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count<15){
      return true;
    }else{
      return false;
    }
  }
  public function check_directors_odd_number($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count%2==1){
      return true;
    }else{
      return false;
    }
  }
  public function check_cooperator_in_cooperative($cooperatives_id,$cooperator_id){
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'id'=>$cooperator_id));
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  
}
