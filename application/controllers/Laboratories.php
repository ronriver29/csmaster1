<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Laboratories extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
    }
    

    public function rupdate($id = null){

      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
 
        
       if(isset($_POST['reserveUpdateBtn'])){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');

        
        $items = array(
              'coop_id'=>$this->input->post('regNo'),
              'labName' => $this->input->post('coopName'),
              'laboratoryName'=> $this->input->post('labName'),
              'comp_college' => $this->input->post('com_college'),
              'comp_highschool' => $this->input->post('com_highschool'),
              'comp_grade' => $this->input->post('com_grade'),
              'comp_outschool' => $this->input->post('com_outofschool'),
              'house_blk_no' => $this->input->post('blkNo'),
              'streetName' =>$this->input->post('stName'),
              'addrCode' =>$this->input->post('barangay'),
              'lastUpdated'=> date('Y-m-d h:i:s',now('Asia/Manila')),
              'user_id'=>$user_id
        ); 
        // $this->debug($items);
          $update=$this->laboratories_model->update_laboratory($items,$decoded_id);
         

          if($update)
          {
              $this->session->set_flashdata('laboratories_success', 'Successfully updated basic information.');
                     redirect('laboratories/'.$this->input->post('cooperativeID'));
          }
          else
          {
              $this->session->set_flashdata('laboratories_error', 'Unable to update laboratory basic information.');
                      redirect('laboratories/'.$this->input->post('cooperativeID'));
          }
        }else{
    

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){
              // if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
              if($this->laboratories_model->check_submitted_for_evaluation_2($decoded_id)){ //modify
                if($this->form_validation->run() == FALSE){
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['title'] = 'Update laboratory Details';
                  $data['header'] = 'Update laboratory Information';
                  $data['regions_list'] = $this->region_model->get_regions();

                  $data['branch_info'] = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
                  $cooperative_info = $this->laboratories_model->coop_dtl($data['branch_info']->cooperative_id);

                  if($cooperative_info->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($cooperative_info->regions);
                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }

                  $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['branch_info']->rCode);
                  $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['branch_info']->pCode);
                  $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['branch_info']->bCode);
                  
                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($cooperative_info->type_of_cooperative);
                  // $this->debug( $data['major_industries_by_coop_type']);
                  $data['major_industry_list'] = $this->laboratories_model->get_all_major_industry($decoded_id);
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                   // $data['regions_list'] = $this->region_model->get_regions();

                  $decrypted_lab_id= $this->encryption->decrypt(decrypt_custom($id));
                   $data['decrypt_id'] = $decrypted_lab_id;
                  $data['lab_info']  = $this->laboratories_model->get_lab_info($decrypted_lab_id); //modify
                  $data['access_level'] = $this->session->userdata('access_level');
                  $this->load->view('./template/header', $data);
                  $this->load->view('laboratories/registration_update', $data);
                  //$this->load->view('cooperative/terms_and_condition');
                  $this->load->view('./template/footer', $data);
                }else{ //else validation false
                  // echo "validation true";
                } //end of validation false

              }else{ //else check submitted
                      // echo"Already submitted";
                      
                // $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                // redirect('laboratories/'.$id);
              }//end of check submitted
            }else{ //laboratory check own branch
              // redirect('laboratories');
            } //end of laboratory check own branch
          }else{ //end of session user client
           
          } //end of session user client


        }else{ 
          show_404();
        }//end of is numeric
        }

      }//end of is_logged
    } //end of public



    
     public function specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignBranchSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('laboratories');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('laboratories');
              }else{
                $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
                
                  if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));
                    $coop_full_name = $this->input->post('cooperativeName',TRUE);
                    if((is_numeric($decoded_id) && $decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
                      if($this->laboratories_model->check_not_yet_assigned($decoded_id)){
                        if($this->laboratories_model->assign_to_specialist($decoded_id,$decoded_specialist_id,$coop_full_name)){
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an evaluator.');
                          redirect('laboratories');
                        }else{
                          $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                          redirect('laboratories');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the cooperative to an evaluator.');
                        redirect('laboratories');
                      }
                    }else{
                      show_404();
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('laboratories');
                  }
              

              }
            }
          }
        }else{
          redirect('laboratories');
        }
      }
    }
    public function business_activity($regNo){
      $data = $this->laboratories_model->get_business_activity_coop($regNo);
      echo json_encode($data);
    }
    public function coop_info($regNo){
      $data = $this->laboratories_model->get_coop($regNo);
      echo json_encode($data);
    }

    public function check_coverage_validity(){
      if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('coopArea')){
        
        if ($this->input->get('coopArea')!='National' && $this->input->get('fieldValue')!= 'National' &&
        $this->input->get('fieldValue')>$this->input->get('coopArea'))
          $result = array($this->input->get('fieldId'),false);
        else
          $result = array($this->input->get('fieldId'),true);

        echo json_encode($result);
      }else{
        show_404();
      }
    }
    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of laboratories';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Laboratories';
          $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories($this->session->userdata('user_id'));

          $data['coopreg_info'] = $this->laboratories_model->getCoopRegNo($user_id);

          if(isset($data['coopreg_info'])){
            if($this->branches_model->check_if_amended($data['coopreg_info']->regNo)){
              $data['coopreg_info'] = $this->laboratories_model->getCoopRegNoAmended($user_id);
            } 
          }
          $data['last_query'] = $this->db->last_query();
          if(empty($data['coopreg_info'])){
              $data['gc'] = '';
          } else {
              $data['gc'] = $data['coopreg_info']->gc;
          }
              
          $data['user_ID'] =$this->session->userdata('user_id');
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_laboratories', $data);
          // $this->load->view('cooperative/delete_modal_laboratory');
            $this->load->view('laboratories/delete_modal_laboratory');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Laboratories';
            $data['header'] = 'Laboratories';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $this->load->view('templates/admin_header', $data);
            
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="0"){
                $data['registered_laboratories'] = $this->laboratories_model->get_registered_laboratories($data['admin_info']->region_code);
                $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                $data['registered_laboratories'] = $this->laboratories_model->get_registered_laboratories($data['admin_info']->region_code);
                $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              $data['registered_laboratories'] = $this->laboratories_model->get_registered_laboratories($data['admin_info']->region_code);
              $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories_by_senior($data['admin_info']->region_code);
              $data['last'] = $this->db->last_query();
              $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);

            }
            else{
              $data['registered_laboratories'] = $this->laboratories_model->get_registered_laboratories($data['admin_info']->region_code);
              $data['list_laboratories'] = $this->laboratories_model->get_all_laboratories_by_director($data['admin_info']->region_code);
            }
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
            $data['user_id'] = $user_id;

            $data['gc']=1; //if admin level enable it 
            $data['user_ID'] =$this->session->userdata('user_id');
            $data['admin_accesslevel'] =$this->session->userdata('access_level');
            $this->load->view('applications/list_of_laboratories', $data);
            $this->load->view('applications/assign_admin_modal_laboratories');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');


          }
        }
      }
    }

    public function registration(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Registration Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Registration';
              $data['regions_list'] = $this->region_model->get_regions();             
              $data['composition'] = $this->cooperatives_model->get_composition();
              $data['coopreg_info'] = $this->laboratories_model->getCoopRegNo($user_id);
              
              if($data['coopreg_info']->area_of_operation == 'Interregional'){
                $data['regions_list'] = $this->region_model->get_selected_regions($data['coopreg_info']->regions);
              } else {
                $data['regions_list'] = $this->region_model->get_regions();
              }

              $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['coopreg_info']->rCode);
              $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['coopreg_info']->pCode);
              $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['coopreg_info']->bCode);

