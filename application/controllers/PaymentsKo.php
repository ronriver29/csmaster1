<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentsKo extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $data['encrypted_id'] = $id;
    $this->load->view('payment_form',$data);
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
