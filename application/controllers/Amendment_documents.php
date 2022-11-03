<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use Dompdf\Options;
class Amendment_documents extends CI_Controller{
  public $decoded_id=null;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  $this->load->library('auth');
  $this->auth->checkLogin();  
  $this->load->model('amendment_uploaded_document_model');
  $this->load->model('amendment_model');
  $this->load->model('cooperatives_model');
  $this->load->model('user_model');
  $this->load->model('amendment_bylaw_model');
  $this->load->model('amendment_cooperator_model');
  $this->load->model('amendment_capitalization_model');
  $this->load->model('amendment_purpose_model');
  $this->load->model('amendment_article_of_cooperation_model');
  $this->load->model('amendment_committee_model');
  $this->load->model('charter_model');

  }
  function index($id = null)
  {
        $this->load->model('amendment_union_model','union_model');
        $this->load->model('amendment_affiliators_model','affiliator_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $cooperative_id= $this->amendment_model->coop_dtl($this->decoded_id);
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
              $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);

                $data['coop_type_compare'] = false;
                if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                {
                   $data['coop_type_compare'] = true;
                }

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if($data['bylaw_complete']){
                    switch ($data['coop_info']->category_of_cooperative) {
                     case 'Secondary':
                     case 'Tertiary':
                      $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                       $data['cooperator_complete'] =true;
                        $data['union_complete'] =true;
                       break;
                      
                     case 'Others':
                      $data['union_complete'] = $this->union_model->is_requirements_complete($user_id);
                       $data['cooperator_complete'] =true;
                       $data['affiliator_complete'] = true;
                      break; 
                     default:
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                         $data['affiliator_complete'] =true;
                          $data['union_complete'] = true;
                       break;
                   }
      
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
           
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
            
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                      
                          $data['ga'] =false;
                          $data['bod_sec'] = false;
                          $data['ga'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,19);
                          // if($data['ga'])
                          // {
                          //    // $data['ga_info'] = $this->amendment_uploaded_document_model->get_document_info($this->decoded_id,19);
                          // }
                          $data['bod_sec'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,20);
                          // if($data['bod_sec'])
                          // {
                          //    // $data['bod_sec_info'] = $this->amendment_uploaded_document_model->get_document_info($this->decoded_id,20);
                          // }
                              if($data['coop_type_compare'])
                              {
                                   $data['coop_type'] =array();
                              }
                              else
                              {
                                  $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);
                                  if(count($data['coop_type'])>0)
                                  {
                                    foreach($data['coop_type'] as $coopRow)
                                    {
                                      $coopRow['link']='';
                                      if($this->check_is_uploaded($this->decoded_id,$coopRow['document_num']))
                                      {
                                      $coopRow['link']='uploaded';
                                      }
                                      $cdatas[]=$coopRow;
                                    }
                                    unset($coopRow);  
                                    $data['coop_types_'] = $cdatas;
                                  }
                                  else
                                  {
                                  $data['coop_types_'] = NULL;
                                  }  
                              } //unset($data['coop_type']);  
                                 

                                $data['other_doc'] = $this->check_is_uploaded($this->decoded_id,30);          
                                $data['feasibity']=$this->check_is_uploaded($this->decoded_id,3);
                                $data['books_of_account']=$this->check_is_uploaded($this->decoded_id,4);
                                 
                                $data['title'] = 'List of Documents';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $data['uid'] = $this->session->userdata('user_id');
                                $data['cid'] = $this->decoded_id;
                                $data['encrypted_id'] = $id;
                               
                                 $data['acbl'] = $this->amendment_model->get_acbl($this->decoded_id,$data['coop_info']->category_of_cooperative);
                              // var_dump($data['acbl']);
                                $this->load->view('template/header', $data);
                                // switch ($data['coop_info']->custom_acbl) {
                                //   case 0:
                                        $this->load->view('documents/amendment_list_of_documents', $data);
                                //     break;
                                //   default:
                                //       $data['uploaded_articles'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,41);
                                //        $data['uploaded_bylaws'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,40);
                                //      $this->load->view('documents/list_amendment_documents_acbl', $data);
                                //     break;
                                // }
                              
                                $this->load->view('template/footer');
                      
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
            //   }else{
            //     redirect('amendment/'.$id);
            //   }
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('amendment');
            // }
          }else{
     
                  $this->load->model('admin_model');
                  $this->load->model('region_model');
                  $this->auth->check_access_level($this->session->userdata('access_level'));
                  $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                  $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                  // if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                    $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                    $data['coop_type_compare'] = false;
                    if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                    {
                       $data['coop_type_compare'] = true;
                    }
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                   
                    if($data['bylaw_complete']){
                       switch ($data['coop_info']->category_of_cooperative) {
                       case 'Secondary':
                       case 'Tertiary':
                        $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                         $data['cooperator_complete'] =true;
                          $data['union_complete'] =true;
                         break;
                        
                       case 'Others':
                        $data['union_complete'] = $this->union_model->is_requirements_complete($user_id);
                         $data['cooperator_complete'] =true;
                         $data['affiliator_complete'] = true;
                        break; 
                       default:
                          $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                           $data['affiliator_complete'] =true;
                            $data['union_complete'] = true;
                         break;
                     }
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                        // if(!$data['purposes_complete']) {
                        //     $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                        // }
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                          // if(!$data['article_complete']) {
                          // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                          // }
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                            // if(!$data['committees_complete']) {
                            //   $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($this->decoded_id);
                            // }
                            if($data['committees_complete']){

                                      $data['title'] = 'List of Documents';
                                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                      $data['header'] = 'Documents';
                                      $data['uid'] = $this->session->userdata('user_id');
                                      $data['cid'] = $this->decoded_id;
                                      $data['encrypted_id'] = $id;

                                      $data['ga'] =false;
                                      $data['bod_sec'] = false;
                                      $data['ga'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,19);
                                      if($data['ga'])
                                      {
                                         // $data['ga_info'] = $this->amendment_uploaded_document_model->get_document_info($this->decoded_id,19);
                                      }
                                      $data['bod_sec'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,20);
                                      if($data['bod_sec'])
                                      {
                                         // $data['bod_sec_info'] = $this->amendment_uploaded_document_model->get_document_info($this->decoded_id,20);
                                      }
                                    
                                  if($data['coop_type_compare'])
                                  {
                                       $data['coop_type'] =array();
                                  }
                                  else
                                  {
                                      $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);
                                      if(count( $data['coop_type'])>0)
                                      {
                                        foreach($data['coop_type'] as $coopRow)
                                        {
                                          $coopRow['link']='';
                                          if($this->check_is_uploaded($this->decoded_id,$coopRow['document_num']))
                                          {
                                          $coopRow['link']='uploaded';
                                          }
                                          $cdatas[]=$coopRow;
                                        }
                                        // echo $this->db->last_query();
                                        $data['coop_types_'] = $cdatas;
                                      }
                                      else
                                      {
                                      $data['coop_types_'] = NULL;
                                      }//end if is array   
                                  }  
                                  
                  
                                     $data['other_doc'] = $this->check_is_uploaded($this->decoded_id,30);     
                                     $data['feasibity']=$this->check_is_uploaded($this->decoded_id,3);
                                      $data['books_of_account']=$this->check_is_uploaded($this->decoded_id,4);


                                    $data['cds_comment'] = $this->amendment_model->admin_comment($this->decoded_id,1);
                                   
                                   if($data['coop_info']->status ==9 && $data['coop_info']->third_evaluated_by>0 || (($data['coop_info']->status ==11 || $data['coop_info']->status ==10) && $data['coop_info']->third_evaluated_by>0) || ($data['coop_info']->status ==6 && $data['coop_info']->third_evaluated_by>0))
                                   {
                                      $data['senior_comment'] = $this->amendment_model->get_comment_single($this->decoded_id,2);
                                      $data['director_comment'] =$this->amendment_model->get_comment_single_dir($this->decoded_id,3);
                                      $data['supervising_comment'] =$this->amendment_model->get_comment_single_dir($this->decoded_id,4);
                                      $data['senior_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                      $data['director_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,3);
                                   }
                                   else
                                   {
                                      $data['senior_comment'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                      $data['director_comment'] = $this->amendment_model->admin_comment($this->decoded_id,3);
                                      $data['supervising_comment'] = $this->amendment_model->admin_comment($this->decoded_id,4);
                                       $data['director_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,3); 
                                        $data['senior_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                   }
                                   if($data['coop_info']->status == 17)
                                   {
                                     $data['senior_comment'] = $this->amendment_model->get_comment_single($this->decoded_id,2); 
                                   }
                                    $data['revert_comment_array'] = $this->amendment_model->revert_comment($this->decoded_id);

                                   
                                   
                                      $data['tool_findings'] = $this->amendment_model->tool_findings($this->decoded_id);
                                      $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                                      $data['is_active_director'] = $this->admin_model->is_active_director($user_id);
                                      $data['acbl'] = $this->amendment_model->get_acbl($this->decoded_id,$data['coop_info']->category_of_cooperative);
                                      $data['amendment_id'] = $this->decoded_id;
                                     
                                      $this->load->view('templates/admin_header', $data);
                                      // switch ($data['coop_info']->custom_acbl) {
                                      //   case 0:
                                              $this->load->view('documents/amendment_list_of_documents', $data);
                                      //     break;
                                      //   default:
                                      //       $data['uploaded_articles'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,41);
                                      //        $data['uploaded_bylaws'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,40);
                                      //      $this->load->view('documents/list_amendment_documents_acbl', $data);
                                      //     break;
                                      // }    
                                      $this->load->view('amendment/evaluation/approve_modal_cooperative');
                                      $this->load->view('amendment/evaluation/deny_modal_cooperative');
                                      $this->load->view('amendment/evaluation/revert_modal');
                                      $this->load->view('amendment/evaluation/defer_modal_cooperative');
                                      $this->load->view('templates/admin_footer');

                                }else{ 
                                  $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Please complete first the list of committee.'));
                                  redirect('amendment');
                                }
                              }else{ 
                                $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Please complete first the article of cooperation additional information.'));
                                redirect('amendment');
                              }
                            }else{ 
                              $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Please complete first the cooperative&apos;s purpose .'));
                              redirect('amendment');
                            }
                      }else{ 
                            $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Please complete first the list of cooperator.'));
                            redirect('amendment');
                          }
                    }else{ 
                      $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'Please complete first the bylaw additional information.'));
                      redirect('amendment');
                    }
                  // }else{  
                  //   $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'The cooperative is not yet submitted for evaluation.'));
                  //   redirect('amendment');
                  // }
                } 
              // } //end check reservation
          // }
        }else{
          show_404();
        }
    
  }

  public function custom_acbl($id,$num)
  {
     $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
     if($this->amendment_model->update_acbl($this->decoded_id,$num))
     { 
       
         redirect(base_url().'amendment/'.$id.'/amendment_documents');
       
     }
   
   
  }
