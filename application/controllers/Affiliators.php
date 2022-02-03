<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliators extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                if($data['capitalization_complete']){
                    $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Members';
                    $data['header'] = 'List of Members';
                    $data['encrypted_id'] = $id;
                    // $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    // $capitalization_info = $data['capitalization_info'];
                    $data['requirements_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$user_id);
                    $data['directors_count'] = $this->affiliators_model->check_no_of_directors($user_id);
                    $data['directors_count_odd'] = $this->affiliators_model->check_directors_odd_number($user_id);
                    $data['total_directors'] = $this->affiliators_model->no_of_directors($user_id);
                    $data['chairperson_count'] = $this->affiliators_model->check_chairperson($user_id);
                    $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
//                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
//                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
//                    $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
//                    $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
                    $data['minimum_regular_subscription'] = $capitalization_info->minimum_subscribed_share_regular;
                    $data['minimum_regular_pay'] = $capitalization_info->minimum_paid_up_share_regular;
                    $data['minimum_associate_subscription'] = $capitalization_info->minimum_subscribed_share_associate;
                    $data['minimum_associate_pay'] = $capitalization_info->minimum_paid_up_share_associate;
                    $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                    $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->affiliators_model->check_vicechairperson($user_id);
                    $data['treasurer_count'] = $this->affiliators_model->check_treasurer($user_id);
                    $data['secretary_count'] = $this->affiliators_model->check_secretary($user_id);
                    $data['list_cooperators'] = $this->affiliators_model->get_all_cooperator_of_coop($user_id);
                    
                    $data['list_cooperators_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
//                    $data['list_cooperators_count'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_count($decoded_id);
                    $data['list_cooperators_associate'] = $this->cooperator_model->get_all_cooperator_of_coop_associate($decoded_id);
                    $data['ten_percent'] = $this->cooperator_model->ten_percent($decoded_id);
                    if($data['coop_info']->category_of_cooperative == 'Tertiary'){
                      $data['registered_coop'] = $this->affiliators_model->get_registered_coop_secondary($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                    } else {
                      $data['registered_coop'] = $this->affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                    }
                    $data['user_id'] = $this->encryption->encrypt(encrypt_custom($user_id));
                    $data['applied_coop'] = $this->affiliators_model->get_applied_coop($user_id);
                    $data['applied_coop_count'] = count($this->affiliators_model->get_applied_coop($user_id));
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $data['list_affiliators'] = $this->affiliators_model->get_all_affiliators_of_coop($user_id);
                    $data['affiliator_info'] = $this->affiliators_model->get_affiliator_info($user_id);

                    $this->load->view('./template/header', $data);
                    $this->load->view('federation/affiliators_list', $data);
                    $this->load->view('federation/full_info_modal_registeredcoop');
                    $this->load->view('federation/add_form_cooperator', $data);
                    $this->load->view('federation/edit_form_cooperator', $data);
                    $this->load->view('federation/delete_form_cooperator');
                    $this->load->view('./template/footer');
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your capitalization additional information.');
                  redirect('cooperatives/'.$id);
                }
              }else{
                redirect('cooperatives/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                  $data['is_client'] = $this->session->userdata('client');
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Affiliators';
                        $data['header'] = 'Affiliators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['registered_coop'] = $this->affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                        $data['requirements_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$user_id);
//                        $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
//                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                        $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
//                        $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
//                        $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
                        $capitalization_info = $data['capitalization_info'];
                        $data['applied_coop'] = $this->affiliators_model->get_applied_coop($data['coop_info']->users_id);
    //                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
    //                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
    //                    $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
    //                    $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
//                        $data['minimum_regular_subscription'] = $capitalization_info->minimum_subscribed_share_regular;
//                        $data['minimum_regular_pay'] = $capitalization_info->minimum_paid_up_share_regular;
//                        $data['minimum_associate_subscription'] = $capitalization_info->minimum_subscribed_share_associate;
//                        $data['minimum_associate_pay'] = $capitalization_info->minimum_paid_up_share_associate;
                        $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                        $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
//                        $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
//                        $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
//                        $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                        $data['list_cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                        $data['list_cooperators_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                        $data['list_cooperators_count'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_count($decoded_id);
                        $data['list_cooperators_associate'] = $this->cooperator_model->get_all_cooperator_of_coop_associate($decoded_id);
                        $data['ten_percent']=$this->cooperator_model->ten_percent($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('federation/affiliators_list', $data);
                        $this->load->view('federation/full_info_modal_registeredcoop');
                        $this->load->view('federation/add_form_cooperator');
                        $this->load->view('federation/edit_form_cooperator');
                        $this->load->view('federation/delete_form_cooperator');
                        $this->load->view('./template/footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the capitalization additional information.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
}

    function add_affiliators($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
        $encrypted_post_coop_id = $this->input->post('cooperativesID');

        if(!empty($this->input->post('position'))){
              $position = implode(", ",$this->input->post('position'));
              // $regions = implode(", ",$this->input->post('regions'));
            } else {
              $position = '';
              // $regions = '';
            }

        $this->db->where('user_id',$user_id);
        // $this->db->where('position', $this->input->post('position'));
        $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
        $this->db->from('affiliators');
        // $count = $this->db->count_all_results();
        $query_aff = $this->db->get();
        $data_aff = $query_aff->result_array();

        foreach($data_aff as $row_aff){
          $aff_results[] = $row_aff['position'];
        }
        if (in_array($position, $aff_results)) {
          $found = 'found' ;
        } else {
          $found = '';
        }
        // print_r($sample_results);
        if($found=='found'){
          $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            redirect('cooperatives/'.$encrypted_post_coop_id.'/affiliators');
        } else {
          if($query==0){
            
              $data = array(
                'registeredcoop_id' => $this->input->post('registered_id'),
                'regNo' => $this->input->post('regNo'),
                'coopName' => $this->input->post('coopName'),
                'application_id' => $this->input->post('applicationid'),
                'cooperatives_id' => $decoded_post_coop_id,
                'number_of_subscribed_shares' => $this->input->post('subscribedShares'),
                'number_of_paid_up_shares' => $this->input->post('paidShares'),
                'representative' => $this->input->post('representative'),
                'position' => $position,
                'proof_of_identity' => $this->input->post('validIdType'),
                'valid_id' => $this->input->post('validIdNo'),
                'date_issued' => date('Y-m-d',strtotime($this->input->post('dateIssued'))),
                'place_of_issuance' => $this->input->post('placeIssuance'),
                'user_id' => $user_id, 
                );
              $success = $this->affiliators_model->add_affiliators($data);
              if($success){
                  echo $query;
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added.');
                      redirect('cooperatives/'.$encrypted_post_coop_id.'/affiliators');
              }else{
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added');
                redirect('cooperatives/'.$encrypted_post_coop_id.'/affiliators');
              }
          } else {
  //            echo $query;
              $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
                      redirect('cooperatives/'.$encrypted_post_coop_id.'/affiliators');
          }
        }
    }

    function edit_affiliators($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        // $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        // $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

        $encryptedcoopid = $this->input->post('cooperativesID');
        $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

        $this->db->where('user_id',$user_id);
        $this->db->where('id !=',$encrypted_post_coop_id);
        // $this->db->where('position', $this->input->post('position'));
        $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
        $this->db->from('affiliators');
        // $count = $this->db->count_all_results();
        $query_aff = $this->db->get();
        $data_aff = $query_aff->result_array();

        if(!empty($this->input->post('position'))){
          $position = implode(", ",$this->input->post('position'));
          // $regions = implode(", ",$this->input->post('regions'));
        } else {
          $position = '';
          // $regions = '';
        }
            
        foreach($data_aff as $row_aff){
          $aff_results[] = $row_aff['position'];
        }
        if (in_array($position, $aff_results)) {
          $found = 'found' ;
        } else {
          $found = '';
        }

        if($found=='found'){
          $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            redirect('cooperatives/'.$encryptedcoopid.'/affiliators');
        }

        // $position_exists = $this->db->where('(position LIKE "%Chairperson%") AND id != '.$encrypted_post_coop_id.' AND user_id ='.$user_id.' AND position NOT IN  ("Member","Board of Director")')->get('affiliators');
        // if($position_exists->num_rows()==1){
            // $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            // redirect('cooperatives/'.$encryptedcoopid.'/affiliators');
          // echo $position_exists->num_rows();
        // } 
        else {
          
          $u_data = array(
              'number_of_subscribed_shares'=> $this->input->post('subscribedShares2'),
              'number_of_paid_up_shares'=> $this->input->post('paidShares2'),
              'representative' => $this->input->post('repre'),
              'position' => $position,
              'proof_of_identity' => $this->input->post('validIdType'),
              'valid_id' => $this->input->post('validIdNo'),
              'date_issued' => date('Y-m-d',strtotime($this->input->post('dateIssued'))),
              'place_of_issuance' => $this->input->post('place_of_issuance'),
            );

          $update_aff = $this->db->update('affiliators',$u_data,array('id'=>$encrypted_post_coop_id));

          if($update_aff)
          {  
            $this->session->set_flashdata('cooperator_success', 'Affiliator Successfully Updated.');
              redirect('cooperatives/'.$encryptedcoopid.'/affiliators');
          }else{
            $this->session->set_flashdata('cooperator_success', 'Affiliator failed to Update');
            redirect('cooperatives/'.$encryptedcoopid.'/affiliators');
          }
        }
    }
    
    function delete_cooperator(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteCooperatorBtn')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
//              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->affiliators_model->delete_affiliators($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Affiliator has been remove.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID').'/affiliators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to remove affiliator.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID').'/affiliators');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                  redirect('cooperatives/'.$this->input->post('cooperativeID'));
                }
//              }else{
//                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
//                redirect('affiliator/'.$this->input->post('cooperativeID').'/affliators');
//              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $success = $this->cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                    if($success){
                      $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
                    }else{
                      $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Deleting a cooperator of the cooperative is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
              }
            }
          }
        }else{
          redirect('cooperatives');
        }
      }else{
        redirect('cooperatives');
      }
    }
  }

  // public function check_position_not_exist(){
  //    if(!$this->session->userdata('logged_in')){
  //       redirect('users/login');
  //     }else{
  //       if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
  //         $data = array(
  //           'fieldId'=>$this->input->get('fieldId'),
  //           'fieldValue'=>$this->input->get('fieldValue'),
  //           'cooperativesID'=>$this->input->get('cooperativesID'),
  //         );
  //         $result = $this->affiliators_model->is_position_available($data);
  //         echo json_encode($result);
  //         // echo $this->db->last_query();
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }

  public function check_position_not_exist($user_id,$position){
      // $position = $this->encryption->decrypt(decrypt_custom($position));
      // $position=str_replace('%20',' ',$position);
      $data = $this->affiliators_model->is_position_available($user_id,$position);
      echo json_encode($data);
  }

  // public function check_edit_position_not_exist(){
  //    if(!$this->session->userdata('logged_in')){
  //       redirect('users/login');
  //     }else{
  //       if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
  //         $data = array(
  //           'fieldId'=>$this->input->get('fieldId'),
  //           'fieldValue'=>$this->input->get('fieldValue'),
  //           'cooperatorID'=>$this->input->get('cooperatorID'),
  //           'cooperativesID'=>$this->input->get('cooperativesID')
  //         );
  //         $result = $this->affiliators_model->edit_is_position_available($data);
  //         echo json_encode($result);
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }

  public function check_edit_position_not_exist($user_id,$position,$cooperatorid){
    $data = $this->affiliators_model->edit_is_position_available($user_id,$position,$cooperatorid);
      echo json_encode($data);
  }
    
}
