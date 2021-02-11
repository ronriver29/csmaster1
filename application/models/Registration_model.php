<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registration_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function register_branch($type,$branch_id,$rCode,$pst,$branchsatellite,$coopName,$branchName,$subaddcode){
    $this->db->trans_begin();
    $x=$this->registered_branch_count($coopName,$branchsatellite,$subaddcode);
    $y=$this->registered_branch_count2();
    if ($branchsatellite=='Branch'){
      $j='CA-'.$pst.$rCode;
      if($x == 0){
            $branchName = 'Branch';
            $x = 1;
      } else {
            $x = $x+1;
            $branchName = 'Branch '.$x;
      }
    } else {
      $j='LA-'.$pst.$rCode;
      if($x == 0){
            $branchName = 'Satellite';
            $x = 1;
      } else {
            $x = $x+1;
            $branchName = 'Satellite '.$x;
      }
    }
    $z = 9;
    $stringcount = $z - strlen($y);
    for($a=strlen($x);$a<$stringcount;$a++)
      $j=$j.'0';
    $j=$j.$y;

    $this->db->update('branches', array('branchName'=>$branchName,'status'=>21,'certNo'=>$j,'dateRegistered'=>date('Y-m-d',now('Asia/Manila'))),array('id'=>$branch_id));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return array('success'=>false,'message'=>'Failed to generate Certification No.');
    }else{
      $this->db->trans_commit();
      return array('success'=>true,'message'=>'Certification No. has been successfully generated.');
    }
  }


  public function register_coop($coop_id,$rCode,$pst,$acronymname){
    $this->db->trans_begin();
    $x=$this->registered_coop_count()+1;
    $j='9520-'.$pst.$rCode;
    for($a=strlen($x);$a<8;$a++) //modify by json from 12 to 8
      $j=$j.'0';
    $j=$j.$x;

    $sql=" INSERT INTO registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id) SELECT RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative,' Cooperative ','$acronymname',' ',grouping)), ?, category_of_cooperative, type_of_cooperative, ?, common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant',id FROM cooperatives WHERE id=".$coop_id;
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

  public function register_coop_amendment($coop_id,$data_reg,$pst){
    $this->db->trans_begin();
    // $x=$this->registered_coop_count()+1;
    // $j='9520-'.$pst.$rCode;
    // for($a=strlen($x);$a<8;$a++) //modify by json from 12 to 8
    //   $j=$j.'0';
    // $j=$j.$x;
    $cooperative_id = $this->coop_dtl($coop_id);
    $chk_query = $this->db->get_where('registeredcoop',array('amendment_id'=>$coop_id));
    if($chk_query->num_rows()>0)
    {
      $this->db->update('registeredcoop',$data_reg,array('amendment_id'=>$coop_id));
    }
    else
    {
      // $sql="insert into registeredcoop(coopName, regNo, category, type, dateRegistered, commonBond, areaOfOperation, noStreet, street, addrCode, compliant,application_id,amendment_id) select RTRIM(CONCAT(proposed_name, ' ', type_of_cooperative,' Cooperative ', grouping)), ?, category_of_cooperative, type_of_cooperative, ?, common_bond_of_membership, area_of_operation, house_blk_no, street, refbrgy_brgyCode, 'Compliant', ".$cooperative_id.",".$coop_id." from amend_coop where id=".$coop_id;
      // $this->db->query($sql,array($j,date('m-d-Y',now('Asia/Manila'))));
      $this->db->insert('registeredcoop',$data_reg);
    
     
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
  public function registered_branch_count($coopName,$branchsatellite,$subaddcode){
      $query= $this->db->query("select * from branches where coopName = '".$coopName."' AND type = '".$branchsatellite."' AND status = 21 AND addrCode LIKE '".$subaddcode."%'");
      return $query->num_rows();
  }
  public function registered_branch_count2(){
      $query= $this->db->query("select * from branches where status = 21");
      return $query->num_rows();
  }

  public function get_coop_info($coop){
    $this->db->select('registeredcoop.*, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region,payment.date_of_or as dateofor,cooperatives.type_of_cooperative');
    $this->db->from('registeredcoop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('cooperatives','cooperatives.id = registeredcoop.application_id','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('payment', 'payment.payor = registeredcoop.coopName');
    $this->db->where(array('registeredcoop.coopName'=>$coop));
    $query = $this->db->get();

    return $query->row();
  }
  
  public function get_coop_info_amendment($amendment_id){
    $this->db->select('amend_coop.* ,amend_coop.id as amendment_id, registeredcoop.*,amend_coop.house_blk_no AS noStreet, amend_coop.street AS Street, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region, amendment_bylaws.annual_regular_meeting_day_venue as ga_venue');
//    $this->db->select('amend_coop.*');
    $this->db->from('amend_coop');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('registeredcoop', 'amend_coop.id = registeredcoop.amendment_id');
    $this->db->join('amendment_bylaws', 'amend_coop.id = amendment_bylaws.amendment_id','left');
    // $this->db->where(array('registeredcoop.amendment_id'=>$amendment_id));
    $this->db->where(array('amend_coop.id'=>$amendment_id));
    $query = $this->db->get();

    return $query->row();
  }
  
  //modify by jason
  public function get_laboratory_info($id)
  {
    $qry = $this->db->get_where('laboratories',array('id'=>$id));
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }

  }

//modify by jason
  public function get_cooperative_info_laboratories($regNo,$lab_id){
    $this->db->select('laboratories.*,registeredcoop.coopName as coopName, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('laboratories');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = laboratories.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('registeredcoop', 'registeredcoop.regNo = laboratories.coop_id','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('registeredcoop.regNo'=>$regNo,'laboratories.id'=>$lab_id));
    $query = $this->db->get();

    return $query->row();
  }
  //end modify

    //modify by json
  public function update_laboratory_($laboratory_id)
  {
    $updated_data = array(
                          'status'=>21
                    );
    if($this->db->update('laboratories',$updated_data,array('id'=>$laboratory_id))){
       // echo "success";
       // return true;
    }
    else
    {
      return "failed to update laboratory details(dateRegistered field)";
    }
  }

  //end modify
  public function get_chairman(){
      $this->db->select('*');
      $this->db->from('chairman');
      $this->db->where(array('active_status' => 1));
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
