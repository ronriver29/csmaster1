<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_Industries_amendment extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    
      $coop_type_id = implode(',',$this->input->post('cooptype_'));
      // echo $coop_type_id;
      $qry = $this->db->query("select distinct industry_subclass_by_coop_type.major_industry_id,major_industry.description from industry_subclass_by_coop_type left join major_industry on industry_subclass_by_coop_type.major_industry_id = major_industry.id where cooperative_type_id IN(".$coop_type_id.")");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          // $row['description'] = $this->major_industry_subclass_id($row['major_industry_id']);
          $data[] = $row;
        }
        echo json_encode($data);
      }
    
  }

}
