<?php

use Dompdf\Options;

defined('BASEPATH') OR exit('No direct script access allowed');



class Payments extends CI_Controller{


  public function __construct()

  {

    parent::__construct();

    //Codeigniter : Write Less Do More
    $this->load->model('cooperatives_model');
    $this->load->model('committee_model');
    $this->load->model('capitalization_model');
    $this->load->model('affiliators_model');
    $this->load->model('unioncoop_model');
    $this->load->model('bylaw_model');
    $this->load->model('economic_survey_model');
    $this->load->model('staff_model');
    $this->load->model('economic_survey_model');
    $this->load->model('uploaded_document_model');
    $this->load->model('user_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('user_model');
    $this->load->model('payment_model');
    $this->load->model('capitalization_model');
    $this->load->model('cooperator_model');
    $this->load->library('pdf');
    $this->load->library('Numbertowords');

  }

  function index($id = null)

  {

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{
      $this->load->model('payment_model');
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));

      $user_id = $this->session->userdata('user_id');

      $data['is_client'] = $this->session->userdata('client');

      if(is_numeric($decoded_id) && $decoded_id!=0){

        if($this->session->userdata('client')){

          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){

            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){

              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;

              if($data['bylaw_complete']){

                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;

                if($data['article_complete']){

                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);

                    $capitalization_info = $data['capitalization_info'];

                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){

                        $model = 'affiliators_model';

                        $ids = $user_id;

                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);

                    } else if($data['coop_info']->grouping == 'Union'){

                        $model = 'unioncoop_model';

                        $ids = $user_id;

                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($user_id);

                    } else {

                        $model = 'cooperator_model';

                        $ids = $decoded_id;

                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);

                    }



                    if($data['cooperator_complete']){

                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){

                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);

                        } else if($data['coop_info']->grouping == 'Union'){

                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);

                        } else {

                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);

                        }

                      if($data['gad_count']>0){

                      if($data['coop_info']->created_at >= '2022-03-08'){

                        $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);

                      } else {

                        $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);

                      }



                      if($data['economic_survey_complete'] || $data['coop_info']->grouping == 'Union' || $data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){

                        $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);

                        if($data['staff_complete']){

                          $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);

                          $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);

                          if(($data['document_one'] && $data['document_two']) || $data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){

//                            if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){

                              if($this->cooperatives_model->check_first_evaluated($decoded_id)){

                                if($this->cooperatives_model->check_second_evaluated($decoded_id)){

                                  if($this->cooperatives_model->check_last_evaluated($decoded_id)){

                                  // Payment Series

                                    $current_year = date('Y');

                                    $this->db->select('*');

                                    $this->db->from('payment');

                                    $this->db->where("(refNo IS NOT NULL OR refNo != '' AND nature = 'Registration') AND YEAR(date) = '".$current_year."'");

                                    $series = $this->db->count_all_results();
                                    // echo $this->db->last_query();
                                    $data['series'] = $series + 1;

                                  // End
                                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                                    $data['title'] = 'Payment Details';
                                    $data['header'] = 'Order of Payment';
                                    $data['encrypted_id'] = $id;
                                    $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                    $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                    $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                    $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                    $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                    $data['name_reservation_fee']=100.00;
                                    $data['pay_from']='reservation';
                                    // $_SESSION['payment_session'] = $decoded_id;
                                    $this->load->view('./template/header', $data);
                                    $this->load->view('cooperative/payment_form', $data);
                                    $this->load->view('./template/footer', $data);

                                  }else{

                                    $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');

                                    redirect('cooperatives/'.$id);

                                  }

                                }else{

                                  $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');

                                  redirect('cooperatives/'.$id);

                                }

                              }else{

                                $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Cooperative Development Specialist II.');

                                redirect('cooperatives/'.$id);

                              }

//                            }else{

//                              echo 'asd';

//                            }

                          }else if(!$data['document_one'] && !$data['document_two']){

                            $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');

                            redirect('cooperatives/'.$id);

                          }else if(!$data['document_one']){

                            $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');

                            redirect('cooperatives/'.$id);

                          }else{

                            $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');

                            redirect('cooperatives/'.$id);

                          }

                        }else{

                          $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');

                          redirect('cooperatives/'.$id);

                        }

                      }else{

                        $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');

                        redirect('cooperatives/'.$id);

                      }

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');

                      redirect('cooperatives/'.$id);

                    }

                  }else{

                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->grouping == 'Union' || $data['coop_info']->type_of_cooperative == 'Technology Service'){

                        $complete = 'Members';

                    } else {

                        $complete = 'Cooperators';

                    }

                    // echo $this->db->last_query();

                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');

                    redirect('cooperatives/'.$id);

                  }

                }else{

                  $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');

                  redirect('cooperatives/'.$id);

                }

              }else{

                $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');

                redirect('cooperatives/'.$id);

              }

            }else{

              redirect('cooperatives/'.$id);

            }

          }else{

            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

            redirect('cooperatives');

          }

        }else{

          if($this->session->userdata('access_level')==5){

            redirect('admins/login');

          }else{

            redirect('cooperatives');

          }

        }

      }else{

        show_404();

      }

    }

  }



  public function add_payment()

  {
     $this->load->model('payment_model');
    if ($this->input->post('offlineBtn')){

      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));

      $this->payment_model->pay_offline($decoded_id);

      $data=array(

        'refNo' => $this->input->post('refNo'),

        'payor' => $this->input->post('payor'),

        'date'    => $this->input->post('tDate'),

        'nature'  => "Registration",

        'particulars'  => $this->input->post('particulars'),

        'amount'  => $this->input->post('amount'),

        'total'  => $this->input->post('total'),

        'cooperatives_id' => $decoded_id,

        'payment_option'=> 'offline',

        'status' => 0

      );



      if ($this->payment_model->check_payment_not_exist($data))

        $this->payment_model->save_payment($data,$this->input->post('rCode'));



      $user_id = $this->session->userdata('user_id');

      $report_exist = $this->db->where(array('payor'=>$this->input->post('payor')))->order_by("id","DESC")->get('payment');

          if($report_exist->num_rows()==0){

            // Payment Series

            $current_year = date('Y');

            $this->db->select('*');

            $this->db->from('payment');

            $this->db->where("(refNo IS NOT NULL OR refNo != '') AND YEAR(date) = '".$current_year."'");

            $series = $this->db->count_all_results();

            $data1['series'] = $series + 1;

            // End Payment Series

          } else {

            $this->db->select('*');

            $this->db->from('payment');

            $this->db->where('payor',$this->input->post('payor'));

            $this->db->order_by("id","DESC");

            $query = $this->db->get();

            $series = $query->row();

            $lastseries = $series->refNo;

            $string = substr($lastseries, strrpos($lastseries, '-' )+1);

            $data1['series'] = $string; // about-us

          }

      $data1['tDate'] = $this->payment_model->get_payment_info($data)->date;

      $data1['nature'] = $this->payment_model->get_payment_info($data)->nature;



      $data1['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);

      $data1['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);

      $data1['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);

      $data1['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);

      $data1['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);

      $data1['name_reservation_fee']=100.00;

      $data1['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);

      set_time_limit(0);



         // $this->load->view('cooperative\order_of_payment', $data1);

          $html2 = $this->load->view('cooperative/order_of_payment', $data1, TRUE);

          $J = new pdf();

          $J->setPaper('folio', 'portrait');

          $J->load_html($html2);

          $J->render();

          $J->stream("order_of_payment.pdf", array("Attachment"=>1));



      $this->session->set_flashdata('payment_success', 'Payment request has been submitted');

      // redirect('cooperatives/'.$this->input->post('cooperativeID').'/payments');

    } else if ($this->input->post('onlineBtn')){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      // $this->payment_model->pay_offline($decoded_id);
      $data=array(
        'cooperatives_id' => $decoded_id,
        'refNo' => $this->input->post('refNo'),
        'payor' => $this->input->post('payor'),
        'date'    => $this->input->post('tDate'),
        'nature'  => "Registration",
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $this->input->post('total'),
        'payment_option'=> 'online',
        'status' => 0
      );

      if ($this->payment_model->check_payment_not_exist($data)) {
      //   $this->payment_model->save_payment_online($data,$this->input->post('rCode'));
      //   $user_id = $this->session->userdata('user_id');
      //   $report_exist = $this->db->where(array('payor'=>$this->input->post('payor')))->order_by("id","DESC")->get('payment');

      //     // if($report_exist->num_rows()==0){
      //     //   // Payment Series
      //     //   $current_year = date('Y');
      //     //   $this->db->select('*');
      //     //   $this->db->from('payment');
      //     //   $this->db->where("(refNo IS NOT NULL OR refNo != '') AND YEAR(date) = '".$current_year."'");
      //     //   $series = $this->db->count_all_results();
      //     //   $data1['series'] = $series + 1;
      //     //   // End Payment Series
      //     // } else {
      //     //   $this->db->select('*');
      //     //   $this->db->from('payment');
      //     //   $this->db->where('payor',$this->input->post('payor'));
      //     //   $this->db->order_by("id","DESC");
      //     //   $query = $this->db->get();
      //     //   $series = $query->row();
      //     //   $lastseries = $series->refNo;
      //     //   $string = substr($lastseries, strrpos($lastseries, '-' )+1);
      //     //   $data1['series'] = $string; // about-us
      //     // }
      // $data1['cooperatives_id'] = $this->payment_model->get_payment_info($data)->cooperatives_id;
      // $data1['tTransactionNo'] = $this->payment_model->get_payment_info($data)->transactionNo;
      // $data1['tDate'] = $this->payment_model->get_payment_info($data)->date;
      // $data1['nature'] = $this->payment_model->get_payment_info($data)->nature;
      // $data1['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
      // $data1['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
      // $data1['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
      // $data1['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
      // $data1['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
      // $data1['name_reservation_fee']=100.00;
      // $data1['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);

      // // echo $data1['tTransactionNo'];
      // $way_up = $this->input->post('refNo').'-'.date('Hi');
      // $hash = strtolower(md5('2018070336'.$way_up.($this->input->post('total') * 100)));

      // $refno_replace = str_replace('-','',$this->input->post('refNo'));
      // $this->payment_model->update_payment_online($decoded_id,$way_up);

      // $enc_user_id = encrypt_custom($this->encryption->encrypt($user_id));
      // $enc_decoded_id = encrypt_custom($this->encryption->encrypt($decoded_id));

      // $params = array(
      //   'MerchantCode' => '2018070336',
      //   'MerchantRefNo' => $way_up,
      //   'Particulars' => 'transaction_type=Cooperative Name Reservation;TransactionNo='.$refno_replace.';Regional Office='.$this->input->post('rDesc').';Reservation Number='.$data1['tTransactionNo'].';Name of Applicant='.$this->input->post('name_of_applicant').';Proposed Name of Cooperative='.$this->input->post('proposed_name').';',
      //   'Amount' => $this->input->post('total'),
      //   'PayorName' => $this->input->post('payor'),
      //   'PayorEmail' => $this->input->post('payoremail'),
      //   'ReturnURLError' => base_url('payments/error/'.$enc_user_id),
      //   // 'ReturnURLOK' => 'http://ecoopris.cmvsd.com/ris_updating/payments/ok',
      //   // 'ReturnURLError' => base_url('payments/error/'.$user_id.'/'.$decoded_id),
      //   'ReturnURLOK' => base_url('payments/ok/'.$enc_user_id.'/'.$enc_decoded_id),
      //   'Hash' => $hash,
      // );

      // // redirect();
      // $url = 'https://222.127.109.48/epp20200915/?';
      // // $url = 'https://epaymentportal.landbank.com/?';

      // $postData = '';
      //   //create name value pairs seperated by &
      //   foreach($params as $k => $v)
      //   {
      //     $postData .= $k . '='.$v.'&';
      //   }

      // $complete_url = $url.$postData;
      // header("Location: ".$complete_url."");
        }

    }

    public function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v)
        {
          $postData .= $k . '='.$v.'&';
        }
        rtrim($postData, '&');


        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$_url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_POST, count($postData));
        echo print_r($postData);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // $output=curl_exec($ch);

        // curl_close($ch);

        return $postData;
    }

    public function ok($user_id = null,$coop_id = null){
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

      $query_epp = $this->db->get_where('payment', array('cooperatives_id' => $decoded_id));
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

      // echo print_r($obj);

      $this->payment_model->pay_online($decoded_id,$obj);

      $this->session->set_flashdata('list_success_message', 'Payment Success');
      echo ("<script LANGUAGE='JavaScript'>window.location='".base_url()."cooperatives';</script>");
    }

    public function error($user_id = null){
      $user_id = $this->encryption->decrypt(decrypt_custom($user_id));

      $query= $this->db->get_where('users', array('id' => $user_id));
      $row = $query->row();

      $user_data = array(
        'user_id' => $row->id,
        'email' => $row->email,
        'client' => true,
        'logged_in' => true
      );

      $this->session->set_userdata($user_data);

      $this->session->set_flashdata('list_error_message', 'Payment Failed');
      echo ("<script LANGUAGE='JavaScript'>window.location='".base_url()."cooperatives';</script>");

    }

}
