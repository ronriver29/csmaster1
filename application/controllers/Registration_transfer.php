<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class registration_transfer extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('user_model', 'user');
    $this->load->library('ci_qr_code');
    $this->config->load('qr_code');
    $this->load->model('branches_model');
    $this->load->model('registration_model');
    $this->load->model('charter_model');
  }
  function index($id = null) {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');

      //add to registered cooop
      $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
      $branch_info_region_trans = $this->branches_model->get_branch_info_transferred_by_admin($decoded_id);
      $branch_code = $this->branches_model->get_branch_addcode($decoded_id);
      
      if ($branch_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($branch_info->category_of_cooperative =='Secondary')  
        $pst="2";
      else
        $pst="3";
      $type=substr($branch_info->branchName, -7);
      
      if($branch_info->status == 53){
        $this->branches_model->register_branch_transfer($branch_info);
      }

      $data1['director']=$this->branches_model->get_director($branch_info->evaluator_for_transfer_3)->full_name;

        $data1['signature'] = "../assets/img/AsecJoy.png"; 
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        $data1['effectivity_date'] = $this->registration_model->get_chairman()->effectivity_date;
        $data1['branch_info']=$branch_info;
        $data1['branch_info_region_trans']=$branch_info_region_trans;
        
        set_time_limit(0);

        $html2 = $this->load->view('cooperative/oot_view', $data1, TRUE);

        $J = new pdf();       
        $J->set_option('isRemoteEnabled',TRUE);
        $J->set_paper([0,0,612,936], "portrait"); //mm to point
        $J->load_html($html2);
        $J->render();
        $J->stream("certificate.pdf", array("Attachment"=>0));
      
    }
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}