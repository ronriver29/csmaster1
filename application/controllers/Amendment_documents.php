<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use Dompdf\Options;
class Amendment_documents extends CI_Controller{
  public $decoded_id=null;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
   
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
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
   
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        $cooperative_id= $this->amendment_model->coop_dtl($this->decoded_id);
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);

                $data['coop_type_compare'] = false;
                if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                {
                   $data['coop_type_compare'] = true;
                }

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                // if(!$data['bylaw_complete']) {
                //     $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                // }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
      
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
           
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                
                      // if(!$data['article_complete']) {
                      // $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;

                      // }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                      
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
                                 
                                $data['title'] = 'List of Documents';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $data['uid'] = $this->session->userdata('user_id');
                                $data['cid'] = $this->decoded_id;
                                $data['encrypted_id'] = $id;
                               
                                 $data['acbl'] = $this->amendment_model->acbl($this->decoded_id);

                                $this->load->view('template/header', $data);
                                $this->load->view('documents/amendment_list_of_documents', $data);
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
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }
          }else{
            if($this->session->userdata('access_level')==5 && $this->session->userdata('access_level')==2){
              redirect('admins/login');
            }else{
              if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('amendment');
                }else{
                  $this->load->model('admin_model');
                  $this->load->model('region_model');
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                    $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);

                    $data['coop_type_compare'] = false;
                    if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
                    {
                       $data['coop_type_compare'] = true;
                    }
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                   
                    if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                      // if(!$data['cooperator_complete']) {
                      //   $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                      // }
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
                                      $data['acbl'] = $this->amendment_model->acbl($this->decoded_id);
                                      $data['amendment_id'] = $this->decoded_id;
                                     
                                      $this->load->view('templates/admin_header', $data);
                                      $this->load->view('documents/amendment_list_of_documents', $data);
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
                  }else{  
                    $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'The cooperative is not yet submitted for evaluation.'));
                    redirect('amendment');
                  }
                } 
              } //end check reservation
          }
        }else{
          show_404();
        }
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
  if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_document_num =  $this->encryption->decrypt(decrypt_custom($document_num));
      $file_qry = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$this->decoded_id,'document_num'=>$decoded_document_num));
      if($file_qry->num_rows()>0)
      {
        foreach($file_qry->result_array() as $frow)
        {
          $file_name = $frow['filename'];
        }
      }
      // echo $file_name;
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$file_name)){
//          if($this->amendment_uploaded_document_model->check_document_of_cooperative(0,$this->decoded_id,1,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
                if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                            if($data['committees_complete']){
                              // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                              // if($data['economic_survey_complete']){
                              //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                              //   if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                      ->set_content_type('application/pdf','utf-8','CoopRIS')
                                      ->set_output(
                                        file_get_contents(UPLOAD_AMD_DIR.$file_name)
                                      );
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
                redirect('amendment'.$id);
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
               
              }else{
                if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('amendment');
                }else{
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                   $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                    if($data['bylaw_complete']){
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($this->decoded_id);
                              if($data['committees_complete']){
                                $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                                // if($data['economic_survey_complete']){
                                //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                                  // if($data['staff_complete']){
                                   $pdf_name = substr($file_name, 7);
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="'.$pdf_name.'.pdf"')
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
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('amendment'.$id);
                  }
                }
              }
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
}

 function upload_cooptype_document($id = null,$document_num=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{

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
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if(!$data['economic_survey_complete']) {
                            //     $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                            // }
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if(!$data['staff_complete']) {
                            //     $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                            //   }
                            //   if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
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
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('amendment/'.$id);
          }
        }
      }else{
        show_404();
      }
    }
  }

//json
 function do_upload_cooptype_document(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('amendment');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
          $decoded_document_num = $this->encryption->decrypt(decrypt_custom($this->input->post('document_num')));
          $file_qry = $this->db->get_where('amendment_coop_type_upload',array('document_num'=>$decoded_document_num));
            if($file_qry->num_rows()>0)
            {
              foreach($file_qry->result_array() as $row_file)
              {
                $doc_title = $row_file['title'];
              }
            }
          $user_id = $this->session->userdata('user_id');
          $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $this->session->userdata('user_id').'_'.$this->decoded_id.'_'.$doc_title.'.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1'))){
              $this->session->set_flashdata('document_one_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              $file_array = array(
                'cooperative_id'=>$cooperative_id,
                'amendment_id'=>$this->decoded_id,
                'document_num'=>$decoded_document_num,
                'filename'=>$this->upload->data('file_name'),
                'status'=>'1',
                'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila')),
                'author'=>$this->session->userdata('user_id')
              );
              // $this->debug($file_array);
              if($this->amendment_uploaded_document_model->add_document_info_amendment($file_array)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded.');
                redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document.');
                  redirect('amendment/'.$this->input->post('amendment_id').'/amendment_documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document.');
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
  }



  // ANJURY START
function do_upload_others(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('amendment');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          $coop_title = preg_replace('/\s+/', '_', $this->input->post('coop_title'));
          $coop_id = $this->input->post('coop_id');
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$this->decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($this->decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$this->decoded_id.'_'.$coop_title.'.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_amendment(0,$this->decoded_id,$coop_id,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
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
  }
  //ANJURY END  
  //json
  public function list_upload_pdf($id =null,$doc_type=null)
{

  if(!$this->session->userdata('logged_in'))
  {
  redirect(base_url());
 
  }
  else
  {
    $this->load->model('admin_model');
    $this->load->model('region_model');
    $this->load->model('user_model');
    $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $user_id = $this->session->userdata('user_id');
     $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
    $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
    $data['title'] = 'List of Documents';
    $user_id = $this->session->userdata('user_id');
    $data['client_info'] = $this->user_model->get_user_info($user_id);
    $data['is_client'] = $this->session->userdata('client');
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['cid'] = $this->decoded_id;
    $data['encrypted_id'] = $id;
    $data['doc_num'] = $doc_type;
    $count_coop = $this->count_documents2($this->decoded_id,$doc_type);

    $data['uploaded_list_pdf'] = $this->amendment_uploaded_document_model->get_document_info($this->decoded_id,$data['doc_num']);
    // if($count_coop>0){
    //     // $data['uploaded_list_pdf'] = $this->count_documents2($this->decoded_id,$doc_type);
    //     $data['uploaded_list_pdf'] = $this->count_documents($this->decoded_id,$doc_type);
    //     // $this->debug( $data['uploaded_list_pdf']);
    // } else {
    //     $data['uploaded_list_pdf'] = $this->count_documents($this->decoded_id,$doc_type);
    // }
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents($this->decoded_id,$doc_type);
    if($data['is_client'] ==1)
    {
     // $this->debug($data['coop_info']);
      $this->load->view('template/header',$data);
      $this->load->view('documents/amendment_list_of_uploaded_pdf',$data);
      $this->load->view('documents/amendment_delete_pdf_modal',$data);
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);  

     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/amendment_list_of_uploaded_pdf',$data);
     $this->load->view('documents/amendment_delete_pdf_modal');
     $this->load->view('templates/admin_footer', $data);
    // $this->debug($data['coop_info']);
    }
    else
    {
       if(!$this->session->userdata('logged_in'))
       {
          redirect('admins/login');
       }
       
    }      
    
       // print_r($this->session->userdata());
      
  }
}

