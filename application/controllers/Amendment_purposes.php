<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendment_purposes extends CI_Controller{
  public $decoded_id   =null;
  public function __construct()

  {

    parent::__construct();

   $this->load->library('auth');
   $this->auth->checkLogin(); 

    $this->load->model('amendment_model');

    $this->load->model('amendment_bylaw_model');

    $this->load->model('amendment_cooperator_model');

    $this->load->model('amendment_capitalization_model');

    $this->load->model('amendment_purpose_model');

    $this->load->model('user_model');

  }

  function index($id = null)

  {


         $this->load->model('amendment_affiliators_model','affiliator_model');
        $this->load->model('amendment_union_model','union_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

        $user_id = $this->session->userdata('user_id');

        $cooperative_id = $this->coop_dtl($this->decoded_id);

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            // if($this->amendment_model->check_own_cooperative($cooperative_id ,$this->decoded_id,$user_id)){

            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){

                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id ,$user_id,$this->decoded_id);
                  $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
                  $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                if($data['bylaw_complete']){

                    switch ($data['coop_info']->category_of_cooperative) {
                     case 'Secondary':
                     case 'Tertiary':
                      $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                       $data['cooperator_complete'] =true;
                        $data['union_complete'] =true;
                       break;
                      
                     case 'Others':
                      $data['union_complete'] = $this->union_model->is_requirements_complete($user_id);
                       $data['cooperator_complete'] =true;
                       $data['affiliator_complete'] = true;
                      break; 
                     default:
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                         $data['affiliator_complete'] =true;
                          $data['union_complete'] = true;
                       break;
                   }

                  if($data['cooperator_complete']){

                    $data['title'] = 'List of Purposes';

                    $data['header'] = 'Purposes';

                    $data['client_info'] = $this->user_model->get_user_info($user_id);

                    $data['encrypted_id'] = $id;

                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

                    $data['purpose_not_null'] = $this->amendment_purpose_model->check_not_null($cooperative_id,$this->decoded_id);

                    $data['purpose_blank_not_exists'] = $this->amendment_purpose_model->check_blank_not_exists($cooperative_id,$this->decoded_id);

                    // echo $this->db->last_query();

                    $row = $this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);

                    // echo $this->db->last_query();

                  

                    foreach($row as $purpose_content)

                    {

                      $purpose_content['content_purpose']= explode(";",$purpose_content['content']);

                      unset($purpose_content['content']);

                      // $purpose_content['content_purpose']=explode(";",$this->amendment_purpose_model->get_purpose_content($purpose_content['cooperative_type']));

                      // unset($purpose_content['content']);

                      $data_contents[]=$purpose_content;

                    }unset($purpose_content);

        

                    // $this->debug($data_contents);

                    $data['contents'] =$data_contents;

                    

                    $this->load->view('template/header', $data);

                    $this->load->view('purposes/amendment_list_of_purposes', $data); 

                    // $this->load->view('purposes/add_form_purposes', $data);

                    $this->load->view('template/footer');

                  }else{

                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');

                    redirect('amendment/'.$id);

                  }

                }else{

                  // var_dump($data['bylaw_complete']);

                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');

                  redirect('amendment/'.$id);

                }

            //   }else{

            //     redirect('amendment/'.$id);

            //   }

            // }else{

            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

            //   redirect('amendment');

            // }

          }else{

            // $access_array = array(1,2);

            // if($this->session->userdata('access_level')==5){

            //   redirect('admins/login');

            // }else if(!in_array($this->session->userdata('access_level'),$access_array)){

            //   redirect('amendment');

            // }else{
              $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
              $this->load->model('admin_model');

              $this->load->model('region_model');

              // if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){

              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');

              //   redirect('amendment');

              // }else{

              //   if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                  $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                  $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                  if($data['bylaw_complete']){

                      switch ($data['coop_info']->category_of_cooperative) {
                       case 'Secondary':
                       case 'Tertiary':
                        $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                         $data['cooperator_complete'] =true;
                          $data['union_complete'] =true;
                         break;
                        
                       case 'Others':
                        $data['union_complete'] = $this->union_model->is_requirements_complete($user_id);
                         $data['cooperator_complete'] =true;
                         $data['affiliator_complete'] = true;
                        break; 
                       default:
                          $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                           $data['affiliator_complete'] =true;
                            $data['union_complete'] = true;
                         break;
                     }

                    if($data['cooperator_complete']){

                      $data['title'] = 'List of Purposes';

                      $data['header'] = 'Purposes';

                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                      $data['encrypted_id'] = $id;

                      $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

                      $data['purpose_not_null'] = $this->amendment_purpose_model->check_not_null($cooperative_id,$this->decoded_id);

                      $data['purpose_blank_not_exists'] = $this->amendment_purpose_model->check_blank_not_exists($cooperative_id,$this->decoded_id);

                      $row = $this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);

                      $data['purposes'] = $row;

                      // $data['contents'] = explode(";",$row->content);



                      $row = $this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);



                  

                    foreach($row as $purpose_content)

                    {

                      $purpose_content['content_purpose']= explode(";",$purpose_content['content']);

                      unset($purpose_content['content']);

                      // $purpose_content['content_purpose']=explode(";",$this->amendment_purpose_model->get_purpose_content($purpose_content['cooperative_type']));

                      // unset($purpose_content['content']);

                      $data_contents[]=$purpose_content;

                    }unset($purpose_content);

                    $data['contents'] =$data_contents;

                    $this->load->view('templates/admin_header', $data);
                    $this->load->view('purposes/amendment_list_of_purposes', $data);
                    $this->load->view('templates/admin_footer');

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');

                      redirect('amendment/'.$id);

                    }

                  }else{

                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');

                    redirect('amendment/'.$id);

                  }

              //   }else{

              //     $this->session->set_flashdata('redirect_applications_message', 'The purpose of the cooperative you trying to view is not yet submitted for evaluation.');

              //     redirect('amendment');

              //   }

              // }

            // }

          }

        }else{

          show_404();

        }

  }

  function edit($id = null){

         $this->load->model('amendment_affiliators_model','affiliator_model');
        $this->load->model('amendment_union_model','union_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

        $user_id = $this->session->userdata('user_id');

        $cooperative_id =$this->coop_dtl($this->decoded_id);

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
                $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                if($data['bylaw_complete']){

                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);

                  switch ($data['coop_info']->category_of_cooperative) {
                     case 'Secondary':
                     case 'Tertiary':
                      $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                       $data['cooperator_complete'] =true;
                        $data['union_complete'] =true;
                       break;
                      
                     case 'Others':
                      $data['union_complete'] = $this->union_model->is_requirements_complete($user_id);
                       $data['cooperator_complete'] =true;
                       $data['affiliator_complete'] = true;
                      break; 
                     default:
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                         $data['affiliator_complete'] =true;
                          $data['union_complete'] = true;
                       break;
                   }

                  if($data['cooperator_complete']){

                    if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){

                        if ( isset( $_POST['editPurposesBtn'] ) ) { 

                            $temp = TRUE;

                        } else { 

                            $temp = FALSE;

                        }

                      if($temp == FALSE){

                        $data['title'] = 'List of Purposes';

                        $data['header'] = 'Purposes';

                        $data['client_info'] = $this->user_model->get_user_info($user_id);

                        $data['encrypted_id'] = $id;

                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

                        $data['purpose_not_null'] = $this->amendment_purpose_model->check_not_null($cooperative_id,$this->decoded_id);

                        $data['purpose_blank_not_exists'] = $this->amendment_purpose_model->check_blank_not_exists($cooperative_id,$this->decoded_id);

                        $row = $this->amendment_purpose_model->get_all_purposes($cooperative_id,$this->decoded_id);

                        foreach($row as $purpose_content)

                        {

                          $purpose_content['content_purpose']= explode(";",$purpose_content['content']);

                          unset($purpose_content['content']);

                          $data_contents[]=$purpose_content;

                        }



                         $data['contents'] =$data_contents;


                       

                        $this->load->view('template/header', $data);

                        $this->load->view('purposes/amendment_add_form_purposes', $data);

                        $this->load->view('template/footer');

                      }else{

                        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

                        $purposes1 = '';

                        $temp = array();

                        $purposes1='';

                        $process = 0;

                        $success = 0;

                         $data_purposes = array();

                        foreach($this->input->post('items') as $row)

                        {

                         $contents = implode(';',array_filter($row['content']));//.'<br>';

                            $data_purposes = array(

                              'id' => $this->encryption->decrypt(decrypt_custom($row['id'])),

                              'cooperative_type' =>$row['type_of_cooperative'],

                              'content' => $contents

                            );

                            // $this->debug( $data_purposes);

                                $process++;

                                $this->db->trans_begin();

                                $this->db->update('amendment_purposes',$data_purposes,array('id'=>$data_purposes['id']));

                                if($this->db->trans_status() === FALSE){

                                  $this->db->trans_rollback();

                                  // return false;

                                }else{

                                  $this->db->trans_commit();

                                   $success++;

                                }

                        }

                                if($process>0 && $success==$process)

                                {

                                  $this->session->set_flashdata('edit_purposes_success', "Updated Purposes Successfully.");

                                  redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');

                                }

                                else

                                {

                                    $this->session->set_flashdata('edit_purposes_error', "Unable to update purposes.");

                                    redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');

                                }



                      }

                    }else{

                      $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');

                      redirect('amendment/'.$id);

                    }

                  }else{

                    $this->session->set_flashdata('redirect_message', 'Please complete first your list of cooperator.');

                    redirect('amendment/'.$id);

                  }

                }else{

                  $this->session->set_flashdata('redirect_message', 'Please complete first your bylaw additional information.');

                  redirect('amendment/'.$id);

                }

            //   }else{

            //     redirect('amendment/'.$id);

            //   }

            // }else{

            //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

            //   redirect('amendment');

            // }

          }else{

            if($this->session->userdata('access_level')==5){

              redirect('admins/login');

            }else if($this->session->userdata('access_level')!=1){

              redirect('amendment');

            }else{

              if($this->amendment_model->check_expired_reservation_by_admin($this->decoded_id)){

                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');

                redirect('amendment');

              }else{

                if($this->amendment_model->check_submitted_for_evaluation($this->decoded_id)){

                  if($this->amendment_model->check_first_evaluated($this->decoded_id)){

                    $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');

                    redirect('amendment');

                  }else{

                    $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                    $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->bylaw_model->check_bylaw_primary_complete($this->decoded_id) : true;

                    if($data['bylaw_complete']){

                      $data['cooperator_complete'] = $this->cooperator_model->is_requirements_complete($this->decoded_id);

                      if($data['cooperator_complete']){

                        if($this->form_validation->run() == FALSE){

                          $data['title'] = 'List of Purposes';

                          $data['header'] = 'Purposes';

                          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                          $data['encrypted_id'] = $id;

                          $data['purposes_complete'] = $this->purpose_model->check_purpose_complete($this->decoded_id);

                          $data['purpose_not_null'] = $this->purpose_model->check_not_null($this->decoded_id);

                          $data['purpose_blank_not_exists'] = $this->purpose_model->check_blank_not_exists($cooperative_id,$this->decoded_id);

                          $row = $this->purpose_model->get_all_purposes($data['coop_info']->id);

                          $data['purposes'] = $row;

                          $data['contents'] = explode(";",$row->content);

                          $this->load->view('templates/admin_header', $data);

                          $this->load->view('purposes/add_form_purposes', $data);

                          $this->load->view('templates/admin_footer');

                        }else{

                          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativesID')));

                          $purposes = '';

                          $temp =  $this->input->post('purposes');

                          foreach($temp as $t){

                            $purposes .= $t.';';

                          }

                          $purposes = substr_replace($purposes, "", -1);

                          $data = array(

                            'content' => $purposes,

                          );

                          $success = $this->purpose_model->edit_purposes($this->decoded_id,$data);

                          if($success){

                            $this->session->set_flashdata('edit_purposes_success', "Updated Purposes Successfully.");

                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');

                          }else{

                            $this->session->set_flashdata('edit_purposes_error', "Unable to update purposes.");

                            redirect('amendment/'.$this->input->post('cooperativesID').'/amendment_purposes');

                          }

                        }

                      }else{

                        $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');

                        redirect('amendment/'.$id);

                      }

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');

                      redirect('amendment/'.$id);

                    }

                  }

                }else{

                  $this->session->set_flashdata('redirect_applications_message', 'Updating the purpose of the cooperative is not available because it is not yet submitted for evaluation.');

                  redirect('amendment');

                }

              }

            }

          }

        }else{

          show_404();

        }

  }

  public function coop_dtl($amendment_id)

    {

      $query = $this->db->query("select cooperative_id from amend_coop where id='$amendment_id'");

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

