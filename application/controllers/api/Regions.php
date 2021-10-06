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
    // $data = $this->region_model->get_regions();
    // echo json_encode($data);

    if($this->input->method(TRUE)==="GET"){
      $data = $this->region_model->get_regions();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $regions = $this->input->post('regions');
      $regions = implode(',',$regions);
      $data = $this->region_model->get_selected_regions($regions);
      // echo $this->db->last_query();
      echo json_encode($data);
    }
  }

}
