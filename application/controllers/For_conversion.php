<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class For_conversion extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model('branches_model');
      $this->load->model('user_model');
      $this->load->model('cooperatives_model');
      $this->load->model('charter_model');
      $this->load->model('admin_model');
      $this->load->model('region_model');
      $this->load->model('major_industry_model');
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
          $data['coopreg_info'] = $this->branches_model->getCoopRegNo($user_id);
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
//              $data['regno'] = $data['coopreg_info']->regNo;
          if(empty($data['coopreg_info'])){
            $data['date2'] = date('m/d/Y');
          } else {
            $data['dateregistered'] = $data['coopreg_info']->dateRegistered;
            $datelang = str_replace("-", "/", $data['dateregistered']);
            $data['date2'] = $datelang;
          }
          $data['coop_exists'] = $this->branches_model->getCoopifExists($user_id);
          // foreach($list_branches as $branch){
          //   $cCode = $branch['cCode'];
          // }
          // $data['in_chartered_cities'] =false;
          // $this->debug();
          // if($this->charter_model->in_charter_city($data['list_branches']->cCode))
          // {
          //   $data['in_chartered_cities']=true;
          //   $data['chartered_cities'] = $this->charter_model->get_charter_city($data['list_branches']->cCode);
          // }
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_branches_for_conversion', $data);
          $this->load->view('cooperative/delete_modal_branch');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Branches and Satellites For Conversion';
            $data['header'] = 'Branches and Satellites For Conversion';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $this->load->view('templates/admin_header', $data);

            $type_arr = array();
            $this->db->where(array('active'=>1));
            $this->db->from('head_office_coop_type_branch');
            $query_type = $this->db->get();
            $data_type = $query_type->result_array();
            foreach($data_type as $typearr){
              $type_arr[] = $typearr['name'];
            }

            $data['typearr'] = $type_arr;

            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_specialist_for_conversion_ho($data['admin_info']->region_code,$user_id);
              }else{
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_specialist_for_conversion($data['admin_info']->region_code,$user_id);
                // echo $this->db->last_query();
              }
            }else if($this->session->userdata('access_level')==2){
              if($data['admin_info']->region_code=="00"){
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_senior_for_conversion_ho($data['admin_info']->region_code);
                $data['outside_the_region_senior'] = $this->branches_model->outside_the_region_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region_ho($data['admin_info']->region_code);
              } else {
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_senior_for_conversion($data['admin_info']->region_code);
                $data['outside_the_region_senior'] = $this->branches_model->outside_the_region_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
            }else{
              if($data['admin_info']->region_code=="00"){
                $data['outside_the_region'] = $this->branches_model->outside_the_region($data['admin_info']->region_code);
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_director_for_conversion_ho($data['admin_info']->region_code);
              } else {
                $data['outside_the_region'] = $this->branches_model->outside_the_region($data['admin_info']->region_code);
                $data['registered_branches'] = $this->branches_model->get_registered_branches($data['admin_info']->region_code);
                $data['list_branches'] = $this->branches_model->get_all_branches_by_director_for_conversion($data['admin_info']->region_code);
              }
            }
            $data['coop_exists'] = $this->branches_model->getCoopifExists($user_id);
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);

            $date_ = ('Y-m-d -3 year');
            $data['date2']  = $date_;
            $this->load->view('applications/list_of_branches_for_conversion', $data);
            $this->load->view('applications/assign_branch_conversion_modal');
            $this->load->view('admin/grant_privilege_supervisor_branch');
            $this->load->view('admin/revoke_privilege_supervisor_branch');
            $this->load->view('templates/admin_footer');
          }
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
              if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                if($this->form_validation->run() == FALSE){
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
//                  $data['members_composition'] = $this->branches_model->get_coop_composition($decoded_id);

                  $data['title'] = 'Update Cooperative Details';
                  $data['header'] = 'Update Cooperative Information';

                  $data['branch_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);

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

//                  if($this->branches_model->check_expired_reservation($decoded_id,$user_id)){
                    $this->load->view('cooperative/registration_update_conversion', $data);

//                  }
                  $this->load->view('./template/footer', $data);
                }else{
                  // if(!$this->branches_model->check_expired_reservation($decoded_id,$user_id)){
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $data['branch_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);

                    $field_data = array(
                      'reason' => $this->input->post('reason'),
                    );

                    if($data['branch_info']->status == 21 || $data['branch_info']->status == 38 || $data['branch_info']->status == 81){
                      if($this->branches_model->update_not_branch_reason($user_id,$decoded_id,$field_data)){
                        // echo '<script>alert("Successfully updated basic information");';
                        // echo "window.location.href = '" . $this->input->post('branchID') . "';</script>";
                        $this->session->set_flashdata('branches_success', 'Successfully updated Branch/Satellite basic information.');
                        redirect('branches/'.$this->input->post('cooperativeID').'/bns_conversion');
                      }else{
                        $this->session->set_flashdata('branches_success', 'Unable to update Branch/Satellite basic information.');
                        redirect('branches/'.$this->input->post('cooperativeID').'/bns_conversion');
                      }
                    }
                }
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('cooperatives/'.$id);
              }
            }else{
              redirect('cooperatives');
            }
      }
    }

    public function payment($coop){
      // $coop = $this->encryption->decrypt(decrypt_custom($coop));
      // $branch=str_replace('%20',' ',$coop);
      $data = $this->branches_model->get_payment_info_conversion($coop);
      echo json_encode($data);
      // print_r($data);
    }

    public function saveORConversion($was){
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('orDate'),
        'status' =>1
      );
          $date_of_or = $this->input->post('orDate');

      $this->branches_model->save_OR_conversion(array('id' => $this->input->post('payment_id')), $data,$this->input->post('bid'),$date_of_or);
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));

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
              redirect('for_conversion');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{

                  // if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->branches_model->check_if_denied($decoded_id)){
                      $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                      if($branch_info->status ==23){
                        $step = 6;
                      } else if($branch_info->status == 34){
                        $step = 9;
                      } else if($branch_info->status == 56){
                        $step = 2;
                      } else if($branch_info->status == 61){
                        $step = 5;
                      } else {
                        $step = 5;
                      }
                      $coop_full_name = $this->input->post('bName',TRUE);
                      $comment_by_specialist_senior = $this->input->post('comment_by_specialist_senior',TRUE);
                      $admin_info = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  if($this->branches_model->check_evaluator_for_conversion2($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('for_conversion');
                                  }else{
                                    $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                                  // echo $regioncode;
                                  // echo '<script>alert('.printf("%02d", 0).');</script>';
                                  $data['director_info'] = $this->admin_model->get_director_info($regioncode);

                                  echo $data['director_info'] ;

                                  if($this->admin_model->is_active_director($data['director_info']->id)){
                                    $data['director_info'] = $this->admin_model->get_emails_of_director_by_region($regioncode);
                                  } else {
                                    $data['director_info'] = $this->admin_model->get_emails_of_supervisor_by_region($regioncode);
                                  }

                                  $senior_info = $this->admin_model->get_senior_info($regioncode);
                                   // echo $this->db->last_query();
                                  if($branch_info->status == 23){
                                    $seniorregionname = $this->branches_model->get_region_name($branch_info->regCode);
                                  } else {
                                    $seniorregionname = $this->branches_model->get_region_name($regioncode);
                                  }
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
                                  foreach($data['director_info'] as $directorinfo){
                                    $emaildirect = $directorinfo['email'];
                                  }

                                  if($this->branches_model->sendEmailToSeniorBranchApproveConversion($coop_full_name,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,'',$seniorregionname)){
                                      $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,5,$comment_by_specialist_senior);
                                    }
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                        redirect('for_conversion');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                        redirect('for_conversion');
                                      }
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('for_conversion');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('for_conversion');
                              }
                            }else{
                              $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2,$comment_by_specialist_senior);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                redirect('for_conversion');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                redirect('for_conversion');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('for_conversion');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  // if($this->branches_model->check_evaluator_for_conversion2($decoded_id)){
                                  //   $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                  //   redirect('for_conversion');
                                  // }else{
                                      $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_conversion_comment_history($data_field);
                                   $coop_full_name = $this->input->post('bName',TRUE);
                                   $reason_commment ='';

                                   $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                                   // echo $this->db->last_query();

                                   $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);

                                   $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                    $this->db->from('head_office_coop_type_branch');
                                    if($this->db->count_all_results()>0 && $branch_info->status != 12){
                                      $regioncode = '00';
                                    }

                                   $senior_info = $this->admin_model->get_senior_info($regioncode);
                                   // echo $this->db->last_query();
                                   // echo $branch_info->regCode.'-'.$regioncode;
                                   if(($branch_info->status == 23 || $branch_info->status == 15) && $branch_info->regCode != 0){
                                      $seniorregionname = $this->branches_model->get_region_name($branch_info->regCode);
                                    } else {
                                      $seniorregionname = $this->branches_model->get_region_name($regioncode);
                                    }

                                   $data['client_info'] = $this->user_model->get_user_info($branch_info->user_id);

                                   $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                                   if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';

                                   $brgyforemail = ucwords($branch_info->house_blk_no).' '.ucwords($branch_info->street).$x.' '.$branch_info->brgy.', '.$branch_info->city.', '.$branch_info->province.', '.$branch_info->region;

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

                                    // foreach($data['senior_info'] as $seniorinfo){
                                    //   $emailsenior = $seniorinfo['email'];
                                    // }
                                      // if($step == 6){
                                      //   $this->branches_model->sendEmailToSeniorBranchApprove($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$branch_info->type,'',$seniorregionname->regDesc);
                                      // } else if($step == 5){
                                      //   $this->branches_model->sendEmailToClientApproveBranch($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$branch_info->type,'',$seniorregionname->regDesc);
                                      // }

                                    if($branch_info->migrated == 1){
                                      $branchname = $branch_info->branchName;
                                    }

                                    if($step == 2){
                                      $this->branches_model->sendEmailToClientApproveBranchConversion($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$branch_info->type,'',$seniorregionname->regDesc);
                                    } else if ($step == 5){
                                      $this->branches_model->sendEmailToSeniorBranchApproveConversion($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,'',$seniorregionname);
                                    }
                                    $success = $this->branches_model->approve_by_admin2_for_conversion($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior, $coop_full_name);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                      redirect('for_conversion');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                      redirect('for_conversion');
                                    }
                                  // }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('for_conversion');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('for_conversion');
                              }
                            }else{
                              $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2,$comment_by_specialist_senior);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                redirect('for_conversion');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                redirect('for_conversion');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('for_conversion');
                          }
                        }else if($this->session->userdata('access_level')==2){
//                          if($this->branches_model->check_evaluator1($decoded_id)){
//                            if($this->branches_model->check_evaluator2($decoded_id)){
//                              if($this->branches_model->check_evaluator3($decoded_id)){
//                                if($this->branches_model->check_evaluator4($decoded_id)){
//                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
//                                }else{
                                  if($branch_info->regCode == 0 || $branch_info->status == 12 || $branch_info->evaluator4 != NULL){
                                    $step = 4;
                                  } else {
                                    $step = 7;
                                  }

                                  if($branch_info->status == 55){
                                    $step = 2;
                                  } else if($branch_info->status == 60){
                                    $step = 4;
                                  }

                                  // $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                  // $this->db->from('head_office_coop_type_branch');
                                  // if($this->db->count_all_results()>0 && $branch_info->status != 12){
                                  //   $step = 7;
                                  // }
                                  $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_conversion_comment_history($data_field);
                                  // $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior);

                                  // Get Count Coop Type for HO
                                  //   $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                  //   $this->db->from('head_office_coop_type_branch');
                                  // // End Get Count Coop Type
                                  // if($this->db->count_all_results()>0)
                                  // {
                                  //   if($branch_info->evaluator4 != 0){
                                  //     $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                                  //   } else {
                                  //     $regioncode = "00";
                                  //   }
                                  // } else {
                                    $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);

                                    $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                    $this->db->from('head_office_coop_type_branch');
                                    if($this->db->count_all_results()>0 && $branch_info->status != 12){
                                      $regioncode = '00';
                                    }
                                  // }
                                  // $query= $this->db->get_where('admin',array('region_code'=>$data,'is_director_active'=>1,'access_level'=>3));
                                  // echo $regioncode;
                                  // echo '<script>alert('.printf("%02d", 0).');</script>';
                                  // $data['director_info'] = $this->admin_model->get_director_info($regioncode);
                                  // $tempcount = count($data['director_info']);

                                  $this->db->where(array('region_code'=>$regioncode,'is_director_active'=>1,'access_level'=>3));
                                  $this->db->from('admin');
                                  if($this->db->count_all_results()>0)
                                  {
                                    if($branch_info->status == 24 && $branch_info->regCode != 0){
                                      $data['director_info'] = $this->admin_model->get_emails_of_director_by_region($branch_info->regCode);
                                    } else {
                                      $data['director_info'] = $this->admin_model->get_emails_of_director_by_region($regioncode);
                                    }
                                  } else {
                                    $data['director_info'] = $this->admin_model->get_emails_of_supervisor_by_region($regioncode);
                                  }
                                  $data['client_info'] = $this->user_model->get_user_info($branch_info->user_id);

                                  $data['cds_info'] = $this->admin_model->get_emails_of_specialist_by_region($branch_info->evaluator3);

                                  if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';

                                  $brgyforemail = ucwords($branch_info->house_blk_no).' '.ucwords($branch_info->street).$x.' '.$branch_info->brgy.', '.$branch_info->city.', '.$branch_info->province.', '.$branch_info->region;

                                  $coop_full_name = $this->input->post('bName',TRUE);
                                  $branchname = $coop_full_name;
                                  $reason_commment='';

                                  $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;
                                  foreach($data['director_info'] as $directorinfo){
                                    $emaildirect = $directorinfo['email'];
                                  }

                                  $fullnamecds = '';

                                  foreach($data['cds_info'] as $cdsinfo){
                                    $fullnamecds = $cdsinfo['full_name'];
                                  }

                                  $coop_region = $this->branches_model->get_coop_region($branch_info->regNo);
                                  if($branch_info->status == 24)
                                  {
                                    if($this->branches_model->sendEmailToDirectorHO_OR($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,$coop_region->region)){
                                      $success = $this->branches_model->approve_by_admin2_for_conversion($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name);
                                    }
                                  } else {
                                    if($step == 4){
                                      if($this->branches_model->sendEmailToDirectorConversionForEva($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,$fullnamecds,$coop_region->region)){
                                        $success = $this->branches_model->approve_by_admin2_for_conversion($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name);
                                      }
                                    } else {
                                      if($this->branches_model->sendEmailToDirectorConversion($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,$fullnamecds,$coop_region->region)){
                                        $success = $this->branches_model->approve_by_admin2_for_conversion($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name);
                                      }
                                    }

                                  }
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been submitted.');
                                    redirect('for_conversion');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('for_conversion');
                                  }
