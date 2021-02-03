<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

class amendment extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model('amendment_uploaded_document_model');
    }
  
    public function saveor($was){
      $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cid')));
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('orDate'),
        'status' =>1,
        'amendment_id' => $amendment_id
      );
     
      $this->amendment_model->save_OR(array('id' => $this->input->post('payment_id'),'amendment_id'=>$amendment_id),$data,$amendment_id);
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
      
    }

    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of Cooperatives';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Amendment';
          $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives($this->session->userdata('user_id'));
            // $this->debug( $data['list_cooperatives']);
         
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_amendment', $data);
          $this->load->view('amendment/delete_modal_amendment');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Amendment';
            $data['header'] = 'Amendment';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            
              $list_coop_type_arr  = $this->amendment_model->check_ho_multipurpose_type($data['admin_info']->region_code);
              // echo $this->db->last_query();
               // $amendment_id_ho = array();
               $amendment_id  = array();
                // $this->debug($list_coop_type_arr);
              foreach($list_coop_type_arr as $row)
              {
                 $types_coop = explode(',',$row['type_of_cooperative']);
                 $a[]= '"' . implode ( '", "', $types_coop  ) . '"';
                 $ho_arr = $this->amendment_model->get_ho_list();
                 $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
                 if($result)
                 { // ho coop
                  array_push($amendment_id,$row['id']);
                 }
                 else
                 { //no ho coop
                  array_push($amendment_id,$row['id']);
                 }
              }
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
                // echo $this->db->last_query();
              }
            }else if($this->session->userdata('access_level')==2){
              // $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
              // $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
            
             
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                // $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code,$amendment_id);
                     echo "dididid";
                // $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
              else 
              {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_senior($data['admin_info']->region_code,$amendment_id);
                // echo $this->db->last_query();
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code); 

              }

            }else{ //DIRECTOR
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_director($data['admin_info']->region_code,$amendment_id);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_director($data['admin_info']->region_code,$amendment_id);
              }
            }

            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code); 
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
             // $this->debug($data['list_cooperatives'])
              $this->load->view('templates/admin_header', $data);
              $this->load->view('applications/list_of_amendment', $data);
              $this->load->view('applications/assign_admin_modal_amendment');
              $this->load->view('admin/grant_privilege_supervisor');
              $this->load->view('admin/revoke_privilege_supervisor');
              $this->load->view('templates/admin_footer');
          }
        }
      }
    }

    public function application(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Application Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Amendment';
              $data['regions_list'] = $this->region_model->get_regions();
              // $data['composition'] = $this->cooperatives_model->get_composition();
              if(isset($_POST['amendmentAddBtn'])){
                  $temp = TRUE;
              } else {
                  $temp = FALSE;
              }
              if ($temp == FALSE){
                $data['regNo'] =$this->load_regNo($user_id);

                ini_set('display_errors', 1);
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/amendment_detail', $data);
//                $this->load->view('cooperative/terms_and_condition');
                $this->load->view('./template/footer');
              }else{
                $subclass_array = $this->input->post('subClass');
                $major_industry = $this->input->post('majorIndustry');
                $members_composition = $this->input->post('composition_of_membersa');
                if ($this->input->post('categoryOfCooperative')=='Primary'){
                  $category ='Primary';
                  $group='';
                }else{
                  $category = substr($this->input->post('categoryOfCooperative'),0,strpos($this->input->post('categoryOfCooperative'),'-')-1);
                  $group = substr($this->input->post('categoryOfCooperative'), strpos($this->input->post('categoryOfCooperative'),'-')+2 , strlen($this->input->post('categoryOfCooperative')) - strpos($this->input->post('categoryOfCooperative'),'-')-2);
                }
                $regNo = $this->input->post('regNo');
                $coop_id = "";
                $query_coop_id = $this->db->select("application_id")->where("regNo",$regNo)->get("registeredcoop");
                if($query_coop_id->num_rows()>0) {
                    $rowd = $query_coop_id->row_array();
                    $coop_id = $rowd['application_id'];
                }
                $amendmentNo = $this->format_amendmentNo_regNo($coop_id);
                
                $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                  $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));
                if($this->input->post('commonBondOfMembership')=='Institutional')
                {
                    $name_of_ins_assoc = implode(',',$this->input->post('name_ins_assoc'));
                    $field_memship =$this->input->post('ins_field_membership');
                }
                else if($this->input->post('commonBondOfMembership')=='Associational')
                {
                      $name_of_ins_assoc = implode(',',$this->input->post('name_associational'));
                      $field_memship =$this->input->post('assoc_field_membership');
                }
                 else if($this->input->post('commonBondOfMembership')=='Occupational')
                {
                      $name_of_ins_assoc ='';
                      $field_memship ='';
                }
                else
                {
                    $name_of_ins_assoc ='';
                      $field_memship ='';
                }    
             

                $proposeName = trim($this->input->post('newNamess'));
                $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);
                $type_of = '';
               	$coopTypeID = implode(',',$typeOfCooperativeID);
                
              if(count($typeOfCooperativeID)>1)
              {
              	$type_of = "Multipurpose";
              }
              else
              {
              	$type_of = "Single";
              }
              //validate name
                if(!$this->amendment_name_exist($coop_id,$proposeName))
                {
                  // echo "duplicate entry";
                   $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Proposed name already exist. Please try again.'));
                    redirect('amendment');
                }

                $occu_comp_of_membship='';
                if(is_array($this->input->post('compositionOfMembersa'))>0)
                {
                  $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembersa'));
                }
              
               
               
                $field_data = array(
                  'users_id' => $this->session->userdata('user_id'),
                  'cooperative_id' => $coop_id, 
                  'regNo' => $this->input->post('regNo'),
                  'amendmentNo' =>  $amendmentNo,
                  'category_of_cooperative' => $category,
                  'proposed_name' => $proposeName,
                  'acronym' => strtoupper($this->input->post('acronym_names')),
                  'type_of_cooperative' => $type_of_cooperativeName,
                  'cooperative_type_id' => 	$coopTypeID,
                  'grouping' => $group,
                  'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                  'comp_of_membership' => $occu_comp_of_membship,
                  'field_of_membership' =>  $field_memship,
                  'name_of_ins_assoc' =>  $name_of_ins_assoc,
                  'type' => $type_of,
                  'area_of_operation' => $this->input->post('areaOfOperation'),
                  'refbrgy_brgyCode' => $this->input->post('barangay'),
                  'street' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'created_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                );
                // $this->debug($field_data);
                // $this->debug($this->amendment_model->if_had_amendment($coop_id));
                if($this->amendment_model->if_had_amendment($coop_id))
                {
                	// $this->debug($this->amendment_model->add_amendment($field_data,$major_industry,$subclass_array,$members_composition,$typeOfCooperative));
                  if($this->amendment_model->add_amendment($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative))
                  {
                    $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
                    redirect('amendment');
                  }
                  else
                  {
                      $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                    redirect('amendment'); 
                  }
                }
                else
                {
                    // $this->debug($this->amendment_model->add_cooperative($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative));
	                if($this->amendment_model->add_cooperative($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative)){
	             
	                  $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
	                  redirect('amendment');
	                }else{
	                  $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
	                  redirect('amendment');
	                }
                }
              }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('cooperatives');
            }
          }

      }
    }

    //json
    public function load_regNo($user_id)
    {
      $qry_user = $this->db->get_where('cooperatives',array('users_id'=>$user_id));
      if($qry_user->num_rows()>0)
      {
        foreach($qry_user->result_array() as $urow)
        {
          $cooperative_id = $urow['id'];
        }
      }

      $qry = $this->db->get_where('registeredcoop',array('application_id'=>$cooperative_id));
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $regno = $row['regNo'];
        }

      }
      else
      {
        $regno = NULL;
      }
      return $regno;
    }


    //modify
    public function format_amendmentNo_regNo($coop_id)
    {
      $amendment_no = '';
      $qry = $this->db->query("select amendmentNo from amend_coop where cooperative_id ={$coop_id} order by id desc limit 1");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
           $amendment_no = $row['amendmentNo'] + 1;
        }
      }
      else
      {
        $amendment_no =1;
      }
      return $amendment_no;
    }
    //end modify

    //modify
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
    //end modify

    //modify
    public function amendment_name_exist($cooperatieID_,$proposed_name)
    {
      $check_name = $this->db->query("select cooperative_id,proposed_name from amend_coop");
      if($check_name->num_rows()>0)
      {
      	foreach($check_name->result_array() as $row_name)
      	{
      		$row_name['proposed_name'] =strtolower($row_name['proposed_name']);
      		if($row_name['proposed_name'] ==strtolower($proposed_name) && $row_name['cooperative_id']==$cooperatieID_)
      		{
      			return TRUE;
      		}	
      	}
	      			//check to amend coop without coop id
		      	 $check_name_all = $this->db->query("select * from amend_coop where proposed_name='$proposed_name' and cooperative_id!={$cooperatieID_}");
		      	 if($check_name_all->num_rows()>0)
		      	 {
		      	 	return FALSE;
		      	 }
		      	 else
		      	 {
		      	 	return TRUE;
		      	 }
      }
      else
      {
      	return TRUE;
      }
    }
    //end modify
    
    public function amendment_update($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
//                if($this->form_validation->run() == FALSE){
                if(!$this->input->post('Amendment_ID')){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  $data['members_composition'] = $this->amendment_model->get_coop_composition($decoded_id);
                  
                  $data['title'] = 'Update Amendment Details';
                  $data['header'] = 'Update Amendment Information';
                  
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);

                  $coopTypeName= $data['coop_info']->type_of_cooperative;
                  $typeName_arr = explode(',',$coopTypeName);
                  $list_of_major_industry_cooptype =$this->major_industry_model->get_major_industries_by_type_name($coopTypeName);
                  $list_type[] = $this->coop_type($coopTypeName);
                  $list_coop_type_id[] =$this->get_coopTypeID( $typeName_arr); 
                  // echo $this->db->last_query();
                 //get major industry id
                  foreach($list_coop_type_id as $row_coop_type_id)
                  { 	
                  	//get major class industry id
                  		$mjor_ins_id[]=$this->industry_subclass_per_coop_type( $row_coop_type_id);

                  }
                
                   	//extract all major industrial id
                  foreach($mjor_ins_id as $id_major_industry)
                  {	
                    foreach($id_major_industry as $mjorID)
                    { 
                    $extracted_majorins_id =  $mjorID['major_industry_id'];
                    $list_major_ins[] = $this->major_industry_description($extracted_majorins_id); 
                    $list_subclassID=$this->major_industry_subclass_id($extracted_majorins_id);
                    }
               		
                  } 
                  // $this->debug($mjor_ins_id);
                  // $this->debug($list_subclassID);

                  //extract subclass id
                  // foreach($list_subclassID as $srow_id) {

                  // 	$subcassID= $srow_id['subclass_id'];
                  // 	 $subclass_description[]=$this->major_industry_description_subclass($subcassID);
                  // }
                  // $this->debug($subclass_description);

                 $data['cooperative_type'] = $list_type; 
                 $data['major_industries_by_coop_type'] = $list_of_major_industry_cooptype;
                 $data['list_of_major_industry'] = $this->get_major_industry($list_of_major_industry_cooptype);

                 if($data['coop_info']->common_bond_of_membership=='Occupational')
                 {
                 	$existed_composition = explode(',',$data['coop_info']->comp_of_membership);
                 	foreach($existed_composition as $com_row)
                 	{
                 		$list_ofComposition[] = $this->CompositionOfmembers($com_row);
                 	}
                 	$data['list_of_comp'] = $list_ofComposition;
                 }

                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['business_activities'] = $this->amendment_model->get_all_business_activities($decoded_id);
                  $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($decoded_id);
                  $data['composition']= $this->amendment_model->get_composition();
                  $data['regions_list'] = $this->region_model->get_regions();
                  $data['encrypted_id'] = $id;

                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                
                  $list_majors = $this->load_major($data['coop_info']->cooperative_type_id);
                  $list_subclass = $this->load_subclass($data['coop_info']->cooperative_type_id);
                  $data['load_major'] = $list_majors;
                  $data['load_subclass'] = $list_subclass;

                  $qry_business_act = $this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$decoded_id));
                 // $this->debug($this->db->last_query());
                  if($qry_business_act->num_rows()>0)
                  {
                    foreach($qry_business_act->result_array() as $brow)
                    {
                      // $this->debug($brow);
                      $major_id = $brow['major_industry_id'];
                      $brow['major_description_']=$this->major_industry_description2($major_id);
                   
                      $brow['subclass_description_']=$this->major_industry_description_subclass2($brow['subclass_id']);
                     
                      $cooptype_id_array[] = $brow['cooperative_type_id'];
                      $brow['load_major'] =  $list_majors;
                      $brow['load_subclass'] = $list_subclass;
                      $business_data[] =$brow;

                       // $this->debug( $business_data);
                        $data['list_of_major_industry_']= $business_data;

                        // $this->debug( $data['list_of_major_industry_']);
                        
                        foreach($cooptype_id_array as $ctype_id)
                        {
                          $mdata[] = $this->list_of_majorindustry($ctype_id);
                        }

                        $data['mjor_list']=$mdata;
                       
                        foreach($mdata as $m)
                        {
                          //$this->$this->major_industry_description_subclass($['sublcass+i']);
                          $subclass_data[]=$this->list_of_subclasss($m['major_industry_id']);
                        }
                        // $this->debug($subclass_data);
                       foreach($subclass_data as $sdata){
                        foreach($sdata as $srow)
                        {
                          $list_subclass[]= $this->major_industry_description_subclass($srow['subclass_id']);
                        }
                       }

                       $data['list_subclass'] = $list_subclass;

                    }
                  }

                  $data['list_type_coop'] = $this->coop_type($coopTypeName);
                  // $this->debug($data['list_type_coop']);
                  //cooperative type value
                  $data['amd_type_of_coop'] = $typeName_arr;
                  $this->load->view('./template/header', $data);
                  $this->load->view('cooperative/amendment_reservation_update', $data);
                  if($this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                    $this->load->view('cooperative/terms_and_condition');
                  }
                  $this->load->view('./template/footer', $data);
                }else{
                	// $cooperative_id = $this->coop_dtl($decoded_id);
                  if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
             
                   
           			  $typeOfCooperativeID = $this->input->post('typeOfCooperative');
	                $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));

	                 // $type_of_cooperativeName = $this->format_name($typeOfCooperative);
                  $field_memship ='';
                  $name_of_ins_assoc ='';
	                if($this->input->post('commonBondOfMembership')=='Institutional')
	                {
	                       $name_of_ins_assoc = implode(',',$this->input->post('name_ins_assoc'));
	                        $field_memship =$this->input->post('ins_field_membership');
	                }
	                else if($this->input->post('commonBondOfMembership')=='Associational')
	                {
	                      $name_of_ins_assoc = implode(',',$this->input->post('name_associational'));
	                      $field_memship =$this->input->post('assoc_field_membership');
	                }
	                 else if($this->input->post('commonBondOfMembership')=='Occupational')
	                {
	                      $name_of_ins_assoc ='';
	                      $field_memship ='';
	                } 

	                $proposeName = strtolower($this->input->post('proposedName'));
	                $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);
	                // echo $typeOfCooperativeID.' '.$proposeName;
	                // if($this->amendment_name_exist($typeOfCooperativeID,$proposeName))
	                // {
	                //   // echo "duplicate entry";
	                //    $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Proposed name already exist. Please try again.'));
	                //     redirect('amendment');
	                // }

	                $occu_comp_of_membship='';
	                if(is_array($this->input->post('compositionOfMembersa'))>0)
	                {
	                  $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembersa'));
	                }    
                  $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('Amendment_ID')));             
	                 $group='';
                   $cooperativeType_id =  implode(',',$this->input->post('typeOfCooperative'));
                    $field_data = array(
                      'users_id' => $this->session->userdata('user_id'),
                      'cooperative_id'=>$this->coop_dtl($decoded_id),
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposedName'),
                      'acronym' => $this->input->post('acronym_name'),
                      'type_of_cooperative' =>   $type_of_cooperativeName,
                      'cooperative_type_id' => $cooperativeType_id,
                      'grouping' => $group,
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'comp_of_membership' =>$occu_comp_of_membship,
                	  'field_of_membership' => $field_memship,
               		  'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                    );
                    // $this->debug($field_data);
                  // $this->debug($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition));
                    // $this->debug($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition));
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry,$members_composition)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                      redirect('amendment/'.$this->input->post('Amendment_ID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                      redirect('amendment/'.$this->input->post('Amendment_ID'));
                    }
                  }else{
                    $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $field_data = array(
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposedName'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                       'cooperative_type_id' => $cooperativeType_id,
                       'cooperative_id'=>$this->coop_dtl($decoded_id),
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'composition_of_members' => $this->input->post('compositionOfMembers'),
                      'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'status' => 1,
                      'created_at'=> date('Y-m-d h:i:s'),
                      'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                    );
                    // $this->debug($field_data);
                    // $this->debug($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry));
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$subclass_array,$major_industry)){

                      $this->session->set_flashdata('cooperative_success', 'Successfully updated expired reservation.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to reserve cooperative.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }
                  }
                }
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('amendment/'.$id);
              }
            }else{
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
                if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  if(!$this->amendment_model->check_first_evaluated($decoded_id)){
                    if($this->form_validation->run() == FALSE){
                      $data['title'] = 'Update Cooperative Details';
                      $data['header'] = 'Update Cooperative Information';
                      $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                      $data['regions_list'] = $this->region_model->get_regions();
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($decoded_id);
                      $data['subclasses_list'] = $this->amendment_model->get_all_subclasses($decoded_id);
                      $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
                      

                      $coopType= explode(',',$data['coop_info']->type_of_cooperative);
                       foreach($coopType as $trow)
                       {
                        $list_type[] = $this->coop_type($trow);
                           $list_of_major_industry_cooptype = $this->major_industry_model->get_major_industries_by_type_name($trow);
                           $list_coop_type_id[] =$this->get_coopTypeID($trow); 
                       }
                        $data['cooperative_type'] = $list_type;

                        
                      $data['encrypted_id'] = $id;
                       $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('cooperative/amendment_reservation_update', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      if(!$this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                        $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                        $subclass_array = $this->input->post('subClass');
                        $major_industry = $this->input->post('majorIndustry');
                        $field_data = array(
                          'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                          'proposed_name' => $this->input->post('proposedName'),
                          'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                          'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                          'composition_of_members' => $this->input->post('compositionOfMembers'),
                          'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                          'area_of_operation' => $this->input->post('areaOfOperation'),
                          'refbrgy_brgyCode' => $this->input->post('barangay'),
                          'street' => $this->input->post('streetName'),
                          'house_blk_no' => $this->input->post('blkNo')
                        );
                        if($this->amendment_model->update_not_expired_cooperative_by_admin($decoded_id,$field_data,$subclass_array,$major_industry)){
                          $this->session->set_flashdata('cooperative_success', 'Successfully updated this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }else{
                          $this->session->set_flashdata('cooperative_error', 'Unable to update this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
                        redirect('amendment');
                      }
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function view($id = null){
     $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $coop_id = $this->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
              $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Amendment Details';
              $data['header'] = 'Amendment Information';
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($coop_id,$user_id,$decoded_id);
              $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
                                $complete_upload = array();
                                foreach($data['coop_type'] as $coopRow)
                                {
                              

                                  if($this->check_is_uploaded($decoded_id,$coopRow['document_num']))
                                  {
                                    $coopRow['status']='true';
                                  }
                                  else
                                  {
                                     $coopRow['status']='false';
                                  }
                                  $complete_upload[]= $coopRow['status'];
                                }
                                $data['status_document_one'] =$this->check_is_uploaded($decoded_id,1);
                                $data['status_document_two'] =$this->check_is_uploaded($decoded_id,2);
                                $data['status_feasibility'] =$this->check_is_uploaded($decoded_id,3);
                                $data['status_books_of_account'] =$this->check_is_uploaded($decoded_id,4);

                                if(in_array('false', $complete_upload))
                                {
                                  $data['status_document_cooptype'] = false;
                                }
                                else
                                {
                                  $data['status_document_cooptype'] = true;
                                }

              $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
//              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$decoded_id) : true;
              // $this->debug( $data['bylaw_complete']);
//              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperative_id']=encrypt_custom($this->encryption->encrypt($coop_id));
              $data['encrypted_id'] = $id;
              
              //$data['capitalization_complete'] = $this->cooperative_model->is_capitalization_complete($decoded_id);
              /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
              $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_capitalization_model->check_capitalization_primary_complete($coop_id,$decoded_id) : true;
              // $this->debug(  $data['capitalization_complete']);
              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);

              if($data['cooperator_complete']==false) {
                $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
              }
              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              if($data['committees_complete']==false) {
                $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
              }
              $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$decoded_id); 
              // echo $this->db->last_query();
              //    $mystring = "hello_there";
              // if(str_replace("_", "", $mystring) != $mystring) 
              // {
              //     // There is an underscore
              // }
              // else
              // {
              //   //no underscore
              // }

                //$pos = strpos($mystring, '_');
                // if(false !== $pos) {
                //     //no _ in the mystring
                // }
                // else {
                //     echo "_ found at pos ".$pos; 
                // }
              // var_dump( $data['purposes_complete']);
              $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);

              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);

              $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
              $data['submitted'] = $this->amendment_model->check_submitted_for_evaluation($coop_id,$decoded_id);
              $data['members_composition'] =  $this->amendment_model->get_coop_composition($decoded_id);
              $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
              if($data['committeescount']==0) {
                $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad($decoded_id);
              }

                 //position 
                       $data['election'] = $this->committee_model->check_position($decoded_id,"Election");
              
                        $data['ethics'] = $this->committee_model->check_position($decoded_id,"Ethics");
                        $data['media_concil'] = $this->committee_model->check_position($decoded_id,"Mediation and Conciliation");
                        $data['gender_dev'] = $this->committee_model->check_position($decoded_id,"Gender and Development");
                         $data['audit'] = $this->committee_model->check_position($decoded_id,"Audit");

                  //end position
                        $data['complete_position']='';
                        if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                        {
                          $data['complete_position']=true;
                        }
                        else
                        {
                          $data['complete_position']=false;
                        }
                        $data['director_comment'] = $this->amendment_model->admin_comment($decoded_id,3);
                        $data['have_director_comment'] = $this->amendment_model->admin_comment_value($decoded_id,3);
                  //download payment      
                  $data['coop_capitalization']=$this->coop_capitalization($coop_id);
                  $data['amendment_capitalization']= $this->amendment_capitalization($decoded_id);      
                  $data['name_reservation_fee']=100.00;
                  $data['pay_from']='reservation'; 
                  //end of download payment       
              $this->load->view('./template/header', $data);
              $this->load->view('cooperative/amendment_details', $data);
              $this->load->view('./template/footer');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else if($this->session->userdata('access_level')!=1){
              redirect('amendment');
            }else{
              if(!$this->amendment_model->check_expired_reservation_by_admin($coop_id,$decoded_id)){
                if($this->amendment_model->check_submitted_for_evaluation($coop_id,$decoded_id)){
                  $data['title'] = 'Cooperative Details';
                  $data['header'] = 'Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['business_activities'] =  $this->amendment_model->get_all_business_activities($decoded_id);
                  $data['members_composition'] =  $this->amendment_model->get_coop_composition($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$decoded_id) : true;
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                  $data['encrypted_id'] = $id;
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
                  $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($decoded_id);
                  $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                  $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$decoded_id); 
                  $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                  // $data['document_one'] = $this->amendment_uploaded_document_model->get_document_one_info($decoded_id);
                  // $data['document_two'] = $this->amendment_uploaded_document_model->get_document_two_info($decoded_id);
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_capitalization_model->check_capitalization_primary_complete($coop_id,$decoded_id) : true;
                  $data['amendment_id']= $decoded_id;

                   $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
                                $complete_upload = array();
                                foreach($data['coop_type'] as $coopRow)
                                {
                                  if($this->check_is_uploaded($decoded_id,$coopRow['document_num']))
                                  {
                                    $coopRow['status']='true';
                                  }
                                  else
                                  {
                                     $coopRow['status']='false';
                                  }
                                  $complete_upload[]= $coopRow['status'];
                                }
                                $data['status_document_one'] =$this->check_is_uploaded($decoded_id,1);
                                $data['status_document_two'] =$this->check_is_uploaded($decoded_id,2);
                                $data['status_feasibility'] =$this->check_is_uploaded($decoded_id,3);
                                $data['status_books_of_account'] =$this->check_is_uploaded($decoded_id,4);
                                if(in_array('false', $complete_upload))
                                {
                                  $data['status_document_cooptype'] = false;
                                }
                                else
                                {
                                  $data['status_document_cooptype'] = true;
                                }

                                // $this->debug($data['coop_info']);
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('cooperative/amendment_details', $data);
                  $this->load->view('amendment/evaluation/approve_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/deny_modal_cooperative',$data);
                  $this->load->view('cooperative/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('./templates/admin_footer');
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The application you trying to view is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }else{ 
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }
            }
          }
        }else{
          show_404();
        }
      }
    }
    
    //json
  public function check_is_uploaded($amendment_id,$document_num)
  {
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>$document_num));
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

    public function delete_amendment(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteAmendmentBtn')){
          if($this->session->userdata('client')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
            $cooperative_id = $this->coop_dtl($decoded_id);
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($decoded_id) && $decoded_id!=0){
              // echo $decoded_id;
              if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
                if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  //remove uploaded file
                  $this->remove_uploaded_file($decoded_id);//remove file
                  $success = $this->amendment_model->delete_cooperative($decoded_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                    redirect('amendment');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                    redirect('amendment');
                  }
                  
                  
                }else{
                  if(!$this->amendment_model->check_if_denied($decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE));
                  }else{
                      $this->remove_uploaded_file($decoded_id); //remove file
                      $success = $this->amendment_model->delete_cooperative($decoded_id);
                      if($success){
                        $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                        redirect('amendment');
                      }else{
                        $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                        redirect('amendment');
                      }
                  }
                }
              }
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('amendment');
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }

    public function remove_uploaded_file($amendment_id)
    {
      $qry_file = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id));
      if($qry_file->num_rows()>0)
      {
        foreach($qry_file->result_array() as $row_file)
        {
        $file=APPPATH.'../uploads/amendment/'.$row_file['filename'];
          if(is_readable($file))
          {
            unlink($file);
          }
          // $data_file[]=$row_file;
        }
      }
    }

    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['document_one'] = $this->amendment_uploaded_document_model->get_document_one_info($cooperative_id,$decoded_id);
                              $data['document_two'] = $this->amendment_uploaded_document_model->get_document_two_info($decoded_id);
                               $data['status_document_one'] =$this->check_is_uploaded($decoded_id,1);
                                $data['status_document_two'] =$this->check_is_uploaded($decoded_id,2);

                              if($data['status_document_one'] && $data['status_document_two']){
                                if($this->amendment_model->check_if_deferred($decoded_id)){
                                  if($this->amendment_model->submit_for_reevaluation($user_id,$decoded_id)){
                                    $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                                    redirect('amendment/'.$id);
                                  }else{
                                    $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                    redirect('amendment/'.$id);
                                  }
                                }else{ 
                                    
                                  if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){

                                    // $this->debug($this->amendment_model->submit_for_evaluation($user_id,$decoded_id,$data['coop_info']->rCode)); 
                                    if($this->amendment_model->submit_for_evaluation($user_id,$decoded_id,$data['coop_info']->rCode)){
                                      $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                      redirect('amendment/'.$id);
                                    }else{
                                      $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                     redirect('amendment/'.$id);
                                    }
                                  }else{
                                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                    redirect('amendment/'.$id);
                                  }
                                }
                              }else if(!$data['status_document_one'] && !$data['status_document_two']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your two other documents.');
                                redirect('amendment/'.$id);
                              }else if(!$data['document_one']){
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document one.');
                                redirect('amendment/'.$id);
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please upload first your document two.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                        redirect('amendment/'.$id);
                      }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                      redirect('amendment/'.$id);
                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                    redirect('amendment/'.$id);
                  }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                  redirect('amendment/'.$id);
                }
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('amendment');
            }
          }
        }else{
          show_404();
        }
      }
    }

    public function payment(){
      $decoded_id =  $this->encryption->decrypt(decrypt_custom($this->input->post('coop_id')));
      $data = $this->amendment_model->get_payment_info( $decoded_id);
      $data->amendment_id = encrypt_custom($this->encryption->encrypt($data->amendment_id));
      echo json_encode($data);
    }

    

    public function specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('amendment');
              }else{
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id',TRUE)));
                $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
                if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));
                    $coop_full_name = $this->input->post('amdName',TRUE);
                    if((is_numeric($decoded_id) && $decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
                      if($this->amendment_model->check_not_yet_assigned($decoded_id)){
                        
                    
                        if($this->amendment_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
                          redirect('amendment');
                        }else{
                          $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                          redirect('amendment');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the amendment cooperative to an validator.');
                        redirect('amendment');
                      }
                    }else{
                      show_404();
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The  you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is already expired.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }
    public function approve_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('approveCooperativeBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $cooperative_id =$this->amendment_model->coop_dtl($decoded_id);
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                    if(!$this->amendment_model->check_if_denied($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            if($this->amendment_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Amendment Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('amendment');
                            }else{
                            // $this->debug($this->admin_model->check_if_director_active($user_id,$data['coop_info']->rCode));
                              if($this->admin_model->check_if_director_active($user_id,$data['coop_info']->rCode)){
                                $success = $this->amendment_model->approve_by_supervisor($data['admin_info'],$decoded_id,$coop_full_name);

                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve Amendment cooperative.');
                                  redirect('amendment');
                                }
                              }else{ 
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                redirect('amendment');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else if($this->session->userdata('access_level')==3){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            if($this->amendment_model->check_last_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              redirect('amendment');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){

                                $comment = $this->input->post('comment');
                                $data_comment = array(
                                        'user_id' => $this->session->userdata('user_id'),
                                        'amendment_id' => $decoded_id,
                                        'access_level' => $this->session->userdata('access_level'),
                                        'status'=> 12,
                                        'comment' => $comment,
                                        'created_at' => date('Y-m-d h:i:s'),
                                        'author' => $this->session->userdata('user_id')
                                        );
                                // echo 'director';
                                $success = $this->amendment_model->approve_by_director($data['admin_info'],$decoded_id,$data_comment);
                                // $this->debug($success);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve amendment cooperative.');
                                  redirect('amendment');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('amendment');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else if($this->session->userdata('access_level')==2){
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          if($this->amendment_model->check_second_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Amendment Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            redirect('amendment');
                          }else{
                            
                          $comment = $this->input->post('comment_by_specialist_senior');
                          $data_comment = array(
                                        'user_id' => $this->session->userdata('user_id'),
                                        'amendment_id' => $decoded_id,
                                        'access_level' => $this->session->userdata('access_level'),
                                        'status'=> 9,
                                        'comment' => $comment,
                                        'created_at' => date('Y-m-d h:i:s'),
                                        'author' => $this->session->userdata('user_id')
                                        );

                            $success = $this->amendment_model->approve_by_senior($data['admin_info'],$decoded_id,$coop_full_name,$data_comment);
                            // $this->debug($success);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been submitted.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to submit cooperative.');
                              redirect('amendment');
                            }
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }
                      }else{
                        if($this->amendment_model->check_first_evaluated($decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }else{
                          $comment = $this->input->post('comment_by_specialist_senior');
                          $data_comment = array(
                                        'user_id' => $this->session->userdata('user_id'),
                                        'amendment_id' => $decoded_id,
                                        'access_level' => $this->session->userdata('access_level'),
                                        'status'=> 6,
                                        'comment' => $comment,
                                        'created_at' => date('Y-m-d h:i:s'),
                                        'author' => $this->session->userdata('user_id')
                                        );
                          if($this->db->insert('amendment_comment',$data_comment))
                          {

                            $coop_types = $data['coop_info']->type_of_cooperative;
                            $coop_types_arr= explode(',', $coop_types);
                            foreach($coop_types_arr as $rowtype)
                            {
                              $ho[] =$this->amendment_model->checking_ho($rowtype);
                            }
                            //confirm in ho
                            if(in_array('true',$ho))
                            {
                              //true
                               $regioncode = '00';
                               //get senior admin info
                               $data['admin_info_senior'] =$this->admin_model->get_senior_info($regioncode);
                              
                            }
                            
                            
                            // $this->debug($this->amendment_model->checking_ho($coop_types));
                            $success = $this->amendment_model->approve_by_specialist($data['admin_info'],$decoded_id,$coop_full_name,$data['coop_info']->type_of_cooperative);
                            // $this->debug($success);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been submitted.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                              redirect('amendment');
                            }

                          }
                          else
                          {
                            $this->session->set_flashdata('list_error_message', 'Failed to approve cooperative.');
                              redirect('amendment');
                          }
                          
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                      redirect('amendment');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is already expired.');
                  redirect('amendment');
                }
              }
            }
          }else{
            show_404();
          }
        }else{
          redirect('amendment');
        }
      }
    }
    public function deny_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
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
                    if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                      
                      //if(!$this->cooperatives_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if(!$this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
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
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              if($this->cooperatives_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if($this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
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
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                              redirect('cooperatives');
                            }else{
                              $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                redirect('cooperatives');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                redirect('cooperatives');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }
                        }else{
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                            redirect('cooperatives');
                          }else{
                            $success = $this->cooperatives_model->deny_by_admin($user_id,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                              redirect('cooperatives');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                              redirect('cooperatives');
                            }
                          }
                        }
                      //}else{
                        //$this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is already denied.');
                        //redirect('cooperatives');
                      //}
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is not yet submitted for evaluation.');
                      redirect('cooperatives');
                    }
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
          $this->session->set_flashdata('cooperative_error', validation_errors('<li>','</li>'));
          redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
        }
      }
    }
    public function defer_cooperative(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        // if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));

          $cooperative_id =   $cooperative_id =$this->amendment_model->coop_dtl($decoded_id);
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                  if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
                    if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                      if(!$this->amendment_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        if($this->session->userdata('access_level')==4){
                          if($this->amendment_model->check_first_evaluated($decoded_id)){
                            if($this->amendment_model->check_second_evaluated($decoded_id)){
                              if($this->amendment_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('amendmet');
                              }else{
                                if(!$this->admin_model->check_if_director_active($user_id)){
                                  echo "No data found";
                                  // $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3);
                                  // if($success){
                                  //   $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                  //   redirect('cooperatives');
                                  // }else{
                                  //   $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                  //   redirect('cooperatives');
                                  // }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                  redirect('amendment');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('amendment');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.dddd');
                            redirect('amendment');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->amendment_model->check_first_evaluated($decoded_id)){
                            if($this->amendment_model->check_second_evaluated($decoded_id)){
                              if($this->amendment_model->check_last_evaluated($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                                redirect('cooperatives');
                              }else{
                                if($this->admin_model->check_if_director_active($user_id)){
                                $comment = $this->input->post('comment');
                                 $data_comment = array(
                                        'user_id' => $this->session->userdata('user_id'),
                                        'amendment_id' => $decoded_id,
                                        'access_level' => $this->session->userdata('access_level'),
                                        'status'=> 11,
                                        'comment' => $comment,
                                        'created_at' => date('Y-m-d h:i:s'),
                                        'author' => $this->session->userdata('user_id')
                                        );
                                  $success = $this->amendment_model->defer_by_admin($user_id,$decoded_id,$reason_commment,3,$data_comment);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('cooperatives');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('cooperatives');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('amendment');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                              redirect('amendment');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist IIddddd.');
                            redirect('amendment');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            if($this->cooperatives_model->check_second_evaluated($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                              redirect('amendment');
                            }else{
                              $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                redirect('amendment');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                redirect('amendment');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist IIssss.');
                            redirect('amendment');
                          }
                        }else{
                          if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                            redirect('amendment');
                          }else{
                            $success = $this->cooperatives_model->defer_by_admin($user_id,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                              redirect('amendment');
                            }
                          }
                        }
                      }else{ 
                        $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to defer is already denied.');
                        redirect('amendment');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is not yet submitted for evaluation.');
                      redirect('amendment');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                    redirect('amendment');
                  }
                }
            }
          }else{
             $this->session->set_flashdata('redirect_applications_message', 'No data found.');
              redirect('amendment');
            // show_404();
          }
        // }else{
        //   $this->session->set_flashdata('amendment_error', validation_errors('<li>','</li>'));
        //   redirect('amendment/'.$this->input->post('cooperativeID',TRUE));
        // }
      }
    }

    public function type_of_cooperative_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      if(strlen($typeOfCooperative) > 0){
        $typeName = $this->cooperative_type_model->get_cooperative_type_name_by_id($typeOfCooperative);
        if(preg_match('/('.$typeName->name.')/i',$proposedName)){
          $this->form_validation->set_message('coop_name_exists_check', 'Dont include the type of cooperative in your proposed name.');
          return FALSE;
        }else{
          return true;
        }
      }else{
        $this->form_validation->set_message('coop_name_exists_check', 'Please select first your type of cooperative.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $data = array(
        'fieldId'=>"proposedName",
        'fieldValue'=>$proposedName,
        'typeOfCooperative'=> $typeOfCooperative,
      );
      $result = $this->cooperatives_model->is_name_unique($data);
      if($result[1]==true){
        return true;
      }else{
        $this->form_validation->set_message('cooperative_name_exists_check', 'Cooperative Name already exists.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_update_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $cooperativeID = $this->input->post('cooperativeID');
      $status =  $this->encryption->decrypt(decrypt_custom($this->input->post('status')));
      if($status >= 1){
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
          'cooperativeID'=> $this->input->get('cooperativeID'),
        );
        $result = $this->cooperatives_model->is_name_update_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }else{
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
        );
        $result = $this->cooperatives_model->is_name_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }
    }
    public function cooperative_word_check($proposedName){
      if(preg_match('/(cooperative|cooperatives|kooperatiba|cooperativa|cooperatiba)/i',$proposedName)){
        $this->form_validation->set_message('coop_name_exists_check', 'Please dont include the word cooperative.');
        return false;
      }else{
        return TRUE;
      }
    }
    public function check_coop_name_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
          );
          $result = $this->cooperatives_model->is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperatives');
        }
      }
    }
    public function check_coop_name_update_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative') && $this->input->get('cooperativeID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
            'cooperativeID'=> $this->input->get('cooperativeID'),
          );
          $result = $this->amendment_model->is_name_update_unique($data);
          echo json_encode($result);
        }else{
          echo json_encode(array($ajax['fieldId'],false,"Error 500. Server error"));
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
            redirect('amendment');
          }
        }else{
          // if($this->input->post('id') && $this->input->post('user_id')){
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
               $cooperative_id = $this->coop_dtl($decoded_id);
            // $result = $this->amendment_model->get_cooperative_info($cooperative_id,$decoded_user_id,$decoded_id);
             $result = $this->amendment_model->get_cooperative_info23($cooperative_id,$decoded_id);
                
      
            $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
            $this->db->from('business_activities_cooperative_amendment');
            $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
            $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
            $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
            $this->db->where('business_activities_cooperative_amendment.amendment_id', $decoded_id);
           $qrys  = $this->db->get();
            // echo json_encode($this->db->last_query());
           $data2 = $qrys->result_array();
            $result->business_activities = $data2;
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function get_cooperative_info_by_admin(){
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function load_major($cooperative_type_id)
    {
      $qry= $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id in({$cooperative_type_id})");
      foreach($qry->result_array() as $row)
      {
        $row['major_description'] =$this->major_industry_description2($row['major_industry_id']);
        // $row['subclass_id'] =$this->g_subclass($row['major_industry_id']);
        $data[] = $row;
      }
      return $data;
    }
    public function load_subclass($cooperative_type_id)
    {
      $qry= $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where cooperative_type_id in({$cooperative_type_id})");
      foreach($qry->result_array() as $row)
      {
        $row['subclass_descriptions'] = $this->major_industry_description_subclass22($row['subclass_id']);
        $data[] = $row;
      }
      return $data;
    }
    public function business_activity($regNo){
      $data = $this->amendment_model->get_business_activity_coop($regNo);
      echo json_encode($data);
    }
    public function coop_info($regNo){
      $qr =$this->db->query("select application_id from registeredcoop where regNo='$regNo' order by id desc limit 1");
      foreach($qr->result() as $c)
      {
        $cooperative_id = $c->application_id;
      }
     
      if($this->amendment_model->if_had_amendment($cooperative_id))
      {
        $a_qty = $this->db->query("select amendment_id from registeredcoop where regNo='$regNo'");
        foreach($a_qty->result() as $a)
        {
          $amendment_id = $a->amendment_id;
        }
         $data = $this->amendment_model->get_amendment($amendment_id);

         //get business activity
         $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
          $this->db->from('business_activities_cooperative_amendment');
          $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
          $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
          $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
          $this->db->where('business_activities_cooperative_amendment.amendment_id',$amendment_id);
          $qry  = $this->db->get();
          $data2 = $qry->result_array();
          $data->business_activities = $data2;
         //end busineess activity
         echo json_encode($data);
      }
      else
      {
         $data = $this->amendment_model->get_coop($regNo);
        $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
          $this->db->from('business_activities_cooperative');
          $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
          $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
          $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
          $this->db->where('business_activities_cooperative.cooperatives_id',$cooperative_id);
          $query = $this->db->get();
          $data2 = $query->result_array();
          $data->business_activities = $data2;
          echo json_encode($data);
      }//end if had amendment
    }
          

    public function composition(){
      $result = $this->amendment_model->get_composition();
      echo json_encode($result);
    }

    public function get_business_activities_of_coop(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function check_minimum_regular_subscription_amendment(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
        $data = array(
          'fieldId'=>$this->input->get('fieldId'),
          'fieldValue'=>$this->input->get('fieldValue'),
          'coop_id'=>$this->input->get('cooperativesID')
        );
        $result = $this->bylaw_model->check_minimum_regular_subscription_amendment($data);
        echo json_encode($result);
      }else{
        show_404();
      }
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

  	public function coop_type($existing_type)
  	{
  		
  		$coop_type = $this->db->get('cooperative_type');
  		foreach($coop_type->result_array() as $row)
  		{
  			$row['amended_type'] = explode(',',$existing_type);
  			$data[] = $row;
  		}
  		return $data;
  	}

  	public function CompositionOfmembers($existing_Composition)
  	{
  		
  		$coop_type = $this->db->get('composition_of_members');
  		foreach($coop_type->result_array() as $row)
  		{
  			$row['amended_composition'] = $existing_Composition;
  			$data[] = $row;
  		}
  		return $data;
  	}

    public function get_specific_CompositionOfmembers()
    {
      $comp_id = $this->input->post('comp_id'); 
      $query= $this->db->get_where('composition_of_members',array('id'=>$comp_id));
      foreach($query->result() as $row)
      {
        $data = $row;
      }
      echo json_encode($data);
    }


    public function composition_of_members_()
    {
      $coopid =$this->input->post('coop_ids');
      $qry=$this->db->query("select members_composition_of_cooperative.coop_id as cooperative_id,composition_of_members.* from members_composition_of_cooperative left join composition_of_members on members_composition_of_cooperative.composition=composition_of_members.id  where members_composition_of_cooperative.coop_id='$coopid'");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data[]=$row;
        }
      }
      else
      {
        $data = NULL;
      }
      echo json_encode($data);
    }

    public function get_major_industry($amended_major_industry)
    {
      $query = $this->db->get('major_industry');
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $row['amended_major_industry'] = $amended_major_industry;
          $data[] = asort($row);
        }
      
      }
      else
      {
        $data =NULL;
      }
        return $data;

    }

    public function get_coopTypeID($type_name)
    {
      // $qry=$this->db->query("select id from cooperative_type where name IN('$type_name')");//'cooperative_type',array('name'=>$type_name));
      $qry = $this->db->select('id')->where_in('name',$type_name)->get('cooperative_type');

      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data = $row['id'];
        }
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }

    public function industry_subclass_per_coop_type($cooptype_ID)
    {
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id={$cooptype_ID}");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data[]= $row;
        }
      }
      else
      {
        $data;
      }
      return $data;
    }

    public function major_industry_description($major_id)
    {
      $query = $this->db->get_where('major_industry',array('id'=>$major_id));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

    public function major_industry_description2($major_id)
    {
      $query = $this->db->query("select * from major_industry where id=".$major_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

    public function major_industry_subclass_id($major_id)
    {
      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

    public function major_industry_description_subclass3($subclass_id)
    {
      $query = $this->db->query("select description from subclass where id=".$subclass_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    public function major_industry_description_subclass($subclass_id)
    {
      $query = $this->db->query("select * from subclass where id=".$subclass_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    public function major_industry_description_subclass22($subclass_id)
    {
      $query = $this->db->query("select description from subclass where id=".$subclass_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    public function major_industry_description_subclass2($subclass_id)
    {
      $query = $this->db->get_where('subclass',array('id'=>$subclass_id));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    //AJAX REQUEST
    //for registration
    public function get_major_industry_ajax()
    {
    	$coop_type_id = $this->input->post('cooptype_');
    	$qry = $this->db->query("select distinct industry_subclass_by_coop_type.major_industry_id,major_industry.description from industry_subclass_by_coop_type left join major_industry on industry_subclass_by_coop_type.major_industry_id = major_industry.id where cooperative_type_id='$coop_type_id'");
    	if($qry->num_rows()>0)
    	{
    		foreach($qry->result_array() as $row)
    		{
    			// $row['description'] = $this->major_industry_subclass_id($row['major_industry_id']);
    			$data[] = $row;
    		}
    		echo json_encode($data);
    	}
    }

    public function get_coopTypeID_ajax()
    {
      $coop_type_name = $this->input->post('cooptype_');

      $qry=$this->db->get_where('cooperative_type',array('name'=>$coop_type_name));
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
         $cooptype_id= $row['id'];
        }
        $qry_major_ins_id = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id={$cooptype_id}");
          foreach($qry_major_ins_id->result_array() as $mrow)
          {
            $major_id[] = $mrow['major_industry_id'];
          }
          // $this->debug($major_id);
          foreach($major_id as $row_id_major)
          {
           $major_description[] = $this->major_industry_description_ajax($row_id_major);
           $subclass_ID[] = $this->major_industry_subclass_id_ajax($row_id_major);
          }
          // $this->debug($subclass_ID);
      }
      else
      {
        $data = "no data";
      }
      $major_description = array_filter($major_description);
     echo json_encode(array_filter($major_description));
    }

    //for update
    public function major_industry_ajax_()
    {
      // $amendment_id= $this->encryption->decrypt(decrypt_custom($this->input->post('ids')));
       $amendment_id =96;
      $qry=$this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data_cooperative_type_id[] = $row['cooperative_type_id'];
          $data[] = $row;
        }
        foreach($data_cooperative_type_id as $row_cid)
        {
          
          $mj[]=$this->list_of_majorindustry($row_cid);
        }
        echo json_encode($mj);
      }
      
    }

    //end updata
      //list of major industry
    public function list_of_majorindustry2($cooperativetype_id)
    {
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id='$cooperativetype_id'");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['major_description'] = $this->major_industry_description2($row['major_industry_id']);
          $data[] =$row;
        }
        return $data;
      }

    }
    //list of major subclass 

    //list of major industry
    public function list_of_majorindustry($cooperativetype_id)
    {
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id='$cooperativetype_id'");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['major_description'] = $this->major_industry_description2($row['major_industry_id']);
          $data =$row;
        }
        return $data;
      }

    }
    //list of major subclass 
    public function list_of_subclasss($major_id)
    {
      $qry = $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where major_industry_id=".$major_id);
      // return $this->db->last_query();
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          // $row['subclass_description']= $this->major_industry_description_subclass($row['subclass_id']);
          $data[] =$row;
        }
        return $data;
      }

    }
    //list of major subclass per coop type
    public function list_of_subclasss_per_coop_type($cooperative_type_id)
    {
      $qry = $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where cooperative_type_id=".$cooperative_type_id);
      // return $this->db->last_query();
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['subclass_description']= $this->major_industry_description_subclass22($row['subclass_id']);
          $data[] =$row;
        }
        return $data;
      }

    }

    public function major_industry_subclass_id_ajax($major_id)
    {
      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }


     public function major_industry_description_ajax($major_id)
    {
      $query = $this->db->query("select id,description from major_industry where id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return array_filter($data);
    }

    public function major_industry_description_subclass_ajax()
    {
    $id_subclass= $this->input->post('major_types');

      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id='$id_subclass'");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $sub_class_id[] = $row['subclass_id'];
        }

        foreach($sub_class_id as $index=> $row_subclass_id)
        {
        	$query_subclass = $this->db->query("select id as sub_class_id,description as subclass_description from subclass where id={$row_subclass_id}");
        	if($query_subclass->num_rows()>0)
        	{
        		foreach($query_subclass->result_array() as $row_subclass)
        		{
        			$data[]=$row_subclass;
        		}
        	}
        	else
        	{
        		$data='dd';
        	}
        }
      }
      else
      {
        $data= $this->db->last_query();
      }
    echo json_encode($data);
    // die();
    }

    public function get_specific_subclassAjax()
    {
    	$id = $this->encryption->decrypt(decrypt_custom($this->input->post("amd_id"))); 
    	$qry = $this->db->query("select amt_baca.*, industry_subclass_by_coop_type.id as ins_id, industry_subclass_by_coop_type.major_industry_id as ins_major_ins_id, industry_subclass_by_coop_type.subclass_id as ins_subclass_id,subclass.description as subclass_description from business_activities_cooperative_amendment as amt_baca left join industry_subclass_by_coop_type on amt_baca.industry_subclass_by_coop_type_id= industry_subclass_by_coop_type.id left join subclass on industry_subclass_by_coop_type.subclass_id=subclass.id where amt_baca.amendment_id='$id'");
    	if($qry->num_rows()>0)
    	{
    		foreach($qry->result() as $row)
    		{
    			echo json_encode($row);
    		}
    	}
    	// echo json_encode($id);
    }

    public function cooperative_type_ajax()
    {
      $qry = $this->db->get('cooperative_type');
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      echo json_encode($data);
    }
    //END AJAX REQUEST

    public function check_amendment_name_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        ini_set('memory_limit', '-1');
        $data='';
        $proposed_name = strtolower($this->input->get('fieldValue'));
        $type_of_coop = $this->input->get('typeOfCooperative_value');
        $coop_id = $this->input->get('cooperative_idss');
        $qry = $this->db->query("select cooperative_id,cooperative_type_id,proposed_name from amend_coop where cooperative_id='$coop_id'");
        // echo $this->db->last_query();
        if($qry->num_rows()>0)
        {
            foreach($qry->result_array() as $row)
            {
              $coopType_id = $row['cooperative_type_id'];
              $proposed_names = $row['proposed_name'];
            }
              if($coopType_id == $type_of_coop && strcasecmp($proposed_name,$proposed_names)==0)
              {
                $data=  true  ;
              }
              else
              {
                  $qrys = $this->db->query("select cooperative_id,cooperative_type_id,proposed_name from amend_coop where cooperative_id!=$coop_id");
                  if($qrys->num_rows()>0)
                  {
                    $coopType_id_ = $row['cooperative_type_id'];
                    $proposed_names_ = $row['proposed_name'];
                     if($coopType_id_ == $type_of_coop && strcasecmp($proposed_name,$proposed_names_)==0)
                      {
                        $data=false;
                      }
                      else
                      {
                        $data = true;
                      }
                  }
                  else
                  {
                     $data = true;
                  }
              }
        }
        else
        {
          //get total rows in cooperatives table
          $qrow = $this->db->query("select id from cooperatives");
          $total_rows = $qrow->num_rows(); 
          $coop_query = $this->db->query("select id,proposed_name,type_of_cooperative from cooperatives limit ".$total_rows);
          $c=count($coop_query->result_array());
          $crow=$coop_query->result_array();
          $a=1;
            for($i =0;  $i < $c; $i++)
            {

              $crow[$i]['input_coop_id'] = $coop_id;
              $crow[$i]['input_type_coop_id'] = $type_of_coop;
              $crow[$i]['input_prosposed_name'] = $proposed_name;
              $coopid_db = $crow[$i]['id'];
              $proposed_name_coop = $crow[$i]['proposed_name'];
               // echo"<pre>"; print_r($crow[$i]);echo"</pre>";
              $coop_typeName = $crow[$i]['type_of_cooperative'];
              // echo $coop_typeName;
             $coop_typeID['id']= $this->get_coopTypeID($coop_typeName);
        
              $crow[$i]['cooperative_type_id'] =   $coop_typeID['id'];
              $crow[$i]['compare']='';
              // echo json_encode(array($c=>$i,$crow[$i]['proposed_name'] => $crow[$i]['input_prosposed_name']));

              if(strcasecmp($crow[$i]['proposed_name'],$crow[$i]['input_prosposed_name'])==0 && $crow[$i]['input_type_coop_id']==$crow[$i]['cooperative_type_id'] &&  $crow[$i]['input_coop_id']==$crow[$i]['id'])
              {
                 $crow[$i]['compare']='true'; 
              }
              elseif(strcasecmp($crow[$i]['proposed_name'],$crow[$i]['input_prosposed_name'])==0 && $crow[$i]['input_type_coop_id']==$crow[$i]['cooperative_type_id'] && $crow[$i]['input_coop_id']!=$crow[$i]['id'])
              {
                
                // echo json_encode(array($crow[$i]['proposed_name']=>$crow[$i]['input_prosposed_name'],$crow[$i]['input_type_coop_id']=>$crow[$i]['cooperative_type_id']));
                //name and type of coop exist and no the same coop id
                $crow[$i]['compare']='false'; 
                // json_encode(array($this->input->get("fieldId"),false));
                // exit();

              }
              elseif(strcasecmp($crow[$i]['proposed_name'],$crow[$i]['input_prosposed_name'])==0 && $crow[$i]['input_type_coop_id']!=$crow[$i]['cooperative_type_id'])
              {
                $crow[$i]['compare']='false';  // echo json_encode("dfadfa");
              }
              else
              {
                // $crow['compare'] ="matched available";
                $crow[$i]['compare']='true';   //echo json_encode("eeee");
              }
              // $d[] = array($crow['input_coop_id'],$coopid_db = $crow['id'], $crow['input_prosposed_name'],$crow['proposed_name'],  $crow['input_type_coop_id'],  $crow['cooperative_type_id']);
              $compare_array[] = $crow[$i]['compare'];
          // echo"success";
            } //end of for loop
            if(is_array($compare_array))
            {
               if(in_array('false',$compare_array))
               {
                $data = false;
               }
               else
               {
                $data = true;
               }
            }
            else
            {
              echo "invalid";
            }
        }
        // echo json_encode( $data);
        echo json_encode(array($this->input->get("fieldId"),$data));
      }
    }

    public function amendment_info()
    {
    	$amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id')));
    	$result = $this->amendment_model->amendment_info($amendment_id);
    	echo json_encode($result);
    }

    public function coop_capitalization($cooperative_id)
    {
      $qry =$this->db->query("select * from capitalization where cooperatives_id='$cooperative_id'");
      if($qry->num_rows()>0)
      {
        $data = $qry->row();
      }
      else
      {
        $data  ='No data found.';
      }
      return $data;
    }
    public function amendment_capitalization($amendment_id)
    {
      $qry =$this->db->query("select * from amendment_capitalization where amendment_id='$amendment_id'");
      if($qry->num_rows()>0)
      {
        $data = $qry->row();
      }
      else
      {
        $data  ='No data found.';
      }
      return $data;
    }

    public function debug($array)
    {
    		echo"<pre>";
    		print_r($array);
    		echo"</pre>";
    }
  }
 ?>
