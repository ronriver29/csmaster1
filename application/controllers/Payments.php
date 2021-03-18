<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->library('Numbertowords');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                      $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                      if($data['economic_survey_complete']){
                        $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                        if($data['staff_complete']){
                          $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                          $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                          if($data['document_one'] && $data['document_two']){
//                            if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                              if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                                if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                                  if($this->cooperatives_model->check_last_evaluated($decoded_id)){
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
                    if($data['coop_info']->grouping == 'Federation'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
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
    if ($this->input->post('offlineBtn')){
      
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $this->Payment_model->pay_offline($decoded_id);
      $data=array(
        'payor' => $this->input->post('payor'),
        'date'    => $this->input->post('tDate'),
        'nature'  => "Registration",
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $this->input->post('total'),
        'payment_option'=> 'offline',
        'status' => 0
      );

      if ($this->Payment_model->check_payment_not_exist($data))
        $this->Payment_model->save_payment($data,$this->input->post('rCode'));
      
      $user_id = $this->session->userdata('user_id');

      $data1['tDate'] = $this->Payment_model->get_payment_info($data)->date;
      $data1['nature'] = $this->Payment_model->get_payment_info($data)->nature;

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

     // $this->session->set_flashdata('redirect_applications_message', 'Payment request has been submitted');
      //redirect('cooperatives');
    }
     else if ($this->input->post('onlineBtn')){
      //change status GET YOUR CERTIFICATE
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $user_id = $this->session->userdata('user_id');
      
      $data['encrypted_id'] = $decoded_id;
      $data['is_client'] = $this->session->userdata('client');
      $data['client_info'] = $this->user_model->get_user_info($user_id);
      $data['title'] = 'Payment Details';
      $data['header'] = 'Online Payment';
  //     $this->Payment_model->pay_online($decoded_id);
  //     $this->session->set_flashdata('redirect_applications_message', 'Thank you for paying online. You may now get your certificate.');
  //    redirect('cooperatives');
  //    }else{
  //     $this->session->set_flashdata('redirect_applications_message', 'Error');
  //    redirect('cooperatives');}

  // Anjury Modification
      $this->load->view('./template/header', $data);
      $this->load->view('cooperative/payment_form_online', $data);
      $this->load->view('./template/footer', $data);
      }
    }

    public function ok(){

      $data['sta']='ok';
       $this->load->view('payment_form',$data);
    }
      
    public function error(){

      $data['sta']='error';
       $this->load->view('payment_form',$data);
    }
}
