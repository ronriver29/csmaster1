<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentsKo extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {
    
    $this->load->view('payment_form');
  }

  public function ok(){

    $data['sta']='ok';
     $this->load->view('payment_form',$data);
  }
    
  public function error(){

    $data['sta']='error';
     $this->load->view('payment_form',$data);
  }
}
