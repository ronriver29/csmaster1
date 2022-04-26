<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Registered_cooperatives extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->library('pdf');
      $this->load->library("pagination");
      //Codeigniter : Write Less Do More
    }

    public function saveor($was){
      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('dateofOR'),
        'status' =>1
      );
        $date_of_or = $this->input->post('dateofOR');

      $this->cooperatives_model->save_OR(array('id' => $this->input->post('payment_id')), $data, $this->input->post('tae'),$date_of_or);
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
    }

    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of Cooperatives';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Cooperatives';
          // print_r($data['client_info']);
          // echo $data['client_info']->regno;
          if($data['client_info']->regno == NULL){
            $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
            $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
          } else {
            $data['list_cooperatives'] = $this->cooperatives_model->get_registeredcoop($data['client_info']->regno);
            $data['coop_info'] = $this->cooperatives_model->get_cooperative_migrated_info($data['client_info']->regno);
          }
          
//          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
          $data['count_cooperatives'] = $this->cooperatives_model->get_count_cooperatives($this->session->userdata('user_id'));
          // $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
  
          // if(!empty($data['coop_info']->id)){
          //     if($data['coop_info']->status != 15){
          //       if(date('Y-m-d H:i:s',strtotime($data['coop_info']->expire_at)) < date('Y-m-d H:i:s')){
          //         // echo '<script>alert("Your Reserved Cooperative Name has Expired. Reserved Name now will be deleted.");</script>';
          //         $success = $this->cooperatives_model->delete_cooperative($data['coop_info']->id,$data['coop_info']->status,$user_id);
          //         if($success){
          //           $this->session->set_flashdata('list_success_message', 'Reserved Cooperative Name has Expired.');
          //           redirect('cooperatives');
          //         }
          //       }
          //     }
          // }
          //Notification if cooperative need to update
          if(isset($data['coop_info']->id)){
            $data['is_update_cooperative'] = $this->cooperatives_update_model->check_date_registered($data['coop_info']->id);
          }
          
          if(isset($_POST['tos']))
          {
            $data['tos'] = $_POST['tos'];
          }
          $this->load->view('template/header', $data);
          if($data['client_info']->regno == NULL){
            $this->load->view('applications/list_of_applications', $data);
          } else {
            $this->load->view('applications/list_of_registeredcoop', $data);
          }
          $this->load->view('cooperative/delete_modal_cooperative');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of Cooperatives';
            $data['header'] = 'Registered Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            
            $config["base_url"] = base_url() . "registered_cooperatives";
            $config["total_rows"] = $this->cooperatives_model->get_all_cooperatives_registration_count($data['admin_info']->region_code);
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            if(isset($_GET['per_page'])){
              $per_page = $_GET['per_page'];
            } else {
              $per_page = 0;
            }

            $this->benchmark->mark('code_start');
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="00"){
              // Registered Coop Process by Head Office
                $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
              // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration2($data['admin_info']->region_code, $config["per_page"], $per_page);
                // $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code);
                $data['list_cooperatives_defer_deny'] = $this->cooperatives_model->get_all_cooperatives_by_ho_senior_defer_deny($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration2($data['admin_info']->region_code, $config["per_page"], $per_page);
                // $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
                $data['list_cooperatives_defer_deny'] = $this->cooperatives_model->get_all_cooperatives_by_senior_defer_deny($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              }
              // echo '<pre>';
              // echo count($data['list_cooperatives']);
              // echo $data['list_cooperatives'][0]['status'];
              // print_r($data['list_cooperatives']);
              // echo '</pre>';
            }else{
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_director($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_inspector($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration2($data['admin_info']->region_code, $config["per_page"], $per_page);
                // $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_inspector($data['admin_info']->region_code);
              }
            }

            $this->benchmark->mark('code_end');
            $data["links"] = $this->pagination->create_links();
            $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memeory useage'=>$this->benchmark->memory_usage()); 

            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_applications_rc', $data);
            $this->load->view('applications/assign_admin_modal_inspector');
            $this->load->view('applications/assign_admin_modal');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }
        }
      }
    }
  }

?>