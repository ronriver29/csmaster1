<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_Activity_Subtypes extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('business_activity_subtype_model');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      echo json_encode('error');
    }else if($this->input->method(TRUE)==="POST"){
      $act_id = $this->input->post('business_activity_id');
      $data = $this->business_activity_subtype_model->get_business_activity_subtype($act_id);
      echo json_encode($data);
    }
  }

}
