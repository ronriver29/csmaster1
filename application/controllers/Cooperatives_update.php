<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cooperatives_update extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->library('pdf');
      //Codeigniter : Write Less Do More
    }

    public function index(){
      
    }
    public function update(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client') || !$this->session->userdata('client')){
          if(!isset($_POST['reserveUpdateBtn']))
          {
            $data['title'] = 'Update Cooperative Details';
            $data['client_info'] = $this->user_model->get_user_info($user_id);
            $data['header'] = 'Update Cooperative Information';
            // $data['regNo']  = $cooperatives_update_model->get_regno_by_user_id($user_id);
            $data['coop_info'] = $this->cooperatives_update_model->get_coop_info($data['client_info']->regno);
            $data['coop_info2'] = $this->cooperatives_update_model->get_cooperative_info($data['coop_info']->id);
            if(isset($data['coop_info2']))
            {
            $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info2']->rCode);
            $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info2']->pCode);
            $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info2']->cCode);
            }
            $data['encrypted_id'] =encrypt_custom($this->encryption->encrypt($data['coop_info']->id));
            // $data['major_industry_list'] = $this->cooperatives_update_model->get_all_major_industry($data['coop_info']->id);
            $data['business_activity'] = $this->cooperatives_update_model->get_all_business_activities($data['coop_info']->id);
            $major_industry_id = '';
            $cooperative_type_id='';
            if(count($data['business_activity'])>0)
            {
              foreach($data['business_activity'] as $business_dtl)
              {
                $major_industry_id = $business_dtl['bactivity_id'];
                $cooperative_type_id = $business_dtl['cooperative_type_id'];
              }
            }
            $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
            $data['major_industries_subclass'] = $this->industry_subclass_model->get_industry_subclasses($cooperative_type_id,$major_industry_id);
            $this->industry_subclass_model->get_industry_subclasses_amendmnet($major_industry_id); 
            $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
            $data['composition']= $this->cooperatives_update_model->get_composition();
            $data['members_composition'] = $this->cooperatives_update_model->get_coop_composition($data['coop_info']->id);
            
            if($data['coop_info']->area_of_operation == 'Interregional'){
                $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
            } else {
              $data['regions_list'] = $this->region_model->get_regions();
            }
         
            if($data['coop_info']->area_of_operation == 'Interregional'){
                $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);
            }
            
            // $check_if_ecoopris = $this->cooperatives_update_model->check_date_registered($data['coop_info']->id);
            $this->load->view('template/header', $data);
            $this->load->view('update/update_cooperative_detail');
            $this->load->view('template/footer');
          }
          else
          {
                   $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
                    if ($this->input->post('categoryOfCooperative')=='Primary'){
                      $category ='Primary';
                      $group='';
                    }else{
                      $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                      $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                    }
                
                    $name_of_ins_assoc = array_filter($this->input->post('name_institution'));
                    if(count($name_of_ins_assoc)>0 )
                    {
                        $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));
                    }
                    else
                    {
                        $name_of_ins_assoc='';
                    }
                    if(!empty($this->input->post('interregional'))){
                      $interregional = implode(", ",$this->input->post('interregional'));
                      $regions = implode(", ",$this->input->post('regions'));
                    } else {
                      $interregional = '';
                      $regions = '';
                    }
                    $id =  $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $field_data = array(
                      'users_id' => $this->session->userdata('user_id'),
                      'category_of_cooperative' => $category,
                      'proposed_name' => $this->input->post('proposedName'),
                      'acronym_name' => $this->input->post('acronym_name'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                      'grouping' => $group,
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'field_of_membership' => $this->input->post('field_membership'),
                      'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'interregional' => $interregional,
                      'regions' => $regions,
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo')
                    );
                    // $this->debug($field_data);
                    // var_dump( $this->cooperatives_update_model->update_cooperative($id,$field_data,$major_industry,$subclass_array,$members_composition));
                if($this->cooperatives_update_model->update_cooperative($id,$field_data,$major_industry,$subclass_array,$members_composition)){
                   // $this->session->set_flashdata('cooperative_update_success', 'Successfully updated basic information.');
                    $this->session->set_flashdata(array('msg_class'=>'success','cooperative_update_msg'=>'Successfully updated basic information.'));
                  redirect('cooperatives_update/update');
                }else{
                  $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                  redirect('cooperatives_update/update');
                }
          }  
        }else{
        
        }
      }
    }

    public function get_business_activities_of_coop(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->cooperatives_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    
    public function cooperative_type_ajax()
    {
      // $this->db->order_by("name", "asc");
      // $qry = $this->db->get('cooperative_type');
      // if($qry->num_rows()>0)
      // {
      //   foreach($qry->result_array() as $row)
      //   {
      //     $data[] = $row;
      //   }
      // }
      // echo json_encode($data);
      $category =  $this->input->post('category');
      if($category == 'Primary')
      { 
        $except_type = array('Bank','Insurance','Multi-Purpose','Federation','Union');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      elseif($category == 'Secondary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      elseif($category == 'Tertiary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      else
      {
        $except_type = array('Bank','Insurance','Union');
        $this->db->select('*');
        $this->db->where_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      
    }
    //END AJAX REQUEST

    public function rupdate($id = null){

      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              // if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                if(!isset($_POST['reserveUpdateBtn'])){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 

                  // $data['members_composition'] = $this->cooperatives_update_model->get_coop_composition($decoded_id);
                  
                  $data['title'] = 'Update Cooperative Details';
                  $data['header'] = 'Update Cooperative Information';
                  
                  // $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($decoded_id);

                  $data['coop_info'] = $this->cooperatives_update_model->get_coop_info($data['client_info']->regno);
                  $data['members_composition'] = $this->cooperatives_update_model->get_coop_composition($data['coop_info']->id);
                  $data['composition']= $this->cooperatives_update_model->get_composition();
                  // echo $this->db->last_query();
                  // $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($data['coop_info']->id);
                  // echo $this->db->last_query();
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['major_industry_list'] = $this->cooperatives_update_model->get_all_major_industry($decoded_id);
                  $data['business_activity'] = $this->cooperatives_update_model->get_all_business_activities($data['coop_info']->id);
                  $major_industry_id = '';
                  $cooperative_type_id='';
                  if(count($data['business_activity'])>0)
                  {
                    foreach($data['business_activity'] as $business_dtl)
                    {
                      $major_industry_id = $business_dtl['bactivity_id'];
                      $cooperative_type_id = $business_dtl['cooperative_type_id'];
                    }
                  }


                  $coopTypeName= $data['coop_info']->type_of_cooperative;
                  $typeName_arr = explode(',',$coopTypeName);
                  $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  $data['cooperative_type'] = $list_type; 
                  $data['amd_type_of_coop'] = $typeName_arr;
                  $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);

                  $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info']->rCode);
                  $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info']->pCode);
                  $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info']->cCode);
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['major_industries_subclass'] = $this->industry_subclass_model->get_industry_subclasses($cooperative_type_id,$major_industry_id);
                  $this->industry_subclass_model->get_industry_subclasses_amendmnet($major_industry_id); 
                  $data['subclasses_list'] = $this->cooperatives_model->get_all_subclasses($decoded_id);
                  $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);
                  }
                  if(isset($data['coop_info']->rCode)){
                    $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info']->rCode);
                  }
                  if(isset($data['coop_info']->pCode)){
                    $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info']->pCode);
                  }
                  if(isset($data['coop_info']->cCode)){
                    $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info']->cCode);
                  }

                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
                  
                  $this->load->view('./template/header', $data);
                  // $this->load->view('cooperative/reservation_update', $data);
                  $this->load->view('update/update_cooperative_detail', $data);
                  // if($this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                    // $this->load->view('cooperative/terms_and_condition');
                  // }
                  $this->load->view('./template/footer', $data);
                }else{
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
                    if ($this->input->post('categoryOfCooperative')=='Primary'){
                      $category ='Primary';
                      $group='';
                    }else{
                      $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                      $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                    }
                
                    $name_of_ins_assoc = array_filter($this->input->post('name_institution'));
                    if(count($name_of_ins_assoc)>0 )
                    {
                        $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));
                    }
                    else
                    {
                        $name_of_ins_assoc='';
                    }
                    if(!empty($this->input->post('interregional'))){
                      $interregional = implode(", ",$this->input->post('interregional'));
                      $regions = implode(", ",$this->input->post('regions'));
                    } else {
                      $interregional = '';
                      $regions = '';
                    }
                    
                    if(is_array($this->input->post('typeOfCooperative'))){

                      $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                      $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));
                      $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);

                      $field_data = array(
                        // 'users_id' => $this->session->userdata('user_id'),
                        'category_of_cooperative' => $category,
                        'proposed_name' => $this->input->post('proposedName'),
                        'acronym_name' => $this->input->post('acronym_name'),
                        'type_of_cooperative' => $type_of_cooperativeName,
                        'grouping' => $group,
                        'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                        'field_of_membership' => $this->input->post('field_membership'),
                        'name_of_ins_assoc' => $name_of_ins_assoc,
                        'area_of_operation' => $this->input->post('areaOfOperation'),
                        'refbrgy_brgyCode' => $this->input->post('barangay'),
                        'interregional' => $interregional,
                        'regions' => $regions,
                        'street' => $this->input->post('streetName'),
                        'house_blk_no' => $this->input->post('blkNo')
                      );
                      // echo $this->cooperatives_update_model->update_not_expired_cooperative_array_type($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition);
                      // echo $type_of_cooperativeName;
                      if($this->cooperatives_update_model->update_not_expired_cooperative_array_type($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                      }else{
                        $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                        redirect('coopecooperatives_updateratives/'.$this->input->post('cooperativeID'));
                      }
                    } else {
                      $field_data = array(
                        // 'users_id' => $this->session->userdata('user_id'),
                        'category_of_cooperative' => $category,
                        'proposed_name' => $this->input->post('proposedName'),
                        'acronym_name' => $this->input->post('acronym_name'),
                        'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                        'grouping' => $group,
                        'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                        'field_of_membership' => $this->input->post('field_membership'),
                        'name_of_ins_assoc' => $name_of_ins_assoc,
                        'area_of_operation' => $this->input->post('areaOfOperation'),
                        'refbrgy_brgyCode' => $this->input->post('barangay'),
                        'interregional' => $interregional,
                        'regions' => $regions,
                        'street' => $this->input->post('streetName'),
                        'house_blk_no' => $this->input->post('blkNo')
                      );
                      // echo $type_of_cooperativeName;
                      if($this->cooperatives_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                      }else{
                        $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                        redirect('coopecooperatives_updateratives/'.$this->input->post('cooperativeID'));
                      }
                    }
                    

                    
                }
              // }else{
              //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
              //   redirect('cooperatives/'.$id);
              // }
            // }else{
            //   redirect('cooperatives');
            // }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }
            // else if($this->session->userdata('access_level')!=1){
            //   redirect('cooperatives');
            // }
            else{
              // if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  // echo $this->db->last_query();
                  // if(($this->cooperatives_model->check_first_evaluated($decoded_id) && $coop_info->status == 6) || $coop_info->status == 3){
                    if(!isset($_POST['reserveUpdateBtn']))
                    {
                      $data['title'] = 'Update Cooperative Details';
                      $data['header'] = 'Update Cooperative Information';
                      $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id);
                      if($data['coop_info']->area_of_operation == 'Interregional'){
                        $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                      } else {
                        $data['regions_list'] = $this->region_model->get_regions();
                      }
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      // $data['major_industry_list'] = $this->cooperatives_model->get_all_major_industry($decoded_id);
                      $data['business_activity'] = $this->cooperatives_update_model->get_all_business_activities($data['coop_info']->id);
                      $major_industry_id = '';
                      $cooperative_type_id='';
                      if(count($data['business_activity'])>0)
                      {
                        foreach($data['business_activity'] as $business_dtl)
                        {
                          $major_industry_id = $business_dtl['bactivity_id'];
                          $cooperative_type_id = $business_dtl['cooperative_type_id'];
                        }
                      }
                      $coopTypeName= $data['coop_info']->type_of_cooperative;
                      $typeName_arr = explode(',',$coopTypeName);
                      $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                      $data['cooperative_type'] = $list_type; 
                      $data['amd_type_of_coop'] = $typeName_arr;
                      $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                      
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      $data['major_industries_subclass'] = $this->industry_subclass_model->get_industry_subclasses($cooperative_type_id,$major_industry_id);
                      $this->industry_subclass_model->get_industry_subclasses_amendmnet($major_industry_id); 
                      $data['subclasses_list'] = $this->cooperatives_model->get_all_subclasses($decoded_id);
                      $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                      // echo $this->db->last_query();
                      $data['composition']= $this->cooperatives_model->get_composition();
                      $data['encrypted_id'] = $id;
                      $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($data['coop_info']->area_of_operation == 'Interregional'){
                        $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);
                      }

                      $data['business_activity'] = $this->cooperatives_update_model->get_all_business_activities($data['coop_info']->id);
                      $major_industry_id = '';
                      $cooperative_type_id='';
                      if(count($data['business_activity'])>0)
                      {
                        foreach($data['business_activity'] as $business_dtl)
                        {
                          $major_industry_id = $business_dtl['bactivity_id'];
                          $cooperative_type_id = $business_dtl['cooperative_type_id'];
                        }
                      }
                      $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coop_info']->rCode);
                      $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coop_info']->pCode);
                      $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coop_info']->cCode);
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('update/update_cooperative_detail', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      // if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
                    if ($this->input->post('categoryOfCooperative')=='Primary'){
                      $category ='Primary';
                      $group='';
                    }else{
                      $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                      $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                    }
                
                    $name_of_ins_assoc = array_filter($this->input->post('name_institution'));
                    if(count($name_of_ins_assoc)>0 )
                    {
                        $name_of_ins_assoc = implode(", ",$this->input->post('name_institution'));
                    }
                    else
                    {
                        $name_of_ins_assoc='';
                    }
                    if(!empty($this->input->post('interregional'))){
                      $interregional = implode(", ",$this->input->post('interregional'));
                      $regions = implode(", ",$this->input->post('regions'));
                    } else {
                      $interregional = '';
                      $regions = '';
                    }
                    
                    if(is_array($this->input->post('typeOfCooperative'))){

                      $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                      $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));
                      $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);

                      $field_data = array(
                        // 'users_id' => $this->session->userdata('user_id'),
                        'category_of_cooperative' => $category,
                        'proposed_name' => $this->input->post('proposedName'),
                        'acronym_name' => $this->input->post('acronym_name'),
                        'type_of_cooperative' => $type_of_cooperativeName,
                        'grouping' => $group,
                        'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                        'field_of_membership' => $this->input->post('field_membership'),
                        'name_of_ins_assoc' => $name_of_ins_assoc,
                        'area_of_operation' => $this->input->post('areaOfOperation'),
                        'refbrgy_brgyCode' => $this->input->post('barangay'),
                        'interregional' => $interregional,
                        'regions' => $regions,
                        'street' => $this->input->post('streetName'),
                        'house_blk_no' => $this->input->post('blkNo')
                      );
                      // echo $this->cooperatives_update_model->update_not_expired_cooperative_array_type($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition);
                      // echo $type_of_cooperativeName;
                      if($this->cooperatives_update_model->update_not_expired_cooperative_array_type($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                      }else{
                        $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                        redirect('coopecooperatives_updateratives/'.$this->input->post('cooperativeID'));
                      }
                    } else {
                      $field_data = array(
                        // 'users_id' => $this->session->userdata('user_id'),
                        'category_of_cooperative' => $category,
                        'proposed_name' => $this->input->post('proposedName'),
                        'acronym_name' => $this->input->post('acronym_name'),
                        'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                        'grouping' => $group,
                        'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                        'field_of_membership' => $this->input->post('field_membership'),
                        'name_of_ins_assoc' => $name_of_ins_assoc,
                        'area_of_operation' => $this->input->post('areaOfOperation'),
                        'refbrgy_brgyCode' => $this->input->post('barangay'),
                        'interregional' => $interregional,
                        'regions' => $regions,
                        'street' => $this->input->post('streetName'),
                        'house_blk_no' => $this->input->post('blkNo')
                      );
                      // echo $type_of_cooperativeName;
                      if($this->cooperatives_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                        $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                        redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                      }else{
                        $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                        redirect('coopecooperatives_updateratives/'.$this->input->post('cooperativeID'));
                      }
                    }
                    // $field_data = array(
                    //   // 'users_id' => $this->session->userdata('user_id'),
                    //   'category_of_cooperative' => $category,
                    //   'proposed_name' => $this->input->post('proposedName'),
                    //   'acronym_name' => $this->input->post('acronym_name'),
                    //   'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                    //   'grouping' => $group,
                    //   'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                    //   'field_of_membership' => $this->input->post('field_membership'),
                    //   'name_of_ins_assoc' => $name_of_ins_assoc,
                    //   'area_of_operation' => $this->input->post('areaOfOperation'),
                    //   'refbrgy_brgyCode' => $this->input->post('barangay'),
                    //   'interregional' => $interregional,
                    //   'regions' => $regions,
                    //   'street' => $this->input->post('streetName'),
                    //   'house_blk_no' => $this->input->post('blkNo')
                    // );
                    // // echo $decoded_id;
                    // if($this->cooperatives_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                    //   $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                    //   redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                    // }else{
                    //   $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                    //   redirect('cooperatives_update/'.$this->input->post('cooperativeID'));
                    // }
                      // }else{
                      //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
                      //   redirect('cooperatives');
                      // }
                    // }
                  }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                  //   redirect('cooperatives');
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                //   redirect('cooperatives');
                // }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('cooperatives');
              // }
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function coop_type($existing_type,$category)
    {
      if($category == 'Primary')
      { 
        $except_type = array('Bank','Insurance','Multi-Purpose','Federation','Union');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      elseif($category == 'Secondary')
      { 
       $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');

      }
      elseif($category == 'Tertiary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      else
      {
        $except_type = array('Bank','Insurance','Union');
        $this->db->select('*');
        $this->db->where_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      foreach($coop_type->result_array() as $row)
      {
        $row['amended_type'] = explode(',',$existing_type);
        $data[] = $row;
      }
      return $data;
    }

    public function view($id)
    {
      // echo $this->encryption->decrypt(decrypt_custom($id));
       if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $data['encrypted_id'] = $id;
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Cooperative Details';
              $data['header'] = 'Cooperative Information';
              // $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($decoded_id);
              $data['coop_info'] = $this->cooperatives_update_model->get_coop_info($data['client_info']->regno);
              $data['coop_info2'] = $this->cooperatives_update_model->get_cooperative_info($data['coop_info']->id);
              $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
              
              if(strlen($data['coop_info']->name_of_ins_assoc)>0)
              {
                 $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
              }
             if($data['coop_info']->grouping == 'Federation'){
                  $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$data['coop_info']->users_id);
              } else {
                  $data['affiliates_complete'] = $this->unioncoop_model->is_requirements_complete($data['coop_info']->users_id);
              } 
             
              $data['capitalization_info'] = $this->capitalization_update_model->get_capitalization_by_coop_id($decoded_id);
              $capitalization_info = $data['capitalization_info'];
              if($capitalization_info != NULL){
                    $data['cooperator_complete'] = $this->cooperators_update_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                 
              } else {
                    $data['cooperator_complete'] = $this->cooperators_update_model->is_requirements_complete($decoded_id,0);
              }
              $data['bylaw_complete'] = $this->bylaw_update_model->check_bylaw_primary_complete($decoded_id);
              $data['capitalization_complete'] = $this->capitalization_update_model->check_capitalization_primary_complete($decoded_id);
              $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              if(isset($data['coop_info']->category_of_cooperative)){
                $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_update_model->check_article_primary_complete($decoded_id) : true;
              }
              $data['members_composition'] =  $this->cooperatives_model->get_coop_composition($decoded_id);
              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              $this->load->view('./template/header', $data);
              if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                $this->load->view('update/cooperative_details_union_update', $data);
              } else if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Federation'){
                $this->load->view('update/cooperative_details_federation_update', $data);
              } else {
                $this->load->view('update/cooperative_details_update', $data);
              }
              $this->load->view('./template/footer');
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('cooperatives');
            // }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }
            // else if($this->session->userdata('access_level')!=1){
            //   redirect('cooperatives');
            // }
            if($this->session->userdata('access_level')==6)
             {
              // if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  $data['title'] = 'Cooperative Details';
                  $data['header'] = 'Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id);
                  $data['business_activities'] =  $this->cooperatives_model->get_all_business_activities($decoded_id);
                  $data['members_composition'] =  $this->cooperatives_model->get_coop_composition($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
                  if(isset($data['coop_info']->category_of_cooperative)){
                    $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->capitalization_update_model->check_capitalization_primary_complete($decoded_id) : true;
                  }
                  
                 /*END: UPDATE FOR CAPITALIZATION --by Fred */
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_update_model->check_article_primary_complete($decoded_id) : true;
                  $data['encrypted_id'] = $id;
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  // echo var_dump($capitalization_info);
                  if($capitalization_info != NULL){
                        $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  } else {
                        $data['cooperator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,0);
                  }
                  
                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);
//                  $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                  if($data['coop_info']->type_of_cooperative == 'Credit'){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_credit_federation($data['coop_info']->users_id);
                        } else {
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_credit($data['coop_info']->users_id);
                        }
                  } else {
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_federation($data['coop_info']->users_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['committees_complete'] = $this->committee_model->get_all_required_count_union($data['coop_info']->users_id);
                        } else {
                            $data['committees_complete'] = $this->committee_model->get_all_required_count($data['coop_info']->users_id);
                        }
                  }
                  $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                  $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);

                  if($data['coop_info']->grouping == 'Federation'){
                      $data['affiliator_complete'] = $this->affiliators_model->is_requirements_complete($decoded_id,$data['coop_info']->users_id);
                  } else {
                      $data['affiliates_complete'] = $this->unioncoop_model->is_requirements_complete($data['coop_info']->users_id);
                  } 
                  
                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                  $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                  $count=0;
                  $data['document_others1'] = $this->uploaded_document_model->get_document_one_info($decoded_id);

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                  }
                  
                  foreach ($data['coop_type'] as $coop) : 

                      $count++;
                      if($count == 1){
                          $data['document_others1'] = $this->uploaded_document_model->get_document_others1_info($decoded_id,$coop['document_num']);
                      } else if($count == 2) {
                          $data['document_others2'] = $this->uploaded_document_model->get_document_others2_info($decoded_id,$coop['document_num']);
                      } else {
                          $data['document_others1'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                          $data['document_others2'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                      }

                  endforeach;
                  
                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                  $data['document_three'] = $this->uploaded_document_model->get_document_three_info($decoded_id);
                  $data['document_four'] = $this->uploaded_document_model->get_document_four_info($decoded_id);//sbao
                  if($data['coop_info']->grouping == 'Federation'){
                        $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                    } else {
                        $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                    }

                  $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($decoded_id);
                  $data['cooperatives_comments_snr_defer'] = $this->cooperatives_model->cooperatives_comments_snr_defer($decoded_id);

                  $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);

                  if($this->cooperatives_model->check_if_revert($decoded_id)){
                    $data['cooperatives_comments'] = $this->cooperatives_model->director_comments_revert($decoded_id);
                    $data['cooperatives_comments_defer'] = $this->cooperatives_model->director_comments_defer_revert($decoded_id);
                    $data['supervising_comment']  = $this->cooperatives_model->admin_supervising_cds_comments_revert($decoded_id);
                  } else {
                    $data['cooperatives_comments'] = $this->cooperatives_model->director_comments($decoded_id);
                    $data['cooperatives_comments_defer'] = $this->cooperatives_model->director_comments_defer($decoded_id);
                    $data['supervising_comment']  = $this->cooperatives_model->admin_supervising_cds_comments($decoded_id);
                  }
                  
                  $data['denied_comments'] = $this->cooperatives_model->denied_comments($decoded_id);
                  $data['deferred_comments'] = $this->cooperatives_model->cooperatives_comments($decoded_id);
                  $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                  $data['cooperatives_comments_snr_revert'] = $this->cooperatives_model->cooperatives_comments_snr_revert($decoded_id);
                  $data['cooperatives_comments_snr_revert_defer'] = $this->cooperatives_model->cooperatives_comments_snr_revert_defer($decoded_id);
                  
                  $data['is_update_cooperative'] = $this->cooperatives_update_model->check_date_registered($data['coop_info']->id);
                  
                  $this->load->view('./templates/admin_header', $data);
                  if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                    $this->load->view('update/cooperative_details_union_update', $data);
                  } else if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Federation'){
                    $this->load->view('update/cooperative_details_federation_update', $data);
                  } else {
                    $this->load->view('update/cooperative_details_update', $data);
                  }

                  $this->load->view('update/evaluation/approve_modal_cooperative',$data);
                  $this->load->view('update/evaluation/deny_modal_cooperative',$data);
                  $this->load->view('update/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('update/evaluation/revert_modal_cooperative');
                  $this->load->view('./templates/admin_footer');
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The application you trying to view is not yet submitted for evaluation.');
                //   redirect('cooperatives');
                // }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('cooperatives');
              // }
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_update_model->check_own_cooperative($decoded_id)){
              if(!$this->cooperatives_update_model->check_expired_reservation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_update_model->get_cooperative_info($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                // if($data['bylaw_complete']){
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,'');
                    }
                  // if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    // if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_update_model->check_article_primary_complete($decoded_id) : true;
                      // if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      // if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          // if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            // if($data['staff_complete']){
                              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                              if($data['coop_info']->grouping == 'Federation'){
                                  $data['document_three'] = $this->uploaded_document_model->get_document_three_info($decoded_id);
                              } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                  $data['document_three'] = $this->uploaded_document_model->get_document_three_info($decoded_id);
                              } else {
                                  $data['document_three'] = 1;
                              }
                              
                              // if(($data['document_one'] && $data['document_two'] && $data['document_three']) || $data['coop_info']->grouping == 'Federation'){
                                // if($this->cooperatives_model->check_if_deferred($decoded_id)){
                                  // if($this->cooperatives_model->submit_for_reevaluation($user_id,$decoded_id)){
                                    // if($data['coop_info']->house_blk_no==null && $data['coop_info']->street==null) $x=''; else $x=', ';

                                    //   $brgyforemail = ucwords($data['coop_info']->house_blk_no).' '.ucwords($data['coop_info']->street).$x.' '.$data['coop_info']->brgy.', '.$data['coop_info']->city.', '.$data['coop_info']->province.', '.$data['coop_info']->region;
                                    //   // Get Count Coop Type for HO
                                    //     $this->db->where(array('name'=>$data['coop_info']->type_of_cooperative,'active'=>1));
                                    //     $this->db->from('head_office_coop_type');
                                    //   // End Get Count Coop Type
                                    //   if($this->db->count_all_results()>0)
                                    //   {
                                    //     $regioncode = '00';
                                    //   } else {
                                    //     $regioncode = '0'.mb_substr($data['coop_info']->refbrgy_brgyCode, 0, 2);
                                    //   }
                                    //   $senior_info = $this->admin_model->get_senior_info($regioncode);
                                    //   $data['client_info'] = $this->user_model->get_user_info($user_id);

                                    //   $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                                    //   if(!empty($data['coop_info']->acronym_name)){ 
                                    //     $acronymname = '('.$data['coop_info']->acronym_name.')';
                                    //   }else{ $acronymname = '';}

                                    //   if($data['coop_info']->grouping == 'Federation'){
                                    //     $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' of '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                                    //   } else {
                                    //     $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                                    //   }
                                      

                                    //   if($this->admin_model->sendEmailToSeniorHO($proposednameemail,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info)){
                                    //   $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please Wait for an e-mail notification list of documents for submission');
                                    //   redirect('cooperatives/'.$id);
                                    // }
                                  // }else{
                                  //   $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                  //   redirect('cooperatives/'.$id);
                                  // }
                                // }else{ 
                                  // if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                    if($this->cooperatives_update_model->submit_for_evaluation($user_id,$decoded_id)){
                                      // echo $this->db->last_query();
                                      if($data['coop_info']->house_blk_no==null && $data['coop_info']->street==null) $x=''; else $x=', ';

                                      $brgyforemail = ucwords($data['coop_info']->house_blk_no).' '.ucwords($data['coop_info']->street).$x.' '.$data['coop_info']->brgy.', '.$data['coop_info']->city.', '.$data['coop_info']->province.', '.$data['coop_info']->region;

                                      // Get Count Coop Type for HO
                                        $this->db->where(array('name'=>$data['coop_info']->type_of_cooperative,'active'=>1));
                                        $this->db->from('head_office_coop_type');
                                      // End Get Count Coop Type
                                      if($this->db->count_all_results()>0)
                                      {
                                        $regioncode = '00';
                                      } else {
                                        $regioncode = '0'.mb_substr($data['coop_info']->refbrgy_brgyCode, 0, 2);
                                      }
                                      // $regioncode = '0'.mb_substr($data['coop_info']->refbrgy_brgyCode, 0, 2);

                                      $senior_info = $this->admin_model->get_ap_info($regioncode);
                                      // var_dump($this->admin_model->get_ap_info($regioncode));
                                      $data['client_info'] = $this->user_model->get_user_info($user_id);

                                      $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                                      if(!empty($data['coop_info']->acronym_name)){ 
                                        $acronymname = '('.$data['coop_info']->acronym_name.')';
                                      }else{ $acronymname = '';}


                                      if($data['coop_info']->grouping == 'Federation'){
                                        $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' of '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                                      } else {
                                        $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                                      }

                                      if($data['coop_info']->refbrgy_brgyCode == ''){
                                        $region_for_ap_email = $data['client_info']->addrCode;
                                      } else {
                                        $region_for_ap_email = $data['coop_info']->refbrgy_brgyCode;
                                      }
                                      $this->admin_model->sendEmailToClientUpdating($proposednameemail,$data['client_info']->email);
                                      if($this->admin_model->sendEmailToAP($data['coop_info']->coopName,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info,$data['coop_info']->regNo,$region_for_ap_email)){
                                        $this->session->set_flashdata('cooperative_success','Thank you. Your cooperative’s information is now updated and will be reviewed by CDA Personnel');
                                        redirect('cooperatives_update/'.$id);
                                      } else {
                                        $this->session->set_flashdata('cooperative_success','Thank you. Your cooperative’s information is now updated and will be reviewed by CDA Personnel');
                                        redirect('cooperatives_update/'.$id);
                                      }
                                    }else{
                                      $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                     redirect('cooperatives_update/'.$id);
                                    }
                                  // }else{
                                  //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                  //   redirect('cooperatives/'.$id);
                                  // }
                                // }
                //               }else if(!$data['document_one'] && !$data['document_two'] && !$data['document_three']){
                //                 $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');
                //                 redirect('cooperatives/'.$id);
                //               }else if(!$data['document_one']){
                //                 $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');
                //                 redirect('cooperatives/'.$id);
                //               }else{
                //                 $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');
                //                 redirect('cooperatives/'.$id);
                //               }
                //             }else{
                //               $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                //               redirect('cooperatives/'.$id);
                //             }
                //           }else{
                //             $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                //             redirect('cooperatives/'.$id);
                //           }
                //         }else{
                //           $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                //           redirect('cooperatives/'.$id);
                //         }
                //       }else{
                //         $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                //         redirect('cooperatives/'.$id);
                //       }
                //     }else{
                //       $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                //       redirect('cooperatives/'.$id);
                //     }
                //   }else{
                //         if($data['coop_info']->grouping == 'Federation'){
                //             $complete = 'Members';
                //         } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                //             $complete = 'Members';
                //         } else {
                //             $complete = 'Cooperators';
                //         }
                //       $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                //         redirect('cooperatives/'.$id);
                //   }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('cooperatives/'.$id);
                // }
              }else{
                redirect('cooperatives/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('cooperatives');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function approve_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('approveCooperativeBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                  // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    // if(!$this->cooperatives_update_model->check_if_denied($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $comment_by_specialist_senior = $this->input->post('comment_by_specialist_senior',TRUE);
                      $reason_documents = $this->input->post('documents',TRUE);
                      $reason_rec_action = $this->input->post('rec_action',TRUE);
                      $reason_tool_findings = $this->input->post('revert_tool',TRUE);
                      $reason_tool_comments = $this->input->post('tool_comments',TRUE);
                      // $reason_revert_tool = $this->input->post('revert_tool',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('cooperatives');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $data_field = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level
                              );
                            $success = $this->cooperatives_model->insert_comment_history($data_field);

                                // $this->debug($this->cooperatives_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name));
                                $success = $this->cooperatives_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been submitted.');
                                  redirect('cooperatives');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                                  redirect('cooperatives');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                redirect('cooperatives');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('cooperatives');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }
                      }else if($this->session->userdata('access_level')==3){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                            if($this->cooperatives_model->check_last_evaluated($decoded_id) && $coop_info->status != 17){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('cooperatives');
                            }else{
                              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $data_field = array(
                                  'cooperatives_id' => $decoded_id,
                                  'comment' => $comment_by_specialist_senior,
                                  'user_id' => $user_id,
                                  'user_level' => $data['admin_info']->access_level
                              );
                            $success = $this->cooperatives_model->insert_comment_history($data_field);
                                $success = $this->cooperatives_model->approve_by_director($data['admin_info'],$decoded_id);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                                  redirect('cooperatives');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                                  redirect('cooperatives');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('cooperatives');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('cooperatives');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }
                      }else if($this->session->userdata('access_level')==6){
                        // if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                        //     if($this->cooperatives_model->check_if_revert($decoded_id)){
                        //       $data_field = array(
                        //           'cooperatives_id' => $decoded_id,
                        //           'comment' => $comment_by_specialist_senior,
                        //           'documents' => $reason_documents,
                        //           'rec_action' => $reason_rec_action,
                        //           'revert_tool' => $reason_tool_findings,
                        //           'user_id' => $user_id,
                        //           'user_level' => $data['admin_info']->access_level,
                        //           'status' => 17
                        //       );
                        //     } else {
                              // $data_field = array(
                              //     'cooperatives_id' => $decoded_id,
                              //     'comment' => $comment_by_specialist_senior,
                              //     'documents' => $reason_documents,
                              //     'rec_action' => $reason_rec_action,
                              //     'tool_comments' => $reason_tool_findings,
                              //     'user_id' => $user_id,
                              //     'user_level' => $data['admin_info']->access_level
                              // );
                            // }

                            $coop_info = $this->cooperatives_update_model->get_cooperative_info_by_admin($decoded_id);

                            if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                            $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                            $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                            $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                            // $query = $this->db->get_where('admin',array('id'=>$decoded_specialist_id));
                            // $admin_info = $query->row();

                            $temp = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                            // Get Count Coop Type for HO
                              $this->db->where(array('name'=>$temp->type_of_cooperative,'active'=>1));
                              $this->db->from('head_office_coop_type');
                            // End Get Count Coop
                            if($this->db->count_all_results()>0){

                              $this->db->where(array('region_code'=>00,'is_director_active'=>1,'access_level'=>3));
                              $this->db->from('admin');

                              if($this->db->count_all_results()>0){
                                $senior_emails = $this->admin_model->get_emails_of_director_by_region("00");
                              } else {
                                $senior_emails = $this->admin_model->get_emails_of_supervisor_by_region("00");
                              }

                              $data['admin_info_ho'] = $this->admin_model->get_admin_info($coop_info->evaluated_by);
                            } else {
                              $senior_emails = $this->admin_model->get_emails_of_director_by_region($temp->rCode);
                              $data['admin_info_ho'] = $this->admin_model->get_admin_info($coop_info->evaluated_by);
                            }

                            // $this->admin_model->sendEmailToDirectorFromSenior($senior_emails,$coop_full_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$data['admin_info_ho'],$coop_info->specialist_submit_at,$coop_info->third_evaluated_by);

                            // $success = $this->cooperatives_update_model->insert_comment_history($data_field);
                            // echo $coop_info->type_of_cooperative;
                            $this->admin_model->sendEmailToClientUpdatingApprove($data['client_info']->email,$coop_info->regNo,$coop_info->refbrgy_brgyCode);
                            $success = $this->cooperatives_update_model->approve_by_senior($data['admin_info'],$decoded_id,$coop_full_name,$comment_by_specialist_senior,$coop_info->grouping,$coop_info->type_of_cooperative,$coop_info->refbrgy_brgyCode,$coop_info->common_bond_of_membership,$coop_info->area_of_operation,$coop_info->street,$coop_info->house_blk_no);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been approved.');
                              redirect('updated_cooperative_info');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                              redirect('updated_cooperative_info');
                            }
                        // }else{
                        //   $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
                        //   redirect('cooperatives');
                        // }
                      }
                    // }else{
                    //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                    //   redirect('cooperatives');
                    // }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
                  //   redirect('cooperatives');
                  // }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative is already expired.');
                  redirect('cooperatives');
                }
              }
            }
          }else{
            show_404();
          }
        }else{
          redirect('cooperatives');
        }
      }
    }

    public function defer_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deferCooperativeBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('cooperatives');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                  // // if(!$this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                  //   if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                  //     if(!$this->cooperatives_update_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $reason_documents = $this->input->post('documents',TRUE);
                        $reason_rec_action = $this->input->post('rec_action',TRUE);
                        $reason_tool_comments = $this->input->post('tool_comments',TRUE);
                        if($this->session->userdata('access_level')==4){
                          // if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          //   if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                              // if($this->cooperatives_model->check_last_evaluated($decoded_id) && $coop_info->status != 17){
                              //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              //   redirect('cooperatives');
                              // }else{
                              //   $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                              //   $query3  = $this->db->get_where('regional_officials',array('region_code'=>$data['admin_info']->region_code));
                              //   if($query3->num_rows()>0)
                              //   {
                              //     $reg_officials_info = $query3->row_array();
                              //   }
                              //   else
                              //   {
                              //     $reg_officials_info = array(
                              //       'email' => 'head_office',
                              //       'contact' => '0830403430'
                              //     );
                              //   }

                              //     // $coop_full_name = $this->input->post('cName',TRUE);

                              //     $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                              //     if($coop_info->grouping == 'Federation'){
                              //       $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' of '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                              //     } else {
                              //       $proposednameemail = $data['coop_info']->proposed_name.' '.$data['coop_info']->grouping.' '.$data['coop_info']->type_of_cooperative.' Cooperative '.$acronymname;
                              //     }

                              //     if(!empty($coop_info->acronym_name)){ 
                              //         $acronymname = '('.$coop_info->acronym_name.')';
                              //     } else { 
                              //       $acronymname = '';
                              //     }

                              //     if($coop_info->grouping == 'Federation'){
                              //       $coop_full_name = $coop_info->proposed_name.' '.$coop_info->grouping.' of '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname;
                              //     } else {
                              //       $coop_full_name = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname;
                              //     }

                              //     if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                              //     $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                              //     $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                              //     $this->admin_model->sendEmailToClientDefer($coop_full_name,$brgyforemail,$data['client_info']->email,$reason_commment,$reason_documents,$reason_rec_action,$data['admin_info']->region_code,$reg_officials_info,$reason_tool_comments);

                              //   if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                              //     $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);

                              //     if($coop_info->status == 17){
                              //       $status = 17;
                              //     } else {
                              //       $status = 11;
                              //     }
                                  
                              //     if($this->cooperatives_model->check_if_revert($decoded_id)){
                              //       $comment = array(
                              //           'cooperatives_id' => $decoded_id,
                              //           'comment' => $reason_commment,
                              //           'documents' => $reason_documents,
                              //           'rec_action' => $reason_rec_action,
                              //           'revert_tool' => $reason_tool_comments,
                              //           'user_id' => $user_id,
                              //           'user_level' => $data['admin_info']->access_level,
                              //           'status' =>17
                              //       );
                              //     } else {
                              //       $comment = array(
                              //           'cooperatives_id' => $decoded_id,
                              //           'comment' => $reason_commment,
                              //           'documents' => $reason_documents,
                              //           'rec_action' => $reason_rec_action,
                              //           'tool_comments' => $reason_tool_comments,
                              //           'user_id' => $user_id,
                              //           'user_level' => $data['admin_info']->access_level,
                              //           'status' =>$status
                              //       );
                              //     }
                              //     $this->cooperatives_model->insert_comment_history($comment);
                              //     if($success){
                              //       $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                              //       redirect('cooperatives');
                              //     }else{
                              //       $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                              //       redirect('cooperatives');
                              //     }
                              //   }else{
                              //     $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                              //     redirect('cooperatives');
                              //   }
                              // }
                          //   }else{
                          //     $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                          //     redirect('cooperatives');
                          //   }
                          // }else{
                          //   $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                          //   redirect('cooperatives');
                          // }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                              if($this->cooperatives_model->check_last_evaluated($decoded_id) && $coop_info->status != 17){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if($coop_info->status == 17){
                                  $status = 17;
                                } else {
                                  $status = 11;
                                }
                                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){

                                  if($this->cooperatives_model->check_if_revert($decoded_id)){
                                    $data_field = array(
                                        'cooperatives_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'documents' => $reason_documents,
                                        'rec_action' => $reason_rec_action,
                                        'revert_tool' => $reason_tool_comments,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level,
                                        'status' =>17
                                    );
                                  } else {
                                    $data_field = array(
                                        'cooperatives_id' => $decoded_id,
                                        'comment' => $reason_commment,
                                        'documents' => $reason_documents,
                                        'rec_action' => $reason_rec_action,
                                        'tool_comments' => $reason_tool_comments,
                                        'user_id' => $user_id,
                                        'user_level' => $data['admin_info']->access_level,
                                        'status' =>$status
                                    );
                                  }
                                  $success_comment = $this->cooperatives_model->insert_comment_history($data_field);

                                  // $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                                  $query3  = $this->db->get_where('regional_officials',array('region_code'=>$data['admin_info']->region_code));
                                  if($query3->num_rows()>0)
                                  {
                                    $reg_officials_info = $query3->row_array();
                                  }
                                  else
                                  {
                                    $reg_officials_info = array(
                                      'email' => 'head_office',
                                      'contact' => '0830403430'
                                    );
                                  }

                                  // $coop_full_name = $this->input->post('cName',TRUE);

                                  $coop_info = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                                  if(!empty($coop_info->acronym_name)){ 
                                      $acronymname = '('.$coop_info->acronym_name.')';
                                  } else { 
                                    $acronymname = '';
                                  }

                                  if($coop_info->grouping == 'Federation'){
                                    $coop_full_name = $coop_info->proposed_name.' '.$coop_info->grouping.' of '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname;
                                  } else {
                                    $coop_full_name = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronymname;
                                  }

                                  if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

                                  $brgyforemail = ucwords($coop_info->house_blk_no).' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

                                  $data['client_info'] = $this->user_model->get_user_info($coop_info->users_id);

                                  $this->admin_model->sendEmailToClientDefer($coop_full_name,$brgyforemail,$data['client_info']->email,$reason_commment,$reason_documents,$reason_rec_action,$data['admin_info']->region_code,$reg_officials_info,$reason_tool_comments);

                                  $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success_comment && $success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('cooperatives');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          // if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            // if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                            //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            //   redirect('cooperatives');
                            // }else{
                              $success = $this->cooperatives_update_model->defer_by_admin($user_id,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                redirect('updated_cooperative_info');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                redirect('updated_cooperative_info');
                              }
                            // }
                          // }else{
                          //   $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                          //   redirect('cooperatives');
                          // }
                        }else{
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                            redirect('updated_cooperative_info');
                          }else{
                            $success = $this->cooperatives_update_model->defer_by_admin($user_id,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                              redirect('updated_cooperative_info');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                              redirect('updated_cooperative_info');
                            }
                          }
                        }
                  //     }else{
                  //       $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to defer is already denied.');
                  //       redirect('cooperatives');
                  //     }
                  //   }else{
                  //     $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is not yet submitted for evaluation.');
                  //     redirect('cooperatives');
                  //   }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  //   redirect('cooperatives');
                  // }
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('cooperative_error', validation_errors('<li>','</li>'));
          redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
        }
      }
    }

    public function get_cooperative_info(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            
            $result = $this->cooperatives_update_model->get_cooperative_info($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function format_name($type_of_coop_id)
    {
      if(is_array($type_of_coop_id))
      {
        foreach($type_of_coop_id as $type_id)
          {
            $sqry = $this->db->get_where('cooperative_type',array('id'=>$type_id));
            foreach($sqry->result_array() as $val)
            {
                $typeCoopName [] = $val['name'];
            }
          }
          
             $type_of_cooperative_name = implode(",",$typeCoopName);
           return $type_of_cooperative_name;
      }
    }

    public function composition(){
      $result = $this->cooperatives_update_model->get_composition();
      echo json_encode($result);
    }
   
     public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
    public function phpinfos(){
      echo phpinfo();
    }

    public function major_industries(){
    if($this->input->method(TRUE)==="GET"){
      $data = array();
      echo json_encode($data);
    }else if($this->input->method(TRUE)==="POST"){
      $coop_type_id = $this->input->post('coop_type');
      if(strpos($coop_type_id, "|")==true) {
          $coop_type_ids = explode("|",$coop_type_id);
          $fetch_ids =array();
          foreach($coop_type_ids AS $id) {
              $list = $this->major_industry_model->get_major_industries_updating($id);
              foreach($list as $row) {
                if(!in_array($row['id'], $fetch_ids)) {
                  $data[] = $row;
                  $fetch_ids[] = $row['id'];
                }
              }
          }
      } else {
        echo $coop_type_id;
        $coop_type_id = implode(",",$coop_type_id);
        $data = $this->major_industry_model->get_major_industries_updating($coop_type_id);
      }
      echo json_encode($data);
    }
  }
  }
 ?>
