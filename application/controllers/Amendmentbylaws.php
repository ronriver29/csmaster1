<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendmentbylaws extends CI_Controller{

  public $decoded_id = null;

  public function __construct()

  {

    parent::__construct();

    //Codeigniter : Write Less Do More
    $this->load->library('auth');
    $this->auth->checkLogin();
    $this->load->model('amendment_capitalization_model');
    $this->load->model('amendment_model');
    $this->load->model('user_model');
    $this->load->model('amendment_bylaw_model');
  }



  function index($id  = null)
  {
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
              $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
              $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
              $coop = $this->amendment_model->qryColumn('grouping',$this->decoded_id);

              if($coop->grouping =="Federation"){
              redirect('amendment/'.$id.'/bylaws_federation');
              }else if($coop->grouping =="Union"){
              redirect('amendment/'.$id.'/bylaws_union');
              // redirect('amendment/'.$id.'/bylaw_update_union');
              }else{
              redirect('amendment/'.$id.'/bylaw_primary');
              }
        }else{
          $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
          $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
          $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
          $coop = $this->amendment_model->qryColumn('grouping',$this->decoded_id);
          if($coop->grouping =="Federation"){
          redirect('amendment/'.$id.'/bylaws_federation');
          }else if($coop->grouping =="Union"){
          redirect('amendment/'.$id.'/bylaws_union');
          }else{
          redirect('amendment/'.$id.'/bylaws_primary');
          }
        }
      }else{
        show_404();
      }
  }



  function union($id  = null)

  {

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $user_id = $this->session->userdata('user_id');

      $data['is_client'] = $this->session->userdata('client');

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){

          // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

          //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
             
              if($this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id)->grouping =="Union"){

                if(!isset($_POST['bylawsUnionBtn'])){

                  $data['title'] = 'By Laws';

                  $data['header'] = 'By Laws';

                  $data['client_info'] = $this->user_model->get_user_info($user_id);

                  $data['encrypted_id'] = $id;

                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                  $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                  $data['reg_qualifications'] ='';
                  $data['delegate_powers'] ='';
                  $data['add_membership']='';
                  $data['primary_consideration'] ='';
                  if($data['bylaw_info']!=null)

                  {

                    $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);
                    $data['delegate_powers'] =  explode(";",$data['bylaw_info']->delegate_powers);                      
                    $data['add_membership'] =  explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                    $data['primary_consideration'] =explode(";",$data['bylaw_info']->primary_consideration);
                  }
                  // $this->debug($data['bylaw_info']);
                  $this->load->view('template/header', $data);
                  $this->load->view('amendment/bylaw_info/bylaw_union_form.php', $data);
                  $this->load->view('template/footer');

                }else{
                
                    //  if($this->input->post('regularQualifications')){
                    //   $regQualificationsLength = sizeof($this->input->post('regularQualifications'));
                    //   $regQualicationsTemp = '';
                    //   for($i = 0; $i< $regQualificationsLength;$i++){
                    //     $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';
                    //     }
                    //   $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);
                    // }
                    // if($this->input->post('associateQualifications')){
                    //   $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));
                    //   $ascQualicationsTemp = '';
                    //   for($i = 0; $i< $ascQualificationsLength;$i++){
                    //       $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';
                    //   }
                    //   $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                    // }

                    $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                    // $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));
                    // var_dump($this->input->post('additionalRequirementsForMembership'));
                    if($this->input->post('additionalRequirementsForMembership')){
                      $regQualificationsLength = sizeof($this->input->post('additionalRequirementsForMembership'));
                      $additionalRequirementsForMembership = '';
                      for($i = 0; $i< $regQualificationsLength;$i++){
                        $additionalRequirementsForMembership .=  $this->input->post('additionalRequirementsForMembership')[$i].';';
                        }
                      $additionalRequirementsForMembership = substr_replace($additionalRequirementsForMembership, "", -1);
                    }
                    // var_dump( $additionalRequirementsForMembership);
                    $additionaldelegatePowers='';
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
                      'amendment_id'=>$this->decoded_id,
                      'kinds_of_members' => $this->input->post('kindsOfMember'),
                      'membership_fee' =>$membershipFee,
                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),
                      'director_hold_term'=> $this->input->post('termHoldDirector'),
                      'director_term'=> $this->input->post('directorsTerm'),
                      'additional_requirements_for_membership' => $additionalRequirementsForMembership,
                      'delegate_powers'=> $additionaldelegatePowers,
                      'primary_consideration'=>  $primaryConsideration,

                    );
                 
                    if($this->amendment_bylaw_model->update_bylaw_primary($this->decoded_id,$data)){

                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');

                       redirect('amendment/'.$id.'/bylaws_union');

                    }else{

                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');

                       redirect('amendment/'.$id.'/bylaws_union');

                    }

                }

              }else{

                redirect('amendment/'.$id.'/bylaws');

              }
        }else{
            $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
            $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
            $this->amendment_model->get_cooperative_info_by_admin_($this->decoded_id);
            $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
            $data['title'] = 'By Laws';
            $data['header'] = 'By Laws';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $data['encrypted_id'] = $id;
            $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
            $data['reg_qualifications'] ='';
            $data['asc_qualifications']='';
            if($data['bylaw_info']!=null)
            {
            $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);
            $data['asc_qualifications'] =  explode(";",$data['bylaw_info']->associate_qualifications);
            }
            $this->load->view('template/header', $data);
            $this->load->view('amendment/bylaw_info/bylaw_union_form.php', $data);
            $this->load->view('template/footer');
        }
      }else{

        show_404();

      }

  }



   function federation($id  = null)

  {

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

      $user_id = $this->session->userdata('user_id');

      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);

      $data['is_client'] = $this->session->userdata('client');

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){ 

          // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            // $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
            // if(!$this->amendment_update_model->check_expired_reservation($this->decoded_id,$user_id)){

              // if($this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id)->grouping =="Federation"){

                if(!isset($_POST['bylawsPrimaryBtn'])){

                  $data['title'] = 'By Laws';

                  $data['header'] = 'By Laws';

                  $data['client_info'] = $this->user_model->get_user_info($user_id);

                  $data['encrypted_id'] = $id;

                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                  $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                  $data['reg_qualifications']='';

                  $data['asc_qualifications']='';

                  $data['primary_consideration']='';

                  $data['delegate_powers'] ='';

                  $data['add_membership'] ='';

                  $data['add_members_vote']='';

                  if($data['bylaw_info']!=null)

                  {

                  $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);

                  $data['asc_qualifications'] =  explode(";",$data['bylaw_info']->associate_qualifications);

                  $data['primary_consideration'] =  explode(";",$data['bylaw_info']->primary_consideration);

                  $data['delegate_powers'] =  explode(";",$data['bylaw_info']->delegate_powers);

                  $data['add_membership'] =  explode(";",$data['bylaw_info']->additional_requirements_for_membership);

                  $data['add_members_vote'] =  explode(";",$data['bylaw_info']->additional_conditions_to_vote);

                  }



                // var_dump($data['delegate_powers'])



                    $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);

                  $this->load->view('template/header', $data);

                  $this->load->view('amendment/bylaw_info/bylaw_federation_form', $data);

                  $this->load->view('template/footer');

                }else{

                  // if(!$this->amendment_update_model->check_submitted_for_evaluation($this->decoded_id)){

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



                     $membership_fee ='';

                    if(strlen($this->input->post('membershipFee'))>0)

                    {

                       $membership_fee=str_replace(',','',$this->input->post('membershipFee'));

                    }

                   

                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    $delegate_powers = implode(';',$this->input->post('additionaldelegatePowers'));

                     $primary_consideration = implode(';',$this->input->post('additionalPrimaryConsideration'));

                    $data = array(

                      'kinds_of_members' => $this->input->post('kindsOfMember'),

                      'additional_requirements_for_membership' => (!empty($this->input->post('additionalRequirementsForMembership')) ? implode(';',$this->input->post('additionalRequirementsForMembership')) : ''),

                      'regular_qualifications' => $regQualicationsTemp,

                      'associate_qualifications' => $ascQualicationsTemp,

                      'membership_fee' => $membership_fee,

                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),

                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),

                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),

                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),

                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),

                      'additional_conditions_to_vote' =>  (!empty($this->input->post('additionalConditionsForVoting')) ? implode(';',$this->input->post('additionalConditionsForVoting')) : '') ,

                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),

                      'delegate_powers'=> $delegate_powers,

                      'primary_consideration'=>$primary_consideration,

                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),

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

                      'composition_of_bod'=>$this->input->post('compositionoftheboard')

                    );

                    unset($regQualicationsTemp);

                    unset($ascQualicationsTemp);


                    if($this->amendment_bylaw_model->update_bylaw_primary($this->decoded_id,$data)){
                    $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                    redirect('amendment/'.$id.'/bylaws_federation');
                    }else{
                    $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                    redirect('amendment/'.$id.'/bylaws_federation');
                    }

                }

              // }else{

              //   redirect('amendment/'.$id);

              // }



          // }else{

          //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

          //   redirect('amendment/'.$this->decoded_id);

          // }

        }else{
 

            // if(!$this->amendment_update_model->check_expired_reservation_by_admin($this->decoded_id)){
              $this->load->model("admin_model");
              $this->load->model('region_model');
              $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
              $data['coop_info']=$this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                  // $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$this->decoded_id);

                  if(!isset($_POST['bylawsPrimaryBtn'])){

                    $data['title'] = 'By Laws';

                    $data['header'] = 'By Laws';

                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                    $data['encrypted_id'] = $id;

                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                    $data['reg_qualifications']='';

                    $data['asc_qualifications']='';

                    $data['primary_consideration']='';

                    $data['delegate_powers'] ='';

                    $data['add_membership'] ='';

                    $data['add_members_vote']='';

                    if($data['bylaw_info']!=null)

                    {

                    $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);

                    $data['asc_qualifications'] =  explode(";",$data['bylaw_info']->associate_qualifications);

                      $data['primary_consideration'] =  explode(";",$data['bylaw_info']->primary_consideration);

                    $data['delegate_powers'] =  explode(";",$data['bylaw_info']->delegate_powers);

                    $data['add_membership'] =  explode(",",$data['bylaw_info']->additional_requirements_for_membership);

                    $data['add_members_vote'] =  explode(";",$data['bylaw_info']->additional_conditions_to_vote);

                    }

                  

                     $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['coop_info']->regNo);

                    $this->load->view('templates/admin_header', $data);

                   $this->load->view('amendment/bylaw_info/bylaw_federation_form', $data);

                    $this->load->view('templates/admin_footer');

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

                    if($this->input->post('associateQualifications')){

                      $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));

                      $ascQualicationsTemp = '';

                      for($i = 0; $i< $ascQualificationsLength;$i++){

                          $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';

                      }

                      $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                      unset($i);
                    }



                     $membership_fee ='';

                    if(strlen($this->input->post('membershipFee'))>0)

                    {

                       $membership_fee=str_replace(',','',$this->input->post('membershipFee'));

                    }

                   

                    $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));

                    $delegate_powers = implode(';',$this->input->post('additionaldelegatePowers'));

                    $primary_consideration = implode(';',$this->input->post('additionalPrimaryConsideration'));

                    $data = array(

                      'kinds_of_members' => $this->input->post('kindsOfMember'),

                      'additional_requirements_for_membership' => (!empty($this->input->post('additionalRequirementsForMembership')) ? implode(';',$this->input->post('additionalRequirementsForMembership')) : ''),

                      'regular_qualifications' => $regQualicationsTemp,

                      'associate_qualifications' => $ascQualicationsTemp,

                      'membership_fee' => $membership_fee,

                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),

                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),

                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),

                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),

                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),

                      'additional_conditions_to_vote' =>  (!empty($this->input->post('additionalConditionsForVoting')) ? implode(',',$this->input->post('additionalConditionsForVoting')) : '') ,

                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),

                      'delegate_powers'=> $delegate_powers,

                      'primary_consideration' =>$primary_consideration,

                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),

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

                      'composition_of_bod'=>$this->input->post('compositionoftheboard')

                    );

                     unset($regQualicationsTemp);

                     unset($ascQualicationsTemp);

                    if($this->amendment_update_bylaw_model->update_bylaw_primary($this->decoded_id,$data)){

                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');

                      redirect('amendment/'.$id.'/bylaws_federation');

                    }else{

                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');

                      redirect('amendment/'.$id.'/bylaws_federation');

                    }
                  }  
        }

      }else{

        show_404();

      }

    }

  

  function primary($id  = null)

  {


      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

       $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);

      $user_id = $this->session->userdata('user_id');

      $data['is_client'] = $this->session->userdata('client');

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){

          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){

              if($this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id)->category_of_cooperative =="Primary"){

                   

                if($this->form_validation->run() == FALSE){

                  $data['title'] = 'By Laws';

                  $data['header'] = 'By Laws';

                  $data['client_info'] = $this->user_model->get_user_info($user_id);

                  $data['encrypted_id'] = $id;

                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                  $data['bylaw_info'] =$this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                  $data['reg_qualifications']='';

                  $data['asc_qualifications']='';

                  $data['delegate_powers'] ='';

                  $data['add_membership'] ='';

                  $data['add_members_vote']='';

                  if($data['bylaw_info']!=null)

                  {

                    $data['add_membership'] =  explode(";",$data['bylaw_info']->additional_requirements_for_membership);

                    $data['add_members_vote'] =  explode(";",$data['bylaw_info']->additional_conditions_to_vote);

                    $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);

                    $data['asc_qualifications'] =  explode(";",$data['bylaw_info']->associate_qualifications);

                  }
   
      
                  $this->load->view('template/header', $data);

                  $this->load->view('amendment/bylaw_info/bylaw_primary_form.php', $data);

                  $this->load->view('template/footer');

                } else {

                  if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){

                    $bylaw_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('bylaw_coop_id')));

                    if($this->input->post('regularQualifications')){

                      $regQualificationsLength = sizeof($this->input->post('regularQualifications'));

                      $regQualicationsTemp = '';

                      for($i = 0; $i< $regQualificationsLength;$i++){

                        $regQualicationsTemp .=  $this->input->post('regularQualifications')[$i].';';

                        }

                      $regQualicationsTemp = substr_replace($regQualicationsTemp, "", -1);

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

                    $additional_requirements_for_membership_ = implode(";",$this->input->post('additionalRequirementsForMembership'));

                    $additionalConditionsForVoting_ =implode(";",$this->input->post('additionalConditionsForVoting'));

                    //  $investAnnualInterest=N;

                    // if($_POST["$this->input->post('investAnnualInterest')"])

                    // {

                      $investAnnualInterest=$this->input->post('investAnnualInterest');

                    // }

                    $data = array(

                      'kinds_of_members' => $this->input->post('kindsOfMember'),

                      'additional_requirements_for_membership' => $additional_requirements_for_membership_,//$additionalRequirementsForMembership,

                      'regular_qualifications' => $regQualicationsTemp,

                      'associate_qualifications' => $ascQualicationsTemp,                     

                      'membership_fee' =>$membership_fee,

                      'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),

                      'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),

                      'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),

                      'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),

                      'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),

                      'additional_conditions_to_vote' =>$additionalConditionsForVoting_,// $additionalConditionsForVoting,

                      'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),

                      // 'delegate_powers'=> $this->input->post('delegatePowers'),

                      'members_percent_quorom'=> $this->input->post('quorumPercentage'),

                      // 'annual_regular_meeting_day_date'=> $this->input->post('Annaul_date_venue'),

                      // 'annual_regular_meeting_day_venue'=> $this->input->post('Annaul_ga_venue'),

                      'number_of_absences_disqualification'=> $this->input->post('consecutiveAbsences'),

                      'percent_of_absences_all_meettings'=> $this->input->post('consecutivePercentageAbsences'),

                      'director_hold_term'=> $this->input->post('termHoldDirector'),

                      'member_invest_per_month'=> $investPerMonth,

                      'member_percentage_annual_interest'=>   $investAnnualInterest,

                      'member_percentage_service'=> $this->input->post('investService'),

                      'percent_reserve_fund'=> $this->input->post('reserveFund'),

                      'percent_education_fund'=> $this->input->post('educationFund'),

                      'percent_community_fund'=> $this->input->post('communityFund'),

                      'percent_optional_fund'=> $this->input->post('othersFund'),

                      'non_member_patron_years'=> $this->input->post('nonMemberPatronYears'),

                      'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith'), 

                      // 'type' => $this->input->post('type')

                    );

                    

                    // $this->debug($data);

                    if($this->amendment_bylaw_model->update_bylaw_primary($bylaw_coop_id,$data)){

                      $this->session->set_flashdata('bylaw_success', 'Successfully Updated');

                      redirect('amendment/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');

                    }else{

                      $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');

                      redirect('amendment/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');

                    }

                  }else{

                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');

                    redirect('amendment/'.$id);

                  }

                }

              }else{

                redirect('amendment/'.$id.'/bylaws');

              }

            }else{

              redirect('amendment/'.$id);

            }

          }else{

            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

            redirect('amendment');

          }

        }else{

            $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
              $this->load->model('admin_model');
              $this->load->model('region_model');
            if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){

              if($this->amendment_model->get_cooperative_info_by_admin($this->decoded_id)->category_of_cooperative =="Primary"){

                if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){

                  if($this->form_validation->run() == FALSE){

                    $data['title'] = 'By Laws';

                    $data['header'] = 'By Laws';

                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                    $data['encrypted_id'] = $id;

                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                    $data['bylaw_info'] =$this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                    $data['reg_qualifications']='';

                    $data['asc_qualifications']='';

                    $data['add_membership'] ='';

                    $data['add_members_vote']='';

                    if($data['bylaw_info']!=null)

                    {

                    $data['add_membership'] =  explode(";",$data['bylaw_info']->additional_requirements_for_membership);

                    $data['add_members_vote'] =  explode(";",$data['bylaw_info']->additional_conditions_to_vote);

                    $data['reg_qualifications'] =  explode(";",$data['bylaw_info']->regular_qualifications);

                    $data['asc_qualifications'] =  explode(";",$data['bylaw_info']->associate_qualifications);

                    }

                    

                    $this->load->view('templates/admin_header', $data);

                    $this->load->view('amendment/bylaw_info/bylaw_primary_form.php', $data);

                    $this->load->view('templates/admin_footer');

                  }else{

                    if($this->amendment_model->check_first_evaluated($this->decoded_id)){

                      $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');

                      redirect('amendment');

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

                      if($this->input->post('associateQualifications')){

                        $ascQualificationsLength = sizeof($this->input->post('associateQualifications'));

                        $ascQualicationsTemp = '';

                        for($i = 0; $i< $ascQualificationsLength;$i++){

                            $ascQualicationsTemp .=  $this->input->post('associateQualifications')[$i].';';

                        }

                        $ascQualicationsTemp = substr_replace($ascQualicationsTemp, "", -1);
                        unset($i);
                      }



                        $membership_fee=str_replace(',','',$this->input->post('membershipFee'));
                        $investPerMonth=str_replace(',','',$this->input->post('investPerMonth'));



                        $data = array(
                        'kinds_of_members' => $this->input->post('kindsOfMember'),
                        'additional_requirements_for_membership' => $this->input->post('additionalRequirementsForMembership'),
                        'regular_qualifications' => $regQualicationsTemp,
                        'associate_qualifications' => $ascQualicationsTemp,
                        'membership_fee' =>$membershipFee,
                        'act_upon_membership_days'=> $this->input->post('actUponMembershipDays'),
                        'regular_percentage_shares_subscription' => $this->input->post('regularMembershipPercentageSubscription'),
                        'regular_percentage_shares_pay' => $this->input->post('regularMembershipPercentagePay'),
                        'associate_percentage_shares_subscription'=> $this->input->post('associateMembershipPercentageSubscription'),
                        'associate_percentage_shares_pay'=> $this->input->post('associateMembershipPercentagePay'),
                        'additional_conditions_to_vote' => $this->input->post('additionalConditionsForVoting'),
                        'annual_regular_meeting_day'=> $this->input->post('regularMeetingDay'),
                        'annual_regular_meeting_day_date'=> $this->input->post('regularMeetingDayDate'),
                        'annual_regular_meeting_day_venue'=> $this->input->post('regularMeetingDayVenue'),
                        // 'delegate_powers'=> $this->input->post('delegatePowers'),
                        'members_percent_quorom'=> $this->input->post('quorumPercentage'),
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
                        'amendment_votes_members_with'=> $this->input->post('amendmentMembersWith')
                        );

                        if($this->bylaw_model->update_bylaw_primary($bylaw_coop_id,$data)){
                        $this->session->set_flashdata('bylaw_success', 'Successfully Updated');
                        redirect('amendment/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                        }else{
                        $this->session->set_flashdata('bylaw_error', 'Unable to update bylaws');
                        redirect('amendment/'.$this->input->post('bylaw_coop_id').'/bylaws_primary');
                        }

                    }

                  }

                }else{

                  $this->session->set_flashdata('redirect_applications_message', 'Viewing and editing the bylaws of the cooperative are not avaiable because it is not yet submitted for evaluation.');

                  redirect('amendment');

                }

              }else{

                redirect('amendment/'.$id.'/bylaws');

              }

            }else{

              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');

              redirect('amendment');

            }

          // }

        }

      }else{

        show_404();

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

        $result = $this->bylaw_model->check_minimum_regular_subscription($data);

        echo json_encode($result);

      }else{

        show_404();

      }

    }

  }

  public function check_minimum_regular_pay(){

    if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('amd_id')){

      $data = array(

        'fieldId'=>$this->input->get('fieldId'),

        'fieldValue'=>$this->input->get('fieldValue'),

        'amendment_id'=>$this->input->get('amd_id')

      );

      $result = $this->amendment_capitalization_model->check_minimum_regular_pay($data);

      echo json_encode($result);

    }else{

      show_404();

    }

  }

  public function check_minimum_associate_subscription(){

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{

      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('amd_id')){

        $data = array(

          'fieldId'=>$this->input->get('fieldId'),

          'fieldValue'=>$this->input->get('fieldValue'),

          'amendment_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('amd_id'))),

          'cooperative_id' => $this->encryption->decrypt(decrypt_custom($this->input->get('cooperative_id')))

        );

        $result = $this->amendment_capitalization_model->check_minimum_associate_subscription($data);

        echo json_encode($result);

      }else{

        // echo'show_404()';

        echo"Ajax error";

      }

    }

  }

  //paid up share associate

  public function check_minimum_associate_pay_amendment(){

    // if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') &&  $this->input->get('cooperative_id') &&  $this->input->get('amd_id')){

    if($this->input->get('fieldId') && $this->input->get('fieldValue')  &&  $this->input->get('cooperative_id') &&  $this->input->get('amd_id')){

      $data = array(

        'fieldId'=>$this->input->get('fieldId'),

        'fieldValue'=>$this->input->get('fieldValue'),

        'cooperative_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperative_id'))),

        'amendment_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('amd_id'))),

        // 'cooperatorID'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperatorID')))

      );

      $result = $this->amendment_capitalization_model->check_minimum_associate_pay($data);

      echo json_encode($result);

    }else{

      // show_404();

      echo"Ajax error";

    }

  }





   public function debug($array)

    {

        echo"<pre>";

        print_r($array);

        echo"</pre>";



    }



    public function check_minimum_regular_subscription_amendment(){

      // echo"success";

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{

     $coop_id= $this->input->get('cooperative_id');

       $amendment_id= $this->input->get('amd_id');

      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperative_id') && $this->input->get('amd_id')){

        $data = array(

          'fieldId'=>$this->input->get('fieldId'),

          'fieldValue'=>$this->input->get('fieldValue'),

          'coop_id'=>$coop_id,

          'amendment_id'=>$amendment_id

        );

        $result = $this->amendment_capitalization_model->check_minimum_regular_subscription($data);

        echo json_encode($result);

      }else{

        show_404();

      }

    }

  }

}

