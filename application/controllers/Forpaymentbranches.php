<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forpaymentbranches extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $items['status'] = '22';
    if($this->db->where("id",$decoded_id)->update("branches",$items)) {
    
    $query_payment = $this->db->select("branches.*,users.*")
                     ->from("branches")
                     ->join("users","branches.user_id = users.id")
                     ->where("branches.id = $decoded_id")
                     ->get();
    $ret = $query_payment->row();
    $email = $ret->email;
    $name = $ret->proposed_name;
    
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";
    if($ret->type == 'Branch'){
      $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PAYMENT</b>.

      You may opt to pay thru the available online facilities listed in your CoopRIS account or
      at CDA Cashier. If opted to pay at the latter, kindly print this notice and present to the
      concerned CDA Office where your proposed cooperative will be registered.

      Once the said documents had been found complete and in order, the client may now
      claim the Certificate of Authority within the day. </pre>";
    } else {
      $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PAYMENT</b>.

      You may opt to pay thru the available online facilities listed in your CoopRIS account or
      at CDA Cashier. If opted to pay at the latter, kindly print this notice and present to the
      concerned CDA Office where your proposed cooperative will be registered.
      
      Once payment has been settled the client may now claim the Letter of Authority. </pre>";
    }



    $this->email->from($from,'CoopRIS Administrator');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        redirect('branches/'.$id);
    }else{
        return false;
    }
        
        redirect('branches/'.$id);
    } else {
        $this->session->set_flashdata('cooperative_error', 'Successfully updated basic information.');
       redirect('branches/'.$this->input->post('cooperativeID'));
    }
  }
}
