<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendment_cooperator_model extends CI_Model{

public $last_query = "";

  public function __construct()

  {

    parent::__construct();

    //Codeigniter : Write Less Do More

    $this->load->database();

  }



    public function get_total_regular_members($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $amendment_id = $this->security->xss_clean($amendment_id);



    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');

    $query = $this->db->get_where('amendment_cooperators',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id,'type_of_member'=>'Regular'));

    $data = $query->row();

    //    $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));

//    $article = $query2->row();

    $query2 = $this->db->get_where('amendment_capitalization',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id));

    $capitalization_info = $query2->row();

    $capitalization_no_of_subscribed = 0;

    $capitalization_no_of_paid = 0;

  
        $this->db->where(array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id));

        $this->db->from('amendment_capitalization');

        if($this->db->count_all_results()==0){

          $capitalization_no_of_subscribed = 0;

        $capitalization_no_of_paid = 0;

        }else{

          $capitalization_no_of_subscribed = $capitalization_info->total_no_of_subscribed_capital;

        $capitalization_no_of_paid = $capitalization_info->total_no_of_paid_up_capital;

        }    

    $totalSubscribed = 0;

    $totalPaid = 0;

    

    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;

    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;

//    $totalSubscribed = $data->total_subscribed;

//    $totalPaid = $data->total_paid;

    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid, 'capitalization_no_of_subscribed'=>$capitalization_no_of_subscribed, 'capitalization_no_of_paid'=>$capitalization_no_of_paid);

  }

