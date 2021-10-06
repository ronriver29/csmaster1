<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Islands extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = $this->island_model->all_islands();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $interregional = $this->input->post('interregional');
      $interregional = implode(',',$interregional);
      $data = $this->island_model->get_islands($interregional);
      // echo $this->db->last_query();
      echo json_encode($data);
    }
  }

}
