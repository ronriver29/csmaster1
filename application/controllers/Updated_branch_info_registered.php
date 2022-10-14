<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Updated_branch_info_registered extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->library('pagination');
      $this->load->model('admin_model');
      $this->load->model('region_model');
      $this->load->model('branch_update_model');
      $this->load->model('cooperatives_update_model');

      //Codeigniter : Write Less Do More
    }
    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        
            $data['title'] = 'Updated Branch/Satellite Information';
            $data['header'] = 'Updated Branch/Satellite Information';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            
            $this->benchmark->mark('code_start');
              if($data['admin_info']->region_code=="00"){
                $data['list_branches'] = '';

                if($this->input->post('submit')) {
                  $coopname = $this->input->post('coopname');
                  $limit = $this->input->post('limit');

                  $array =array(
                  'url'=>base_url()."updated_branch_info_registered",
                  'total_rows'=>$this->branch_update_model->get_all_updated_branch_info_count_registered($data['admin_info']->region_code,$coopname),
                  'per_page'=>$config['per_page']=4,
                  'url_segment'=>2
                  );
                  if(isset($_GET['per_page'])){
                    $per_page = $_GET['per_page'];
                  } else {
                    $per_page = 0;
                  }
                  $data['links']=$this->paginate($array);

                  $type_arr = array();
                  $this->db->where(array('active'=>1));
                  $this->db->from('head_office_coop_type_branch');
                  $query_type = $this->db->get();
                  $data_type = $query_type->result_array();
                  foreach($data_type as $typearr){
                    $type_arr[] = $typearr['name'];
                  }

                  $typearray = implode('","',$type_arr);
                  $data['list_branches'] = $this->branch_update_model->get_all_updated_Branch_info2_registered_ho($data['admin_info']->region_code,$coopname,$limit,$per_page,$typearray);
                  // echo $this->db->last_query();
                }
                // $data['list_cooperatives_defer_deny'] = $this->cooperatives_update_model->get_all_cooperatives_by_senior_defer_deny($data['admin_info']->region_code);
              } else {
                $data['list_branches'] = '';

                if($this->input->post('submit')) {
                  $coopname = $this->input->post('coopname');
                  $limit = $this->input->post('limit');

                  $array =array(
                  'url'=>base_url()."updated_branch_info_registered",
                  'total_rows'=>$this->branch_update_model->get_all_updated_branch_info_count_registered($data['admin_info']->region_code,$coopname),
                  'per_page'=>$config['per_page']=4,
                  'url_segment'=>2
                  );
                  if(isset($_GET['per_page'])){
                    $per_page = $_GET['per_page'];
                  } else {
                    $per_page = 0;
                  }
                  $data['links']=$this->paginate($array);
                  $data['list_branches'] = $this->branch_update_model->get_all_updated_Branch_info2_registered($data['admin_info']->region_code,$coopname,$limit,$per_page);
                  // echo $this->db->last_query();
                }
              }
            $this->benchmark->mark('code_end');
            $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage()); 
      }
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_registered_branch_info', $data);
            $this->load->view('admin/edit_bns_cert', $data);
            $this->load->view('applications/assign_admin_modal');
            $this->load->view('templates/admin_footer');
          
      }

    public function view($id = null){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
            
        $data['title'] = 'Account Approval Detail';
        $data['header'] = 'Account Information';
        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
        $data['account_info'] = $this->cooperatives_model->get_account_info_by_senior($decoded_id);
        $data['id'] = $decoded_id;

        // $this->load->helper('download');
        // $data = file_get_contents('./uploads/21052-20210312104031855288622.pdf');
        // force_download('file.pdf', $data);

        $this->load->view('./templates/admin_header', $data);
        $this->load->view('cooperative/account_approval_detail', $data);
        $this->load->view('./templates/admin_footer');
      }
    }

  public function edit_bns_cert(){
    if(!$this->session->userdata('logged_in')){
      redirect('admins/login');
    }else{
      if(!$this->session->userdata('client')){
          if($this->input->post('editBnsBtn')){
            $decoded_aid = $this->encryption->decrypt(decrypt_custom($this->input->post('adminID')));
            $regNo = $this->input->post('regno');
            $data = array(
                    'certNo' => $this->input->post('bns_cert'),
                    'dateRegistered' => date('Y-m-d',strtotime($this->input->post('date_registered')))
            );
              if($this->branch_update_model->edit_bns_cert($decoded_aid,$data,$regNo)){
                // echo $this->db->last_query();
                $this->session->set_flashdata('list_success_message', 'Certificate Successfully Edited');
                redirect('updated_branch_info_registered');
              }else{
                $this->session->set_flashdata('delete_admin_error', 'Unable to delete user.');
                redirect('updated_branch_info_registered');
              }
          }else{
            $this->session->set_flashdata('redirect_admin_applications_message', 'Unauthorized!!.');
            redirect('updated_branch_info_registered');
          }
      }else{
        $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        redirect('updated_branch_info_registered');
      }
    }
  }

    public function download($id = null){

        $this->load->helper('download');
        $data = file_get_contents(UPLOAD_DIR.'/'.$id);
        force_download('file.pdf', $data);
      
    }

    public function approve($id = null,$email){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $email = $this->encryption->decrypt(decrypt_custom($email));

        $temp_passwd = random_string('alnum',8);
        $data = array(
          'is_verified' => 1,
          'is_taken' => 1,
          'password'=> password_hash($temp_passwd, PASSWORD_BCRYPT)
        );

        $getRegCoop = $this->db->get_where('users',array('id'=>$decoded_id));
          if($getRegCoop->num_rows() != 0){
            foreach($getRegCoop->result_array() as $reg){
              $regCode = $reg['addrCode'];
              $regNo = $reg['regno'];
            }
          }

        $data_registeredcoop = array(
          'addrCode' => $regCode
        );

        $from = "ecoopris@cda.gov.ph";    //senders email address
        $subject = 'Cooperative Account Application';  //email subject
        $burl = base_url();
           
        $message = "Good Day! Your Account has been Approved!<br><br>Your Password is: ".$temp_passwd." You may now Login.";
       
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        

        $this->db->where(array('id'=>$decoded_id));
        $this->db->update('users',$data);
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to approve. Please Contact Administrator.'));
          redirect('account_approval');
        }else{
          $this->db->where(array('regNo'=>$regNo));
          $this->db->update('registeredcoop',$data_registeredcoop);
          if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to approve. Please Contact Administrator.'));
            redirect('account_approval');
          } else {
            $this->db->trans_commit();
            $this->session->set_flashdata(array('email_sent_success'=>'Account has been approved.'));
            redirect('account_approval');
          }
        }
    }

    public function deny($id = null,$email){

        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $email = $this->encryption->decrypt(decrypt_custom($email));

        $data = array(
          'is_verified' => 2,
          'is_taken' => 2
        );

        $from = "ecoopris@cda.gov.ph";    //senders email address
        $subject = 'Cooperative Account Application';  //email subject
        $burl = base_url();
           
        $message = "Your Account has been Denied";
       
        $this->email->from($from,'ecoopris CDA (No Reply)');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        $this->db->where(array('id'=>$decoded_id));
        $this->db->delete('users');
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          $this->session->set_flashdata(array('email_sent_warning'=>'Account failed to deny. Please Contact Administrator.'));
          redirect('account_approval');
        }else{
          $this->db->trans_commit();
          $this->session->set_flashdata(array('email_sent_success'=>'Account has been denied.'));
          redirect('account_approval');
        }
      
    }

    public function paginate($array)
    {
      // $result =null;
        $config["base_url"] = $array['url'];
        $config["total_rows"] =$array['total_rows'];
        $config["per_page"] = $array['per_page'];
        $config["uri_segment"] = $array['url_segment'];
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">asfasd<span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        
       
       
        $links = $this->pagination->create_links();
        return $links;
    }
  }
?>