<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces_bns extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->province_model->all_provinces();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $region = $this->input->post('region');
      $data = $this->province_model->get_provinces($region);
      echo json_encode($data);
    }
  }

}
