<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_committees_update_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function get_all_gad_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Gender and Development" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
   public function get_all_gad_count2($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->where('name = "Gender and Development" AND amendment_id ='.$amendment_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
  public function get_all_committees_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
  public function add_committee($data){
    $data = $this->security->xss_clean($data);
    // $this->db->where($data);
    
    $amendment_id  = $data['amendment_id'];
    $position = $data['name'];
     $this->db->trans_begin();
    $query_check = $this->db->get_where('amendment_committees',array('amendment_id'=>$amendment_id));
    if($query_check->num_rows()>0)
    {
    	$check_query = $this->db->get_where('amendment_committees' ,array('amendment_id'=>$amendment_id,'name'=>$position));
	   // return $this->db->last_query();
	    if($check_query->num_rows()>=3)
	    {
	      return array('success'=>false,'message'=>'Committee already has 3 '.$data['name']);
	     }else{
	       
	        $this->db->insert('amendment_committees',$data);
	        
	    } 

    } 
    else
    {
    	$this->db->insert('amendment_committees',$data);
    }
	    

	  	    if($this->db->trans_status() === FALSE){
	          $this->db->trans_rollback();
	          return array('success'=>false,'message'=>'Unable to add committee');
	        }else{
	          $this->db->trans_commit();
	          return array('success'=>true,'message'=>'Successfully added');
	        }
   
  }
    public function check_position_($amendment_id)
    {
    $data=[];
    $this->db->select('name');
    $this->db->from('amendment_committees');
    $this->db->where(array('amendment_id'=>$amendment_id));
    $qry = $this->db->get();
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        $data[] =$row['name'];
      }
    }
    unset($qry);
    return $data;
    }


  public function edit_committee($committee_id,$committee_info){
    // $committee_id = $this->security->xss_clean($committee_id);
    // $cooperator_info = $this->security->xss_clean($committee_info);
    // $query = $this->db->get_where('amendment_committees',array('id'=>$committee_id));
    // $data = $query->row();
  
  $committee_id = $committee_info['id'];
  $position =  $committee_info['name'];
  $amendment_id = $committee_info['amendment_id'];

  //if no changes 
  $qry = $this->db->get_where('amendment_committees',array('id'=>$committee_id,'name'=>$position));
  if($qry->num_rows()>0)
  {
   
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
  }
  else
  {
    $ch_qry = $this->db->query("select * from amendment_committees where name='$position' and amendment_id='$amendment_id'");
    if($ch_qry->num_rows()>=3)
    {
      return array('success'=>false,'message'=>'Committee already has 3 '.$position);
    }
    else
    {
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
    }
  }
    // if(strcmp($data->name, $committee_info['name'])===0){
    //   $this->db->trans_begin();
    //   $this->db->where('id', $committee_id);
    //   $this->db->update('amendment_committees',$committee_info);
    //   if($this->db->trans_status() === FALSE){
    //     $this->db->trans_rollback();
    //     return array('success'=>false,'message'=>'Unable to updated committee');
    //   }else{
    //     $this->db->trans_commit();
    //     return array('success'=>true,'message'=>'Committee has been successfully updated');
    //   }
    // }else{
    //   $this->db->where($committee_info);
    //   $this->db->where(array('amendment_cooperators_id'=>$data->cooperators_id));
    //   $this->db->from('amendment_committees');
    //   $count = $this->db->count_all_results();
    //   if(!$count>=3){
    //     $this->db->trans_begin();
    //     $this->db->where(array('id'=>$committee_id));
    //     $this->db->update('amendment_committees',$committee_info);
    //     if($this->db->trans_status() === FALSE){
    //       $this->db->trans_rollback();
    //       return array('success'=>false,'message'=>'Unable to update committee');
    //     }else{
    //       $this->db->trans_commit();
    //       return array('success'=>true,'message'=>'Committee has been successfully updated');
    //     }
    //   }else{
    //     return array('success'=>false,'message'=>'Committee already has 3 '.$committee_info['name'].' committee');
    //   }
    // }
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
    $query = $this->db->get_where('amendment_committees', array('amendment_cooperators_id'=>$co_id));
    
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

   public function get_committee_info_edit($com_id){
    $query = $this->db->get_where('amendment_committees', array('id'=>$com_id));
    $data = $query->row_array();
    return $data;
  }

  public function get_all_required_count_credit($user_id){
    if($this->get_all_gad_count($user_id) != 0){ //ok
        if($this->get_all_audit_count($user_id) != 0){ //ok
            if($this->get_all_election_count($user_id) != 0){ //ok
                if($this->get_all_medcon_count($user_id) != 0){ //ok
                    if($this->get_all_ethics_count($user_id) != 0){ //ok 
                        if($this->get_all_credit_count($user_id) != 0){
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
  } 
   public function get_all_audit_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Audit" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }

  public function get_all_election_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Election" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
  public function get_all_medcon_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Mediation and Conciliation" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
  public function get_all_ethics_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Ethics" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
   public function get_all_credit_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Credit" AND user_id ='.$user_id.'');
    $this->db->from('amendment_committees');
    return $this->db->count_all_results();
  }
  public function get_all_committees_of_coop($amendment_id){
    $data = array();
    // $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*');
    // $this->db->from('amendment_committees');
    // $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.amendment_cooperators_id', 'inner');
    // $this->db->where('amendment_cooperators.amendment_id', $amendment_id);
    // $query = $this->db->get();

//    if($query->num_rows()>0) {
//        foreach($query->result_array() AS $key =>$row) {
//            $this->db->select('amendment_committees.id as comid, amendment_committees.* ,cooperators.*');
//            $this->db->from('amendment_committees');
//            $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
//            $this->db->where('cooperators.cooperatives_id', $coop_id);
//            $this->db->where('amendment_committees.orig_committee_id', $row['id']);
//            $query2 = $this->db->get();
//            if($query2->num_rows()>0) {
//                $row2 = $query2->row_array();
//                $data[$key] = $row2; 
//            } else {
//                $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*');
//                $this->db->from('amendment_committees');
//                $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.cooperators_id', 'inner');
//                $this->db->where('amendment_cooperators.cooperatives_id', $coop_id);
//                $this->db->where('amendment_committees.orig_committee_id', $row['id']);
//                $query3 = $this->db->get();
//                if($query3->num_rows()>0) {
//                    $row3 = $query2->row_array();
//                    $data[$key] = $row3; 
//                } else {
//                    $data[$key] = $row;
//                }
//            }
//        }
//    }
    
    $this->db->select('*');
    $this->db->from('amendment_committees');
    $this->db->where('amendment_id', $amendment_id);
    // $this->db->where("CHAR_LENGTH(orig_committee_id)=0 OR orig_committee_id IS NULL");
    $query_new = $this->db->get();
    if($query_new->num_rows()>0) {
        foreach($query_new->result_array() as $rownew) {
            $data[] = $rownew;
        }
    }
    // $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*');
    // $this->db->from('amendment_committees');
    // $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.cooperators_id', 'inner');
    // $this->db->where('amendment_cooperators.cooperatives_id', $coop_id);
    // $this->db->where("CHAR_LENGTH(orig_committee_id)=0 OR orig_committee_id IS NULL");
    // $query_new2 = $this->db->get();
    // if($query_new2->num_rows()>0) {
    //     foreach($query_new2->result_array() as $rownew2) {
    //         $data[] = $rownew2;
    //     }
    // }
    
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
  
  public function get_all_committees_of_coop_gad_amendment($amendment_id){
    $this->db->select('amendment_committees.id as comid, amendment_committees.* ,amendment_cooperators.*,count(amendment_committees.id) AS count');
    $this->db->from('amendment_committees');
    $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.amendment_cooperators_id', 'inner');
    $this->db->join('amend_coop', 'amend_coop.id = amendment_cooperators.amendment_id', 'inner');
    $this->db->where('amendment_committees.name = "Gender and Development" AND amend_coop.id = ',$amendment_id);
    $this->db->group_by('amendment_committees.id');
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_custom_committee_names_of_coop($amendment_id){
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
    $this->db->join('amendment_cooperators' , 'amendment_cooperators.id = amendment_committees.amendment_cooperators_id','inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('amendment_committees.name',$list_committee_names);
    $this->db->where('amendment_committees.amendment_id',$amendment_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_committee_names_of_coop_multi($amendment_id){
    $this->db->select('amendment_committees.name');
    $this->db->order_by('amendment_committees.name','asc');
    $this->db->from('amendment_committees');
    $this->db->join('amendment_cooperators' , 'amendment_committees.amendment_cooperators_id = amendment_cooperators.id','inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where('amendment_committees.amendment_id',$amendment_id);
    $query = $this->db->get();
    $data = $query->result_array();
    $temp = array();
    foreach($data as $d){
      $temp2 = array(
        'name_of_committee' => $d['name'],
        'committees_cooperator_list' => array()
      );
      $this->db->select('amendment_cooperators.full_name');
      $this->db->from('amendment_committees');
      $this->db->join('amendment_cooperators' , 'amendment_committees.amendment_cooperators_id = amendment_cooperators.id','inner');
      // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
      $this->db->distinct();
      $this->db->where(array('amendment_committees.amendment_id'=>$amendment_id,'amendment_committees.name'=>$d['name']));
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
  public function check_committee_in_cooperative($committee_id,$amendment_id){
    $this->db->select('amendment_committees.id');
    $this->db->from('amendment_committees');
    $this->db->join('amendment_cooperators' , 'amendment_committees.amendment_cooperators_id = amendment_cooperators.id','inner');
    $this->db->join('amend_coop', 'amend_coop.id = amendment_committees.amendment_id','inner');
    $this->db->where(array('amend_coop.id'=>$amendment_id,'amendment_committees.id'=>$committee_id));
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function committee_complete_count($amendment_id){
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    $this->db->join('amendment_cooperators', 'amendment_cooperators.id = amendment_committees.amendment_cooperators_id', 'inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amendment_committees.amendment_id', $amendment_id);
    $count = $this->db->count_all_results();
    if($count<1){
      return false;
    }else{
      return true;
    }
  }
  public function committee_complete_count_amendment($amendment_id){
    $this->db->select('amendment_committees.name');
    $this->db->from('amendment_committees');
    // $this->db->join('cooperators', 'cooperators.id = amendment_committees.cooperators_id', 'inner');
    // $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amendment_id', $amendment_id);
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
    $this->db->join('amendment_cooperators' , 'amendment_cooperators.id = amendment_committees.amendment_cooperators_id','inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('amendment_committees.name',$list_committee_names);
    $this->db->where('amendment_committees.amendment_id',$decoded_id);
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
  public function get_all_others_committees_of_coop($amendment_id){
    $query = $this->db->get_where('amendment_committees',array('amendment_id'=>$amendment_id,'type'=>'others'));
    $data =  $query->result_array();
    return $data;
  }
  public function check_credit_committe_in_agriculture($amendment_id)
  {
    $query =$this->db->query("select type_of_cooperative from amend_coop where id='$amendment_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $typeCoop = explode(',',$row['type_of_cooperative']);
        if(count($typeCoop)>1)
        {
          //valid for credit
          return true;
        }
        else
        {
          $array_type = array('Agriculture','Agrarian Reform');
          if(in_array($typeCoop,$array_type))
          {
            return true;
          }
          else
          {
            return false;
          }
        }
      }
    }
    else
    {
      return false;
    }
  }
  public function check_if_has_credit($amendment_id)
  {
    $query = $this->db->query("select name from amendment_committees where amendment_id ='$amendment_id' and name='Credit'");
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
