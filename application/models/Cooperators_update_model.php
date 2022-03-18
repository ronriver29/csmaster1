<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperators_update_model extends CI_Model{
public $last_query = "";
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
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
  public function is_name_unique_laboratories($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('full_name', $ajax['fieldValue']);
    $this->db->from('laboratories_cooperators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }

   //modify by json 
    public function get_cooperative_info($user_id,$coop_id){
    $this->db->select('cooperatives.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.users_id'=>$user_id,'cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }
  //end modify
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
  
  public function edit_is_name_unique_laboratories($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $cooperator_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatorID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('id !=',$cooperator_id);
    $this->db->where('full_name', $ajax['fieldValue']);
    $this->db->from('laboratories_cooperators');
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
  
  public function edit_is_position_available_laboratories($ajax){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));
    $cooperator_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatorID']));
    $this->db->where('cooperatives_id',$decoded_id);
    $this->db->where('id !=',$cooperator_id);
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

  public function check_name_not_exist($cooperatives_id, $name){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('full_name', $name);
    $this->db->from('cooperators');
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
      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'],$data['full_name'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          if($this->check_directors_not_max($data['cooperatives_id'])){
            $this->db->trans_begin();
            $this->db->insert('cooperators',$data);
            $query = $this->db->select('id')
        ->from('cooperators')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_cooperator_id'] = $row['id'];
        $this->db->insert('amendment_cooperators',$data);
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
        return array('success'=>false,'message'=>'Only one Chairperson is allowed');
      }
    }else if(strcmp($data['position'], 'Vice-Chairperson')===0){
      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'],$data['full_name'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          if($this->check_directors_not_max($data['cooperatives_id'])){
            $this->db->trans_begin();
            $this->db->insert('cooperators',$data);
            $query = $this->db->select('id')
        ->from('cooperators')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_cooperator_id'] = $row['id'];
        $this->db->insert('amendment_cooperators',$data);
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
        return array('success'=>false,'message'=>'Only one Vice-Chairperson is allowed');
      }
    }else if(strcmp($data['position'],'Board of Director')===0){
      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
        if($this->check_directors_not_max($data['cooperatives_id'])){
          $this->db->trans_begin();
          $this->db->insert('cooperators',$data);
          $query = $this->db->select('id')
        ->from('cooperators')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_cooperator_id'] = $row['id'];
        $this->db->insert('amendment_cooperators',$data);
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
        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'],$data['full_name'])){
          $this->db->trans_begin();
          $this->db->insert('cooperators',$data);
          $query = $this->db->select('id')
        ->from('cooperators')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_cooperator_id'] = $row['id'];
        $this->db->insert('amendment_cooperators',$data);
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
        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'],$data['full_name'])){
            $this->db->trans_begin();
            $this->db->insert('cooperators',$data);
            $query = $this->db->select('id')
            ->from('cooperators')
            ->order_by('id','DESC')
            ->limit(1)
            ->get();
            if ($query->num_rows() > 0)
            {           
                $row = $query->row_array();
            }
            $data['orig_cooperator_id'] = $row['id'];
            $this->db->insert('amendment_cooperators',$data);
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
        $this->db->insert('cooperators',$data);
        $query = $this->db->select('id')
        ->from('cooperators')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_cooperator_id'] = $row['id'];
        $this->db->insert('amendment_cooperators',$data);
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

  public function edit_cooperator($cooperator_id,$cooperator_info){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $cooperator_info = $this->security->xss_clean($cooperator_info);
    $query = $this->db->get_where('cooperators',array('id'=>$cooperator_id));
    
    $data = $query->row();
 
    if(strcmp($data->position, $cooperator_info['position'])===0 && strcmp($data->full_name, $cooperator_info['full_name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $cooperator_id);
      $this->db->update('cooperators',$cooperator_info);
      $this->db->where('orig_cooperator_id', $cooperator_id);
      // $this->db->update('amendment_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name']) <= 1){
            // if($this->check_directors_not_max_edit($data->cooperatives_id <= 1)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('cooperators',$cooperator_info);
              $this->db->where('orig_cooperator_id', $cooperator_id);
              // $this->db->update('amendment_cooperators',$cooperator_info);
              if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('success'=>false,'message'=>'Unable to update cooperator');
              }else{
                $this->db->trans_commit();
                return array('success'=>true,'message'=>'Cooperator has been successfully updated');
              }
            // }else{
            //   return array('success'=>false,'message'=>'Maximum of 15 directors');
            // }
          }else{
            return array('success'=>false,'message'=>'Only one Chairperson is allowed');
          }
        }else if(strcmp($cooperator_info['position'], 'Vice-Chairperson')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name']) <= 1){
            // if($this->check_directors_not_max_edit($data->cooperatives_id <= 1)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('cooperators',$cooperator_info);
              $this->db->where('orig_cooperator_id', $cooperator_id);
              // $this->db->update('amendment_cooperators',$cooperator_info);
              if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('success'=>false,'message'=>'Unable to update cooperator');
              }else{
                $this->db->trans_commit();
                return array('success'=>true,'message'=>'Cooperator has been successfully updated');
              }
            // }else{
            //   return array('success'=>false,'message'=>'Maximum of 15 directors');
            // }
          }else{
            return array('success'=>false,'message'=>'Only one Vice-Chairperson is allowed');
          }
        }else if(strcmp($cooperator_info['position'],'Board of Director')===0){
          if($this->check_directors_not_max_edit($data->cooperatives_id) < 1){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            $this->db->where('orig_cooperator_id', $cooperator_id);
            // $this->db->update('amendment_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name']) <= 1){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            $this->db->where('orig_cooperator_id', $cooperator_id);
            // $this->db->update('amendment_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name']) <= 1){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('cooperators',$cooperator_info);
            $this->db->where('orig_cooperator_id', $cooperator_id);
            // $this->db->update('amendment_cooperators',$cooperator_info);
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
          $this->db->where('orig_cooperator_id', $cooperator_id);
          // $this->db->update('amendment_cooperators',$cooperator_info);
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
  
  public function edit_cooperator_laboratories($cooperator_id,$cooperator_info){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $cooperator_info = $this->security->xss_clean($cooperator_info);
    $query = $this->db->get_where('laboratories_cooperators',array('id'=>$cooperator_id));
    
    $data = $query->row();
 
    if(strcmp($data->position, $cooperator_info['position'])===0 && strcmp($data->full_name, $cooperator_info['full_name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $cooperator_id);
      $this->db->update('laboratories_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name'])){
            if($this->check_directors_not_max($data->cooperatives_id)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('laboratories_cooperators',$cooperator_info);
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
            return array('success'=>false,'message'=>'Only one Chairperson is allowed');
          }
        }else if(strcmp($cooperator_info['position'], 'Vice-Chairperson')===0){
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name'])){
            if($this->check_directors_not_max($data->cooperatives_id)){
              $this->db->trans_begin();
              $this->db->where('id', $cooperator_id);
              $this->db->update('laboratories_cooperators',$cooperator_info);
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
            return array('success'=>false,'message'=>'Only one Vice-Chairperson is allowed');
          }
        }else if(strcmp($cooperator_info['position'],'Board of Director')===0){
          if($this->check_directors_not_max($data->cooperatives_id)){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('laboratories_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name'])){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('laboratories_cooperators',$cooperator_info);
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
          if($this->check_position_not_exists($data->cooperatives_id,$cooperator_info['position'],$cooperator_info['full_name'])){
            $this->db->trans_begin();
            $this->db->where('id', $cooperator_id);
            $this->db->update('laboratories_cooperators',$cooperator_info);
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
          $this->db->update('laboratories_cooperators',$cooperator_info);
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
  public function delete_cooperator_assoc($data){
    $this->db->trans_begin();
    $this->db->delete('cooperators',array('cooperatives_id' => $data,'type_of_member' => 'Associate'));
    // $this->db->delete('committees',array('cooperators_id'=>$data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_cooperator($data){
    $this->db->trans_begin();
    $this->db->delete('cooperators',array('id' => $data));
    $this->db->delete('committees',array('cooperators_id'=>$data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_cooperator_laboratories($data){
    $this->db->trans_begin();
    $this->db->delete('laboratories_cooperators',array('id' => $data));
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
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyDesc," ",refcitymun.citymunDesc," ",refprovince.provDesc," ",refregion.regDesc) AS full_address,cooperators.full_name');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('cooperators.id',$cooperator_id);
    $query=$this->db->get();
    return $query->row();
  
  }
  public function get_cooperator_info_laboratories($cooperator_id){
    $cooperator_id = $this->security->xss_clean($cooperator_id);
    $this->db->select('laboratories_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyCode," ",refbrgy.brgyDesc," ",refcitymun.citymunCode," ",refcitymun.citymunDesc," ",refprovince.provCode," ",refprovince.provDesc," ",refregion.regCode," ",refregion.regDesc) AS full_address');
    $this->db->from('laboratories_cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=laboratories_cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('laboratories_cooperators.id',$cooperator_id);
    $query=$this->db->get();
    return $query->row();
  
  }
  public function get_all_cooperator_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('cooperatives_id', $cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperator_of_bods($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('position IN ("Chairperson", "Vice-Chairperson", "Board of Director") AND cooperatives_id =', $cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperator_of_coop_regular($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('type_of_member = "Regular" AND cooperatives_id = '.$cooperatives_id.'');
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperator_of_coop_regular_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amendment_cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('type_of_member = "Regular" AND amendment_id = '.$cooperatives_id.'');
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  
  public function get_all_cooperator_of_coop_board($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('(position = "Board of Director" OR position = "Chairperson" OR position = "Vice-Chairperson" OR position = "Treasurer" OR position = "Secretary" OR (position = "Member" AND type_of_member = "Regular")) AND cooperatives_id = '.$cooperatives_id.'');
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_cooperator_of_coop_regular_count($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('type_of_member = "Regular" AND cooperatives_id ='.$cooperatives_id.'');
    $this->db->from('cooperators');
    return $this->db->count_all_results();
  }
  
  public function get_all_cooperator_of_coop_associate_count($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('type_of_member = "Associate" AND cooperatives_id ='.$cooperatives_id.'');
    $this->db->from('cooperators');
    return $this->db->count_all_results();
  }
  public function get_all_cooperator_of_coop_associate($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('type_of_member = "Associate" AND cooperatives_id = '.$cooperatives_id.'');
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
  public function get_chairperson_of_coop_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $cooperatives_id,'position'=>'Chairperson'));
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
  public function get_vicechairperson_of_coop_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $cooperatives_id,'position'=>'Vice-Chairperson'));
    $data = $query->row();
    return $data;
  }
  public function get_treasurer_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position'=>'Treasurer'));
    $data = $query->row();
    return $data;
  }
  public function get_treasurer_of_coop_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $cooperatives_id,'position'=>'Treasurer'));
    $data = $query->row();
    return $data;
  }
  public function get_all_cooperator_of_coop_for_committee($cooperatives_id,$user_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('*');
    $this->db->from('cooperators');
    $this->db->where('cooperatives_id = '.$cooperatives_id.' AND position != "Chairperson" AND type_of_member != "Associate" AND id NOT IN (SELECT cooperators_id FROM committees WHERE user_id ='.$user_id.')');
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
    $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
    
//    $this->db->order_by('full_name','asc');
//    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'position !=' => 'Chairperson','type_of_member !=' => 'Associate','id NOT IN (SELECT cooperators_id FROM committees WHERE user_id ='.$user_id.')'));
//    $data = $query->result_array();
//    return $data;
  }
  
  public function get_all_cooperator_of_coop_for_committee_federation($cooperatives_id,$user_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $cooperatives_id = join(',',$cooperatives_id);  
    $this->db->select('*');
    $this->db->from('affiliators');
    $this->db->where('user_id ='.$user_id);
    $this->db->order_by('representative','asc');
    $query=$this->db->get();
    $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
    
//    $cooperatives_id = join(',',$cooperatives_id);  
//    $this->db->order_by('full_name','asc');
//    $query = $this->db->get_where('cooperators','cooperatives_id IN ('.$cooperatives_id.') AND position != "Chairperson" AND type_of_member != "Associate"');
//    $data = $query->result_array();
//    return $data;
  }

  public function get_all_cooperator_of_coop_for_committee_union($cooperatives_id,$user_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $cooperatives_id = join(',',$cooperatives_id);  
    $this->db->select('*');
    $this->db->from('unioncoop');
    $this->db->where('user_id ='.$user_id);
    $this->db->order_by('representative','asc');
    $query=$this->db->get();
    $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
    
//    $cooperatives_id = join(',',$cooperatives_id);  
//    $this->db->order_by('full_name','asc');
//    $query = $this->db->get_where('cooperators','cooperatives_id IN ('.$cooperatives_id.') AND position != "Chairperson" AND type_of_member != "Associate"');
//    $data = $query->result_array();
//    return $data;
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
  public function get_total_count_regular($cooperatives_id)
  {
     $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('type_of_member',"Regular");
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

  //laboratory cooperator
  public function is_cooperator_lab_complete($laboratory_id)
  {
    $qry = $this->db->get_where('laboratories_cooperators',array('laboratory_id'=>$laboratory_id));
    return $qry->num_rows();
    // return $count_result;
    if($count_result<15)
    {
      return false;
    }
    else
    {
      return true;
    }
  }
  public function is_requirements_complete($cooperatives_id,$associate_members){
    if($this->check_no_of_directors($cooperatives_id)){
      if($this->check_chairperson($cooperatives_id))
      {
        if($this->check_vicechairperson($cooperatives_id))
        {
          if($this->check_treasurer($cooperatives_id))
          {
            if($this->check_secretary($cooperatives_id))
            {
              if($this->check_directors_odd_number($cooperatives_id))
              {
                if($this->ten_percent($cooperatives_id))
                {
                    if($this->bylaw_update_model->get_bylaw_by_coop_id($cooperatives_id)->kinds_of_members==1){
                      if($this->check_associate_not_exists($cooperatives_id)){
                        if($this->check_all_minimum_regular_subscription($cooperatives_id))
                        {
                          if($this->check_all_minimum_regular_pay($cooperatives_id))
                          {
                               if($this->check_regular_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id))){
                                  return true;
                                }else{
                                  return false;
                                }
                          }
                          else
                          {
                            return false2;
                          }
                        }
                        else
                        {
                          return false;
                        }
                           
                      }else{
                        return false;
                      }
                    }else{
                      if($this->check_all_minimum_regular_subscription($cooperatives_id) && $this->check_all_minimum_regular_pay($cooperatives_id) && $this->check_all_minimum_associate_subscription($cooperatives_id) && $this->check_all_minimum_associate_pay($cooperatives_id) && $this->get_all_cooperator_of_coop_associate_count($cooperatives_id) >= $associate_members){
                        if($this->check_with_associate_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id),$this->get_total_associate($cooperatives_id))){
                          return true;
                        }else{
                          return false;
                        }
                      }else{
                        return false;
                      }
                    }
                }
                else
                {
                  return false;
                }
              }
              else
              {
                return false;
              }
            }
            else
            {
              return false;
            }
          }
          else
          {
            return false;
          }
        }
        else
        {
            return $this->db->last_query();
          return false;
        }
      }
      else
      {

        return false;
      }
    }else{
      return false;
    }
  }

  public function check_all_minimum_regular_subscription($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
//    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_subscription;
    if(empty($this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_subscribed_share_regular)){
      $temp = 0;
    } else {
      $temp = $this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_subscribed_share_regular;
    }
    
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
//    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->regular_percentage_shares_pay;
    if(empty($this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_paid_up_share_regular)){
      $temp = 0;
    } else {
      $temp = $this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_paid_up_share_regular;
    }
    // $temp = $this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_paid_up_share_regular;
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
//    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->associate_percentage_shares_pay;
    $temp = $this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_subscribed_share_associate;
    if($temp == NULL){
        $temp = 0;
    }
    $kind_of_members = $this->bylaw_update_model->get_bylaw_by_coop_id($cooperatives_id)->kinds_of_members;
    
    if(isset($kind_of_members)){
      if($kind_of_members==2)  {
          $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Associate'));
          $this->db->where('number_of_subscribed_shares <', $temp);
          $this->db->from('cooperators');
          if($this->db->count_all_results()==0){
            return true;
          }else{
            return false;
          }
      } else {
          return true;
      }
    } else {
      return true;
    }
  }
  public function check_all_minimum_associate_pay($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
//    $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->associate_percentage_shares_pay;
    $temp = $this->capitalization_model->get_capitalization_by_coop_id($cooperatives_id)->minimum_paid_up_share_associate;
    if($temp == NULL){
        $temp = 0;
    }
    $kind_of_members = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id)->kinds_of_members;
    if($kind_of_members==2)  {
        $this->db->where(array('cooperatives_id'=>$cooperatives_id,'type_of_member'=>'Associate'));
        $this->db->where('number_of_paid_up_shares <', $temp);
        $this->db->from('cooperators');
        if($this->db->count_all_results()==0){
          return true;
        }else{
          return false;
        }
    } else {
        return true;
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
  public function get_total_regular_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $cooperatives_id,'type_of_member'=>'Regular'));
    $data = $query->row();
    //    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));
//    $article = $query2->row();
    $query2 = $this->db->get_where('amendment_capitalization',array('amendment_id' => $cooperatives_id));
    $capitalization_info = $query2->row();
    $capitalization_no_of_subscribed = 0;
    $capitalization_no_of_paid = 0;
    
    // Jiee
        $this->db->where(array('amendment_id' => $cooperatives_id));
        $this->db->from('amendment_capitalization');
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
  public function get_total_associate_amend($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $cooperatives_id,'type_of_member'=>'Associate'));
    $data = $query->row();
    $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id' => $cooperatives_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }
  public function get_total_regular($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Regular'));
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
//    if($temp['total_paid'] >= ceil($temp['total_subscribed']*0.25)){
    if($temp['total_subscribed']== $temp['capitalization_no_of_subscribed'] && $temp['total_paid'] == $temp['capitalization_no_of_paid']){
      return true;
    }else{
      return false;
    }
  }
  public function check_with_associate_total_shares_paid_is_correct($data_reg,$data_assoc){
    $temp = $data_reg;
    $temp_assoc = $data_assoc;
//    if(($temp['total_paid'] + $temp_assoc['total_paid']) >= ceil(($temp['total_subscribed'] + $temp_assoc['total_subscribed']) * 0.25)){
    if(($temp['total_subscribed'] + $temp_assoc['total_subscribed'])== $temp['capitalization_no_of_subscribed']&& ($temp['total_paid'] + $temp_assoc['total_paid']) == $temp['capitalization_no_of_paid']){
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
  public function check_position_not_exists($cooperatives_id,$position,$full_name){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('position', $position);
    $this->db->where('full_name != "'.$full_name.'"');
    $this->db->from('cooperators');
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
    if($count<14){
      return true;
    }else{
      return false;
    }
  }
  public function check_directors_not_max_edit($cooperatives_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where_in('position', $position);
    $this->db->from('cooperators');
    $count = $this->db->count_all_results();
    if($count>14){
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
  public function check_cooperator_in_cooperative_laboratories($laboratory_id,$cooperator_id){
    $this->db->where(array('laboratory_id'=>$laboratory_id,'id'=>$cooperator_id));
    $this->db->from('laboratories_cooperators');
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function get_all_cooperator_of_coop_laboratories($laboratory_id){
   $laboratory_id = $this->security->xss_clean($laboratory_id);
    $this->db->select('laboratories_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('laboratories_cooperators');
    $this->db->join('refbrgy','refbrgy.brgycode=laboratories_cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('laboratories_cooperators.laboratory_id', $laboratory_id);
    $this->db->order_by('laboratories_cooperators.created_at','ASC');
    $query=$this->db->get();
    $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }
  public function add_cooperator_laboratories($data){
    $data = $this->security->xss_clean($data);
//    if(strcmp($data['position'], 'Chairperson')===0){
//      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
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
//      }else{
//        return array('success'=>false,'message'=>'Only one Chairpeson is allowed');
//      }
//    }else if(strcmp($data['position'], 'Vice-Chairperson')===0){
//      if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
//        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
//          if($this->check_directors_not_max($data['cooperatives_id'])){
//            $this->db->trans_begin();
//            $this->db->insert('laboratories_cooperators',$data);
//            if($this->db->trans_status() === FALSE){
//              $this->db->trans_rollback();
//              return array('success'=>false,'message'=>'Unable to add cooperator');
//            }else{
//              $this->db->trans_commit();
//              return array('success'=>true,'message'=>'Cooperator has been successfully added');
//            }
//          }else{
//            return array('success'=>false,'message'=>'Maximum of 15 directors');
//          }
//        }else{
//          return array('success'=>false,'message'=>'Name already exist');
//        }
//      }else{
//        return array('success'=>false,'message'=>'Only one Vice-Chairpeson is allowed');
//      }
//    }else if(strcmp($data['position'],'Board of Director')===0){
//      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
//        if($this->check_directors_not_max($data['cooperatives_id'])){
//          $this->db->trans_begin();
//          $this->db->insert('laboratories_cooperators',$data);
//          if($this->db->trans_status() === FALSE){
//            $this->db->trans_rollback();
//            return array('success'=>false,'message'=>'Unable to add cooperator');
//          }else{
//            $this->db->trans_commit();
//            return array('success'=>true,'message'=>'Cooperator has been successfully added');
//          }
//        }else{
//          return array('success'=>false,'message'=>'Maximum of 15 directors');
//        }
//      }else{
//        return array('success'=>false,'message'=>'Name already exist');
//      }
//    }else if(strcmp($data['position'], 'Treasurer')===0){
//      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){    
//        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
//          $this->db->trans_begin();
//          $this->db->insert('laboratories_cooperators',$data);
//          if($this->db->trans_status() === FALSE){
//            $this->db->trans_rollback();
//            return array('success'=>false,'message'=>'Unable to add cooperator');
//          }else{
//            $this->db->trans_commit();
//            return array('success'=>true,'message'=>'Cooperator has been successfully added');
//          }
//        }else{
//          return array('success'=>false,'message'=>'Only one Treasurer is allowed');
//        }
//      }else{
//        return array('success'=>false,'message'=>'Name already exist');
//      }
//    }else if(strcmp($data['position'],'Secretary')===0){
//      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
//        if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
//          $this->db->trans_begin();
//          $this->db->insert('laboratories_cooperators',$data);
//          if($this->db->trans_status() === FALSE){
//            $this->db->trans_rollback();
//            return array('success'=>false,'message'=>'Unable to add cooperator');
//          }else{
//            $this->db->trans_commit();
//            return array('success'=>true,'message'=>'Cooperator has been successfully added');
//          }
//        }else{
//          return array('success'=>false,'message'=>'Only one Secretary is allowed');
//        }
//      }else{
//        return array('success'=>false,'message'=>'Name already exist');
//      }
//    }else{
//      if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
//        $this->db->trans_begin();
//        $this->db->insert('laboratories_cooperators',$data);
//        if($this->db->trans_status() === FALSE){
//          $this->db->trans_rollback();
//          return array('success'=>false,'message'=>'Unable to add cooperator');
//        }else{
//          $this->db->trans_commit();
//          return array('success'=>true,'message'=>'Cooperator has been successfully added');
//        }
//      }else{
//        return array('success'=>false,'message'=>'Name already exist');
//      }
//    }
//  }
  }

  
}
