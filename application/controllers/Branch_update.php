<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Branch_update extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->model('uploaded_document_model');
      $this->load->model('user_model');
      $this->load->model('branches_model');
      $this->load->model('region_model');
      $this->load->model('admin_model');
      $this->load->model('charter_model');
      $this->load->model('user_model');
      $this->load->model('major_industry_model');
      $this->load->model('cooperatives_model');
      $this->load->model('branch_update_model');
      //Codeigniter : Write Less Do More
    }

    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of Branches and Satellites';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Branches and Satellites';
          $data['list_branches'] = $this->branches_model->get_all_branches($this->session->userdata('user_id'));
          $data['list_of_migrated'] = $this->branches_model->get_all_branches_migrated($this->session->userdata('user_id'));
          // echo $this->db->last_query();
          $data['coopreg_info'] = $this->branches_model->getCoopRegNo($user_id);
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
//              $data['regno'] = $data['coopreg_info']->regNo;
          if(empty($data['coopreg_info'])){
            $data['date2'] = date('m/d/Y');
            $data['list_of_migrated'] = '';
          } else {
            $data['list_of_migrated'] = $this->branches_model->get_all_branches_migrated($data['coopreg_info']->regNo);
            $data['dateregistered'] = $data['coopreg_info']->dateRegistered;
            $datelang = str_replace("-", "/", $data['dateregistered']);
            $data['date2'] = $datelang;
          }
          $data['coop_exists'] = $this->branches_model->getCoopifExists($user_id);
          $data['regions_list'] = $this->region_model->get_regions();

          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_branches', $data);
          $this->load->view('cooperative/delete_modal_branch');
          $this->load->view('applications/transfer_modal');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Branches and Satellites';
            $data['header'] = 'Branches and Satellites';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $this->load->view('templates/admin_header', $data);

            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              if($data['admin_info']->region_code=="00"){
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_senior_ho($data['admin_info']->region_code);
                $data['outside_the_region_senior'] = $this->branches_model->get_all_branches_by_senior_ho($data['admin_info']->region_code);
                // $data['outside_the_region_senior'] = $this->branches_model->outside_the_region_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              } else {
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_senior($data['admin_info']->region_code);
                $data['outside_the_region_senior'] = $this->branches_model->outside_the_region_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
            }else{
              if($data['admin_info']->region_code=="00"){
                $data['outside_the_region'] = $this->branches_model->outside_the_region_ho($data['admin_info']->region_code);
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_director($data['admin_info']->region_code);
              } else {
                $data['outside_the_region'] = $this->branches_model->outside_the_region($data['admin_info']->region_code);
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_director($data['admin_info']->region_code);
              }
            }
            $data['coop_exists'] = $this->branches_model->getCoopifExists($user_id);
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);

            $date_ = ('Y-m-d -3 year');
            $data['date2']  = $date_;
            $this->load->view('applications/list_of_branches', $data);
            $this->load->view('applications/assign_branch_admin_modal');
            $this->load->view('admin/grant_privilege_supervisor_branch');
            $this->load->view('admin/revoke_privilege_supervisor_branch');
            $this->load->view('templates/admin_footer');
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
            // if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Branch/Satellite Details';
              $data['header'] = 'Branch Information';
              $branch_info = $this->branches_model->get_branch_info_migrated($decoded_id);
              // echo $this->db->last_query();
              $data['branch_info'] = $branch_info;
              $data['business_activities'] =  $this->branches_model->get_all_business_activities($decoded_id);
              $data['encrypted_id'] = $id;
              if(isset($branch_info)){
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($decoded_id,$branch_info->application_id);
              } else {
                $data['document_5'] = '';
                $data['document_6'] = '';
                $data['document_7'] = '';
                $data['document_8'] = '';
                $data['document_9'] = '';
                $data['document_40'] = '';
              }

              $data['in_chartered_cities'] = false;

              if($this->charter_model->in_charter_city($data['branch_info']->cCode))
              {
                $data['in_chartered_cities']=true;
                $data['chartered_cities'] = $this->charter_model->get_charter_city($data['branch_info']->cCode);
              }

              if($data['branch_info']->area_of_operation == 'Interregional'){
                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['branch_info']->regions);
              }

              $this->load->view('./template/header', $data);
              $this->load->view('branches/branch_detail_update', $data);
              $this->load->view('./template/footer');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
              $data['title'] = 'Branch/Satellite Details';
              $data['header'] = 'Branch Information';
              $branch_info = $this->branches_model->get_branch_info_migrated($decoded_id);
              $data['branch_info'] = $branch_info;
              $data['business_activities'] =  $this->branches_model->get_all_business_activities($decoded_id);
              $data['encrypted_id'] = $id;
              if(isset($branch_info)){
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($decoded_id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($decoded_id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($decoded_id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($decoded_id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($decoded_id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($decoded_id,$branch_info->application_id);
              } else {
                $data['document_5'] = '';
                $data['document_6'] = '';
                $data['document_7'] = '';
                $data['document_8'] = '';
                $data['document_9'] = '';
                $data['document_40'] = '';
              }
              if($data['branch_info']->area_of_operation == 'Interregional'){
                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['branch_info']->regions);
              }
              $data['subcode'] = substr($data['admin_info']->region_code,1,2);
              $data['in_chartered_cities'] = false;

              $this->load->view('./templates/admin_header', $data);
              $this->load->view('cooperative/evaluation/approve_modal_branch_update',$data);
              $this->load->view('branches/branch_detail_update', $data);
              $this->load->view('./templates/admin_footer');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function approve_branch(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('approveBranchBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{

                  // if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->branches_model->check_if_denied($decoded_id)){
                      $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                      if($branch_info->status ==23){
                        $step = 6;
                      } else {
                        $step = 5;
                      }
                      $coop_full_name = $this->input->post('bName',TRUE);
                      $comment_by_specialist_senior = $this->input->post('comment_by_specialist_senior',TRUE);
                      $admin_info = $this->admin_model->get_admin_info($user_id);
                                  $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                // $this->debug($data_field);
                             $coop_full_name = $this->input->post('bName',TRUE);

                                $success = $this->branches_model->insert_comment_history($data_field);
                                $reason_commment='';

                                $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                                // echo $regioncode;
                                // echo '<script>alert('.printf("%02d", 0).');</script>';
                                // $data['director_info'] = $this->admin_model->get_director_info($regioncode);

                                // if($this->admin_model->is_active_director($data['director_info']->id)){
                                  $seniorinfo = $this->admin_model->get_emails_of_senior_by_region($regioncode);

                                  $data['suvervising_info'] = $this->admin_model->get_specialst_info($branch_info->evaluator3);

                                // } else {
                                  // $data['director_info'] = $this->admin_model->get_emails_of_supervisor_by_region($regioncode);
                                // }
                                $data['client_info'] = $this->user_model->get_user_info($branch_info->user_id);

                                if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';

                                $brgyforemail = ucwords($branch_info->house_blk_no).' '.ucwords($branch_info->street).$x.' '.$branch_info->brgy.', '.$branch_info->city.', '.$branch_info->province.', '.$branch_info->region;

                                $coop_full_name = $this->input->post('bName',TRUE);
                                // $branchname = $coop_full_name.' '.$branch_info->type;

                                if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                                    $branchname = $branch_info->brgy.' '.$branch_info->type;
                                } else if($branch_info->area_of_operation == 'Provincial') {
                                    $branchname = $branch_info->city.' '.$branch_info->type;
                                } else if ($branch_info->area_of_operation == 'Regional' || $branch_info->area_of_operation == 'Interregional') {
                                    if($this->charter_model->in_charter_city($branch_info->cCode))
                                    {
                                      $branchname = $branch_info->city.' '.$branch_info->type;
                                    } else {
                                      $branchname = $branch_info->city.', '.$branch_info->province.' '.$branch_info->type;
                                    }
                                } else if ($branch_info->area_of_operation == 'National') {
                                  if($this->charter_model->in_charter_city($branch_info->cCode))
                                    {
                                      $branchname = $branch_info->city.' '.$branch_info->type;
                                    } else {
                                      $branchname = $branch_info->city.', '.$branch_info->province.' '.$branch_info->type;
                                    }
                                }

                                $reason_commment='';

                                $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;
                                // foreach($data['senior_info'] as $directorinfo){
                                //   $emaildirect = $seniorinfo['email'];
                                // }

                                $coop_region = $this->branches_model->get_coop_region($branch_info->regNo);
                                // echo $coop_full_name.'-'.$branchname.'-'.$brgyforemail.'-'.$fullnameforemail.'-'.$data['client_info']->contact_number.'-'.$data['client_info']->email.'-'.$emaildirect.'-'.$branch_info->type;

                                  $success = $this->branch_update_model->approve_by_admin2($admin_info,$decoded_id,$reason_commment,1,$comment_by_specialist_senior,$coop_full_name);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been submitted.');
                                    redirect('branch_update/'.$this->input->post('branchID',TRUE).'/view');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('branches');
                                  }

                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to approve is already denied.');
                      redirect('branches');
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to approve is not yet submitted for evaluation.');
                  //   redirect('branches');
                  // }

              }
            }
          }else{
            show_404();
          }
        }else{
          redirect('branches');
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
                    $status = 12;
                } else {
                    $status = 80;
                }
                $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                $this->db->from('head_office_coop_type_branch');
                if($this->db->count_all_results()>0){
                  $status = 80;
                }

                if($data['branch_info']->status == 0 || $data['branch_info']->status == 21){
                    $stat = 80;
                }

                $same= ($branch_info->rCode=='0'+substr($branch_info->mainAddr, 0,2)) ? $status: $stat;
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
//                $data['branch_info'] = $branch_info;
                // if($data['branch_info']->type == "Branch"){
                      if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                        if($this->branches_model->check_if_deferred($decoded_id)){
                          if($this->branches_model->submit_for_reevaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
                            $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                            redirect('branch_update/'.$id.'/view');
                          }else{
                            $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                            redirect('branch_update/'.$id.'/view');
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
                              $sendemailtosenior = 'sendEmailToSeniorBranch';
                            }

                            if($this->branches_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['branch_info']->type,'',$coop_region->region)){
                              if($this->branches_model->sendEmailToClientBranch($data['client_info']->email,$data['branch_info']->type,$proposedbranch,$brgyforemail)){
                                $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('branch_update/'.$id.'/view');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('branch_error','Unable to submit your application');
                            redirect('branch_update/'.$id.'/view');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                        redirect('branch_update/'.$id.'/view');
                      }
                }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('branch_update');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function bupdate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->form_validation->run() == FALSE){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
//                  $data['members_composition'] = $this->branches_model->get_coop_composition($decoded_id);

              $data['title'] = 'Updating Branch/Satellite Details';
              $data['header'] = 'Updating Branch/Satellite Information';

              $data['branch_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);

              $data['last_query'] = $this->db->last_query();
              $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);
              $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['registered_info']->type);
              $data['major_industry_list'] = $this->branches_model->get_all_major_industry($decoded_id);
