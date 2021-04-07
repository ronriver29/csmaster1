<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cooperatives extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
    }

    public function saveor($was){
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('dateofOR'),
        'status' =>1
      );
        $date_of_or = $this->input->post('dateofOR');

      $this->cooperatives_model->save_OR(array('id' => $this->input->post('payment_id')), $data, $this->input->post('tae'),$date_of_or);
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
          $data['header'] = 'Cooperatives';
          // print_r($data['client_info']);
          // echo $data['client_info']->regno;
          if($data['client_info']->regno == NULL){
            $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
          } else {
            $data['list_cooperatives'] = $this->cooperatives_model->get_registeredcoop($data['client_info']->regno);
          }
          
//          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
          $data['count_cooperatives'] = $this->cooperatives_model->get_count_cooperatives($this->session->userdata('user_id'));
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
          // if(!empty($data['coop_info']->id)){
          //     if($data['coop_info']->status != 15){
          //       if(date('Y-m-d H:i:s',strtotime($data['coop_info']->expire_at)) < date('Y-m-d H:i:s')){
          //         // echo '<script>alert("Your Reserved Cooperative Name has Expired. Reserved Name now will be deleted.");</script>';
          //         $success = $this->cooperatives_model->delete_cooperative($data['coop_info']->id,$data['coop_info']->status,$user_id);
          //         if($success){
          //           $this->session->set_flashdata('list_success_message', 'Reserved Cooperative Name has Expired.');
          //           redirect('cooperatives');
          //         }
          //       }
          //     }
          // }
          if(isset($_POST['tos']))
          {
            $data['tos'] = $_POST['tos'];
          }
          $this->load->view('template/header', $data);
          if($data['client_info']->regno == NULL){
            $this->load->view('applications/list_of_applications', $data);
          } else {
            $this->load->view('applications/list_of_registeredcoop', $data);
          }
          $this->load->view('cooperative/delete_modal_cooperative');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Cooperatives';
            $data['header'] = 'Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          
            // $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($data['coop_info']->id);
            // $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($data['coop_info']->id);
            // $data['cooperatives_comments'] = $this->cooperatives_model->cooperatives_comments($data['coop_info']->id);
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="00"){
              // Registered Coop Process by Head Office
                $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
              // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
              // echo '<pre>';
              // echo count($data['list_cooperatives']);
              // echo $data['list_cooperatives'][0]['status'];
              // print_r($data['list_cooperatives']);
              // echo '</pre>';
            }else{
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_director($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
              }
            }
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_applications', $data);
            $this->load->view('applications/assign_admin_modal');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }
        }
      }
    }
    public function reservation(){
    	$major_industries = array();
    	$major_industry_sub_classes = array();
    	$query_major_industry = $this->db->get("major_industry");
    	if($query_major_industry->num_rows()>0) {
    		$major_industries = $query_major_industry->result_array();
    	}
    	$data['major_industries'] = $major_industries;
    	$query_major_industry_sub_classes = $this->db->get("subclass");
    	if($query_major_industry_sub_classes->num_rows()>0) {
    		$major_industry_sub_classes = $query_major_industry_sub_classes->result_array();
    	}
    	$data['major_industry_sub_classes'] = $major_industry_sub_classes;
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Reservation Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Reservation';
              $data['regions_list'] = $this->region_model->get_regions();
              $data['composition'] = $this->cooperatives_model->get_composition();
              if ($this->form_validation->run() == FALSE){
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/reservation_detail', $data);
               // $this->load->view('cooperative/terms_and_condition');
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
                if($this->input->post('commonBondOfMembership')=="Institutional"){
                    $name_of_ins_assoc = $this->input->post('name_institution');
                    $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));
                } else {
                    $name_of_ins_assoc = $this->input->post('name_associational');
                    $name_of_ins_assoc = implode(", ",$this->input->post('name_associational'));
                }
                $field_data = array(
                  'users_id' => $this->session->userdata('user_id'),
                  'category_of_cooperative' => $category,
                  'proposed_name' => $this->input->post('proposedName'),
                  'acronym_name' => $this->input->post('acronym_name'),
                  'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                  'grouping' => $group,
                  'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                  'field_of_membership' => $this->input->post('field_membership'),
                  'name_of_ins_assoc' => $name_of_ins_assoc,
                  'area_of_operation' => $this->input->post('areaOfOperation'),
                  'refbrgy_brgyCode' => $this->input->post('barangay'),
                  'street' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'created_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                );

                if($this->cooperatives_model->add_cooperative($field_data,$major_industry,$subclass_array,$members_composition)){
                  $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
                  redirect('cooperatives');
                }else{
                  $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                  redirect('cooperatives');
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
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Cooperative Details';
              $data['header'] = 'Cooperative Information';
              $data['deferred_comments'] = $this->cooperatives_model->cooperatives_comments($decoded_id);
              $data['denied_comments'] = $this->cooperatives_model->denied_comments($decoded_id);
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
              $data['coop_type_upload_doc'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
              // $this->debug(  $data['coop_type_upload_doc']);
              // $data['document_completed'] =''; 
              $array_upload[] = array();
              if(!empty($data['coop_type_upload_doc']))
              {
                foreach ($data['coop_type_upload_doc'] as $coop) : 
                  //if uploaded or not
                  $coop['statuses']=$this->uploaded_document_model->check_document_exist($decoded_id,$coop['document_num']);
                  $array_upload[] = $coop['statuses'];
                endforeach;
                 if(in_array('false',$array_upload))
                  {
                    $data['document_completed'] =false;
                  }
                  else
                  {
                    $data['document_completed']=true;
                  }
              }
              else
              {
                 $data['document_completed'] =true;
              }  

              $data['bylawprimary'] = $data['coop_info']->category_of_cooperative=="Primary";
                if($data['coop_info']->category_of_cooperative=="Primary"){
                    $bylawstf = $this->bylaw_model->check_bylaw_primary_complete($decoded_id);
                } else if($data['coop_info']->grouping=="Federation" && $data['coop_info']->category_of_cooperative=="Secondary" || $data['coop_info']->grouping=="Federation" && $data['coop_info']->category_of_cooperative=="Tertiary"){
                    $bylawstf = $this->bylaw_model->check_bylaw_primary_complete($decoded_id);
                } else if($data['coop_info']->grouping=="Union" && $data['coop_info']->category_of_cooperative=="Secondary" || $data['coop_info']->grouping=="Union" && $data['coop_info']->category_of_cooperative=="Tertiary") {
                    $bylawstf = $this->bylaw_model->check_bylaw_primary_complete_union($decoded_id);
                } else {
                    $bylawstf = true;
                }
//              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              $data['bylaw_complete'] = $bylawstf;
              /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred && Anjury */
                if($data['coop_info']->category_of_cooperative=="Primary"){
                    $federationtf = $this->capitalization_model->check_capitalization_primary_complete($decoded_id);
                } else if($data['coop_info']->category_of_cooperative=="Secondary" || $data['coop_info']->category_of_cooperative=="Tertiary"){
                    $federationtf = $this->capitalization_model->check_capitalization_primary_complete($decoded_id);
                } else {
                    $federationtf = true;
                }
//              $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
              $data['capitalization_complete'] = $federationtf;
              /*END: UPDATE FOR CAPITALIZATION --by Fred && Anjury*/
                if($data['coop_info']->category_of_cooperative=="Primary"){
                    $capitalizationtf = $this->article_of_cooperation_model->check_article_primary_complete($decoded_id);
                } else if($data['coop_info']->category_of_cooperative=="Secondary" || $data['coop_info']->category_of_cooperative=="Tertiary"){
                    $capitalizationtf = $this->article_of_cooperation_model->check_article_primary_complete($decoded_id);
                } else {
                    $capitalizationtf = true;
                }
//              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              $data['article_complete'] = $capitalizationtf;
              $data['encrypted_id'] = $id;
             //                 $data['capitalization_complete'] = $this->cooperative_model->is_capitalization_complete($decoded_id);
              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
              $capitalization_info = $data['capitalization_info'];
              if($capitalization_info != NULL){
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
              } else {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,0);
              }
              if($data['coop_info']->type_of_cooperative == 'Credit'){
                    if($data['coop_info']->grouping == 'Federation'){
                        $data['committees_complete'] = $this->committee_model->get_all_required_count_credit_federation($user_id);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $data['committees_complete'] = $this->committee_model->get_all_required_count_credit_union($user_id);
                    } else {
                        $data['committees_complete'] = $this->committee_model->get_all_required_count_credit($user_id);
                    }
              } else {
                    if($data['coop_info']->grouping == 'Federation'){
                        $data['committees_complete'] = $this->committee_model->get_all_required_count_federation($user_id);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $data['committees_complete'] = $this->committee_model->get_all_required_count_union($user_id);
                    } else {
                        $data['committees_complete'] = $this->committee_model->get_all_required_count($user_id);
                    }
                  
              }
              if($capitalization_info != NULL){
                   $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$user_id);
              } else {
                    $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,0);
              }
