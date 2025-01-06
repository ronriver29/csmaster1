<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class order_of_closure extends CI_Controller{

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

  function index($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');

      //add to registered cooop
      $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
      $branch_code = $this->branches_model->get_branch_addcode($decoded_id);
        if ($branch_info->status==39){
          $this->branches_model->branch_closure($decoded_id,$branch_info->rCode,$branch_info->type,$branch_info->coopName,$branch_info->branchName,$branch_code->subaddcode);
        }
      }

        $data1['director']=$this->branches_model->get_director($branch_info->evaluator_for_closure_2)->full_name;

        $data1['signature'] = "../assets/img/AsecParadillo.png";
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        $data1['effectivity_date'] = $this->registration_model->get_chairman()->effectivity_date;
        $data1['branch_info']=$branch_info;

        set_time_limit(0);

        $html2 = $this->load->view('cooperative/ooc_view', $data1, TRUE);

        $J = new pdf();
        $J->set_option('isRemoteEnabled',TRUE);
        $J->set_paper([0,0,612,936], "portrait"); //mm to point
        $J->load_html($html2);
        $J->render();
        $J->stream("certificate.pdf", array("Attachment"=>0));


  }
  public function OrdinalIndicator($dateRegistered)
  {
        $date_day = date('d',strtotime($dateRegistered));
        $num_day= substr($date_day,-1);
        $char_length = strlen($date_day);
        $ordinal_indicator='';
        $nums ='';
        $num_array = array(10,11,12,13,14,15,16,17,18,19,20,30);
        if(in_array($date_day,$num_array))
        {
          $ordinal_indicator ='th';
        }
        else
        {
            switch ($num_day) {
            case 1:
              $ordinal_indicator='st';
              break;
            case 2:
              $ordinal_indicator='nd';
              break;
            case 3:
              $ordinal_indicator='rd';
              break;
            default:
               $ordinal_indicator='th';
              break;
          }
        }

        return $date_day.$ordinal_indicator;//$num_day.$ordinal_indicator;
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
