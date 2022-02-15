<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperatives_update_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function get_regno_by_coop($coop_id,$user_id)
  {

  }

  public function get_regno_by_user_id($user_id)
  {
    // $data = null;
    $query = $this->db->query("select regno from users where id='$user_id'");
    return $query->row();
  }

  public function get_coop_info($regNo)
  {
    $this->db->select('cooperatives.*,registeredcoop.Street as reg_street');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id');
    $this->db->where(array('registeredcoop.regNo'=>$regNo));
    $query = $this->db->get();
    return $query->row();
  }

  //if have address code
  public function get_cooperative_info($coop_id){
    $this->db->select('cooperatives.*, cooperatives.category_of_cooperative as cofc, refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province,refregion.regCode as rCode, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->where(array('cooperatives.id'=>$coop_id));
    $query = $this->db->get();
    return $query->row();
  }


  public function get_all_major_industry($coop_id){
    // $this->db->distinct();
    $this->db->select('major_industry.id,major_industry.description');
    $this->db->from('business_activities_cooperative');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_business_activities($coop_id){
    $this->db->select('industry_subclass_by_coop_type.cooperative_type_id,major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
    $this->db->from('business_activities_cooperative');
    $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
    $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
    $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
    $this->db->where('business_activities_cooperative.cooperatives_id',$coop_id);
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
  public function get_coop_composition($id){
    $this->db->select('composition_of_members.composition');
    $this->db->from('members_composition_of_cooperative');
    $this->db->join('composition_of_members','members_composition_of_cooperative.composition=composition_of_members.id','inner');
    $this->db->where('members_composition_of_cooperative.coop_id',$id);
    $query = $this->db->get();

    return $query->result_array();
  }

   public function get_composition(){
    $this->db->from('composition_of_members');
    $this->db->order_by('composition ASC');
    $query = $this->db->get();

    return $query->result();
  }

  public function approve_by_senior($admin_info,$coop_id,$coop_full_name,$comment_by_specialist_senior){
  $coop_id = $this->security->xss_clean($coop_id);
  $comment_by_specialist_senior = $this->security->xss_clean($comment_by_specialist_senior);
  $now = date('Y-m-d H:i:s');
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  $this->db->update('cooperatives',array('status'=>39,'second_evaluated_by'=>$admin_info->id,'evaluation_comment'=>NULL,'comment_by_senior'=>$comment_by_specialist_senior,'senior_submit_at'=>$now));
  $director_emails = $this->admin_model->get_emails_of_director_by_region($admin_info->region_code);
    foreach($director_emails as $email){
      if($email['is_director_active'] == 0){
        $director_emails = $this->admin_model->get_emails_of_revoke_director_by_region($admin_info->region_code);
      }
    }
  
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    // if($this->admin_model->sendEmailToAdmins($admin_info,$director_emails,$coop_full_name)){
      $this->db->trans_commit();
      return true;
    // }else{
    //   $this->db->trans_rollback();
    //   return false;
    // }
  }
}

  public function update_cooperative($coop_id,$data,$major_industry,$subtypes_array,$members_composition)
  {
    $data = $this->security->xss_clean($data);
    $major_industry = $this->security->xss_clean($major_industry);
    $subtypes_array = $this->security->xss_clean($subtypes_array);
    $batch_subtype = array();
    $this->db->select('name');
    $this->db->where('id',$data['type_of_cooperative']);
    $this->db->from('cooperative_type');
    $query2 = $this->db->get();
    $coop_type = $query2->row();
    $cooperative_type_id = $data['type_of_cooperative'];
    $data['type_of_cooperative'] = $coop_type->name;
    $this->db->trans_begin();
    $this->db->update('cooperatives',$data,array('id'=>$coop_id));
    
     

      $this->db->select('id');
      $this->db->where(array('cooperative_type_id'=>$cooperative_type_id));
      $this->db->where_in('major_industry_id',$major_industry);
      $this->db->where_in('subclass_id',$subtypes_array);
      $this->db->from('industry_subclass_by_coop_type');
      $query = $this->db->get();
      $industry_subclasses_id_array = $query->result_array();
        // return $this->db->last_query();
       if(count($industry_subclasses_id_array)!=0){
        $this->db->delete('business_activities_cooperative',array('cooperatives_id'=>$coop_id));
        foreach($industry_subclasses_id_array as $industry_subclasses_id){
          array_push($batch_subtype, array(
            'cooperatives_id'=> $coop_id,
            'industry_subclass_by_coop_type_id'=>$industry_subclasses_id['id'])
          );
        }
        $this->db->insert_batch('business_activities_cooperative', $batch_subtype);
      }

    // }
     if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }  

  public function defer_by_admin($admin_id,$coop_id,$reason_commment,$step){
  
  $this->db->trans_begin();
  $this->db->where('id',$coop_id);
  if ($step==1)
    $this->db->update('cooperatives',array('evaluated_by'=>$admin_id,'status'=>5,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else if($step==2)
    $this->db->update('cooperatives',array('second_evaluated_by'=>$admin_id,'status'=>41,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  else 
    $this->db->update('cooperatives',array('third_evaluated_by'=>$admin_id,'status'=>11,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(15*24*60*60))),'evaluation_comment'=>$reason_commment,'temp_evaluation_comment'=>$reason_commment));
  if($this->db->trans_status() === FALSE){
    $this->db->trans_rollback();
    return false;
  }else{
    if ($step==3){
      $this->db->select('cooperatives.proposed_name, cooperatives.type_of_cooperative, cooperatives.grouping, users.*');
      $this->db->from('cooperatives');
      $this->db->join('users' , 'users.id = cooperatives.users_id','inner');
      $this->db->where('cooperatives.id', $coop_id);
      $query = $this->db->get();
      $client_info = $query->row();
      $full_name= $client_info->first_name.' '.$client_info->last_name; // modified by json
      // if($this->admin_model->sendEmailToClientDefer($full_name, $client_info->proposed_name.' '.$client_info->type_of_cooperative.' Cooperative '.$client_info->grouping ,$client_info->email, $reason_commment)){
        $this->db->trans_commit();
        return true;
      // }else{
      //   $this->db->trans_rollback();
      //   return false;
      // }
    }else{
      $this->db->trans_commit();
      return true;
    }
  }
}

  public function check_date_registered($coop_id)
  {
    $query = $this->db->query("select application_id,dateRegistered from registeredcoop where application_id = '$coop_id' and  dateRegistered >='2020-09-30'");
    if($query->num_rows()==1)
    {
      return false;
    }
    else
    {
      return true;
    }

  }

  public function get_all_cooperatives_registration($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $this->db->query('set session sql_mode = (select replace(@@sql_mode,"ONLY_FULL_GROUP_BY", ""))');
    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('registeredcoop.*,cooperatives.*,payment.date_of_or, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('registeredcoop', 'registeredcoop.application_id = cooperatives.id','inner');
    $this->db->join('payment', 'registeredcoop.coopName = payment.payor','left');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('cooperatives.status = 39 AND cooperatives.type_of_cooperative NOT IN ('.$typeofcoopimp.')');
    $this->db->order_by('regNo', 'ASC');
    $this->db->group_by('coopName');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function check_if_denied($coop_id){
    $query = $this->db->get_where('cooperatives',array('id'=>$coop_id));
    $data = $query->row();
    $coop_status = $data->status;
    if($coop_status==41){
      return true;
    }else{
      return false;
    }
  }

  public function insert_comment_history($data_field){
        $this->db->trans_begin();
        $this->db->insert('cooperatives_comment',$data_field);
        $id = $this->db->insert_id();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
  }

  public function get_provinces($regCode){
    $this->db->select('provDesc,provCode,regCode');
    $this->db->where(array('regCode'=>$regCode));
    $query = $this->db->get('refprovince');
    return $query->result_array();
  }
  public function get_cities($provCode){
    $this->db->select('citymunDesc,citymunCode,provCode,regCode');
    $this->db->where(array('provCode'=>$provCode));
    $query = $this->db->get('refcitymun');
    return $query->result_array();
  }
   public function get_brgys($cityCode){
    $this->db->select('brgyCode,brgyDesc,citymunCode,provCode');
     // $this->db->select('brgyCode,brgyDesc');
    $this->db->where(array('citymunCode'=>$cityCode));
    $query = $this->db->get('refbrgy');
    return $query->result_array();
  }

  public function submit_for_evaluation($user_id,$coop_id){
    $user_id = $this->security->xss_clean($user_id);
    $coop_id = $this->security->xss_clean($coop_id);
    $this->db->trans_begin();
    $this->db->where(array('users_id'=>$user_id,'id'=>$coop_id));
    $this->db->update('cooperatives',array('status'=>40,'expire_at'=>date('Y-m-d h:i:s',(now('Asia/Manila')+(30*24*60*60)))));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    }
  }

  public function get_all_updated_coop_info($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status = 40');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

  public function get_all_cooperatives_by_senior_defer_deny($regcode){
    // Get Coop Type for HO
    $this->db->select('name');
    $this->db->from('head_office_coop_type');
    $query = $this->db->get();
    $typeofcoop = $query->result_array();
    foreach($typeofcoop as $typesofcoop){
      $cooparray[] = $typesofcoop['name'];
    }

    $typeofcoopimp = '"' . implode ( '", "', $cooparray ) . '"';
    // End Get Coop Type for HO
    $this->db->select('cooperatives.*, refbrgy.brgyDesc as brgy, refcitymun.citymunDesc as city, refprovince.provDesc as province, refregion.regDesc as region');
    $this->db->from('cooperatives');
    $this->db->join('refbrgy' , 'refbrgy.brgyCode = cooperatives.refbrgy_brgyCode','inner');
    $this->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','inner');
    $this->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','inner');
    $this->db->join('refregion', 'refregion.regCode = refprovince.regCode','inner');
    $this->db->like('refregion.regCode', $regcode);
    $this->db->where('status = 41');
    // $this->db->where_in('status',array('2','3','4','5','6','12','13','14','16'));
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }

 } 