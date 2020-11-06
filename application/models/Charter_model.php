<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charter_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  
  public function in_charter_city($city_code)
  {
    $psgcCode='';
    $city_code = $this->security->xss_clean($city_code);
    $query_city = $this->db->get_where('refcitymun',array('citymunCode'=>$city_code));
    if($query_city->num_rows()>0)
    {
      foreach($query_city->result() as $city_row)
      {
        $psgcCode= $city_row->psgcCode;
      }
    }
    //remove zero string
   if(substr($psgcCode,0,1) =='0')
   {
      $count_string =strlen($psgcCode);
      $str_length  = $count_string -1;
      
      $psgcCode= substr($psgcCode,1,$str_length);
   }
    $query = $this->db->get_where('charter_cities',array('city_code'=> $psgcCode));
    if($query->num_rows()>0)
    {
      // return $query->row_array();
      return true;
    }
    else
    {
      return false;
    }

  }

  public function get_charter_city($city_code)
  {
    $psgcCode='';
    $city_code = $this->security->xss_clean($city_code);
    $query_city = $this->db->get_where('refcitymun',array('citymunCode'=>$city_code));
    if($query_city->num_rows()>0)
    {
      foreach($query_city->result() as $city_row)
      {
        $psgcCode= $city_row->psgcCode;
        $cityDesc = $city_row->citymunDesc;
      }
    }
    
     //remove zero char
     if(substr($psgcCode,0,1) =='0')
     {
        $count_string =strlen($psgcCode);
        $str_length  = $count_string -1;
        
        $psgcCode= substr($psgcCode,1,$str_length);
     }
    $query = $this->db->get_where('charter_cities',array('city_code'=> $psgcCode));
    if($query->num_rows()>0)
    {
     
     return  $cityDesc;
    }
    else
    {
      return false;
    }
  }
 

}