public function check_is_uploaded($amendment_id,$document_num)
{
  $query = $this->db->query("select amendment_id,document_num from amendment_uploaded_documents where amendment_id='$amendment_id' and document_num='$document_num'");
  if($query->num_rows()>0)
  {
    return true;
  }
  else
  {
    return false;
  }
}

public function doc_link_view($id,$document_num)
{

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_document_num =  $this->encryption->decrypt(decrypt_custom($document_num));
      $file_qry = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$this->decoded_id,'document_num'=>$decoded_document_num));
      if($file_qry->num_rows()>0)
      {
        foreach($file_qry->result_array() as $frow)
        {
          $file_name = $frow['filename'];
        }
        unset($frow);
      }
      // echo $file_name;
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$file_name)){
//          if($this->amendment_uploaded_document_model->check_document_of_cooperative(0,$this->decoded_id,1,$decoded_filename)){
            if($this->session->userdata('client')){
              $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
              $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
              // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
              //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              //     $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              //     $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
              //     if($data['bylaw_complete']){
              //         $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
              //         if($data['cooperator_complete']){
              //           $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
              //           if($data['purposes_complete']){
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents(UPLOAD_AMD_DIR.$file_name)
                                        );
                                  // }else{
                                  //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                  //   redirect('amendment/'.$id);
                                  // }
                                // }else{
                                //   $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                //   redirect('amendment/'.$id);
                                // }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                              redirect('amendment/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                          redirect('amendment/'.$id);
                        }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('amendment/'.$id);
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                  //   redirect('amendment'.$id);
                  // }
                // }
              // }
            }