//              if(!empty($data['coopreg_info'])){
//                  $data['regno'] = '';
//              } else {
                  $data['regno'] = $data['coopreg_info']->regNo;
//              }
              
              if(isset($_POST['branchAddBtn'])){
                  $temp = TRUE;
              } else {
                  $temp = FALSE;
              }
              if ($temp == FALSE){
                $this->load->view('./template/header', $data);
                $this->load->view('laboratories/registration_detail', $data); //registration form
//                $this->load->view('cooperative/terms_and_condition');
                $this->load->view('./template/footer');
              }else{

                $BAC = $this->input->post('BAC');
                $provDesc = $this->laboratories_model->prov($this->input->post('province'));
                $cityDesc = $this->laboratories_model->city($this->input->post('city'));
                $branchCount =$this->laboratories_model->branch_count($this->input->post('regNo'),substr($this->input->post('city'),0,6),$this->input->post('typeOfBranch')); 

                $cooperative_ID = $this->laboratories_model->get_coopID($this->input->post('regNo'));
                $field_data = array(
                  'user_id' => $this->session->userdata('user_id'),
                  'labName' => $this->input->post('coopName'),
                  'cooperative_id' => $cooperative_ID,
                  'laboratoryName' => $this->input->post('labName'), 
                  'coop_id' => $this->input->post('regNo'),
                  'addrCode' => $this->input->post('barangay'),
                  'streetName' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'dateApplied' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'lastUpdated' =>  date('Y-m-d h:i:s',now('Asia/Manila'))
                );
                //if($this->laboratories_model->rule_3_years($this->input->post('regNo'))){

                // echo"<pre>";
                // print_r($field_data);
                //  echo"<pre>";
                  if($this->laboratories_model->add_branch($field_data,$BAC)){
                    $this->session->set_flashdata('list_success_message', 'Laboratory registration info has been submitted. Proceed to Next Step');
                    redirect('laboratories');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                    redirect('laboratories');
                  }

                //}else{
                //  $this->session->set_flashdata('list_error_message', 'Cooperative existence is less than 3 years.');
                //  redirect('laboratories');
                //}
              }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('laboratories');
            }
          }

      }
    }


  //modify 
  public function UploadDocuments($id=NULL)
  {
      $decoded_id =$this->encryption->decrypt(decrypt_custom($id));
    if(!$this->session->userdata('logged_in')){
      redirect(base_url());
    }else{
      

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        $coopInfo = $this->db->query("select laboratories.coop_id as coop_reg_no ,laboratories.cooperative_id as cooperate_ID,registeredcoop.application_id as coopID,cooperatives.*
                                  from laboratories
                                  left join registeredcoop on laboratories.coop_id = registeredcoop.regNo
                                  left join cooperatives on registeredcoop.application_id = cooperatives.id where laboratories.id = '$decoded_id'");
        if($coopInfo->num_rows()>0)
        {
         $data['coop_info']=$coopInfo->row();
          foreach($coopInfo->result() as $row)
          {

          $cooperativeID= $row->coopID;
          $Cooperative_id = $row->cooperate_ID;
          }
        }
        // else
        // {
        //   $Cooperative_id = NULL;
        // }

        $type_query = $this->db->get_where('cooperatives',array('id'=>$Cooperative_id));
        if($type_query->num_rows()>0)
        {
          foreach ($type_query->result_array() as $row) {
            $cooperativeType = $row['type_of_cooperative'];
          }
        }
        else
        {
           $cooperativeType ="No Cooperative type found";
        }
     
         $cooperative_doc_ = $this->cooperatives_model->get_type_of_coop($cooperativeType);
         if(count( $cooperative_doc_)>0)
         {
            foreach($cooperative_doc_ as $doctypes)
             {
              $doctypes['link'] = $this->count_documents_others_laboratory($Cooperative_id,$doctypes['document_num']);
              $data_docs[]= $doctypes;
             }

             $data['coop_type']=$data_docs;
         }
         else
         {
            $data['coop_type'] = NULL;
         }
     
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['title'] = 'List of Documents';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Documents';
          $data['uid'] =  encrypt_custom($this->encryption->encrypt($this->session->userdata('user_id')));
          $data['cid'] = encrypt_custom($this->encryption->encrypt($Cooperative_id));
          $data['encrypted_id'] = $id;
          $data['document_one'] = $this->uploaded_document_model->get_document_one_info($Cooperative_id);
          $data['document_two'] = $this->uploaded_document_model->get_document_two_info($Cooperative_id);

          // $this->count_documents_others($Cooperative_id,24);
          // $this->count_documents_others($Cooperative_id,25);
          $data['Manual_of_board'] = $this->docUpload( $Cooperative_id ,$decoded_id,25);
          $data['Board_of_resolution'] = $this->docUpload($Cooperative_id ,$decoded_id,26);
          $data['Other_requirements'] = $this->docUpload($Cooperative_id ,$decoded_id,42);
          $data['document_others_lab'] = $this->uploaded_document_model->get_document_42_info($decoded_id,$Cooperative_id);
          $data['last_query'] = $this->db->last_query();
          $data['encrypted_ids'] =$id;

     
          $this->load->view('template/header', $data);
          $this->load->view('laboratories/upload_documents', $data);
          $this->load->view('template/footer');
    }//is logged
  
  }

  //modify
   public function count_documents_others2($coop_id,$num)
  {
    $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('uploaded_documents');
    if($query->num_rows()>0)
    {
      $data = $query->result_array();
    }
    else
    {
      $data =NULL;
    }
    return $data;

  }

   public function count_documents_others_laboratory($coop_id,$num)
  {
    // $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('uploaded_documents');
    $query = $this->db->query("select * from uploaded_documents where cooperatives_id='$coop_id' and document_num='$num' and status=1 order by id desc limit 1");
    if($query->num_rows()>0)
    {
      $data = $query->result_array();
    }
    else
    {
      $data =NULL;
    }
    return $data;

  }



  //modify by json
  public function docUpload($coopID,$labID,$docType)
  {
    $qry = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coopID,'laboratory_id'=>$labID,'document_num'=>$docType,'status'=>1));
    if($qry->num_rows()>0)
    {
        $data = $qry->row(); 
    }
    else
    {
      $data = NULL;
    }
    return $data;
  }
  //modify



    //modify by anj
  public function count_documents_others($coop_id,$num)
  {
    $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('uploaded_documents');
    if($query->num_rows()>0)
    {
      $data = $query->result_array();
    }
    else
    {
      $data =NULL;
    }
    return $data;

  }
  
 
    public function delete_laboratory(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteBranchBtn')){
          if($this->session->userdata('client')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($decoded_id) && $decoded_id!=0){
              if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){
                if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                  $success = $this->laboratories_model->delete_branch($decoded_id);
                  if($success){
                    $this->session->set_flashdata('list_success_message', 'Laboratory has been deleted.');
                    redirect('laboratories');
                  }else{
                    $this->session->set_flashdata('list_error_message', 'Unable to delete Laboratory.');
                    redirect('laboratories');
                  }
                }else{
                  if(!$this->laboratories_model->check_if_denied($decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('cooperatives/'.$this->input->post('cooperativeID',TRUE));
                  }else{
                    $success = $this->laboratories_model->delete_cooperative($decoded_id);
                    if($success){
                      $this->session->set_flashdata('list_success_message', 'Laboratory has been deleted.');
                      redirect('laboratories');
                    }else{
                      $this->session->set_flashdata('list_error_message', 'Unable to delete Laboratory.');
                      redirect('laboratories');
                    }
                  }
                }
              }
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('laboratories');
            }
          }
        }else{
          redirect('laboratories');
        }
      }
    }
    public function view($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Laboratories Details';
              $data['header'] = 'Laboratories Information';
              $branch_info = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
              $data['branch_info'] = $branch_info;
              // echo $this->db->last_query();
              $data['business_activities'] =  $this->laboratories_model->get_all_business_activities($decoded_id); 
              $data['cooperators_count'] = $this->laboratories_model->count_cooperators($decoded_id);
              $data['encrypted_id'] = $id;

            
              $data['submitted'] = $this->laboratories_model->check_submitted_for_evaluation($decoded_id);
              $lab_infos =  $this->laboratories_model->get_lab_info($decoded_id);
              $data['comment_list_director'] = $this->get_comment($decoded_id,3,25);
              $data['comment_list_senior'] = $this->get_comment($decoded_id,2,12);
              // $data['comment_list_defer_director'] = $this->get_comment($decoded_id,3,24);
               $data['comment_list_defer_director'] =$this->get_latest_comment($decoded_id,3,24);
                // $this->debug( $data['comment_list_defer_director']);
              //check if document is uploaded
              $data['manual_operation'] =$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,25);
              $data['board_resolution']=$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,26);
             
              // $data['Manual_of_board'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,25);
              // $data['Board_of_resolution'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,26);

              $this->load->view('./template/header', $data);
              $this->load->view('laboratories/laboratories_detail', $data);
              $this->load->view('./template/footer');
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('laboratories');
            }
          }
        }else{
          show_404();
        }
      }
    }   

    //modify
  public function get_comment($lab_id,$access_level,$laboratory_status)
  {
    $qry =  $this->db->get_where('laboratory_comment',array('laboratory_id'=>$lab_id,'user_access_level'=>$access_level,'laboratory_status'=>$laboratory_status));
    if($qry->num_rows()>0)
    {
      return $qry->row();
    }
  }
  public function get_latest_comment($lab_id,$access_level,$laboratory_status)
  {
    // $qry =  $this->db->query("select * from laboratory_comment where laboratory_id='$lab_id' and user_access_level='$access_level' and laboratory_status='$laboratory_status' order by id desc limit 1");
     $qry =  $this->db->query("select * from laboratory_comment where laboratory_id='$lab_id' and user_access_level='$access_level' and laboratory_status='$laboratory_status' order by id desc");

    if($qry->num_rows()>0)
    {
      // return $qry->row();
      foreach($qry->result_array() as $row)
      {
        $data[] = $row;
      }

    }else
    {
      $data=NULL;
    }
    return $data;
  }





    public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){
              
                $lab_info = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
                $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$lab_info->application_id);
                $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$lab_info->application_id);
                $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$lab_info->application_id);
                $same= ($lab_info->rCode=='0'+substr($lab_info->mainAddr, 0,2)) ? 8: 2;
                
