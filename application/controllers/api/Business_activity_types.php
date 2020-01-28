<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_Activity_Types extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->business_activity_model->get_business_activities();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $data = $this->business_activity_model->get_business_activities();
      echo json_encode($data);
    }
  }

}
