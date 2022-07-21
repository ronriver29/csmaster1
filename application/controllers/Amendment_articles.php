<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendment_articles extends CI_Controller{

  public $decoded_id=null;

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

    $this->load->model('amendment_article_of_cooperation_model'); 

    $this->load->model('user_model');

  }

  function index($id  = null)

  {

    $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
    $user_id = $this->session->userdata('user_id');
    $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
    $data['is_client'] = $this->session->userdata('client');

      if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

        if($this->session->userdata('client')){

          // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

          //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
              $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
              $this->amendment_model->check_own_cooperative_($cooperative_id,$this->decoded_id,$user_id);
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

              if($data['coop_info']->category_of_cooperative =="Primary" || ($data['coop_info']->category_of_cooperative =="Secondary") || ($data['coop_info']->category_of_cooperative =="Tertiary")){

                redirect('amendment/'.$id.'/articles_primary');

              }else if($data['coop_info']->grouping =="Union"){

                 redirect('amendment/'.$id.'/article_union');

              }
              // else{

              //    // redirect('amendment/'.$id.'/articles_federation');

              // }

          //   }else{

          //     redirect('amendment/'.$id);

          //   }

          // }else{

          //   $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');

          //   redirect('amendment');

          // }

        }else{

          // if($this->session->userdata('access_level')==5){

          //   redirect('admins/login');

          // }else if($this->session->userdata('access_level')!=1){

          //   redirect('cooperatives');

          // }else{

            // if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
          $this->auth->authuserLevelAmd($this->session->userdata('access_level'),array(1,2));
          $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
              $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

               if($data['coop_info']->category_of_cooperative =="Primary" || ($data['coop_info']->category_of_cooperative =="Secondary") || ($data['coop_info']->category_of_cooperative =="Tertiary")){

                redirect('amendment/'.$id.'/articles_primary');

              }else if($data['coop_info']->grouping =="Union"){

                 redirect('amendment/'.$id.'/article_union');

              }

            // }else{

            //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');

            //   redirect('amendment');

            // }

        //   }

        }

      }else{

        show_404();

      }
  }



  function primary($id = null)

  {
      $this->load->model('amendment_affiliators_model');
      $this->load->model('amendment_union_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

        $user_id = $this->session->userdata('user_id');

        $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);

        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){

                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

              
                

                if($data['bylaw_complete']){

                  switch ($data['coop_info']->category_of_cooperative) {
                     case 'Secondary':
                     case 'Tertiary':
                      $data['affiliator_complete'] = $this->amendment_affiliators_model->is_requirements_complete($this->decoded_id);
                      $data['cooperator_complete'] =true;
                      $data['union_complete'] =true;
                      $data['total_regular'] = $this->amendment_affiliators_model->get_total_regular($this->decoded_id);
                       break;
                      
                     case 'Others':
                      $data['union_complete'] = $this->amendment_union_model->is_requirements_complete($user_id);
                       $data['cooperator_complete'] =true;
                       $data['affiliator_complete'] = true;
                      break; 
                     default:
                        $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);
                        $data['affiliator_complete'] =true;
                        $data['union_complete'] = true;
                        $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);
                        $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);
                       break;
                   }



                  if($data['cooperator_complete']){

                    $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

 

                    if($data['purposes_complete']){

                      $array_category = array('Primary','Secondary','Tertiary');

                      if(in_array($this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id)->category_of_cooperative,$array_category)){

                        if(!isset($_POST['articlesPrimaryBtn'])){

                          $data['title'] = 'Articles of Cooperation';

                          $data['header'] = 'Articles of Cooperation';

                          $data['client_info'] = $this->user_model->get_user_info($user_id);

                          $data['encrypted_id'] = $id;

                          $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                          $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                          // $this->debug(  $data['articles_info']);

                          // if(!$data['articles_info']) {

                          //   $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                          // }

                         

                          // if($data['total_regular']==0){

                          //   $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($this->decoded_id);

                          // }


                          // if($data['total_associate']==0) {

                          //   $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);

                          // }

                          $data['encrypted_articles_id'] = encrypt_custom($this->encryption->encrypt($data['articles_info']->id)); //modified

                           //capitalization

                          $data['capitalization_info']  = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                          // $this->output->enable_profiler(TRUE);

                        

                          $this->load->view('template/header', $data);

                          $this->load->view('amendment/articles_cooperation_info/articles_primary_form.php', $data);

                          $this->load->view('template/footer');

                        }else{ //true button submit

                          if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){

                            $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));

                            // $get_record = $this->db->where("amendment_id",$this->decoded_id)->get("amendment_articles_of_cooperation");

                            // if($get_record->num_rows()==0) {

                            //     $this->db->insert('amendment_articles_of_cooperation', array('amendment_id'=>$this->decoded_id));

                            //     $this->db->trans_commit();

                            // }

                                $datas = array(

                                  'cooperatives_id'=>$cooperative_id,

                                  'amendment_id' => $this->decoded_id,

                                  'years_of_existence' => $this->input->post('cooperativeExistence'),

                                  'directors_turnover_days' => $this->input->post('turnOverDirectors'),

                                  'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),

                                  'common_share' => str_replace(',','',$this->input->post('commonShares')),

                                  'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),

                                  'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),

                                  'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred')),

                                  'guardian_cooperative' => $this->input->post('guardian_cooperative')

                                );

                                // $this->debug($datas);

                                // echo $article_coop_id;

                                // $this->debug($this->amendment_article_of_cooperation_model->update_article_primary($article_coop_id,$datas));

                                if($this->amendment_article_of_cooperation_model->update_article_primary($this->decoded_id,$datas)){

                                  

                                  $this->session->set_flashdata('article_success', 'Successfully Updated.');

                                  redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');

                                }else{

                                  $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');

                                  redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');

                                }

