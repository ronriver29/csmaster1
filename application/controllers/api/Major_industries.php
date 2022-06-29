<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_Industries extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('major_industry_model');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = array();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $coop_type_id = $this->input->post('coop_type');
      if(strpos($coop_type_id, "|")==true) {
          $coop_type_ids = explode("|",$coop_type_id);
          $fetch_ids =array();
          foreach($coop_type_ids AS $id) {
              $list = $this->major_industry_model->get_major_industries($id);
              foreach($list as $row) {
                if(!in_array($row['id'], $fetch_ids)) {
                  $data[] = $row;
                  $fetch_ids[] = $row['id'];
                }
              }
          }
      } else {
        $data = $this->major_industry_model->get_major_industries($coop_type_id);
      }
      echo json_encode($data);
    }
  }

}
