<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_cooperators extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("amendment_capitalization_model");
    $this->load->model("amendment_cooperator_model");
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
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['requirements_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
                    $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                    $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                    $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
                    $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $count_cap = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id_count($decoded_id);
                    if($count_cap>0){
                        $data['capitalization_info'] = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id($decoded_id);
                    } else {
                        $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    }
                    $capitalization_info = $data['capitalization_info'];
                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
                    $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
                    $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
                    $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                    $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
                    $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
                    $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                    $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                    $data['list_cooperators_count'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular_count($decoded_id);
                    $data['list_cooperators_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate($decoded_id);
                    $data['ten_percent']=$this->cooperator_model->ten_percent($decoded_id);
                    $this->load->view('./template/header', $data);
                    $this->load->view('cooperators/amendment_cooperators_list', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('cooperators/amendment_delete_form_cooperator');
                    $this->load->view('./template/footer');
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['requirements_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                        $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                        $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                        $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
                        $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
                        $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
                        $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
                        $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
                        $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                        $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                        $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
                        $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
                        $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                        $data['list_cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                        $data['ten_percent']=$this->cooperator_model->ten_percent($decoded_id);
                        $data['list_cooperators_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('cooperators/amendment_cooperators_list', $data);
                        $this->load->view('cooperators/full_info_modal_cooperator');
                        $this->load->view('cooperators/amendment_delete_form_cooperator');
                        $this->load->view('./templates/admin_footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }

  function add($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                   // if($this->form_validation->run() == FALSE){
                    if($this->input->post('fName')) {
                        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                      $data = array(
                        'cooperatives_id' => $decoded_post_coop_id,
                        'full_name' => $this->input->post('fName'),
                        'gender' => $this->input->post('gender'),
                        'position' => $this->input->post('position'),
                        'type_of_member' => $this->input->post('membershipType'),
                        'birth_date' => $this->input->post('bDate'),
                        'house_blk_no'=> $this->input->post('blkNo'),
                        'streetName'=> $this->input->post('streetName'),
                        'addrCode' => $this->input->post('barangay'),
                        'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                        'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                        'proof_of_identity' =>$this->input->post('validIdType'),
                        'proof_of_identity_number' =>$this->input->post('validIdNo'),
                        'proof_date_issued' =>$this->input->post('dateIssued'),
                        'place_of_issuance' =>$this->input->post('placeIssuance'),
                        );
                      $success = $this->amendment_cooperator_model->add_cooperator($data);
                      if($success['success']){
                        $this->session->set_flashdata('cooperator_success', $success['message']);
                        redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                      }else{
                        $this->session->set_flashdata('cooperator_error', $success['message']);
                        redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                      }

                    }else{ 
                      $data['client_info'] = $this->user_model->get_user_info($user_id);
                      $data['title'] = 'List of Cooperators';
                      $data['header'] = 'Cooperators';
                      $data['encrypted_id'] = $id;
                      $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                      $data['regions_list'] = $this->region_model->get_regions();

                      $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                      $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                      $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                      $this->load->view('./template/header', $data);
                      $this->load->view('cooperators/amendment_add_form_cooperator', $data);
                      $this->load->view('./template/footer');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      if($this->form_validation->run() == FALSE){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($data['coop_info']->users_id));
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('cooperators/amendment_add_form_cooperator', $data);
                        $this->load->view('./templates/admin_footer');
                      }else{
                        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                        $data = array(
                          'cooperatives_id' => $decoded_post_coop_id,
                          'full_name' => $this->input->post('fName'),
                          'gender' => $this->input->post('gender'),
                          'position' => $this->input->post('position'),
                          'type_of_member' => $this->input->post('membershipType'),
                          'birth_date' => $this->input->post('bDate'),
                          'house_blk_no'=> $this->input->post('blkNo'),
                          'streetName'=> $this->input->post('streetName'),
                          'addrCode' => $this->input->post('barangay'),
                          'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                          'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                          'proof_of_identity' =>$this->input->post('validIdType'),
                          'proof_of_identity_number' =>$this->input->post('validIdNo'),
                          'proof_date_issued' =>$this->input->post('dateIssued'),
                          'place_of_issuance' =>$this->input->post('placeIssuance'),
                          );
                        $success = $this->cooperator_model->add_cooperator($data);
                        if($success['success']){
                          $this->session->set_flashdata('cooperator_success', $success['message']);
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                        }else{
                          $this->session->set_flashdata('cooperator_error', $success['message']);
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Adding cooperator is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }
  function edit($id = null,$cooperator_id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                    if($this->amendment_cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_cooperator_id)){ //check if cooperator is in cooperative
                        if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                          
                          if($this->input->post('cooperativesID')){
//                              exit;
                              $temp = TRUE;
//                              echo '<script>alert("wow");</script>';
                          } else {
                              $temp = FALSE;
//                              echo '<script>alert("www");</script>';
                          }
                          
                        if($temp == FALSE){
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'List of Cooperators';
                          $data['header'] = 'Cooperators';
                          $data['encrypted_id'] = $id;

                          $data['regions_list'] = $this->region_model->get_regions();
                          $data['encrypted_cooperator_id'] = $cooperator_id;
                          $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                          $data['cooperator_info'] = $this->amendment_cooperator_model->get_cooperator_info($decoded_cooperator_id);
                          $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                          $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                          $this->load->view('./template/header', $data);
                          $this->load->view('cooperators/amendment_edit_form_cooperator', $data);
                          $this->load->view('./template/footer');
                        }else{
//                                exit;
                          $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                          $data = array(
                            'full_name' => $this->input->post('fName'),
                            'gender' => $this->input->post('gender'),
                            'position' => $this->input->post('position'),
                            'type_of_member' => $this->input->post('membershipType'),
                            'birth_date' => $this->input->post('bDate'),
                            'house_blk_no'=> $this->input->post('blkNo'),
                            'streetName'=> $this->input->post('streetName'),
                            'addrCode' => $this->input->post('barangay'),
                            'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                            'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                            'proof_of_identity' =>$this->input->post('validIdType'),
                            'proof_of_identity_number' =>$this->input->post('validIdNo'),
                            'proof_date_issued' =>$this->input->post('dateIssued'),
                            'place_of_issuance' =>$this->input->post('placeIssuance'),
                            );
                          $success = $this->cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data);
                          if($success['success']){
                            $this->session->set_flashdata('cooperator_success', $success['message']);
                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                          }else{
                            $this->session->set_flashdata('cooperator_error', $success['message']);
                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                      redirect('amendment/'.$id.'/amendment_cooperators');
                    }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                        $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                        if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_cooperator_id)){
                            if(isset($_POST['editCooperatorBtn'])){
                              $temp = TRUE;
                              echo '<script>alert("wow");</script>';
                          } else {
                              $temp = FALSE;
                              echo '<script>alert("www");</script>';
                          }
                            if($temp == FALSE){
                              $data['title'] = 'List of Cooperators';
                              $data['header'] = 'Cooperators';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_cooperator_id'] = $cooperator_id;
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($decoded_cooperator_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('cooperators/amendment_edit_form_cooperator', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'full_name' => $this->input->post('fName'),
                                'gender' => $this->input->post('gender'),
                                'position' => $this->input->post('position'),
                                'type_of_member' => $this->input->post('membershipType'),
                                'birth_date' => $this->input->post('bDate'),
                                'house_blk_no'=> $this->input->post('blkNo'),
                                'streetName'=> $this->input->post('streetName'),
                                'addrCode' => $this->input->post('barangay'),
                                'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                                'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                                'proof_of_identity' =>$this->input->post('validIdType'),
                                'proof_of_identity_number' =>$this->input->post('validIdNo'),
                                'proof_date_issued' =>$this->input->post('dateIssued'),
                                'place_of_issuance' =>$this->input->post('placeIssuance'),
                                );
                              $success = $this->cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data);
                              if($success['success']){
                                $this->session->set_flashdata('cooperator_success', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                              }else{
                                $this->session->set_flashdata('cooperator_error', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                              }
                            }
                      }else{
                        $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                        redirect('amendment/'.$id.'/amendment_cooperators');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          show_404();
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
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                  redirect('amendment/'.$id);
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $success = $this->cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                    if($success){
                      $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                    }else{
                      $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Deleting a cooperator of the cooperative is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
              }
            }
          }
        }else{
          redirect('amendment');
        }
      }else{
        redirect('amendment');
      }
    }
  }
  function all(){

    if($this->input->method(TRUE)==="GET"){
      redirect('amendment');
    }else if($this->input->method(TRUE)==="POST"){
      $uid = $this->session->userdata('user_id');
      $cooperatives_id = $this->amendment_model->get_cooperative_info($uid)->id;
      $cooperators = $this->amendment_model->get_all_cooperator_of_coop($cooperatives_id);
      $temp['data'] = $cooperators;
      echo json_encode($temp);
    }

  }
  public function check_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperativesID'=>$this->input->get('cooperativesID'),
          );
          $result = $this->cooperator_model->is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  public function check_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperativesID'=>$this->input->get('cooperativesID'),
          );
          $result = $this->cooperator_model->is_position_available($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  public function check_edit_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->input->get('cooperatorID'),
            'cooperativesID'=>$this->input->get('cooperativesID')
          );
          $result = $this->cooperator_model->edit_is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  public function check_edit_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->input->get('cooperatorID'),
            'cooperativesID'=>$this->input->get('cooperativesID')
          );
          $result = $this->cooperator_model->edit_is_position_available($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  function get_post_cooperator_info($id){
    if($this->input->method(TRUE)==="GET"){
      redirect('amendment');
    }else if($this->input->method(TRUE)==="POST"){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
              $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
              echo json_encode($data);
          }else{
            $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
            redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else if($this->session->userdata('access_level')!=1){
            redirect('amendment');
          }else{
            $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
            $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
            echo json_encode($data);
          }
        }
      }else{
        show_404();
      }
    }
  }
  public function get_cooperative_info(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->amendment_model->get_cooperative_info($decoded_user_id,$decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
}
