<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_of_Cooperation_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_article_by_coop_id($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('articles_of_cooperation',array('cooperatives_id'=>$data));
    return $query->row();
  }
  public function get_article_by_coop_id_amend($coop_id){
    $data = $this->security->xss_clean($coop_id);
    $query = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$data));
    return $query->row();
  }
  public function update_article_primary($article_coop_id,$article_info){
    $article_coop_id = $this->security->xss_clean($article_coop_id);
    $article_info = $this->security->xss_clean($article_info);
    $this->db->trans_begin();
    $this->db->where('cooperatives_id', $article_coop_id);
    $this->db->update('articles_of_cooperation',$article_info);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function check_article_primary_complete($article_coop_id){
    $counter = 0;
    $query = $this->db->get_where('bylaws',array('cooperatives_id'=>$article_coop_id));
    $data = $query->row();
    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id'=>$article_coop_id));
    $data2 = $query2->row();
    foreach ($data2 as $key => $value){
      if(empty($value)) $counter++;
    }
    if($data->kinds_of_members==1){
      if($counter<=3){
        $temp = $this->cooperator_model->get_total_regular($article_coop_id);
//        if($data2->common_share >= $temp['total_subscribed'] && $data2->common_share <= ($temp['total_subscribed']*4)){
          return true;
//        }else{
          return false;
//        }
      }else{
        return false;
      }
    }else{
      if($counter<=2){
        $temp = $this->cooperator_model->get_total_regular($article_coop_id);
        $temp2 = $this->cooperator_model->get_total_associate($article_coop_id);
        $tempGrandTotal = ($data2->common_share * $data2->par_value_common) + ($data2->preferred_share * $data2->par_value_preferred);
        if($data2->common_share >= $temp['total_subscribed']){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
  }
  public function check_article_union_complete($article_coop_id){
    $counter = 0;
    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id'=>$article_coop_id));
    $data2 = $query2->row();
    foreach ($data2 as $key => $value){
      if(empty($value)) $counter++;
    }

    if($counter <= 7){
      return true;
    } else {
      return false;
    }
    // return $counter++;
  }

  public function check_article_primary_complete_amend($article_coop_id){
    $counter = 0;
    $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$article_coop_id));
    $data = $query->row();
    $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$article_coop_id));
    $data2 = $query2->row();
    foreach ($data2 as $key => $value){
      if(empty($value)) $counter++;
    }
    if($data->kinds_of_members==1){
      if($counter<=3){
        $temp = $this->cooperator_model->get_total_regular_amend($article_coop_id);
//        if($data2->common_share >= $temp['total_subscribed'] && $data2->common_share <= ($temp['total_subscribed']*4)){
          return true;
//        }else{
          return false;
//        }
      }else{
        return false;
      }
    }else{
      if($counter<=1){
        $temp = $this->cooperator_model->get_total_regular_amend($article_coop_id);
        $temp2 = $this->cooperator_model->get_total_associate($article_coop_id);
        $tempGrandTotal = ($data2->common_share * $data2->par_value_common) + ($data2->preferred_share * $data2->par_value_preferred);
        if($data2->common_share >= $temp['total_subscribed'] && $data2->preferred_share >= $temp2['total_subscribed']){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }
  }
}
