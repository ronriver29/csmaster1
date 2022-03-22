<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
    $this->load->library('email');
  }
  public function login_admin($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin', array('username' => $data['username'],'active' => 1));
    $row = $query->row();
    if(isset($row)){
      if(password_verify($data['password'], $row->password)){
        $user_data = array(
          'user_id' => $row->id,
          'username' => $row->username,
          'client' => false,
          'access_level' => $row->access_level,
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
  public function get_all_admin(){
    $this->db->select('admin.*');
    $this->db->from('admin');
    $this->db->where(array('admin.access_level!=' => 5,'admin.active' => 1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_all_signatory(){
    $this->db->select('*');
    $this->db->from('signatory');
    // $this->db->where(array('active' => 1,'regno' => NULL));
    $this->db->where(array('active' => 1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_all_user(){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where(array('is_verified =' => 1));
    $query = $this->db->get();
    return $query->result_array();
  }
  public function get_all_new_user(){
    $this->db->select('u.*,c.id as application_id');
    $this->db->from('users u');
    $this->db->join('cooperatives c','u.id = c.users_id');
    $this->db->where(array('u.is_verified =' => 1,'u.regno !=' => NULL));
    $query = $this->db->get();
    return $query->result_array();

    // $this->db->select('u.*,c.id as application_id');
    // $this->db->from('users u');
    // $this->db->join('cooperatives c','u.id = c.users_id');
    // $this->db->where(array('u.is_verified =' => 1));
  }
  public function get_migrated_data($coopName,$regNo,$limit){
    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $this->db->select('*');
    $this->db->from('registeredcoop');
    $this->db->where('coopName LIKE "%'.$coopName.'%" AND regNo LIKE "%'.$regNo.'%"');
    $this->db->group_by('regNo');
    $this->db->order_by('coopName','ASC');
    $this->db->limit($limit);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function add_admin($data,$raw_pass){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('admin',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      if($this->sendEmailAccountDetails($data['email'],$data['username'],$raw_pass)){
        $this->db->trans_commit();
        return true;
      }else{
        $this->db->trans_rollback();
        return false;
      }
    }
  }
  public function add_admin_signatory($data){
    $data = $this->security->xss_clean($data);
      $this->db->trans_begin();
      $this->db->insert('signatory',$data);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        // if($this->sendEmailAccountDetails($data['email'],$data['username'],$raw_pass)){
          $this->db->trans_commit();
          return array('status'=>1,'msg'=>"Successfully added an Administrator.");
        // }else{
        //   $this->db->trans_rollback();
        //   return false;
        // }
      }
  }
public function add_admin_director($data,$raw_pass){
    $data = $this->security->xss_clean($data);
   
    // if($data['access_name']=="Director")
    // {
    //     $chk_qry = $this->db->get_where('admin',array('region_code'=>$data['region_code'],'access_level'=>3));
    //     if($chk_qry->num_rows()>0)
    //     {
    //       return array('status'=>1,'msg'=>"Regional Director already exist");//already have an director
    //     } 
    // }
    if($data['access_name']=="Acting Regional Director")
    {
      $chk_qry = $this->db->get_where('admin',array('region_code'=>$data['region_code'],'access_level'=>3,'access_name'=>'Director'));
      if($chk_qry->num_rows()>0)
      {
          return array('status'=>0,'msg'=>"Regional Director already exist");//already have an director
      }
      else
      {  
          $chk_qry2 = $this->db->get_where('admin',array('region_code'=>$data['region_code'],'access_name'=>"Acting Regional Director"));
          if($chk_qry2->num_rows()>0)
          {
             return array('status'=>0,'msg'=>"Acting Regional Director already exist");
          }
          else
          {
            $this->db->trans_begin();
            $this->db->insert('admin',$data);
            if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return false;
            }else{
              if($this->sendEmailAccountDetails($data['email'],$data['username'],$raw_pass)){
                $this->db->trans_commit();
                return array('status'=>1,'msg'=>"Successfully added an Administrator.");
              }else{
                $this->db->trans_rollback();
                return false;
              }
            }
          }
      }//end if director exist

      
    } //end access anme
    
  
    
  }

  public function get_inspector($regcode){
    $this->db->like('region_code',$regcode);
    $query = $this->db->get_where('ca_admin',array('active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }

  public function update_admin($aid,$data){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id',$aid);
    $this->db->update('admin',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function update_signatory($aid,$data){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id',$aid);
    $this->db->update('signatory',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function edit_datereg_status($aid,$data,$regno){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where(array('id'=>$aid,'regNo'=>$regno));
    $this->db->update('registeredcoop',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function reset_password($aid,$data){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id',$aid);
    $this->db->update('users',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_admin($aid){
    $aid = $this->security->xss_clean($aid);
    $this->db->trans_begin();
    $data = array('active' => 0);
    $this->db->where('id',$aid);
    $this->db->update('admin',$data);
    // $this->db->delete('admin',array('id' => $aid));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_signatory($aid,$data){
    $aid = $this->security->xss_clean($aid);
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->where('id',$aid);
    $this->db->update('signatory',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function delete_user($aid){
    $aid = $this->security->xss_clean($aid);
    $this->db->trans_begin();
    $this->db->delete('users',array('id' => $aid));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function grant_privilege_supervisor($director_id){
    $query = $this->db->get_where('admin',array('id'=>$director_id,'access_level'=>3));
    $data = $query->row();
    $query2 = $this->db->get_where('admin',array('access_level'=>4,'region_code'=>$data->region_code));
    $supervisor = $query2->row();
    $this->db->trans_begin();
    
    // $this->db->where('id',$director_id);
    $this->db->where('access_level',3);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>0));

    $this->db->where('access_level',4);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>1));
    if($data->region_code == '00'){
      $code_name = 'Chief CDS Registration Divisiion';
    } else {
      $code_name = 'Regional Director';
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      // Send email for granting proviliges
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Cooperative Application for Registration';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! The ".$code_name." granted you all the authority to process the application for registration.<p>

<label>Date stamp:".date("d/m/Y")."
<label>Time stamp:".date("h:i:s a")."";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($supervisor->email);
      $this->email->subject($subject);
      $this->email->message($message);
    // End Seding email for granding priviliges
      if($this->email->send()){
          $this->db->trans_commit();
        return true;
      }else{
        return false;

      }
      
    }
  }

  public function grant_privilege_supervisor_amendment($director_id){
    $query = $this->db->get_where('admin',array('id'=>$director_id,'access_level'=>3));
    $data = $query->row();
    $query2 = $this->db->get_where('admin',array('access_level'=>4,'region_code'=>$data->region_code));
    $supervisor = $query2->row();
    $this->db->trans_begin();
    // return $data; //director data
    // return $supervisor;
    // $this->db->where('id',$director_id);
    $this->db->where('access_level',3);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>0));

    $this->db->where('access_level',4);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>1));
    if($data->region_code == '00'){
      $code_name = 'Head Office Director';
    } else {
      $code_name = 'Regional Director';
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Cooperative Amendment Application for Registration';  //email subject
      $burl = base_url();
      if($data->region_code =='00')
      {
        //HO
         $message = "<pre>Good Day!<br> 
      The Chief CDS Registration Division granted you all the authority to process the application for Amendment Registration.<p>
        <br>
      <label>Date stamp:".date("m/d/Y")."
      <label>Time stamp:".date("h:i:s a")."</pre>";
      }
      else
      {
         $message = "<pre>Good Day!<br> 
        The Regional Director granted you all the authority to process the application for registration.<p>
          <br>
        <label>Date stamp:".date("m/d/Y")."
        <label>Time stamp:".date("h:i:s a")."</pre>";
      }
      // Send email for granting proviliges
     
      //sending confirmEmail($receiver) function calling link to the user, inside message body
     
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($supervisor->email);
      $this->email->subject($subject);
      $this->email->message($message);
    // End Seding email for granding priviliges
      if($this->email->send()){
          $this->db->trans_commit();
        return true;
      }else{
        return false;

      }
      
    }
  }


  public function revoke_privilege_supervisor($director_id){
    $query = $this->db->get_where('admin',array('id'=>$director_id,'access_level'=>3));
    $data = $query->row();
    $query2 = $this->db->get_where('admin',array('access_level'=>4,'region_code'=>$data->region_code,'is_director_active'=>1));
    $supervisor = $query2->row();
    $this->db->trans_begin();
    // $this->db->where('id',$director_id);
    $this->db->where('access_level',3);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>1));
     $this->db->where('access_level',4);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>0));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      if($supervisor->region_code == '00'){
        $title = 'Chief CDS Registration Division';
      } else {
        $title = 'Regional Director';
      }
      // Send email for granting proviliges
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Cooperative Application for Registration';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! The Authority to process all application for registration has been revoked by the ".$title.".<p>

<label>Date stamp:".date("d/m/Y")."
<label>Time stamp:".date("h:i:s a")."";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($supervisor->email);
      $this->email->subject($subject);
      $this->email->message($message);
    // End Seding email for granding priviliges
      if($this->email->send()){
          $this->db->trans_commit();
        return true;
      }else{
        return false;
      }
    }
  }

  public function revoke_privilege_supervisor_amendment($director_id){
    $query = $this->db->get_where('admin',array('id'=>$director_id,'access_level'=>3));
    $data = $query->row();
    $query2 = $this->db->get_where('admin',array('access_level'=>4,'region_code'=>$data->region_code,'is_director_active'=>1));
    $supervisor = $query2->row();
    $this->db->trans_begin();
    // $this->db->where('id',$director_id);
    $this->db->where('access_level',3);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>1));
     $this->db->where('access_level',4);
    $this->db->where('region_code',$data->region_code);
    $this->db->update('admin',array('is_director_active'=>0));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
          $from = "ecoopris@cda.gov.ph";    //senders email address
          $subject = 'Cooperative Amendment Application for Registration';  //email subject
          $burl = base_url();
        if($data->region_code =='00')
         {
            //for HO
          $message = "<pre>The Authority to process all application for Amendment Registration has been revoked by the Chief CDS Registration Division.<p>
      
          <label>Date stamp:".date("m/d/Y")."
          <label>Time stamp:".date("h:i:s a")."</pre>";

         }
         else 
         {
            $message = "<pre>Good day! The Authority to process all application for registration has been revoked by the Regional Director.<p>
      
            <label>Date stamp:".date("m/d/Y")."
            <label>Time stamp:".date("h:i:s a")."</pre>";
         }
      // Send email for granting proviliges
    
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($supervisor->email);
      $this->email->subject($subject);
      $this->email->message($message);
    // End Seding email for granding priviliges
      if($this->email->send()){
          $this->db->trans_commit();
        return true;
      }else{
        return false;
      }
    }
  }

  public function sendEmailAccountDetails($email,$username,$password){
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Admin Account Details';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been created. See the details below: <br>".
      "<ul><li>Username: ".$username."</li><li>Password: ".$password."</li></ul><br><br>We highly recommend to change your password once you successfully logged in";
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
  public function sendEmailToSeniorHO($proposedname,$brgy,$fullname,$contactnumber,$clientemail,$senioremail){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! A deferred application for registration with the following details has been re-submitted for re-evaluation:<p>

      <ol type='a'> 
        <b><li> Proposed Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Address of Proposed Cooperative:</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$clientemail."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
      return true;
    }
  }
  public function sendEmailToClient($proposedname,$email){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sucessfully submitted your application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";
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
  public function sendEmailToClientUpdating($proposedname,$email){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $message = "Good day! Encoded updates on your cooperative information have been successfully submitted for evaluation.<p>";
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


  public function sendEmailToSenior($proposedname,$brgy,$fullname,$contactnumber,$clientemail,$senioremail){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application for registration with the following details has been submitted:<p>

      <ol type='a'> 
        <b><li> Proposed Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Address of Proposed Cooperative:</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$clientemail."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
      return true;
    }
  }
  public function sendEmailToAP($proposedname,$brgy,$fullname,$contactnumber,$clientemail,$senioremail,$regNo,$coop_region){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }

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
      $this->db->where('refbrgy.brgyCode', $coop_region);
      $query2 = $this->db->get();
      $region = $query2->row();
        
      // $this->db->select('*');
      // $this->db->from('refregion');
      // $this->db->where('regCode', '0'.substr($coop_region, 0, 2));
      // $query2 = $this->db->get();
      // $region = $query2->row();
    // echo $receiver;
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = 'Cooperative Update Info';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application to update the cooperative information with the following details had been submitted for evaluation.<br><br>

      a. ".$reg->coopName."<br>
      b. ".$region->region."<br>
      c. ".$reg->regNo."<br>
      d. ".$region->brgy.", ".$region->city.", ".$region->province.", ".$region->region."<br>
      e. ".$clientemail."<br>
      ";

      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
      return true;
    }
  }

  public function sendEmailToClientUpdatingApprove($client_email,$regNo,$coop_region){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Updating Application';  //email subject
    $burl = base_url();

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
      $this->db->where('refbrgy.brgyCode', $coop_region);
      $query2 = $this->db->get();
      $region = $query2->row();

    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $message = "Congratulations! The cooperative information with the following details had been successfully UPDATED.<br><br>

    a. ".$reg->coopName."<br>
    b. ".$region->region."<br>
    c. ".$reg->regNo."<br>
    d. ".$region->brgy.", ".$region->city.", ".$region->province.", ".$region->region."<br>
    e. ".$client_email."<br>
    ";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($client_email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToSeniorBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application for establishment of ".$type." with the following details has been submitted::<p>

      <ol type='a'> 
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
        <b><li> Email Address: </b>".$email."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
          return true;
      }
  }
  public function sendEmailToSeniorBranchApprove($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising,$regionname){
    if(sizeof($senioremail)>0){
      $receiver = "";
      if(sizeof($senioremail)>1){
        $tempEmail = array();
        foreach($senioremail as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $senioremail[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $proposedname.' Application';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = "Good day! An application from ".$regionname." for establishment of ".$type." with the following details has been submitted::<p>

      <ol type='a'> 
        <b><li> Name of Cooperative:</b>".$proposedname."</li>
        <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
        <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
        <b><li> Contact Person:</b> ".$fullname."</li>
        <b><li> Contact Number: </b>".$contactnumber."</li>
      </ol>";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    } else {
          return true;
      }
  }
  public function approved_by_director_level1($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Good day! An application for establishment of ".$type." with the following details has been submitted::<p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToSeniorFromCDSBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamesupervising){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "A validated application for establishment of ".$type." with the following details has been submitted for your evaluation:<p>

    <ol type='a'> 
      <b><li> Name of CDS II/Validator:</b>".$fullnamesupervising."</li>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToSeniorDeferBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Good day! A deferred application for establishment of ".$type." with the following details has been submitted:<p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToClientDeferBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$comment,$region_code,$reg_officials_info){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "".date('F d, Y')." <br><br>

  Proposed Name of ".$type.": ".$proposedbranch." <br>
  Proposed Address of ".$type." : ".$brgy."<br><br>

  Good Day! <br><br>

  This refers to the application for registration of the proposed ".$proposedname.".<br><br>

    Upon review of the documents submitted online the following are our findings:<p> <br>
    
    <br>".nl2br($comment)."<br>

    <br>Please comply immediately with the above-mentioned findings within 15 days. <br>

    <br>Should you need further information or clarification, please feel free to contact Registration Division/Section at telephone numbers ".ltrim(rtrim($reg_officials_info['contact']))." or email us at ".$reg_officials_info['email'].".   <br><br>


Very truly yours,<br>

<br>Regional Director<br>
Region";


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

  public function sendEmailToSpecialistBranch($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "You are assigned to validate the  application for establishment of ".$type." with the following details: <p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToDirector($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type,$fullnamecds){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Senior CDS evaluated application for establishment of ".$type." with the following details has been submitted for your evaluation and approval/denial/deferment: <p>

    <ol type='a'> 
      <b><li> Name of CDS II/Validator:</b>".$fullnamecds."</li>
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
      // echo $this->email->print_debugger();
    }else{
        return false;
    }
  }
  public function sendEmailToDirectorHO_OR($proposedname,$proposedbranch,$brgy,$fullname,$contactnumber,$email,$senioremail,$type){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $proposedname.' Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body

    $message = "Good day! An application for establishment of ".$type." with the following details has been submitted: <p>

    <ol type='a'> 
      <b><li> Name of Cooperative:</b>".$proposedname."</li>
      <b><li> Name of Proposed ".$type.":</b>".$proposedbranch."</li>
      <b><li> Address of Proposed ".$type.":</b>".$brgy."</li>
      <b><li> Contact Person:</b> ".$fullname."</li>
      <b><li> Contact Number: </b>".$contactnumber."</li>
      <b><li> Email Address: </b>".$email."</li>
    </ol>";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($senioremail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToClientBranch($email){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Your application has been submitted and subject for validation and evaluation.<p>";
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
  public function sendEmailToSpecialist($coop_full_name,$brgyforemail,$fullnameforemail,$contact_number,$email,$adminemail){
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coop_full_name.'`s Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body

    $message = "You are assigned to validate the application for registration with the following details:<p>
    <ol type='a'>
      <li> Name of proposed Cooperative: ".$coop_full_name."</li>
      <li> Address of proposed Cooperative: ".$brgyforemail."</li>
      <li> Contact Person: ".$fullnameforemail."</li>
      <li> Contact Number: ".$contact_number."</li>
      <li> Email Address: ".$email."</li>
    </ol>
    ";
    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($adminemail);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToDirectorFromSenior($emails,$coop_full_name,$brgyforemail,$fullnameforemail,$contact_number,$clientemail,$admin_info,$specialistsubmitat,$status){
    if(sizeof($emails)>0){
      $receiver = "";
      if(sizeof($emails)>1){
        $tempEmail = array();
        foreach($emails as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $emails[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      $now = date('F d, Y');

      if($status == NULL || $status == 0){
        $evaluated = 'evaluated';
      } else {
        $evaluated = 're-evaluated';
      }
      //sending confirmEmail($receiver) function calling link to the user, inside message body

      // $message = $coop_full_name." has been submitted by "". You can now evaluate this application.";
      $message = "Senior CDS ".$evaluated." application for registration with the following details has been submitted for your evaluation and approval/denial/deferment:<p>

      <ol type='a'>
        <li>Name of CDS II/Validator: ".$admin_info->full_name."</li>
        <li>Date of validation: ".$now."</li>
        <li>Sr. CDS evaluation date: ".date('F d, Y H:i:s')."</li>
        <li>Name of proposed Cooperative: ".$coop_full_name."</li>
        <li>Address of proposed Cooperative: ".$brgyforemail."</li>
        <li>Contact Person: ".$fullnameforemail."</li>
        <li>Contact Number: ".$contact_number."</li>
        <li>Email address: ".$clientemail."</li>
      </ol>";

      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return true;
      }
    }else{
      return true;
    }
  }

  public function sendEmailToAdmins($emails,$coop_full_name,$brgyforemail,$fullnameforemail,$contact_number,$clientemail,$admin_info){
    if(sizeof($emails)>0){
      $receiver = "";
      if(sizeof($emails)>1){
        $tempEmail = array();
        foreach($emails as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $emails[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      $now = date('F d, Y');
      //sending confirmEmail($receiver) function calling link to the user, inside message body

      // $message = $coop_full_name." has been submitted by "". You can now evaluate this application.";
      $message = "A validated application for registration with the following details has been submitted for your evaluation<p>                                 
      
      <ol type='a'>
        <li>Name of CDS II/Validator: ".$admin_info->full_name."</li>
        <li>Date of validation: ".$now."</li>
        <li>Name of proposed Cooperative: ".$coop_full_name."</li>
        <li>Address of proposed Cooperative: ".$brgyforemail."</li>
        <li>Contact Person: ".$fullnameforemail."</li>
        <li>Contact Number: ".$contact_number."</li>
        <li>Email address: ".$clientemail."</li>
      </ol>";

      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return true;
      }
    }else{
      return true;
    }
  }
  
  public function sendEmailToDirectorApprovedBySupervisor($admin_info,$emails,$coop_full_name){
    if(sizeof($emails)>0){
      $receiver = "";
      if(sizeof($emails)>1){
        $tempEmail = array();
        foreach($emails as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $emails[0]['email'];
      }
      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been approved by ".$admin_info->full_name.". You can now evaluate this application.";
      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return false;
      }
    }else{
      return true;
    }
  }
  public function sendEmailToClientApprove($name,$email){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     1.  Economic Survey;
     2.  Articles of Cooperation and the approved By-laws;
           2.1.  All original;
           2.2.  The Articles of Cooperation shall be signed by all the cooperators on each and every page and duly notarized by a Notary Public; and
           2.3.  The By-Laws shall be signed by all the members on the adoption page.
     3.  Treasurer's Affidavit duly notarized by a Notary Public;

The above documents shall be printed in legal size bond paper or 8.5\" x 13\" or 8.5\" x 14\" size paper.

In addition to the above, please attach the following in 1 original and 3 photocopies:

     1.  Surety Bond of Accountable Officers;
     2.  Certification of Pre-Registration Seminar (PRS); 
     3.  Other requirements for specific type of cooperatives

You shall submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS).</pre>";


    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
        // echo $this->email->print_debugger();
    }
  }
  public function sendEmailToClientApproveFederation($name,$email,$admin_info,$coopname,$addresscoop){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre>
    Name of Proposed Federation: ".$coopname."
    Address of Proposed Federation: ".$addresscoop."

    <b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     1.  Feasibility Study;
     2. Duly notarized Articles of Cooperation with signatures of all member-cooperatives representatives/cooperators in every page;
     3. By-Laws with signatures of all member-cooperatives representatives/cooperators on the adoption page;
     4. Duly notarized Treasurer's Affidavit stating the total amount received from members' share capital contributions, membership fees, donations or subsidies;
     5. General Assembly Resolution of each member-cooperative stating that the general assembly has approved its membership and the exact amounts of paid-up share capital contributions/dues to the federation; and
     6. BOD Resolution on authorized representative/s of each of the member-cooperatives.

Submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information System (E-CoopRIS).

In addition to the above, please attached other required documents 1 original and 3 photocopies, if applicable.

Very truly yours,

".$admin_info->full_name."</pre>";


    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
        // echo $this->email->print_debugger();
    }
  }
  public function sendEmailToClientApproveUnion($name,$email,$admin_info,$coopname,$addresscoop){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre>
    Name of Proposed Federation: ".$coopname."
    Address of Proposed Federation: ".$addresscoop."

    <b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     1. Developmental Plan;
     2. Duly notarized Articles of Cooperation with signatures of all member-cooperatives representatives/cooperators in every page;
     3. By-Laws with signatures of all member-cooperatives representatives/cooperators on the adoption page;
     4. Duly notarized Treasurer's Affidavit stating the total amount received from members;
     5. General Assembly Resolution of each member-cooperative stating that the general assembly has approved its membership and the amount of dues to the cooperative union; and
     6. BOD Resolution on authorized representative/s.

Submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information System (E-CoopRIS).

In addition to the above, please attached other required documents 1 original and 3 photocopies, if applicable.

Very truly yours,

".$admin_info->full_name."</pre>";


    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
        // echo $this->email->print_debugger();
    }
  }
  public function sendEmailToClientDeferAmendment($client_info,$data_comment,$amendment_info,$reg_officials_info){
    $acbl = $this->amendment_model->acbl($amendment_info->id);
   
    $articles = '';
    $bylaws = '';
    $and ='';
    $acro = '';
    if($acbl['articles'])
    {
      $acro = " (AC)";
      $articles = ' Articles of Cooperation ';
    }
    if($acbl['bylaws'])
    {
      $acro = ' (BL)';
      $bylaws = ' By-Laws ';
    }

    if($acbl['articles'] && $acbl['bylaws'])
    {
      $acro=' (ACBL)';
      $and = ' and ';
    }
    $acronym = '';
    if(strlen($amendment_info->acronym)>0)
    {
      $acronym =' ('.$amendment_info->acronym.')';
    }
    if(count(explode(',',$amendment_info->type_of_cooperative))>1)
      {
       $coop_full_name = $amendment_info->proposed_name.' Multipurpose Cooperative'.$acronym;
      }
      else
      {
        $coop_full_name  = $amendment_info->proposed_name.' '.$amendment_info->type_of_cooperative.'  Cooperative'.$acronym;
      }
    $address_coop = $amendment_info->house_blk_no.' '.$amendment_info->brgy.' '.$amendment_info->street.' ,'.$amendment_info->city.' ,'.$amendment_info->province.' ,'.$amendment_info->region;
    $client_full_name = $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;

    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =  $coop_full_name.' Amendment Evaluation Result';  //email subject
    $burl = base_url();
    if($amendment_info->ho ==1)
    {
      $director_type = 'LRRD Director';
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    }
    else
    {
      $director_type ='Regional Office Director';
    }
    $message = "<pre>
    <b>Date:</b> ".date('Y-m-d h:i:s',now('Asia/Manila'))." 
     ".$coop_full_name."
    
    Good Day! <br><br>

    This refers to your application for the registration of proposed amendments to the".$articles.$and.$bylaws.$acro." of ".$coop_full_name.".

    
    Upon review of the documents submitted online the following are our findings:

  
        <body>
          <div><ul type='square'>
                  <li>".$data_comment['tool_findings']."</li>
                 </ul></div>
            <table width='900' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'> 
                <tr style='border:1px solid black'>  
                    <th width='30%'>Documents</th>
                    <th width='30%'>Findings</th>
                    <th width='30%'>Recommended Action</th>
                </tr>
                <tr>  
                    <td style='padding:5px;'>".ltrim(rtrim($data_comment['documents']))."</td>
                    <td style='padding:5px;'>".$data_comment['comment']."</td>
                    <td style='padding:5px;'>".ltrim(rtrim($data_comment['rec_action']))."</td>
                </tr>
            </table>
        </body>
    

    Please comply immediately with the above-mentioned findings within 15 days.  

    Should you need further information or clarification, please feel free to contact Registration Division/Section at telephone numbers ".ltrim(rtrim($reg_officials_info['contact']))." or email us at ".$reg_officials_info['email'].". 

    Very truly yours, 


 
    <b>".$director_type."</b>
    ".$amendment_info->region."

    </pre>";

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($client_info->email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  
  public function sendEmailToDirectorRevertAmendment($amendment_info,$director_info){
   $acronym = '';
    if(strlen($amendment_info->acronym)>0)
    {
      $acronym =' ('.$amendment_info->acronym.')';
    }
    if(count(explode(',',$amendment_info->type_of_cooperative))>1)
      {
       $coop_full_name = $amendment_info->proposed_name.' Multipurpose Cooperative'.$acronym;
      }
      else
      {
        $coop_full_name  = $amendment_info->proposed_name.' '.$amendment_info->type_of_cooperative.'  Cooperative'.$acronym;
      }
    $address_coop = $amendment_info->house_blk_no.' '.$amendment_info->brgy.' '.$amendment_info->street.' ,'.$amendment_info->city.' ,'.$amendment_info->province.' ,'.$amendment_info->region;
    // $client_full_name = $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;

    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = 'Amendment Revert for re-evaluation';  //email subject
    $burl = base_url();
    if($amendment_info->ho ==1)
    {
      $director_type = 'LRRD Director';
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    }
    else
    {
      $director_type ='Regional Office Director';
    }
    $message = "<pre>
    <b>Date:</b> ".date('Y-m-d h:i:s',now('Asia/Manila'))." 
    <b>Proposed Name of Cooperative:</b> ".$coop_full_name."
    <b>Proposed Address of Cooperative:</b> ".$address_coop." 

   An approved online application with discrepancy/ies per submitted hard copies to the Senior CDS has been re-evaluated and for your re-evaluation and approval/deferment/denial.</pre>";

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($director_info->email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  
  public function sendEmailToClientApproveBranch($name,$email){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre>Congratulations! Your application status is APPROVED and for SUBMISSION of documents.

You may now submit the following requirements/ documents:

     1.  Business Plan
     2.  General Assembly Resolution
     3.  Certification for the presence of Manual of Operation and Addresses of the branch office

The client shall submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Electronic-Cooperative Registration Information
System (E-CoopRIS).</pre>";


    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
    }
  }
  public function sendEmailToClientApproveSatellite($name,$email){
//    echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now submit the following requirements/documents:

    1.  Certificate of Compliance for (year)
    2.  Oath of Undertaking signed by the Chairperson
    3.  Certificate of Available Space and Manpower
    4.  Official Receipt

The above documents shall be printed in Legal size or ”8.5 x 13” or ”8.5 x 14” bond paper.

The client shall submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS).</pre>";


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
  public function sendEmailToClientDeny($coop_full_name,$brgyforemail,$reason_commment,$email,$reason_tool_comments,$reason_documents,$reason_rec_action){
    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coop_full_name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    // $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> failed the evaluation. This cooperative has been denied because of the following reason/s:<br><pre>".$comment."</pre>";

    $message = "".date('F d, Y')."<br><br>

    Proposed Name of Cooperative: ".$coop_full_name."<br>
    Proposed Address of Cooperative: ".$brgyforemail."<br><br>

    Good Day! <br><br>

    This refers to the application for registration of the proposed ".$coop_full_name.".<br><br>

    Based on the evaluation of the submitted application documents for registration, we regret to inform you that the application is denied due to:<p> <br><br>
    
    <body>
    <div><ul type='square'>
            <li>".nl2br($reason_tool_comments)."</li>
           </ul></div>
      <table width='900' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'> 
          <tr style='border:1px solid black'>  
              <th width='30%'>Documents</th>
              <th width='30%'>Findings</th>
              <th width='30%'>Recommended Action</th>
          </tr>
          <tr>  
              <td style='padding:5px;'>".nl2br($reason_commment)."</td>
              <td style='padding:5px;'>".nl2br($reason_documents)."</td>
              <td style='padding:5px;'>".nl2br($reason_rec_action)."</td>
          </tr>
      </table>
  </body>";

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

  public function sendEmailToClientDenyAmendment($client_info,$amendment_info,$data_comment,$admin_info){
      $acronym = '';
    if(strlen($amendment_info->acronym)>0)
    {
      $acronym =' ('.$amendment_info->acronym.')';
    }
    if(count(explode(',',$amendment_info->type_of_cooperative))>1)
      {
       $coop_full_name = $amendment_info->proposed_name.' Multipurpose Cooperative'.$acronym;
      }
      else
      {
        $coop_full_name  = $amendment_info->proposed_name.' '.$amendment_info->type_of_cooperative.'  Cooperative '.$acronym;
      }
    $address_coop = $amendment_info->house_blk_no.' '.$amendment_info->brgy.' '.$amendment_info->street.' ,'.$amendment_info->city.' ,'.$amendment_info->province.' ,'.$amendment_info->region;

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coop_full_name.' Amendment Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    // $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> failed the evaluation. This cooperative has been denied because of the following reason/s:<br><pre>".$comment."</pre>";

    $message = "".date('F d, Y')."<br><br>

    Proposed Name of Cooperative: ".$coop_full_name."<br>
    Proposed Address of Cooperative: ".$address_coop."<br><br>

    Good Day! <br><br>

    This refers to the application for Amendment of the proposed ".$coop_full_name.".<br><br>

    Based on the evaluation of the submitted application documents for Amendment, we regret to inform you that the application is denied due to:<p> <br><br>
    
    <body>
    <div><ul type='square'>
            <li>".nl2br($data_comment['tool_findings'])."</li>
           </ul></div>
      <table width='900' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'> 
          <tr style='border:1px solid black'>  
              <th width='30%'>Documents</th>
              <th width='30%'>Findings</th>
              <th width='30%'>Recommended Action</th>
          </tr>
          <tr>  
              <td style='padding:5px;'>".nl2br($data_comment['documents'])."</td>
              <td style='padding:5px;'>".nl2br($data_comment['comment'])."</td>
              <td style='padding:5px;'>".nl2br($data_comment['rec_action'])."</td>
          </tr>
      </table>
  </body>";

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($client_info->email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToAdminRevert($coop_full_name,$brgyforemail,$emails,$reason_commment,$directorregioncode,$reg_officials_info){
    if(sizeof($emails)>0){
      $receiver = "";
      if(sizeof($emails)>1){
        $tempEmail = array();
        foreach($emails as $email){
          array_push($tempEmail, $email['email']);
        }
        $receiver = implode(", ",$tempEmail);
      }else{
        $receiver = $emails[0]['email'];
      }
      if($directorregioncode == '00'){
        $trulyyours = 'LRRD Director';
      } else {
        $trulyyours = 'Regional Office Director';
      }

      // if(strpos($reason_commment, "\n") !== FALSE) {
      //   $wk = 'New line break found';
      // }
      // else {
      //   $wk = 'not found';
      // }
      $wk = trim(preg_replace('/\s\s+/', '<br>', $reason_commment));
      // $wk = str_replace(strpos($reason_commment, "\n"),"<br><br>",$reason_commment);

      $from = "ecoopris@cda.gov.ph";    //senders email address
      $subject =$coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
        //sending confirmEmail($receiver) function calling link to the user, inside message body
      // $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> has been deferred because of the following reason/s:<br><pre>".$comment."</pre><br> You have 15 days to complete the following.";

      $message = "Proposed Name of Cooperative: ".$coop_full_name." <br>
                  Proposed Address of Cooperative : ".$brgyforemail."<br><br>

  An approved online application with discrepancy/ies per submitted hard copies to the Senior
CDS has been re-evaluated and for your re-evaluation and approval/deferment/denial.";

      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($receiver);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          return true;
      }else{
          return true;
      }
    }
  }
  public function sendEmailToClientDefer($coop_full_name,$brgyforemail,$email,$reason_commment,$reason_documents,$reason_rec_action,$directorregioncode,$reg_officials_info,$reason_tool_comments){

    if($directorregioncode == '00'){
      $trulyyours = 'LRRD Director';
    } else {
      $trulyyours = 'Regional Office Director';
    }

    // if(strpos($reason_commment, "\n") !== FALSE) {
    //   $wk = 'New line break found';
    // }
    // else {
    //   $wk = 'not found';
    // }
    $wk = trim(preg_replace('/\s\s+/', '<br>', $reason_commment));
    // $wk = str_replace(strpos($reason_commment, "\n"),"<br><br>",$reason_commment);

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$coop_full_name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    // $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> has been deferred because of the following reason/s:<br><pre>".$comment."</pre><br> You have 15 days to complete the following.";

    $message = "".date('F d, Y')." <br><br>

Proposed Name of Cooperative: ".$coop_full_name." <br>
Proposed Address of Cooperative : ".$brgyforemail."<br><br>

Good Day! <br><br>

This refers to the application for registration of the proposed ".$coop_full_name.". <br><br>

Based on the evaluation of the submitted application documents for registration, the following are our findings and comments: <br><br>


<body>
    <div><ul type='square'>
            <li>".nl2br($reason_tool_comments)."</li>
           </ul></div>
      <table width='900' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'> 
          <tr style='border:1px solid black'>  
              <th width='30%'>Documents</th>
              <th width='30%'>Findings</th>
              <th width='30%'>Recommended Action</th>
          </tr>
          <tr>  
              <td style='padding:5px;'>".nl2br($reason_commment)."</td>
              <td style='padding:5px;'>".nl2br($reason_documents)."</td>
              <td style='padding:5px;'>".nl2br($reason_rec_action)."</td>
          </tr>
      </table>
  </body>


Please comply the findings within 15 days so that we can facilitate with the issuance of your Certificate of Registration. However, your submission shall still be subject to further evaluation. <br><br>

 For further information and clarification, please feel free to contact our Registration Division/Section at telephone numbers ".$reg_officials_info['contact']." or email us at ".$reg_officials_info['email'].".<br><br>


Very truly yours, <br>
".$trulyyours."
";

    $this->email->from($from,'ecoopris CDA (No Reply)');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return true;
    }
  }
  public function get_emails_of_senior_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>2,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_supervisor_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>4,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_director_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>3,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_specialist_by_region($id){
    $query = $this->db->get_where('admin',array('id'=>$id));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_revoke_director_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>4,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_all_specialist_by_region($regcode){
    $this->db->like('region_code',$regcode);
    $query = $this->db->get_where('admin',array('access_level'=>1,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_specialst_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('id'=>$data,'access_level'=>1,'active'=>1));
    $row = $query->row();
    return $row;
  }
  public function get_ap_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('region_code'=>$data,'access_level'=>6,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_senior_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('region_code'=>$data,'is_director_active'=>1,'access_level'=>2,'active'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_senior_info_dir_defer($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('region_code'=>$data,'access_level'=>2,'active'=>1));
    $row = $query->row();
    return $row;
  }
  public function get_director_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('region_code'=>$data,'is_director_active'=>1,'access_level'=>3,'active'=>1));
    $row = $query->row();
    return $row;
  }
  public function get_supervising_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('region_code'=>$data,'is_director_active'=>1,'access_level'=>4,'active'=>1));
    $row = $query->row();
    return $row;
  }
  public function get_admin_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('id'=>$data));
    $row = $query->row();
    return $row;
  }
  public function get_signatory_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('signatory',array('id'=>$data));
    $row = $query->row();
    return $row;
  }
  public function is_username_unique($ajax){
    $ajax = $this->security->xss_clean($ajax);
    $this->db->where('username',$ajax['fieldValue']);
    $this->db->from('admin');
    if($this->db->count_all_results()==0){
      return array($ajax['fieldId'],true);
    }else{
      return array($ajax['fieldId'],false);
    }
  }
  public function check_super_admin($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('id'=>$data));
    $row = $query->row();
    if($row->access_level ==5){
      return true;
    }else{
      return false;
    }
  }
  public function check_ap($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('id'=>$data));
    $row = $query->row();
    if($row->access_level ==6){
      return true;
    }else{
      return false;
    }
  }
  public function check_if_director_active($admin_id,$region_code){
    // $query= $this->db->get_where('admin',array('id'=>$admin_id,'access_level'=>3));
    $query = $this->db->query("select * from admin where id='$admin_id' and region_code='$region_code' and access_level IN (3,4) and active = 1");
    $row = $query->row();
    // return $this->db->last_query();
    if($row->is_director_active ==1){
      return true;
    }else{
      return false;
    }
  }
  public function check_position_not_exists_in_region($access_level,$regcode){
    return array('success'=>true,'message'=>'allow all');
    // if($access_level > 1){
    //   $this->db->where(array('access_level'=>$access_level,'region_code'=>$regcode));
    //   $this->db->from('admin');
    //   if($this->db->count_all_results()<2){
    //     return array('success'=>true,'message'=>'Not exists');
    //   }else{
    //     $recDesc = ($regcode != "0" ) ? $this->region_model->get_region_by_code($regcode)->regDesc : "Central Office";
    //     $position = (($access_level == 1) ? "Cooperative Development Specialist II" : (($access_level == 2) ? "Senior Cooperative Development Specialist" : (($access_level == 3) ? "Director": "Supervising CDS")));
    //     return array('success'=>false,'message'=> $position.' already exists in '.$recDesc);
    //   }
    // }else{
    //   return array('success'=>true,'message'=>'Not exists');
    // }
  }
  public function check_position_not_exists_in_region_update($data,$aid){
    $recDesc = ($data['region_code'] != "0" ) ? $this->region_model->get_region_by_code($data['region_code'])->regDesc : "Central Office";
    if($data['access_name'] == "Acting Regional Director")
    {
      $qry_check = $this->db->get_where('admin',array('region_code'=>$data['region_code'],'access_name'=>"Acting Regional Director"));
      if($qry_check->num_rows()>0)
      {
        foreach($qry_check->result() as $act_row)
        {
          if($act_row->id == $aid)
          {
            return array('success'=>true,'message'=>'Not exists'); 
          }
          else
          {
             return array('success'=>false,'message'=> $data['access_name'].' already exists in '.$recDesc);
          }
        }
       
      }
      else
      {
         return array('success'=>true,'message'=>'Not exists'); 
      }
    }
    else
    {
      if($data['access_level'] > 1 && $data['access_name'] != "Acting Regional Director"){
        return array('success'=>true,'message'=>'Not exists');
        // $this->db->where(array('access_level'=>$data['access_level'],'region_code'=>$data['region_code'],'id!='=>$aid));
        // $this->db->from('admin');
        // if($this->db->count_all_results()==0){
        //   return array('success'=>true,'message'=>'Not exists');
        // }else{
        //   return array('success'=>false,'message'=> $data['access_name'].' already exists in '.$recDesc);
        // }
      }else{
       return array('success'=>true,'message'=>'Not exists');
      }
    }
  }
  
   public function sendEmailToClientApproveLaboratories($name,$email){
    // echo $name;
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Laboratory Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";
$chars ='â€?'; 
    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.


You may now submit the following requirements/ documents:


  1. Articles of Cooperation and By Laws of the Guardian Cooperative stating the
      acceptance of its responsibilities as Guardian Cooperative; and
  2. Resolution of the Board of Directors of the Guardian Cooperative accepting its
    responsibility and liability as Guardian of the Laboratory Cooperative.

The above documents shall be printed in Legal size or ”8.5 x 13” or ”8.5 x 14” bond paper.
The client shall submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Cooperative Registration Information
System (CoopRIS).</pre>";

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
//    public function sendEmailToClientApproveLaboratories($name,$email){
//     echo $name;
//     $from = "ecoopris@cda.gov.ph";    //senders email address
//     $subject =$name.' Laboratory Result';  //email subject
//     $burl = base_url();
//       //sending confirmEmail($receiver) function calling link to the user, inside message body

// //    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

//     $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.


// You may now submit the following documents:

// 1. Resolution of the Board of Directors of the Guardian Cooperative accepting
// its responsibility and liability as Guardian of the Laboratory Cooperative;
// and

// 2. Manual of operation for the Laboratory Cooperative, which shall include
// but not limited to the following:
// a. The name of the Laboratory Cooperative
// b. The purpose/s and business activities for which it is organized;
// c. The qualifications, rights, duties and responsibilities of members and the
// procedure to be followed in the termination of membership;
// d. The area of operation and the postal addresses of Laboratory Cooperative;
// e. The common bond of membership;
// f. The organizational structure of the Laboratory Cooperative which shall
// likewise indicate the officer/s of Guardian cooperative tasked to
// supervise/oversee/monitor the laboratory cooperative;
// g. Duties and responsibilities of officers of the Laboratory Cooperative;
// h. The rules and procedures on the agenda, time, place and manner of calling,
// convening, conducting meetings, quorum requirements, voting systems, and
// other matters relative to the business affairs of the officers and general
// assembly;
// i. The rate of interest on savings and deposit, if applicable;
// j. Duties and Responsibilities of the Guardian Cooperative
// k. Other matters incident to the purposes and activities of the cooperative.


// The client shall submit the above required documents within 30 working days from the date of e-mail notification.
// Failure to submit the same shall be considered as an abandonment of your
// interest to pursue your application and thus, will be removed from the
// Cooperative Registration Information
// System (CoopRIS).
// Once the said documents had been found complete and in order, the client may
// now claim the Certificate of Recognition within the day.</pre>";


//     $this->email->from($from,'ecoopris CDA (No Reply)');
//     $this->email->to($email);
//     $this->email->subject($subject);
//     $this->email->message($message);
//     if($this->email->send()){
//         return true;
//     }else{
//         return false;
//     }
//   }
    public function is_acting_director($supervising_id)
    {
      $query = $this->db->get_where('admin',array('id'=>$supervising_id,'is_director_active'=>1,'access_level'=>4,'active'=>1));
      if($query->num_rows()>0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    public function is_active_director($director_id)
    {
      $query = $this->db->get_where('admin',array('id'=>$director_id,'is_director_active'=>1,'access_level'=>3,'active'=>1));
      if($query->num_rows()>0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    public function check_director_supervising()
    {
      $data=null;
      $query = $this->db->query("select access_level,is_director_active from admin where region_code =013 and access_level IN(3,4) and is_director_active =1");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['access_level'];
        }
      }
      return $data;
    }
}
