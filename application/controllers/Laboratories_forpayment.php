<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratories_forpayment extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $items['status'] = '19';
    if($this->db->where("id",$decoded_id)->update("laboratories",$items)) 
    {
    $query_payment = $this->db->select("laboratories.*,users.*")
                     ->from("laboratories")
                     ->join("users","laboratories.user_id = users.id")
                     ->where("laboratories.id = $decoded_id")
                     ->get();
    $ret = $query_payment->row();
    $email = $ret->email;
    $name = $ret->laboratoryName;

    $from = "ecoopris@cda.gov.ph";    //senders email address
    $subject =$name.' Laboratory Result';  //email subject
     $message="<pre><b>Congratulations!</b> Your application status is <b> FOR PAYMENT</b>.


You may opt to pay thru the available online facilities listed in your CoopRIS account or
at CDA Cashier. If opted to pay at the latter, kindly print this notice and present to the
concerned CDA Office where your proposed cooperative will be registered.

Once the said documents had been found complete and in order, the client may now
claim the Certificate of Recognition within the day.</pre>";


            $this->email->from($from,'ecoopris CDA (No Reply)');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send()){
                // $this->session->set_flashdata('Email_success', 'Success');
                // redirect('cooperatives');
            }else{
                return false;
            }
     
       $this->session->set_flashdata('success_message', 'Successfully submitted.');
          redirect('laboratories/');   
    } else {
        $this->session->set_flashdata('error_message', 'Failed to submit ok for payment');
          redirect('laboratories/');
//        redirect('laboratories/'.$this->input->post('cooperativeID'));
       
    }
  } //end of function

}
