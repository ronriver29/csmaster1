<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_union extends CI_Controller{
  public $coopName = '';
  public $regNo='';

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('amendment_union_model','amd_union_model');
    $this->load->model('amendment_update_cooperator_model');
    $this->load->library('pagination');

  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $this->benchmark->mark('code_start');
        // $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $data['encrypted_id'] = $id;
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['client_info'] = $this->user_model->get_user_info($user_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            $data['title'] = 'List of Members';
            $data['header'] = 'Members';
            $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
            $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($decoded_id);
            $data['requirements_complete'] = $this->amd_union_model->is_requirements_complete($user_id);
            $data['cc_count'] = $this->amd_union_model->get_total_cc($decoded_id);
            $data['directors_count'] = $this->amd_union_model->check_no_of_directors($decoded_id);
            $data['directors_count_odd'] = $this->amd_union_model->check_directors_odd_number($user_id);
            $data['total_directors'] = $this->amd_union_model->no_of_directors($decoded_id);
            $data['chairperson_count'] = $this->amd_union_model->check_chairperson($decoded_id);
            $data['vice_count'] = $this->amd_union_model->check_vicechairperson($decoded_id);
            $data['treasurer_count'] = $this->amd_union_model->check_treasurer($decoded_id);
            $data['secretary_count'] = $this->amd_union_model->check_secretary($decoded_id);
            $data['msg'] ='';
            $submit =false;
            if(isset($_POST['btn-filter']))
            {
            $submit =true;
            $this->coopName = $this->input->post('coopName');
            $this->regNo=$this->input->post('regNo');
            }
            
            if($data['coop_info']->area_of_operation == 'Interregional'){
            $data['registered_coop'] = $this->amd_union_model->get_registered_interregion($data['coop_info']->regions);
            } else {
            $data['registered_coop'] = $this->amd_union_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName); 

            }
            
            $array =array(
                  'url'=>base_url()."amendment/".$id."/amendment_union",
                  'total_rows'=>$this->amd_union_model->get_applied_coop_count($decoded_id),
                  'per_page'=>$config['per_page']=10,
                  'url_segment'=>4
                  );
                
            $data['links']=$this->paginate($array);

            $data['msg'] = ($submit && empty($data['registered_coop']) ? 'No data found.':'');
            $data['applied_coop'] = $this->amd_union_model->get_applied_coop($decoded_id);
            $this->benchmark->mark('code_end');
            $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage());
            $this->load->view('./template/header', $data);
            $this->load->view('amendment/union/union_list', $data);
            $this->load->view('amendment/union/full_info_modal');
            $this->load->view('amendment/union/add_form_affiliates');
            $this->load->view('amendment/union/edit_form_affiliates');
            $this->load->view('/amendment/union/delete_form_affiliates');
            $this->load->view('./template/footer');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
                $this->benchmark->mark('code_start');
                $data['coop_info'] = $this->amendment_update_model->get_cooperative_info_by_admin($decoded_id);
                $data['capitalization_complete'] =$this->capitalization_model->check_capitalization_primary_complete($decoded_id);
                $data['bylaw_complete'] =$this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id);
                $data['title'] = 'List of Members';
                $data['header'] = 'List of Members';
                $data['admin_info'] = $this->admin_model->get_admin_info($this->session->userdata('user_id'));
                $data['encrypted_id'] = $id;
                $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($decoded_id);
                $data['requirements_complete'] = $this->amd_union_model->is_requirements_complete($decoded_id);
                $data['cc_count'] = $this->amd_union_model->get_total_cc($decoded_id);
                $data['directors_count'] = $this->amd_union_model->check_no_of_directors($decoded_id);
                $data['directors_count_odd'] = $this->amd_union_model->check_directors_odd_number($decoded_id);
                $data['total_directors'] = $this->amd_union_model->no_of_directors($decoded_id);
                $data['chairperson_count'] = $this->amd_union_model->check_chairperson($decoded_id);
                $data['vice_count'] = $this->amd_union_model->check_vicechairperson($decoded_id);
                $data['treasurer_count'] = $this->amd_union_model->check_treasurer($decoded_id);
                $data['secretary_count'] = $this->amd_union_model->check_secretary($decoded_id);
               
                $this->regNo='';
                 $this->regNo='';
                $data['msg']='';
                if($data['coop_info']->area_of_operation == 'Interregional'){
                $data['registered_coop'] = $this->amd_union_model->get_registered_interregion($data['coop_info']->regions);
                } else {
                $data['registered_coop'] = $this->amd_union_model->get_registered_coop($data['coop_info']->area_of_operation,$data['coop_info']->refbrgy_brgyCode,$data['coop_info']->type_of_cooperative,$this->regNo,$this->coopName);
                }
               
                $data['applied_coop'] = $this->amd_union_model->get_applied_coop($decoded_id);

                $this->benchmark->mark('code_end');
                $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage());
                $this->load->view('./templates/admin_header', $data);
                $this->load->view('amendment/union/union_list', $data);
                $this->load->view('amendment/union/full_info_modal');
                $this->load->view('templates/admin_footer', $data);
              }
            }
        }else{
          show_404();
        }
    }
}

    function add_affiliates(){
        $user_id = $this->session->userdata('user_id');
        $query = $this->amd_union_model->existing_unioncoop($user_id,$this->input->post('regNo'));
        $amd_union_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_union_id')));
        $cooperative_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
        $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
        $registered_id = $this->encryption->decrypt(decrypt_custom($this->input->post('registered_id')));

        $data['cc_count'] = $this->amd_union_model->get_total_cc($user_id);
        $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($user_id,$amd_union_id);

        $this->db->where('user_id',$user_id);
        // $this->db->where('id !=',$encrypted_post_coop_id);
        $this->db->where('position', $this->input->post('position'));
        $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
        $this->db->from('amendment_unioncoop');
        $count = $this->db->count_all_results();
        if($count==1){
          $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            redirect('amendment/'.$encrypted_post_coop_id.'/amendment_union');
        } else {
          if($query==0){
           
            // echo $decoded_id;
            if($this->input->post('types')=='cooperative')
            {
              // echo'cooperatives';
               $data = array(
                'amd_union_id'=>$amd_union_id,
                'registeredcoop_id' => $registered_id,
                'regNo' => $this->input->post('regNo'),
                'coopName' => $this->input->post('coopName'),
                'amendment_id' => $amendment_id,
                'cooperative_id' => $cooperative_id,
                'representative' => $this->input->post('fName'),
                'position' => $this->input->post('position'),
                'proof_of_identity' => $this->input->post('validIdType'),
                'valid_id' => $this->input->post('validIdNo'),
                'date_issued' => $this->input->post('dateIssued'),
                'place_of_issuance' => $this->input->post('placeIssuance'),
                'capital_contribution' => str_replace(',', '', $this->input->post('cc')),
                'user_id' => $user_id, 
                'types' => 'cooperative'
                );
            }
            else
            {
              //amendment
               $data = array(
                'amd_union_id'=>$amd_union_id,
                'reg_amendment_id' => $registered_id,
                'regNo' => $this->input->post('regNo'),
                'coopName' => $this->input->post('coopName'),
                'amendment_id' => $amendment_id,
                'representative' => $this->input->post('fName'),
                'position' => $this->input->post('position'),
                'proof_of_identity' => $this->input->post('validIdType'),
                'valid_id' => $this->input->post('validIdNo'),
                'date_issued' => $this->input->post('dateIssued'),
                'place_of_issuance' => $this->input->post('placeIssuance'),
                'capital_contribution' => str_replace(',', '', $this->input->post('cc')),
                'user_id' => $user_id, 
                'types' => 'amendment'
                );
            }


             
              // $this->debug($data); 
              $success = $this->amd_union_model->add_unioncoop($data);
              // echo $this->db->last_query();
              if($success){
                $this->session->set_flashdata('cooperator_success', 'Cooperative Added.');
                      redirect('amendment/'.$this->input->post('amd_union_id').'/amendment_union');
              }else{
                $this->session->set_flashdata('cooperator_error', 'Cooperative Failed to Add.');
                redirect('amendment/'.$this->input->post('amd_union_id').'/amendment_union');
              }
          } else {
  //            echo $query;
              $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
                      redirect('amendment/'.$this->input->post('amd_union_id').'/amendment_union');
          }
        }
    }

    function edit_unioncoop($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        $data['encrypted_id'] = $id;
        $data['is_client'] = $this->session->userdata('client');
        // $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        // $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

        $encryptedcoopid = $this->input->post('cooperativesID');
        $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
        $data['cc_count'] = $this->amd_union_model->get_total_cc($user_id);
        $data['coop_info'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
        
        $this->db->where('user_id',$user_id);
        $this->db->where('id !=',$encrypted_post_coop_id);
        $this->db->where('position', $this->input->post('position'));
        $this->db->where_in('position',array('Chairperson','Vice-Chairperson','Treasurer','Secretary'));
        $this->db->from('amendment_unioncoop');
        $count = $this->db->count_all_results();
        if($count==1){
          $this->session->set_flashdata('cooperator_error', 'Position already exists.');
            redirect('cooperatives/'.$encryptedcoopid.'/unioncoop');
        } else {
          $u_data = array(
              'representative' => $this->input->post('repre'),
              'position' => $this->input->post('position'),
              'proof_of_identity' => $this->input->post('validIdType'),
              'valid_id' => $this->input->post('validIdNo'),
              'date_issued' => $this->input->post('dateIssued'),
              'place_of_issuance' => $this->input->post('place_of_issuance'),
              'capital_contribution' => str_replace(',', '', $this->input->post('cc')),
            );
          // $this->debug($u_data);
          $update_aff = $this->db->update('amendment_unioncoop',$u_data,array('id'=>$encrypted_post_coop_id));

          if($update_aff)
          {  
            $this->session->set_flashdata('cooperator_success', 'Affiliator Successfully Updated.');
              redirect('amendment/'.$encryptedcoopid.'/amendment_union');
          }else{
            $this->session->set_flashdata('cooperator_success', 'Affiliator failed to Update');
            redirect('amendment_update/'.$encryptedcoopid.'/amendment_union');
          }
        }
    }

    function update_cc($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('addAdministratorBtn')){
            $user_id = $this->session->userdata('user_id');
            $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
            $data['encrypted_id'] = $this->encryption->encrypt(encrypt_custom($decoded_id));
            $data['is_client'] = $this->session->userdata('client');
            // $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
            $decoded_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));

            $encryptedcoopid = $this->input->post('cooperativeID');

            // echo $decoded_post_coop_id;
            $encrypted_post_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));

            $u_data = array(
              'capital_contribution' => str_replace(',', '', $this->input->post('cc')),
            );

            // echo $user_id.'-'.$encrypted_post_coop_id;
            $update_aff = $this->db->update('amend_coop',$u_data,array('id'=>$decoded_post_coop_id));

            if($update_aff)
            {  
              $this->session->set_flashdata('cooperator_success', 'Capital Contribution Successfully Updated.');
                redirect('amendment/'.$encryptedcoopid.'/amendment_union');
            }else{
              $this->session->set_flashdata('cooperator_success', 'Capital Contribution failed to Update');
              redirect('amendmentt/'.$encryptedcoopid.'/amendment_union');
            }
          }
        }
    }
    
    function delete_affiliates(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('deleteCooperatorBtn')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $cooperative_id = $this->amendment_update_model->coop_dtl($decoded_id);
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_update_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
//              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                // if(!$this->amendment_update_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  $success = $this->amd_union_model->delete_affiliators($decoded_post_cooperator_id);
                  if($success){
                    $this->session->set_flashdata('cooperator_success', 'Affiliator has been remove.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_union');
                  }else{
                    $this->session->set_flashdata('cooperator_error', 'Unable to remove affiliator.');
                    redirect('amendment/'.$this->input->post('cooperativeID').'/amendment_union');
                  }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'You already submitted for evaluation.');
                //   redirect('amendment_update/'.$this->input->post('cooperativeID'));
                // }
//              }else{
//                $this->session->set_flashdata('cooperator_redirect','Unauthorized!!');
//                redirect('affiliator/'.$this->input->post('cooperativeID').'/affliators');
//              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment_update/'.$this->input->post('cooperativeID'));
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('cooperatives');
            }else{
              $decoded_post_cooperator_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperatorID')));
              if($this->cooperator_model->check_cooperator_in_cooperative($decoded_id,$decoded_post_cooperator_id)){
                if($this->amendment_update_model->check_submitted_for_evaluation($decoded_id)){
                  if($this->amendment_update_model->check_first_evaluated($decoded_id)){
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('cooperatives');
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
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
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
