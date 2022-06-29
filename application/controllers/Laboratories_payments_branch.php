<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratories_payments_branch extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('laboratories_model');
    $this->load->model('branches_model');
    $this->load->model('user_model');
    $this->load->model('payment_branch_model');
    $this->load->model('payment_model');
  }

  function index($id = null) {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){ 
//            if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
//              if($this->branches_model->check_evaluator1($decoded_id)){
//                if($this->branches_model->check_evaluator2($decoded_id)){
//                  if($this->branches_model->check_evaluator3($decoded_id)){
//                    if($this->branches_model->check_evaluator4($decoded_id)){
                      if($this->branches_model->check_evaluator5_laboratories($decoded_id)){
                        $data['client_info'] = $this->user_model->get_user_info($user_id);
                        $data['title'] = 'Payment Details';
                        $data['header'] = 'Order of Payment';
                        $data['encrypted_id'] = $id;
                        $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                        $branch_info = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
                        $data['branch_info'] = $branch_info;
                        $data['lab_fee'] =50.00;
//                        if ($branch_info->category_of_cooperative=='Primary' && substr($branch_info->branchName,-7)=='Branch '){
//                          $data['branching_fee']=500.00;
//                          $data['last']=substr($branch_info->branchName,-7);
//                        }
//                        else if ($branch_info->category_of_cooperative=='Secondary' && substr($branch_info->branchName,-7)=='Branch '){
//                          $data['branching_fee']=2000.00;
//                          $data['last']=substr($branch_info->branchName,-7);
//                        }
//                        else if ($branch_info->category_of_cooperative=='Tertiary' && substr($branch_info->branchName,-7)=='Branch '){
//                          $data['branching_fee']=3000.00;
//                          $data['last']=substr($branch_info->branchName,-7);
//                        }
//                        else if ($branch_info->category_of_cooperative=='Secondary' && substr($branch_info->branchName,-10)=='Satellite '){
//                          $data['branching_fee']=1000.00;
//                          $data['last']=substr($branch_info->branchName,-10);
//                        }
//                        else if ($branch_info->category_of_cooperative=='Tertiary' && substr($branch_info->branchName,-10)=='Satellite '){
//                          $data['branching_fee']=2000.00;
//                          $data['last']=substr($branch_info->branchName,-10);
//                        }
//                        else{
//                          $data['branching_fee']=500.00;
//                          $data['last']=substr($branch_info->branchName,-10);
//                        }

                        // Payment Series
                          $current_year = date('Y');
                          $this->db->select('*');
                          $this->db->from('payment');
                          $this->db->where("(refNo IS NOT NULL OR refNo != '') AND YEAR(date) = '".$current_year."'");
                          $series = $this->db->count_all_results();
                          $data['series'] = $series + 1;
                        // End

                        $data['pay_from']='branching';
                        $this->load->view('./template/header', $data);
                        $this->load->view('laboratories/payment_form_laboratories', $data);
                        $this->load->view('./template/footer', $data);
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Regional Director.');
                          redirect('laboratories/'.$id);
                      }
//                    }else{
//                      $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');
//                      redirect('branches/'.$id);
//                    }
//                  }else{
//                    $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Cooperative Development Specialist II.');
//                    redirect('branches/'.$id);
//                  }
//                }else{
//                  $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Regional Director.');
//                  redirect('branches/'.$id);
//                }
//              }else{
//                $this->session->set_flashdata('redirect_applications_message', 'This cooperative must be evaluated first by a Senior Cooperative Development Specialist.');
//                redirect('branches/'.$id);
//              }        
//            }else{
//              $this->session->set_flashdata('redirect_applications_message', 'This cooperative is not yet  evaluated.');
//              redirect('branches/'.$id);
//            }                
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('laboratories');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('laboratories');
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
      
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
      $this->payment_branch_model->pay_offline_laboratories($decoded_id);
      $app_code_type='L-'.$decoded_id;//(L-7) L is laboratory + -laboratoryID
      $data=array(
        'payor' => $this->input->post('payor'),
        'refNo' => $this->input->post('refno'),
        'date'    => $this->input->post('tDate'),
        'nature'  => $this->input->post('nature'),
        'particulars'  => $this->input->post('particulars'),
        'amount'  => $this->input->post('amount'),
        'total'  => $this->input->post('total'),
        'payment_option'=> 'offline',
        'app_code_type' => $app_code_type,
        'status' => 0
      );
        // $this->debug($data);
      if ($this->payment_branch_model->check_payment_not_exist_laboratories($data))
      { 
        $this->payment_branch_model->save_payment($data,$this->input->post('rCode'));
        // echo $this->db->last_query();
      }
        //modify by json
       $laboratory_id= $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
       $lab_data = array('status'=>20);
       $this->db->update('laboratories',$lab_data,array('id'=>$laboratory_id));

        $user_id = $this->session->userdata('user_id');
        $data1['payment'] = $this->payment_branch_model->get_payment_info($data);
        $data1['last_query'] = $this->db->last_query();
        $data1['series'] = $this->input->post('refno');
     

          set_time_limit(0);
         // $this->debug($data1);
         // $this->load->view('cooperative/order_of_payment_branch', $data1);
          $html2 = $this->load->view('cooperative/order_of_payment_lab', $data1, TRUE);
          $J = new pdf();
          $J->setPaper('folio', 'portrait');
          $J->load_html($html2);
          $J->render();
          $J->stream("Order_Of_Payment.pdf", array("Attachment"=>1));

      $this->session->set_flashdata('redirect_applications_message', 'Payment request has been submitted');
      // redirect('laboratories');
    }
     else if ($this->input->post('onlineBtn')){
      //change status GET YOUR CERTIFICATE
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
      $this->payment_model->pay_online($decoded_id);
      $this->session->set_flashdata('redirect_applications_message', 'Thank you for paying online. You may now get your certificate.');
     redirect('cooperatives');
     }else{
      $this->session->set_flashdata('redirect_applications_message', 'Error');
     redirect('cooperatives');}
  }

   public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    } 
}