//                if($document_5 && $document_6 && $document_7){
                  // if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                 if($this->laboratories_model->check_submitted_for_evaluation_2($decoded_id)){ //modify
//                    if($this->laboratories_model->check_if_deferred($decoded_id)){
//                      if($this->laboratories_model->submit_for_reevaluation($user_id,$decoded_id,$same,$branch_info->rCode)){
//                        $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
//                        redirect('laboratories/'.$id);
//                      }else{
//                        $this->session->set_flashdata('cooperative_error','Unable to submit your application');
//                        redirect('laboratories/'.$id);
//                      }
//                    if($this->laboratories_model->check_if_deferred($decoded_id)){
                      $data['client_info'] = $this->user_model->get_user_info($user_id);
                      $lab_name = $lab_info->laboratoryName.' Laboratory Cooperative';

                      if($lab_info->house_blk_no==null && $lab_info->streetName==null) $x=''; else $x=', ';

                      $brgyforemail = ucwords($lab_info->house_blk_no).' '.ucwords($lab_info->streetName).$x.' '.$lab_info->brgy.', '.$lab_info->city.', '.$lab_info->province.', '.$lab_info->region;

                      $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                      $regioncode = '0'.mb_substr($lab_info->addrCode, 0, 2);

                      $senior_info = $this->admin_model->get_senior_info($regioncode);

                      if($this->laboratories_model->sendEmailToSenior($lab_info->coopName,$lab_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info)){
                        if($this->laboratories_model->sendEmailToClient($lab_name,$data['client_info']->email)){;
                          if($this->laboratories_model->submit_for_evaluation($user_id,$decoded_id,$same,$lab_info->rCode)){
                            $this->session->set_flashdata('branch_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                            redirect('laboratories/'.$id);
                          }else{
                            $this->session->set_flashdata('branch_error','Unable to submit your application');
                            redirect('laboratories/'.$id);
                          }
                        } else {
                          $this->session->set_flashdata('branch_error','Unable to submit your application');
                            redirect('laboratories/'.$id);
                        }
                      }

//                    }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('laboratories/'.$id);
                  }
