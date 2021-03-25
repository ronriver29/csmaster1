<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->session->userdata('logged_in')){
      if(!$this->session->userdata('client')){
        redirect('admins/all_admin');
      }else{
        redirect('cooperatives');
      }
    }else{
      redirect('admins/login');
    }
  }
  public function login()
  {
    if($this->session->userdata('logged_in')){
      if(!$this->session->userdata('client')){
        redirect('admins/all_admin');
      }else{
        redirect('cooperatives');
      }
    }else{
      $data['title'] = 'Admin Login';
      if ($this->form_validation->run() == FALSE){
        $this->load->view('./templates/admin_header', $data);
        $this->load->view('admin/login', $data);
        $this->load->view('./templates/admin_footer');
      }else{
        $data = array(
          'username' => $this->input->post('usernameAdminLogin'),
          'password'=> $this->input->post('passwordAdminLogin'),
        );
          $user_data = $this->admin_model->login_admin($data);
          if($user_data){
            // if($user_data['access_level'] == 4 && $this->admin_model->get_admin_info($user_data['user_id'])->is_director_active==0){
            //   $this->session->set_flashdata('login_admin_failed', 'You dont have a permission to login.');
            //   redirect('admins/login');
            // }else{
              $this->session->set_userdata($user_data);
              // $this->session->set_flashdata('login_admin_success', 'You are now logged in.');
              $admin_user_id = $this->session->userdata('user_id');
              if($this->admin_model->check_super_admin($admin_user_id)){
                redirect('admins/all_admin');
              }else{
                redirect('cooperatives');
              }
            // }
          }else{
            $this->session->set_flashdata('login_admin_failed', 'Invalid username/password.');
            redirect('admins/login');
          }
      }
    }
  }
  public function all_admin(){ 
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'List of Administrators';
          $data['header'] = 'List of Administrators';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['admins_list'] = $this->admin_model->get_all_admin();
          $this->load->view('./templates/admin_header', $data);
          $this->load->view('admin/list_of_admin', $data);
          $this->load->view('admin/delete_modal_admin', $data);
          $this->load->view('./templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function all_user(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'List of Users';
          $data['header'] = 'List of Users';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['users_list'] = $this->admin_model->get_all_user();
          $this->load->view('./templates/admin_header', $data);
          $this->load->view('admin/list_of_user', $data);
          $this->load->view('admin/resetpassword_modal_user', $data);
          $this->load->view('admin/delete_modal_user', $data);
          $this->load->view('./templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function add(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          if($this->form_validation->run() == FALSE){
            $data['title'] = 'Add Administrator';
            $data['header'] = 'Add Administrator';
            $data['regions_list'] = $this->region_model->get_regions();
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $this->load->view('./templates/admin_header', $data);
            $this->load->view('admin/add_form_admin', $data);
            $this->load->view('./templates/admin_footer');
          }else{
            $data = array(
              'full_name' => $this->input->post('fName'),
              'access_level' => $this->input->post('access_level'),
              'access_name' => $this->input->post('access_name'),
              'is_director_active' =>  (($this->input->post('access_level') ==4) ? 0 : 1),
              'email' => $this->input->post('eAddress'),
              'region_code' => $this->input->post('region'),
              'username' => $this->input->post('uname'),
              'password' => password_hash($this->input->post('pword'), PASSWORD_BCRYPT)
              );
                if($this->input->post('access_name') == 'Acting Regional Director'){
                  // $this->debug($this->admin_model->add_admin_director($data,$this->input->post('pword',true)));              
                    $insert = $this->admin_model->add_admin_director($data,$this->input->post('pword',true));
                    if($insert['status']==1)
                    {
                        $this->session->set_flashdata('add_admin_success', $insert['msg']);
                        redirect('admins/all_admin');
                    }
                    else if($insert['status']==0)
                    {
                      $this->session->set_flashdata('add_admin_error', $insert['msg']);
                        redirect('admins/all_admin');
                    }
                    else
                    {
                        $this->session->set_flashdata('add_admin_error', 'Unable to add administrator.');
                        redirect('admins/all_admin');
                    }
                } else {
                    $success = $this->admin_model->check_position_not_exists_in_region($data['access_level'],$data['region_code']);
                    if($success['success']){
                      if($this->admin_model->add_admin($data,$this->input->post('pword',true))){
                        $this->session->set_flashdata('add_admin_success', 'Successfully added an administrator.');
                      redirect('admins/all_admin');
                      }else{
                        $this->session->set_flashdata('add_admin_error', 'Unable to add administrator.');
                        redirect('admins/all_admin');
                      }
                    }else{
                      $this->session->set_flashdata('add_admin_error', $success['message']);
                      redirect('admins/all_admin');
                    }
                }
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function edit($aid=null){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      $decoded_aid = $this->encryption->decrypt(decrypt_custom($aid));
      if(is_numeric($decoded_aid) && $decoded_aid!=0){
        if(!$this->session->userdata('client')){
          $admin_user_id = $this->session->userdata('user_id');
          if($this->admin_model->check_super_admin($admin_user_id)){
            if($this->form_validation->run() == FALSE){
              $data['title'] = 'Edit Administrator';
              $data['header'] = 'Edit Administrator';
              $data['regions_list'] = $this->region_model->get_regions();
              $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
              $data['encrypted_aid'] = $aid;
              $data['edit_admin_info'] = $this->admin_model->get_admin_info($decoded_aid);
              $this->load->view('./templates/admin_header', $data);
              $this->load->view('admin/edit_form_admin', $data);
              $this->load->view('./templates/admin_footer');
            }else{
              $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('adID')));
              $data = array(
                'full_name' => $this->input->post('fName'),
                'username'=> $this->input->post('uname'),
                'access_level' => $this->input->post('access_level'),
                'access_name' => $this->input->post('access_name'),
                'is_director_active' =>  (($this->input->post('access_level') ==4) ? 0 : 1),
                'email' => $this->input->post('eAddress'),
                'region_code' => $this->input->post('region')
                );
              // $this->debug($data);
              $success = $this->admin_model->check_position_not_exists_in_region_update($data,$decoded_aid);
              // $this->debug($success);
              if($success['success']){
                if($this->admin_model->update_admin($decoded_aid,$data)){
                  $this->session->set_flashdata('update_admin_success', 'Successfully updated an administrator.');
                  redirect('admins/all_admin');
                }else{
                  $this->session->set_flashdata('update_admin_error', 'Unable to update administrator.');
                  redirect('admins/all_admin');
                }
              }else{
                $this->session->set_flashdata('update_admin_error', $success['message']);
                redirect('admins/all_admin');
              }
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives');
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }
      }else{
        show_404();
      }
    }
  }
  public function delete_admin(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('deleteAdministratorBtn')){
            $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('adminID')));
              if($this->admin_model->delete_admin($decoded_aid)){
                $this->session->set_flashdata('delete_admin_success', 'Successfully deleted an administrator.');
                redirect('admins/all_admin');
              }else{
                $this->session->set_flashdata('delete_admin_error', 'Unable to delete administrator.');
                redirect('admins/all_admin');
              }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('admins/all_admin');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function delete_user(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('deleteAdministratorBtn')){
            $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('adminID')));
              if($this->admin_model->delete_user($decoded_aid)){
                $this->session->set_flashdata('delete_admin_success', 'Successfully deleted an user.');
                redirect('admins/all_user');
              }else{
                $this->session->set_flashdata('delete_admin_error', 'Unable to delete administrator.');
                redirect('admins/all_user');
              }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('admins/all_user');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function reset_password_user(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('resetPasswordBtn')){
            $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('adminID')));
            $data = array(
                    'password' => password_hash($this->input->post('pword'), PASSWORD_BCRYPT)
            );
              if($this->admin_model->reset_password($decoded_aid,$data)){
                $this->session->set_flashdata('delete_admin_success', 'Password successfully reset.');
                redirect('admins/all_user');
              }else{
                $this->session->set_flashdata('delete_admin_error', 'Unable to delete user.');
                redirect('admins/all_user');
              }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('admins/all_user');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }
  public function grant_supervisor(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('grantSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            if($this->admin_model->grant_privilege_supervisor($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully granted all authorities to Supervising CDS.');
              redirect('cooperatives');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to grant all privileges to Supervising CDS.');
              redirect('cooperatives');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }

  public function grant_supervisor_amendment(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('grantSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            // $this->debug($this->admin_model->grant_privilege_supervisor($admin_user_id));
            if($this->admin_model->grant_privilege_supervisor_amendment($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully granted all authorities to Supervising CDS.');
              redirect('amendment');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to grant all privileges to Supervising CDS.');
              redirect('grant_privilege_supervisor_amendment');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('amendment');
      }
    }
  }

  public function grant_supervisor_branch(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('branches');
        }else{
          if($this->input->post('grantSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            if($this->admin_model->grant_privilege_supervisor($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully granted all authorities to Supervising CDS.');
              redirect('branches');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to grant all privileges to Supervising CDS.');
              redirect('branches');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('branches');
      }
    }
  }
  public function revoke_supervisor(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('revokeSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            if($this->admin_model->revoke_privilege_supervisor($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully revoked all authories to Supervising CDS.');
              redirect('cooperatives');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to revoke all privileges to Supervising CDS.');
              redirect('cooperatives');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }

  public function revoke_supervisor_amendment(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->post('revokeSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            // $this->debug($this->admin_model->revoke_privilege_supervisor_amendment($admin_user_id));
            if($this->admin_model->revoke_privilege_supervisor_amendment($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully revoked all authories to Supervising CDS.');
              redirect('amendment');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to revoke all privileges to Supervising CDS.');
              redirect('amendment');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('amendment');
      }
    }
  }
  
  public function revoke_supervisor_branch(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if($this->session->userdata('access_level')==5){
          redirect('all_admin');
        }else if($this->session->userdata('access_level')!=3){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('branches');
        }else{
          if($this->input->post('revokeSupervisorBtn')){
            $admin_user_id = $this->session->userdata('user_id');
            if($this->admin_model->revoke_privilege_supervisor($admin_user_id)){
              $this->session->set_flashdata('list_success_message', 'Successfully revoked all authories to Supervising CDS.');
              redirect('branches');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to revoke all privileges to Supervising CDS.');
              redirect('branches');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('branches');
      }
    }
  }

   public function forgot_password()
  {
    $data['alert_class']=''; //alert class value
    if(isset($_POST['submit-email-client']))
    {
     $u_email = $this->input->post('eAddressLogin');
      //check email in users
      $check_user_query = $this->db->get_where('admin',array('username'=> $u_email));
      if($check_user_query->num_rows()>0)
      {
        foreach($check_user_query->result_array() as $row)
        {
          $id = $row['id'];
          $user_email = $row["email"];
          $username = $row["username"];
        }
         //echo'email already exist.';
        // $this->load->helper('string');
        $temp_passwd = random_string('alnum',8); //create temp password
        $u_data = array('password'=>password_hash($temp_passwd, PASSWORD_BCRYPT),'updated_at'=> date('Y-m-d h:i:s',now('Asia/Manila')));
        $update_passwd = $this->db->update('admin',$u_data,array('id'=>$id));
        {
          if($update_passwd)
          {
              $send_mail = $this->sendEmailpassword($user_email,$temp_passwd,$username);
              if($send_mail)
              {
                 $data['alert_class'] ='success';
                $this->session->set_flashdata(array('resetpsswd_msg'=>"success check your email to recover your account"));
              } 
              else 
              {
                 $data['alert_class'] ='danger';
              $this->session->set_flashdata(array('resetpsswd_msg'=>"error while trying to send the data to your email. Plaese Contact System Administrator."));
              }
          }
          else
          {
            $this->session->set_flashdata(array('resetpsswd_msg' => "failed to recover your password."));
          }
        } 
        

      }
      else
      {
          $data['alert_class'] ='danger';
          $this->session->set_flashdata(array('resetpsswd_msg' => "Email not recognized."));
//        echo'email not recognized';
      } //end of num rows
    }
      $head = 'Account recovery';
      $msg= '';
      $this->load->view('./templates/admin_header', $head);
        $this->load->view('admin/v_forgotpassword',$data);
        $this->load->view('./templates/admin_footer'); 
  }
  
  public function sendEmailpassword($email,$temppassword,$username){
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Password recovery';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been reset. Please see your updated login details below. <br>".
      "<ul><li>Username: ".$username."</li><li>Password: ".$temppassword."</li></ul><br/>
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
  
  public function logout(){
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('client');
    $this->session->unset_userdata('access_level');
    $this->session->unset_userdata('pagecount');
    redirect('admins/login');
  }

  public function check_username_not_exists(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->get('fieldId') && $this->input->get('fieldValue')){
            $data = array(
              'fieldId'=>$this->input->get('fieldId'),
              'fieldValue'=>$this->input->get('fieldValue')
            );
            $result = $this->admin_model->is_username_unique($data);
            echo json_encode($result);
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('admins/all_admin');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
    }
  }

  public function check_username_not_exists_edit(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
        if(!$this->session->userdata('access_level')==5){
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives');
        }else{
          if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('adID')){

            $data = array(
              'fieldId'=>$this->input->get('fieldId'),
              'fieldValue'=>$this->input->get('fieldValue'),
              'id' => $this->encryption->decrypt(decrypt_custom($this->input->get('adID')))
            );
            $qry =$this->db->get_where('admin',array('id'=>$data['id']));
            if($qry->num_rows()>0)
            {
              foreach($qry->result() as $urow)
              {
                if($data['fieldValue']==$urow->username)
                {
                  echo json_encode(array($data['fieldId'],true));
                }
                else
                {
                  $result = $this->admin_model->is_username_unique($data);
                  echo json_encode($result);
                }
              }
            }
            else
            {
              $result = $this->admin_model->is_username_unique($data);
              echo json_encode($result);
            }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('admins/all_admin');
          }
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');
      }
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
        $check_query = $this->db->get_where('admin',array('id'=>$u_id));
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
                 $update_passwd = $this->db->update('admin',$u_data,array('id'=>$u_id));
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


      $data['admin_info'] = $this->admin_model->get_admin_info($u_id);
      $data['header'] = 'Change Password';
      $data['title'] = 'Change password'; 
       $this->load->view('./templates/admin_header',$data);
        $this->load->view('admin/change_passwords',$data);
        $this->load->view('./templates/admin_footer',$data); 

  }
   public function debug($array)
   {
      echo"<pre>";
      print_r($array);
      echo"</pre>";
   }

   public function cooperatives_list(){
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        $data['is_client'] = $this->session->userdata('client');
        if(!$this->session->userdata('client')){
          $admin_user_id = $this->session->userdata('user_id');
          if($this->admin_model->check_super_admin($admin_user_id)){
            $data['title'] = 'List of Cooperatives';
            $data['header'] = 'List of Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['users_list'] = $this->admin_model->get_all_user();

            $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_ho();
            $data['is_acting_director'] = $this->admin_model->is_active_director($admin_user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($admin_user_id);
            
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_all_cooperatives', $data);
            $this->load->view('applications/change_cooperative_status');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('cooperatives_list');
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('cooperatives_list');
        }
      }
    }

  public function branches_list(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      $data['is_client'] = $this->session->userdata('client');
      if(!$this->session->userdata('client')){
        $admin_user_id = $this->session->userdata('user_id');
        if($this->admin_model->check_super_admin($admin_user_id)){
          $data['title'] = 'List of Branches';
          $data['header'] = 'List of Branches';
          $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
          $data['users_list'] = $this->admin_model->get_all_user();

          $data['list_branches'] = $this->branches_model->get_all_branches_ho();
          $this->load->view('templates/admin_header', $data);
          $this->load->view('applications/list_of_all_branches', $data);
          $this->load->view('applications/change_branches_status');
          $this->load->view('admin/grant_privilege_supervisor');
          $this->load->view('admin/revoke_privilege_supervisor');
          $this->load->view('templates/admin_footer');
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('branches_list');
        }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('branches_list');
      }
    }
  }

  public function amendment_list()
  {
    if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        $data['is_client'] = $this->session->userdata('client');
        if(!$this->session->userdata('client')){
          $admin_user_id = $this->session->userdata('user_id');
          if($this->admin_model->check_super_admin($admin_user_id)){
            $data['title'] = 'List of Amendments';
            $data['header'] = 'List of Amendments';
            $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
            $data['users_list'] = $this->admin_model->get_all_user();

            $data['list_amendments'] = $this->amendment_model->get_all_amendments();
            $data['is_acting_director'] = $this->admin_model->is_active_director($admin_user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($admin_user_id);
            
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_all_amendments', $data);
            $this->load->view('applications/change_amendment_modal');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment_list');
          }
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          redirect('amendment_list');
        }
      }
  }

  public function change_status(){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID',TRUE)));
      $decoded_specialist_id = $this->input->post('statuschange');
      $status_id = $this->input->post('statusid');
      $module_type = $this->input->post('module_type');
      $admin_user_id = $this->session->userdata('user_id');
      $now = date('Y-m-d h:i:s');
      // echo $admin_user_id.'-';
      // echo $status_id;
      // echo $now;
      if($module_type == "Cooperative"){
        if($decoded_specialist_id == 1 || $decoded_specialist_id == 2){
          $data_field = array(
              'from' => $status_id,
              'to' => $decoded_specialist_id,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
              'evaluated_by' => 0,
              'second_evaluated_by' => 0,
              'third_evaluated_by' => 0
          );
        } else if ($decoded_specialist_id == 3){
          $data_field = array(
              'from' => $status_id,
              'to' => $decoded_specialist_id,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
              'second_evaluated_by' => 0,
              'third_evaluated_by' => 0
          );
        } else if ($decoded_specialist_id == 9){
          $data_field = array(
              'from' => $status_id,
              'to' => $decoded_specialist_id,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
              'third_evaluated_by' => 0
          );
        }
        $data_field = array(
              'from' => $status_id,
              'to' => $decoded_specialist_id,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
          );
      } else if ($module_type == "Branches"){
        $data_field = array(
            'from' => $status_id,
            'to' => $decoded_specialist_id,
            'edited_by' => $admin_user_id,
            'cooperative_id' => $decoded_id,
            'date_modified' => $now,
            'module_type' => $module_type
        );
      }

      if($module_type == "Cooperative"){
        $model = 'cooperatives_model';
        $change_status = "change_status_cooperatives";
      } else if ($module_type == "Branches"){
        $model = 'branches_model';
        $change_status = "change_status_branches";
      }
      $success =  $this->cooperatives_model->insert_audit_log_cooperatives_change_status($data_field);
        if($success){
        $success =  $this->$model->$change_status($decoded_id,$decoded_specialist_id);
          if($success){
            $this->session->set_flashdata('list_success_message', 'Cooperative Status has been Changed.');
            redirect('admins/cooperatives_list');
          }else{
            $this->session->set_flashdata('list_error_message', 'Unable to Change Status Cooperative.');
            redirect('admins/cooperatives_list');
          }
        }else{
            $this->session->set_flashdata('list_error_message', 'Unable to Change Status Cooperative.');
            redirect('admins/cooperatives_list');
          }
    }

    public function change_status_amendment(){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID',TRUE)));
      $status = $this->input->post('statuschange');
      $status_id = $this->input->post('statusid');
      $module_type = $this->input->post('module_type');
      $admin_user_id = $this->session->userdata('user_id');
      $now = date('Y-m-d h:i:s');

      if($status == 1 || $decoded_specialist_id == 2){
          $data_amd = array(
              'status'=> $status,
              'evaluated_by' => 0,
              'second_evaluated_by' => 0,
              'third_evaluated_by' => 0
          );

          $data_field = array(
              'from' => $status_id,
              'to' => $status,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
             
          );

        } else if ($status == 3){
          $data_amd = array(
              'status'=> $status,
              'second_evaluated_by' => 0,
              'third_evaluated_by' => 0
          );

          $data_field = array(
              'from' => $status_id,
              'to' => $status,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
             
          );
        } else if ($status == 9){
          $data_amd = array(
            
              'status' => $status,
              'edited_by' => $admin_user_id,
              'third_evaluated_by' => 0
          );

          $data_field = array(
              'from' => $status_id,
              'to' => $status,
              'edited_by' => $admin_user_id,
              'cooperative_id' => $decoded_id,
              'date_modified' => $now,
              'module_type' => $module_type,
              'third_evaluated_by' => 0
          );
        }
          
           $success =  $this->cooperatives_model->insert_audit_log_cooperatives_change_status($data_field);
          if($success){
          $success =  $this->amendment_model->change_status_amendment($decoded_id,$data_amd);
            if($success){
              $this->session->set_flashdata('list_success_message', 'Cooperative Status has been Changed.');
              redirect('admins/cooperatives_list');
            }else{
              $this->session->set_flashdata('list_error_message', 'Unable to Change Status Cooperative.');
              redirect('admins/cooperatives_list');
            }
          }else{
              $this->session->set_flashdata('list_error_message', 'Unable to Change Status Cooperative.');
              redirect('admins/cooperatives_list');
          }
            
   }  
    
    
}
