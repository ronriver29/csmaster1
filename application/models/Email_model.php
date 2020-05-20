<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
    $this->load->library('email');
  }
  

  public function sendEmailAccountDetails($email,$username,$password){
      $from = "coopris4.test@gmail.com";    //senders email address
      $subject = 'Admin Account Details';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $keywords = preg_split("/@/", $email);
      $message = "Your account has been created. See the details below: <br>".
      "<ul><li>Username: ".$username."</li><li>Password: ".$password."</li></ul>";
//      $this->email->from($from,'CoopRIS Administrator');
//      $this->email->to($email);
//      $this->email->subject($subject);
//      $this->email->message($message);
//      if($this->email->send()){
      if($this->sendMail($email, $subject, $message)){
          return true;
      }else{
          return false;
      }
  }
  public function sendEmailToSpecialist($admin_info,$coop_full_name){
    $from = "coopris4.test@gmail.com";    //senders email address
    $subject = $coop_full_name.'&rsquo;s Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $coop_full_name." has been assigned to you by ".$admin_info->full_name.". You can now evaluate this application.";
//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($admin_info->email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToSpecialistAmendment($admin_info,$coop_full_name){
    $from = "coopris.test@gmail.com";    //senders email address
    $subject = $coop_full_name.'\'s Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $coop_full_name." has been assigned to you. You can now evaluate this application.";
//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($admin_info->email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($admin_info->email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToSeniorAmendment($admin_info,$emails,$coop_full_name){
    // if(sizeof($emails)>0){
    //   $receiver = "";
    //   if(sizeof($emails)>1){
    //     $tempEmail = array();
    //     foreach($emails as $email){
    //       array_push($tempEmail, $email['email']);
    //     }
    //     $receiver = implode(", ",$tempEmail);
    //   }else{
    //     $receiver = $emails[0]['email'];
    //   }
      $from = "coopris.test@gmail.com";    //senders email address
      // $subject = $coop_full_name.' Evaluation Result';  //email subject
       $subject =' Evaluation Result';  //email subject

      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been approved by ".$admin_info->full_name.". You can now evaluate this application.";
//      $this->email->from($from,'CoopRIS Administrator');
//      $this->email->to($receiver);
//      $this->email->subject($subject);
//      $this->email->message($message);
//      if($this->email->send()){
      if($this->sendMail($emails, $subject, $message)){
          return true;
      }else{
          return false;
      }
    // }else{
    //   return true;
    // }
  }

  public function sendEmailToDirectorAmendment($admin_info,$emails,$coop_full_name)
  {
    
      $from = "coopris.test@gmail.com";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been submitted by ".$admin_info->full_name.". You can now evaluate this application.";

      if($this->sendMail($emails, $subject, $message)){
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
      $from = "coopris4.test@gmail.com";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been approved by ".$admin_info->full_name.". You can now evaluate this application.";
//      $this->email->from($from,'CoopRIS Administrator');
//      $this->email->to($receiver);
//      $this->email->subject($subject);
//      $this->email->message($message);
//      if($this->email->send()){
      if($this->sendMail($email, $subject, $message)){
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
      $from = "coopris4.test@gmail.com";    //senders email address
      $subject = $coop_full_name.' Evaluation Result';  //email subject
      $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
      $message = $coop_full_name." has been approved by ".$admin_info->full_name.". You can now evaluate this application.";
//      $this->email->from($from,'CoopRIS Administrator');
//      $this->email->to($receiver);
//      $this->email->subject($subject);
//      $this->email->message($message);
//      if($this->email->send()){
      if($this->sendMail($email, $subject, $message)){
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
    $from = "coopris4.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     4.1.  Economic Survey;
     4.2.  Articles of Cooperation and the approved By-laws;
           4.2.1.  All original;
           4.2.2.  The Articles of Cooperation shall be signed by all the cooperators on each and every page and duly notarized by a Notary Public; and
           4.2.3.  The By-Laws shall be signed by all the members on the adoption page.
     4.3.  Treasurer's Affidavit duly notarized by a Notary Public;

The above documents shall be printed in legal size bond paper or 8.5\" x 13\" size paper.

In addition to the above, please attach the following in 1 original and 3 certified true photocopies signed by the Authorized Officer:

     1.  Surety Bond of Accountable Officers;
     2.  Certification of Pre-Registration Seminar (PRS); 
     3.  Proof of Payment; and 
     4.  Other requirements for specific type of cooperatives

The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS)..</pre>";


//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToClientAmendmentApprove($name,$email){
//    echo $name;
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     4.1.  Economic Survey;
     4.2.  Articles of Cooperation and the approved By-laws;
           4.2.1.  All original;
           4.2.2.  The Articles of Cooperation shall be signed by all the cooperators on each and every page and duly notarized by a Notary Public; and
           4.2.3.  The By-Laws shall be signed by all the members on the adoption page.
     4.3.  Treasurer's Affidavit duly notarized by a Notary Public;

The above documents shall be printed in legal size bond paper or 8.5\" x 13\" size paper.

In addition to the above, please attach the following in 1 original and 3 certified true photocopies signed by the Authorized Officer:

     1.  Surety Bond of Accountable Officers;
     2.  Certification of Pre-Registration Seminar (PRS); 
     3.  Proof of Payment; and 
     4.  Other requirements for specific type of cooperatives

The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS)..</pre>";


//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }

  public function sendEmailToClientDeny($full_name,$name,$email,$comment){
    //$step_str = (($step==1) ? "First" : (($step==2) ? "Second" : "Third"));
    $from = "coopris4.test@gmail.com";    //senders email address
    $subject = $name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> failed the evaluation. This cooperative has been denied because of the following reason/s:<br><pre>".$comment."</pre>";
//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }
  public function sendEmailToClientDefer($full_name,$name,$email,$comment){
    $from = "coopris4.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> has been deferred because of the following reason/s:<br><pre>".$comment."</pre><br> You have 10 days to complete the following.";
//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }
  
  
  public function sendEmailToClientApproveLaboratories($name,$email){
	  echo $name;
    $from = "coopris4.test@gmail.com";    //senders email address
    $subject =$name.' Laboratory Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in Four (4) copies:

     4.1.  Economic Survey;
     4.2.  Articles of Cooperation and the approved By-laws;
           4.2.1.  All original;
           4.2.2.  The Articles of Cooperation shall be signed by all the cooperators on each and every page and duly notarized by a Notary Public; and
           4.2.3.  The By-Laws shall be signed by all the members on the adoption page.
     4.3.  Treasurer's Affidavit duly notarized by a Notary Public;

The above documents shall be printed in legal size bond paper or 8.5\" x 13\" size paper.

In addition to the above, please attach the following in 1 original and 3 certified true photocopies signed by the Authorized Officer:

     1.  Surety Bond of Accountable Officers;
     2.  Certification of Pre-Registration Seminar (PRS); 
     3.  Proof of Payment; and 
     4.  Other requirements for specific type of cooperatives

The client shall submit the above required documents within 30 working days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS)..</pre>";

//    $this->email->from($from,'CoopRIS Administrator');
//    $this->email->to($email);
//    $this->email->subject($subject);
//    $this->email->message($message);
//    if($this->email->send()){
    if($this->sendMail($email, $subject, $message)){
        return true;
    }else{
        return false;
    }
  }
  
  public function sendMail($recipient,$subject,$content){
        
            $this->load->library('mailer');
            $mail = new PHPMailer;

            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'cooperative.testing20@gmail.com';          // SMTP username
            $mail->Password = 'kamote]]'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->SetFrom('coopris4.test@gmail.com', 'CoopRIS Administrator');
            $mail->addAddress($recipient);   // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML

            $bodyContent = utf8_decode($content);

            $mail->Subject = $subject;
            $mail->Body    = $bodyContent;
            if($mail->send()) {
                return TRUE;
            }else{
                return FALSE;
            }
    }
}
