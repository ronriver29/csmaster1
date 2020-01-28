<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forpayment extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $items['status'] = '16';
    if($this->db->where("id",$decoded_id)->update("cooperatives",$items)) {
    
    $query_payment = $this->db->select("cooperatives.*,users.*")
                     ->from("cooperatives")
                     ->join("users","cooperatives.users_id = users.id")
                     ->where("cooperatives.id = $decoded_id")
                     ->get();
    $ret = $query_payment->row();
    $email = $ret->email;
    $name = $ret->proposed_name;
    
    $from = "coopris.test@gmail.com";    //senders email address
    $subject =$name.' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PAYMENT</b>.

You may opt to pay thru the available online facilities listed in your CoopRIS account or at CDA Cashier. 

Once payment has been settled the client may now claim the Certificate of Registration. </pre>";


    $this->email->from($from,'CoopRIS Administrator');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send()){
        redirect('cooperatives/'.$id);
    }else{
        return false;
    }
        
        redirect('cooperatives/'.$id);
    } else {
        $this->session->set_flashdata('cooperative_error', 'Successfully updated basic information.');
//        redirect('cooperatives/'.$this->input->post('cooperativeID'));
    }
  }
}
