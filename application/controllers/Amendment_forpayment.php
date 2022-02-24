<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_forpayment extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    // $this->db->delete('payment',array('amendment_id'=>$decoded_id));
    $data_payment = array(
            'date' => date('Y-m-d h:i:s',now('Asia/Manila')),
            'amendment_id' => $decoded_id
    );
    $query_check = $this->db->get_where('payment',array('amendment_id'=>$decoded_id));
    if($query_check->num_rows==1)
    {
         // $this->db->insert('payment',$data_payment);
        $items['status'] = '16';
        if($this->db->where("id",$decoded_id)->update("amend_coop",$items)) {
        
        $query_payment = $this->db->select("amend_coop.*,users.*")
                         ->from("amend_coop")
                         ->join("users","amend_coop.users_id = users.id")
                         ->where("amend_coop.id = $decoded_id")
                         ->get();
        $ret = $query_payment->row();
        $email = $ret->email;
        $name = $ret->proposed_name;
        }
    }
    else
    {
        $this->db->insert('payment',$data_payment);
        $items['status'] = '16';
        if($this->db->where("id",$decoded_id)->update("amend_coop",$items)) {
        
            $query_payment = $this->db->select("amend_coop.*,users.*")
                             ->from("amend_coop")
                             ->join("users","amend_coop.users_id = users.id")
                             ->where("amend_coop.id = $decoded_id")
                             ->get();
            $ret = $query_payment->row();
            $email = $ret->email;
            $name = $ret->proposed_name;
        }
    }
   
    

    // $from = "Amendment_forpayment.php";    //senders email address

    // $from = "ecoopris@cda.gov.ph";    //senders email address

    // $from = "ecoopris@cda.gov.ph";    //senders email address

    // $from = "ecoopris@cda.gov.ph";    //senders email address

    $from = "ecoopris@cda.gov.ph";    //senders email address

    $subject =' Evaluation Result';  //email subject
    $burl = base_url();
      //sending confirmEmail($receiver) function calling link to the user, inside message body

//    $message = "Congratulations ".$client_info->full_name.". Your application <b>".$client_info->proposed_name." ".$client_info->type_of_cooperative." Cooperative</b> has been approved. You can now proceed to payment. You have 10 working days to complete the payment";

    $message="<pre><b>Congratulations!</b> Your application status is <b>FOR PAYMENT</b>.

Please Print the system generated Order of payment in your account and present the same to the CDA Cashier or you may opt to pay thru the available online facilities encoding the details in the Order of Payment. 

Once payment has been settled the client may now claim the Certificate of Amendment by presenting the Official Receipt or incase of online payment the successful transaction receipt to CDA Registration Division/Section having jurisdiction over your area.

Thank you. </pre>";


   $this->email->from($from,'ecoopris CDA (No Reply)');
   $this->email->to($email);
   $this->email->subject($subject);
   $this->email->message($message);
   if($this->email->send()){
       redirect('amendment');
   }else{
       return false;
   }
    redirect('amendment');
   
  }

  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
