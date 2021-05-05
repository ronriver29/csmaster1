<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubClass extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
  	 
      $major_industry_id = $this->input->post('major_industry');
      $data =  $this->industry_subclass_model->get_industry_subclasses_amendmnet($major_industry_id);
      echo json_encode($data);
  }

}