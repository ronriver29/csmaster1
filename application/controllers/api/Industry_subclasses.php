<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_subclasses extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->input->method(TRUE)==="GET"){
      $data = array();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $coop_type_id = $this->input->post('coop_type');
      $major_industry_id = $this->input->post('major_industry');
      if(strpos($coop_type_id, "|")==true) {
          $coop_type_ids = explode("|",$coop_type_id);
          $coop_type_ids = array_filter($coop_type_ids);
          $fetch_ids = array();
          foreach($coop_type_ids AS $id) {
              $list = $this->industry_subclass_model->get_industry_subclasses($id,$major_industry_id);
              if(count($list)>0) {
                foreach($list as $row) {
                    if(!in_array($row['id'], $fetch_ids)) {
                        $data[] = $row;
                        $fetch_ids[] = $row['id'];
                    }
                }
              }
          }
      } else {
        $data = $this->industry_subclass_model->get_industry_subclasses($coop_type_id,$major_industry_id);
      }
      echo json_encode($data);
    }
  }

}
