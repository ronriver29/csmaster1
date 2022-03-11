<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_cooperators extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("amendment_capitalization_model");
    $this->load->model("amendment_cooperator_model");
  }
  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
          $cooperative_id = $this->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                $data['has_new_regular'] = $this->amendment_cooperator_model->has_new_amendment_cptr($decoded_id,'Regular');
                $data['has_new_associate'] = $this->amendment_cooperator_model->has_new_amendment_cptr($decoded_id,'Associate');
                if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['requirements_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                    // var_dump( $data['requirements_complete']);
                    $data['check_if_equal_shares_paid'] =$this->amendment_cooperator_model->check_equal_shares($decoded_id);//modified
                    // var_dump( $data['check_if_equal_shares_paid']);
                    $data['directors_count'] = $this->amendment_cooperator_model->check_no_of_directors($cooperative_id,$decoded_id);

                    $data['directors_count_odd'] = $this->amendment_cooperator_model->check_directors_odd_number($cooperative_id,$decoded_id);
                    $data['total_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$decoded_id);
                    $data['chairperson_count'] = $this->amendment_cooperator_model->check_chairperson($cooperative_id,$decoded_id);
                    $data['associate_not_exists'] = $this->amendment_cooperator_model->check_associate_not_exists($cooperative_id,$decoded_id);
                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                    $count_cap = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id_count($decoded_id);
                    if($count_cap>0){
                        $data['capitalization_info'] = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id($decoded_id);
                    } else {
                        $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id);
                    }
                    
                    $capitalization_info = $data['capitalization_info'];
                    // $this->debug(  $data['capitalization_info']);
                    $data['minimum_regular_subscription'] = $this->amendment_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$decoded_id);
                    // $this->debug( $data['minimum_regular_subscription']);
                    // echo $this->db->last_query();
                    $data['minimum_regular_pay'] = $this->amendment_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$decoded_id);
                   if($data['bylaw_info']->kinds_of_members!=1)
                    { 
                    $data['minimum_associate_subscription'] = $this->amendment_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$decoded_id);
                    // echo $this->db->last_query();
                    // var_dump( $data['minimum_associate_subscription']);
                    }
                 
                 //    echo $this->db->last_query();
                    $data['minimum_associate_pay']='';
                    if($data['bylaw_info']->kinds_of_members!=1)
                    {
                        $data['minimum_associate_pay'] = $this->amendment_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$decoded_id);
                    }
                  
          
                    $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                    $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                    $data['check_regular_paid'] = $this->amendment_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->amendment_cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->amendment_cooperator_model->check_vicechairperson($cooperative_id,$decoded_id);
                    $data['treasurer_count'] = $this->amendment_cooperator_model->check_treasurer($cooperative_id,$decoded_id);
                    $data['secretary_count'] = $this->amendment_cooperator_model->check_secretary($cooperative_id,$decoded_id);
                    $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                    // $this->debug($data['list_cooperators']);

                    $data['list_cooperators_count'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular_count($cooperative_id,$decoded_id);

                    $data['list_cooperators_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$decoded_id);
                    $data['list_cooperators_associate_count'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate_count($decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$decoded_id);

                    $data['count_cooperators_total'] =$this->amendment_cooperator_model->count_total_cptr_capitalization($decoded_id);
                    $data['total_reg_assoc_cptr'] =  $data['list_cooperators_count'] +  $data['list_cooperators_associate_count'];
                    $data['count_matching']= false;
                    if( $data['total_reg_assoc_cptr'] < $data['count_cooperators_total'])
                    {
                      $data['count_matching'] =true;
                    }
                      $data['ten_percent']=$this->amendment_cooperator_model->ten_percent($decoded_id);
          
                    $this->load->view('./template/header', $data);
                    $this->load->view('cooperators/amendment_cooperators_list', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('cooperators/amendment_delete_form_cooperator');
                    $this->load->view('./template/footer');
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            $access_array = array(1,2);
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if(!in_array($this->session->userdata('access_level'),$access_array)){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['requirements_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                        $data['directors_count'] = $this->amendment_cooperator_model->check_no_of_directors($cooperative_id,$decoded_id);
                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($cooperative_id,$decoded_id);
                        $data['total_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$decoded_id);
                        $data['chairperson_count'] = $this->amendment_cooperator_model->check_chairperson($cooperative_id,$decoded_id);
                        $data['associate_not_exists'] = $this->amendment_cooperator_model->check_associate_not_exists($cooperative_id,$decoded_id);
                        $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                        $data['minimum_regular_subscription'] = $this->amendment_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$decoded_id);
                        $data['minimum_regular_pay'] = $this->amendment_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$decoded_id);
                        if($data['bylaw_info']->kinds_of_members!=1)
                        { 
                        $data['minimum_associate_subscription'] = $this->amendment_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$decoded_id);
                        $data['minimum_associate_pay'] = $this->amendment_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$decoded_id);
                        }
                        
                        $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                        $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                        $data['check_regular_paid'] = $this->amendment_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->amendment_cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                        $data['vice_count'] = $this->amendment_cooperator_model->check_vicechairperson($cooperative_id,$decoded_id);
                        $data['treasurer_count'] = $this->amendment_cooperator_model->check_treasurer($cooperative_id,$decoded_id);
                        $data['secretary_count'] = $this->amendment_cooperator_model->check_secretary($cooperative_id,$decoded_id);
                        $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                        $data['ten_percent']=$this->amendment_cooperator_model->ten_percent($decoded_id);
                        $data['list_cooperators_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$decoded_id);
                          $data['check_if_equal_shares_paid'] =$this->amendment_cooperator_model->check_equal_shares($decoded_id);//modified    
                      $data['list_cooperators_count'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular_count($cooperative_id,$decoded_id);
                    $data['list_cooperators_associate_count'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_associate_count($decoded_id);
                              
                          $data['total_reg_assoc_cptr'] =  $data['list_cooperators_count'] +  $data['list_cooperators_associate_count'];

                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('cooperators/amendment_cooperators_list', $data);
                        $this->load->view('cooperators/full_info_modal_cooperator');
                        $this->load->view('cooperators/amendment_delete_form_cooperator');
                        $this->load->view('./templates/admin_footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }
  //modified
//   public function check_equal_shares($amendment_id)
//   {
//     $query= $this->db->query("select cap.total_no_of_subscribed_capital as cap_total_subscribed_capital,
//       cap.total_no_of_paid_up_capital as cap_total_paidup_capital,
// sum(amendment_cooperators.number_of_subscribed_shares) as coop_total_subscribed_shares,
// sum(amendment_cooperators.number_of_paid_up_shares) as coop_total_paid_up
// from amendment_capitalization as cap
// left join amendment_cooperators on cap.amendment_id = amendment_cooperators.amendment_id
//  where cap.amendment_id='$amendment_id'");
//     if($query->num_rows()>0)
//     {
//       foreach($query->result_array() as $row)
//       {
//         if($row['cap_total_subscribed_capital']==$row['coop_total_subscribed_shares'] && $row['cap_total_paidup_capital']==$row['coop_total_paid_up'])
//         {
//           return true;
//         }
//         else
//         {
//           return false;
//         }
//       }
//     }
//     else
//     {
//       return false;
//     }
//   }

  function add($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
           $cooperative_id = $this->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $new=1;
                if($this->amendment_cooperator_model->check_if_exist_orig_coop($this->input->post('fName'),$cooperative_id))
                {
                  $new = 0;
                }  
                var_dump($new);
                $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if($data['bylaw_complete']){
                  if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                   // if($this->form_validation->run() == FALSE){
                    if($this->input->post('fName')) {
                       $dateIssued_ = '';
                          if($this->input->post('dateIssued'))
                          {
                             $dateIssued_ =$this->input->post('dateIssued');
                          }
                          if($this->input->post('dateIssued_chks'))
                          {
                            $dateIssued_  = $this->input->post('dateIssued_chks');
                          }

                      $data = array( 
                        'cooperatives_id' => $cooperative_id,
                        'amendment_id' => $decoded_id,
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
                        'proof_date_issued' => $dateIssued_,
                        'place_of_issuance' =>$this->input->post('placeIssuance'),
                        'new'=> $new
                        );
                      // $this->debug($data);
                      $success = $this->amendment_cooperator_model->add_cooperator($data);
                      if($success['success']){
                        $this->session->set_flashdata('cooperator_success', $success['message']);
                        redirect('amendment/'.$id.'/amendment_cooperators');
                      }else{
                        $this->session->set_flashdata('cooperator_error', $success['message']);
                        redirect('amendment/'.$id.'/amendment_cooperators');
                      }

                    }else{ 
                      $data['client_info'] = $this->user_model->get_user_info($user_id);
                      $data['title'] = 'List of Cooperators';
                      $data['header'] = 'Cooperators';
                      $data['encrypted_id'] = $id;
                      $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                      // $this->debug($data['coop_info']);
                      if($data['coop_info']->area_of_operation == 'Interregional'){
                       
                        $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                      } else {
                        $data['regions_list'] = $this->region_model->get_regions();
                      }
                  

                      $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                      $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id);
                      $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                      $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                      $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                      $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                      $this->load->view('./template/header', $data);
                      $this->load->view('cooperators/amendment_add_form_cooperator', $data);
                      $this->load->view('./template/footer');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
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
                        $this->load->view('cooperators/amendment_add_form_cooperator', $data);
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
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                        }else{
                          $this->session->set_flashdata('cooperator_error', $success['message']);
                          redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_cooperators');
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Adding cooperator is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          show_404();
        }
    }
  }
  function edit($id = null,$cooperator_id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->coop_dtl($decoded_id);
        $data['cooperative_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));

        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                // $this->debug($data['coop_info']);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if($data['bylaw_complete']){
                    $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                    if($this->amendment_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$decoded_id,$decoded_cooperator_id)){ //check if cooperator is in cooperative
                        if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                          
                          if($this->input->post('cooperative_id')){
//                              exit;
                              $temp = TRUE;
//                              echo '<script>alert("wow");</script>';
                          } else {
                              $temp = FALSE;
//                              echo '<script>alert("www");</script>';
                          }
                          
                        if($temp == FALSE){
                          $data['client_info'] = $this->user_model->get_user_info($user_id);
                          $data['title'] = 'List of Cooperators';
                          $data['header'] = 'Cooperators';
                          $data['encrypted_id'] = $id;

                           if($data['coop_info']->area_of_operation == 'Interregional'){
                       
                            $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                          } else {
                            $data['regions_list'] = $this->region_model->get_regions();
                          }
                          $data['encrypted_cooperator_id'] = $cooperator_id;
                          $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                           $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                          $data['cooperator_info'] = $this->amendment_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$decoded_cooperator_id);  // echo $this->db->last_query()
                           $data['cooperator_info_orig'] = $this->amendment_cooperator_model->get_cooperator_info_orig($data['cooperator_info']->full_name);
                          
                          $data['is_original_cptr'] = $this->amendment_cooperator_model->check_edit_id_orig_cptr($data['cooperator_info']->full_name,$cooperative_id);
                          // echo $this->db->last_query();
                           $data['is_original_cooperator'] ='false';
                          if($data['is_original_cptr'])
                          {
                            $data['is_original_cooperator'] = 'true';
                          }
                          $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id);
                          $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);

                          if(strlen($data['client_info']->regno) ==0)
                          {
                             $data['regNo'] =$this->amendment_model->load_regNo($user_id);
                          }
                          else
                          {
                             $data['regNo'] = $this->amendment_model->load_regNo_reg($user_id);
                          }

                          if($this->amendment_model->if_had_amendment_new($data['regNo']))
                          {
                             $last_amendment_info = $this->amendment_model->get_last_amendment_info($cooperative_id,$decoded_id);
                             $data['last_share_amount']=$this->amendment_cooperator_model->get_last_amount_share_amd($data['cooperator_info']->full_name,$last_amendment_info->id);

                          }
                          else
                          { 
                            $data['last_share_amount']=$this->amendment_cooperator_model->get_last_amount_share_coop($data['cooperator_info']->full_name);
                          }

                          $data['list_cooperators'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                           $data['list_cooperators_orig'] = $this->cooperator_model->get_all_cooperator_of_coop($cooperative_id);
                      
                          $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['cooperator_info']->rCode);
                          $data['list_of_cities'] = $this->amendment_model->get_cities($data['cooperator_info']->pCode);
                          $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['cooperator_info']->cCode);
                          $this->load->view('./template/header', $data);
                          $this->load->view('cooperators/amendment_edit_form_cooperator', $data);
                          $this->load->view('./template/footer');
                        }else{
//                                exit;
                          $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
                          $dateIssued_ = '';
                          if($this->input->post('dateIssued'))
                          {
                             $dateIssued_ =$this->input->post('dateIssued');
                          }
                          if($this->input->post('dateIssued_chk'))
                          {
                            $dateIssued_  = $this->input->post('dateIssued_chk');
                          }
                          $data = array(
                            'id'=> $decoded_post_cooperator_id ,
                            'amendment_id'=>$decoded_id,
                            'full_name' => $this->input->post('fName'),
                            'gender' => $this->input->post('gender'),
                            'position' => $this->input->post('position'),
                            'type_of_member' => $this->input->post('membershipType'),
                            'birth_date' => $this->input->post('bDate'),
                            'house_blk_no'=> $this->input->post('blkNo'),
                            'streetName'=> $this->input->post('streetName'),
                            'addrCode' => $this->input->post('addr_barangay'), // $this->input->post('barangay'),
                            'number_of_subscribed_shares' =>$this->input->post('amd_subscribedShares'),
                            'number_of_paid_up_shares' =>$this->input->post('paidShares'),
                            'proof_of_identity' =>$this->input->post('validIdType'),
                            'proof_of_identity_number' =>$this->input->post('validIdNo'),
                            'proof_date_issued' => $dateIssued_,
                            'place_of_issuance' =>$this->input->post('placeIssuance'),
                            );
                      
                          // $this->debug($data);
                          $success = $this->amendment_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data,$decoded_id);
                          // $this->debug($success);
                          if($success['success']){
                            $this->session->set_flashdata('cooperator_success', $success['message']);
                            redirect('amendment/'.$id.'/amendment_cooperators');
                          }else{
                            $this->session->set_flashdata('cooperator_error', $success['message']);
                            redirect('amendment/'.$id.'/amendment_cooperators');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                      redirect('amendment/'.$id.'/amendment_cooperators');
                    }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                        $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                        if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_cooperator_id)){
                            if(isset($_POST['editCooperatorBtn'])){
                              $temp = TRUE;
                              echo '<script>alert("www");</script>';
                          } else {
                              $temp = FALSE;
                              echo '<script>alert("www");</script>';
                          }
                            if($temp == FALSE){
                              $data['title'] = 'List of Cooperators';
                              $data['header'] = 'Cooperators';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_cooperator_id'] = $cooperator_id;
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($decoded_cooperator_id);
                              $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                              $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                              $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                              $this->load->view('./templates/admin_header', $data);
                              $this->load->view('cooperators/amendment_edit_form_cooperator', $data);
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
                              $success = $this->amendment_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data);
                              if($success['success']){
                                $this->session->set_flashdata('cooperator_success', $success['message']);
                                redirect('amendment/'.$id.'/amendment_cooperators');
                              }else{
                                $this->session->set_flashdata('cooperator_error', $success['message']);
                                redirect('amendment/'.$id.'/amendment_cooperators');
                              }
                            }
                      }else{
                        $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                        redirect('amendment/'.$id.'/amendment_cooperators');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                  redirect('amendment');
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
        $cooperative_id = $this->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
           
              if($this->amendment_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$decoded_id,$decoded_post_cooperator_id)){
                // if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                
                  $success = $this->amendment_cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                  }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                //   redirect('amendment/');
                // }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
              }
            }else{

              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.sss');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }else{
                    $success = $this->amendment_cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                    if($success){
                      $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                    }else{
                      $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                    }
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'Deleting a cooperator of the cooperative is not available because the cooperative is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }else{
                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
                redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
              }
            }
          }
        }else{
          redirect('amendment');
        }
      }else{
        redirect('amendment');
      }
    }
  }
  function all(){

    if($this->input->method(TRUE)==="GET"){
      redirect('amendment');
    }else if($this->input->method(TRUE)==="POST"){
      $uid = $this->session->userdata('user_id');
      $cooperatives_id = $this->amendment_model->get_cooperative_info($uid)->id;
      $cooperators = $this->amendment_model->get_all_cooperator_of_coop($cooperatives_id);
      $temp['data'] = $cooperators;
      echo json_encode($temp);
    }

  }
  public function check_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperative_id') && $this->input->get('amd_id')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperative_id'=>$this->input->get('cooperative_id'),
            'amendment_id'=>$this->input->get('amd_id')
          );
          $result = $this->amendment_cooperator_model->is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  public function check_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{

         // echo json_encode( $this->input->get('cooperative_id'));
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperative_id') && $this->input->get('amd_id') ){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatives_id'=>$this->input->get('cooperative_id'),
            'amendment_id'=>$this->input->get('amd_id')
          );
          $result = $this->amendment_cooperator_model->is_position_available($data);
          echo json_encode($result);
          // echo json_encode( $this->input->get('cooperatives_id'));
        }else{
          echo"unauthenticated";
          // $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          // redirect('cooperators');
        }
      }
  }

  public function check_position_not_exist_edit(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        echo"as;ldfkj";
        // $input_position = $this->input->get('');
        // $input_amendment_id = $this->input->get();
        // $input_cooperative_id = $this->input->get();
        // $cooperator_id = $this->input->get('fieldValue');
        // echo json_encode($input_position.' '.$input_position.' '.$input_cooperative_id.' '. $cooperator_id);
        // $query = $this->db->get_where('amendment_cooperators',)
         // echo json_encode( $this->input->get('cooperative_id'));
        // if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperative_id') && $this->input->get('amd_id') ){
        //   $data = array(
        //     'fieldId'=>$this->input->get('fieldId'),
        //     'fieldValue'=>$this->input->get('fieldValue'),
        //     'cooperatives_id'=>$this->input->get('cooperative_id'),
        //     'amendment_id'=>$this->input->get('amd_id')
        //   );
        //   $result = $this->amendment_cooperator_model->is_position_available($data);
        //   echo json_encode($result);
        
        // }else{
        //   echo"unauthenticated";
        
        // }
      }
  }

  // public function check_edit_cooperator_not_exist(){
  //    if(!$this->session->userdata('logged_in')){
  //       redirect('users/login');
  //     }else{
  //       if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperativesID')){
  //         $data = array(
  //           'fieldId'=>$this->input->get('fieldId'),
  //           'fieldValue'=>$this->input->get('fieldValue'),
  //           'cooperatorID'=>$this->input->get('cooperatorID'),
  //           'cooperativesID'=>$this->input->get('cooperativesID')
  //         );
  //         $result = $this->cooperator_model->edit_is_name_unique($data);
  //         echo json_encode($result);
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }
//modified
    public function check_edit_cooperator_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperative_id') && $this->input->get('amd_id')){

          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperatorID'))),
            'cooperative_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperative_id'))),
            'amendment_id' => $this->encryption->decrypt(decrypt_custom($this->input->get('amd_id')))
          );
          // echo json_encode($data);
        
          $where = array('cooperatives_id'=>$data['cooperative_id'],'amendment_id'=>$data['amendment_id'],'full_name'=>$data['fieldValue'],'id'=>$data['cooperatorID']);
          $qry_nochanges = $this->db->get_where('amendment_cooperators',$where);
          if($qry_nochanges->num_rows()>0)
          {
            echo json_encode(array($data['fieldId'],true));
          }
          else
          {
              $result = $this->amendment_cooperator_model->edit_is_name_unique($data);
          echo json_encode($result);
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }


  public function check_edit_position_not_exist(){
     if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperatorID') && $this->input->get('cooperative_id') && $this->input->get('amd_id')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'cooperatorID'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperatorID'))),
            'cooperative_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('cooperative_id'))),
            'amendment_id'=>$this->encryption->decrypt(decrypt_custom($this->input->get('amd_id')))

          );
         
          $where = array('id'=>$data['cooperatorID'],'cooperatives_id'=>$data['cooperative_id'],'amendment_id'=>$data['amendment_id'],'position'=>$data['fieldValue']);
          $nochanges_qry = $this->db->get_where('amendment_cooperators',$where);
          if($nochanges_qry->num_rows()>0)
          {
            echo json_encode(array($data['fieldId'],true));
          }
          else
          {
             $result = $this->amendment_cooperator_model->edit_is_position_available($data);
                // $qry = $this->db->get('amendment_cooperators');
                // if($qry->num_rows()>0)
                // {
                //     foreach($qry->result_array() as $row)
                //     {
                //          $row['status']='';
                //         if(strcasecmp($row['position'],$data['fieldValue'])==0 && $row['cooperatives_id']==$data['cooperative_id'] && $row['amendment_id']==$data['amendment_id'])
                //         {
                //             $row['status']='false';
                //         }
                //         else
                //         {
                //             $row['status']='true';
                //         }
                //         $arry_status[]=$row['status'];
                //     }
                //     if(in_array('false', $arry_status))
                //     {
                //          echo json_encode(array($data['fieldId'],false));  
                //     }
                //     else
                //     {
                //          echo json_encode(array($data['fieldId'],true));
                //     }
                // }
                // else
                // {
                //       echo json_encode(array($data['fieldId'],true));
                // }
             echo json_encode($result);
             // echo $this->db->last_query();
          }//no changes query   
         
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperators');
        }
      }
  }

  function get_post_cooperator_info($id){
    if($this->input->method(TRUE)==="GET"){
      redirect('amendment');
    }else if($this->input->method(TRUE)==="POST"){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
              $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
              echo json_encode($data);
          }else{
            $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
            redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else if($this->session->userdata('access_level')!=1){
            redirect('amendment');
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
  function get_post_cooperator_info_ajax(){
    if($this->input->method(TRUE)==="GET"){
      redirect('amendment');
    }else if($this->input->method(TRUE)==="POST"){
     $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id')));
     $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_ids')));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->coop_dtl($decoded_id);
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
              $data = $this->amendment_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$decoded_post_coop_id);
              echo json_encode($data);
          }else{
            $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
            redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else if($this->session->userdata('access_level')!=1){
            redirect('amendment');
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
            $cooperative_id = $this->coop_dtl($decoded_id);
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->amendment_model->get_cooperative_info($cooperative_id,$decoded_user_id,$decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }

  //   function get_post_cooperator_info($id){
  //   if($this->input->method(TRUE)==="GET"){
  //     redirect('amendment');
  //   }else if($this->input->method(TRUE)==="POST"){
  //     $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
  //     $user_id = $this->session->userdata('user_id');
  //     if(is_numeric($decoded_id) && $decoded_id!=0){
  //       if($this->session->userdata('client')){
  //         if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
  //             $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
  //             $data = $this->amendment_cooperator_model->get_cooperator_info($decoded_post_coop_id);
  //             echo json_encode($data);
  //         }else{
  //           $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
  //           redirect('amendment/'.$this->input->post('cooperativeID').'/cooperators');
  //         }
  //       }else{
  //         if($this->session->userdata('access_level')==5){
  //           redirect('admins/login');
  //         }else if($this->session->userdata('access_level')!=1){
  //           redirect('amendment');
  //         }else{
  //           $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));
  //           $data = $this->cooperator_model->get_cooperator_info($decoded_post_coop_id);
  //           echo json_encode($data);
  //         }
  //       }
  //     }else{
  //       show_404();
  //     }
  //   }
  // }

    public function debug($array)
    {
      echo"<pre>";
      print_r($array);
      echo"</pre>";
    }
}
