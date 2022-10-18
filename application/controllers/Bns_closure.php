<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Bns_closure extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model('uploaded_document_model');
      $this->load->model('user_model');
      $this->load->model('branches_model');
      $this->load->model('region_model');
      $this->load->model('admin_model');
      $this->load->model('charter_model');
      $this->load->model('user_model');

    }

    public function index($id = null){
      if(!$this->session->userdata('logged_in')){
        // redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Branch/Satellite Details';
              $data['header'] = 'Branch Information';
              $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
              $data['branch_info'] = $branch_info;
              $data['business_activities'] =  $this->branches_model->get_all_business_activities($decoded_id);
              $data['encrypted_id'] = $id;
              $data['document_5'] = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
              $data['document_6'] = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
              $data['document_7'] = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
              $data['document_8'] = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
              $data['document_9'] = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);
              $data['document_40'] = $this->uploaded_document_model->get_document_40_info($decoded_id,$branch_info->application_id);
              $data['document_43'] = $this->uploaded_document_model->get_document_43_info($decoded_id,$branch_info->application_id);
              $data['document_44'] = $this->uploaded_document_model->get_document_44_info($decoded_id,$branch_info->application_id);
              $data['document_45'] = $this->uploaded_document_model->get_document_45_info($decoded_id,$branch_info->application_id);
              $data['document_46'] = $this->uploaded_document_model->get_document_46_info($decoded_id,$branch_info->application_id);

              $data['branches_comments'] = $this->branches_model->branches_closure_comments_client($decoded_id);

              $data['submitted'] = $this->branches_model->check_submitted_for_evaluation($decoded_id);

              $data['in_chartered_cities'] = false;
              // $this->debug();

              if($this->charter_model->in_charter_city($data['branch_info']->cCode))
              {
                $data['in_chartered_cities']=true;
                $data['chartered_cities'] = $this->charter_model->get_charter_city($data['branch_info']->cCode);
              }

              if($data['branch_info']->area_of_operation == 'Interregional'){
                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['branch_info']->regions);
              }

              $this->load->view('./template/header', $data);
              $this->load->view('cooperative/branch_detail_closure', $data);
              $this->load->view('./template/footer');
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
              // echo $this->db->last_query();
            }
          }else{
            if($this->session->userdata('access_level')==5){
              // redirect('admins/login');
            }else{
              redirect('branches');
            }
          }
        }else{
          // show_404();
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
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){

                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
                $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
                $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
                $document_8 = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
                $document_9 = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);

                $data['branch_info'] = $branch_info;
                $coop_region = $this->branches_model->get_coop_region($data['branch_info']->regNo);

                if($data['branch_info']->status==17){
                    $status = 31;
                } else {
                    $status = 30;
                }
                // $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                // $this->db->from('head_office_coop_type_branch');
                // if($this->db->count_all_results()>0){
                //   $status = 24;
                // }

                if($data['branch_info']->status == 1){
                    $stat = 2;
                } else {
                    $stat = 24;
                }
                $same = $status;
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
//                $data['branch_info'] = $branch_info;
                      if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                        if($this->branches_model->check_if_deferred($decoded_id)){
                          if($this->branches_model->submit_for_reevaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
                            $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                            redirect('branches/'.$id);
                          }else{
                            $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                            redirect('branches/'.$id);
                          }
                        }else{
                          if($this->branches_model->submit_for_evaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
                            if($data['branch_info']->house_blk_no==null && $data['branch_info']->street==null) $x=''; else $x=', ';

                            $data['client_info'] = $this->user_model->get_user_info($user_id);

                            $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                            // Get Count Coop Type for HO
                            // $this->db->where(array('name'=>$data['branch_info']->type_of_cooperative,'active'=>1));
                            // $this->db->from('head_office_coop_type_branch');
                            // // End Get Count Coop Type
                            // if($this->db->count_all_results()>0)
                            // {
                            //   $regioncode = '00';
                            // } else {
                              $regioncode = '0'.mb_substr($data['branch_info']->addrCode, 0, 2);
                            // }

                            if($data['branch_info']->regCode != 0){
                              $regioncode = $regioncode.','.$data['branch_info']->regCode;
                            }

                            $this->db->where(array('name'=>$data['branch_info']->type_of_cooperative,'active'=>1));
                            $this->db->from('head_office_coop_type_branch');
                            // End Get Count Coop Type
                            if($this->db->count_all_results()>0)
                            {
                              $regioncode = '00';
                            }
                            // echo $regioncode;
                            if(($data['branch_info']->status == 1 && $data['branch_info']->regCode != 0) ||($data['branch_info']->status == 17 && $data['branch_info']->regCode != 0 && $data['branch_info']->evaluator5 == NULL)){
                              $senior_info = $this->admin_model->get_senior_info_closure($regioncode);

                            } else {
                              $senior_info = $this->admin_model->get_senior_info_closure($regioncode);
                              // echo $this->db->last_query();
                            }


                            $brgyforemail = ucwords($data['branch_info']->house_blk_no).' '.ucwords($data['branch_info']->street).$x.' '.$data['branch_info']->brgy.', '.$data['branch_info']->city.', '.$data['branch_info']->province.', '.$data['branch_info']->region;

                            $proposednameemail = $data['branch_info']->coopName;

                            if($data['branch_info']->area_of_operation == 'Barangay' || $data['branch_info']->area_of_operation == 'Municipality/City'){
                                $proposedbranch = $data['branch_info']->brgy.' '.$data['branch_info']->type;
                            } else if($data['branch_info']->area_of_operation == 'Provincial') {
                                $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                            } else if ($data['branch_info']->area_of_operation == 'Regional' || $data['branch_info']->area_of_operation == 'Interregional') {
                                if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                                {
                                  $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                                } else {
                                  $proposedbranch = $data['branch_info']->city.', '.$data['branch_info']->province.' '.$data['branch_info']->type;
                                }
                            } else if ($data['branch_info']->area_of_operation == 'National') {
                              if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                                {
                                  $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                                } else {
                                  $proposedbranch = $data['branch_info']->city.', '.$data['branch_info']->province.' '.$data['branch_info']->type;
                                }

                            }
                            // $proposedbranch = $data['branch_info']->coopName.' '.$data['branch_info']->type;
                            if($data['branch_info']->status == 17){
                              $coop_region = $this->branches_model->get_coop_region($data['branch_info']->regNo);
                              $sendemailtosenior = 'sendEmailToSeniorDeferBranch';
                            } else {
                              $sendemailtosenior = 'sendEmailToSeniorBranchClosure';
                            }

                            if($data['branch_info']->migrated == 1){
                              $proposedbranch = $data['branch_info']->branchName;
                            }

                            if($this->branches_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['branch_info']->type,'',$coop_region->region)){
                              if($this->branches_model->sendEmailToClientBranchClosure($data['client_info']->email,$data['branch_info']->type,$proposedbranch,$brgyforemail)){
                                $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('branches/'.$id.'/bns_closure');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('branch_error','Unable to submit your application');
                            redirect('branches/'.$id.'/bns_closure');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                        redirect('branches/'.$id);
                      }
                }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('branches');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function evaluation_for_submission($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){

                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
                $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
                $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
                $document_8 = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
                $document_9 = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);

                $data['branch_info'] = $branch_info;
                $coop_region = $this->branches_model->get_coop_region($data['branch_info']->regNo);

                if($data['branch_info']->status==17){
                    $status = 31;
                } else if ($data['branch_info']->status==33 || $data['branch_info']->status==32 || $data['branch_info']->status==34){
                    $status = 35;
                } else if ($data['branch_info']->status==38){
                    $status = 35;
                } else {
                    $status = 30;
                }

                if($data['branch_info']->status == 1 && $data['branch_info']->regCode == 0 || $data['branch_info']->evaluator4 != NULL){
                    $stat = 2;
                } else {
                    $stat = 24;
                }
                $same = $status;
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
                      if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                        if($this->branches_model->check_if_deferred($decoded_id)){
                          if($this->branches_model->submit_for_reevaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
                            $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                            redirect('branches/'.$id);
                          }else{
                            $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                            redirect('branches/'.$id);
                          }
                        }else{
                          if($this->branches_model->submit_for_evaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
                            if($data['branch_info']->house_blk_no==null && $data['branch_info']->street==null) $x=''; else $x=', ';

                            $data['client_info'] = $this->user_model->get_user_info($user_id);

                            $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                            // Get Count Coop Type for HO
                            $this->db->where(array('name'=>$data['branch_info']->type_of_cooperative,'active'=>1));
                            $this->db->from('head_office_coop_type_branch');
                            // End Get Count Coop Type
                            if($this->db->count_all_results()>0)
                            {
                              $regioncode = '00';
                            } else {
                              $regioncode = '0'.mb_substr($data['branch_info']->addrCode, 0, 2);
                            }

                            if(($data['branch_info']->status == 1 && $data['branch_info']->regCode != 0) ||($data['branch_info']->status == 17 && $data['branch_info']->regCode != 0 && $data['branch_info']->evaluator5 == NULL)){
                              $senior_info = $this->admin_model->get_senior_info($data['branch_info']->regCode);
                            } else {
                              $senior_info = $this->admin_model->get_senior_info($regioncode);
                            }

                            $brgyforemail = ucwords($data['branch_info']->house_blk_no).' '.ucwords($data['branch_info']->street).$x.' '.$data['branch_info']->brgy.', '.$data['branch_info']->city.', '.$data['branch_info']->province.', '.$data['branch_info']->region;

                            $proposednameemail = $data['branch_info']->coopName;

                            if($data['branch_info']->area_of_operation == 'Barangay' || $data['branch_info']->area_of_operation == 'Municipality/City'){
                                $proposedbranch = $data['branch_info']->brgy.' '.$data['branch_info']->type;
                            } else if($data['branch_info']->area_of_operation == 'Provincial') {
                                $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                            } else if ($data['branch_info']->area_of_operation == 'Regional' || $data['branch_info']->area_of_operation == 'Interregional') {
                                if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                                {
                                  $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                                } else {
                                  $proposedbranch = $data['branch_info']->city.', '.$data['branch_info']->province.' '.$data['branch_info']->type;
                                }
                            } else if ($data['branch_info']->area_of_operation == 'National') {
                              if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                                {
                                  $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                                } else {
                                  $proposedbranch = $data['branch_info']->city.', '.$data['branch_info']->province.' '.$data['branch_info']->type;
                                }

                            }
                            // $proposedbranch = $data['branch_info']->coopName.' '.$data['branch_info']->type;
                            if($data['branch_info']->status == 17){
                              $coop_region = $this->branches_model->get_coop_region($data['branch_info']->regNo);
                              $sendemailtosenior = 'sendEmailToSeniorDeferBranch';
                            } else {
                              $sendemailtosenior = 'sendEmailToSeniorBranchClosureForEva';
                            }

                            if($data['branch_info']->migrated == 1){
                              $proposedbranch = $data['branch_info']->branchName;
                            }

                            if($this->branches_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['branch_info']->type,'',$coop_region->region)){
                              // if($this->branches_model->sendEmailToClientBranch($data['client_info']->email,$data['branch_info']->type,$proposedbranch,$brgyforemail)){
                                $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('branches/'.$id.'/bns_closure');
                              // }
                            }
                          }else{
                            $this->session->set_flashdata('branch_error','Unable to submit your application');
                            redirect('branches/'.$id);
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                        redirect('branches/'.$id);
                      }
                }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('branches');
            }
          }
        }else{
          show_404();
        }
      }
    }

}
