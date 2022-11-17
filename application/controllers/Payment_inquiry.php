<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Payment_inquiry extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->model('admin_model');
      $this->load->model('region_model');
      $this->load->model('amendment_model');
      $this->load->model('cooperatives_model');
      $this->load->model('branches_model');
      $this->load->model('user_model');
      $this->load->model('email_model');
      $this->load->library("pagination");
      //Codeigniter : Write Less Do More
    }

    function index()
    {
      if($this->session->userdata('logged_in')){
        if(!$this->session->userdata('client')){
          redirect('payment_inquiry/cooperatives_inquiry');
        }else{
          redirect('cooperatives');
        }
      }else{
        redirect('admins/login');
      }
    }

    public function cooperatives_inquiry(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'Payment Inquiry';
            $data['header'] = 'Payment Inquiry - Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

            if(isset($_POST['submit'])){

              $trans_number = $this->input->post('trans_number');
              $epp_number = $this->input->post('epp_number');

              if($trans_number == '' && $epp_number == ''){
                $data['no_data'] = 'No Record Found!';
              } else {
                if($data['admin_info']->region_code=="00"){
                  $data['list_cooperatives_inquiry'] = $this->cooperatives_model->get_all_cooperatives_inquiry($data['admin_info']->region_code);
                }else{
                  $data['list_cooperatives_inquiry'] = $this->cooperatives_model->get_all_cooperatives_inquiry($data['admin_info']->region_code,$trans_number,$epp_number);
                  // echo $this->db->last_query();
                }
              }

            }

            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_payments_cooperatives', $data);
            $this->load->view('templates/admin_footer');
          }
      }
    }

    public function bns_inquiry(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'Payment Inquiry';
            $data['header'] = 'Payment Inquiry - Branch/Satellite';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

            if(isset($_POST['submit'])){

              $trans_number = $this->input->post('trans_number');
              $epp_number = $this->input->post('epp_number');

              if($trans_number == '' && $epp_number == ''){
                $data['no_data'] = 'No Record Found!';
              } else {
                if($data['admin_info']->region_code=="00"){
                  $data['list_bns_inquiry'] = $this->cooperatives_model->get_all_bns_inquiry($data['admin_info']->region_code);
                }else{
                  $data['list_bns_inquiry'] = $this->cooperatives_model->get_all_bns_inquiry($data['admin_info']->region_code,$trans_number,$epp_number);
                  // echo $this->db->last_query();
                }
              }
            }

            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_payments_bns', $data);
            $this->load->view('templates/admin_footer');
          }
      }
    }

    public function laboratory_inquiry(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'Payment Inquiry';
            $data['header'] = 'Payment Inquiry - Laboratory';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

            if(isset($_POST['submit'])){

              $trans_number = $this->input->post('trans_number');
              $epp_number = $this->input->post('epp_number');

              if($trans_number == '' && $epp_number == ''){
                $data['no_data'] = 'No Record Found!';
              } else {
                if($data['admin_info']->region_code=="00"){
                  $data['list_laboratory_inquiry'] = $this->cooperatives_model->get_all_laboratory_inquiry($data['admin_info']->region_code);
                }else{
                  $data['list_laboratory_inquiry'] = $this->cooperatives_model->get_all_laboratory_inquiry($data['admin_info']->region_code,$trans_number,$epp_number);
                  // echo $this->db->last_query();
                }
              }
            }

            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_payments_laboratory', $data);
            $this->load->view('templates/admin_footer');
          }
      }
    }

    public function amendment_inquiry(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'Payment Inquiry';
            $data['header'] = 'Payment Inquiry - Amendment';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

            if(isset($_POST['submit'])){

              $trans_number = $this->input->post('trans_number');
              $epp_number = $this->input->post('epp_number');

              if($trans_number == '' && $epp_number == ''){
                $data['no_data'] = 'No Record Found!';
              } else {
                if($data['admin_info']->region_code=="00"){
                  $data['list_amendment_inquiry'] = $this->cooperatives_model->get_all_amendment_inquiry($data['admin_info']->region_code);
                }else{
                  $data['list_amendment_inquiry'] = $this->cooperatives_model->get_all_amendment_inquiry($data['admin_info']->region_code,$trans_number,$epp_number);
                  // echo $this->db->last_query();
                }
              }
            }

            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_payments_amendment', $data);
            $this->load->view('templates/admin_footer');
          }
      }
    }

  }

 ?>
