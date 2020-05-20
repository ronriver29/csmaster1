<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_staff_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function cooperative()
  {
    $query =$this->db->get('cooperatives');
      return $query->row();
  }
  public function get_all_staff_of_coop($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->order_by('full_name','asc');
    $query = $this->db->get_where('amendment_staff',array('amendment_id' => $amendment_id));
    $data = $query->result_array();
    return $data;
  }
  public function get_all_staff_of_coop_by_position($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->order_by('position','asc');
    $query = $this->db->get_where('amendment_staff',array('amendment_id' => $amendment_id ,'position !=' => 'Others'));
    $data = $query->result_array();
    return $data;
  }
  public function get_all_staff_of_coop_by_other_position($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('position_others','asc');
    $query = $this->db->get_where('amendment_staff',array('cooperatives_id' => $cooperatives_id ,'position' => 'Others'));
    $data = $query->result_array();
    return $data;
  }
  public function add_staff($data){
    $data = $this->security->xss_clean($data);
    if($data['position']=="Others"){
      if($this->check_others_position_not_exists($data['amendment_id'],$data['position_others'])){
        $this->db->trans_begin();
        $data['position_others'] = ucfirst(strtolower($data['position_others']));
        $this->db->insert('amendment_staff',$data);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to add staff');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Staff has been successfully added');
        }
      }else{
        return array('success'=>false,'message'=>'Only one '.strtolower($data['position_others']).' position is allowedaaaaa');
      }
    }else{
      if(!$this->check_position_not_exists($data['amendment_id'],$data['position'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          $this->db->trans_begin();
          $this->db->insert('amendment_staff',$data);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to add staff');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Staff has been successfully added');
          }
        }else{
          return array('success'=>false,'message'=>'Name already exist');
        }
      }else{
        return array('success'=>false,'message'=>'Only one '.strtolower($data['position']).' position is allowedssss');
      }
    }
  }

  public function check_name_not_exist($coop_id,$name){
    $this->db->where('cooperatives_id',$coop_id);
    $this->db->where('full_name', $name);
    $this->db->from('amendment_staff');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }

  }

  public function edit_staff($staff_id,$staff_info){
    $staff_info = $this->security->xss_clean($staff_info);
    $query = $this->db->get_where('amendment_staff',array('id'=>$staff_id));
    $data = $query->row();
    if($staff_info['position']=="Others"){
      if(strcmp($data->position_others, $staff_info['position_others'])===0){
        $this->db->trans_begin();
        $staff_info['position_others'] = ucfirst(strtolower($staff_info['position_others']));
        $this->db->where('id', $staff_id);
        $this->db->update('amendment_staff',$staff_info);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to update staff');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Staff has been successfully updated');
        }
      }else{
        if(!$this->check_others_position_not_exists($staff_info['amendment_id'],$staff_info['position_others'])){
          
          $this->db->trans_begin();
          $staff_info['position_others'] = ucfirst(strtolower($staff_info['position_others']));
          $this->db->where('id', $staff_id);
          $this->db->update('amendment_staff',$staff_info);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to update staff');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Staff has been successfully updated');
          }
        }else{
          return array('success'=>false,'message'=>'Only one '.strtolower($staff_info['position_others']).' position is allowed');
        }
      }
    }else{
      if(strcmp($data->position, $staff_info['position'])===0){
        $this->db->trans_begin();
        $this->db->where('id', $staff_id);
        $this->db->update('amendment_staff',$staff_info);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to update staff');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Staff has been successfully updated');
        }
      }else{
        if(!$this->check_position_not_exists($staff_info['amendment_id'],$staff_info['position'])){
          $this->db->trans_begin();
          $this->db->where('id', $staff_id);
          $this->db->update('amendment_staff',$staff_info);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to update staff');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Staff has been successfully updated');
          }
        }else{
         
          return array('success'=>false,'message'=>'Only one '.strtolower($staff_info['position']).' position is allowed');
        }
      }
    }
  }
  public function get_staff_info($staff_id){
    $cooperatives_id = $this->security->xss_clean($staff_id);
    $query = $this->db->get_where('amendment_staff',array('id' => $staff_id));
    $data = $query->row();
    return $data;
  }
  public function delete_staff($data){
    $this->db->trans_begin();
    $this->db->delete('amendment_staff',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_position_not_exists($amendment_id,$position){
    // $this->db->where('amendment_id',$amendment_id);
    // $this->db->where('position', $position);
    // $this->db->from('amendment_staff');
    $qry = $this->db->get_where('amendment_staff',array('amendment_id'=>$amendment_id,'position'=>$position));
   if($qry->num_rows()>0)
   {
      return true;
    }else{
      return false;
    }
  }
  public function requirements_complete($amendment_id){
    if($this->check_position_not_exists($amendment_id,"bookkeeper") && $this->check_position_not_exists($amendment_id,"manager") && $this->check_position_not_exists($amendment_id,"cashier/treasurer")){
      return true;
    }else{
      return false;
    }
  }
  public function check_others_position_not_exists($amendment_id, $position_others){
    $this->db->where('amendment_id',$amendment_id);
    $this->db->where('position_others', $position_others);
    $this->db->from('amendment_staff');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_staff_in_cooperative($amendment_id,$staff_id){
    $this->db->where(array('amendment_id'=>$amendment_id,'id'=>$staff_id));
    $this->db->from('amendment_staff');
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }


}
