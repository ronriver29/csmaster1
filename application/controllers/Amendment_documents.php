<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Options;
class Amendment_documents extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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
            if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                                $data['coop_type'] = $this->amendment_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                $data['ching'] = array_column($data['coop_type'], 'id');
                                $data['ching2'] = implode(',',$data['ching']);
                                $data['ching3'] = count($data['coop_type']);
                                if($data['ching3']!=0){
                                    $data['ching4'] = $data['ching'][0];
                                    if($data['ching3'] == 2){
                                        $data['ching5'] = $data['ching'][1];
                                    }
                                }
                                $data['title'] = 'List of Documents';
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['header'] = 'Documents';
                                $data['uid'] = $this->session->userdata('user_id');
                                $data['cid'] = $decoded_id;
                                $data['encrypted_id'] = $id;
                                $data['document_one'] = $this->count_documents($decoded_id,1);
                                if($data['document_one'])
                                {
                                  $data['read_upload'] = $this->count_documents($decoded_id,1);
                                }
                                $data['document_two'] = $this->count_documents($decoded_id,2);
                                if($data['document_two'])
                                {
                                  $data['read_upload'] = $this->count_documents($decoded_id,2);
                                }
                                if($data['ching3'] == 2){
                                    $data['document_others'] = $this->count_documents_others($decoded_id,$data['ching4']);
                                    if($data['document_others'])
                                    {
                                      $data['read_upload'] = $this->count_documents_others($decoded_id,$data['ching4']);
                                    }
                                    $data['document_others2'] = $this->count_documents_others2($decoded_id,$data['ching5']);
                                    if($data['document_others2'])
                                    {
                                      $data['read_upload'] = $this->count_documents_others2($decoded_id,$data['ching5']);
                                    }
                                } else {
                                    if($data['ching3']!=0){
                                        $data['document_others'] = $this->count_documents_others($decoded_id,$data['ching4']);
                                        if($data['document_others'])
                                        {
                                          $data['read_upload'] = $this->count_documents_others($decoded_id,$data['ching4']);
                                        }
                                    }
                                }
                                $this->load->view('template/header', $data);
                                $this->load->view('documents/amendment_list_of_documents', $data);
                                $this->load->view('template/footer');
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
              if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }else{
                if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                                if($data['staff_complete']){
                                  $data['title'] = 'List of Documents';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $data['uid'] = $this->session->userdata('user_id');
                                  $data['cid'] = $decoded_id;
                                  $data['encrypted_id'] = $id;
                                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                                  $data['coop_type'] = $this->amendment_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                $data['ching'] = array_column($data['coop_type'], 'id');
                                $data['ching2'] = implode(',',$data['ching']);
                                $data['ching3'] = count($data['coop_type']);
                                if($data['ching3']!=0){
                                    $data['ching4'] = $data['ching'][0];
                                    if($data['ching3'] == 2){
                                        $data['ching5'] = $data['ching'][1];
                                    }
                                }
                                  $this->load->view('templates/admin_header', $data);
                                  $this->load->view('documents/amendment_list_of_documents', $data);
                                  $this->load->view('amendment/evaluation/approve_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/deny_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/defer_modal_cooperative');
                                  $this->load->view('templates/admin_footer');
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                  redirect('amendment/'.$id);
                                }
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                redirect('amendment/'.$id);
                              }
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          $coop_title = preg_replace('/\s+/', '_', $this->input->post('coop_title'));
          $coop_id = $this->input->post('coop_id');
          
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_'.$coop_title.'.pdf';
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
              if($this->uploaded_document_model->add_document_info_amendment(0,$decoded_id,$coop_id,$this->upload->data('file_name'),$status)){
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
    $count_coop = $this->count_documents2($decoded_id,$doc_type);
    if($count_coop>0){
        $data['uploaded_list_pdf'] = $this->count_documents2($decoded_id,$doc_type);
        $data['uploaded_list_pdf'] = $this->count_documents($decoded_id,$doc_type);
        
    } else {
        $data['uploaded_list_pdf'] = $this->count_documents($decoded_id,$doc_type);
    }
    $data['defered_uploaded_list_pdf'] =$this->defered_count_documents($decoded_id,$doc_type);
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/amendment_list_of_uploaded_pdf',$data);
      $this->load->view('documents/amendment_delete_pdf_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/amendment_list_of_uploaded_pdf',$data);
     $this->load->view('documents/amendment_delete_pdf_modal');
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
  public function count_documents2($coop_id,$num)
  {
//    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
    $query = $this->db->get_where('amendment_uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  public function count_documents($coop_id,$num)
  {
//    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
    $query = $this->db->get_where('uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>1));
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
  public function count_documents_others($coop_id,$num)
  {
    $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('amendment_uploaded_documents');
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
    $query = $this->db->where('document_num = '.$num.' AND cooperatives_id ='.$coop_id.' AND status = 1')->get('amendment_uploaded_documents');
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
    $query = $this->db->get_where('amendment_uploaded_documents',array('cooperatives_id'=>$coop_id, 'document_num'=>$num,'status'=>2));
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
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->branches_model->check_own_branch($decoded_id,$user_id)){
              
                $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
                $data['branch_info'] = $branch_info;
                $data['title'] = 'List of Documents';
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['header'] = 'Documents';
                $data['uid'] = $this->session->userdata('user_id');
                $data['bid'] = $decoded_id;
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
                if($this->branches_model->check_submitted_for_evaluation($decoded_id)) {
                  //
                  $branch_info=$this->branches_model->get_branch_info_by_admin($decoded_id);
                  $data['branch_info'] = $branch_info;
                  $data['title'] = 'List of Documents';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['header'] = 'Documents';
                  $data['uid'] = $this->session->userdata('user_id');
                  $data['bid'] = $decoded_id;
                  $data['cid'] = $decoded_id;
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->amendment_purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['members_composition'] = $this->amendment_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                              $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($decoded_id);
                              $data['regular_cooperator_list'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                              $data['associate_cooperator_list'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              //$this->load->view('documents/primary/articles_of_cooperation_for_primary', $data);
                              $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              
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
            if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                                $data['title'] = 'Articles of Cooperation for Primary';
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['purposes_list'] = explode(";",$this->amendment_purpose_model->get_all_purposes($data['coop_info']->id)->content);
                                $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->amendment_model->get_coop_composition($decoded_id);
                                $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                                $data['no_of_directors'] = $this->amendment_cooperator_model->no_of_directors($decoded_id);
                                $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($decoded_id);
                                $data['regular_cooperator_list'] = $this->amendment_cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                                $data['associate_cooperator_list'] = $this->amendment_cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                                $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                                $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                              $data['title'] = 'By Laws for Primary';
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                              $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                              $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                              $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                              $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                              
                              $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
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
            if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                                $data['title'] = 'By Laws for Primary';
                                $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['regular_ar_qualifications'] = explode(";",$data['bylaw_info']->regular_qualifications);
                                $data['assoc_ar_qualifications'] = explode(";",$data['bylaw_info']->associate_qualifications);
                                $data['members_additional_requirements'] = explode(";",$data['bylaw_info']->additional_requirements_for_membership);
                                $data['members_additional_conditions_to_vote'] = explode(";",$data['bylaw_info']->additional_conditions_to_vote);
                                $data['cooperators_list'] = $this->amendment_cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
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
  function bylaws_federation(){
    $data['title'] = 'By Laws for Federation';
    $options = new Options();
    $options->setDpi(150);
    $f = new pdf($options);
    $f->setPaper('folio', 'portrait');
    $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
    $f->load_html($html2);
    $f->render();
    $f->stream("bylaws_federation.pdf", array("Attachment"=>0));
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
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
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
            if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
              $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              redirect('amendment');
            }else{
              if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                                $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
                              }else{
                                $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                redirect('amendment/'.$id);
                              }
                            }else{
                              $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                              redirect('amendment/'.$id);
                            }
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
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              $data['title'] = "Economic Survey";
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                              $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                              $html2 = $this->load->view('documents/economic_survey', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("economic_survey.pdf", array("Attachment"=>0));
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
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                          if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['title'] = "Economic Survey";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['survey_info'] = $this->economic_survey_model->get_economic_survey_by_coop_id($decoded_id);
                                $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                                $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                                $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                                $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['staff_list'] = $this->staff_model->get_all_staff_of_coop_by_position($decoded_id);
                                $data['others_staff_list'] = $this->staff_model->get_all_staff_of_coop_by_other_position($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['committees_list'] = $this->committee_model->get_all_committee_names_of_coop_multi($decoded_id);
                                $html2 = $this->load->view('documents/economic_survey', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("economic_survey.pdf", array("Attachment"=>0));
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
  function view_document_one($id = null,$filename = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists('uploads/'.$decoded_filename)){
//          if($this->amendment_uploaded_document_model->check_document_of_cooperative(0,$decoded_id,1,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                            if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete']){
                                $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                      ->set_content_type('application/pdf','utf-8','CoopRIS')
                                      ->set_output(
                                        file_get_contents('uploads/'.$decoded_filename)
                                      );
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
                if($this->amendment_model->check_expired_reservation_by_admin($decoded_id)){
                  $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                  redirect('amendment');
                }else{
                  if($this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                    if($data['bylaw_complete']){
                        $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                              if($data['committees_complete']){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete']){
                                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                  if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents('uploads/'.$decoded_filename)
                                        );
                                  }else{
                                    $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                                    redirect('amendment/'.$id);
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                                  redirect('amendment/'.$id);
                                }
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
//          }else{
//            $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
//            redirect('cooperatives/'.$id.'/documents');
//          }
        }else{
          $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
          redirect('cooperatives/'.$id.'/documents');
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if(file_exists('uploads/'.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative(0,$decoded_id,2,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
                if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                  $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                  if($data['bylaw_complete']){
                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete']){
                            $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                            if($data['committees_complete']){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete']){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                                  $this->output
                                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                      ->set_content_type('application/pdf','utf-8')
                                      ->set_output(
                                        file_get_contents('uploads/'.$decoded_filename)
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
                        if($data['cooperator_complete']){
                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                          if($data['purposes_complete']){
                            $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                            if($data['article_complete']){
                              $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                              if($data['committees_complete']){
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                                if($data['economic_survey_complete']){
                                  $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                  if($data['staff_complete']){
                                    $this->output
                                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                                        ->set_content_type('application/pdf','utf-8')
                                        ->set_output(
                                          file_get_contents('uploads/'.$decoded_filename)
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
        if(file_exists('uploads/'.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,5,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents('uploads/'.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents('uploads/'.$decoded_filename)
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
        if(file_exists('uploads/'.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,6,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents('uploads/'.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents('uploads/'.$decoded_filename)
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
        if(file_exists('uploads/'.$decoded_filename)){
          if($this->uploaded_document_model->check_document_of_cooperative($decoded_branch_id,$decoded_id,7,$decoded_filename)){
            if($this->session->userdata('client')){
              if($this->branches_model->check_own_branch($decoded_branch_id,$user_id)){
                
                  // $this->load->view('template_pdf/whole_template_pdf',$data);
                  $this->output
                      ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                      ->set_content_type('application/pdf','utf-8')
                      ->set_output(
                        file_get_contents('uploads/'.$decoded_filename)
                      );
 
                
              }else{
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('branches');
              }
            }else{
              if($this->session->userdata('access_level')==5){
                redirect('admins/login');
              }else{
                
                  if($this->branches_model->check_submitted_for_evaluation($decoded_id)){
                    $this->output
                        ->set_header('Content-Disposition: inline; filename="Pre_Registration.pdf"')
                        ->set_content_type('application/pdf','utf-8')
                        ->set_output(
                          file_get_contents('uploads/'.$decoded_filename)
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if(!$data['bylaw_complete']) {
                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                }
                if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
                  if(!$data['cooperator_complete']) {
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                  }
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if(!$data['purposes_complete']) {
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    }
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if(!$data['article_complete']) {
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      }
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if(!$data['committees_complete']) {
                          $data['committees_complete'] = $this->committee_model->committee_complete_count_amendment($decoded_id);
                        }
                        if($data['committees_complete']){
                            $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                            if(!$data['economic_survey_complete']) {
                                $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            }
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                              if(!$data['staff_complete']) {
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              }
                              if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_one', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
//                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_two', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
          if($this->amendment_model->check_own_cooperative($decoded_id,$user_id)){
            if(!$this->amendment_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              if($data['bylaw_complete']){
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($decoded_id);
//                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($decoded_id);
                        if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($decoded_id);
                            if($data['staff_complete']){
                              if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
                                $data['coop_type'] = $this->amendment_model->get_type_of_coop_single($data['coop_info']->type_of_cooperative,$coop_id);
                                $data['client_info'] = $this->user_model->get_user_info($user_id);
                                $data['title'] = 'Upload Document';
                                $data['header'] = 'Upload Document';
                                $data['coop_info'] = $this->amendment_model->get_cooperative_info($user_id,$decoded_id);
                                $data['encrypted_id'] = $id;
                                $data['encrypted_uid'] = encrypt_custom($this->encryption->encrypt($user_id));
                                $data['uid'] = $user_id;
                                $data['coopid'] = $decoded_id;
                                $this->load->view('./template/header', $data);
                                $this->load->view('amendment/upload_form/upload_document_others', $data);
                                $this->load->view('./template/footer');
                              }else{
                                $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $decoded_id;
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          if(!$this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_business_plan.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file5'))){
              $this->session->set_flashdata('document_5_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$decoded_id,5,$this->upload->data('file_name'))){
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
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $decoded_id;
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          if(!$this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_GA_Resolution.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file6'))){
              $this->session->set_flashdata('document_6_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$decoded_id,6,$this->upload->data('file_name'))){
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
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if(is_numeric($decoded_id) && $decoded_id!=0){
        if($this->session->userdata('client')){
          if($this->branches_model->check_own_branch($decoded_id,$user_id)){
            
              $branch_info = $this->branches_model->get_branch_info($user_id,$decoded_id);
              if(!$this->branches_model->check_submitted_for_evaluation($decoded_id)){
                $data['client_info'] = $this->user_model->get_user_info($user_id);
                $data['title'] = 'Upload Document';
                $data['header'] = 'Upload Document';
               // $data['branch_info'] =$branch_info; 
                $data['encrypted_branch_id'] = $id;
                $data['branch_id'] = $decoded_id;
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_branch_id = $this->encryption->decrypt(decrypt_custom($this->input->post('branchID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));

          if(!$this->branches_model->check_submitted_for_evaluation($decoded_branch_id)){
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_certification.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file7'))){
              $this->session->set_flashdata('document_7_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('branches/'.$this->input->post('branchID').'/documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->uploaded_document_model->add_document_info($decoded_branch_id,$decoded_id,7,$this->upload->data('file_name'))){
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_surety_bond.pdf';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!($this->upload->do_upload('file1'))){
              $this->session->set_flashdata('document_one_error', $this->upload->display_errors('<p>', '</p>'));
              redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
            }else{
              $data = array('upload_data' => $this->upload->data());
              if($this->input->post('status')==11){
                  $status = 2;
              } else {
                  $status = 1;
              }
              if($this->uploaded_document_model->add_document_info_amendment(0,$decoded_id,1,$this->upload->data('file_name'),$status)){
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded document one.');
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

//  function do_upload_two(){
//    if(!$this->session->userdata('logged_in')){
//      redirect('users/login');
//    }else{
//      if($this->input->post('uploadOtherDocumentTwoBtn')){
//        if($this->session->userdata('access_level') && $this->session->userdata('access_level')==5){
//          redirect('admins/login');
//        }else if($this->session->userdata('access_level') && $this->session->userdata('access_level')<5){
//          redirect('amendment');
//        }else{
//          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
//          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
//          
//          if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){  
//            $config['upload_path'] = './uploads/';
//            $config['file_name'] = $decoded_uid.'_'.$decoded_id.'_pre_registration.pdf';
//            $config['allowed_types'] = 'pdf';
//            $config['overwrite'] = true;
//            $this->load->library('upload', $config);
//            $this->upload->initialize($config);
//            if(!($this->upload->do_upload('file2'))){
//              $this->session->set_flashdata('document_two_error', $this->upload->display_errors('<p>', '</p>'));
//              redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
//            }else{
//              if($this->uploaded_document_model->add_document_info(0,$decoded_id,2,$this->upload->data('file_name'))){
//                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
//                redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
//              }else{
//                $file = $config['upload_path'].$config['file_name'];
//                if(is_readable($file) && unlink($file)){
//                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
//                  redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
//                }else{
//                  $this->session->set_flashdata('document_one_error', 'Please reupload document one.');
//                  redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_documents');
//                }
//              }
//            }
//          }else{
//            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
//            redirect('amendment/'.$this->input->post('cooperativesID'));
//          }
//        }
//      }else{
//        redirect('amendment');
//      }
//    }
//  }
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
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));
          $decoded_uid = $this->encryption->decrypt(decrypt_custom($this->input->post('uID')));
          
          $data['coop_info'] = $this->amendment_model->get_cooperative_info($decoded_uid,$decoded_id);
          if(!$this->amendment_model->check_submitted_for_evaluation($decoded_id)){  
            $random_ = random_string('alnum',5);
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_pre_registration.pdf';
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
              if($this->uploaded_document_model->add_document_info_amendment(0,$decoded_id,2,$this->upload->data('file_name'),$status)){
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
  //end modify
}
