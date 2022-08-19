<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committees extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('cooperatives_model');
    $this->load->model('bylaw_model');
    $this->load->model('capitalization_model');
    $this->load->model('cooperator_model');
    $this->load->model('purpose_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('committee_model');
    $this->load->model('user_model');
    $this->load->model('affiliators_model');
    $this->load->model('unioncoop_model');
    $this->load->model('admin_model');
    $this->load->model('region_model');
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
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count_federation($user_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count_federation($user_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count_federation($user_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count_federation($user_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count_union($user_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count_union($user_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count_union($user_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count_union($user_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count($user_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count($user_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count($user_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count($user_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count($user_id);
                        }
                        
                        $data['committees_count_member'] = $this->committee_model->get_all_committees_count($user_id);
                        $data['client_info'] = $this->user_model->get_user_info($user_id);
                        $data['title'] = 'List of Committees';
                        $data['header'] = 'Committees';
                        $data['encrypted_id'] = $id;
                        
                        $data['committees'] = $this->committee_model->get_all_committees_of_coop($user_id);
                        $data['committees_federation'] = $this->committee_model->get_all_committees_of_coop_federation($user_id);
                        $data['committees_union'] = $this->committee_model->get_all_committees_of_coop_union($user_id);
                        $data['committees_count'] = $this->committee_model->get_all_committees_of_coop_gad($decoded_id); //not hear
                        
                        $this->load->view('./template/header', $data);
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $this->load->view('federation/federation_committees_list', $data);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $this->load->view('union/union_committees_list', $data);
                        } else {
                            $this->load->view('committees/committees_list', $data);
                        }
                        // $this->load->view('committees/committees_list', $data);
                        $this->load->view('committees/delete_modal_committee');
                        $this->load->view('./template/footer');
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $complete = 'Federations';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
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
            }
            // else if($this->session->userdata('access_level')!=1){
            //   redirect('cooperatives');
            // }
            else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                    if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']|| $data['coop_info']->category_of_cooperative = 'Tertiary'){
                         if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count_federation($data['coop_info']->users_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count_federation($data['coop_info']->users_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count_federation($data['coop_info']->users_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count_federation($data['coop_info']->users_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count_federation($data['coop_info']->users_id);
                        } else if($data['coop_info']->grouping == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($data['coop_info']->users_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count_union($data['coop_info']->users_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count_union($data['coop_info']->users_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count_union($data['coop_info']->users_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count_union($data['coop_info']->users_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count_union($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                            $data['audit_count'] = $this->committee_model->get_all_audit_count($data['coop_info']->users_id);
                            $data['election_count'] = $this->committee_model->get_all_election_count($data['coop_info']->users_id);
                            $data['medcon_count'] = $this->committee_model->get_all_medcon_count($data['coop_info']->users_id);
                            $data['ethics_count'] = $this->committee_model->get_all_ethics_count($data['coop_info']->users_id);
                            $data['credit_count'] = $this->committee_model->get_all_credit_count($data['coop_info']->users_id);
                        }
                          $data['committees_count_member'] = $this->committee_model->get_all_committees_count($user_id);
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'List of Committees';
                          $data['header'] = 'Committees';
                          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['committees'] = $this->committee_model->get_all_committees_of_coop($data['coop_info']->users_id);
                          $data['committees_federation'] = $this->committee_model->get_all_committees_of_coop_federation($data['coop_info']->users_id); 
                          $data['committees_union'] = $this->committee_model->get_all_committees_of_coop_union($data['coop_info']->users_id);
                            $data['committees_count'] = $this->committee_model->get_all_committees_of_coop_gad($decoded_id); //modify

                          $this->load->view('./templates/admin_header', $data);
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                              $this->load->view('federation/federation_committees_list', $data);
                          } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                              $this->load->view('union/union_committees_list', $data);
                          } else {
                              $this->load->view('committees/committees_list', $data);
                          }
                          $this->load->view('committees/delete_modal_committee');
                          $this->load->view('./templates/admin_footer');
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function add($id = null){
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
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        // if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                          if($this->form_validation->run() == FALSE){
                            $data['client_info'] = $this->user_model->get_user_info($user_id);
                            $data['title'] = 'List of Committees';
                            $data['header'] = 'Committees';
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                            $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                            $data['applied_coop'] = $this->affiliators_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop'] as $applied_coop){
                                $result_array[] = $applied_coop['application_id'];
                            }
                            $data['applied_coop_union'] = $this->unioncoop_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop_union'] as $applied_coop_union){
                                $result_array_union[] = $applied_coop_union['application_id'];
                            }
                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['cooperators_federation'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_federation($result_array,$user_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $data['cooperators_union'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_union($result_array_union,$user_id);
                            }
                            $this->load->view('./template/header', $data);

                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $this->load->view('committees/add_form_committee_federation', $data);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $this->load->view('committees/add_form_committee_union', $data);
                            } else {
                                $this->load->view('committees/add_form_committee', $data);
                            }

                            $this->load->view('./template/footer');
                          }else{
                            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                            $committeeName = $this->input->post('committeeName');
                            //CHECK MUNA
                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                if ($this->committee_model->isExistingFederation($decoded_id,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2federation($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                    );
                                  $success = $this->committee_model->add_committee_federation($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                if ($this->committee_model->isExistingUnion($decoded_id,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2union($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')== "Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                    'func_and_respons' => $this->input->post('func_and_respons')
                                    );
                                  $success = $this->committee_model->add_committee_union($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            } else {
                                if ($this->committee_model->isExisting($decoded_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? $this->input->post('committeeNameSpecify') : $this->input->post('committeeName'),
                                    'cooperative_id' => $data['coop_info']->id,
                                     'func_and_respons' => $this->input->post('func_and_respons'),
                                     'type' => $this->input->post('type')
                                    );
                                  $success = $this->committee_model->add_committee($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            }
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                        //   redirect('cooperatives/'.$id);
                        // }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
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
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            if($this->form_validation->run() == FALSE){
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committees';
                              $data['encrypted_id'] = $id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                              $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('committees/add_form_committee', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'cooperators_id' => $decoded_id,
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->committee_model->add_committee($data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function add_fed($id = null){
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
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                          if($this->form_validation->run() == FALSE){
                            $data['client_info'] = $this->user_model->get_user_info($user_id);
                            $data['title'] = 'List of Committees';
                            $data['header'] = 'Committees';
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                            $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                            $data['applied_coop'] = $this->affiliators_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop'] as $applied_coop){
                                $result_array[] = $applied_coop['application_id'];
                            }
                            $data['applied_coop_union'] = $this->unioncoop_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop_union'] as $applied_coop_union){
                                $result_array_union[] = $applied_coop_union['application_id'];
                            }
                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['cooperators_federation'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_federation($result_array,$user_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $data['cooperators_union'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_union($result_array_union,$user_id);
                            }
                            $this->load->view('./template/header', $data);

                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $this->load->view('committees/add_form_committee_federation', $data);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $this->load->view('committees/add_form_committee', $data);
                            } else {
                                $this->load->view('committees/add_form_committee', $data);
                            }

                            $this->load->view('./template/footer');
                          }else{
                            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                            $committeeName = $this->input->post('committeeName');
                            //CHECK MUNA
                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                // if ($this->committee_model->isExistingFederation($decoded_id,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else if ($this->committee_model->isExisting2federation($committeeName,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                    'func_and_respons' => $this->input->post('func_and_respons'),
                                    );
                                  $success = $this->committee_model->add_committee_federation($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                // }
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                if ($this->committee_model->isExistingUnion($decoded_id,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2union($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                    );
                                  $success = $this->committee_model->add_committee_union($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            } else {
                                if ($this->committee_model->isExisting($decoded_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? $this->input->post('committeeNameSpecify') : $this->input->post('committeeName'),
                                    'cooperative_id' => $data['coop_info']->id,
                                     'func_and_respons' => $this->input->post('func_and_respons'),
                                     'type' => $this->input->post('type')
                                    );
                                  $success = $this->committee_model->add_committee($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
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
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            if($this->form_validation->run() == FALSE){
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committees';
                              $data['encrypted_id'] = $id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                              $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('committees/add_form_committee', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'cooperators_id' => $decoded_id,
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->committee_model->add_committee($data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function add_union($id = null){
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
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                          if($this->form_validation->run() == FALSE){
                            $data['client_info'] = $this->user_model->get_user_info($user_id);
                            $data['title'] = 'List of Committees';
                            $data['header'] = 'Committees';
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                            $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                            $data['applied_coop'] = $this->affiliators_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop'] as $applied_coop){
                                $result_array[] = $applied_coop['application_id'];
                            }
                            $data['applied_coop_union'] = $this->unioncoop_model->get_applied_coop_for_committees($user_id);
                            foreach($data['applied_coop_union'] as $applied_coop_union){
                                $result_array_union[] = $applied_coop_union['application_id'];
                            }
                            if($data['coop_info']->grouping == 'Federation'){
                                $data['cooperators_federation'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_federation($result_array,$user_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $data['cooperators_union'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee_union($result_array_union,$user_id);
                            }
                            $this->load->view('./template/header', $data);

                            if($data['coop_info']->grouping == 'Federation'){
                                $this->load->view('committees/add_form_committee_federation', $data);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $this->load->view('committees/add_form_committee_union', $data);
                            } else {
                                $this->load->view('committees/add_form_committee', $data);
                            }

                            $this->load->view('./template/footer');
                          }else{
                            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                            $committeeName = $this->input->post('committeeName');
                            //CHECK MUNA
                            if($data['coop_info']->grouping == 'Federation'){
                                // if ($this->committee_model->isExistingFederation($decoded_id,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else if ($this->committee_model->isExisting2federation($committeeName,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                    );
                                  $success = $this->committee_model->add_committee_federation($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                // }
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                // if ($this->committee_model->isExistingUnion($decoded_id,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else if ($this->committee_model->isExisting2union($committeeName,$user_id)){
                                //   $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                //   redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                // }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                    'func_and_respons' => $this->input->post('func_and_respons')
                                    );
                                  $success = $this->committee_model->add_committee_union($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                // }
                            } else {
                                if ($this->committee_model->isExisting($decoded_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $data = array(
                                    'user_id' => $user_id,
                                    'cooperators_id' => $decoded_id,
                                    'name'=> ($this->input->post('committeeName')=="Others") ? $this->input->post('committeeNameSpecify') : $this->input->post('committeeName'),
                                    'cooperative_id' => $data['coop_info']->id,
                                     'func_and_respons' => $this->input->post('func_and_respons'),
                                     'type' => $this->input->post('type')
                                    );
                                  $success = $this->committee_model->add_committee($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('committee_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }else{
                                    $this->session->set_flashdata('committee_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                  }
                                }
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
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
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            if($this->form_validation->run() == FALSE){
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committees';
                              $data['encrypted_id'] = $id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                              $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('committees/add_form_committee', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'cooperators_id' => $decoded_id,
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName')
                                );
                              $success = $this->committee_model->add_committee($data);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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

  function edit($id = null,$committee_id = null){
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
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $decoded_committee_id = $this->encryption->decrypt(decrypt_custom($committee_id));
                        if($data['coop_info']->grouping == "Federation"){
                            $committee_edit = 'check_committee_in_cooperative_federation';
                            $committee_info = 'get_committee_federation_info';
                            $edit_committee_federation = 'edit_committee_federation';
                        } else if($data['coop_info']->grouping == "Union"){
                            $committee_edit = 'check_committee_in_cooperative_union';
                            $committee_info = 'get_committee_union_info';
                            $edit_committee_federation = 'edit_committee_union';
                        } else {
                            $committee_edit = 'check_committee_in_cooperative';
                            $committee_info = 'get_committee_federation_info';
                            $edit_committee_federation = 'edit_committee';
                        }
                        if($this->committee_model->$committee_edit($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                            if($this->form_validation->run() == FALSE){
                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committee';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_committee_id'] = $committee_id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              if($data['coop_info']->grouping == "Federation"){
                                  $data['committee_info'] = $this->committee_model->get_committee_federation_info($decoded_committee_id);
                              } else if($data['coop_info']->grouping == "Union"){
                                  $data['committee_info'] = $this->committee_model->get_committee_union_info($decoded_committee_id);
                              } else {
                                  $data['committee_info'] = $this->committee_model->get_committee_info($decoded_committee_id);
                              }
                              
                              $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($data['committee_info']->cooperators_id);
                              $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                              $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                              $this->load->view('./template/header', $data);
                              $this->load->view('committees/edit_form_committee', $data);
                              $this->load->view('./template/footer');
                            }else{
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                              $data = array(
                                'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                'func_and_respons'=>$this->input->post('func_and_respons')
                                );
                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $committeeName = $this->input->post('committeeName');
                              if ($this->committee_model->isExisting($decoded_id)){
                                  $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else if ($this->committee_model->isExisting2($committeeName,$user_id)){
                                  $this->session->set_flashdata('committee_error', 'Committee already has 3 cooperators');
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  // $this->debug($data);
                                    $success = $this->committee_model->$edit_committee_federation($decoded_post_committee_id,$data);
                                    if($success['success']){
                                      $this->session->set_flashdata('committee_success', $success['message']);
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                    }else{
                                      $this->session->set_flashdata('committee_error', $success['message']);
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                    }
                                }
//                              $success = $this->committee_model->$edit_committee_federation($decoded_post_committee_id,$data);
//                              if($success['success']){
//                                $this->session->set_flashdata('committee_success', $success['message']);
//                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
//                              }else{
//                                $this->session->set_flashdata('committee_error', $success['message']);
//                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
//                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                          redirect('cooperatives/'.$id.'/committees');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
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
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $decoded_committee_id = $this->encryption->decrypt(decrypt_custom($committee_id));
                            if($this->committee_model->check_committee_in_cooperative($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                              if($this->form_validation->run() == FALSE){
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                $data['title'] = 'List of Committees';
                                $data['header'] = 'Committee';
                                $data['encrypted_id'] = $id;
                                $data['encrypted_committee_id'] = $committee_id;
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['committee_info'] = $this->committee_model->get_committee_info($decoded_committee_id);
                                $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($data['committee_info']->cooperators_id);
                                $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                                $data['cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id,$user_id);
                                $this->load->view('./templates/admin_header', $data);
                                $this->load->view('committees/edit_form_committee', $data);
                                $this->load->view('./templates/admin_footer');
                              }else{
                                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                                $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                                $data = array(
                                  'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                  'func_and_respons' => $this->input->post('func_and_respons'),
                                  'type' =>$this->input->post('type')
                                  );
                                $success = $this->committee_model->edit_committee($decoded_post_committee_id,$data);
                                if($success['success']){
                                  $this->session->set_flashdata('committee_success', $success['message']);
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }else{
                                  $this->session->set_flashdata('committee_error', $success['message']);
                                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/committees');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                              redirect('cooperatives/'.$id.'/committees');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
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
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID',TRUE)));
              //if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_committee_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    if($data['coop_info']->grouping=="Federation" || $data['coop_info']->type_of_cooperative=="Technology Service"){
                        $success = $this->committee_model->delete_committee_federation($decoded_post_committee_id);
                    } else if($data['coop_info']->grouping=="Union"){
                        $success = $this->committee_model->delete_committee_union($decoded_post_committee_id);
                    } else {
                        $success = $this->committee_model->delete_committee($decoded_post_committee_id);
                    }
                  

                  if($success){
                    $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE).'/committees');
                  }else{
                    $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE).'/committees');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                  redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
                }
              //}else{
                //$this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                //redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE)."/committees");
              //}
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
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                  redirect('cooperatives');
                }else{
                  $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                  if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                    $success = $this->committee_model->delete_committee($decoded_post_committee_id);
                    if($success){
                      $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE).'/committees');
                    }else{
                      $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE).'/committees');
                    }
                  }else{
                    $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE)."/committees");
                  }
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('cooperatives');
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
  public function debug($array)
  {
    echo"<pre>";
    print_r($array);
    echo"<pre>";
  }
}
