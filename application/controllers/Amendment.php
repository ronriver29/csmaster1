<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class amendment extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
    }
  
    public function saveor($was){
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'status' =>1
      );

      $this->amendment_model->save_OR(array('id' => $this->input->post('payment_id')), $data, $this->input->post('tae'));
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
      
    }

    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of Cooperatives';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Amendment';
          $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives($this->session->userdata('user_id'));
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_amendment', $data);
          $this->load->view('amendment/delete_modal_cooperative');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Amendment';
            $data['header'] = 'Amendment';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $this->load->view('templates/admin_header', $data);

            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
              $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
            }else{
              $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
            }
            $this->load->view('applications/list_of_amendment', $data);
            $this->load->view('applications/assign_admin_modal_amendment');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }
        }
      }
    }

    public function application(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Application Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Amendment';
              $data['regions_list'] = $this->region_model->get_regions();
              $data['composition'] = $this->cooperatives_model->get_composition();
              if(isset($_POST['amendmentAddBtn'])){
                  $temp = TRUE;
              } else {
                  $temp = FALSE;
              }
              if ($temp == FALSE){
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/amendment_detail', $data);
//                $this->load->view('cooperative/terms_and_condition');
                $this->load->view('./template/footer');
              }else{
                $subclass_array = $this->input->post('subClass');
                $major_industry = $this->input->post('majorIndustry');
                $members_composition = $this->input->post('compositionOfMembers');
                if ($this->input->post('categoryOfCooperative')=='Primary'){
                  $category ='Primary';
                  $group='';
                }else{
                  $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                  $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                }
                $regNo = $this->input->post('regNo');
                $coop_id = "";
                $query_coop_id = $this->db->select("application_id")->where("regNo",$regNo)->get("registeredcoop");
                if($query_coop_id->num_rows()>0) {
                    $rowd = $query_coop_id->row_array();
                    $coop_id = $rowd['application_id'];
                }
                $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));
                $field_data = array(
                  'users_id' => $this->session->userdata('user_id'),
                  'id' => $coop_id,
                  'regNo' => $this->input->post('regNo'),
                  'category_of_cooperative' => $category,
                  'proposed_name' => $this->input->post('newName'),
                  'type_of_cooperative' => $typeOfCooperative,
                  'grouping' => $group,
                  'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                  'area_of_operation' => $this->input->post('areaOfOperation'),
                  'refbrgy_brgyCode' => $this->input->post('barangay'),
                  'street' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'created_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                );
                
                if($this->amendment_model->add_cooperative($field_data,$major_industry,$subclass_array,$members_composition)){
                  $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
                  redirect('amendment');
                }else{
                  $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                  redirect('amendment');
                }
              }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('cooperatives');
            }
          }

      }
    }
    
    public function view($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
              $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Cooperative Details';
              $data['header'] = 'Cooperative Information';
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
//              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
//              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              $data['encrypted_id'] = $id;
              //$data['capitalization_complete'] = $this->cooperative_model->is_capitalization_complete($decoded_id);
              /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
              $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
              /*END: UPDATE FOR CAPITALIZATION --by Fred */
              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
              if($data['cooperator_complete']==false) {
                $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
              }
              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              if($data['committees_complete']==false) {
                $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
              }
              $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
              $data['submitted'] = $this->amendment_model->check_submitted_for_evaluation($decoded_id);
              $data['members_composition'] =  $this->amendment_model->get_coop_composition($decoded_id);
              $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
              // if($data['committeescount']==0) {
              //   $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad($decoded_id);
              // }
              $this->load->view('./template/header', $data);
              $this->load->view('cooperative/amendment_details', $data);
              $this->load->view('./template/footer');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $data['title'] = 'Cooperative Details';
                  $data['header'] = 'Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
                  $data['members_composition'] =  $this->amendment_model->get_coop_composition($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                  $data['encrypted_id'] = $id;
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                  $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                  $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('cooperative/amendment_details', $data);
                  $this->load->view('amendment/evaluation/approve_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/deny_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('./templates/admin_footer');
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The application you trying to view is not yet submitted for evaluation.');
                  redirect('amendment');
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
    public function amendment_update($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
//        $coop_id = "";
//        $query_coop_id = $this->db->select("coop_id")->where(array("id"=>$decoded_id))->get("amend_coop");
//        if($query_coop_id->num_rows()>0) {
//            $rowid = $query_coop_id->row_array();
//            $coop_id = $rowid['coop_id'];
//        }
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
//                if($this->form_validation->run() == FALSE){
                if(!$this->input->post('cooperativeID')){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  $data['members_composition'] = $this->amendment_model->get_coop_composition($decoded_id);
                  
                  $data['title'] = 'Update Amendment Details';
                  $data['header'] = 'Update Amendment Information';
                  
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($decoded_id);
                  $data['composition']= $this->amendment_model->get_composition();
                  $data['regions_list'] = $this->region_model->get_regions();
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                  $this->load->view('./template/header', $data);
                  $this->load->view('cooperative/amendment_reservation_update', $data);
                  if($this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                    $this->load->view('cooperative/terms_and_condition');
                  }
                  $this->load->view('./template/footer', $data);
                }else{
                  if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
                    if ($this->input->post('categoryOfCooperative')=='Primary'){
                      $category ='Primary';
                      $group='';
                    }else{
                      $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                      $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                    }
                    $field_data = array(
                      'users_id' => $this->session->userdata('user_id'),
                      'category_of_cooperative' => $category,
                      'proposed_name' => $this->input->post('proposedName'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                      'grouping' => $group,
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo')
                    );
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }
                  }else{
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $field_data = array(
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposedName'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'composition_of_members' => $this->input->post('compositionOfMembers'),
                      'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'status' => 1,
                      'created_at'=> date('Y-m-d h:i:s'),
                      'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                    );
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated expired reservation.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to reserve cooperative.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }
                  }
                }
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('amendment/'.$id);
              }
            }else{
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if(!$this->amendment_model->check_first_evaluated($decoded_id)){
                    if($this->form_validation->run() == FALSE){
                      $data['title'] = 'Update Cooperative Details';
                      $data['header'] = 'Update Cooperative Information';
                      $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                      $data['regions_list'] = $this->region_model->get_regions();
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($decoded_id);
                      $data['subclasses_list'] = $this->amendment_model->get_all_subclasses($decoded_id);
                      $data['encrypted_id'] = $id;
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('cooperative/amendment_reservation_update', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                        $subclass_array = $this->input->post('subClass');
                        $major_industry = $this->input->post('majorIndustry');
                        $field_data = array(
                          'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                          'proposed_name' => $this->input->post('proposedName'),
                          'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                          'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                          'composition_of_members' => $this->input->post('compositionOfMembers'),
                          'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                          'area_of_operation' => $this->input->post('areaOfOperation'),
                          'refbrgy_brgyCode' => $this->input->post('barangay'),
                          'street' => $this->input->post('streetName'),
                          'house_blk_no' => $this->input->post('blkNo')
                        );
                        if($this->amendment_model->update_not_expired_cooperative_by_admin($decoded_id,$field_data,$subclass_array,$major_industry)){
                          $this->session->set_flashdata('cooperative_success', 'Successfully updated this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }else{
                          $this->session->set_flashdata('cooperative_error', 'Unable to update this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
                        redirect('amendment');
                      }
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                  redirect('amendment');
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
    public function delete_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteCooperativeBtn')){
          if($this->session->userdata('client')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($decoded_id) && $decoded_id!=0){
              if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->amendment_model->delete_cooperative($decoded_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                    redirect('amendment');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                    redirect('amendment');
                  }
                }else{
                  if(!$this->amendment_model->check_if_denied($decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE));
                  }else{
                    $success = $this->amendment_model->delete_cooperative($decoded_id);
                    if($success){
                      $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                      redirect('amendment');
                    }else{
                      $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                      redirect('amendment');
                    }
                  }
                }
              }
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('amendment');
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }

    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                              if($data['document_one'] && $data['document_two']){
                                if($this->amendment_model->check_if_deferred($decoded_id)){
                                  if($this->amendment_model->submit_for_reevaluation($user_id,$decoded_id)){
                                    $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                                    redirect('amendment/'.$id);
                                  }else{
                                    $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                    redirect('amendment/'.$id);
                                  }
                                }else{
                                  if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                    if($this->amendment_model->submit_for_evaluation($user_id,$decoded_id)){
                                      $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                      redirect('amendment/'.$id);
                                    }else{
                                      $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                     redirect('amendment/'.$id);
                                    }
                                  }else{
                                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                    redirect('amendment/'.$id);
                                  }
                                }
                              }else if(!$data['document_one'] && !$data['document_two']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');
                                redirect('amendment/'.$id);
                              }else if(!$data['document_one']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');
                                redirect('amendment/'.$id);
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('amendment/'.$id);
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
            }else{
              redirect('amendment');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function payment($coop){
      $coop=str_replace('%20',' ',$coop);
      $data = $this->amendment_model->get_payment_info($coop);
      echo json_encode($data);
    }

    

    public function specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('amendment');
              }else{
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID',TRUE)));
                if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));
                    $coop_full_name = $this->input->post('cooperativeName',TRUE);
                    if((is_numeric($decoded_id) && $decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
                      if($this->amendment_model->check_not_yet_assigned($decoded_id)){
                        if($this->amendment_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an evaluator.');
                          redirect('cooperatives');
                        }else{
                          $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                          redirect('cooperatives');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the cooperative to an evaluator.');
                        redirect('cooperatives');
                      }
                    }else{
                      show_404();
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The  you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is already expired.');
                  redirect('cooperatives');
                }
              }
            }
          }
        }else{
          redirect('cooperatives');
        }
      }
    }
    public function approve_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('approveCooperativeBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->amendment_model->check_if_denied($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            if($this->amendment_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('amendment');
                            }else{
                              if(!$this->admin_model->check_if_director_active($user_id)){
                                $success = $this->amendment_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                                  redirect('amendment');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                redirect('amendment');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else if($this->session->userdata('access_level')==3){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            if($this->amendment_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('amendment');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id)){
                                $success = $this->amendment_model->approve_by_director($data['admin_info'],$decoded_id);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                                  redirect('amendment');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('amendment');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else if($this->session->userdata('access_level')==2){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }else{
                            $success = $this->amendment_model->approve_by_senior($data['admin_info'],$decoded_id,$coop_full_name);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                              redirect('amendment');
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else{
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }else{
                          $success = $this->amendment_model->approve_by_specialist($data['admin_info'],$decoded_id,$coop_full_name);
                          if($success){
                            $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                            redirect('amendment');
                          }else{
                            $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                            redirect('amendment');
                          }
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                      redirect('amendment');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is already expired.');
                  redirect('amendment');
                }
              }
            }
          }else{
            show_404();
          }
        }else{
          redirect('amendment');
        }
      }
    }
    public function deny_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                  if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                    if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                      
                      //if(!$this->cooperatives_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if(!$this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                  redirect('cooperatives');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if($this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('cooperatives');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }else{
                              $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                redirect('cooperatives');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                redirect('cooperatives');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else{
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }else{
                            $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                              redirect('cooperatives');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                              redirect('cooperatives');
                            }
                          }
                        }
                      //}else{
                        //$this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is already denied.');
                        //redirect('cooperatives');
                      //}
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is not yet submitted for evaluation.');
                      redirect('cooperatives');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is already expired.');
                    redirect('cooperatives');
                  }
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('cooperative_error', validation_errors('<li>','</li>'));
          redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
        }
      }
    }
    public function defer_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                  if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                    if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                      if(!$this->cooperatives_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        if($this->session->userdata('access_level')==4){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if(!$this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                  redirect('cooperatives');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if($this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('cooperatives');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }else{
                              $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                redirect('cooperatives');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                redirect('cooperatives');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else{
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }else{
                            $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                              redirect('cooperatives');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                              redirect('cooperatives');
                            }
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to defer is already denied.');
                        redirect('cooperatives');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is not yet submitted for evaluation.');
                      redirect('cooperatives');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                    redirect('cooperatives');
                  }
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('cooperative_error', validation_errors('<li>','</li>'));
          redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
        }
      }
    }

    public function type_of_cooperative_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      if(strlen($typeOfCooperative) > 0){
        $typeName = $this->cooperative_type_model->get_cooperative_type_name_by_id($typeOfCooperative);
        if(preg_match('/('.$typeName->name.')/i',$proposedName)){
          $this->form_validation->set_message('coop_name_exists_check', 'Dont include the type of cooperative in your proposed name.');
          return FALSE;
        }else{
          return true;
        }
      }else{
        $this->form_validation->set_message('coop_name_exists_check', 'Please select first your type of cooperative.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $data = array(
        'fieldId'=>"proposedName",
        'fieldValue'=>$proposedName,
        'typeOfCooperative'=> $typeOfCooperative,
      );
      $result = $this->cooperatives_model->is_name_unique($data);
      if($result[1]==true){
        return true;
      }else{
        $this->form_validation->set_message('cooperative_name_exists_check', 'Cooperative Name already exists.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_update_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $cooperativeID = $this->input->post('cooperativeID');
      $status =  $this->encryption->decrypt(decrypt_custom($this->input->post('status')));
      if($status >= 1){
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
          'cooperativeID'=> $this->input->get('cooperativeID'),
        );
        $result = $this->cooperatives_model->is_name_update_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }else{
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
        );
        $result = $this->cooperatives_model->is_name_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }
    }
    public function cooperative_word_check($proposedName){
      if(preg_match('/(cooperative|cooperatives|kooperatiba|cooperativa|cooperatiba)/i',$proposedName)){
        $this->form_validation->set_message('coop_name_exists_check', 'Please dont include the word cooperative.');
        return false;
      }else{
        return TRUE;
      }
    }
    public function check_coop_name_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
          );
          $result = $this->cooperatives_model->is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperatives');
        }
      }
    }
    public function check_coop_name_update_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative') && $this->input->get('cooperativeID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
            'cooperativeID'=> $this->input->get('cooperativeID'),
          );
          $result = $this->amendment_model->is_name_update_unique($data);
          echo json_encode($result);
        }else{
          echo json_encode(array($ajax['fieldId'],false,"Error 500. Server error"));
        }
      }
    }
    public function get_cooperative_info(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->amendment_model->get_cooperative_info($decoded_user_id,$decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function get_cooperative_info_by_admin(){
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function business_activity($regNo){
      $data = $this->amendment_model->get_business_activity_coop($regNo);
      echo json_encode($data);
    }
    public function coop_info($regNo){
      $data = $this->amendment_model->get_coop($regNo);
      $coop_id = $data->application_id;
      $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
        $this->db->from('business_activities_cooperative');
        $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
        $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
        $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
        $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
        $query = $this->db->get();
    $data2 = $query->result_array();
      $data->business_activities = $data2;
      echo json_encode($data);
    }

    public function composition(){
      $result = $this->amendment_model->get_composition();
      echo json_encode($result);
    }

    public function get_business_activities_of_coop(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function check_minimum_regular_subscription_amendment(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'coop_id'=>$this->input->get('cooperativesID')
        );
        $result = $this->bylaw_model->check_minimum_regular_subscription_amendment($data);
        echo json_encode($result);
      }else{
        show_404();
      }
    }
  }
  }
 ?>
