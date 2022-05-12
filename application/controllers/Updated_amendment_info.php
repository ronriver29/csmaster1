<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Updated_amendment_info extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
       $this->load->library('pagination');
    }

    public $coopName='';
    public $regNo='';
    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
       
          $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
            $data['title'] = 'Updated Amendment Information';
            $data['header'] = 'Updated Amendment Information';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
 
                $this->benchmark->mark('code_start');
                  
                 if(isset($_POST['btn-filter']))
                 {
                  $this->coopName = $this->input->post('coopName');
                  $this->regNo=$this->input->post('regNo');
                 }
                  $array =array(
                  'url'=>base_url()."updated_amendment_info",
                  'total_rows'=>$this->amendment_update_model->get_all_submitted_coop_count($data['admin_info']->region_code,$this->coopName,$this->regNo),
                  'per_page'=>$config['per_page']=5,
                  'url_segment'=>2
                  );
                  
                 $data['links']=$this->paginate($array);
                 $data['list_cooperatives']=$this->amendment_update_model->get_all_updated_coop_info($data['admin_info']->region_code,$config['per_page'],$page,$this->coopName,$this->regNo); 
                $this->benchmark->mark('code_end');
              // }
            $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage());
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_updated_amendment_info', $data);
            $this->load->view('applications/assign_admin_modal');
            $this->load->view('templates/admin_footer');
           }
      }

  public function registered_updated()
  {
    $data['title'] = 'Registered Updated Amendment Information';
    $data['header'] = 'Registered Updated Amendment Information';
    $user_id = $this->session->userdata('user_id');
    $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    if(isset($_POST['btn-filter']))
    {
    $this->coopName = $this->input->post('coopName');
    $this->regNo=$this->input->post('regNo');
    }
    $array =array(
    'url'=>base_url()."registered_updated",
    'total_rows'=>$this->amendment_update_model->get_all_registered_amendment_count($data['admin_info']->region_code,$this->coopName,$this->regNo),
    'per_page'=>$config['per_page']=5,
    'url_segment'=>2
    );
    $data['links']=$this->paginate($array);
    $data['list_cooperatives_registered'] = $this->amendment_update_model->get_all_registered_amendment($data['admin_info']->region_code,$config['per_page'],$page,$this->coopName,$this->regNo); 

    // echo $this->db->last_query();
    $this->load->view('templates/admin_header', $data);
    $this->load->view('applications/list_updated_registered_amendment', $data);
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
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
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

    public function debug($array)
    {
      echo"<pre>";
      print_r($array);
      echo"</pre>";
    }
  }
?>