//              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              
              $data['affiliates_complete'] = $this->unioncoop_model->is_requirements_complete($user_id);
              
              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);//surety
              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);//pre regis
              $data['submitted'] = $this->cooperatives_model->check_submitted_for_evaluation($decoded_id);
              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
              $data['committeescount'] = $this->committee_model->get_all_committees_of_coop_gad($decoded_id);
              if($data['coop_info']->grouping == 'Federation'){
                  $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
              } else {
                  $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
              }
              $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
//              print_r($data['inssoc']);
              $data['committees_count_member'] = $this->committee_model->get_all_committees_count($user_id);
              $data['list_cooperators_count'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_count($decoded_id);
              //payment download form
               $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
               $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                $data['name_reservation_fee']=100.00;
                $data['pay_from']='reservation';
              //END payment download form
              $this->load->view('./template/header', $data);
              $this->load->view('cooperative/cooperative_detail', $data);
              $this->load->view('./template/footer');
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $data['title'] = 'Cooperative Details';
                  $data['header'] = 'Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
                  $data['members_composition'] =  $this->cooperatives_model->get_coop_composition($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                 /*END: UPDATE FOR CAPITALIZATION --by Fred */
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                  $data['encrypted_id'] = $id;
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
//                  $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                  if($data['coop_info']->type_of_cooperative == 'Credit'){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_credit_federation($data['coop_info']->users_id);
                        } else {
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_credit($data['coop_info']->users_id);
                        }
                  } else {
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_federation($data['coop_info']->users_id);
                        } else if($data['coop_info']->grouping == 'Union'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_union($data['coop_info']->users_id);
                        } else {
                            $data['committees_complete'] = $this->committee_model->get_all_required_count($data['coop_info']->users_id);
                        }
                  }
                  $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                  $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                  $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$data['coop_info']->users_id);
                  $data['affiliates_complete'] = $this->unioncoop_model->is_requirements_complete($data['coop_info']->users_id);
                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                  
                  $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                  $count=0;
                  $data['document_others1'] = $this->uploaded_document_model->get_document_one_info($decoded_id);

                  foreach ($data['coop_type'] as $coop) : 

                      $count++;
                      if($count == 1){
                          $data['document_others1'] = $this->uploaded_document_model->get_document_others1_info($decoded_id,$coop['document_num']);
                      } else if($count == 2) {
                          $data['document_others2'] = $this->uploaded_document_model->get_document_others2_info($decoded_id,$coop['document_num']);
                      } else {
                          $data['document_others1'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                          $data['document_others2'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                      }

                  endforeach;
                  
                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                  if($data['coop_info']->grouping == 'Federation'){
                        $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                    } else {
                        $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                    }
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('cooperative/cooperative_detail', $data);
                  $this->load->view('cooperative/evaluation/approve_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/deny_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('./templates/admin_footer');
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The application you trying to view is not yet submitted for evaluation.');
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
    public function rupdate($id = null){

      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                if($this->form_validation->run() == FALSE){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                  
                  $data['title'] = 'Update Cooperative Details';
                  $data['header'] = 'Update Cooperative Information';
                  
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['major_industry_list'] = $this->cooperatives_model->get_all_major_industry($decoded_id);
               
                  $data['composition']= $this->cooperatives_model->get_composition();
                  $data['regions_list'] = $this->region_model->get_regions();
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
                  
                  $this->load->view('./template/header', $data);
                  $this->load->view('cooperative/reservation_update', $data);
                  if($this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                    // $this->load->view('cooperative/terms_and_condition');
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
                
                    $name_of_ins_assoc = array_filter($this->input->post('name_institution'));
                    if(count($name_of_ins_assoc)>0 )
                    {
                        $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));
                    }
                    else
                    {
                        $name_of_ins_assoc='';
                    }
                    
                    $field_data = array(
                      'users_id' => $this->session->userdata('user_id'),
                      'category_of_cooperative' => $category,
                      'proposed_name' => $this->input->post('proposedName'),
                      'acronym_name' => $this->input->post('acronym_name'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                      'grouping' => $group,
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'field_of_membership' => $this->input->post('field_membership'),
                      'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo')
                    );
                    if($this->cooperatives_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID'));
                    }
                  }else{
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $field_data = array(
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposedName'),
                      'acronym_name' => $this->input->post('acronym_name'),
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
                    if($this->cooperatives_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry)){
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
              if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if(!$this->cooperatives_model->check_first_evaluated($decoded_id)){
                    if($this->form_validation->run() == FALSE){
                      $data['title'] = 'Update Cooperative Details';
                      $data['header'] = 'Update Cooperative Information';
                      $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                      $data['regions_list'] = $this->region_model->get_regions();
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      $data['major_industry_list'] = $this->cooperatives_model->get_all_major_industry($decoded_id);
                      $data['subclasses_list'] = $this->cooperatives_model->get_all_subclasses($decoded_id);
                      $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                      $data['composition']= $this->cooperatives_model->get_composition();
                      $data['encrypted_id'] = $id;
                      $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('cooperative/reservation_update', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                        $subclass_array = $this->input->post('subClass');
                        $major_industry = $this->input->post('majorIndustry');
                        $field_data = array(
                          'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                          'proposed_name' => $this->input->post('proposedName'),
                          'acronym_name' => $this->input->post('acronym_name'),
                          'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                          'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                          'composition_of_members' => $this->input->post('compositionOfMembers'),
                          'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                          'area_of_operation' => $this->input->post('areaOfOperation'),
                          'refbrgy_brgyCode' => $this->input->post('barangay'),
                          'street' => $this->input->post('streetName'),
                          'house_blk_no' => $this->input->post('blkNo')
                        );
                        if($this->cooperatives_model->update_not_expired_cooperative_by_admin($decoded_id,$field_data,$subclass_array,$major_industry)){
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
    public function delete_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteCooperativeBtn')){
          if($this->session->userdata('client')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($decoded_id) && $decoded_id!=0){
              if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    // $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
                  $data['coop_info']= $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                    // if($data['coop_info']=="Federation"){
                    //     $deletecoop = 'delete_cooperative';
                    // } else {
                    //     $deletecoop = 'delete_cooperative_federation';
                    // }
                    if($data['coop_info']->category_of_cooperative == 'Primary')
                    {
                     $success =  $this->cooperatives_model->delete_cooperative($decoded_id,$data['coop_info']->status,$user_id);
                      if($success){
                        $this->session->set_flashdata('list_success_message', 'Cooperative has been deleted.');
                        redirect('cooperatives');
                      }else{
                        $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                        redirect('cooperatives');
                      }
                    }
                   
                }else{
                  if(!$this->cooperatives_model->check_if_denied($decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
                  }else{
                    $success = $this->cooperatives_model->delete_cooperative($decoded_id);
                    if($success){
                      $this->session->set_flashdata('list_success_message', 'Cooperative has been deleted.');
                      redirect('cooperatives');
                    }else{
                      $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                      redirect('cooperatives');
                    }
                  }
                }
              } else {
                redirect('cooperatives');
              }
            } else {
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('cooperatives');
            }
          }
        }else{
          redirect('cooperatives');
        }
      }
    }
    
    public function delete_branches(){
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
    
    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                if($data['bylaw_complete']){
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union'){
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
                        } else if($data['coop_info']->grouping == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                              if($data['document_one'] && $data['document_two']){
                                if($this->cooperatives_model->check_if_deferred($decoded_id)){
                                  if($this->cooperatives_model->submit_for_reevaluation($user_id,$decoded_id)){
                                    if($data['coop_info']->house_blk_no==null && $data['coop_info']->street==null) $x=''; else $x=', ';

                                      $brgyforemail = ucwords($data['coop_info']->house_blk_no).' '.ucwords($data['coop_info']->street).$x.' '.$data['coop_info']->brgy.', '.$data['coop_info']->city.', '.$data['coop_info']->province.', '.$data['coop_info']->region;
                                      // Get Count Coop Type for HO
                                        $this->db->where(array('name'=>$data['coop_info']->type_of_cooperative,'active'=>1));
                                        $this->db->from('head_office_coop_type');
                                      // End Get Count Coop Type
                                      if($this->db->count_all_results()>0)
                                      {
                                        $regioncode = '00';
                                      } else {
                                        $regioncode = '0'.mb_substr($data['coop_info']->refbrgy_brgyCode, 0, 2);
                                      }
                                      $data['senior_info'] = $this->admin_model->get_senior_info($regioncode);
                                      $data['client_info'] = $this->user_model->get_user_info($user_id);

                                      $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                                      if(!empty($data['coop_info']->acronym_name)){ 
                                        $acronymname = '('.$data['coop_info']->acronym_name.')';
                                      }else{ $acronymname = '';}

                                      $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' '.$data['coop_info']->type_of_cooperative.' Cooperative ';

                                      if($this->admin_model->sendEmailToSeniorHO($proposednameemail,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email)){
                                      $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please Wait for an e-mail notification list of documents for submission');
                                      redirect('cooperatives/'.$id);
                                    }
                                  }else{
                                    $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                    redirect('cooperatives/'.$id);
                                  }
                                }else{ 
                                  if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                    if($this->cooperatives_model->submit_for_evaluation($user_id,$decoded_id)){

                                      if($data['coop_info']->house_blk_no==null && $data['coop_info']->street==null) $x=''; else $x=', ';

                                      $brgyforemail = ucwords($data['coop_info']->house_blk_no).' '.ucwords($data['coop_info']->street).$x.' '.$data['coop_info']->brgy.', '.$data['coop_info']->city.', '.$data['coop_info']->province.', '.$data['coop_info']->region;

                                      $regioncode = '0'.mb_substr($data['coop_info']->refbrgy_brgyCode, 0, 2);

                                      $data['senior_info'] = $this->admin_model->get_senior_info($regioncode);
                                      $data['client_info'] = $this->user_model->get_user_info($user_id);

                                      $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                                      if(!empty($data['coop_info']->acronym_name)){ 
                                        $acronymname = '('.$data['coop_info']->acronym_name.')';
                                      }else{ $acronymname = '';}

                                      $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' '.$data['coop_info']->type_of_cooperative.' Cooperative ';

                                      $this->admin_model->sendEmailToClient($proposednameemail,$data['client_info']->email);

                                      if($this->admin_model->sendEmailToSenior($proposednameemail,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['senior_info']->email)){
                                        $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                        redirect('cooperatives/'.$id);
                                      }
                                      else
                                      {
                                        $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                        redirect('cooperatives/'.$id);
                                      }
                                    }else{
                                      $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                     redirect('cooperatives/'.$id);
                                    }
                                  }else{
                                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                    redirect('cooperatives/'.$id);
                                  }
                                }
                              }else if(!$data['document_one'] && !$data['document_two']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');
                                redirect('cooperatives/'.$id);
                              }else if(!$data['document_one']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');
                                redirect('cooperatives/'.$id);
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
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
            }else{
              redirect('cooperatives');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function payment($coop){
      $coop = $this->encryption->decrypt(decrypt_custom($coop));
      $coop=str_replace('%20',' ',$coop);
      $data = $this->cooperatives_model->get_payment_info($coop);
      echo json_encode($data);
    }

    

    public function assign_specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('cooperatives');
              }else{
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID',TRUE)));
                $user_id = $this->session->userdata('user_id');
                if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));;
                    $coop_full_name = $this->input->post('cooperativeName',TRUE);
                    if((is_numeric($decoded_id) && $decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
                      if($this->cooperatives_model->check_not_yet_assigned($decoded_id)){

                        $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                        if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                        $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                        $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                        $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                        $query = $this->db->get_where('admin',array('id'=>$decoded_specialist_id));
                        $admin_info = $query->row();
                        
                        if($this->admin_model->sendEmailToSpecialist($coop_full_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$admin_info->email)){
                          if($this->cooperatives_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
                            $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
                          redirect('cooperatives');
                          }
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
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('cooperatives');
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
              redirect('cooperatives');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->cooperatives_model->check_if_denied($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $comment_by_specialist_senior = $this->input->post('comment_by_specialist_senior',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('cooperatives');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                // $this->debug($this->cooperatives_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name));
                                $success = $this->cooperatives_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been submitted.');
                                  redirect('cooperatives');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
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
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }
                      }else if($this->session->userdata('access_level')==3){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('cooperatives');
                            }else{
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $data_field = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level
                              );
                            $success = $this->cooperatives_model->insert_comment_history($data_field);
                                $success = $this->cooperatives_model->approve_by_director($data['admin_info'],$decoded_id);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                                  redirect('cooperatives');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
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
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }
                      }else if($this->session->userdata('access_level')==2){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            redirect('cooperatives');
                          }else{
                              $data_field = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level
                              );

                            $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                            if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                            $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                            $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                            $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                            // $query = $this->db->get_where('admin',array('id'=>$decoded_specialist_id));
                            // $admin_info = $query->row();

                            $temp = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                            // Get Count Coop Type for HO
                              $this->db->where(array('name'=>$temp->type_of_cooperative,'active'=>1));
                              $this->db->from('head_office_coop_type');
                            // End Get Count Coop
                            if($this->db->count_all_results()>0){

                              $this->db->where(array('region_code'=>00,'is_director_active'=>1,'access_level'=>3));
                              $this->db->from('admin');

                              if($this->db->count_all_results()>0){
                                $senior_emails = $this->admin_model->get_emails_of_director_by_region("00");
                              } else {
                                $senior_emails = $this->admin_model->get_emails_of_supervisor_by_region("00");
                              }

                              $data['admin_info_ho'] = $this->admin_model->get_admin_info($coop_info->evaluated_by);
                            } else {
                              $senior_emails = $this->admin_model->get_emails_of_director_by_region($temp->rCode);
                              $data['admin_info_ho'] = $this->admin_model->get_admin_info($coop_info->evaluated_by);
                            }

                            $this->admin_model->sendEmailToDirectorFromSenior($senior_emails,$coop_full_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['admin_info_ho'],$coop_info->specialist_submit_at,$coop_info->third_evaluated_by);

                            $success = $this->cooperatives_model->insert_comment_history($data_field);
                            $success = $this->cooperatives_model->approve_by_senior($data['admin_info'],$decoded_id,$coop_full_name,$comment_by_specialist_senior);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been submitted.');
                              redirect('cooperatives');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                              redirect('cooperatives');
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }
                      }else{
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }else{
                            $data_field = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level
                              );

                            $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                            if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                            $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                            $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                            $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                            // $query = $this->db->get_where('admin',array('id'=>$decoded_specialist_id));
                            // $admin_info = $query->row();

                            $temp = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                            // Get Count Coop Type for HO
                              $this->db->where(array('name'=>$temp->type_of_cooperative,'active'=>1));
                              $this->db->from('head_office_coop_type');
                            // End Get Count Coop
                            if($this->db->count_all_results()>0){
                              $senior_emails = $this->admin_model->get_emails_of_senior_by_region("00");
                            } else {
                              $senior_emails = $this->admin_model->get_emails_of_senior_by_region($temp->rCode);
                            }

                            $this->admin_model->sendEmailToAdmins($senior_emails,$coop_full_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['admin_info']);

                            $success = $this->cooperatives_model->insert_comment_history($data_field);
                            $success = $this->cooperatives_model->approve_by_specialist($data['admin_info'],$decoded_id,$coop_full_name,$comment_by_specialist_senior);

                          if($success){
                            $this->session->set_flashdata('list_success_message', 'Cooperative has been submitted.');
                            redirect('cooperatives');
                          }else{
                            $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                            redirect('cooperatives');
                          }
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                      redirect('cooperatives');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
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
          redirect('cooperatives');
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
                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                   $comment_by_specialist_senior = $this->input->post('comment',TRUE);
                                   $data_comment = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level,
                                  'status' => 10
                                   );

                                   $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                                   // $coop_full_name = $this->input->post('cName',TRUE);
                                   $coop_full_name = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping;

                                    $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                                    if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                                    $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                                    $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                                   $this->cooperatives_model->insert_comment_history($data_comment);
                                   $this->admin_model->sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$data['client_info']->email);

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
                                 $comment_by_specialist_senior = $this->input->post('comment',TRUE);
                                   $data_comment = array(
                                    'cooperatives_id' => $decoded_id,
                                    'comment' => $comment_by_specialist_senior,
                                    'user_id' => $user_id,
                                    'user_level' => $data['admin_info']->access_level,
                                    'status' => 10
                                 );

                                 $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                                 $coop_full_name = $this->input->post('cName',TRUE);

                                    $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                                    if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                                    $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                                    $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                                  $this->cooperatives_model->insert_comment_history($data_comment);
                                  $this->admin_model->sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$data['client_info']->email);

                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
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

                                  // $coop_full_name = $this->input->post('cName',TRUE);

                                  $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                                  $coop_full_name = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping;

                                  if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                                  $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                                  $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                                  $this->admin_model->sendEmailToClientDefer($coop_full_name,$brgyforemail,$data['client_info']->email,$reason_commment,$data['admin_info']->region_code,$reg_officials_info);

                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                  $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                   $comment = array(
                                        'cooperatives_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => $this->session->userdata('access_level'),
                                        'status' =>11
                                    );
                                  $this->cooperatives_model->insert_comment_history($comment);
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
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                    $data_field = array(
                                        'cooperatives_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level,
                                        'status' =>11
                                    );
                                  $success_comment = $this->cooperatives_model->insert_comment_history($data_field);

                                  // $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

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

                                  // $coop_full_name = $this->input->post('cName',TRUE);

                                  $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                                  $coop_full_name = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping;

                                  if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                                  $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                                  $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                                  $this->admin_model->sendEmailToClientDefer($coop_full_name,$brgyforemail,$data['client_info']->email,$reason_commment,$data['admin_info']->region_code,$reg_officials_info);

                                  $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success_comment && $success){
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
          $result = $this->cooperatives_model->is_name_update_unique($data);
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
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->cooperatives_model->get_cooperative_info($decoded_user_id,$decoded_id);
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
            $result = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function composition(){
      $result = $this->cooperatives_model->get_composition();
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
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->cooperatives_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }


     //modify by json
    public function approve_laboratories(){
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
              redirect('cooperatives');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if(!$this->laboratories_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->cooperatives_model->check_if_denied_laboratories($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated_laboratories($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Laboratory already evaluated by a Director/Supervising CDS.');
                              redirect('cooperatives');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $success = $this->cooperatives_model->approve_by_supervisor_laboratories($data['admin_info'],$decoded_id,$coop_full_name);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                                  redirect('cooperatives');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve laboraotories.');
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
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('laboratories');
                        }
                      }else if($this->session->userdata('access_level')==3){
//                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated_laboratories($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated_laboratories($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'laboratories already evaluated by a Director/Supervising CDS.');
                              redirect('laboratories');
                            }else{
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $success = $this->cooperatives_model->approve_by_director_laboratories($data['admin_info'],$decoded_id);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                                  redirect('laboratories');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve Laboratory.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('laboratories');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('laboratories');
                          }
//                        }else{
//                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a labroratories Development Specialist II.');
//                          redirect('laboratories');
//                        }
                      }else if($this->session->userdata('access_level')==2){
//                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated_laboratories($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            redirect('cooperatives');
                          }else{
                             
                             
                             if(strlen(trim($this->input->post('comment')))>0)
                             {
                              $usr_id = $this->session->userdata('user_id');
                              $usr_access_level = $this->session->userdata('access_level');
                              $data3 = array(
                                              'user_id'=> $usr_id,
                                              'user_access_level'=>$usr_access_level,
                                              'laboratory_id'=> $decoded_id,
                                              'laboratory_status'=>12,
                                              'comment'=> trim($this->input->post('comment')),
                                              'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))
                                            );
                              $check_comment_senior = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$decoded_id,'laboratory_status'=>12,'user_access_level'=>2));
                                if($check_comment_senior->num_rows()>0)
                                {
                                  $this->db->update('laboratory_comment',$data3,array('laboratory_id'=>$decoded_id,'laboratory_status'=>12,'user_access_level'=>2));
                                }
                                else
                                {
                                  $this->laboratory_comment($data3); // insert comment details
                                }
                             }
                             

                            $success = $this->cooperatives_model->approve_by_supervisor_laboratories($data['admin_info'],$decoded_id,$coop_full_name);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Laboratories has been submitted.');
                              redirect('laboratories');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve L.');
                              redirect('laboratories');
                            }
                          }
