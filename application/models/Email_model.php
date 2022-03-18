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
//      $this->email->from($from,'ecoopris CDA (No Reply)');
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
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject = $coop_full_name.'&rsquo;s Application';  //email subject
    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
    $message = $coop_full_name." has been assigned to you by ".$admin_info->full_name.". You can now evaluate this application.";
//    $this->email->from($from,'ecoopris CDA (No Reply)');
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

  public function sendEmailToSpecialistAmendment($admin_info,$client_info,$amendment_info){
     $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =  $coop_full_name.'\'s Amendment Application';  //email subject

    $burl = base_url();
    //sending confirmEmail($receiver) function calling link to the user, inside message body
      $admin_message = "You are assigned to validate the application for amendment registration with the following details:<p>
                <ol type='a'>
                <b><li> Name of Cooperative:</b> ".$coop_full_name."</li>                
                <b><li> Address of cooperative:</b> ". $address_coop."</li>                             
                <b><li> Contact Person:</b> ".$client_full_name."</li>                                         
                <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                <b><li> Email address:</b> ". $client_info->email."</li>
                </ol>";   

   $this->email->from($from,'ecoopris CDA (No Reply)');
   $this->email->to($admin_info->email);
   $this->email->subject($subject);
   $this->email->message($admin_message);
   if($this->email->send())
   {
      return true;
   }
   else
   {
    return false;
   }

  }

  public function sendEmailDefferedtoSenior($client_info, $senior_email,$amendment_info)
  { 
     $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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
    $client_full_name = $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;
    $from = "ecoopris@cda.gov.ph";   
    $admin_subject =$coop_full_name.'\'s Amendment Application'; 
    // $client_subject = 'Amendment Application';
       
       $admin_message = "Good day! A deferred application for Amendment registration with the following details has been re-submitted for re-evaluation:<p>
                  <ol type='a'>  
                     <b><li> Proposed Name of Cooperative:</b> ". $coop_full_name."</li>                
                     <b><li> Address of proposed cooperative: </b>". $address_coop."</li>                             
                     <b><li> Contact Person: </b>". $client_full_name."</li>                                         
                     <b><li> Contact Number: </b>". $client_info->contact_number."</li>
                     <b><li> Email address: </b>". $client_info->email."</li>
                    </ol>";          

      // $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";  
     //Admin send mail                                                               ;
     $this->email->from($from,'ecoopris CDA (No Reply)');
     $this->email->to( $senior_email);
     $this->email->subject($admin_subject);
     $this->email->message($admin_message);
      if($this->email->send()){
            return true;
            // Client send email
               // $this->email->from($from,'ecoopris CDA (No Reply)');
               // $this->email->to($client_info->email);
               // $this->email->subject($client_subject);
               // $this->email->message($client_message);
               // if($this->email->send())
               // {
               //    return true;
               // }
               // else
               // {
               //    return false;
               // }
        }else{
            return false;
        }
  }

   public function sendEmailtoClientResubmission($client_info)
  {
    $from = "ecoopris@cda.gov.ph";   
    $client_subject = 'Amendment Application';
    $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($client_info->email);
        $this->email->subject($client_subject);
        $this->email->message($client_message);
        if($this->email->send())
        {
        return true;
        }
        else
        {
        return false;
        }
  }

   public function sendEmailtoAuthorized($authorized_email,$coop_info,$client_info)
  {
    $address = $coop_info->house_blk_no.' '.$coop_info->street.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region;
    $from = "ecoopris@cda.gov.ph";   
    $subject = 'Amendment Update Info';
    $message = "<pre> Good day! An application to update the cooperative information with the following details had been submitted for evaluation. </pre>

                    <ol type='a'>  
                     <b><li> Name of Cooperative:</b> ". $coop_info->coopName."</li>                
                     <b><li> Region of Cooperative: </b>". $coop_info->region."</li>                             
                     <b><li> Registration Number: </b>". $coop_info->dateRegistered."</li>                                         
                     <b><li> Address of Cooperative: </b>". $client_info->contact_number."</li>
                     <b><li> Email address: </b>". $client_info->email."</li>
                    </ol>";       
                       

        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($authorized_email);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send())
        {
        return true;
        }
        else
        {
        return false;
        }
  }

   public function sendEmailtoClientupdate($client_info)
  {
    $from = "ecoopris@cda.gov.ph";   
    $client_subject = 'Amendment Update Info';
    $client_message = "<pre>Good Day! 
                        
                        Good day! Encoded updates on your cooperative information have been successfully submitted for evaluation. </pre>";
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($client_info->email);
        $this->email->subject($client_subject);
        $this->email->message($client_message);
        if($this->email->send())
        {
        return true;
        }
        else
        {
        return false;
        }
  }


  public function sendEmailfirstSubmissionAmendment($client_info,$senior_email,$amendment_info)
  {
     $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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
    $client_full_name = $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;
    $from = "ecoopris@cda.gov.ph";   
    $admin_subject =$coop_full_name.'\'s Amendment Application'; 
    // $client_subject = 'Amendment Application';
    if($amendment_info->status == 11)
    {
        
       $admin_message = "Good day! A deferred application for Amendment registration with the following details has been re-submitted for re-evaluation:<p>
                  <ol type='a'>  
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>                
                     <b><li> Address of cooperative: </b>". $address_coop."</li>                             
                     <b><li> Contact Person: </b>". $client_full_name."</li>                                         
                     <b><li> Contact Number: </b>". $client_info->contact_number."</li>
                     <b><li> Email address: </b>". $client_info->email."</li>
                    </ol>";          
    }
    else
    {
        $admin_message = "Good day! An application for Amendment registration with the following details has been submitted:<p>
                  <ol type='a'>
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>                
                     <b><li> Address of cooperative:</b> ". $address_coop."</li>                            
                     <b><li> Contact Person:</b> ". $client_full_name."</li>                                         
                     <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                     <b><li> Email address:</b> ". $client_info->email."</li>
                </ol>"; 
             
    }
      // $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";  
     //Admin send mail                                                               ;
     $this->email->from($from,'ecoopris CDA (No Reply)');
     $this->email->to($senior_email);
     $this->email->subject($admin_subject);
     $this->email->message($admin_message);
      if($this->email->send()){
            return true;
            // // Client send email
            //    $this->email->from($from,'ecoopris CDA (No Reply)');
            //    $this->email->to($client_info->email);
            //    $this->email->subject($client_subject);
            //    $this->email->message($client_message);
            //    if($this->email->send())
            //    {
            //       return true;
            //    }
            //    else
            //    {
            //       return false;
            //    }
        }else{
            return false;
        }
  }

  //client email receive first submission
  public function sendEmailClientFirstSubmission($client_info)
  {
     $from = "ecoopris@cda.gov.ph";   
     $client_subject = 'Amendment Application';
     $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";
        // Client send email
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($client_info->email);
        $this->email->subject($client_subject);
        $this->email->message($client_message);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
  }

  public function sendEmailToSeniorAmendment($senior_email,$client_info,$amendment_info,$specialist_info){
    $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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
    $from = "ecoopris@cda.gov.ph";   
    $admin_subject =$coop_full_name.'\'s Amendment Application'; 
    // $client_subject = 'Amendment Application';
    if($amendment_info->status == 11)
    {
        
       $admin_message = "Good day! A deferred application for Amendment registration with the following details has been re-submitted for re-evaluation:<p>
                  <ol type='a'>  
                     <b><li> Name of CDS II/Validator:</b> ". $specialist_info->full_name."</li>                
                     <b><li> Date of validation:</b> ". date('Y-m-d h:i:s',now('Asia/Manila'))."</li>                            
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>
                     <b><li> Address of Cooperative:</b> ". $address_coop."</li>                                         
                     <b><li> Address of Cooperative: </b> ". $client_info->contact_number."</li>
                     <b><li> Contact Person:</b> ".  $client_full_name."</li>
                     <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                     <b><li> Email Address:</b> ". $client_info->email."</li>
                    </ol>";          
    }
    else
    {
        $admin_message = "A validated application for Amendment Registration with the following details has been submitted for your evaluation:<p>
                  <ol type='a'>
                     <b><li> Name of CDS II/Validator:</b> ". $specialist_info->full_name."</li>                
                     <b><li> Date of validation:</b> ". date('Y-m-d h:i:s',now('Asia/Manila'))."</li>                            
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>
                     <b><li> Address of Cooperative:</b> ". $address_coop."</li>                                         
                     <b><li> Address of Cooperative: </b> ". $client_info->contact_number."</li>
                     <b><li> Contact Person:</b> ".  $client_full_name."</li>
                     <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                     <b><li> Email Address:</b> ". $client_info->email."</li>
                </ol>"; 
             
    }
      // $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";  
     //Admin send mail                                                               ;
     $this->email->from($from,'ecoopris CDA (No Reply)');
     $this->email->to($senior_email);
     $this->email->subject($admin_subject);
     $this->email->message($admin_message);
      if($this->email->send()){
            return true;
        }else{
            return false;
        }
  }

  public function sendEmailtoClientFromCds($client_info,$amendment_info)
  {
     $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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
    $client_full_name = $client_info->first_name.' '.$client_info->middle_name.' '.$client_info->last_name;
    $from = "ecoopris@cda.gov.ph"; 
    $client_subject = 'Amendment Application';
     $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";  

        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($client_info->email);
        $this->email->subject($client_subject);
        $this->email->message($client_message);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
  }

  public function sendEmailToDirectorAmendment($admin_info,$client_info,$amendment_info,$director_email,$cds_fullname)
  {
    $cds_date_findings = $this->amendment_model->get_latest_comment_date(1,$amendment_info->id);
    $sernior_date_findings = $this->amendment_model->get_latest_comment_date(2,$amendment_info->id);

       $acronym='';
        if(strlen($amendment_info->acronym)>0)
        {
            $acronym=' ('.$amendment_info->acronym.')';
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
    $from = "ecoopris@cda.gov.ph";   
    $admin_subject =$coop_full_name.'\'s Amendment Application'; 
    $client_subject = 'Amendment Application';
   

    if($amendment_info->status == 11)
    {
        
       $admin_message = "Senior CDS evaluated application for amendment registration with the following details has been submitted for your evaluation and approval/denial/deferment:<p>
                  <ol type='a'>  
                     <b><li> Name of CDS II/Validator:</b> ".$cds_fullname."</li>                
                     <b><li> Date of validation:</b> ". $cds_date_findings->created_at."</li>
                     <b><li> Sr. CDS Evaluation Date:</b> ".$sernior_date_findings->created_at."</li>                          
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>
                     <b><li> Address of Cooperative:</b> ". $address_coop."</li>                                         
                     <b><li> Contact Person:</b> ".  $client_full_name."</li>
                     <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                     <b><li> Email Address:</b> ". $client_info->email."</li>
                    </ol>";          
    }
    else
    {
        $admin_message = "Senior CDS evaluated application for amendment registration with the following details has been submitted for your evaluation and approval/denial/deferment:<p>
                  <ol type='a'>
                    <b><li> Name of CDS II/Validator:</b> ". $cds_fullname."</li>                
                     <b><li> Date of validation:</b> ".$cds_date_findings->created_at."</li>
                     <b><li> Sr. CDS Evaluation Date:</b> ".$sernior_date_findings->created_at."</li>                          
                     <b><li> Name of Cooperative:</b> ". $coop_full_name."</li>
                     <b><li> Address of Cooperative:</b> ". $address_coop."</li>                                         
                     <b><li> Contact Person:</b> ".  $client_full_name."</li>
                     <b><li> Contact Number:</b> ". $client_info->contact_number."</li>
                     <b><li> Email Address:</b> ". $client_info->email."</li>
                </ol>"; 
             
    }
      // $client_message = "Successfully submitted your amendment application. Please wait for an email of either payment procedure or the list of documents for compliance.<p>";  
     //Admin send mail                                                               ;
     $this->email->from($from,'ecoopris CDA (No Reply)');
     $this->email->to($director_email);
     $this->email->subject($admin_subject);
     $this->email->message($admin_message);
      if($this->email->send()){
            return true;
            // Client send email
               // $this->email->from($from,'ecoopris CDA (No Reply)');
               // $this->email->to($client_info->email);
               // $this->email->subject($client_subject);
               // $this->email->message($client_message);
               // if($this->email->send())
               // {
               //    return true;
               // }
               // else
               // {
               //    return false;
               // }
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
//      $this->email->from($from,'ecoopris CDA (No Reply)');
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
//      $this->email->from($from,'ecoopris CDA (No Reply)');
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


//    $this->email->from($from,'ecoopris CDA (No Reply)');
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
  public function sendEmailToClientAmendmentApprove($name,$email,$amendment_id){
    $acbl = $this->amendment_model->acbl($amendment_id);
    $articles = '';
    $bylaws = '';
    $and ='';
    if($acbl['articles'])
    {
      $articles = ' Articles of Cooperation ';
    }
    if($acbl['bylaws'])
    {
      $bylaws = ' By-Laws ';
    }
    if($acbl['articles'] && $acbl['bylaws'])
    {
      $and = ' and ';
    }

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PRINTING AND SUBMISSION</b>.

You may now print the following documents in three (3) copies:

     
     a. Approved Amended".$articles.$and.$bylaws."
     b. General Assembly Resolution stating the fact that the said
        amendments have been duly approved by at least two-thirds (2/3) vote
        of all members with voting rights;
     c. Treasurer’s Affidavit (in case of proposed increase in capital)
     d. BOD and Secretary Certificate


The above documents shall be printed in Bookman Style Font 12 legal size or 8.5\" x 13\" bond paper.

In addition to the above, please attach the following in 1 original and 2 certified true photocopies signed by the Authorized
Officer:

     e. Other requirements for specific type of cooperatives

The client shall submit the above required documents within 30 days from the date of e-mail notification. Failure to submit the same shall be considered as an abandonment of your interest to pursue your application and thus, will be purged from the Cooperative Registration Information System (CoopRIS)..</pre>";


   $this->email->from($from,'ecoopris CDA (No Reply)');
   $this->email->to($email);
   $this->email->subject($subject);
   $this->email->message($message);
   if($this->email->send()){
    // if($this->sendMail($email, $subject, $message)){
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
//    $this->email->from($from,'ecoopris CDA (No Reply)');
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
    $message = "Sorry. ".$full_name.". Your application <b>".$name."</b> has been deferred because of the following reason/s:<p><br><pre>".$comment."</pre><br> You have 10 days to complete the following.";
//    $this->email->from($from,'ecoopris CDA (No Reply)');
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

//    $this->email->from($from,'ecoopris CDA (No Reply)');
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
            $mail->Username = 'ecoopris@cda.gov.ph';          // SMTP username
            $mail->Password = 'Registrationh0'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->SetFrom('coopris4.test@gmail.com', 'ecoopris CDA (No Reply)');
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

