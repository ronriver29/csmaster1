<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Options;
class Documents_branch_update extends CI_Controller{
   var $pageCount = array();
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
      $this->load->library('pdf');
      $this->load->model('cooperatives_model');
      $this->load->model('bylaw_model');
      $this->load->model('capitalization_model');
      $this->load->model('cooperator_model');
      $this->load->model('purpose_model');
      $this->load->model('article_of_cooperation_model');
      $this->load->model('committee_model');
      $this->load->model('economic_survey_model');
      $this->load->model('staff_model');
      $this->load->model('user_model');
      $this->load->model('charter_model');
      $this->load->model('branches_model');
      $this->load->model('uploaded_document_model');
      $this->load->model('admin_model');
      $this->load->model('region_model');
      $this->load->model('laboratories_model');
      $this->load->model('affiliators_model');
      $this->load->model('unioncoop_model');
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
                          } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                          } else {
                              $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                          }
                          if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                  $data['document_others2'] = NULL;
                                    $data['document_others'] =NULL;
                                if(!empty($data['coop_type']))
                                {
                                  foreach($data['coop_type'] as $key => $docs_type)
                                  {
                                    if($key==0)
                                    // {
                                    //   if($data['coop_info']->status==11) //deferred
                                    //   {
                                    //    $data['document_others']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                    //   }
                                    //   else
                                    //   {
                                       $data['document_others']= $this->get_documentss($decoded_id,$docs_type['document_num']);//$this->count_documents_others($decoded_id,$docs_type['document_num']);
                                      // }
                                    }

                                    if($key==1)
                                    {
                                      // if($data['coop_info']->status==11) //deferred
                                      // {
                                      //  $data['document_others2']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                      // }
                                      // else
                                      {
                                       $data['document_others2']= $this->get_documentss($decoded_id,$docs_type['document_num']);
                                      // }
                                    }
                                  }
                                }


                                $data['title'] = 'List of Documents';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $data['uid'] = $this->session->userdata('user_id');
                                $data['cid'] = $decoded_id;
                                $data['encrypted_id'] = $id;

                                // if($data['coop_info']->status==11) //deferred
                                // {
                                //   $data['document_one']= $this->defered_count_documents($decoded_id,1);
                                //   $data['document_two']= $this->defered_count_documents($decoded_id,2);
                                // }
                                // else
                                // {
                                  $data['document_one'] = $this->get_documentss($decoded_id,1);//$this->count_documents($decoded_id,1);
                                  if($data['document_one'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,1);
                                  }
                                   $data['document_two'] =$this->get_documentss($decoded_id,2);
                                  if($data['document_two'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,2);
                                  }
                                  $data['document_three'] =$this->get_documentss($decoded_id,3);
                                  if($data['document_three'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,3);
                                  }
                                  $data['document_four'] =$this->get_documentss($decoded_id,41);
                                  if($data['document_four'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,41);
                                  }
                                  $data['document_others_unifed'] =$this->get_documentss($decoded_id,42);
                                  if($data['document_others_unifed'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,42);
                                  }
                                // }
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $this->load->view('documents/list_of_documents_federation', $data);
                                } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                  $this->load->view('documents/list_of_documents_union', $data);
                                } else {
                                    $this->load->view('documents/list_of_documents', $data);
                                }

                                $this->load->view('template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
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
            }else{
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
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_union($data['coop_info']->users_id);
                            } else {
                              $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                            }
                            if($data['gad_count']>0){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                    $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);

                                  $data['document_others2'] = NULL;
                                    $data['document_others'] =NULL;
                                if(!empty($data['coop_type']))
                                {
                                  foreach($data['coop_type'] as $key => $docs_type)
                                  {
                                    if($key==0)
                                    {
                                    //   if($data['coop_info']->status==11) //deferred
                                    //   {
                                    //    $data['document_others']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                    //   }
                                    //   else
                                    //   {
                                       $data['document_others']= $this->get_documentss($decoded_id,$docs_type['document_num']);//$this->count_documents_others($decoded_id,$docs_type['document_num']);
                                      // }
                                    }

                                    if($key==1)
                                    {

                                       $data['document_others2']= $this->get_documentss($decoded_id,$docs_type['document_num']);

                                    }
                                  }
                                }

                                  $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);
                                  $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($decoded_id);
                                  $data['cooperatives_comments_snr_defer'] = $this->cooperatives_model->cooperatives_comments_snr_defer($decoded_id);
                                  $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);

                                  if($this->cooperatives_model->check_if_revert($decoded_id)){
                                    $data['cooperatives_comments'] = $this->cooperatives_model->director_comments_revert($decoded_id);
                                    $data['cooperatives_comments_defer'] = $this->cooperatives_model->director_comments_defer_revert($decoded_id);
                                    $data['supervising_comment']  = $this->cooperatives_model->admin_supervising_cds_comments_revert($decoded_id);
                                  } else {
                                    $data['cooperatives_comments'] = $this->cooperatives_model->director_comments($decoded_id);
                                    $data['cooperatives_comments_defer'] = $this->cooperatives_model->director_comments_defer($decoded_id);
                                    $data['supervising_comment']  = $this->cooperatives_model->admin_supervising_cds_comments($decoded_id);
                                  }
                                  $data['denied_comments'] = $this->cooperatives_model->denied_comments($decoded_id);
                                  $data['cooperatives_comments_snr_revert'] = $this->cooperatives_model->cooperatives_comments_snr_revert($decoded_id);
                                  $data['cooperatives_comments_snr_revert_defer'] = $this->cooperatives_model->cooperatives_comments_snr_revert_defer($decoded_id);

                                  $data['title'] = 'List of Documents';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $data['uid'] = $this->session->userdata('user_id');
                                  $data['cid'] = $decoded_id;
                                  $data['encrypted_id'] = $id;
                                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                                  $data['document_three'] = $this->uploaded_document_model->get_document_three_info($decoded_id);
                                  $data['document_four'] = $this->uploaded_document_model->get_document_four_info($decoded_id);
                                  $data['document_others_unifed'] = $this->uploaded_document_model->get_document_others_unifed_info($decoded_id);
                                  $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                                  $data['is_active_director'] = $this->admin_model->is_active_director($user_id);

                                  $this->load->view('templates/admin_header', $data);
                                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $this->load->view('documents/list_of_documents_federation', $data);
                                  } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                    $this->load->view('documents/list_of_documents_union', $data);
                                  } else {
                                      $this->load->view('documents/list_of_documents', $data);
                                  }
                                  $this->load->view('cooperative/evaluation/approve_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/deny_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/defer_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/revert_modal_cooperative');
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  // echo"dito";
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                  redirect('cooperatives/'.$id);
                                }
                              } else {
                                // echo"hear";
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
                            } else {
                              // echo"ddd";
                              // echo $this->db->last_query();
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('cooperatives/'.$id);
                            }
                          } else {
                            // echo"dddddf";
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

  function branch($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->branches_model->check_own_branch($decoded_id,$user_id)){

                $branch_info = $this->branches_model->get_branch_info_migrated($decoded_id);
                $data['branch_info'] = $branch_info;
                // Ammend
                $branch_info_amend = $this->branches_model->get_branch_info_amend_migrated($decoded_id);
                // echo $this->db->last_query();
                $data['branch_info_amend'] = $branch_info_amend;
                // End
                // $data['home'] = $branch_info_amend->amendment_id;
                $data['title'] = 'List of Documents';
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['header'] = 'Documents';
                $data['uid'] = $this->session->userdata('user_id');
                $data['bid'] = $decoded_id;
                $data['cid'] = $branch_info->application_id;
                $data['encrypted_branch_id'] = $id;
                $data['type']=substr($branch_info->branchName, -7);
                if($this->branches_model->check_if_amended_branch_migrate($branch_info->regNo)){

                  $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->ammend_id));
                  $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->branch_id));
                } else {
                  $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                  $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info->id));
                }
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_three'] = $this->uploaded_document_model->get_document_three_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($branch_info->id,$branch_info->application_id);
                $data['document_others_unifed'] = $this->uploaded_document_model->get_document_42_info($branch_info->id,$branch_info->application_id);
                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['branch_info']->type);

                $data['in_chartered_cities'] =false;
                // $this->debug();
                if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                {
                  $data['in_chartered_cities']=true;
                  $data['chartered_cities'] = $this->charter_model->get_charter_city($data['branch_info']->cCode);
                }
                // $data['ca_user_info'] = $this->sfc_model->get_cais_user($data['branch_info']->regNo);
                if(isset($data['ca_user_info'])>0){
                  $data['cafsis_info'] = $this->profile_model->get_saved_data_document($data['ca_user_info']->id);
                }

                $this->load->view('template/header', $data);
                $this->load->view('documents/list_of_documents_branch_updating', $data);
                $this->load->view('template/footer');

            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('branches');
            // }


          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
