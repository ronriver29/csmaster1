<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperative_Types extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->cooperative_type_model->all_cooperative_types();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $act_subtype_id = $this->input->post('business_activity_subtype_id');
      $data = $this->cooperative_type_model->get_cooperative_type($act_subtype_id);
      echo json_encode($data);
    }
  }

}
