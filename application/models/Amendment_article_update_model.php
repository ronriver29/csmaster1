<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_article_update_model extends CI_Model{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('amendment_update_cooperator_model');
  }
  public function get_article_by_coop_id($amendment_id){
    // $data_coop_id = $this->security->xss_clean($coop_id);
    $data_amendment_id = $this->security->xss_clean($amendment_id);
    $query = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$data_amendment_id));
    if($query->num_rows()==1)
    {
      $data = $query->row();
    }
    else
    {
      $data =null;
    }
    return $data;
  }
  public function update_article_primary($amendment_id,$article_info){
   $amendment_id = $this->security->xss_clean($amendment_id);
    $article_info = $this->security->xss_clean($article_info);

    $check_article = $this->db->query("select id from amendment_articles_of_cooperation where amendment_id ='$amendment_id'");
    if($check_article->num_rows()==1)
    {
      $this->db->trans_begin();
      $this->db->update('amendment_articles_of_cooperation',$article_info,array('amendment_id'=>$amendment_id));
    }
    else
    {
       $this->db->trans_begin();
       $this->db->insert('amendment_articles_of_cooperation',$article_info);
    }
   
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function check_article_primary_complete($amendment_id){
  $check_qry = $this->db->query("select * from amendment_articles_of_cooperation where amendment_id ='$amendment_id'");
  if($check_qry->num_rows()==1)
  {
      $counter = 0;
       $cooperative_id = $this->coop_dtl($amendment_id);
      $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$amendment_id));
      $data = $query->row();
      $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$amendment_id));
      $data2 = array();
      if($query2->num_rows()>0) {
          $data2 = $query2->row();
          foreach ($data2 as $key => $value){
            if(empty($value)) $counter++;
          }
      }
      if($data->kinds_of_members==1){
        // if($counter<=2){
          $temp = $this->amendment_update_cooperator_model->get_total_regular($cooperative_id,$amendment_id);
          if($data2->common_share >= $temp['total_subscribed'] && $data2->common_share <= ($temp['total_subscribed']*4)){
            return true;
          }else{
            return false;
          }
      }else{
        if($counter<=0){
         
          $temp = $this->amendment_update_cooperator_model->get_total_regular($cooperative_id,$amendment_id);
          $temp2 = $this->amendment_update_cooperator_model->get_total_associate($cooperative_id,$amendment_id);
          $tempGrandTotal = $data2 ? ($data2->common_share * $data2->par_value_common) + ($data2->preferred_share * $data2->par_value_preferred) : 0;
          if($data2 && $data2->common_share >= $temp['total_subscribed'] && $data2->preferred_share >= $temp2['total_subscribed']){
            return true;
          }else{
            return false;
          }
        }else{
          // return false;
          return true;
        }
      }
  } 
  else
  {
    return false;
  } 
    
  }
  public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }
}
