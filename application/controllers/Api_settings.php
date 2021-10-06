<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_settings extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'API Settings';
          $data['header'] = 'API Settings';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['admins_list'] = $this->admin_model->get_all_admin();
          $data['api_config'] = $this->api_model->get_api_config_info();
          $this->load->view('./templates/admin_header', $data);
          $this->load->view('messages_settings/api_settings', $data);
          // $this->load->view('admin/delete_modal_admin', $data);
          $this->load->view('./templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function edit(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'API Settings';
            $data['header'] = 'API Settings';
            $data['regions_list'] = $this->region_model->get_regions();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/api_settings', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            $data = array(
              'url' => $this->input->post('url'),
              'apikey'=> $this->input->post('apikey'),
              'senderid' => $this->input->post('senderid'),
              'maxchar' => $this->input->post('maxchar'),
              'userid_last_update' => $admin_user_id,
              'date_last_update' => date('Y-m-d H:i:s')
            );

            // if($success['success']){
              if($this->api_model->update_api($data)){
                $this->session->set_flashdata('update_admin_success', 'Successfully updated API.');
                redirect('api_settings');
              }else{
                $this->session->set_flashdata('update_admin_error', 'Unable to update API.');
                redirect('api_settings');
              }
            // }else{
            //   $this->session->set_flashdata('update_admin_error', $success['message']);
            //   // redirect('api_settings');
            // }
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function primary(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'SMS Allowed Actions - Primary';
            $data['header'] = 'SMS Allowed Actions - Primary';
            $data['primary_sms_list'] = $this->api_model->get_sms_primary();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/v_primary', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            foreach($this->input->post('page_id') as $page_id) {

              // $access_level = $items['access_level_'.$page_id];
                $data['message'] = $this->input->post('message_'.$page_id);

                if($this->input->post('allowed_'.$page_id) != null) {
                    $data['allowed'] = 1;
                } else {
                    $data['allowed'] = 0;
                }

                $data['userid_last_update'] = $admin_user_id;
                $data['date_last_update'] = date('Y-m-d H:i:s');

                if($this->api_model->update_sms_allowed_actions_primary($data,$page_id)){
                  // echo $this->db->last_query();
                  // $this->session->set_flashdata('update_admin_success', 'Successfully updated API.');
                  // redirect('api_settings/primary');
                }else{
                  // $this->session->set_flashdata('update_admin_error', 'Unable to update API.');
                  // redirect('api_settings/primary');
                }
            }

            $this->session->set_flashdata('update_admin_success', 'Successfully updated SMS Actions.');
            redirect('api_settings/primary');

            // $this->session->set_flashdata('update_admin_success', 'Successfully updated API.');
            // redirect('api_settings/primary');
            // $data = array(
            //   'url' => $this->input->post('url'),
            //   'apikey'=> $this->input->post('apikey'),
            //   'senderid' => $this->input->post('senderid'),
            //   'maxchar' => $this->input->post('maxchar'),
            //   'userid_last_update' => $admin_user_id,
            //   'date_last_update' => date('Y-m-d H:i:s')
            // );

            // if($success['success']){
              
            // }else{
            //   $this->session->set_flashdata('update_admin_error', $success['message']);
            //   // redirect('api_settings');
            // }
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function bns_inside(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'SMS Allowed Actions - Branch & Satellite';
            $data['header'] = 'SMS Allowed Actions - Branch & Satellite';
            $data['bns_inside_sms_list'] = $this->api_model->get_sms_bns_inside();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/v_bns_inside', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            foreach($this->input->post('page_id') as $page_id) {

              // $access_level = $items['access_level_'.$page_id];
                $data['message'] = $this->input->post('message_'.$page_id);

                if($this->input->post('allowed_'.$page_id) != null) {
                    $data['allowed'] = 1;
                } else {
                    $data['allowed'] = 0;
                }

                $data['userid_last_update'] = $admin_user_id;
                $data['date_last_update'] = date('Y-m-d H:i:s');

                if($this->api_model->update_sms_allowed_actions_primary($data,$page_id)){
                  // echo $this->db->last_query();
                  // $this->session->set_flashdata('update_admin_success', 'Successfully updated API.');
                  // redirect('api_settings/primary');
                }else{
                  // $this->session->set_flashdata('update_admin_error', 'Unable to update API.');
                  // redirect('api_settings/primary');
                }
            }

            $this->session->set_flashdata('update_admin_success', 'Successfully updated SMS Actions.');
            redirect('api_settings/bns_inside');

            // $this->session->set_flashdata('update_admin_success', 'Successfully updated API.');
            // redirect('api_settings/primary');
            // $data = array(
            //   'url' => $this->input->post('url'),
            //   'apikey'=> $this->input->post('apikey'),
            //   'senderid' => $this->input->post('senderid'),
            //   'maxchar' => $this->input->post('maxchar'),
            //   'userid_last_update' => $admin_user_id,
            //   'date_last_update' => date('Y-m-d H:i:s')
            // );

            // if($success['success']){
              
            // }else{
            //   $this->session->set_flashdata('update_admin_error', $success['message']);
            //   // redirect('api_settings');
            // }
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function bns_outside(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'SMS Allowed Actions - Branch & Satellite';
            $data['header'] = 'SMS Allowed Actions - Branch & Satellite';
            $data['bns_outside_sms_list'] = $this->api_model->get_sms_bns_outside();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/v_bns_outside', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            foreach($this->input->post('page_id') as $page_id) {

              // $access_level = $items['access_level_'.$page_id];
                $data['message'] = $this->input->post('message_'.$page_id);

                if($this->input->post('allowed_'.$page_id) != null) {
                    $data['allowed'] = 1;
                } else {
                    $data['allowed'] = 0;
                }

                $data['userid_last_update'] = $admin_user_id;
                $data['date_last_update'] = date('Y-m-d H:i:s');

                $this->api_model->update_sms_allowed_actions_primary($data,$page_id);

            }

            $this->session->set_flashdata('update_admin_success', 'Successfully updated SMS Actions.');
            redirect('api_settings/bns_outside');

          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function laboratories(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'SMS Allowed Actions - Laboratories';
            $data['header'] = 'SMS Allowed Actions - Laboratories';
            $data['laboratories_sms_list'] = $this->api_model->get_sms_laboratories();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/v_laboratories', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            foreach($this->input->post('page_id') as $page_id) {

              // $access_level = $items['access_level_'.$page_id];
                $data['message'] = $this->input->post('message_'.$page_id);

                if($this->input->post('allowed_'.$page_id) != null) {
                    $data['allowed'] = 1;
                } else {
                    $data['allowed'] = 0;
                }

                $data['userid_last_update'] = $admin_user_id;
                $data['date_last_update'] = date('Y-m-d H:i:s');

                $this->api_model->update_sms_allowed_actions_primary($data,$page_id);

            }

            $this->session->set_flashdata('update_admin_success', 'Successfully updated SMS Actions.');
            redirect('api_settings/laboratories');

          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  function amendment(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'SMS Allowed Actions - Amendment';
            $data['header'] = 'SMS Allowed Actions - Amendment';
            $data['amendment_sms_list'] = $this->api_model->get_sms_amendment();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['api_config'] = $this->api_model->get_api_config_info();
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('messages_settings/v_amendment', $data);
            $this->load->view('./templates/admin_footer');
          }else{

            foreach($this->input->post('page_id') as $page_id) {

              // $access_level = $items['access_level_'.$page_id];
                $data['message'] = $this->input->post('message_'.$page_id);

                if($this->input->post('allowed_'.$page_id) != null) {
                    $data['allowed'] = 1;
                } else {
                    $data['allowed'] = 0;
                }

                $data['userid_last_update'] = $admin_user_id;
                $data['date_last_update'] = date('Y-m-d H:i:s');

                $this->api_model->update_sms_allowed_actions_primary($data,$page_id);

            }

            $this->session->set_flashdata('update_admin_success', 'Successfully updated SMS Actions.');
            redirect('api_settings/amendment');

          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }

  public function messages_list(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      $data['is_client'] = $this->session->userdata('client');
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'List of Messages';
          $data['header'] = 'List of Messages';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['users_list'] = $this->admin_model->get_all_user();

          $data['list_messages'] = $this->api_model->get_all_messages();

          $this->load->view('templates/admin_header', $data);
          $this->load->view('messages_settings/v_messages', $data);
          $this->load->view('templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('messages_list');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('messages_list');
      }
    }
  }

  public function blocked_no(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      $data['is_client'] = $this->session->userdata('client');
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'List of Blocked No.';
          $data['header'] = 'List of Blocked No.';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['users_list'] = $this->admin_model->get_all_user();

          $data['list_blocked_no'] = $this->api_model->get_all_blocked_no();

          $this->load->view('templates/admin_header', $data);
          $this->load->view('messages_settings/v_blocked_no', $data);
          $this->load->view('messages_settings/add_blocked_no', $data);
          $this->load->view('messages_settings/edit_blocked_no', $data);
          $this->load->view('messages_settings/delete_blocked_no', $data);
          $this->load->view('templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('messages_list');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('messages_list');
      }
    }
  }

  function add_blocked_no($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        if($query==0){
            $data = array(
              'mobile' => $this->input->post('mobile'),
              'reason' => $this->input->post('reason'),
              'useridlastupdate' => $user_id,
              'date_last_update' => date('Y-m-d H:i:s'),  
              );

            $success = $this->api_model->add_blocked_no($data);
            if($success){
              $this->session->set_flashdata('cooperator_success', 'Mobile No. Added.');
                    redirect('api_settings/blocked_no');
            }else{
              $this->session->set_flashdata('cooperator_success', 'Mobile No. Failed to Add');
              redirect('api_settings/blocked_no');
            }
        } else {
            $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
                    redirect('api_settings');
        }
    }

    function edit_blocked_no($id = null){
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('blockedid')));
        $query = $this->affiliators_model->existing_affiliators($user_id,$this->input->post('regNo'));
        if($query==0){
            $data = array(
              'mobile' => $this->input->post('mobile'),
              'reason' => $this->input->post('reason'),
              'useridlastupdate' => $user_id,
              'date_last_update' => date('Y-m-d H:i:s'),  
              );

            $success = $this->api_model->edit_blocked_no($data,$decoded_id);
            if($success){
              $this->session->set_flashdata('cooperator_success', 'Mobile No. Edited.');
                    redirect('api_settings/blocked_no');
            }else{
              $this->session->set_flashdata('cooperator_success', 'Mobile No. Failed to Edit');
              redirect('api_settings/blocked_no');
            }
        } else {
            $this->session->set_flashdata('cooperator_error', 'Cooperative already exists.');
                    redirect('api_settings');
        }
    }

    public function delete_blocked_no(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('api_settings');
        }else{
          if($this->input->post('deleteCooperatorBtn')){
            $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('blockedid')));
              if($this->api_model->delete_blocked_no($decoded_aid)){
                $this->session->set_flashdata('delete_admin_success', 'Successfully deleted a Mobile Number.');
                redirect('api_settings/blocked_no');
              }else{
                $this->session->set_flashdata('delete_admin_error', 'Unable to delete Mobile Number.');
                redirect('api_settings/blocked_no');
              }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('api_settings/blocked_no');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('api_settings');
      }
    }
  }
}