//                  $data['composition']= $this->branches_model->get_composition();
              // $data['regions_list'] = $this->region_model->get_regions();
              if($data['branch_info']->area_of_operation == 'Interregional'){
                $data['regions_list'] = $this->region_model->get_selected_regions($data['branch_info']->regions);
              } else {
                $data['regions_list'] = $this->region_model->get_regions();
              }

              $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['branch_info']->rCode);
              $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['branch_info']->pCode);
              $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['branch_info']->cCode);

              $data['encrypted_id'] = $id;
              $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

              $this->load->view('./template/header', $data);
              $this->load->view('branches/branch_migration_update', $data);
               // $this->load->view('cooperative/terms_and_condition');
              $this->load->view('./template/footer', $data);
            }else{
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

              $BAC = $this->input->post('BAC');
              $provDesc = $this->branches_model->prov($this->input->post('province'));
              $cityDesc = $this->branches_model->city($this->input->post('city'));
              $branchCount =$this->branches_model->branch_count($this->input->post('regNo'),substr($this->input->post('city'),0,6),$this->input->post('typeOfBranch'));

              $data['branch_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);
              $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);

              if(substr($this->input->post('barangay'), 0, 2)==substr($this->input->post('barangay2'), 0, 2)){ // empty($this->input->post('region2')) ||
                  $regCodeBranch = 0;
              } else if (substr($data['registered_info']->addrCode, 0, 2) == substr($this->input->post('barangay'), 0, 2)){
                  $regCodeBranch = 0;
              } else {
                  $regCodeBranch = '0'.substr($data['registered_info']->addrCode, 0, 2);
              }

              // echo substr($data['registered_info']->addrCode, 0, 2).'-'.substr($this->input->post('barangay'), 0, 2);
              // echo  $this->input->post('typeOfbranchsatellite');

              $field_data = array(
                'user_id' => $this->session->userdata('user_id'),
                'regCode' => $regCodeBranch,
                'coopName' => $this->input->post('coopname'),
//                      'category_of_cooperative' => $category,
//                      'proposed_name' => $this->input->post('proposedName'),
//                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
//                      'grouping' => $group,
//                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                'branchName' => $this->input->post('branchName'),
                'type' => $this->input->post('typeOfbranchsatellite'),
                'area_of_operation' => $this->input->post('areaOfOperation'),
                'addrCode' => $this->input->post('barangay'),
                'street' => $this->input->post('streetName'),
                'house_blk_no' => $this->input->post('blkNo')
              );
              if($data['branch_info']->status < 2 || $data['branch_info']->status == 17 || $data['branch_info']->status == 21){
                if($this->branches_model->update_not_expired_branches_migrated($decoded_id,$field_data)){
                  // echo '<script>alert("Successfully updated basic information");';
                  // echo "window.location.href = '" . $this->input->post('branchID') . "';</script>";
                  $this->session->set_flashdata('branches_success', 'Successfully updated Branch/Satellite basic information.');
                  redirect('branch_update/'.$this->input->post('cooperativeID').'/view');
                }else{
                  $this->session->set_flashdata('branches_success', 'Unable to update Branch/Satellite basic information.');
                  redirect('branch_update/'.$this->input->post('cooperativeID').'/view');
                }
              } else {
                $this->session->set_flashdata('branches_error', 'Unable to Save. Application already submitted.');
                redirect('branch_update/'.$this->input->post('cooperativeID').'/view');
              }
            }
          } else if($this->session->userdata('access_level')==6){
            if($this->form_validation->run() == FALSE){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
    //                  $data['members_composition'] = $this->branches_model->get_coop_composition($decoded_id);
              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
              $data['title'] = 'Updating Branch/Satellite Details';
              $data['header'] = 'Updating Branch/Satellite Information';

              $data['branch_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);

              $data['last_query'] = $this->db->last_query();
              $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);
              $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['registered_info']->type);
              $data['major_industry_list'] = $this->branches_model->get_all_major_industry($decoded_id);
    //                  $data['composition']= $this->branches_model->get_composition();
              // $data['regions_list'] = $this->region_model->get_regions();
              if($data['branch_info']->area_of_operation == 'Interregional'){
                $data['regions_list'] = $this->region_model->get_selected_regions($data['branch_info']->regions);
              } else {
                $data['regions_list'] = $this->region_model->get_regions();
              }

              $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['branch_info']->rCode);
              $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['branch_info']->pCode);
              $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['branch_info']->cCode);

              $data['encrypted_id'] = $id;
              $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

              $this->load->view('./templates/admin_header', $data);
              $this->load->view('branches/branch_migration_update', $data);
              $this->load->view('./templates/admin_footer', $data);
            }else{
              // if(!$this->branches_model->check_expired_reservation_by_admin($decoded_id)){
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                $subclass_array = $this->input->post('subClass');
                $major_industry = $this->input->post('majorIndustry');

                $data['branch_info'] = $this->branches_model->get_branch_info_migrated($decoded_id);
                $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);

                if(substr($this->input->post('barangay'), 0, 2)==substr($this->input->post('barangay2'), 0, 2)){ // empty($this->input->post('region2')) ||
                    $regCodeBranch = 0;
                } else if (substr($data['registered_info']->addrCode, 0, 2) == substr($this->input->post('barangay'), 0, 2)){
                    $regCodeBranch = 0;
                } else {
                    $regCodeBranch = '0'.substr($data['registered_info']->addrCode, 0, 2);
                }
                
                $field_data = array(
                  // 'user_id' => $this->session->userdata('user_id'),
                'regCode' => $regCodeBranch,
//                      'category_of_cooperative' => $category,
//                      'proposed_name' => $this->input->post('proposedName'),
//                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
//                      'grouping' => $group,
//                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                'branchName' => $this->input->post('branchName'),
                'type' => $this->input->post('typeOfbranchsatellite'),
                'area_of_operation' => $this->input->post('areaOfOperation'),
                'addrCode' => $this->input->post('barangay'),
                'street' => $this->input->post('streetName'),
                'house_blk_no' => $this->input->post('blkNo')
                );
                if($this->branches_model->update_not_expired_branches_migrated($decoded_id,$field_data)){
                  // echo '<script>alert("Successfully updated basic information");';
                  // echo "window.location.href = '" . $this->input->post('branchID') . "';</script>";
                  $this->session->set_flashdata('branches_success', 'Successfully updated Branch/Satellite basic information.');
                  redirect('branch_update/'.$this->input->post('cooperativeID').'/view');
                }else{
                  $this->session->set_flashdata('branches_success', 'Unable to update Branch/Satellite basic information.');
                  redirect('branches_update/'.$this->input->post('cooperativeID').'/view');
                }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
              //   // redirect('cooperatives');
              // }
            }
        }
        }
      }
    }
  }
?>
