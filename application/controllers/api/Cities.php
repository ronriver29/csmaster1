<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('city_model');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->city_model->all_cities();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $prov = $this->input->post('province');
      $data = $this->city_model->get_cities($prov);
      echo json_encode($data);
    }
  }

}
