<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Account_approval extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
    }
    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        
            $data['title'] = 'Account Approval';
            $data['header'] = 'Account Approval';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_account_approval_ho($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_account_approval($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_account_approval', $data);
            $this->load->view('applications/assign_admin_modal');
            $this->load->view('templates/admin_footer');
          
      }
    }

    public function view($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
            
        $data['title'] = 'Account Approval Detail';
        $data['header'] = 'Account Information';
        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
        $data['account_info'] = $this->cooperatives_model->get_account_info_by_senior($decoded_id);
        $data['id'] = $decoded_id;

        // $this->load->helper('download');
        // $data = file_get_contents('./uploads/21052-20210312104031855288622.pdf');
        // force_download('file.pdf', $data);

        $this->load->view('./templates/admin_header', $data);
        $this->load->view('cooperative/account_approval_detail', $data);
        $this->load->view('applications/deny_account');
        $this->load->view('./templates/admin_footer');
      }
    }
    public function download($id = null){

        $this->load->helper('download');
        $data = file_get_contents(UPLOAD_DIR.'/'.$id);
        force_download('file.pdf', $data);
      
    }

    public function approve($id = null,$email){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $email = $this->encryption->decrypt(decrypt_custom($email));

        $temp_passwd = random_string('alnum',8);
        $data = array(
          'is_verified' => 1,
          'is_taken' => 1,
          'password'=> password_hash($temp_passwd, PASSWORD_BCRYPT)
        );

        $getRegCoop = $this->db->get_where('users',array('id'=>$decoded_id));
          if($getRegCoop->num_rows() != 0){
            foreach($getRegCoop->result_array() as $reg){
              $regCode = $reg['addrCode'];
              $regNo = $reg['regno'];
              $email = $reg['email'];
            }
          }

        $this->db->select('*');
        $this->db->from('registeredcoop');
        $this->db->where('regNo', $regNo);
        $this->db->limit('1');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $reg = $query->row();

        $this->db->select('*');
        $this->db->from('refregion');
        $this->db->where('regCode', '0'.substr($regCode, 0, 2));
        $query2 = $this->db->get();
        $region = $query2->row();

        $data_registeredcoop = array(
          'addrCode' => $regCode
        );

        $from = "ecoopris@cda.gov.ph";    //senders email address
        $subject = 'Cooperative Account Application';  //email subject
        $burl = base_url();
           
        $message = "Good day! Your application for account creation with the following information had been APPROVED.<br><br>

        a. ".$reg->coopName."<br>
        b. ".$region->regDesc."<br>
        c. ".$reg->regNo."<br>
        d. ".$reg->noStreet." ".$reg->Street."<br>
        e. ".$email."<br>

        Your Password is: ".$temp_passwd." . <br><br>You may now login and update your cooperative information thru this link:".base_url()."users/login";
       
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        

        $this->db->where(array('id'=>$decoded_id));
        $this->db->update('users',$data);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to approve. Please Contact Administrator.'));
          redirect('account_approval');
        }else{
          $this->db->where(array('regNo'=>$regNo));
          $this->db->update('registeredcoop',$data_registeredcoop);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to approve. Please Contact Administrator.'));
            redirect('account_approval');
          } else {
            $this->db->trans_commit();
            $this->session->set_flashdata(array('email_sent_success'=>'Account has been approved.'));
            redirect('account_approval');
          }
        }
    }

    public function deny($id = null,$email){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $email = $this->encryption->decrypt(decrypt_custom($email));
        $reason = $this->input->post('reason');

        // echo $decoded_id.'<br>';
        // echo $email.'<br>';
        // echo $reason;
        $data = array(
          'is_verified' => 2,
          'is_taken' => 2
        );

        $from = "ecoopris@cda.gov.ph";    //senders email address
        $subject = 'Cooperative Account Application';  //email subject
        $burl = base_url();
           
        $message = "Good day! Your application for account creation had been denied due to the following reasons:<br><br>

        ".nl2br($reason)."";
       
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        $this->db->where(array('id'=>$decoded_id));
        $this->db->delete('users');
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to deny. Please Contact Administrator.'));
          redirect('account_approval');
        }else{
          $this->db->trans_commit();
          $this->session->set_flashdata(array('email_sent_success'=>'Account has been denied.'));
          redirect('account_approval');
        }
      
    }
  }
?>