public function count_documents_coop($coop_id,$num)
  {
    $query = $this->db->select('*')
             ->db->from('uploaded_documents')
             ->db->join('amendment_uploaded_documents','uploaded_documents.cooperatives_id = amendment_uploaded_documents.cooperatives_id','inner')
             ->db->where(array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
    if($query->num_rows()>0)
    {
      $data = $query->result_array();

    }
    else
    {
      $data = 0;
    }
    return $data;

  }
  public function count_documents2($amendment_id,$num)
  {
//    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id, 'document_num'=>$num,'status'=>1));
    if($query->num_rows()>0)
    {
      $data = $query->result_array();

    }
    else
    {
      $data = NULL;
    }
    return $data;

  }
  public function count_documents($amendment_id,$num)
  {

    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id, 'document_num'=>$num,'status'=>1));
    if($query->num_rows()>0)
    {
      $data = $query->result_array();

    }
    else
    {
      $data = NULL;
    }
    return $data;

  }
  //modify by anj
  public function count_documents_others($amendment_id,$num)
  {
    $query = $this->db->where('document_num = '.$num.' AND amendment_id ='.$amendment_id.' AND status = 1')->get('amendment_uploaded_documents');
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
  public function count_documents_others2($amendment_id,$num)
  {
    $query = $this->db->where('document_num = '.$num.' AND amendment_id ='.$amendment_id.' AND status = 1')->get('amendment_uploaded_documents');
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
  public function defered_count_documents($amendment_id,$num)
  {
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id, 'document_num'=>$num,'status'=>2));
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
  // end modify by anj
//end modify

  function branch($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->branches_model->check_own_branch($this->decoded_id,$user_id)){
              
                $branch_info = $this->branches_model->get_branch_info($user_id,$this->decoded_id);
                $data['branch_info'] = $branch_info;
                $data['title'] = 'List of Documents';
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['header'] = 'Documents';
                $data['uid'] = $this->session->userdata('user_id');
                $data['bid'] = $this->decoded_id;
                $data['cid'] = $branch_info->application_id;
                $data['encrypted_branch_id'] = $id;
                $data['type']=substr($branch_info->branchName, -7);
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                
                $this->load->view('template/header', $data);
                $this->load->view('documents/list_of_documents_branch', $data);
                $this->load->view('template/footer');
              
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('branches');
            }


          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
                if($this->branches_model->check_submitted_for_evaluation($this->decoded_id)) {
                  //
                  $branch_info=$this->branches_model->get_branch_info_by_admin($this->decoded_id);
                  $data['branch_info'] = $branch_info;
                  $data['title'] = 'List of Documents';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['header'] = 'Documents';
                  $data['uid'] = $this->session->userdata('user_id');
                  $data['bid'] = $this->decoded_id;
                  $data['cid'] = $this->decoded_id;
                  $data['encrypted_branch_id'] = $id;
                  $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));

                  $data['type']=substr($branch_info->branchName, -7);
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                  $this->load->view('templates/admin_header', $data);
                  $this->load->view('documents/list_of_documents_branch', $data);
                  $this->load->view('cooperative/evaluation/approve_modal_branch');
                  $this->load->view('cooperative/evaluation/deny_modal_branch');
                  $this->load->view('cooperative/evaluation/defer_modal_branch');
                  $this->load->view('templates/admin_footer');
                } else{
                  $this->session->set_flashdata('redirect_applications_message', 'The branches is not yet submitted for evaluation.');
                  redirect('branches');
                }
              
            }
          }

        }else{
          show_404();
        }
    }
  }
  function articles_cooperation_primary($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      ini_set('memory_limit', '-1');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      $regNo= $this->amendment_model->get_regno_by_amd_id($this->decoded_id);
      $fisrt_amendment = false;
      $next_amendment = false;
      $this->load->library('pdf');
      $this->load->model('bylaw_model');
       $this->load->model('cooperator_model');
       $this->load->model('article_of_cooperation_model');
       $this->load->model('capitalization_model');
       
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
              
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                   
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                 
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                    
                        if($data['committees_complete']){
                  
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                               $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                           
                              $purposes=$this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);
                              $data['purposes_list'] =$purposes;
                              $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                              $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);
                                $data['directors_list'] = $this->cooperator_model->get_list_of_directors($cooperative_id);
                               $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($cooperative_id);
                               
                              $data['no_of_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$this->decoded_id);
                              $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                               
                              $data['regular_cooperator_list'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($this->decoded_id);
                               $data['regular_cooperator_list_coop'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($cooperative_id);
                               $data['regular_cooperator_list_new'] = $this->amendment_cooperator_model->new_regular_cooperator($this->decoded_id);
                              $data['associate_cooperator_list'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($this->decoded_id);
                             
                              $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);

                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($cooperative_id);
                              
                              // $data['cooperators_list_board']=$this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id);

                               $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                              
                               $data['in_chartered_cities_orig'] =false;
                               $data['nextAmendment'] = false;
                              if($this->amendment_model->if_had_amendment($regNo,$this->decoded_id))
                              { 
                                 $next_amendment = true;
                                   $data['nextAmendment'] = true;
                                  if($next_amendment)
                                  {  
                                    //Next Amendment
                                    //get last amendment dtl
                                    $last_amendment_dtl =  $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $last_amendment_dtl->id; //last registered amendment id

                                   $data['coop_info_orig']= $this->amendment_model->get_cooperative_info_by_admin($last_amendment_dtl->id);
                                    $coop_info_orig  =$data['coop_info_orig'];
                                   $acronym='';
                                    if(strlen($coop_info_orig->acronym)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym.')';
                                    }
                                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                    }
                                    else
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    }
                                    $data['coop_info_orig'] = $coop_info_orig;
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                    $purposes_orig=$this->amendment_purpose_model->get_all_purposes($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                    $data['purposes_list_orig'] =$purposes_orig;
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                     $data['directors_list_orig'] = $this->amendment_cooperator_model->get_list_of_directors($last_amendment_dtl->id); 
                                      $data['regular_cooperator_list_orig'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($last_amendment_dtl->id);
                                    $data['associate_cooperator_list_orig'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($last_amendment_dtl->id);
                                    $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                     $data['cooperators_list_board_orig']=$this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                      $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);
                                      // echo $this->db->last_query();
                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      }
                                  }    
                              }
                              else
                              { 
                                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                     $acronym='';
                                     $coop_info_orig  =$data['coop_info_orig'];
                                    if(strlen($coop_info_orig->acronym_name)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym_name.')';
                                    }
                                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                    
                                   $data['directors_list_orig'] = $this->cooperator_model->get_list_of_directors($cooperative_id);
                                   $purposes_orig=$this->amendment_purpose_model->get_all_purposes2($cooperative_id);
                                    $data['purposes_list_orig'] =$purposes_orig;
                                    // $this->debug( $data['purposes_list_orig']);
                                    $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                    $data['regular_cooperator_list_orig'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop_orig($cooperative_id);
                                    // echo $this->db->last_query();
                                    $data['associate_cooperator_list_orig'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($cooperative_id);
                                    $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                     $data['cooperators_list_board_orig']=$this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);
                                      $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                    if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                    {
                                    $data['in_chartered_cities_orig']=true;
                                    $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                    }  
                              }//end had amendment     
                             
                              $data['commonBond_'] = $this->amendment_model->get_common_bond($data['coop_info']);
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
              
                                  // $this->load->view('documents/primary/amendment_articles_of_cooperation_for_primary', $data);
                                $html2 = $this->load->view('documents/primary/amendment_articles_of_cooperation_for_primary', $data,TRUE);
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                
                                $this->load->library('session');
                                $path = 'articles_of_cooperation_primary.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  'pagecount' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                  $data_doc = array(
                                    'amendment_id' => $this->decoded_id,
                                    'name' => 'articles',
                                    'total_pages' => $this->session->userdata('pagecount')
                                  );
                                 if($this->check_if_exist_doc($this->decoded_id,$data_doc['name']))
                                 {
                                    $this->db->where('amendment_id', $this->decoded_id);
                                    $this->db->update('document_info', $data_doc);
                                 }
                                 else
                                 {
                                    $this->db->insert('document_info',$data_doc);
                                 }
                                $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                            
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
            if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                     
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                                $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                           
                                $purposes=$this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);
                              $data['purposes_list'] =$purposes;
                                $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                                $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);
                              
                                $data['directors_list'] = $this->cooperator_model->get_list_of_directors($cooperative_id);
                                $data['no_of_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$this->decoded_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                                $data['regular_cooperator_list'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($this->decoded_id);
                                $data['regular_cooperator_list_new'] = $this->amendment_cooperator_model->new_regular_cooperator($this->decoded_id);
                                 $data['regular_cooperator_list_coop'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($cooperative_id);
                                $data['associate_cooperator_list'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($this->decoded_id);
                                $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                                   $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($cooperative_id);
                                // $data['cooperators_list_board']=$this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id);
                                 $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($cooperative_id);
                                 
                                $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                               $data['in_chartered_cities_orig']=false;   
                                $data['nextAmendment'] = false;
                              if($this->amendment_model->if_had_amendment($regNo,$this->decoded_id))
                              { //echo"next";
                                 $next_amendment = true;
                                  $data['nextAmendment'] = true;
                                  if($next_amendment)
                                  {  
                                    //Next Amendment
                                    //get last amendment dtl
                                    $last_amendment_dtl =  $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $last_amendment_dtl->id; //last registered amendment id

                                   $data['coop_info_orig']= $this->amendment_model->get_cooperative_info_by_admin($last_amendment_dtl->id);
                                    $coop_info_orig  =$data['coop_info_orig'];
                                    $acronym='';
                                    if(strlen($coop_info_orig->acronym)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym.')';
                                    }
                                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                    }
                                    else
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    }
                                   $coop_info_orig->acronym_name = $coop_info_orig->acronym;
                                    $data['coop_info_orig'] = $coop_info_orig;
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                    $purposes_orig=$this->amendment_purpose_model->get_purposes_($last_amendment_dtl->id);
                                    
                                    $data['purposes_list_orig'] =$purposes_orig;
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                     $data['directors_list_orig'] = $this->amendment_cooperator_model->get_list_of_directors($last_amendment_dtl->id); 
                                      $data['regular_cooperator_list_orig'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($last_amendment_dtl->id);
                                    $data['associate_cooperator_list_orig'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($last_amendment_dtl->id);
                                    $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                     $data['cooperators_list_board_orig']=$this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($last_amendment_dtl->cooperative_id,$last_amendment_dtl->id);
                                      $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);
                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      }
                                  }    
                              }
                              else
                              { 
                                    // $fisrt_amendment=true;
                                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                     $acronym='';
                                    $coop_info_orig= $data['coop_info_orig'];
                                    if(strlen($coop_info_orig->acronym_name)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym_name.')';
                                    }
                                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;

                                    $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                    $purposes_orig=$this->amendment_purpose_model->get_all_purposes2($cooperative_id);
                                    $data['purposes_list_orig'] =$purposes_orig;
                                    $data['directors_list_orig'] = $this->cooperator_model->get_list_of_directors($cooperative_id);
                             
                                    $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                    $data['regular_cooperator_list_orig'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($cooperative_id);
                                    $data['associate_cooperator_list_orig'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($cooperative_id);
                                    $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                     $data['cooperators_list_board_orig']=$this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);
                                      $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                    if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                    {
                                    $data['in_chartered_cities_orig']=true;
                                    $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                    }  
                              }//end had amendment 
                               $data['commonBond_'] = $this->amendment_model->get_common_bond($data['coop_info']);
                               $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                               if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
                              unset($coop_info_orig );
                               // $this->load->view('documents/primary/amendment_articles_of_cooperation_for_primary', $data);
                              // $check_date_reg_new = false;
                              // if($this->amendment_model->newly_registered_date_of_primary($cooperative_id)->date_difference>0)
                              // {
                              //   $check_date_reg_new =true;
                              // }
                              // $data['new_reg_coop'] = $check_date_reg_new ;
                               
                                $html2 = $this->load->view('documents/primary/amendment_articles_of_cooperation_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                 $this->load->library('session');
                              // $path = 'articles_of_cooperation_primary.pdf';
                              $getTotalPages = $f->get_canvas()->get_page_count();
                              $user_data = array(
                                // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                'pagecount' => $getTotalPages
                              );
                              $this->session->set_userdata($user_data);
                                  $data_doc = array(
                                    'amendment_id' => $this->decoded_id,
                                    'name' => 'articles',
                                    'total_pages' => $this->session->userdata('pagecount')
                                  );
                                 if($this->check_if_exist_doc($this->decoded_id,$data_doc['name']))
                                 { 
                                    $this->db->where('amendment_id', $this->decoded_id);
                                    $this->db->update('document_info', $data_doc);
                                   
                                 }
                                 else
                                 {
                                    $this->db->insert('document_info',$data_doc);
                                 }

                              $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              
                    
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                            redirect('amendment/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('amendment');
              }
            }
          }
        }
      }else{
        show_404();
      }
    }
  }


  function articles_cooperation_union(){
    $data['title'] = 'Articles of Cooperation for Union';
    $data['pageCount'] = 1;
    $html = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
    $dompdf = new pdf();
    $dompdf->setPaper('folio', 'portrait');
    $dompdf->load_html($html);
    $dompdf->render();
    $data['pageCount'] = $dompdf->get_canvas()->get_page_count();
    unset($dompdf);
    $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
    $f = new pdf();
    $f->setPaper('folio', 'portrait');
    $f->load_html($html2);
    $f->render();
    $f->stream("articles_of_cooperation_union.pdf", array("Attachment"=>0));
  }

  function articles_cooperation_federation(){
    $data['title'] = 'Articles of Cooperation for Federation';
    $data['pageCount'] = 1;
    $html = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
    $dompdf = new pdf();
    $dompdf->setPaper('folio', 'portrait');
    $dompdf->load_html($html);
    $dompdf->render();
    $data['pageCount'] = $dompdf->get_canvas()->get_page_count();
    unset($dompdf);
    $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
    $f = new pdf();
    $f->setPaper('folio', 'portrait');
    $f->load_html($html2);
    $f->render();
    $f->stream("articles_of_cooperation_federation.pdf", array("Attachment"=>0));
  }
  function bylaws_primary($id = null){
    ini_set('max_execution_time', '300');
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->load->library('pdf');
      $this->load->model('cooperator_model');
      $this->load->model('capitalization_model');
      $this->load->model('bylaw_model');
      $this->load->model('cooperator_model');
      $this->load->model('cooperatives_model');
      $this->load->model('article_of_cooperation_model');
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                   

                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
    
                              $data['title'] = 'By Laws for Primary';
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);

                              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                               
                              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                              
                              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                            
                              $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                              $data['cooperator_chairperson'] = $this->amendment_cooperator_model->get_chairperson_of_coop($this->decoded_id);
                              $data['cooperator_vicechairperson'] = $this->amendment_cooperator_model->get_vicechairperson_of_coop($this->decoded_id);
                              $data['cooperator_directors'] = $this->amendment_cooperator_model->get_all_board_of_director_only($this->decoded_id);
                              $data['no_of_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$this->decoded_id);
                             
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                               // $data['cooperators_list_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id);
                                 $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);
                               $data['cooperator_directors']=$this->amendment_cooperator_model->get_all_board_of_director_only($this->decoded_id);
                               $data['nextAmendment'] = false;
                               if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {
                              
                                    //Next amendment
                                    $data['nextAmendment'] = true;
                                    $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;
                                    $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['regular_ar_qualifications_orig']= explode(";",$data['bylaw_info_orig']->regular_qualifications); 

                                    $data['assoc_ar_qualifications_orig'] = explode(";",$data['bylaw_info_orig']->associate_qualifications);
                                    $data['members_additional_requirements_orig'] = explode(";",$data['bylaw_info_orig']->additional_requirements_for_membership);
                                      $data['members_additional_conditions_to_vote_orig'] = explode(";",$data['bylaw_info_orig']->additional_conditions_to_vote);
                                   $data['coop_info_orig']= $this->amendment_model->get_cooperative_info_by_admin($amendment_id);
                                    $acronym='';
                                     $coop_info_orig = $data['coop_info_orig'];  
                                    if(strlen($coop_info_orig->acronym)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym.')';
                                    }
                                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                    }
                                    else
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    }
                                    $coop_info_orig->acronym_name = $coop_info_orig->acronym;
                                    // $this->debug($coop_info_orig);
                                    $data['coop_info_orig'] = $coop_info_orig;
                                    $data['cooperators_list_regular_orig'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$amendment_id);


                              }
                              else
                              {

                              //first amendment
                                    $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                    $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                    $data['regular_ar_qualifications_orig']= explode(";",$data['bylaw_info_orig']->regular_qualifications); 

                                    $data['assoc_ar_qualifications_orig'] = explode(";",$data['bylaw_info_orig']->associate_qualifications);
                                    $data['members_additional_requirements_orig'] = explode(";",$data['bylaw_info_orig']->additional_requirements_for_membership);
                                      $data['members_additional_conditions_to_vote_orig'] = explode(";",$data['bylaw_info_orig']->additional_conditions_to_vote);
                                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                    $coop_info_orig = $data['coop_info_orig'];  
                                    $acronym='';
                                    if(strlen($coop_info_orig->acronym_name)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym_name.')';
                                    }
                                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;

                                    $data['cooperators_list_regular_orig'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);
                             } //end of had amendment

                              $data['committees_others'] = $this->amendment_committee_model->get_all_others_committees_of_coop($this->decoded_id); 
                               $data['valid_for_credit_type'] = $this->amendment_committee_model->check_credit_committe_in_agriculture($this->decoded_id);
                              $data['has_credit'] = $this->amendment_committee_model->check_if_has_credit($this->decoded_id);

                               // var_dump($this->amendment_model->newly_registered_date_of_primary($cooperative_id));
                               $check_date_reg_new = false;
                              if($this->amendment_model->newly_registered_date_of_primary($cooperative_id)->date_difference>0)
                              {
                                $check_date_reg_new =true;
                              }
                              $data['new_reg_coop'] = $check_date_reg_new;
                               // var_dump($data['new_reg_coop']);
                              // $this->load->view('documents/primary/amendment_bylaws_for_primary',$data);
                              $html2 = $this->load->view('documents/primary/amendment_bylaws_for_primary', $data, TRUE);
                               $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                // $f->setBasePath(public_path()); // This line resolve
                                $f->render();
                                $this->load->library('session');
                                $path = 'amendment_bylaws_for_primary.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                  'total_pages' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                
                                  $data_doc = array(
                                    'amendment_id' => $this->decoded_id,
                                    'name' => 'bylaws',
                                    'total_pages' => $this->session->userdata('total_pages')
                                  );
                                 if($this->check_if_exist_doc($this->decoded_id,$data_doc['name']))
                                 {
                                    $this->db->where('amendment_id', $this->decoded_id);
                                    $this->db->update('document_info', $data_doc);
                                 }
                                 else
                                 {
                                    $this->db->insert('document_info',$data_doc);
                                 }
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));

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
            if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if(!$data['economic_survey_complete']) {
                            //     $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                            // }
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if(!$data['staff_complete']) {
                            //     $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                            //   }
                            //   if($data['staff_complete']){
                                $data['title'] = 'By Laws for Primary';
                                $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                                $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                                $data['cooperator_chairperson'] = $this->amendment_cooperator_model->get_chairperson_of_coop($this->decoded_id);
                                $data['cooperator_vicechairperson'] = $this->amendment_cooperator_model->get_vicechairperson_of_coop($this->decoded_id);
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($this->decoded_id);
                                $data['no_of_directors'] = $this->amendment_cooperator_model->no_of_directors($cooperative_id,$this->decoded_id);
                                // $data['cooperators_list_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id);
                                 // $data['cooperators_list_regular'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$this->decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);
                                 $data['cooperator_directors']=$this->amendment_cooperator_model->get_all_board_of_director_only($this->decoded_id);
                               $data['nextAmendment'] = false; 
                              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {   
                              $data['nextAmendment'] = true;                              
                                    //Next amendment
                                    $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;
                                    $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['regular_ar_qualifications_orig']= explode(";",$data['bylaw_info_orig']->regular_qualifications); 

                                    $data['assoc_ar_qualifications_orig'] = explode(";",$data['bylaw_info_orig']->associate_qualifications);
                                    $data['members_additional_requirements_orig'] = explode(";",$data['bylaw_info_orig']->additional_requirements_for_membership);
                                      $data['members_additional_conditions_to_vote_orig'] = explode(";",$data['bylaw_info_orig']->additional_conditions_to_vote);
                                    $coop_info_orig= $this->amendment_model->get_cooperative_info_by_admin($amendment_id);
                                    $acronym='';
                                    if(strlen($coop_info_orig->acronym)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym.')';
                                    }
                                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                    }
                                    else
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    }
                                    $data['coop_info_orig'] = $coop_info_orig;
                                    $data['cooperators_list_regular_orig'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id,$amendment_id);

                                 
                              }
                              else
                              {
                                  //first amendment
                                    $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                    $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                    $data['regular_ar_qualifications_orig']= explode(";",$data['bylaw_info_orig']->regular_qualifications); 

                                    $data['assoc_ar_qualifications_orig'] = explode(";",$data['bylaw_info_orig']->associate_qualifications);
                                    $data['members_additional_requirements_orig'] = explode(";",$data['bylaw_info_orig']->additional_requirements_for_membership);
                                      $data['members_additional_conditions_to_vote_orig'] = explode(";",$data['bylaw_info_orig']->additional_conditions_to_vote);
                                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                    $acronym='';
                                     $coop_info_orig = $data['coop_info_orig'];  
                                    if(strlen($coop_info_orig->acronym_name)>0)
                                    {
                                      $acronym=' ('.$coop_info_orig->acronym_name.')';
                                    }
                                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                                    }
                                    else
                                    {
                                      $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                                    }

                                    $data['cooperators_list_regular_orig'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($cooperative_id);

                             } //end of had amendment
                              $data['committees_others'] = $this->amendment_committee_model->get_all_others_committees_of_coop($this->decoded_id); 
                              $data['valid_for_credit_type'] = $this->amendment_committee_model->check_credit_committe_in_agriculture($this->decoded_id);
                              $data['has_credit'] = $this->amendment_committee_model->check_if_has_credit($this->decoded_id);
                             //admin bylaws
                               $check_date_reg_new = false;
                              if($this->amendment_model->newly_registered_date_of_primary($cooperative_id)->date_difference>0)
                              {
                                $check_date_reg_new =true;
                              }
                              $data['new_reg_coop'] = $check_date_reg_new;

                                // $this->load->view('documents/primary/amendment_bylaws_for_primary', $data);
                                $html2 = $this->load->view('documents/primary/amendment_bylaws_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                 $this->load->library('session');
                                $path = 'amendment_bylaws_for_primary.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                  'total_pages' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                
                                  $data_doc = array(
                                    'amendment_id' => $this->decoded_id,
                                    'name' => 'bylaws',
                                    'total_pages' => $this->session->userdata('total_pages')
                                  );
                                 if($this->check_if_exist_doc($this->decoded_id,$data_doc['name']))
                                 {
                                    $this->db->where('amendment_id', $this->decoded_id);
                                    $this->db->update('document_info', $data_doc);
                                 }
                                 else
                                 {
                                    $this->db->insert('document_info',$data_doc);
                                 }
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                            //   }else{
                            //     $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                            //     redirect('amendment/'.$id);
                            //   }
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
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('amendment');
              }
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function bylaws_union(){
    $data['title'] = 'By Laws for Union';
    $options = new Options();
    $options->setDpi(150);
    $f = new pdf($options);
    $f->setPaper('folio', 'portrait');
    $html2 = $this->load->view('documents/union/bylaws_for_union', $data, TRUE);
    $f->load_html($html2);
    $f->render();
    $f->stream("bylaws_union.pdf", array("Attachment"=>0));
  }
  function bylaws_federation($id=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
       $this->load->model('amendment_affiliators_model');
        $this->load->model('amendment_committee_model');
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id= $this->amendment_model->coop_dtl($decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
              $data['title'] = 'By Laws for Primary';
              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
              $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($decoded_id);
              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
              $data['primary_consideration'] = explode(";",$data['bylaw_info']->primary_consideration);
              $data['delegate_powers'] = explode(";",$data['bylaw_info']->delegate_powers);
              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
              $data['cooperators_list'] = $this->affiliators_model->get_all_cooperator_of_coop($user_id);
              // $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
              // $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
              $data['cooperator_directors'] = $this->amendment_affiliators_model->get_all_board_of_director_only($user_id);
              $data['no_of_directors'] = $this->amendment_affiliators_model->no_of_directors($user_id);
              $data['cooperator_chairperson'] = $this->amendment_affiliators_model->get_chairperson_of_coop($user_id);
              $data['cooperator_vicechairperson'] = $this->amendment_affiliators_model->get_vicechairperson_of_coop($user_id);
              $data['other_committees'] = $this->amendment_committee_model->get_all_custom_committee_names_of_coop($decoded_id);

              if($data['coop_info']->category_of_cooperative == 'Tertiary'){
              $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data, TRUE);
              } else {
                // $this->load->view('documents/federation/amendment_bylaw_federation', $data);
              $html2 = $this->load->view('documents/federation/amendment_bylaw_federation', $data, TRUE);
              }

              $f = new pdf();
              $f->setPaper('folio', 'portrait');
              $f->load_html($html2);
              $f->render();
              $f->stream("bylaws_federation.pdf", array("Attachment"=>0));
            }
            else
            {
              $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is already expired.');
                  redirect('amendment');
            }
          }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$data['coop_info']->users_id);
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
                    }
                      
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'By Laws for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['delegate_powers'] = explode(";",$data['bylaw_info']->delegate_powers);
                                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                                $data['cooperators_list'] = $this->affiliators_model->get_all_cooperator_of_coop($data['coop_info']->users_id);
                                $data['cooperator_chairperson'] = $this->affiliators_model->get_chairperson_of_coop($data['coop_info']->users_id);
                                $data['cooperator_vicechairperson'] = $this->affiliators_model->get_vicechairperson_of_coop($data['coop_info']->users_id);
                                $data['cooperator_directors'] = $this->affiliators_model->get_all_board_of_director_only($data['coop_info']->users_id);
                                $data['no_of_directors'] = $this->affiliators_model->no_of_directors($data['coop_info']->users_id);
                                // $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                // $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['primary_consideration'] = explode(";",$data['bylaw_info']->primary_consideration);
                                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop_fed($data['coop_info']->users_id); 
                              
                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
                                }
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("bylaws_federation.pdf", array("Attachment"=>0));
                                
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                        redirect('cooperatives/'.$id);
                      }
                    }else{
                      if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
                      redirect('cooperatives/'.$id);
                    }
                }else{
                  $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                  redirect('cooperatives/'.$id);
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('cooperatives');
              }
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function affidavit_primary($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->load->library('pdf');
      $this->load->model('capitalization_model');
       $this->load->model('cooperator_model');
       $this->load->model('bylaw_model');
       $this->load->model('article_of_cooperation_model');
       
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if(!$data['economic_survey_complete']) {
                            //     $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // }
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if(!$data['staff_complete']) {
                            //     $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   }
                              $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                               $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);  
                              // if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                              
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                              
                              $data['no_of_cooperator'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($this->decoded_id);
                               
                              $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                               
                              $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                              
                              $data['treasurer_of_coop'] = $this->amendment_cooperator_model->get_treasurer_of_coop($this->decoded_id);
                              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {
                               
                                   
                                    //Next amendment
                                     $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;
                                     $data['treasurer_of_coop_orig'] = $this->amendment_cooperator_model->get_treasurer_of_coop($amendment_id);
                                    $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id); 
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$amendment_id);
                                    $data['no_of_cooperator_orig'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($amendment_id);
                                    $data['prev_no_of_cooperator_orig']= $this->amendment_cooperator_model->get_prev_total_number_of_cooperators($amendment_id,$amendment_dtl->regNo);
                                    
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);

                                    $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$amendment_id);

                                      $data['total_new_cooperators_added_orig'] = $data['no_of_cooperator_orig'] -$data['prev_no_of_cooperator_orig'] ;
                                      if($data['total_new_cooperators_added_orig']<=0)
                                      {
                                        $data['total_new_cooperators_added_orig'] = 0;
                                      }        
                              }
                              else
                              {
                                 //first amendment

                                     $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);

                                     $data['treasurer_of_coop_orig'] = $this->cooperator_model->get_treasurer_of_coop($cooperative_id);

                                    $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                    $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                    $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                    $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                    $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);

                                    $data['total_new_cooperators_added_orig'] = $data['no_of_cooperator']; 
                                   

                                 
                              }//end of had amendment
                              
                              $data['total_new_cooperators_added'] = $data['no_of_cooperator'] -$data['no_of_cooperator_orig'];
                              if($data['total_new_cooperators_added']<=0)
                              {
                                $data['total_new_cooperators_added'] = 0;
                              }
                            
                              // $this->load->view('documents/primary/amendment_treasurer_affidavit_primary', $data);
                              $html2 = $this->load->view('documents/primary/amendment_treasurer_affidavit_primary', $data, TRUE);
                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
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
            if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if(!$data['economic_survey_complete']) {
                            //     $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                            // }
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if(!$data['staff_complete']) {
                            //     $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                            //   }
                            //   if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                                $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                                $data['no_of_cooperator'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($this->decoded_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);

                                $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                                $data['treasurer_of_coop'] = $this->amendment_cooperator_model->get_treasurer_of_coop($this->decoded_id);

                                 $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);
                              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {
                             
                                    //Next amendment
                                     $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;

                                     $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);

                                     $data['treasurer_of_coop_orig'] = $this->amendment_cooperator_model->get_treasurer_of_coop($amendment_id);
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$amendment_id);
                                    $data['no_of_cooperator_orig'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($amendment_id);
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);
                                    $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$amendment_id);
                                   $data['prev_no_of_cooperator_orig']= $this->amendment_cooperator_model->get_prev_total_number_of_cooperators($amendment_id,$amendment_dtl->regNo);
                                      $data['total_new_cooperators_added_orig'] = $data['no_of_cooperator_orig'] -$data['prev_no_of_cooperator_orig'] ;
                                      if($data['total_new_cooperators_added_orig']<=0)
                                      {
                                        $data['total_new_cooperators_added_orig'] = 0;
                                      }        
                            
                              }
                              else
                              {
                                //first amendment
                                $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                $data['treasurer_of_coop_orig'] = $this->cooperator_model->get_treasurer_of_coop($cooperative_id);
                                $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                 $data['total_new_cooperators_added_orig'] = $data['no_of_cooperator']; 
                              }//end of had amendment

                              $data['total_new_cooperators_added'] = $data['no_of_cooperator'] -$data['no_of_cooperator_orig'];
                              if($data['total_new_cooperators_added']<=0)
                              {
                                $data['total_new_cooperators_added'] = 0;
                              }

                                $this->load->view('documents/primary/amendment_treasurer_affidavit_primary', $data);
                                $html2 = $this->load->view('documents/primary/amendment_treasurer_affidavit_primary', $data, TRUE);
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
                            //   }else{
                            //     $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                            //     redirect('amendment/'.$id);
                            //   }
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
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is not yet submitted for evaluation.');
                redirect('amendment');
              }
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function affidavit_union(){
    $data['title'] = "Treasurer's Affidavit for Union";
    $options = new Options();
    $options->setDpi(150);
    $f = new pdf($options);
    $f->setPaper('folio', 'portrait');
    $html2 = $this->load->view('documents/union/treasurer_affidavit_union', $data, TRUE);
    $f->load_html($html2);
    $f->render();
    $f->stream("treasurer_affidavit_union.pdf", array("Attachment"=>0));
  }
  function affidavit_federation(){
    $data['title'] = "Treasurer's Affidavit for Federation";
    $options = new Options();
    $options->setDpi(150); 
    $f = new pdf($options);
    $f->setPaper('folio', 'portrait');
    $html2 = $this->load->view('documents/federation/treasurer_affidavit_federation', $data, TRUE);
    $f->load_html($html2);
    $f->render();
    $f->stream("treasurer_affidavit_federation.pdf", array("Attachment"=>0));
  }
  function economic_survey($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
             
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($this->decoded_id);
                        if($data['committees_complete']){
                          // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                          // if($data['economic_survey_complete']){
                          //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                          //   if($data['staff_complete']){
                              $data['title'] = "Economic Survey";
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                             
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                              
                              $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);
                              
                            
                              $data['survey_info'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($this->decoded_id);
                              
                              $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                              $data['cooperator_chairperson'] = $this->amendment_cooperator_model->get_chairperson_of_coop($this->decoded_id);
                              $data['cooperator_vicechairperson'] = $this->amendment_cooperator_model->get_vicechairperson_of_coop($this->decoded_id);
                              $data['cooperator_directors'] = $this->amendment_cooperator_model->get_all_board_of_director_only($this->decoded_id);
                              // $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                              $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                            
                              $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                             
                              $data['staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop_by_position($this->decoded_id);
                              $data['others_staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop_by_other_position($this->decoded_id);
                              $data['no_of_cooperator'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($this->decoded_id);
                              
                              $data['committees_list'] = $this->amendment_committee_model->get_all_committee_names_of_coop_multi($this->decoded_id);
                            
                              $data['cooperators_list_bods'] = $this->amendment_cooperator_model->get_all_cooperator_of_bods($this->decoded_id);

                               $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);  
                               $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {
                                $qry_a = $this->db->query("select amendmentNo from amend_coop where id ='$this->decoded_id'");
                                if($qry_a->num_rows()>0)
                                {
                                  foreach($qry_a->result() as $arow)
                                  {
                                    $AmendmentNo = $arow->amendmentNo;
                                  }
                                  
                                  if($AmendmentNo<=1)
                                  {
                                    //first amendment
                                    $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                                    $data['coop_info_orig'] = $this->cooperatives_model->get_cooperative_info($user_id,$cooperative_id);
                                    $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                    $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                    $data['members_composition_orig'] = $this->cooperatives_model->get_coop_composition($cooperative_id);
                                    $data['survey_info_orig'] = $this->economic_survey_model->get_economic_survey_by_coop_id($cooperative_id);
                                    $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                   
                                     $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                   
                                     $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                                    $data['others_staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop_by_other_position($this->decoded_id);
                        
                                     $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                   
                                     $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);

                                     $data['total_regular2'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                    
                                      $data['in_chartered_cities_orig'] =false;
                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig ']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      } 
                                  }
                                  else
                                  {
                                    //next amendment
                                     $amendment_dtl = $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;
                                     $data['capitalization_info_orig'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_id);
                                     $amendment_dtl = $this->amendment_model->amendment_dtl($cooperative_id);
                                    $amendment_id = $amendment_dtl->id;
                                    $data['coop_info_orig'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$amendment_id);
                                   
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$amendment_id);
                                    $data['members_composition_orig'] = $this->amendment_model->get_coop_composition($amendment_id);
                                    $data['survey_info_orig'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($amendment_id);
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);
                                      // echo $this->db->last_query();
                                     $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$amendment_id);
                                  
                                     $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                                  
                                     $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                   
                                     $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);
                                     $data['total_regular2'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                      $data['in_chartered_cities_orig'] =false;

                                     $data['total_regular2'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);

                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig ']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      }
                                  }
                                }
                                else
                                {
                                  echo"No data found.";
                                  exit;
                                }    
                              }
                              else
                              { 
                                $data['coop_info_orig'] = $this->cooperatives_model->get_cooperative_info($user_id,$cooperative_id);
                                $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                $data['members_composition_orig'] = $this->cooperatives_model->get_coop_composition($cooperative_id);
                                $data['survey_info_orig'] = $this->economic_survey_model->get_economic_survey_by_coop_id($cooperative_id);
                                $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                               
                                 $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                              
                                 $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                                // $data['others_staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop_by_other_position($this->decoded_id);
                               
                                 $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                              
                                 $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                                 $data['total_regular2'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                $data['in_chartered_cities_orig'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                {
                                $data['in_chartered_cities_orig']=true;
                                $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                }

                              }//end of had amendment
                              
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }
                              // $this->load->view('documents/amendment_economic_survey', $data);
                              $html2 = $this->load->view('documents/amendment_economic_survey', $data, TRUE);
                              $f = new pdf();
                               $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("economic_survey.pdf", array("Attachment"=>0));
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
          if($this->session->userdata('access_level')==5 && $this->session->userdata('access_level')==2){
            redirect('admins/login');
          }else{
            if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendent');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
               // echo $this->db->last_query();
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                        if($data['article_complete']){
                          $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($this->decoded_id);
                          if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if($data['staff_complete']){
                                $data['title'] = "Economic Survey";
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                                $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);
                                $data['survey_info'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($this->decoded_id);
                                $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($cooperative_id,$this->decoded_id);
                                $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);
                                $data['cooperator_chairperson'] = $this->amendment_cooperator_model->get_chairperson_of_coop($this->decoded_id);
                                $data['cooperator_vicechairperson'] = $this->amendment_cooperator_model->get_vicechairperson_of_coop($this->decoded_id);
                                $data['cooperator_directors'] = $this->amendment_cooperator_model->get_all_board_of_director_only($this->decoded_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                                $data['staff_list'] = $this->amendment_staff_model->get_all_staff_of_coop_by_position($this->decoded_id);
                                $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($this->decoded_id);
                                $data['no_of_cooperator'] = $this->amendment_cooperator_model->get_total_number_of_cooperators($this->decoded_id);
                                $data['committees_list'] = $this->amendment_committee_model->get_all_committee_names_of_coop_multi($this->decoded_id);
                                 $data['cooperators_list_bods'] = $this->amendment_cooperator_model->get_all_cooperator_of_bods($this->decoded_id);
                                  $data['capitalization_info'] = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);  
                               $data['capitalization_info_orig'] = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);
                              if($this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id))
                              {
                                $qry_a = $this->db->query("select amendmentNo from amend_coop where id ='$this->decoded_id'");
                                if($qry_a->num_rows()>0)
                                {
                                  foreach($qry_a->result() as $arow)
                                  {
                                    $AmendmentNo = $arow->amendmentNo;
                                  }
                                  
                                  if($AmendmentNo<=1)
                                  {
                                    //first amendment
                                    $data['coop_info_orig'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                   $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                  $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                                   $data['members_composition_orig'] = $this->cooperatives_model->get_coop_composition($cooperative_id);
                                   $data['survey_info_orig'] = $this->economic_survey_model->get_economic_survey_by_coop_id($cooperative_id);
                                   $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                    $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                    $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                                   $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                   $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);
                                      $data['in_chartered_cities_orig'] =false;
                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig ']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      }
                                  }
                                  else
                                  {
                                    //next amendment
                                     $amendment_dtl =$this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                                    $amendment_id = $amendment_dtl->id;
                                    $data['coop_info_orig'] = $this->amendment_model->get_cooperative_info_by_admin($amendment_id);
                                    $data['bylaw_info_orig'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_id);
                                    $data['article_info_orig'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$amendment_id);
                                    $data['members_composition_orig'] = $this->amendment_model->get_coop_composition($amendment_id);
                                    $data['survey_info_orig'] = $this->amendment_economic_survey_model->get_economic_survey_by_coop_id($amendment_id);
                                    $data['total_regular_orig'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$amendment_id);
                                  
                                     $data['total_associate_orig'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$amendment_id);
                                  
                                     $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                                  
                                     $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                                   
                                     $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);
                                      $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                      $data['in_chartered_cities_orig'] =false;
                                      if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                      {
                                      $data['in_chartered_cities_orig ']=true;
                                      $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                      }
                                  }
                                }
                                else
                                {
                                  echo"No data found.";
                                  exit;
                                }    
                              }
                              else
                              {
                               
                                $data['coop_info_orig'] = $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);
                                $data['bylaw_info_orig'] = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);
                                $data['article_info_orig'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id);
                               $data['members_composition_orig'] = $this->cooperatives_model->get_coop_composition($cooperative_id);
                               $data['survey_info_orig'] = $this->economic_survey_model->get_economic_survey_by_coop_id($cooperative_id);
                               $data['total_regular_orig'] = $this->cooperator_model->get_total_regular($cooperative_id);
                                $data['total_associate_orig'] = $this->cooperator_model->get_total_associate($cooperative_id);
                                $data['staff_list_orig'] = $this->staff_model->get_all_staff_of_coop_by_position($cooperative_id);
                               $data['no_of_cooperator_orig'] = $this->cooperator_model->get_total_number_of_cooperators($cooperative_id);
                               $data['committees_list_orig'] = $this->committee_model->get_all_committee_names_of_coop_multi($cooperative_id);
                                // $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                $data['total_regular2'] = $this->amendment_cooperator_model->get_total_regular_amendment($cooperative_id,$this->decoded_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                                $data['in_chartered_cities_orig'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info_orig']->cCode))
                                {
                                $data['in_chartered_cities_orig']=true;
                                $data['chartered_cities_orig'] =$this->charter_model->get_charter_city($data['coop_info_orig']->cCode);
                                }
                              }//end of had amendment
                                  
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }
                               //admin economic_survey
                                // $this->load->view('documents/amendment_economic_survey', $data);
                                $html2 = $this->load->view('documents/amendment_economic_survey', $data, TRUE);
                                $f = new pdf();
                                 $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("economic_survey.pdf", array("Attachment"=>0));
                            //   }else{
                            //     $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                            //     redirect('amendment/'.$id);
                            //   }
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
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                redirect('amendment');
              }
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function view_document_one($id = null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$decoded_filename)){
//          if($this->amendment_uploaded_document_model->check_document_of_cooperative(0,$this->decoded_id,1,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
                if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                            if($data['committees_complete']){
                              // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                              // if($data['economic_survey_complete']){
                              //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                              //   if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="General_Assembly.pdf"')
                                      ->set_content_type('application/pdf','utf-8','CoopRIS')
                                      ->set_output(
                                        file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                                      );
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
                redirect('amendment'.$id);
              }
            }else{
              if(!$this->session->userdata('access_level')==1){
                redirect('admins/login');
              }else{
                if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('amendment');
                }else{
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                    if($data['bylaw_complete']){
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count($this->decoded_id);
                              if($data['committees_complete']){
                                // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                                // if($data['economic_survey_complete']){
                                //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                                //    if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                                        );
                                //   }else{
                                //     $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                //     redirect('amendment/'.$id);
                                //   }
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
                  }else{
                  
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('amendment'.$id);
                  }
                }
              }
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
  }
  function view_document_two($id = null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative(0,$this->decoded_id,2,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->cooperatives_model->check_own_cooperative($this->decoded_id,$user_id)){
                if(!$this->cooperatives_model->check_expired_reservation($this->decoded_id,$user_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->committee_model->committee_complete_count($this->decoded_id);
                            if($data['committees_complete']){
                              // $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                              // if($data['economic_survey_complete']){
                              //   $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                              //   if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                      ->set_content_type('application/pdf','utf-8')
                                      ->set_output(
                                        file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                                      );
                              //   }else{
                              //     $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              //     redirect('cooperatives/'.$id);
                              //   }
                              // }else{
                              //   $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              //   redirect('cooperatives/'.$id);
                              // }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                        redirect('cooperatives/'.$id);
                      }
                  }else{
                    $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                    redirect('cooperatives/'.$id);
                  }
                }else{
                  redirect('cooperatives/'.$id);
                }
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('amendment');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if($this->cooperatives_model->check_expired_reservation_by_admin($this->decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('cooperatives');
                }else{
                  if($this->cooperatives_model->check_submitted_for_evaluation($this->decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                    if($data['bylaw_complete']){
                        $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($this->decoded_id);
                              if($data['committees_complete']){
                                // $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                                // if($data['economic_survey_complete']){
                                //   $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                                //   if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                                        );
                                //   }else{
                                //     $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                //     redirect('cooperatives/'.$id);
                                //   }
                                // }else{
                                //   $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                //   redirect('cooperatives/'.$id);
                                // }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                          redirect('cooperatives/'.$id);
                        }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('cooperatives');
                  }
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
            redirect('cooperatives/'.$id.'/documents');
          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('cooperatives/'.$id.'/documents');
        }
      }else{
        show_404();
      }
    }
  }

function view_document_5($id = null,$branch_id=null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$this->decoded_id,5,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                        );
                                  
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('branches');
                  }

              }
            }
          }else{
            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
            redirect('branches/'.$id.'/documents');
          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('branches/'.$id.'/documents');
        }
      }else{
        show_404();
      }
    }
  }

  function view_document_6($id = null,$branch_id=null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$this->decoded_id,6,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                        );
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('branches');
                  }
                
              }
            }
          }else{
            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
            redirect('branches/'.$id.'/documents');
          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('branches/'.$id.'/documents');
        }
      }else{
        show_404();
      }
    }
  }

  function view_document_7($id = null,$branch_id=null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if(file_exists(UPLOAD_AMD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$this->decoded_id,7,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($this->decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_AMD_DIR.$decoded_filename)
                        );
                    
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                    redirect('branches');
                  }
                
              }
            }
          }else{
            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
            redirect('branches/'.$id.'/documents');
          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('branches/'.$id.'/documents');
        }
      }else{
        show_404();
      }
    }
  }


  function upload_document_one($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        }
                        if($data['committees_complete']){
                            // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                            // if(!$data['economic_survey_complete']) {
                            //     $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($this->decoded_id);
                            // }
                            // if($data['economic_survey_complete']){
                            //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                            //   if(!$data['staff_complete']) {
                            //     $data['staff_complete'] = $this->staff_model->requirements_complete($this->decoded_id);
                            //   }
                            //   if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $this->decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_one', $data);
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
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('amendment/'.$id);
          }
        }
      }else{
        show_404();
      }
    }
  }

  function upload_document_two($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model ->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
//                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                          // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
                          // if($data['economic_survey_complete']){
                          //   $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                          //   if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $this->decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_two', $data);
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
//                    redirect('cooperatives/'.$id);
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
  }

  function upload_document_other($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model ->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
//                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $this->decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_other', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
  }

  // modify by anjury
  function upload_document_others($id = null,$coop_id){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
  }
  
  function upload_document_5($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
    }
  }

  function do_upload_5(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
            $config['file_name'] = $decoded_uid.'_'.$this->decoded_id.'_business_plan.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file5'))){
              $this->session->set_flashdata('document_5_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$this->decoded_id,5,$this->upload->data('file_name'))){
                $this->session->set_flashdata('document_5_success', 'Successfully uploaded Business Plan.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_5_error', 'Please reupload Business Plan.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_5_error', 'Please reupload Business Plan.');
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
  }

  function do_upload_other(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('amendment');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
          $user_id = $this->session->userdata('user_id');
          $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
             $data['coop_infos'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            $random_ = random_string('alnum',5);
            $coop_status = $data['coop_infos']->status;
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $this->input->post('file1');
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
  }


  function upload_document_6($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
  }
  function do_upload_6(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
  }

  function upload_document_7($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
  }

  function do_upload_7(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file7'))){
              $this->session->set_flashdata('document_7_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$this->decoded_id,7,$this->upload->data('file_name'))){
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded Certification.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_7_error', 'Please reupload Certification.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_7_error', 'Please reupload Certification.');
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
  }
  //json
  function do_upload_one(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
       

        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('amendment');
        }else{
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amendment_id')));
          $user_id = $this->session->userdata('user_id');
          $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
             $data['coop_infos'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            $random_ = random_string('alnum',5);
            $coop_status = $data['coop_infos']->status;
            $config['upload_path'] = UPLOAD_AMD_DIR;
            $config['file_name'] = $random_.'_'.$this->session->userdata('user_id').'_'.$this->decoded_id.'_General_Assembly.pdf';
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
                'document_num'=>19,
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
  }

  function do_upload_two(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
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
  }
  //end modify
  //json
public function delete_pdf()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
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
                  redirect('/documents/list_upload_pdf/'.$amendment_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf/'.$amendment_id.'/'.$doc_type);
            }
           
       }
       else
       {
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/documents/list_upload_pdf/'.$amendment_id.'/'.$doc_type);
       }
      

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
