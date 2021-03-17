<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function index($id  = null)
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
              if($data['coop_info']->category_of_cooperative =="Primary"){
                redirect('cooperatives/'.$id.'/articles_primary');
              }else if($data['coop_info']->category_of_cooperative =="Secondary" && $data['coop_info']->grouping =="Union"){
                redirect('cooperatives/'.$id.'/articles_primary');
              }else{
                redirect('cooperatives/'.$id.'/articles_primary');
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
            if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
              if($data['coop_info']->category_of_cooperative =="Primary"){
                redirect('cooperatives/'.$id.'/articles_primary');
              }else if($data['coop_info']->category_of_cooperative =="Secondary" && $data['coop_info']->grouping =="Union"){
                redirect('cooperatives/'.$id.'/articles_primary');
              }else{
                redirect('cooperatives/'.$id.'/articles_primary');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }
          }
        }
      }else{
        show_404();
      }
    }
  }

  function primary($id = null)
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
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                  if($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->category_of_cooperative =="Primary" || $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->category_of_cooperative =="Secondary"){
                        if($this->form_validation->run() == FALSE){
                          $data['title'] = 'Articles of Cooperation';
                          $data['header'] = 'Articles of Cooperation';
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                          $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                          $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                          $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                          $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                          $this->load->view('template/header', $data);
                          $this->load->view('cooperative/articles_cooperation_info/articles_primary_form.php', $data);
                          $this->load->view('template/footer');
                        }else{
                          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                            $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));
                            $data = array(
                              'years_of_existence' => $this->input->post('cooperativeExistence'),
                              'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                              'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                              'common_share' => str_replace(',','',$this->input->post('commonShares')),
                              'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                              'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                              'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred')),
                              'guardian_cooperative' => $this->input->post('guardian_cooperative')
                            );
                            if($this->article_of_cooperation_model->update_article_primary($article_coop_id,$data)){
                              $this->session->set_flashdata('article_success', 'Successfully Updated.');
                              redirect('cooperatives/'.$this->input->post('article_coop_id').'/articles_primary');
                            }else{
                              $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                              redirect('cooperatives/'.$this->input->post('article_coop_id').'/articles_primary');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('cooperatives/'.$id);
                          }
                        }
                      }else{
                        redirect('cooperatives/'.$id.'/articles');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    if($data['coop_info']->grouping == 'Federation'){
                            $complete = 'Affiliators';
                        } else if($data['coop_info']->grouping == 'Union'){
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
                  if($data['bylaw_complete']){
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        if($this->cooperatives_model->get_cooperative_info_by_admin($decoded_id)->category_of_cooperative =="Primary" || $this->cooperatives_model->get_cooperative_info($data['coop_info']->users_id,$decoded_id)->category_of_cooperative =="Secondary"){
                          if($this->form_validation->run() == FALSE){
                            $data['title'] = 'Articles of Cooperation';
                            $data['header'] = 'Articles of Cooperation';
                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                            $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                            $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                            $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                            $this->load->view('templates/admin_header', $data);
                            $this->load->view('cooperative/articles_cooperation_info/articles_primary_form.php', $data);
                            $this->load->view('templates/admin_footer', $data);
                          }else{
                            if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                              redirect('cooperatives');
                            }else{
                              $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));
                              $data = array(
                                'years_of_existence' => $this->input->post('cooperativeExistence'),
                                'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                                'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                                'common_share' => str_replace(',','',$this->input->post('commonShares')),
                                'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                                'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                                'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred'))
                              );
                              if($this->article_of_cooperation_model->update_article_primary($article_coop_id,$data)){
                                $this->session->set_flashdata('article_success', 'Successfully Updated.');
                                redirect('cooperatives/'.$this->input->post('article_coop_id').'/articles_primary');
                              }else{
                                $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                                redirect('cooperatives/'.$this->input->post('article_coop_id').'/articles_primary');
                              }
                            }
                          }
                        }else{
                          redirect('cooperatives/'.$id.'/articles');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
}
