<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_subclasses extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = array();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $coop_type_id = $this->input->post('coop_type');
      $major_industry_id = $this->input->post('major_industry');
      $data = $this->industry_subclass_model->get_industry_subclasses($coop_type_id,$major_industry_id);
      echo json_encode($data);
    }
  }

}
