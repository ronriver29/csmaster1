<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_staff extends CI_Controller{

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
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['title'] = 'List of Staff';
                              $data['header'] = 'Staff';
                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['encrypted_id'] = $id;
                              $data['manager_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Manager");
                              $data['accountant_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Accountant");
                              $data['bookkeeper_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Bookkeeper");
                              $data['cashier_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Cashier");
                              $data['collector_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Collector");
                              $data['sales_clerk_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Sales clerk");
                              $data['requirements_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              $data['staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop($decoded_id);
                              $this->load->view('./template/header', $data);
                              $this->load->view('staff/amendment_staff_list', $data);
                              $this->load->view('staff/amendment_delete_modal_staff');
                              $this->load->view('./template/footer');
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
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
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                              if($data['economic_survey_complete']){
                                $data['title'] = 'List of Staff';
                                $data['header'] = 'Staff';
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                $data['encrypted_id'] = $id;
                                $data['manager_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Manager");
                                $data['accountant_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Accountant");
                                $data['bookkeeper_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Bookkeeper");
                                $data['cashier_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Cashier");
                                $data['collector_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Collector");
                                $data['sales_clerk_not_exists'] = $this->amendment_staff_model->check_position_not_exists($decoded_id,"Sales clerk");
                                $data['requirements_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                                $data['staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop($decoded_id);
                                $this->load->view('templates/admin_header', $data);
                                $this->load->view('staff/staff_list', $data);
                                $this->load->view('staff/amendment_delete_modal_staff');
                                $this->load->view('templates/admin_footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('amendment/'.$id);
                      }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the Economic Survey of the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                          if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                if(isset($_POST['addStaffBtn'])){
                                  $temp = TRUE;
                                } else {
                                  $temp = FALSE;
                                }
                                if($temp == FALSE){
                                  $data['title'] = 'Staff';
                                  $data['header'] = 'Staff';
                                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('./template/header', $data);
                                  $this->load->view('staff/amendment_add_form_staff', $data);
                                  $this->load->view('./template/footer');
                                }else{
                                  $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                                  $data = array(
                                    'cooperatives_id' => $decoded_post_coop_id,
                                    'full_name' => $this->input->post('fName'),
                                    'gender' => $this->input->post('gender'),
                                    'position' => $this->input->post('position'),
                                    'position_others' => $this->input->post('staffPositionSpecify'),
                                    'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                    'birth_date' => $this->input->post('bDate'),
                                    'postal_address' => $this->input->post('pAddress'),
                                    'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                    'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                    );
                                  $success = $this->amendment_staff_model->add_staff($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('staff_success', $success['message']);
                                    redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                  }else{
                                    $this->session->set_flashdata('staff_error', $success['message']);
                                    redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
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
            redirect('cooperatives');
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
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                            if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete']){
                                if($this->form_validation->run() == FALSE){
                                  $data['title'] = 'Staff';
                                  $data['header'] = 'Staff';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('./templates/admin_header', $data);
                                  $this->load->view('staff/amendment_add_form_staff', $data);
                                  $this->load->view('./templates/admin_footer');
                                }else{
                                  $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                                  $data = array(
                                    'cooperatives_id' => $decoded_post_coop_id,
                                    'full_name' => $this->input->post('fName'),
                                    'gender' => $this->input->post('gender'),
                                    'position' => $this->input->post('position'),
                                    'position_others' => $this->input->post('staffPositionSpecify'),
                                    'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                    'birth_date' => $this->input->post('bDate'),
                                    'postal_address' => $this->input->post('pAddress'),
                                    'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                    'monthly_compensation' =>$this->input->post('monthlyCompensation')
                                    );
                                  $success = $this->amendment_staff_model->add_staff($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('staff_success', $success['message']);
                                    redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                  }else{
                                    $this->session->set_flashdata('staff_error', $success['message']);
                                    redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('amendment/'.$id);
                      }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('amendment/'.$id);
                  }
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Adding staff to the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
  function edit($id = null,$staff_id = null){
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
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                          if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
                              $decoded_staff_id = $this->encryption->decrypt(decrypt_custom($staff_id));
                              if($this->amendment_staff_model->check_staff_in_cooperative($decoded_id,$decoded_staff_id)){ //check if staff is in cooperative
                                if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                  if(isset($_POST['editStaffBtn'])){
                                    $temp = TRUE;
                                  } else {
                                    $temp = FALSE;
                                  }
                                  if($temp == FALSE){
                                    $data['title'] = 'Staff';
                                    $data['header'] = 'Staff';
                                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                                    $data['encrypted_id'] = $id;
                                    $data['encrypted_staff_id'] = $staff_id;
                                    $data['staff_info'] = $this->amendment_staff_model->get_staff_info($decoded_staff_id);
                                    $this->load->view('./template/header', $data);
                                    $this->load->view('staff/amendment_edit_form_staff', $data);
                                    $this->load->view('./template/footer');
                                  }else{
                                    $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                                    $data = array(
                                      'full_name' => $this->input->post('fName'),
                                      'gender' => $this->input->post('gender'),
                                      'position' => $this->input->post('position'),
                                      'position_others' => $this->input->post('staffPositionSpecify'),
                                      'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                      'birth_date' => $this->input->post('bDate'),
                                      'postal_address' => $this->input->post('pAddress'),
                                      'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                      'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                      );
                                    $success = $this->amendment_staff_model->edit_staff($decoded_post_staff_id,$data);
                                    if($success['success']){
                                      $this->session->set_flashdata('staff_success', $success['message']);
                                      redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                    }else{
                                      $this->session->set_flashdata('staff_error', $success['message']);
                                      redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                    }
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                  redirect('amendment/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                                redirect('amendment/'.$id.'/staff');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
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
                        $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                              if($data['committees_complete']){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete']){
                                  $decoded_staff_id = $this->encryption->decrypt(decrypt_custom($staff_id));
                                  if($this->amendment_staff_model->check_staff_in_cooperative($decoded_id,$decoded_staff_id)){ //check if staff is in cooperative
                                    if($this->form_validation->run() == FALSE){
                                      $data['title'] = 'Staff';
                                      $data['header'] = 'Staff';
                                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                      $data['encrypted_id'] = $id;
                                      $data['encrypted_staff_id'] = $staff_id;
                                      $data['staff_info'] = $this->amendment_staff_model->get_staff_info($decoded_staff_id);
                                      $this->load->view('./templates/admin_header', $data);
                                      $this->load->view('staff/amendment_edit_form_staff', $data);
                                      $this->load->view('./templates/admin_footer');
                                    }else{
                                      $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                                      $data = array(
                                        'full_name' => $this->input->post('fName'),
                                        'gender' => $this->input->post('gender'),
                                        'position' => $this->input->post('position'),
                                        'position_others' => $this->input->post('staffPositionSpecify'),
                                        'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                        'birth_date' => $this->input->post('bDate'),
                                        'postal_address' => $this->input->post('pAddress'),
                                        'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                        'monthly_compensation' =>$this->input->post('monthlyCompensation')
                                        );
                                      $success = $this->amendment_staff_model->edit_staff($decoded_post_staff_id,$data);
                                      if($success['success']){
                                        $this->session->set_flashdata('staff_success', $success['message']);
                                        redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                      }else{
                                        $this->session->set_flashdata('staff_error', $success['message']);
                                        redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_staff');
                                      }
                                    }
                                  }else{
                                    $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                                    redirect('amendment/'.$id.'/amendment_staff');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                  redirect('amendment/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                          redirect('amendment/'.$id);
                        }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Editing staff of the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
  function delete_staff(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteStaffBtn')){

          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
                $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                if($this->amendment_staff_model->check_staff_in_cooperative($decoded_id,$decoded_post_staff_id)){
                  if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                    $success = $this->amendment_staff_model->delete_staff($decoded_post_staff_id);
                    if($success){
                      $this->session->set_flashdata('delete_staff_success', 'Staff has been deleted.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
                    }else{
                      $this->session->set_flashdata('delete_staff_error', 'Unable to delete staff.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                  redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
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
                $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                if($this->amendment_staff_model->check_staff_in_cooperative($decoded_id,$decoded_post_staff_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                    if($this->amendment_model->check_first_evaluated($decoded_id)){
                      $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                      redirect('amendment');
                    }else{
                      $success = $this->amendment_staff_model->delete_staff($decoded_post_staff_id);
                      if($success){
                        $this->session->set_flashdata('delete_staff_success', 'Staff has been deleted.');
                        redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
                      }else{
                        $this->session->set_flashdata('delete_staff_error', 'Unable to delete staff.');
                        redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
                      }
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'Deleting staff of the cooperative are not avaiable because it is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                  redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_staff');
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
}
