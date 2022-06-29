<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_access extends CI_Controller {

    public function __construct ()
    {
        parent::__construct();
         // $this->load->helper('jwt_helper');
        $this->load->model('admin_model');
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
        $table = $this->input->post('table');
        $id = $this->input->post('id');

            // $fields = implode(',',$this->input->post('fields'));
            $data =['tbl'=>$table,'active'=>$id,'updated_at'=>date('Y-m-d h:i:s',now('Asia/Manila'))];
            $ajax ='Failed';
            if($this->api_access_model->update($data))
            {
                $ajax = 'success';
            }
           echo json_encode(['msg'=> $ajax]);
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
        return $token;
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

    public function davao_api()
    {
        if(isset($_POST['token']))
        {
            $token = $this->input->post('token');
            $regNo = $this->input->post('regNo');
            $table = 'registeredcoop';
            if($this->api_access_model->check_table_access($table))
            {
                if($this->token() == $token)
                {
                   $result = $this->api_access_model->get_coop_by_regNo($regNo);
                   echo json_encode($result);
                }
                else
                {
                    echo json_encode("Unauthorized");
                }
            }
            else
            {
                echo json_encode("Fobidden to accesss data. Please contact system administrator.");
            }
            
        }
        else
        {
            echo '404 No found';
        }
    }

    public function request()
    {
  
    $admin_user_id = $this->session->userdata('user_id');
    $data['admin_info'] = $this->admin_model->get_admin_info($admin_user_id);

      $data['title'] = 'Davao API';
      $data['header'] = 'Davao API';
      $this->load->view('./templates/admin_header', $data);
      $this->load->view('davao/sample_form', $data);
      $this->load->view('./templates/admin_footer');
 
     }
    public function result()
    {
      if(!isset($_POST['submit']))
      {
        $token = $this->input->post('token');
        $regNo = $this->input->post('regNo');
        $table = 'registeredcoop';
        if($this->api_access_model->check_table_access($table))
        {
          if($this->token() == $token)
          {
            $result = $this->api_access_model->get_coop_by_regNo($regNo);
            echo json_encode($result);
          }
          else
          {
           echo json_encode("Unauthorized");
          }
        }
        else
        {
          echo json_encode("Fobidden to accesss data. Please contact system administrator.");
        }
       }
    }
   
    
    public function debug($array)
    {
        echo"<pre>";
        print_r($array);
    }
}
