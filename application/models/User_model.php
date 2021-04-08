<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
    $this->load->library('email');
  }
  public function login_user($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('users', array('email' => $data['email']));
    $row = $query->row();
    if(isset($row)){
      if(password_verify($data['password'], $row->password)){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
  public function get_user_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('users',array('id'=>$data));
    $row = $query->row();
    return $row;
  }
  public function add_user($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('users',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }
    $this->db->trans_commit();
    return true;
  }
  //send confirm mail
  public function sendEmail($receiver,$hash){
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Verify email address';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $receiver);
      $message = "Dear User,<br><br> Please click on the below activation link to verify your email address<br><br>
      <a href='".$burl."users/verify/".$keywords[0]."%40".$keywords[1]."/".$hash."'>".$burl."ecoopris/users/verify/".$keywords[0]."%40".$keywords[1]."/".$hash."</a><br><br>Thanks";

      $this->email->from($from);
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);

      if($this->email->send()){
          return true;
      }else{
          return false;
      }
  }
  //activate account
  public function sendEmailCreateNewEmail($receiver,$hash,$full_name,$newnamearray,$AdminEmail){

      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Account Creation Request';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $receiver);
      $message = "Good Day!<br><br> Client ".$full_name." with the email of ".$receiver.", submitted an Account Creation request. Kindly login to your account to check the said request";

      $this->email->from($from, 'ecoopris CDA (No Reply)');
      $this->email->to($AdminEmail);
      $this->email->subject($subject);
      $this->email->message($message);
      foreach($newnamearray as $newnamearrays){
        // $files = $newnamearrays;  
        $this->email->attach('uploads/'.$newnamearrays.'', $newnamearrays);
      }
      // $attachment = str_replace("./uploads/","",$emp_data2->img_name);
      // $this->email->addAttachment('uploads/'.$attachment.'', $attachment);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
  }

  function verifyEmail($data){
    // return $data;
      $query = $this->db->get_where('users', $data);
      $row = $query->row();
      if(isset($row)){
        if($row->is_verified == 0){
          $isVerified = array('is_verified' => 1);
          $this->db->trans_begin();
          $this->db->where($data);
          $this->db->update('users',$isVerified);
          if($this->db->trans_status() === TRUE){
            $this->db->trans_commit();
            return array("success"=> true, "message"=> "Your account has been verified. You can now login.");
          }else{
            $this->db->trans_rollback();
            return array("success"=> false, "message"=> "There was an error verifying your acount. Please try again later.");
          }
        }else{
          return array("success"=> false, "message"=> "You already verify your acount.");
        }
      }else{
        return array("success"=> false, "message"=> "Unable to verify your account. Please check again the link provided in your email.");
      }
  }

  public function check_email_exists($data){
    $query = $this->db->get_where('users', array('email' => $this->security->xss_clean($data['fieldValue'])));
    if(empty($query->row_array())){
      return array($data['fieldId'],true);
    }else{
      return array($data['fieldId'],false);
    }
  }
  public function check_email_verified($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('users', array('email' => $data['email']));
    $row = $query->row();
    if(isset($row)){
      if($row->is_verified == 1){
        $user_data = array(
          'user_id' => $row->id,
          'email' => $row->email,
          'client' => true,
          'logged_in' => true
        );
        return $user_data;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

}
