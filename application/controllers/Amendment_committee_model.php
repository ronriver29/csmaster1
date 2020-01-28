<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_committee_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function add_committee($data){
    $data = $this->security->xss_clean($data);
    $this->db->where($data);
    $this->db->from('amendment_committees');
    $count = $this->db->count_all_results();
    if($count<1){
      $this->db->trans_begin();
      $this->db->insert('amendment_committees',$data);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return array('success'=>false,'message'=>'Unable to add committee');
      }else{
        $this->db->trans_commit();
        return array('success'=>true,'message'=>'Successfully added');
      }
    }else{
      return array('success'=>false,'message'=>'Cooperator already exists in '.$data['name'].' committee');
    }
  }
  public function edit_committee($committee_id,$committee_info){
    $cooperator_id = $this->security->xss_clean($committee_id);
    $cooperator_info = $this->security->xss_clean($committee_info);
    $query = $this->db->get_where('amendment_committees',array('id'=>$committee_id));
    $data = $query->row();
    if(strcmp($data->name, $committee_info['name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $committee_id);
      $this->db->update('amendment_committees',$committee_info);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return array('success'=>false,'message'=>'Unable to updated committee');
      }else{
        $this->db->trans_commit();
        return array('success'=>true,'message'=>'Committee has been successfully updated');
      }
    }else{
      $this->db->where($committee_info);
      $this->db->where(array('cooperators_id'=>$data->cooperators_id));
      $this->db->from('amendment_committees');
      $count = $this->db->count_all_results();
      if($count<1){
        $this->db->trans_begin();
        $this->db->where(array('id'=>$committee_id));
        $this->db->update('amendment_committees',$committee_info);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return array('success'=>false,'message'=>'Unable to update committee');
        }else{
          $this->db->trans_commit();
          return array('success'=>true,'message'=>'Committee has been successfully updated');
        }
      }else{
        return array('success'=>false,'message'=>'Cooperator already exists in '.$committee_info['name'].' committee');
      }
    }
  }

  public function delete_committee($data){
    $this->db->trans_begin();
    $this->db->delete('amendment_committees',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function isExisting($co_id){
    $query = $this->db->get_where('amendment_committees', array('cooperators_id'=>$co_id));
    
    if ($query->num_rows()>0)
      return true;
    else
      return false;
  }  

  public function isExisting2($co_name,$user_id){
    $query = $this->db->get_where('amendment_committees', array('name'=>$co_name,'user_id'=>$user_id));
    
    if ($query->num_rows()>0)
      return true;
    else
      return false;
  }  

  public function get_committee_info($com_id){
    $query = $this->db->get_where('amendment_committees', array('id'=>$com_id));
    $data = $query->row();
    return $data;
  }

  public function get_all_committees_of_coop($coop_id){
    $data = array();
    $this->db->select('committees.id as comid, committees.* ,cooperators.*');
    $this->db->from('committees');
    $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
    $this->db->where('cooperators.cooperatives_id', $coop_id);
    $query = $this->db->get();
    if($query->num_rows()>0) {
        foreach($query->result_array() AS $key =>$row) {
            $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*');
            $this->db->from('amendment_committees');
            $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
            $this->db->where('cooperators.cooperatives_id', $coop_id);
            $this->db->where('amendment_committees.orig_committee_id', $row['id']);
            $query2 = $this->db->get();
            if($query2->num_rows()>0) {
                $row2 = $query2->row_array();
                $data[$key] = $row2; 
            } else {
                $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*');
                $this->db->from('amendment_committees');
                $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.cooperators_id', 'inner');
                $this->db->where('amendment_cooperators.cooperatives_id', $coop_id);
                $this->db->where('amendment_committees.orig_committee_id', $row['id']);
                $query3 = $this->db->get();
                if($query3->num_rows()>0) {
                    $row3 = $query2->row_array();
                    $data[$key] = $row3; 
                } else {
                    $data[$key] = $row;
                }
            }
        }
    }
    
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->where('cooperators.cooperatives_id', $coop_id);
    $this->db->where("CHAR_LENGTH(orig_committee_id)=0 OR orig_committee_id IS NULL");
    $query_new = $this->db->get();
    if($query_new->num_rows()>0) {
        foreach($query_new->result_array() as $rownew) {
            $data[] = $rownew;
        }
    }
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*');
    $this->db->from('amendment_committees');
    $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->where('amendment_cooperators.cooperatives_id', $coop_id);
    $this->db->where("CHAR_LENGTH(orig_committee_id)=0 OR orig_committee_id IS NULL");
    $query_new2 = $this->db->get();
    if($query_new2->num_rows()>0) {
        foreach($query_new2->result_array() as $rownew2) {
            $data[] = $rownew2;
        }
    }
    
//    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_amendment($coop_id){
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amend_coop.id', $coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_gad($coop_id){
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*,count(amendment_committees.id) AS count');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amendment_committees.name = "Gender and Development" AND cooperatives.id = ',$coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_gad_amendment($coop_id){
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*,count(amendment_committees.id) AS count');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amendment_committees.name = "Gender and Development" AND amend_coop.id = ',$coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_custom_committee_names_of_coop($coop_id){
    $list_committee_names = array(
      "Audit",
      // "Accounting",
      "Election",
      "Education and Training",
      "Mediation and Conciliation",
      "Ethics",
      "Credit",
      "Gender and Development");
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('amendment_committees.name',$list_committee_names);
    $this->db->where('cooperatives.id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_committee_names_of_coop_multi($coop_id){
    $this->db->select('amendment_committees.name');
    $this->db->order_by('amendment_committees.name','asc');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where('cooperatives.id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    $temp = array();
    foreach($data as $d){
      $temp2 = array(
        'name_of_committee' => $d['name'],
        'committees_cooperator_list' => array()
      );
      $this->db->select('cooperators.full_name');
      $this->db->from('amendment_committees');
      $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
      $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
      $this->db->distinct();
      $this->db->where(array('cooperatives.id'=>$coop_id,'amendment_committees.name'=>$d['name']));
      $query2 = $this->db->get();
      $datatemp = $query2->result_array();
      foreach($datatemp as $dt){
        array_push($temp2['committees_cooperator_list'],$dt['full_name']);
      }
      array_push($temp,$temp2);
    }
    return $temp;
  }
  // public function get_list_possible_committee($id){
  //   $this->db->select('full_name');
  //   $this->db->from('cooperators');
  //   $this->db->where('cooperatives_id', $id);
  //   $query1 = $this->db->get_compiled_select();
  //   $this->db->select('full_name');
  //   $this->db->from('members');
  //   $this->db->where('cooperatives_id', $id);
  //   $query2 = $this->db->get_compiled_select();
  //   $query = $this->db->query($query1 . ' UNION ALL ' . $query2);
  //   return $query->result();
  // }
  public function check_committee_in_cooperative($committee_id,$cooperatives_id){
    $this->db->select('*');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id','inner');
    $this->db->where(array('cooperatives.id'=>$cooperatives_id,'amendment_committees.id'=>$committee_id));
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function committee_complete_count($coop_id){
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('cooperatives.id', $coop_id);
    $count = $this->db->count_all_results();
    if($count<1){
      return false;
    }else{
      return true;
    }
  }
  public function committee_complete_count_amendment($coop_id){
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amend_coop.id', $coop_id);
    $count = $this->db->count_all_results();
    if($count<1){
      return false;
    }else{
      return true;
    }
  }
  public function check_committee_name_not_exists($ajax){
    $ajax = $this->security->xss_clean($ajax);
    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatives_id']));
    $list_committee_names = array(
      "Audit",
      // "Accounting",
      "Election",
      "Education and Training",
      "Mediation and Conciliation",
      "Ethics",
      "Credit",
      "Gender and Development");
    $temp = strtolower(str_replace(' ', '', $ajax['fieldValue']));
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('amendment_committees.name',$list_committee_names);
    $this->db->where('cooperatives.id',$decoded_id);
    $query = $this->db->get();
    $data = $query->result_array();
    foreach($data as $s_data){
      array_push($list_committee_names,$s_data['name']);
    }
    $temp2_list = array_map('strtolower', str_replace(' ', '',$list_committee_names));
    if (in_array($temp, $temp2_list)){
      return array($ajax['fieldId'],false);
    }else{
      return array($ajax['fieldId'],true);
    }
  }
}
