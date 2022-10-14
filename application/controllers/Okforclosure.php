<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Okforclosure extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index($id = null)
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $items['status'] = '39';
    $items['ok_for_closure'] = date('Y-m-d');
    if($this->db->where("id",$decoded_id)->update("branches",$items)) {
          redirect('For_closure');
      
    } else {
        $this->session->set_flashdata('cooperative_error', 'Successfully updated basic information.');
       // redirect('branches/'.$this->input->post('cooperativeID'));
    }
  }
}
