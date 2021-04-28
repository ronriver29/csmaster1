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
          if($user_data){    
           $this->session->set_userdata($user_data);
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
        $this->load->view('client/options');
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
  public function use_registered_email()
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

        $data['regions_list'] = $this->region_model->get_regions();

        $this->load->view('./template/header', $data);
        // $this->load->view('client/options');
        $this->load->view('client/use_registered_email', $data);
        $this->load->view('./template/footer');
      // }else{
        if(isset($_POST['signUpBtn']))
        {
        // $coop_exist = $this->db->get_where('registeredcoop',array('regNo'=>$this->input->post('regno')));
        $coop_exist = $this->db->get_where('users',array('email'=>$this->input->post('eAddress'),'regNo'=>$this->input->post('regno')));
        $email_taken = $this->db->where(array('email'=>$this->input->post('eAddress')))->get('users');

        // $coop_exist = $this->db->where(array('regNo'=>$this->input->post('regno')))->get('registeredcoop');
        // $coop_exist2 = $this->db->where(array('email'=>$this->input->post('eAddress')))->get('users');
        if($coop_exist->num_rows()==0){
          $is_taken = 0;
        } else {
          foreach($coop_exist->result_array() as $row)
          {
            $is_taken = $row['is_taken'];
          }
          
        }

        if($is_taken == '1'){
          $this->session->set_flashdata(array('email_sent_warning'=>'This Registration is already Taken'));
                redirect('users/use_registered_email');
        } 
        // elseif($email_taken->num_rows() > 0) {
        //   $this->session->set_flashdata(array('email_sent_warning'=>'Email already Taken.'));
        //         redirect('users/use_registered_email');
        // } 
        else {
          if ($coop_exist->num_rows()==0){
              $this->session->set_flashdata(array('email_sent_warning'=>'Email or Registration Number does not match.'));
                redirect('users/use_registered_email');
            // echo '<script>alert("adsdaddadddddd");</script>';
          } else {
              $temp_passwd = random_string('alnum',8); //create temp password
              
              $u_data = array(
                'last_name' => $this->input->post('LastName'),
                'first_name' => $this->input->post('Name'),
                'middle_name' => $this->input->post('middle_name'),
                'birthdate' => $this->input->post('bDate'),
                'contact_number' => $this->input->post('mNo'),
                'type_id' => $this->input->post('type_id'), 
                'valid_id_number' => $this->input->post('validIdNo'),
                'address' => $this->input->post('hAddress'),
                'password'=>password_hash($temp_passwd, PASSWORD_BCRYPT),
                'updated_at'=> date('Y-m-d h:i:s',now('Asia/Manila')),
                'is_taken'=>1,
                'is_verified' => 1,
                'addrCode' => $this->input->post('barangay')
              );

              $regcoop_data = array(
                'addrCode' => $this->input->post('barangay')
              );
              
              $update_passwd = $this->db->update('users',$u_data,array('email'=>$this->input->post('eAddress'),'is_taken = 0 OR is_taken IS NULL'));
              {
                $update_regcoop_address = $this->db->update('registeredcoop',$regcoop_data,array('regNo'=>$this->input->post('regno')));
                if($update_passwd)
                {   
                    
                    $reg_name = $this->db->get_where('registeredcoop',array('regNo'=>$this->input->post('regno')));
                    foreach($reg_name->result_array() as $row)
                    {
                      $coopName = $row['coopName'];
                    }

                    $send_mail = $this->sendEmailpassword($this->input->post('eAddress'),$temp_passwd);
                    if($send_mail)
                    {
                      $this->session->set_flashdata(array('email_sent_success'=>"".$coopName.". You're account credentials have been sent to your email."));
                      redirect('users/login');
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
          }
        }//end isset
        
      // }
    }
  }

  public function create_new_email_account()
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
        $data['regions_list'] = $this->region_model->get_regions();
        $this->load->view('./template/header', $data);
        // $this->load->view('client/options');
        $this->load->view('client/create_new_email_account', $data);
        $this->load->view('./template/footer');
      // }else{
        if(isset($_POST['signUpBtn']))
        {

        $coop_exist = $this->db->where(array('regNo'=>$this->input->post('regno')))->get('registeredcoop');
        $coop_exist_taken = $this->db->where(array('regNo'=>$this->input->post('regno'),'is_taken'=>1))->get('users');
        $email_taken = $this->db->where(array('email'=>$this->input->post('eAddress')))->get('users');
        // $coop_exist = $this->db->get_where('registeredcoop',array('regNo'=>$this->input->post('regno')));
        if($coop_exist->num_rows() == 0){
          $this->session->set_flashdata(array('email_sent_warning'=>'Registration Number does not Exist.'));
                // redirect('users/create_new_email_account');
        } elseif($coop_exist_taken->num_rows() > 0) {
          $this->session->set_flashdata(array('email_sent_warning'=>'Registration Number already Taken.'));
                // redirect('users/create_new_email_account');
        } 
        // elseif($email_taken->num_rows() > 0) {
        //   $this->session->set_flashdata(array('email_sent_warning'=>'Email already Taken.'));
        //         // redirect('users/create_new_email_account');
        // } 
        else {

          $getRegCoop = $this->db->get_where('registeredcoop',array('regNo'=>$this->input->post('regno')));
          if($getRegCoop->num_rows() != 0){
            foreach($getRegCoop->result_array() as $reg){
              $regCode = $reg['addrCode'];
            }
          } 
          // else {
          //   $this->session->set_flashdata(array('email_sent_warning'=>'Registered Cooperatives has no Region assign. Please contact the System Admin!'));
          //       redirect('users/create_new_email_account');
          // }
          // echo $this->input->post('barangay');
          // $newregCode2 = substr($this->input->post('barangay'), 0, 2);
          // $newregCode2 = '0'.$newregCode2;

          $newregCode = substr($this->input->post('barangay'), 0, 2);
          $newregCode = '0'.$newregCode;

          // echo $newregCode2;

          $getAdminEmail = $this->db->get_where('admin',array('access_level'=>2,'region_code'=>$newregCode));
          if($getAdminEmail->num_rows() != 0){
            foreach($getAdminEmail->result_array() as $email){
              $AdminEmail = $email['email'];
            }
          } 
          // else {
          //   $this->session->set_flashdata(array('email_sent_warning'=>'Registered Cooperatives has no Region assign. Please contact the System Admin'));

          //   // print_r($getAdminEmail->num_rows());
          //       redirect('users/create_new_email_account');
          // }

          $img = $_FILES['img'];

          if(!empty($img))
          {
              $img_desc = $this->reArrayFiles($img);
              // print_r($img_desc);
              $newnamearray = array();
              foreach($img_desc as $val)
              {
                  $newname = $this->input->post('regno').'-'.date('YmdHis',time()).mt_rand().'.pdf';
                  move_uploaded_file($val['tmp_name'],UPLOAD_DIR.$newname);

                  $newnamearray[] = $newname;
              }

              $filenameuser = implode('|',$newnamearray);
          }

          $full_name = $this->input->post('LastName').', '.$this->input->post('Name');
          $data = array(
            'regno' => $this->input->post('regno'),
            'files' => $filenameuser,
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
            'addrCode' => $this->input->post('barangay')
          );
            // print_r($data);
            $data = $this->security->xss_clean($data);
            if($this->user_model->add_user($data)){
              if($this->user_model->sendEmailCreateNewEmail($data['email'],$data['hash'],$full_name,$newnamearray,$AdminEmail)){
                $this->session->set_flashdata(array('email_sent_success'=>'Your account application is pending for approval. Result and login credentials will be sent to your email.'));
                // redirect('users/login');
              }else{
                redirect('users/login');
              }
            }else{
              echo 'server error';
            }
          }//end isset
        }
          
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
      // echo"<pre>";print_r($data); echo "<pre>";
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
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Password recovery';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been reset. Please see your updated login details below. <br>".
      "<ul><li>Username/email: ".$email."</li><li>Password: ".$temppassword."</li></ul><br/>
      Once logged in, we suggest you to change your password immediately. 
      ";
      $this->email->from($from,'ecoopris CDA (No Reply)');
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

    function reArrayFiles($file)
    {
        $file_ary = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);
       
        for($i=0;$i<$file_count;$i++)
        {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
    }

}
