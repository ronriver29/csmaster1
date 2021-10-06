<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class sked22_model extends CI_Model {

	function get_sked22($data,$coverageYear){
		$data = $this->security->xss_clean($data);
		$this->db->select('schedule22');
		$this->db->from('cafsis');
		$this->db->where(array('userID'=>$data,'cafsis_year'=>$coverageYear));

		$query = $this->db->get();
		
    	return $query->row();
    	
	}

	public function check_existing_data($data){
   		$data = $this->security->xss_clean($data);
    	$query= $this->db->get_where('cafsis', array('userID' => $data['userID'],'cafsis_year'=>$data['cafsis_year']));

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
	    $this->db->where(array('userID'=>$data['userID'],'cafsis_year'=>$data['cafsis_year']));
	    $this->db->update('cafsis',$data);
	    
	    return true;
	}
	
}