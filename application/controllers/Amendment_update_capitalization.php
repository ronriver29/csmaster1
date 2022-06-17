
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amendment_update_capitalization extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("amendment_affiliators_update_model");
  }

  function index($id = null)
  {
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
    	$data['encrypted_id'] =$id;
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
         $cooperative_id = $this->coop_dtl($decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($decoded_id) && $decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->amendment_model->check_own_cooperative($cooperative_id,$decoded_id,$user_id)){
            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$decoded_id);
               
                // $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;
                // if($data['bylaw_complete']){
                    $data['client_info'] = $this->user_model->get_user_info($user_id);
                     $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);
                   
                    $data['title'] = 'Capitalization';
                    $data['header'] = 'Capitalization';
                    $data['encrypted_id'] = $id;
//                    $data['requirements_complete'] = $this->amendment_update_capitalization_model->is_requirements_complete($decoded_id);
                    
                    $data['bylaw_info'] = $this->amendment_update_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                    
                    if($this->input->post('capitalizationPrimaryBtn')) {
                      $data = $this->input->post('item');
                     	// $this->debug($data);
                      // var_dump($this->amendment_update_capitalization_model->update_capitalization($decoded_id,$cooperative_id,$data));
                       if($this->amendment_update_capitalization_model->update_capitalization($decoded_id,$cooperative_id,$data)){
                            $this->session->set_flashdata('capitalization_success', 'Successfully Updated');
                            redirect('amendment_update/'.$id.'/capitalization');
                        }else{
                          $this->session->set_flashdata('capitalization_error', 'Unable to update capitalization');
                          redirect('amendment_update/'.$id.'/capitalization');
                        }
                  
                    }

                    // $count = $this->amendment_update_capitalization_model->amend_get_capitalization_by_coop_id_count($decoded_id);
                    // if($count == 0){
                    //     $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($decoded_id);
                    // } else {
                    //     $data['capitalization_info'] = $this->amendment_update_capitalization_model->amend_get_capitalization_by_coop_id($decoded_id);
                    // }

                    $data['capitalization_info'] = $this->amendment_update_capitalization_model->get_capitalization_by_coop_id($cooperative_id,$decoded_id);

                    
                    //modified
                    $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                    if($data['coop_info']->grouping=='Federation')
                    {
                      $data['total_regular'] =$this->amendment_affiliators_update_model->total_regular($decoded_id);
                    }
                    $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
                    $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                    //end modified
                  
                    $this->load->view('./template/header', $data);
                    $this->load->view('update/amendment/bylaw_info/capitalization_update_form', $data);
                    $this->load->view('./template/footer');
                // }else{
                //   $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');
                //   redirect('amendment/'.$id);
                // }
            //   }else{
            //     redirect('amendment/'.$id);
            //   }
            // }else{
            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            //   redirect('amendment');
            // }
          }else{ 
            if($this->session->userdata('access_level')!=6){
              redirect('admins/login');
            }else{
              // if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$decoded_id)){
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('amendment');
              // }else{
                // if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$decoded_id)){
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($decoded_id);
              
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) : true;

          
                  // if($data['bylaw_complete']){
                        $data['title'] = 'Capitalization';
                        $data['header'] = 'Capitalization';
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        $data['encrypted_id'] = $id;
//                        $data['requirements_complete'] = $this->capitalization_model->is_requirements_complete($decoded_id);
                        $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($cooperative_id,$decoded_id);
                        $data['capitalization_info'] = $this->amendment_update_capitalization_model    ->get_capitalization_by_coop_id($cooperative_id,$decoded_id);

                          //modified
                    $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$decoded_id);
                    if($data['coop_info']->category_of_cooperative =='Secondary')
                    {
                      $data['total_regular'] = $this->amendment_affiliators_update_model->total_regular($decoded_id);

                    }

                  
                    $data['article_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$decoded_id);
                    $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$decoded_id);
                    //end modified
                     if($this->input->post('capitalizationPrimaryBtn')) {
                      $data = $this->input->post('item');
                      // $this->debug($data);
                      // var_dump($this->amendment_update_capitalization_model->update_capitalization($decoded_id,$cooperative_id,$data));
                       if($this->amendment_update_capitalization_model->update_capitalization($decoded_id,$cooperative_id,$data)){
                            $this->session->set_flashdata('capitalization_success', 'Successfully Updated');
                            redirect('amendment_update/'.$id.'/capitalization');
                        }else{
                          $this->session->set_flashdata('capitalization_error', 'Unable to update capitalization');
                          redirect('amendment_update/'.$id.'/capitalization');
                        }
                  
                    }
                    
                        $this->load->view('./templates/admin_header', $data);
                        $this->load->view('update/amendment/bylaw_info/capitalization_update_form', $data);
                        $this->load->view('./templates/admin_footer');
                  // }else{
                  //   $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');
                  //   redirect('amendment_update/'.$id);
                  // }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperators of the cooperative you trying to view is not yet submitted for evaluation.');
                //   redirect('amendment_update/'.$id);
                // }
              // }
            }
          }
        }else{
          show_404();
        }
    }
  }
  //modified by json
    public function coop_dtl($amendment_id)
    {
      $query = $this->db->query("select cooperative_id from amend_coop where id={$amendment_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $row)
        {
          $data = $row->cooperative_id;
        }
      }
      else
      {
        $data =NULL;
      }
      return $data;
    }
    public function debug($array)
    {
    
        echo"<pre>";
        print_r($array);
        echo"</pre>";
   

    }
}
