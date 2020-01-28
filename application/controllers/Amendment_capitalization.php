<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_capitalization extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("amendment_capitalization_model");
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
                    $data['title'] = 'Capitalization';
                    $data['header'] = 'Capitalization';
                    $data['encrypted_id'] = $id;
//                    $data['requirements_complete'] = $this->amendment_capitalization_model->is_requirements_complete($decoded_id);
                    
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $count = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id_count($decoded_id);
                    if($count == 0){
                        $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    } else {
                        $data['capitalization_info'] = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id($decoded_id);
                    }
                    if($this->input->post('capitalizationPrimaryBtn')) {
                      $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                      $data = $this->input->post('item');
                       if($this->amendment_capitalization_model->update_capitalization($decoded_post_coop_id,$data)){
                            $this->session->set_flashdata('capitalization_success', 'Successfully Updated');
                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_capitalization');
                        }else{
                          $this->session->set_flashdata('capitalization_error', 'Unable to update capitalization');
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_capitalization');
                        }
                      /*get the updated data*/
                    $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    }
                    $this->load->view('./template/header', $data);
                    $this->load->view('amendment/bylaw_info/capitalization_form', $data);
//                    $this->load->view('cooperators/full_info_modal_cooperator');
//                    $this->load->view('cooperators/delete_form_cooperator');
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
                        $data['title'] = 'Capitalization';
                        $data['header'] = 'Capitalization';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
//                        $data['requirements_complete'] = $this->capitalization_model->is_requirements_complete($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['capitalization_info'] = $this->amendment_capitalization_model    ->get_capitalization_by_coop_id($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('amendment/bylaw_info/capitalization_form', $data);
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
  
}
