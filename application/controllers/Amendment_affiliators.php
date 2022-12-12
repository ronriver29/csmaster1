<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_affiliators extends CI_Controller{
  public $cooperative_id =null;
  public $regNo=null;
  public $coopName = null;  
  public function __construct()
  {
    parent::__construct();
     $this->load->library('auth');
     $this->load->model('Amendment_affiliators_model','amd_affiliators_model');
     $this->load->library('pagination');
  }

  function index($id = null)
  { 

      $this->load->model('amendment_model');
      $this->load->model('amendment_bylaw_model');
      $this->load->model('amendment_capitalization_model'); 
      $this->load->model('user_model');
       $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $this->cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            $this->amendment_model->check_own_cooperative_($decoded_id,$user_id);
            $this->amendment_model->check_expired_reservation_($decoded_id,$user_id);
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($this->cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                if($data['capitalization_complete']){
                    $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Members';
                    $data['header'] = 'List of Members';
                    $data['encrypted_id'] = $id;
                    // $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    // $capitalization_info = $data['capitalization_info'];
                    $data['requirements_complete'] = $this->amd_affiliators_model->is_requirements_complete($decoded_id,$user_id);
                    $data['directors_count'] = $this->amd_affiliators_model->check_no_of_directors($decoded_id);
                    $data['directors_count_odd'] = $this->amd_affiliators_model->check_directors_odd_number($decoded_id);
                    $data['total_directors'] = $this->amd_affiliators_model->no_of_directors($decoded_id);

                    $data['chairperson_count'] = $this->amd_affiliators_model->check_chairperson($decoded_id);
                  
                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                    $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id); 
                    
                    $data['minimum_regular_subscription'] = ($data['capitalization_info']!=NULL ? $data['capitalization_info']->minimum_subscribed_share_regular : '');
                    $data['minimum_regular_pay'] =  ($data['capitalization_info']!=NULL ? $data['capitalization_info']->minimum_paid_up_share_regular : '');
                    $data['minimum_associate_subscription'] =  ($data['capitalization_info']!=NULL ? $data['capitalization_info']->minimum_subscribed_share_associate : '');
                    $data['minimum_associate_pay'] = ($data['capitalization_info']!=NULL ? $data['capitalization_info']->minimum_paid_up_share_associate : '');
                    $data['total_regular'] = $this->amd_affiliators_model->get_total_regular($decoded_id);

                   
                    $data['vice_count'] = $this->amd_affiliators_model->check_vicechairperson($decoded_id);
                    $data['treasurer_count'] = $this->amd_affiliators_model->check_treasurer($decoded_id);
                    $data['secretary_count'] = $this->amd_affiliators_model->check_secretary($decoded_id);
                    $data['list_cooperators'] = $this->amd_affiliators_model->get_all_cooperator_of_coop($decoded_id);
                    
                 
                     $data['msg'] ='';
                    $submit =false;
                     $data['registered_coop']=null;
                    if(isset($_POST['btn-filter']))
                    {
                    $submit =true;
                    $this->regNo=$this->input->post('regNo');
                    $this->coopName = $this->input->post('coopName');

                      // if($data['coop_info']->area_of_operation == 'Interregional'){
                    // $data['registered_coop'] = $this->affiliator_model->get_registered_interregion($data['coop_info']->regions);
                    // } else {
                    if($data['coop_info']->category_of_cooperative =='Secondary')
                    {
                      $data['registered_coop'] = $this->amd_affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName); 
                    
                    }

                     if($data['coop_info']->category_of_cooperative =='Tertiary')
                    {
                      $data['registered_coop'] = $this->amd_affiliators_model->get_registered_coop_tertiary($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName); 
                    } 
                    // }

                    }

                     $data['msg'] = ($submit && empty($data['registered_coop']) ? 'No data found.':'');
                    // if($data['coop_info']->category_of_cooperative == 'Tertiary'){
                    //   $data['registered_coop'] = $this->amd_affiliators_model->get_registered_coop_secondary($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                    // } else {
                    //   $data['registered_coop'] = $this->amd_affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                    // }

                   $data['user_id'] = $this->encryption->encrypt(encrypt_custom($user_id));

                   $data['applied_coop_count'] = $this->amd_affiliators_model->count_applied_coop($decoded_id);
                    $array =array(
                    'url'=>base_url().'amendment/'.$id.'/amendment_affiliators',
                    'total_rows'=>$data['applied_coop_count'],
                    'per_page'=>$config['per_page']=5,
                    'url_segment'=>4
                    );
                     $data['links']=$this->paginate($array);
                    $data['applied_coop'] = $this->amd_affiliators_model->get_applied_coop($decoded_id,$config['per_page'],$page);

                    $data['list_affiliators'] = $this->amd_affiliators_model->get_all_affiliators_of_coop($decoded_id);
                    $data['affiliator_info'] = $this->amd_affiliators_model->get_affiliator_info($decoded_id);

                    $this->load->view('./template/header', $data);
                    $this->load->view('amendment/federation/affiliator_list', $data);
                    $this->load->view('amendment/federation/full_info_modal');
                    $this->load->view('amendment/federation/add_form_member', $data);
                     $this->load->view('amendment/federation/edit_form_member', $data);
                    $this->load->view('amendment/federation/delete_modal_member');
                    $this->load->view('./template/footer');
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your capitalization additional information.');
                  redirect('amendment/'.$id);
                }
    
          }else{
                $this->load->model('admin_model');
                $this->load->model('region_model');
                $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
                $this->amendment_model->check_expired_reservation_by_admin_($decoded_id);
                $this->amendment_model->check_submitted_for_evaluation_($decoded_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($decoded_id) : true;
                  $data['is_client'] = $this->session->userdata('client');
                  if($data['bylaw_complete']){
                        $data['title'] = 'List of Affiliators';
                        $data['header'] = 'Affiliators';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
                        // $data['registered_coop'] = $this->amd_affiliators_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative);
                        $data['requirements_complete'] = $this->amd_affiliators_model->is_requirements_complete($decoded_id,$user_id);
//                        $data['directors_count'] = $this->cooperator_model->check_no_of_directors($decoded_id);
//                        $data['directors_count_odd'] = $this->cooperator_model->check_directors_odd_number($decoded_id);
                        $data['total_directors'] = $this->amd_affiliators_model->no_of_directors($decoded_id);
//                        $data['chairperson_count'] = $this->cooperator_model->check_chairperson($decoded_id);
//                        $data['associate_not_exists'] = $this->cooperator_model->check_associate_not_exists($decoded_id);
                        $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                        $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
                        $capitalization_info = $data['capitalization_info'];

                         $data['msg'] ='';
                        $submit =false;
                         $data['registered_coop']=null;
                        if(isset($_POST['btn-filter']))
                        {
                        $submit =true;
                        $this->regNo=$this->input->post('regNo');
                        $this->coopName = $this->input->post('coopName');
                        }
                        $data['applied_coop_count'] = $this->amd_affiliators_model->count_applied_coop_admin($decoded_id,$this->coopName,$this->regNo);
                        $array =array(
                        'url'=>base_url()."amendment_update/".$id.'/amendment_affiliators',
                        'total_rows'=>$data['applied_coop_count'],
                        'per_page'=>$config['per_page']=5,
                        'url_segment'=>4
                        );
                         $data['links']=$this->paginate($array);
                        $data['applied_coop'] = $this->amd_affiliators_model->get_applied_coop_admin($decoded_id,$config['per_page'],$page,$this->coopName,$this->regNo);
                        
                         $data['msg'] = ($submit && empty( $data['applied_coop']) ? 'No data found.':'');
    //                    $data['minimum_regular_subscription'] = $this->cooperator_model->check_all_minimum_regular_subscription($decoded_id);
    //                    $data['minimum_regular_pay'] = $this->cooperator_model->check_all_minimum_associate_subscription($decoded_id);

//                        $data['minimum_regular_subscription'] = $capitalization_info->minimum_subscribed_share_regular;
//                        $data['minimum_regular_pay'] = $capitalization_info->minimum_paid_up_share_regular;
//                      
                        $data['total_regular'] = $this->amd_affiliators_model->get_total_regular($decoded_id);
                        $data['list_cooperators'] = $this->amd_affiliators_model->get_all_cooperator_of_coop($decoded_id);
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('amendment/federation/affiliator_list', $data);
                        $this->load->view('amendment/federation/full_info_modal');
                        $this->load->view('./template/footer');
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first the capitalization additional information.');
                    redirect('cooperatives/'.$id);
                  }

          }
        }else{
          show_404();
        }
}

    function add_amendment_affiliators(){
        $this->load->model('amendment_model');
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $amd_fed_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_fed_id')));
        $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id')));
        $cooperative_id = $this->encryption->decrypt(decrypt_custom($this->input->post('application_id')));
        $registered_id = $this->encryption->decrypt(decrypt_custom($this->input->post('registered_id')));
        $coop_info = $this->amendment_model->coop_info_($amd_fed_id);
        $client_id = ($coop_info!=null ? $coop_info->users_id : '');
            if(!empty($this->input->post('position'))){
              $position = implode(", ",$this->input->post('position'));
              // $regions = implode(", ",$this->input->post('regions'));
            } else {
              $position = '';
              // $regions = '';
            }

      
        if($this->amd_affiliators_model->coop_exist($amd_fed_id,$this->input->post('regNo')))
        {
           $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
            redirect('amendment_update/'.$this->input->post('amd_fed_id').'/update_affiliators');
        }
        else
        {
   
              $data = array(
                'amendment_fed_id' => $amd_fed_id,
                'amendment_id' =>$amendment_id ,
                'cooperative_id'=>$cooperative_id,
                'registered_id' => $registered_id,
                'regNo' => $this->input->post('regNo'),
                'coopName' => $this->input->post('coopName'),
                'type'=> $this->input->post('type'),
                'commonBond' => $this->input->post('commonBond'),
                'dateRegistered'=> $this->input->post('dateRegistered'),
                'source' => $this->input->post('source'),
                'addrCode' => $this->input->post('addrCode'),
                'Street' => $this->input->post('street'),
                'noStreet' => $this->input->post('nostreet'),
                'brgy'=> $this->input->post('brgy'),
                'city' => $this->input->post('city'),
                'province' => $this->input->post('province'),
                'region' => $this->input->post('region'),
                'number_of_subscribed_shares' => $this->input->post('subscribedShares'),
                'number_of_paid_up_shares' => $this->input->post('paidShares'),
                'representative' => $this->input->post('representative'),
                'position' => $position,
                'proof_of_identity' => $this->input->post('validIdType'),
                'valid_id' => $this->input->post('validIdNo'),
                'date_issued' => date('Y-m-d',strtotime($this->input->post('dateIssued'))),
                'place_of_issuance' => $this->input->post('placeIssuance'),
                'user_id' => $client_id,
                'type_of_member'=>'Regular'
                );
                unset($client_id);
                unset($amd_fed_id);
                unset($amendment_id);
                unset($cooperative_id);
                unset($registered_id);
                unset($coop_info);
                unset($client_id);
                // $this->debug($data);
              $success = $this->amd_affiliators_model->add_amendment_affiliators($data);
              if($success){
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added.');
                redirect('amendment/'.$this->input->post('amd_fed_id').'/amendment_affiliators');
              }else{
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added');
                redirect('amendment/'.$this->input->post('amd_fed_id').'/amendment_affiliators');
              }
      }        
    }

    function edit_affiliator($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        // $query = $this->amd_affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        // $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

        $encryptedcoopid = $this->input->post('cooperativesID');
        $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
        if(!empty($this->input->post('position'))){
          $position = implode(", ",$this->input->post('position'));
          // $regions = implode(", ",$this->input->post('regions'));
        } else {
          $position = '';
          // $regions = '';
        }
            
    
          $u_data = array(
              'number_of_subscribed_shares'=> $this->input->post('subscribedShares2'),
              'number_of_paid_up_shares'=> $this->input->post('paidShares2'),
              'representative' => $this->input->post('repre'),
              'position' => $position,
              'proof_of_identity' => $this->input->post('validIdType'),
              'valid_id' => $this->input->post('validIdNo'),
              'date_issued' => date('Y-m-d',strtotime($this->input->post('dateIssued'))),
              'place_of_issuance' => $this->input->post('place_of_issuance'),
            );

          if($this->amd_affiliators_model->update_affiliator($u_data,$encrypted_post_coop_id))
          {  
            $this->session->set_flashdata('cooperator_success', 'Affiliator Successfully Updated.');
              redirect('amendment/'.$encryptedcoopid.'/amendment_affiliators');
          }else{
            $this->session->set_flashdata('cooperator_success', 'Affiliator failed to Update');
            redirect('amendment/'.$encryptedcoopid.'/amendment_affiliators');
          }
        
    }
    
    function delete_cooperator(){

      if($this->input->post('deleteCooperatorBtn')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          // if($this->session->userdata('client') || $this->session->userdata('access_level')==6){
          // if($this->amendment_update_model->check_own_cooperative($decoded_id,$user_id)){
            $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
            $success = $this->amd_affiliators_model->delete_amendment_affiliators($decoded_post_cooperator_id);
            if($success){
            $this->session->set_flashdata('cooperator_success', 'Affiliator has been remove.');
            redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_affiliators');
            }else{
            $this->session->set_flashdata('cooperator_error', 'Unable to remove affiliator.');
            redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_affiliators');
            }
          // }  
        }
      }
    }
    


  // public function check_position_not_exist(){
  //    if(!$this->session->userdata('logged_in')){
  //       redirect('users/login');
  //     }else{
  //       if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
  //         $data = array(
  //           'fieldId'=>$this->input->get('fieldId'),
  //           'fieldValue'=>$this->input->get('fieldValue'),
  //           'cooperativesID'=>$this->input->get('cooperativesID'),
  //         );
  //         $result = $this->amd_affiliators_model->is_position_available($data);
  //         echo json_encode($result);
  //         // echo $this->db->last_query();
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }

  public function check_position_not_exist($user_id,$position){
      // $position = $this->encryption->decrypt(decrypt_custom($position));
      // $position=str_replace('%20',' ',$position);
      $data = $this->amd_affiliators_model->is_position_available($user_id,$position);
      echo json_encode($data);
  }

  // public function check_edit_position_not_exist(){
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
  //         $result = $this->amd_affiliators_model->edit_is_position_available($data);
  //         echo json_encode($result);
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }

  public function check_edit_position_not_exist($user_id,$position,$cooperatorid){
    $data = $this->amd_affiliators_model->edit_is_position_available($user_id,$position,$cooperatorid);
      echo json_encode($data);
  }
  
  public function paginate($array)
    {
      // $result =null;
        $config["base_url"] = $array['url'];
        $config["total_rows"] =$array['total_rows'];
        $config["per_page"] = $array['per_page'];
        $config["uri_segment"] = $array['url_segment'];
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
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#" style="height:3.5rem;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        
       
       
        $links = $this->pagination->create_links();
        return $links;
    }

  public function debug($array)
  {
    echo"<pre>";
    print_r($array);
    unset($array);
  }  
}
