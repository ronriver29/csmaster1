<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('cooperatives_model');
    $this->load->model('bylaw_model');
    $this->load->model('capitalization_model');
    $this->load->model('cooperator_model');
    $this->load->model('purpose_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('committee_model');
    $this->load->model('economic_survey_model');
    $this->load->model('user_model');
    $this->load->model('staff_model');
    $this->load->model('admin_model');
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
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['title'] = 'List of Staff';
                              $data['header'] = 'Staff';
                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['encrypted_id'] = $id; 
                              $data['manager_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"manager");
                                // print_r( $data['manager_not_exists']);
                                // echo $this->db->last_query();
                              $data['accountant_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"accountant");
                              $data['bookkeeper_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"bookkeeper");
                              $data['cashier_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"cashier");
                              $data['collector_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"collector");
                              $data['sales_clerk_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"cales clerk");
                              $data['cashier_tresurer_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"cashier/treasurer"); //modified
                               // echo $this->db->last_query();
                               // var_dump(  $data['cashier_tresurer_not_exists']);
                              $data['requirements_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              // echo $this->db->last_query();
                             // var_dump($data['requirements_complete']);
                              $data['staff_list'] = $this->staff_model->get_all_staff_of_coop($decoded_id);
                              $this->load->view('./template/header', $data);
                              $this->load->view('staff/staff_list', $data);
                              $this->load->view('staff/delete_modal_staff');
                              $this->load->view('./template/footer');
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
                      if($data['coop_info']->grouping == 'Federation'){
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
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
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
                            if($data['coop_info']->grouping == 'Federation'){
                                $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                $data['gad_count'] = $this->committee_model->get_all_gad_count_union($data['coop_info']->users_id);
                            } else {
                                $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                            }
                          if($data['gad_count']>0){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                $data['title'] = 'List of Staff';
                                $data['header'] = 'Staff';
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                $data['encrypted_id'] = $id;
                                $data['manager_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Manager");
                                $data['accountant_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Accountant");
                                $data['bookkeeper_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Bookkeeper");
                                $data['cashier_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Cashier");
                                $data['collector_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Collector");
                                $data['sales_clerk_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"Sales clerk");
                                $data['sales_clerk_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"cashier/treasurer"); //modified
                                $data['cashier_tresurer_not_exists'] = $this->staff_model->check_position_not_exists($decoded_id,"cashier/treasurer"); //modified
                                $data['requirements_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                $data['staff_list'] = $this->staff_model->get_all_staff_of_coop($decoded_id);
                                $this->load->view('templates/admin_header', $data);
                                $this->load->view('staff/staff_list', $data);
                                $this->load->view('staff/delete_modal_staff');
                                $this->load->view('templates/admin_footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('cooperatives/'.$id);
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
                  $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the Economic Survey of the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
                          if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                if($this->form_validation->run() == FALSE){
                                  //modified by json
                                  $others_from_coop_position=$this->other_position($decoded_id);
                                  $position_qry = $this->db->get_where('staff_position',array('cooperative_id'=>0));
                                  if($position_qry->num_rows()>0)
                                  {
                                    foreach($position_qry->result_array() as $prow)
                                    {
                                    
                                      $list_of_positions[]=$prow;
                                    }
                                    // print_r($others_from_coop_position);
                                    if(is_array($others_from_coop_position)){
                                       $data['list_postion'] = array_merge($list_of_positions,$others_from_coop_position); 
                                    }
                                    else
                                    {
                                       $data['list_postion']=$list_of_positions;
                                    }
                                   
                                  }
                                  else
                                  {
                                    $data['list_postion'] =NULL;
                                  }
                                  $data['title'] = 'Staff';
                                  $data['header'] = 'Staff';
                                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                                  $data['encrypted_id'] = $id;
                             
                                  $this->load->view('./template/header', $data);
                                  $this->load->view('staff/add_form_staff', $data);
                                  $this->load->view('./template/footer');
                                }else{
                                  $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

                                  $input_position = strtolower($this->input->post('position'));
                                  if($input_position == 'others')
                                  {
                                    $new_position = $this->input->post('staffPositionSpecify');
                                    if($this->staff_model->check_position_($new_position,$decoded_id))
                                    {
                                       $this->session->set_flashdata('staff_error','"'.$new_position.'"'.' position already exist in dropdown selection.');
                                         redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                    }
                                    else
                                    {
                                      $other_position = array('position_name'=> $new_position,'cooperative_id'=>$decoded_id);
                                      $this->db->insert('staff_position',$other_position);
                                      $data = array(
                                    'cooperatives_id' => $decoded_post_coop_id,
                                    'full_name' => $this->input->post('fName'),
                                    'gender' => $this->input->post('gender'),
                                    'position' => $new_position,
                                    'position_others' => $this->input->post('staffPositionSpecify'),
                                    'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                    'birth_date' => $this->input->post('bDate'),
                                    'postal_address' => $this->input->post('pAddress'),
                                    'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                    'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                    );

                                      $success = $this->staff_model->add_staff($data);
                                      if($success['success']){ 
                                         $this->session->set_flashdata('staff_success', $success['message']);
                                         redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                         
                                        // $success1 = $this->amendment_staff_model->add_staff($data);
                                        // if($success1['success'])
                                        // {
                                        //   $this->session->set_flashdata('staff_success', $success['message']);
                                        //  redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');  
                                        // }
                                        

                                      }else{
                                        $this->session->set_flashdata('staff_error', $success['message']);
                                        redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }

                           }  
                                      
                                  }
                                  else
                                  {
                                      $data = array(
                                    'cooperatives_id' => $decoded_post_coop_id,
                                    'full_name' => $this->input->post('fName'),
                                    'gender' => $this->input->post('gender'),
                                    'position' => $input_position,
                                    'position_others' => $this->input->post('staffPositionSpecify'),
                                    'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                    'birth_date' => $this->input->post('bDate'),
                                    'postal_address' => $this->input->post('pAddress'),
                                    'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                    'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                    );
                                  $success = $this->staff_model->add_staff($data);
                                  if($success['success']){
                                       $this->session->set_flashdata('staff_success', $success['message']);
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                  }else{
                                    $this->session->set_flashdata('staff_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                  }
                                  }
                                  
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
                            $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                            if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete']){
                                if($this->form_validation->run() == FALSE){
                                  $data['title'] = 'Staff';
                                  $data['header'] = 'Staff';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('./templates/admin_header', $data);
                                  $this->load->view('staff/add_form_staff', $data);
                                  $this->load->view('./templates/admin_footer');
                                }else{
                                  $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                                  $data = array(
                                    'cooperatives_id' => $decoded_post_coop_id,
                                    'full_name' => $this->input->post('fName'),
                                    'gender' => $this->input->post('gender'),
                                    'position' => $this->input->post('position'),
                                    'position_others' => $this->input->post('staffPositionSpecify'),
                                    'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                    'birth_date' => $this->input->post('bDate'),
                                    'postal_address' => $this->input->post('pAddress'),
                                    'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                    'monthly_compensation' =>$this->input->post('monthlyCompensation')
                                    );
                                  $success = $this->staff_model->add_staff($data);
                                  if($success['success']){
                                    $this->session->set_flashdata('staff_success', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                  }else{
                                    $this->session->set_flashdata('staff_error', $success['message']);
                                    redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('cooperatives/'.$id);
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
                $this->session->set_flashdata('redirect_applications_message', 'Adding staff to the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
  function edit($id = null,$staff_id = null){
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
                  $assoc_query = $this->db->query("select count(type_of_member) as assoc_mem_count from cooperators where type_of_member='Associate' and cooperatives_id='$decoded_id'");
                    if($assoc_query->num_rows()>0)
                    {
                      foreach($assoc_query->result() as $res_count)
                      {
                        $assoc_ = $res_count->assoc_mem_count;
                      }
                    }
                    else
                    {
                      $assoc_ ='';
                    }
                    
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids, $assoc_);
                    }
                      
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id,$assoc_);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0 || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $decoded_staff_id = $this->encryption->decrypt(decrypt_custom($staff_id));
                              if($this->staff_model->check_staff_in_cooperative($decoded_id,$decoded_staff_id)){ //check if staff is in cooperative
                                if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                  if($this->form_validation->run() == FALSE){
                                    $data['title'] = 'Staff';
                                    $data['header'] = 'Staff';
                                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                                    $data['encrypted_id'] = $id;
                                    $data['encrypted_staff_id'] = $staff_id;
                                    $data['staff_info'] = $this->staff_model->get_staff_info($decoded_staff_id);

                                    //modify by json
                                  $others_from_coop_position=$this->other_position($decoded_id);
                                  $position_qry = $this->db->get_where('staff_position',array('cooperative_id'=>0));
                                  if($position_qry->num_rows()>0)
                                  {
                                    if(is_array($others_from_coop_position))
                                    {
                                       $data['list_position'] = array_merge($position_qry->result_array(),$others_from_coop_position);
                                    }
                                    else
                                    {
                                      $data['list_position'] = $position_qry->result_array();
                                    }
                                    
                                  }
                                  else
                                  {
                                    $data['list_postion'] =NULL;
                                  }

                                    $this->load->view('./template/header', $data);
                                    $this->load->view('staff/edit_form_staff', $data);
                                    $this->load->view('./template/footer');
                                  }else{

                                    $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                                  $input_position = strtolower($this->input->post('position'));                                  
                                  if($input_position == 'others')
                                  {
                                      $new_position = strtolower($this->input->post('staffPositionSpecify'));
                                      if($this->staff_model->check_position_($new_position))
                                      {
                                      $this->session->set_flashdata('staff_error','"'.ucfirst($new_position).'"'.' position already exist in dropdown selection.');
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }
                                      else
                                      {
                                          $other_position = array('position_name'=> $new_position,'cooperative_id'=>$decoded_id);
                                          $this->db->insert('staff_position',$other_position);
                                          $data = array(
                                          'full_name' => $this->input->post('fName'),
                                          'gender' => $this->input->post('gender'),
                                          'position' => $new_position,
                                          'position_others' => $this->input->post('staffPositionSpecify'),
                                          'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                          'birth_date' => $this->input->post('bDate'),
                                          'postal_address' => $this->input->post('pAddress'),
                                          'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                          'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                          );
                                            $success = $this->staff_model->edit_staff($decoded_post_staff_id,$data);
                                            if($success['success']){
                                            $this->session->set_flashdata('staff_success', $success['message']);
                                            echo"success";
                                            // redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                            }else{
                                            // $this->session->set_flashdata('staff_error', $success['message']);
                                            // redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                            }
                                      }//end check position
                                  }
                                  else // if others
                                  {
                                      $data = array(
                                      'full_name' => $this->input->post('fName'),
                                      'gender' => $this->input->post('gender'),
                                      'position' => $this->input->post('position'),
                                      'position_others' => $this->input->post('staffPositionSpecify'),
                                      'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                      'birth_date' => $this->input->post('bDate'),
                                      'postal_address' => $this->input->post('pAddress'),
                                      'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                      'monthly_compensation' =>str_replace(',', '',$this->input->post('monthlyCompensation'))
                                      );
                                      $success = $this->staff_model->edit_staff($decoded_post_staff_id,$data);
                                      if($success['success']){
                                      $this->session->set_flashdata('staff_success', $success['message']);
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }else{
                                      $this->session->set_flashdata('staff_error', $success['message']);
                                      redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }
                                  }///if others
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                  redirect('cooperatives/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                                redirect('cooperatives/'.$id.'/staff');
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
                        if($data['coop_info']->grouping == 'Federation'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        // echo $this->db->last_query();
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
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                              if($data['committees_complete']){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete']){
                                  $decoded_staff_id = $this->encryption->decrypt(decrypt_custom($staff_id));
                                  if($this->staff_model->check_staff_in_cooperative($decoded_id,$decoded_staff_id)){ //check if staff is in cooperative
                                    if($this->form_validation->run() == FALSE){
                                      $data['title'] = 'Staff';
                                      $data['header'] = 'Staff';
                                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                      $data['encrypted_id'] = $id;
                                      $data['encrypted_staff_id'] = $staff_id;
                                      $data['staff_info'] = $this->staff_model->get_staff_info($decoded_staff_id);
                                      $this->load->view('./templates/admin_header', $data);
                                      $this->load->view('staff/edit_form_staff', $data);
                                      $this->load->view('./templates/admin_footer');
                                    }else{
                                      $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                                      $data = array(
                                        'full_name' => $this->input->post('fName'),
                                        'gender' => $this->input->post('gender'),
                                        'position' => $this->input->post('position'),
                                        'position_others' => $this->input->post('staffPositionSpecify'),
                                        'status_of_appointment' => $this->input->post('statusOfAppointment'),
                                        'birth_date' => $this->input->post('bDate'),
                                        'postal_address' => $this->input->post('pAddress'),
                                        'minimum_education_experience_training' =>$this->input->post('minimumEducation'),
                                        'monthly_compensation' =>$this->input->post('monthlyCompensation')
                                        );
                                      $success = $this->staff_model->edit_staff($decoded_post_staff_id,$data);
                                      if($success['success']){
                                        $this->session->set_flashdata('staff_success', $success['message']);
                                        redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }else{
                                        $this->session->set_flashdata('staff_error', $success['message']);
                                        redirect('cooperatives/'.$this->input->post('cooperativesID').'/staff');
                                      }
                                    }
                                  }else{
                                    $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                                    redirect('cooperatives/'.$id.'/staff');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                  redirect('cooperatives/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                                redirect('cooperatives/'.$id);
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
                  $this->session->set_flashdata('redirect_applications_message', 'Editing staff of the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
  function delete_staff(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteStaffBtn')){

          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
                $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                if($this->staff_model->check_staff_in_cooperative($decoded_id,$decoded_post_staff_id)){
                  if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    $success = $this->staff_model->delete_staff($decoded_post_staff_id);
                    if($success){
                      $this->session->set_flashdata('delete_staff_success', 'Staff has been deleted.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
                    }else{
                      $this->session->set_flashdata('delete_staff_error', 'Unable to delete staff.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                  redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
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
                $decoded_post_staff_id = $this->encryption->decrypt(decrypt_custom($this->input->post('staffID')));
                if($this->staff_model->check_staff_in_cooperative($decoded_id,$decoded_post_staff_id)){
                  if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                      $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                      redirect('cooperatives');
                    }else{
                      $success = $this->staff_model->delete_staff($decoded_post_staff_id);
                      if($success){
                        $this->session->set_flashdata('delete_staff_success', 'Staff has been deleted.');
                        redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
                      }else{
                        $this->session->set_flashdata('delete_staff_error', 'Unable to delete staff.');
                        redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
                      }
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'Deleting staff of the cooperative are not avaiable because it is not yet submitted for evaluation.');
                    redirect('cooperatives');
                  }
                }else{
                  $this->session->set_flashdata('staff_redirect', 'Unauthorized!!');
                  redirect('cooperatives/'.$this->input->post('cooperativeID').'/staff');
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
  public function other_position($coop_id)
  {
    $qry=$this->db->query("select * from staff_position where cooperative_id={$coop_id}");
    if($qry->num_rows()>0)
    {
      foreach($qry->result_array() as $row)
      {
        $data[]=$row;
      }
    }
    else
    {
      $data=NULL;
    }
    return $data;
  }
   public function debug($array)
    {
      if(is_array($array))
      {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
      }
      else
      {
        echo "null value";
      }

    }
}
