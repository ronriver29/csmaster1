<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {
    if($this->session->userdata('logged_in')){
      redirect('cooperatives');
    }else{
      redirect('users/login');
    }
  }

  public function login() 
  {
    if($this->session->userdata('logged_in')){
      redirect('cooperatives');
    }else{
      $data['title'] = 'Login';
      $data['header']= 'huy';
      if ($this->form_validation->run() == FALSE){
        $this->load->view('./template/header', $data);
        $this->load->view('client/login', $data); //client login
        $this->load->view('./template/footer');
      }else{
        $data = array(
          'email' => $this->input->post('eAddressLogin'),
          'password'=> $this->input->post('passwordLogin'),
        );
        if($this->user_model->login_user($data)){
          $user_data = $this->user_model->check_email_verified($data);
          $user_data['time'] = time();
          if($user_data){
              
           $this->session->set_userdata($user_data);
           // print_r($this->session->userdata());
        
            $this->session->set_flashdata('login_success', 'You are now logged in.');
            redirect('cooperatives');
          }else{
            $this->session->set_flashdata('login_failed', 'Your account is not yet verified. Please check your email.');
            redirect('users/login');
          }
        }else{
          $this->session->set_flashdata('login_failed', 'Invalid email/password');
          redirect('users/login');
        }
      }
    }
  }
  public function signup()
  {
    if($this->session->userdata('logged_in')){
      redirect('cooperatives');
    }else{
      $data['title'] = 'Sign Up';
      $data['header'] = '';
      // if ($this->form_validation->run() == FALSE){
        //get id list
        $id_query = $this->db->get('id_list');
        if($id_query->num_rows()>0)
        {
          $data['list_id'] = $id_query->result_array();
        }
        else
        {
          $data['list_id'] = NULL;
        }
        $this->load->view('./template/header', $data);
        $this->load->view('client/signup', $data);
        $this->load->view('./template/footer');
      // }else{
        if(isset($_POST['signUpBtn']))
        {


        $data = array(
          'last_name' => $this->input->post('LastName'),
          'first_name' => $this->input->post('Name'),
          'middle_name'=> $this->input->post('middle_name'),
          'birthdate' => $this->input->post('bDate'),
          'contact_number' => $this->input->post('mNo'),
          'email' => $this->input->post('eAddress'),
          'address' => $this->input->post('hAddress'),
          'password' => password_hash($this->input->post('pword'), PASSWORD_BCRYPT),
          'hash' => md5(rand(0, 1000)),
          'type_id' => $this->input->post('type_id'), 
          'valid_id_number' => $this->input->post('validIdNo'),
        );
          // print_r($data);
          $data = $this->security->xss_clean($data);
          if($this->user_model->add_user($data)){
            if($this->user_model->sendEmail($data['email'],$data['hash'])){
              $this->session->set_flashdata(array('email_sent_success'=>'Your account has been created.</br> Please check your email to verify your account.'));
              redirect('users/login');
            }else{
              redirect('users/login');
            }
          }else{
            echo 'server error';
          }
        }//end isset
        
      // }
    }
  }
  public function verify($email = '', $hash = ''){
    $head['title'] = 'Email Verification';
    if(!empty($email) && !empty($hash)){
      $data = array (
        'email' => $email,
        'hash' => $hash
      );
      $data = $this->security->xss_clean($data);
      $msg = $this->user_model->verifyEmail($data);
      if($msg['success']){
        $this->load->view('./template/header', $head);
        $this->load->view('verification/verify_success',$msg);
        $this->load->view('./template/footer');
      }else{
        $this->load->view('./template/header', $head);
        $this->load->view('verification/verify_error',$msg);
        $this->load->view('./template/footer');
      }
    }else{
       show_404();
    }
  }

  public function forgot_password()
  {
    $data['alert_class']=''; //alert class value
    if(isset($_POST['submit-email-client']))
    {
     $u_email = $this->input->post('eAddressLogin');
      //check email in users
      $check_user_query = $this->db->get_where('users',array('email'=> $u_email));
      if($check_user_query->num_rows()>0)
      {
        foreach($check_user_query->result_array() as $row)
        {
          $id = $row['id'];
          $user_email = $row["email"];
        }
         //echo'email already exist.';
        // $this->load->helper('string');
        $temp_passwd = random_string('alnum',8); //create temp password
        $u_data = array('password'=>password_hash($temp_passwd, PASSWORD_BCRYPT),'updated_at'=> date('Y-m-d h:i:s',now('Asia/Manila')));
        $update_passwd = $this->db->update('users',$u_data,array('id'=>$id));
        {
          if($update_passwd)
          {
              $send_mail = $this->sendEmailpassword($user_email,$temp_passwd);
              if($send_mail)
              {
                 $data['alert_class'] ='success';
                $this->session->set_flashdata(array('resetpsswd_msg'=>"Success check your email to recover your account"));
              } 
              else 
              {
                 $data['alert_class'] ='danger';
              $this->session->set_flashdata(array('resetpsswd_msg'=>"Error while trying to send the data to your email. Plaese Contact System Administrator."));
              }
          }
          else
          {
            $this->session->set_flashdata(array('resetpsswd_msg' => "Failed to recover your password."));
          }
        } 
        

      }
      else
      {
        echo'email not recognized';
      } //end of num rows
    }
      $head = 'Account recovery';
      $msg= '';
      $this->load->view('./template/header', $head);
        $this->load->view('client/v_forgotpassword',$data);
        $this->load->view('./template/footer'); 
  }

   public function sendEmailpassword($email,$temppassword){
      $from = "coopris.test@gmail.com";    //senders email address
      $subject = 'Password recovery';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been reset. Please see your updated login details below. <br>".
      "<ul><li>Username/email: ".$email."</li><li>Password: ".$temppassword."</li></ul><br/>
      Once logged in, we suggest you to change your password immediately. 
      ";
      $this->email->from($from,'CoopRIS Administrator');
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
  }


  public function change_passwd()
  {
    $data['alert_class']='';
    $u_id=  $this->session->userdata('user_id');
    if(isset($_POST['submit-change-passwd']))
    {
      $input_current_passwd = $this->input->post('password');
      $new_passwd = $this->input->post('newpassword');
      $confirm_password = $this->input->post('conf_password');
      // echo "new" .$new_passwd.  ' confirm' . $confirm_password;
      if($new_passwd != $confirm_password)
      {
              $data['alert_class'] = 'danger';
            $this->session->set_flashdata(array('change_password_msg'=>"Password did not match."));
      }
      else
      {

     
        //check current password
        $check_query = $this->db->get_where('users',array('id'=>$u_id));
        if($check_query->num_rows()>0)
        {
          foreach($check_query->result_array() as $row)
          {
            // $current_passwd = $row['password'];
            $input_verified_passwd = password_verify($input_current_passwd,$row['password']);
            if($input_verified_passwd ==1)
            {
               $u_data = array(
                'password'=>password_hash($new_passwd, PASSWORD_BCRYPT),
                'updated_at'=> date('Y-m-d h:i:s',now('Asia/Manila'))
                );
                 $update_passwd = $this->db->update('users',$u_data,array('id'=>$u_id));
                 if($update_passwd)
                 {
                  $data['alert_class'] = 'success';
                   $this->session->set_flashdata(array('change_password_msg'=>"Successfully password changed."));//password match';
                 }
               
            }
            else
            {
                  $data['alert_class'] = 'danger';
              $this->session->set_flashdata(array('change_password_msg'=>"Failed! Password not exist."));
            }

          }
        }
        else
        {
          echo "no user found.";
        }
       }// end of confirm password  
    }


      $data['client_info'] = $this->user_model->get_user_info($u_id);
      $data['header'] = 'Change Password';
       $this->load->view('./template/header',$data);
        $this->load->view('client/v_change_passwd',$data);
        $this->load->view('./template/footer',$data); 

  }

  public function logout(){
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('client');
    $this->session->unset_userdata('pagecount');
    redirect('users/login');
  }
  public function fullname_check($fname = null){
    if(preg_match('/^([A-Z]+[a-zA-Z ]*[\'\,\.\-]?[a-zA-Z ]*)+([ ]+[A-Z]+[a-zA-Z ]*[\'\,\.\-]?)+$/',$fname)){
      return TRUE;
    }else{
      $this->form_validation->set_message('fullname_check', 'Please enter your full name.');
      return FALSE;
    }
  }
  public function mobile_number_check($mobile_num){
    if(preg_match('/^[0][1-9]\d{9}$/',$mobile_num)){
      return TRUE;
    }else{
      $this->form_validation->set_message('mobile_number_check', 'Must be 11 digit number and start with 0.');
      return FALSE;
    }
  }
  public function birthdate_check($dte){
    $dteInput = new DateTime($dte);
    $dteNow = new DateTime();
    $dif = $dteNow->diff($dteInput);
    if ($dte == '' || is_null($dte))
      {
        $this->form_validation->set_message('birthdate_check', 'Please enter your birth date.');
        return FALSE;
    }else if($dif->y <18){
        $this->form_validation->set_message('birthdate_check','Age must be 18 and above.');
        return FALSE;
    }else
        {
          return TRUE;
        }
    }
    public function check_email_exists(){
      if($this->input->get('fieldId') && $this->input->get('fieldValue')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue')
        );
        $result = $this->user_model->check_email_exists($data);
        echo json_encode($result);
      }else{
        show_404();
      }
    }

    ///modify
     public function users_manual($file_name)
    {
        $filename= $this->encryption->decrypt(decrypt_custom($file_name));
          $this->output->set_header('Content-Disposition: inline; filename="'.$filename.'"')
          ->set_content_type('application/pdf','utf-8','CoopRIS')
          ->set_output(
          file_get_contents('user_guide/user_manual/'.$filename)
          );
    }  

}