//                            } else {

//                                

//                            }

                          }else{

                            $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');

                            redirect('amendment/'.$id);

                          }

                        }

                      }else{

                        redirect('amendment/'.$id);

                      }

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first your cooperative&apos;s purpose .');

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

            // $access_array = array(1,2);

            // if($this->session->userdata('access_level')==5){

            //   redirect('admins/login');

            // }else if(!in_array($this->session->userdata('access_level'),$access_array)){

            //   redirect('amendment');

            // }else{
             

              // if($this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){

              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');

              //   redirect('amendment');

              // }else{

                // if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                  $this->auth->authuserLevelAmd($this->session->userdata('access_level'),array(1,2));
                  $this->load->model('admin_model');
                  $this->load->model('region_model');
                  $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                  $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                  if($data['bylaw_complete']){

                     switch ($data['coop_info']->category_of_cooperative) {
                       case 'Secondary':
                       case 'Tertiary':
                        $data['affiliator_complete'] = $this->amendment_affiliators_model->is_requirements_complete($this->decoded_id);
                         $data['cooperator_complete'] =true;
                          $data['union_complete'] =true;
                         break;
                        
                       case 'Others':
                        $data['union_complete'] = $this->amendment_union_model->is_requirements_complete($user_id);
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

                        $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

                        if($data['purposes_complete']){

                          $array_category = array('Primary','Secondary','Tertiary');

                      if(in_array($this->amendment_model->get_cooperative_info_by_admin($this->decoded_id)->category_of_cooperative,$array_category)){

                          if($this->form_validation->run() == FALSE){

                            $data['title'] = 'Articles of Cooperation';

                            $data['header'] = 'Articles of Cooperation';

                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                            $data['encrypted_id'] = $id;

                            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                            $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                        

                        // Added By Anjury

                            $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);

                                if($data['total_regular']==0){

                                  $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($this->decoded_id);

                                }

                                

                            $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);

                                if($data['total_associate']==0) {

                                  $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);

                                }

                             $data['encrypted_articles_id'] = encrypt_custom($this->encryption->encrypt($data['articles_info']->id)); //modified

                              $data['capitalization_info']  = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                              $this->load->view('templates/admin_header', $data);
                              $this->load->view('amendment/articles_cooperation_info/articles_primary_form.php', $data);
                              $this->load->view('templates/admin_footer', $data);

                          }else{

                            if($this->amendment_model->check_first_evaluated($this->decoded_id)){

                              $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');

                              // redirect('cooperatives');

                            }else{

                              $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));

                              $get_record = $this->db->where("cooperatives_id",$this->decoded_id)->get("amendment_articles_of_cooperation");

                                if($get_record->num_rows()==0) {

                                    $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$this->decoded_id));

                                    $this->db->trans_commit();

                                }

                              $data = array(
                              'years_of_existence' => $this->input->post('cooperativeExistence'),
                              'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                              'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                              'common_share' => str_replace(',','',$this->input->post('commonShares')),
                              'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                              'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                              'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred')),
                              'guardian_cooperative'=>$this->input->post('guardian_cooperative')
                              );

                       
                              if($this->amendment_article_of_cooperation_model->update_article_primary($article_coop_id,$data)){
                              $this->session->set_flashdata('article_success', 'Successfully Updated.');
                              redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                              }else{
                              $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                              redirect('amendment/'.$this->input->post('article_coop_id').'/articles_primary');
                              }

                            }

                          }

                        }else{

                         //redirect('amendment/'.$id.'/articles');

                        }

                      }else{
                      $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');
                      redirect('amendment/'.$id);
                      }

                    }else{

                      $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');

                      redirect('amendment/'.$id);

                    }

                  }else{

                    $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');

                    redirect('amendment/'.$id);

                  }

                // }else{

                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');

                //   redirect('amendment');

                // }

              // }

            // }

          }

        }else{

          show_404();

        }

  }



  function union($id = null)

  {

        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
        $data['is_client'] = $this->session->userdata('client');

        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){

          if($this->session->userdata('client')){

            // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){

            //   if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                // $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
                // $this->amendment_model->check_expired_reservation_($this->decoded_id,$user_id);
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;



                        if(!isset($_POST['articlesUnionBtn'])){

                          $data['title'] = 'Articles of Cooperation';

                          $data['header'] = 'Articles of Cooperation';

                          $data['client_info'] = $this->user_model->get_user_info($user_id);

                          $data['encrypted_id'] = $id;

                          $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                          $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                          // $this->debug(  $data['articles_info']);

                          // if(!$data['articles_info']) {

                          //   $data['articles_info'] = $this->article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                          // }

                          $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);

                          if($data['total_regular']==0){

                            $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($this->decoded_id);

                          }

                          $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);

                          if($data['total_associate']==0) {

                            $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);

                          }

                          $data['encrypted_articles_id']='';

                          if(isset($data['articles_info']))

                          {

                            $data['encrypted_articles_id'] = encrypt_custom($this->encryption->encrypt($data['articles_info']->id));

                          }

                        

                          $data['capitalization_info']  = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                          
                            $this->load->view('template/header', $data);
                            $this->load->view('amendment/articles_cooperation_info/articles_union_form', $data);
                            $this->load->view('template/footer');

                        }else{ //true button submit


                            $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));

                              $datas = array(
                              'cooperatives_id'=>$cooperative_id,
                              'amendment_id' => $this->decoded_id,
                              'years_of_existence' => $this->input->post('years_of_existence'),
                              'directors_turnover_days' => $this->input->post('turnOverDirectors'),
                              'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),
                              'common_share' => str_replace(',','',$this->input->post('commonShares')),
                              'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),
                              'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),
                              'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred')),
                              'guardian_cooperative' => $this->input->post('guardian_cooperative')
                              );

                              if($this->amendment_article_of_cooperation_model->update_article_primary($this->decoded_id,$datas)){

                              $this->session->set_flashdata('article_success', 'Successfully Updated.');
                              redirect('amendment/'.$this->input->post('article_coop_id').'/article_union');
                              }else{
                              $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');
                              redirect('amendment/'.$this->input->post('article_coop_id').'/article_union');
                              }

                        }

          }else{

            // if($this->session->userdata('access_level')!=6){

            //   redirect('admins/login');

            // }else{
                  $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
                  $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id); 

                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$this->decoded_id) : true;

                  // if($data['bylaw_complete']){

                    $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($cooperative_id,$this->decoded_id);

                    // if($data['cooperator_complete']){

                    //   $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($cooperative_id,$this->decoded_id);

                    //   if($data['purposes_complete']){

                        // if($this->amendment_model->get_cooperative_info_by_admin($this->decoded_id)->category_of_cooperative =="Primary"){

                    

                        if(!isset($_POST['articlesPrimaryBtn'])){

                            $data['title'] = 'Articles of Cooperation';

                            $data['header'] = 'Articles of Cooperation';

                            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

                            $data['encrypted_id'] = $id;

                            $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

                            $data['articles_info'] = $this->amendment_article_of_cooperation_model->get_article_by_coop_id($cooperative_id,$this->decoded_id);

                        

                        // Added By Anjury

                            $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($cooperative_id,$this->decoded_id);

                                if($data['total_regular']==0){

                                  $data['total_regular'] = $this->amendment_cooperator_model->get_total_regular($this->decoded_id);

                                }

                                

                            $data['total_associate'] = $this->amendment_cooperator_model->get_total_associate($cooperative_id,$this->decoded_id);

                                if($data['total_associate']==0) {

                                  $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id);

                                }

                        // End Add By Anjury

