<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_survey extends CI_Controller{

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
      $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        $previouslyRegisteredWith = '00';
        $strategiesSupport = '000';
        $generateCapital = '00000';
        $investments = '000000';
        $equipments = '00000000000000';
        $procureEquipments = '000';
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
              if($data['bylaw_complete']){
                $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                // var_dump(  $data['cooperator_complete']);
                if($data['cooperator_complete']){
                  $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                  if($data['purposes_complete']){
                    $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                    if($data['article_complete']){
                      $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                      // echo $this->db->last_query();
                      // var_dump( $data['committees_complete']);
                      if($data['committees_complete']){
                          if(isset($_POST['economicSurveyBtn'])){
                              $temp = TRUE;
                          } else {
                              $temp = FALSE;
                          }
                        if($temp == FALSE){
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'Economic Survey';
                          $data['header'] = 'Economic Survey';
                          $data['encrypted_id'] = $id;
                          $survey_amend_count = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id_amend($decoded_id);
                          if($survey_amend_count==0){
                                $data['survey_info'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                          } else {
                                $data['survey_info'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                          }
                          // echo $this->db->last_query();
                          // $this->debug($data['survey_info']);
                          $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                           $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;
                          $this->load->view('template/header', $data);
                          $this->load->view('amendment/economic_survey_info/economic_survey_form', $data);
                          $this->load->view('template/footer');
                        }else{
                          if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                            $survey_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('survey_coop_id')));

                            // if($this->input->post('previouslyRegisteredWith')){
                            //   foreach($this->input->post('previouslyRegisteredWith') as $increase){
                            //     if($increase<3){
                            //       $previouslyRegisteredWith[$increase-1] = 1;
                            //     }
                            //   }
                            // }
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
                              'amendment_id'=>$decoded_id,
                              'background'=> $this->input->post('backgroundCooperative'),
                              'rationale'=> $this->input->post('rationaleCooperative'),
                              'increase_first_year'=> $this->input->post('increaseFirst'),
                              'increase_second_year'=> $this->input->post('increaseSecond'),
                              'increase_third_year'=> $this->input->post('increaseThird'),
                              'previously_registered_with'=> $this->input->post('previouslyRegisteredWith'), //SEC
                              'previously_registered_with_dole'=> $this->input->post('previouslyRegisteredWith_dole'),//DOLE
                              // 'previously_registered_with_others'=> (in_array(3,$this->input->post('previouslyRegisteredWith')) ? $this->input->post('registeredOthersSpecify') : ""),
                              'previously_registered_with_others'=> $this->input->post('previouslyRegisteredWith_other'),
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
                            // $this->debug($data);
                            $survey_amend_count = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id_amend($decoded_id);
	                          if($survey_amend_count==0){
	                          	
		                            if($this->amendment_economic_survey_model->insert_economic_survey($decoded_id,$data)){
		                              $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
		                              redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
		                            }else{
		                              $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
		                              redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
		                            }
	                          } else { 
		                              if($this->amendment_economic_survey_model->update_economic_survey($decoded_id,$data)){
		                              $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
		                              redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
		                             }else{
		                              $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
		                              redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
		                             }
	                          }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            redirect('amendment/'.$id);
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        redirect('amendment/'.$id);
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
            if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($decoded_id);
                        if($data['committees_complete']){
                          if($this->form_validation->run() == FALSE){
                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                            $data['title'] = 'Economic Survey';
                            $data['header'] = 'Economic Survey';
                            $data['encrypted_id'] = $id;
                            $data['survey_info'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                            $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                           $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;
                            $this->load->view('templates/admin_header', $data);
                            $this->load->view('amendment/economic_survey_info/economic_survey_form', $data);
                            $this->load->view('templates/admin_footer');
                          }else{
                            if($this->amendment_model->check_first_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                              redirect('amendment');
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
                                'previously_registered_with'=> $this->input->post('previouslyRegisteredWith'), //SEC,
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
                              $this->debug($data);
                              // if($this->economic_survey_model->update_economic_survey($survey_coop_id,$data)){
                              //   $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                              //   redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
                              // }else{
                              //   $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                              //   redirect('amendment/'.$this->input->post('survey_coop_id').'/amendment_survey');
                              // }
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          redirect('amendment/'.$id);
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
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the Economic Survey of the cooperative are not avaiable because it is not yet submitted for evaluation.');
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
  public function get_paid_up_capital($coop_id)
  {
   $qry = $this->db->select('total_amount_of_paid_up_capital')->where(array('amendment_id'=>$coop_id))->get('amendment_capitalization');
   if($qry->num_rows()>0)
   {
    return $qry->row();
   }
  }
  public function debug($array)
    {
    		echo"<pre>";
    		print_r($array);
    		echo"</pre>";
    }
}