//                if($this->branches_model->check_submitted_for_evaluation($decoded_id)) {
                  //
                  // $branch_info=$this->branches_model->get_branch_info_by_admin($decoded_id);
                  $branch_info = $this->branches_model->get_branch_info_migrated($decoded_id);
                  $data['branch_info'] = $branch_info;
                  // Ammend
                  $branch_info_amend = $this->branches_model->get_branch_info_amend_migrated($decoded_id);
                  $data['branch_info_amend'] = $branch_info_amend;
                  $data['last_query'] = $this->db->last_query();
                  // End
                  $data['branch_info'] = $branch_info;
                  $data['title'] = 'List of Documents';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['header'] = 'Documents';
                  $data['uid'] = $this->session->userdata('user_id');
                  $data['bid'] = $decoded_id;
                  $data['cid'] = $decoded_id;
                  $data['encrypted_branch_id'] = $id;
                  // $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                  if($this->branches_model->check_if_amended_branch_migrate($branch_info->regNo)){
                    $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->ammend_id));
                    $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->branch_id));
                  } else {
                    $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                    $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info->id));
                  }

                  // $data['branches_comments_cds'] = $this->branches_model->branches_comments_cds($branch_info->id);
                  if($branch_info->status == 23){
                      $evaluator_number = $branch_info->evaluator1;
                  } else {
                      $evaluator_number = $branch_info->evaluator4;
                  }

                  $data['branches_comments_main'] = $this->branches_model->branches_comments_main($branch_info->id,$branch_info->evaluator2);
                  // $data['last_query'] = $this->db->last_query();
                  // New
                  $data['branches_comments_cds'] = $this->branches_model->branches_comments_cds($branch_info->id);
                  $data['branches_comments_snr'] = $this->branches_model->branches_comments_snr($branch_info->id,$evaluator_number);
                  $data['branches_comments_snr_limit'] = $this->branches_model->branches_comments_snr_limit($branch_info->id,$evaluator_number);
                  //
                  // $data['branches_comments_snr'] = $this->branches_model->branches_comments_snr($branch_info->id,$evaluator_number);
                  $data['branches_comments_level1_defer'] = $this->branches_model->branches_comments_level1_defer($branch_info->id);

                  $data['branches_comments'] = $this->branches_model->branches_comments($branch_info->id,$branch_info->evaluator5);
                  $data['branches_comments_director'] = $this->branches_model->branches_comments_director($branch_info->id,$branch_info->evaluator2);
                  $data['branches_comments_director_limit'] = $this->branches_model->branches_comments_director_limit($branch_info->id,$branch_info->evaluator5);

                  // Outside Comments
                  $data['branches_comments_director_level1'] = $this->branches_model->branches_comments_director_level1($branch_info->id,$branch_info->evaluator2);
                  $data['branches_comments_snr_limit_level1'] = $this->branches_model->branches_comments_snr_limit_level1($branch_info->id,$evaluator_number);
                  // END New
                $data['type']=substr($branch_info->branchName, -7);
                // $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_three'] = $this->uploaded_document_model->get_document_three_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($branch_info->id,$branch_info->application_id);
                $data['document_others_unifed'] = $this->uploaded_document_model->get_document_42_info($branch_info->id,$branch_info->application_id);


                $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                $data['is_active_director'] = $this->admin_model->is_active_director($user_id);
                $data['business_activities'] =  $this->branches_model->get_all_business_activities($branch_info->id);
                if($data['branch_info']->area_of_operation == 'Interregional'){
                  $data['regions_island_list'] = $this->region_model->get_selected_regions($branch_info->regions);
                }
                  $this->load->view('templates/admin_header', $data);
                  $this->load->view('documents/list_of_documents_branch_updating', $data);
                  $this->load->view('cooperative/evaluation/approve_modal_branch');
                  $this->load->view('cooperative/evaluation/deny_modal_branch');
                  $this->load->view('cooperative/evaluation/defer_modal_branch');
                  $this->load->view('templates/admin_footer');
//                } else{
//                  $this->session->set_flashdata('redirect_applications_message', 'The branches is not yet submitted for evaluation.');
//                  redirect('branches');
//                }

            }
          }
        }else{
          show_404();
        }
    }
  }

  function upload_document_others_bns($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        // if($this->session->userdata('client')){
          // if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_others_bns', $data);
                $this->load->view('./template/footer');
          // }else{
          //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!.');
          //   redirect('branches');
          // }
        // }else{
        //   if($this->session->userdata('access_level')==5){
        //     redirect('admins/login');
        //   }else{
        //     $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
        //     redirect('branches/'.$id);
        //   }
        // }
      }else{
        show_404();
      }
    }
  }
}
