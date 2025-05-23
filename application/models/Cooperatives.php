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
          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
//          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
          $data['count_cooperatives'] = $this->cooperatives_model->get_count_cooperatives($this->session->userdata('user_id'));
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
          if(!empty($data['coop_info']->id)){
              if($data['coop_info']->status != 15){
                if(date('Y-m-d H:i:s',strtotime($data['coop_info']->expire_at)) < date('Y-m-d H:i:s')){
                  // echo '<script>alert("Your Reserved Cooperative Name has Expired. Reserved Name now will be deleted.");</script>';
                  $success = $this->cooperatives_model->delete_cooperative($data['coop_info']->id,$data['coop_info']->status,$user_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Reserved Cooperative Name has Expired.');
                    redirect('cooperatives');
                  }
                }
              }
          }
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_applications', $data);
          $this->load->view('cooperative/delete_modal_cooperative');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Cooperatives';
            $data['header'] = 'Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $this->load->view('templates/admin_header', $data);
            // $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($data['coop_info']->id);
            // $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($data['coop_info']->id);
            // $data['cooperatives_comments'] = $this->cooperatives_model->cooperatives_comments($data['coop_info']->id);
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
              $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
              $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
            }else{
              $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
              $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
            }
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
              $data['cooperatives_comments'] = $this->cooperatives_model->cooperatives_comments($decoded_id);
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
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
              if($data['coop_info']->type_of_cooperative == 'Credit' || $data['coop_info']->type_of_cooperative == 'Agriculture'){
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
//              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($user_id);
              $data['affiliates_complete'] = $this->unioncoop_model->is_requirements_complete($user_id);
              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
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
                  $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($data['coop_info']->users_id);
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

                    $name_of_ins_assoc = $this->input->post('name_institution');
                    $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));

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
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
                    if($data['coop_info']=="Federation"){
                        $deletecoop = 'delete_cooperative';
                    } else {
                        $deletecoop = 'delete_cooperative_federation';
                    }
                  $success = $this->cooperatives_model->$deletecoop($decoded_id,$data['coop_info']->status,$user_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deleted.');
                    redirect('cooperatives');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                    redirect('cooperatives');
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
              }
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
                if($data['bylaw_complete']){
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } else if($data['coop_info']->grouping == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
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
                                    $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please Wait for an e-mail notification list of documents for submission');
                                    redirect('cooperatives/'.$id);
                                  }else{
                                    $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                    redirect('cooperatives/'.$id);
                                  }
                                }else{
                                  if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                    if($this->cooperatives_model->submit_for_evaluation($user_id,$decoded_id)){
                                      $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                      redirect('cooperatives/'.$id);
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
                        if($this->cooperatives_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
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
                              if(!$this->admin_model->check_if_director_active($user_id)){
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
                              if($this->admin_model->check_if_director_active($user_id)){
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
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                if($this->admin_model->check_if_director_active($user_id)){
                                    $data_field = array(
                                        'cooperatives_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level
                                    );
                                  $success = $this->cooperatives_model->insert_comment_history($data_field);
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
                              if(!$this->admin_model->check_if_director_active($user_id)){
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
                              if($this->admin_model->check_if_director_active($user_id)){
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
  }
 ?>
