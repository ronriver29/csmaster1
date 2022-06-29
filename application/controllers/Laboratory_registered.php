<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory_registered extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('admin_model');
    $this->load->model('laboratories_model');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      $data['is_client'] = $this->session->userdata('client');
      if(!$this->session->userdata('client')){
        $regNo = $this->encryption->decrypt(decrypt_custom($id));
        $admin_user_id = $this->session->userdata('user_id');
        // if($this->admin_model->check_super_admin($admin_user_id)){
          
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['users_list'] = $this->admin_model->get_all_user();

          $data['get_registered_laboratory_info'] = $this->laboratories_model->get_laboratory_registered_info($regNo);

          $data['title'] = 'Laboratories of '.$data['get_registered_laboratory_info']->labName;
          $data['header'] = 'Laboratories of '.$data['get_registered_laboratory_info']->labName;

          $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories_registered($regNo);

          $this->load->view('templates/admin_header', $data);
          $this->load->view('applications/list_of_registered_laboratories', $data);
          $this->load->view('templates/admin_footer');
        // }else{
        //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        //   redirect('branches');
        // }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('branches');
      }
    }
  }
}
