<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bylaw_update extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  // function index($id  = null)
  // {
  //   if(!$this->session->userdata('logged_in')){
  //     redirect('users/login');
  //   }else{
  //     $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
  //     $user_id = $this->session->userdata('user_id');
  //     $data['is_client'] = $this->session->userdata('client');
  //     if(is_numeric($decoded_id) && $decoded_id!=0){
  //       if($this->session->userdata('client')){
  //         if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
  //           if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
  //             $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
  //             if($data['coop_info']->grouping =="Federation"){
  //               redirect('cooperatives/'.$id.'/bylaws_federation');
  //             }else 
  //                 if($data['coop_info']->grouping =="Union" && $data['coop_info']->type_of_cooperative == 'Union'){
  //               redirect('cooperatives/'.$id.'/bylaws_union');
  //             }else{
  //               redirect('cooperatives_update/'.$id.'/bylaws_primary');
  //             }
  //           }else{
  //             redirect('cooperatives/'.$id);
  //           }
  //         }else{
  //           $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
  //           redirect('cooperatives');
  //         }
  //       }else{
  //         if($this->session->userdata('access_level')==5){
  //           redirect('admins/login');
  //         }
  //         // else if($this->session->userdata('access_level')!=1){
  //         //   redirect('cooperatives');
  //         // }
  //         else{
  //           if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
  //             $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
  //             if($data['coop_info']->grouping =="Federation"){
  //               redirect('cooperatives/'.$id.'/bylaws_federation');
  //             }else if($data['coop_info']->grouping =="Union" && $data['coop_info']->type_of_cooperative == 'Union'){
  //               redirect('cooperatives/'.$id.'/bylaws_union');
  //             }else{
  //               redirect('cooperatives/'.$id.'/bylaws_primary');
  //             }
  //           }else{
  //             $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
  //             redirect('cooperatives_update/'.$id);
  //           }
  //         }
  //       }
  //     }else{
  //       show_404();
  //     }
      
  //   }
  // }


  function primary($id  = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_update_model->check_own_cooperative($decoded_id)){
            if(!$this->cooperatives_update_model->check_expired_reservation($decoded_id)){
              // if($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->category_of_cooperative =="Primary" || ($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->grouping == "Union" && $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->type_of_cooperative != "Union")){
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                if(!isset($_POST['bylawsPrimaryBtn'])){
                  $data['title'] = 'By Laws';
                  $data['header'] = 'By Laws';
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['encrypted_id'] = $id;
                  $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($decoded_id);
                  $data['bylaw_info'] = $this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id);
                  $data['reg_qualifications'] ='';
                  $data['add_membership'] ='';
                  $data['add_members_vote']='';
                  $data['asc_qualifications'] ='';
                  if($data['bylaw_info']!=null)
                  {
                    $data['reg_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                    $data['add_membership'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                    $data['add_members_vote'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_conditions_to_vote);
                    $data['asc_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                  }
                  
                  //Notification if cooperative need to update
                  if(isset($data['coop_info']->id)){
                   $data['is_update_cooperative'] = $this->cooperatives_update_model->check_date_registered($data['coop_info']->id);
                  }
                  $this->load->view('template/header', $data);
                  $this->load->view('update/bylaw_form_update.php', $data);
                  // $this->load->view('cooperators/delete_cooperators_alert');
                  $this->load->view('template/footer');
                }else{
                  
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    if($this->input->post('additionalConditionsForVoting')){
                      $regQualificationsLength = sizeof($this->input->post('additionalConditionsForVoting'));
                      $additionalConditionsForVoting = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalConditionsForVoting .=  $this->input->post('additionalConditionsForVoting')[$i].';';
                        }
                      $additionalConditionsForVoting = substr_replace($additionalConditionsForVoting, "", -1);
                    }
                     $ascQualicationsTemp = '';
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                     
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    // $now = date('m/d/Y H:i:s');
                    // $expire = date('Y-m-d H:i:s',strtotime('+30 days',strtotime($now)));

          
                    
                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
                      'regular_qualifications' => $regQualicationsTemp,
                      'associate_qualifications' => $ascQualicationsTemp,                     
                      'membership_fee' =>$membership_fee,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
                      'additional_conditions_to_vote' => $additionalConditionsForVoting,
                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      // 'delegate_powers'=> $this->input->post('delegatePowers'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'annual_regular_meeting_day_date'=> $this->input->post('regularMeetingDayDate'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('regularMeetingDayVenue'),
                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'member_invest_per_month'=> $investPerMonth,
                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
                      'member_percentage_service'=> $this->input->post('investService'),
                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
                      'percent_education_fund'=> $this->input->post('educationFund'),
                      'percent_community_fund'=> $this->input->post('communityFund'),
                      'percent_optional_fund'=> $this->input->post('othersFund'),
                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    // $this->debug($data);
                    // var_dump($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data));
                    // echo $this->db->last_query();
                    if($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                    }
                 
                }
              // }else{ 
              //   redirect('cooperatives_update/'.$id.'/bylaws_primary');
              // }
            }else{
               redirect('cooperatives_update/'.$id.'/bylaws_primary');
            }
          }else{ 
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives_update/'.$id.'/bylaws_primary');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }
          // else if($this->session->userdata('access_level')!=1){
          //   redirect('cooperatives');
          // }
          // else{
          if($this->session->userdata('access_level')==6)
          {

           
            if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              if($this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->category_of_cooperative == "Primary" || $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->type_of_cooperative == "Insurance" || $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->type_of_cooperative == "Cooperative Bank"){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                  if(!isset($_POST['bylawsPrimaryBtn'])){
                    $data['title'] = 'By Laws';
                    $data['header'] = 'By Laws';
                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                    $data['encrypted_id'] = $id;
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_info'] = $this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id);
                    if(isset($data['bylaw_info'])){
                      $data['add_members_vote'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_conditions_to_vote);
                      $data['reg_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                      $data['asc_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                      $data['add_membership'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                    }
                    $this->load->view('templates/admin_header', $data);
                    $this->load->view('update/bylaw_form_update.php', $data);
                    $this->load->view('templates/admin_footer');
                  } else {
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    if($this->input->post('additionalConditionsForVoting')){
                      $regQualificationsLength = sizeof($this->input->post('additionalConditionsForVoting'));
                      $additionalConditionsForVoting = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalConditionsForVoting .=  $this->input->post('additionalConditionsForVoting')[$i].';';
                        }
                      $additionalConditionsForVoting = substr_replace($additionalConditionsForVoting, "", -1);
                    }
                     $ascQualicationsTemp = '';
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                     
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    // $now = date('m/d/Y H:i:s');
                    // $expire = date('Y-m-d H:i:s',strtotime('+30 days',strtotime($now)));

          
                    
                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
                      'regular_qualifications' => $regQualicationsTemp,
                      'associate_qualifications' => $ascQualicationsTemp,                     
                      'membership_fee' =>$membership_fee,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
                      'additional_conditions_to_vote' => $additionalConditionsForVoting,
                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      // 'delegate_powers'=> $this->input->post('delegatePowers'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'annual_regular_meeting_day_date'=> $this->input->post('regularMeetingDayDate'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('regularMeetingDayVenue'),
                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'member_invest_per_month'=> $investPerMonth,
                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
                      'member_percentage_service'=> $this->input->post('investService'),
                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
                      'percent_education_fund'=> $this->input->post('educationFund'),
                      'percent_community_fund'=> $this->input->post('communityFund'),
                      'percent_optional_fund'=> $this->input->post('othersFund'),
                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    // $this->debug($data);
                    // var_dump($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data));
                    // echo $this->db->last_query();
                    if($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the bylaws of the cooperative are not avaiable because it is not yet submitted for evaluation.');
                  redirect('cooperatives_update');
                }
              }else{
                redirect('cooperatives_update/'.$id.'/bylaws');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives_update');
            }
          }
        }
      }else{
        // show_404();
      }
    }
  }

  function federation($id  = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_update_model->check_own_cooperative($decoded_id)){
            if(!$this->cooperatives_update_model->check_expired_reservation($decoded_id)){
              // if($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->category_of_cooperative =="Primary" || ($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->grouping == "Union" && $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->type_of_cooperative != "Union")){
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                if(!isset($_POST['bylawsPrimaryBtn'])){
                  $data['title'] = 'By Laws';
                  $data['header'] = 'By Laws';
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['encrypted_id'] = $id;
                  $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($decoded_id);
                  $data['bylaw_info'] = $this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id);
                  $data['reg_qualifications'] ='';
                  $data['add_membership'] ='';
                  $data['add_members_vote']='';
                  $data['asc_qualifications'] ='';
                  $data['delegate_powers'] ='';
                  $data['primary_consideration'] ='';


                  if($data['bylaw_info']!=null)
                  {
                    $data['reg_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                    $data['add_membership'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                    $data['add_members_vote'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_conditions_to_vote);
                    $data['asc_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                    $data['delegate_powers'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers);
                    $data['primary_consideration'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration);
                  }

                  //Notification if cooperative need to update
                  if(isset($data['coop_info']->id)){
                   $data['is_update_cooperative'] = $this->cooperatives_update_model->check_date_registered($data['coop_info']->id);
                  }
                  $this->load->view('template/header', $data);
                  $this->load->view('update/bylaw_federation_form', $data);
                  // $this->load->view('cooperators/delete_cooperators_alert');
                  $this->load->view('template/footer');
                }else{
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    if($this->input->post('additionaldelegatePowers')){
                      $regQualificationsLength = sizeof($this->input->post('additionaldelegatePowers'));
                      $additionaldelegatePowers = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionaldelegatePowers .=  $this->input->post('additionaldelegatePowers')[$i].';';
                        }
                      $additionaldelegatePowers = substr_replace($additionaldelegatePowers, "", -1);
                    }
                    if($this->input->post('additionalPrimaryConsideration')){
                      $regQualificationsLength = sizeof($this->input->post('additionalPrimaryConsideration'));
                      $additionalPrimaryConsideration = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalPrimaryConsideration .=  $this->input->post('additionalPrimaryConsideration')[$i].';';
                        }
                      $additionalPrimaryConsideration = substr_replace($additionalPrimaryConsideration, "", -1);
                    }
                    if($this->input->post('additionalConditionsForVoting')){
                      $regQualificationsLength = sizeof($this->input->post('additionalConditionsForVoting'));
                      $additionalConditionsForVoting = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalConditionsForVoting .=  $this->input->post('additionalConditionsForVoting')[$i].';';
                        }
                      $additionalConditionsForVoting = substr_replace($additionalConditionsForVoting, "", -1);
                    }
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                      $ascQualicationsTemp = '';
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    $now = date('m/d/Y H:i:s');
                    $expire = date('Y-m-d H:i:s',strtotime('+30 days',strtotime($now)));

                    if($data['bylaw_info']->regular_percentage_shares_subscription == NULL){
                      $field_data = array(
                        'expire_at' => $expire,
                      );
                      if($this->cooperatives_model->update_expire_at($user_id,$decoded_id,$field_data)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        // redirect('cooperatives/'.$this->input->post('cooperativeID'));
                      }
                    }

                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
                      'regular_qualifications' => $regQualicationsTemp,
                      'associate_qualifications' => $ascQualicationsTemp,                     
                      'membership_fee' =>$membership_fee,
                      'primary_consideration' =>$additionalPrimaryConsideration,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
                      'additional_conditions_to_vote' => $additionalConditionsForVoting,
                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      'delegate_powers'=> $additionaldelegatePowers,
                      'composition_of_bod'=> $this->input->post('compositionoftheboard'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'annual_regular_meeting_day_date'=> $this->input->post('regularMeetingDayDate'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('regularMeetingDayVenue'),
                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'member_invest_per_month'=> $investPerMonth,
                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
                      'member_percentage_service'=> $this->input->post('investService'),
                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
                      'percent_education_fund'=> $this->input->post('educationFund'),
                      'percent_community_fund'=> $this->input->post('communityFund'),
                      'percent_optional_fund'=> $this->input->post('othersFund'),
                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    if($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_federation');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_federation');
                    }
                 
                }
              // }else{ 
              //   redirect('cooperatives_update/'.$id.'/bylaws_primary');
              // }
            }else{
               redirect('cooperatives_update/'.$id.'/bylaws_federation');
            }
          }else{ 
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives_update/'.$id.'/bylaws_federation');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }
          // else if($this->session->userdata('access_level')!=1){
          //   redirect('cooperatives');
          // }
          // else{
          if($this->session->userdata('access_level')==6)
          {

           
            if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              if($this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->category_of_cooperative == "Primary" || $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->type_of_cooperative == "Insurance" || $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id)->type_of_cooperative == "Cooperative Bank"){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                  if(!isset($_POST['bylawsPrimaryBtn'])){
                    $data['title'] = 'By Laws';
                    $data['header'] = 'By Laws';
                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                    $data['encrypted_id'] = $id;
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_info'] = $this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id);
                    $data['reg_qualifications'] ='';
                    $data['add_membership'] ='';
                    $data['add_members_vote']='';
                    $data['asc_qualifications'] ='';
                    $data['delegate_powers'] ='';
                    $data['primary_consideration'] ='';


                    if($data['bylaw_info']!=null)
                    {
                      $data['reg_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                      $data['add_membership'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                      $data['add_members_vote'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->additional_conditions_to_vote);
                      $data['asc_qualifications'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                      $data['delegate_powers'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers);
                      $data['primary_consideration'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration);
                    }

                    if(isset($this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers)){
                      $data['delegate_power'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers);
                    }
                    
                    if(isset($this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration)){
                      $data['primary_consideration'] =  explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration);
                    }
                    if(isset($this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications)){
                      $data['reg_qualifications'] = explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                    }
                    if(isset($this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications)){
                      $data['asc_qualifications'] = explode(";",$this->bylaw_update_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                    }

                    $this->load->view('templates/admin_header', $data);
                    $this->load->view('update/bylaw_federation_form', $data);
                    $this->load->view('templates/admin_footer');
                  } else {
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    if($this->input->post('additionaldelegatePowers')){
                      $regQualificationsLength = sizeof($this->input->post('additionaldelegatePowers'));
                      $additionaldelegatePowers = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionaldelegatePowers .=  $this->input->post('additionaldelegatePowers')[$i].';';
                        }
                      $additionaldelegatePowers = substr_replace($additionaldelegatePowers, "", -1);
                    }
                    if($this->input->post('additionalPrimaryConsideration')){
                      $regQualificationsLength = sizeof($this->input->post('additionalPrimaryConsideration'));
                      $additionalPrimaryConsideration = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalPrimaryConsideration .=  $this->input->post('additionalPrimaryConsideration')[$i].';';
                        }
                      $additionalPrimaryConsideration = substr_replace($additionalPrimaryConsideration, "", -1);
                    }
                    if($this->input->post('additionalConditionsForVoting')){
                      $regQualificationsLength = sizeof($this->input->post('additionalConditionsForVoting'));
                      $additionalConditionsForVoting = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalConditionsForVoting .=  $this->input->post('additionalConditionsForVoting')[$i].';';
                        }
                      $additionalConditionsForVoting = substr_replace($additionalConditionsForVoting, "", -1);
                    }
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                      $ascQualicationsTemp = '';
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    $now = date('m/d/Y H:i:s');
                    $expire = date('Y-m-d H:i:s',strtotime('+30 days',strtotime($now)));

                    if($data['bylaw_info']->regular_percentage_shares_subscription == NULL){
                      $field_data = array(
                        'expire_at' => $expire,
                      );
                      if($this->cooperatives_model->update_expire_at($user_id,$decoded_id,$field_data)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        // redirect('cooperatives/'.$this->input->post('cooperativeID'));
                      }
                    }

                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
                      'regular_qualifications' => $regQualicationsTemp,
                      'associate_qualifications' => $ascQualicationsTemp,                     
                      'membership_fee' =>$membership_fee,
                      'primary_consideration' =>$additionalPrimaryConsideration,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
                      'additional_conditions_to_vote' => $additionalConditionsForVoting,
                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      'delegate_powers'=> $additionaldelegatePowers,
                      'composition_of_bod'=> $this->input->post('compositionoftheboard'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'annual_regular_meeting_day_date'=> $this->input->post('regularMeetingDayDate'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('regularMeetingDayVenue'),
                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'member_invest_per_month'=> $investPerMonth,
                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
                      'member_percentage_service'=> $this->input->post('investService'),
                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
                      'percent_education_fund'=> $this->input->post('educationFund'),
                      'percent_community_fund'=> $this->input->post('communityFund'),
                      'percent_optional_fund'=> $this->input->post('othersFund'),
                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    if($this->bylaw_update_model->update_bylaw_primary($bylaw_coop_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_federation');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$this->input->post('bylaw_coop_id').'/bylaws_federation');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the bylaws of the cooperative are not avaiable because it is not yet submitted for evaluation.');
                  redirect('cooperatives_update');
                }
              }else{
                redirect('cooperatives_update/'.$id.'/bylaws');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives_update');
            }
          }
        }
      }else{
        // show_404();
      }
    }
  }

  function union($id  = null)
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
              if($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->grouping == "Union"){
                if(!isset($_POST['bylawsUnionBtn'])){
                  $data['title'] = 'By Laws';
                  $data['header'] = 'By Laws';
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['encrypted_id'] = $id;
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                  $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                  if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership)){
                    $data['add_membership'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                  }
                  if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers)){
                    $data['delegate_power'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers);
                  }
                  if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration)){
                    $data['primary_consideration'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration);
                  }
                  if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications)){
                    $data['reg_qualifications'] = explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                  }
                  if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications)){
                    $data['asc_qualifications'] = explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                  }
                  
                  $this->load->view('template/header', $data);
                  $this->load->view('update/bylaw_union_form.php', $data);
                  $this->load->view('template/footer');
                }else{
                  // if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                      $ascQualicationsTemp = '';
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));
                    
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    
                    if($this->input->post('additionaldelegatePowers')){
                      $regQualificationsLength = sizeof($this->input->post('additionaldelegatePowers'));
                      $additionaldelegatePowers = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionaldelegatePowers .=  $this->input->post('additionaldelegatePowers')[$i].';';
                        }
                      $additionaldelegatePowers = substr_replace($additionaldelegatePowers, "", -1);
                    }
                    
                    if($this->input->post('additionalPrimaryConsideration')){
                      $regQualificationsLength = sizeof($this->input->post('additionalPrimaryConsideration'));
                      $primaryConsideration = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $primaryConsideration .=  $this->input->post('additionalPrimaryConsideration')[$i].';';
                        }
                      $primaryConsideration = substr_replace($primaryConsideration, "", -1);
                    }
                    
                    $membershipFee=str_replace(',','',$this->input->post('membershipFee'));
                    
                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'membership_fee' =>$membershipFee,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'directors_term'=> $this->input->post('directorsTerm'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
//                      'regular_qualifications' => $regQualicationsTemp,
//                      'associate_qualifications' => $ascQualicationsTemp,
//                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
//                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
//                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
//                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
//                      'additional_conditions_to_vote' => $this->input->post('additionalConditionsForVoting'),
//                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      'delegate_powers'=> $additionaldelegatePowers,
                      'primary_consideration'=> $primaryConsideration,
//                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
//                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
//                      'member_invest_per_month'=> $investPerMonth,
//                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
//                      'member_percentage_service'=> $this->input->post('investService'),
//                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
//                      'percent_education_fund'=> $this->input->post('educationFund'),
//                      'percent_community_fund'=> $this->input->post('communityFund'),
//                      'percent_optional_fund'=> $this->input->post('othersFund'),
//                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
//                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    if($this->bylaw_update_model->update_bylaw_primary($decoded_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$id.'/bylaws_union');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$id.'/bylaws_union');
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                  //   redirect('cooperatives/'.$id);
                  // }
                }
              }else{
                redirect('cooperatives_update/'.$id.'/bylaws');
              }
            }else{
              redirect('cooperatives_update/'.$id);
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives_update');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            // if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              // if($this->cooperatives_model->get_cooperative_info($user_id,$decoded_id)->grouping == "Union"){
                // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if(!isset($_POST['bylawsUnionBtn'])){
                    $data['title'] = 'By Laws';
                    $data['header'] = 'By Laws';
                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                    $data['encrypted_id'] = $id;
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership)){
                      $data['add_membership'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->additional_requirements_for_membership);
                    }
                    if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers)){
                      $data['delegate_power'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->delegate_powers);
                    }
                    if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration)){
                      $data['primary_consideration'] =  explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->primary_consideration);
                    }
                    if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications)){
                      $data['reg_qualifications'] = explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->regular_qualifications);
                    }
                    if(isset($this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications)){
                      $data['asc_qualifications'] = explode(";",$this->bylaw_model->get_bylaw_by_coop_id($decoded_id)->associate_qualifications);
                    }
                    $this->load->view('templates/admin_header', $data);
                    $this->load->view('update/bylaw_union_form.php', $data);
                    $this->load->view('templates/admin_footer');
                  }else{
                    // if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));
                    if($this->input->post('regularQualifications')){
                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                      $regQualicationsTemp = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                        }
                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    }
                    if($this->input->post('associateQualifications')){
                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                      $ascQualicationsTemp = '';
                      for($i = 0; $i< $ascQualificationsLength;$i++){
                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                      }
                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));
                    
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    
                    if($this->input->post('additionaldelegatePowers')){
                      $regQualificationsLength = sizeof($this->input->post('additionaldelegatePowers'));
                      $additionaldelegatePowers = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionaldelegatePowers .=  $this->input->post('additionaldelegatePowers')[$i].';';
                        }
                      $additionaldelegatePowers = substr_replace($additionaldelegatePowers, "", -1);
                    }
                    
                    if($this->input->post('additionalPrimaryConsideration')){
                      $regQualificationsLength = sizeof($this->input->post('additionalPrimaryConsideration'));
                      $primaryConsideration = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $primaryConsideration .=  $this->input->post('additionalPrimaryConsideration')[$i].';';
                        }
                      $primaryConsideration = substr_replace($primaryConsideration, "", -1);
                    }
                    
                    $membershipFee=str_replace(',','',$this->input->post('membershipFee'));
                    
                    $data = array(
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'membership_fee' =>$membershipFee,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'directors_term'=> $this->input->post('directorsTerm'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
//                      'regular_qualifications' => $regQualicationsTemp,
//                      'associate_qualifications' => $ascQualicationsTemp,
//                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
//                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
//                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
//                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
//                      'additional_conditions_to_vote' => $this->input->post('additionalConditionsForVoting'),
//                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                      'delegate_powers'=> $additionaldelegatePowers,
                      'primary_consideration'=> $primaryConsideration,
//                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),
//                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),
//                      'member_invest_per_month'=> $investPerMonth,
//                      'member_percentage_annual_interest'=> $this->input->post('investAnnualInterest'),
//                      'member_percentage_service'=> $this->input->post('investService'),
//                      'percent_reserve_fund'=> $this->input->post('reserveFund'),
//                      'percent_education_fund'=> $this->input->post('educationFund'),
//                      'percent_community_fund'=> $this->input->post('communityFund'),
//                      'percent_optional_fund'=> $this->input->post('othersFund'),
//                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),
//                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'),
                    );
                    if($this->bylaw_update_model->update_bylaw_primary($decoded_id,$data)){
                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                      redirect('cooperatives_update/'.$id.'/bylaws_union');
                    }else{
                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                      redirect('cooperatives_update/'.$id.'/bylaws_union');
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                  //   redirect('cooperatives/'.$id);
                  // }
                  }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the bylaws of the cooperative are not avaiable because it is not yet submitted for evaluation.');
                //   redirect('cooperatives_update');
                // }
              // }else{
              //   redirect('cooperatives/'.$id.'/bylaws');
              // }
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
            //   redirect('cooperatives_update');
            // }
          }
        }
      }else{
        show_404();
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
  public function check_minimum_regular_subscription(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'coop_id'=>$this->input->get('cooperativesID')
        );
//        $result = $this->bylaw_model->check_minimum_regular_subscription($data);
        $result = $this->capitalization_model->check_minimum_regular_subscription($data);
        echo json_encode($result);
      }else{
        show_404();
      }
    }
  }
  public function check_minimum_regular_subscription2(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'coop_id'=>$this->input->get('cooperativesID')
        );
