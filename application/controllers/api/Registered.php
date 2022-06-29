<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registered extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('registration_model');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    // $data = $this->region_model->get_regions();
    // echo json_encode($data);

    if($this->input->method(TRUE)==="GET"){
      $data = $this->registration_model->get_registeredcoop();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $regno = $this->input->post('regno');
      // $regno = implode(',',$regno);
      $data = $this->registration_model->get_selected_registered_coop($regno);
      // echo $this->db->last_query();
      echo json_encode($data);
    }
  }

}
