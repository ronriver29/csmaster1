<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_capitalization extends CI_Controller{
  public $decoded_id = null;
  public function __construct()
  {
    parent::__construct();
   $this->load->library('auth');
   $this->auth->checkLogin();
   
  }

  function index($id = null)
  {   
      $this->load->model("amendment_capitalization_model");
      $this->load->model("amendment_model");
      $this->load->model('amendment_bylaw_model'); 
      $this->load->model('user_model');
      $this->load->model('amendment_cooperator_model');
      $this->load->model('amendment_article_of_cooperation_model'); 
      $this->load->model('amendment_affiliators_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
         $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
               $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
               $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'Capitalization';
                    $data['header'] = 'Capitalization';
                    $data['encrypted_id'] = $id;
                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                    
                    if($this->input->post('capitalizationPrimaryBtn')) {
                      $data = $this->input->post('item');
                       if($this->amendment_capitalization_model->update_capitalization($this->decoded_id,$data)){
                            $this->session->set_flashdata('capitalization_success', 'Successfully Updated');
                            redirect('amendment/'.$id.'/amendment_capitalization');
                        }else{
                          $this->session->set_flashdata('capitalization_error', 'Unable to update capitalization');
                          redirect('amendment/'.$id.'/amendment_capitalization');
                        }
                  
                    }

                    $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                   
                    $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                    $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                    //end modified
                
                    $this->load->view('./template/header', $data);
                    switch ($data['coop_info']->category_of_cooperative) { 
                      case 'Secondary':
                      case 'Tertiary':
                       $data['total_regular'] = $this->amendment_affiliators_model->get_total_regular($this->decoded_id);
                          $this->load->view('amendment/bylaw_info/fed_capitalization_form', $data);
                        break;
                      default:
                       $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                        $this->load->view('amendment/bylaw_info/capitalization_form', $data);
                        break;
                    }
                    
                    $this->load->view('./template/footer');
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }

          }else{ 
            $this->auth->authuserLevelAmd($this->session->userdata('access_level'),array(1,2));
            $this->load->model('admin_model');
            $this->load->model('region_model');
                
            $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
            $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
            $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

            if($data['bylaw_complete']){
            $data['title'] = 'Capitalization';
            $data['header'] = 'Capitalization';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $data['encrypted_id'] = $id;
            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
            $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
            //modified
            $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
            $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
            $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
            //end modified

            $this->load->view('./templates/admin_header', $data);
            $this->load->view('amendment/bylaw_info/capitalization_form', $data);
            $this->load->view('./templates/admin_footer');
            }else{
            $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
            redirect('amendment/'.$id);
            }
          }
        }else{
          show_404();
        }
  }


    public function debug($array)
    {
    
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
