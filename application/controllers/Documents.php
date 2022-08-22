<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Options;
class Documents extends CI_Controller{
   var $pageCount = array();
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

    $this->load->model('cooperatives_model');
    $this->load->model('bylaw_model');
    $this->load->model('capitalization_model');
    $this->load->model('cooperator_model');
    $this->load->model('purpose_model');
    $this->load->model('article_of_cooperation_model');
    $this->load->model('committee_model');
    $this->load->model('economic_survey_model');
    $this->load->model('staff_model');
    $this->load->model('user_model');
    $this->load->model('charter_model');
    $this->load->model('branches_model');
    $this->load->model('uploaded_document_model');
    $this->load->model('admin_model');
    $this->load->model('region_model');
    $this->load->model('laboratories_model');
    $this->load->model('affiliators_model');
    $this->load->model('unioncoop_model');
    // $this->load->model('Sfc_model');
      $this->load->library('pdf');
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                          } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                          } else {
                              $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                          }
                          if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                  $data['document_others2'] = NULL;
                                    $data['document_others'] =NULL;
                                if(!empty($data['coop_type']))
                                {
                                  foreach($data['coop_type'] as $key => $docs_type)
                                  {
                                    if($key==0)
                                    // { 
                                    //   if($data['coop_info']->status==11) //deferred
                                    //   {
                                    //    $data['document_others']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                    //   }
                                    //   else
                                    //   {
                                       $data['document_others']= $this->get_documentss($decoded_id,$docs_type['document_num']);//$this->count_documents_others($decoded_id,$docs_type['document_num']);
                                      // }
                                    }
                                    
                                    if($key==1)
                                    {
                                      // if($data['coop_info']->status==11) //deferred
                                      // {
                                      //  $data['document_others2']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                      // }
                                      // else
                                      {
                                       $data['document_others2']= $this->get_documentss($decoded_id,$docs_type['document_num']);
                                      // }
                                    }
                                  }
                                }
                                
                               
                                $data['title'] = 'List of Documents';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $data['uid'] = $this->session->userdata('user_id');
                                $data['cid'] = $decoded_id;
                                $data['encrypted_id'] = $id;
    
                                // if($data['coop_info']->status==11) //deferred
                                // {
                                //   $data['document_one']= $this->defered_count_documents($decoded_id,1);
                                //   $data['document_two']= $this->defered_count_documents($decoded_id,2);
                                // }
                                // else
                                // {
                                  $data['document_one'] = $this->get_documentss($decoded_id,1);//$this->count_documents($decoded_id,1);
                                  if($data['document_one'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,1);
                                  }
                                   $data['document_two'] =$this->get_documentss($decoded_id,2);
                                  if($data['document_two'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,2);
                                  }
                                  $data['document_three'] =$this->get_documentss($decoded_id,3);
                                  if($data['document_three'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,3);
                                  }
                                  $data['document_four'] =$this->get_documentss($decoded_id,41);
                                  if($data['document_four'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,41);
                                  }
                                  $data['document_others_unifed'] =$this->get_documentss($decoded_id,42);
                                  if($data['document_others_unifed'])
                                  {
                                    $data['read_upload'] = $this->count_documents($decoded_id,42);
                                  }
                                // }  
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $this->load->view('documents/list_of_documents_federation', $data);
                                } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                  $this->load->view('documents/list_of_documents_union', $data);
                                } else {
                                    $this->load->view('documents/list_of_documents', $data);
                                }
                                
                                $this->load->view('template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
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
                      if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
              redirect('cooperatives');
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('cooperatives');
              }else{
                if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                      $capitalization_info = $data['capitalization_info'];
                      if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                      } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                      } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                      }
                      
                     if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                            } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_union($data['coop_info']->users_id);
                            } else {
                              $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                            }
                            if($data['gad_count']>0){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                    $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);

                                  $data['document_others2'] = NULL;
                                    $data['document_others'] =NULL;
                                if(!empty($data['coop_type']))
                                {
                                  foreach($data['coop_type'] as $key => $docs_type)
                                  {
                                    if($key==0)
                                    { 
                                    //   if($data['coop_info']->status==11) //deferred
                                    //   {
                                    //    $data['document_others']= $this->defered_count_documents($decoded_id,$docs_type['document_num']);
                                    //   }
                                    //   else
                                    //   {
                                       $data['document_others']= $this->get_documentss($decoded_id,$docs_type['document_num']);//$this->count_documents_others($decoded_id,$docs_type['document_num']);
                                      // }
                                    }
                                    
                                    if($key==1)
                                    {
                                     
                                       $data['document_others2']= $this->get_documentss($decoded_id,$docs_type['document_num']);
                                      
                                    }
                                  }
                                }  
                                         
                                  $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);
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
                                  $data['cooperatives_comments_snr_revert'] = $this->cooperatives_model->cooperatives_comments_snr_revert($decoded_id);
                                  $data['cooperatives_comments_snr_revert_defer'] = $this->cooperatives_model->cooperatives_comments_snr_revert_defer($decoded_id);
                                  
                                  $data['title'] = 'List of Documents';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $data['uid'] = $this->session->userdata('user_id');
                                  $data['cid'] = $decoded_id;
                                  $data['encrypted_id'] = $id;
                                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                                  $data['document_three'] = $this->uploaded_document_model->get_document_three_info($decoded_id);
                                  $data['document_four'] = $this->uploaded_document_model->get_document_four_info($decoded_id);
                                  $data['document_others_unifed'] = $this->uploaded_document_model->get_document_others_unifed_info($decoded_id);
                                  $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                                  $data['is_active_director'] = $this->admin_model->is_active_director($user_id);
                            
                                  $this->load->view('templates/admin_header', $data);
                                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $this->load->view('documents/list_of_documents_federation', $data);
                                  } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                                    $this->load->view('documents/list_of_documents_union', $data);
                                  } else {
                                      $this->load->view('documents/list_of_documents', $data);
                                  }
                                  $this->load->view('cooperative/evaluation/approve_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/deny_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/defer_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/revert_modal_cooperative');
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  // echo"dito";
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                  redirect('cooperatives/'.$id);
                                }
                              } else { 
                                // echo"hear";
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
                            } else {
                              // echo"ddd";
                              // echo $this->db->last_query();
                              $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                              redirect('cooperatives/'.$id);
                            }
                          } else { 
                            // echo"dddddf";
                            $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
          show_404();
        }
    }
  }

//modify by anj
function view_document_one_branch($id = null,$filename = null,$doc_type=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      // echo"<br />".$decoded_id;
      //  echo"<br />".$decoded_filename;
      //   echo"<br />".$doc_type;
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
            if($this->session->userdata('client')){
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $this->output
                ->set_header('Content-Disposition: inline; filename="'.$decoded_filename.'"') //modify
                    ->set_content_type('application/pdf','utf-8','CoopRIS')
                    ->set_output(
                      file_get_contents(UPLOAD_DIR.$decoded_filename)
                    );
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
//                if($this->branches_model->check_expired_reservation_by_admin($decoded_id)){
//                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
//                  redirect('branches');
//                }else{
//                  if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
//                    $data['coop_info'] = $this->branches_model->get_cooperative_info_by_admin($decoded_id);
                
                        $this->output
                            ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                            ->set_content_type('application/pdf','utf-8')
                            ->set_output(
                              file_get_contents(UPLOAD_DIR.$decoded_filename)
                            );
//                  }else{
//                    $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
//                    redirect('branches');
//                  }
//                }
              }
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
  
public function list_upload_pdf_branch($id =null,$doc_type=null)
{

  if(!$this->session->userdata('logged_in'))
  {
  redirect(base_url());
 
  }
  else
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    //echo $decoded_id;
    $branch_info = $this->branches_model->get_branch_info_document($decoded_id);
    $data['branch_info'] = $branch_info;
    $data['title'] = 'List of Documents';
    $user_id = $this->session->userdata('user_id');
    $data['client_info'] = $this->user_model->get_user_info($user_id);
    $data['is_client'] = $this->session->userdata('client');
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['cid'] = $decoded_id;
    $data['encrypted_id'] = $id;
    $data['doc_types'] = $doc_type;
    $data['uploaded_list_pdf'] =$this->count_documents_branch($decoded_id,$doc_type);
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents_branch($decoded_id,$doc_type);
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/list_of_uploaded_pdf_branch',$data);
      $this->load->view('documents/delete_pdf_branch_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 || ($this->session->userdata('access_level')==6)){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/list_of_uploaded_pdf_branch',$data);
     $this->load->view('documents/delete_pdf_branch_modal');
     $this->load->view('templates/admin_footer', $data);

    }
    else
    {
       if(!$this->session->userdata('logged_in')){
          redirect('admins/login');
       }
       
    }      
    
       // print_r($this->session->userdata());
      
  }
}
  public function count_documents_laboratory($coop_id,$num)
    {
    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  public function count_documents_laboratory_updating($coop_id,$num)
    {
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  public function defered_count_documents_laboratory($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>2));
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
  public function count_documents_branch($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  //modify by anj
  public function defered_count_documents_branch($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('branch_id'=>$coop_id, 'document_num'=>$num,'status'=>2));
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
  
  public function delete_pdf_branch()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
    {
    $doc_type =  $this->input->post("doc_type_");
    $coop_id = $this->input->post('cooperativeID');
    $id=  $this->encryption->decrypt(decrypt_custom($this->input->post('pdfID')));
    $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
    $filename= $this->input->post('file_name');
    $config['upload_path'] = UPLOAD_DIR;
    $config['file_name'] = $filename;
    $file = $config['upload_path'].$config['file_name'];

       if(is_readable($file)){
            unlink($file);
            if($this->db->delete('uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/documents/list_upload_pdf_branch/'.$coop_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf_branch/'.$coop_id.'/'.$doc_type);
            }
           
       }
       else
       {
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/documents/list_upload_pdf_branch/'.$coop_id.'/'.$doc_type);
       }
      

    }
  }

  public function delete_pdf_lab_updating()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
    {
    $doc_type =  $this->input->post("doc_type_");
    $coop_id = $this->input->post('cooperativeID');
    $id=  $this->encryption->decrypt(decrypt_custom($this->input->post('pdfID')));
    $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
    $filename= $this->input->post('file_name');
    $config['upload_path'] = UPLOAD_DIR;
    $config['file_name'] = $filename;
    $file = $config['upload_path'].$config['file_name'];

       if(is_readable($file)){
            unlink($file);
            if($this->db->delete('uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/documents/list_upload_pdf_laboratory_updating/'.$coop_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf_laboratory_updating/'.$coop_id.'/'.$doc_type);
            }
           
       }
       else
       {
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/documents/list_upload_pdf_laboratory_updating/'.$coop_id.'/'.$doc_type);
       }
      

    }
  }

  public function delete_pdf_lab()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
    {
    $doc_type =  $this->input->post("doc_type_");
    $coop_id = $this->input->post('cooperativeID');
    $id=  $this->encryption->decrypt(decrypt_custom($this->input->post('pdfID')));
    $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
    $filename= $this->input->post('file_name');
    $config['upload_path'] = UPLOAD_DIR;
    $config['file_name'] = $filename;
    $file = $config['upload_path'].$config['file_name'];

       if(is_readable($file)){
            unlink($file);
            if($this->db->delete('uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/documents/list_upload_pdf_laboratory/'.$coop_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf_laboratory/'.$coop_id.'/'.$doc_type);
            }
           
       }
       else
       {
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/documents/list_upload_pdf_laboratory/'.$coop_id.'/'.$doc_type);
       }
      

    }
  }
  // end modify by anj
// end modify by anj

//modify by json
public function list_upload_pdf($id =null,$doc_type=null)
{
  if(!$this->session->userdata('logged_in'))
  {
  redirect(base_url()); 
  }
  else
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    //echo $decoded_id;
    $data['title'] = 'List of Documents';
    $user_id = $this->session->userdata('user_id');
    $data['client_info'] = $this->user_model->get_user_info($user_id);
    $data['is_client'] = $this->session->userdata('client');
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['cid'] = $decoded_id;
    $data['encrypted_id'] = $id;
    $data['doc_types'] = $doc_type;
    $data['uploaded_list_pdf'] = $this->count_documents($decoded_id,$doc_type);
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents($decoded_id,$doc_type);
    $data['coop_info'] = $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/list_of_uploaded_pdf',$data);
      $this->load->view('documents/delete_pdf_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/list_of_uploaded_pdf',$data);
     $this->load->view('documents/delete_pdf_modal');
     $this->load->view('templates/admin_footer', $data);

    }
    else
    {
       if(!$this->session->userdata('logged_in')){
          redirect('admins/login');
       }
       
    }      
    
       // print_r($this->session->userdata());
      
  }
}

