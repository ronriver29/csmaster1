<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile_model extends CI_Model{

  public function get_address_region($r){
    $this->db->select('regDesc');
    $this->db->from('refregion');
    $this->db->where('regCode', $r);

    $query = $this->db->get();
   
    return $query->row();
  }

  public function get_address_province($p){
    $this->db->select('provDesc');
    $this->db->from('refprovince');
    $this->db->where('provCode', $p);

    $query = $this->db->get();
    
    return $query->row();
  }

  public function get_address_city($c){
    $this->db->select('citymunDesc');
    $this->db->from('refcitymun');
    $this->db->where('citymunCode', $c);

    $query = $this->db->get();
    
    return $query->row();
  }

  public function get_address_brgy($b){
    $this->db->select('brgyDesc');
    $this->db->from('refbrgy');
    $this->db->where('brgyCode', $b);

    $query = $this->db->get();
    
    return $query->row();
  }

  public function get_coopType($data){
    $data = $this->security->xss_clean($data);
    $this->db->select('type');
    $this->db->from('registeredcoop');
    $this->db->where('regNo', $data);

    $query = $this->db->get();
    
    return $query->row();
  }

  public function get_subType($data){
    $data = $this->security->xss_clean($data);
    $this->db->select('type');
    $this->db->from('multipurpose');
    $this->db->where('regNo', $data);

    $query = $this->db->get();
    
    return $query;
  }

  public function get_assetSize($data,$coverageYear){
    $data = $this->security->xss_clean($data);
    $this->db->select('assetSize,genInfo,brgy,city,province,region');
    $this->db->from('capris');
    $this->db->where(array('userid'=>$data,'capris_year'=>$coverageYear));

    $query = $this->db->get();
    
    return $query->row();
  }

  public function get_saved_data($data,$coverageYear){
    $data = $this->security->xss_clean($data);
    $this->db->select('ceaNo,auditor');
    $this->db->from('cafsis');
    $this->db->where(array('userid'=>$data,'cafsis_year'=>$coverageYear));

    $query = $this->db->get();
   
    return $query->row();
  }

  public function get_saved_data_document($data){
    $data = $this->security->xss_clean($data);
    $this->db->select('*');
    $this->db->from('cafsis');
    $this->db->where(array('userid'=>$data));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_coop($data){
    $data = $this->security->xss_clean($data);
    $this->db->select('coopName,regNo,mobileNo,email');
    $this->db->from('ca_user');
    $this->db->where('id', $data);

    $query = $this->db->get();
    
    return $query->row();
  }

  public function check_existing_data($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('cafsis', array('userid' => $data['userid'],'cafsis_year'=>$data['cafsis_year']));

    if($query->num_rows()>0)
    	return true;
    else
    	return false;
  }

  public function save_data($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('cafsis',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }
    $this->db->trans_commit();
    return true;
  }

  public function edit_data($data){
    $data = $this->security->xss_clean($data);
    $this->db->where(array('userid'=>$data['userid'],'cafsis_year'=>$data['cafsis_year']));
    $this->db->update('cafsis',$data);
    return true;
  }

  public function find_name($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('cea', array('ceaNo' => $data));

    if($query->num_rows()>0)
      return $query->row();
    else
      return '{"no":"","auditor":"","dateReg":"","dateValid":""}';
    
  }    
}