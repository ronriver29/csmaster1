 <?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratories_registration extends CI_Controller{

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


      // DATE REGISTERED IS DATE DIRECTOR APPROVAL
      $lab_info = $this->registration_model->get_laboratory_info($decoded_id);
      $lab_Name="Laboratory Cooperative of".$lab_info->laboratoryName;
      $reg_no = $lab_info->coop_id;
      $this->laboratories_model->generate_certNo($decoded_id);
      // if($this->laboratories_model->generate_certNo($decoded_id))
      // {

      //  echo "certificate generated";
      // }
      // else
      // {
      //   echo"failed to generated certificate";
      // }
      
      $lab_details = $this->registration_model->get_cooperative_info_laboratories($reg_no,$decoded_id);
      // echo $this->db->last_query();
     
      $app_code_types = 'L-'.$decoded_id;
      $date_or = $this->date_or_encode($app_code_types);
      $DateofOR =$date_or->date_of_or;
      $data1['date_year'] = date('Y',now('Asia/Manila'));
      $data1['date_month'] = date('F',now('Asia/Manila'));
      
      // $data1['date_day']=$this->OrdinalIndicator($DateofOR);
      $dateApproved_director=$this->OrdinalIndicator($DateofOR);
      $first_string = substr($dateApproved_director,0,1);

      if($first_string=='0'){
         $date_approved=substr($dateApproved_director,1);
      }
      else{
        $date_approved =  $dateApproved_director;
      }
         $data1['date_day_approved'] =$date_approved;
       

      $data1['date_year']= date('Y',strtotime($lab_details->dateRegistered));
      $data1['date_month'] =date('F',strtotime($lab_details->dateRegistered));
      $dateDay = date('d',strtotime($lab_details->dateRegistered));
      $data1['date_day']=$this->OrdinalIndicator($dateDay);

      // echo "<br> QT code : ".$lab_details->qr_code;
       if (strlen($lab_details->qr_code)<1 || $lab_details->qr_code='')
      {
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
         $image_name = $lab_details->certNo.".png";

         // create user content
         $codeContents = "Laboratory Name:";
         $codeContents .= $lab_Name; //$coop_details->laboratoryName;
         $codeContents .= "\n";
         $codeContents .= "Certiface No:";
         $codeContents .= $lab_details->certNo;
         $codeContents .= "\n";
         $codeContents .= "Date Registered:";
         $codeContents .= $lab_details->dateRegistered;

         $params['data'] = $codeContents;
         $params['level'] = 'H';
         $params['size'] = 2;

         $params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
         $this->ci_qr_code->generate($params);

         $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;


         // if($this->db->update('laboratories',array('qr_code'=>$image_name),array('id'=>$decoded_id))){
           
         //  
          $this->save_Qrcode_laboratory($decoded_id,$image_name);
      } //qrcode null   

      if($lab_info->status==20)
      {
        // $this->registration_model->register_coop($decoded_id,$lab_info->addrCode);
        $this->registration_model->update_laboratory_($decoded_id);
      }//if status      
        $data1['chair'] = $this->registration_model->get_chairman()->chairman;
        // $data1['coop_info']=$lab_details;
        $data1['director']=$this->registration_model->get_director($user_id)->full_name;
        set_time_limit(0);
        //get again after update qr and cert
        $laboratory_registered= $this->registration_model->get_cooperative_info_laboratories($reg_no,$decoded_id);
        $data1['coop_info']= $laboratory_registered;
        // echo"<pre>";print_r( $laboratory_registered);echo"<pre><br>";
        //   echo"<pre>";print_r($lab_info);echo"<pre>";
         // echo json_encode( $data1['coop_info']);

         $this->load->view('laboratories/cor_view', $data1);
        $html2 = $this->load->view('laboratories/cor_view', $data1, TRUE);
        $J = new pdf();       
        $J->set_option('isRemoteEnabled',TRUE);
        $J->set_paper([0,0,612,936], "portrait"); //mm to point
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
        return $date_day.$ordinal_indicator;//$num_day.$ordinal_indicator;
  }

  //modify by json
   public function save_Qrcode_laboratory($id,$qr_code)
  {
    // $data = array('qr_code'=> $qr_code);
      // $this->db->trans_begin();
    // $this->db->where('id',$id);
      if($this->db->update('laboratories', array('qr_code'=>$qr_code),array('id'=>$id)))
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
  

  //modify by json
  public function date_or_encode($app_code_type)
  {
    $qry =$this->db->query("select date_of_or from payment where app_code_type='$app_code_type' and nature='Laboratory Registration'");
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }
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
}