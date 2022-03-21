<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_update_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function get_all_staff_of_coop($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('full_name','asc');
    $query = $this->db->get_where('staff',array('cooperatives_id' => $cooperatives_id));
    $data = $query->result_array();
    return $data;
  }
  public function get_all_staff_of_coop_by_position($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('position','asc');
    $query = $this->db->get_where('staff',array('cooperatives_id' => $cooperatives_id ,'position !=' => 'Others'));
    $data = $query->result_array();
    return $data;
  }
  public function get_all_staff_of_coop_by_other_position($cooperatives_id){
    $cooperatives_id = $this->security->xss_clean($cooperatives_id);
    $this->db->order_by('position_others','asc');
    $query = $this->db->get_where('staff',array('cooperatives_id' => $cooperatives_id ,'position' => 'Others'));
    $data = $query->result_array();
    return $data;
  }
  public function add_staff($data){
    $data = $this->security->xss_clean($data);
    if($data['position']=="Others"){
      if($this->check_others_position_not_exists($data['cooperatives_id'],$data['position_others'])){
        $this->db->trans_begin();
        $data['position_others'] = ucfirst(strtolower($data['position_others']));
        $this->db->insert('staff',$data);
        $query = $this->db->select('id')
        ->from('staff')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_staff_id'] = $row['id'];
        $this->db->insert('amendment_staff',$data);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to add staff');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Staff has been successfully added');
        }
      }else{
        return array('success'=>false,'message'=>'Only one '.strtolower($data['position_others']).' position is allowedere');
      }
    }else{
      // if($this->check_position_not_exists($data['cooperatives_id'],$data['position'])){
        if($this->check_name_not_exist($data['cooperatives_id'],$data['full_name'])){
          $this->db->trans_begin();
          $this->db->insert('staff',$data);
            $query = $this->db->select('id')
            ->from('staff')
            ->order_by('id','DESC')
            ->limit(1)
            ->get();
            if ($query->num_rows() > 0)
            {           
                $row = $query->row_array();
            }
            $data['orig_staff_id'] = $row['id'];
            $this->db->insert('amendment_staff',$data);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to add staff');
            echo 'b';
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Staff has been successfully added');
            echo 'asdasdasd';
          }
        }else{
          return array('success'=>false,'message'=>'Name already exist');
          echo 'c';
        }
      // }else{
      //     echo 'd';
      //   return array('success'=>false,'message'=>'Only one '.strtolower($data['position']).' position is allowedddddd');
      // }
    }
  }

  public function check_name_not_exist($coop_id,$name){
    $this->db->where('cooperatives_id',$coop_id);
    $this->db->where('full_name', $name);
    $this->db->from('staff');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }

  }

  public function edit_staff($staff_id,$staff_info){
    $staff_info = $this->security->xss_clean($staff_info);
    $query = $this->db->get_where('staff',array('id'=>$staff_id));
    $data = $query->row();

     $this->db->trans_begin();
      $this->db->where('id', $staff_id);
      $this->db->update('staff',$staff_info);
      $this->db->where('orig_staff_id', $staff_id);
      $this->db->update('amendment_staff',$staff_info);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return array('success'=>false,'message'=>'Unable to update staff');
          }else{
            $this->db->trans_commit();
            return array('success'=>true,'message'=>'Staff has been successfully updated');
          }

    // if($staff_info['position']=="Others"){
    //   if(strcmp($data->position_others, $staff_info['position_others'])===0){
    //     $this->db->trans_begin();
    //     $staff_info['position_others'] = ucfirst(strtolower($staff_info['position_others']));
    //     $this->db->where('id', $staff_id);
    //     $this->db->update('staff',$staff_info);
    //     if($this->db->trans_status() === FALSE){
    //       $this->db->trans_rollback();
    //       return array('success'=>false,'message'=>'Unable to update staff');
    //     }else{
    //       $this->db->trans_commit();
    //       return array('success'=>true,'message'=>'Staff has been successfully updatedsss');
    //     }
    //   }else{
    //     if($this->check_others_position_not_exists($staff_info['cooperatives_id'],$staff_info['position_others'])){
    //       $this->db->trans_begin();
    //       $staff_info['position_others'] = ucfirst(strtolower($staff_info['position_others']));
    //       $this->db->where('id', $staff_id);
    //       $this->db->update('staff',$staff_info);
    //       if($this->db->trans_status() === FALSE){
    //         $this->db->trans_rollback();
    //         return array('success'=>false,'message'=>'Unable to update staff');
    //       }else{
    //         $this->db->trans_commit();
    //         return array('success'=>true,'message'=>'Staff has been successfully updatedaaa');
    //       }
    //     }else{
    //       return array('success'=>false,'message'=>'Only one '.strtolower($staff_info['position_others']).' position is allowed');
    //     }
    //   }
    // }else{
    //   if(strcmp($data->position, $staff_info['position'])===0){
    //     $this->db->trans_begin();
    //     $this->db->where('id', $staff_id);
    //     $this->db->update('staff',$staff_info);
    //     if($this->db->trans_status() === FALSE){
    //       $this->db->trans_rollback();
    //       return array('success'=>false,'message'=>'Unable to update staff');
    //     }else{
    //       $this->db->trans_commit();
    //       return array('success'=>true,'message'=>'Staff has been successfully updatedaaada');
    //     }
    //   }else{
    //     if($this->check_position_not_exists($staff_info['cooperatives_id'],$staff_info['position'])){
    //       $this->db->trans_begin();
    //       $this->db->where('id', $staff_id);
    //       $this->db->update('staff',$staff_info);
    //       if($this->db->trans_status() === FALSE){
    //         $this->db->trans_rollback();
    //         return array('success'=>false,'message'=>'Unable to update staff');
    //       }else{
    //         $this->db->trans_commit();
    //         return array('success'=>true,'message'=>'Staff has been successfully updatedhhh');
    //       }
    //     }else{
    //       return array('success'=>false,'message'=>'Only one '.strtolower($staff_info['position']).' position is allowed');
    //     }
    //   }
    // }
  }
  //modify by json
  public function check_position_($input_position,$cooperative_id)
  {
    $checkqry = $this->db->get('staff_position');
    if($checkqry->num_rows()>0)
    {
      foreach($checkqry->result_array()as $row)
      {
        $row['input_position'] = $input_position;
        $row['input_cooperave_id'] = $cooperative_id;
        $row['status']='';
        if($row['cooperative_id'] == $row['input_cooperave_id'] && strcasecmp($row['position_name'],$row['input_position'])==0)
        {
            $row['status']='false';
        }
        $data[] = $row['status'];
      }
        if(in_array('false',$data))
        {
          return true;
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

  public function get_staff_info($staff_id){
    $cooperatives_id = $this->security->xss_clean($staff_id);
    $query = $this->db->get_where('staff',array('id' => $staff_id));
    $data = $query->row();
    return $data;
  }
  public function delete_staff($data){
    $this->db->trans_begin();
    $this->db->delete('staff',array('id' => $data));
    // $this->db->delete('amendment_staff',array('orig_staff_id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_position_not_exists($cooperatives_id,$position){
    // $this->db->where('cooperatives_id',$cooperatives_id);
    // $this->db->where('position', strtolower($position));
    // $this->db->from('staff');
    $positions = strtolower($position);
    $qry = $this->db->query("select LOWER(position) from staff where position='$position' and cooperatives_id='$cooperatives_id'");
    // $count = $this->db->count_all_results();
    if($qry->num_rows()>0){
      return true;
    }else{
      return false;
    }
  }
  public function requirements_complete($cooperatives_id){
   $qry = $this->db->query("select LOWER(position) as position_name from staff where cooperatives_id ='$cooperatives_id  '");
   // return $this->db->last_query()
   if($qry->num_rows()>0)
   {
      foreach($qry->result_array() as $row)
      {
        $position_[]=$row['position_name'];
      }
      if(in_array("manager",$position_) && in_array("bookkeeper",$position_) && in_array("cashier/treasurer",$position_) )
      {
        return true;
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
  //modified
  public function check_others_position_not_exists($cooperatives_id, $position_others){
    $this->db->where('cooperatives_id',$cooperatives_id);
    $this->db->where('position_name', $position_others);
    $this->db->from('staff_position');
    $count = $this->db->count_all_results();
    if($count==0){
      return true;
    }else{
      return false;
    }
  }
  public function check_staff_in_cooperative($cooperatives_id,$staff_id){
    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'id'=>$staff_id));
    $this->db->from('staff');
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }


}
