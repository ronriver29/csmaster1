<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class cooperative_tool extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
  }

  function index($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if($this->session->userdata('client')){
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');    
      }else{
        if($this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else{
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['title'] = 'Evaluation Tool for Cooperative Applicant';
          $data['header'] = 'Cooperative';
          $data['encrypted_id'] = $id;
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_info_by_admin($decoded_id);
          
          $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($decoded_id);
          
          if(!empty($data['coop_info']->tool_yn_answer))
            $data['ans']=$data['coop_info']->tool_yn_answer;
          else
            $data['ans']=null;
          if(!empty($data['coop_info']->tool_remark))
            $data['rem']=explode('~^~',$data['coop_info']->tool_remark);
          else
            $data['rem']=null;
          if(!empty($data['coop_info']->tool_comment))
            $data['comments']=$data['coop_info']->tool_comment;
          else
            $data['comments']=null;
          if(!empty($data['coop_info']->tool_findings))
            $data['findings']=$data['coop_info']->tool_findings;
          else
            $data['findings']=null;

          $this->load->view('./templates/admin_header', $data);
          if($data['coop_info']->grouping == 'Federation'){
            $this->load->view('cooperative/evaluation/coop_tool_federation', $data);
          } else if($data['coop_info']->grouping == 'Union' && $data['coop_info']->type_of_cooperative == 'Union'){
            $this->load->view('cooperative/evaluation/coop_tool_union', $data);
          } else {
            $this->load->view('cooperative/evaluation/coop_tool', $data);
          }
          
          $this->load->view('./template/footer', $data);
        }
      }
    }                          
  }

  public function save($id = null){
    if(!$this->session->userdata('logged_in')){
        redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if($this->session->userdata('client')){
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');    
      }else{
        if($this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
          if ($this->input->post('coopBtn')){
            $remark='';
            $yn='';
            foreach ($this->input->post('ans') as $itm) {
             
              $yn=$yn.$itm;
            }
            foreach ($this->input->post('sagot') as $itm) {
              $remark=$remark.$itm.'~^~';
            }

            $remark=substr_replace($remark, "", -1);
            $remark=substr_replace($remark, "", -1);
            $remark=substr_replace($remark, "", -1);

            // echo "<pre>";print_r($yn);echo"</pre>";
            $data1 = array(
              'tool_yn_answer' => $yn,
              'tool_remark' => $remark,
              'tool_findings' => $this->input->post('findings'),
              'tool_comment' => $this->input->post('comments'),
            );   
            
            $data1 = $this->security->xss_clean($data1);

            if($this->coop_tool_model->edit_data($data1,$decoded_id)){
              redirect('cooperatives/'.$this->input->post('id'));    
            }else{
              echo 'server error';
            }
            
          }  
        }
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
      if($this->session->userdata('client')){
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');    
      }else{
        if($this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else{
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['title'] = 'Evaluation Tool for Cooperative Applicant';
          $data['header'] = 'Cooperative';
          $data['encrypted_id'] = $id;
          $data['branch_info'] = $this->branches_model->get_branch_info_by_admin($decoded_id);

          if(!empty($data['branch_info']->tool_yn_answer))
            $data['ans']=$data['branch_info']->tool_yn_answer;
          else
            $data['ans']=null;
          if(!empty($data['branch_info']->tool_remark))
            $data['rem']=explode('~^~',$data['branch_info']->tool_remark);
          else
            $data['rem']=null;
          if(!empty($data['branch_info']->tool_comment))
            $data['comments']=$data['branch_info']->tool_comment;
          else
            $data['comments']=null;
          if(!empty($data['branch_info']->tool_findings))
            $data['findings']=$data['branch_info']->tool_findings;
          else
            $data['findings']=null;
          $this->load->view('./templates/admin_header', $data);
          $this->load->view('cooperative/evaluation/branch_tool', $data);
          $this->load->view('./template/footer', $data);
        }
      }
    }                          
  }

  public function save_branch($id = null){
    if(!$this->session->userdata('logged_in')){
        redirect('users/login');
    }else{
      $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
      $data['is_client'] = $this->session->userdata('client');
      if($this->session->userdata('client')){
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('cooperatives');    
      }else{
        if($this->session->userdata('access_level')==5){
          redirect('admins/login');
        }else{
          $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
          if ($this->input->post('branchBtn')){
            $remark='';
            $yn='';
            foreach ($this->input->post('ans') as $itm) {
              $yn=$yn.$itm;
            }
            foreach ($this->input->post('sagot') as $itm) {
              $remark=$remark.$itm.'~^~';
            }
            $remark=substr_replace($remark, "", -1);
            $remark=substr_replace($remark, "", -1);
            $remark=substr_replace($remark, "", -1);

            $data1 = array(
              'tool_yn_answer' => $yn,
              'tool_remark' => $remark,
              'tool_findings' => $this->input->post('findings'),
              'tool_comment' => $this->input->post('comments'),
            );   
            
            $data1 = $this->security->xss_clean($data1);

            if($this->coop_tool_model->edit_branch($data1,$decoded_id)){
              redirect('branches/'.$this->input->post('id').'/documents');    
            }else{
              echo 'server error';
            }
            
          }  
        }
      }
    }                             
  }
}