//          }else{
//            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
//            redirect('cooperatives/'.$id.'/documents');
//          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('amendment/'.$id.'/amendment_documents');
        }
      }else{
        show_404();
      }
  
}

 function upload_cooptype_document($id = null,$document_num=null){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_document_num = $this->encryption->decrypt(decrypt_custom($document_num));
      //get document title 
      $qry_doc_title = $this->db->query("select title from amendment_coop_type_upload where document_num=' $decoded_document_num'");
      foreach($qry_doc_title->result() as $doc_row)
      {
        $doc_titled = $doc_row->title;
      }
   
    
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
      $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
      $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
      $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              // $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
               
              //   if($data['bylaw_complete']){
              //     $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                 
              //     if($data['cooperator_complete']){
              //       $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                   
              //       if($data['purposes_complete']){
              //         $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                     
              //         if($data['article_complete']){
              //           $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                      
              //           if($data['committees_complete']){    
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Upload Document';
              $data['header'] = 'Upload Document';
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['encrypted_id'] = $id;
              $data['encrypted_doc_num']= $document_num;
              $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
              $data['uid'] = $user_id;
              $data['coopid'] = $this->decoded_id;
              $data['document_titled'] = $doc_titled;
              $this->load->view('./template/header', $data);
              $this->load->view('amendment/upload_form/upload_cooptype_document', $data);
              $this->load->view('./template/footer');
              //           }else{
              //             $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
              //             redirect('amendment/'.$id);
              //           }
              //         }else{
              //           $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
              //           redirect('amendment/'.$id);
              //         }
              //       }else{
              //         $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
              //         redirect('amendment/'.$id);
              //       }
              //     }else{
              //       $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
              //       redirect('amendment/'.$id);
              //     }
              // }else{
              //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
              //   redirect('amendment/'.$id);
              // }
        }
      }else{
        show_404();
      }
  }

  function upload_acbl($id = null,$document_num=null){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_document_num = $this->encryption->decrypt(decrypt_custom($document_num));
      //get document title 
     
      if($decoded_document_num==41)
      {
        $doc_title  ="articles_of_cooperation";
      }
      if($decoded_document_num ==40)
      {
            $data['title'] = "Treasurer's Affidavit for Union";
            // $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$this->decoded_id);
            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
            $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
            // $data['no_of_cooperator'] = $this->unioncoop_model->get_total_number_of_cooperators($user_id);
            $data['no_of_cooperator'] = $this->amendment_union_model->get_total_number_of_cooperators($this->decoded_id);
            $data['total_regular'] = $this->unioncoop_model->get_total_regular($user_id,$this->decoded_id);
            // $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);
            $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($user_id);
            // $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data);
              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
              {

                  $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                 $data['no_of_cooperator_previous'] = $this->amendment_union_model->get_total_number_of_cooperators($amendment_dtl->id);
                
              }
              else
              {
                $this->load->model('unioncoop_model');

                  $data['no_of_cooperator_previous'] = $this->unioncoop_model->get_total_number_of_cooperators($cooperative_id);

              }  
              $data['total_new_cooperators_added'] = $data['no_of_cooperator'] -$data['no_of_cooperator_previous'];
              if($data['total_new_cooperators_added']<=0)
              {
              $data['total_new_cooperators_added'] = 0;
              }
               // $this->load->view('documents/union/amendment_treasurer_affidavit_union', $data);
            $f = new pdf();
            $html2 = $this->load->view('documents/union/amendment_treasurer_affidavit_union', $data, TRUE);

            // $f->setIsRemoteEnabled(true);
            // $f->setIsFontSubsettingEnabled(true);
            $f->set_option('isHtml5ParserEnabled', true);
            $f->set_option("isPhpEnabled", true);
            $f->setPaper('folio', 'portrait');
            $f->set_option('defaultFont','bookman');
            $f->load_html($html2);
            $f->render();
            $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
            $f->stream("treasurer_affidavit_union.pdf", array("Attachment"=>0));

        }else{
              $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2,3,4]);
              $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
              $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
              $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
              $data['title'] = "Treasurer's Affidavit for Union";
              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
              // $data['no_of_cooperator'] = $this->unioncoop_model->get_total_number_of_cooperators($data['coop_info']->users_id);
                $data['no_of_cooperator'] = $this->amendment_union_model->get_total_number_of_cooperators($this->decoded_id);
               $data['total_regular'] = $this->unioncoop_model->get_total_regular($data['coop_info']->users_id,$this->decoded_id);
              $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($data['coop_info']->users_id);
                if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
              {

                  $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                 $data['no_of_cooperator_previous'] = $this->amendment_union_model->get_total_number_of_cooperators($amendment_dtl->id);
                
              }
              else
              {
                $this->load->model('unioncoop_model');

                  $data['no_of_cooperator_previous'] = $this->unioncoop_model->get_total_number_of_cooperators($cooperative_id);

              }  
    
  }

  // modify by anjury
  function upload_document_others($id = null,$coop_id){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $coop_id = $this->encryption->decrypt(decrypt_custom($coop_id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($this->decoded_id);
//                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($this->decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                          // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                          // if($data['economic_survey_complete']){
                          //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                          //   if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation($this->decoded_id)){
                                $data['coop_type'] = $this->amendment_model->get_type_of_coop_single($data['coop_info']->type_of_cooperative,$coop_id);
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$this->decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $this->decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_others', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('amendment/'.$id);
                              }
                          //   }else{
                          //     $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                          //     redirect('amendment/'.$id);
                          //   }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                          //   redirect('amendment/'.$id);
                          // }
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
//                  }else{
//                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
//                    redirect('amendment/'.$id);
//                  }
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
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('amendment/'.$id);
          }
        }
      }else{
        show_404();
      }
    
  }
  
  function upload_document_5($id = null){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($this->decoded_id,$user_id)){
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$this->decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $this->decoded_id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id; 
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['coop_type'] = $this->amendment_model->get_type_of_coop_single($data['coop_info']->type_of_cooperative,$coop_id);
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_5', $data);
                $this->load->view('./template/footer');
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('branches/'.$id);
              }
            
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('branches/'.$id);
          }
        }
      }else{
        show_404();
      }
    
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1'))){
              $this->session->set_flashdata('document_one_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($coop_status==11){
                  $status_docs = 2;
              } else {
                  $status_docs = 1;
              }
              $file_array = array(
                'cooperative_id'=>$cooperative_id,
                'amendment_id'=>$this->decoded_id,
                'document_num'=>30,
                'filename'=>$this->upload->data('file_name'),
                'status'=> $status_docs,
                'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila')),
                'author'=>$this->session->userdata('user_id')
              );
           
              if($this->amendment_uploaded_document_model->add_document_info_amendment($file_array)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded document.');
                redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('amendment/'.$this->decoded_id);
          }
        }
      }else{
        redirect('amendment');
      }
    
  }


  function upload_document_6($id = null){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($this->decoded_id,$user_id)){
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$this->decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $this->decoded_id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id; 
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_6', $data);
                $this->load->view('./template/footer');
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('branches/'.$id);
              }
            
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('branches/'.$id);
          }
        }
      }else{
        show_404();
      }
    
  }
  function do_upload_6(){
   
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('branches');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          if(!$this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $decoded_uid.'_'.$this->decoded_id.'_GA_Resolution.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file6'))){
              $this->session->set_flashdata('document_6_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$this->decoded_id,6,$this->upload->data('file_name'))){
                $this->session->set_flashdata('document_6_success', 'Successfully uploaded G.A. Resolution.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_6_error', 'Please reupload G.A. Resolution.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_6_error', 'Please reupload G.A. Resolution.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('branches/'.$this->input->post('branchID'));
          }
        }
      }else{
        redirect('branches');

      }
    
  }

  function upload_document_7($id = null){

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($this->decoded_id,$user_id)){
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$this->decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $this->decoded_id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id; 
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_7', $data);
                $this->load->view('./template/footer');
              }else{
                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                redirect('branches/'.$id);
              }
            
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('branches');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('branches/'.$id);
          }
        }
      }else{
        show_404();
      }
    
  }

  function do_upload_7(){

      if($this->input->post('uploadOtherDocumentBtn')){

        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('branches');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          if(!$this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $decoded_uid.'_'.$this->decoded_id.'_certification.pdf';
            $config['allowed_types'] = 'pdf';
                'filename'=>$this->upload->data('file_name'),
                'status'=> $status_docs,
                'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila')),
                'author'=>$this->session->userdata('user_id')
              );
           
              if($this->amendment_uploaded_document_model->add_document_info_amendment($file_array)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded document.');
                redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('amendment/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('amendment');
      }
    
  }

  function do_upload_two(){

      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('amendment');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
          $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $user_id = $this->session->userdata('user_id');
          $data['coop_infos'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            $coop_status = $data['coop_infos']->status;
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $random_.'_'.$user_id.'_'.$this->decoded_id.'_BOD_and_Secretary_Cert.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            if($coop_status==11){
                  $status_docs = 2;
              } else {
                  $status_docs = 1;
              }
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
            }else{
                $file_array=array(
                    'cooperative_id'=>$cooperative_id,
                    'amendment_id '=>$this->decoded_id,
                    'document_num'=>20, //pre registration document
                    'filename'=>$this->upload->data('file_name'),
                    'status' =>$status_docs,
                    'created_at'=> date('Y-m-d h:i:s',now('Asia/Manila')),
                    'author' =>$user_id 
                );
                // $this->debug($file_array);
              if($this->amendment_uploaded_document_model->add_document_info_amendment($file_array)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
                redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('amendment/'.$this->input->post('amendment_id'));
          }
        }
      }else{
        redirect('amendment');
      }
    
  }
  //end modify

public function delete_pdf()
  {

    $doc_type =  $this->input->post("doc_type_");
    $id=  $this->encryption->decrypt(decrypt_custom($this->input->post('pdfID')));
    $this->decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
    $filename= $this->input->post('file_name');
     // echo $id.' amendment_id: '.$this->decoded_id.' filename: '.$filename;
    $amendment_id = $this->decoded_id;
    $config['upload_path'] = UPLOAD_AMD_DIR;
    $config['file_name'] = $filename;
    $file = $config['upload_path'].$config['file_name'];

       if(is_readable($file)){
            unlink($file);
            if($this->db->delete('amendment_uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/amendment_documents/list_upload_pdf/'.$this->input->post('amendment_id').'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/amendemnt_documents/list_upload_pdf/'.$this->input->post('amendment_id').'/'.$doc_type);
            }
           
       }
       else
       {
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/amendment_documents/list_upload_pdf/'.$amendment_id.'/'.$doc_type);
       }
  }
//end modify

  public function check_if_exist_doc($amendment_id,$doc_name)
  {
    $query = $this->db->query("select * from document_info where amendment_id = '$amendment_id' and name='$doc_name'");
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}

