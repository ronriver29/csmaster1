<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cooperatives_list extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
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
          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
//          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives($this->session->userdata('user_id'));
          $data['count_cooperatives'] = $this->cooperatives_model->get_count_cooperatives($this->session->userdata('user_id'));
          $data['coop_info'] = $this->cooperatives_model->get_cooperative_expiration($this->session->userdata('user_id'));
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
          if(isset($_POST['tos']))
          {
            $data['tos'] = $_POST['tos'];
          }
          $this->load->view('template/header', $data);
          $this->load->view('applications/list_of_all_cooperatives', $data);
          $this->load->view('cooperative/delete_modal_cooperative');
          $this->load->view('template/footer');
        }else{
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            $data['title'] = 'List of All Cooperatives';
            $data['header'] = 'All Cooperatives';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          
            // $data['cooperatives_comments_cds'] = $this->cooperatives_model->cooperatives_comments_cds($data['coop_info']->id);
            // $data['cooperatives_comments_snr'] = $this->cooperatives_model->cooperatives_comments_snr($data['coop_info']->id);
            // $data['cooperatives_comments'] = $this->cooperatives_model->cooperatives_comments($data['coop_info']->id);
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="00"){
              // Registered Coop Process by Head Office
                $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
              // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_ho($data['admin_info']->region_code);
              }else{
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id);
              }
            }else if($this->session->userdata('access_level')==2){
              if($data['admin_info']->region_code=="00"){
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_ho($data['admin_info']->region_code);
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_senior($data['admin_info']->region_code);
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
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_director($data['admin_info']->region_code);
              } else {
                // Registered Coop Process by Head Office
                  $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
                // End Registered Coop Process by Head Office
                $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
                $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
              }
            }
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
            $this->load->view('templates/admin_header', $data);
            $this->load->view('applications/list_of_all_cooperatives', $data);
            $this->load->view('applications/change_cooperative_status');
            $this->load->view('admin/grant_privilege_supervisor');
            $this->load->view('admin/revoke_privilege_supervisor');
            $this->load->view('templates/admin_footer');
          }
        }
      }
    }

    public function change_status(){
      $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID',TRUE)));
      $decoded_specialist_id = $this->input->post('statuschange');
      
      $success =  $this->cooperatives_model->change_status_cooperatives($decoded_id,$decoded_specialist_id);
        if($success){
          $this->session->set_flashdata('list_success_message', 'Cooperative Status has beed Change.');
          redirect('cooperatives_list');
        }else{
          $this->session->set_flashdata('list_error_message', 'Unable to Change Status Cooperative.');
          redirect('cooperatives_list');
        }
    }
  }

 ?>
