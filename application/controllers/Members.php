<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $uid = $this->session->userdata('user_id');
      if($this->cooperatives_model->check_cooperative_exist($uid)){
        if(!$this->cooperatives_model->check_expired_reservation($uid)){
            $data['title'] = 'List of Members';
            $this->load->view('./templates/header', $data);
            $this->load->view('members/members_list', $data);
            $this->load->view('members/add_form_member');
            $this->load->view('members/edit_form_member');
            $this->load->view('members/delete_form_member');
            $this->load->view('./templates/footer');
        }else{
          redirect('cooperatives/reservation_update');
        }
      }else{
        redirect('cooperatives/reservation');
      }
    }
  }
  function add_member(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $uid = $this->session->userdata('user_id');
      if($this->cooperatives_model->check_cooperative_exist($uid)){
        if(!$this->cooperatives_model->check_expired_reservation($uid)){
          if($this->input->method(TRUE)==="GET"){
            redirect('members');
          }else{
            $data = array(
              'cooperatives_id' => $this->cooperatives_model->get_cooperative_info($uid)->id,
              'full_name' => $this->input->post('fName'),
              'gender' => $this->input->post('gender'),
              'position' => $this->input->post('position'),
              'birth_date' => $this->input->post('bDate'),
              'postal_address' => $this->input->post('pAddress'),
            );
            $success = $this->member_model->add_member($data);
            if($success){
                $this->session->set_flashdata('add_member_success', 'Member has been successfully added');
            }else{
                $this->session->set_flashdata('add_member_error', 'Unable to add member');
            }
            redirect('members');
          }
        }else{
          echo 'expired';
        }
      }else{
        redirect('cooperatives/reservation');
      }
    }
  }
  function edit_member(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $uid = $this->session->userdata('user_id');
      if($this->cooperatives_model->check_cooperative_exist($uid)){
        if(!$this->cooperatives_model->check_expired_reservation($uid)){
          if($this->input->method(TRUE)==="GET"){
            redirect('members');
          }else{
            $data = array(
              'id' => $this->input->post('memberID'),
              'cooperatives_id' => $this->cooperatives_model->get_cooperative_info($uid)->id,
              'full_name' => $this->input->post('fName'),
              'gender' => $this->input->post('gender'),
              'position' => $this->input->post('position'),
              'birth_date' => $this->input->post('bDate'),
              'postal_address' => $this->input->post('pAddress'),
            );
            $success = $this->member_model->edit_member($data);
            if($success){
                $this->session->set_flashdata('edit_member_success', 'Member has been successfully updated');
            }else{
                $this->session->set_flashdata('edit_member_error', 'Unable to update cooperator');
            }
            redirect('members');
          }
        }else{
          echo 'expired';
        }
      }else{
        redirect('cooperatives/reservation');
      }
    }
  }
  function delete_member(){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
      $uid = $this->session->userdata('user_id');
      if($this->cooperatives_model->check_cooperative_exist($uid)){
        if(!$this->cooperatives_model->check_expired_reservation($uid)){
          if($this->input->method(TRUE)==="GET"){
            redirect('members');
          }else{
            $id = $this->input->post('memberID');
            $success = $this->member_model->delete_member($id);
            if($success){
                $this->session->set_flashdata('delete_member_success', 'Member has been successfully deleted');
            }else{
                $this->session->set_flashdata('delete_member_error', 'Unable to delete member');
            }
            redirect('members');
          }
        }else{
          echo 'expired';
        }
      }else{
        redirect('cooperatives/reservation');
      }
    }
  }
  function all(){
    if($this->input->method(TRUE)==="GET"){
      redirect('members');
    }else{
      $members = $this->member_model->get_all_member();
      $temp['data'] = $members;
      echo json_encode($temp);
    }
  }
}
