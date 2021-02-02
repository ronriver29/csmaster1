<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_registration extends CI_Controller{

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
      $coop_info = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
      if ($coop_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($coop_info->category_of_cooperative =='Secondary')  
        $pst="2";
      else
        $pst="3";

      // $cooperative_id = $this->registration_model->coop_dtl($decoded_id);
      $rCode = $coop_info->rCode;
      $x=$this->registration_model->registered_coop_count()+1;
    $j='9520-'.$pst.$rCode;
    for($a=strlen($x);$a<8;$a++) //modify by json from 12 to 8
      $j=$j.'0';
    $j=$j.$x;

      $amendment_no ='';
      $qry_amd_no = $this->db->query("select amendmentNo from amend_coop where cooperative_id=813 and status=15 order by id desc limit 1");
      if($qry_amd_no->num_rows()>0)
      {
        if($qry_amd_no->num_rows()==1)
        {
           $amendment_no=1;
         
        }
        else
        {
           $amendment_no = $qry_amd_no->num_rows()+1;
        }
       
      }
      else
      {
        $amendment_no = 1;
      }
        if($this->db->update('amend_coop',array('amendmentNo'=>$amendment_no),array('id'=>$decoded_id)))
        {
          
 
            $data_reg = array(
              'coopName'=>$coop_info->proposed_name.' '.$coop_info->type_of_cooperative,
              'acronym'=> $coop_info->acronym,
              'regNo'=> $coop_info->regNo,
              'category'=> $coop_info->category_of_cooperative,
              'type'=> $coop_info->type_of_cooperative,
              'dateRegistered'=>$coop_info->dateRegistered,
              'commonBond'=> $coop_info->common_bond_of_membership,
              'areaOfOperation'=>$coop_info->area_of_operation,
              'noStreet'=> $coop_info->house_blk_no,
              'Street' => $coop_info->street,
              'addrCode'=> $coop_info->addrCode,
              'compliant'=>'Compliant',
              // 'qr_code'=>$j,
              'application_id'=>$coop_info->application_id,
              'amendment_id'=>$decoded_id
            );

      
      
            $this->registration_model->register_coop_amendment($decoded_id,$data_reg,$pst);
            // $this->debug($this->registration_model->register_coop_amendment($decoded_id,$coop_info->rCode,$pst));
            $cName=$coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping;
            $coop_details = $this->registration_model->get_coop_info_amendment($decoded_id);
            // $amend_coop_details = $this->registration_model->get_coop_info_amendment($decoded_id);
            // $this->debug($coop_details);
            // $this->debug($coop_info);
            // if (strlen($coop_info->qr_code)<1 || $coop_info->qr_code='')
            // {

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
              // $image_name = $coop_details->regNo . ".png";
               $image_name = $coop_details->regNo."-".$amendment_no.".png";


              // create user content
              $codeContents = "Cooperative Name:";
              $codeContents .= $coop_details->coopName;
              $codeContents .= "\n";
              $codeContents .= "Registration No:";
              $codeContents .= $coop_details->regNo."-".$amendment_no;
              $codeContents .= "\n";
              $codeContents .= "Date Registered:";
              $codeContents .= $coop_details->dateRegistered;

              

              $params['data'] = $codeContents;
              $params['level'] = 'H';
              $params['size'] = 2;

              $params['savename'] = $qr_code_config['imagedir'] . $image_name;
              $this->ci_qr_code->generate($params);

              $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;

              // save image path in tree table
              // if(!$this->registration_model->save_qr_code($coop_details->regNo, $image_name))
              // {
              //   echo"Failed to generate QRCode";
              //   exit;
              // }
              // else
              // {
              //   echo"qr code saved";
              // }

              if(!$this->save_Qrcode_amendment($decoded_id,$image_name))
              {
                echo"Failed to generate QRCode";
                exit;
              }
              else
              {
                // echo"success";
              }
              // echo $this->db->last_query();

             



            // } //end qr code
        }
        else
        {
          echo "Failed to update";
        }//end update amendmentno
        
       


        $query_or = $this->db->get_where('payment',array('amendment_id'=>$decoded_id));
        if($query_or->num_rows()>0)
        {
          foreach($query_or->result_array() as $o)
          {
            $date_OR = $o['date_of_or'];
          }
        }
        else
        {
          $date_OR=now();
        }

        $data1['date_year']= date('Y',strtotime($date_OR));
        $data1['date_month'] =date('F',strtotime($date_OR));
        $dateDay = date('d',strtotime($date_OR));
        $data1['date_day']=$this->OrdinalIndicator($date_OR);

        $dt_data = substr($data1['date_day'],0,1);
       if($dt_data=="0")
        {
          $data1['date_day']=substr($data1['date_day'],1);
        }
      
        $data1['in_chartered_cities'] =false;
        // $this->debug($data1['coop_info']);
        if($this->charter_model->in_charter_city($coop_info->cCode))
        {
          $data1['in_chartered_cities']=true;
          $data1['chartered_cities'] =$this->charter_model->get_charter_city($data1['coop_info']->cCode);
        }
        
              
      
          $data1['chair'] = $this->registration_model->get_chairman()->chairman;
          $data1['coop_info']=$coop_details;
          // $this->debug($data1['coop_info']);
          $data1['amend_coop_info']=$coop_details;
      
          $data1['director']=$this->registration_model->get_director($coop_details->rCode);
          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($coop_info->cooperative_id,$decoded_id);
        
          set_time_limit(0);
          // $this->debug($coop_details);
       
          // $this->load->view('amendment/cor_view', $data1);
          $html2 = $this->load->view('amendment/cor_view', $data1, TRUE);
          $J = new pdf();       
          $J->set_option('isRemoteEnabled',TRUE);
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("certificate.pdf", array("Attachment"=>0));
    }
  }
  //modify by json
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
      if ($branch_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($branch_info->category_of_cooperative =='Secondary')  
        $pst="2";
      else
        $pst="3";
      $type=substr($branch_info->branchName, -7);
      
      if ($branch_info->status==20)
        $this->registration_model->register_branch($type,$decoded_id,$branch_info->rCode,$pst);
      

        $branch_details = $this->branches_model->get_branch_info_by_admin($decoded_id);
        $cName=$branch_details->coopName.' - '.$branch_details->branchName;
        
        
        if ($branch_details->qr_code==null){
          if ($type=='Branch '){
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
          $image_name = $branch_details->certNo . ".png";

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

          $params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
          $this->ci_qr_code->generate($params);

          $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;

          // save image path in tree table
          $this->registration_model->save_branch_qr_code($branch_details->certNo, $image_name);
        }
        
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        $data1['branch_info']=$branch_details;
        $data1['director']=$this->registration_model->get_director($user_id)->full_name;
        $data1['type']=$type;
        
        set_time_limit(0);

           //$this->load->view('cooperative\order_of_payment', $data1);

        $html2 = $this->load->view('cooperative/CA_view', $data1, TRUE);
        $J = new pdf();       
        $J->set_option('isRemoteEnabled',TRUE);
        $J->setPaper('folio', 'portrait');
        $J->load_html($html2);
        $J->render();
        $J->stream("certificate.pdf", array("Attachment"=>0));
      
    }
  }

  public function save_Qrcode_amendment($id,$qr_code)
  {
    // $data = array('qr_code'=> $qr_code);
      // $this->db->trans_begin();
    // $this->db->where('id',$id);
      if($this->db->update('registeredcoop', array('qr_code'=>$qr_code),array('amendment_id'=>$id)))
      {
          return true;
      }
      else{
        return false;
      }

    // if($this->db->trans_status() === FALSE){
    //   $this->db->trans_rollback();
    //   return false;
    // }else{
    //   $this->db->trans_commit();
    //   return true;
    // }
  }


  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}