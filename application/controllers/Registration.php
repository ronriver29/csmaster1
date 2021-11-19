<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class registration extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('user_model', 'user');
    $this->load->library('ci_qr_code');
    $this->config->load('qr_code');
  }

  function index($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');

      //add to registered cooop
      $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

      if ($coop_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($coop_info->category_of_cooperative =='Secondary')  
        $pst="2";
      else
        $pst="3";
      if($coop_info->grouping == 'Union'){
        if(!empty($coop_info->acronym_name)){ 
            $acronymname = '('.$coop_info->acronym_name.') ';
        } else {
            $acronymname = '';
        }
      } else {
        if(!empty($coop_info->acronym_name)){ 
            $acronymname = '('.$coop_info->acronym_name.')';
        } else {
            $acronymname = '';
        }
      }
     
      if ($coop_info->status==14){
        if(!$this->registration_model->register_coop($decoded_id,$coop_info,$pst,$acronymname))
        {
            echo "Failed to print registration details";
            exit;
        }
      }
      if($coop_info->grouping == 'Federation'){
        $cName=rtrim($coop_info->proposed_name.' Federation of '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname);
      } if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
        $cName=rtrim($coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname);
      } else {
        $cName=rtrim($coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname.' '.$coop_info->grouping);
      }
      // echo $coop_info->id;
      // $cName = $coop_info->id;
      if($coop_info->grouping == 'Union'){
        $coop_details = $this->registration_model->get_coop_info_union($coop_info->id);
      } else if($coop_info->grouping == 'Federation'){
        $coop_details = $this->registration_model->get_coop_info_federation($coop_info->id);
      }else {
        $coop_details = $this->registration_model->get_coop_info($cName);
      }
      

      // echo $coop_details;
      // echo print_r($coop_details);
      // $this->debug($coop_details);
      // echo $this->db->last_query();
//      if ($coop_details->qr_code==null || ($coop_details->qr_code=='')){
      // $pathss = APPPATH.'../assets/qr_code/tmp/logs';
      // chmod($pathss, 0777);
      //  $paths = APPPATH.'../assets/qr_code/tmp/logs/';
      // chmod($paths, 0777);
          // more code
      //     chmod($path, 0755);
      // }

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
        $image_name = $coop_details->regNo.".png";
      
        // create user content
        $codeContents = "Cooperative Name:";
        $codeContents .= $coop_details->coopName;
        $codeContents .= "\n";
        $codeContents .= "Registration No:";
        $codeContents .= $coop_details->regNo;
        $codeContents .= "\n";
        $codeContents .= "Date Registered:";
        $codeContents .= $coop_details->dateofor;

        $params['data'] = $codeContents;
        $params['level'] = 'H';
        $params['size'] = 2;

        $params['savename'] = $qr_code_config['imagedir'] . $image_name;
        $this->ci_qr_code->generate($params);

        $this->data['qr_code_image_url'] = $qr_code_config['imagedir'] . $image_name;

        // save image path in tree table
        $this->registration_model->save_qr_code($coop_details->regNo, $image_name);
//      }
      $registereddate = date("Y-m-d",strtotime($coop_details->dateRegistered));
      // 04-18-2021
      if($coop_details->date_of_or >= "2021-04-15"){
        // $data1['mydateregistered'] = $coop_details->date_of_or;
        $data1['signature'] = "../assets/img/AsecJoy.png"; 
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
      } else {
        // $data1['mydateregistered'] = $registereddate;
        $data1['chair'] = $this->registration_model->get_chairman2()->chairman;
        $data1['signature'] = "../assets/img/1.png"; 
      }


      
      $data1['coop_info']=$coop_details;
      // $data1['director']=$this->registration_model->get_director($user_id)->full_name;
      // Get Count Coop Type for HO
        $this->db->where(array('name'=>$coop_info->type_of_cooperative,'active'=>1));
        $this->db->from('head_office_coop_type');
      // End Get Count Coop Type
      if($this->db->count_all_results()>0){
        $data1['director']=$this->registration_model->get_director($coop_info->third_evaluated_by);
      } else {
        $data1['director']=$this->registration_model->get_director($coop_info->third_evaluated_by);
      }
   
          set_time_limit(0);

       $data1['date_year']= date('Y',strtotime($data1['coop_info']->dateofor));
        $data1['date_month'] =date('F',strtotime($data1['coop_info']->dateofor));
        $dateDay = date('d',strtotime($data1['coop_info']->dateofor));
        $data1['date_day']=$this->OrdinalIndicator($data1['coop_info']->dateofor);

        $dt_data = substr($data1['date_day'],0,1);
       if($dt_data=="0")
        {
          $data1['date_day']=substr($data1['date_day'],1);
        }
      
        $data1['in_chartered_cities'] =false;
        // $this->debug($data1['coop_info']);
        if($this->charter_model->in_charter_city($data1['coop_info']->cCode))
        {
          $data1['in_chartered_cities']=true;
          $data1['chartered_cities'] =$this->charter_model->get_charter_city($data1['coop_info']->cCode);
        }
        $data1['memory_usage'] = memory_get_usage();
     

         // $html2 = $this->load->view('cooperative/cor_view', $data1);
         $html2 = $this->load->view('cooperative/cor_view', $data1, TRUE);
           $J = new pdf();       
           $J->set_option('isRemoteEnabled',TRUE);
           $J->setPaper('folio', 'portrait');
           $J->load_html($html2);
           $J->render();
           $J->stream("certificate.pdf", array("Attachment"=>0));
    }
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
  function branch($id = null) {
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
      
      if ($branch_info->status==20)
        $this->registration_model->register_branch($type,$decoded_id,$branch_info->rCode,$pst,$branch_info->type,$branch_info->coopName,$branch_info->branchName,$branch_code->subaddcode);
        $x = $this->registration_model->registered_branch_count($branch_info->type,$branch_info->coopName,$branch_code->subaddcode);
        $branch_details = $this->branches_model->get_branch_info_by_admin($decoded_id);
        $cName=$branch_details->coopName.' - '.$branch_details->branchName;
        
        
        if ($branch_details->qr_code==null || ($branch_details->qr_code='')){
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
        }
        
        $data1['signature'] = "../assets/img/AsecJoy.png"; 
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        $data1['effectivity_date'] = $this->registration_model->get_chairman()->effectivity_date;
        $data1['branch_info']=$branch_details;
        // $data1['director']=$this->registration_model->get_director($user_id)->full_name;
        $data1['type']=$type;
        
        set_time_limit(0);

           //$this->load->view('cooperative\order_of_payment', $data1);

        $html2 = $this->load->view('cooperative/CA_view', $data1, TRUE);
        // $J = new pdf();       
        // $J->set_option('isRemoteEnabled',TRUE);
        // $J->setPaper('folio', 'portrait');
        // $J->load_html($html2);
        // $J->render();
        // $J->stream("certificate.pdf", array("Attachment"=>0));

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