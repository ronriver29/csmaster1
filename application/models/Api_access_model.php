<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_access_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
 
  public function update($data)
  {
    $data = $this->security->xss_clean($data);
    $this->db->trans_begin();
    $this->db->update('api_data_access',$data,array('tbl'=>$data['tbl']));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function remove($id)
  {
    $this->db->trans_begin();
    $this->db->update('api_data_access',array('active'=>0),array('id'=>$id));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
  public function get_access()
  {
    $data =null;
    $query  = $this->db->query("select * from api_data_access order by alias asc");
    if($query->num_rows()>0)
    {
      $data= $query->result_array();
    }
    return $data;
  }

  public function get_coop_by_regNo($regNo)
  {
    $regNo = $data = $this->security->xss_clean($regNo);
    $this->db->select('users.first_name,users.last_name,users.contact_number,registeredcoop.coopName,registeredcoop.dateRegistered,registeredcoop.regNo,registeredcoop.category,registeredcoop.type,registeredcoop.noStreet,registeredcoop.Street,registeredcoop.compliant,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region,cooperatives.proposed_name, cooperatives.category_of_cooperative, cooperatives.grouping,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,cooperatives.interregional,cooperatives.regions,registeredcoop.application_id');
    $this->db->from('registeredcoop');
   
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->join('cooperatives','cooperatives.id=registeredcoop.application_id','inner');
     $this->db->join('users', 'cooperatives.users_id = users.id','inner');
    // $this->db->join('cooperative_type','cooperative_type.name=registeredcoop.type','inner');
    $this->db->where('registeredcoop.regNo', $regNo);
    $query = $this->db->get();
    // return $this->db->last_query();
    $data=[];
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $data[]= array(
          'RegistrationNo.' =>$row['regNo'],
          'RegistrationDate' => $row['dateRegistered'],
          'CooperativeName' => $row['coopName'],
          'address'=> array(
            'details'=> $row['noStreet'].' '.$row['Street'].' '.$row['brgy'].', '.$row['city'].', '.$row['province'].', '.$row['region'],
            'locality' =>$row['city'],
            'region' => $row['region']
          ),
          'type'=>$row['type'],
          'category' => $row['category'],
          'contactPerson' => array(
              'name'=>$row['first_name'].' '.$row['last_name'],
              'phone'=>$row['contact_number']
          ),
          'status'=>$row['compliant'],
          'cooperatives_id'=>$row['application_id']
        );
      }
      return $data;
    }
    else
    {
      return "No data found.";
    }
  }

  public function check_table_access($table)
  {
    $query = $this->db->query("SELECT active FROM api_data_access WHERE active =1 AND tbl like'".$table."%'");
    if($query->num_rows()==1)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
