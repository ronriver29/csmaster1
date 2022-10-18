<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Laboratories_update extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('laboratories_model');
      $this->load->model('branches_model');
      $this->load->model('region_model');
      $this->load->model('cooperatives_model');
      $this->load->model('major_industry_model');
      $this->load->model('admin_model');
      $this->load->model('uploaded_document_model');
      //Codeigniter : Write Less Do More
    }


    public function rupdate($id = null){

      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{


       if(isset($_POST['reserveUpdateBtn'])){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');



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
              'first_evaluated_by' => $user_id
        );

        if($data['is_client']){
          $items['user_id'] = $user_id;
        }
        // print_r($items);
        // $this->debug($items);
          $update=$this->laboratories_model->update_laboratory($items,$decoded_id);


          if($update)
          {
              $this->session->set_flashdata('laboratories_success', 'Successfully updated basic information.');
                     redirect('laboratories_update/'.$this->input->post('cooperativeID').'/view');
          }
          else
          {
              $this->session->set_flashdata('laboratories_error', 'Unable to update laboratory basic information.');
                      redirect('laboratories_update/'.$this->input->post('cooperativeID').'/view');
          }
        }else{


        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->laboratories_model->check_own_branch_updating($decoded_id)){
              // if(!$this->laboratories_model->check_submitted_for_evaluation($decoded_id)){
              // if($this->laboratories_model->check_submitted_for_evaluation_2($decoded_id)){ //modify
                if($this->form_validation->run() == FALSE){
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['title'] = 'Update laboratory Details';
                  $data['header'] = 'Update laboratory Information';
                  $data['regions_list'] = $this->region_model->get_regions();

                  $data['branch_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
                  $cooperative_info = $this->laboratories_model->coop_dtl($data['branch_info']->cooperative_id);

                  if($cooperative_info->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($cooperative_info->regions);
                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }

                  $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['branch_info']->rCode);
                  $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['branch_info']->pCode);
                  $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['branch_info']->cCode);

                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($cooperative_info->type_of_cooperative);
                  // $this->debug( $data['major_industries_by_coop_type']);
                  $data['major_industry_list'] = $this->laboratories_model->get_all_major_industry($decoded_id);
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                   // $data['regions_list'] = $this->region_model->get_regions();

                  $decrypted_lab_id= $this->encryption->decrypt(decrypt_custom($id));
                   $data['decrypt_id'] = $decrypted_lab_id;
                  $data['lab_info']  = $this->laboratories_model->get_lab_info_updating($decrypted_lab_id); //modify
                  $data['access_level'] = $this->session->userdata('access_level');
                  $this->load->view('./template/header', $data);
                  $this->load->view('update/laboratories/registration_update', $data);
                  //$this->load->view('cooperative/terms_and_condition');
                  $this->load->view('./template/footer', $data);
                }else{ //else validation false
                  // echo "validation true";
                }
            }else{ //laboratory check own branch
              redirect('laboratories_update');
            } //end of laboratory check own branch
          } else if($this->session->userdata('access_level')==6){
                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['title'] = 'Update laboratory Details';
                  $data['header'] = 'Update laboratory Information';
                  $data['regions_list'] = $this->region_model->get_regions();

                  $data['branch_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
                  $cooperative_info = $this->laboratories_model->coop_dtl($data['branch_info']->cooperative_id);

                  if($cooperative_info->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($cooperative_info->regions);
                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }

                  $data['list_of_provinces'] = $this->cooperatives_model->get_provinces($data['branch_info']->rCode);
                  $data['list_of_cities'] = $this->cooperatives_model->get_cities($data['branch_info']->pCode);
                  $data['list_of_brgys'] = $this->cooperatives_model->get_brgys($data['branch_info']->cCode);

                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($cooperative_info->type_of_cooperative);
                  // $this->debug( $data['major_industries_by_coop_type']);
                  $data['major_industry_list'] = $this->laboratories_model->get_all_major_industry($decoded_id);
                  $data['encrypted_id'] = $id;
                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));

                   // $data['regions_list'] = $this->region_model->get_regions();

                  $decrypted_lab_id= $this->encryption->decrypt(decrypt_custom($id));
                   $data['decrypt_id'] = $decrypted_lab_id;
                  $data['lab_info']  = $this->laboratories_model->get_lab_info_updating($decrypted_lab_id); //modify
                  $data['access_level'] = $this->session->userdata('access_level');

                  $this->load->view('templates/admin_header',$data);
                  $this->load->view('update/laboratories/registration_update', $data);
                  $this->load->view('templates/admin_footer');

          } else{ //end of session user client

          } //end of session user client


        }else{
          show_404();
        }//end of is numeric
        }

      }//end of is_logged
    } //end of public

    public function view($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->laboratories_model->check_own_branch_updating($decoded_id)){
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Laboratories Details';
              $data['header'] = 'Laboratories Information';
              $lab_info_updating = $this->laboratories_model->get_lab_info_updating($decoded_id);
              // echo $this->db->last_query();
              $data['lab_info_updating'] = $lab_info_updating;
              // echo $this->db->last_query();
              $data['business_activities'] =  $this->laboratories_model->get_all_business_activities($decoded_id);
              $data['cooperators_count'] = $this->laboratories_model->count_cooperators($decoded_id);
              $data['encrypted_id'] = $id;

              $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$lab_info_updating->application_id);
              $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$lab_info_updating->application_id);
              $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$lab_info_updating->application_id);

              $data['submitted'] = $this->laboratories_model->check_submitted_for_evaluation($decoded_id);
              $lab_infos =  $this->laboratories_model->get_lab_info($decoded_id);
              // $data['comment_list_defer_director'] = $this->get_comment($decoded_id,3,24);
                // $this->debug( $data['comment_list_defer_director']);
              //check if document is uploaded
              $data['manual_operation'] =$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,25);
              $data['board_resolution']=$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,26);

              // $data['Manual_of_board'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,25);
              // $data['Board_of_resolution'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,26);

              $this->load->view('./template/header', $data);
              $this->load->view('update/laboratories/laboratories_detail', $data);
              $this->load->view('./template/footer');
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('laboratories');
            // }
          } else if($this->session->userdata('access_level')==6){

              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
              $data['title'] = 'Laboratories Details';
              $data['header'] = 'Laboratories Information';
              $lab_info_updating = $this->laboratories_model->get_lab_info_updating($decoded_id);
              // echo $this->db->last_query();
              $data['lab_info_updating'] = $lab_info_updating;
              // echo $this->db->last_query();
              $data['business_activities'] =  $this->laboratories_model->get_all_business_activities($decoded_id);
              $data['cooperators_count'] = $this->laboratories_model->count_cooperators($decoded_id);
              $data['encrypted_id'] = $id;

              $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$lab_info_updating->application_id);
              $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$lab_info_updating->application_id);
              $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$lab_info_updating->application_id);

              $data['submitted'] = $this->laboratories_model->check_submitted_for_evaluation($decoded_id);
              $lab_infos =  $this->laboratories_model->get_lab_info($decoded_id);
              // $data['comment_list_defer_director'] = $this->get_comment($decoded_id,3,24);
                // $this->debug( $data['comment_list_defer_director']);
              //check if document is uploaded
              $data['manual_operation'] =$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,25);
              $data['board_resolution']=$this->laboratories_model->check_submitted_doc($lab_infos->cooperative_id,$decoded_id,26);

              // $data['Manual_of_board'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,25);
              // $data['Board_of_resolution'] = $this->docUpload($lab_infos->cooperative_id,$decoded_id,26);

              $this->load->view('templates/admin_header',$data);
              $this->load->view('update/laboratories/laboratories_detail', $data);
              $this->load->view('templates/admin_footer');
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('laboratories');
            // }
          } else{
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
          // $data['last_query'] = $this->db->last_query();
          if(empty($data['coopreg_info'])){
              $data['gc'] = '';
          } else {
              $data['gc'] = $data['coopreg_info']->gc;
          }

          if(empty($data['coopreg_info'])){
            $data['date2'] = date('m/d/Y');
            $data['list_of_migrated'] = '';
          } else {
            $data['list_of_migrated'] = $this->laboratories_model->get_all_lab_migrated($data['coopreg_info']->regNo);
            // $data['dateregistered'] = $data['coopreg_info']->dateRegistered;
            // $datelang = str_replace("-", "/", $data['dateregistered']);
            // $data['date2'] = $datelang;
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
          // $data['last_query'] = $this->db->last_query();
          if(empty($data['coopreg_info'])){
              $data['gc'] = '';
          } else {
              $data['gc'] = $data['coopreg_info']->gc;
          }

          if(empty($data['coopreg_info'])){
            $data['date2'] = date('m/d/Y');
            $data['list_of_migrated'] = '';
          } else {
            $data['list_of_migrated'] = $this->laboratories_model->get_all_lab_migrated($data['coopreg_info']->regNo);
            // $data['dateregistered'] = $data['coopreg_info']->dateRegistered;
            // $datelang = str_replace("-", "/", $data['dateregistered']);
            // $data['date2'] = $datelang;
          }

          $data['user_ID'] =$this->session->userdata('user_id');
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_laboratories', $data);
          // $this->load->view('cooperative/delete_modal_laboratory');
            $this->load->view('laboratories/delete_modal_laboratory');
          $this->load->view('template/footer');
          }
        }
      }
    }

    public function UploadDocuments($id=NULL)
  {
      $decoded_id =$this->encryption->decrypt(decrypt_custom($id));
    if(!$this->session->userdata('logged_in')){
      redirect(base_url());
    }else{
      if($this->session->userdata('client')){
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['coop_info'] = $this->laboratories_model->get_cooperative_info_updating($decoded_id);
        // echo $this->db->last_query();
        $data['is_client'] = $this->session->userdata('client');
        $coopInfo = $this->db->query("select laboratories.coop_id as coop_reg_no,laboratories.status as lab_status,laboratories.cooperative_id as cooperate_ID,registeredcoop.application_id as coopID,cooperatives.*
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
          $data['document_others_lab'] = $this->uploaded_document_model->get_document_42_info_updating_lab($decoded_id);
          $data['last_query'] = $this->db->last_query();
          $data['encrypted_ids'] =$id;


          $this->load->view('template/header', $data);
          $this->load->view('update/laboratories/upload_documents', $data);
          $this->load->view('template/footer');
      } else {
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['coop_info'] = $this->laboratories_model->get_cooperative_info_updating($decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        $coopInfo = $this->db->query("select laboratories.coop_id as coop_reg_no ,laboratories.status as lab_status,laboratories.cooperative_id as cooperate_ID,registeredcoop.application_id as coopID,cooperatives.*
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
          $data['document_others_lab'] = $this->uploaded_document_model->get_document_42_info_updating_lab($decoded_id);
          $data['last_query'] = $this->db->last_query();
          $data['encrypted_ids'] =$id;


          $this->load->view('templates/admin_header', $data);
          $this->load->view('update/laboratories/upload_documents', $data);
          $this->load->view('templates/admin_footer');
      }
    }//is logged

  }

  public function evaluate($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client') || $this->session->userdata('access_level')==6){
            if($this->laboratories_model->check_own_branch_updating($decoded_id)){

              $lab_info = $this->laboratories_model->get_lab_info_updating($decoded_id);
              $document_5 = $this->uploaded_document_model->get_document_5_info($decoded_id,$lab_info->application_id);
              $document_6 = $this->uploaded_document_model->get_document_6_info($decoded_id,$lab_info->application_id);
              $document_7 = $this->uploaded_document_model->get_document_7_info($decoded_id,$lab_info->application_id);
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $lab_name = $lab_info->laboratoryName.' Laboratory Cooperative';

              if($lab_info->house_blk_no==null && $lab_info->streetName==null) $x=''; else $x=', ';

              $brgyforemail = ucwords($lab_info->house_blk_no).' '.ucwords($lab_info->streetName).$x.' '.$lab_info->brgy.', '.$lab_info->city.', '.$lab_info->province.', '.$lab_info->region;

              $fullnameforemail = $data['client_info']->last_name.', '.$data['client_info']->first_name.' '.$data['client_info']->middle_name;

              $regioncode = '0'.mb_substr($lab_info->addrCode, 0, 2);

              $senior_info = $this->admin_model->get_senior_info($regioncode);

              if($lab_info->status == 21){
                if($this->laboratories_model->submit_for_evaluation_migration($decoded_id,30,$lab_info->rCode)){
                    $this->session->set_flashdata('laboratories_success','Successfully submitted your application.');
                    redirect('laboratories_update/'.$id.'/view');
                    // echo $this->db->last_query();
                  }else{
                    $this->session->set_flashdata('laboratories_error','Unable to submit your application');
                    redirect('laboratories_update/'.$id.'/view');
                  }
              } else {
                if($this->laboratories_model->submit_for_evaluation_admin($lab_info->user_id,$decoded_id,31,$lab_info->rCode)){
                    $this->session->set_flashdata('laboratories_success','Successfully submitted the application');
                    redirect('updated_laboratory_info');
                  }else{
                    $this->session->set_flashdata('laboratories_error','Unable to submit your application');
                    redirect('updated_laboratory_info');
                  }
              }
              // if($this->laboratories_model->sendEmailToSenior($lab_info->coopName,$lab_name,$brgyforemail,$fullnameforemail,$data['client_info']->contact_number,$data['client_info']->email,$senior_info)){
                // if($this->laboratories_model->sendEmailToClient($lab_name,$data['client_info']->email)){

                // } else {
                //   $this->session->set_flashdata('branch_error','Unable to submit your application');
                //     redirect('laboratories/'.$id);
                // }
              // }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('laboratories_update');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('laboratories_update');
            }
          }
        }else{
          show_404();
        }
      }
    }

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

  public function upload_manual_operation($id,$doctype)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
    {

      $user_id = $this->session->userdata('user_id');
      $laboratory_id=$this->encryption->decrypt(decrypt_custom($id));
      $lab_query = $this->db->get_where('laboratories',array('id'=>$laboratory_id));
      if($lab_query->num_rows()>0)
      {
        foreach($lab_query->result_array() as $row)
        {
          $coopID  = $row['cooperative_id'];
          $data['lab_info'] = $lab_query->row();
        }
      }
        $data['client_info'] = $this->user_model->get_user_info($user_id);
        $data['title'] = 'Upload Document';
        $data['header'] = 'Upload Document';
        $data['coop_info'] = $this->laboratories_model->get_cooperative_info_updating($laboratory_id);
        // echo $this->db->last_query();
        $data['cid'] = encrypt_custom($this->encryption->encrypt($coopID));
        $data['encrypted_id'] = $id;
        $data['uid'] = encrypt_custom($this->encryption->encrypt($user_id));
        $data['document_type'] = $doctype;
        // echo"<pre>";print_r($data['lab_info']); echo"<pre>";
        // echo"<pre>";print_r($data['coop_info']); echo"<pre>";
        $this->load->view('./template/header', $data);
        $this->load->view('update/laboratories/upload_manual_operation', $data);
        $this->load->view('./template/footer');

    }
  }

  public function do_upload_laboratory(){
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->input->post('uploadOtherDocumentBtn'))
      {
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')>=2)
        {
          redirect('admins/login');
        }
        else
        {
          // $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          // $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          $items = $this->input->post('item');
          $CooperativeID = $this->encryption->decrypt(decrypt_custom($items['cid']));
          $laboratoryID = $this->encryption->decrypt(decrypt_custom($items['encrypted_id']));
          $user_id_ = $this->encryption->decrypt(decrypt_custom($items['uid']));
          $doctype =$items['doctype'];

           switch ($doctype) {
          case 25:
            $docname ='Manual_of_Operation';
            break;
          case 26:
            $docname ='Board_Resolution';
            break;
          case 42:
            $docname ='Other_requiredments';
            break;

          default:
            $docname='Unlabeled_document';
            break;
          }//end switch

          $coop_info= $this->laboratories_model->get_lab_info_updating($laboratoryID);

          // print_r($data['coop_info']);

           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$user_id_.'_'.$laboratoryID.'_'.$docname;
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1')))
            {
              $this->session->set_flashdata(array('status_msg'=>"danger",'doc_msg'=>"Failed to upload, file not supported."));
              redirect('laboratories_update/'.$items['encrypted_id'].'/UploadDocuments');
            }
            else
            {


              //delete data in db
              $file_existed = $this->check_doc_first($CooperativeID,$laboratoryID,$doctype);
              if($file_existed!=NULL)
              {
                  $file_to_remove = $config['upload_path'].$file_existed->filename;
                 if(is_readable($file_to_remove))
                  {
                      if(unlink($file_to_remove))
                      {
                        // echo"file successfuly deleted";
                        $this->db->delete('uploaded_documents',array('id'=>$file_existed->id));
                      }
                  }
                  else
                  {
                    echo "unable to read file";
                  }
              }



              $data = array('upload_data' => $this->upload->data());
                  if($this->uploaded_document_model->upload_lab_document($CooperativeID,$laboratoryID,$doctype,$this->upload->data('file_name')))
                  {
                    $this->session->set_flashdata(array('status_msg'=>"success",'doc_msg'=>"Successfully uploaded."));
                      redirect('laboratories_update/'.$items['encrypted_id'].'/UploadDocuments');
                  }
                  else
                  {
                      $file = $config['upload_path'].$config['file_name'];
                        if(is_readable($file) && unlink($file))
                        {
                           $this->session->set_flashdata(array('status_msg'=>"danger",'doc_msg'=>"Failed to upload document please contact system administrator."));
                            redirect('laboratories_update/'.$items['encrypted_id'].'/UploadDocuments');
                        }
                        else
                        {
                           $this->session->set_flashdata(array('status_msg'=>"danger",'doc_msg'=>"Failed to upload document please contact system administrator."));
                          redirect('laboratories_update/'.$items['encrypted_id'].'/UploadDocuments');
                        }
                  }//upload lab do
            }//if not do upload

        }//end if user admin
      }
      else
      {
       redirect('laboratories_update/'.$items['encrypted_id']);
      }//end of addbtn button
    } //end islogged session
  }

  public function check_doc_first($coopID,$labID,$doctype)
  {
    $qry = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coopID,'laboratory_id'=>$labID,'document_num'=>$doctype));
    if($qry->num_rows()>0)
    {
      $data = $qry->row();
    }
    else
    {
      $data = NULL;
    }
    return $data;

     // $this->delete('uploaded_documents',array('cooperatives_id'=>$coopID,'laboratory_id'=>$labID,'document_num'=>$doctype,'filename'=>$filename));

  }

  function upload_document_others_lab($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->laboratories_model->check_own_branch_updating($decoded_id)){
              $data['coop_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
              // echo $this->db->last_query();
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('update/laboratories/upload_form/upload_document_others_lab', $data);
                $this->load->view('./template/footer');
          }else{
            echo $decoded_id.'-'.$user_id;
            // $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            // redirect('branches');
          }
        }else{
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['coop_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
          // echo $this->db->last_query();
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['title'] = 'Upload Document';
          $data['header'] = 'Upload Document';
          $data['encrypted_branch_id'] = $id;
          $data['coop_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
          $data['encrypted_id'] = $id;
          $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
          $data['uid'] = $user_id;
          $data['coopid'] = $decoded_id;
          $this->load->view('./templates/admin_header', $data);
          $this->load->view('update/laboratories/upload_form/upload_document_others_lab', $data);
          $this->load->view('./templates/admin_footer');
        }
      }else{
        show_404();
      }
    }
  }

  function do_upload_others_lab(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('branches');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          $data['coop_info'] = $this->laboratories_model->get_lab_info_updating($decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $this->input->post('file42');
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file42'))){
              $this->session->set_flashdata('document_40_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('laboratories_update/'.$this->input->post('branchID').'/UploadDocuments');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,42,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_40_success', 'Successfully uploaded.');
                redirect('laboratories_update/'.$this->input->post('branchID').'/UploadDocuments');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('laboratories_update/'.$this->input->post('branchID').'/UploadDocuments');
                }else{
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('laboratories_update/'.$this->input->post('branchID').'/UploadDocuments');
                }
              }
            }
//          }else{
//            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
//            redirect('branches/'.$this->input->post('branchID'));
//          }
        }
      }else{
        redirect('branches');
      }
    }
  }
}
