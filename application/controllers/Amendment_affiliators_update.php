<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_affiliators_update extends CI_Controller{
  public $decoded_id=null;
  public $coopName='';
  public $regNo='';
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  $this->load->model('amendment_affiliators_update_model','affiliator_model');
  $this->load->model('amendment_update_cooperator_model','cooperators_model');
  $this->load->model('amendment_update_capitalization_model','amd_capitalization_model');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $data['encrypted_id'] = $id;
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_update_model->coop_dtl($this->decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_update_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
              // if(!$this->amendment_update_model->check_expired_reservation($this->decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                    $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($this->decoded_id);
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                    $data['title'] = 'List of Members';
                    $data['header'] = 'List of Members';
                    $data['encrypted_id'] = $id;
                    $data['requirements_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                    $data['directors_count'] = $this->affiliator_model->check_no_of_directors($this->decoded_id);
                    $data['directors_count_odd'] = $this->affiliator_model->check_directors_odd_number($this->decoded_id);
                    $data['total_directors'] = $this->affiliator_model->no_of_directors($this->decoded_id);
                    $data['chairperson_count'] = $this->affiliator_model->check_chairperson($this->decoded_id);
                    // $data['associate_not_exists'] = $this->cooperators_model->check_associate_not_exists($cooperative_id,$this->decoded_id);
                    $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                    $data['capitalization_info'] = $this->amd_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                    // echo $this->db->last_query();
                    // var_dump($data['capitalization_info']);
                     $data['minimum_regular_subscription'] = '';
                      $data['minimum_regular_pay'] ='';
                      $data['minimum_associate_subscription'] ='';
                      $data['minimum_associate_pay'] ='';
                    if($data['capitalization_info']!=null)
                    {
                      $data['minimum_regular_subscription'] = $data['capitalization_info']->minimum_subscribed_share_regular;
                      $data['minimum_regular_pay'] = $data['capitalization_info']->minimum_paid_up_share_regular;
                      $data['minimum_associate_subscription'] = $data['capitalization_info']->minimum_subscribed_share_associate;
                      $data['minimum_associate_pay'] = $data['capitalization_info']->minimum_paid_up_share_associate;
                    }
                
                    $data['total_regular'] = $this->affiliator_model->total_regular($this->decoded_id);
                    $data['total_associate'] = $this->cooperators_model->get_total_associate($cooperative_id,$this->decoded_id);
                    $data['vice_count'] = $this->affiliator_model->check_vicechairperson($this->decoded_id);
                    $data['treasurer_count'] = $this->affiliator_model->check_treasurer($this->decoded_id);
                    $data['secretary_count'] = $this->affiliator_model->check_secretary($this->decoded_id);
                    // $data['list_cooperators'] = $this->affiliator_model->get_all_cooperator_of_coop($user_id);
                 
                     $data['msg'] ='';
                    $submit =false;
                     $data['registered_coop']=null;
                    if(isset($_POST['btn-filter']))
                    {
                    $submit =true;
                    $this->regNo=$this->input->post('regNo');
                    $this->coopName = $this->input->post('coopName');

        
                      if($data['coop_info']->category_of_cooperative=='Secondary')
                      {
                         $data['registered_coop'] = $this->affiliator_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName);  

                      }
                      if($data['coop_info']->category_of_cooperative=='Tertiary')
                      {
                          $data['registered_coop'] = $this->affiliator_model->get_registered_coop_tertiary($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName);  
                      }
                    }
                   
                    $data['msg'] = ($submit && isset($data['registered_coop']['msg']) ? $data['registered_coop']['msg'] :'');
                    
                    // $data['ten_percent'] = $this->cooperators_model->ten_percent($this->decoded_id);
        
                    // $data['user_id'] = $this->encryption->encrypt(encrypt_custom($this->decoded_id));
                    $data['applied_coop_count'] = $this->affiliator_model->count_applied_coop($this->decoded_id);
                    $array =array(
                    'url'=>base_url()."amendment_update/".$id.'/update_affiliators',
                    'total_rows'=>$data['applied_coop_count'],
                    'per_page'=>$config['per_page']=5,
                    'url_segment'=>4
                    );
                     $data['links']=$this->paginate($array);
                    $data['applied_coop'] = $this->affiliator_model->get_applied_coop($this->decoded_id,$config['per_page'],$page);
                   
                
                    // $data['list_amendment_affiliators'] = $this->affiliator_model->get_all_amendment_affiliators_of_coop($user_id);
                    
                    $data['affiliator_info'] = $this->affiliator_model->get_affiliator_info($user_id);
                    $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);
                    $this->load->view('./template/header', $data);
                    $this->load->view('update/amendment/federation_update/affiliators_list', $data);
                    $this->load->view('update/amendment/federation_update/full_info_modal');
                    $this->load->view('update/amendment/federation_update/add_form_secondary', $data);
                    $this->load->view('update/amendment/federation_update/edit_form_secondary', $data);
                    $this->load->view('update/amendment/federation_update/delete_affiliator');
                    $this->load->view('./template/footer');

            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment_update');
            }
          }else{
            if($this->session->userdata('access_level')!=6){
              redirect('admins/login');
            }else{
              // if($this->amendment_update_model->check_expired_reservation_by_admin($this->decoded_id)){
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('cooperatives');
              // }else{
                // if($this->amendment_update_model->check_submitted_for_evaluation($this->decoded_id)){

                  $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_model->check_capitalization_primary_complete($this->decoded_id) : true;
                  $data['is_client'] = false;
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  // if($data['bylaw_complete']){

                        $data['title'] = 'List of Members';
                        $data['header'] = 'List of Members';
                        $data['encrypted_id'] = $id;
                        $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$this->decoded_id);
                        $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_update_bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                        $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($this->decoded_id);
                      
                        
                        $data['requirements_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id,$user_id);
                        $data['directors_count'] = $this->affiliator_model->check_no_of_directors($user_id);
                        $data['directors_count_odd'] = $this->affiliator_model->check_directors_odd_number($user_id);
                        $data['total_directors'] = $this->affiliator_model->no_of_directors($user_id);
                        $data['chairperson_count'] = $this->affiliator_model->check_chairperson($user_id);
                        $data['associate_not_exists'] = $this->cooperators_model->check_associate_not_exists($cooperative_id,$this->decoded_id);
                        $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                        $data['capitalization_info'] = $this->amd_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                        // echo $this->db->last_query();
                        // var_dump($data['capitalization_info']);
                        $data['minimum_regular_subscription'] = '';
                        $data['minimum_regular_pay'] ='';
                        $data['minimum_associate_subscription'] ='';
                        $data['minimum_associate_pay'] ='';
                        if($data['capitalization_info']!=null)
                        {
                        $data['minimum_regular_subscription'] = $data['capitalization_info']->minimum_subscribed_share_regular;
                        $data['minimum_regular_pay'] = $data['capitalization_info']->minimum_paid_up_share_regular;
                        $data['minimum_associate_subscription'] = $data['capitalization_info']->minimum_subscribed_share_associate;
                        $data['minimum_associate_pay'] = $data['capitalization_info']->minimum_paid_up_share_associate;
                        }

                        $data['total_regular'] = $this->affiliator_model->total_regular($this->decoded_id);
                        $data['total_associate'] = $this->cooperators_model->get_total_associate($cooperative_id,$this->decoded_id);
                        $data['check_regular_paid'] = $this->cooperators_model->check_regular_total_shares_paid_is_correct($data['total_regular']);
                        $data['check_with_associate_paid'] = $this->cooperators_model->check_with_associate_total_shares_paid_is_correct($data['total_regular'],$data['total_associate']);
                        $data['vice_count'] = $this->affiliator_model->check_vicechairperson($user_id);
                        $data['treasurer_count'] = $this->affiliator_model->check_treasurer($user_id);
                        $data['secretary_count'] = $this->affiliator_model->check_secretary($user_id);
                        // $data['list_cooperators'] = $this->affiliator_model->get_all_cooperator_of_coop($user_id);
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
                        if($data['coop_info']->category_of_cooperative=='Secondary')
                        {
                           $data['registered_coop'] = $this->affiliator_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName);  
                         
                        // $this->debug($data['registered_coop']);
                        }
                        if($data['coop_info']->category_of_cooperative=='Tertiary')
                        {
                            $data['registered_coop'] = $this->affiliator_model->get_registered_coop_tertiary($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName);  
                        }
                        // }

                        }

                        $data['msg'] = (isset($_POST['btn-filter']) && empty($data['registered_coop']) ? 'No data found.':'');

                        // $data['ten_percent'] = $this->cooperators_model->ten_percent($this->decoded_id);

                        // $data['user_id'] = $this->encryption->encrypt(encrypt_custom($this->decoded_id));
                        $data['applied_coop_count'] = $this->affiliator_model->count_applied_coop($this->decoded_id);
                        $array =array(
                        'url'=>base_url()."amendment_update/".$id.'/update_affiliators',
                        'total_rows'=>$data['applied_coop_count'],
                        'per_page'=>$config['per_page']=5,
                        'url_segment'=>4
                        );
                         $data['links']=$this->paginate($array);
                        $data['applied_coop'] = $this->affiliator_model->get_applied_coop($this->decoded_id,$config['per_page'],$page);
                        // $data['applied_coop_count'] = count($this->affiliator_model->get_applied_coop($this->decoded_id));

                        // $data['list_amendment_affiliators'] = $this->affiliator_model->get_all_amendment_affiliators_of_coop($user_id);
                        $data['affiliator_info'] = $this->affiliator_model->get_affiliator_info($this->decoded_id);
                        $data['is_update_cooperative'] = true;
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('update/amendment/federation_update/affiliators_list', $data);
                        $this->load->view('update/amendment/federation_update/delete_affiliator');
                        $this->load->view('update/amendment/federation_update/full_info_modal');
                        $this->load->view('update/amendment/federation_update/add_form_secondary', $data);
                        $this->load->view('update/amendment/federation_update/edit_form_secondary', $data);
                        $this->load->view('./template/footer');
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'Please complete first the capitalization additional information.');
                  //   redirect('cooperatives/'.$id);
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                //   redirect('cooperatives');
                // }
              // }
            }
          }
        }else{
          show_404();
        }
    }
}

    function add_amendment_affiliators(){

        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $amd_fed_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_fed_id')));
        $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id')));
        $cooperative_id = $this->encryption->decrypt(decrypt_custom($this->input->post('application_id')));
        $registered_id = $this->encryption->decrypt(decrypt_custom($this->input->post('registered_id')));
        $coop_info = $this->amendment_update_model->get_coop_info2($amd_fed_id);
        $client_id = ($coop_info!=null ? $coop_info->users_id : '');
            if(!empty($this->input->post('position'))){
              $position = implode(", ",$this->input->post('position'));
              // $regions = implode(", ",$this->input->post('regions'));
            } else {
              $position = '';
              // $regions = '';
            }

        // $position_exist = $this->affiliator_model->check_position($amendment_id,$position);
        // print_r($sample_results);
        // if($position_exist){
        //   $this->session->set_flashdata('cooperator_error', 'Position already exists.');
        //     redirect('amendment_update/'.$this->input->post('amd_fed_id').'/update_affiliators');
        // } else {
          // if(!$this->affiliator_model->check_coop_by_regNo($amendment_id,$this->input->post('regNo'))){
      
        if($this->affiliator_model->coop_exist($amd_fed_id,$this->input->post('regNo')))
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
              $success = $this->affiliator_model->add_amendment_affiliators($data);
              if($success){
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added.');
                redirect('amendment_update/'.$this->input->post('amd_fed_id').'/update_affiliators');
              }else{
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added');
                redirect('amendment_update/'.$this->input->post('amd_fed_id').'/update_affiliators');
              }
      }        
  //         } else {
  // //            echo $query;
  //             $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
  //                     redirect('amendment_update/'.$this->input->post('amd_fed_id').'/update_affiliators');
  //         }
        // }
    }

    function edit_amendment_affiliators($id = null){
        $user_id = $this->session->userdata('user_id');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        // $query = $this->affiliator_model->existing_amendment_affiliators($user_id,$this->input->post('regNo'));
        // $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

        $encryptedcoopid = $this->input->post('cooperativesID');
        $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

        // $this->db->where('user_id',$user_id);
        $this->db->where('id !=',$encrypted_post_coop_id);
        // $this->db->where('position', $this->input->post('position'));
        $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
        $this->db->from('amendment_affiliators');
        // $count = $this->db->count_all_results();
        $query_aff = $this->db->get();
      
        if(!empty($this->input->post('position'))){
          $position = implode(", ",$this->input->post('position'));
          // $regions = implode(", ",$this->input->post('regions'));
        } else {
          $position = '';
          // $regions = '';
        }
        $found ='';
        if($query_aff->num_rows()>0)
        {
          $data_aff = $query_aff->result_array();
           foreach($data_aff as $row_aff){
              $aff_results[] = $row_aff['position'];
            }
            if (in_array($position, $aff_results)) {
              $found = 'found' ;
            } 
        }    
      
        if($found=='found'){
          $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            redirect('amendment_update/'.$encryptedcoopid.'/update_affiliators');
        }

        // $position_exists = $this->db->where('(position LIKE "%Chairperson%") AND id != '.$encrypted_post_coop_id.' AND user_id ='.$user_id.' AND position NOT IN  ("Member","Board of Director")')->get('amendment_affiliators');
        // if($position_exists->num_rows()==1){
            // $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            // redirect('cooperatives/'.$encryptedcoopid.'/amendment_affiliators');
          // echo $position_exists->num_rows();
        // } 
        else {
          
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
            // $this->debug($u_data);
          $update_aff = $this->db->update('amendment_affiliators',$u_data,array('id'=>$encrypted_post_coop_id));

          if($update_aff)
          {  
            $this->session->set_flashdata('cooperator_success', 'Affiliator Successfully Updated.');
              redirect('amendment_update/'.$encryptedcoopid.'/update_affiliators');
          }else{
            $this->session->set_flashdata('cooperator_success', 'Affiliator failed to Update');
            redirect('amendment_update/'.$encryptedcoopid.'/update_affiliators');
          }
        }
    }
    
    function delete_cooperator(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteCooperatorBtn')){
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client') || $this->session->userdata('access_level')==6){
            // if($this->amendment_update_model->check_own_cooperative($this->decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

                  $success = $this->affiliator_model->delete_amendment_affiliators($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Affiliator has been remove.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID').'/update_affiliators');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to remove affiliator.');
                    redirect('amendment_update/'.$this->input->post('cooperativeID').'/update_affiliators');
                  }
            
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperators_model->check_cooperator_in_cooperative($this->decoded_id,$decoded_post_cooperator_id)){
                if($this->amendment_update_model->check_submitted_for_evaluation($this->decoded_id)){
                  if($this->amendment_update_model->check_first_evaluated($this->decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
                  }else{
                    $success = $this->cooperators_model->delete_cooperator($decoded_post_cooperator_id);
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
  //         $result = $this->affiliator_model->is_position_available($data);
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
      $data = $this->affiliator_model->is_position_available($user_id,$position);
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
  //         $result = $this->affiliator_model->edit_is_position_available($data);
  //         echo json_encode($result);
  //       }else{
  //         $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
  //         redirect('cooperators');
  //       }
  //     }
  // }

  public function check_edit_position_not_exist($user_id,$position,$cooperatorid){
    $data = $this->affiliator_model->edit_is_position_available($user_id,$position,$cooperatorid);
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
  }  
}