//                }else if(!$document_5 && !$document_6 && !$document_7){
//                  $this->session->set_flashdata('redirect_message', 'Please upload first your three other documents.');
//                  redirect('laboratories/'.$id);
//                }
//                else if(!$document_5){
//                  $this->session->set_flashdata('redirect_message', 'Please upload first your Business Plan.');
//                  redirect('laboratories/'.$id);
//                }else if(!$document_6){
//                  $this->session->set_flashdata('redirect_message', 'Please upload first your GA Resolution.');
//                  redirect('laboratories/'.$id);
//                }else{
//                  $this->session->set_flashdata('redirect_message', 'Please upload first your Certification.');
//                  redirect('laboratories/'.$id);
//                }
                            
              
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('laboratories');
            }
          }
        }else{
          show_404();
        }
      }
    }


          //modify by json
    public function approve_laboratories_2(){
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
                if(!$this->laboratories_model->check_expired_reservation_by_admin($decoded_id)){
                  if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->cooperatives_model->check_if_denied_laboratories($decoded_id)){
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated_laboratories($decoded_id)){
                            // if($this->laboratories_model->check_last_evaluated($decoded_id)){
                            //   $this->session->set_flashdata('redirect_applications_message', 'Laboratory already evaluated by a Director/Supervising CDS.');
                            //   redirect('cooperatives');
                            // }else{
                              // if(!$this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $success = $this->laboratories_model->approve_by_director_laboratories($data['admin_info'],$decoded_id);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                                  redirect('laboratories');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve laboraotories.');
                                  redirect('laboratories');
                                }
                              // }else{
                              //   $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                              //   redirect('cooperatives');
                              // }
                            // }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('cooperatives');
                          }
                        }else{
                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                          redirect('laboratories');
                        }
                      }else if($this->session->userdata('access_level')==3){
//                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->cooperatives_model->check_second_evaluated_laboratories($decoded_id)){
                            if($this->cooperatives_model->check_last_evaluated_laboratories($decoded_id)){
                              $this->session->set_flashdata('redirect_applications_message', 'laboratories already evaluated by a Director/Supervising CDS.');
                              redirect('laboratories');
                            }else{
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                // echo "ANO :" . $decoded
                                $lab_info = $this->laboratories_model->get_branch_info_by_admin($decoded_id);

                                $coop_full_name = $lab_info->laboratoryName.' Laboratory Cooperative';

                                $data['client_info'] = $this->user_model->get_user_info($lab_info->user_id);

                                if($this->laboratories_model->sendEmailToClientApproved($coop_full_name,$data['client_info']->email)){
                                  $success = $this->laboratories_model->approve_by_director_laboratories($data['admin_info'],$decoded_id);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                                    redirect('laboratories');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve Laboratory.');
                                    redirect('laboratories');
                                  }
                                } else {
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve Laboratory.');
                                    redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('laboratories');
                              }
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                            redirect('laboratories');
                          }
