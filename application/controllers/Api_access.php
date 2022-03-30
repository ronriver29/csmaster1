<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_access extends CI_Controller {

    public function __construct ()
    {
        parent::__construct();
         // $this->load->helper('jwt_helper');
        $this->load->model('api_access_model');
    }    
    public function index()
    {

        if(!$this->session->userdata('logged_in')){
          redirect('admins/login');
        }else{
          if(!$this->session->userdata('client')){
            $admin_user_id = $this->session->userdata('user_id');
            if($this->admin_model->check_super_admin($admin_user_id)){
              $data['title'] = 'Davao API';
              $data['header'] = 'Davao API';
              $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);
              $data['list_access'] = $this->api_access_model->get_access();
              $this->load->view('./templates/admin_header', $data);
              $this->load->view('davao/davao_api', $data);
              $this->load->view('davao/delete_modal', $data);
              $this->load->view('./templates/admin_footer');
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('api_settings');
            }
          }else{
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('api_settings');
          }
        }
  
    }

    public function update_access()
    {
        // if(isset($_POST['submit']))
        // {
        //     $table = $this->input->post('table');
        //     $fields = implode(',',$this->input->post('fields'));
        //     $data =['table'=>$table,'fields'=>$fields,'active'=>1,'created_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))];
        //     if($this->api_access_model->create($data))
        //     {
        //      $this->session->set_flashdata('redirect_applications_message', 'Successfully created!');
        //       redirect('api_access');
        //     }
        //     else
        //     {
        //      $this->session->set_flashdata('error_redirect_applications_message', 'Failed to create data.');
        //       redirect('api_access');
        //     }
        // }
        // else
        // {
        //      $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
        //       redirect('api_access');
        // }

        $table = $this->input->post('table');
        $id = $this->input->post('id');

            // $fields = implode(',',$this->input->post('fields'));
            $data =['table'=>$table,'active'=>$id,'updated_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))];
            $ajax =false;
            if($this->api_access_model->update($data))
            {
                $ajax = true;
            }
            return $ajax;
    }

    public function delete_access()
    {
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
         $decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
         if($this->api_access_model->remove($decoded_id))
         {
             $this->session->set_flashdata('redirect_applications_message', 'Successfully deleted!');
              redirect('api_access');
         }
         else
         {
             $this->session->set_flashdata('error_redirect_applications_message', 'Failed to delete data.');
              redirect('api_access');
         }
      }  
    }
  public function fields()
  {
    if($this->input->method(TRUE)==="POST")
    {
      $table = $this->input->post('table');
       $query = $this->db->list_fields($table);
      // $query = $this->db->query("select id,proposed_name from amend_coop limit 10");
     echo json_encode($query);
     // echo json_encode($query->result_array());
    }
  }



    public function token()
    {
        $jwt = new JWT();
        $jwtSecrectKey = 'Mysecredtkey';
        $data = array(
                'userID' =>456,
                'email' =>'jaysondelapaz16@gamil.com',
                'userType' => 'admin'
        );

        $token = $jwt->encode($data,$jwtSecrectKey,'HS256');
        echo $token;
    }

    public function decode_token()
    {
        $token = $this->uri->segment(3);

        $jwt = new JWT();
        $jwtSecrectKey = 'Mysecredtkey';
        $decode_token = $jwt->decode($token,$jwtSecrectKey,'HS256');
        // echo'<pre>';
        // print_r($decode_token);    
        echo $jwt->jsonEncode($decode_token);
    }

    public function debug($array)
    {
        echo"<pre>";
        print_r($array);
    }
}
