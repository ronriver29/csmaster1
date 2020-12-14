<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_payments extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('amendment_uploaded_document_model');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
              if($data['bylaw_complete']){
                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
//                if($data['article_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if($data['cooperator_complete']){
                    $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                    if($data['committees_complete']){
                      $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                        if(!$data['economic_survey_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                      }
                      if($data['economic_survey_complete']){
                        $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                        if($data['staff_complete']){
                          $data['document_one'] = $this->amendment_uploaded_document_model->get_document_one_info($decoded_id);
                          $data['document_two'] = $this->amendment_uploaded_document_model->get_document_two_info($decoded_id);
                          if($data['document_one'] && $data['document_two']){
                            if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                              if($this->amendment_model->check_first_evaluated($decoded_id)){
                                if($this->amendment_model->check_second_evaluated($decoded_id)){
                                  if($this->amendment_model->check_last_evaluated($decoded_id)){
                                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                                    $data['title'] = 'Payment Details';
                                    $data['header'] = 'Order of Payment';
                                    $data['encrypted_id'] = $id;
                                    $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                                    $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                                    $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);

                                    $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
                                     // $this->debug($data['article_info']);
                                    $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                    $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                    $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                    $data['name_reservation_fee']=100.00;
                                    $data['pay_from']='reservation';

                                    $data['coop_capitalization']=$this->coop_capitalization($cooperative_id);
                                    $data['amendment_capitalization']= $this->amendment_capitalization($decoded_id);
                                     
                                     $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                     if(strlen($data['coop_info_orig']->acronym_name)>0)
                                     {
                                       $acronym =' ('.$data['coop_info_orig']->acronym_name.')';
                                     }
                                     else
                                     {
                                      $acronym = '';
                                     }
                                    $coop_orig_name = $data['coop_info_orig']->proposed_name;
                                    $data['original_coop_name']= $coop_orig_name.$acronym;
                                    // $this->debug( $data['coop_info_orig']);
                                    $this->load->view('./template/header', $data);
                                    $this->load->view('amendment/payment_form', $data);
                                    $this->load->view('./template/footer', $data);
                                  }else{
                                    $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');
                                    redirect('amendment/'.$id);
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');
                                  redirect('amendment/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Cooperative Development Specialist II.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              echo 'asd';
                            }
                          }else if(!$data['document_one'] && !$data['document_two']){
                            $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');
                            redirect('amendment/'.$id);
                          }else if(!$data['document_one']){
                            $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');
                            redirect('amendment/'.$id);
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                      redirect('amendment/'.$id);
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                    redirect('amendment/'.$id);
                  }
//                }else{
//                  $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
//                  redirect('amendment/'.$id);
//                }
              }else{
                $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                redirect('amendment/'.$id);
              }
            }else{
              redirect('amendment/'.$id);
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
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
    $qry =$this->db->query("select * from capitalization where cooperatives_id='$cooperative_id'");
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
    if ($this->input->post('offlineBtn')){
 
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
      $this->Payment_model->pay_offline_amendment($decoded_id);
      $data=array(
        'payor' => $this->input->post('payor'),
        'date'    => $this->input->post('tDate'),
        'nature'  => $this->input->post('nature'),
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $this->input->post('total'),
        'payment_option'=> 'offline',
        'status' => 0,
        'amendment_id'=> $decoded_id
      );
      // $this->debug($data);
    
      if ($this->Payment_model->check_payment_not_exist_amendment($data))
       {

       
        if(!$this->Payment_model->save_payment($data,$this->input->post('rCode')))
        {
             $this->session->set_flashdata('redirect_applications_message', 'Error Saving payment details');
              redirect('amendment');
        }
        else
        {
         
          $user_id = $this->session->userdata('user_id');
          $data1['tDate'] = $this->Payment_model->get_payment_info_amendment($data)->date;
          // echo $this->db->last_query();
          $data1['nature'] = $this->Payment_model->get_payment_info_amendment($data)->nature;

          $data1['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
          $data1['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
          // $data1['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
          // $data1['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
          $data1['name_reservation_fee']=100.00;
          $data1['coop_capitalization']=$this->coop_capitalization($cooperative_id);
          $data1['amendment_capitalization']= $this->amendment_capitalization($decoded_id);

          $data1['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
          if(strlen($data1['coop_info_orig']->acronym_name)>0)
          {
          $acronym =' ('.$data1['coop_info_orig']->acronym_name.')';
          }
          else
          {
          $acronym = '';
          }
          $coop_orig_name = $data1['coop_info_orig']->proposed_name;
          $data1['original_coop_name']= $coop_orig_name.$acronym;
          // $this->debug( $data1['original_coop_name']);
         // $this->load->view('amendment\order_of_payment', $data1);
          $html2 = $this->load->view('amendment/order_of_payment', $data1, TRUE);
          $J = new pdf();
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("order_of_payment.pdf", array("Attachment"=>1));
        }//end payment save
      }
      else{
          $user_id = $this->session->userdata('user_id');
          $data1['tDate'] = $this->Payment_model->get_payment_info_amendment($data)->date;
          // echo $this->db->last_query();
          $data1['nature'] = $this->Payment_model->get_payment_info_amendment($data)->nature;

          $data1['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
          $data1['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
          // $data1['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
          // $data1['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
          $data1['name_reservation_fee']=100.00;
          $data1['coop_capitalization']=$this->coop_capitalization($cooperative_id);
          $data1['amendment_capitalization']= $this->amendment_capitalization($decoded_id);

          $data1['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
          if(strlen($data1['coop_info_orig']->acronym_name)>0)
          {
          $acronym =' ('.$data1['coop_info_orig']->acronym_name.')';
          }
          else
          {
          $acronym = '';
          }
          $coop_orig_name = $data1['coop_info_orig']->proposed_name;
          $data1['original_coop_name']= $coop_orig_name.$acronym;
          // $this->debug( $data1['original_coop_name']);
         // $this->load->view('amendment\order_of_payment', $data1);
          $html2 = $this->load->view('amendment/order_of_payment', $data1, TRUE);
          $J = new pdf();
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("order_of_payment.pdf", array("Attachment"=>1));

      } //end check paymet exist
    }
     else if ($this->input->post('onlineBtn')){
      //change status GET YOUR CERTIFICATE
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $this->Payment_model->pay_online($decoded_id);
      $this->session->set_flashdata('redirect_applications_message', 'Thank you for paying online. You may now get your certificate.');
     redirect('amendment');
     }else{
      $this->session->set_flashdata('redirect_applications_message', 'Error');
     redirect('amendment');
    }
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
