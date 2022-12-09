<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Amendment_payments extends CI_Controller{
  public $decoded_id = null;
  public function __construct()
  {
    parent::__construct();

    //Codeigniter : Write Less Do More

    $this->load->library('Auth');
    // $this->auth->checkLogin();
    $this->load->model('amendment_uploaded_document_model');
  }



  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{
      $this->load->model('amendment_model');
      $this->load->model('amendment_bylaw_model');
      $this->load->model('amendment_article_of_cooperation_model');
      $this->load->model('amendment_cooperator_model');
      $this->load->model('amendment_committee_model');
      $this->load->model('user_model');
      $this->load->model('Payment_model');
      $this->load->model('cooperatives_model');
      $this->load->model('amendment_affiliators_model');
      $this->load->model('amendment_union_model');
      $this->load->model('amendment_capitalization_model');
      $this->load->model('region_model');
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          $this->amendment_model->check_own_cooperative_($cooperative_id,$this->decoded_id,$user_id);
          $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

              if($data['bylaw_complete']){
                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                   switch ($data['coop_info']->category_of_cooperative) {
                   case 'Secondary':
                   case 'Tertiary':
                    $data['affiliator_complete'] = $this->amendment_affiliators_model->is_requirements_complete($this->decoded_id);
                     $data['cooperator_complete'] =true;
                      $data['union_complete'] =true;
                     break;

                   case 'Others':
                    $data['union_complete'] = $this->amendment_union_model->is_requirements_complete($this->decoded_id);
                     $data['cooperator_complete'] =true;
                     $data['affiliator_complete'] = true;
                    break;
                   default:
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                       $data['affiliator_complete'] =true;
                        $data['union_complete'] = true;
                     break;
                 }
                  if($data['cooperator_complete']){
                    $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                    if($data['committees_complete']){
                          $data['document_one'] = $this->amendment_uploaded_document_model->get_document_one_info($this->decoded_id);
                          $data['document_two'] = $this->amendment_uploaded_document_model->get_document_two_info($this->decoded_id);
                              $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);

                              $this->amendment_model->check_first_evaluated_($this->decoded_id);
                              $this->amendment_model->check_second_evaluated_($this->decoded_id);

                              $data['client_info'] = $this->user_model->get_user_info($user_id);
                              $data['title'] = 'Payment Details';
                              $data['header'] = 'Order of Payment';
                              $data['encrypted_id'] = $id;
                              $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$this->decoded_id);
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                                    // $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($this->decoded_id);
                                    // $data['total_regular'] = $this->cooperator_model->get_total_regular($this->decoded_id);
                                    // $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);
                                    // $data['name_reservation_fee']=100.00;
                              $data['pay_from']='reservation';
                              $data['ref_no'] = $this->Payment_model->orderPaymentNo($this->decoded_id);

                              $data['amendment_capitalization']= $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                                if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                                {
                                     $data['coop_info_orig']= $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                     $data['previous_total_paid_up_capital'] = $this->amendment_capitalization_model->total_amount_of_paid_up_capital($data['coop_info_orig']->id);

                                     $coop_info_orig = $data['coop_info_orig'];
                                       $acronym='';
                                        if(strlen($coop_info_orig->acronym)>0)
                                        {
                                          $acronym='('.$coop_info_orig->acronym.')';
                                        }
                                        if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                        {
                                          $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                        }
                                        else
                                        {
                                          switch ($data['coop_info_orig']->category_of_cooperative) {
                                            case 'Secondary':
                                            case 'Tertiary':
                                               $data['orig_proposedName_formated'] = $data['coop_info']->proposed_name.' Federation of '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronym;
                                              break;
                                            case 'Others':
                                              $data['orig_proposedName_formated'] = $data['coop_info']->proposed_name.' Union Cooperative '.$acronym;
                                              break;
                                            default:
                                              $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                              break;
                                          }

                                        }
                                }
                                else
                                {
                                  $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                  $coop_info_orig = $data['coop_info_orig'];
                                  $acronym='';
                                    if(strlen($coop_info_orig->acronym_name)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym_name.')';
                                    }
                                  $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative'.$acronym;
                                  $data['previous_total_paid_up_capital'] = $this->amendment_capitalization_model->total_amount_of_paid_up_capital($data['coop_info_orig']->id);
                                }

                                    $coop_orig_name = $data['coop_info_orig']->proposed_name;
                                    $data['original_coop_name']= rtrim($coop_orig_name).' '.$data['coop_info_orig']->type_of_cooperative.' Cooperative '.$acronym;
                                    $data['date_ok_for_payment'] = $this->Payment_model->get_payment_info_amendment($this->decoded_id)->date;
                                    // $_SESSION['payment_session'] = $this->decoded_id;
                                    $data['regInfo'] = $this->region_model->get_region_by_code($data['coop_info']->rCode);

                                      $this->load->view('./template/header', $data);
                                      $this->load->view('amendment/payment_form', $data);
                                      $this->load->view('./template/footer', $data);

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');

                      redirect('amendment/'.$id);

                    }

                  }else{

                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');

                    redirect('amendment/'.$id);

                  }


              }else{

                $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');

                redirect('amendment/'.$id);

              }

        }else{

          if($this->session->userdata('access_level')==5){

            redirect('admins/login');

          }else{

            redirect('amendment');

          }

        }

      }else{

        show_404();

      }
    }

  }



  public function coop_capitalization($cooperative_id)

  {
    $data =null;
    $qry =$this->db->query("select total_amount_of_paid_up_capital from capitalization where cooperatives_id='$cooperative_id'");

    if($qry->num_rows()>0)

    {

      $data = $qry->row();

    }
    return $data;

  }



  public function amendment_capitalization($amendment_id)

  {

    $qry =$this->db->query("select * from amendment_capitalization where amendment_id='$amendment_id'");

    if($qry->num_rows()>0)

    {

      $data = $qry->row();

    }

    else

    {

      $data  ='No data found.';

    }

    return $data;

  }



  public function add_payment()

  {
    $this->load->model('amendment_model');
    $this->load->model('Payment_model');
    $this->load->model('amendment_bylaw_model');
    $this->load->model('amendment_article_of_cooperation_model');
    $this->load->model('amendment_capitalization_model');
    $this->load->model('cooperatives_model');
    $this->load->library('pdf');
    if ($this->input->post('offlineBtn')){
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $this->Payment_model->pay_offline_amendment($this->decoded_id);

      // // $this->debug($amendment_info);

      // $ref_no  = $this->orderPaymentNo($this->decoded_id);
      $total = str_replace( ',', '', $this->input->post('total')); //number_format($this->input->post('total'),2,'.','');
       $data=array(
        'refNo' => $this->input->post('ref_no'),
        'payor' => $this->input->post('payor'),
        // 'date'    => $this->input->post('tDate'),
        'nature'  => $this->input->post('nature'),
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $total,
        'payment_option'=> 'offline',
        'status' => 0,
        // 'amendment_id'=> $this->decoded_id,
        );

       // $this->debug($data);
      if ($this->Payment_model->check_payment_not_exist_amendment($this->decoded_id))
       {
        // $this->debug( $this->Payment_model->update_payment_amendment($data,$this->input->post('rCode'),$this->decoded_id));

        $this->Payment_model->update_payment_amendment($data,$this->input->post('rCode'),$this->decoded_id);
        // echo $this->db->last_query();
          $user_id = $this->session->userdata('user_id');
          $payment_ = $this->Payment_model->get_payment_info_amendment($this->decoded_id);
          $data1['tDate'] = date("d-m-Y", strtotime($payment_->date));

          $data1['refNo'] = $payment_->refNo;
          $data1['nature'] = $payment_->nature;
          $data1['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
          $data1['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
          $data1['name_reservation_fee']=100.00;

          $data1['amendment_capitalization']= $this->amendment_capitalization($this->decoded_id);

              if($this->amendment_model->if_had_amendment($data1['coop_info']->regNo,$this->decoded_id))
              { //next amendment

                $data1['coop_info_orig']= $this->amendment_model->get_last_amendment_info($this->decoded_id,$data1['coop_info']->regNo);
                $coop_info_orig = $data1['coop_info_orig'];
                $data1['previous_total_paid_up_capital'] = $this->amendment_capitalization_model->total_amount_of_paid_up_capital($data1['coop_info_orig']->id);
                $acronym='';
                if(strlen($coop_info_orig->acronym)>0)
                {
                $acronym='('.$coop_info_orig->acronym.')';
                }
                if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                {
                $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                }
                else
                {
                    switch ($data1['coop_info_orig']->category_of_cooperative) {
                    case 'Secondary':
                    case 'Tertiary':
                    $data1['orig_proposedName_formated'] = $coop_info->proposed_name.' Federation of '.$coop_info->type_of_cooperative.' Cooperative '.$acronym;
                    break;
                    case 'Others':
                    $data1['orig_proposedName_formated'] = $data1['coop_info']->proposed_name.' Union Cooperative '.$acronym;
                    break;
                    default:
                    $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                    break;
                    }
                }
              }
              else
              { //first amendmen
                $data1['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                $coop_info_orig = $data1['coop_info_orig'];
                $acronym='';
                if(strlen($coop_info_orig->acronym_name)>0)
                {
                $acronym='('.$coop_info_orig->acronym_name.')';
                }
                $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                $data1['previous_total_paid_up_capital']=$this->coop_capitalization($cooperative_id);
              }

        // $this->load->view('amendment/order_of_payment', $data1);

          $html2 = $this->load->view('amendment/order_of_payment', $data1, TRUE);
          $J = new pdf();
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("order_of_payment.pdf", array("Attachment"=>1));
      }
    }

     else if ($this->input->post('onlineBtn')){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);

      // // $this->debug($amendment_info);

      // $ref_no  = $this->orderPaymentNo($this->decoded_id);
      $total = str_replace( ',', '', $this->input->post('total')); //number_format($this->input->post('total'),2,'.','');
       $data=array(
        'refNo' => $this->input->post('ref_no'),
        'payor' => $this->input->post('payor'),
        // 'date'    => $this->input->post('tDate'),
        'nature'  => $this->input->post('nature'),
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $total,
        'payment_option'=> 'online',
        'status' => 0,
        // 'amendment_id'=> $this->decoded_id,
        );

       // $this->debug($data);
      if ($this->Payment_model->check_payment_not_exist_amendment($this->decoded_id))
       {
        // $this->debug( $this->Payment_model->update_payment_amendment($data,$this->input->post('rCode'),$this->decoded_id));

        $this->Payment_model->update_payment_amendment($data,$this->input->post('rCode'),$this->decoded_id);
        // echo $this->db->last_query();
          $user_id = $this->session->userdata('user_id');
          $payment_ = $this->Payment_model->get_payment_info_amendment($this->decoded_id);
          $data1['tDate'] = date("d-m-Y", strtotime($payment_->date));

          $data1['refNo'] = $payment_->refNo;
          $data1['nature'] = $payment_->nature;
          $data1['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
          $data1['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
          $data1['name_reservation_fee']=100.00;
          $data1['coop_capitalization']=$this->coop_capitalization($cooperative_id);
          $data1['amendment_capitalization']= $this->amendment_capitalization($this->decoded_id);

              if($this->amendment_model->if_had_amendment($data1['coop_info']->regNo,$this->decoded_id))
              { //next amendment

                $data1['coop_info_orig']= $this->amendment_model->get_last_amendment_info($this->decoded_id,$data1['coop_info']->regNo);
                $coop_info_orig = $data1['coop_info_orig'];
                $acronym='';
                if(strlen($coop_info_orig->acronym)>0)
                {
                $acronym='('.$coop_info_orig->acronym.')';
                }
                if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                {
                $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                }
                else
                {
                    switch ($data1['coop_info_orig']->category_of_cooperative) {
                    case 'Secondary':
                    case 'Tertiary':
                    $data1['orig_proposedName_formated'] = $coop_info->proposed_name.' Federation of '.$coop_info->type_of_cooperative.' Cooperative '.$acronym;
                    break;
                    case 'Others':
                    $data1['orig_proposedName_formated'] = $data1['coop_info']->proposed_name.' Union Cooperative '.$acronym;
                    break;
                    default:
                    $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                    break;
                    }
                }
              }
              else
              { //first amendmen
                $data1['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                $coop_info_orig = $data1['coop_info_orig'];
                $acronym='';
                if(strlen($coop_info_orig->acronym_name)>0)
                {
                $acronym='('.$coop_info_orig->acronym_name.')';
                }
                $data1['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
              }

      $way_up = $this->input->post('ref_no').'-'.date('Hi');
      $hash = strtolower(md5('2018070336'.$way_up.($total * 100)));

      $refno_replace = str_replace('-','',$this->input->post('ref_no'));
      $this->Payment_model->update_payment_online_amendment($this->decoded_id,$way_up);

      $registration_number = str_replace('-','',$this->input->post('regNo'));

      $enc_user_id = encrypt_custom($this->encryption->encrypt($user_id));
      $enc_decoded_id = encrypt_custom($this->encryption->encrypt($this->decoded_id));

      $params = array(
        'MerchantCode' => '2018070336',
        'MerchantRefNo' => $way_up,
        'Particulars' => 'transaction_type=Registration Fee - Amendment;TransactionNo='.$refno_replace.';Regional Office='.$this->input->post('regDesc').';Registration Number='.$registration_number.';Name of Cooperative='.$this->input->post('payor').';Name of Applicant='.$this->input->post('applicant').';',
        'Amount' => $total,
        'PayorName' => $this->input->post('payor'),
        'PayorEmail' => $this->input->post('payoremail'),
        // 'ReturnURLError' => base_url('amendment_payments/ok/'.$enc_user_id.'/'.$enc_decoded_id),
        'ReturnURLError' => base_url('amendment_payments/error/'.$enc_user_id),
        'ReturnURLOK' => base_url('amendment_payments/ok/'.$enc_user_id.'/'.$enc_decoded_id),
        // 'ReturnURLError' => 'http://ecoopris.cmvsd.com/ris_updating/amendment_payments/error',
        // 'ReturnURLOK' => 'http://ecoopris.cmvsd.com/ris_updating/amendment_payments/ok',
        'Hash' => $hash,
      );

      // echo 'transaction_type=Registration Fee - Amendment;TransactionNo='.$refno_replace.';Regional Office='.$this->input->post('regDesc').';Registration Number='.$registration_number.';Name of Cooperative='.$this->input->post('payor').';Name of Applicant='.$this->input->post('applicant').';';
      // redirect();
      $url = 'https://222.127.109.48/epp20200915/?';
      // $url = 'https://epaymentportal.landbank.com/?';

      $postData = '';
        //create name value pairs seperated by &
        foreach($params as $k => $v)
        {
          $postData .= $k . '='.$v.'&';
        }

      $complete_url = $url.$postData;
      header("Location: ".$complete_url."");

     }else{

      $this->session->set_flashdata('redirect_applications_message', 'Error');

     redirect('amendment');

    }

  }
}
   public function ok($user_id = null,$coop_id = null){
    $this->load->model('Payment_model');

    $user_id = $this->encryption->decrypt(decrypt_custom($user_id));
    $coop_id = $this->encryption->decrypt(decrypt_custom($coop_id));

    $query= $this->db->get_where('users', array('id' => $user_id));
    $row = $query->row();

    $user_data = array(
      'user_id' => $row->id,
      'email' => $row->email,
      'client' => true,
      'logged_in' => true
    );

    $this->session->set_userdata($user_data);

    $decoded_id = $coop_id;

    $query_epp = $this->db->get_where('payment', array('amendment_id' => $decoded_id));
    $epp = $query_epp->row();

    $merchantrefno = $epp->merchantrefno;

    $hash = strtolower(md5('2018070336'.$merchantrefno.'9fd681eab5130912791ec76fa1572995'));
    $postdata = array(
    'MerchantCode' => '2018070336',
    'MerchantRefNo' => $merchantrefno,
    'Hash' => $hash
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://222.127.109.48/epp20200915/api2-status.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $output = curl_exec($ch);

    $obj = $output;

    curl_close($ch);

    $this->Payment_model->pay_online_amendment($decoded_id,$obj);

      $this->session->set_flashdata('list_success_message', 'Payment Success');
      echo ("<script LANGUAGE='JavaScript'>window.location='".base_url()."amendment';</script>");
    }

    public function error($user_id = null){
      $user_id = $this->encryption->decrypt(decrypt_custom($user_id));
      $query= $this->db->select("id,email")->from('users')->where(['id' => $user_id])->get();
      if($query->num_rows()==1)
      {
        $row=$query->row();
         $user_data = array(
        'user_id' => $row->id,
        'email' => $row->email,
        'client' => true,
        'logged_in' => true
         );
         unset($query);

      $this->session->set_userdata($user_data);
      $this->session->set_flashdata('list_error_message', 'Payment Failed');
      echo ("<script LANGUAGE='JavaScript'>window.location='".base_url()."amendment';</script>");
      }
      else
      {
          $this->session->set_flashdata('list_error_message', 'Payment Failed. User does not exist');
      echo ("<script LANGUAGE='JavaScript'>window.location='".base_url()."amendment';</script>");
      }
    }


  public function debug($array)

    {

        echo"<pre>";

        print_r($array);

        echo"</pre>";

    }

}
