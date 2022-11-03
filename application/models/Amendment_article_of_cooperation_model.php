<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendment_article_of_Cooperation_model extends CI_Model{

  public function __construct()

  {

    parent::__construct();

    //Codeigniter : Write Less Do More

  }

  public function get_article_by_coop_id($coop_id,$amendment_id){

    $data_coop_id = $this->security->xss_clean($coop_id);

    $data_amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_articles_of_cooperation',array('cooperatives_id'=>$data_coop_id,'amendment_id'=>$data_amendment_id));

    return $query->row();

  }

  public function update_article_primary($amendment_id,$article_info){

   $amendment_id = $this->security->xss_clean($amendment_id);

    $article_info = $this->security->xss_clean($article_info);

    /*check record first if existing if not then create*/

    // $get_record = $this->db->where("id",$article_coop_id)->get("amendment_articles_of_cooperation");

    // if($get_record->num_rows()==0) {

    //     $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$article_coop_id));

    //     $this->db->trans_commit();

    // }

    $this->db->trans_begin();

    // $this->db->where('id', $article_coop_id);

    $this->db->update('amendment_articles_of_cooperation',$article_info,array('amendment_id'=>$amendment_id));

    if($this->db->trans_status() === FALSE){

      $this->db->trans_rollback();

      return false;

    }else{

      $this->db->trans_commit();

      return true;

    }

  }



  public function check_article_primary_complete($amendment_id){

    

    $counter = 0;

     $cooperative_id = $this->coop_dtl($amendment_id);

    $query = $this->db->get_where('amendment_bylaws',array('amendment_id'=>$amendment_id));

    $data = $query->row();
    $common_share=0;
    $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('amendment_id'=>$amendment_id));

    $data2 = array();

    if($query2->num_rows()>0) {

        $data2 = $query2->row();
        $common_share = $data2->common_share;
        foreach ($data2 as $key => $value){

          if(empty($value)) $counter++;

        }
        unset($value);
    }

    if($data->kinds_of_members==1){

      // if($counter<=2){

        $temp = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);

        if($common_share >= $temp['total_subscribed'] && $common_share <= ($temp['total_subscribed']*4)){

          return true;

        }else{

          return false;

        }

      // }else{

      //   return false;

      // }

    }else{

      if($counter<=0){

       

        $temp = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);

        $temp2 = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$amendment_id);

        $tempGrandTotal = $data2 ? ($data2->common_share * $data2->par_value_common) + ($data2->preferred_share * $data2->par_value_preferred) : 0;

        if($data2 && $data2->common_share >= $temp['total_subscribed'] && $data2->preferred_share >= $temp2['total_subscribed']){

          return true;

        }else{

          return false;

        }

      }else{
        return true;
      }

    }
    return false;
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

