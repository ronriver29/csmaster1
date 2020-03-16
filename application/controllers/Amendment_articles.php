<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_articles extends CI_Controller{

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
      $cooperative_id = $this->coop_dtl($decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
              if($data['coop_info']->category_of_cooperative =="Primary"){
                redirect('amendment/'.$id.'/articles_primary');
              }else if($data['coop_info']->category_of_cooperative =="Secondary"){
                redirect('amendment/'.$id.'/articles_union');
              }else{
                redirect('amendment/'.$id.'/articles_federation');
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
            if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
              if($data['coop_info']->category_of_cooperative =="Primary"){
                redirect('amendment/'.$id.'/articles_primary');
              }else if($data['coop_info']->category_of_cooperative =="Secondary"){
                redirect('amendment/'.$id.'/articles_union');
              }else{
                redirect('amendment/'.$id.'/articles_federation');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
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
        $cooperative_id = $this->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                }
                
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      if($this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id)->category_of_cooperative =="Primary"){
                          if(isset($_POST['articlesPrimaryBtn'])){
                              $temp = TRUE;
                          } else {
                              $temp = FALSE;
                          }
                        if($temp == FALSE){
                          $data['title'] = 'Articles of Cooperation';
                          $data['header'] = 'Articles of Cooperation';
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                          if(!$data['bylaw_info']) {
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                          }
                          $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
                          if(!$data['articles_info']) {
                            $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
                          }
                          $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                          if($data['total_regular']==0){
                            $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($decoded_id);
                          }
                          $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                          if($data['total_associate']==0) {
                            $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                          }
                          $this->load->view('template/header', $data);
                          $this->load->view('amendment/articles_cooperation_info/articles_primary_form.php', $data);
                          $this->load->view('template/footer');
                        }else{
                          if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                            $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));
                            $get_record = $this->db->where("cooperatives_id",$decoded_id)->get("amendment_articles_of_cooperation");
                            if($get_record->num_rows()==0) {
                                $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$decoded_id));
                                $this->db->trans_commit();
                            }
                                $data = array(
                                  'years_of_existence' => $this->input->post('cooperativeExistence'),
                                  'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                                  'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                                  'common_share' => str_replace(',','',$this->input->post('commonShares')),
                                  'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                                  'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                                  'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred'))
                                );
                                if($this->amendment_article_of_cooperation_model->update_article_primary($article_coop_id,$data)){
                                  $this->session->set_flashdata('article_success', 'Successfully Updated.');
                                  redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                                }else{
                                  $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                                  redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                                }
//                            } else {
//                                
//                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('amendment/'.$id);
                          }
                        }
                      }else{
                        redirect('amendment/'.$id.'/articles');
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
                        if($this->amendment_model->get_cooperative_info_by_admin($decoded_id)->category_of_cooperative =="Primary"){
                          if($this->form_validation->run() == FALSE){
                            $data['title'] = 'Articles of Cooperation';
                            $data['header'] = 'Articles of Cooperation';
                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                            $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                            $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                            $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                            $this->load->view('templates/admin_header', $data);
                            $this->load->view('amendment/articles_cooperation_info/articles_primary_form.php', $data);
                            $this->load->view('templates/admin_footer', $data);
                          }else{
                            if($this->amendment_model->check_first_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                              redirect('cooperatives');
                            }else{
                              $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));
                              $get_record = $this->db->where("cooperatives_id",$decoded_id)->get("amendment_articles_of_cooperation");
                                if($get_record->num_rows()==0) {
                                    $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$decoded_id));
                                    $this->db->trans_commit();
                                }
                              $data = array(
                                'years_of_existence' => $this->input->post('cooperativeExistence'),
                                'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                                'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                                'common_share' => str_replace(',','',$this->input->post('commonShares')),
                                'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                                'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                                'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred'))
                              );
                              if($this->amendment_article_of_cooperation_model->update_article_primary($article_coop_id,$data)){
                                $this->session->set_flashdata('article_success', 'Successfully Updated.');
                                redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                              }else{
                                $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                                redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                              }
                            }
                          }
                        }else{
                          redirect('amendment/'.$id.'/articles');
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
  public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }
   public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