//modify by json
public function list_upload_pdf_laboratory($id =null,$doc_type=null)
{

  if(!$this->session->userdata('logged_in'))
  {
  redirect(base_url());
 
  }
  else
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    //echo $decoded_id;
    $branch_info = $this->branches_model->get_branch_info_document($decoded_id);
    $data['branch_info'] = $branch_info;
    $data['title'] = 'List of Documents';
    $user_id = $this->session->userdata('user_id');
    $data['client_info'] = $this->user_model->get_user_info($user_id);
    $data['is_client'] = $this->session->userdata('client');
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['cid'] = $decoded_id;
    $data['encrypted_id'] = $id;
    $data['doc_types'] = $doc_type;
    $data['uploaded_list_pdf'] =$this->count_documents_laboratory($decoded_id,$doc_type);
    // echo $this->db->last_query();
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents_branch($decoded_id,$doc_type);
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/list_of_uploaded_pdf_laboratory',$data);
      $this->load->view('documents/delete_pdf_lab_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/list_of_uploaded_pdf_laboratory',$data);
     $this->load->view('documents/delete_pdf_lab_modal');
     $this->load->view('templates/admin_footer', $data);

    }
    else
    {
       if(!$this->session->userdata('logged_in')){
          redirect('admins/login');
       }
       
    }      
    
       // print_r($this->session->userdata());
      
  }
}

public function list_upload_pdf_laboratory_updating($id =null,$doc_type=null)
{

  if(!$this->session->userdata('logged_in'))
  {
  redirect(base_url());
 
  }
  else
  {
    $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    //echo $decoded_id;
    $branch_info = $this->laboratories_model->get_lab_info_updating($decoded_id);
    $data['branch_info'] = $branch_info;
    $data['title'] = 'List of Documents';
    $user_id = $this->session->userdata('user_id');
    $data['client_info'] = $this->user_model->get_user_info($user_id);
    $data['is_client'] = $this->session->userdata('client');
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');
    $data['cid'] = $decoded_id;
    $data['encrypted_id'] = $id;
    $data['doc_types'] = $doc_type;
    $data['uploaded_list_pdf'] =$this->count_documents_laboratory_updating($decoded_id,$doc_type);
    // echo $this->db->last_query();
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents_branch($decoded_id,$doc_type);
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/list_of_uploaded_pdf_laboratory_updating',$data);
      $this->load->view('documents/delete_pdf_lab_updating_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 || ($this->session->userdata('access_level')==6)){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/list_of_uploaded_pdf_laboratory_updating',$data);
     $this->load->view('documents/delete_pdf_lab_modal');
     $this->load->view('templates/admin_footer', $data);

    }
    else
    {
       if(!$this->session->userdata('logged_in')){
          redirect('admins/login');
       }
       
    }      
    
       // print_r($this->session->userdata());
      
  }
}




//modify by jason
public function delete_pdf()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }
    else
    {
    $doc_type =  $this->input->post("doc_type_");
    $coop_id = $this->input->post('cooperativeID');
    $id=  $this->encryption->decrypt(decrypt_custom($this->input->post('pdfID')));
    $decoded_id =$this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
    $filename= $this->input->post('file_name');
    $config['upload_path'] = UPLOAD_DIR;
    $config['file_name'] = $filename;
    $file = $config['upload_path'].$config['file_name'];

       if(is_readable($file)){
            unlink($file);
            if($this->db->delete('uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/documents/list_upload_pdf/'.$coop_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf/'.$coop_id.'/'.$doc_type);
            }
           
       }
       else
       {
         if($this->db->delete('uploaded_documents',array('id'=>$id)))
            {
              $this->session->set_flashdata('delete_success', 'File Successfully deleted.');
                  redirect('/documents/list_upload_pdf/'.$coop_id.'/'.$doc_type);
            }
            else
            {
                $this->session->set_flashdata('delete_error', 'Failed to delete in database.');
                  redirect('/documents/list_upload_pdf/'.$coop_id.'/'.$doc_type);
            }
            // $this->session->set_flashdata('delete_error', 'Error file not exist.');
                  redirect('/documents/list_upload_pdf/'.$coop_id.'/'.$doc_type);
       }
      

    }
  }
//end modify

  //modify 
  public function do_upload_laborator(){
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
          // echo $CooperativeID.' '.$laboratoryID.' '.$user_id.' '.$document_name;
          // echo"<pre>"; print_r($items);echo"<pre>";
          
          $coop_info= $this->laboratories_model->get_lab_info($laboratoryID);

          // print_r($data['coop_info']);
          if($coop_info->status <=1 || ($coop_info->status==24))
          {
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
              redirect('laboratories/'.$items['encrypted_id'].'/UploadDocuments');
            }
            else
            {

                       
              //delete data in db
              $file_existed = $this->check_doc_first($CooperativeID,$laboratoryID,$doctype);
              // echo"<pre>";print_r($file_existed);echo"<pre>";  
              if($file_existed!=NULL)
              {
                  $file_to_remove = $config['upload_path'].$file_existed->filename;
                 if(is_readable($file_to_remove))
                  {
                      // echo "file is readable";
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
                      redirect('laboratories/'.$items['encrypted_id'].'/UploadDocuments');
                  }
                  else
                  {
                      $file = $config['upload_path'].$config['file_name'];
                        if(is_readable($file) && unlink($file))
                        {
                           $this->session->set_flashdata(array('status_msg'=>"danger",'doc_msg'=>"Failed to upload document please contact system administrator."));
                            redirect('laboratories/'.$items['encrypted_id'].'/UploadDocuments');
                        }
                        else
                        {
                           $this->session->set_flashdata(array('status_msg'=>"danger",'doc_msg'=>"Failed to upload document please contact system administrator."));
                          redirect('laboratories/'.$items['encrypted_id'].'/UploadDocuments');
                        }
                  }//upload lab do  
            }//if not do upload
          }
          else
          {
            print_r($coop_info->status);
            // $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for complianceaaaaaa.');
            // redirect('laboratories/'.$items['encrypted_id']);
          }//end status
        }//end if user admin 
      }  
      else
      {
       redirect('laboratories/'.$items['encrypted_id']);
      }//end of addbtn button
    } //end islogged session
  }
