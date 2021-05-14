<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unioncoop extends CI_Controller{

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
                    $data['title'] = 'List of Federation';
                    $data['header'] = 'Affiliates';
                    $data['encrypted_id'] = $id;
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    // $data['requirements_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
                    $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                    $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                    $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
                    $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
//                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
//                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
//                    $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
//                    $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
                    // $data['minimum_regular_subscription'] = $capitalization_info->minimum_subscribed_share_regular;
                    // $data['minimum_regular_pay'] = $capitalization_info->minimum_paid_up_share_regular;
                    // $data['minimum_associate_subscription'] = $capitalization_info->minimum_subscribed_share_associate;
                    // $data['minimum_associate_pay'] = $capitalization_info->minimum_paid_up_share_associate;
                    $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                    $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
                    $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
                    $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                    $data['list_cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                    $data['list_cooperators_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
//                    $data['list_cooperators_count'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_count($decoded_id);
                    $data['list_cooperators_associate'] = $this->cooperator_model->get_all_cooperator_of_coop_associate($decoded_id);
                    $data['ten_percent'] = $this->cooperator_model->ten_percent($decoded_id);
                    $data['registered_coop'] = $this->unioncoop_model->get_registered_fed_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                    $data['applied_coop'] = $this->unioncoop_model->get_applied_coop($user_id);
                    $this->load->view('./template/header', $data);
                    $this->load->view('union/union_list', $data);
                    $this->load->view('federation/full_info_modal_registeredcoop');
                    $this->load->view('union/add_form_affiliates');
                    $this->load->view('union/edit_form_cooperator');
                    $this->load->view('union/delete_form_affiliates');
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
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Members';
                        $data['header'] = 'List of Members';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['registered_coop'] = $this->affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $capitalization_info = $data['capitalization_info'];
                        $data['requirements_complete'] = $this->unioncoop_model->is_requirements_complete($data['coop_info']->users_id);
//                        $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
//                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                        $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
//                        $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
//                        $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
                        $capitalization_info = $data['capitalization_info'];
                        $data['applied_coop'] = $this->unioncoop_model->get_applied_coop($data['coop_info']->users_id);
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
                        $this->load->view('union/union_list', $data);
                        $this->load->view('federation/full_info_modal_registeredcoop');
                        $this->load->view('federation/add_form_cooperator');
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

    function add_affiliates($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        $query = $this->unioncoop_model->existing_unioncoop($user_id,$this->input->post('regNo'));
        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
        $encrypted_post_coop_id = $this->input->post('cooperativesID');
        if($query==0){
            $data = array(
              'registeredcoop_id' => $this->input->post('registered_id'),
              'regNo' => $this->input->post('regNo'),
              'coopName' => $this->input->post('coopName'),
              'application_id' => $this->input->post('applicationid'),
              'representative' => $this->input->post('fName'),
              'user_id' => $user_id, 
              );
            $success = $this->unioncoop_model->add_unioncoop($data);
            if(!$success){
              $this->session->set_flashdata('cooperator_success', 'Cooperative Added.');
                    redirect('cooperatives/'.$encrypted_post_coop_id.'/unioncoop');
            }else{
              $this->session->set_flashdata('cooperator_error', 'Cooperative Failed to Add.');
              redirect('cooperatives/'.$encrypted_post_coop_id.'/unioncoop');
            }
        } else {
//            echo $query;
            $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
                    redirect('cooperatives/'.$encrypted_post_coop_id.'/unioncoop');
        }
    }

    function edit_unioncoop($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        // $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        // $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

        $encryptedcoopid = $this->input->post('cooperativesID');
        $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

        $u_data = array(
            'representative' => $this->input->post('repre'),
          );

        $update_aff = $this->db->update('unioncoop',$u_data,array('id'=>$encrypted_post_coop_id));

        if($update_aff)
        {  
          $this->session->set_flashdata('cooperator_success', 'Affiliator Successfully Updated.');
            redirect('cooperatives/'.$encryptedcoopid.'/unioncoop');
        }else{
          $this->session->set_flashdata('cooperator_success', 'Affiliator failed to Update');
          redirect('cooperatives/'.$encryptedcoopid.'/unioncoop');
        }
    }
    
    function delete_affiliates(){
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
                  $success = $this->unioncoop_model->delete_affiliators($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Affiliator has been remove.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID').'/unioncoop');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to remove affiliator.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID').'/unioncoop');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                  redirect('cooperatives/'.$id);
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
    
}
