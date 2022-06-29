<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capitalization extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("capitalization_model");
    $this->load->model('cooperatives_model');
    $this->load->model('bylaw_model');
    $this->load->model('cooperator_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('user_model');
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
                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);

                    if($data['coop_info']->grouping == 'Federation'){
                        $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                    } else {
                        $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                    }
                    
                    $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'Capitalization';
                    $data['header'] = 'Capitalization';
                    $data['encrypted_id'] = $id;
//                    $data['requirements_complete'] = $this->capitalization_model->is_requirements_complete($decoded_id);
                    
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    if($this->input->post('capitalizationPrimaryBtn')) {
                      $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                      $data = $this->input->post('item');
                       if($this->capitalization_model->update_capitalization($decoded_post_coop_id,$data)){
                            $this->session->set_flashdata('capitalization_success', 'Successfully Updated');
                            redirect('cooperatives/'.$this->input->post('cooperativesID').'/capitalization');
                        }else{
                          $this->session->set_flashdata('capitalization_error', 'Unable to update capitalization');
                          redirect('cooperatives/'.$this->input->post('cooperativesID').'/capitalization');
                        }
                      /*get the updated data*/
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    }
                    $this->load->view('./template/header', $data);
                    if($data['coop_info']->grouping == 'Federation' && $data['coop_info']->category_of_cooperative == 'Secondary'){
                        $this->load->view('cooperative/bylaw_info/fed_capitalization_form', $data);
                    } else if($data['coop_info']->grouping == 'Federation' && $data['coop_info']->category_of_cooperative == 'Tertiary'){
                        $this->load->view('cooperative/bylaw_info/fed_tert_capitalization_form', $data);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $this->load->view('cooperative/bylaw_info/capitalization_form', $data);
                    } else {
                        $this->load->view('cooperative/bylaw_info/capitalization_form', $data);
                    }
                    // $this->load->view('cooperative/bylaw_info/capitalization_form', $data);
//                    $this->load->view('cooperators/full_info_modal_cooperator');
//                    $this->load->view('cooperators/delete_form_cooperator');
                    $this->load->view('./template/footer');
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
                        $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['total_regular'] = $this->affiliators_model->get_total_regular($data['coop_info']->users_id,$decoded_id);
                        } else if($data['coop_info']->grouping == 'Union'){
                            $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        } else {
                            $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        }
                        // $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        $data['title'] = 'Capitalization';
                        $data['header'] = 'Capitalization';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
//                        $data['requirements_complete'] = $this->capitalization_model->is_requirements_complete($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        if($data['coop_info']->grouping == 'Federation' && $data['coop_info']->category_of_cooperative == 'Secondary'){
                            $this->load->view('cooperative/bylaw_info/fed_capitalization_form', $data);
                        } else if($data['coop_info']->grouping == 'Federation' && $data['coop_info']->category_of_cooperative == 'Tertiary'){
                            $this->load->view('cooperative/bylaw_info/fed_tert_capitalization_form', $data);
                        } else if($data['coop_info']->grouping == 'Union'){
                            $this->load->view('cooperative/bylaw_info/capitalization_form', $data);
                        } else {
                            $this->load->view('cooperative/bylaw_info/capitalization_form', $data);
                        }
                        
                        $this->load->view('./templates/admin_footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The capitalization of the cooperative you trying to view is not yet submitted for evaluation.');
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
