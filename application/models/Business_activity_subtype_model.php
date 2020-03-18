<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Business_Activity_Subtype_model extends CI_Model{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->database();
    }
    public function get_business_activity_subtype($business_act_id){
      $this->db->order_by('name', 'ASC');
      $query = $this->db->get_where('business_activity_subtype',array('business_activity_id'=>$business_act_id));
      return $query->result_array();
    }

  }
