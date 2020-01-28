<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data = $this->region_model->get_regions();
    echo json_encode($data);
  }

}
