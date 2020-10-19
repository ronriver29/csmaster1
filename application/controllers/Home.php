<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      // $uid = $this->session->userdata('user_id');
      // if($this->cooperatives_model->check_cooperative_exist($uid)){
      //   if(!$this->cooperatives_model->check_expired_reservation($uid)){
      //     $data['title'] = 'Dashboard';
      //     $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($uid);
      //     $this->load->view('template/header', $data);
      //     $this->load->view('dashboard/dashboard.php', $data);
      //     $this->load->view('template/footer');
      //   }else{
      //     redirect('cooperatives/reservation_update');
      //   }
      // }else{
      //   redirect('cooperatives/reservation');
      // }
          // $data['title'] = 'Dashboard';
          // $this->load->view('template/header', $data);
          // $this->load->view('applications/list_of_applications', $data);
          // $this->load->view('template/footer');
    }
    // if($this->session->userdata('coop_exists')){
      // echo $this->session->userdata('coop_exists');
  }
}
