<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registration_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function register_branch($type,$branch_id,$rCode,$pst){
    $this->db->trans_begin();
    $x=$this->registered_branch_count()+1;
    if ($type=='Branch ')
      $j='CA-'.$pst.$rCode;
    else
      $j='LA-'.$pst.$rCode;
    for($a=strlen($x);$a<8;$a++)
      $j=$j.'0';
    $j=$j.$x;

    $this->db->update('branches', array('status'=>21,'certNo'=>$j,'dateRegistered'=>date('Y-m-d',now('Asia/Manila'))),array('id'=>$branch_id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Certification No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'Certification No. has been successfully generated.');
    }
  }


  public function register_coop($coop_id,$rCode,$pst){
    $this->db->trans_begin();
    $x=$this->registered_coop_count()+1;
    $j='9520-'.$pst.$rCode;
    for($a=strlen($x);$a<12;$a++)
      $j=$j.'0';
    $j=$j.$x;

    $sql="insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative, ' Cooperative ', grouping)), ?, category_of_cooperative, type_of_cooperative, ?, common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id from cooperatives where id=".$coop_id;
    $this->db->query($sql,array($j,date('m-d-Y',now('Asia/Manila'))));

    $this->db->update('cooperatives', array('status'=>15),array('id'=>$coop_id));

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
  public function registered_branch_count(){
      $query= $this->db->query("select distinct id from branches where not(certNo=null)");
      return $query->num_rows();
  }

  public function get_coop_info($coop){
    $this->db->select('registeredcoop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('registeredcoop.coopName'=>$coop));
    $query = $this->db->get();

    return $query->row();
  }
  
  public function get_coop_info_amendment($coop){
    $this->db->select('amend_coop.*');
    $this->db->from('amend_coop');
    $this->db->where(array('amend_coop.id'=>$coop));
    $query = $this->db->get();

    return $query->row();
  }
  
  public function get_chairman(){
      $this->db->select('*');
      $this->db->from('chairman');
      $this->db->where(array('active_status' => 1));
      $query = $this->db->get();

      return $query->row();
  }
  public function get_director($id){
      
      $query = $this->db->query('select * from admin where access_level=3 and region_code=(select region_code from admin where id ='.$id.')');
      
      return $query->row();
  }

  public function save_qr_code($regNo,$qr_code){
    $this->db->trans_begin();
    $this->db->where('regNo',$regNo);
      $query= $this->db->update('registeredcoop', array('qr_code'=>$qr_code));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
   public function save_branch_qr_code($certNo,$qr_code){
    $this->db->trans_begin();
    $this->db->where('certNo',$certNo);
      $query= $this->db->update('branches', array('qr_code'=>$qr_code));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  
  public function get_coop_info_laboratories($coop){
    $this->db->select('laboratories.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = laboratories.coop_id','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('registeredcoop.coopName'=>$coop));
    $query = $this->db->get();

    return $query->row();
  }
}