//                        }else{
//                          $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a labroratories Development Specialist II.');
//                          redirect('laboratories');
//                        }
                      }else if($this->session->userdata('access_level')==2){
//                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          if($this->laboratories_model->check_second_evaluated_laboratories($decoded_id)){
                            $this->session->set_flashdata('redirect_applications_message', 'laboratory already evaluated by a Senior Cooperative Development Specialist.');
                            redirect('laboratories/'.$decoded_id.'/laboratories_documents');
                          }else{
                             
                             
                             if(strlen(trim($this->input->post('comment')))>0)
                             {
                              $usr_id = $this->session->userdata('user_id');
                              $usr_access_level = $this->session->userdata('access_level');
                              $data3 = array(
                                              'user_id'=> $usr_id,
                                              'user_access_level'=>$usr_access_level,
                                              'laboratory_id'=> $decoded_id,
                                              'laboratory_status'=>12,
                                              'comment'=> trim($this->input->post('comment')),
                                              'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))
                                            );
                               $this->db->insert('laboratory_comment',$data3); // insert comment details
                              // $check_comment_senior = $this->db->get_where('laboratory_comment',array('laboratory_id'=>$decoded_id,'laboratory_status'=>12,'user_access_level'=>2));
                              //   if($check_comment_senior->num_rows()>0)
                              //   {
                              //     $this->db->update('laboratory_comment',$data3,array('laboratory_id'=>$decoded_id,'laboratory_status'=>12,'user_access_level'=>2));
                              //   }
                              //   else
                              //   {
                              //     $this->db->insert('laboratory_comment',$data3); // insert comment details
                              //   }
                             }
                          $lab_info = $this->laboratories_model->get_branch_info_by_admin($decoded_id);

                          $temp = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);

                          $regioncode = '0'.mb_substr($lab_info->addrCode, 0, 2);

                          $director_emails = $this->admin_model->get_emails_of_director_by_region($regioncode);

                          $data['client_info'] = $this->user_model->get_user_info($lab_info->user_id);
                          $lab_name = $lab_info->laboratoryName.' Laboratory Cooperative';

                          if($lab_info->house_blk_no==null && $lab_info->street==null) $x=''; else $x=', ';

                          $brgyforemail = ucwords($lab_info->house_blk_no).' '.ucwords($lab_info->streetName).$x.' '.$lab_info->brgy.', '.$lab_info->city.', '.$lab_info->province.', '.$lab_info->region;

                          $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

                          

                          $senior_info = $this->admin_model->get_senior_info($regioncode);

                          $coopname = $this->encryption->encrypt(encrypt_custom($lab_info->coopName));

                          if($this->laboratories_model->sendEmailToDirectorFromSenior($coopname,$director_emails,$coop_full_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email)){
                              $success = $this->cooperatives_model->approve_by_supervisor_laboratories($data['admin_info'],$decoded_id,$coop_full_name);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Laboratories has been submitted.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve L.');
                                redirect('laboratories');
                              }
                            }
                          }