//end modify

  //modify
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
  //end modify
 
  //end modify
  public function count_documents($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  public function get_documentss($coop_id,$num)
  {
    $query = $this->db->query("select * from uploaded_documents where cooperatives_id='$coop_id' and document_num='$num' and status IN(1,2) order by id desc limit 1");//get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  //modify by anj
  public function count_documents_others($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('document_num'=>$num,'cooperatives_id'=>$coop_id,'status'=> 1));
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
  public function defered_count_documents($coop_id,$num)
  {
    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>2));
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
  function articles_cooperation_federation(){
    ini_set('memory_limit', '1024M');
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($_GET['id2']));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  // if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['members_list'] = $this->affiliators_model->get_applied_coop($user_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->affiliators_model->get_list_of_directors($user_id);
                              $data['no_of_directors'] = $this->affiliators_model->no_of_directors($user_id);
                              $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                              $data['regular_cooperator_list'] = $this->affiliators_model->get_all_regular_cooperator_of_coop($user_id);
                              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($user_id);

                              if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
                              //charter citie
                             // $this->debug($data['coop_info']);
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $_GET['id2'];
                                $data['title'] = 'Articles of Cooperation';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data);
                                } else {
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data);
                                }
                                $this->load->view('template/footer');
                              } else {
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                
                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
                                }

                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                
                                $this->load->library('session');
                                $path = 'articles_of_cooperation_primary.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                  'pagecount' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                $f->stream("articles_of_cooperation_federation.pdf", array("Attachment"=>0));
                              }

                              // $f = new pdf();
                              // $f->set_option("isPhpEnabled", true);

                              // if($data['coop_info']->cofc == 'Tertiary'){
                              //   $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data, TRUE);
                              // } else {
                              //   $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
                              // }

                              // $f->setPaper('folio', 'portrait');
                              // $f->load_html($html2);
                              // $f->render();
                              
                              // $this->load->library('session');
                              // $path = 'articles_of_cooperation_primary.pdf';
                              // $getTotalPages = $f->get_canvas()->get_page_count();
                              // $user_data = array(
                              //   // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                              //   'pagecount' => $getTotalPages
                              // );
                              // $this->session->set_userdata($user_data);
                              // $f->stream("articles_of_cooperation_federation.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
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
                    // redirect('cooperatives/'.$id);
                  }
              // }else{
                // $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                // redirect('cooperatives/'.$id);
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
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    // if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          // if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                                $data['directors_list'] = $this->affiliators_model->get_list_of_directors($data['coop_info']->users_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['total_regular'] = $this->affiliators_model->get_total_regular($data['coop_info']->users_id,$decoded_id);
                                $data['regular_cooperator_list'] = $this->affiliators_model->get_all_regular_cooperator_of_coop($data['coop_info']->users_id);
                                $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($data['coop_info']->users_id);
                                $data['members_list'] = $this->affiliators_model->get_applied_coop2($data['coop_info']->users_id);
                                $data['last_query'] = $this->db->last_query();

                                if($data['coop_info']->area_of_operation == 'Interregional'){
                                  $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                                }
                                //chartered cities
                                $data['in_chartered_cities'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                {
                                $data['in_chartered_cities']=true;
                                $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                }

                                if($data['coop_info']->status != 12){
                                  $data['encrypted_id'] = $_GET['id2'];
                                  $data['title'] = 'Articles of Cooperation';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $this->load->view('templates/admin_header', $data);
                                  if($data['coop_info']->cofc == 'Tertiary'){
                                    $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data);
                                  } else {
                                    $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data);
                                  }
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  if($data['coop_info']->cofc == 'Tertiary'){
                                      $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data, TRUE);
                                    } else {
                                      $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
                                    }
                                  
                                    $f = new pdf();
                                     $f->set_option("isPhpEnabled", true);
                                    $f->setPaper('folio', 'portrait');
                                    $f->load_html($html2);
                                    $f->render();
                                    $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                                    $this->load->library('session');
                                  $path = 'articles_of_cooperation_federation.pdf';
                                  $getTotalPages = $f->get_canvas()->get_page_count();
                                  $user_data = array(
                                    // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                    'pagecount' => $getTotalPages
                                  );
                                  $this->session->set_userdata($user_data);
                                }
                                
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                        redirect('cooperatives/'.$id);
                      }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                    //   // redirect('cooperatives/'.$id);
                    // }
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
  function articles_cooperation_primary($id = null){
     ini_set('memory_limit', '1024M');
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union' || $data['coop_info']->type_of_cooperative == 'Technology Service')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                          // if($data['coop_info']->created_at >= '2022-03-08'){
                          //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                          // } else {
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          // }
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                              
                              
                              $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              
                              if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_ts($decoded_id);
                                $data['no_of_directors'] = $this->affiliators_model->no_of_directors_ts($decoded_id);
                                $data['total_regular'] = $this->affiliators_model->get_total_regular_ts($decoded_id);
                              } else {
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              }

                              if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['cooperators_list_board'] = $this->affiliators_model->get_applied_coop_ts($decoded_id);
                              } else {
                                $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                              }
                              
                              if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
                              //charter citie
                             // $this->debug($data['coop_info']);
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);

                              if($data['coop_info']->is_youth == 0 && $data['coop_info']->type_of_cooperative != 'Technology Service'){
                                if($data['coop_info']->type_of_cooperative == 'Bank'){
                                  $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_bank', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                                }
                              } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $html2 = $this->load->view('documents/primary/technology_service/articles_of_cooperation_for_primary_ts', $data, TRUE);
                              } else {
                                $html2 = $this->load->view('documents/primary/youth/articles_of_cooperation_for_primary_youth', $data, TRUE);
                              }
                              
                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Articles of Cooperation';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->is_youth == 0 && $data['coop_info']->type_of_cooperative != 'Technology Service'){
                                  $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data); 
                                } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $this->load->view('documents/primary/technology_service/articles_of_cooperation_for_primary_ts', $data);
                                } else {
                                  $this->load->view('documents/primary/youth/articles_of_cooperation_for_primary_youth', $data);
                                }
                                $this->load->view('template/footer');
                              } else {
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                
                                $this->load->library('session');
                                $path = 'articles_of_cooperation_primary.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                  'pagecount' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || ($data['coop_info']->type_of_cooperative == 'Technology Service')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                                $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                                $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);

                                if($data['coop_info']->area_of_operation == 'Interregional'){
                                  $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                                }
                                //chartered cities
                                $data['in_chartered_cities'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                {
                                $data['in_chartered_cities']=true;
                                $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                }
                                if($data['coop_info']->status != 12){
                                  $data['title'] = 'Articles of Cooperation';
                                  $data['header'] = 'Articles of Cooperation';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('templates/admin_header', $data);
                                  if($data['coop_info']->is_youth == 0 && $data['coop_info']->type_of_cooperative != 'Technology Service'){
                                    $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data); 
                                  } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $this->load->view('documents/primary/technology_service/articles_of_cooperation_for_primary_ts', $data);
                                  } else {
                                    $this->load->view('documents/primary/youth/articles_of_cooperation_for_primary_youth', $data);
                                  }
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  
                                  if($data['coop_info']->is_youth == 0 && $data['coop_info']->type_of_cooperative != 'Technology Service'){
                                    $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                                  } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $html2 = $this->load->view('documents/primary/technology_service/articles_of_cooperation_for_primary_ts', $data, TRUE);
                                  } else {
                                    $html2 = $this->load->view('documents/primary/youth/articles_of_cooperation_for_primary_youth', $data, TRUE);
                                  }
                                  // $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                                  $f = new pdf();
                                   $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  $f->render();
                                  $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                                  $this->load->library('session');
                                  $path = 'articles_of_cooperation_primary.pdf';
                                  $getTotalPages = $f->get_canvas()->get_page_count();
                                  $user_data = array(
                                    // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                    'pagecount' => $getTotalPages
                                  );
                                  $this->session->set_userdata($user_data);
                                }
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
        show_404();
      }
    }
  }
  
  function branch($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['branch_info'] = $branch_info;
                // Ammend
                $branch_info_amend = $this->branches_model->get_branch_info_amend($user_id,$decoded_id);
                $data['branch_info_amend'] = $branch_info_amend;
                // End
                // $data['home'] = $branch_info_amend->amendment_id;
                $data['title'] = 'List of Documents';
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['header'] = 'Documents';
                $data['uid'] = $this->session->userdata('user_id');
                $data['bid'] = $decoded_id;
                $data['cid'] = $branch_info->application_id;
                $data['encrypted_branch_id'] = $id;
                $data['type']=substr($branch_info->branchName, -7);
                if($this->branches_model->check_if_amended($branch_info->regNo)){
                  $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->ammend_id));
                  $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->branch_id));
                } else {
                  $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                  $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info->id));
                }
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_three'] = $this->uploaded_document_model->get_document_three_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($branch_info->id,$branch_info->application_id);
                $data['document_others_unifed'] = $this->uploaded_document_model->get_document_42_info($branch_info->id,$branch_info->application_id);
                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['branch_info']->type);
                
                $data['in_chartered_cities'] =false;
                // $this->debug();
                if($this->charter_model->in_charter_city($data['branch_info']->cCode))
                {
                  $data['in_chartered_cities']=true;
                  $data['chartered_cities'] = $this->charter_model->get_charter_city($data['branch_info']->cCode);
                }
                // $data['ca_user_info'] = $this->sfc_model->get_cais_user($data['branch_info']->regNo);
                if(isset($data['ca_user_info'])>0){
                  $data['cafsis_info'] = $this->profile_model->get_saved_data_document($data['ca_user_info']->id);
                }
                
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
//                if($this->branches_model->check_submitted_for_evaluation($decoded_id)) {
                  //
                  // $branch_info=$this->branches_model->get_branch_info_by_admin($decoded_id);
                  $branch_info = $this->branches_model->get_branch_info_by_admin($decoded_id);
                  $data['branch_info'] = $branch_info;
                  // Ammend
                  $branch_info_amend = $this->branches_model->get_branch_info_amend_by_admin($decoded_id);
                  $data['branch_info_amend'] = $branch_info_amend;
                  $data['last_query'] = $this->db->last_query();
                  // End
                  $data['branch_info'] = $branch_info;
                  $data['title'] = 'List of Documents';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['header'] = 'Documents';
                  $data['uid'] = $this->session->userdata('user_id');
                  $data['bid'] = $decoded_id;
                  $data['cid'] = $decoded_id;
                  $data['encrypted_branch_id'] = $id;
                  // $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                  if($this->branches_model->check_if_amended($branch_info->regNo)){
                      
                    $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->ammend_id));
                    
                    $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info_amend->branch_id));
                  } else {
                    $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                    $data['encrypted_id_others'] = encrypt_custom($this->encryption->encrypt($branch_info->id));
                  }

                  // $data['branches_comments_cds'] = $this->branches_model->branches_comments_cds($branch_info->id);
                  if($branch_info->status == 23){
                      $evaluator_number = $branch_info->evaluator1;
                  } else {
                      $evaluator_number = $branch_info->evaluator4;
                  }

                  $data['branches_comments_main'] = $this->branches_model->branches_comments_main($branch_info->id,$branch_info->evaluator2);
                  // $data['last_query'] = $this->db->last_query();
                  // New
                  $data['branches_comments_cds'] = $this->branches_model->branches_comments_cds($branch_info->id);
                  $data['branches_comments_snr'] = $this->branches_model->branches_comments_snr($branch_info->id,$evaluator_number);
                  $data['branches_comments_snr_limit'] = $this->branches_model->branches_comments_snr_limit($branch_info->id,$evaluator_number);
                  //
                  // $data['branches_comments_snr'] = $this->branches_model->branches_comments_snr($branch_info->id,$evaluator_number);
                  $data['branches_comments_level1_defer'] = $this->branches_model->branches_comments_level1_defer($branch_info->id);

                  $data['branches_comments'] = $this->branches_model->branches_comments($branch_info->id,$branch_info->evaluator5);
                  $data['branches_comments_director'] = $this->branches_model->branches_comments_director($branch_info->id,$branch_info->evaluator2);
                  $data['branches_comments_director_limit'] = $this->branches_model->branches_comments_director_limit($branch_info->id,$branch_info->evaluator5);

                  // Outside Comments
                  $data['branches_comments_director_level1'] = $this->branches_model->branches_comments_director_level1($branch_info->id,$branch_info->evaluator2);
                  $data['branches_comments_snr_limit_level1'] = $this->branches_model->branches_comments_snr_limit_level1($branch_info->id,$evaluator_number);
                  // END New
                $data['type']=substr($branch_info->branchName, -7);
                // $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_three'] = $this->uploaded_document_model->get_document_three_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                $data['document_40'] = $this->uploaded_document_model->get_document_40_info($branch_info->id,$branch_info->application_id);
                $data['document_others_unifed'] = $this->uploaded_document_model->get_document_42_info($branch_info->id,$branch_info->application_id);

                
                $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                $data['is_active_director'] = $this->admin_model->is_active_director($user_id);
                $data['business_activities'] =  $this->branches_model->get_all_business_activities($branch_info->id);
                if($data['branch_info']->area_of_operation == 'Interregional'){
                  $data['regions_island_list'] = $this->region_model->get_selected_regions($branch_info->regions);
                }
                  $this->load->view('templates/admin_header', $data);
                  $this->load->view('documents/list_of_documents_branch', $data);
                  $this->load->view('cooperative/evaluation/approve_modal_branch');
                  $this->load->view('cooperative/evaluation/deny_modal_branch');
                  $this->load->view('cooperative/evaluation/defer_modal_branch');
                  $this->load->view('templates/admin_footer');
