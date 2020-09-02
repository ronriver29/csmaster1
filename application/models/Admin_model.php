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
    $query= $this->db->get_where('admin', array('username' => $data['username']));
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
    $this->db->where(array('admin.access_level!=' => 5));
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
    $this->db->delete('admin',array('id' => $aid));
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
    $this->db->where('id',$director_id);
    $this->db->update('admin',array('is_director_active'=>0));
    $this->db->where('id',$supervisor->id);
    $this->db->update('admin',array('is_director_active'=>1));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function revoke_privilege_supervisor($director_id){
    $query = $this->db->get_where('admin',array('id'=>$director_id,'access_level'=>3));
    $data = $query->row();
    $query2 = $this->db->get_where('admin',array('access_level'=>4,'region_code'=>$data->region_code));
    $supervisor = $query2->row();
    $this->db->trans_begin();
    $this->db->where('id',$director_id);
    $this->db->update('admin',array('is_director_active'=>1));
    $this->db->where('id',$supervisor->id);
    $this->db->update('admin',array('is_director_active'=>0));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function sendEmailAccountDetails($email,$username,$password){
      $from = "coopris.test@gmail.com";    //senders email address
      $subject = 'Admin Account Details';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been created. See the details below: <br>".
      "<ul><li>Username: ".$username."</li><li>Password: ".$password."</li></ul>";
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
  public function sendEmailToSpecialist($admin_info,$coop_full_name){
    $from = "coopris.test@gmail.com";    //senders email address
    $subject = $coop_full_name.'`s Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $coop_full_name." has been assigned to you. You can now validate this application.";
    $this->email->from($from,'CoopRIS Administrator');
    $this->email->to($admin_info->email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToAdmins($admin_info,$emails,$coop_full_name){
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
      $from = "coopris.test@gmail.com";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been submitted by ".$admin_info->full_name.". You can now evaluate this application.";
      $this->email->from($from,'CoopRIS Administrator');
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
      $from = "coopris.test@gmail.com";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been approved by ".$admin_info->full_name.". You can now evaluate this application.";
      $this->email->from($from,'CoopRIS Administrator');
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
//	  echo $name;
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
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

In addition to the above, please attach the following in 1 original and 3 certified true photocopies signed by the Authorized Officer:

     1.  Surety Bond of Accountable Officers;
     2.  Certification of Pre-Registration Seminar (PRS); 
     3.  Other requirements for specific type of cooperatives

The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS).</pre>";


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
  public function sendEmailToClientApproveBranch($name,$email){
//	  echo $name;
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now submit the following requirements/ documents:

     1.  Business Plan
     2.  General Assembly Resolution
     3.  Certification for the presence of Manual of Operation and Addresses of the branch office
     4.  Audited Financial Statement for the last three years

The above documents shall be printed in Legal size or ”8.5 x 13” or ”8.5 x 14” bond paper.


The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS).</pre>";


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
  public function sendEmailToClientApproveSatellite($name,$email){
//	  echo $name;
    $from = "coopris.test@gmail.com";    //senders email address
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

The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS).</pre>";


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
  public function sendEmailToClientDeny($full_name,$name,$email,$comment){
    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "coopris.test@gmail.com";    //senders email address
    $subject = $name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> failed the evaluation. This cooperative has been denied because of the following reason/s:<br><pre>".$comment."</pre>";
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
  public function sendEmailToClientDefer($full_name,$name,$email,$comment){
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> has been deferred because of the following reason/s:<br><pre>".$comment."</pre><br> You have 15 days to complete the following.";
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
  public function get_emails_of_senior_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>2));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_supervisor_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>4));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_emails_of_director_by_region($regcode){
    $query = $this->db->get_where('admin',array('region_code'=>$regcode,'access_level'=>3));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_all_specialist_by_region($regcode){
    $this->db->like('region_code',$regcode);
    $query = $this->db->get_where('admin',array('access_level'=>1));
    $data = $query->result_array();
    if($this->db->count_all_results()==0){
      return array();
    }else{
      return $data;
    }
  }
  public function get_admin_info($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('admin',array('id'=>$data));
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
  public function check_if_director_active($admin_id,$region_code){
    // $query= $this->db->get_where('admin',array('id'=>$admin_id,'access_level'=>3));
    $query = $this->db->query("select * from admin where id='$admin_id' and region_code='$region_code' and access_level IN (3,4)");
    $row = $query->row();
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
  public function check_position_not_exists_in_region_update($access_level,$regcode,$aid){
    if($access_level > 1){
      $this->db->where(array('access_level'=>$access_level,'region_code'=>$regcode,'id!='=>$aid));
      $this->db->from('admin');
      if($this->db->count_all_results()==0){
        return array('success'=>true,'message'=>'Not exists');
      }else{
        $recDesc = ($regcode != "0" ) ? $this->region_model->get_region_by_code($regcode)->regDesc : "Central Office";
        $position = (($access_level == 1) ? "Cooperative Development Specialist II" : (($access_level == 2) ? "Senior Cooperative Development Specialist" : (($access_level == 3) ? "Director": "Supervising CDS")));
        return array('success'=>false,'message'=> $position.' already exists in '.$recDesc);
      }
    }else{
      return array('success'=>true,'message'=>'Not exists');
    }
  }
  
   public function sendEmailToClientApproveLaboratories($name,$email){
    // echo $name;
    $from = "coopris.test@gmail.com";    //senders email address
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
The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be removed from the Cooperative Registration Information
System (CoopRIS).</pre>";

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
//    public function sendEmailToClientApproveLaboratories($name,$email){
//     echo $name;
//     $from = "coopris.test@gmail.com";    //senders email address
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


//     $this->email->from($from,'CoopRIS Administrator');
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
      $query = $this->db->get_where('admin',array('id'=>$supervising_id,'is_director_active'=>1,'access_level'=>4));
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
      $query = $this->db->get_where('admin',array('id'=>$director_id,'is_director_active'=>1,'access_level'=>3));
      if($query->num_rows()>0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
}
