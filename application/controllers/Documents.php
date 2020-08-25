<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Options;
class Documents extends CI_Controller{

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
            if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
              if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
                              $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                              if($data['staff_complete']){
                                $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                
                                // echo '<pre>';print_r(  $data['coop_type']);echo'</pre>';
                                $data['ching'] = array_column($data['coop_type'], 'document_num');
                                $data['ching2'] = implode(',',$data['ching']);
                                 $data['ching3'] = count($data['coop_type']);
                                if($data['ching3']!=0){
                                    if(empty($data['ching'][0]))
                                    {
                                      $data['ching'][0]=0;
                                    }
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
                                $this->load->view('documents/list_of_documents', $data);
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
                      if($data['coop_info']->grouping == 'Federation'){
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
                      if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                      if($data['cooperator_complete']){
                        $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                        if($data['purposes_complete']){
                          $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                          if($data['article_complete']){
                            if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                        }
                      if($data['gad_count']>0){
                              $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                              if($data['economic_survey_complete']){
                                $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                                if($data['staff_complete']){
                                    $data['coop_type'] = $this->cooperatives_model->get_type_of_coop($data['coop_info']->type_of_cooperative);
                                    $data['ching'] = array_column($data['coop_type'], 'document_num');
                                    $data['ching2'] = implode(',',$data['ching']);
                                    $data['ching3'] = count($data['coop_type']);
                                    if($data['ching3']!=0){
                                        $data['ching4'] = $data['ching'][0];
                                        if($data['ching3'] == 2){
                                            $data['ching5'] = $data['ching'][1];
                                        }
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
                                  $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);
                                  $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($decoded_id);
                                  $data['cooperatives_comments'] = $this->cooperatives_model->director_comments($decoded_id);
                                  $data['supervising_comment']  = $this->cooperatives_model->admin_supervising_cds_comments($decoded_id);
                                  $data['title'] = 'List of Documents';
                                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                                  $data['header'] = 'Documents';
                                  $data['uid'] = $this->session->userdata('user_id');
                                  $data['cid'] = $decoded_id;
                                  $data['encrypted_id'] = $id;
                                  $data['document_one'] = $this->uploaded_document_model->get_document_one_info($decoded_id);
                                  $data['document_two'] = $this->uploaded_document_model->get_document_two_info($decoded_id);
                                  $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                                  $data['is_active_director'] = $this->admin_model->is_active_director($user_id);
                            
                                  $this->load->view('templates/admin_header', $data);
                                  $this->load->view('documents/list_of_documents', $data);
                                  $this->load->view('cooperative/evaluation/approve_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/deny_modal_cooperative');
                                  $this->load->view('cooperative/evaluation/defer_modal_cooperative');
                                  $this->load->view('templates/admin_footer');
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
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
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
    if($data['is_client'] ==1)
    {
     
      $this->load->view('template/header',$data);
      $this->load->view('documents/list_of_uploaded_pdf_laboratory',$data);
      $this->load->view('documents/delete_pdf_modal');
      $this->load->view('template/footer');
    }
    if($this->session->userdata('access_level')<=5 && $data['is_client']!=1 ){
             
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $data['header'] = 'Uploaded file';
    $data['uid'] = $this->session->userdata('user_id');  
    // print_r($this->session->userdata());
     $this->load->view('templates/admin_header', $data);
     $this->load->view('documents/list_of_uploaded_pdf_laboratory',$data);
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
            $this->session->set_flashdata('delete_error', 'Error file not exist.');
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
  function articles_cooperation_primary($id = null){
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
                              $data['title'] = 'Articles of Cooperation for Primary';
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['purposes_list'] = explode(";",$this->purpose_model->get_all_purposes($data['coop_info']->id)->content);
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperators_list_regular'] = $this->cooperator_model->get_all_cooperator_of_coop_regular($decoded_id);
                              $data['cooperators_list_board'] = $this->cooperator_model->get_all_cooperator_of_coop_board($decoded_id);
                              $data['members_composition'] = $this->cooperatives_model->get_coop_composition($decoded_id);
                              $data['directors_list'] = $this->cooperator_model->get_list_of_directors($decoded_id);
                              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['regular_cooperator_list'] = $this->cooperator_model->get_all_regular_cooperator_of_coop($decoded_id);
                              $data['associate_cooperator_list'] = $this->cooperator_model->get_all_associate_cooperator_of_coop($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              $data['pageCount']="";
                               $f = new pdf();
                              $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                               $data['pageCount'] = $f->get_canvas()->get_page_count();
                              $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              
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
                                $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
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
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                
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
                  
                  $data['branches_comments_cds'] = $this->branches_model->branches_comments_cds($branch_info->id);
                  if($branch_info->status == 23){
                      $evaluator_number = $branch_info->evaluator1;
                  } else {
                      $evaluator_number = $branch_info->evaluator4;
                  }
                  $data['branches_comments_snr'] = $this->branches_model->branches_comments_snr($branch_info->id,$evaluator_number);
                  $data['branches_comments'] = $this->branches_model->branches_comments($branch_info->id,$branch_info->evaluator5);
                  $data['branches_comments_main'] = $this->branches_model->branches_comments_main($branch_info->id,$branch_info->evaluator2);
                                  
                  $data['type']=substr($branch_info->branchName, -7);
                $data['encrypted_id'] = encrypt_custom($this->encryption->encrypt($branch_info->application_id));
                $data['document_one'] = $this->uploaded_document_model->get_document_one_info($branch_info->application_id);
                $data['document_two'] = $this->uploaded_document_model->get_document_two_info($branch_info->application_id);
                $data['document_5'] = $this->uploaded_document_model->get_document_5_info($branch_info->id,$branch_info->application_id);
                $data['document_6'] = $this->uploaded_document_model->get_document_6_info($branch_info->id,$branch_info->application_id);
                $data['document_7'] = $this->uploaded_document_model->get_document_7_info($branch_info->id,$branch_info->application_id);
                $data['document_8'] = $this->uploaded_document_model->get_document_8_info($branch_info->id,$branch_info->application_id);
                $data['document_9'] = $this->uploaded_document_model->get_document_9_info($branch_info->id,$branch_info->application_id);
                
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
                             // $this->load->view('documents/primary/bylaws_for_primary', $data);

                              $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);

                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              // $f->setBasePath(public_path()); // This line resolve
                              $f->render();
                              $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
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
                                $html2 = $this->load->view('documents/primary/bylaws_for_primary', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
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
                  if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                  $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
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
                              $data['cooperators_list'] = $this->cooperator_model->get_all_cooperator_of_coop($decoded_id);
                              $data['cooperator_chairperson'] = $this->cooperator_model->get_chairperson_of_coop($decoded_id);
                              $data['cooperator_vicechairperson'] = $this->cooperator_model->get_vicechairperson_of_coop($decoded_id);
                              $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                              $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                              
                              $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("bylaws_federation.pdf", array("Attachment"=>0));
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
                    if($data['coop_info']->grouping == 'Federation'){
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
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                      $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                            $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                            if($data['economic_survey_complete']){
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
                                $data['cooperator_directors'] = $this->cooperator_model->get_all_board_of_director_only($decoded_id);
                                $data['no_of_directors'] = $this->cooperator_model->no_of_directors($decoded_id);
                                $html2 = $this->load->view('documents/federation/bylaws_for_federation', $data, TRUE);
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
                      if($data['coop_info']->grouping == 'Federation'){
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
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              // $html2 = $this->load->view('documents/primary/test', $data, TRUE);
                              $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary', $data, TRUE);
                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
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
              if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
                $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
                if($data['bylaw_complete']){
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
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
                  if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
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
                               // $this->load->view('documents/economic_survey', $data);
                              $html2 = $this->load->view('documents/economic_survey', $data, TRUE);
                              $f = new pdf();
                                $f->set_option("isPhpEnabled", true);
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
                    if($data['coop_info']->grouping == 'Federation'){
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
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $data['coop_info']->users_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                      $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                    if($data['cooperator_complete']){
                      $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                      if($data['purposes_complete']){
                        $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                        if($data['article_complete']){
                          if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($data['coop_info']->users_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->committee_complete_count($decoded_id);
                        }
                      if($data['gad_count']>0){
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
                      if($data['coop_info']->grouping == 'Federation'){
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
  // function view_document_one($id = null,$filename = null){
  //   if(!$this->session->userdata('logged_in')){
  //     redirect('users/login');
  //   }else{
  //     $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
  //     $decoded_filename =  $this->encryption->decrypt(decrypt_custom($filename));
  //     $user_id = $this->session->userdata('user_id');
  //     $data['is_client'] = $this->session->userdata('client');
  //     if(is_numeric($decoded_id) && $decoded_id!=0){
  //       if(file_exists('uploads/'.$decoded_filename)){
  //         if($this->uploaded_document_model->check_document_of_cooperative(0,$decoded_id,1,$decoded_filename)){
  //           if($this->session->userdata('client')){
  //             if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
  //               if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
  //                 $data['coop_info'] = $this->cooperatives_model->get_cooperative_info($user_id,$decoded_id);
  //                 $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
  //                 if($data['bylaw_complete']){
  //                     $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
  //                     if($data['cooperator_complete']){
  //                       $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
  //                       if($data['purposes_complete']){
  //                         $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
  //                         if($data['article_complete']){
  //                           $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
  //                           if($data['committees_complete']){
  //                             $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
  //                             if($data['economic_survey_complete']){
  //                               $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
  //                               if($data['staff_complete']){
  //                                 // $this->load->view('template_pdf/whole_template_pdf',$data);
  //                                 $this->output
  //                                     ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
  //                                     ->set_content_type('application/pdf','utf-8','CoopRIS')
  //                                     ->set_output(
  //                                       file_get_contents('uploads/'.$decoded_filename)
  //                                     );
  //                               }else{
  //                                 $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
  //                                 redirect('cooperatives/'.$id);
  //                               }
  //                             }else{
  //                               $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
  //                               redirect('cooperatives/'.$id);
  //                             }
  //                           }else{
  //                             $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
  //                             redirect('cooperatives/'.$id);
  //                           }
  //                         }else{
  //                           $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
  //                           redirect('cooperatives/'.$id);
  //                         }
  //                       }else{
  //                         $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
  //                         redirect('cooperatives/'.$id);
  //                       }
  //                     }else{
  //                       $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
  //                       redirect('cooperatives/'.$id);
  //                     }
  //                 }else{
  //                   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
  //                   redirect('cooperatives/'.$id);
  //                 }
  //               }else{
  //                 redirect('cooperatives/'.$id);
  //               }
  //             }else{
  //               $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
  //               redirect('cooperatives');
  //             }
  //           }else{
  //             if($this->session->userdata('access_level')==5){
  //               redirect('admins/login');
  //             }else{
  //               if($this->cooperatives_model->check_expired_reservation_by_admin($decoded_id)){
  //                 $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
  //                 redirect('cooperatives');
  //               }else{
  //                 if($this->cooperatives_model->check_submitted_for_evaluation($decoded_id)){
  //                   $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
  //                   $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
  //                   if($data['bylaw_complete']){
  //                       $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
  //                       if($data['cooperator_complete']){
  //                         $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
  //                         if($data['purposes_complete']){
  //                           $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
  //                           if($data['article_complete']){
  //                             $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
  //                             if($data['committees_complete']){
  //                               $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
  //                               if($data['economic_survey_complete']){
  //                                 $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
  //                                 if($data['staff_complete']){
  //                                   $this->output
  //                                       ->set_header('Content-Disposition: inline; filename="Surety_Bond.pdf"')
  //                                       ->set_content_type('application/pdf','utf-8')
  //                                       ->set_output(
  //                                         file_get_contents('uploads/'.$decoded_filename)
  //                                       );
  //                                 }else{
  //                                   $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
  //                                   redirect('cooperatives/'.$id);
  //                                 }
  //                               }else{
  //                                 $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
  //                                 redirect('cooperatives/'.$id);
  //                               }
  //                             }else{
  //                               $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
  //                               redirect('cooperatives/'.$id);
  //                             }
  //                           }else{
  //                             $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
  //                             redirect('cooperatives/'.$id);
  //                           }
  //                         }else{
  //                           $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
  //                           redirect('cooperatives/'.$id);
  //                         }
  //                       }else{
  //                         $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
  //                         redirect('cooperatives/'.$id);
  //                       }
  //                   }else{
  //                     $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
  //                     redirect('cooperatives/'.$id);
  //                   }
  //                 }else{
  //                   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
  //                   redirect('cooperatives');
  //                 }
  //               }
  //             }
  //           }
  //         }else{
  //           $this->session->set_flashdata('redirect_documents', 'Unauthorized!!.');
  //           redirect('cooperatives/'.$id.'/documents');
  //         }
  //       }else{
  //         $this->session->set_flashdata('redirect_documents', 'Uploaded file not exists.');
  //         redirect('cooperatives/'.$id.'/documents');
  //       }
  //     }else{
  //       show_404();
  //     }
  //   }
  // }


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
                    if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
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
                        if($data['coop_info']->grouping == 'Federation'){
                            $model = 'affiliators_model';
                            $ids = $user_id;
                        } 
                        else {
                            $model = 'cooperator_model';
                            $ids = $decoded_id;
                        }
                        $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                        $capitalization_info = $data['capitalization_info'];
                        $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
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
                  if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
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
                    if($data['coop_info']->grouping == 'Federation'){
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
                  if($data['coop_info']->grouping == 'Federation'){
                        $model = 'affiliators_model';
                        $ids = $user_id;
                    } 
                    else {
                        $model = 'cooperator_model';
                        $ids = $decoded_id;
                    }
                    $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    $capitalization_info = $data['capitalization_info'];
                    $data['cooperator_complete'] = $this->$model->is_requirements_complete($ids,$data['capitalization_info']->associate_members);
                  if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      if($data['article_complete']){
                        if($data['coop_info']->grouping == 'Federation'){
                            $data['gad_count'] = $this->committee_model->get_all_gad_count_federation($user_id);
                        } else {
                            $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
                        }
                      if($data['gad_count']>0){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          if($data['economic_survey_complete']){
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
                    if($data['coop_info']->grouping == 'Federation'){
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
                $this->session->set_flashdata('document_5_success', 'Successfully uploaded business plan.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
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
                $this->session->set_flashdata('document_6_success', 'Successfully uploaded G.A Resolution.');
                redirect('branches/'.$this->input->post('branchID').'/documents');
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
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded certification.');
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
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded compliance.');
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
                $this->session->set_flashdata('document_7_success', 'Successfully uploaded oath of undertaking.');
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
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded document one.');
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
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_surety_bond.pdf';
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
                $this->session->set_flashdata('document_one_success', 'Successfully uploaded document one.');
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
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
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
            $config['file_name'] = $random_.'_'.$decoded_uid.'_'.$decoded_id.'_pre_registration.pdf';
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
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
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
                $this->session->set_flashdata('document_two_success', 'Successfully uploaded document two.');
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
          // if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            // if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->branches_model->get_branch_info_bylaws($decoded_id);
              // $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              // if($data['bylaw_complete']){
              //     $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
              //     if($data['cooperator_complete']){
              //       $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              //       if($data['purposes_complete']){
              //         $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              //         if($data['article_complete']){
              //           $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              //           if($data['committees_complete']){
              //             $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              //             if($data['economic_survey_complete']){
              //               $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              //               if($data['staff_complete']){
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

                              $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
              //               }else{
              //                 $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
              //                 redirect('branches/'.$id);
              //               }
              //             }else{
              //               $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
              //               redirect('branches/'.$id);
              //             }
              //           }else{
              //             $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
              //             redirect('branches/'.$id);
              //           }
              //         }else{
              //           $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
              //           redirect('branches/'.$id);
              //         }
              //       }else{
              //         $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
              //         redirect('branches/'.$id);
              //       }
              //     }else{
              //       $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
              //       redirect('branches/'.$id);
              //     }
              // }else{
              //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
              //   redirect('branches/'.$id);
              // }
            // }else{
            //   redirect('branches/'.$id);
            // }
          // }else{
          //   // $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          //   // redirect('cooperatives');
          // }
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
              //   $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              //   if($data['bylaw_complete']){
              //       $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
              //       if($data['cooperator_complete']){
              //         $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              //         if($data['purposes_complete']){
              //           $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              //           if($data['article_complete']){
              //             $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              //             if($data['committees_complete']){
              //               $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              //               if($data['economic_survey_complete']){
              //                 $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              //                 if($data['staff_complete']){
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

                                $html2 = $this->load->view('documents/primary/bylaws_for_primary_branch', $data, TRUE);
                                $J = new pdf();       
                                $J->set_option('isRemoteEnabled',TRUE);
                                $J->set_paper([0,0,612,936], "portrait"); //mm to point
                                $J->load_html($html2);
                                $J->render();
                                $J->stream("bylaws_primary.pdf", array("Attachment"=>0));

                                // $f = new pdf();
                                // $f->setPaper('folio', 'portrait');
                                // $f->load_html($html2);
                                // $f->render();
                                // $f->stream("bylaws_primary.pdf", array("Attachment"=>0));
                //               }else{
                //                 $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
                //                 redirect('cooperatives/'.$id);
                //               }
                //             }else{
                //               $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
                //               redirect('cooperatives/'.$id);
                //             }
                //           }else{
                //             $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
                //             redirect('cooperatives/'.$id);
                //           }
                //         }else{
                //           $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
                //           redirect('cooperatives/'.$id);
                //         }
                //       }else{
                //         $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                //         redirect('cooperatives/'.$id);
                //       }
                //     }else{
                //       $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
                //       redirect('cooperatives/'.$id);
                //     }
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                //   redirect('cooperatives/'.$id);
                // }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
              //   redirect('cooperatives');
              // }
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
          // if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
            // if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch($user_id,$decoded_id);
              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              // if($data['bylaw_complete']){
                  $data['capitalization_info'] = $this->capitalization_model->get_capitalization_by_coop_id($decoded_id);
                  $capitalization_info = $data['capitalization_info'];
                  $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id,$data['capitalization_info']->associate_members);
                  // if($data['cooperator_complete']){
                    $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
                    // if($data['purposes_complete']){
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
                      // if($data['article_complete']){
                        $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
                        // if($data['committees_complete']){
                          $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
                          // if($data['economic_survey_complete']){
                            $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
                            // if($data['staff_complete']){
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
                              //$this->load->view('documents/primary/articles_of_cooperation_for_primary', $data);
                              $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch', $data, TRUE);
                              $f = new pdf();
                              $f->set_option("isPhpEnabled", true);
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                              
                            // }else{
                            //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
                            //   redirect('cooperatives/'.$id);
                            // }
                          // }else{
                          //   $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
                          //   redirect('cooperatives/'.$id);
                          // }
                        // }else{
                        //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                        //   redirect('cooperatives/'.$id);
                        // }
                      // }else{
                      //   $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
                      //   redirect('cooperatives/'.$id);
                      // }
                    // }else{
                    //   $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
                    //   redirect('cooperatives/'.$id);
                    // }
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
                  //   redirect('cooperatives/'.$id);
                  // }
              // }else{
              //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
              //   redirect('cooperatives/'.$id);
              // }
            // }else{
            //   redirect('cooperatives/'.$id);
            // }
          // }else{
          //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          //   redirect('cooperatives');
          // }
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
              //   $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              //   if($data['bylaw_complete']){
              //       $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
              //       if($data['cooperator_complete']){
              //         $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              //         if($data['purposes_complete']){
              //           $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              //           if($data['article_complete']){
              //             $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              //             if($data['committees_complete']){
              //               $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              //               if($data['economic_survey_complete']){
              //                 $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              //                 if($data['staff_complete']){
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
                                $html2 = $this->load->view('documents/primary/articles_of_cooperation_for_primary_branch', $data, TRUE);
                                $J = new pdf();       
                                $J->set_option('isRemoteEnabled',TRUE);
                                $J->set_paper([0,0,612,936], "portrait"); //mm to point
                                $J->load_html($html2);
                                $J->render();
                                $J->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
                                
                                // $f = new pdf();
                                // $f->setPaper('folio', 'portrait');
                                // $f->load_html($html2);
                                // $f->render();
                                // $f->stream("articles_of_cooperation_primary.pdf", array("Attachment"=>0));
              //                 }else{
              //                   $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
              //                   redirect('cooperatives/'.$id);
              //                 }
              //               }else{
              //                 $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
              //                 redirect('cooperatives/'.$id);
              //               }
              //             }else{
              //               $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
              //               redirect('cooperatives/'.$id);
              //             }
              //           }else{
              //             $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
              //             redirect('cooperatives/'.$id);
              //           }
              //         }else{
              //           $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
              //           redirect('cooperatives/'.$id);
              //         }
              //       }else{
              //         $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
              //         redirect('cooperatives/'.$id);
              //       }
              //   }else{
              //     $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
              //     redirect('cooperatives/'.$id);
              //   }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
              //   redirect('cooperatives');
              // }
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
          // if($this->cooperatives_model->check_own_cooperative($decoded_id,$user_id)){
          //   if(!$this->cooperatives_model->check_expired_reservation($decoded_id,$user_id)){
              // $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch($user_id,$decoded_id);
          //     $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
          //     if($data['bylaw_complete']){
          //         $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
          //         if($data['cooperator_complete']){
          //           $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
          //           if($data['purposes_complete']){
          //             $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
          //             if($data['article_complete']){
          //               $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
          //               if($data['committees_complete']){
          //                 $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
          //                 if($data['economic_survey_complete']){
          //                   $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
          //                   if($data['staff_complete']){
                              $data['title'] = "Treasurer's Affidavit for Primary";
                              $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_branch($user_id,$decoded_id);
                              $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                              $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                              $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                              $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                              $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                              $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                              $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs', $data, TRUE);
                              $f = new pdf();
                              $f->setPaper('folio', 'portrait');
                              $f->load_html($html2);
                              $f->render();
                              $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
          //                   }else{
          //                     $this->session->set_flashdata('redirect_message', 'Please complete first your list of staff.');
          //                     redirect('cooperatives/'.$id);
          //                   }
          //                 }else{
          //                   $this->session->set_flashdata('redirect_message', 'Please complete first your economic survey additional information.');
          //                   redirect('cooperatives/'.$id);
          //                 }
          //               }else{
          //                 $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
          //                 redirect('cooperatives/'.$id);
          //               }
          //             }else{
          //               $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
          //               redirect('cooperatives/'.$id);
          //             }
          //           }else{
          //             $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');
          //             redirect('cooperatives/'.$id);
          //           }
          //         }else{
          //           $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');
          //           redirect('cooperatives/'.$id);
          //         }
          //     }else{
          //       $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
          //       redirect('cooperatives/'.$id);
          //     }
          //   }else{
          //     redirect('cooperatives/'.$id);
          //   }
          // }else{
          //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
          //   redirect('cooperatives');
          // }
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
              //   $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($decoded_id) : true;
              //   if($data['bylaw_complete']){
              //       $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($decoded_id);
              //       if($data['cooperator_complete']){
              //         $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($decoded_id);
              //         if($data['purposes_complete']){
              //           $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->article_of_cooperation_model->check_article_primary_complete($decoded_id) : true;
              //           if($data['article_complete']){
              //             $data['committees_complete'] = $this->committee_model->committee_complete_count($decoded_id);
              //             if($data['committees_complete']){
              //               $data['economic_survey_complete'] = $this->economic_survey_model->check_survey_complete($decoded_id);
              //               if($data['economic_survey_complete']){
              //                 $data['staff_complete'] = $this->staff_model->requirements_complete($decoded_id);
              //                 if($data['staff_complete']){
                                $data['title'] = "Treasurer's Affidavit for Primary";
                                $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($decoded_id);
                                $data['article_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($decoded_id);
                                $data['no_of_cooperator'] = $this->cooperator_model->get_total_number_of_cooperators($decoded_id);
                                $data['total_regular'] = $this->cooperator_model->get_total_regular($decoded_id);
                                $data['total_associate'] = $this->cooperator_model->get_total_associate($decoded_id);
                                $data['treasurer_of_coop'] = $this->cooperator_model->get_treasurer_of_coop($decoded_id);
                                $html2 = $this->load->view('documents/primary/treasurer_affidavit_primary_bs', $data, TRUE);
                                $f = new pdf();
                                $f->setPaper('folio', 'portrait');
                                $f->load_html($html2);
                                $f->render();
                                $f->stream("treasurer_affidavit_primary.pdf", array("Attachment"=>0));
              //                 }else{
              //                   $this->session->set_flashdata('redirect_message', 'Please complete first the list of staff.');
              //                   redirect('cooperatives/'.$id);
              //                 }
              //               }else{
              //                 $this->session->set_flashdata('redirect_message', 'Please complete first the economic survey additional information.');
              //                 redirect('cooperatives/'.$id);
              //               }
              //             }else{
              //               $this->session->set_flashdata('redirect_message', 'Please complete first the list of committee.');
              //               redirect('cooperatives/'.$id);
              //             }
              //           }else{
              //             $this->session->set_flashdata('redirect_message', 'Please complete first the article of cooperation additional information.');
              //             redirect('cooperatives/'.$id);
              //           }
              //         }else{
              //           $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
              //           redirect('cooperatives/'.$id);
              //         }
              //       }else{
              //         $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');
              //         redirect('cooperatives/'.$id);
              //       }
              //   }else{
              //     $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
              //     redirect('cooperatives/'.$id);
              //   }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');
              //   redirect('cooperatives');
              // }
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
