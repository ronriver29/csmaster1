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
    if($this->db->insert('users',$data))
    {
      $query_last_user_id = $this->db->query("select id from users order by id desc limit 1");
      foreach($query_last_user_id->result_array() as $user_row)
      {
        $user_last_id = $user_row['id'];
      }
    }
   

    $new_user_regNo = $data['regno'];
    $query_application_id = $this->db->query('select application_id as coop_id from registeredcoop where regNo="'.$new_user_regNo.'"');
    $row = $query_application_id->row();

    
    
    $new_user_data =array('users_id'=>$this->get_user_id_by_reg($new_user_regNo));
    $this->db->where(array('id'=>$row->coop_id));
    $this->db->update('cooperatives',$new_user_data);

    $this->db->where(array('regNo'=>$new_user_regNo));
    $this->db->update('amend_coop',$new_user_data);

    $this->db->trans_commit();

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }
    $this->db->trans_commit();
    return true;
  }
  public function get_user_id_by_reg($regNo)
  {
    $data =0;
    $query = $this->db->query("select id from users where regNo='$regNo' order by id desc limit 1");
    if($query->num_rows()==1)
    {
      foreach($query->result_array() as $row)
      {
        $data = $row['id'];
      }
    }
    unset($query);
    return $data;
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
  public function get_search_reg($regno){
    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where(array('regNo'=>$regno));
    $query = $this->db->get();
    return $query->row();
  }
  //activate account
  public function sendEmailCreateNewEmail($receiver,$hash,$full_name,$newnamearray,$AdminEmail,$regNo,$region,$email){

      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Account Creation Request';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $receiver);

    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where('regNo', $regNo);
    $this->db->limit('1');
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
    $reg = $query->row();
      
    $this->db->select('refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('refbrgy');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('refbrgy.brgyCode', $region);
    $query2 = $this->db->get();
    $region = $query2->row();
        
    
    $message = "Good day! An account had been created with the following information for your validation: <br><br>

a. ".$reg->coopName."<br>
b. ".$region->region."<br>
c. ".$reg->regNo."<br>
d. ".$region->brgy.", ".$region->city.", ".$region->province.", ".$region->region."<br>
e. ".$email."<br>
";

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

  public function sendEmailToClientCreateNewEmail($receiver,$hash,$full_name,$newnamearray,$AdminEmail,$regNo,$region,$email){

      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Account Creation Request';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $receiver);

    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where('regNo', $regNo);
    $this->db->limit('1');
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
    $reg = $query->row();
    
    $this->db->select('refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('refbrgy');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where('refbrgy.brgyCode', $region);
    $query2 = $this->db->get();
    $region = $query2->row();
    
// echo $this->db->last_query();
      $message = "Good day! Your application for account creation with the following information had been successfully submitted for validation: <br><br>

a. ".$reg->coopName."<br>
b. ".$region->region."<br>
c. ".$reg->regNo."<br>
d. ".$region->brgy.", ".$region->city.", ".$region->province.", ".$region->region."<br>
e. ".$email."<br>
";

      $this->email->from($from, 'ecoopris CDA (No Reply)');
      $this->email->to($email);
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
