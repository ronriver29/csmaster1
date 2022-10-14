<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Bns_transfer extends CI_Controller{

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

              $branch_trans = $this->branches_model->get_branch_to_be_transferred($user_id,$decoded_id);
              $data['branch_trans'] = $branch_trans;
              
              $data['business_activities'] =  $this->branches_model->get_all_business_activities($decoded_id);
              $data['encrypted_id'] = $id;
              $data['document_5'] = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
              $data['document_6'] = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
              $data['document_7'] = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
              $data['document_8'] = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
              $data['document_9'] = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);
              $data['document_40'] = $this->uploaded_document_model->get_document_40_info($decoded_id,$branch_info->application_id);
              $data['document_43'] = $this->uploaded_document_model->get_document_43_info($decoded_id,$branch_info->application_id);
              $data['document_47'] = $this->uploaded_document_model->get_document_47_info($decoded_id,$branch_info->application_id);
              $data['document_48'] = $this->uploaded_document_model->get_document_48_info($decoded_id,$branch_info->application_id);
              $data['document_49'] = $this->uploaded_document_model->get_document_49_info($decoded_id,$branch_info->application_id);

              $data['branches_comments'] = $this->branches_model->branches_comments_client($decoded_id);
              
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
              $this->load->view('cooperative/branch_detail_transfer', $data);
              $this->load->view('./template/footer');
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              // redirect('branches');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              // redirect('admins/login');
            }else{
              // redirect('branches');
            }
          }
        }else{
          // show_404();
        }
      }
    }   

    public function transfer_region(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('TransferBtn')){
          if($this->session->userdata('client')){
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
              $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
              if($this->branches_model->transfer_region($decoded_id,$this->input->post('barangay'),$this->input->post('transferred_houseblk'),$this->input->post('transferred_street'))){
                $this->session->set_flashdata('list_success_message', 'Successfully Updated the Transfer of Region');
                redirect('branches');
              }else{
                $this->session->set_flashdata('list_error_message', 'Unable to update the region');
                redirect('branches');
              }
            }
          }
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
                    $status = 41;
                }
                
                $stat = 41;

                $same= ($branch_info->rCode=='0'+substr($branch_info->mainAddr, 0,2)) ? $status: $stat;
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
//                $data['branch_info'] = $branch_info;\
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
                            
                            if($data['branch_info']->status == 40){
                              $senior_info = $this->admin_model->get_senior_info_transfer('0'.mb_substr($data['branch_info']->addrCode, 0, 2),'0'.mb_substr($data['branch_info']->transferred_region, 0, 2));
                              // $senior_info = $this->admin_model->get_senior_info();
                            } else {
                                $senior_info = $this->admin_model->get_senior_info('0'.mb_substr($data['branch_info']->transferred_region, 0, 2));
                            }

                            // if(($data['branch_info']->status == 1 && $data['branch_info']->regCode != 0) ||($data['branch_info']->status == 17 && $data['branch_info']->regCode != 0 && $data['branch_info']->evaluator5 == NULL)){
                            //   $senior_info = $this->admin_model->get_senior_info($data['branch_info']->regCode);
                            // } else {
                            //   $senior_info = $this->admin_model->get_senior_info($regioncode);
                            // }

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
                              $sendemailtosenior = 'sendEmailToSeniorBranchTransfer';
                            }

                            if($data['branch_info']->migrated == 1){
                              $proposedbranch = $data['branch_info']->branchName;
                            }
                            
                            if($this->branches_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['branch_info']->type,'',$coop_region->region)){
                              if($this->branches_model->sendEmailToClientBranchTransfer($data['client_info']->email,$data['branch_info']->type,$proposedbranch,$brgyforemail)){
                                $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('branches/'.$id.'/bns_transfer');
                              }
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
                } else if ($data['branch_info']->status==33 || $data['branch_info']->status==32 || $data['branch_info']->status==35){
                    $status = 33;
                } else if ($data['branch_info']->status==43){
                    $status = 44;
                } else if ($data['branch_info']->status==49){
                    $status = 46;
                } else {
                    $status = 30;
                }
                
                
                if(($data['branch_info']->status == 1 && $data['branch_info']->regCode == 0) || $data['branch_info']->evaluator4 != NULL){
                    $stat = 44;
                } else {
                    $stat = 24;
                }
                $same=  $status;
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
                        $this->db->where(array('name'=>$data['branch_info']->type_of_cooperative,'active'=>1));
                        $this->db->from('head_office_coop_type_branch');
                        // End Get Count Coop Type
                        if($this->db->count_all_results()>0)
                        {
                          $regioncode = '00';
                        } else {
                          $regioncode = '0'.mb_substr($data['branch_info']->transferred_region, 0, 2);
                        }
                        
                        if(($data['branch_info']->status == 1 && $data['branch_info']->regCode != 0) ||($data['branch_info']->status == 17 && $data['branch_info']->regCode != 0 && $data['branch_info']->evaluator5 == NULL)){
                          $senior_info = $this->admin_model->get_senior_info($data['branch_info']->transferred_region);
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
                          $sendemailtosenior = 'sendEmailToSeniorBranchTransferForEva';
                        }

                        if($data['branch_info']->migrated == 1){
                          $proposedbranch = $data['branch_info']->branchName;
                        }
                            
                        if($this->branches_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['branch_info']->type,'',$coop_region->region)){
                          if($same != 44){
                            if($this->branches_model->sendEmailToClientBranch($data['client_info']->email,$data['branch_info']->type,$proposedbranch,$brgyforemail)){
                              $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                            }
                          }
                          redirect('branches/'.$id.'/bns_transfer');
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