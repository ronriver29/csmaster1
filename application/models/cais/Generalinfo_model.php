<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class generalInfo_model extends CI_Model{

  public function get_address_region($r){
    $this->db->select('*');
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
    if($query->num_rows()>0) {
	return $query->row();
	}
    else { return false; }
	
  }

  public function get_region(){
    $this->db->select('*');
    $this->db->from('refregion');

    $query = $this->db->get();
   
    return $query;
  }

  public function get_provins($reg){
    $this->db->select('provDesc,provCode');
    $this->db->from('refprovince');
    $this->db->where('regCode', $reg);

    $query = $this->db->get();
  
    return $query;
  }



  public function get_ct($pro){
    $this->db->select('citymunDesc,citymunCode');
    $this->db->from('refcitymun');
    $this->db->where('provCode', $pro);

    $query = $this->db->get();
   // echo $this->db->last_query();  
    return $query;
  }

  public function get_brg($cit){
    $this->db->select('brgyDesc,brgyCode');
    $this->db->from('refbrgy');
    $this->db->where('citymunCode', $cit);

    $query = $this->db->get();
    
    return $query;
  }

  public function get_province($reg){
    $this->db->select('provDesc,provCode');
    $this->db->from('refprovince');
    $this->db->where('regCode', $reg);

    $query = $this->db->get();
    
    return $query->result();
  }

  public function get_city($pro){
    $this->db->select('citymunDesc,citymunCode');
    $this->db->from('refcitymun');
    $this->db->where('provCode', $pro);

    $query = $this->db->get();
    
    return $query->result();
  }

  public function get_brgy($cit){
    $this->db->select('brgyDesc,brgyCode');
    $this->db->from('refbrgy');
    $this->db->where('citymunCode', $cit);

    $query = $this->db->get();
    
    return $query->result();
  }

  public function get_regNo($data){ 
    $data = $this->security->xss_clean($data);
    $this->db->select('regNo,period');
    $this->db->from('ca_user');
    $this->db->where('id', $data);

    $query = $this->db->get();
    return $query->row();
  }

  public function get_coop($data){
    $regNo = $this->security->xss_clean($data['regNo']); //9520-14009400
    $coverageYear = $this->security->xss_clean($data['coverageYear']); //9520-14009400
    $this->db->select("*, CASE WHEN LOCATE('-', dateRegistered) > 0 THEN STR_TO_DATE(dateRegistered, '%m-%d-%Y') ELSE STR_TO_DATE(dateRegistered, '%d/%m/%Y') END AS dateRegistered");
    $this->db->from('registeredcoop');
    $this->db->where('regNo', $regNo);
    $this->db->where("(YEAR(CASE WHEN LOCATE('-', dateRegistered) > 0 THEN STR_TO_DATE(dateRegistered, '%m-%d-%Y') ELSE STR_TO_DATE(dateRegistered, '%d/%m/%Y') END) < '".$coverageYear."')");
    //get the latest record
    $this->db->order_by('id', 'DESC');
    $this->db->limit('1');
    
    $query = $this->db->get();
    
    return $query->row();
  }
  public function get_coop_amendment($data){
    $regNo = $this->security->xss_clean($data['regNo']); //9520-14009400
    $coverageYear = $this->security->xss_clean($data['coverageYear']); //9520-14009400
    $this->db->select('*');
    $this->db->from('registeredamendment');
    $this->db->where('regNo', $regNo);
    $this->db->where("(YEAR(dateRegistered) < '".$coverageYear."')");
    //get the latest record
    $this->db->order_by('id', 'DESC');
    $this->db->limit('1');
    
    $query = $this->db->get();
    
    return $query->row();
  }


  //get amended coop
  public function get_coop_amendment_application($data){
    $data = $this->security->xss_clean($data); //9520-14009400
    $this->db->select("*, proposed_name AS coopName, refbrgy_brgyCode AS addrCode, street AS 'Street', house_blk_no AS noStreet, category_of_cooperative AS category, type_of_cooperative AS type");
    $this->db->from('amend_coop');
    $this->db->where('cooperative_id', $data);
    $this->db->where('status', 15);
    //get the latest amended
    $this->db->order_by('amendmentNo', 'DESC');
    $this->db->limit('1');
    
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

  public function get_saved_data($data,$coverageYear){
    $data = $this->security->xss_clean($data);
    $coverageYear = $this->security->xss_clean($coverageYear);
    $this->db->select('genInfo, assetSize, brgy, city, province, region,isImported,importItem,importVol,importOrig,isExported,exportItem,exportVol,exportDest,capris_year');
    $this->db->from('capris');
    $this->db->where(array('userid'=>$data,'capris_year'=>$coverageYear));

    $query = $this->db->get();

    return $query->row(); 
  }

  public function check_existing_data($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('capris', array('userid' => $data['userid'],'capris_year'=>$data['capris_year']));

    if($query->num_rows()>0)
    	return true;
    else
    	return false;
  }

    public function check_existing_data1($data){
    $data = $this->security->xss_clean($data);
    $query= $this->db->get_where('registeredcoop', array('regNo' => $data));

    if($query->num_rows()>0)
      return true;
    else
      return false;
  }

  public function save_data($data){
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->insert('capris',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }
    $this->db->trans_commit();
    return true;
  }

  public function edit_data($data){
    $data = $this->security->xss_clean($data);
    $this->db->where(array('userid'=>$data['userid'],'capris_year'=>$data['capris_year']));
    $this->db->update('capris',$data);
    
    return true;
  }
    public function edit_data1($data,$regNo){
    $data = $this->security->xss_clean($data);
    $this->db->where('regNo',$regNo);
    $this->db->update('registeredcoop',$data);
    
    return true;
  }

  public function isCharteredCity($cityCode)
  {
    $cityCode = (int)$cityCode.'000';
      $query = $this->db->where("city_code",$cityCode)->get("charter_cities");
      if($query->num_rows()>0)
      {
        return true;
      }
      return false;
  }
    
}