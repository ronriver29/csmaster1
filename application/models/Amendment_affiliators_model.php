<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_affiliators_model extends CI_Model{
public $amendment_fed_id = null;
public $data = null;
public $coopName = '';
public $regNo='';
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    // $this->load->database();
  }
    
    public function count_applied_coop($amend_coop_id)
    {   
        $this->amendment_fed_id= $this->security->xss_clean($amend_coop_id);
        $this->db->select("id");
        $this->db->from('amendment_affiliators');
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        unset($this->amendment_fed_id);
        unset($amend_coop_id);
        return  $this->db->count_all_results();

    }

    public function get_applied_coop($amendment_id,$limit,$start){
    
        $this->db->select("source");
        $this->db->from('amendment_affiliators');
        $this->db->where(['amendment_fed_id'=>$amendment_id]);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
             $this->db->limit($limit, $start);
              $this->db->select("amendment_affiliators.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
                $this->db->from('amendment_affiliators');
                // $this->db->join('amend_coop', 'amendment_affiliators.amendment_fed_id = amend_coop.id','left');
                // $this->db->join('registeredamendment','registeredamendment.id = amendment_affiliators.amendment_id','right');
                $this->db->join('refbrgy' , 'refbrgy.brgyCode = amendment_affiliators.addrCode','left');
                $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
                $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
                $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
                $this->db->where('amendment_affiliators.amendment_fed_id ='.$amendment_id);
                $query2 = $this->db->get();
                return $query2->result_array();
                unset($query2);
                unset($query);
                unset($amendment_id);
        }
    }

    public function get_applied_coop_admin($amendment_id,$limit,$start,$coopName,$regNo){
        $this->coopName = (strlen($coopName)>0 ? " AND amendment_affiliators.coopName like '$coopName%'" : "");
        $this->regNo = (strlen($regNo)>0 ? " AND amendment_affiliators.regNo like '$regNo%'" : "");
  
        $this->db->select("source");
        $this->db->from('amendment_affiliators');
        $this->db->where(['amendment_fed_id'=>$amendment_id]);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
             $this->db->limit($limit, $start);
              $this->db->select("amendment_affiliators.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
                $this->db->from('amendment_affiliators');
                // $this->db->join('amend_coop', 'amendment_affiliators.amendment_fed_id = amend_coop.id','left');
                // $this->db->join('registeredamendment','registeredamendment.id = amendment_affiliators.amendment_id','right');
                $this->db->join('refbrgy' , 'refbrgy.brgyCode = amendment_affiliators.addrCode','left');
                $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
                $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
                $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
                $this->db->where('amendment_affiliators.amendment_fed_id ='.$amendment_id.$this->coopName.$this->regNo);
                $query2 = $this->db->get();
                return $query2->result_array();
                unset($query2);
                unset($query);
                unset($amendment_id);
        }
    }

     public function count_applied_coop_admin($amend_coop_id,$coopName,$regNo)
    {   
        $this->coopName = (strlen($coopName)>0 ? " AND amendment_affiliators.coopName like '$coopName%'" : "");
        $this->regNo = (strlen($regNo)>0 ? " AND amendment_affiliators.regNo like '$regNo%'" : "");
        $this->amendment_fed_id= $this->security->xss_clean($amend_coop_id);
        // $this->db->limit($limit, $start);
        $this->db->select("id");
        $this->db->from('amendment_affiliators');
        $this->db->where("amendment_fed_id=".$this->amendment_fed_id.$this->coopName.$this->regNo);
        unset($this->amendment_fed_id);
        unset($amend_coop_id);
        return  $this->db->count_all_results();

    }


    public function get_all_affiliators_of_coop($amend_coop_id){
    $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
    $this->db->select('amendment_affiliators.*');
    $this->db->from('amendment_affiliators');
    $this->db->where('amendment_fed_id', $this->amendment_fed_id);
    $query=$this->db->get();
    unset($this->amendment_fed_id);
    unset($amend_coop_id);
    // $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
    }

    public function get_registered_coop($area_of_operation,$addresscode,$type_of_cooperative,$regNo,$coopName){
    $AmendmentName = (strlen($coopName)>0 ? " AND registeredamendment.coopName like '$coopName%'" : "");
    $AmendmentregNo=(strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'" : "");
    $CoopName = (strlen($coopName)>0 ? " AND registeredcoop.coopName like '%$coopName%'" : "");
    $CoopregNo=(strlen($regNo)>0 ? " AND registeredcoop.regNo='$regNo'" : "");
    $regNoamd=(strlen($regNo)>0 ? " AND registeredamendment.regNo='$regNo'" : "");
    $where_ = " registeredamendment.coopName like '$coopName%' AND registeredamendment.regNo ='$regNo'";
    $data=[];  
    if($area_of_operation == 'Barangay'){
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
         
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-',registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")  AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
          
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41  AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
 
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id,cooperatives.common_bond_of_membership, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
 
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;

      
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41 AND  addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    } 
                }
            }
        }
        else
        {
            //PRIMARY COOP
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where($where_);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                    }
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                    }   
                }
            }
        }
        else
        {
            //PRIMARY COOP $this->db->where('amend_coop.status = 15 AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")');// AND addrCode LIKE "'.$addresscode.'%"');
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    }
    
    } 

 public function get_registered_coop_tertiary($area_of_operation,$addresscode,$type_of_cooperative,$regNo,$coopName){
    $AmendmentName = (strlen($coopName)>0 ? " AND registeredamendment.coopName like '$coopName%'" : "");
    $AmendmentregNo=(strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'" : "");
    $CoopName = (strlen($coopName)>0 ? " AND registeredcoop.coopName like '%$coopName%'" : "");
    $CoopregNo=(strlen($regNo)>0 ? " AND registeredcoop.regNo='$regNo'" : "");
    $regNoamd=(strlen($regNo)>0 ? " AND registeredamendment.regNo='$regNo'" : "");
    $where_ = " registeredamendment.coopName like '$coopName%' AND registeredamendment.regNo ='$regNo'";
    $data=[];  
    if($area_of_operation == 'Barangay'){
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
         
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-',registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND AND cooperatives.category_of_cooperative IN("Primary","Secondary") AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")  AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
          
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.type_of_cooperative AND amend_coop.category_of_cooperative IN("Primary","Secondary") AND NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41  AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
 
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id,cooperatives.common_bond_of_membership, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.category_of_cooperative IN("Primary","Secondary") AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    }
                    
                }
            }
        }
        else
        {
            //PRIMARY COOP
 
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.category_of_cooperative IN("Primary","Secondary") AND cooperatives.status IN (15,39) AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }

                    // $data = $coop_info->result_array();
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;

      
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where('addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$regNoamd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41 AND  addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                       
                    }
                   
                }
                else //NOT MIGRATED
                {
                    $updated_amendment_qry =$this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                      
                    } 
                }
            }
        }
        else
        {
            //PRIMARY COOP
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND cooperatives.category_of_cooperative IN("Primary","Secondary") AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where($where_);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $first_query  = $this->db->get();
        if($first_query->num_rows() ==1)
        {
            foreach($first_query->result() as $frow)
            {
                if($frow->migrated==1)
                {
                    //FOR MIGRATED
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 41'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['source'] = 'amendment';
                            $row['application_id'] = 0;
                            $data[]= $row;
                        }
                        // $data = $updated_amendment_qry->result_array();
                        unset($row);
                        unset($updated_amendment_qry);
                        unset($addresscode);
                    }
                }
                else //NOT MIGRATED
                {
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id,registeredamendment.commonBond,registeredamendment.Street,registeredamendment.noStreet,registeredamendment.addrCode, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.category_of_cooperative IN("Primary","Secondary") AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance") AND amend_coop.status = 15'.$AmendmentName.$AmendmentregNo);
                     $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {
                        $data = $updated_amendment_qry->result_array();
                        unset($updated_amendment_qry);
                        unset($addresscode);
                    }   
                }
            }
        }
        else
        {
            //PRIMARY COOP $this->db->where('amend_coop.status = 15 AND amend_coop.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")');// AND addrCode LIKE "'.$addresscode.'%"');
            $this->db->select("registeredcoop.*,DATE(CASE WHEN LOCATE('-', registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND amend_coop.category_of_cooperative IN("Primary","Secondary") AND cooperatives.type_of_cooperative NOT IN("Bank","Cooperative Bank","Insurance")'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['source'] = 'cooperative';
                            $row['amendment_id'] = 0;
                            $data[]= $row;
                        }
                    unset($addresscode);
                    unset($coop_query);
                    unset($coop_info);
                    unset($addresscode);
                    unset($regNo);
                }
        }
        return $data;
    }
    
    } 


    public function update_affiliator($data,$affiliator_id)
    {
        $data= $this->security->xss_clean($data);
        $affiliator_id= $this->security->xss_clean($affiliator_id);
        $this->db->trans_begin();
        $this->db->update('amendment_affiliators',$data,array('id'=>$affiliator_id));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }

    }
  // public function get_registered_coop($area_of_operation,$addresscode,$type_of_cooperative){
  //   if($area_of_operation == 'Barangay'){
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id,amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //   } else if($area_of_operation == 'Municipality/City'){
  //       $addresscode = substr($addresscode, 0, 6);
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //   } else if($area_of_operation == 'Provincial'){
  //       $addresscode = substr($addresscode, 0, 4);
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //   } else if($area_of_operation == 'Regional'){
  //       $addresscode = substr($addresscode, 0, 2);
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //   } else if($area_of_operation == 'National'){
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
  //       $this->db->where('(amend_coop.status IS NULL OR amend_coop.status = 15 OR amend_coop.status = 39)');
  //       // $this->db->limit('10');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //       }
  //       else if($area_of_operation == 'Interregional'){
  //       $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
  //       $this->db->from('amend_coop');
  //       $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
  //       $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
  //       $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
  //       $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
  //       $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','right');
  //       $this->db->where('registeredamendment.type LIKE "'.$type_of_cooperative.'%" AND (amend_coop.status IS NULL OR amend_coop.status = 15) AND length(registeredamendment.addrCode)=9');
  //       // $this->db->limit('10');
  //       $query = $this->db->get();
  //       $data = $query->result_array();
  //       return $data;
  //       }
  //   }


    public function get_registered_coop_update($area_of_operation,$addresscode,$type_of_cooperative){
    if($area_of_operation == 'Barangay'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id,amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('(amend_coop.status = 39 OR amend_coop.status = 15) AND addrCode LIKE "'.$addresscode.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('(amend_coop.status = 39 OR amend_coop.status = 15) AND addrCode LIKE "'.$addresscode.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('(amend_coop.status = 39 OR amend_coop.status = 15) AND addrCode LIKE "'.$addresscode.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->where('(amend_coop.status = 39 OR amend_coop.status = 15)');
        // $this->db->limit('10');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
        else if($area_of_operation == 'Interregional'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','right');
        $this->db->where('(amend_coop.status = 39 OR amend_coop.status = 15)');
        // $this->db->limit('10');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
    }
    
public function get_registered_coop_tech_service($area_of_operation,$addresscode,$type_of_cooperative){
    if($area_of_operation == 'Barangay'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id,amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->where('length(amend_coop.refbrgy_brgyCode = 9) AND (amend_coop.status = 15 OR amend_coop.status = 39)');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->where('length(amend_coop.refbrgy_brgyCode = 9) AND (amend_coop.status = 15 OR amend_coop.status = 39)');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->where('length(amend_coop.refbrgy_brgyCode = 9) AND (amend_coop.status = 15 OR amend_coop.status = 39)');
        // $this->db->limit('10');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
        else if($area_of_operation == 'Interregional'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','right');
        $this->db->where('length(amend_coop.refbrgy_brgyCode = 9) AND (amend_coop.status = 15 OR amend_coop.status = 39)');
        // $this->db->limit('10');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
    }

    public function get_all_cooperator_of_coop($amend_coop_id){
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->select('amendment_affiliators.*');
        $this->db->from('amendment_affiliators');
        $this->db->where('user_id', $amend_coop_id);
        $this->db->order_by('representative','asc');
        $query=$this->db->get();
        $this->last_query = $this->db->last_query();
        $data = $query->result_array();
        return $data;
      }

    public function get_registered_coop_secondary($area_of_operation,$addresscode,$type_of_cooperative){
    if($area_of_operation == 'Barangay'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id,amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.category = "Secondary" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Municipality/City'){
        $addresscode = substr($addresscode, 0, 6);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.category = "Secondary" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Provincial'){
        $addresscode = substr($addresscode, 0, 4);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.category = "Secondary" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'Regional'){
        $addresscode = substr($addresscode, 0, 2);
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%" AND registeredamendment.category = "Secondary" AND registeredamendment.type LIKE "'.$type_of_cooperative.'%"');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    } else if($area_of_operation == 'National'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.id','inner');
        $this->db->where('registeredamendment.category = "Secondary" AND (amend_coop.status IS NULL OR amend_coop.status = 15) AND registeredamendment.type != "Union"');
        // $this->db->limit('10');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
        }
    }
    public function add_amendment_affiliators($data){
         $data= $this->security->xss_clean($data);
        $this->db->trans_begin();
        $this->db->insert('amendment_affiliators',$data);
         if($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return false;
            }else{
              $this->db->trans_commit();
              return true;
            }
    }
    
    public function existing_amendment_affiliators($user_id,$registeredno){
        $this->db->select('*');
        $this->db->from('amendment_affiliators');
        $this->db->where('user_id = '.$user_id.' AND regNo ="'.$registeredno.'"');
//        $query = $this->db->get();
        $data = $this->db->count_all_results();
        return $data;
    }
    
    // public function get_applied_coop($user_id){
    //     $this->db->select("amendment_affiliators.*, amendment_affiliators.id AS aff_id, registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
    //     $this->db->from('amendment_affiliators');
    //     $this->db->join('amend_coop', 'amendment_affiliators.cooperative_id = amend_coop.id','left');
    //     $this->db->join('registeredamendment','registeredamendment.id = amendment_affiliators.registeredamendment_id','right');
    //     $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredamendment.addrCode','left');
    //     $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    //     $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    //     $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    //     $this->db->where('user_id ='.$user_id);
    //     $query = $this->db->get();
    //     $data = $query->result_array();
    //     return $data;
    // }

    public function get_applied_coop2($user_id){
        $this->db->select("amendment_affiliators.*, amendment_affiliators.id AS aff_id, registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region");
        // $this->db->from('"amendment_affiliators"');
        $this->db->join('amend_coop', 'amendment_affiliators.cooperative_id = amend_coop.id','left');
        $this->db->join('registeredamendment','registeredamendment.id = amendment_affiliators.registeredamendment_id','right');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredamendment.addrCode','left');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
        $this->db->where('user_id ='.$user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function get_applied_coop_for_committees($user_id){
        $this->db->select('cooperative_id');
        $this->db->from('amendment_affiliators');
        $this->db->where('user_id ='.$user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
      public function delete_amendment_affiliators($data){
    $this->db->trans_begin();
    $this->db->delete('amendment_affiliators',array('id' => $data));
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }

    }
    
    public function is_requirements_complete($amend_coop_id){
       $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        if($this->check_no_of_directors($this->amendment_fed_id) && $this->check_chairperson($this->amendment_fed_id) && $this->check_vicechairperson($this->amendment_fed_id) && $this->check_treasurer($this->amendment_fed_id) && $this->check_secretary($this->amendment_fed_id) && $this->check_directors_odd_number($this->amendment_fed_id)){
            return $this->check_all_minimum_regular_subscription($this->amendment_fed_id);
            $this->check_all_minimum_regular_pay($this->amendment_fed_id); 
            $this->check_regular_total_shares_paid_is_correct($this->get_total_regular($this->amendment_fed_id));
            // if($this->check_all_minimum_regular_subscription($this->amendment_fed_id) && $this->check_all_minimum_regular_pay($this->amendment_fed_id) && $this->check_regular_total_shares_paid_is_correct($this->get_total_regular($this->amendment_fed_id))){
            //     return true;
            // }else{
            //   return false;
            // }
        } else {
            return false;
        }
    }
    
    public function check_no_of_directors($amend_coop_id){
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amendment_fed_id',$amend_coop_id);
        $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Board of Director%")');
        $this->db->from('amendment_affiliators');
        if($this->db->count_all_results()>=5 && $this->db->count_all_results()<=15){
          return true;
        }else{
          return false;
        }
    }

    public function check_directors_odd_number($amend_coop_id){
         $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Board of Director%")');
        $this->db->from('amendment_affiliators');
        $count = $this->db->count_all_results();
        unset($amend_coop_id);
        if($count%2==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_chairperson($amend_coop_id){
        $position = array('Chairperson');
       $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        $this->db->where('position LIKE "Chairperson%"');
        $this->db->from('amendment_affiliators');
         unset($amend_coop_id);
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_vicechairperson($amend_coop_id){
        $position = array('Vice-Chairperson');
        $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        $this->db->where('position LIKE "Vice-Chairperson%"');
        $this->db->from('amendment_affiliators');
        unset($amend_coop_id);
        if($this->db->count_all_results()>0){
          return true;
        }else{
          return false;
        }
    }

    public function check_treasurer($amend_coop_id){
        $position = array('Treasurer');
       $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        $this->db->where('(position LIKE "Treasurer%" OR position LIKE "%Treasurer")');
        $this->db->from('amendment_affiliators');
        unset($amend_coop_id);
        if($this->db->count_all_results()>0){
          return true;
        }else{
          return false;
        }
    }

    public function check_secretary($amend_coop_id){
        $position = array('Secretary');
        $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amendment_fed_id',$this->amendment_fed_id);
        $this->db->where('(position LIKE "Secretary%" OR position LIKE "%Secretary")');
        $this->db->from('amendment_affiliators');
        unset($amend_coop_id);
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_all_minimum_regular_subscription($amend_coop_id){
        $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
       
    //    $temp = $this->bylaw_model->get_bylaw_by_coop_id($amend_coop_id)->regular_percentage_shares_subscription;
        
        // if($user_id == 0){
        //     $temp = 0;
        // } else {
            $temp = $this->get_capitalization_by_coop_id($this->amendment_fed_id)->minimum_subscribed_share_regular;
        // }
        $this->db->where(array('amendment_fed_id'=>$this->amendment_fed_id));
        $this->db->where('number_of_subscribed_shares <', $temp);
        $this->db->from('amendment_affiliators');
        if($this->db->count_all_results()==0){
          return true;
        }else{
          return false;
        }
    }

    public function check_all_minimum_regular_pay($amend_coop_id){
        $this->amendment_fed_id= $this->security->xss_clean($amend_coop_id);
        // $user_id = $this->security->xss_clean($user_id);
    //    $temp = $this->bylaw_model->get_bylaw_by_coop_id($amend_coop_id)->regular_percentage_shares_pay;
        
        // if($user_id == 0){
        //     $temp = 0;
        // } else {
            $temp = $this->get_capitalization_by_coop_id($this->amendment_fed_id)->minimum_paid_up_share_regular;
        // }
        $this->db->where(array('amendment_fed_id'=>$this->amendment_fed_id));
        $this->db->where('number_of_paid_up_shares <', $temp);
        $this->db->from('amendment_affiliators');
        if($this->db->count_all_results()==0){
          return true;
        }else{
          return false;
        }
    }

    public function get_capitalization_by_coop_id($amendment_id){
        $this->amendment_fed_id = $this->security->xss_clean($amendment_id);
        unset($amendment_id);
        $query = $this->db->get_where('amendment_capitalization',array('amendment_id'=>$this->amendment_fed_id));
         if($query->num_rows()==1)
         {
            $this->data = $query->row();
            unset($query);
         }
         return $this->data;
    }

    public function check_regular_total_shares_paid_is_correct($data){
        $temp = $data;
    //    if($temp['total_paid'] >= ceil($temp['total_subscribed']*0.25)){
        if($temp['total_subscribed']== $temp['capitalization_no_of_subscribed'] && $temp['total_paid'] == $temp['capitalization_no_of_paid']){
          return true;
        }else{
          return false;
        }
    }

    public function is_requirements_complete_admin($user_id){
        $this->db->where('amendment_affiliators.user_id =',$user_id);
        $this->db->from('amendment_affiliators');
        $this->db->join('amend_coop','amendment_affiliators.users_id = amend_coop.users_id','inner');
        if($this->db->count_all_results()<=4){
          return false;
        }else{
          return true;
        }
    }

  public function get_all_amendment_affiliators_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->select('amendment_affiliators.*');
    $this->db->from('amendment_affiliators');
    $this->db->where('user_id', $amend_coop_id);
    $query=$this->db->get();
$this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }

  public function get_affiliator_info($amend_coop_id){
    $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
    $this->db->select('amendment_affiliators.*');
    $this->db->from('amendment_affiliators');
    $this->db->where('amendment_fed_id',  $this->amendment_fed_id);
    $query=$this->db->get();
    if($query->num_rows()>0)
    {
    return $query->row();
    }
    else
    {
        return null;
    }
  }

  public function get_total_regular($amend_coop_id){
    $this->amendment_fed_id = $this->security->xss_clean($amend_coop_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $this->db->from('amendment_affiliators');
    $this->db->where(array('amendment_fed_id' => $this->amendment_fed_id));
    unset($amend_coop_id);
    $query = $this->db->get();
    $data = $query->row();

    $query2 = $this->db->get_where('amendment_capitalization',array('amendment_id' => $this->amendment_fed_id));
    $capitalization_info = $query2->row();
    $capitalization_no_of_subscribed = 0;
    $capitalization_no_of_paid = 0;
    
    $totalSubscribed = 0;
    $totalPaid = 0;
    
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;

    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid, 'capitalization_no_of_subscribed'=>$capitalization_no_of_subscribed, 'capitalization_no_of_paid'=>$capitalization_no_of_paid);
  }

  public function coop_exist($amendment_fed_id,$regNo)
  {
    $query = $this->db->query("select id from amendment_affiliators where amendment_fed_id='$amendment_fed_id' AND  regNo='$regNo'");
    if($query->num_rows()==1)
    {
        return true;
    }
    else
    {
        return false;
    }
  }

  public function get_total_associate($amendment_feb_id){
    $this->amendment_feb_id = $this->security->xss_clean($amendment_feb_id);
    // $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->db->get_where('amendment_affiliators',array('amendment_fed_id'=>$amendment_id,'type_of_member'=>'Associate'));
    $data = $query->row();
    $query2 = $this->db->get_where('amendment_articles_of_cooperation',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }


  public function get_list_of_directors($amend_coop_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('user_id',$amend_coop_id);
    $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Board of Director%")');
    $query = $this->db->get('amendment_affiliators');
    $data = $query->result_array();
    return $data;
  }

  public function no_of_directors($amend_coop_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('amendment_fed_id',$amend_coop_id);
    $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Board of Director%")');
    $this->db->from('amendment_affiliators');
    return $this->db->count_all_results();
  }

  public function get_all_regular_cooperator_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->order_by('representative','asc');
    $query = $this->db->get_where('amendment_affiliators',array('user_id' => $amend_coop_id));
    $data = $query->result_array();
    return $data;
  }

  public function get_treasurer_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_affiliators','user_id = '.$amend_coop_id.' AND (position LIKE "Treasurer%" OR position LIKE "%Treasurer")');
    $this->db->from('amendment_affiliators');
    $data = $query->row();
    return $data;
  }

  public function get_all_cooperator_of_coop_regular($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->select('amendment_affiliators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amendment_affiliators');
    $this->db->join('refbrgy','refbrgy.brgycode=cooperators.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('type_of_member = "Regular" AND amend_coop_id = '.$amend_coop_id.'');
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
    // $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }

  public function is_position_available($user_id,$position){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($user_id));
    // echo print_r($position);
    // $count_temp = count($ajax['fieldValue']);
    // if(is_array($position)){
        // $position_imp = replace(', ', $position);
        $position_imp = str_replace('_', ', ', $position);
        $position_array = explode(', ',$position_imp);
        $and = array();
        if(count($position_array) > 1){
            foreach($position_array as $row){
                if($row == 'Treasurer'){
                    $row = '%'.$row;
                }
                if($row == 'Secretary'){
                    $row = '%'.$row;
                }
                $and[] = 'position LIKE "'.$row.'%" OR ';
            }
        } else {
            foreach($position_array as $row){
                if($row == 'Treasurer'){
                    $row = '%'.$row;
                }
                if($row == 'Secretary'){
                    $row = '%'.$row;
                }
                $and[] = 'position LIKE "'.$row.'%"';
            }
        }

        $or = implode(' ',$and);
        $or = rtrim($or," OR");

    $this->db->where('amend_coop_id',$decoded_id);
    $this->db->where('('.$or.')');
    $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Treasurer%" OR position LIKE "Secretary%")');
    $this->db->from('amendment_affiliators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($count,false);
    }else{
      return array($count,true);
    }
  }

  public function edit_is_position_available($user_id,$position,$cooperatorid){
    $decoded_id = $this->encryption->decrypt(decrypt_custom($user_id));
    $cooperator_id = $this->encryption->decrypt(decrypt_custom($cooperatorid));

    $position_imp = str_replace('_', ', ', $position);
        $position_array = explode(', ',$position_imp);
        $and = array();
        if(count($position_array) > 1){
            foreach($position_array as $row){
                if($row == 'Treasurer'){
                    $row = '%'.$row;
                }
                if($row == 'Secretary'){
                    $row = '%'.$row;
                }
                $and[] = 'position LIKE "'.$row.'%" OR ';
            }
        } else {
            foreach($position_array as $row){
                if($row == 'Treasurer'){
                    $row = '%'.$row;
                }
                if($row == 'Secretary'){
                    $row = '%'.$row;
                }
                $and[] = 'position LIKE "'.$row.'%"';
            }
        }

        $or = implode(' ',$and);
        $or = rtrim($or," OR");

    $this->db->where('amend_coop_id',$decoded_id);
    $this->db->where('id !=',$cooperator_id);
    $this->db->where('('.$or.')');
    $this->db->where('(position LIKE "Chairperson%" OR position LIKE "Vice-Chairperson%" OR position LIKE "Treasurer%" OR position LIKE "Secretary%")');
    $this->db->from('amendment_affiliators');
    $count = $this->db->count_all_results();
    if($count==0){
      return array($this->db->last_query(),false);
    }else{
      return array($this->db->last_query(),true);
    }
  }

  public function get_total_number_of_cooperators($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('user_id',$amend_coop_id);
    $this->db->from('amendment_affiliators');
    return $this->db->count_all_results();
  }

  public function get_all_board_of_director_only($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_affiliators','user_id = '.$amend_coop_id.' AND (position LIKE "Board of Director%" OR position LIKE "%Board of Director")');
    $data = $query->result_array();
    return  $data;
  }

  public function get_chairperson_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_affiliators','user_id = '.$amend_coop_id.' AND (position LIKE "Chairperson%" OR position LIKE "%Chairperson")');
    $data = $query->row();
    return $data;
  }

  public function get_vicechairperson_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_affiliators','user_id = '.$amend_coop_id.' AND (position LIKE "Vice-Chairperson%" OR position LIKE "%Vice-Chairperson")');
    // 'user_id = '.$amend_coop_id.' AND (position LIKE "Treasurer%" OR position LIKE "%Treasurer")'
    $data = $query->row();
    return $data;
  }
}
