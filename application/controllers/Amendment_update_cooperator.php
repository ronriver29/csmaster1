<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Amendment_update_cooperator extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    // $this->load->model("amendment_capitalization_model");
    $this->load->model("amendment_update_cooperator_model");
     // $this->output->cache(30);
  }
  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{//$this->output->enable_profiler(TRUE);
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $config["base_url"] = base_url()."amendment_update/".$id."/amendment_cooperators";
        $config["total_rows"] = $this->amendment_update_cooperator_model->regular_cooperators_count($cooperative_id,$decoded_id);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
          $this->benchmark->mark('code_start'); 
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
                $data['has_new_regular'] =false;
                $data['has_new_associate'] = false;
                $data['has_new_regular'] = $this->amendment_update_cooperator_model->has_new_amendment_cptr($decoded_id,'Regular');
                $data['has_new_associate'] = $this->amendment_update_cooperator_model->has_new_amendment_cptr($decoded_id,'Associate');
                // if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['requirements_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                    
                    // $data['check_if_equal_shares_paid'] =$this->amendment_update_cooperator_model->check_equal_shares($decoded_id);//modified
                     $data['check_if_equal_shares_paid'] = $this->cooperator->check_equal_shares($decoded_id);
                    
                    $data['directors_count'] = $this->cooperator->check_no_of_directors($cooperative_id,$decoded_id);

                    // $data['directors_count_odd'] = $this->amendment_update_cooperator_model->check_directors_odd_number($cooperative_id,$decoded_id);
                      $data['directors_count_odd'] = $this->cooperator->check_directors_odd_number($cooperative_id,$decoded_id);
                    // $data['total_directors'] = $this->amendment_update_cooperator_model->no_of_directors($cooperative_id,$decoded_id);
                      $data['total_directors'] = $this->cooperator->no_of_directors($cooperative_id,$decoded_id);
                    // $data['chairperson_count'] = $this->amendment_update_cooperator_model->check_chairperson($cooperative_id,$decoded_id);
                      $data['chairperson_count'] = $this->cooperator->check_chairperson($cooperative_id,$decoded_id);
                    // $data['associate_not_exists'] = $this->amendment_update_cooperator_model->check_associate_not_exists($cooperative_id,$decoded_id);
                      $data['associate_not_exists'] = $this->cooperator->check_associate_not_exists($cooperative_id,$decoded_id);
                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                    $count_cap = $this->amendment_update_capitalization_model->amend_get_capitalization_by_coop_id_count($decoded_id);
                    if($count_cap>0){
                        $data['capitalization_info'] = $this->amendment_capitalization_model->amend_get_capitalization_by_coop_id($decoded_id);
                    } else {
                        $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id);
                    }
                    
                    $capitalization_info = $data['capitalization_info'];
                    // $this->debug(  $data['capitalization_info']);
                    $data['minimum_regular_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$decoded_id);
                    // $this->debug( $data['minimum_regular_subscription']);
                    // echo $this->db->last_query();
                    $data['minimum_regular_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$decoded_id);
                   if($data['bylaw_info']->kinds_of_members!=1)
                    { 
                    $data['minimum_associate_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$decoded_id);
                    // echo $this->db->last_query();
                    // var_dump( $data['minimum_associate_subscription']);
                    }
                 
                 //    echo $this->db->last_query();
                    $data['minimum_associate_pay']='';
                    if($data['bylaw_info']->kinds_of_members!=1)
                    {
                        $data['minimum_associate_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$decoded_id);
                    }
                  
          
                    // $data['total_regular'] = $this->amendment_update_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                     $data['total_regular'] = $this->cooperator->get_total_regular($cooperative_id,$decoded_id);
                    // $data['total_associate'] = $this->amendment_update_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                     $data['total_associate'] = $this->cooperator->get_total_associate($cooperative_id,$decoded_id);
                    $data['check_regular_paid'] = $this->amendment_update_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->cooperator->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->cooperator->check_vicechairperson($cooperative_id,$decoded_id);
                    $data['treasurer_count'] = $this->cooperator->check_treasurer($cooperative_id,$decoded_id);
                    $data['secretary_count'] = $this->cooperator->check_secretary($cooperative_id,$decoded_id);
                    $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                    // $this->debug($data['list_cooperators']);

                    $data['list_cooperators_count'] = $this->cooperator->get_all_cooperator_of_coop_regular_count($cooperative_id,$decoded_id);
                  
                    $data['list_cooperators_regular'] = $this->cooperator->get_all_cooperator_of_coop_regular($cooperative_id,$decoded_id,$config['per_page'],$page);
                    // echo $this->db->last_query();
                   
                    $data['list_cooperators_associate_count'] = $this->cooperator->get_all_cooperator_of_coop_associate_count($decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$decoded_id);

                    $data['count_cooperators_total'] =$this->cooperator->count_total_cptr_capitalization($decoded_id);
                    $data['total_reg_assoc_cptr'] =  $data['list_cooperators_count'] +  $data['list_cooperators_associate_count'];
                    $data['count_matching']= false;
                    if($data['total_reg_assoc_cptr'] < $data['count_cooperators_total'])
                    {
                      $data['count_matching'] =true;
                    }
                      $data['ten_percent']=$this->amendment_update_cooperator_model->ten_percent($decoded_id);
                       $this->benchmark->mark('code_end');
                     $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage()); 
                    $this->load->view('./template/header', $data);
                    $this->load->view('update/amendment/cooperators/cooperator_list', $data);
                    $this->load->view('update/amendment/cooperators/upload_modal', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('update/amendment/cooperators/delete_form_cooperator');
                    $this->load->view('./template/footer');
              }else{
                redirect('amendment_update/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')!=6){
              redirect('admins/login');
            }else{
                $data['has_new_regular'] =false;

                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                 
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['requirements_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                        $data['directors_count'] = $this->amendment_update_cooperator_model->check_no_of_directors($cooperative_id,$decoded_id);
                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($cooperative_id,$decoded_id);
                        $data['total_directors'] = $this->amendment_update_cooperator_model->no_of_directors($cooperative_id,$decoded_id);
                        $data['chairperson_count'] = $this->amendment_update_cooperator_model->check_chairperson($cooperative_id,$decoded_id);
                        $data['associate_not_exists'] = $this->amendment_update_cooperator_model->check_associate_not_exists($cooperative_id,$decoded_id);
                        $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                        $data['minimum_regular_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$decoded_id);
                        $data['minimum_regular_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$decoded_id);
                        if($data['bylaw_info']->kinds_of_members!=1)
                        { 
                        $data['minimum_associate_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$decoded_id);
                        $data['minimum_associate_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$decoded_id);
                        }
                        
                        $data['total_regular'] = $this->amendment_update_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                        $data['total_associate'] = $this->amendment_update_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                        $data['check_regular_paid'] = $this->amendment_update_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->amendment_update_cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                        $data['vice_count'] = $this->amendment_update_cooperator_model->check_vicechairperson($cooperative_id,$decoded_id);
                        $data['treasurer_count'] = $this->amendment_update_cooperator_model->check_treasurer($cooperative_id,$decoded_id);
                        $data['secretary_count'] = $this->amendment_update_cooperator_model->check_secretary($cooperative_id,$decoded_id);
                        $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                        $data['ten_percent']=$this->amendment_update_cooperator_model->ten_percent($decoded_id);
                        $data['list_cooperators_regular'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$decoded_id,$config['per_page'],$page);
                    $data['list_cooperators_associate'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$decoded_id);
                          $data['check_if_equal_shares_paid'] =$this->amendment_update_cooperator_model->check_equal_shares($decoded_id);//modified    
                      $data['list_cooperators_count'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular_count($cooperative_id,$decoded_id);
                    $data['list_cooperators_associate_count'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate_count($decoded_id);
                              
                          $data['total_reg_assoc_cptr'] =  $data['list_cooperators_count'] +  $data['list_cooperators_associate_count'];

                    $this->load->view('./templates/admin_header', $data);
                    $this->load->view('update/amendment/cooperators/cooperator_list', $data);
                    $this->load->view('update/amendment/cooperators/upload_modal', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('update/amendment/cooperators/delete_form_cooperator');
                    $this->load->view('./templates/admin_footer');
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
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              // if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $new=1;
                if($this->amendment_update_cooperator_model->check_if_exist_orig_coop($this->input->post('fName'),$cooperative_id))
                {
                  $new = 0;
                }  

                
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                // if($data['bylaw_complete']){
                  // if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                   // if($this->form_validation->run() == FALSE){
                   if(isset($_POST['addCooperatorBtn'])){
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
                      $success = $this->amendment_update_cooperator_model->add_cooperator($data);
                      if($success['success']){
                        $this->session->set_flashdata('cooperator_success', $success['message']);
                        redirect('amendment_update/'.$id.'/amendment_cooperators');
                      }else{
                        $this->session->set_flashdata('cooperator_error', $success['message']);
                        redirect('amendment_update/'.$id.'/amendment_cooperators');
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
                      $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id); 
                      $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                      $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                      $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                      $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                      $this->load->view('./template/header', $data);
                      $this->load->view('update/amendment/cooperators/add_form_cooperator', $data);
                      $this->load->view('./template/footer');
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                  //   redirect('amendment_update/'.$id);
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('amendment_update/'.$id);
                // }
              // }else{
              //   redirect('amendment/'.$id);
              // }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment_update');
            }
          }else{
            if($this->session->userdata('access_level')!=6){
              redirect('admins/login');
            }else{
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                       if(!isset($_POST['addCooperatorBtn'])){
                        $data['title'] = 'List of Cooperators';
                        $data['header'] = 'Cooperators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($data['coop_info']->users_id));
                        $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id); 
                        $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                        if($data['coop_info']->area_of_operation == 'Interregional'){
                          $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                        } else {
                          $data['regions_list'] = $this->region_model->get_regions();
                        }
                        $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                        $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                        $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('update/amendment/cooperators/add_form_cooperator', $data);
                        $this->load->view('./templates/admin_footer');
                      }else{
                        $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
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
                        'new'=> 1
                        );
                        $success = $this->amendment_update_cooperator_model->add_cooperator($data);
                        if($success['success']){
                          $this->session->set_flashdata('cooperator_success', $success['message']);
                          redirect('amendment_update/'.$id.'/amendment_cooperators');
                        }else{
                          $this->session->set_flashdata('cooperator_error', $success['message']);
                          redirect('amendment_update/'.$id.'/amendment_cooperators');
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
         $data['has_new_regular'] =false;
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->coop_dtl($decoded_id);
        $data['cooperative_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));

        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              // if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                // $this->debug($data['coop_info']);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                // if($data['bylaw_complete']){
                    $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
                    if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$decoded_id,$decoded_cooperator_id)){ //check if cooperator is in cooperative
                        // if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
                          
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
                          $data['cooperator_info'] = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$decoded_cooperator_id);
                           $data['cooperator_info_orig'] = $this->amendment_update_cooperator_model->get_cooperator_info_orig($data['cooperator_info']->full_name);
                           // echo $this->db->last_query()
                          $data['is_original_cptr'] = $this->amendment_update_cooperator_model->check_edit_id_orig_cptr($data['cooperator_info']->full_name,$cooperative_id);
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

                          // if($this->amendment_model->if_had_amendment_new($data['regNo']))
                          // {
                          //    $last_amendment_info = $this->amendment_model->get_last_amendment_info($cooperative_id,$decoded_id);
                          //    $data['last_share_amount']=$this->amendment_update_cooperator_model->get_last_amount_share_amd($data['cooperator_info']->full_name,$last_amendment_info->id);

                          // }
                          // else
                          // { 
                            $data['last_share_amount']=$this->amendment_update_cooperator_model->get_last_amount_share_coop($data['cooperator_info']->full_name);
                          // }

                          $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                           $data['list_cooperators_orig'] = $this->cooperator_model->get_all_cooperator_of_coop($cooperative_id);
                      
                          $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                          $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                          $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                          $this->load->view('./template/header', $data);
                          $this->load->view('update/amendment/cooperators/edit_form_cooperator', $data);
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
                          $success = $this->amendment_update_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data,$decoded_id);
                          // $this->debug($success);
                          if($success['success']){
                            $this->session->set_flashdata('cooperator_success', $success['message']);
                            redirect('amendment_update/'.$id.'/amendment_cooperators');
                          }else{
                            $this->session->set_flashdata('cooperator_error', $success['message']);
                            redirect('amendment_update/'.$id.'/amendment_cooperators');
                          }
                        }
                      // }else{
                      //   $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                      //   redirect('amendment_update/'.$id);
                      // }
                    }else{
                      $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                      redirect('amendment_update/'.$id.'/amendment_cooperators');
                    }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('amendment_update/'.$id);
                // }
              // }else{
              //   redirect('amendment/'.$id);
              // }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment_update/'.$id);
            }
          }else{
            if($this->session->userdata('access_level')!=6){
            redirect('admins/login');
            }else{

            $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));
            $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
            $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
            $data['cooperator_info'] = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$decoded_cooperator_id); 
            $data['cooperator_info_orig'] = $this->amendment_update_cooperator_model->get_cooperator_info_orig($data['cooperator_info']->full_name);
            // echo $this->db->last_query()
            $data['is_original_cptr'] = $this->amendment_update_cooperator_model->check_edit_id_orig_cptr($data['cooperator_info']->full_name,$cooperative_id);
            // echo $this->db->last_query();
            $data['is_original_cooperator'] ='false';
            if($data['is_original_cptr'])
            {
            $data['is_original_cooperator'] = 'true';
            }
            $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id); 
            $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
            $data['bylaw_complete'] =false;// ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;


            if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$decoded_id,$decoded_cooperator_id)){

                if(!isset($_POST['editCooperatorBtn'])){
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['encrypted_cooperator_id'] = $cooperator_id;
                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                    // $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    // $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($decoded_cooperator_id);
                    $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$decoded_id);
                    $data['list_cooperators_orig'] = $this->cooperator_model->get_all_cooperator_of_coop($cooperative_id);
                    if($data['coop_info']->area_of_operation == 'Interregional'){

                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                    } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                    }
                    $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                    $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                    $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                    $this->load->view('./templates/admin_header', $data);
                    $this->load->view('update/amendment/cooperators/edit_form_cooperator', $data);
                    $this->load->view('./templates/admin_footer');
                }
                else
                {
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
                        $success = $this->amendment_update_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data,$decoded_id);
                        if($success['success']){
                            $this->session->set_flashdata('cooperator_success', $success['message']);
                             redirect('amendment_update/'.$id.'/amendment_cooperators');
                        }else{
                            $this->session->set_flashdata('cooperator_error', $success['message']);
                             redirect('amendment_update/'.$id.'/amendment_cooperators');
                        }
                }
            }else{
                $this->session->set_flashdata('cooperator_redirect', 'Unauthorized!!.');
                redirect('amendment_update/'.$id.'/amendment_cooperators');
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
           
              if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$decoded_id,$decoded_post_cooperator_id)){
                // if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                
                  $success = $this->amendment_update_cooperator_model->delete_cooperator($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID').'/amendment_cooperators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID').'/amendment_cooperators');
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
                    $success = $this->amendment_update_cooperator_model->delete_cooperator($decoded_post_cooperator_id);
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
          $result = $this->amendment_update_cooperator_model->is_name_unique($data);
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
          $result = $this->amendment_update_cooperator_model->is_position_available($data);
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
        //   $result = $this->amendment_update_cooperator_model->is_position_available($data);
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
              $result = $this->amendment_update_cooperator_model->edit_is_name_unique($data);
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
             $result = $this->amendment_update_cooperator_model->edit_is_position_available($data);
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
              $data = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$decoded_id,$decoded_post_coop_id);
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
  //             $data = $this->amendment_update_cooperator_model->get_cooperator_info($decoded_post_coop_id);
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

  public function importcptr()
    {
    if ($this->input->post('submit')) {
      $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('aid')));
      $cooperative_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cid')));
      // $path = UPLOAD_DIR;

      // $config['upload_path'] = $path;
      // $config['allowed_types'] = 'xlsx|xls|csv';
      // $config['remove_spaces'] = TRUE;
      // $this->load->library('upload', $config);
      // $this->upload->initialize($config);


      // if (!$this->upload->do_upload('uploadFile'))
      // {
      // $error = array('error' => $this->upload->display_errors());
      // }
      // else
      // {
      // $data = array('upload_data' => $this->upload->data());
      // }

      // if(empty($error))
      // {
      // if (!empty($data['upload_data']['file_name'])) {
      // $import_xls_file = $data['upload_data']['file_name'];
      // }
      // else
      // {
      // $import_xls_file = 0;
      // }
      // $inputFileName = $path . $import_xls_file;
        // try
        // {

          $upload_file =  $_FILES['excel_file']['name'];
          $extension = pathinfo($upload_file,PATHINFO_EXTENSION);
          

          if($extension == 'xlsx')
          {
            $reader =new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            // echo '<pre>'; print_r($sheetData);
            $sheetCount = count($sheetData);
            // echo $sheetCount;
            if($sheetCount>1)
            {
              for ($i=1; $i < $sheetCount; $i++) { 
                // $amendment_id = $sheetData[$i][0];
                $fullname= $sheetData[$i][0];
                $gender= $sheetData[$i][1];
                $birthday= $sheetData[$i][2];
                $houseNo= $sheetData[$i][3];
                $Street= $sheetData[$i][4];
                $AddressCode= $sheetData[$i][5];
                $position= $sheetData[$i][6];
                $Type_member= $sheetData[$i][7];
                $Number_subscribe= $sheetData[$i][8];
                $Number_paidup= $sheetData[$i][9];
                $Proof_idendity= $sheetData[$i][10];
                $Proof_idendityNo= $sheetData[$i][11];
                $Place_issuance= $sheetData[$i][12];

                $data_array[] =array(
                  'cooperatives_id'=>$cooperative_id,
                  'amendment_id'=> $amendment_id,
                  'full_name'=> $fullname,
                  'gender'=> $gender,
                  'birth_date'=> $birthday,
                  'house_blk_no'=> $houseNo,
                  'streetName'=> $Street,
                  'addrCode'=> $AddressCode,
                  'position'=> $position,
                  'type_of_member'=> $Type_member,
                  'number_of_subscribed_shares'=> $Number_subscribe,
                  'number_of_paid_up_shares'=> $Number_paidup,
                  'proof_of_identity'=> $Proof_idendity,
                  'proof_of_identity_number'=> $Proof_idendity,
                  // 'proof_date_issued'=> 
                  'place_of_issuance'=> $Place_issuance

                );
              }
              
            }
            // echo"<pre>";
            // print_r($data_array);
            if($this->db->insert_batch('amendment_cooperators',$data_array))
            {
              $this->session->set_flashdata('cooperator_success','Successfully uploaded.');
               redirect('amendment_update/'.$this->input->post('aid').'/amendment_cooperators');
            }
            else
            {
               $this->session->set_flashdata('cooperator_error','Error Encounter while uploading your file.');
                redirect('amendment_update/'.$this->input->post('aid').'/amendment_cooperators');
            }
          }
        // }
        // catch (Exception $e)
        // {
        // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
        // . '": ' .$e->getMessage());
        // }
      // }
      // else
      // {
      // echo $error['error'];
      // }
    }//end of submit
    
   } //end of public

  
    public function export()
   {
    // $amendment_id =$this->encryption->decrypt(decrypt_custom($id));
  $filename = "Cooperators form". date("Y-m-d-H-i-s").'.xlsx';
  // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  ob_end_clean();
  header('Content-Type: application/vnd.ms-excel'); 
    // header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
  $spreadsheet = new Spreadsheet();
  // $sheet = $spreadsheet->getActiveSheet();
  $spreadsheet->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
  // $spreadsheet->getActiveSheet()->SetCellValue('A1', 'Coop ID');
  $spreadsheet->getActiveSheet()->SetCellValue('A1', 'fullname');
  $spreadsheet->getActiveSheet()->SetCellValue('B1', 'Gender');
  $spreadsheet->getActiveSheet()->SetCellValue('C1', 'Birthday');
  $spreadsheet->getActiveSheet()->SetCellValue('D1', 'House No.');
  $spreadsheet->getActiveSheet()->SetCellValue('E1', 'Street');
  $spreadsheet->getActiveSheet()->SetCellValue('F1', 'AddressCode');
  $spreadsheet->getActiveSheet()->SetCellValue('G1', 'Position');
  $spreadsheet->getActiveSheet()->SetCellValue('H1', 'Type of Member');
  $spreadsheet->getActiveSheet()->SetCellValue('I1', 'Number of Subscribe Shares');
  $spreadsheet->getActiveSheet()->SetCellValue('J1', 'Number of Paid up Shares');
  $spreadsheet->getActiveSheet()->SetCellValue('K1', 'Proof of Idendity');
  $spreadsheet->getActiveSheet()->SetCellValue('L1', 'Proof of Idendity No.');
  $spreadsheet->getActiveSheet()->SetCellValue('M1', 'Proof of Idendity date issued');
  $spreadsheet->getActiveSheet()->SetCellValue('N1', 'Place of Issuance');
  $writer = new Xlsx($spreadsheet);
  // $writer->save($filename.'.xlsx');
  $writer->save("php://output");
   }

   // public function test()
   // {
   //  $this->load->library('cooperator');
   //  var_dump($this->cooperator->select_test());
   // }
    public function debug($array)
    {
      echo"<pre>";
      print_r($array);
      echo"</pre>";
    }


}