//                } else{
//                  $this->session->set_flashdata('redirect_applications_message', 'The branches is not yet submitted for evaluation.');
//                  redirect('branches');
//                }
              
            }
          }
        }else{
          show_404();
        }
    }
  }

  function articles_cooperation_union($id = null){
    ini_set('memory_limit', '1024M');
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  // if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'Articles of Cooperation for Union';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['members_list'] = $this->unioncoop_model->get_applied_coop($user_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->unioncoop_model->get_list_of_directors($user_id);
                              $data['no_of_directors'] = $this->unioncoop_model->no_of_directors($user_id);
                              $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                              $data['regular_cooperator_list'] = $this->affiliators_model->get_all_regular_cooperator_of_coop($user_id);
                              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($user_id);

                              if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
                              //charter citie
                             // $this->debug($data['coop_info']);
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              // $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data);
                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Articles of Cooperation';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data);
                                $this->load->view('template/footer');
                              } else {
                                $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
                                $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                
                                $this->load->library('session');
                                $path = 'articles_of_cooperation_union.pdf';
                                $getTotalPages = $f->get_canvas()->get_page_count();
                                $user_data = array(
                                  // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                  'pagecount' => $getTotalPages
                                );
                                $this->session->set_userdata($user_data);
                                $f->stream("articles_of_cooperation_union.pdf", array("Attachment"=>0));
                              }
                              // $f = new pdf();
                              // $f->set_option("isPhpEnabled", true);
                              // $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
                             
                              // $f->setPaper('folio', 'portrait');
                              // $f->load_html($html2);
                              // $f->render();
                              
                              // $this->load->library('session');
                              // $path = 'articles_of_cooperation_union.pdf';
                              // $getTotalPages = $f->get_canvas()->get_page_count();
                              // $user_data = array(
                              //   // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                              //   'pagecount' => $getTotalPages
                              // );
                              // $this->session->set_userdata($user_data);
                              // $f->stream("articles_of_cooperation_union.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
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
                    // redirect('cooperatives/'.$id);
                  }
              // }else{
                // $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                // redirect('cooperatives/'.$id);
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
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if(($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          // if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['members_list'] = $this->unioncoop_model->get_applied_coop($data['coop_info']->users_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                                $data['directors_list'] = $this->unioncoop_model->get_list_of_directors($data['coop_info']->users_id);
                                $data['no_of_directors'] = $this->unioncoop_model->no_of_directors($data['coop_info']->users_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                                $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($data['coop_info']->users_id);

                                if($data['coop_info']->area_of_operation == 'Interregional'){
                                  $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                                }
                                //chartered cities
                                $data['in_chartered_cities'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                {
                                $data['in_chartered_cities']=true;
                                $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                }

                                if($data['coop_info']->status != 12){
                                  $data['encrypted_id'] = $id;
                                  $data['title'] = 'Articles of Cooperation';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $this->load->view('templates/admin_header', $data);
                                  $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data);
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  $f = new pdf();
                                  $f->set_option("isPhpEnabled", true);
                                  $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  $f->render();
                                  
                                  $this->load->library('session');
                                  $path = 'articles_of_cooperation_union.pdf';
                                  $getTotalPages = $f->get_canvas()->get_page_count();
                                  $user_data = array(
                                    // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                    'pagecount' => $getTotalPages
                                  );
                                  $this->session->set_userdata($user_data);
                                  $f->stream("articles_of_cooperation_union.pdf", array("Attachment"=>0));
                                }
                              //   $html2 = $this->load->view('documents/union/articles_of_cooperation_for_union', $data, TRUE);
                              //   $f = new pdf();
                              //    $f->set_option("isPhpEnabled", true);
                              //   $f->setPaper('folio', 'portrait');
                              //   $f->load_html($html2);
                              //   $f->render();
                              //   $f->stream("articles_of_cooperation_union.pdf", array("Attachment"=>0));
                              //   $this->load->library('session');
                              // $path = 'articles_of_cooperation_union.pdf';
                              // $getTotalPages = $f->get_canvas()->get_page_count();
                              // $user_data = array(
                              //   // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                              //   'pagecount' => $getTotalPages
                              // );
                              // $this->session->set_userdata($user_data);
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
        show_404();
      }
    }
  }

  function articles_federation(){
    ini_set('memory_limit', '1024M');
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($_GET['id2']));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  // if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['members_list'] = $this->affiliators_model->get_applied_coop($user_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->affiliators_model->get_list_of_directors($user_id);
                              $data['no_of_directors'] = $this->affiliators_model->no_of_directors($user_id);
                              $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                              $data['regular_cooperator_list'] = $this->affiliators_model->get_all_regular_cooperator_of_coop($user_id);
                              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($user_id);

                              if($data['coop_info']->area_of_operation == 'Interregional'){
                                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                              }
                              //charter citie
                             // $this->debug($data['coop_info']);
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);

                              if($data['coop_info']->cofc == 'Tertiary'){
                                // $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data, TRUE);
                              } else {
                                $html2 = $this->load->view('documents/federation/amendment_article_federation', $data, TRUE);
                              }

                              // $f->setPaper('folio', 'portrait');
                              // $f->load_html($html2);
                              // $f->render();
                              
                              // $this->load->library('session');
                              // $path = 'articles_of_cooperation_primary.pdf';
                              // $getTotalPages = $f->get_canvas()->get_page_count();
                              // $user_data = array(
                              //   // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                              //   'pagecount' => $getTotalPages
                              // );
                              // $this->session->set_userdata($user_data);
                              $f->stream("articles_of_cooperation_federation.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
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
                    // redirect('cooperatives/'.$id);
                  }
              // }else{
                // $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                // redirect('cooperatives/'.$id);
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
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    // if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Union'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          // if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                                $data['directors_list'] = $this->affiliators_model->get_list_of_directors($data['coop_info']->users_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['total_regular'] = $this->affiliators_model->get_total_regular($data['coop_info']->users_id,$decoded_id);
                                $data['regular_cooperator_list'] = $this->affiliators_model->get_all_regular_cooperator_of_coop($data['coop_info']->users_id);
                                $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($data['coop_info']->users_id);
                                $data['members_list'] = $this->affiliators_model->get_applied_coop2($data['coop_info']->users_id);
                                $data['last_query'] = $this->db->last_query();

                                if($data['coop_info']->area_of_operation == 'Interregional'){
                                  $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                                }
                                //chartered cities
                                $data['in_chartered_cities'] =false;
                                if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                {
                                $data['in_chartered_cities']=true;
                                $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                }

                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation_tertiary', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/federation/articles_of_cooperation_for_federation', $data, TRUE);
                                }
                              
                                $f = new pdf();
                                 $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                                $this->load->library('session');
                              $path = 'articles_of_cooperation_federation.pdf';
                              $getTotalPages = $f->get_canvas()->get_page_count();
                              $user_data = array(
                                // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                                'pagecount' => $getTotalPages
                              );
                              $this->session->set_userdata($user_data);
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                        redirect('cooperatives/'.$id);
                      }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                    //   // redirect('cooperatives/'.$id);
                    // }
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
  function bylaws_primary($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union' || $data['coop_info']->type_of_cooperative == 'Technology Service')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                          // if($data['coop_info']->created_at >= '2022-03-08'){
                          //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                          // } else {
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          // }
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'By Laws for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              
                              if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['cooperator_directors'] = $this->affiliators_model->get_all_board_of_director_only($user_id);
                                $data['no_of_directors'] = $this->affiliators_model->no_of_directors($user_id);
                              } else {
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                              }
                              // echo $this->db->last_query();
                              
                              // $data['cooperator_directors'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                              // $this->debug($data['cooperator_directors']);
                              
                              if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['cooperators_list_regular'] = $this->affiliators_model->get_all_cooperator_of_coop_ts($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->affiliators_model->get_vicechairperson_of_coop_ts($decoded_id);
                                $data['cooperator_chairperson'] = $this->affiliators_model->get_chairperson_of_coop_ts($decoded_id);
                                // $data['last'] = $this->db->last_query();
                              } else {
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              }
                              $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 
                              $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                             // $this->load->view('documents/primary/bylaws_for_primary', $data); 
                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Bylaws';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->is_youth == 1){
                                  $this->load->view('documents/primary/youth/bylaws_for_primary_youth', $data);
                                } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $this->load->view('documents/primary/technology_service/bylaws_for_primary_ts', $data);
                                } else {
                                  $this->load->view('documents/primary/bylaws_for_primary', $data); 
                                }
                                $this->load->view('template/footer');
                              } else {

                                if($data['coop_info']->is_youth == 1){
                                  $html2 = $this->load->view('documents/primary/youth/bylaws_for_primary_youth', $data, TRUE);
                                } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $html2 = $this->load->view('documents/primary/technology_service/bylaws_for_primary_ts', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                }

                                $f = new pdf(); 
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                // $f->setBasePath(public_path()); // This line resolve
                                $f->render();
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            // if($data['coop_info']->created_at >= '2022-03-08'){
                            //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                            // } else {
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            // }
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'By Laws for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);

                                if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $data['cooperator_directors'] = $this->affiliators_model->get_all_board_of_director_only($user_id);
                                  $data['no_of_directors'] = $this->affiliators_model->no_of_directors($user_id);
                                } else {
                                  $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                  $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                }

                                // $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id);
                                $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                              // $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                if($data['coop_info']->status != 12){
                                  $data['title'] = 'Bylaws';
                                  $data['header'] = 'Bylaws';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('templates/admin_header', $data);

                                  if($data['coop_info']->is_youth == 1){
                                    $this->load->view('documents/primary/youth/bylaws_for_primary_youth', $data);
                                  } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $this->load->view('documents/primary/technology_service/bylaws_for_primary_ts', $data);
                                  } else {
                                    $this->load->view('documents/primary/bylaws_for_primary', $data); 
                                  }

                                  $this->load->view('templates/admin_footer');
                                } else {

                                  if($data['coop_info']->is_youth == 1){
                                    $html2 = $this->load->view('documents/primary/youth/bylaws_for_primary_youth', $data, TRUE);
                                  } else if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                    $html2 = $this->load->view('documents/primary/technology_service/bylaws_for_primary_ts', $data, TRUE);
                                  } else {
                                    $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                  }

                                  // $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                  $f = new pdf();
                                  $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  // $f->setBasePath(public_path()); // This line resolve
                                  $f->render();
                                  $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                                }
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
        show_404();
      }
    }
  }
  function bylaws_union($id=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = 'By Laws for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                              $data['cooperators_list'] = $this->unioncoop_model->get_applied_coop($user_id);
                              $data['cooperator_chairperson'] = $this->unioncoop_model->get_chairperson_of_coop($user_id);
                              $data['cooperator_vicechairperson'] = $this->unioncoop_model->get_vicechairperson_of_coop($user_id);
                              $data['cooperator_directors'] = $this->unioncoop_model->get_all_board_of_director_only($user_id);
                              $data['delegate_powers'] = explode(";",$data['bylaw_info']->delegate_powers);
                              $data['primary_consideration'] = explode(";",$data['bylaw_info']->primary_consideration);
                              // echo $this->db->last_query();
                              // $data['cooperator_directors'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                              // $this->debug($data['cooperator_directors']);
                              $data['no_of_directors'] = $this->unioncoop_model->no_of_directors($user_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              // $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 
                              $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                              $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop_union($user_id); 
                             // $this->load->view('documents/primary/bylaws_for_primary', $data); 
                              // $html2 = $this->load->view('documents/union/bylaws_for_union', $data);

                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Bylaws';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                $html2 = $this->load->view('documents/union/bylaws_for_union', $data);
                                $this->load->view('template/footer');
                              } else {

                                $html2 = $this->load->view('documents/union/bylaws_for_union', $data, TRUE);

                                $f = new pdf(); 
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                // $f->setBasePath(public_path()); // This line resolve
                                $f->render();
                                $f->stream("bylaws_union.pdf", array("Attachment"=>0));
                              }

                                // $html2 = $this->load->view('documents/union/bylaws_for_union', $data, TRUE);

                                // $f = new pdf(); 
                                // $f->set_option("isPhpEnabled", true);
                                // $f->setPaper('folio', 'portrait');
                                // $f->load_html($html2);
                                // // $f->setBasePath(public_path()); // This line resolve
                                // $f->render();
                                // $f->stream("bylaws_union.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
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
            redirect('cooperatives');
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
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    // if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          // if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = 'By Laws for Primary';
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['delegate_powers'] = explode(";",$data['bylaw_info']->delegate_powers);
                                $data['primary_consideration'] = explode(";",$data['bylaw_info']->primary_consideration);
                                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                                $data['cooperators_list'] = $this->unioncoop_model->get_applied_coop($data['coop_info']->users_id);
                                $data['cooperator_chairperson'] = $this->unioncoop_model->get_chairperson_of_coop($data['coop_info']->users_id);
                                $data['cooperator_vicechairperson'] = $this->unioncoop_model->get_vicechairperson_of_coop($data['coop_info']->users_id);
                                $data['cooperator_directors'] = $this->unioncoop_model->get_all_board_of_director_only($data['coop_info']->users_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id);
                                $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop_union($data['coop_info']->users_id); 
                              // $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);

                                if($data['coop_info']->status != 12){
                                  $data['encrypted_id'] = $id;
                                  $data['title'] = 'Bylaws';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $this->load->view('templates/admin_header', $data);
                                  $html2 = $this->load->view('documents/union/bylaws_for_union', $data);
                                  $this->load->view('templates/admin_footer');
                                } else {

                                  $html2 = $this->load->view('documents/union/bylaws_for_union', $data, TRUE);

                                  $f = new pdf(); 
                                  $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  // $f->setBasePath(public_path()); // This line resolve
                                  $f->render();
                                  $f->stream("bylaws_union.pdf", array("Attachment"=>0));
                                }
                                // $html2 = $this->load->view('documents/union/bylaws_for_union', $data, TRUE);
                                // $f = new pdf();
                                // $f->set_option("isPhpEnabled", true);
                                // $f->setPaper('folio', 'portrait');
                                // $f->load_html($html2);
                                // // $f->setBasePath(public_path()); // This line resolve
                                // $f->render();
                                // $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                        redirect('cooperatives/'.$id);
                      }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                    //   redirect('cooperatives/'.$id);
                    // }
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
  function bylaws_federation($id=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,0);
                    }
                  // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
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
                              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                              $data['primary_consideration'] = explode(";",$data['bylaw_info']->primary_consideration);
                              $data['delegate_powers'] = explode(";",$data['bylaw_info']->delegate_powers);
                              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                              $data['cooperators_list'] = $this->affiliators_model->get_all_cooperator_of_coop($user_id);
                              // $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              // $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->affiliators_model->get_all_board_of_director_only($user_id);
                              $data['no_of_directors'] = $this->affiliators_model->no_of_directors($user_id);
                              $data['cooperator_chairperson'] = $this->affiliators_model->get_chairperson_of_coop($user_id);
                              $data['cooperator_vicechairperson'] = $this->affiliators_model->get_vicechairperson_of_coop($user_id);
                              $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop_fed($user_id); 

                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Bylaws';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data);
                                } else {
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data);
                                }
                                $this->load->view('template/footer');
                              } else {

                                if($data['coop_info']->cofc == 'Tertiary'){
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data, TRUE);
                                } else {
                                  $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
                                }

                                $f = new pdf(); 
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                // $f->setBasePath(public_path()); // This line resolve
                                $f->render();
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                              }

                              // $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data);
                              // $data['data_type'] = $data['coop_info']->cofc;
                              // if($data['coop_info']->cofc == 'Tertiary'){
                              //   $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data, TRUE);
                              // } else {
                              //   $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
                              // }
                              
                              //   $f = new pdf();
                              //   $f->setPaper('folio', 'portrait');
                              //   $f->load_html($html2);
                              //   $f->render();
                              //   $f->stream("bylaws_federation.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                    } else {
                        $complete = 'Cooperators';
                    }
                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
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
                              
                                if($data['coop_info']->status != 12){
                                  $data['encrypted_id'] = $id;
                                  $data['title'] = 'Bylaws';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $this->load->view('templates/admin_header', $data);
                                  if($data['coop_info']->cofc == 'Tertiary'){
                                    $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data);
                                  } else {
                                    $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data);
                                  }
                                  $this->load->view('templates/admin_footer');
                                } else {

                                  if($data['coop_info']->cofc == 'Tertiary'){
                                    $html2 = $this->load->view('documents/federation/bylaws_for_federation_tertiary', $data, TRUE);
                                  } else {
                                    $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
                                  }

                                  $f = new pdf(); 
                                  $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  // $f->setBasePath(public_path()); // This line resolve
                                  $f->render();
                                  $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                                }
                                
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union' || $data['coop_info']->type_of_cooperative == 'Technology Service')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                          // if($data['coop_info']->created_at >= '2022-03-08'){
                          //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                          // } else {
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          // }
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_ts($decoded_id);
                              } else {
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              }
                              // $data['last_query'] = $this->db->last_query();
                                $f = new pdf();
                                $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data, TRUE);
                                $f->set_option('isHtml5ParserEnabled', true);
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                $f->set_option('defaultFont','bookman');
                                $f->load_html($html2);
                                $f->render();
                               $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
                                $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            // if($data['coop_info']->created_at >= '2022-03-08'){
                            //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                            // } else {
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            // }
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                if($data['coop_info']->type_of_cooperative == 'Technology Service'){
                                  $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_ts($decoded_id);
                                } else {
                                  $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                                }
                                  $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data, TRUE);
                                  $f = new pdf();
                                  $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  $f->render();
                                  $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
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
        show_404();
      }
    }
  }
  function affidavit_union($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  // if($data['coop_info']->grouping == 'Federation'){
                  //       $model = 'affiliators_model';
                  //       $ids = $user_id;
                  //       $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                  //   } 
                  //   else {
                  //       $model = 'cooperator_model';
                  //       $ids = $decoded_id;
                  //       $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
                  //   }
                  if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->unioncoop_model->get_total_number_of_cooperators($user_id);
                              $data['total_regular'] = $this->unioncoop_model->get_total_regular($user_id,$decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($user_id);
                              // $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data);
                              $f = new pdf();
                              $html2 = $this->load->view('documents/union/treasurer_affidavit_union', $data, TRUE);
                              

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
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
            redirect('cooperatives');
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
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    // $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                          } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                              $data['gad_count'] = $this->committee_model->get_all_gad_count_union($data['coop_info']->users_id);
                          } else {
                              $data['gad_count'] = $this->committee_model->get_all_gad_count($data['coop_info']->users_id);
                          }
                        if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['no_of_cooperator'] = $this->unioncoop_model->get_total_number_of_cooperators($data['coop_info']->users_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->unioncoop_model->get_treasurer_of_coop($data['coop_info']->users_id);
                                $html2 = $this->load->view('documents/union/treasurer_affidavit_union', $data, TRUE);
                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
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
        show_404();
      }
    }
  }
  function affidavit_federation($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
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
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->affiliators_model->get_total_number_of_cooperators($user_id);
                              $data['total_regular'] = $this->affiliators_model->get_total_regular($user_id,$decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($user_id);
                              // $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data);
                              $f = new pdf();
                              $html2 = $this->load->view('documents/federation/treasurer_affidavit_federation', $data, TRUE);
                              

                              // $f->setIsRemoteEnabled(true);
                              // $f->setIsFontSubsettingEnabled(true);
                              $f->set_option('isHtml5ParserEnabled', true);
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->set_option('defaultFont','bookman');
                              $f->load_html($html2);
                              $f->render();
                             $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
                              $f->stream("treasurer_affidavit_federation.pdf", array("Attachment"=>0));
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
            redirect('cooperatives');
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
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete'] || $data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service' || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          // if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['no_of_cooperator'] = $this->affiliators_model->get_total_number_of_cooperators($data['coop_info']->users_id);
                              $data['total_regular'] = $this->affiliators_model->get_total_regular($data['coop_info']->users_id,$decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->affiliators_model->get_treasurer_of_coop($data['coop_info']->users_id);
                                $html2 = $this->load->view('documents/federation/treasurer_affidavit_federation', $data, TRUE);
                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('cooperatives/'.$id);
                            }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                          redirect('cooperatives/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
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
        show_404();
      }
    }
  }
  function economic_survey($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Economic Survey";
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                               $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperators_list_bods'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                              $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_no_of_regular_cptr']=$this->cooperator_model->get_total_count_regular($decoded_id);
                              $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                              //chartered cities
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }
                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Economic Survey';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                $this->load->view('documents/economic_survey', $data); 
                                $this->load->view('template/footer');
                              } else {
                                 // $this->load->view('documents/economic_survey', $data);
                                $f = new pdf();
                                $html2 = $this->load->view('documents/economic_survey', $data, TRUE);
                                // $f->set_option('isHtml5ParserEnabled', true);
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                // $f->set_option('defaultFont','bookman');
                                $f->load_html($html2);
                                $f->render();
                                $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
                                $f->stream("economic_survey.pdf", array("Attachment"=>0));
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                      
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                        }
                      if($data['gad_count']>0){
                            // if($data['coop_info']->created_at >= '2022-03-08'){
                            //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                            // } else {
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            // }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Economic Survey";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperators_list_bods'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                                $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                                 $data['total_no_of_regular_cptr']=$this->cooperator_model->get_total_count_regular($decoded_id);
                                  $data['in_chartered_cities'] =false;
                                  if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                  {
                                  $data['in_chartered_cities']=true;
                                  $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                  }
                                  // var_dump(  $data['in_chartered_cities']);
                                  if($data['coop_info']->status != 12){
                                  $data['title'] = 'Economic Survey';
                                  $data['header'] = 'Economic Survey';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('templates/admin_header', $data);
                                  $this->load->view('documents/economic_survey', $data);
                                  $this->load->view('templates/admin_footer');
                                } else {
                                  $html2 = $this->load->view('documents/economic_survey', $data, TRUE);
                                  $f = new pdf();
                                  $f->set_option("isPhpEnabled", true);
                                  $f->setPaper('folio', 'portrait');
                                  $f->load_html($html2);
                                  $f->render();
                                  $f->stream("economic_survey.pdf", array("Attachment"=>0));
                                }
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

  function simplified_economic_survey($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Economic Survey";
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                               $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                              $data['simplified_survey_info'] = $this->economic_survey_model->get_simplified_economic_survey_by_coop_id($decoded_id);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperators_list_bods'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                              $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_no_of_regular_cptr']=$this->cooperator_model->get_total_count_regular($decoded_id);
                              $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                              //chartered cities
                              $data['in_chartered_cities'] =false;
                              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                              {
                              $data['in_chartered_cities']=true;
                              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                              }

                              $data['audit_committee'] = $this->committee_model->get_all_audit($user_id);
                              $data['bod_committee'] = $this->committee_model->get_all_bod($decoded_id);
                              $data['election_committee'] = $this->committee_model->get_all_election($user_id);
                              $data['secretary_committee'] = $this->committee_model->get_all_secretary($decoded_id);
                              $data['treasurer_committee'] = $this->committee_model->get_all_treasurer($decoded_id);
                              $data['medcon_committee'] = $this->committee_model->get_all_medcon($user_id);
                              $data['education_committee'] = $this->committee_model->get_all_education($user_id);
                              $data['credit_committee'] = $this->committee_model->get_all_credit($user_id);
                              $data['ethics_committee'] = $this->committee_model->get_all_ethics($user_id);
                              $data['gad_committee'] = $this->committee_model->get_all_gad($user_id);
                              $data['other_committee'] = $this->committee_model->get_all_other($user_id);

                              if($data['coop_info']->status != 12){
                                $data['encrypted_id'] = $id;
                                $data['title'] = 'Economic Survey';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $this->load->view('template/header', $data);
                                $this->load->view('documents/simplified_economic_survey', $data); 
                                $this->load->view('template/footer');
                              } else {
                                 // $this->load->view('documents/economic_survey', $data);
                                $f = new pdf();
                                $html2 = $this->load->view('documents/simplified_economic_survey_fortesting', $data, TRUE);
                                // $html2 = $this->load->view('documents/simplified_economic_survey', $data, TRUE);
                                // $f->set_option('isHtml5ParserEnabled', true);
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                // $f->set_option('defaultFont','bookman');
                                $f->load_html($html2);
                                $f->render();
                                $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
                                $f->stream("economic_survey.pdf", array("Attachment"=>0));
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id) || !$this->session->userdata('client')){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$ids);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                      
                    if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                          if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                        }
                      if($data['gad_count']>0){
                            // if($data['coop_info']->created_at >= '2022-03-08'){
                            //   $data['economic_survey_complete'] = $this->economic_survey_model->simplified_check_survey_complete($decoded_id);
                            // } else {
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            // }
                            // $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Economic Survey";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['simplified_survey_info'] = $this->economic_survey_model->get_simplified_economic_survey_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperators_list_bods'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                                $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                                 $data['total_no_of_regular_cptr']=$this->cooperator_model->get_total_count_regular($decoded_id);
                                  $data['in_chartered_cities'] =false;
                                  if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                                  {
                                  $data['in_chartered_cities']=true;
                                  $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                                  }

                                  $data['audit_committee'] = $this->committee_model->get_all_audit($data['coop_info']->users_id);
                                  // echo $this->db->last_query();
                                  $data['bod_committee'] = $this->committee_model->get_all_bod($decoded_id);
                                  $data['election_committee'] = $this->committee_model->get_all_election($data['coop_info']->users_id);
                                  $data['secretary_committee'] = $this->committee_model->get_all_secretary($decoded_id);
                                  $data['treasurer_committee'] = $this->committee_model->get_all_treasurer($decoded_id);
                                  $data['medcon_committee'] = $this->committee_model->get_all_medcon($data['coop_info']->users_id);
                                  $data['education_committee'] = $this->committee_model->get_all_education($data['coop_info']->users_id);
                                  $data['credit_committee'] = $this->committee_model->get_all_credit($data['coop_info']->users_id);
                                  $data['ethics_committee'] = $this->committee_model->get_all_ethics($data['coop_info']->users_id);
                                  $data['gad_committee'] = $this->committee_model->get_all_gad($data['coop_info']->users_id);
                                  $data['other_committee'] = $this->committee_model->get_all_other($data['coop_info']->users_id);

                                  // var_dump(  $data['in_chartered_cities']);
                                  if($data['coop_info']->status != 12){
                                  $data['title'] = 'Economic Survey';
                                  $data['header'] = 'Economic Survey';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['encrypted_id'] = $id;
                                  $this->load->view('templates/admin_header', $data);
                                  $this->load->view('documents/simplified_economic_survey', $data);
                                  $this->load->view('templates/admin_footer');
                                } else {
                                   // $this->load->view('documents/economic_survey', $data);
                                $f = new pdf();
                                $html2 = $this->load->view('documents/simplified_economic_survey_approved', $data, TRUE);
                                // $html2 = $this->load->view('documents/simplified_economic_survey', $data, TRUE);
                                // $f->set_option('isHtml5ParserEnabled', true);
                                $f->set_option("isPhpEnabled", true);
                                $f->setPaper('folio', 'portrait');
                                // $f->set_option('defaultFont','bookman');
                                $f->load_html($html2);
                                $f->render();
                                $pageCount['pageCount']=  $f->get_canvas()->get_page_count();
                                $f->stream("economic_survey.pdf", array("Attachment"=>0));
                                }
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


  function view_document_one($id = null,$filename = null,$doc_type=null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      // echo"<br />".$decoded_id;
      //  echo"<br />".$decoded_filename;
      //   echo"<br />".$doc_type;
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          // if($this->uploaded_document_model->check_document_of_cooperative(0,$decoded_id,1,$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative(0,$decoded_id,$doc_type,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                        $model = 'unioncoop_model';
                        $ids = $user_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                    } else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                            // if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      // ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                  ->set_header('Content-Disposition: inline; filename="'.$decoded_filename.'"') //modify
                                      ->set_content_type('application/pdf','utf-8','CoopRIS')
                                      ->set_output(
                                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                                      );
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                                  redirect('cooperatives/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
                            // }else{
                            //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                            //   redirect('cooperatives/'.$id);
                            // }
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
                redirect('cooperatives');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('cooperatives');
                }else{
                  // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                    $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $model = 'affiliators_model';
                            $ids = $user_id;
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $model = 'unioncoop_model';
                            $ids = $user_id;
                            $data['cooperator_complete'] = $this->$model->is_requirements_complete($decoded_id,$user_id);
                        } else {
                            $model = 'cooperator_model';
                            $ids = $decoded_id;
                        }
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $capitalization_info = $data['capitalization_info'];
                        // $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                        // if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->grouping == 'Federation'){
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                            if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                              if($data['committees_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                  if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents(UPLOAD_DIR.$decoded_filename)
                                        );
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
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                        //   redirect('cooperatives/'.$id);
                        // }
                    }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                      redirect('cooperatives/'.$id);
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
                  //   redirect('cooperatives');
                  // }
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
            redirect('cooperatives/'.$id.'/documents');
          }
        }else{
          // $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          // redirect('cooperatives/'.$id.'/documents');
        }
      }else{
        show_404();
      }
    }
  }
  //end modify
  function view_document_two($id = null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative(0,$decoded_id,2,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                            if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                      ->set_content_type('application/pdf','utf-8')
                                      ->set_output(
                                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                                      );
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                                  redirect('cooperatives/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                                redirect('cooperatives/'.$id);
                              }
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
                redirect('cooperatives');
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
                        $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                        if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                            if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                              if($data['committees_complete'] || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete']){
                                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                  if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents(UPLOAD_DIR.$decoded_filename)
                                        );
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,5,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_DIR.$decoded_filename)
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,6,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_DIR.$decoded_filename)
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,7,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_DIR.$decoded_filename)
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
  
  function view_document_8($id = null,$branch_id=null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,8,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="certificate_of_compliance.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_DIR.$decoded_filename)
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
  
  function view_document_9($id = null,$branch_id=null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($branch_id));

      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists(UPLOAD_DIR.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,9,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="oath_of_undertaking.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents(UPLOAD_DIR.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents(UPLOAD_DIR.$decoded_filename)
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

  //modify 
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
        $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$coopID);
        // echo $this->db->last_query();
        $data['cid'] = encrypt_custom($this->encryption->encrypt($coopID));
        $data['encrypted_id'] = $id;
        $data['uid'] = encrypt_custom($this->encryption->encrypt($user_id));
        $data['document_type'] = $doctype;
        // echo"<pre>";print_r($data['lab_info']); echo"<pre>";
        // echo"<pre>";print_r($data['coop_info']); echo"<pre>";
        $this->load->view('./template/header', $data);
        $this->load->view('laboratories/upload_manual_operation', $data);
        $this->load->view('./template/footer');

    }
  }

  function upload_document_one($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_one', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_two', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
          }
        }
      }else{
        show_404();
      }
    }
  }
  function upload_document_three($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_three', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
          }
        }
      }else{
        show_404();
      }
    }
  }

  function upload_document_unifed_sbao($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_unifed_sbao', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
          }
        }
      }else{
        show_404();
      }
    }
  }

  function upload_document_others_unifed($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                  if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
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
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    }
                    
                    
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union')){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_union($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_others_unifed', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
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
                    if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
                            $complete = 'Affiliators';
                        } else {
                            $complete = 'Cooperators';
                        }
                        $this->session->set_flashdata('redirect_message', 'Please complete first your list of '.$complete.'');
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $coop_id = $this->encryption->decrypt(decrypt_custom($coop_id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete'] || ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union') || $data['coop_info']->grouping == 'Federation'){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete'] || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete'] || $data['coop_info']->category_of_cooperative = 'Secondary' || $data['coop_info']->category_of_cooperative = 'Tertiary'){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop_single($data['coop_info']->type_of_cooperative,$coop_id);
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('cooperative/upload_form/upload_document_others', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                redirect('cooperatives/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                              redirect('cooperatives/'.$id);
                            }
                          }else{
                            $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                            redirect('cooperatives/'.$id);
                          }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
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
            redirect('cooperatives');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('cooperatives/'.$id);
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_5', $data);
                $this->load->view('./template/footer');
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_business_plan.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file5'))){
              $this->session->set_flashdata('document_5_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,5,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_5_success', 'Successfully uploaded.');
                if($this->input->post('status') == 57){
                  redirect('branches/'.$this->input->post('branchID').'/documents_conversion');
                } else {
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_5_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_5_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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
  
  function upload_document_6($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_6', $data);
                $this->load->view('./template/footer');
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_ga_resolution.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file6'))){
              $this->session->set_flashdata('document_6_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,6,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_6_success', 'Successfully uploaded.');
                if($this->input->post('status') == 57){
                  redirect('branches/'.$this->input->post('branchID').'/documents_conversion');
                } else {
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_6_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_6_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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

  function upload_document_7($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_7', $data);
                $this->load->view('./template/footer');
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

  function upload_document_40($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_40', $data);
                $this->load->view('./template/footer');
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

  function upload_document_others_bns($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_others_bns', $data);
                $this->load->view('./template/footer');
          }else{
            echo $decoded_id.'-'.$user_id;
            // $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!!!!.');
            // redirect('branches');
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

  function upload_document_others_lab($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->laboratories_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->laboratories_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_others_lab', $data);
                $this->load->view('./template/footer');
          }else{
            echo $decoded_id.'-'.$user_id;
            // $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            // redirect('branches');
          }
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $this->session->set_flashdata('redirect_message', 'Unauthorized!!.');
            redirect('laboratories/'.$id);
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_certification.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file7'))){
              $this->session->set_flashdata('document_7_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,7,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded.');
                if($this->input->post('status') == 57){
                  redirect('branches/'.$this->input->post('branchID').'/documents_conversion');
                } else {
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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

  function do_upload_40(){
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
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_lra.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file40'))){
              $this->session->set_flashdata('document_40_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,40,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_40_success', 'Successfully uploaded.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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

  function do_upload_others_bns(){
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
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
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
              redirect('branches/'.$this->input->post('branchID').'/documents');
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
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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
          
          $data['coop_info'] = $this->laboratories_model->get_branch_info($decoded_uid,$decoded_id);
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
              redirect('branches/'.$this->input->post('branchID').'/UploadDocuments');
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
                redirect('laboratories/'.$this->input->post('branchID').'/UploadDocuments');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('laboratories/'.$this->input->post('branchID').'/UploadDocuments');
                }else{
                  $this->session->set_flashdata('document_40_error', 'Please reupload document one.');
                  redirect('laboratories/'.$this->input->post('branchID').'/UploadDocuments');
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
  
  function upload_document_8($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_8', $data);
                $this->load->view('./template/footer');
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
  
  function do_upload_8(){
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
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_compliance.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file8'))){
              $this->session->set_flashdata('document_7_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,8,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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
  
  function upload_document_9($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
                $data['encrypted_branch_id'] = $id;
                $data['coop_info'] = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['encrypted_id'] = $id;
                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                $data['uid'] = $user_id;
                $data['coopid'] = $decoded_id;
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/upload_form/upload_document_9', $data);
                $this->load->view('./template/footer');
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
  
  function do_upload_9(){
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
          
          $data['coop_info'] = $this->branches_model->get_branch_info($decoded_uid,$decoded_id);
//          if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_oath_of_undertaking.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file9'))){
              $this->session->set_flashdata('document_7_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
                if($this->input->post('status')==17){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $application_id = $this->input->post('application_id');
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_($decoded_id,$application_id,9,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
                }else{
                  $this->session->set_flashdata('document_7_error', 'Please reupload document one.');
                  redirect('branches/'.$this->input->post('branchID').'/documents');
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
// end modification

  function do_upload_one(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_surety_bond.pdf';
            $config['allowed_types'] = 'pdf';
            $config['max_size']     = '10000';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1'))){
              $this->session->set_flashdata('document_one_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->input->post('status')==11){
                  $status = 2;
              } else {
                  $status = 1;
              }
              if($this->uploaded_document_model->add_document_info(0,$decoded_id,1,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }


//modify jayson
  function do_upload_one_(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
           $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_feasibility_study.pdf';
            } else if ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_development_plan.pdf';
            } else {
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_surety_bond.pdf';
            }
            
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1'))){
              $this->session->set_flashdata('document_one_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,1,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }
//end modify



// ANJURY START
function do_upload_others(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          $coop_title = preg_replace('/\s+/', '_', $this->input->post('coop_title'));
          $coop_id = $this->input->post('document_num');
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_'.$coop_title.'.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,$coop_id,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }
  //ANJURY END  
  
  //modify by json
function do_upload_two_(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            if($data['coop_info']->grouping == 'Federation' || $data['coop_info']->type_of_cooperative == 'Technology Service'){
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_ga_resolution.pdf';
            } else if ($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_ga_resolution.pdf';
            } else {
              $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_pre_registration.pdf';
            }
            
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,2,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }
  //end modify

  function do_upload_three_(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_bod_resolution.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,3,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }

  function do_upload_unifed_sbao_(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_sbao.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,41,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }

  function do_upload_others_unifed(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      if($this->input->post('uploadOtherDocumentTwoBtn')){
        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $this->input->post('file2');
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
                if($this->input->post('status')==11){
                    $status = 2;
                } else {
                    $status = 1;
                }
              if($this->uploaded_document_model->add_document_info_(0,$decoded_id,42,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
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
          redirect('cooperatives');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $config['upload_path'] = UPLOAD_DIR;
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_pre_registration.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file2'))){
              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
            }else{
              if($this->uploaded_document_model->add_document_info(0,$decoded_id,2,$this->upload->data('file_name'))){
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded.');
                redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
              }else{
                $file = $config['upload_path'].$config['file_name'];
                if(is_readable($file) && unlink($file)){
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }else{
                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
                  redirect('cooperatives/'.$this->input->post('cooperativesID').'/documents');
                }
              }
            }
          }else{
            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
            redirect('cooperatives/'.$this->input->post('cooperativesID'));
          }
        }
      }else{
        redirect('cooperatives');
      }
    }
  }
  function bylaws_primary_branch($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
              $data['coop_info'] = $this->branches_model->get_branch_info_bylaws($decoded_id);
              $data['title'] = 'By Laws for Primary';
              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
              $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
              $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 

              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Documents';
              $this->load->view('template/header', $data);
              $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch', $data);
              $this->load->view('template/footer');
              
              // $f = new pdf();
              // $f->setPaper('folio', 'portrait');
              // $f->load_html($html2);
              // $f->render();
              // $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
                $data['title'] = 'By Laws for Primary';
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 

                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                $data['header'] = 'Documents';
                $this->load->view('templates/admin_header', $data);
                $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch', $data);
                $this->load->view('templates/admin_footer');

                // $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch', $data, TRUE);
                // $J = new pdf();       
                // $J->set_option('isRemoteEnabled',TRUE);
                // $J->set_paper([0,0,612,936], "portrait"); //mm to point
                // $J->load_html($html2);
                // $J->render();
                // $J->stream("bylaws_primary.pdf", array("Attachment"=>0));

            }
          }
        }
      }else{
        show_404();
      }
    }
  }

  function bylaws_primary_branch_amend($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
              $data['coop_info'] = $this->branches_model->get_branch_info_bylaws_amend($decoded_id);
              $data['title'] = 'By Laws for Primary';
              $data['last_query'] = $decoded_id;
              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id_amend($decoded_id);
              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id_amend($decoded_id);
              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop_amend($decoded_id);
              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop_amend($decoded_id);
              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_amend($decoded_id);
              $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
              $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 

              // $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch_amend', $data);
              $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch_amend', $data, TRUE);
              $f = new pdf();
              $f->setPaper('folio', 'portrait');
              $f->load_html($html2);
              $f->render();
              $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
                $data['title'] = 'By Laws for Primary';
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id_amend($decoded_id);
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id_amend($decoded_id);
                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop_amend($decoded_id);
                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop_amend($decoded_id);
                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular_amend($decoded_id);
                $data['Agriculture_type'] = $this->committee_model->check_credit_committe_in_agriculture($decoded_id);
                $data['committees_others'] = $this->committee_model->get_all_others_committees_of_coop($decoded_id); 
                $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch_amend', $data, TRUE);
                $J = new pdf();       
                $J->set_option('isRemoteEnabled',TRUE);
                $J->set_paper([0,0,612,936], "portrait"); //mm to point
                $J->load_html($html2);
                $J->render();
                $J->stream("bylaws_primary.pdf", array("Attachment"=>0));

            }
          }
        }
      }else{
        show_404();
      }
    }
  }

  function articles_cooperation_primary_branch($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                  $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                  $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                  $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                  $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                  $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                  $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                  $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                  $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                  $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                  $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                  $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                  $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                  $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                  $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                  $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                  $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                  $data['in_chartered_cities'] =false;

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                  }
                              
                  if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                  {
                  $data['in_chartered_cities']=true;
                  $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                  }
                  $data['title'] = 'Articles of Cooperation for Primary';

                  $data['client_info'] = $this->user_model->get_user_info($user_id);
                  $data['header'] = 'Documents';
                  $this->load->view('template/header', $data);
                  $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch', $data);
                  $this->load->view('template/footer');
                  // $f = new pdf();
                  // $f->set_option("isPhpEnabled", true);
                  // $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch', $data,TRUE);
                 
                  // $f->setPaper('folio', 'portrait');
                  // $f->load_html($html2);
                  // $f->render();
                  
                  // $this->load->library('session');
                  // $path = 'articles_of_cooperation_primary.pdf';
                  // $getTotalPages = $f->get_canvas()->get_page_count();
                  // $user_data = array(
                  //   // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                  //   'pagecount' => $getTotalPages
                  // );

                  // $this->session->set_userdata($user_data);
                  // $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
              $data['title'] = 'Articles of Cooperation for Primary';
              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
              $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
              $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
              $data['in_chartered_cities'] =false;
              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
              {
              $data['in_chartered_cities']=true;
              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
              }
              if($data['coop_info']->area_of_operation == 'Interregional'){
                $data['regions_island_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
              }
              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
              $data['title'] = 'Articles of Cooperation for Primary';

              $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
              $data['header'] = 'Documents';
              $this->load->view('templates/admin_header', $data);
              $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch', $data);
              $this->load->view('templates/admin_footer');
                                
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function articles_cooperation_primary_branch_amend($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch_amend($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete_amend($decoded_id) : true;
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id_amend($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  // $data['purposes_complete'] = $this->purpose_model->check_purpose_complete_amend($decoded_id);
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete_amend($decoded_id) : true;
                  $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                  $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                  $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id_amend($decoded_id);
                  $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id_amend($decoded_id);
                  $purposes=$this->amendment_purpose_model->get_all_purposes($cooperative_id,$decoded_id);
                  $data['purposes_list'] =$purposes;
                  $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                  $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                  $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                  $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                  $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
                  $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                  $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                  $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                  $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                  $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_amend($decoded_id);
                  $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                  $data['in_chartered_cities'] =false;
                  if($this->charter_model->in_charter_city($data['coop_info']->cCode))
                  {
                  $data['in_chartered_cities']=true;
                  $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
                  }
                  $data['commonBond_'] = $this->cooperatives_model->get_common_bond($data['coop_info']);
                  $data['title'] = 'Articles of Cooperation for Primary';

                  // $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch_amend', $data);

                  $f = new pdf();
                  $f->set_option("isPhpEnabled", true);
                  $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch_amend', $data, TRUE);
                 
                  $f->setPaper('folio', 'portrait');
                  $f->load_html($html2);
                  $f->render();
                  
                  $this->load->library('session');
                  $path = 'articles_of_cooperation_primary.pdf';
                  $getTotalPages = $f->get_canvas()->get_page_count();
                  $user_data = array(
                    // 'pagecount' => $canvas->page_text(5, 5, "{PAGE_COUNT}", '', 8, 0)
                    'pagecount' => $getTotalPages
                  );

                  $this->session->set_userdata($user_data);
                  $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
              $data['title'] = 'Articles of Cooperation for Primary';
              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes_amend($decoded_id)->content);
              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
              $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_bods($decoded_id);
              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
              $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_amend($decoded_id);
              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
              $data['in_chartered_cities'] =false;
              if($this->charter_model->in_charter_city($data['coop_info']->cCode))
              {
              $data['in_chartered_cities']=true;
              $data['chartered_cities'] =$this->charter_model->get_charter_city($data['coop_info']->cCode);
              }
              
              $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
              $data['commonBond_'] = $this->amendment_model->get_common_bond($data['coop_info']);

              $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch_amend', $data, TRUE);
              $f = new pdf();
              $f->set_option("isPhpEnabled", true);
              $f->setPaper('folio', 'portrait');
              $f->load_html($html2);
              $f->render();
              $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                                
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
  function affidavit_primary_bs($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
          $data['title'] = "Treasurer's Affidavit for Primary";
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch($user_id,$decoded_id);
          $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
          $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
          $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
          $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
          $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
          $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Documents';
          $this->load->view('template/header', $data);
          $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs', $data);
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                $data['title'] = "Treasurer's Affidavit for Primary";
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);

                $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                $data['header'] = 'Documents';
                $this->load->view('templates/admin_header', $data);
                $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs', $data);
                $this->load->view('templates/admin_footer');
                
                // $f = new pdf();
                // $f->setPaper('folio', 'portrait');
                // $f->load_html($html2);
                // $f->render();
                // $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
            }
          }
        }
      }else{
        show_404();
      }
    }
  }

  function affidavit_primary_bs_amend($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id_amend($decoded_id);
          $data['title'] = "Treasurer's Affidavit for Primary";
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch_amend($user_id,$decoded_id);
          $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id_amend($decoded_id);
          $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
          $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
          $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
          $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
          $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_amend($decoded_id);
          $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs_amend', $data, TRUE);
          $f = new pdf();
          $f->setPaper('folio', 'portrait');
          $f->load_html($html2);
          $f->render();
          $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('cooperatives');
            }else{
              // if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin_branch($decoded_id);
                $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id_amend($decoded_id);
                $data['title'] = "Treasurer's Affidavit for Primary";
                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id_amend($decoded_id);
                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop_amend($decoded_id);
                $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs_amend', $data, TRUE);
                $f = new pdf();
                $f->setPaper('folio', 'portrait');
                $f->load_html($html2);
                $f->render();
                $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
            }
          }
        }
      }else{
        show_404();
      }
    }
  }
   public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
