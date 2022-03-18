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
    // header("Location: https://222.127.109.48/epp20200915/mpi.php"); 
    // exit();
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $data['encrypted_id'] = $id;
    $this->load->view('payment_form',$data);

    // $postdata = array(
    // 'MerchantCode' => '2018070336',
    // 'MerchantRefNo' => '1234',
    // 'Hash' => 'e6fc2a9e521ee7c5a6477edc7192879e'
    // );
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://222.127.109.48/ epp20200915/api2-
    // status.php");
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output = curl_exec($ch);
    // echo var_dump($output);
    // curl_close($ch);
  }

  public function ok(){

    $data['sta']='ok';
     $this->load->view('payment_form',$data);
  }
    
  public function error(){

    $data['sta']='error';
     $this->load->view('payment_form',$data);
  }

  public function submit(){
    // echo ;
  }

  // public function posting(){
  //   $postdata = array(
  //     'MerchantCode' => '0001',
  //     'MerchantRefNo' => '1234',
  //     'Hash' => 'e6fc2a9e521ee7c5a6477edc7192879e'
  //   );

  //   $ch = curl_init();
  //   curl_setopt($ch, CURLOPT_URL, " https://222.127.109.48/ epp20200915/api2-
  //   status.php");
  //   curl_setopt($ch, CURLOPT_POST, 1);
  //   curl_setopt($ch, CURLOPT_HEADER, 0);
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //   $output = curl_exec($ch);
  //   curl_close($ch);
  // }
}
?>
