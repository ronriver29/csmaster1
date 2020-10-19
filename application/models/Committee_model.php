<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committee_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function add_committee($data){
    $data = $this->security->xss_clean($data);
    $this->db->where($data);
    $this->db->from('committees');
    $count = $this->db->count_all_results();
    if($count<1){
      $this->db->trans_begin();
      $this->db->insert('committees',$data);
      $query = $this->db->select('id')
        ->from('committees')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_committee_id'] = $row['id'];
        //$this->db->insert('amendment_committees',$data);
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
  public function add_committee_federation($data){
    $data = $this->security->xss_clean($data);
    $this->db->where($data);
    $this->db->from('committees_federation');
    $count = $this->db->count_all_results();
    if($count<1){
      $this->db->trans_begin();
      $this->db->insert('committees_federation',$data);
      $query = $this->db->select('id')
        ->from('committees_federation')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_committee_id'] = $row['id'];
        $this->db->insert('amendment_committees_federation',$data);
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
  public function add_committee_union($data){
    $data = $this->security->xss_clean($data);
    $this->db->where($data);
    $this->db->from('committees_union');
    $count = $this->db->count_all_results();
    if($count<1){
      $this->db->trans_begin();
      $this->db->insert('committees_union',$data);
      $query = $this->db->select('id')
        ->from('committees_union')
        ->order_by('id','DESC')
        ->limit(1)
        ->get();
        if ($query->num_rows() > 0)
        {           
            $row = $query->row_array();
        }
        $data['orig_committee_id'] = $row['id'];
        $this->db->insert('amendment_committees_federation',$data);
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
    $query = $this->db->get_where('committees',array('id'=>$committee_id));
    $data = $query->row();
    if(strcmp($data->name, $committee_info['name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $committee_id);
      $this->db->update('committees',$committee_info);
      $this->db->where('orig_committee_id', $committee_id);
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
      $this->db->from('committees');
      $count = $this->db->count_all_results();
      if($count<1){
        $this->db->trans_begin();
        $this->db->where(array('id'=>$committee_id));
        $this->db->update('committees',$committee_info);
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
  public function edit_committee_federation($committee_id,$committee_info){
    $cooperator_id = $this->security->xss_clean($committee_id);
    $cooperator_info = $this->security->xss_clean($committee_info);
    $query = $this->db->get_where('committees_federation',array('id'=>$committee_id));
    $data = $query->row();
    if(strcmp($data->name, $committee_info['name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $committee_id);
      $this->db->update('committees_federation',$committee_info);
      $this->db->where('orig_committee_id', $committee_id);
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
      $this->db->from('committees_federation');
      $count = $this->db->count_all_results();
      if($count<1){
        $this->db->trans_begin();
        $this->db->where(array('id'=>$committee_id));
        $this->db->update('committees_federation',$committee_info);
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
  public function edit_committee_union($committee_id,$committee_info){
    $cooperator_id = $this->security->xss_clean($committee_id);
    $cooperator_info = $this->security->xss_clean($committee_info);
    $query = $this->db->get_where('committees_union',array('id'=>$committee_id));
    $data = $query->row();
    if(strcmp($data->name, $committee_info['name'])===0){
      $this->db->trans_begin();
      $this->db->where('id', $committee_id);
      $this->db->update('committees_union',$committee_info);
      $this->db->where('orig_committee_id', $committee_id);
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
      $this->db->from('committees_union');
      $count = $this->db->count_all_results();
      if($count<1){
        $this->db->trans_begin();
        $this->db->where(array('id'=>$committee_id));
        $this->db->update('committees_union',$committee_info);
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
    $this->db->delete('committees',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function delete_committee_federation($data){
    $this->db->trans_begin();
    $this->db->delete('committees_federation',array('id' => $data));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function isExisting($co_id){
    $query = $this->db->get_where('committees', array('cooperators_id'=>$co_id));
    
    if ($query->num_rows()>0)
      return true;
    else
      return false;
  }
  
   public function isExisting2($co_name,$user_id){
    $query = $this->db->get_where('committees', array('name'=>$co_name,'user_id'=>$user_id));
    if ($query->num_rows()>2)
      return true;
    else
      return false;
  }  
  
  public function isExistingFederation($co_id){
    $query = $this->db->get_where('committees_federation', array('cooperators_id'=>$co_id));
    
    if ($query->num_rows()>0)
      return true;
    else
      return false;
  }  

  public function isExisting2federation($co_name,$user_id){
    $query = $this->db->get_where('committees_federation', array('name'=>$co_name,'user_id'=>$user_id));
    if ($query->num_rows()>2)
      return true;
    else
      return false;
  }  

  public function get_committee_info($com_id){
    $query = $this->db->get_where('committees', array('id'=>$com_id));
    $data = $query->row();
    return $data;
  }
  public function get_committee_federation_info($com_id){
    $query = $this->db->get_where('committees_federation', array('id'=>$com_id));
    $data = $query->row();
    return $data;
  }
  public function get_committee_union_info($com_id){
    $query = $this->db->get_where('committees_union', array('id'=>$com_id));
    $data = $query->row();
    return $data;
  }

  public function get_all_committees_of_coop($coop_id){
    $query = $this->db->query("SELECT committees.id as comid, committees.*,cooperators.* from committees left join cooperators ON committees.cooperators_id = cooperators.id WHERE cooperative_id = '$coop_id'");
    // $this->db->select('committees.id as comid, committees.* ,cooperators.*');
    // $this->db->from('committees');
    // $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    // $this->db->where('cooperatives.id', $coop_id);
    // $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  public function get_all_others_committees_of_coop($coop_id){
    $query = $this->db->get_where('committees',array('cooperative_id'=>$coop_id,'type'=>'others'));
    $data =  $query->result_array();
    return $data;
  }
  //exclusive for Agriculture cooperative type
  public function check_credit_committe_in_agriculture($cooperative_id)
  {
    $query =$this->db->query("select type_of_cooperative from cooperatives where id='$cooperative_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        if($row['type_of_cooperative'] =='Agriculture')
        {
          $query2 = $this->db->get_where('committees',array('cooperative_id'=>$cooperative_id,'name'=>"Credit"));
          if($query2->num_rows()>0)
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
    }
    else
    {
      return false;
    }
  }
  public function get_all_committees_of_coop_federation($coop_id){
    $this->db->select('committees_federation.id as comid, committees_federation.* ,cooperators.*');
    $this->db->from('committees_federation');
    $this->db->join('cooperators', 'cooperators.id = committees_federation.cooperators_id', 'inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('committees_federation.user_id', $coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_union($coop_id){
    $this->db->select('committees_union.id as comid, committees_union.* ,cooperators.*');
    $this->db->from('committees_union');
    $this->db->join('cooperators', 'cooperators.id = committees_union.cooperators_id', 'inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('committees_union.user_id', $coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_amendment($coop_id){
    $this->db->select('committees.id as comid, committees.* ,cooperators.*');
    $this->db->from('committees');
    $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
    $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    $this->db->where('amend_coop.id', $coop_id);
    $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_gad($coop_id){
    // $this->db->select('committees.id as comid, committees.* ,cooperators.*,count(committees.id) AS count');
    // $this->db->from('committees');
    // $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
    // $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id', 'inner');
    // $this->db->where('committees.name = "Gender and Development" AND cooperatives.id = ',$coop_id);

   $query = $this->db->query("select committees.id as comid, committees.* ,cooperators.*,count(committees.id) AS count from committees inner join cooperators on cooperators.id=committees.cooperators_id inner join cooperatives on cooperatives.id = cooperators.cooperatives_id where committees.name ='Gender and Development' and cooperatives.id='$coop_id' group by committees.id");
    // $query = $this->db->get();
    $data =  $query->result_array();
    return $data;
  }
  
  public function get_all_committees_of_coop_gad_amendment($amendment_id){
    // $this->db->select('committees.id as comid, committees.* ,cooperators.*,count(committees.id) AS count');
    // $this->db->from('committees');
    // $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
    // $this->db->join('amend_coop', 'amend_coop.id = cooperators.cooperatives_id', 'inner');
    // $this->db->where('committees.name = "Gender and Development" AND amend_coop.id = ',$coop_id);
    // $query = $this->db->get();
    $this->db->get_where('amendment_committees',array('amendment_id'=>$amendment_id));
    $data =  $query->result_array();
    return $data;
  }

  public function check_position($amendment_id,$position)
  {
    $qry = $this->db->get_where('amendment_committees',array('amendment_id'=>$amendment_id,'name'=>$position));
    if($qry->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
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
    $this->db->select('committees.name');
    $this->db->from('committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('committees.name',$list_committee_names);
    $this->db->where('cooperatives.id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_all_committee_names_of_coop_multi($coop_id){
    $this->db->select('committees.name','committes.func_and_respons');
    $this->db->order_by('committees.name','asc');
    $this->db->from('committees');
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
      $this->db->from('committees');
      $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
      $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
      $this->db->distinct();
      $this->db->where(array('cooperatives.id'=>$coop_id,'committees.name'=>$d['name']));
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
    $this->db->from('committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id','inner');
    $this->db->where(array('cooperatives.id'=>$cooperatives_id,'committees.id'=>$committee_id));
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function check_committee_in_cooperative_federation($committee_id,$cooperatives_id){
    $this->db->select('*');
    $this->db->from('committees_federation');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id','inner');
    $this->db->where(array('committees_federation.id'=>$committee_id));
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function check_committee_in_cooperative_union($committee_id,$cooperatives_id){
    $this->db->select('*');
    $this->db->from('committees_union');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id','inner');
    $this->db->where(array('committees_union.id'=>$committee_id));
    $count = $this->db->count_all_results();
    if($count>0){
      return true;
    }else{
      return false;
    }
  }
  public function committee_complete_count($coop_id){
    $this->db->select('committees.name');
    $this->db->from('committees');
    $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
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
    $this->db->select('committees.name');
    $this->db->from('committees');
    $this->db->join('cooperators', 'cooperators.id = committees.cooperators_id', 'inner');
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
    $this->db->select('committees.name');
    $this->db->from('committees');
    $this->db->join('cooperators' , 'cooperators.id = cooperators_id','inner');
    $this->db->join('cooperatives', 'cooperatives.id = cooperators.cooperatives_id');
    $this->db->distinct();
    $this->db->where_not_in('committees.name',$list_committee_names);
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
// COUNT ALL REQUIRED
  public function get_all_required_count_credit($user_id){
    if($this->get_all_gad_count($user_id) != 0){
        if($this->get_all_audit_count($user_id) != 0){
            if($this->get_all_election_count($user_id) != 0){
                if($this->get_all_medcon_count($user_id) != 0){
                    if($this->get_all_ethics_count($user_id) != 0){
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
  public function get_all_required_count_credit_federation($user_id){
    if($this->get_all_gad_count_federation($user_id) != 0){
        if($this->get_all_audit_count_federation($user_id) != 0){
            if($this->get_all_election_count_federation($user_id) != 0){
                if($this->get_all_medcon_count_federation($user_id) != 0){
                    if($this->get_all_ethics_count_federation($user_id) != 0){
                        if($this->get_all_credit_count_federation($user_id) != 0){
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
  public function get_all_required_count_credit_union($user_id){
    if($this->get_all_gad_count_union($user_id) != 0){
        if($this->get_all_audit_count_union($user_id) != 0){
            if($this->get_all_election_count_union($user_id) != 0){
                if($this->get_all_medcon_count_union($user_id) != 0){
                    if($this->get_all_ethics_count_union($user_id) != 0){
                        if($this->get_all_credit_count_union($user_id) != 0){
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
    public function get_all_required_count($user_id){
    if($this->get_all_gad_count($user_id) != 0){
        if($this->get_all_audit_count($user_id) != 0){
            if($this->get_all_election_count($user_id) != 0){
                if($this->get_all_medcon_count($user_id) != 0){
                    if($this->get_all_ethics_count($user_id) != 0){
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
  }
  
  public function get_all_required_count_federation($user_id){
    if($this->get_all_gad_count_federation($user_id) != 0){
        if($this->get_all_audit_count_federation($user_id) != 0){
            if($this->get_all_election_count_federation($user_id) != 0){
                if($this->get_all_medcon_count_federation($user_id) != 0){
                    if($this->get_all_ethics_count_federation($user_id) != 0){
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
  }
  
  public function get_all_required_count_union($user_id){
    if($this->get_all_gad_count_union($user_id) != 0){
        if($this->get_all_audit_count_union($user_id) != 0){
            if($this->get_all_election_count_union($user_id) != 0){
                if($this->get_all_medcon_count_union($user_id) != 0){
                    if($this->get_all_ethics_count_union($user_id) != 0){
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
  }
// END COUNT ALL REQUIRED

// COMMITTEES REQUIRED
  
  public function get_all_gad_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Gender and Development" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
  public function get_all_audit_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Audit" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
  public function get_all_election_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Election" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
  public function get_all_medcon_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Mediation and Conciliation" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
  public function get_all_ethics_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Ethics" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
    public function get_all_credit_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Credit" AND user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
// COMMITTEES REQUIRED END
  public function get_all_gad_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Gender and Development" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_audit_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Audit" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_election_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Election" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_medcon_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Mediation and Conciliation" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_ethics_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Ethics" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_credit_count_federation($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Credit" AND user_id ='.$user_id.'');
    $this->db->from('committees_federation');
    return $this->db->count_all_results();
  }
  public function get_all_committees_count($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('user_id ='.$user_id.'');
    $this->db->from('committees');
    return $this->db->count_all_results();
  }
  
  public function get_all_gad_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Gender and Development" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  public function get_all_audit_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Audit" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  public function get_all_election_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Election" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  public function get_all_medcon_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Mediation and Conciliation" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  public function get_all_ethics_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Ethics" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  public function get_all_credit_count_union($user_id){
    $user_id = $this->security->xss_clean($user_id);
    $this->db->where('name = "Credit" AND user_id ='.$user_id.'');
    $this->db->from('committees_union');
    return $this->db->count_all_results();
  }
  
}
