<?php
  use Dompdf\Options;
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Audited_financial_statement extends CI_Controller{

    public function __construct(){
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->library('pdf');
    }

    public function index($regno) {
      if (!$this->session->userdata('logged_in') && !$this->session->userdata('Alogged_in')){
        redirect('users/login');
      }else{
        $this->load->helper('url');
        // echo $id;
        $coverageYear = $_GET['coverage_year'];
        // echo $id;
        
        $ca_user_info = $this->sfc_model->get_cais_user($regno);
        // echo $this->db->last_query();

        $user_id = $ca_user_info->id;
        // $coverageYear = 2019;
      // if(isset($_GET['c'])) {
      //      $user_id = $this->encryption->decrypt(decrypt_custom($this->input->get('c',TRUE)));
      //       $coverageYear = $this->encryption->decrypt(decrypt_custom($this->input->get('coverage_year',TRUE)));
      // }
      // else
      // {
      //       $user_id = $this->session->userdata('user_id');
      //       $coverageYear = $this->session->userdata('period');
      // }


        $data['title'] = 'CAFSIS';
        $data['fname'] = $this->session->userdata('fname');
        $data['header'] = 'Cooperative Audited Financial Statement';

        // if (!empty($this->reports_model->check_if_saved($user_id,$coverageYear))){ 
        //   $data['final']= 1 ;
        // }else{
        //   $data['final']= 0 ;         
        // }

        $data['ceaN'] = null;
          $data['ceaName']=null;
          $data['dateReg']=null;
          $data['dateValid']=null;
          $data['afsby'] = explode(';', $this->profile_model->get_saved_data($user_id,$coverageYear)->auditor); 

          // echo $this->db->last_query();
        // if (!empty($this->profile_model->get_saved_data($user_id,$coverageYear)->ceaNo)) {
        //   $ceaNo = $this->profile_model->get_saved_data($user_id,$coverageYear)->ceaNo;
        //   $data['ceaN'] =$ceaNo;
        //   if(!empty($this->profile_model->find_name($ceaNo)->auditor))
        //   {
        //     $data['ceaName']=$this->profile_model->find_name($ceaNo)->auditor;
        //     $data['dateReg']=$this->profile_model->find_name($ceaNo)->dateReg;
        //     $data['dateValid']=$this->profile_model->find_name($ceaNo)->dateValid;
        //   }
          
        //   $data['afsby'] = explode(';', $this->profile_model->get_saved_data($user_id,$coverageYear)->auditor);
        // } 

         if (!empty($this->generalinfo_model->get_regNo($user_id)->regNo)) {
          $regNo = $this->generalinfo_model->get_regNo($user_id)->regNo;  
        } else {
          $regNo = null;
        }
        $data['regNo'] = $regno;
        if (!empty($this->profile_model->get_coop($user_id)->coopName)) {
          // $data['coopName'] = $this->profile_model->get_coop($user_id)->coopName;
          // $regNo =  $this->profile_model->get_coop($user_id)->regNo;
          // $data['regNo'] =$regNo;
          $data['mobileNo'] = $this->profile_model->get_coop($user_id)->mobileNo;
          $data['email'] =  $this->profile_model->get_coop($user_id)->email; 
        } else {
          // $data['coopName'] = null;
          // $data['regNo'] = null;
          $data['email'] = null;
          $data['mobileNo'] = null;
        }

        $data['coop'] = null;
          if (!empty($this->generalinfo_model->get_coop(['regNo'=>$regNo, 'coverageYear'=>$coverageYear]))) {
            $coop_data = $this->generalinfo_model->get_coop(['regNo'=>$regNo, 'coverageYear'=>$coverageYear]);
            $coop_id = $coop_data->application_id;
            //check if has amendment and get the info
            $amend_data = $this->generalinfo_model->get_coop_amendment(['regNo'=>$regNo, 'coverageYear'=>$coverageYear]);
            if (!empty($amend_data)) 
            {
                foreach($amend_data as $field => $value)
                {
                    if(isset($coop_data->$field))
                    {
                        $coop_data->$field = $value;
                    }
                 }
//                 $coop_data = $this->generalinfo_model->get_coop_amendment($regNo);
                $oldAddr = $amend_data->addrCode;
                $coopType = $amend_data->type;
                $data['amendment_no'] = $amend_data->amendment_no;
            }
            $oldAddr = $coop_data->addrCode;
            $coopType = $coop_data->type;
          $data['coop'] = $coop_data;
          $data['coopName'] = $coop_data->coopName;
          $data['houseNo'] = $coop_data->noStreet;
          $data['street'] =$coop_data->Street != "NA" ? $coop_data->Street : null;
          $data['brgy']=$this->generalinfo_model->get_address_brgy($oldAddr)->brgyDesc;
          $data['city']=$this->generalinfo_model->get_address_city(substr($oldAddr, 0, 6))->citymunDesc;
          $data['province']=$this->generalinfo_model->get_address_province(substr($oldAddr, 0, 4))->provDesc;
          $data['region']=$this->generalinfo_model->get_address_region('0'.substr($oldAddr, 0, 2))->regDesc;
          $data['isCharteredCity'] = $this->generalinfo_model->isCharteredCity(substr($oldAddr, 0, 6));
        }
        if (!empty($this->profile_model->get_assetSize($user_id,$coverageYear)->genInfo)) {
          $data['genInfo'] = explode(';', $this->profile_model->get_assetSize($user_id,$coverageYear)->genInfo);
        } else {
          $data['genInfo'] = null;
        }

           if (!empty($this->sfc_model->get_sfc($user_id,$coverageYear)->sfc)){ 
          $data['asset']= explode(';',$this->sfc_model->get_sfc($user_id,$coverageYear)->sfc);
          }else{
            $data['asset']=0;          
          }
        //  if (!empty($this->sked9_model->get_sked9($user_id,$coverageYear)->schedule9)){ 
        //   $data['land']= explode(';',$this->sked9_model->get_sked9($user_id,$coverageYear)->schedule9);

        // }else{
         
        //      $data['land'] = 0; 
          
        // }
        // print_r($data['asset']);
          if(isset($data['asset'][5]) && isset($data['land'][6])){
        $x = str_replace(',','',$data['asset'][5]) - str_replace(',','',$data['land'][6]);
        }else{
          $x = 0;
        }
        
        if($x > 100000000)
        {
          $data['assetSize'] = 'Large (with Assets over P100 million)';
        }else if($x <= 100000000 && $x >=15000001)
        {
          $data['assetSize'] = 'Medium (with Assets of P15,000,001 to P100 million)';
        }else if($x <= 15000000 && $x >=3000001)
        {
          $data['assetSize'] = 'Small (with Assets of P3,000,001 to P15 million)';
        }else
        {
          $data['assetSize'] = 'Micro (with Assets of P3,000,000 and below)';
        }

        if (!empty($coopType)) 
          {
              if($coopType == 'Multipurpose')
              {
                  $subtype = $this->Business_Activity_model->get_coop1($regNo);
                  if(!empty($subtype))
                  {
                      foreach($subtype as $sub)
                      {
                          $data['coop'] = explode(",",$sub->type_of_cooperative);
                      }
                  }
                  else
                  {
                      $data['coopType'][] = $coopType;
                  }
              }
              else
              {
                 $data['coopType'][] = $coopType;
              }
          }
          else 
          {
              $data['coopType'] = array();
          }

        if (!empty($this->sfc_model->get_sfc($user_id,$coverageYear)->sfc)){ 
          $data['sagot']= explode(';',$this->sfc_model->get_sfc($user_id,$coverageYear)->sfc);
        }else{
          $data['sagot']=null;          
        }
      
        if (!empty($this->sked1_model->get_sked1($user_id,$coverageYear)->schedule1)){ 
          $s1 = $this->sked1_model->get_sked1($user_id,$coverageYear)->schedule1;
          $data['sagot1'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot1']=null;          
        }
 
        if (!empty($this->sked2_model->get_sked2($user_id,$coverageYear)->schedule2)){ 
          $s1 = $this->sked2_model->get_sked2($user_id,$coverageYear)->schedule2;
          $data['sagot2'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot2']=null;          
        }
 
        if (!empty($this->sked3_model->get_sked3($user_id,$coverageYear)->schedule3)){ 
          $s1 = $this->sked3_model->get_sked3($user_id,$coverageYear)->schedule3;
          $data['sagot3'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot3']=null;          
        }
 
        if (!empty($this->sked4_model->get_sked4($user_id,$coverageYear)->schedule4)){ 
          $s1 = $this->sked4_model->get_sked4($user_id,$coverageYear)->schedule4;
          $data['sagot4'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot4']=null;          
        }
 
        if (!empty($this->sked5_model->get_sked5($user_id,$coverageYear)->schedule5)){ 
          $s1 = $this->sked5_model->get_sked5($user_id,$coverageYear)->schedule5;
          $data['sagot5'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot5']=null;          
        }
 
        if (!empty($this->sked6_model->get_sked6($user_id,$coverageYear)->schedule6)){ 
          $s1 = $this->sked6_model->get_sked6($user_id,$coverageYear)->schedule6;
          $data['sagot6'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot6']=null;          
        }
 
        if (!empty($this->sked7_model->get_sked7($user_id,$coverageYear)->schedule7)){ 
          $s1 = $this->sked7_model->get_sked7($user_id,$coverageYear)->schedule7;
          $data['sagot7'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot7']=null;          
        }
 
        if (!empty($this->sked8_model->get_sked8($user_id,$coverageYear)->schedule8)){ 
          $s1 = $this->sked8_model->get_sked8($user_id,$coverageYear)->schedule8;
          $data['sagot8'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot8']=null;          
        }
 
        if (!empty($this->sked9_model->get_sked9($user_id,$coverageYear)->schedule9)){ 
          $s1 = $this->sked9_model->get_sked9($user_id,$coverageYear)->schedule9;
          $data['sagot9'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot9']=null;          
        }

        if (!empty($this->sked10_model->get_sked10($user_id,$coverageYear)->schedule10)){ 
          $s1 = $this->sked10_model->get_sked10($user_id,$coverageYear)->schedule10;
          $data['sagot10'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot10']=null;          
        }
 
        if (!empty($this->sked11_model->get_sked11($user_id,$coverageYear)->schedule11)){ 
          $s1 = $this->sked11_model->get_sked11($user_id,$coverageYear)->schedule11;
          $data['sagot11'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot11']=null;          
        }
 
        if (!empty($this->sked12_model->get_sked12($user_id,$coverageYear)->schedule12)){ 
          $s1 = $this->sked12_model->get_sked12($user_id,$coverageYear)->schedule12;
          $data['sagot12'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot12']=null;          
        }
 
        if (!empty($this->sked13_model->get_sked13($user_id,$coverageYear)->schedule13)){ 
          $s1 = $this->sked13_model->get_sked13($user_id,$coverageYear)->schedule13;
          $data['sagot13'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot13']=null;          
        }

        if (!empty($this->sked14_model->get_sked14($user_id,$coverageYear)->schedule14)){ 
          $s1 = $this->sked14_model->get_sked14($user_id,$coverageYear)->schedule14;
          $data['sagot14'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot14']=null;          
        }
 
        if (!empty($this->sked15_model->get_sked15($user_id,$coverageYear)->schedule15)){ 
          $s1 = $this->sked15_model->get_sked15($user_id,$coverageYear)->schedule15;
          $data['sagot15'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot15']=null;          
        }
 
        if (!empty($this->sked16_model->get_sked16($user_id,$coverageYear)->schedule16)){ 
          $s1 = $this->sked16_model->get_sked16($user_id,$coverageYear)->schedule16;
          $data['sagot16'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot16']=null;          
        }

        if (!empty($this->sked17_model->get_sked17($user_id,$coverageYear)->schedule17)){ 
          $s1 = $this->sked17_model->get_sked17($user_id,$coverageYear)->schedule17;
          $data['sagot17'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot17']=null;          
        }
 
        if (!empty($this->sked18_model->get_sked18($user_id,$coverageYear)->schedule18)){ 
          $s1 = $this->sked18_model->get_sked18($user_id,$coverageYear)->schedule18;
          $data['sagot18'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot18']=null;          
        }
 
        if (!empty($this->sked19_model->get_sked19($user_id,$coverageYear)->schedule19)){ 
          $s1 = $this->sked19_model->get_sked19($user_id,$coverageYear)->schedule19;
          $data['sagot19'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot19']=null;          
        }
 
        if (!empty($this->sked20_model->get_sked20($user_id,$coverageYear)->schedule20)){ 
          $s1 = $this->sked20_model->get_sked20($user_id,$coverageYear)->schedule20;
          $data['sagot20'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot20']=null;          
        }
 
        if (!empty($this->sked21_model->get_sked21($user_id,$coverageYear)->schedule21)){ 
          $s1 = $this->sked21_model->get_sked21($user_id,$coverageYear)->schedule21;
          $data['sagot21'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot21']=null;          
        }
 
        if (!empty($this->sked22_model->get_sked22($user_id,$coverageYear)->schedule22)){ 
          $s1 = $this->sked22_model->get_sked22($user_id,$coverageYear)->schedule22;
          $data['sagot22'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot22']=null;          
        }

        if (!empty($this->so_model->get_so($user_id,$coverageYear)->so)){ 
          $data['sagut']= explode(';',$this->so_model->get_so($user_id,$coverageYear)->so);
        }else{
          $data['sagut']=null;          
        }
        
        if (!empty($this->sked23_model->get_sked23($user_id,$coverageYear)->schedule23)){ 
          $s1 = $this->sked23_model->get_sked23($user_id,$coverageYear)->schedule23;
          $data['sagot23'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot23']=null;          
        }
 
        if (!empty($this->sked24_model->get_sked24($user_id,$coverageYear)->schedule24)){ 
          $s1 = $this->sked24_model->get_sked24($user_id,$coverageYear)->schedule24;
          $data['sagot24'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot24']=null;          
        }

        if (!empty($this->sked25_model->get_sked25($user_id,$coverageYear)->schedule25)){ 
          $s1 = $this->sked25_model->get_sked25($user_id,$coverageYear)->schedule25;
          $data['sagot25'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot25']=null;          
        }
 
        if (!empty($this->sked26_model->get_sked26($user_id,$coverageYear)->schedule26)){ 
          $s1 = $this->sked26_model->get_sked26($user_id,$coverageYear)->schedule26;
          $data['sagot26'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot26']=null;          
        }
 
        if (!empty($this->sked27_model->get_sked27($user_id,$coverageYear)->schedule27)){ 
          $s1 = $this->sked27_model->get_sked27($user_id,$coverageYear)->schedule27;
          $data['sagot27'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot27']=null;          
        }
 
        if (!empty($this->sked28_model->get_sked28($user_id,$coverageYear)->schedule28)){ 
          $s1 = $this->sked28_model->get_sked28($user_id,$coverageYear)->schedule28;
          $data['sagot28'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot28']=null;          
        }
 
        if (!empty($this->sked29_model->get_sked29($user_id,$coverageYear)->schedule29)){ 
          $s1 = $this->sked29_model->get_sked29($user_id,$coverageYear)->schedule29;
          $data['sagot29'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot29']=null;          
        }
 
        if (!empty($this->sked30_model->get_sked30($user_id,$coverageYear)->schedule30)){ 
          $s1 = $this->sked30_model->get_sked30($user_id,$coverageYear)->schedule30;
          $data['sagot30'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot30']=null;          
        }
 
        if (!empty($this->sked31_model->get_sked31($user_id,$coverageYear)->schedule31)){ 
          $s1 = $this->sked31_model->get_sked31($user_id,$coverageYear)->schedule31;
          $data['sagot31'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot31']=null;          
        }
 
        if (!empty($this->sked32_model->get_sked32($user_id,$coverageYear)->schedule32)){ 
          $s1 = $this->sked32_model->get_sked32($user_id,$coverageYear)->schedule32;
          $data['sagot32'] = substr($s1,strrpos($s1,";")+1,strlen($s1)-strrpos($s1,";")-1);
        }else{
          $data['sagot32']=null;          
        }
          // $this->load->view('report/Audited_Financial_Statement_view',$data);

        set_time_limit(0);
          $html2 = $this->load->view('report/Audited_Financial_Statement_view', $data, TRUE);
          $J = new pdf();
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("Audited_Financial_Statement.pdf", array("Attachment"=>0));
        
      }
    }
  
  }