//        $result = $this->bylaw_model->check_minimum_regular_subscription($data);
        $result = $this->capitalization_model->check_minimum_regular_subscription2($data);
        echo json_encode($result);
      }else{
        show_404();
      }
    }
  }
  public function check_minimum_regular_pay_amendment(){
    if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
      $data = array(
        'fieldId'=>$this->input->get('fieldId'),
        'fieldValue'=>$this->input->get('fieldValue'),
        'coop_id'=>$this->input->get('cooperativesID')
      );
      $result = $this->bylaw_model->check_minimum_regular_pay_amendment($data);
      echo json_encode($result);
    }else{
      show_404();
    }
  }
  public function check_minimum_regular_pay(){
    if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
      $data = array(
        'fieldId'=>$this->input->get('fieldId'),
        'fieldValue'=>$this->input->get('fieldValue'),
        'coop_id'=>$this->input->get('cooperativesID')
      );
//      $result = $this->bylaw_model->check_minimum_regular_pay($data);
      $result = $this->capitalization_model->check_minimum_regular_pay($data);
      echo json_encode($result);
    }else{
      show_404();
    }
  }
  public function check_minimum_associate_subscription(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'coop_id'=>$this->input->get('cooperativesID')
        );
//        $result = $this->bylaw_model->check_minimum_associate_subscription($data);
        $result = $this->capitalization_model->check_minimum_associate_subscription($data);
        echo json_encode($result);
      }else{
        show_404();
      }
    } 
  }  
  public function check_minimum_associate_subscription_amendment(){
    // if(!$this->session->userdata('logged_in')){
    //   redirect('users/login');
    // }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('amd_id')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'amendment_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('amd_id'))),
        );
        $result = $this->amendment_capitalization_model->check_minimum_associate_subscription($data);
        echo json_encode($result);
      }else{
        // echo'show_404()';
        echo"Ajax error";
      }
    // }
  }
  public function check_minimum_associate_pay(){
    if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
      $data = array(
        'fieldId'=>$this->input->get('fieldId'),
        'fieldValue'=>$this->input->get('fieldValue'),
        'coop_id'=>$this->input->get('cooperativesID')
      );
//      $result = $this->bylaw_model->check_minimum_associate_pay($data);
      $result = $this->capitalization_model->check_minimum_associate_pay($data);
      echo json_encode($result);
    }else{
      show_404();
    }
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
