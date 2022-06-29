<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratories_cooperators extends CI_Controller{

// public $laboratories_cooperator_model='';
  public function __construct()
  {
    parent::__construct();
    $this->load->model('laboratories_model');
    $this->load->model('user_model');
    $this->load->model('cooperator_model');
    $this->load->model('laboratories_cooperator_model');
    $this->load->model('cooperatives_model');
    $this->load->model('province_model');
    $this->load->model('bylaw_model');
    $this->load->model('region_model');
    $this->load->model('admin_model');

    //Codeigniter : Write Less Do More
     // $this->laboratories_cooperator_model= $this->load->model('Laboratories_cooperator_model');

  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        // echo $decoded_id;
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->laboratories_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->laboratories_model->get_cooperative_info($user_id,$decoded_id);
//                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
//                if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Members/Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['cooperators_count'] = $this->laboratories_model->count_cooperators($decoded_id);
//                    $data['requirements_complete'] = $this->laboratories_cooperator_model->is_requirements_complete($decoded_id);
//                    $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
//                    $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
//                    $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
//                    $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
//                    $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
//                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
//                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
//                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
//                    $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
//                    $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
//                    $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
//                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
//                    $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
//                    $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
//                    $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
//                    $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
//                    $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                    $data['list_cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop_laboratories($decoded_id);
                    // echo $this->db->last_query()
//                    $data['ten_percent']=$this->cooperator_model->ten_percent($decoded_id);
                    $this->load->view('./template/header', $data);
                    $this->load->view('laboratories/laboratory_cooperators_list', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('laboratories/delete_form_cooperator_laboratory');
                    $this->load->view('./template/footer');
//                }else{
//                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
//                  redirect('cooperatives/'.$id);
//                }
              }else{
                redirect('laboratories/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['requirements_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                        $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                        $data['total_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                        $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
                        $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
                        $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_regular_pay($decoded_id);
                        $data['minimum_associate_subscription'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);
                        $data['minimum_associate_pay'] = $this->cooperator_model->check_all_minimum_associate_pay($decoded_id);
                        $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                        $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                        $data['check_regular_paid'] = $this->cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                        $data['vice_count'] = $this->cooperator_model->check_vicechairperson($decoded_id);
                        $data['treasurer_count'] = $this->cooperator_model->check_treasurer($decoded_id);
                        $data['secretary_count'] = $this->cooperator_model->check_secretary($decoded_id);
                        $data['list_cooperators'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                        $data['ten_percent']=$this->cooperator_model->ten_percent($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('laboratories/laboratory_cooperators_list', $data);
                        $this->load->view('cooperators/full_info_modal_cooperator');
                        $this->load->view('laboratories/delete_form_cooperator_laboratory');
                        $this->load->view('./templates/admin_footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }

  function add($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->laboratories_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->laboratories_model->get_cooperative_info($user_id,$decoded_id);
                  // if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){

                $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info']->rCode);
                $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info']->pCode);
                $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info']->cCode);

                if($this->laboratories_model->check_submitted_for_evaluation_2($decoded_id)){
                  if(isset($_POST['addCooperatorBtn'])){
                      $temp = TRUE;
                  } else {
                      $temp = FALSE;
                  }
                    if($temp == TRUE){
//                    if($this->input->post('fName')) {
                      $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                      $first_Name = $this->input->post('fName');
                      $MidlleName = $this->input->post('middle_name');
                      $Last_Name = $this->input->post('last_name');
                      $data = array(
                        'cooperatives_id' => $decoded_post_coop_id,
                        'laboratory_id' => $decoded_id,
                        'full_name' => $first_Name ,
                        'middle_name' =>$MidlleName ,
                        'last_name' =>   $Last_Name,
                        'gender' => $this->input->post('gender'),
                        'age' => $this->input->post('age'),
                        'educational_experience' => $this->input->post('educational_experience'),
                      'educational_bg' => strtolower($this->input->post('edb')),
//                        'type_of_member' => $this->input->post('membershipType'),
                        'birth_date' => $this->input->post('bDate'),
                        'house_blk_no'=> $this->input->post('blkNo'),
                        'streetName'=> $this->input->post('streetName'),
                        'addrCode' => $this->input->post('barangay'),
//                        'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
//                        'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                        'proof_of_identity' =>$this->input->post('validIdType'),
                        'proof_of_identity_number' =>$this->input->post('validIdNo'),
                        'proof_date_issued' =>$this->input->post('dateIssued'),
                        'place_of_issuance' =>$this->input->post('placeIssuance'),
                        );
                       // print_r($data);
                      $name_check =$this->laboratories_model->check_lab_membername_exist($first_Name,$MidlleName,$Last_Name,$decoded_id);
                      if($name_check)
                      {

                     
                        $this->session->set_flashdata('member_error', "Member/Cooperator Name already exist.");
                         redirect('laboratories/'.$this->input->post('cooperativesID').'/laboratories_cooperators');
                         //get last name
                         $check_input_name = $this->check_lastname($first_Name,$MidlleName,$Last_Name,$decoded_id);
                         if($check_input_name)
                         {
                            $this->session->set_flashdata('member_error', "Member/Cooperator first and lastname already exist.");
                         }
                         else
                         {
                            $success = $this->laboratories_model->add_lab_members($data);
                          if($success['success']){
                            $this->session->set_flashdata('member_success', $success['message']);
                            redirect('laboratories/'.$this->input->post('cooperativesID').'/laboratories_cooperators');
                          }else{
                            $this->session->set_flashdata('member_error', $success['message']);
                            redirect('laboratories/'.$this->input->post('cooperativesID').'/laboratories_cooperators');
                          } 
                         }//else lastname

                      }
                      else
                      {
                          // $success = $this->cooperator_model->add_cooperator_laboratories($data);
                        $success = $this->laboratories_model->add_lab_members($data);
                        // var_dump($success);
                          if($success['success']){
                            $this->session->set_flashdata('member_success', $success['message']);
                            redirect('laboratories/'.$id.'/laboratories_cooperators');
                          }else{
                            $this->session->set_flashdata('member_error', $success['message']);
                            redirect('laboratories/'.$id.'/laboratories_cooperators');
                          }
                      }
              
                    }else{ 
                      $data['client_info'] = $this->user_model->get_user_info($user_id);
                      $data['title'] = 'List of Cooperators';
                      $data['header'] = 'Members/Cooperators';
                      $data['encrypted_id'] = $id;
                      $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                      $data['provinces_list'] = $this->province_model->all_provinces();

                      $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);

                      $user_id = $this->session->userdata('user_id');
                      $CoopInfo = $this->laboratories_model->get_cooperative_info($user_id,$decoded_id);

                      if($CoopInfo->area_of_operation == 'Interregional'){
                        $data['regions_list'] = $this->region_model->get_selected_regions($CoopInfo->regions);
                      } else {
                        $data['regions_list'] = $this->region_model->get_regions();
                      }

                     //cooperative id
                      $data['encrypted_coop_id']=encrypt_custom($this->encryption->encrypt($CoopInfo->cooperative_id)); 
                      $data['regno']=$CoopInfo->coop_id; 

                        // echo"<pre>";
                        // print_r($data['coop_info']);
                        // echo"<pre>";


                      $this->load->view('./template/header', $data);
                      $this->load->view('laboratories/add_form_cooperator_laboratory', $data);
                      $this->load->view('./template/footer');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliancessss');
                    redirect('laboratories/'.$id);
                  }
              }else{
                redirect('laboratories/'.$id);
              }
            }else{
              // $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              // redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('laboratories');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('laboratories');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('laboratories');
                  }else{
                    $data['coop_info'] = $this->laboratories_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                      if($this->form_validation->run() == FALSE){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($data['coop_info']->users_id));
                        $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);


                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('cooperators/add_form_cooperator', $data);
                        $this->load->view('./templates/admin_footer');
                      }else{
                        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
                        $data = array(
                          'cooperatives_id' => $decoded_post_coop_id,
                          'full_name' => $this->input->post('fName'),
                          'gender' => $this->input->post('gender'),
                          'position' => $this->input->post('position'),
                          'type_of_member' => $this->input->post('membershipType'),
                          'birth_date' => $this->input->post('bDate'),
                          'house_blk_no'=> $this->input->post('blkNo'),
                          'streetName'=> $this->input->post('streetName'),
                          'addrCode' => $this->input->post('barangay'),
                          'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                          'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                          'proof_of_identity' =>$this->input->post('validIdType'),
                          'proof_of_identity_number' =>$this->input->post('validIdNo'),
                          'proof_date_issued' =>$this->input->post('dateIssued'),
                          'place_of_issuance' =>$this->input->post('placeIssuance'),
                          );
                        $success = $this->cooperator_model->add_cooperator($data);
                        if($success['success']){
                          $this->session->set_flashdata('cooperator_success', $success['message']);
                          redirect('cooperatives/'.$this->input->post('cooperativesID').'/cooperators');
                        }else{
                          $this->session->set_flashdata('cooperator_error', $success['message']);
                          redirect('cooperatives/'.$this->input->post('cooperativesID').'/cooperators');
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Adding cooperator is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }

  public function check_lastname($first_name,$middle_name,$Last_Name,$laboratory_id)
  {
    $get_query = $this->db->query("select full_name,middle_name,last_name from laboratories_cooperators where laboratory_id='$laboratory_id'");
    if($get_query->num_rows()>0)
    {
      foreach($get_query->result_array() as $row)
      {
        $row['input_firstname'] = $first_name;
        $row['input_lastname'] = $Last_Name;
        $row['input_middlename'] = $middle_name;
        $row['first_status']='';
        if(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strcasecmp($row['input_lastname'],$row['last_name'])==0 && strcasecmp($row['input_middlename'],$row['middle_name'])==0)
        {
            $row['first_status']='false';
        }
        elseif(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strlen($row['input_middlename'])<1 && strlen($row['input_lastname'])<1)
        {
             $row['first_status']='false';
        } 
        elseif(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strcasecmp($row['input_firstname'],$row['first_name'])==0 && strlen($row['input_middlename'])<1)
        {
          $row['first_status']='false';
        }
        else
        {
          $row['first_status']='true';
        }
        $status[] = $row['first_status'];
        $data[] = $row;
      }

          if(in_array('false',$status))
          {
            return false;
          }
          else
          {
            return true;
          }
    }
    else
    {
      return true;
    }
  }

  public function edit_no_changes($first_name,$middle_name,$Last_Name,$cooperator_id)
  {
    $qry_no_changes = $this->db->query("select * from laboratories_cooperators where LOWER(full_name)='$first_name' and LOWER(middle_name)='$middle_name' and LOWER(last_name)='$Last_Name' and id='$cooperator_id'");
    if($qry_no_changes->num_rows()>0)
    {
      return true;
    }
  
  }

  public function check_cooperator_name_edit($first_name,$middle_name,$Last_Name,$laboratory_id)
  {

    // $qry_no_changes = $this->db->query("select * from laboratories_cooperators where full_name='$first_name' and middle_name='$middle_name' and last_name='$Last_Name' and laboratory_id='$laboratory_id'");
    // if($qry_no_changes->num_rows()>0)
    // {
    //  return true;
    // }
    // else
    // {
      $get_query = $this->db->query("select full_name,middle_name,last_name from laboratories_cooperators where laboratory_id='$laboratory_id'");
      if($get_query->num_rows()>0)
      {
        foreach($get_query->result_array() as $row)
        {
          $row['input_firstname'] = $first_name;
          $row['input_lastname'] = $Last_Name;
          $row['input_middlename'] = $middle_name;
          $row['first_status']='';
          if(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strcasecmp($row['input_lastname'],$row['last_name'])==0 && strcasecmp($row['input_middlename'],$row['middle_name'])==0)
          {
              $row['first_status']='true';
          }
          elseif(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strlen($row['input_middlename'])<1 && strlen($row['input_lastname'])<1)
          {
               $row['first_status']='false';
          } 
          elseif(strcasecmp($row['input_firstname'],$row['full_name'])==0 && strcasecmp($row['input_lastname'],$row['last_name'])==0 && strlen($row['input_middlename'])<1)
          {
            $row['first_status']='false';
          }
          else
          {
            $row['first_status']='true';
          }
          $status[] = $row['first_status'];
          $data[] = $row;
        }

            if(in_array('false',$status))
            {
              return false;
            }
            else
            {
              return true;
            }
      }
      else
      {
        return true;
      }
    // }//end of $qry_no_changes
  }


  function edit($id = null,$cooperator_id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->laboratories_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->laboratories_model->get_cooperative_info($user_id,$decoded_id);

                    $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                    if($this->cooperator_model->check_cooperator_in_cooperative_laboratories($decoded_id,$decoded_cooperator_id)){ //check if cooperator is in cooperative

                        if(isset($_POST['editCooperatorBtn'])){
                            $temp = TRUE;
                        } else {
                            $temp = FALSE;
                        }
                        if($temp == FALSE){
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'List of Cooperators';
                          $data['header'] = 'Members/Cooperators';
                          $data['encrypted_id'] = $id;

                          $data['regions_list'] = $this->region_model->get_regions();
                          $data['encrypted_cooperator_id'] = $cooperator_id;
                          $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                          $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info_laboratories($decoded_cooperator_id);
                           $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                            // $data['regions_list'] = $this->region_model->get_regions(); //modify jayson
                           if($data['coop_info']->area_of_operation == 'Interregional'){
                            $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                          } else {
                            $data['regions_list'] = $this->region_model->get_regions();
                          }

                          $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info']->rCode);
                          $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info']->pCode);
                          $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info']->cCode);
                          $data['encrypted_coop_id']=encrypt_custom($this->encryption->encrypt($data['coop_info']->cooperative_id)); 
                          
                          $this->load->view('./template/header', $data);
                          $this->load->view('laboratories/edit_form_cooperator_laboratory', $data);
                          $this->load->view('./template/footer');
                        }else{
                          $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                          $items = $this->input->post('item');
                          $items['full_name'] = strtolower($items['full_name']);
                          //get current name for edit
                           $coop_info_for_current_first_name = $this->cooperator_model->get_cooperator_info_laboratories($decoded_cooperator_id);
                           $current_name = $coop_info_for_current_first_name->full_name;


                          $coopID = $items['cooperatives_id']; 
                          $items['house_blk_no'] = $items['blkNo']; 
                          unset($items['blkNo']);
                         
                          if($this->edit_no_changes(strtolower($items['full_name']),strtolower($items['middle_name']),strtolower($items['last_name']),$items['id']))
                          {
                              $success = $this->laboratories_cooperator_model->edit_cooperator_laboratories($items['id'],$items);
                          
                            if($success['success']){
                              $this->session->set_flashdata('member_success', $success['message']);
                              redirect('laboratories/'.$coopID.'/laboratories_cooperators');
                            }else{
                              $this->session->set_flashdata('member_error', $success['message']);
                              redirect('laboratories/'.$coopID.'/laboratories_cooperators');
                            }
                          }
                          else
                          {
                            // echo"saan";
                            // var_dump($this->check_cooperator_name_edit($items['full_name'],$items['middle_name'],$items['last_name'],$decoded_id));
                              if($this->check_cooperator_name_edit($items['full_name'],$items['middle_name'],$items['last_name'],$decoded_id))
                              {

                                $success = $this->laboratories_cooperator_model->edit_cooperator_laboratories($items['id'],$items);
                             
                                if($success['success']){
                                  $this->session->set_flashdata('member_success', $success['message']);
                                  redirect('laboratories/'.$coopID.'/laboratories_cooperators');
                                }else{
                                  $this->session->set_flashdata('member_error', $success['message']);
                                  redirect('laboratories/'.$coopID.'/laboratories_cooperators');
                                } 
                              }
                              else
                              {
                                $this->session->set_flashdata('member_error', "Member/Cooperator first and lastname already exist.");
                                redirect('laboratories/'.$coopID.'/laboratories_cooperators');
                              }
                          }//end edit no changes
                          // var_dump($this->check_cooperator_name_edit($items['full_name'],$items['middle_name'],$items['last_name'],$decoded_id));

                          
                         
                        }
//                      }else{
//                        $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
//                        redirect('cooperatives/'.$id);
//                      }
                    }else{
                      $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                      redirect('laboratories/'.$id.'/laboratories_cooperators');
                    }
//                }else{
//                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
//                  redirect('cooperatives/'.$id);
//                }
              }else{
                redirect('laboratories/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('laboratories');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                        $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                        if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_cooperator_id)){
                            if($this->form_validation->run() == FALSE){
                              $data['title'] = 'List of Cooperators';
                              $data['header'] = 'Cooperators';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_cooperator_id'] = $cooperator_id;
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($decoded_cooperator_id);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('cooperators/edit_form_cooperator', $data);
                              $this->load->view('./templates/admin_footer');
                            }else{
                              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                              $data = array(
                                'full_name' => $this->input->post('fName'),
                                'gender' => $this->input->post('gender'),
                                'position' => $this->input->post('position'),
                                'type_of_member' => $this->input->post('membershipType'),
                                'birth_date' => $this->input->post('bDate'),
                                'house_blk_no'=> $this->input->post('blkNo'),
                                'streetName'=> $this->input->post('streetName'),
                                'addrCode' => $this->input->post('barangay'),
                                'number_of_subscribed_shares' =>$this->input->post('subscribedShares'),
                                'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                                'proof_of_identity' =>$this->input->post('validIdType'),
                                'proof_of_identity_number' =>$this->input->post('validIdNo'),
                                'proof_date_issued' =>$this->input->post('dateIssued'),
                                'place_of_issuance' =>$this->input->post('placeIssuance'),
                                );
                              $success = $this->cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data);
                              if($success['success']){
                                $this->session->set_flashdata('cooperator_success', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/cooperators');
                              }else{
                                $this->session->set_flashdata('cooperator_error', $success['message']);
                                redirect('cooperatives/'.$this->input->post('cooperativesID').'/cooperators');
                              }
                            }
                      }else{
                        $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                        redirect('cooperatives/'.$id.'/cooperators');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }
  function delete_cooperator(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteCooperatorBtn')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative_laboratories($decoded_id,$decoded_post_cooperator_id)){
                if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->cooperator_model->delete_cooperator_laboratories($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Laboratory has been deleted.');
                    redirect('laboratories/'.$this->input->post('cooperativeID').'/laboratories_cooperators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to delete Laboratory.');
                    redirect('laboratories/'.$this->input->post('cooperativeID').'/laboratories_cooperators');
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                  redirect('laboratories/'.$id);
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('laboratories/'.$this->input->post('cooperativeID').'/laboratories_cooperators');
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('laboratories');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('laboratories');
                  }else{
                    $success = $this->cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                    if($success){
                      $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
                    }else{
                      $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                      redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Deleting a cooperator of the cooperative is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('cooperatives');
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
              }
            }
          }
        }else{
          redirect('cooperatives');
        }
      }else{
        redirect('cooperatives');
      }
    }
  }
  function all(){

    if($this->input->method(TRUE)==="GET"){
      redirect('cooperatives');
    }else if($this->input->method(TRUE)==="POST"){
      $uid = $this->session->userdata('user_id');
      $cooperatives_id = $this->cooperatives_model->get_cooperative_info($uid)->id;
      $cooperators = $this->cooperator_model->get_all_cooperator_of_coop($cooperatives_id);
      $temp['data'] = $cooperators;
      echo json_encode($temp);
    }

  }
  public function check_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperativesID'=>$this->input->get('cooperativesID'),
          );
          
          $result = $this->cooperator_model->is_name_unique_laboratories($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('laboratories_cooperators');
        }
      }
  }

  public function check_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperativesID'=>$this->input->get('cooperativesID'),
          );
          $result = $this->cooperator_model->is_name_unique_laboratories($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  public function check_edit_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->input->get('cooperatorID'),
            'cooperativesID'=>$this->input->get('cooperativesID')
          );
          $result = $this->cooperator_model->edit_is_name_unique_laboratories($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('laboratories_cooperators');
        }
      }
  }

  public function check_edit_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->input->get('cooperatorID'),
            'cooperativesID'=>$this->input->get('cooperativesID')
          );
          $result = $this->cooperator_model->edit_is_position_available_laboratories($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  function get_post_cooperator_info($id){
    if($this->input->method(TRUE)==="GET"){
      redirect('cooperatives');
    }else if($this->input->method(TRUE)==="POST"){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
              $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
              echo json_encode($data);
          }else{
            $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
            redirect('cooperatives/'.$this->input->post('cooperativeID').'/cooperators');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else if($this->session->userdata('access_level')!=1){
            redirect('cooperatives');
          }else{
            $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
            $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
            echo json_encode($data);
          }
        }
      }else{
        show_404();
      }
    }
  }

  public function cooperative_info_details()
  {
       if(!$this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
      else
      {
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('laboratories_cooperatives');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $decoded_coop_id= $this->encryption->decrypt(decrypt_custom($this->input->post('coop_ids')));
            $result = $this->laboratories_cooperator_model->get_cooperative_details($decoded_user_id,$decoded_coop_id);
            // echo json_encode($this->db->last_query());
             echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }

  }

  public function get_cooperative_info_edit(){
      if(!$this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
      else
      {
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('laboratories_cooperatives');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));

            $result = $this->laboratories_cooperator_model->get_cooperative_info_edit($decoded_user_id,$decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
   

   }

  public function coop_info($regNo){
      // $regno = $this->encryption->decrypt(decrypt_custom($regNo));
      $data = $this->laboratories_model->get_coop($regNo);
      echo $this->db->last_query();
    }

}//end of class
