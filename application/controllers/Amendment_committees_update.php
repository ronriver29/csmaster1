<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_committees_update extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('amendment_committees_update_model');
    $this->load->model('amendment_update_cooperator_model');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                }
                // if($data['bylaw_complete']){
                //   $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                //   // if(!$data['cooperator_complete']) {
                //   //   $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                //   // }
                //   if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    }
                    // if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($cooperative_id,$decoded_id) : true;
                      }
                      // if($data['article_complete']){
                        $data['gad_count'] = $this->amendment_committees_update_model->get_all_gad_count2($decoded_id);
                        $data['committees_count_member'] = $this->amendment_committees_update_model->get_all_committees_count($user_id);
                        $data['client_info'] = $this->user_model->get_user_info($user_id);
                        $data['title'] = 'List of Committees';
                        $data['header'] = 'Committees';
                        $data['encrypted_id'] = $id;
                        $data['committees'] = $this->amendment_committees_update_model->get_all_committees_of_coop($decoded_id);
                        // echo $this->db->last_query();
                        // $this->debug(  $data['committees']);
                        if(!$data['committees']) {
                            $data['committees'] = $this->amendment_committees_update_model->get_all_committees_of_coop($decoded_id);
                        }

                      
                        $data['committeescount'] = $this->amendment_committees_update_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        // if($data['committeescount']==0) {
                        //     $data['committeescount'] = $this->committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        // }

                        // $this->debug( $data['committeescount']);
                        //check position
                        $data['election'] = $this->committee_model->check_position($decoded_id,"Election");
                        $data['ethics'] = $this->committee_model->check_position($decoded_id,"Ethics");
                        $data['media_concil'] = $this->committee_model->check_position($decoded_id,"Mediation and Conciliation");
                        $gender_dev = $this->committee_model->check_position($decoded_id,"Gender and Development");
                        $data['audit'] = $this->committee_model->check_position($decoded_id,"Audit");
                       
                        $data['gender_dev'] = $gender_dev;
             
                        $type_coop_array_ = explode(',',$data['coop_info']->type_of_cooperative);
                        $count_type ='';
                        $count_type = count($type_coop_array_);
                        // var_dump( $type_coop_array_)
                        $data['complete_position']=false;
                        if($count_type > 1)
                        {
                             if(in_array('Credit', $type_coop_array_))
                            {
                               $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                              if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                            else
                            {
                               $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                        }
                        else
                        {
                           
                          if($data['coop_info']->type_of_cooperative == 'Credit')
                          {
                            // $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                            $data['credit'] = true;
                            if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                          }
                          else
                          {
                            $data['credit'] = true;
                            if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                          }       
                        }
                       
                        
                        
                        //end position
                        $this->load->view('./template/header', $data);
                        $this->load->view('update/amendment/committees/committee_list', $data);
                        $this->load->view('update/amendment/committees/delete_modal_committee');
                        $this->load->view('./template/footer');
                      // }else{
                      //   $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                      //   redirect('amendment_update/'.$id);
                      // }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                    //   redirect('amendment_update/'.$id);
                    // }
                //   }else{
                //     $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                //     redirect('amendment/'.$id);
                //   }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('amendment/'.$id);
                // }
              }else{
                redirect('amendment_update/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            $access_array = array(6);
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if(!in_array($this->session->userdata('access_level'),$access_array)){
              redirect('amendment');
            }else{
              // if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('amendment');
              // }else{
                // if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                  // if($data['bylaw_complete']){
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                    // if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                      // if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        // if($data['article_complete']){
                          // $data['gad_count'] = $this->amendment_committees_update_model->get_all_gad_count($user_id);
                           $data['gad_count'] = $this->amendment_committees_update_model->get_all_gad_count2($decoded_id);
                          $data['committees_count_member'] = $this->amendment_committees_update_model->get_all_committees_count($user_id);
                          $data['title'] = 'List of Committees';
                          $data['header'] = 'Committees';
                          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                          $data['encrypted_id'] = $id;
                          $data['committees'] = $this->amendment_committees_update_model->get_all_committees_of_coop($decoded_id);
                        if(!$data['committees']) {
                            $data['committees'] = $this->amendment_committees_update_model->get_all_committees_of_coop($decoded_id);
                        }


                       
                        $data['committeescount'] = $this->amendment_committees_update_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        // if($data['committeescount']==0) {
                        //     $data['committeescount'] = $this->committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
                        // }

                        // $this->debug( $data['committeescount']);
                        //check position
                        $data['election'] = $this->committee_model->check_position($decoded_id,"Election");
                        $data['ethics'] = $this->committee_model->check_position($decoded_id,"Ethics");
                        $data['media_concil'] = $this->committee_model->check_position($decoded_id,"Mediation and Conciliation");
                        $gender_dev = $this->committee_model->check_position($decoded_id,"Gender and Development");
                        $data['audit'] = $this->committee_model->check_position($decoded_id,"Audit");
                       
                        $data['gender_dev'] = $gender_dev;
             
                        $type_coop_array_ = explode(',',$data['coop_info']->type_of_cooperative);
                        $count_type ='';
                        $count_type = count($type_coop_array_);
                        // var_dump( $type_coop_array_)
                        $data['complete_position']=false;
                        if($count_type > 1)
                        {
                             if(in_array('Credit', $type_coop_array_))
                            {
                               $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                              if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                            else
                            {
                               $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                        }
                        else
                        {
                           
                          if($data['coop_info']->type_of_cooperative == 'Credit')
                          {
                            // $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                            $data['credit'] = true;
                            if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                          }
                          else
                          {
                            $data['credit'] = true;
                            if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                          }       
                        }
                        
                          $this->load->view('./templates/admin_header', $data);
                          $this->load->view('update/amendment/committees/committee_list', $data);
                          $this->load->view('update/amendment/committees/delete_modal_committee');
                          $this->load->view('./templates/admin_footer');
                      //   }else{
                      //     $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                      //     redirect('amendment/'.$id);
                      //   }
                      // }else{
                      //   $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                      //   redirect('amendment/'.$id);
                      // }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                    //   redirect('amendment/'.$id);
                    // }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                  //   redirect('amendment/'.$id);
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                //   redirect('amendment');
                // }
              // }
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
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              // if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                }
                // if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  }
                  // if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    }
                    // if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($cooperative_id,$decoded_id) : true;
                      }
                      // if($data['article_complete']){
                      //   if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                          if(!isset($_POST['addCommitteeBtn'])){
                            $data['client_info'] = $this->user_model->get_user_info($user_id);
                            $data['title'] = 'List of Committees';
                            $data['header'] = 'Committees';
                            $data['encrypted_id'] = $id;
                            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                            // $data['cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                            $data['cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_for_committee2($decoded_id);
                            $data['custom_committees'] = $this->amendment_committees_update_model->get_all_custom_committee_names_of_coop($decoded_id);
                    
                            $this->load->view('./template/header', $data);
                            $this->load->view('update/amendment/committees/add_form_committee', $data); 
                            $this->load->view('./template/footer');
                          }else{
                            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                            $amendment_id_ = $this->encryption->decrypt(decrypt_custom($this->input->post('amendmentID')));
                            //CHECK MUNA
                            // if ($this->amendment_committees_update_model->isExisting($decoded_id)){
                            //   $this->session->set_flashdata('committee_error', 'Cooperator already has committee');
                            //   redirect('amendment_update/'.$this->input->post('amendmentID').'/committees_update');
                            // }else{
                              $data = array(
                                'user_id' => $user_id,
                                // 'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                'name'=> ($this->input->post('committeeName')=="Others") ? $this->input->post('committeeNameSpecify') : $this->input->post('committeeName'),
                                'amendment_cooperators_id'=> $decoded_id,
                                'amendment_id'=>$amendment_id_,
                                'cooperative_id' => $cooperative_id,
                                'func_and_respons' => $this->input->post('func_and_respons'),
                                'type' => $this->input->post('type')
                                );
                              // $this->debug($data);
                              $success = $this->amendment_committees_update_model->add_committee($data);
                              // $this->debug($success);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('amendment_update/'.$this->input->post('amendmentID').'/committees_update');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('amendment_update/'.$this->input->post('amendmentID').'/committees_update');
                              }
                            // }
                          }
                      //   }else{
                      //     $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                      //     redirect('amendment/'.$id);
                      //   }
                      // }else{
                      //   $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                      //   redirect('amendment/'.$id);
                      // }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                    //   redirect('amendment/'.$id);
                    // }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                  //   redirect('amendment/'.$id);
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('amendment/'.$id);
                // }
              // }else{
              //   redirect('amendment/'.$id);
              // }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
              if($this->session->userdata('access_level')!=6){
              redirect('admins/login');
              }else{
                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                // if($data['bylaw_complete']){
                $data['cooperator_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                // if($data['cooperator_complete']){
                $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                // if($data['purposes_complete']){
                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                if(!$data['article_complete']) {
                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                }
                // if($data['article_complete']){
                if(!isset($_POST['addCommitteeBtn'])){
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['title'] = 'List of Committees';
                  $data['header'] = 'Committees';
                  $data['encrypted_id'] = $id;
                  $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                  $data['cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_for_committee($cooperative_id,$decoded_id);
                  $data['custom_committees'] = $this->committee_model->get_all_custom_committee_names_of_coop($decoded_id);
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('update/amendment/committees/add_form_committee', $data);
                  $this->load->view('./templates/admin_footer');
                }else{

                  $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                  $amendment_id_ = $this->encryption->decrypt(decrypt_custom($this->input->post('amendmentID')));
                    $data = array(
                    'user_id' => $user_id,
                    // 'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                    'name'=> ($this->input->post('committeeName')=="Others") ? $this->input->post('committeeNameSpecify') : $this->input->post('committeeName'),
                    'amendment_cooperators_id'=> $decoded_id,
                    'amendment_id'=>$amendment_id_,
                    'cooperative_id' => $cooperative_id,
                    'func_and_respons' => $this->input->post('func_and_respons'),
                    'type' => $this->input->post('type')
                    );
                  $success = $this->amendment_committees_update_model->add_committee($data);
                  if($success['success']){
                    $this->session->set_flashdata('committee_success', $success['message']);
                    redirect('amendment_update/'.$this->input->post('amendmentID').'/committees_update');
                  }else{
                    $this->session->set_flashdata('committee_error', $success['message']);
                    redirect('amendment_update/'.$this->input->post('amendmentID').'/committees_update');
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
        $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
        $decoded_committee_id = $this->encryption->decrypt(decrypt_custom($committee_id));
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;

                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        
                        if($this->amendment_committees_update_model->check_committee_in_cooperative($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                          if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                            if($this->form_validation->run() == FALSE){
                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['title'] = 'List of Committees';
                              $data['header'] = 'Committee';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_committee_id'] = $committee_id;
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['committee_info'] = $this->amendment_committees_update_model->get_committee_info($decoded_committee_id);
                              $committee_dtl = $this->amendment_committees_update_model->   get_committee_info_edit($decoded_committee_id);
                             
                              $data['cooperator_info'] = $this->amendment_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$data['committee_info']->amendment_cooperators_id);

                              $cooperator_position = $data['cooperator_info']->position;

                              $data['custom_committees'] = $this->amendment_committees_update_model->get_all_custom_committee_names_of_coop($decoded_id);
                              // echo $this->db->last_query();
                              $data['cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_for_committee($decoded_id);
                              // $this->debug( $data['committee_info']);
                              $this->load->view('./template/header', $data);
                              $this->load->view('amendment/edit_form_committee', $data);
                              $this->load->view('./template/footer');
                            }else{
                                // $commitee_info = $this->amendment_committees_update_model->get_committee_info($decoded_committee_id);

                              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                              $data_com = array(
                                 'name'=> ($this->input->post('committeeName')=="Others") ? ucfirst(strtolower($this->input->post('committeeNameSpecify'))) : $this->input->post('committeeName'),
                                  'func_and_respons' => $this->input->post('func_and_respons'),
                                  // 'type' =>$this->input->post('type'),
                                'amendment_id' => $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID'))),
                                'id' => $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')))
                                );
                               // $this->debug($data_com);
                              $success = $this->amendment_committees_update_model->edit_committee($decoded_post_committee_id,$data_com);
                              // $this->debug($success);
                              if($success['success']){
                                $this->session->set_flashdata('committee_success', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_committees');
                              }else{
                                $this->session->set_flashdata('committee_error', $success['message']);
                                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_committees');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                          redirect('amendment/'.$id.'/amendment_committees');
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
                            if($this->amendment_committees_update_model->check_committee_in_cooperative($decoded_committee_id,$decoded_id)){ //check if committee is in cooperative
                              if($this->form_validation->run() == FALSE){
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                $data['title'] = 'List of Committees';
                                $data['header'] = 'Committee';
                                $data['encrypted_id'] = $id;
                                $data['encrypted_committee_id'] = $committee_id;
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['committee_info'] = $this->amendment_committees_update_model->get_committee_info($decoded_committee_id);
                                $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($data['committee_info']->cooperators_id);
                                $data['custom_committees'] = $this->amendment_committees_update_model->get_all_custom_committee_names_of_coop($decoded_id);
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
                                $success = $this->amendment_committees_update_model->edit_committee($decoded_post_committee_id,$data);
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
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID',TRUE)));
              //if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_committee_id)){
                // if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                  $success = $this->amendment_committees_update_model->delete_committee($decoded_post_committee_id);

                  if($success){
                    $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE).'/committees_update');
                  }else{
                    $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE).'/committees_update');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                  redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE.'/committees_update'));
                }
              //}else{
                //$this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                //redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE)."/committees");
              //}
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('amendment');
            // }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')==6){
           
              // if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
              //   if($this->amendment_model->check_first_evaluated($decoded_id)){
              //     $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
              //     redirect('amendment');
              //   }else{
                  $decoded_post_committee_id = $this->encryption->decrypt(decrypt_custom($this->input->post('committeeID')));
                  // if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                    $success = $this->amendment_committees_update_model->delete_committee($decoded_post_committee_id);
                    if($success){
                      $this->session->set_flashdata('committee_success', 'Committee has been deleted.');
                      redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE).'/committees_update');
                    }else{
                      $this->session->set_flashdata('committee_error', 'Unable to delete committee.');
                      redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE).'/committees_update');
                    }
                  // }else{
                  //   $this->session->set_flashdata('committee_redirect', 'Unauthorized!!.');
                  //   redirect('amendment_update/'.$this->input->post('cooperativeID',TRUE)."/committees_update");
                  // }
              //   }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
              //   redirect('amendment');
              // }
            }
          }
        }else{
          redirect('amendment_update');
        }
      }else{
        redirect('amendment_update');
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
    $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
    if(is_numeric($decoded_id) && $decoded_id!=0){
      if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
        if($this->input->get('fieldId') && $this->input->get('fieldValue')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatives_id'=>$coop_id
          );
          $result = $this->amendment_committees_update_model->check_committee_name_not_exists($data);
          echo json_encode($result);
        }else{
          
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
        echo"</pre>";
    }
}