//                        }else{
//                          $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
//                          redirect('cooperatives');
//                        }
                      }else{
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }else{
                          $success = $this->cooperatives_model->approve_by_specialist($data['admin_info'],$decoded_id,$coop_full_name);
                          if($success){
                            $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                            redirect('cooperatives');
                          }else{
                            $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                            redirect('cooperatives');
                          }
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                      redirect('cooperatives');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
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
          redirect('cooperatives');
        }
      }
    }
    
    


    //modify by json
    public function laboratory_comment($comment_data)
    {
      if($this->db->insert('laboratory_comment',$comment_data))
      {
         //success insert comment
      }
      else
      {
        return "Error while trying to insert comment into database";
      }
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
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
                          redirect('amendment');
                        }else{
                          $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                          redirect('amendment');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the cooperative to an evaluator.');
                        redirect('amendment');
                      }
                    }else{
                      show_404();
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is already expired.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }
    
    public function count_documents($coop_id,$num)
    {
      $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
      if($query->num_rows()>0)
      {
        $data = $query->result_array();

      }
      else
      {
        $data =NULL;
      }
      return $data;

    }
    
    public function count_documents_others($coop_id,$num)
    {
      $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('uploaded_documents');
      if($query->num_rows()>0)
      {
        $data = $query->result_array();
      }
      else
      {
        $data =NULL;
      }
      return $data;

    }
    public function count_documents_others2($coop_id,$num)
    {
      $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('uploaded_documents');
      if($query->num_rows()>0)
      {
        $data = $query->result_array();
      }
      else
      {
        $data =NULL;
      }
      return $data;

    }
     public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
    public function phpinfos(){
      echo phpinfo();
    }
  }
 ?>
