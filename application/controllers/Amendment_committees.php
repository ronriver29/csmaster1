<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_committees extends CI_Controller{

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
                        $data['gad_count'] = $this->amendment_committee_model->get_all_gad_count($user_id);
                        $data['committees_count_member'] = $this->amendment_committee_model->get_all_committees_count($user_id);
                        $data['client_info'] = $this->user_model->get_user_info($user_id);
                        $data['title'] = 'List of Committees';
                        $data['header'] = 'Committees';
                        $data['encrypted_id'] = $id;
                        $data['committees'] = $this->amendment_committee_model->get_all_committees_of_coop($decoded_id);
                        if(!$data['committees']) {
                            $data['committees'] = $this->committee_model->get_all_committees_of_coop($decoded_id);
                        }
                        $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        if($data['committeescount']==0) {
                            $data['committeescount'] = $this->committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        }
                        $this->load->view('./template/header', $data);
                        $this->load->view('amendment/committees_list', $data);
                        $this->load->view('amendment/delete_modal_committee');
                        $this->load->view('./template/footer');
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
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          $data['gad_count'] = $this->amendment_committee_model->get_all_gad_count($user_id);
                          $data['committees_count_member'] = $this->amendment_committee_model->get_all_committees_count($user_id);
                          $data['title'] = 'List of Committees';
                          $data['header'] = 'Committees';
                          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['committees'] = $this->amendment_committee_model->get_all_committees_of_coop($decoded_id);
                        if(!$data['committees']) {
                            $data['committees'] = $this->committee_model->get_all_committees_of_coop($decoded_id);
                        }
                          $this->load->view('./templates/admin_header', $data);
                          $this->load->view('committees/committees_list', $data);
                          $this->load->view('committees/delete_modal_committee');
                          $this->load->view('./templates/admin_footer');
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
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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
                        if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                            if(isset($_POST['addCommitteeBtn'])){
                                $temp = TRUE;
                            } else {
                                $temp = FALSE;
                            }
                          if($temp == FALSE){
                            $data['client_info'] = $this->user_model->get_user_info($user_id);
                            $data['title'] = 'List of Committees';
                            $data['header'] = 'Committees';
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                            $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                            $this->load->view('./template/header', $data);
                            $this->load->view('amendment/add_form_committee', $data);
                            $this->load->view('./template/footer');
                          }else{
                            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                            //CHECK MUNA
                            if ($this->committee_model->isExisting($decoded_id)){
                              $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                              redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                            }else{
                              $data = array(
                                'user_id' => $user_id,
                                'cooperators_id' => $decoded_id,
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->amendment_committee_model->add_committee($data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
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
                            if($this->form_validation->run() == FALSE){
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committees';
                              $data['encrypted_id'] = $id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                              $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('amendment/add_form_committee', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'cooperators_id' => $decoded_id,
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->amendment_committee_model->add_committee($data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }
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
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function edit($id = null,$committee_id = null){
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
                        $decoded_committee_id = $this->encryption->decrypt(decrypt_custom($committee_id));
                        if($this->amendment_committee_model->check_committee_in_cooperative($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                          if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                            if($this->form_validation->run() == FALSE){
                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committee';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_committee_id'] = $committee_id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['committee_info'] = $this->amendment_committee_model->get_committee_info($decoded_committee_id);
                              $data['cooperator_info'] = $this->amendment_cooperator_model->get_cooperator_info($data['committee_info']->cooperators_id);
                              $data['custom_committees'] = $this->amendment_committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $data['cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                              $this->load->view('./template/header', $data);
                              $this->load->view('amendment/edit_form_committee', $data);
                              $this->load->view('./template/footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                              $data = array(
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->amendment_committee_model->edit_committee($decoded_post_committee_id,$data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                          redirect('amendment/'.$id.'/committees');
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
                            $decoded_committee_id = $this->encryption->decrypt(decrypt_custom($committee_id));
                            if($this->amendment_committee_model->check_committee_in_cooperative($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                              if($this->form_validation->run() == FALSE){
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                $data['title'] = 'List of Committees';
                                $data['header'] = 'Committee';
                                $data['encrypted_id'] = $id;
                                $data['encrypted_committee_id'] = $committee_id;
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['committee_info'] = $this->amendment_committee_model->get_committee_info($decoded_committee_id);
                                $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($data['committee_info']->cooperators_id);
                                $data['custom_committees'] = $this->amendment_committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                                $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                                $this->load->view('./templates/admin_header', $data);
                                $this->load->view('amendment/edit_form_committee', $data);
                                $this->load->view('./templates/admin_footer');
                              }else{
                                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                                $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                                $data = array(
                                  'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                  );
                                $success = $this->amendment_committee_model->edit_committee($decoded_post_committee_id,$data);
                                if($success['success']){
                                  $this->session->set_flashdata('committee_success', $success['message']);
                                  redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $this->session->set_flashdata('committee_error', $success['message']);
                                  redirect('amendment/'.$this->input->post('cooperativesID').'/committees');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                              redirect('amendment/'.$id.'/committees');
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
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function delete_committee(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteCommitteeBtn')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID',TRUE)));
              //if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_committee_id)){
                if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->amendment_committee_model->delete_committee($decoded_post_committee_id);

                  if($success){
                    $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE).'/committees');
                  }else{
                    $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE).'/committees');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                  redirect('amendment/'.$this->input->post('cooperativeID',TRUE));
                }
              //}else{
                //$this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                //redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE)."/committees");
              //}
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
              if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                if($this->amendment_model->check_first_evaluated($decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                  redirect('amendment');
                }else{
                  $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                  if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                    $success = $this->amendment_committee_model->delete_committee($decoded_post_committee_id);
                    if($success){
                      $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                      redirect('amendment/'.$this->input->post('cooperativeID',TRUE).'/committees');
                    }else{
                      $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                      redirect('amendment/'.$this->input->post('cooperativeID',TRUE).'/committees');
                    }
                  }else{
                    $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE)."/committees");
                  }
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('amendment');
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
      redirect('committees');
    }else{
      $uid = $this->session->userdata('user_id');
      $cooperatives_id = $this->cooperatives_model->get_cooperative_info($uid)->id;
      $committees = $this->committee_model->get_all_committees_of_coop($cooperatives_id);
      $temp['data'] = $committees;
      echo json_encode($temp);
    }
  }
  public function check_committee_name_not_exists($coop_id){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($coop_id));
    $user_id = $this->session->userdata('user_id');
    if(is_numeric($decoded_id) && $decoded_id!=0){
      if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
        if($this->input->get('fieldId') && $this->input->get('fieldValue')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatives_id'=>$coop_id
          );
          $result = $this->committee_model->check_committee_name_not_exists($data);
          echo json_encode($result);
        }else{
          show_404();
        }
      }else{
        show_404();
      }
    }else{
      show_404();
    }
  }
}
