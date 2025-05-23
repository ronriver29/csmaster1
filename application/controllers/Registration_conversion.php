<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class registration_conversion extends CI_Controller{

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
      $branch_code = $this->branches_model->get_branch_addcode($decoded_id);
      if ($branch_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($branch_info->category_of_cooperative =='Secondary')
        $pst="2";
      else
        $pst="3";
      $type=substr($branch_info->branchName, -7);

      if($branch_info->status == 67){
        $this->branches_model->register_branch($branch_info);
      }
      if ($branch_info->status==20)

        // $this->branches_model->register_branch($type,$decoded_id,$branch_info->rCode,$pst,$branch_info->type,$branch_info->coopName,$branch_info->branchName,$branch_code->subaddcode);
        $x = $this->registration_model->registered_branch_count($branch_info->type,$branch_info->coopName,$branch_code->subaddcode);
        $branch_details = $this->branches_model->get_branch_info_by_admin($decoded_id);
        $cName=$branch_details->coopName.' - '.$branch_details->branchName;


        // if ($branch_details->qr_code==null || ($branch_details->qr_code='')){
          if ($type=='Branch'){
            $label='Certificate of Authority No:';
          }else{
            $label='Letter of Authority No:';
          }
          $qr_code_config = array();
          $qr_code_config['cacheable'] = $this->config->item('cacheable');
          $qr_code_config['cachedir'] = $this->config->item('cachedir');
          $qr_code_config['imagedir'] = $this->config->item('imagedir');
          $qr_code_config['errorlog'] = $this->config->item('errorlog');
          $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
          $qr_code_config['quality'] = $this->config->item('quality');
          $qr_code_config['size'] = $this->config->item('size');
          $qr_code_config['black'] = $this->config->item('black');
          $qr_code_config['white'] = $this->config->item('white');
          $this->ci_qr_code->initialize($qr_code_config);

          // get full name and user details

          $image_name = $branch_details->certNo.".png";

          // create user content
          $codeContents = "Name:";
          $codeContents .= $cName;
          $codeContents .= "\n";
          $codeContents .= $label;
          $codeContents .= $branch_details->certNo;
          $codeContents .= "\n";
          $codeContents .= "Date Registered:";
          $codeContents .= $branch_details->dateRegistered;

          $params['data'] = $codeContents;
          $params['level'] = 'H';
          $params['size'] = 2;

          $params['savename'] =$qr_code_config['imagedir'] . $image_name;// FCPATH . $qr_code_config['imagedir'] . $image_name;
          $this->ci_qr_code->generate($params);

          $this->data['qr_code_image_url'] =$qr_code_config['imagedir'] . $image_name;

          // save image path in tree table
          $this->registration_model->save_branch_qr_code($branch_details->certNo, $image_name);
        // }

        $data1['signature'] = "../assets/img/AsecJoy.png";
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        $data1['effectivity_date'] = $this->registration_model->get_chairman()->effectivity_date;
        $data1['branch_info']=$branch_details;
        // $data1['director']=$this->registration_model->get_director($user_id)->full_name;
        $data1['type']=$type;

        set_time_limit(0);

        // $this->load->view('cooperative/CO_view', $data1);

        $html2 = $this->load->view('cooperative/CO_view', $data1, TRUE);

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
