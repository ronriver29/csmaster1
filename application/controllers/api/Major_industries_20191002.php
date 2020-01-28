<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_Industries extends CI_Controller{

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
      $data = $this->major_industry_model->get_major_industries($coop_type_id);
      echo json_encode($data);
    }
  }

}
