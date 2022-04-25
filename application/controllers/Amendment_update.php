<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_update extends CI_Controller{
 
    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      // $this->load->model('amendment_update_model');
      $this->load->model('amendment_uploaded_document_model');
    }
    
    public function index()
    {
      echo'index';
    }


    public function view($id = null){
     $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $coop_id = $this->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
              $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Amendment Details';
              $data['header'] = 'Amendment Information';
              $data['coop_info'] = $this->amendment_update_model->get_coop_info2($decoded_id);
              $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($coop_id,$decoded_id);
              $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);

              $data['coop_type_compare'] = false;
              if($data['coop_info_primary']!=NULL)
              {
                   if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                    {
                       $data['coop_type_compare'] = true;
                    }
              }
               
              
              $data['coop_type'] = $this->amendment_update_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
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
                              
                                $data['ga_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($decoded_id,19);
                                 $data['bod_sec_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($decoded_id,20);
                                if($data['coop_type_compare'])
                                {
                                   $data['status_document_cooptype'] = true;
                                } 
                                else
                                {
                                    if(in_array('false', $complete_upload))
                                    {
                                      $data['status_document_cooptype'] = false;
                                    }
                                    else
                                    {
                                      $data['status_document_cooptype'] = true;
                                    }
                                }
                                
                                
              $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($decoded_id);

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$decoded_id) : true;
  
//              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_update_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperative_id']=encrypt_custom($this->encryption->encrypt($coop_id));
              $data['encrypted_id'] = $id;
    
              /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
              $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_capitalization_model->check_capitalization_primary_complete($coop_id,$decoded_id) : true;
              // $this->debug(  $data['capitalization_complete']);
              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_update_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
         
              // if($data['cooperator_complete']==false) {
              //   $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
              // }
              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              if($data['committees_complete']==false) {
                $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              }

              $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$decoded_id); 
              // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
              
              // $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);

              // $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              // $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
              $data['submitted'] = $this->amendment_update_model->check_submitted_for_evaluation($coop_id,$decoded_id);
              $data['members_composition'] =  $this->amendment_update_model->amendment_composition($decoded_id);//get_coop_composition($decoded_id);
              $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
              if($data['committeescount']==0) {
                $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad($decoded_id);
              }
                 //position 
                       $data['election'] = $this->committee_model->check_position($decoded_id,"Election");
                        $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");            
                        $data['ethics'] = $this->committee_model->check_position($decoded_id,"Ethics");
                        $data['media_concil'] = $this->committee_model->check_position($decoded_id,"Mediation and Conciliation");
                        $data['gender_dev'] = $this->committee_model->check_position($decoded_id,"Gender and Development");
                        $data['audit'] = $this->committee_model->check_position($decoded_id,"Audit");

                  //end position
                         $count_type ='';
                        $type_coop_array_ = explode(',',$data['coop_info']->type_of_cooperative);
                        $count_type = count($type_coop_array_);
                        $data['complete_position']=false;
                        if($count_type > 1)
                        {
                             if(in_array('Credit', $type_coop_array_) || in_array('Agriculture', $type_coop_array_))
                            {
                               $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                              if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                            else
                            {
                               $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                        }
                        else
                        {
                           $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                        }
                        
                        
                        $data['director_comment'] = $this->amendment_update_model->admin_comment($decoded_id,3);
                        $data['have_director_comment'] = $this->amendment_update_model->admin_comment_value($decoded_id,3);
                        $data['deffered_comment'] = $this->amendment_update_model->client_diferred_comment($decoded_id);
                        $data['denied_comment'] = $this->amendment_update_model->client_denied_comment($decoded_id);
                        // $this->debug($data['denied_comment']);
                  //download payment      
                  $data['coop_capitalization']=$this->coop_capitalization($coop_id);
                  $data['amendment_capitalization']= $this->amendment_capitalization($decoded_id);      
                  $data['name_reservation_fee']=100.00;
                  $data['pay_from']='reservation'; 
                  if($this->Payment_model->get_payment_info_amendment($decoded_id)!=NULL)
                  {
                   $data['ref_no'] = $this->Payment_model->get_payment_info_amendment($decoded_id)->refNo;
                  }
                  else
                  {
                    $data['ref_no'] = NULL;
                  }
                 
                
                  if($this->amendment_update_model->if_had_amendment($data['coop_info']->regNo,$decoded_id))
                  { //next amendment
                    $data['coop_info_orig']= $this->amendment_update_model->get_last_amendment_info($data['coop_info']->regNo);
                    // echo $this->db->last_query();
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym.')';
                    }
                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                    }
                    else
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                    }
                  }
                  else
                  { //first amendment
                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym_name)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym_name.')';
                    }
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                  }

                   // $data['acting_director'] = $this->admin_model->check_director_supervising($data['coop_info']->rCode);
                  //end of download payment   
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } 
            
               $data['is_deferred'] = $this->amendment_update_model->if_past_deffered($decoded_id);

              $this->load->view('./template/header', $data);
              $this->load->view('update/amendment/amendment_update_details', $data);
              $this->load->view('update/amendment/approve_amendment_modal',$data);
              $this->load->view('./template/footer');
          }
          else
          { 
            if($this->session->userdata('access_level') == 6){

              $data['title'] = 'Amendment Details';
              $data['header'] = 'Amendment Information';
              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

              $data['coop_info'] = $this->amendment_update_model->get_coop_info2($decoded_id);
              $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($coop_id,$decoded_id);
              $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);

              $data['coop_type_compare'] = false;
              if($data['coop_info_primary']!=NULL)
              {
                   if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                    {
                       $data['coop_type_compare'] = true;
                    }
              }
               
              
              $data['coop_type'] = $this->amendment_update_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
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
                              
                                $data['ga_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($decoded_id,19);
                                 $data['bod_sec_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($decoded_id,20);
                                if($data['coop_type_compare'])
                                {
                                   $data['status_document_cooptype'] = true;
                                } 
                                else
                                {
                                    if(in_array('false', $complete_upload))
                                    {
                                      $data['status_document_cooptype'] = false;
                                    }
                                    else
                                    {
                                      $data['status_document_cooptype'] = true;
                                    }
                                }
                                
                                
              $data['business_activities'] =  $this->amendment_update_model->get_all_business_activities($decoded_id);

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$decoded_id) : true;
  
//              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_update_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperative_id']=encrypt_custom($this->encryption->encrypt($coop_id));
              $data['encrypted_id'] = $id;
    
              /*BEGIN: UPDATE FOR CAPITALIZATION --by Fred */
              $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_capitalization_model->check_capitalization_primary_complete($coop_id,$decoded_id) : true;
              // $this->debug(  $data['capitalization_complete']);
              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_update_model->check_article_primary_complete($decoded_id) : true;
              $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
         
              // if($data['cooperator_complete']==false) {
              //   $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$decoded_id);
              // }
              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              if($data['committees_complete']==false) {
                $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
              }
              $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$decoded_id); 
             
              // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
              
              // $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);

              // $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
              // $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
              $data['submitted'] = $this->amendment_update_model->check_submitted_for_evaluation($coop_id,$decoded_id);
              $data['members_composition'] =  $this->amendment_update_model->amendment_composition($decoded_id);
              $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($decoded_id);
              if($data['committeescount']==0) {
                $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad($decoded_id);
              }
                 //position 
                       $data['election'] = $this->committee_model->check_position($decoded_id,"Election");
                        $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");            
                        $data['ethics'] = $this->committee_model->check_position($decoded_id,"Ethics");
                        $data['media_concil'] = $this->committee_model->check_position($decoded_id,"Mediation and Conciliation");
                        $data['gender_dev'] = $this->committee_model->check_position($decoded_id,"Gender and Development");
                        $data['audit'] = $this->committee_model->check_position($decoded_id,"Audit");

                  //end position
                         $count_type ='';
                        $type_coop_array_ = explode(',',$data['coop_info']->type_of_cooperative);
                        $count_type = count($type_coop_array_);
                        $data['complete_position']=false;
                        if($count_type > 1)
                        {
                             if(in_array('Credit', $type_coop_array_) || in_array('Agriculture', $type_coop_array_))
                            {
                               $data['credit'] = $this->committee_model->check_position($decoded_id,"Credit");
                              if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                            else
                            {
                               $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                        }
                        else
                        {
                           $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                        }
                        
                        
                        $data['director_comment'] = $this->amendment_update_model->admin_comment($decoded_id,3);
                        $data['have_director_comment'] = $this->amendment_update_model->admin_comment_value($decoded_id,3);
                        $data['deffered_comment'] = $this->amendment_update_model->client_diferred_comment($decoded_id);
                        $data['denied_comment'] = $this->amendment_update_model->client_denied_comment($decoded_id);
                        // $this->debug($data['denied_comment']);
                  //download payment      
                  $data['coop_capitalization']=$this->coop_capitalization($coop_id);
                  $data['amendment_capitalization']= $this->amendment_capitalization($decoded_id);      
                  $data['name_reservation_fee']=100.00;
                  $data['pay_from']='reservation'; 
                  if($this->Payment_model->get_payment_info_amendment($decoded_id)!=NULL)
                  {
                   $data['ref_no'] = $this->Payment_model->get_payment_info_amendment($decoded_id)->refNo;
                  }
                  else
                  {
                    $data['ref_no'] = NULL;
                  }
                 
                
                  if($this->amendment_update_model->if_had_amendment($data['coop_info']->regNo,$decoded_id))
                  { //next amendment
                    $data['coop_info_orig']= $this->amendment_update_model->get_last_amendment_info($data['coop_info']->regNo);
                    // echo $this->db->last_query();
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym.')';
                    }
                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                    }
                    else
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                    }
                  }
                  else
                  { //first amendment
                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym_name)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym_name.')';
                    }
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                  }

                   // $data['acting_director'] = $this->admin_model->check_director_supervising($data['coop_info']->rCode);
                  //end of download payment   
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } 
                  $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['coop_info']->regNo);
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('update/amendment/approve_amendment_modal',$data);
                  $this->load->view('update/amendment/amendment_update_details', $data);
                  $this->load->view('update/amendment/approve_amendment_modal',$data);
                  // $this->load->view('cooperative/amendment_details', $data);
                  // $this->load->view('amendment/evaluation/approve_modal_cooperative',$data);
                  // $this->load->view('amendment/evaluation/deny_modal_cooperative',$data);
                  //  $this->load->view('amendment/evaluation/revert_modal',$data);
                  // $this->load->view('amendment/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('templates/admin_footer');
            }
            else
            {
              echo"Unauthorized";
            }
            
          }
        }else{
          show_404();
        }
      }
    }


      public function update($id = null){ 
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{ 
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $cooperative_id = $this->coop_dtl($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        $user_id = $this->session->userdata('user_id');
        $data['encrypted_id'] = $id;
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->amendment_update_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
              // if(!$this->amendment_update_model->check_submitted_for_evaluation_client($cooperative_id,$decoded_id)){
//                if($this->form_validation->run() == FALSE){
                if(!isset($_POST['amendmentAddBtn']))
                {
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  // echo $this->db->last_query();
                  $data['title'] = 'Update Amendment Details';
                  $data['header'] = 'Update Amendment Information';
                  $data['coop_info'] = $this->amendment_update_model->get_coop_info2($decoded_id);
                  $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
                  $data['name_of_coop_primary'] = $this->amendment_update_model->name_coop_primary($data['client_info']->regno);
                  $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                  $coopTypeName= $data['coop_info']->type_of_cooperative;
                  $typeName_arr = explode(',',$coopTypeName);
                  $list_of_major_industry_cooptype =$this->major_industry_model->get_major_industries_by_type_name($coopTypeName);
                  $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  $list_coop_type_id[] =$this->get_coopTypeID($typeName_arr); 

                  $data['members_composition'] = $this->amendment_update_model->get_coop_composition($decoded_id);
                  // echo $this->db->last_query();
                 //get major industry id
                  // var_dump(count($list_coop_type_id));
                  if(count($list_coop_type_id)>1)
                  {
                    foreach($list_coop_type_id as $row_coop_type_id)
                    {   
                      //get major class industry id
                        $mjor_ins_id[]=$this->industry_subclass_per_coop_type($row_coop_type_id);

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
                  }  
                  

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
                  $data['business_activities'] = $this->amendment_update_model->get_all_business_activities($decoded_id);
                  $data['major_industry_list'] = $this->amendment_update_model->get_all_major_industry($decoded_id);
                  $data['composition']= $this->amendment_update_model->get_composition();
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
                      $brow['major_description_']=$this->amendment_update_model->major_industry_description2($major_id);
                   
                      $brow['subclass_description_']=$this->major_industry_description_subclass2($brow['subclass_id']);
                     
                      $cooptype_id_array[] = explode(',',$data['coop_info']->cooperative_type_id);
                      $brow['load_major'] =  $list_majors;
                      $brow['load_subclass'] = $list_subclass;
                      $business_data[] =$brow;

                       // $this->debug( $business_data);
                        $data['list_of_major_industry_']= $business_data;

                        // $this->debug( $data['list_of_major_industry_']);
                      if($data['coop_info2']->type_of_cooperative !='Union')
                      {  
                        foreach($cooptype_id_array as $ctype_id)
                        {
                          $mdata[] = $this->list_of_majorindustry($ctype_id);
                        }
                     
                        $data['mjor_list']=$mdata;
                     
                        foreach($mdata as $m)
                        {
                            $subclass_data[]=$this->list_of_subclasss($m['major_industry_id']);
                        }

                       foreach($subclass_data as $sdata){
                        foreach($sdata as $srow)
                        {
                          $list_subclass[]= $this->major_industry_description_subclass($srow['subclass_id']);
                        }
                       }

                       $data['list_subclass'] = $list_subclass;
                      }   

                    }
                  }
                  // $data['members_compositions']=$this->amendment_update_model->get_composition_of_members($decoded_id);
                  // $this->debug( $data['members_composition']); 
                  $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  //cooperative type value
                  $data['amd_type_of_coop'] = $typeName_arr;

                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);

                  }
               
                  if(strlen($data['client_info']->regno) ==0)
                  {
                     $data['regNo'] =$this->amendment_update_model->load_regNo($user_id);
                  }
                  else
                  {
                     $data['regNo'] = $this->amendment_update_model->load_regNo_reg($user_id);
                  }

                  $data['date_diff_Reg'] =false;
                  $date_diff_reg = $this->amendment_update_model->year_registered($data['regNo']);
                  if($date_diff_reg>=2)
                  {
                     $data['date_diff_Reg'] = true;
                  }
                  if($date_diff_reg ==NULL)
                  {
                    $date_diff_reg = $this->amendment_update_model->year_registered2($data['regNo']); 
                     if($date_diff_reg>=2)
                    {
                     $data['date_diff_Reg'] = true;
                   }
                  }   
                  // var_dump($date_diff_reg);
                  if(isset($data['coop_info2']))
                  {
                  $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info2']->rCode);
                  $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info2']->pCode);
                  $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info2']->cCode);
                  }

                  // $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                   $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);
                  $this->load->view('./template/header', $data);
                  $this->load->view('update/amendment/amendment_update_info', $data);
                  $this->load->view('./template/footer', $data);
                }else{ //trigger submit button
                  // $cooperative_id = $this->coop_dtl($decoded_id);
                  // if(!$this->amendment_update_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                    $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));  
                    // $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    // $members_composition = $this->input->post('compositionOfMembers');
             
                   
                      $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                      $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));

                       // $type_of_cooperativeName = $this->format_name($typeOfCooperative);
                      $field_memship ='';
                      $name_of_ins_assoc ='';
                      if($this->input->post('commonBondOfMembership')=='Institutional')
                      {
                             $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
                              $field_memship =$this->input->post('field_membership');
                      }
                      else if($this->input->post('commonBondOfMembership')=='Associational')
                      {
                            $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
                            $field_memship =$this->input->post('field_membership');
                      }
                       else if($this->input->post('commonBondOfMembership')=='Occupational')
                      {
                            $name_of_ins_assoc ='';
                            $field_memship ='';

                      } 

                      // $proposeName = strtolower($this->input->post('proposedName'));
                      $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);

                      $occu_comp_of_membship='';
                      if(is_array($this->input->post('compositionOfMembers'))>0)
                      {
                        $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembers'));
                      }    
                      // $this->debug( $occu_comp_of_membship);
                             
                       $group='';

                       $interregional='';
                       $regions='';
                       if($this->input->post('interregional')!=NULL)
                       {
                        $interregional= implode(',',$this->input->post('interregional'));
                       }
                        if($this->input->post('regions')!=NULL)
                       {
                         $regions= implode(',',$this->input->post('regions'));
                       }
                       else
                       {
                        $regions = $this->input->post('region');
                       }
                       $cooperativeType_id =  implode(',',$this->input->post('typeOfCooperative'));

                        $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
                        // if(in_array('Workers',explode(',',$type_of_cooperativeName))  || in_array('Labor Service',explode(',',$type_of_cooperativeName)))
                        // {
                        //    $commonBondOFmembership = $this->input->post('commonBond2');
                        // }
                        // else
                        // {
                        //   $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
                        // }
                       
                        $grouping_ ='';
                        if(($type_of_cooperativeName =='Union') && $this->input->post('categoryOfCooperative')=='Others')
                        {
                          $grouping_='Union';
                        }
                        if($this->input->post('categoryOfCooperative')=='Secondary' || $this->input->post('categoryOfCooperative')=='Tertiary')
                        {
                          $grouping_='Federation';
                        }
                       
                    $cooperative_id = $this->coop_dtl($decoded_id);
                    $field_data = array(
                      'amendmentNo'=> $this->input->post('amendmentNo'),
                      'users_id' => $this->session->userdata('user_id'),
                      'cooperative_id'=> $cooperative_id,
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'type_of_cooperative' =>   $type_of_cooperativeName,
                      'cooperative_type_id' => $cooperativeType_id,
                      'grouping' => $grouping_,
                      'common_bond_of_membership' => $commonBondOFmembership,
                      'comp_of_membership' =>$occu_comp_of_membship,
                      'field_of_membership' => $field_memship,
                      'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay_'),//$this->input->post('barangay'),
                      'interregional' =>$interregional,
                      'regions'=>$regions,
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                    );
                  // $this->debug($field_data);
                    $data_bylaws = array(
                      'cooperatives_id' => $cooperative_id,
                      'amendment_id' =>$decoded_id,
                      'annual_regular_meeting_day_date'=> $this->input->post('annaul_date_venue'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('assembly_venue'),
                      'type' => $this->input->post('type')
                    );
                    if($this->amendment_update_model->check_has_bylaws($decoded_id))
                     {
                        $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$decoded_id));
                       
                     }
                     else
                     {
                        $bylaw_info_coop = $this->amendment_update_model->cooperative_by_laws($cooperative_id,$decoded_id);
                        if($bylaw_info_coop !=NULL)
                        {  echo'ss';
                           unset($bylaw_info_coop['directors_term']);
                           if($this->db->insert('amendment_bylaws',$bylaw_info_coop))
                           {
                             $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$decoded_id));
                           }
                        }
                        else
                        { 
                          $this->db->insert('amendment_bylaws',$data_bylaws);
                        }
                     }



                    //  $coo_info_by_admin= $this->amendment_update_model->get_coop_info2($decoded_id);
                    // if($coo_info_by_admin->type_of_cooperative != $field_data['type_of_cooperative'])
                    // {
                        $cooptypess = explode(',',$field_data['type_of_cooperative']); 
                        foreach($cooptypess as $type_coop)
                        {
                           $temp_purpose[] = array(
                            'cooperatives_id' => $cooperative_id,
                            'amendment_id' => $decoded_id,
                            'content'  => $this->amendment_update_model->get_purpose_content($type_coop),
                            'cooperative_type' => $type_coop
                          ); 
                            // $this->debug($temp_purpose);
                        } 
                        if($this->db->delete('amendment_purposes',array('amendment_id'=>$decoded_id)))
                        {
                          $this->db->insert_batch('amendment_purposes',$temp_purpose);
                        }
                    // }
                    // var_dump($this->amendment_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$major_industry,$data_bylaws));
                    if($this->amendment_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$major_industry,$data_bylaws)){
                       $this->session->set_flashdata(array('msg_class'=>'success','amendment_msg'=>'Successfully updated basic information.'));
                      redirect(base_url('/amendment_update/'.$this->input->post('amendment_id').'/update'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', '');
                        $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Unable to update cooperative basic information.'));
                      redirect('amendment_update/'.$this->input->post('amendment_id'));
                    }
                 
                  }
           
          }else{
            $access_level = array(6);
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            // }else if($this->session->userdata('access_level')!=1){
            }else if(!in_array($this->session->userdata('access_level'),$access_level)){  
              redirect('amendment');
            }
            else
            {
                
              if(!isset($_POST['amendmentAddBtn']))
              {
                   $admin_user_id = $this->session->userdata('user_id');
                  $user_id = $this->amendment_update_model->user_info_by_amendment_id($decoded_id)->users_id;
                  // echo $this->db->last_query();
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  // $this->debug($data['client_info']);
                  $data['members_composition'] = $this->amendment_update_model->get_coop_composition($decoded_id);
                  $data['title'] = 'Update Cooperative Details';
                  $data['header'] = 'Update Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
                  $data['coop_info'] = $this->amendment_update_model->get_coop_info2($decoded_id);
                  $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
                  $data['name_of_coop_primary'] = $this->amendment_update_model->name_coop_primary($data['client_info']->regno);

                  $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                  $coopTypeName= $data['coop_info']->type_of_cooperative;
                  $typeName_arr = explode(',',$coopTypeName);
                  $list_of_major_industry_cooptype =$this->major_industry_model->get_major_industries_by_type_name($coopTypeName);
                  $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  $list_coop_type_id[] =$this->get_coopTypeID($typeName_arr); 

                  $data['members_composition'] = $this->amendment_update_model->get_coop_composition($decoded_id);
                 //get major industry id
                  // var_dump(count($list_coop_type_id));
                  if(count($list_coop_type_id)>1)
                  {
                    foreach($list_coop_type_id as $row_coop_type_id)
                    {   
                      //get major class industry id
                        $mjor_ins_id[]=$this->industry_subclass_per_coop_type($row_coop_type_id);

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
                  }  
                  

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
                  $data['business_activities'] = $this->amendment_update_model->get_all_business_activities($decoded_id);
                  $data['major_industry_list'] = $this->amendment_update_model->get_all_major_industry($decoded_id);
                  $data['composition']= $this->amendment_update_model->get_composition();
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
                      $brow['major_description_']=$this->amendment_update_model->major_industry_description2($major_id);
                   
                      $brow['subclass_description_']=$this->major_industry_description_subclass2($brow['subclass_id']);
                     
                      $cooptype_id_array[] = explode(',',$data['coop_info']->cooperative_type_id);
                      $brow['load_major'] =  $list_majors;
                      $brow['load_subclass'] = $list_subclass;
                      $business_data[] =$brow;

                       // $this->debug( $business_data);
                        $data['list_of_major_industry_']= $business_data;

                        // $this->debug( $data['list_of_major_industry_']);
                      if($data['coop_info2']->type_of_cooperative !='Union')
                      {    
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

                         foreach($subclass_data as $sdata){
                          foreach($sdata as $srow)
                          {
                            $list_subclass[]= $this->major_industry_description_subclass($srow['subclass_id']);
                          }
                         }

                         $data['list_subclass'] = $list_subclass;
                      }   
                    }
                  }
                  // $data['members_compositions']=$this->amendment_update_model->get_composition_of_members($decoded_id);
                  // $this->debug( $data['members_composition']); 
                  $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  //cooperative type value
                  $data['amd_type_of_coop'] = $typeName_arr;

                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);

                  }
               
                  if(strlen($data['client_info']->regno) ==0)
                  {
                     $data['regNo'] =$this->amendment_update_model->load_regNo($user_id);
                  }
                  else
                  {
                     $data['regNo'] = $this->amendment_update_model->load_regNo_reg($user_id);
                  }

                  $data['date_diff_Reg'] =false;
                  $date_diff_reg = $this->amendment_update_model->year_registered($data['regNo']);
                  if($date_diff_reg>=2)
                  {
                     $data['date_diff_Reg'] = true;
                  }
                  if($date_diff_reg ==NULL)
                  {
                    $date_diff_reg = $this->amendment_update_model->year_registered2($data['regNo']); 
                     if($date_diff_reg>=2)
                    {
                     $data['date_diff_Reg'] = true;
                   }
                  }   
                  // var_dump($date_diff_reg);
                  if(isset($data['coop_info2']))
                  {
                  $data['list_of_provinces'] = $this->amendment_update_model->get_provinces($data['coop_info2']->rCode);
                  $data['list_of_cities'] = $this->amendment_update_model->get_cities($data['coop_info2']->pCode);
                  $data['list_of_brgys'] = $this->amendment_update_model->get_brgys($data['coop_info2']->cCode);
                  }

                  // $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                   $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);
               
                    $this->load->view('./templates/admin_header', $data);
                    $this->load->view('update/amendment/amendment_update_info', $data);
                    $this->load->view('./templates/admin_footer', $data);
              }
              else
              {
                  $user_id = $this->amendment_update_model->user_info_by_amendment_id($decoded_id)->users_id;
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 

                  $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));  
                   $cooperative_id = $this->coop_dtl($decoded_id);
                  $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
             
                   
                      $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                      $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));

                       // $type_of_cooperativeName = $this->format_name($typeOfCooperative);
                      $field_memship ='';
                      $name_of_ins_assoc ='';
                      if($this->input->post('commonBondOfMembership')=='Institutional')
                      {
                             $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
                              $field_memship =$this->input->post('field_membership');
                      }
                      else if($this->input->post('commonBondOfMembership')=='Associational')
                      {
                            $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
                            $field_memship =$this->input->post('field_membership');
                      }
                       else if($this->input->post('commonBondOfMembership')=='Occupational')
                      {
                            $name_of_ins_assoc ='';
                            $field_memship ='';
                      } 

                      // $proposeName = strtolower($this->input->post('proposedName'));
                      $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);

                      $occu_comp_of_membship='';
                      if(is_array($this->input->post('compositionOfMembers'))>0)
                      {
                        $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembers'));
                      }    
                      // $this->debug( $occu_comp_of_membship);
                             
                       $group='';

                       $interregional='';
                       $regions='';
                       if($this->input->post('interregional')!=NULL)
                       {
                        $interregional= implode(',',$this->input->post('interregional'));
                       }
                        if($this->input->post('regions')!=NULL)
                       {
                         $regions= implode(',',$this->input->post('regions'));
                       }
                       else
                       {
                        $regions = $this->input->post('region');
                       }
                       $cooperativeType_id =  implode(',',$this->input->post('typeOfCooperative'));

                        $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
                        // if(in_array('Workers',explode(',',$type_of_cooperativeName))  || in_array('Labor Service',explode(',',$type_of_cooperativeName)))
                        // {
                        //    $commonBondOFmembership = $this->input->post('commonBond2');
                        // }
                        // else
                        // {
                        //   $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
                        // }
                         $grouping_ ='';
                        if(($type_of_cooperativeName =='Union') && $this->input->post('categoryOfCooperative')=='Others')
                        {
                          $grouping_='Union';
                        }
                        if($this->input->post('categoryOfCooperative')=='Secondary' || $this->input->post('categoryOfCooperative')=='Tertiary')
                        {
                          $grouping_='Federation';
                        }
                    $cooperative_id = $this->coop_dtl($decoded_id);
                    $field_data = array(
                      'amendmentNo'=> $this->input->post('amendmentNo'),
                      'users_id' =>   $user_id,
                      'cooperative_id'=> $cooperative_id,
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposed_name'),
                      'acronym' => $this->input->post('acronym_names'),
                      'type_of_cooperative' =>   $type_of_cooperativeName,
                      'cooperative_type_id' => $cooperativeType_id,
                      'grouping' =>$grouping_,
                      'common_bond_of_membership' => $commonBondOFmembership,
                      'comp_of_membership' =>$occu_comp_of_membship,
                      'field_of_membership' => $field_memship,
                      'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay_'),//$this->input->post('barangay'),
                      'interregional' =>$interregional,
                      'regions'=>$regions,
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                    );
                    $reg_id = $this->amendment_update_model->reg_id($data['coop_info2']->regNo)->id;
                    $dateRegistered = $this->input->post('dateRegistered');     
                    $coopName = $this->input->post('proposed_name');
                    $this->db->update('registeredamendment',array('dateRegistered'=>$dateRegistered,'coopName'=>$coopName),array('id'=>$reg_id));
                   
                    $data_bylaws = array(
                      'cooperatives_id' => $cooperative_id,
                      'amendment_id' =>$decoded_id,
                      'annual_regular_meeting_day_date'=> $this->input->post('annaul_date_venue'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('assembly_venue'),
                      'type' => $this->input->post('type')
                    );
                    // $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$decoded_id));
           
         
                    $coo_info_by_admin= $this->amendment_update_model->get_coop_info2($decoded_id);
                    if($coo_info_by_admin->type_of_cooperative != $field_data['type_of_cooperative'])
                    {
                        $cooptypess = explode(',',$field_data['type_of_cooperative']); 
                        foreach($cooptypess as $type_coop)
                        {
                           $temp_purpose[] = array(
                            'cooperatives_id' => $cooperative_id,
                            'amendment_id' => $decoded_id,
                            'content'  => $this->amendment_update_model->get_purpose_content($type_coop),
                            'cooperative_type' => $type_coop
                          ); 
                            // $this->debug($temp_purpose);
                        } 
                        if($this->db->delete('amendment_purposes',array('amendment_id'=>$decoded_id)))
                        {
                          $this->db->insert_batch('amendment_purposes',$temp_purpose);
                        }
                    }
                  
                    if($this->amendment_update_model->update_not_expired_cooperative($user_id,$decoded_id,$field_data,$major_industry,$data_bylaws)){
                       $this->session->set_flashdata(array('msg_class'=>'success','amendment_msg'=>'Successfully updated basic information.'));
                      redirect(base_url('/amendment_update/'.$this->input->post('amendment_id').'/update'));
                    }else{
                        $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Unable to update cooperative basic information.'));
                      redirect('amendment_update/'.$this->input->post('amendment_id'));
                    }
                 
                  
              }
                    


            }
          }
        }else{
          show_404();
        }
      }
    }


  public function seed_data()
  {
      if(!$this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
  	$user_id = $this->session->userdata('user_id');
    $data['all_users'] = $this->user_model->get_all_users();
  	$data['client_info'] = $this->user_model->get_user_info($user_id);
  	$data['title'] = 'Update Amendment Details';
  	$data['header'] = 'Add amendment migration';
    if(!isset($_POST['submit']))
    {
      $data['list_type_coop'] = $this->list_coopType();
      $this->load->view('./template/header', $data);
      $this->load->view('update/amendment/migrate_form', $data);
      $this->load->view('./template/footer', $data);
    }
    else
    {
      $typeOfCooperativeID = $this->input->post('typeOfCooperative'); 
      $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);
        $data_cooperative = array(
          'users_id' => $this->input->post('user_id'),
        	'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
        	'type_of_cooperative' => $type_of_cooperativeName,
        	'proposed_name' => $this->input->post('proposed_name'),
        	'acronym_name' => $this->input->post('acronym_names'),
        	'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
        	'area_of_operation' => $this->input->post('areaOfOperation'),
        	'street' => $this->input->post('streetName'),
        	'house_blk_no' => $this->input->post('blkNo'),
        	'status'=>15,
          'migrated'=>1
        );
       
        if($this->amendment_update_model->add_to_coop($data_cooperative))
          {
          $application_id =   $this->amendment_update_model->get_cooperative_id_by_regNo($this->input->post('regNo'));
            $field_regcoop = array(
            'coopName' => $this->input->post('coopName'),
            'regNo' => $this->input->post('regNo'),
            'category' => $this->input->post('categoryOfCooperative'),
            'type' =>   $type_of_cooperativeName,
            // 'cooperative_type_id' => $typeOfCooperativeID,
            'dateRegistered' => $this->input->post('dateRegistered'),
            'commonBond' => $this->input->post('commonBondOfMembership'),
            // 'comp_of_membership' =>$occu_comp_of_membship,
            // 'field_of_membership' => $field_memship,
            // 'name_of_ins_assoc' => $name_of_ins_assoc,
            'areaOfOperation' => $this->input->post('areaOfOperation'),
            // 'refbrgy_brgyCode' => $this->input->post('barangay_'),//$this->input->post('barangay'),
            // 'interregional' =>$interregional,
            // 'regions'=>$regions,
            'compliant'=> $this->input->post('compliant'),
            'application_id' => $application_id,
            'compliant' =>'',
            'Street' => $this->input->post('streetName'),
            'noStreet' => $this->input->post('blkNo'),
            'migrated'=>1
            // 'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
            );
            if($this->amendment_update_model->add_to_Regcoop($field_regcoop))
            {
              var_dump($this->amendment_update_model->replicate_to_temp_table($this->input->post('regNo'),$this->input->post('user_id')));
                // if($this->amendment_update_model->seed_migration($this->input->post('regNo'),$this->input->post('user_id')))
                // {
                //   $this->session->set_flashdata(array('msg_class'=>'success','amendment_msg'=>'Successfully migrate basic information.'));
                // redirect(base_url('/amendment_update/seed_data'));
                // }
                // else{
                //   $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Unable to migrate cooperative basic information.'));
                // redirect(base_url('/amendment_update/seed_data'));
                // }  
            }
        }
    }
  }

    public function list_coopType()
    {
       $this->db->select('*');
       
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
          foreach($coop_type->result_array() as $row)
      {
        // $row['amended_type'] = explode(',',$existing_type);
        $data[] = $row;
      }
      return $data;
    }
    public function coop_type($existing_type,$category)
    {
      if($category == 'Primary')
      { 
        $except_type = array('Bank','Cooperative Bank','Insurance','Multi-Purpose','Federation','Union');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      elseif($category == 'Secondary')
      { 
       $except_type = array('Bank','Insurance','Union','Cooperative Bank','Multi-Purpose','Federation');//array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      elseif($category == 'Tertiary')
      { 
        $except_type = array('Bank','Cooperative Bank','Insurance','Union','Multi-Purpose','Federation');
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

     public function industry_subclass_per_coop_type($cooptype_ID)
    {
      $data =null;
      if(strlen($cootype_ID)>0)
      {
        $cooptype_ID=$cooptype_ID;
      }
      else
      {
        $cooptype_ID ='';
      }
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id='$cooptype_ID'");
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

    // public function major_industry_description2($major_id)
    // { 
    //   $where ="";
    //   if(strlen($major_id)>0)
    //   { 
    //      $where =" where id ='$major_id'";
    //   }
    //   $query = $this->db->query("select * from major_industry".$where);
    //   if($query->num_rows()>0)
    //   {
    //     foreach($query->result_array() as $row)
    //     {
    //       $data = $row['description'];
    //     }
    //   }
    //   else
    //   {
    //     $data= NULL;
    //   }
    //   return $data;
    // }
    


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

    public function list_of_subclasss($major_id)
    {
      if(strlen($major_id)>0)
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
      else
      {
        return null;
      }  

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

     public function list_of_majorindustry($cooperativetype_id)
    {
      $cooperativetype_id = implode(',',$cooperativetype_id);
      // var_dump($cooperativetype_id);
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id in(".$cooperativetype_id.")");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['major_description'] = $this->amendment_update_model->major_industry_description2($row['major_industry_id']);
          $data =$row;
        }
        return $data;
      }

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

    public function load_major($cooperative_type_id)
    { 
      $data=null;
      if(strlen($cooperative_type_id)>1)
      {
        $cooperative_type_id = $cooperative_type_id;
      }
      else
      {
        $cooperative_type_id='';
      }
      $qry= $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id in('$cooperative_type_id')");
      if($qry->num_rows() >0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['major_description'] =$this->amendment_update_model->major_industry_description2($row['major_industry_id']);
          // $row['subclass_id'] =$this->g_subclass($row['major_industry_id']);
          $data[] = $row;
        }
      }
      
      return $data;
    }
    public function load_subclass($cooperative_type_id)
    {
       if(strlen($cooperative_type_id)>1)
      {
        $cooperative_type_id = $cooperative_type_id;
      }
      else
      {
        $cooperative_type_id='';
      }
      $qry= $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where cooperative_type_id in('$cooperative_type_id')");
      $data = null;
      if($qry->num_rows()>0)
      {
         foreach($qry->result_array() as $row)
        {
          $row['subclass_descriptions'] = $this->major_industry_description_subclass22($row['subclass_id']);
          $data[] = $row;
        }
      }

      return $data;
    }

      public function coop_info(){
       $user_id = $this->session->userdata('user_id');
       $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
      $datas['client_info'] = $this->user_model->get_user_info($user_id);
     

         // $data = $this->amendment_update_model->get_amendment($amendment_id);
           $data = $this->amendment_update_model->get_coop_info2($amendment_id);
      
         // get business activity
         $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
          $this->db->from('business_activities_cooperative_amendment');
          $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
          $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
          $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
          $this->db->where('business_activities_cooperative_amendment.amendment_id',$amendment_id);
          $qry  = $this->db->get();
          if($qry->num_rows()>0)
          {
             $data2 = $qry->result_array(); 
          $data->business_activities = $data2;
          }
         
         //end busineess activity
         echo json_encode($data);
      // }
      // else
      // {
        
      //    $data = $this->amendment_update_model->get_coop_info2($amendment_id);
      //    // echo $this->db->last_query();
      //   $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
      //     $this->db->from('business_activities_cooperative');
      //     $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
      //     $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
      //     $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
      //     $this->db->where('business_activities_cooperative.cooperatives_id',$cooperative_id);
      //     $query = $this->db->get();
      //     // echo $this->db->last_query();
      //     if($query->num_rows()>0)
      //     {
      //            $data2 = $query->result_array();
      //          $data->business_activities = $data2;
      //     }
     
      //     echo json_encode($data);
      // }//end if had amendment
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
        $except_type = array('Cooperative Bank','Bank','Insurance','Multi-Purpose','Federation','Union');
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
        $except_type = array('Cooperative Bank','Bank','Insurance','Union','Federation');
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
        $except_type = array('Bank','Cooperative Bank','Insurance','Union','Multi-Purpose','Federation');
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
    
    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
        if(is_numeric($decoded_id) && $decoded_id!=0){
           $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
           // $this->debug($data['coop_info2']);       
           // var_dump($this->amendment_update_model->submit_to_authorized_user($decoded_id,$data['coop_info2']->rCode));
           $region_code = $data['coop_info2']->rCode;
           if($data['coop_info2']->type_of_cooperative =='Bank' || $data['coop_info2']->type_of_cooperative =='Insurance')
           {
            $region_code = '00';
           }
           // $this->debug($this->amendment_update_model->submit_to_authorized_user($decoded_id,$region_code,$user_id,$data['coop_info2']));
          if($this->amendment_update_model->submit_to_authorized_user($decoded_id,$region_code,$user_id,$data['coop_info2']))
          {                              
            $this->session->set_flashdata(array('msg_class'=>'success','amendment_msg'=>'Successfully submitted your application.'));   
            redirect('amendment_update/'.$id);                           
          }
          else
          {
             $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Unable to submit your application.')); 
              redirect('amendment_update/'.$id);   
          }
         
        }else{
          show_404();
        }
      }
    }

    public function authorized_user_submission()
    {
        if(!$this->session->userdata('logged_in')){
          redirect('users/login');
        }else{
          if($this->input->post('approveCooperativeBtn'))
          {
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
            $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
            $data['coop_info2'] = $this->amendment_update_model->get_cooperative_info($cooperative_id,$decoded_id);
             $region_code = $data['coop_info2']->rCode;
             if($data['coop_info2']->type_of_cooperative =='Bank' || $data['coop_info2']->type_of_cooperative =='Insurance')
             {
              $region_code = '00';
             }
             if($this->amendment_update_model->submit_by_authorized_user($decoded_id,$region_code))
            {                              
              $this->session->set_flashdata(array('msg_class'=>'success','amendment_msg'=>'Successfully submitted.'));   
              redirect('amendment_update/'.$this->input->post('cooperativeID'));                           
            }
            else
            {
               $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Unable to submit the application.')); 
                redirect('amendment_update/'.$this->input->post('cooperativeID'));   
            }
          }
          
        }
    }

  //REPLICATE 
    public function replicate()
    {	
    	$regNos = [];
        $query_regno = $this->db->select('regNo')->get('temp_registeredcoop');
        if($query_regno->num_rows() > 0)
        {
            $result = $query_regno->result_array();
            $regNos = array_column($result,'regNo');
        }
        $fields = $this->db->list_fields("temp_registeredcoop");
        // $this->debug($regNos);
        unset($fields['id']);
        $qry = $this->db->query("select application_id,coopName,acronym,regNo,category,type,commonBond,areaOfOperation,noStreet,Street,addrCode,compliant, DATE(CASE WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(temp_registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered from temp_registeredcoop  where dateRegistered <> '0000-00-00' order by regNo, dateRegistered");

        $process = 0;
        $success =0;
         foreach($qry->result_array() as $row)
         {
            unset($row['id']);
          $data=Array (
                'cooperative_id' => $row['application_id'],
                // 'amendment_no' => $row['']
                'coopName' =>$row['coopName'],
                'acronym' => $row['acronym'],
                'regNo' => $row['regNo'],
                'category' => $row['category'],
                'type' => $row['type'],
                'date_printed' => $row['dateRegistered'],
                'dateRegistered' =>$row['dateRegistered'],
                'commonBond' =>$row['commonBond'],
                'areaOfOperation' => $row['areaOfOperation'],
                'noStreet' => $row['noStreet'],
                'Street' => $row['Street'],
                'addrCode' => $row['addrCode'],
                'compliant' => $row['compliant'],
                'migrated'=>1
              );

            if($row['dateRegistered']!=null)
            { 
              $process++;
              if($this->db->insert('registeredamendment',$data))
              {
                $success++;
              }
            }

         }
        
           if($success == $process)
           {
            echo"success process :".$process." success :".$success;
           }
           else
           {
            echo"failed";
           }
        //  $this->debug($data);
        // foreach($regNos as $regNo)
        // {
        //     $query_records = $this->db->where('regNo', $regNo)->get("temp_registeredcoop");
        //     if($query_records->num_rows()>0)
        //     {
        //         $result2 = $query_records->result_array();
        //         //get the first record
        //         $orig = $result2[0];
        //          // $this->debug($orig);
        //         //remove the first record from array
        //         unset($result2[0]);
        //         $this->debug($result);
        //         $duplicates = $result;
        //         foreach($duplicates as $dup)
        //         {
        //             $match = true;
        //             foreach($fields as $field)
        //             {
        //                 if($orig[$field] != $dup)
        //                 {
        //                     $match  = false;
        //                 }
        //             }
        //             if(!$match)
        //             {
        //                 //put into registeredamendment array or insert into registered amendment query
        //             }
        //             //remove from registeredcoop
        //         }
        //     }
        // }
    }

    public function update_amendment_table($start_id)
    {
      // echo $start_id;
      //$start id is last registered amendment
      $query = $this->db->query("select registeredamendment.regNo,cooperatives.id,cooperatives.users_id, cooperatives.category_of_cooperative,cooperatives.type_of_cooperative,cooperatives.grouping,cooperatives.proposed_name,cooperatives.acronym_name,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,cooperatives.area_of_operation,cooperatives.refbrgy_brgyCode,cooperatives.interregional,cooperatives.regions,cooperatives.street,cooperatives.house_blk_no,cooperatives.status from registeredamendment left join cooperatives on registeredamendment.cooperative_id = cooperatives.id where registeredamendment.id > '$start_id'");
      $process=0;
      $success =0;
      foreach($query->result_array() as $row)
      {
        $data_amendment =array(
          'cooperative_id' =>  $row['id'],
          'regNo'=>$row['regNo'],
          'amendmentNo' =>'' ,
          'users_id' => $row['users_id'],
          'category_of_cooperative' => $row['category_of_cooperative'],
          'type_of_cooperative' =>$row['type_of_cooperative'],
          'cooperative_type_id'=>'',
          'grouping' =>$row['grouping'],
          'proposed_name' => $row['proposed_name'],
          'acronym' => $row['acronym_name'],
          'common_bond_of_membership' => $row['common_bond_of_membership'],
          // 'comp_of_membership',
          // 'field_of_membership',
          // 'name_of_ins_assoc',
          'area_of_operation' => $row['area_of_operation'],
          'refbrgy_brgyCode' => $row['refbrgy_brgyCode'],
          // 'interregional',
          'regions' => $row['regions'],
          'street' => $row['street'],
          'house_blk_no'=> $row['house_blk_no'],
          'status' => 15,
          'created_at' => date('Y-m-d h:i:s',now('Asia/Manila')),
          'ho'=>0,
          'migrated'=>1
        );
        $process++;
        if($this->db->insert('amend_coop',$data_amendment))
        {
          $success++;
        }
      }
      if($success == $process)
      {
        echo "success";
      }
      else
      {
        echo"failed : success : ".$success .' '."process :".$process;
      }
    }
    public function reg_table()
    {
    	 $fields = $this->db->list_fields("amend_coop");
    	 $this->debug($fields);
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

    public function composition(){
      $result = $this->amendment_model->get_composition();
      echo json_encode($result);
    }
    
    public function debug($array)
    {
    	echo"<pre>";
    	print_r($array);
    	echo"</pre>";
    }

}    