//modified

  public function get_total_associate($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');

    $query = $this->db->get_where('amendment_cooperators',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id,'type_of_member'=>'Associate'));

    $data = $query->row();

    $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id));

    $article = $query2->row();

    $totalSubscribed = 0;

    $totalPaid = 0;

    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;

    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;

    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);

  }





   public function get_all_cooperator_of_coop_regular($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

     $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('type_of_member = "Regular" AND cooperatives_id = '.$cooperatives_id.' AND amendment_id='.$amendment_id);

    $this->db->order_by('full_name','asc');

    $query=$this->db->get();

// $this->last_query = $this->db->last_query();

    $data = $query->result_array();

    return $data;

  }



  public function cooperator_coop_regular($cooperatives_id,$amendment_id,$limit,$start){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

     $amendment_id = $this->security->xss_clean($amendment_id);

     $this->db->limit($limit,$start);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('type_of_member = "Regular" AND cooperatives_id = '.$cooperatives_id.' AND amendment_id='.$amendment_id);

    $this->db->order_by('full_name','asc');

    $query=$this->db->get();

// $this->last_query = $this->db->last_query();

    $data = $query->result_array();

    return $data;

  }

  public function cooperator_regular_count($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->select('type_of_member');

    $this->db->from('amendment_cooperators');

    $this->db->where('type_of_member = "Regular" AND  amendment_id='.$amendment_id);

    unset($amendment_id);

    return $this->db->count_all_results();



  }



  public function count_total_cptr_capitalization($amendment_id)

  {

    $total = 0;

    $reg = 0;

    $assoc = 0;

    $query = $this->db->query("select regular_members,associate_members from amendment_capitalization where amendment_id ='$amendment_id'");

    if($query->num_rows()>0)

    {

      foreach($query->result_array() as $row)

      {

        $reg = $row['regular_members'];

        if($row['associate_members']!=NULL)

        {

          $assoc = $row['associate_members'];

        }

        $total = $reg+$assoc;

      }

    }

    

    return $total;

  }

  public function get_all_cooperator_of_coop_associate($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('type_of_member = "Associate" AND cooperatives_id = '.$cooperatives_id.' AND amendment_id='.$amendment_id);

    $this->db->order_by('full_name','asc');

    $query=$this->db->get();

    $this->last_query = $this->db->last_query();

    $data = $query->result_array();

    return $data;

  }

  public function get_all_cooperator_of_coop_regular_count($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('type_of_member = "Regular" AND cooperatives_id ='.$cooperatives_id.' AND amendment_id='.$amendment_id);

    $this->db->from('amendment_cooperators');

    return $this->db->count_all_results();

  }



  public function get_all_cooperator_of_coop_associate_count($amendment_id){

    $amendment_id= $this->security->xss_clean($amendment_id);

    $this->db->where('type_of_member = "Associate" AND amendment_id ='.$amendment_id.'');

    $this->db->from('amendment_cooperators');

    return $this->db->count_all_results();

  }



  public function is_name_unique($ajax){

    $coop_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperative_id']));

     $amendment_id = $this->encryption->decrypt(decrypt_custom($ajax['amendment_id']));

    $this->db->where('cooperatives_id',$coop_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where('full_name', $ajax['fieldValue']);

    $this->db->from('amendment_cooperators');

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



  public function is_position_available($ajax){

    $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatives_id']));

     $amendment_id = $this->encryption->decrypt(decrypt_custom($ajax['amendment_id']));

    $this->db->where('cooperatives_id',$decoded_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where('position', $ajax['fieldValue']);

    $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count==0){

      return array($ajax['fieldId'],true);

    }else{

      return array($ajax['fieldId'],false);

    }

  }



  public function edit_is_name_unique($ajax){

    // $decoded_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperativesID']));

    // $cooperator_id = $this->encryption->decrypt(decrypt_custom($ajax['cooperatorID']));

    $this->db->where('cooperatives_id',$ajax['cooperative_id']);

    $this->db->where('amendment_id',$ajax['amendment_id']);

    $this->db->where('id !=',$ajax['cooperatorID']);

    $this->db->where('full_name', $ajax['fieldValue']);

    $this->db->from('amendment_cooperators');

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



    $this->db->where('cooperatives_id',$ajax['cooperative_id']);

    $this->db->where('amendment_id',$ajax['amendment_id']);

    $this->db->where('id!=',$ajax['cooperatorID']);

    $this->db->where('position', $ajax['fieldValue']);

    $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));

    $this->db->from('amendment_cooperators');

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



  public function check_name_not_exist($cooperatives_id,$amendment_id, $name){

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where('full_name', $name);

    $this->db->from('amendment_cooperators');

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

      if($this->check_position_not_exists($data['cooperatives_id'],$data['amendment_id'],$data['position'])){

        if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){

          if($this->check_directors_not_max($data['cooperatives_id'],$data['amendment_id'])){

            $this->db->trans_begin();

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

        return array('success'=>false,'message'=>'Only one Chairpeson is allowed');

      }

    }else if(strcmp($data['position'], 'Vice-Chairperson')===0){

      if($this->check_position_not_exists($data['cooperatives_id'],$data['amendment_id'],$data['position'])){

        if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){

          if($this->check_directors_not_max($data['cooperatives_id'],$data['amendment_id'])){

            $this->db->trans_begin();

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

        return array('success'=>false,'message'=>'Only one Vice-Chairpeson is allowed');

      }

    }else if(strcmp($data['position'],'Board of Director')===0){

      if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){

        if($this->check_directors_not_max($data['cooperatives_id'],$data['amendment_id'])){

          $this->db->trans_begin();

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

      if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){    

        if($this->check_position_not_exists($data['cooperatives_id'],$data['amendment_id'],$data['position'])){

          $this->db->trans_begin();

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

      if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){

        if($this->check_position_not_exists($data['cooperatives_id'],$data['amendment_id'],$data['position'])){

          $this->db->trans_begin();

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

      if($this->check_name_not_exist($data['cooperatives_id'],$data['amendment_id'],$data['full_name'])){

        $this->db->trans_begin();

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



  public function checkname_not_id($cooperator_id,$name,$coop_id,$amendment_id){

    $this->db->where_not_in('id',array($cooperator_id));

    $this->db->where('full_name', $name);

    $this->db->where('cooperatives_id', $coop_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count==0){

      return true;

    }else{

      return false;

    }

  }



  public function check_edit_id_orig_cptr($full_name,$cooperatives_id)

  {

    $query = $this->db->query("select full_name from cooperators where cooperatives_id ='$cooperatives_id' and full_name like '%".$full_name."%'");

    if($query->num_rows()==1)

    {

     return true;

    }

    else

    {

      return false;

    }

  }



  



  public function edit_cooperator($cooperator_id,$cooperator_info,$amendment_id){

    $cooperator_id = $this->security->xss_clean($cooperator_id);

    $cooperator_info = $this->security->xss_clean($cooperator_info);

    $query = $this->db->get_where('amendment_cooperators',array('id'=>$cooperator_id));

    

    $data = $query->row();

 

    if(strcmp($data->position, $cooperator_info['position'])===0 && strcmp($data->full_name, $cooperator_info['full_name'])===0){

      $this->db->trans_begin();

      $this->db->where('id', $cooperator_id);

      $this->db->update('amendment_cooperators',$cooperator_info);

      if($this->db->trans_status() === FALSE){

        $this->db->trans_rollback();

        return array('success'=>false,'message'=>'Unable to updated cooperator');

      }else{

        $this->db->trans_commit();

        return array('success'=>true,'message'=>'Cooperator has been successfully updated');

      }

    }else{

      if ($this->checkname_not_id($cooperator_id, $cooperator_info['full_name'], $data->cooperatives_id,$cooperator_info['amendment_id'])) {

        if(strcmp($cooperator_info['position'], 'Chairperson')===0){

          $qry_nochange_position = $this->db->get_where('amendment_cooperators',array('position'=>$cooperator_info['position'],'id'=>$cooperator_id));

          if($qry_nochange_position->num_rows()>0)

          {

              

                $this->db->trans_begin();

                  $this->db->where('id', $cooperator_id);

                  $this->db->update('amendment_cooperators',$cooperator_info);

                  if($this->db->trans_status() === FALSE){

                    $this->db->trans_rollback();

                    return array('success'=>false,'message'=>'Unable to update cooperator');

                  }else{

                    $this->db->trans_commit();

                    return array('success'=>true,'message'=>'Cooperator has been successfully updated');

                  }   

          }

          else

          {

              if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

                if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

                  $this->db->trans_begin();

                  $this->db->where('id', $cooperator_id);

                  $this->db->update('amendment_cooperators',$cooperator_info);

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

          }//end num rows



          

        }else if(strcmp($cooperator_info['position'], 'Vice-Chairperson')===0){

          $qry_nochange_position = $this->db->get_where('amendment_cooperators',array('position'=>$cooperator_info['position'],'id'=>$cooperator_id));

          if($qry_nochange_position->num_rows()>0)

          {

                 $this->db->trans_begin();

                  $this->db->where('id', $cooperator_id);

                  $this->db->update('amendment_cooperators',$cooperator_info);

                  if($this->db->trans_status() === FALSE){

                    $this->db->trans_rollback();

                    return array('success'=>false,'message'=>'Unable to update cooperator');

                  }else{

                    $this->db->trans_commit();

                    return array('success'=>true,'message'=>'Cooperator has been successfully updated');

                  }

          }

          else

          {

              if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

                if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

                  $this->db->trans_begin();

                  $this->db->where('id', $cooperator_id);

                  $this->db->update('amendment_cooperators',$cooperator_info);

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

          } //end num rows 

          

        }else if(strcmp($cooperator_info['position'],'Board of Director')===0){

          if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

            $this->db->trans_begin();

            $this->db->where('id', $cooperator_id);

            $this->db->update('amendment_cooperators',$cooperator_info);

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

          $qry_nochange_position = $this->db->get_where('amendment_cooperators',array('position'=>$cooperator_info['position'],'id'=>$cooperator_id));

          if($qry_nochange_position->num_rows()>0)

          {

            $this->db->trans_begin();

                $this->db->where('id', $cooperator_id);

                $this->db->update('amendment_cooperators',$cooperator_info);

                if($this->db->trans_status() === FALSE){

                  $this->db->trans_rollback();

                  return array('success'=>false,'message'=>'Unable to update cooperator');

                }else{

                  $this->db->trans_commit();

                  return array('success'=>true,'message'=>'Cooperator has been successfully updated');

                }      

          } 

          else

          {

              if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position']))

             {

                $this->db->trans_begin();

                $this->db->where('id', $cooperator_id);

                $this->db->update('amendment_cooperators',$cooperator_info);

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

          }//num rows 

          

        }else if(strcmp($cooperator_info['position'],'Secretary')===0){

          $query_sec = $this->db->get_where('amendment_cooperators',array('id'=>$cooperator_id));

          $cptr_data =  $query_sec->row();

          if($cptr_data->id == $cooperator_id && $cptr_data->position=='Secretary')

          {

           // return  $cptr_data->id.' '.$cooperator_id.' '.$cptr_data->position;

              $this->db->trans_begin();

              $this->db->where('id', $cooperator_id);

              $this->db->update('amendment_cooperators',$cooperator_info);

              if($this->db->trans_status() === FALSE){

                $this->db->trans_rollback();

                return array('success'=>false,'message'=>'Unable to update cooperator');

              }else{

                $this->db->trans_commit();

                return array('success'=>true,'message'=>'Cooperator has been successfully updated');

              }

          }

          else

          {

            if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

              $this->db->trans_begin();

              $this->db->where('id', $cooperator_id);

              $this->db->update('amendment_cooperators',$cooperator_info);

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

          }

          

        }else{

          $this->db->trans_begin();

          $this->db->where('id', $cooperator_id);

          $this->db->update('amendment_cooperators',$cooperator_info);

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

          if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

            if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

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

            return array('success'=>false,'message'=>'Only one Chairpeson is allowed');

          }

        }else if(strcmp($cooperator_info['position'], 'Vice-Chairperson')===0){

          if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

            if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

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

            return array('success'=>false,'message'=>'Only one Vice-Chairpeson is allowed');

          }

        }else if(strcmp($cooperator_info['position'],'Board of Director')===0){

          if($this->check_directors_not_max($data->cooperatives_id,$amendment_id)){

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

          if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

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

          if($this->check_position_not_exists($data->cooperatives_id,$amendment_id,$cooperator_info['position'])){

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

  

  public function delete_cooperator($cooperator_id){

    $this->db->trans_begin();

    $this->db->delete('amendment_cooperators',array('id' => $cooperator_id));

    $this->db->delete('amendment_committees',array('amendment_cooperators_id'=> $cooperator_id));

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

    $query = $this->db->get('amendment_cooperators');

    $data = $query->result();

    return $data;

  }

  public function get_cooperator_info($cooperative_id,$amendment_id,$cooperator_id){

    $cooperator_id = $this->security->xss_clean($cooperator_id);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyCode," ",refbrgy.brgyDesc," ",refcitymun.citymunCode," ",refcitymun.citymunDesc," ",refprovince.provCode," ",refprovince.provDesc," ",refregion.regCode," ",refregion.regDesc) AS full_address');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    // $this->db->where('amendment_cooperators.cooperatives_id',$cooperative_id);

    $this->db->where('amendment_cooperators.amendment_id',$amendment_id);

    $this->db->where('amendment_cooperators.id',$cooperator_id);

    $query=$this->db->get();

    return $query->row();

  

  }



  public function get_cooperator_info_orig($full_name){

    // $cooperator_id = $this->security->xss_clean($cooperator_id);

    $this->db->select('cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyDesc," ",refcitymun.citymunDesc," ",refprovince.provDesc," ",refregion.regDesc) AS full_address,cooperators.full_name');

    $this->db->from('cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->like('cooperators.full_name',$full_name);

    $query=$this->db->get();

    return $query->row();

  

  } 



  public function get_cooperator_info_orig_amd($full_name){

    // $cooperator_id = $this->security->xss_clean($cooperator_id);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyDesc," ",refcitymun.citymunDesc," ",refprovince.provDesc," ",refregion.regDesc) AS full_address,amendment_cooperators.full_name');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->like('amendment_cooperators.full_name',$full_name);

    $query=$this->db->get();

    return $query->row();

  

  } 



  public function check_if_exist_orig_coop($full_name,$cooperative_id)

  {

    $data = false;

    $query = $this->db->query("select full_name from cooperators where cooperatives_id = '$cooperative_id' and full_name like '%".$full_name."%'");

    if($query->num_rows()>0)

    {

      $data = true;

    }

    return $data;

  }



  public function has_new_amendment_cptr($amendment_id,$type_of_member)

  {

    $data = false;

    $query = $this->db->query("select * from amendment_cooperators where amendment_id = '$amendment_id' and type_of_member='$type_of_member' and new =1");

    if($query->num_rows()>0)

    {

      $data = true;

    }

    return $data;



  }

  public function get_cooperator_info_laboratories($cooperator_id){

    $cooperator_id = $this->security->xss_clean($cooperator_id);

    $this->db->select('laboratories_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region, CONCAT(refbrgy.brgyCode," ",refbrgy.brgyDesc," ",refcitymun.citymunCode," ",refcitymun.citymunDesc," ",refprovince.provCode," ",refprovince.provDesc," ",refregion.regCode," ",refregion.regDesc) AS full_address');

    $this->db->from('laboratories_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=laboratories_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode =refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('laboratories_cooperators.id',$cooperator_id);

    $query=$this->db->get();

    return $query->row();

  

  }

  public function get_all_cooperator_of_coop($cooperatives_id,$amendment_id){

      $data = array();

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    /*get cooperators from orig*/

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('amendment_cooperators.amendment_id', $amendment_id);

    $this->db->where('amendment_cooperators.cooperatives_id', $cooperatives_id);

    $this->db->order_by('full_name','asc');

    $query=$this->db->get();

    if($query->num_rows()>0) {

        foreach($query->result_array() as $key => $row){

            $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

            $this->db->from('amendment_cooperators');

            $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

            $this->db->where('cooperatives_id', $cooperatives_id);

            $this->db->where('amendment_id', $amendment_id);

            $this->db->order_by('full_name','asc');

            $query2 = $this->db->get();

            if($query2->num_rows()>0) {

                $row2 = $query2->row_array();

                $data[$key] = $row2; 

            } else {

                $data[$key] = $row;

            }

        }

    }

    /*get new records from amendment*/

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('cooperatives_id', $cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    // $this->db->where("CHAR_LENGTH(orig_cooperator_id)=0 OR orig_cooperator_id IS NULL");

    $this->db->order_by('full_name','asc');

    $query_new = $this->db->get();

    if($query_new->num_rows()>0) {

        foreach($query_new->result_array() as $rownew) {

            $data2[] = $rownew;

        }

    }

    // $this->last_query = $this->db->last_query();

//    $data = $query->result_array();

    return $data2;

  }

  public function get_chairperson_of_coop($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position'=>'Chairperson'));

    $data = $query->row();

    return $data;

  }

  public function get_all_board_of_director_only($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position'=>'Board of Director'));

    $data = $query->result_array();

    return  $data;

  }

  public function get_vicechairperson_of_coop($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position'=>'Vice-Chairperson'));

    $data = $query->row();

    return $data;

  }

  public function get_treasurer_of_coop($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position'=>'Treasurer'));

    $data = $query->row();

    return $data;

  }

  public function get_all_cooperator_of_coop_for_committee($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->order_by('full_name','asc');

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position !=' => 'Chairperson','type_of_member !=' => 'Associate'));

    $data = $query->result_array();

    return $data;

  }



  public function get_all_cooperator_of_coop_for_committee2($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $get_committee = $this->db->query("select amendment_cooperators_id from amendment_committees where amendment_id='$amendment_id'");

    if($get_committee->num_rows()>0)

    {

      foreach($get_committee->result_array() as $ssrow)

      {

        $committee_id_list[] = $ssrow['amendment_cooperators_id'];

      }

    }

    else

    {

       $committee_id_list = NULL;

    }

    $this->db->order_by('full_name','asc');

    $this->db->where_not_in('id',  $committee_id_list);

    // return  $committee_id_list;

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'position !=' => 'Chairperson','type_of_member !=' => 'Associate'));

    $data = $query->result_array();

    return $data;

  }



  public function get_all_cooperator_of_bods($amendment_id){

   $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');

    $this->db->from('amendment_cooperators');

    $this->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');

    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');

    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');

    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');

    $this->db->where('position IN ("Chairperson", "Vice-Chairperson", "Board of Director") AND amendment_id =', $amendment_id);

    $this->db->order_by('full_name','asc');

    $query=$this->db->get();

  $this->last_query = $this->db->last_query();

    $data = $query->result_array();

    return $data;

  }



  public function no_of_directors($cooperatives_id,$amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    return $this->db->count_all_results();

  }

  public function get_total_number_of_cooperators($amendment_id){

   $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->from('amendment_cooperators');

    return $this->db->count_all_results();

  }

  public function get_prev_total_number_of_cooperators($amendment_id,$regNo){

   $amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->query("select (ac.regular_members + ac.associate_members) as total_previous_cooperators from amend_coop as amd 

left join amendment_capitalization as ac ON amd.id = ac.amendment_id 

where amd.regNo ='$regNo' and amd.id <> '$amendment_id' and amd.status =15");

    $data = 0;

    if($query->num_rows()>0)

    {

      foreach($query->result() as $row)

      {

        $data = $row->total_previous_cooperators;

      }

    }

    return $data;

  }

  public function check_no_of_directors($cooperatives_id,$amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()>=5 && $this->db->count_all_results()<=15){

      return true;

    }else{

      return false;

    }

  }

  public function check_chairperson($cooperatives_id,$amendment_id){

    $position = array('Chairperson');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()==1){

      return true;

    }else{

      return false;

    }

  }

  public function check_vicechairperson($cooperatives_id,$amendment_id){

    $position = array('Vice-Chairperson');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

      $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()==1){

      return true;

    }else{

      return false;

    }

  }

  public function check_treasurer($cooperatives_id,$amendment_id){

    $position = array('Treasurer');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

      $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()==1){

      return true;

    }else{

      return false;

    }

  }

  public function check_secretary($cooperatives_id,$amendment_id){

    $position = array('Secretary');

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $this->db->where('cooperatives_id',$cooperatives_id);

      $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()==1){

      return true;

    }else{

      return false;

    }

  }

  public function ten_percent($amendment_id){

    //get total of number of subscribe share cooperators and multiply by 10 percent

    //and get total number of subscribe in capitalization

    $res = $this->db->query("select sum(amendment_cooperators.number_of_subscribed_shares) * .1 as total_cooperator_subscribe,

(select amendment_capitalization.total_no_of_subscribed_capital from amendment_capitalization where amendment_capitalization.amendment_id ='$amendment_id') * .1 as cap_subscribe_capital 

from amendment_cooperators where amendment_cooperators.amendment_id ='$amendment_id'

");

    if ($res->num_rows()>0)

    {

      foreach($res->result() as $row)

      {

       

        if(number_format($row->total_cooperator_subscribe,2) < number_format($row->cap_subscribe_capital,2))

        {

          // return $row->total_cooperator_subscribe.' : '.$row->cap_subscribe_capital;

          return false;

        }

        else

        {

          return true;

        }

      }

    }

  }



  public function is_requirements_complete($cooperatives_id,$amendment_id){

    if($this->check_no_of_directors($cooperatives_id,$amendment_id))

    {  

      if($this->check_chairperson($cooperatives_id,$amendment_id))

      { //return true; 

        if($this->check_vicechairperson($cooperatives_id,$amendment_id))

        { //return true;

          if($this->check_treasurer($cooperatives_id,$amendment_id))

          {  //return true;

            if($this->check_secretary($cooperatives_id,$amendment_id))

            { 

              if($this->check_directors_odd_number($cooperatives_id,$amendment_id))

              { 



                if($this->ten_percent($amendment_id))

                {

                  if($this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id)->kinds_of_members==1){



                      if($this->check_associate_not_exists($cooperatives_id,$amendment_id))

                      {//  return true;

                        if($this->check_all_minimum_regular_subscription($amendment_id))

                        {

                          if($this->check_all_minimum_regular_pay($cooperatives_id,$amendment_id))

                          {

                            if($this->check_regular_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id,$amendment_id)))

                            {

                              if($this->check_equal_shares($amendment_id))

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

                          else

                          {

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

                  else

                  { 

                      if($this->check_all_minimum_regular_subscription($amendment_id)){

                          if($this->check_all_minimum_regular_pay($cooperatives_id,$amendment_id))

                          {

                            if( $this->check_all_minimum_associate_subscription($cooperatives_id,$amendment_id))

                            {

                              if($this->check_all_minimum_associate_pay($cooperatives_id,$amendment_id))

                              {

                                if($this->check_with_associate_total_shares_paid_is_correct($this->get_total_regular($cooperatives_id,$amendment_id),$this->get_total_associate($cooperatives_id,$amendment_id))){

                                   if($this->check_equal_shares($amendment_id)) //modified

                                   {

                                      $count_associate =$this->get_all_cooperator_of_coop_associate_count($amendment_id);

                                      $capitalization_info = $this->get_capitalization_info($amendment_id);

                                      if($count_associate < $capitalization_info->associate_members)

                                      {

                                        return false;

                                      }

                                      else

                                      {

                                        return true;

                                      }

                                    }

                                }else{

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



              } //end  

            }

            else

            {

              return false; 

            }//end of secreatary    

          }

          else

          {

            return false;

          }        

        }

        else

        {

          return false;

        } //end of vice chairperson         

      }

      else

      {

        return false;

      } //end check_chairperson();          

    }else{

      return false;

    }

  }

  //modified



  public function get_capitalization_info($amendment_id){

    

     $data_amendment_id = $this->security->xss_clean($amendment_id);

    $query = $this->db->get_where('amendment_capitalization',array('amendment_id'=>$data_amendment_id));

    return $query->row();

  }



  public function check_equal_shares($amendment_id)

  {

    $query= $this->db->query("select cap.id, cap.total_no_of_subscribed_capital as cap_total_subscribed_capital,cap.total_no_of_paid_up_capital as cap_total_paidup_capital,

sum(amendment_cooperators.number_of_subscribed_shares) as coop_total_subscribed_shares,

sum(amendment_cooperators.number_of_paid_up_shares) as coop_total_paid_up

from amendment_capitalization as cap

left join amendment_cooperators on cap.amendment_id = amendment_cooperators.amendment_id

 where cap.amendment_id='$amendment_id' group by cap.id");

    if($query->num_rows()>0)

    {

      foreach($query->result_array() as $row)

      {

        if($row['cap_total_subscribed_capital']==$row['coop_total_subscribed_shares'] && $row['cap_total_paidup_capital']==$row['coop_total_paid_up'])

        {

          return true;

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

  public function check_all_minimum_regular_subscription($amendment_id){
      $this->load->model('amendment_capitalization_model');
    $amendment_id = $this->security->xss_clean($amendment_id);

    // $temp = $this->bylaw_model->get_bylaw_by_coop_id($cooperatives_id,$amendment_id)->regular_percentage_shares_subscription;

     $temp = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id)->minimum_subscribed_share_regular;



    // $this->db->where(array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id,'type_of_member'=>'Regular'));

    // $this->db->where('number_of_subscribed_shares <', $temp);

    // $this->db->from('amendment_cooperators');



    $query  = $this->db->query("SELECT number_of_subscribed_shares FROM amendment_cooperators WHERE amendment_id ='$amendment_id' AND type_of_member='Regular' AND number_of_subscribed_shares < '$temp' AND new =1");

    // return $this->db->last_query();

    if($query->num_rows()==0){ 

      return true;

    }else{

      return false;

    }

  }

  public function check_all_minimum_regular_pay($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $temp = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id)->minimum_paid_up_share_regular;

    // $this->db->where(array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id,'type_of_member'=>'Regular'));

    // $this->db->where('number_of_paid_up_shares <', $temp);

    // $this->db->from('amendment_cooperators');

    // if($this->db->count_all_results()==0){

    //   return true;

    // }else{

    //   return false;

    // }

    $query  = $this->db->query("SELECT number_of_paid_up_shares FROM amendment_cooperators WHERE cooperatives_id='$cooperatives_id' AND amendment_id ='$amendment_id' AND type_of_member='Regular' AND number_of_paid_up_shares < '$temp' AND new =1");

    // return $this->db->last_query();

    if($query->num_rows()==0){ 

      return true;

    }else{

      return false;

    }

  }

  public function check_all_minimum_associate_subscription($amendment_id){

    // $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->select("minimum_subscribed_share_associate");

    $this->db->from('amendment_capitalization');

    $this->db->where(array('amendment_id'=>$amendment_id));

    $qry= $this->db->get();

    $temp =0;

    if($qry->num_rows()==1);

    {

     foreach($qry->result() as $row)

     {

      $temp = $row->minimum_subscribed_share_associate;

     }

    }



    $query = $this->db->query("SELECT * FROM amendment_cooperators WHERE amendment_id='$amendment_id' AND type_of_member='Associate' AND number_of_subscribed_shares < '$temp' AND new =1");

    // if($this->db->count_all_results()==0){

    if($query->num_rows()==0){

      return true;

    }else{

      return false;

    }

  }

  public function check_all_minimum_associate_pay($cooperatives_id,$amendment_id){

    $cooperatives_id = $this->security->xss_clean($cooperatives_id);

    $amendment_id = $this->security->xss_clean($amendment_id);



    $temp =  $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id)->minimum_paid_up_share_associate;

    if($temp == 0 || $temp==NULL)

    {

      $temp=0;

    }

    $this->db->where(array('amendment_id'=>$amendment_id,'type_of_member'=>'Associate'));

    $this->db->where('number_of_paid_up_shares <', $temp);

    $this->db->where(array('new'=>1));//new added to apply only for new members

    $this->db->from('amendment_cooperators');

    if($this->db->count_all_results()==0){

      return true;

    }else{

      return false;

    }

  }

  public function get_list_of_directors($amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

   $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $query = $this->db->get('amendment_cooperators');

    $data = $query->result_array();

    return $data;

  }

  public function get_total_regular_amendment($cooperative_id,$amendment_id)

  {

     $query = $this->db->get_where('amendment_cooperators',array('cooperatives_id'=>$cooperative_id,'amendment_id' => $amendment_id,'type_of_member'=>'Regular'));

     return $query->num_rows();

  }

  public function get_total_regular($cooperative_id,$amendment_id){

    $cooperative_id = $this->security->xss_clean($cooperative_id);

    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');

    $query = $this->db->get_where('amendment_cooperators',array('cooperatives_id'=>$cooperative_id,'amendment_id' => $amendment_id,'type_of_member'=>'Regular'));

    $data = $query->row();

    $query2 = $this->db->get_where('amendment_capitalization',array('cooperatives_id' => $cooperative_id,'amendment_id'=>$amendment_id));

    $article = $query2->row();

    $totalSubscribed = 0;

    $totalPaid = 0;

    $totalSubscribed = $data->total_subscribed;

    $totalPaid = $data->total_paid;

    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);

  }

  // public function get_total_associate($cooperatives_id){

  //   $cooperatives_id = $this->security->xss_clean($cooperatives_id);

  //   $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');

  //   $query = $this->db->get_where('amendment_cooperators',array('cooperatives_id' => $cooperatives_id,'type_of_member'=>'Associate'));

  //   $data = $query->row();

  //   $query2 = $this->db->get_where('articles_of_cooperation',array('cooperatives_id' => $cooperatives_id));

  //   $article = $query2->row();

  //   $totalSubscribed = 0;

  //   $totalPaid = 0;

  //   $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;

  //   $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;

  //   return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);

  // }

  public function get_all_regular_cooperator_of_coop($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    // $this->db->order_by('full_name','asc');

    $this->db->where(array('amendment_id' => $amendment_id,'type_of_member'=>'Regular'));

    // $this->db->order_by('full_name','asc');

    $query= $this->db->get('amendment_cooperators');

    $data = $query->result_array();

    return $data;

  }



  public function new_regular_cooperator($amendment_id)

  {

    $query = $this->db->query("select  ac.full_name,ac.number_of_subscribed_shares,ac.number_of_paid_up_shares,

 cc.full_name as orig_full_name, cc.number_of_subscribed_shares as orig_number_of_subscribed_shares,

 cc.number_of_paid_up_shares as orig_number_of_paid_up_shares

 from amendment_cooperators as ac 

left join cooperators as cc on ac.full_name like  cc.full_name

where ac.amendment_id = '$amendment_id' and ac.type_of_member='Regular' order by ac.full_name asc");

    return $query->result_array();

  }

  public function get_all_regular_cooperator_of_coop_orig($cooperative_id){

    $cooperative_id = $this->security->xss_clean($cooperative_id);

    // $this->db->order_by('full_name','asc');

    $this->db->where(array('cooperatives_id' => $cooperative_id,'type_of_member'=>'Regular'));

    // $this->db->order_by('full_name','asc');

    $query  = $this->db->get('cooperators');

    $data = $query->result_array();

    return $data;

  }

  public function get_all_associate_cooperator_of_coop($amendment_id){

    $amendment_id = $this->security->xss_clean($amendment_id);

    $this->db->order_by('full_name','asc');

    $query = $this->db->get_where('amendment_cooperators',array('amendment_id' => $amendment_id,'type_of_member'=>'Associate'));

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

  public function check_associate_not_exists($cooperatives_id,$amendment_id){

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where('type_of_member', "Associate");

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count==0){

      return true;

    }else{

      return false;

    }

  }

  public function check_position_not_exists($cooperatives_id,$amendment_id,$position){

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where('position', $position);

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count==0){

      return true;

    }else{

      return false;

    }

  }

  public function check_directors_not_max($cooperatives_id,$amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count<15){

      return true;

    }else{

      return false;

    }

  }

  public function check_directors_odd_number($cooperatives_id,$amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

    $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count%2==1){

      return true;

    }else{

      return false;

    }

  }

  public function check_directors_odd_number_amendment($amendment_id){

    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');

    // $this->db->where('cooperatives_id',$cooperatives_id);

    $this->db->where('amendment_id',$amendment_id);

    $this->db->where_in('position', $position);

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count%2==1){

      return true;

    }else{

      return false;

    }

  }

  public function check_cooperator_in_cooperative($cooperatives_id,$amendment_id,$cooperator_id){

    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'amendment_id'=>$amendment_id,'id'=>$cooperator_id));

    $this->db->from('amendment_cooperators');

    $count = $this->db->count_all_results();

    if($count>0){

      return true;

    }else{

      return false;

    }

  }

  public function check_cooperator_in_cooperative_laboratories($cooperatives_id,$cooperator_id){

    $this->db->where(array('cooperatives_id'=>$cooperatives_id,'id'=>$cooperator_id));

    $this->db->from('laboratories_cooperators');

    $count = $this->db->count_all_results();

    if($count>0){

      return true;

    }else{

      return false;

    }

  }

  public function get_all_cooperator_of_coop_laboratories($cooperatives_id){

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



  public function get_last_amount_share_coop($cooperator_name)

  {

    $data =null;

    $query = $this->db->query("select number_of_subscribed_shares,number_of_paid_up_shares from cooperators where full_name like '%$cooperator_name%'");

    if($query->num_rows()>0)

    {

      $data =$query->row();

    }

    return $data;

  }



  public function get_last_amount_share_amd($cooperator_name,$amendment_id)

  {

     $data =null;

    $query = $this->db->query("select number_of_subscribed_shares,number_of_paid_up_shares from amendment_cooperators cooperators where full_name like '%$cooperator_name%' and amendment_id ='$amendment_id'");

    if($query->num_rows()>0)

    {

      $data = $query->row();

    }

    return $data;

  }

}

