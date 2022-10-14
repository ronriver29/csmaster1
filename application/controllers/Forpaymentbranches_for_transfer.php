<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forpaymentbranches_for_transfer extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $items['status'] = '51';
    $items['date_for_payment'] = date('Y-m-d');
    if($this->db->where("id",$decoded_id)->update("branches",$items)) {
    
    $query_payment = $this->db->select("branches.*,users.*")
                     ->from("branches")
                     ->join("users","branches.user_id = users.id")
                     ->where("branches.id = $decoded_id")
                     ->get();
    $ret = $query_payment->row();
    $email = $ret->email;
    // $name = $ret->proposed_name;
    $name = $ret->coopName;
      // echo '<pre>';print_r($ret); echo'</pre>';
    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";
      $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PAYMENT</b>.

      Please print the system generated Order of Payment in your account and present the same to the CDA Cashier or you may opt to pay thru the available online facilities encoding the details in the Order of Payment.

      Please comply immediately within ten (10) days upon receipt of this email.

      Thank you.</pre>";
    



      $this->email->from($from,'ecoopris CDA (No Reply)');
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($message);
      if($this->email->send()){
          redirect('branches/'.$id);
      }else{
          return false;
      }
        
        // redirect('branches/'.$id);
    } else {
        $this->session->set_flashdata('cooperative_error', 'Successfully updated basic information.');
       // redirect('branches/'.$this->input->post('cooperativeID'));
    }
  }
}
