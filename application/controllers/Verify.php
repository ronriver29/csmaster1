<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

    $this->load->model('Verify_model', 'verifydb');
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
        $coopName = $this->input->get('regid');
        $data = $this->verifydb->getCoop($coopName);
        if($data == true){
            $status_msg = "valid";
        }else{
            $status_msg = "invalid";
        }
        $display = array("coop_reg_num"=>$coopName, "status"=>$status_msg);
        echo json_encode($display, JSON_PRETTY_PRINT);
    }
    else if($this->input->method(TRUE)==="POST"){
      $coopName = $this->input->post('regid');
      $data = $this->verifydb->getCoop($coopName);
      if($data == true){
        $status_msg = "valid";
        }else{
            $status_msg = "invalid";
        }
        $display = array("coop_reg_num"=>$coopName, "status"=>$status_msg);
      header('Content-Type: application/json;charset=utf-8');
      echo json_encode($data, JSON_PRETTY_PRINT);
    }
  }

}
