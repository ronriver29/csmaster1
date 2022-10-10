<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplified_survey extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('cooperatives_model');
    $this->load->model('affiliators_model');
    $this->load->model('unioncoop_model');
    $this->load->model('cooperator_model');
    $this->load->model('purpose_model');
    $this->load->model('committee_model');
    $this->load->model('user_model');
    $this->load->model('economic_survey_model');
    $this->load->model('capitalization_model');
    $this->load->model('admin_model');
    $this->load->model('bylaw_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('region_model');
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
        $initial_capital = '0000';
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
                          $data['survey_info'] = $this->economic_survey_model->get_simplified_economic_survey_by_coop_id($decoded_id);
                          $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                          $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;

                          $data['audit_committee'] = $this->committee_model->get_all_audit($user_id);
                          $data['bod_committee'] = $this->committee_model->get_all_bod($decoded_id);
                          $data['election_committee'] = $this->committee_model->get_all_election($user_id);
                          $data['secretary_committee'] = $this->committee_model->get_all_secretary($decoded_id);
                          $data['treasurer_committee'] = $this->committee_model->get_all_treasurer($decoded_id);
                          $data['medcon_committee'] = $this->committee_model->get_all_medcon($user_id);
                          $data['ethics_committee'] = $this->committee_model->get_all_ethics($user_id);
                          $data['gad_committee'] = $this->committee_model->get_all_gad($user_id);
                          $data['other_committee'] = $this->committee_model->get_all_other($user_id);

                          $this->load->view('template/header', $data);
                           $this->load->view('cooperative/economic_survey_info/simplified_economic_survey_form', $data);
                            $this->load->view('template/footer');
                        }else{
                          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                            $survey_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('survey_coop_id')));

                            if($this->input->post('initial_capital')){
                              foreach($this->input->post('initial_capital') as $strategy){
                                if($strategy<5){
                                  $initial_capital[$strategy-1] = 1;
                                }
                              }
                            }

                            $if_econ_exist = $this->economic_survey_model->simplified_econ_exist($survey_coop_id);
                            if($if_econ_exist){
                              $data = array(
                                'nature_of_business'=> $this->input->post('natureofbusiness'),
                                'initial_capital'=> $initial_capital,
                                'initial_capital_others'=> $this->input->post('initialCapitalSpecify')
                              );

                              if($this->economic_survey_model->update_simplified_economic_survey($survey_coop_id,$data)){
                                $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
                              }else{
                                $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
                              }
                            } else {
                              $data = array(
                                'cooperatives_id'=> $survey_coop_id,
                                'nature_of_business'=> $this->input->post('natureofbusiness'),
                                'initial_capital'=> $initial_capital,
                                'initial_capital_others'=> $this->input->post('initialCapitalSpecify'),
                                'documents' => $filenameuser
                              );

                              if($this->economic_survey_model->insert_simplified_economic_survey($survey_coop_id,$data)){
                                $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
                              }else{
                                $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
                              }
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
                            $data['survey_info'] = $this->economic_survey_model->get_simplified_economic_survey_by_coop_id($decoded_id);
                            // $data['last_query'] = $this->db->last_query();
                            $capital_init =$this->get_paid_up_capital($decoded_id); //modify by json
                            $data['InitialCapital'] = $capital_init->total_amount_of_paid_up_capital;

                            $data['audit_committee'] = $this->committee_model->get_all_audit($data['coop_info']->users_id);
                            $data['bod_committee'] = $this->committee_model->get_all_bod($decoded_id);
                            $data['election_committee'] = $this->committee_model->get_all_election($data['coop_info']->users_id);
                            $data['secretary_committee'] = $this->committee_model->get_all_secretary($decoded_id);
                            $data['treasurer_committee'] = $this->committee_model->get_all_treasurer($decoded_id);
                            $data['medcon_committee'] = $this->committee_model->get_all_medcon($data['coop_info']->users_id);
                            $data['ethics_committee'] = $this->committee_model->get_all_ethics($data['coop_info']->users_id);
                            $data['gad_committee'] = $this->committee_model->get_all_gad($data['coop_info']->users_id);
                            $data['other_committee'] = $this->committee_model->get_all_other($data['coop_info']->users_id);

                            $this->load->view('templates/admin_header', $data);
                            $this->load->view('cooperative/economic_survey_info/simplified_economic_survey_form', $data);
                            $this->load->view('templates/admin_footer');
                          }else{
                            if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                              redirect('cooperatives');
                            }else{
                              $survey_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('survey_coop_id')));
                              if($this->input->post('initial_capital')){
                                foreach($this->input->post('initial_capital') as $increase){
                                  if($increase<4){
                                    $initial_capital[$increase-1] = 1;
                                  }
                                }
                              }
                              $data = array(
                                'nature_of_business'=> $this->input->post('natureofbusiness'),
                                'initial_capital'=> $initial_capital,
                                'initial_capital_others'=> $this->input->post('initialCapitalSpecify'),
                              );
                              if($this->economic_survey_model->update_economic_survey($survey_coop_id,$data)){
                                $this->session->set_flashdata('survey_update_success', 'Successfully Updated');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
                              }else{
                                $this->session->set_flashdata('survey_update_error', 'Unable to update economic survey additional info');
                                redirect('cooperatives/'.$this->input->post('survey_coop_id').'/simplified_survey');
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

  public function download($id = null,$ext){
        $this->load->helper('download');
        $data = file_get_contents(UPLOAD_DIR.'/'.$id);
        force_download('file.'.$ext, $data);

    }

  function reArrayFiles($file)
    {
        $file_ary = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);

        for($i=0;$i<$file_count;$i++)
        {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
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