//                            $data['total_regular'] = $this->cooperator_model->get_total_regular($this->decoded_id); // Comment By Anjury

//                            $data['total_associate'] = $this->cooperator_model->get_total_associate($this->decoded_id); // Comment By Anjury



                             $data['encrypted_articles_id'] = encrypt_custom($this->encryption->encrypt($data['articles_info']->id)); //modified

                             $capitalinfo = null;

                             $data['capitalization_info']  = $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

                           

                            $this->load->view('templates/admin_header', $data);

                            $this->load->view('update/amendment/articles/articles_union_form', $data);

                            $this->load->view('templates/admin_footer', $data);

                          }else{

                           

                              $article_coop_id = $this->encryption->decrypt(decrypt_custom($this->input->post('article_coop_id')));

                              $get_record = $this->db->where("cooperatives_id",$this->decoded_id)->get("amendment_articles_of_cooperation");

                                if($get_record->num_rows()==0) {

                                    $this->db->insert('amendment_articles_of_cooperation', array('cooperatives_id'=>$this->decoded_id));

                                    $this->db->trans_commit();

                                }

                              $data = array(

                                'years_of_existence' => $this->input->post('cooperativeExistence'),

                                'directors_turnover_days' => $this->input->post('turnOverDirectors'),

                                'authorized_share_capital' => str_replace(',','',$this->input->post('authorizedShareCapital')),

                                'common_share' => str_replace(',','',$this->input->post('commonShares')),

                                'par_value_common' => str_replace(',','',$this->input->post('parValueCommon')),

                                'preferred_share' => str_replace(',','',$this->input->post('preferredShares')),

                                'par_value_preferred' =>str_replace(',','',$this->input->post('parValuePreferred')),

                                'guardian_cooperative'=>$this->input->post('guardian_cooperative')

                              );

                              // $this->debug($data);

                              // echo $article_coop_id;

                              if($this->amendment_article_of_cooperation_model->update_article_primary($article_coop_id,$data)){

                                $this->session->set_flashdata('article_success', 'Successfully Updated.');

                                redirect('amendment/'.$this->input->post('article_coop_id').'/article_union');

                              }else{

                                $this->session->set_flashdata('article_error', 'Unable to update article of cooperation additional information.');

                                redirect('amendment/'.$this->input->post('article_coop_id').'/article_union');

                              }

                          

                          }

                        // }else{

                        //   redirect('amendment_update/'.$id.'/articles');

                        // }

                    //   }else{

                    //     $this->session->set_flashdata('redirect_message', 'Please complete first the cooperative&apos;s purpose .');

                    //     redirect('amendment_update/'.$id);

                    //   }

                    // }else{

                    //   $this->session->set_flashdata('redirect_message', 'Please complete first the list of cooperator.');

                    //   redirect('amendment_update/'.$id);

                    // }

                  // }else{

                  //   $this->session->set_flashdata('redirect_message', 'Please complete first the bylaw additional information.');

                  //   redirect('amendment/'.$id);

                  // }

                // }else{

                //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative is not yet submitted for evaluation.');

                //   redirect('amendment_update/'.$id);

                // }

             

            // }

          }

        }else{

          show_404();

        }


  }




public function debug($array)
{
  echo"<pre>";
    print_r($array);
  echo"</pre>";
}

}

