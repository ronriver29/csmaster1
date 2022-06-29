<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangays extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('barangay_model');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->barangay_model->all_barangays();
      echo json_encode($data);
    }
    else if($this->input->method(TRUE)==="POST"){
      $cities = $this->input->post('cities');
      $data = $this->barangay_model->get_barangays($cities);
      echo json_encode($data);
    }
  }

}