//                        }else{
//                          $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
//                          redirect('cooperatives');
//                        }
                      }else{
                        if($this->cooperatives_model->check_first_evaluated($decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('cooperatives');
                        }else{
                          $success = $this->cooperatives_model->approve_by_specialist($data['admin_info'],$decoded_id,$coop_full_name);
                          if($success){
                            $this->session->set_flashdata('list_success_message', 'Laboratory has been approved.');
                            redirect('cooperatives');
                          }else{
                            $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                            redirect('cooperatives');
                          }
                        }
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                      redirect('cooperatives');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
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
          redirect('cooperatives');
        }
      }
  
    }

   

      //modify by json 
     public function payment(){
      $labName = $this->encryption->decrypt(decrypt_custom($this->input->post('lab_name')));
      $coop_name = $this->encryption->decrypt(decrypt_custom($this->input->post('coop_name')));
      $laboratory_name = $labName.' - '.$coop_name;
      // $branch=str_replace('%20',' ',$coop);
      $data = $this->laboratories_model->get_payment_info($laboratory_name);

      echo json_encode($data);
    }

    

   
    public function approve_laboratories(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('approveBranchBtn')){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                    if(!$this->laboratories_model->check_if_denied($decoded_id)){
                      $coop_full_name = $this->input->post('bName',TRUE);
                      $admin_info = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    if(!$this->admin_model->check_if_director_active($user_id)){
                                      $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                        redirect('laboratories');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                        redirect('laboratories');
                                      }   
                                    }else{
                                      $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Director.');
                                      redirect('laboratories');    
                                    }   
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                      redirect('laboratories');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                      redirect('laboratories');
                                    }      
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
                                }else{
                                  $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,4);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                    redirect('laboratories');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                    redirect('laboratories');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                              redirect('laboratories');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                              redirect('laboratories');
                            }
                          } 
                        }else{
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }else{
                                $success = $this->laboratories_model->approve_by_admin($admin_info,$decoded_id,$reason_commment,3);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch has been approved.');
                                  redirect('laboratories');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve branch.');
                                  redirect('laboratories');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('laboratories');
                          }
                        }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to approve is already denied.');
                      redirect('laboratories');
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to approve is not yet submitted for evaluation.');
                    redirect('laboratories');
                  }
                
              }
            }
          }else{
            show_404();
          }
        }else{
          redirect('laboratories');
        }
      }
    }
    public function deny_branch(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                    if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){   
                      //if(!$this->laboratories_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $admin_info = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    if(!$this->admin_model->check_if_director_active($user_id)){
                                      $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                        redirect('laboratories');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                        redirect('laboratories');
                                      } 
                                    }else{
                                      $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Director.');
                                      redirect('laboratories');
                                    }     
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                      redirect('laboratories');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                      redirect('laboratories');
                                    }      
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
                                }else{
                                  $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,4);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                    redirect('laboratories');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                    redirect('laboratories');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                              redirect('laboratories');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                              redirect('laboratories');
                            }
                          } 
                        }else{
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }else{
                                $success = $this->laboratories_model->deny_by_admin($admin_info,$decoded_id,$reason_commment,3);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch has been denied.');
                                  redirect('laboratories');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to deny branch.');
                                  redirect('laboratories');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('laboratories');
                          }
                        }
                      //}else{
                        //$this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to deny is already denied.');
                        //redirect('cooperatives');
                      //}
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                      redirect('laboratories');
                    }
                  
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('branche_error', validation_errors('<li>','</li>'));
          redirect('laboratories/'.$this->input->post('branchID',TRUE));
        }
      }
    }
    public function defer_branch(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->form_validation->run() == TRUE){
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($decoded_id) && $decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories');
            }else{
                if($this->session->userdata('access_level')==5){
                  redirect('admins/login');
                }else{
                    if($this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
                      if(!$this->laboratories_model->check_if_denied($decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $admin_info = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    if(!$this->admin_model->check_if_director_active($user_id)){
                                      $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                      if($success){
                                        $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                        redirect('laboratories');
                                      }else{
                                        $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                        redirect('laboratories');
                                      }  
                                    }else{
                                      $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Director.');
                                      redirect('laboratories');
                                    }
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==3){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  if($this->laboratories_model->check_evaluator5($decoded_id)){
                                    $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by the Regional Director.');
                                    redirect('laboratories');
                                  }else{
                                    $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,5);
                                    if($success){
                                      $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                      redirect('laboratories');
                                    }else{
                                      $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                      redirect('laboratories');
                                    }      
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist.');
                                  redirect('laboratories');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                redirect('laboratories');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                redirect('laboratories');
                              }  
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Senior Cooperative Development Specialist of Cooperative Main Branch.');
                            redirect('laboratories');
                          }
                        }else if($this->session->userdata('access_level')==2){
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                if($this->laboratories_model->check_evaluator4($decoded_id)){
                                  $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Senior Cooperative Development Specialist.');
                                }else{
                                  $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,4);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                    redirect('laboratories');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                    redirect('laboratories');
                                  }
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                              redirect('laboratories');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                              redirect('laboratories');
                            }
                          } 
                        }else{
                          if($this->laboratories_model->check_evaluator1($decoded_id)){
                            if($this->laboratories_model->check_evaluator2($decoded_id)){
                              if($this->laboratories_model->check_evaluator3($decoded_id)){
                                $this->session->set_flashdata('redirect_applications_message', 'Branch already evaluated by a Cooperative Development Specialist II.');
                                redirect('laboratories');
                              }else{
                                $success = $this->laboratories_model->defer_by_admin($admin_info,$decoded_id,$reason_commment,3);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Branch has been deferred.');
                                  redirect('laboratories');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to defer branch.');
                                  redirect('laboratories');
                                }
                              }
                            }else{
                              $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated first by the Regional Director of the Main Cooperative Branch.');
                              redirect('laboratories');
                            }
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'Branch must be evaluated by the Senior Cooperative Development Specialist of the Main Cooperative Branch.');
                            redirect('laboratories');
                          }
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to defer is already denied.');
                        redirect('laboratories');
                      }
                    }else{
                      $this->session->set_flashdata('redirect_applications_message', 'The branch you trying to deny is not yet submitted for evaluation.');
                      redirect('laboratories');
                    }  
                }
            }
          }else{
            show_404();
          }
        }else{
          $this->session->set_flashdata('branch_error', validation_errors('<li>','</li>'));
          redirect('laboratories/'.$this->input->post('branchID',TRUE));
        }
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
      $result = $this->laboratories_model->is_name_unique($data);
      if($result[1]==true){
        return true;
      }else{
        $this->form_validation->set_message('cooperative_name_exists_check', 'Cooperative Name already exists.');
        return FALSE;
      }
    }
    
    public function get_cooperative_info($id=NULL){ 

      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('laboratories');
          }
        }else{
          if($this->input->post('id') && $this->input->post('user_id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $result = $this->laboratories_model->get_cooperative_info($decoded_user_id,$decoded_id);
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
            redirect('cooperatives');
          }
        }else{
          if($this->input->post('id')){
            $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->laboratories_model->get_cooperative_info_by_admin($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
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
            $result = $this->laboratories_model->get_all_subclasses($decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
  

    public function saveor($was){
       $current_time = date('h:i:s');
      $date_or =  date('Y-m-d '. $current_time, strtotime($this->input->post('date_or')));
     
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'status' =>1,
        'date_of_or' => date('Y-m-d h:i:s',strtotime($date_or))

      );
         $labID = $this->encryption->decrypt(decrypt_custom($this->input->post('laboratoryID')));
    $this->laboratories_model->save_OR(array('id' => $this->input->post('payment_id')), $data,$labID,$date_or);
       echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
      
    }
    //modify by json
    public function deny_laboratory()
    {
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->session->userdata('access_level')>=3 && ($this->session->userdata('access_level')<=5))
        {
            $user_id = $this->session->userdata('user_id');
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $access_level =  $this->session->userdata('access_level');
            $decoded_laboratory_id= $this->encryption->decrypt(decrypt_custom($this->input->post('laboratoryID')));
            $comment = $this->input->post('comment');
           // echo $user_id.' '.$decoded_laboratory_id.' '.$comment;
            $lab_info = $this->laboratories_model->get_branch_info_by_admin($decoded_laboratory_id);

            $coop_full_name = $lab_info->laboratoryName.' Laboratory Cooperative';

            $brgyforemail = ucwords($lab_info->house_blk_no).' '.ucwords($lab_info->streetName).$x.' '.$lab_info->brgy.', '.$lab_info->city.', '.$lab_info->province.', '.$lab_info->region;

            $data['client_info'] = $this->user_model->get_user_info($lab_info->user_id);

            if($lab_info->house_blk_no==null && $lab_info->street==null) $x=''; else $x=', ';

            if($this->laboratories_model->sendEmailToClientDeny($coop_full_name,$brgyforemail,$comment,$data['client_info']->email)){
              if($this->laboratories_model->deny_by_director($decoded_laboratory_id,$user_id,$access_level,$comment))
              {
                $this->session->set_flashdata(array('status_msg'=>'success','deny_msg'=>'Laboratory has been denied successfully.'));
                 redirect('laboratories');
              }
              else
              {
                $this->session->set_flashdata(array('status_msg'=>"danger",'deny_msg'=>"Failed while trying to deny Laboratory."));
                redirect('laboratories/'.$this->input->post('laboratoryID').'/laboratories_documents');
               
              } 
            } else {
              $this->session->set_flashdata(array('status_msg'=>"danger",'deny_msg'=>"Failed while trying to deny Laboratory."));
              redirect('laboratories/'.$this->input->post('laboratoryID').'/laboratories_documents');
            }
        }
        else
        {
          echo "Unauthorized!";
        }
      } // end of logged_in  
    } //public

    public function defer_laboratory()
    {
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->session->userdata('access_level')>=3 && ($this->session->userdata('access_leve')<=5)){

            $user_id = $this->session->userdata('user_id');
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $access_level =  $this->session->userdata('access_level');
            $decoded_laboratory_id= $this->encryption->decrypt(decrypt_custom($this->input->post('laboratoryID')));
            $comment = $this->input->post('comment');
            // echo $decoded_laboratory_id.' '.$comment.' '.$access_level;
            $lab_info = $this->laboratories_model->get_branch_info_by_admin($decoded_laboratory_id);

            $coop_full_name = $lab_info->laboratoryName.' Laboratory Cooperative';

            $brgyforemail = ucwords($lab_info->house_blk_no).' '.ucwords($lab_info->streetName).$x.' '.$lab_info->brgy.', '.$lab_info->city.', '.$lab_info->province.', '.$lab_info->region;

            $data['client_info'] = $this->user_model->get_user_info($lab_info->user_id);

            if($lab_info->house_blk_no==null && $lab_info->street==null) $x=''; else $x=', ';

            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

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

            if($this->laboratories_model->sendEmailToClientDefer($coop_full_name,$brgyforemail,$comment,$data['client_info']->email,$reg_officials_info)){
              if($this->laboratories_model->defer_by_director($decoded_laboratory_id,$user_id,$access_level,$comment))
              {
                $this->session->set_flashdata(array('status_msg'=>'success','defer_msg'=>'Laboratory has been deferred successfully.'));
                 redirect('laboratories');
              }
              else
              {
                $this->session->set_flashdata(array('status_msg'=>"danger",'defer_msg'=>"Failed while trying to defer Laboratory."));
                redirect('laboratories/'.$this->input->post('laboratoryID').'/laboratories_documents');
              }
            } else {
                $this->session->set_flashdata(array('status_msg'=>"danger",'defer_msg'=>"Failed while trying to defer Laboratory."));
                redirect('laboratories/'.$this->input->post('laboratoryID').'/laboratories_documents');
              }
        }
        else
        {
          echo"Unauthorized";
        }

      }//end is logged  
    }//end public
    public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
  }
 ?>
