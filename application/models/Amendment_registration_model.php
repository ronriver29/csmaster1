<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_registration_model extends CI_Model{

  public function register_coop_amendment($coop_id,$data_reg,$pst){
    $this->db->trans_begin();
    // $x=$this->registered_coop_count()+1;
    // $j='9520-'.$pst.$rCode;
    // for($a=strlen($x);$a<8;$a++) //modify by json from 12 to 8
    //   $j=$j.'0';
    // $j=$j.$x;
    $cooperative_id = $this->coop_dtl($coop_id);
    $chk_query = $this->db->get_where('registeredamendment',array('amendment_id'=>$coop_id));
    if($chk_query->num_rows()>0)
    {
      $this->db->update('registeredamendment',$data_reg,array('amendment_id'=>$coop_id));
    }
    else
    {
      // $sql="insert into registeredamendment(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id,amendment_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative,' Cooperative ', grouping)), ?, category_of_cooperative, type_of_cooperative, ?, common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant', ".$cooperative_id.",".$coop_id." from amend_coop where id=".$coop_id;
      // $this->db->query($sql,array($j,date('m-d-Y',now('Asia/Manila'))));
      $this->db->insert('registeredamendment',$data_reg);
    
     
    }//end chk query
     $this->db->update('amend_coop', array('status'=>15),array('id'=>$coop_id));  

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Registration No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'Registration No. has been successfully generated.');
    }
  }
  
  public function registered_coop_count(){
      $query= $this->db->query("select distinct regNo from registeredcoop");
      return $query->num_rows();
  }

   public function get_coop_info_amendment($amendment_id){
    $this->db->select('amend_coop.* ,amend_coop.id as amendment_id, registeredamendment.*,amend_coop.house_blk_no AS noStreet, amend_coop.street AS Street, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, amendment_bylaws.annual_regular_meeting_day_venue as ga_venue');
//    $this->db->select('amend_coop.*');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredamendment', 'amend_coop.id = registeredamendment.amendment_id');
    $this->db->join('amendment_bylaws', 'amend_coop.id = amendment_bylaws.amendment_id','left');
    // $this->db->where(array('registeredamendment.amendment_id'=>$amendment_id));
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();

    return $query->row();
  }
   
   public function get_chairman(){
      $this->db->select('*');
      $this->db->from('chairman');
      $this->db->where('active_status = 1 AND effectivity_date >= "2021-04-15"');
      $query = $this->db->get();

      return $query->row();
  }
  
  public function get_director($region_code){
      
      // $query = $this->db->query('select * from admin where access_level=3 and region_code=(select region_code from admin where id ='.$id.')');
    $query = $this->db->get_where('admin',array('region_code'=>$region_code,'access_level'=>3,'ord'=>1));
    if($query->num_rows()>0)
    {
      return $query->row(); 
    }
    else
    {
      $query2 = $this->db->get_where('admin',array('access_level'=>3,'access_name'=>"Acting Regional Director",'region_code'=>$region_code));
      if($query2->num_rows()>0)
      {
         return $query2->row();
      }
      
    }  
      
  }

  public function get_last_reg_amendment($regno)
  {
    $query =$this->db->query("select regNo,amendment_no from registeredamendment where regNo='$regno'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $amendment_no = $row['amendment_no']+1;//.' '.$row['regNo'];
      }
    }
    else
    {
      $amendment_no = 1;
    }
    return $amendment_no;
  }

  public function get_last_amendment_no($amendment_id)
  {
    $query =$this->db->query("select amendment_no from registeredamendment where amendment_id='$amendment_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $amendment_no = $row['amendment_no'];//.' '.$row['regNo'];
      }
    }
    
    return $amendment_no;
  }

  public function in_registeredamendment($amendment_id)
  {
    $query = $this->db->select('amendment_id')->from('registeredamendment')->where('amendment_id',$amendment_id)->get();
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }

}
