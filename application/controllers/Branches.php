<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Branches extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
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
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                if($this->form_validation->run() == FALSE){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
//                  $data['members_composition'] = $this->branches_model->get_coop_composition($decoded_id);
                  
                  $data['title'] = 'Update Cooperative Details';
                  $data['header'] = 'Update Cooperative Information';
                  
                  $data['branch_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                  $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['registered_info']->type);
                  $data['major_industry_list'] = $this->branches_model->get_all_major_industry($decoded_id);
//                  $data['composition']= $this->branches_model->get_composition();
                  $data['regions_list'] = $this->region_model->get_regions();
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                  $this->load->view('./template/header', $data);
                  $this->load->view('cooperative/registration_update', $data);
//                  if($this->branches_model->check_expired_reservation($decoded_id,$user_id)){
//                    $this->load->view('cooperative/terms_and_condition');
//                  }
                  $this->load->view('./template/footer', $data);
                }else{
                  if(!$this->branches_model->check_expired_reservation($decoded_id,$user_id)){
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
                    
                    $data['branch_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                    $data['registered_info'] = $this->branches_model->get_registered_coop($data['branch_info']->regNo);
                    
                    if(empty($this->input->post('region2')) || $this->input->post('barangay')==$this->input->post('barangay2')){
                        $regCodeBranch = 0;
                    } else if ($data['registered_info']->addrCode == $this->input->post('barangay')){ 
                        $regCodeBranch = 0;
                    } else {
                        $regCodeBranch = $this->input->post('region2');
                    }
                    
                    $field_data = array(
                      'user_id' => $this->session->userdata('user_id'),
                      'regCode' => $regCodeBranch,
//                      'category_of_cooperative' => $category,
//                      'proposed_name' => $this->input->post('proposedName'),
//                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
//                      'grouping' => $group,
//                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'type' => $this->input->post('typeOfbranchsatellite'),
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'addrCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo')
                    );
                    if($this->branches_model->update_not_expired_branches($user_id,$decoded_id,$field_data)){
                      // echo '<script>alert("Successfully updated basic information");';
                      // echo "window.location.href = '" . $this->input->post('branchID') . "';</script>";
                      $this->session->set_flashdata('branches_success', 'Successfully updated Branch/Satellite basic information.');
                     redirect('branches/'.$this->input->post('branchID'));
                    }else{
                      $this->session->set_flashdata('branches_success', 'Unable to update Branch/Satellite basic information.');
                      redirect('branches/'.$this->input->post('branchID'));
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
                    if($this->branches_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated expired reservation.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to reserve cooperative.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID'));
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
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              if(!$this->branches_model->check_expired_reservation_by_admin($decoded_id)){
                if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                  if(!$this->branches_model->check_first_evaluated($decoded_id)){
                    if($this->form_validation->run() == FALSE){
                      $data['title'] = 'Update Branch/Satellite Details';
                      $data['header'] = 'Update Branch/Satellite Information';
                      $data['branch_info'] = $this->branches_model->get_cooperative_info_by_admin($decoded_id);
                      $data['regions_list'] = $this->region_model->get_regions();
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['branch_info']->type_of_cooperative);
                      $data['major_industry_list'] = $this->branches_model->get_all_major_industry($decoded_id);
                      $data['subclasses_list'] = $this->branches_model->get_all_subclasses($decoded_id);
                      $data['encrypted_id'] = $id;
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('cooperative/registration_update', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      if(!$this->branches_model->check_expired_reservation_by_admin($decoded_id)){
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
                        if($this->branches_model->update_not_expired_cooperative_by_admin($decoded_id,$field_data,$subclass_array,$major_industry)){
                          $this->session->set_flashdata('cooperative_success', 'Successfully updated this cooperative basic information.');
                          redirect('cooperatives/'.$this->input->post('cooperativeID'));
                        }else{
                          $this->session->set_flashdata('cooperative_error', 'Unable to update this cooperative basic information.');
                          redirect('cooperatives/'.$this->input->post('cooperativeID'));
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
                        redirect('cooperatives');
                      }
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
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

                  if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
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
                      } else if ($branch_info->area_of_operation == 'Regional') {
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

                      // echo $coop_full_name.'-'.$branchname.'-'.$brgyforemail.'-'.$fullnameforemail.'-'.$data['client_info']->contact_number.'-'.$data['client_info']->email.'-'.$emaildirect.'-'.$branch_info->type;
                      if($this->admin_model->sendEmailToSpecialistBranch($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type)){
                          if($this->branches_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
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
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('branches');
                  }
              

              }
            }
          }
        }else{
          redirect('branches');
        }
      }
    }
    public function business_activity($regNo){
      $data = $this->branches_model->get_business_activity_coop($regNo);
      echo json_encode($data);
    }
    public function coop_info($regNo){
      $data = $this->branches_model->get_coop($regNo);
      echo json_encode($data);
    }

    public function check_coverage_validity(){
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('coopArea')){
        
        if ($this->input->get('coopArea')!='National' && $this->input->get('fieldValue')!= 'National' &&
        $this->input->get('fieldValue')>$this->input->get('coopArea'))
          $result = array($this->input->get('fieldId'),false);
        else
          $result = array($this->input->get('fieldId'),true);

        echo json_encode($result);
      }else{
        show_404();
      }
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
          $this->load->view('applications/list_of_branches', $data);
          $this->load->view('cooperative/delete_modal_branch');
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

    public function registration(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Registration Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Registration';
              $data['regions_list'] = $this->region_model->get_regions();             
              $data['coopreg_info'] = $this->branches_model->getCoopRegNo($user_id);
//              $data['regno'] = $data['coopreg_info']->regNo;
              if(empty($data['coopreg_info'])){
                  $data['regno'] = '';
              } else {
                  $data['regno'] = $data['coopreg_info']->regNo;
              }
              
              if ($this->form_validation->run() == FALSE){
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/registration_detail', $data);
//                $this->load->view('cooperative/terms_and_condition');
                $this->load->view('./template/footer');
              }else{

                $BAC = $this->input->post('BAC');
                $provDesc = $this->branches_model->prov($this->input->post('province'));
                $cityDesc = $this->branches_model->city($this->input->post('city'));
                $branchCount =$this->branches_model->branch_count($this->input->post('regNo'),substr($this->input->post('city'),0,6),$this->input->post('typeOfBranch')); 
                if(empty($this->input->post('region2')) || $this->input->post('barangay')==$this->input->post('barangay2')){
                    $regCodeBranch = 0;
                } else {
                    $regCodeBranch = $this->input->post('region2');
                }
                // echo $this->input->post('barangay2');
                // echo $this->input->post('barangay');
                // echo $this->input->post('region2');
                $field_data = array(
                  'user_id' => $this->session->userdata('user_id'),
                  'branchName' => $this->input->post('typeOfBranch'),
                  'coopName' => $this->input->post('coopName'),
                  'regNo' => $this->input->post('regNo'),
                  'common_bond' => $this->input->post('commonBondOfMembership'),
                  'area_of_operation' => $this->input->post('areaOfOperation'),
                  'type' => $this->input->post('typeOfBranch'),
                  'regCode' => $regCodeBranch,
                  'addrCode' => $this->input->post('barangay'),
                  'street' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'dateApplied' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'lastUpdated' =>  date('Y-m-d h:i:s',now('Asia/Manila'))
                );
                //if($this->branches_model->rule_3_years($this->input->post('regNo'))){
                  if($this->branches_model->add_branch($field_data,$BAC)){
                    $this->session->set_flashdata('list_success_message', 'Registration info has been submitted. Proceed to Next Step');
                    redirect('branches');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                    redirect('branches');
                  }
                //}else{
                //  $this->session->set_flashdata('list_error_message', 'Cooperative existence is less than 3 years.');
                //  redirect('branches');
                //}
              }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('branches');
            }
          }

      }
    }

    public function delete_branches(){
        echo '<script>alert("wow");</script>';
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteBranchBtn')){
          if($this->session->userdata('client')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($decoded_id) && $decoded_id!=0){
              if($this->branches_model->check_own_branch($decoded_id,$user_id)){
                if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->branches_model->delete_branch($decoded_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Branch has been deleted.');
                    redirect('branches');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to delete branch.');
                    redirect('branches');
                  }
                }else{
                  if(!$this->branches_model->check_if_denied($decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('branches/'.$this->input->post('branchID',TRUE));
                  }else{
                    $success = $this->branches_model->delete_branch($decoded_id);
                    if($success){
                      $this->session->set_flashdata('list_success_message', 'Branch has been deleted.');
                      redirect('branches');
                    }else{
                      $this->session->set_flashdata('list_error_message', 'Unable to delete branch.');
                      redirect('branches');
                    }
                  }
                }
              }
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('branches');
            }
          }
        }else{
          redirect('branches');
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
              
              $data['branches_comments'] = $this->branches_model->branches_comments_client($decoded_id);
              
              $data['submitted'] = $this->branches_model->check_submitted_for_evaluation($decoded_id);

              $data['in_chartered_cities'] = false;
              // $this->debug();

              if($this->charter_model->in_charter_city($data['branch_info']->cCode))
              {
                $data['in_chartered_cities']=true;
                $data['chartered_cities'] = $this->charter_model->get_charter_city($data['branch_info']->cCode);
              }


              $this->load->view('./template/header', $data);
              $this->load->view('cooperative/branch_detail', $data);
              $this->load->view('./template/footer');
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
                if($data['branch_info']->status==17){
                    $status = 12;
                } else {
                    $status = 8;
                }
                $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                $this->db->from('head_office_coop_type_branch');
                if($this->db->count_all_results()>0){
                  $status = 24;
                }
                
                if($data['branch_info']->status == 1 && $data['branch_info']->regCode == 0 || $data['branch_info']->evaluator4 != NULL){
                    $stat = 2;
                } else {
                    $stat = 24;
                }
                $same= ($branch_info->rCode=='0'+substr($branch_info->mainAddr, 0,2)) ? $status: $stat;
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
//                $data['branch_info'] = $branch_info;
                if($data['branch_info']->type == "Branch"){
                  if($document_5 && $document_6 && $document_7){
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
                            
                            $data['senior_info'] = $this->admin_model->get_senior_info($regioncode);

                            $brgyforemail = ucwords($data['branch_info']->house_blk_no).' '.ucwords($data['branch_info']->street).$x.' '.$data['branch_info']->brgy.', '.$data['branch_info']->city.', '.$data['branch_info']->province.', '.$data['branch_info']->region;

                            $proposednameemail = $data['branch_info']->coopName;

                            if($data['branch_info']->area_of_operation == 'Barangay' || $data['branch_info']->area_of_operation == 'Municipality/City'){
                                $proposedbranch = $data['branch_info']->brgy.' '.$data['branch_info']->type;
                            } else if($data['branch_info']->area_of_operation == 'Provincial') {
                                $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                            } else if ($data['branch_info']->area_of_operation == 'Regional') {
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
                              $sendemailtosenior = 'sendEmailToSeniorDeferBranch';
                            } else {
                              $sendemailtosenior = 'sendEmailToSeniorBranch';
                            }

                            if($this->admin_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email,$data['branch_info']->type)){
                              if($this->admin_model->sendEmailToClientBranch($data['client_info']->email)){
                                $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('branches/'.$id);
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
                    }else if(!$document_5 && !$document_6 && !$document_7){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your three other documents.');
                      redirect('branches/'.$id);
                    }else if(!$document_5){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your Business Plan.');
                      redirect('branches/'.$id);
                    }else if(!$document_6){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your GA Resolution.');
                      redirect('branches/'.$id);
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please upload first your Certification.');
                      redirect('branches/'.$id);
                    }
  /*Else Satellite*/} else {
                    if($document_7 && $document_8 && $document_9){
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
                            
                            $data['senior_info'] = $this->admin_model->get_senior_info($regioncode);

                            $brgyforemail = ucwords($data['branch_info']->house_blk_no).' '.ucwords($data['branch_info']->street).$x.' '.$data['branch_info']->brgy.', '.$data['branch_info']->city.', '.$data['branch_info']->province.', '.$data['branch_info']->region;

                            $proposednameemail = $data['branch_info']->coopName;

                            if($data['branch_info']->area_of_operation == 'Barangay' || $data['branch_info']->area_of_operation == 'Municipality/City'){
                                $proposedbranch = $data['branch_info']->brgy.' '.$data['branch_info']->type;
                            } else if($data['branch_info']->area_of_operation == 'Provincial') {
                                $proposedbranch = $data['branch_info']->city.' '.$data['branch_info']->type;
                            } else if ($data['branch_info']->area_of_operation == 'Regional') {
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
                              $sendemailtosenior = 'sendEmailToSeniorDeferBranch';
                            } else {
                              $sendemailtosenior = 'sendEmailToSeniorBranch';
                            }
                            if($this->admin_model->$sendemailtosenior($proposednameemail,$proposedbranch,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email,$data['branch_info']->type)){
                              $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                              redirect('branches/'.$id);
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
                    }else if(!$document_7 && !$document_8 && !$document_9){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your three other documents.');
                      redirect('branches/'.$id);
                    }else if(!$document_7){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your Certification.');
                      redirect('branches/'.$id);
                    }else if(!$document_8){
                      $this->session->set_flashdata('redirect_message', 'Please upload first your Certificate of Compliance.');
                      redirect('branches/'.$id);
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please upload first your Oath of Undertaking.');
                      redirect('branches/'.$id);
                    }
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

    public function payment($coop){
      $coop = $this->encryption->decrypt(decrypt_custom($coop));
      $branch=str_replace('%20',' ',$coop);
      $data = $this->branches_model->get_payment_info($branch);
      echo json_encode($data);
      // print_r($data);
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
                      if($this->session->userdata('access_level')==4){
                          if($this->branches_model->check_evaluator1($decoded_id)){
                            if($this->branches_model->check_evaluator2($decoded_id)){
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                if($this->branches_model->check_evaluator4($decoded_id)){
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
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
                                  $data['client_info'] = $this->user_model->get_user_info($branch_info->user_id);

                                  if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';

                                  $brgyforemail = ucwords($branch_info->house_blk_no).' '.ucwords($branch_info->street).$x.' '.$branch_info->brgy.', '.$branch_info->city.', '.$branch_info->province.', '.$branch_info->region;

                                  $coop_full_name = $this->input->post('bName',TRUE);
                                  // $branchname = $coop_full_name.' '.$branch_info->type;

                                  if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                                      $branchname = $branch_info->brgy.' '.$branch_info->type;
                                  } else if($branch_info->area_of_operation == 'Provincial') {
                                      $branchname = $branch_info->city.' '.$branch_info->type;
                                  } else if ($branch_info->area_of_operation == 'Regional') {
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

                                  if($this->admin_model->sendEmailToSeniorBranch($coop_full_name,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type)){
                                      $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,5,$comment_by_specialist_senior);
                                    }
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                        redirect('branches');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
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
                              $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2,$comment_by_specialist_senior);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                redirect('branches');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
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
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
                                  }else{
                                      $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_comment_history($data_field);
                                   $coop_full_name = $this->input->post('bName',TRUE);
                                   $reason_commment ='';
                                    $success = $this->branches_model->approve_by_admin2($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior, $coop_full_name);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                      redirect('branches');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
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
                              $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2,$comment_by_specialist_senior);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been approved.');
                                redirect('branches');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                redirect('branches');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('branches');
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
                                  $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                  $this->db->from('head_office_coop_type_branch');
                                  if($this->db->count_all_results()>0 && $branch_info->status != 12){
                                    $step = 7;
                                  }
                                  $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $comment_by_specialist_senior,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_comment_history($data_field);
                                  // $success = $this->branches_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior);

                                  // Get Count Coop Type for HO
                                    $this->db->where(array('name'=>$branch_info->registeredtype,'active'=>1));
                                    $this->db->from('head_office_coop_type_branch');
                                  // End Get Count Coop Type
                                  if($this->db->count_all_results()>0)
                                  {
                                    if($branch_info->evaluator4 != 0){
                                      $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                                    } else {
                                      $regioncode = "00";
                                    }
                                  } else {
                                    $regioncode = "0".mb_substr($branch_info->addrCode, 0, 2);
                                  }
                                  // $query= $this->db->get_where('admin',array('region_code'=>$data,'is_director_active'=>1,'access_level'=>3));
                                  // echo $regioncode;
                                  // echo '<script>alert('.printf("%02d", 0).');</script>';
                                  // $data['director_info'] = $this->admin_model->get_director_info($regioncode);
                                  // $tempcount = count($data['director_info']);

                                  $this->db->where(array('region_code'=>$regioncode,'is_director_active'=>1,'access_level'=>3));
                                  $this->db->from('admin');
                                  if($this->db->count_all_results()>0)
                                  {
                                    $data['director_info'] = $this->admin_model->get_emails_of_director_by_region($regioncode);
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

                                  foreach($data['cds_info'] as $cdsinfo){
                                    $fullnamecds = $cdsinfo['full_name'];
                                  }

                                  if($branch_info->status == 24)
                                  {
                                    if($this->admin_model->sendEmailToDirectorHO_OR($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type)){
                                      $success = $this->branches_model->approve_by_admin2($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name);
                                    }
                                  } else {
                                    if($this->admin_model->sendEmailToDirector($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type,$fullnamecds)){
                                      $success = $this->branches_model->approve_by_admin2($admin_info,$decoded_id,$reason_commment,$step,$comment_by_specialist_senior,$coop_full_name);
                                    }
                                  }
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been submitted.');
                                    redirect('branches');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('branches');
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
                              if($this->branches_model->check_evaluator3($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                                redirect('branches');
                              }else{
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
                                  $data['director_info'] = $this->admin_model->get_emails_of_senior_by_region($regioncode);
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
                                } else if ($branch_info->area_of_operation == 'Regional') {
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

                                // echo $coop_full_name.'-'.$branchname.'-'.$brgyforemail.'-'.$fullnameforemail.'-'.$data['client_info']->contact_number.'-'.$data['client_info']->email.'-'.$emaildirect.'-'.$branch_info->type;
                                if($this->admin_model->sendEmailToSpecialistBranch($branch_info->coopName,$branchname,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$emaildirect,$branch_info->type)){
                                  $success = $this->branches_model->approve_by_admin2($admin_info,$decoded_id,$reason_commment,3,$comment_by_specialist_senior,$coop_full_name);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been submitted.');
                                    redirect('branches');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('branches');
                                  }
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
    public function deny_branch(){
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
                  
                    if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                      
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
                                      $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                        redirect('branches');
                                      }else{
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
                              $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                redirect('branches');
                              }else{
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
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
                                  }else{
                                    $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                      redirect('branches');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
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
                              $success = $this->branches_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                redirect('branches');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                redirect('branches');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('branches');
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
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                      redirect('branches');
                    }
                  
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
                  
                    if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
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
                                    if(!$this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                        $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->branches_model->insert_comment_history($data_field);
                                      $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,5);
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
                                  if($this->branches_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('branches');
                                  }else{
                                      $data_field = array(
                                        'branches_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => 3
                                    );
                                  $success = $this->branches_model->insert_comment_history($data_field);
                                    $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                      redirect('branches');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
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
                                    redirect('branches');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
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
                            $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                              redirect('branches');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
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
                                $success = $this->branches_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,3);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch/Satellite has been deferred.');
                                  redirect('branches');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
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
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to defer is already denied.');
                        redirect('branches');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                      redirect('branches');
                    }
                  
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('branch_error', validation_errors('<li>','</li>'));
          redirect('branches/'.$this->input->post('branchID',TRUE));
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
      $result = $this->branches_model->is_name_unique($data);
      if($result[1]==true){
        return true;
      }else{
        $this->form_validation->set_message('cooperative_name_exists_check', 'Cooperative Name already exists.');
        return FALSE;
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
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->branches_model->get_cooperative_info($decoded_user_id,$decoded_id);
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
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->branches_model->get_cooperative_info_by_admin($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function get_business_activities_of_coop(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('branches');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->branches_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
  

    public function saveor($was){
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('orDate'),
        'status' =>1
      );
          $date_of_or = $this->input->post('orDate');

      $this->branches_model->save_OR(array('id' => $this->input->post('payment_id')), $data,$this->input->post('bid'),$date_of_or);
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
      
    }
    public function get_branch_info(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('branches');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->branches_model->get_branch_info($decoded_user_id,$decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
  }

 ?>
