<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Amendment_update_cooperator extends CI_Controller{

  public $decoded_id=null;

  public function __construct()

  {

    parent::__construct();

    //Codeigniter : Write Less Do More

    // $this->load->model("amendment_capitalization_model");

    $this->load->model("amendment_update_cooperator_model");
    $this->load->model("user_model");
    $this->load->model("admin_model");
    $this->load->model("amendment_update_model");
    $this->load->model('amendment_update_bylaw_model');
    $this->load->model('amendment_update_capitalization_model');

  }

  function index($id = null)
  {

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);
        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(!$this->amendment_update_cooperator_model->check_if_no_addrCode($this->decoded_id))
        {
            $count_cptr = $this->amendment_update_cooperator_model->regular_cooperators_count($cooperative_id,$this->decoded_id);
        }
        else
        {
             $count_cptr = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular_inc_count($cooperative_id,$this->decoded_id);
          
        }
                    
        $config["base_url"] = base_url()."amendment_update/".$id."/amendment_cooperators";
        $config["total_rows"] =  $count_cptr ;
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
        $data["links"] = $this->pagination->create_links();
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){
                    $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);
                    $data['has_new_regular'] =false;
                    $data['has_new_associate'] = false;
                    $data['has_new_regular'] = $this->amendment_update_cooperator_model->has_new_amendment_cptr($this->decoded_id,'Regular');
                    $data['has_new_associate'] = $this->amendment_update_cooperator_model->has_new_amendment_cptr($this->decoded_id,'Associate');
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Cooperators';
                    $data['header'] = 'Cooperators';
                    $data['encrypted_id'] = $id;
                    $data['requirements_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                    $data['check_if_equal_shares_paid'] = $this->cooperator->check_equal_shares($this->decoded_id);
                    $data['directors_count'] = $this->cooperator->check_no_of_directors($cooperative_id,$this->decoded_id);
                    $data['directors_count_odd'] = $this->cooperator->check_directors_odd_number($cooperative_id,$this->decoded_id);
                    $data['total_directors'] = $this->cooperator->no_of_directors($cooperative_id,$this->decoded_id);
                    $data['chairperson_count'] = $this->cooperator->check_chairperson($cooperative_id,$this->decoded_id);
                    $data['associate_not_exists'] = $this->cooperator->check_associate_not_exists($cooperative_id,$this->decoded_id);
                    $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                    $count_cap = $this->amendment_update_capitalization_model->amend_get_capitalization_by_coop_id_count($this->decoded_id);
                    if($count_cap>0){
                    $data['capitalization_info'] = $this->amendment_update_capitalization_model->amend_get_capitalization_by_coop_id($this->decoded_id);
                    } else {
                    $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                    }

                    $capitalization_info = $data['capitalization_info'];
                    $data['minimum_regular_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$this->decoded_id);
                    $data['minimum_regular_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$this->decoded_id);

                    if($data['bylaw_info']->kinds_of_members!=1)
                    {
                    $data['minimum_associate_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$this->decoded_id);
                    }
                    $data['minimum_associate_pay']='';
                    if($data['bylaw_info']->kinds_of_members!=1)
                    {
                    $data['minimum_associate_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$this->decoded_id);
                    }

                    $data['total_regular'] = $this->cooperator->get_total_regular($cooperative_id,$this->decoded_id);
                    $data['total_associate'] = $this->cooperator->get_total_associate($cooperative_id,$this->decoded_id);
                    $data['check_regular_paid'] = $this->amendment_update_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                    $data['check_with_associate_paid'] = $this->cooperator->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                    $data['vice_count'] = $this->cooperator->check_vicechairperson($cooperative_id,$this->decoded_id);
                    $data['treasurer_count'] = $this->cooperator->check_treasurer($cooperative_id,$this->decoded_id);
                    $data['secretary_count'] = $this->cooperator->check_secretary($cooperative_id,$this->decoded_id);
                    $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                    $data['list_cooperators_count'] = $this->cooperator->get_all_cooperator_of_coop_regular_count($cooperative_id,$this->decoded_id);
                   if(!$this->amendment_update_cooperator_model->check_if_no_addrCode($this->decoded_id))
                   {
                    // $data['list_cooperators_regular'] = $this->cooperator->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id,$config['per_page'],$page);
                    $data['list_cooperators_regular'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id,$config['per_page'],$page); 
                   }
                   else
                   { 
                    $data['list_cooperators_regular'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular_inc($cooperative_id,$this->decoded_id,$config['per_page'],$page); 
                   }
                   
                    $data['list_cooperators_associate_count'] = $this->cooperator->get_all_cooperator_of_coop_associate_count($this->decoded_id);
                    $data['list_cooperators_associate'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$this->decoded_id);
                    $data['count_cooperators_total'] =$this->cooperator->count_total_cptr_capitalization($this->decoded_id);
                    $data['total_reg_assoc_cptr'] =  $data['list_cooperators_count'] +  $data['list_cooperators_associate_count'];
                    $data['count_matching']= false;

                    if($data['total_reg_assoc_cptr'] < $data['count_cooperators_total'])
                    {
                    $data['count_matching'] =true;
                    }
                    $data['ten_percent']=$this->amendment_update_cooperator_model->ten_percent($this->decoded_id);
                    $this->load->view('./template/header', $data);
                    $this->load->view('update/amendment/cooperators/cooperator_list', $data);
                    $this->load->view('update/amendment/cooperators/upload_modal', $data);
                    $this->load->view('cooperators/full_info_modal_cooperator');
                    $this->load->view('update/amendment/cooperators/delete_form_cooperator');
                    $this->load->view('./template/footer');
          }else{

            if($this->session->userdata('access_level')!=6){

              redirect('admins/login');

            }else{
                $this->load->model('admin_model');    
                $this->load->model('region_model');
                $data['has_new_regular'] =false;



                  $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($this->decoded_id);

                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                 

                        $data['title'] = 'List of Cooperators';

                        $data['header'] = 'Cooperators';

                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                        $data['encrypted_id'] = $id;

                        $data['requirements_complete'] = $this->amendment_update_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);

                        $data['directors_count'] = $this->amendment_update_cooperator_model->check_no_of_directors($cooperative_id,$this->decoded_id);

                        $data['directors_count_odd'] = $this->amendment_update_cooperator_model->check_directors_odd_number($cooperative_id,$this->decoded_id);

                        $data['total_directors'] = $this->amendment_update_cooperator_model->no_of_directors($cooperative_id,$this->decoded_id);

                        $data['chairperson_count'] = $this->amendment_update_cooperator_model->check_chairperson($cooperative_id,$this->decoded_id);

                        $data['associate_not_exists'] = $this->amendment_update_cooperator_model->check_associate_not_exists($cooperative_id,$this->decoded_id);

                        $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                        $data['minimum_regular_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_subscription($cooperative_id,$this->decoded_id);

                        $data['minimum_regular_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_regular_pay($cooperative_id,$this->decoded_id);

                        if($data['bylaw_info']->kinds_of_members!=1)

                        { 

                        $data['minimum_associate_subscription'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_subscription($cooperative_id,$this->decoded_id);

                        $data['minimum_associate_pay'] = $this->amendment_update_cooperator_model->check_all_minimum_associate_pay($cooperative_id,$this->decoded_id);

                        }

                        

                        $data['total_regular'] = $this->amendment_update_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);

                        $data['total_associate'] = $this->amendment_update_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);

                        $data['check_regular_paid'] = $this->amendment_update_cooperator_model->check_regular_total_shares_paid_is_correct($data['total_regular']);

                        $data['check_with_associate_paid'] = $this->amendment_update_cooperator_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);

                        $data['vice_count'] = $this->amendment_update_cooperator_model->check_vicechairperson($cooperative_id,$this->decoded_id);

                        $data['treasurer_count'] = $this->amendment_update_cooperator_model->check_treasurer($cooperative_id,$this->decoded_id);

                        $data['secretary_count'] = $this->amendment_update_cooperator_model->check_secretary($cooperative_id,$this->decoded_id);

                        $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);

                        $data['ten_percent']=$this->amendment_update_cooperator_model->ten_percent($this->decoded_id);

                        $data['list_cooperators_regular'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id,$config['per_page'],$page);

                    $data['list_cooperators_associate'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate($cooperative_id,$this->decoded_id);

                          $data['check_if_equal_shares_paid'] =$this->amendment_update_cooperator_model->check_equal_shares($this->decoded_id);//modified    

                      $data['list_cooperators_count'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_regular_count($cooperative_id,$this->decoded_id);

                    $data['list_cooperators_associate_count'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop_associate_count($this->decoded_id);

                              

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




  function add($id = null){

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{
        $this->load->model('region_model');    
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

        $user_id = $this->session->userdata('user_id');

        $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);

        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            if($this->amendment_update_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

              // if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){

                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);

                $new=1;

                if($this->amendment_update_cooperator_model->check_if_exist_orig_coop($this->input->post('fName'),$cooperative_id))

                {

                  $new = 0;

                }  



                

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                // if($data['bylaw_complete']){

                  // if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){

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

                        'amendment_id' => $this->decoded_id,

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

                  



                      $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                      $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($this->decoded_id); 

                      $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);

                      $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info']->rCode);

                      $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info']->pCode);

                      $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info']->cCode);

                      $this->load->view('./template/header', $data);

                      $this->load->view('update/amendment/cooperators/add_form_cooperator', $data);

                      $this->load->view('./template/footer');

                    }

            }else{

              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

              redirect('amendment_update');

            }

          }else{

            if($this->session->userdata('access_level')!=6){

              redirect('admins/login');

            }else{

                    $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($this->decoded_id);

                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                       if(!isset($_POST['addCooperatorBtn'])){

                        $data['title'] = 'List of Cooperators';

                        $data['header'] = 'Cooperators';

                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                        $data['encrypted_id'] = $id;

                        $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($data['coop_info']->users_id));

                        $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($this->decoded_id); 

                        $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                        if($data['coop_info']->area_of_operation == 'Interregional'){

                          $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                        } else {

                          $data['regions_list'] = $this->region_model->get_regions();

                        }

                        $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info']->rCode);

                        $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info']->pCode);

                        $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info']->cCode);

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

                        'amendment_id' => $this->decoded_id,

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
        $this->load->model('region_model');
         $this->load->model('bylaw_model');
          $this->load->model('capitalization_model');
           $this->load->model('cooperator_model');
         $data['has_new_regular'] =false;

        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

        $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);

        $data['cooperative_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));



        $data['encrypted_coop_id'] = encrypt_custom($this->encryption->encrypt($cooperative_id));

        $user_id = $this->session->userdata('user_id');

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            if($this->amendment_update_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

              // if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){

                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);

                // $this->debug($data['coop_info']);

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                // if($data['bylaw_complete']){

                    $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));

                    if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$this->decoded_id,$decoded_cooperator_id)){ //check if cooperator is in cooperative

                        // if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){

                          

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

                          $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                          $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);

                          $data['cooperator_info'] = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$this->decoded_id,$decoded_cooperator_id);

                           $data['cooperator_info_orig'] = $this->amendment_update_cooperator_model->get_cooperator_info_orig($data['cooperator_info']->full_name);

                           // echo $this->db->last_query()

                          $data['is_original_cptr'] = $this->amendment_update_cooperator_model->check_edit_id_orig_cptr($data['cooperator_info']->full_name,$cooperative_id);

                          // echo $this->db->last_query();

                           $data['is_original_cooperator'] ='false';

                          if($data['is_original_cptr'])

                          {

                            $data['is_original_cooperator'] = 'true';

                          }

                          $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                          $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);



                          if(strlen($data['client_info']->regno) ==0)

                          {

                             $data['regNo'] =$this->amendment_update_model->load_regNo($user_id);

                          }

                          else

                          {

                             $data['regNo'] = $this->amendment_update_model->load_regNo_reg($user_id);

                          }



                          // if($this->amendment_model->if_had_amendment_new($data['regNo']))

                          // {

                          //    $last_amendment_info = $this->amendment_model->get_last_amendment_info($cooperative_id,$this->decoded_id);

                          //    $data['last_share_amount']=$this->amendment_update_cooperator_model->get_last_amount_share_amd($data['cooperator_info']->full_name,$last_amendment_info->id);



                          // }

                          // else

                          // { 

                            $data['last_share_amount']=$this->amendment_update_cooperator_model->get_last_amount_share_coop($data['cooperator_info']->full_name);

                          // }



                          $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);

                           $data['list_cooperators_orig'] = $this->cooperator_model->get_all_cooperator_of_coop($cooperative_id);

                      

                          $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info']->rCode);

                          $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info']->pCode);

                          $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info']->cCode);

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

                            'amendment_id'=>$this->decoded_id,

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

                          $success = $this->amendment_update_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data,$this->decoded_id);

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

             $this->load->model('bylaw_model');      
             $this->load->model('capitalization_model');       
             $this->load->model('cooperator_model');
             $this->load->model('region_model');   
            $decoded_cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperator_id));

            $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($this->decoded_id);

            $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

            $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);

            $data['cooperator_info'] = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$this->decoded_id,$decoded_cooperator_id); 

            $data['cooperator_info_orig'] = $this->amendment_update_cooperator_model->get_cooperator_info_orig($data['cooperator_info']->full_name);

            // echo $this->db->last_query()

            $data['is_original_cptr'] = $this->amendment_update_cooperator_model->check_edit_id_orig_cptr($data['cooperator_info']->full_name,$cooperative_id);

            // echo $this->db->last_query();

            $data['is_original_cooperator'] ='false';

            if($data['is_original_cptr'])

            {

            $data['is_original_cooperator'] = 'true';

            }

            $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($this->decoded_id); 

            $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);

            $data['bylaw_complete'] =false;// ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;





            if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$this->decoded_id,$decoded_cooperator_id)){



                if(!isset($_POST['editCooperatorBtn'])){

                    $data['title'] = 'List of Cooperators';

                    $data['header'] = 'Cooperators';

                    $data['encrypted_id'] = $id;

                    $data['encrypted_cooperator_id'] = $cooperator_id;

                    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                    // $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                    // $data['cooperator_info'] = $this->cooperator_model->get_cooperator_info($decoded_cooperator_id);

                    $data['list_cooperators'] = $this->amendment_update_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);

                    $data['list_cooperators_orig'] = $this->cooperator_model->get_all_cooperator_of_coop($cooperative_id);

                    if($data['coop_info']->area_of_operation == 'Interregional'){



                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                    } else {

                    $data['regions_list'] = $this->region_model->get_regions();

                    }

                    $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info']->rCode);

                    $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info']->pCode);

                    $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info']->cCode);

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

                            'amendment_id'=>$this->decoded_id,

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

                        $success = $this->amendment_update_cooperator_model->edit_cooperator($decoded_post_cooperator_id,$data,$this->decoded_id);

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

        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));

        $cooperative_id =$this->amendment_update_model->coop_dtl($this->decoded_id);

        $user_id = $this->session->userdata('user_id');

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            if($this->amendment_update_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

           

              if($this->amendment_update_cooperator_model->check_cooperator_in_cooperative($cooperative_id,$this->decoded_id,$decoded_post_cooperator_id)){

                // if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){

                

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

              // if($this->cooperator_model->check_cooperator_in_cooperative($this->decoded_id,$decoded_post_cooperator_id)){

                // if($this->amendment_model->check_submitted_for_evaluation($this->decoded_id)){

                  // if($this->amendment_model->check_first_evaluated($this->decoded_id)){

                  //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');

                  //   redirect('amendment');

                  // }else{

                    $success = $this->amendment_update_cooperator_model->delete_cooperator($decoded_post_cooperator_id);

                    if($success){

                      $this->session->set_flashdata('cooperator_success', 'Cooperative has been deleted.');

                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');

                    }else{

                      $this->session->set_flashdata('cooperator_error', 'Unable to delete cooperative.');

                      redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');

                    }

                  // }

                // }else{

                //   $this->session->set_flashdata('redirect_applications_message', 'Deleting a cooperator of the cooperative is not available because the cooperative is not yet submitted for evaluation.');

                //   redirect('amendment');

                // }

              // }else{

              //   $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');

              //   redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_cooperators');

              // }

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

  // function all(){



  //   if($this->input->method(TRUE)==="GET"){

  //     redirect('amendment');

  //   }else if($this->input->method(TRUE)==="POST"){

  //     $uid = $this->session->userdata('user_id');

  //     $cooperatives_id = $this->amendment_update_model->get_cooperative_info($uid)->id;

  //     $cooperators = $this->amendment_update_model->get_all_cooperator_of_coop($cooperatives_id);

  //     $temp['data'] = $cooperators;

  //     echo json_encode($temp);

  //   }



  // }

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

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

      $user_id = $this->session->userdata('user_id');

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){

          if($this->amendment_model->check_own_cooperative($this->decoded_id,$user_id)){

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
        $this->load->model('cooperator_model');
    if($this->input->method(TRUE)==="GET"){

      redirect('amendment');

    }else if($this->input->method(TRUE)==="POST"){

     $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id')));

     $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_ids')));

      $user_id = $this->session->userdata('user_id');

      $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){

          if($this->amendment_update_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

              $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperator_id',true)));

              $data = $this->amendment_update_cooperator_model->get_cooperator_info($cooperative_id,$this->decoded_id,$decoded_post_coop_id);

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

            $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));

            $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);

            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));

            $result = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);

            echo json_encode($result);

          }else{

            echo json_encode(array('error'=>'Internal Server Error.'));

          }

        }

      }

    }

   



  //   function get_post_cooperator_info($id){

  //   if($this->input->method(TRUE)==="GET"){

  //     redirect('amendment');

  //   }else if($this->input->method(TRUE)==="POST"){

  //     $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

  //     $user_id = $this->session->userdata('user_id');

  //     if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

  //       if($this->session->userdata('client')){

  //         if($this->cooperatives_model->check_own_cooperative($this->decoded_id,$user_id)){

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
        $cooperator_list = $this->amendment_update_cooperator_model->cooperators_exist($amendment_id);
        // var_dump($cooperator_list);      
          $upload_file =  $_FILES['excel_file']['name'];
          $extension = pathinfo($upload_file,PATHINFO_EXTENSION);
          if($extension == 'xlsx')
          {
            $reader =new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $sheetCount = count($sheetData);
            $count_existing_cptr = count($cooperator_list) + 11;   
            // var_dump($sheetCount); var_dump($count_existing_cptr);
           // $this->debug($sheetData);
          
            if($sheetCount>$count_existing_cptr)

            {
              // for ($i=9; $i < $sheetCount; $i++) { 
               for ($i=$count_existing_cptr; $i < $sheetCount; $i++) {  ;
                $fullname= $sheetData[$i][0];
                $gender= $sheetData[$i][1];
                $birthday= $sheetData[$i][2];
                $houseNo= $sheetData[$i][3];
                $Street= $sheetData[$i][4];
                $AddressCode= $sheetData[$i][5];
                $position= ucfirst($sheetData[$i][6]);
                $Type_member= ucfirst($sheetData[$i][7]);
                $Number_subscribe= $sheetData[$i][8];
                $Number_paidup= $sheetData[$i][9];
                $Proof_idendity= ucfirst($sheetData[$i][10]);
                $Proof_idendityNo= $sheetData[$i][11];
                $proof_date_issue= $sheetData[$i][12];
                $Place_issuance= $sheetData[$i][13];

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
                'proof_of_identity_number'=>$Proof_idendityNo,
                'proof_date_issued'=> $proof_date_issue,
                'place_of_issuance'=> $Place_issuance
                );
              }
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
            else
            {
                $this->session->set_flashdata('cooperator_error','Failed to upload file. System identified that the uploaded file doesn\'t include new member. Any modification should be done using the "Edit" function of the system.');
                redirect('amendment_update/'.$this->input->post('aid').'/amendment_cooperators');
            }

               
          }
          else
          {
             $this->session->set_flashdata('cooperator_error','Invalid file.');
                redirect('amendment_update/'.$this->input->post('aid').'/amendment_cooperators');
          }

    }//end of submit

    

   } //end of public



  

    public function export($id=null)

   {

    $amendment_id =$this->encryption->decrypt(decrypt_custom($id));
    // echo $amendment_id  ;
  $cooperator_list = $this->amendment_update_cooperator_model->cooperators($amendment_id);      
 // $rowCount =  count($cooperator_list);
 // $this->debug($cooperator_list);
  $spreadsheet = new Spreadsheet();
  $rowCount =12;
 foreach($cooperator_list  as $cooperator)
 {
    $date_issued  = 'N/A';
    if($cooperator->proof_date_issued==NULL)
    {
        $date_issued = $cooperator->proof_date_issued;
    }
    $spreadsheet->getActiveSheet()->SetCellValue('A' . $rowCount, $cooperator->full_name);
    $spreadsheet->getActiveSheet()->SetCellValue('B' . $rowCount, $cooperator->gender);
    $spreadsheet->getActiveSheet()->SetCellValue('C' . $rowCount, $cooperator->birth_date);
    $spreadsheet->getActiveSheet()->SetCellValue('D' . $rowCount, $cooperator->house_blk_no);
    $spreadsheet->getActiveSheet()->SetCellValue('E' . $rowCount, $cooperator->streetName);
    $spreadsheet->getActiveSheet()->SetCellValue('F' . $rowCount, $cooperator->addrCode);
    $spreadsheet->getActiveSheet()->SetCellValue('G' . $rowCount, $cooperator->position);
    $spreadsheet->getActiveSheet()->SetCellValue('H' . $rowCount, $cooperator->type_of_member);
    $spreadsheet->getActiveSheet()->SetCellValue('I' . $rowCount, $cooperator->number_of_subscribed_shares);
    $spreadsheet->getActiveSheet()->SetCellValue('J' . $rowCount, $cooperator->number_of_paid_up_shares);
    $spreadsheet->getActiveSheet()->SetCellValue('K' . $rowCount, $cooperator->proof_of_identity);
    $spreadsheet->getActiveSheet()->SetCellValue('L' . $rowCount, $cooperator->proof_of_identity_number);
    $spreadsheet->getActiveSheet()->SetCellValue('M' . $rowCount, $cooperator->proof_date_issued);
    $spreadsheet->getActiveSheet()->SetCellValue('N' . $rowCount, $cooperator->place_of_issuance);
    $rowCount++;
 }
 unset($cooperator);
 // $this->debug($spreadsheet);
  $filename = "Cooperators form". date("Y-m-d-H-i-s").'.xlsx';
  // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  ob_end_clean();
  header('Content-Type: application/vnd.ms-excel'); 
    // header('Content-Disposition: attachment;filename="test.xlsx"');
  header('Content-Disposition: attachment; filename="'.$filename.'"');

  // $spreadsheet = new Spreadsheet();
  $url_code = 'https://psa.gov.ph/classification/psgc/?q=psgc/summary';
  // $sheet = $spreadsheet->getActiveSheet();
  $spreadsheet->getActiveSheet()->getStyle('A11:N11')->getFont()->setBold(true);
  $spreadsheet->getActiveSheet()->getStyle('A1:A7')->getFont()->setName('Oblique');
  $spreadsheet->getActiveSheet()->SetCellValue('A1', 'NOTE:');
  $spreadsheet->getActiveSheet()->SetCellValue('A2', 'Address Code should be encoded correctly. To know the code > Click the link below > Look and click for the Region & Province > Get the "Correspondence Code".');
  $spreadsheet->getActiveSheet()->SetCellValue('A4', 'Position should be encoded as "Chairperson", "Vice-Chairperson", "Board of Director", "Treasurer", "Secretary" and 
Member" only.');
  $spreadsheet->getActiveSheet()->SetCellValue('A5', 'Type of Membership must be encoded as "Regular" and " Associate" only.');
  $spreadsheet->getActiveSheet()->SetCellValue('A6', 'Gender must be encoded as "Male" and "Female" only');
  $spreadsheet->getActiveSheet()->SetCellValue('A7', 'Birthdate and Date Issued format should be ("yyyy-mm-dd / 1980-09-16")');
  $spreadsheet->getActiveSheet()->SetCellValue('A8', 'Proof of Identity must be encoded as "Digitized Postal ID, Drivers\'s License, GSIS E-Card, IBP ID, OWWA ID, Passport, PRC ID, Senior Citizen\'s ID, SSS ID, TIN, Voter\'s ID, Philhealth, OFW, Single Parent, PWD, Pag-IBIG');

  // $spreadsheet->getActiveSheet()->SetCellValue('A9',' For every successful upload of file, excel file must be downloaded for the updated list of members from the system.');

 
    $link_style_array = [
        'font'  => [
        'color' => ['rgb' => '0000FF'],
        'underline' => 'single',
        ],
    ];

  $spreadsheet->getActiveSheet()->getStyle("A3")->applyFromArray($link_style_array);
  $spreadsheet->getActiveSheet()->SetCellValue('A3', 'www.psa.gov.ph');
  $spreadsheet->getActiveSheet()->getCell('A3')->getHyperlink()->setUrl(strip_tags($url_code));
  // $spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  // $spreadsheet->getActiveSheet()->mergeCells('A3');
  $spreadsheet->getActiveSheet()->SetCellValue('A11', 'fullname');
  $spreadsheet->getActiveSheet()->SetCellValue('B11', 'Gender');
  $spreadsheet->getActiveSheet()->SetCellValue('C11', 'Birthday');
  $spreadsheet->getActiveSheet()->SetCellValue('D11', 'House No.');
  $spreadsheet->getActiveSheet()->SetCellValue('E11', 'Street');
  $spreadsheet->getActiveSheet()->SetCellValue('F11', 'AddressCode');
  $spreadsheet->getActiveSheet()->SetCellValue('G11', 'Position');
  $spreadsheet->getActiveSheet()->SetCellValue('H11', 'Type of Member');
  $spreadsheet->getActiveSheet()->SetCellValue('I11', 'Number of Subscribe Shares');
  $spreadsheet->getActiveSheet()->SetCellValue('J11', 'Number of Paid up Shares');
  $spreadsheet->getActiveSheet()->SetCellValue('K11', 'Proof of Idendity');
  $spreadsheet->getActiveSheet()->SetCellValue('L11', 'Proof of Idendity No.');
  $spreadsheet->getActiveSheet()->SetCellValue('M11', 'Proof of Idendity date issued');
  $spreadsheet->getActiveSheet()->SetCellValue('N11', 'Place of Issuance');

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