//                                }
//                              }else{
//                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
//                                redirect('branches');
//                              }
//                            }else{
//                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
//                              redirect('branches');
//                            }
//                          }else{
//                            $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,1,$comment_by_specialist_senior);
//                            if($success){
//                              $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
//                              redirect('branches');
//                            }else{
//                              $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
//                              redirect('branches');
//                            }
//                          }
                        }else{
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              // if($this->branches_model->check_evaluator3($decoded_id)){
                              //   $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist III.');
                              //   redirect('for_conversion');
                              // }else{
                                  $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                // $this->debug($data_field);
                             $coop_full_name = $this->input->post('bName',TRUE);

                                $success = $this->branches_model->insert_conversion_comment_history($data_field);
                                $reason_commment='';

                                $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);

                                $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                $this->db->from('head_office_coop_type_branch');
                                if($this->db->count_all_results()>0 && $branch_info->status != 12){
                                  $regioncode = '00';
                                }
                                // echo $regioncode;
                                // echo '<script>alert('.printf("%02d", 0).');</script>';
                                // $data['director_info'] = $this->admin_model->get_director_info($regioncode);

                                // if($this->admin_model->is_active_director($data['director_info']->id)){
                                  $seniorinfo = $this->admin_model->get_emails_of_senior_by_region($regioncode);

                                  $data['suvervising_info'] = $this->admin_model->get_specialst_info($branch_info->evaluator_for_transfer_1);

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
                                if($branch_info->migrated == 1){
                                  $branchname = $branch_info->branchName;
                                }
                                $coop_region = $this->branches_model->get_coop_region($branch_info->regNo);
                                // echo $coop_full_name.'-'.$branchname.'-'.$brgyforemail.'-'.$fullnameforemail.'-'.$data['client_info']->contact_number.'-'.$data['client_info']->email.'-'.$emaildirect.'-'.$branch_info->type;
                                if($this->branches_model->sendEmailToSeniorFromCDSBranchConversion($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$seniorinfo,$branch_info->type,$data['suvervising_info']->full_name,$coop_region->region)){
                                  $success = $this->branches_model->approve_by_admin2_for_conversion($admin_info,$decoded_id,$reason_commment,3,$comment_by_specialist_senior,$coop_full_name);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been submitted.');
                                    redirect('for_conversion');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('for_conversion');
                                  }
                                }
                              // }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('for_conversion');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('for_conversion');
                          }
                        }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to approve is already denied.');
                      redirect('for_conversion');
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
          redirect('for_conversion');
        }
      }
    }

    public function specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignBranchSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }else{
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
                $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);

                  // if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));
                    $coop_full_name = $this->input->post('cooperativeName',TRUE);
                    if((is_numeric($decoded_id) && $decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
//                      if($this->branches_model->check_not_yet_assigned($decoded_id)){
                      $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                      // echo $regioncode;
                      // echo '<script>alert('.printf("%02d", 0).');</script>';
                      // $data['director_info'] = $this->admin_model->get_director_info($regioncode);

                      // if($this->admin_model->is_active_director($data['director_info']->id)){
                        $data['director_info'] = $this->admin_model->get_emails_of_specialist_by_region($decoded_specialist_id);
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
                      foreach($data['director_info'] as $directorinfo){
                        $emaildirect = $directorinfo['email'];
                      }

                      $coop_region = $this->branches_model->get_coop_region($branch_info->regNo);
                      if($branch_info->migrated == 1){
                        $branchname = $branch_info->branchName;
                      }
                      // echo $coop_full_name.'-'.$branchname.'-'.$brgyforemail.'-'.$fullnameforemail.'-'.$data['client_info']->contact_number.'-'.$data['client_info']->email.'-'.$emaildirect.'-'.$branch_info->type;
                      if($this->branches_model->sendEmailToSpecialistConversion($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,$coop_region->region)){
                          if($this->branches_model->assign_to_specialist_for_conversion($decoded_id,$decoded_specialist_id,$coop_full_name)){
                            $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
                            redirect('branches');
                          }else{
                            $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                            redirect('branches');
                          }
                        }
//                      }else{
//                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the cooperative to an validator.');
//                        redirect('branches');
//                      }
                    }else{
                      show_404();
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to assign to an evaluator is not yet submitted for evaluation.');
                  //   redirect('branches');
                  // }


              }
            }
          }
        }else{
          redirect('branches');
        }
      }
    }

    public function defer_branch(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{

                    // if($this->branches_model->check_evaluator_for_conversion2($decoded_id)){
                      if(!$this->branches_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $admin_info = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
                                  }else{
                                    $data['admin_info'] = $admin_info;
                                    if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                        $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_conversion_comment_history($data_field);
                                  $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,10);

                                    $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                                    $data['branch_info'] = $branch_info;

                                    if($data['branch_info']->house_blk_no==null && $data['branch_info']->street==null) $x=''; else $x=', ';

                                    $data['client_info'] = $this->user_model->get_user_info($data['branch_info']->user_id);

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

                                    $data['senior_info'] = $this->admin_model->get_senior_info($regioncode);

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

                                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                                    $query3  = $this->db->get_where('regional_officials',array('region_code'=>$data['admin_info']->region_code));
                                    if($query3->num_rows()>0)
                                    {
                                      $reg_officials_info = $query3->row_array();
                                    }
                                    else
                                    {
                                      $reg_officials_info = array(
                                        'email' => 'head_office',
                                        'contact' => '0830403430'
                                      );
                                    }

                                    $rdregion = $this->branches_model->get_region_name($admin_info->region_code);

                                    // echo $rdregion;
                                    if($this->branches_model->sendEmailToClientDeferBranch($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email,$data['branch_info']->type,$reason_commment,$data['admin_info']->region_code,$reg_officials_info,$rdregion->regDesc)){
                                        if($success){
                                          $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                          redirect('branches');
                                        }else{
                                          $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                          redirect('branches');
                                        }
                                      }else{
                                        $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Director.');
                                        redirect('branches');
                                      }
                                    }
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('branches');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('branches');
                              }
                            }else{
                              $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                redirect('branches');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                redirect('branches');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('branches');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  // if($this->branches_model->check_evaluator_for_conversion($decoded_id)){
                                  //   $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                  //   redirect('for_conversion');
                                  // }else{
                                      $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => 3
                                    );
                                  $success = $this->branches_model->insert_conversion_comment_history($data_field);
                                  $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                                    $data['branch_info'] = $branch_info;

                                  if($data['branch_info']->status==23){
                                    $step = 6;
                                  } else {
                                    $step = 5;
                                  }

                                  if($data['branch_info']->status == 34){
                                    $step = 7;
                                  }
                                    $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,10);

                                    if($data['branch_info']->house_blk_no==null && $data['branch_info']->street==null) $x=''; else $x=', ';

                                    $data['client_info'] = $this->user_model->get_user_info($data['branch_info']->user_id);

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

                                    $data['senior_info'] = $this->admin_model->get_senior_info_dir_defer($regioncode);

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

                                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                                    $query3  = $this->db->get_where('regional_officials',array('region_code'=>$data['admin_info']->region_code));
                                    if($query3->num_rows()>0)
                                    {
                                      $reg_officials_info = $query3->row_array();
                                    }
                                    else
                                    {
                                      $reg_officials_info = array(
                                        'email' => 'head_office',
                                        'contact' => '0830403430'
                                      );
                                    }
                                    $rdregion = $this->branches_model->get_region_name($admin_info->region_code);

                                    if($this->branches_model->sendEmailToClientDeferBranchConversion($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email,$data['branch_info']->type,$reason_commment,$data['admin_info']->region_code,$reg_officials_info,$rdregion->regDesc)){
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                        redirect('for_conversion');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                        redirect('for_conversion');
                                      }
                                    }

                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('for_conversion');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('for_conversion');
                              }
                            }else{
                              $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                redirect('for_conversion');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                redirect('for_conversion');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('for_conversion');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
                                }else{
                                  $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,4);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                    redirect('for_conversion');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                    redirect('brafor_conversionnches');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('for_conversion');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('for_conversion');
                            }
                          }else{
                            $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                              redirect('for_conversion');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                              redirect('for_conversion');
                            }
                          }
                        }else{
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              // if($this->branches_model->check_evaluator3($decoded_id)){
                              //   $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                              //   redirect('for_conversion');
                              // }else{
                                $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,7);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                  redirect('for_conversion');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                  redirect('for_conversion');
                                }
                              // }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('for_conversion');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('for_conversion');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to defer is already denied.');
                        redirect('for_conversion');
                      }
                    // }else{
                    //   $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                    //   redirect('for_conversion');
                    // }

                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('branch_error', validation_errors('<li>','</li>'));
          redirect('for_conversion');
        }
      }
    }

    public function deny_branch_for_conversion(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');

          $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
          $coop_full_name = $this->input->post('bnameorig',TRUE);

          if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';

          $brgyforemail = ucwords($branch_info->house_blk_no).' '.ucwords($branch_info->street).$x.' '.$branch_info->brgy.', '.$branch_info->city.', '.$branch_info->province.', '.$branch_info->region;

          $data['client_info'] = $this->user_model->get_user_info($branch_info->user_id);

          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('for_conversion');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{

                    // if($this->branches_model->check_submitted_for_evaluation($decoded_id)){

                      //if(!$this->branches_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $admin_info = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
                                  }else{
                                    if(!$this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){

                                      $rdregion = $this->branches_model->get_region_name($admin_info->region_code);

                                      if($this->branches_model->sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$data['client_info']->email,$branch_info->type,$rdregion)){
                                        $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                        if($success){
                                          $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                          redirect('branches');
                                        }else{
                                          $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                          redirect('branches');
                                        }
                                      } else {
                                        $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                          redirect('branches');
                                      }
                                    }else{
                                      $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Director.');
                                      redirect('branches');
                                    }
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('branches');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('branches');
                              }
                            }else{
                              if($this->branches_model->sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$data['client_info']->email,$branch_info->type)){
                                $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                  redirect('branches');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                  redirect('branches');
                                }
                              } else {
                                $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                  redirect('branches');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('branches');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  // if($this->branches_model->check_evaluator5($decoded_id)){
                                  //   $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                  //   redirect('branches');
                                  // }else{

                                    $rdregion = $this->branches_model->get_region_name($admin_info->region_code);

                                    // echo $coop_full_name;
                                    if($this->branches_model->sendEmailToClientDenyConversion($coop_full_name,$brgyforemail,$reason_commment,$data['client_info']->email,$branch_info->type,$rdregion->regDesc)){
                                      $success = $this->branches_model->deny_by_admin_for_conversion($admin_info,$decoded_id,$reason_commment,1);
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                        redirect('for_conversion');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                        redirect('for_conversion');
                                      }
                                    } else {
                                      $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                        redirect('for_conversion');
                                    }
                                  // }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('for_conversion');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('for_conversion');
                              }
                            }else{
                              $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                redirect('for_conversion');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                redirect('for_conversion');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('for_conversion');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
                                }else{
                                  $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,4);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                    redirect('branches');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                    redirect('branches');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('branches');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('branches');
                            }
                          }else{
                            $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                              redirect('branches');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                              redirect('branches');
                            }
                          }
                        }else{
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                                redirect('branches');
                              }else{
                                $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,3);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                  redirect('branches');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                  redirect('branches');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('branches');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('branches');
                          }
                        }
                      //}else{
                        //$this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is already denied.');
                        //redirect('cooperatives');
                      //}
                    // }else{
                    //   $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                    //   redirect('branches');
                    // }

                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('branche_error', validation_errors('<li>','</li>'));
          redirect('branches/'.$this->input->post('branchID',TRUE));
        }
      }
    }
}
