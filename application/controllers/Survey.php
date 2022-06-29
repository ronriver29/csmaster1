<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller{

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
    $this->load->model('user_model');
    $this->load->model('economic_survey_model');
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
        $previouslyRegisteredWith = '00';
        $strategiesSupport = '000';
        $generateCapital = '00000';
        $investments = '000000';
        $equipments = '00000000000000';
        $procureEquipments = '000';
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
                    
                    
                if($data['cooperator_complete']){
                  $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                  if($data['purposes_complete']){
                    $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                    if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                        if($this->form_validation->run() == FALSE){
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'Economic Survey';
                          $data['header'] = 'Economic Survey';
                          $data['encrypted_id'] = $id;
                          $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                          $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                           $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;
                        
                          $this->load->view('template/header', $data);
                           $this->load->view('cooperative/economic_survey_info/economic_survey_form', $data);
                            $this->load->view('template/footer');
                        }else{
                          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                            $survey_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('survey_coop_id')));
                            // if($this->input->post('previouslyRegisteredWith')){
                            //   foreach($this->input->post('previouslyRegisteredWith') as $increase){
                            //     if($increase<3){
                            //       $previouslyRegisteredWith[$increase-1] = 1;
                            //     }
                            //   }
                            // }
                          //end modify

                            if($this->input->post('strategiesSupport')){
                              foreach($this->input->post('strategiesSupport') as $strategy){
                                if($strategy<4){
                                  $strategiesSupport[$strategy-1] = 1;
                                }
                              }
                            }
                            if($this->input->post('generateCapital')){
                              foreach($this->input->post('generateCapital') as $genCapital){
                                $generateCapital[$genCapital-1] = 1;
                              }
                            }
                            if($this->input->post('investments')){
                              foreach($this->input->post('investments') as $invest){
                                if($invest<6){
                                  $investments[$invest-1] = 1;
                                }
                              }
                            }
                            if($this->input->post('equipments')){
                              foreach($this->input->post('equipments') as $equip){
                                if($equip<15){
                                  $equipments[$equip-1] = 1;
                                }
                              }
                            }
                            if($this->input->post('procureEquipments')){
                              foreach($this->input->post('procureEquipments') as $procure){
                                if($procure<4){
                                  $procureEquipments[$procure-1] = 1;
                                }
                              }
                            }

                            $prev_reg_sec = $this->input->post('previouslyRegisteredWith');
                            $prev_reg_dole =  $this->input->post('previouslyRegisteredWith_dole');
                            $prev_reg_none = $this->input->post('previously_registered_with_none');
                            $prev_reg_others = $this->input->post('registeredOthersSpecify');
                            if(empty($prev_reg_sec) && empty($prev_reg_dole) && empty($prev_reg_none) && empty($prev_reg_others))
                            {
                              $this->session->set_flashdata('survey_update_error', 'The Proposed Cooperative previously registered with is required');
                              redirect('cooperatives/'.$this->input->post('survey_coop_id').'/survey');
                            }

                            $data = array(
                              'background'=> $this->input->post('backgroundCooperative'),
                              'rationale'=> $this->input->post('rationaleCooperative'),
                              'increase_first_year'=> $this->input->post('increaseFirst'),
                              'increase_second_year'=> $this->input->post('increaseSecond'),
                              'increase_third_year'=> $this->input->post('increaseThird'),
                              'previously_registered_with'=> $prev_reg_sec,
                              'previously_registered_with_dole'=> $prev_reg_dole,
                              'previously_registered_with_none'=> $prev_reg_none,
                              'previously_registered_with_others'=> $prev_reg_others,
                              'exisiting_cooperative_same_area'=> $this->input->post('sameArea'),
                              'strategies_support_members'=> $strategiesSupport,
                              'strategies_support_members_others'=> (in_array(4,$this->input->post('strategiesSupport')) ? $this->input->post('strategiesSupportOthersSpecify'): ""),
                              'transact_business_with'=> $this->input->post('transactBusiness'),
                              'bactivities_plans_first_year'=> $this->input->post('businessActivityFirst'),
                              'bactivities_plans_second_year'=> $this->input->post('businessActivitySecond'),
                              'bactivities_plans_third_year'=> $this->input->post('businessActivityThird'),
                              'generate_capital'=> $generateCapital,
                              'amount_initial_operating_capital'=> $this->input->post('initialCapital'),
                              'strategy_capital_build_up'=> $this->input->post('strategyCapitalBuildUp'),
                              'revenue_first_year'=> $this->input->post('revenueFirst'),
                              'revenue_second_year'=> $this->input->post('revenueSecond'),
                              'revenue_third_year'=> $this->input->post('revenueThird'),
                              'expenditure_first_year'=> $this->input->post('expenditureFirst'),
                              'expenditure_second_year'=> $this->input->post('expenditureSecond'),
                              'expenditure_third_year'=> $this->input->post('expenditureThird'),
                              'investments'=> $investments,
                              'investments_others'=> (in_array(6,$this->input->post('investments')) ? $this->input->post('investOthersSpecify') : ""),
                              'equipments_etc'=> $equipments,
                              'equipments_etc_others'=> (in_array(15,$this->input->post('equipments')) ? $this->input->post('equipmentOthersSpecify') : ""),
                              'procure_equipments_etc'=> $procureEquipments,
                              'procure_equipments_etc_others'=> (in_array(4,$this->input->post('procureEquipments')) ? $this->input->post('procureEquipmentOthersSpecify') : ""),
                              'skills_etc_necessary_equipments_etc'=> $this->input->post('necessarySkills'),
                              'qualifications_directors'=> $this->input->post('qualificationsBoard'),
                              'education_programs_members'=> $this->input->post('educationProgramMembers'),
                              'education_programs_officers'=> $this->input->post('educationProgramOfficers'),
                              'education_programs_staff'=> $this->input->post('educationProgramStaff'),
                            );

                            // echo "<pre>";
                            // echo print_r($data);
                            // echo "<pre";

                            if($this->economic_survey_model->update_economic_survey($survey_coop_id,$data)){
                              $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                              redirect('cooperatives/'.$this->input->post('survey_coop_id').'/survey');
                            }else{
                              $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                              redirect('cooperatives/'.$this->input->post('survey_coop_id').'/survey');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('cooperatives/'.$id);
                          }
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
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                                $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                            } else {
                                $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                            }
                          if($data['gad_count']>0){
                          if($this->form_validation->run() == FALSE){
                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                            $data['title'] = 'Economic Survey';
                            $data['header'] = 'Economic Survey';
                            $data['encrypted_id'] = $id;
                            $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                            $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                            $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;
                            $this->load->view('templates/admin_header', $data);
                            $this->load->view('cooperative/economic_survey_info/economic_survey_form', $data);
                            $this->load->view('templates/admin_footer');
                          }else{
                            if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                              redirect('cooperatives');
                            }else{
                              $survey_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('survey_coop_id')));
                              if($this->input->post('previouslyRegisteredWith')){
                                foreach($this->input->post('previouslyRegisteredWith') as $increase){
                                  if($increase<3){
                                    $previouslyRegisteredWith[$increase-1] = 1;
                                  }
                                }
                              }
                              if($this->input->post('strategiesSupport')){
                                foreach($this->input->post('strategiesSupport') as $strategy){
                                  if($strategy<4){
                                    $strategiesSupport[$strategy-1] = 1;
                                  }
                                }
                              }
                              if($this->input->post('generateCapital')){
                                foreach($this->input->post('generateCapital') as $genCapital){
                                  $generateCapital[$genCapital-1] = 1;
                                }
                              }
                              if($this->input->post('investments')){
                                foreach($this->input->post('investments') as $invest){
                                  if($invest<6){
                                    $investments[$invest-1] = 1;
                                  }
                                }
                              }
                              if($this->input->post('equipments')){
                                foreach($this->input->post('equipments') as $equip){
                                  if($equip<15){
                                    $equipments[$equip-1] = 1;
                                  }
                                }
                              }
                              if($this->input->post('procureEquipments')){
                                foreach($this->input->post('procureEquipments') as $procure){
                                  if($procure<4){
                                    $procureEquipments[$procure-1] = 1;
                                  }
                                }
                              }
                              $data = array(
                                'background'=> $this->input->post('backgroundCooperative'),
                                'rationale'=> $this->input->post('rationaleCooperative'),
                                'increase_first_year'=> $this->input->post('increaseFirst'),
                                'increase_second_year'=> $this->input->post('increaseSecond'),
                                'increase_third_year'=> $this->input->post('increaseThird'),
                                'previously_registered_with'=> $previouslyRegisteredWith,
                                'previously_registered_with_others'=> (in_array(3,$this->input->post('previouslyRegisteredWith')) ? $this->input->post('registeredOthersSpecify') : ""),
                                'exisiting_cooperative_same_area'=> $this->input->post('sameArea'),
                                'strategies_support_members'=> $strategiesSupport,
                                'strategies_support_members_others'=> (in_array(4,$this->input->post('strategiesSupport')) ? $this->input->post('strategiesSupportOthersSpecify'): ""),
                                'transact_business_with'=> $this->input->post('transactBusiness'),
                                'bactivities_plans_first_year'=> $this->input->post('businessActivityFirst'),
                                'bactivities_plans_second_year'=> $this->input->post('businessActivitySecond'),
                                'bactivities_plans_third_year'=> $this->input->post('businessActivityThird'),
                                'generate_capital'=> $generateCapital,
                                'amount_initial_operating_capital'=> $this->input->post('initialCapital'),
                                'strategy_capital_build_up'=> $this->input->post('strategyCapitalBuildUp'),
                                'revenue_first_year'=> $this->input->post('revenueFirst'),
                                'revenue_second_year'=> $this->input->post('revenueSecond'),
                                'revenue_third_year'=> $this->input->post('revenueThird'),
                                'expenditure_first_year'=> $this->input->post('expenditureFirst'),
                                'expenditure_second_year'=> $this->input->post('expenditureSecond'),
                                'expenditure_third_year'=> $this->input->post('expenditureThird'),
                                'investments'=> $investments,
                                'investments_others'=> (in_array(6,$this->input->post('investments')) ? $this->input->post('investOthersSpecify') : ""),
                                'equipments_etc'=> $equipments,
                                'equipments_etc_others'=> (in_array(15,$this->input->post('equipments')) ? $this->input->post('equipmentOthersSpecify') : ""),
                                'procure_equipments_etc'=> $procureEquipments,
                                'procure_equipments_etc_others'=> (in_array(4,$this->input->post('procureEquipments')) ? $this->input->post('procureEquipmentOthersSpecify') : ""),
                                'skills_etc_necessary_equipments_etc'=> $this->input->post('necessarySkills'),
                                'qualifications_directors'=> $this->input->post('qualificationsBoard'),
                                'education_programs_members'=> $this->input->post('educationProgramMembers'),
                                'education_programs_officers'=> $this->input->post('educationProgramOfficers'),
                                'education_programs_staff'=> $this->input->post('educationProgramStaff'),
                              );
                              if($this->economic_survey_model->update_economic_survey($survey_coop_id,$data)){
                                $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/survey');
                              }else{
                                $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/survey');
                              }
                            }
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


  //modify by json
  public function get_paid_up_capital($coop_id)
  {
   $qry = $this->db->select('total_amount_of_paid_up_capital')->where(array('cooperatives_id'=>$coop_id))->get('capitalization');
   if($qry->num_rows()>0)
   {
    return $qry->row();
   }
  }
  
}
