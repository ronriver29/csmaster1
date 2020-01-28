<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_purposes extends CI_Controller{

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
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  if($data['cooperator_complete']){
                    $data['title'] = 'List of Purposes';
                    $data['header'] = 'Purposes';
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['encrypted_id'] = $id;
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    $data['purpose_not_null'] = $this->purpose_model->check_not_null($decoded_id);
                    $data['purpose_blank_not_exists'] = $this->purpose_model->check_blank_not_exists($decoded_id);
                    $row = $this->amendment_purpose_model->get_all_purposes($data['coop_info']->id);
                    $data['purposes'] = $row;
                    $data['contents'] = explode(";",$row->content);
                    $this->load->view('template/header', $data);
                    $this->load->view('purposes/amendment_list_of_purposes', $data);
                    // $this->load->view('purposes/add_form_purposes', $data);
                    $this->load->view('template/footer');
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
                      $data['title'] = 'List of Purposes';
                      $data['header'] = 'Purposes';
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      $data['encrypted_id'] = $id;
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      $data['purpose_not_null'] = $this->purpose_model->check_not_null($decoded_id);
                      $data['purpose_blank_not_exists'] = $this->purpose_model->check_blank_not_exists($decoded_id);
                      $row = $this->purpose_model->get_all_purposes($data['coop_info']->id);
                      $data['purposes'] = $row;
                      $data['contents'] = explode(";",$row->content);
                      $this->load->view('templates/admin_header', $data);
                      $this->load->view('purposes/amendment_list_of_purposes', $data);
                      $this->load->view('templates/admin_footer');
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                      redirect('amendment/'.$id);
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The purpose of the cooperative you trying to view is not yet submitted for evaluation.');
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
  function edit($id = null){
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
                    if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                        if ( isset( $_POST['editPurposesBtn'] ) ) { 
                            $temp = TRUE;
                        } else { 
                            $temp = FALSE;
                        }
                      if($temp == FALSE){
                        $data['title'] = 'List of Purposes';
                        $data['header'] = 'Purposes';
                        $data['client_info'] = $this->user_model->get_user_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        $data['purpose_not_null'] = $this->purpose_model->check_not_null($decoded_id);
                        $data['purpose_blank_not_exists'] = $this->purpose_model->check_blank_not_exists($decoded_id);
                        $row = $this->amendment_purpose_model->get_all_purposes($data['coop_info']->id);
                        $data['purposes'] = $row;
                        $data['contents'] = explode(";",$row->content);
                        $this->load->view('template/header', $data);
                        $this->load->view('purposes/amendment_add_form_purposes', $data);
                        $this->load->view('template/footer');
                      }else{
                        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                        $purposes = '';
                        $temp =  $this->input->post('purposes');
                        foreach($temp as $t){
                          $purposes .= $t.';';
                        }
                        $purposes = substr_replace($purposes, "", -1);
                        $data = array(
                          'content' => $purposes,
                        );
                        $success = $this->purpose_model->edit_purposes($decoded_id,$data);
                        if($success){
                          $this->session->set_flashdata('edit_purposes_success', "Updated Purposes Successfully.");
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');
                        }else{
                          $this->session->set_flashdata('edit_purposes_error', "Unable to update purposes.");
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
                        if($this->form_validation->run() == FALSE){
                          $data['title'] = 'List of Purposes';
                          $data['header'] = 'Purposes';
                          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          $data['purpose_not_null'] = $this->purpose_model->check_not_null($decoded_id);
                          $data['purpose_blank_not_exists'] = $this->purpose_model->check_blank_not_exists($decoded_id);
                          $row = $this->purpose_model->get_all_purposes($data['coop_info']->id);
                          $data['purposes'] = $row;
                          $data['contents'] = explode(";",$row->content);
                          $this->load->view('templates/admin_header', $data);
                          $this->load->view('purposes/add_form_purposes', $data);
                          $this->load->view('templates/admin_footer');
                        }else{
                          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                          $purposes = '';
                          $temp =  $this->input->post('purposes');
                          foreach($temp as $t){
                            $purposes .= $t.';';
                          }
                          $purposes = substr_replace($purposes, "", -1);
                          $data = array(
                            'content' => $purposes,
                          );
                          $success = $this->purpose_model->edit_purposes($decoded_id,$data);
                          if($success){
                            $this->session->set_flashdata('edit_purposes_success', "Updated Purposes Successfully.");
                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');
                          }else{
                            $this->session->set_flashdata('edit_purposes_error', "Unable to update purposes.");
                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');
                          }
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
                  $this->session->set_flashdata('redirect_applications_message', 'Updating the purpose of the cooperative is not available because it is not yet submitted for evaluation.');
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
}
