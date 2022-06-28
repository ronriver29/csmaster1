<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_union_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
 
  public function get_registered_coop($area_of_operation,$addresscode,$type_of_cooperative,$regNo,$coopName){
    $AmendmentName = (strlen($coopName)>0 ? " AND registeredamendment.coopName like '$coopName%'" : "");
    $AmendmentregNo=(strlen($regNo)>0 ? " AND amend_coop.regNo='$regNo'" : "");
    $CoopName = (strlen($coopName)>0 ? " AND registeredcoop.coopName like '%$coopName%'" : "");
    $CoopregNo=(strlen($regNo)>0 ? " AND registeredcoop.regNo='$regNo'" : "");
    $regNoamd=(strlen($regNo)>0 ? " AND registeredamendment.regNo='$regNo'" : "");
    $data=[];  
    if($area_of_operation == 'Barangay'){
        $this->db->select('regNo,migrated');
        $this->db->from('registeredamendment');
        $this->db->where("addrCode LIKE '".$addresscode."'%".$AmendmentName.$regNoamd);
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id, amend_coop.common_bond_of_membership, amend_coop.regNo,amend_coop.house_blk_no,amend_coop.street, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['types'] = 'amendment';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry = $this->db->get();
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
 
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['types'] = 'cooperative';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id, amend_coop.common_bond_of_membership, amend_coop.regNo,amend_coop.house_blk_no,amend_coop.street, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['types'] = 'amendment';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry = $this->db->get();
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
 
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['types'] = 'cooperative';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id, amend_coop.common_bond_of_membership, amend_coop.regNo,amend_coop.house_blk_no,amend_coop.street, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['types'] = 'amendment';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry = $this->db->get();
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
 
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['types'] = 'cooperative';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id, amend_coop.common_bond_of_membership, amend_coop.regNo,amend_coop.house_blk_no,amend_coop.street, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 41 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['types'] = 'amendment';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry = $this->db->get();
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
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39) AND registeredcoop.addrCode LIKE "'.$addresscode.'%"'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['types'] = 'cooperative';
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
        $this->db->where("coopName like '$coopName%'".$regNoamd);
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName,registeredamendment.dateRegistered,registeredamendment.type,registeredamendment.amendment_id, amend_coop.common_bond_of_membership, amend_coop.regNo,amend_coop.house_blk_no,amend_coop.street, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 41'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry =$this->db->get();
                    if($updated_amendment_qry->num_rows()==1)
                    {   
                        foreach($updated_amendment_qry->result_array() as $row)
                        {
                            $row['types'] = 'amendment';
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
                    $this->db->select('registeredamendment.id as registered_id,registeredamendment.coopName, amend_coop.regNo, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
                    $this->db->from('amend_coop');
                    $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
                    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
                    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
                    $this->db->join('registeredamendment','registeredamendment.amendment_id = amend_coop.id','inner');
                    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
                    $this->db->where('amend_coop.status = 15'.$AmendmentName.$AmendmentregNo);
                    $updated_amendment_qry = $this->db->get();
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
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status IN (15,39)'.$CoopName.$CoopregNo);
            $this->db->order_by('cooperatives.id','ASC');
            $this->db->limit(1);
            $coop_info = $this->db->get();
                if($coop_info->num_rows()==1)
                {
                    foreach($coop_info->result_array() as $row)
                        {
                            $row['types'] = 'cooperative';
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
        unset($AmendmentName);
        unset($AmendmentregNo);
        unset($CoopregNo);
        unset($CoopName);
        unset($regNoamd);
        return $data;}
    }

    public function registered_coop_count($area_of_operation,$addresscode,$type_of_cooperative,$coopName,$regNo){
        $coopName = (strlen($coopName)>0 ? " AND registeredcoop.coopName like '%".$coopName."%'" : '');
      $regNo = (strlen($regNo)>0 ? " AND registeredcoop.regNo='$regNo'"  : '');    

        if($area_of_operation == 'Regional')
        {
            $addresscode = substr($addresscode, 0, 2);
            $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
            $this->db->from('cooperatives');
            $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
            $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
            $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
            $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
            $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
            $this->db->where('cooperatives.status = 15 AND addrCode LIKE "'.$addresscode.'%"'.$coopName.$regNo);
           
        }
        return  $this->db->count_all_results();
    }    

    public function get_registered_interregion($regions){
      // if($area_of_operation == 'Interregional'){
        $this->db->select('registeredamendment.*, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        $this->db->from('amend_coop');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        $this->db->join('registeredamendment','registeredamendment.cooperative_id = amend_coop.cooperative_id','inner');
        $this->db->where('(amend_coop.status = 15) AND refregion.regCode IN ('.$regions.')');
        $this->db->group_by('registeredamendment.regNo');
        $this->db->order_by('registeredamendment.id','desc');
        $query = $this->db->get();
        $data1 = $query->result_array();

        //  $this->db->select('registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
        // $this->db->from('cooperatives');
        // $this->db->join('refbrgy' , 'refbrgy.brgyCode = amend_coop.refbrgy_brgyCode','inner');
        // $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
        // $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
        // $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
        // $this->db->join('registeredcoop','registeredcoop.application_id = cooperatives.id','inner');
        // $this->db->where('(cooperatives.status = 15) AND refregion.regCode IN ('.$regions.') AND registeredcoop.dateRegistered >=DATE("2020-09-30")');
        // $this->db->group_by('registeredcoop.regNo');
        // $this->db->order_by('registeredcoop.id','desc');
        // $query2 = $this->db->get();


        // $data =null;
        // if($query2->num_rows()>0)
        // {
        //   $data12= $query2->result_array();
        //   $data =array_merge($data1,$data2); 
        // }
        
        return $data1;
        // }
    }


    public function add_amendment_unioncoop($data){
        $this->db->insert('amendment_unioncoop',$data);
    }
    
    public function existing_amendment_unioncoop($amd_union_id,$registeredno){
        $this->db->select('*');
        $this->db->from('amendment_unioncoop');
        $this->db->where('amd_union_id = '.$amd_union_id.' AND regNo ="'.$registeredno.'"');
//        $query = $this->db->get();
        $data = $this->db->count_all_results();
        return $data;
    }
    
     public function existing_unioncoop($amd_union_id,$registeredno){
        $this->db->select('*');
        $this->db->from('amendment_unioncoop');
        $this->db->where('amd_union_id = '.$amd_union_id.' AND regNo ="'.$registeredno.'"');
//        $query = $this->db->get();
        $data = $this->db->count_all_results();
        return $data;
    }

    public function get_applied_coop($amd_union_id){
        $this->db->select('amendment_unioncoop.*,amendment_unioncoop.capital_contribution as cc, amendment_unioncoop.id AS aff_id, registeredcoop.*, registeredcoop.id as registered_id, cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredcoop.coopName');
        $this->db->from('amendment_unioncoop');
        $this->db->join('cooperatives', 'amendment_unioncoop.cooperative_id = cooperatives.id','left');
        $this->db->join('registeredcoop','registeredcoop.id = amendment_unioncoop.registeredcoop_id','right');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredcoop.addrCode','left');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
        // $this->db->where('amd_union_id ='.$amd_union_id);  
         $this->db->where('amendment_unioncoop.amd_union_id ='.$amd_union_id);
        $query1 = $this->db->get();
        $data1 = $query1->result_array();
        unset($query1);
        $this->db->select('amendment_unioncoop.*, amendment_unioncoop.capital_contribution as cc, amendment_unioncoop.id AS aff_id, registeredamendment.type as typecoop,registeredamendment.dateRegistered, registeredamendment.id as registered_id, amend_coop.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region,registeredamendment.coopName');
        $this->db->from('amendment_unioncoop');
        $this->db->join('amend_coop', 'amendment_unioncoop.amendment_id = amend_coop.id','left');
        $this->db->join('registeredamendment','registeredamendment.id = amendment_unioncoop.reg_amendment_id','right');
        $this->db->join('refbrgy' , 'refbrgy.brgyCode = registeredamendment.addrCode','left');
        $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
        $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
        $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
        // $this->db->where('amd_union_id ='.$amd_union_id);
        $this->db->where('amendment_unioncoop.amd_union_id ='.$amd_union_id);
        $query2 = $this->db->get();
        $data2 = $query2->result_array();
        unset($query2);
        return array_merge($data1,$data2);
    }
    
    public function get_applied_coop_for_committees($amd_union_id){
        $this->db->select('amendment_id');
        $this->db->from('amendment_unioncoop');
        $this->db->where('amd_union_id ='.$amd_union_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function delete_affiliators($data){
    $this->db->trans_begin();
    $this->db->delete('amendment_unioncoop',array('id' => $data));
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          return true;
        }

    }
    
    public function is_requirements_complete($amendment_id){
      // $this->db->where('amd_union_id =',$amd_union_id);
      // $this->db->from('amendment_unioncoop');

      if($this->check_no_of_directors($amendment_id) && $this->check_chairperson($amendment_id) && $this->check_vicechairperson($amendment_id) && $this->check_treasurer($amendment_id) && $this->check_secretary($$amendment_id) && $this->check_directors_odd_number($amendment_id)){
            if($this->check_total_coop($amendment_id)){
                return true;
            }else{
              return false;
            }
        } else {
            return false;
        }
      // $this->db->where('amd_union_id =',$amd_union_id);
      // $this->db->from('amendment_unioncoop');
      // if($this->db->count_all_results()<=9){
      //   return false;
      // }else{
      //   return true;
      // }
    }
    
    public function check_total_coop($amd_union_id){
        $this->db->where('amd_union_id =',$amd_union_id);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()>=10 && $this->db->count_all_results()<=15){
          return true;
        }else{
          return false;
        }
    }

    public function check_no_of_directors($amend_coop_id){
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()>=5 && $this->db->count_all_results()<=15){
          return true;
        }else{
          return false;
        }
    }

    public function check_directors_odd_number($amend_coop_id){
        $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        $count = $this->db->count_all_results();
        if($count%2==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_chairperson($amend_coop_id){
        $position = array('Chairperson');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_vicechairperson($amend_coop_id){
        $position = array('Vice-Chairperson');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_treasurer($amend_coop_id){
        $position = array('Treasurer');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function check_secretary($amend_coop_id){
        $position = array('Secretary');
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->where('amd_union_id',$amend_coop_id);
        $this->db->where_in('position', $position);
        $this->db->from('amendment_unioncoop');
        if($this->db->count_all_results()==1){
          return true;
        }else{
          return false;
        }
    }

    public function is_requirements_complete_admin($amd_union_id){
    $this->db->where('affiliators.amd_union_id =',$amd_union_id);
    $this->db->from('affiliators');
    $this->db->join('amend_coop','affiliators.users_id = amend_coop.users_id','inner');
    if($this->db->count_all_results()<=4){
      return false;
    }else{
      return true;
    }
  }

  public function get_all_cooperator_of_coop($amend_coop_id){
        $amend_coop_id = $this->security->xss_clean($amend_coop_id);
        $this->db->select('amendment_unioncoop.*');
        $this->db->from('amendment_unioncoop');
        $this->db->where('amd_union_id', $amend_coop_id);
        $this->db->order_by('representative','asc');
        $query=$this->db->get();
        // $this->last_query = $this->db->last_query();
        $data = $query->result_array();
        unset($query);
        return $data;
      }

  public function get_all_cooperator_of_coop_regular($amendment_id,$limit,$start){
    $data=null;
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->limit($limit, $start);
    $this->db->select('amendment_unioncoop.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('amendment_unioncoop');
    $this->db->join('refbrgy','refbrgy.brgycode=amendment_unioncoop.addrCode','left');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->db->where('type_of_member = "Regular" AND amendment_id='.$amendment_id);
    $this->db->order_by('full_name','asc');
    $query=$this->db->get();
// $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    unset($query);
    return $data;
  }

  public function no_of_directors($amend_coop_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('amd_union_id',$amend_coop_id);
    $this->db->where_in('position', $position);
    $this->db->from('amendment_unioncoop');
    unset($position);
    return $this->db->count_all_results();
  }

  public function get_list_of_directors($amend_coop_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('amd_union_id',$amend_coop_id);
    $this->db->where_in('position', $position);
    $query = $this->db->get('amendment_unioncoop');
    $data = $query->result_array();
    unset($query);
    unset($amend_coop_id);
    return $data;
  }

  public function get_treasurer_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amend_coop_id,'position'=>'Treasurer'));
    $data = $query->row();
    unset($amend_coop_id);
    unset($query);
    return $data;
  }

  public function get_total_cc($amendment_id){
    $amendment_id = $this->security->xss_clean($amendment_id);
    $this->db->select('SUM(capital_contribution) as total_cc');
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amendment_id));
    $data = $query->row();
    unset($amendment_id);
    unset($query);
    return $data;
  }
    public function add_unioncoop($data){
      // $this->db->trans_begin();
        if($this->db->insert('amendment_unioncoop',$data))
        {
            unset($data);
          return true;
        }
        else
        {
            unset($data);
          return false;
        }
    }
  public function get_total_number_of_cooperators($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $this->db->where('amd_union_id',$amend_coop_id);
    $this->db->from('amendment_unioncoop');
    unset($amend_coop_id);
    return $this->db->count_all_results();
  }

  public function get_total_regular($amd_union_id,$amend_coop_id){
    $amd_union_id = $this->security->xss_clean($amd_union_id);
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);

    $this->db->select('SUM(capital_contribution) as total_cc');
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amd_union_id));
    $data = $query->row();

    // print_r($data);
    //    $query2 = $this->db->get_where('articles_of_cooperation',array('amend_coop_id' => $amend_coop_id));
//    $article = $query2->row();
    $query2 = $this->db->get_where('capitalization',array('amend_coop_id' => $amend_coop_id));
    $capitalization_info = $query2->row();
    $capitalization_no_of_subscribed = 0;
    $capitalization_no_of_paid = 0;
    
    // Jiee
        $this->db->where(array('amend_coop_id' => $amend_coop_id));
        $this->db->from('capitalization');
        if($this->db->count_all_results()==0){
          $capitalization_no_of_subscribed = 0;
        $capitalization_no_of_paid = 0;
        }else{
          $capitalization_no_of_subscribed = $capitalization_info->total_no_of_subscribed_capital;
        $capitalization_no_of_paid = $capitalization_info->total_no_of_paid_up_capital;
        }
    //
    
    $totalSubscribed = 0;
    $totalcc = 0;
    
    $totalcc = ($data->total_cc==null) ? 0 : $data->total_cc;
    unset($amend_coop_id);
    unset($query);
    unset($query2);
    unset($amd_union_id);
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalcc, 'capitalization_no_of_subscribed'=>$capitalization_no_of_subscribed, 'capitalization_no_of_paid'=>$capitalization_no_of_paid);
  }

  public function get_chairperson_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amend_coop_id,'position'=>'Chairperson'));
    $data = $query->row();
    unset($amend_coop_id);
    unset($query);
    return $data;
  }

  public function get_vicechairperson_of_coop($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amend_coop_id,'position'=>'Vice-Chairperson'));
    $data = $query->row();
    unset($amend_coop_id);
    unset($query);
    return $data;
  }

  public function get_all_board_of_director_only($amend_coop_id){
    $amend_coop_id = $this->security->xss_clean($amend_coop_id);
    $query = $this->db->get_where('amendment_unioncoop',array('amd_union_id' => $amend_coop_id,'position'=>'Board of Director'));
    $data = $query->result_array();
    unset($amend_coop_id);
    unset($query);
    return  $data;
  }

}
