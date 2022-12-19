<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

class amendment extends CI_Controller{
    public $decoded_id = null;
    public $coopName =null;
    public $regNo=null;
    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->library('auth');
      $this->auth->checkLogin();
      $this->load->model('amendment_uploaded_document_model');
      $this->load->model('amendment_model');
      $this->load->model('amendment_committee_model');
      $this->load->model('amendment_bylaw_model');
      $this->load->model('amendment_capitalization_model');
      $this->load->model('amendment_purpose_model');
      $this->load->model('amendment_article_of_cooperation_model');
      $this->load->model('amendment_cooperator_model');
      $this->load->model('Amendment_affiliators_model','amendment_affiliators_model');
      $this->load->model('cooperatives_model');
      $this->load->model('user_model');
      $this->load->model('admin_model');
      $this->load->model('region_model');

    }
  
    public function saveor($was){ 
      $amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cid')));

      $data = array(
        'id' => $this->input->post('payment_id'),
        'or_no' => $this->input->post('orNo'),
        'date_of_or' => $this->input->post('dateofOR'),
        'status' =>1,
        'amendment_id' => $amendment_id
      );
     
      $this->amendment_model->save_OR(array('id' => $this->input->post('payment_id'),'amendment_id'=>$amendment_id),$data,$amendment_id);
      unset($amendment_id);
      echo json_encode(array("status" => TRUE, "message"=>"O.R. No has been saved."));
    }

    public function index(){

        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if($this->session->userdata('client')){
          $data['title'] = 'List of Cooperatives';
          $data['client_info'] = $this->user_model->get_user_info($user_id);
          $data['header'] = 'Amendment';
          $data['has_registered_coop'] = $this->amendment_model->check_if_has_registered($user_id);
          $data['check_pending'] = $this->amendment_model->check_pending($data['client_info']->regno,$user_id);  
          $data['is_update_cooperative'] = $this->amendment_model->check_date_registered($data['client_info']->regno);
          $data['is_coop_updated'] = $this->amendment_model->is_coop_updated($data['client_info']->regno);
          $data['is_amendment_updated'] = $this->amendment_model->is_amendment_updated($data['client_info']->regno);
            $this->load->view('template/header', $data);
           if($data['client_info']->regno ==NULL)
           {
            $data['is_coop_updated'] =true;
            $data['is_amendment_updated'] =true;
           }
           if($data['is_coop_updated'] && ($data['is_amendment_updated']))
           {
          
            $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives($this->session->userdata('user_id'));
            $this->load->view('applications/list_of_amendment', $data);
           }
           else
           {
            
            if(!$data['is_update_cooperative']) //check if for updating
            {
            $data['list_cooperatives_for_update'] = $this->amendment_model->reg_coop_migrated_data($user_id);
            $this->load->view('applications/list_of_reg_amendment', $data);
            }
            else
            {
            //new upadeted coop migrated data
              $data['has_registered_coop'] =true;
              $data['list_cooperatives'] =$this->amendment_model->reg_coop_migrated_data_updates($data['client_info']->regno);
              $this->load->view('update/amendment/list_of_migrated_amendment', $data);
            }
           } 
            // $this->load->view('applications/list_of_amendment', $data);
          $this->load->view('amendment/delete_modal_amendment');
          $this->load->view('template/footer');
        }else{
           $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2,3]);
           $this->load->library('pagination');
            $this->load->model('region_model');
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; 
            $data['title'] = 'List of Amendment';
            $data['header'] = 'Amendment';
            $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
            $data['has_registered_coop']=true;
              $list_coop_type_arr  = $this->amendment_model->check_ho_multipurpose_type($data['admin_info']->region_code);
             
               $amendment_id  = array();
                // $this->debug($list_coop_type_arr);
              foreach($list_coop_type_arr as $row)
              {
                 $types_coop = explode(',',$row['type_of_cooperative']);
                 $a[]= '"' . implode ( '", "', $types_coop  ) . '"';
                 $ho_arr = $this->amendment_model->get_ho_list();
                 $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
                 if($result)
                 { // ho coop
                  array_push($amendment_id,$row['id']);
                 }
                 else
                 { //non ho coop
                  array_push($amendment_id,$row['id']);
                 }
              }
               $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
              $data['msg'] ='';
              $submit =false;
            
              if(isset($_POST['submit']))
              {
              $submit =true;
              $this->coopName = $this->input->post('coopName');
              }
                   
            if($this->session->userdata('access_level')==1){
              if($data['admin_info']->region_code=="00"){
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);
              }else{         
                $data['specialist_coop_count'] = $this->amendment_model->get_all_cooperatives_by_specialist_count($data['admin_info']->region_code,$user_id);
                $array =array(
                'url'=>base_url()."amendment",
                'total_rows'=> $data['specialist_coop_count'],
                'per_page'=>$config['per_page']=5,
                'url_segment'=>2
                ); 
                $data['links']=$this->paginate($array);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id,$config['per_page'],$page); 
                 $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
               
              }
            }else if($this->session->userdata('access_level')==2){             
              if($data['admin_info']->region_code=="00"){

                if(count($amendment_id)>0) 
                {
                  $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code,$amendment_id);  
                } 
                else
                {
                  $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior2("00");
                }  
              }
              else 
              {
                $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_by_senior_count($data['admin_info']->region_code,$this->coopName);
                $array =array(
                'url'=>base_url()."amendment",
                'total_rows'=>$data['senior_coop_count'],
                'per_page'=>$config['per_page']=5,
                'url_segment'=>2
                );
              
                $data['links']=$this->paginate($array);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_senior($data['admin_info']->region_code,$amendment_id,$this->coopName,$config['per_page'],$page); 
                 $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
                $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code); 
              }
            }else{ //DIRECTOR
               $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
              if($data['admin_info']->region_code=="00"){
        
                $data['list_cooperatives'] = $this->amendment_model->get_not_ho_list_of_coop($amendment_id);
               
              } else {
               
                $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_by_director_count($data['admin_info']->region_code);
                $array =array(
                'url'=>base_url()."amendment",
                'total_rows'=>$data['senior_coop_count'],
                'per_page'=>$config['per_page']=5,
                'url_segment'=>2
                );
              
                $data['links']=$this->paginate($array);
                $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_director($data['admin_info']->region_code,$amendment_id,$config['per_page'],$page);
                $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');

                // $data['list_of_cooperative_by_ho_process'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code);
              }
            }

        
            $data['is_acting_director'] = $this->admin_model->is_active_director($user_id);
            $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
          
              $this->load->view('templates/admin_header', $data);
              $this->load->view('applications/list_of_amendment', $data);
              $this->load->view('applications/assign_admin_modal_amendment');
              $this->load->view('admin/grant_privilege_supervisor_amendment');
              $this->load->view('admin/revoke_privilege_supervisor_amendment');
              $this->load->view('templates/admin_footer');
          }
        // }
      
    }

    public function registered()
    {
  
        $this->auth->check_access_level($this->session->userdata('access_level'));
        $this->load->library('pagination');
          $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $user_id = $this->session->userdata('user_id');
          $data['title'] = 'List of Amendment';
          $data['header'] = 'Amendment';
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['has_registered_coop']=true;
          $list_coop_type_arr  = $this->amendment_model->check_ho_multipurpose_type($data['admin_info']->region_code);

          $amendment_id  = array();
          // $this->debug($list_coop_type_arr);
          foreach($list_coop_type_arr as $row)
          {
            $types_coop = explode(',',$row['type_of_cooperative']);
            $a[]= '"' . implode ( '", "', $types_coop  ) . '"';
            $ho_arr = $this->amendment_model->get_ho_list();
            $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
              if($result)
              { // ho coop
              array_push($amendment_id,$row['id']);
              }
              else
              { //no ho coop
              array_push($amendment_id,$row['id']);
              }
          }
          unset($row);
          $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
          $data['msg'] ='';
          $submit =false;
          // $data['registered_coop']=null;
          if(isset($_POST['submit']))
          {
            $submit =true;
            $this->coopName = $this->input->post('coopName');
            $this->regNo = $this->input->post('regNo');
          }

          if($this->session->userdata('access_level')==1){
            if($data['admin_info']->region_code=="00"){
            $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);

            }else{
              $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_registration_count($data['admin_info']->region_code);
              $array =array(
              'url'=>base_url()."amendment/registered",
              'total_rows'=>$data['senior_coop_count'],
              'per_page'=>$config['per_page']=5,
              'url_segment'=>3
              );

              $data['links']=$this->paginate($array);
              $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code,$this->coopName,$config['per_page'],$page);
              $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
            }  
          }else if($this->session->userdata('access_level')==2){
            if($data['admin_info']->region_code=="00"){
              //head office
            }
            else
            {
              $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_registration_count($data['admin_info']->region_code,$this->coopName,$this->regNo);
              $array =array(
              'url'=>base_url()."amendment/registered",
              'total_rows'=>$data['senior_coop_count'],
              'per_page'=>$config['per_page']=5,
              'url_segment'=>3
              );

              $data['links']=$this->paginate($array);
              $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code,$this->coopName,$this->regNo,$config['per_page'],$page);
              $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
              
            }
          }
          else{ //DIRECTOR
          $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
            if($data['admin_info']->region_code=="00"){

            } else {
              
               $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_registration_count($data['admin_info']->region_code,$this->coopName,$this->regNo);
              $array =array(
              'url'=>base_url()."amendment/registered",
              'total_rows'=>$data['senior_coop_count'],
              'per_page'=>$config['per_page']=5,
              'url_segment'=>3
              );

              $data['links']=$this->paginate($array);
              $data['list_cooperatives_registered'] = $this->amendment_model->get_all_cooperatives_registration($data['admin_info']->region_code,$this->coopName,$this->regNo,$config['per_page'],$page);
              $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
            }
          }  
     
      $this->load->view('templates/admin_header', $data);
      $this->load->view('amendment/registered_amendment', $data);
      $this->load->view('templates/admin_footer');
    }  

    public function registered_ho()
    {
        $this->auth->check_access_level($this->session->userdata('access_level'));
        $this->load->library('pagination');
          $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $user_id = $this->session->userdata('user_id');
          $data['title'] = 'List of Amendment';
          $data['header'] = 'Amendment';
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['has_registered_coop']=true;
          $list_coop_type_arr  = $this->amendment_model->check_ho_multipurpose_type($data['admin_info']->region_code);

          $amendment_id  = array();
          // $this->debug($list_coop_type_arr);
          foreach($list_coop_type_arr as $row)
          {
            $types_coop = explode(',',$row['type_of_cooperative']);
            $a[]= '"' . implode ( '", "', $types_coop  ) . '"';
            $ho_arr = $this->amendment_model->get_ho_list();
            $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
              if($result)
              { // ho coop
              array_push($amendment_id,$row['id']);
              }
              else
              { //no ho coop
              array_push($amendment_id,$row['id']);
              }
          }
          unset($row);
          $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
          $data['msg'] ='';
          $submit =false;
          // $data['registered_coop']=null;
          if(isset($_POST['submit']))
          {
            $submit =true;
            $this->coopName = $this->input->post('coopName');
          }

            $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_registration_by_ho_count($data['admin_info']->region_code);
            $array =array(
            'url'=>base_url()."amendment/registered_ho",
            'total_rows'=>$data['senior_coop_count'],
            'per_page'=>$config['per_page']=5,
            'url_segment'=>3
            );
            $data['links']=$this->paginate($array);

          if($this->session->userdata('access_level')==1){
            if($data['admin_info']->region_code=="00"){
            $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);

            }else{
              $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code,$this->coopName,$config['per_page'],$page); 
              $data['msg'] = ($submit && empty($data['list_cooperatives_registered_by_ho']) ? 'No data found.':'');
             ;
            }  
          }else if($this->session->userdata('access_level')==2){
            if($data['admin_info']->region_code=="00"){
            // Registered Coop Process by Head Office
             // $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code);
             //  if(count($amendment_id)>0)
             //  {
             //   $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code,$amendment_id);
             //  }
             //  else
             //  {
             //  $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior2("00");
             //  }

            }
            else
            {
              
               $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code,$this->coopName,$config['per_page'],$page); 
              $data['msg'] = ($submit && empty($data['list_cooperatives_registered_by_ho']) ? 'No data found.':'');
             
            }
          }
          else{ //DIRECTOR
          $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
            if($data['admin_info']->region_code=="00"){

            } else {
              
              $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code,$this->coopName,$config['per_page'],$page); 
              $data['msg'] = ($submit && empty($data['list_cooperatives_registered_by_ho']) ? 'No data found.':'');
            }
          }  
           $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':''); 
      $this->load->view('templates/admin_header', $data);
      $this->load->view('amendment/registered_amendment_ho', $data);
      $this->load->view('templates/admin_footer');
    }

    public function deferred_denied()
    {
       $this->auth->check_access_level($this->session->userdata('access_level'));
        $this->load->library('pagination');
          $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
          $user_id = $this->session->userdata('user_id');
          $data['title'] = 'List of Amendment';
          $data['header'] = 'Amendment';
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['has_registered_coop']=true;
          $list_coop_type_arr  = $this->amendment_model->check_ho_multipurpose_type($data['admin_info']->region_code);

          $amendment_id  = array();
          foreach($list_coop_type_arr as $row)
          {
            $types_coop = explode(',',$row['type_of_cooperative']);
            $a[]= '"' . implode ( '", "', $types_coop  ) . '"';
            $ho_arr = $this->amendment_model->get_ho_list();
            $result = count(array_intersect($types_coop, $ho_arr)) ? true : false;
              if($result)
              { // ho coop
              array_push($amendment_id,$row['id']);
              }
              else
              { //no ho coop
              array_push($amendment_id,$row['id']);
              }
          }
          unset($row);
          $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
          $data['msg'] ='';
          $submit =false;
          // $data['registered_coop']=null;
          if(isset($_POST['submit']))
          {
            $submit =true;
            $this->coopName = $this->input->post('coopName');
          }

          if($this->session->userdata('access_level')==1){
            if($data['admin_info']->region_code=="00"){
            $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist_central_office($data['admin_info']->region_code);

            }else{
            $data['specialist_coop_count'] = $this->amendment_model->get_all_cooperatives_by_specialist_count($data['admin_info']->region_code,$user_id);
            $array =array(
            'url'=>base_url()."amendment",
            'total_rows'=> $data['specialist_coop_count'],
            'per_page'=>$config['per_page']=5,
            'url_segment'=>2
            );
            $data['links']=$this->paginate($array);
            $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_specialist($data['admin_info']->region_code,$user_id,$config['per_page'],$page);
            $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
            $data['list_of_cooperative_by_ho_process'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code);
            }
          }else if($this->session->userdata('access_level')==2){
            if($data['admin_info']->region_code=="00"){
            // Registered Coop Process by Head Office
             $data['list_cooperatives_registered_by_ho'] = $this->amendment_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code);
              if(count($amendment_id)>0)
              {
               $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code,$amendment_id);
              }
              else
              {
              $data['list_cooperatives'] = $this->amendment_model->get_all_cooperatives_by_ho_senior2("00");
              }

            }
            else
            {
              $data['senior_coop_count'] = $this->amendment_model->get_all_cooperatives_debydefer_count($data['admin_info']->region_code);
              $array =array(
              'url'=>base_url()."amendment",
              'total_rows'=>$data['senior_coop_count'],
              'per_page'=>$config['per_page']=5,
              'url_segment'=>2
              );

              $data['links']=$this->paginate($array);
              $data['list_of_defer_deny'] =$this->amendment_model->get_all_cooperatives_debydefer($data['admin_info']->region_code);
              $data['msg'] = ($submit && empty($data['list_cooperatives']) ? 'No data found.':'');
            }
          }
          // else{ //DIRECTOR
          // $data['registered_coop_change_region'] =$this->amendment_model->cooperatives_registered_change_region($data['admin_info']->region_code);
          //   if($data['admin_info']->region_code=="00"){

          //   } else {
            

          //   }
          // }  
   
      $this->load->view('templates/admin_header', $data);
      $this->load->view('amendment/deferred_denied', $data);
      $this->load->view('templates/admin_footer');
    }  
    public function application(){

        $this->load->model('bylaw_model');
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if($this->session->userdata('client')){
              $data['title'] = 'Application Details';
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['header'] = 'Amendment';
              $data['regions_list'] = $this->region_model->get_regions();
              if(!$this->amendment_model->check_date_registered($data['client_info']->regno))
              {
                if(!$this->amendment_model->check_if_has_updated($user_id))
                {
                $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'A Cooperative must be updated.'));
                redirect('amendment');
                }
              }
              else
              {
                if(!$this->amendment_model->check_if_has_registered($user_id))
                {
                // $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
                $this->session->set_flashdata(array('msg_class'=>'danger','amendment_msg'=>'A Cooperative must be registered first to open Amendment module.'));
                redirect('amendment');
                }
              }
              $data['has_registered_coop'] = $this->amendment_model->check_if_has_registered($user_id);
   
              if (!isset($_POST['amendmentAddBtn'])){
               
                if(strlen($data['client_info']->regno) ==0)
                {
                   $data['regNo'] =$this->amendment_model->load_regNo($user_id);
                }
                else
                {
                   $data['regNo'] = $this->amendment_model->load_regNo_reg($user_id);
                }

              if($this->amendment_model->check_pending($data['regNo'],$user_id))
              {
                  $this->session->set_flashdata('list_error_message', 'A pending amendment Cooperative application must be process.');
                    redirect('amendment'); 
              }  
              $data['cooperative_id'] = $this->amendment_model->get_cooperative_id_by_regNo($data['regNo']);
              
              $data['date_diff_Reg'] =false;
                  $date_diff_reg = $this->amendment_model->year_registered($data['regNo']);
                  if($date_diff_reg>=2)
                  {
                     $data['date_diff_Reg'] = true;
                  }
                  if($date_diff_reg ==NULL)
                  {
                    $date_diff_reg = $this->amendment_model->year_registered2($data['regNo']); 
                     if($date_diff_reg>=2)
                    {
                     $data['date_diff_Reg'] = true;
                   }
                  } 
               
                if($this->amendment_model->if_had_amendment_new($data['regNo']))
                {
                  // $composition_members = $this->amendment_model->amendment_info_by_regno($data['regNo']);
                  //last amendment info
                  $data['coop_info'] = $this->amendment_model->get_amendment_info_byreg($data['regNo']);
                  $composition_members = $this->amendment_model->get_composition_of_members_by_amendment($data['coop_info']->cooperative_id,$data['coop_info']->id);               
                }
                else
                { 
                   $data['cooperative_id'] = $this->amendment_model->coop_info_by_regno($data['regNo'])->application_id;
                    $composition_members = $this->amendment_model->get_composition_of_members_by_coop($data['cooperative_id']);
                  //cooperative info if firt amendment apply  
                  $data['coop_info'] =  $this->amendment_model->get_cooperative_info_by_admin_previous($data['cooperative_id']);
                }
               
                $data['comp_of_membership'] =$composition_members;// explode(',',$composition_members);
               // $this->debug($data['comp_of_membership']);
                $data['list_of_composition'] = $this->amendment_model->get_composition_of_members();
                // $this->debug($data['list_of_composition']);
                 if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);

                  }
                  $data['bylaw_info'] = $this->bylaw_model->get_bylaw_by_coop_id($data['cooperative_id']);
                  // $data['list_of_regions'] = $this->amendment_model->get_regions();
                  $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                  $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                  $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
          
                 
                ini_set('display_errors', 1);
                $this->load->view('./template/header', $data);
                $this->load->view('cooperative/amendment_detail', $data);
//                $this->load->view('cooperative/terms_and_condition');
                $this->load->view('./template/footer');
              }else{
                $subclass_array = $this->input->post('subClass');
                $major_industry = $this->input->post('majorIndustry');
                $members_composition = $this->input->post('composition_of_membersa');
                $regNo = $this->input->post('regNo');
                $coop_id = $this->amendment_model->coop_info_by_regno($regNo)->application_id;
                $amendmentNo = $this->amendment_model->format_amendmentNo_byregNo($this->input->post('regNo'));
                
                $typeOfCooperativeID = $this->input->post('typeOfCooperative');
                  $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));
                if($this->input->post('commonBondOfMembership')=='Institutional')
                {
                    $name_of_ins_assoc = implode(',',$this->input->post('name_associational'));
                    $field_memship =$this->input->post('assoc_field_membership');
                }
                else if($this->input->post('commonBondOfMembership')=='Associational')
                {
                    $name_of_ins_assoc = implode(',',$this->input->post('name_associational'));
                    $field_memship =$this->input->post('assoc_field_membership');
                }
                else if($this->input->post('commonBondOfMembership')=='Occupational')
                {
                    $name_of_ins_assoc ='';
                    $field_memship ='';
                }
                else
                {
                    $name_of_ins_assoc ='';
                    $field_memship ='';
                }    
             

                $proposeName = trim($this->input->post('newNamess'));
                $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);
                $type_of = '';
               	$coopTypeID = implode(',',$typeOfCooperativeID);

                $occu_comp_of_membship='';
                if(is_array($this->input->post('compositionOfMembersa'))>0)
                {
                  $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembersa'));
                }
              
               $interregional='';
               $regions='';
               $interregional ='';
              
               if($this->input->post('areaOfOperation') == 'Interregional')
               {
                $interregional= implode(',',$this->input->post('interregional'));
                 $regions= implode(',',$this->input->post('regions'));
               }
              
                
                if(in_array('Workers',explode(',',$type_of_cooperativeName))  || in_array('Labor Service',explode(',',$type_of_cooperativeName)))
                {
                   $commonBondOFmembership = $this->input->post('commonBond2');
                }
                else
                {
                  $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
                }
                 
              $grouping_ ='Primary';
              if(($type_of_cooperativeName =='Union') && $this->input->post('categoryOfCooperative')=='Others')
              {
              $grouping_='Union';
              }
              if($this->input->post('categoryOfCooperative')=='Secondary' || $this->input->post('categoryOfCooperative')=='Tertiary')
              {
              $grouping_='Federation';
              }

                $field_data = array(
                  'users_id' => $this->session->userdata('user_id'),
                  'cooperative_id' => $coop_id, 
                  'regNo' => $this->input->post('regNo'),
                  'amendmentNo' =>  $amendmentNo,
                  'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                  'proposed_name' => $proposeName,
                  'capital_contribution' => $this->input->post('capital_contribution'),
                  'acronym' => strtoupper($this->input->post('acronym_names')),
                  'type_of_cooperative' => $type_of_cooperativeName,
                  'cooperative_type_id' => 	$coopTypeID,
                  'grouping' => $grouping_,
                  'common_bond_of_membership' =>$commonBondOFmembership,
                  'comp_of_membership' => $occu_comp_of_membship,
                  'field_of_membership' =>  $field_memship,
                  'name_of_ins_assoc' =>  $name_of_ins_assoc,
                  // 'type' => $type_of,
                  'area_of_operation' => $this->input->post('areaOfOperation'),
                  'refbrgy_brgyCode' =>  $this->input->post('barangay_'),// $this->input->post('barangay'),
                  'interregional' => $interregional,
                  'regions' => $regions,
                  'street' => $this->input->post('streetName'),
                  'house_blk_no' => $this->input->post('blkNo'),
                  'status' => '1',
                  'created_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                  'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                );
                unset($coopTypeID);
                unset($name_of_ins_assoc);
                unset($grouping_);
                unset($proposeName);
                unset($amendmentNo);
                unset($type_of_cooperativeName);
                 $data_bylaws = array(
                      'cooperatives_id' => $coop_id, 
                      'annual_regular_meeting_day_date'=> $this->input->post('annaul_date_venue'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('assembly_venue'),
                      'type' => $this->input->post('type')
                );
                unset($coop_id);
                if($this->amendment_model->if_had_amendment_new($this->input->post('regNo')))
                {
           
                  // $this->debug($this->amendment_model->create_amendment($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative,$data_bylaws));
                  if($this->amendment_model->create_amendment($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative,$data_bylaws))
                  {
                    $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
                    redirect('amendment');
                  }
                  else
                  {
                    $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
                    redirect('amendment'); 
                  }
                }
                else
                {
              
	                if($this->amendment_model->add_new_amendment($field_data,$major_industry,$subclass_array,$occu_comp_of_membship,$typeOfCooperative,$data_bylaws)){
	             
	                  $this->session->set_flashdata('list_success_message', 'Your reservation is confirmed.');
	                  redirect('amendment');
	                }else{
	                  $this->session->set_flashdata('list_error_message', 'Unable to reserve cooperative name.');
	                  redirect('amendment');
	                }
                }
              }
          }
      
    }


    public function format_name($type_of_coop_id)
    {
    	if(is_array($type_of_coop_id))
    	{
    		foreach($type_of_coop_id as $type_id)
		      {
		        // $sqry = $this->db->get_where('cooperative_type',array('id'=>$type_id));
            $this->db->select('cooperative_type.name');
            $this->db->from('cooperative_type');
            $this->db->where(['id'=>$type_id]);
            $sqry=$this->db->get();
		        foreach($sqry->result_array() as $val)
		        {
		            $typeCoopName [] = $val['name'];
		        }
            unset($val);
		      }
          unset($type_id);
		      $type_of_cooperative_name = implode(",",$typeCoopName);
          unset($type_of_coop_id);
          unset($sqry);
		      return $type_of_cooperative_name;
    	}
    }

    public function amendment_name_exist($cooperatieID_,$proposed_name)
    {
      $check_name = $this->db->query("select cooperative_id,proposed_name from amend_coop");
      if($check_name->num_rows()>0)
      {
      	foreach($check_name->result_array() as $row_name)
      	{
      		$row_name['proposed_name'] =strtolower($row_name['proposed_name']);
      		if($row_name['proposed_name'] ==strtolower($proposed_name) && $row_name['cooperative_id']==$cooperatieID_)
      		{
      			return TRUE;
      		}	
      	}
        unset($row_name);
	      			//check to amend coop without coop id
		      	 $check_name_all = $this->db->query('select id from amend_coop where proposed_name="'.$proposed_name.'" and cooperative_id!='.$cooperatieID_);
		      	 if($check_name_all->num_rows()>0)
		      	 {
		      	 	return FALSE;
		      	 }
		      	 else
		      	 {
		      	 	return TRUE;
		      	 }
      }
      else
      {
      	return TRUE;
      }
    }
    //end modify
    public function amendment_update($id = null){ 

        $this->load->model('major_industry_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            // if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
            //   if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
                $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                $this->amendment_model->check_own_cooperative_($this->decoded_id,$user_id);
                if(!$this->input->post('Amendment_ID')){
                  $data['client_info'] = $this->user_model->get_user_info($user_id); 
                  $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);

                  $data['title'] = 'Update Amendment Details';
                  $data['header'] = 'Update Amendment Information';
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);

                  $coopTypeName= $data['coop_info']->type_of_cooperative;
                  $typeName_arr = explode(',',$coopTypeName);
                  $list_of_major_industry_cooptype =$this->major_industry_model->get_major_industries_by_type_name($coopTypeName);
                  
                  $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                   $data['cooperative_type'] = $list_type;
                  $list_coop_type_id[] =$this->get_coopTypeID( $typeName_arr); 
                 //get major industry id
                  if($data['coop_info']->grouping!='Union')
                  {
                    foreach($list_coop_type_id as $row_coop_type_id)
                    { 	
                    	//get major class industry id
                    		$mjor_ins_id[]=$this->industry_subclass_per_coop_type( $row_coop_type_id);

                    }
                  
                     	//extract all major industrial id
                    foreach($mjor_ins_id as $id_major_industry)
                    {	
                      foreach($id_major_industry as $mjorID)
                      { 
                      $extracted_majorins_id =  $mjorID['major_industry_id'];
                      $list_major_ins[] = $this->major_industry_description($extracted_majorins_id); 
                      $list_subclassID=$this->major_industry_subclass_id($extracted_majorins_id);
                      }
                 		
                    } 

                   
                    $data['major_industries_by_coop_type'] = $list_of_major_industry_cooptype;
                    $data['list_of_major_industry'] = $this->get_major_industry($list_of_major_industry_cooptype);
                    $list_majors = $this->load_major($data['coop_info']->cooperative_type_id);
                    $list_subclass = $this->load_subclass($data['coop_info']->cooperative_type_id);
                    $data['load_major'] = $list_majors;
                    $data['load_subclass'] = $list_subclass;

                    $qry_business_act = $this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$this->decoded_id));
                    if($qry_business_act->num_rows()>0)
                    {
                      foreach($qry_business_act->result_array() as $brow)
                      {
                        // $this->debug($brow);
                        $major_id = $brow['major_industry_id'];
                        $brow['major_description_']=$this->amendment_model->major_industry_description2($major_id);
                     
                        $brow['subclass_description_']=$this->major_industry_description_subclass2($brow['subclass_id']);
                       
                        $cooptype_id_array[] = $brow['cooperative_type_id'];
                        $brow['load_major'] =  $list_majors;
                        $brow['load_subclass'] = $list_subclass;
                        $business_data[] =$brow;

                         // $this->debug( $business_data);
                          $data['list_of_major_industry_']= $business_data;

                          // $this->debug( $data['list_of_major_industry_']);
                          
                          foreach($cooptype_id_array as $ctype_id)
                          {
                            $mdata[] = $this->amendment_model->list_of_majorindustry($ctype_id);
                          }
                          unset($ctype_id);
                          $data['mjor_list']=$mdata;
                         
                          foreach($mdata as $m)
                          {
                            //$this->$this->major_industry_description_subclass($['sublcass+i']);
                            $subclass_data[]=$this->amendment_model->list_of_subclasss($m['major_industry_id']);
                          }
                        unset($m);
                         foreach($subclass_data as $sdata){
                          foreach($sdata as $srow)
                          {
                            $list_subclass[]= $this->amendment_model->major_industry_description_subclass($srow['subclass_id']);
                          }
                         }
                         unset($sdata);
                         unset($srow);
                         $data['list_subclass'] = $list_subclass;
                      }
                      unset($brow);
                    }

                  } //end union
                 if($data['coop_info']->common_bond_of_membership=='Occupational')
                 {
                 	$existed_composition = explode(',',$data['coop_info']->comp_of_membership);
                 	foreach($existed_composition as $com_row)
                 	{
                 		$list_ofComposition[] = $this->CompositionOfmembers($com_row);
                 	}
                  unset($com_row);
                 	$data['list_of_comp'] = $list_ofComposition;
                 }

                  $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                  $data['business_activities'] = $this->amendment_model->get_all_business_activities($this->decoded_id);
                  $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($this->decoded_id);
                  $data['composition']= $this->amendment_model->get_composition();
                  $data['regions_list'] = $this->region_model->get_regions();
                  $data['encrypted_id'] = $id;

                  $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                  $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                  unset($coopTypeName);
                  $data['amd_type_of_coop'] = $typeName_arr;
                  unset($typeName_arr);
                  $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);

                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } else {
                    $data['regions_list'] = $this->region_model->get_regions();
                  }
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);

                  }
                   $data['client_info'] = $this->user_model->get_user_info($user_id);
                  if(strlen($data['client_info']->regno) ==0)
                  {
                     $data['regNo'] =$this->amendment_model->load_regNo($user_id);
                  }
                  else
                  {
                     $data['regNo'] = $this->amendment_model->load_regNo_reg($user_id);
                  }

                  $data['date_diff_Reg'] =false;
                  $date_diff_reg = $this->amendment_model->year_registered($data['regNo']);
                  if($date_diff_reg>=2)
                  {
                     $data['date_diff_Reg'] = true;
                  }
                  if($date_diff_reg ==NULL)
                  {
                    $date_diff_reg = $this->amendment_model->year_registered2($data['regNo']); 
                     if($date_diff_reg>=2)
                    {
                     $data['date_diff_Reg'] = true;
                   }
                  }   
                 
                
                  $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                  $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                  $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);

                  $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);
                  
                  $this->load->view('./template/header', $data);
                  $this->load->view('cooperative/amendment_reservation_update', $data);
                  if($this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                    // $this->load->view('cooperative/terms_and_condition');
                  }
                  $this->load->view('./template/footer', $data);
                }else{
                	// $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
                  if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                    $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $members_composition = $this->input->post('compositionOfMembers');
             
                   
           			  $typeOfCooperativeID = $this->input->post('typeOfCooperative');
	                $typeOfCooperative = implode(',',$this->input->post('typeOfCooperative'));

	                 // $type_of_cooperativeName = $this->format_name($typeOfCooperative);
                  $field_memship ='';
                  $name_of_ins_assoc ='';
                   $commonBondOFmembership =  $this->input->post('commonBondOfMembership');
	                if($commonBondOFmembership=='Institutional')
	                {
	                       $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
	                        $field_memship =$this->input->post('field_membership');
	                }
	                else if( $commonBondOFmembership=='Associational')
	                {
	                      $name_of_ins_assoc = implode(',',$this->input->post('name_institution'));
	                      $field_memship =$this->input->post('field_membership');
	                }
                  else if($commonBondOFmembership=='Residential')
                  {
                      $name_of_ins_assoc ='';
                      $field_memship ='';
                      $occu_comp_of_membship='';
                  }  

	                 else 
	                {
	                      $name_of_ins_assoc ='';
	                      $field_memship ='';
                        $commonBondOFmembership =  $this->input->post('commonBond2');
	                } 

	                $proposeName = strtolower($this->input->post('proposedName'));
	                $type_of_cooperativeName = $this->format_name($typeOfCooperativeID);
                  unset($typeOfCooperativeID);
	                $occu_comp_of_membship='';
	                if(is_array($this->input->post('compositionOfMembers'))>0)
	                {
	                  $occu_comp_of_membship = implode(',',$this->input->post('compositionOfMembers'));
	                }    
                  // $this->debug( $occu_comp_of_membship);
                  $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('Amendment_ID')));             
	                 // $group='';

                   $interregional='';
                   $regions='';
                   if($this->input->post('interregional')!=NULL)
                   {
                    $interregional= implode(',',$this->input->post('interregional'));
                   }
                    if($this->input->post('regions')!=NULL)
                   {
                     $regions= implode(',',$this->input->post('regions'));
                   }
                   $cooperativeType_id =  implode(',',$this->input->post('typeOfCooperative'));
                

                   
                    $grouping_ ='';
                    if(($type_of_cooperativeName =='Union') && $this->input->post('categoryOfCooperative')=='Others')
                    {
                    $grouping_='Union';
                    }
                    if($this->input->post('categoryOfCooperative')=='Secondary' || $this->input->post('categoryOfCooperative')=='Tertiary')
                    {
                    $grouping_='Federation';
                    }
                
                    $field_data = array(
                      'users_id' => $this->session->userdata('user_id'),
                      'cooperative_id'=>$this->amendment_model->coop_dtl($this->decoded_id),
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('newNamess'),
                      'acronym' => $this->input->post('acronym_name'),
                      'type_of_cooperative' =>   $type_of_cooperativeName,
                      'cooperative_type_id' => $cooperativeType_id,
                      'grouping' => $grouping_,
                      'common_bond_of_membership' => $commonBondOFmembership,
                      'comp_of_membership' =>$occu_comp_of_membship,
                	    'field_of_membership' => $field_memship,
               		    'name_of_ins_assoc' => $name_of_ins_assoc,
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay_'),//$this->input->post('barangay'),
                      'interregional' =>$interregional,
                      'regions'=>$regions,
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'updated_at' =>  date('Y-m-d h:i:s',now('Asia/Manila')),
                    );
                    // $this->debug($field_data);
                    $data_bylaws = array(
                      'annual_regular_meeting_day_date'=> $this->input->post('annaul_date_venue'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('assembly_venue'),
                      'type' => $this->input->post('type')
                    );
                    $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$this->decoded_id));
                     $coo_info_by_admin=$this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                    if($coo_info_by_admin->type_of_cooperative != $field_data['type_of_cooperative'] || $coo_info_by_admin->category_of_cooperative != $field_data['category_of_cooperative'])
                    {
                        $cooptypess = explode(',',$field_data['type_of_cooperative']); 
                        foreach($cooptypess as $type_coop)
                        {
                           $temp_purpose[] = array(
                            'cooperatives_id' => $cooperative_id,
                            'amendment_id' => $this->decoded_id,
                            'content'  => $this->amendment_model->get_purpose_content($type_coop,$grouping_),
                            'cooperative_type' => $type_coop
                          ); 
                            // $this->debug($temp_purpose);
                        } 
                        unset($type_coop);
                        if($this->db->delete('amendment_purposes',array('amendment_id'=>$this->decoded_id)))
                        {
                          $this->db->insert_batch('amendment_purposes',$temp_purpose);
                        }
                    }
                     // $this->debug($this->amendment_model->update_not_expired_cooperative($user_id,$this->decoded_id,$field_data,$subclass_array,$major_industry,$members_composition,$data_bylaws));
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$this->decoded_id,$field_data,$subclass_array,$major_industry,$members_composition,$data_bylaws)){
                      $this->session->set_flashdata('cooperative_success', 'Successfully updated basic information.');
                      redirect('amendment/'.$this->input->post('Amendment_ID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to update cooperative basic information.');
                      redirect('amendment/'.$this->input->post('Amendment_ID'));
                    }
                  }else{
                    $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                    $subclass_array = $this->input->post('subClass');
                    $major_industry = $this->input->post('majorIndustry');
                    $field_data = array(
                      'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                      'proposed_name' => $this->input->post('proposedName'),
                      'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                       'cooperative_type_id' => $cooperativeType_id,
                       'cooperative_id'=>$this->amendment_model->coop_dtl($this->decoded_id),
                      'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                      'composition_of_members' => $this->input->post('compositionOfMembers'),
                      'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                      'area_of_operation' => $this->input->post('areaOfOperation'),
                      'refbrgy_brgyCode' => $this->input->post('barangay'),
                      'street' => $this->input->post('streetName'),
                      'house_blk_no' => $this->input->post('blkNo'),
                      'status' => 1,
                      'created_at'=> date('Y-m-d h:i:s'),
                      'expire_at' =>  date('Y-m-d h:i:s',(now('Asia/Manila')+(4*24*60*60)))
                    );
                    $data_bylaws = array(
                      'annual_regular_meeting_day_date'=> $this->input->post('annaul_date_venue'),
                      'annual_regular_meeting_day_venue'=> $this->input->post('assembly_venue'),
                      'type' => $this->input->post('type')
                    );
                     $this->db->update('amendment_bylaws',$data_bylaws,array('amendment_id'=>$this->decoded_id));
                
                   
                    if($this->amendment_model->update_not_expired_cooperative($user_id,$this->decoded_id,$field_data,$subclass_array,$major_industry,$data_bylaws)){

                      $this->session->set_flashdata('cooperative_success', 'Successfully updated expired reservation.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }else{
                      $this->session->set_flashdata('cooperative_error', 'Unable to reserve cooperative.');
                      redirect('amendment/'.$this->input->post('cooperativeID'));
                    }
                  }
                }
              // }else{

              //   $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
              //   redirect('amendment/'.$id);
              // }
            // }else{
            //   redirect('amendment');
            // }
          }else{
            // $access_level = array(1,2);
            // if($this->session->userdata('access_level')==5){
            //   redirect('admins/login');
            // // }else if($this->session->userdata('access_level')!=1){
            // }else if(!in_array($this->session->userdata('access_level'),$access_level)){  
            //   redirect('amendment');
            // }else{
              // if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
              //   if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                  // if(!$this->amendment_model->check_first_evaluated($this->decoded_id)){
                  $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2]);
                  $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                  $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                    if($this->form_validation->run() == FALSE){
                      $data['title'] = 'Update Cooperative Details';
                      $data['header'] = 'Update Cooperative Information';
                      $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                      $data['regions_list'] = $this->region_model->get_regions();
                      $data['major_industries_by_coop_type'] = $this->major_industry_model->get_major_industries_by_type_name($data['coop_info']->type_of_cooperative);
                      $data['major_industry_list'] = $this->amendment_model->get_all_major_industry($this->decoded_id);
                      $data['subclasses_list'] = $this->amendment_model->get_all_subclasses($this->decoded_id);
                      $data['business_activities'] =  $this->amendment_model->get_all_business_activities($this->decoded_id);
                      $data['members_composition'] = $this->amendment_model->get_coop_composition($this->decoded_id);
                      $data['composition']= $this->amendment_model->get_composition();
                      $coopTypeName= $data['coop_info']->type_of_cooperative;
                      $typeName_arr = explode(',',$coopTypeName);
                      $list_of_major_industry_cooptype =$this->major_industry_model->get_major_industries_by_type_name($coopTypeName);
                      $list_type[] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                      $list_coop_type_id[] =$this->get_coopTypeID( $typeName_arr); 
                     //get major industry id
                        if($data['coop_info']->grouping!='Union')
                  {
                    foreach($list_coop_type_id as $row_coop_type_id)
                    {   
                      //get major class industry id
                        $mjor_ins_id[]=$this->industry_subclass_per_coop_type( $row_coop_type_id);

                    }
                  
                      //extract all major industrial id
                    foreach($mjor_ins_id as $id_major_industry)
                    { 
                      foreach($id_major_industry as $mjorID)
                      { 
                      $extracted_majorins_id =  $mjorID['major_industry_id'];
                      $list_major_ins[] = $this->major_industry_description($extracted_majorins_id); 
                      $list_subclassID=$this->major_industry_subclass_id($extracted_majorins_id);
                      }
                    
                    } 

                   
                    $data['major_industries_by_coop_type'] = $list_of_major_industry_cooptype;
                    $data['list_of_major_industry'] = $this->get_major_industry($list_of_major_industry_cooptype);
                    $list_majors = $this->load_major($data['coop_info']->cooperative_type_id);
                    $list_subclass = $this->load_subclass($data['coop_info']->cooperative_type_id);
                    $data['load_major'] = $list_majors;
                    $data['load_subclass'] = $list_subclass;

                    $qry_business_act = $this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$this->decoded_id));
                    if($qry_business_act->num_rows()>0)
                    {
                      foreach($qry_business_act->result_array() as $brow)
                      {
                        // $this->debug($brow);
                        $major_id = $brow['major_industry_id'];
                        $brow['major_description_']=$this->amendment_model->major_industry_description2($major_id);
                     
                        $brow['subclass_description_']=$this->major_industry_description_subclass2($brow['subclass_id']);
                       
                        $cooptype_id_array[] = $brow['cooperative_type_id'];
                        $brow['load_major'] =  $list_majors;
                        $brow['load_subclass'] = $list_subclass;
                        $business_data[] =$brow;

                         // $this->debug( $business_data);
                          $data['list_of_major_industry_']= $business_data;

                          // $this->debug( $data['list_of_major_industry_']);
                          
                          foreach($cooptype_id_array as $ctype_id)
                          {
                            $mdata[] = $this->amendment_model->list_of_majorindustry($ctype_id);
                          }
                          unset($ctype_id);
                          $data['mjor_list']=$mdata;
                         
                          foreach($mdata as $m)
                          {
                            //$this->$this->major_industry_description_subclass($['sublcass+i']);
                            $subclass_data[]=$this->amendment_model->list_of_subclasss($m['major_industry_id']);
                          }
                        unset($m);
                         foreach($subclass_data as $sdata){
                          foreach($sdata as $srow)
                          {
                            $list_subclass[]= $this->amendment_model->major_industry_description_subclass($srow['subclass_id']);
                          }
                         }
                         unset($sdata);
                         unset($srow);
                         $data['list_subclass'] = $list_subclass;
                      }
                      unset($brow);
                    }

                  } //end union
                 if($data['coop_info']->common_bond_of_membership=='Occupational')
                 {
                  $existed_composition = explode(',',$data['coop_info']->comp_of_membership);
                  foreach($existed_composition as $com_row)
                  {
                    $list_ofComposition[] = $this->CompositionOfmembers($com_row);
                  }
                  unset($com_row);
                  $data['list_of_comp'] = $list_ofComposition;
                 }

                        $data['list_type_coop'] = $this->coop_type($coopTypeName,$data['coop_info']->category_of_cooperative);
                        // $this->debug($data['list_type_coop']);
                        //cooperative type value
                        $data['amd_type_of_coop'] = $typeName_arr;

                      //end new 

                      $coopType= explode(',',$data['coop_info']->type_of_cooperative);
                       foreach($coopType as $trow)
                       {
                        $list_type[] = $this->coop_type($trow,$data['coop_info']->category_of_cooperative);
                           $list_of_major_industry_cooptype = $this->major_industry_model->get_major_industries_by_type_name($trow);
                           $list_coop_type_id[] =$this->get_coopTypeID($trow); 
                       }
                        $data['cooperative_type'] = $list_type;

                       $data['inssoc'] = explode(",",$data['coop_info']->name_of_ins_assoc);  
                      $data['encrypted_id'] = $id;
                       $data['encrypted_user_id'] = encrypt_custom($this->encryption->encrypt($user_id));
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($data['coop_info']->area_of_operation == 'Interregional'){
                      $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                      } else {
                        $data['regions_list'] = $this->region_model->get_regions();
                      }
                      $data['regions_island_list'] ='';
                      if($data['coop_info']->area_of_operation == 'Interregional'){
                        $data['regions_island_list'] = $this->region_model->get_selected_islands($data['coop_info']->interregional);

                      }
                       $data['date_diff_Reg'] =false;
                      $date_diff_reg = $this->amendment_model->year_registered($data['coop_info']->regNo);
                      if($date_diff_reg>=2)
                      {
                         $data['date_diff_Reg'] = true;
                      }   
                       $data['list_of_provinces'] = $this->amendment_model->get_provinces($data['coop_info']->rCode);
                        $data['list_of_cities'] = $this->amendment_model->get_cities($data['coop_info']->pCode);
                        $data['list_of_brgys'] = $this->amendment_model->get_brgys($data['coop_info']->cCode);
                      $data['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);  
                      $this->load->view('./templates/admin_header', $data);
                      $this->load->view('cooperative/amendment_reservation_update', $data);
                      $this->load->view('./templates/admin_footer', $data);
                    }else{
                      // if(!$this->amendment_model->check_expired_reservation_by_admin($this->decoded_id)){
                        $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID')));
                        $subclass_array = $this->input->post('subClass');
                        $major_industry = $this->input->post('majorIndustry');
                        $field_data = array(
                          'category_of_cooperative' => $this->input->post('categoryOfCooperative'),
                          'proposed_name' => $this->input->post('proposedName'),
                          'type_of_cooperative' => $this->input->post('typeOfCooperative'),
                          'common_bond_of_membership' => $this->input->post('commonBondOfMembership'),
                          'composition_of_members' => $this->input->post('compositionOfMembers'),
                          'composition_of_members_others' => $this->input->post('compositionOfMembersSpecify'),
                          'area_of_operation' => $this->input->post('areaOfOperation'),
                          'refbrgy_brgyCode' => $this->input->post('barangay'),
                          'street' => $this->input->post('streetName'),
                          'house_blk_no' => $this->input->post('blkNo')
                        );
                        if($this->amendment_model->update_not_expired_cooperative_by_admin($this->decoded_id,$field_data,$subclass_array,$major_industry)){
                          $this->session->set_flashdata('cooperative_success', 'Successfully updated this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }else{
                          $this->session->set_flashdata('cooperative_error', 'Unable to update this cooperative basic information.');
                          redirect('amendment/'.$this->input->post('cooperativeID'));
                        }
                      // }else{
                      //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is already expired.');
                      //   redirect('amendment');
                      // }
                    }
                  // }else{
                  //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                  //   redirect('amendment');
                  // }
              //   }else{
              //     $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to update is not yet submitted for evaluation.');
              //     redirect('amendment');
              //   }
              // }else{
              //   $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
              //   redirect('amendment');
              // }
            // }
          }
        }else{
          show_404();
        }
      
    }

    public function view($id = null){
     $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $this->load->model('amendment_union_model');
        $this->load->model('amendment_affiliators_model','affiliator_model');
         $this->load->model('Payment_model');
         $this->load->model('admin_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $coop_id = $this->amendment_model->coop_dtl($this->decoded_id);
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
              // $data['gad_count'] = $this->committee_model->get_all_gad_count($user_id);
              $data['client_info'] = $this->user_model->get_user_info($user_id);
              $data['title'] = 'Amendment Details';
              $data['header'] = 'Amendment Information';
              $data['coop_info'] = $this->amendment_model->get_cooperative_info($coop_id,$user_id,$this->decoded_id);
              $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);
              $data['is_from_updating'] =$this->amendment_model->is_from_updating($data['coop_info']->regNo);
              $data['bylaw_doc_complete'] = true;
               $data['articles_doc_complete'] =true;
              if($data['is_from_updating'])
              {

                if($data['coop_info']->custom_acbl==1){
                  $data['acbl'] = $this->amendment_model->get_acbl($this->decoded_id,$data['coop_info']->category_of_cooperative);
                   if($data['acbl']['articles'])
                   {
                       $data['articles_doc_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,41);
                   }
                   if($data['acbl']['bylaws'])
                   {
                        $data['bylaw_doc_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,40);
                 
                   }
                }

                 
              
              }
              $data['coop_type_compare'] = false;
              if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
              {
                 $data['coop_type_compare'] = true;
              }
              
              $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
              $complete_upload = array();
              foreach($data['coop_type'] as $coopRow)
              {
                if($this->check_is_uploaded($this->decoded_id,$coopRow['document_num']))
                {
                $coopRow['status']='true';
                }
                else
                {
                $coopRow['status']='false';
                }
                $complete_upload[]= $coopRow['status'];
              }
              unset($coopRow);

              $data['ga_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,19);
              $data['bod_sec_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,20);
              // echo $this->db->last_query();exit;
              if($data['coop_type_compare'])
              {
              $data['status_document_cooptype'] = true;
              }
              else
              {
                if(in_array('false', $complete_upload))
                {
                $data['status_document_cooptype'] = false;
                }
                else
                {
                $data['status_document_cooptype'] = true;
                }
              }
                                
                                
              $data['business_activities'] =  $this->amendment_model->get_all_business_activities($this->decoded_id);

              $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$this->decoded_id) : true;
          
              $data['cooperative_id']=encrypt_custom($this->encryption->encrypt($coop_id));
              $data['encrypted_id'] = $id;
    
      
              $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                switch ($data['coop_info']->category_of_cooperative) {
                   case 'Secondary':
                   case 'Tertiary':
                      $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                      $data['cooperator_complete'] =true;
                      $data['union_complete'] =true;
                      $data['capitalization_complete'] =$this->amendment_capitalization_model->check_capitalization_federation_complete($this->decoded_id);
                     // $this->debug($data['capitalization_complete']);exit;
                     break;
                    
                   case 'Others':
                    $data['union_complete'] = $this->amendment_union_model->is_requirements_complete($this->decoded_id); 
                    
                     $data['cooperator_complete'] =true;
                     $data['affiliator_complete'] = true;
                    break; 
                   default:
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$this->decoded_id);
                       $data['affiliator_complete'] =true;
                        $data['union_complete'] = true;
                        $data['capitalization_complete'] =$this->amendment_capitalization_model->check_capitalization_primary_complete($this->decoded_id);
                     break;
                 }
       
              // if($data['cooperator_complete']==false) {
              //   $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$this->decoded_id);
              // }
              $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id); 
              $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$this->decoded_id); 
             
              // $data['economic_survey_complete'] = $this->amendment_economic_survey_model->check_survey_complete($this->decoded_id);
              
              // $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);

              // $data['document_one'] = $this->uploaded_document_model->get_document_one_info($this->decoded_id);
              // $data['document_two'] = $this->uploaded_document_model->get_document_two_info($this->decoded_id);
              $data['submitted'] = $this->amendment_model->check_submitted_for_evaluation($coop_id,$this->decoded_id);
              $data['members_composition'] =  $this->amendment_model->get_coop_composition($this->decoded_id);
              $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad_amendment($this->decoded_id);
              if($data['committeescount']==0) {
                $data['committeescount'] = $this->amendment_committee_model->get_all_committees_of_coop_gad($this->decoded_id);
              }
                  $in_positions = $this->amendment_committee_model->check_position_($this->decoded_id);
                  $data['election'] = (in_array('Election',$in_positions) ? true: false);
                  $data['credit'] = (in_array('Credit',$in_positions) ? true: false);
                  $data['ethics'] =  (in_array('Ethics',$in_positions) ? true: false);
                  $data['media_concil'] =  (in_array('Mediation and Conciliation',$in_positions) ? true: false);
                  $data['gender_dev'] =  (in_array('Gender and Development',$in_positions) ? true: false);
                  $data['audit'] =  (in_array('Audit',$in_positions) ? true: false);
                         $count_type ='';
                        $type_coop_array_ = explode(',',$data['coop_info']->type_of_cooperative);
                        $count_type = count($type_coop_array_);
                        $data['complete_position']=false; 
                        if($count_type > 1)
                        {
                             if(in_array('Credit', $type_coop_array_) || in_array('Agriculture', $type_coop_array_))
                            { 
                              if($data['credit'] && $data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                            else
                            {
                               $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                            }
                        }
                        else
                        {
                           $data['credit'] = true;
                              if($data['election'] && $data['ethics'] && $data['media_concil'] &&  $data['gender_dev'] && $data['audit'])
                              {
                                $data['complete_position']=true;
                              }
                        }
                        
                        
                        $data['director_comment'] = $this->amendment_model->admin_comment($this->decoded_id,3);
                        $data['have_director_comment'] = $this->amendment_model->admin_comment_value($this->decoded_id,3);
                        $data['deffered_comment'] = $this->amendment_model->client_diferred_comment($this->decoded_id);
                        $data['denied_comment'] = $this->amendment_model->client_denied_comment($this->decoded_id);
                      
                  $data['amendment_capitalization']= $this->amendment_capitalization($this->decoded_id);      
                  $data['name_reservation_fee']=100.00;
                  $data['pay_from']='reservation'; 
                  if($this->Payment_model->get_payment_info_amendment($this->decoded_id)!=NULL)
                  {
                   $data['ref_no'] = $this->Payment_model->get_payment_info_amendment($this->decoded_id)->refNo;
                  }
                  else
                  {
                    $data['ref_no'] = NULL;
                  }
                 
                  $have_amendment = $this->amendment_model->if_had_amendment($data['coop_info']->regNo,$this->decoded_id);
                  if($data['coop_info']->migrated==1)
                  {
                     $have_amendment = $this->amendment_model->if_had_amendment_migrated($data['coop_info']->regNo,$this->decoded_id,$data['coop_info']->amendmentNo);
                  }
                 
                  if($have_amendment)
                  { //next amendment

                    $data['coop_info_orig']= $this->amendment_model->get_last_amendment_info($this->decoded_id,$data['coop_info']->regNo);
                    $data['previous_total_paid_up_capital'] = $this->amendment_capitalization_model->total_amount_of_paid_up_capital($data['coop_info_orig']->id); 
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym.')';
                    }
                    if(count(explode(',',$coop_info_orig->type_of_cooperative))>1)
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' Multipurpose Cooperative '.$acronym;
                    }
                    else
                    {
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                    }
                  }
                  else
                  { //first amendment
                    $data['coop_info_orig']= $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);
                    $coop_info_orig = $data['coop_info_orig'];
                    $acronym='';
                    if(strlen($coop_info_orig->acronym_name)>0)
                    {
                    $acronym='('.$coop_info_orig->acronym_name.')';
                    }
                    $data['orig_proposedName_formated'] = ltrim(rtrim($coop_info_orig->proposed_name)).' '.$coop_info_orig->type_of_cooperative.' Cooperative '.$acronym;
                      $data['previous_total_paid_up_capital'] = $this->amendment_capitalization_model->total_amount_of_paid_up_capital($data['coop_info_orig']->id);
                  }

                   $data['acting_director'] = $this->admin_model->check_director_supervising($data['coop_info']->rCode);
                  //end of download payment   
                  if($data['coop_info']->area_of_operation == 'Interregional'){
                    $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);

                  } 
            
               $data['is_deferred'] = $this->amendment_model->if_past_deffered($this->decoded_id);
             
               
              $this->load->view('./template/header', $data);
              switch ($data['coop_info']->grouping) {
                case 'Federation':
                  $data['affiliator_complete'] = $this->amendment_affiliators_model->is_requirements_complete($this->decoded_id);
                 
                 $this->load->view('amendment/federation/federation_details', $data);

                  break;
                
                default:
                   $this->load->view('cooperative/amendment_details', $data);
                  break;
              }
              $this->load->view('amendment/confirmModal');
              $this->load->view('./template/footer');
          }else{
            $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
            if($this->session->userdata('access_level') == 1 || $this->session->userdata('access_level') == 2){
              if(!$this->amendment_model->check_expired_reservation_by_admin($coop_id,$this->decoded_id)){
                if($this->amendment_model->check_submitted_for_evaluation($coop_id,$this->decoded_id)){
                  $data['title'] = 'Cooperative Details';
                  $data['header'] = 'Cooperative Information';
                  $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                  $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
                  $data['coop_info_primary'] = $this->cooperatives_model->get_cooperative_info_by_admin($coop_id);

                                
                  $data['business_activities'] =  $this->amendment_model->get_all_business_activities($this->decoded_id);
                  $data['members_composition'] =  $this->amendment_model->get_coop_composition($this->decoded_id);
                  $data['bylaw_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_bylaw_model->check_bylaw_primary_complete($coop_id,$this->decoded_id) : true;
                  $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                  $data['encrypted_id'] = $id;
                  $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$this->decoded_id);
                  switch ($data['coop_info']->category_of_cooperative) {
                   case 'Secondary':
                   case 'Tertiary':
                    $data['affiliator_complete'] = $this->affiliator_model->is_requirements_complete($this->decoded_id);
                     $data['cooperator_complete'] =true;
                      $data['union_complete'] =true;
                     break;
                    
                   case 'Others':
                    $data['union_complete'] = $this->amendment_union_model->is_requirements_complete($this->decoded_id);
                     $data['cooperator_complete'] =true;
                     $data['affiliator_complete'] = true;
                    break; 
                   default:
                      $data['cooperator_complete'] = $this->amendment_cooperator_model->is_requirements_complete($coop_id,$this->decoded_id);
                       $data['affiliator_complete'] =true;
                        $data['union_complete'] = true;
                     break;
                 }
                  $data['purposes_complete'] = $this->amendment_purpose_model->check_purpose_complete($coop_id,$this->decoded_id); 
                  // $data['staff_complete'] = $this->amendment_staff_model->requirements_complete($this->decoded_id);
                  // $data['document_one'] = $this->amendment_uploaded_document_model->get_document_one_info($this->decoded_id);
                  // $data['document_two'] = $this->amendment_uploaded_document_model->get_document_two_info($this->decoded_id);
                  $data['capitalization_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_capitalization_model->check_capitalization_primary_complete($this->decoded_id) : true;
                  $data['amendment_id']= $this->decoded_id;
                  $data['coop_type_compare'] = false;
              if($data['coop_info_primary']->type_of_cooperative == $data['coop_info']->type_of_cooperative)
              {
                 $data['coop_type_compare'] = true;
              }
              
              $data['coop_type'] = $this->amendment_model->get_cooperatve_types($data['coop_info']->cooperative_type_id);;
                                
                                $complete_upload = array();
                                foreach($data['coop_type'] as $coopRow)
                                {
                              

                                  if($this->check_is_uploaded($this->decoded_id,$coopRow['document_num']))
                                  {
                                    $coopRow['status']='true';
                                  }
                                  else
                                  {
                                     $coopRow['status']='false';
                                  }
                                  $complete_upload[]= $coopRow['status'];
                                }
                                // $data['status_document_one'] =$this->check_is_uploaded($this->decoded_id,1);
                                // $data['status_document_two'] =$this->check_is_uploaded($this->decoded_id,2);
                                // $data['status_feasibility'] =$this->check_is_uploaded($this->decoded_id,3);
                                // $data['status_books_of_account'] =$this->check_is_uploaded($this->decoded_id,4);
                                $data['ga_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,19);
                                 $data['bod_sec_complete'] = $this->amendment_uploaded_document_model->check_is_uploaded($this->decoded_id,20);
                                if($data['coop_type_compare'])
                                {
                                   $data['status_document_cooptype'] = true;
                                } 
                                else
                                {
                                    if(in_array('false', $complete_upload))
                                    {
                                      $data['status_document_cooptype'] = false;
                                    }
                                    else
                                    {
                                      $data['status_document_cooptype'] = true;
                                    }
                                }
              

                             $data['cds_comment'] = $this->amendment_model->admin_comment($this->decoded_id,1);
                                   
                                   if($data['coop_info']->status ==9 && $data['coop_info']->third_evaluated_by>0 || (($data['coop_info']->status ==11 || $data['coop_info']->status ==10) && $data['coop_info']->third_evaluated_by>0) || ($data['coop_info']->status ==6 && $data['coop_info']->third_evaluated_by>0))
                                   { 
                                      $data['senior_comment'] = $this->amendment_model->get_comment_single($this->decoded_id,2);
                                      $data['director_comment'] =$this->amendment_model->get_comment_single_dir($this->decoded_id,3);
                                      $data['supervising_comment'] =$this->amendment_model->get_comment_single_dir($this->decoded_id,4);
                                      $data['senior_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                      $data['director_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,3);
                                   }
                                   else
                                   {
                                      $data['senior_comment'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                      $data['director_comment'] = $this->amendment_model->admin_comment($this->decoded_id,3);
                                      $data['supervising_comment'] = $this->amendment_model->admin_comment($this->decoded_id,4);
                                       $data['director_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,3); 
                                        $data['senior_comment_array'] = $this->amendment_model->admin_comment($this->decoded_id,2);
                                   }
                                   if($data['coop_info']->status == 17)
                                   {
                                     $data['senior_comment'] = $this->amendment_model->get_comment_single($this->decoded_id,2); 
                                   }
                                    $data['revert_comment_array'] = $this->amendment_model->revert_comment($this->decoded_id);

                                    $data['tool_findings'] = $this->amendment_model->tool_findings($this->decoded_id);
                                    $data['senior_tool_findings'] = $this->amendment_model->senior_tool_findings($this->decoded_id);
                                    $data['supervising_'] = $this->admin_model->is_acting_director($user_id);
                                   
                                    $data['revert_comment_array'] = $this->amendment_model->revert_comment($this->decoded_id);
                                // $this->debug($data['coop_info']);
                                    if($data['coop_info']->area_of_operation == 'Interregional'){
                                      $data['regions_list'] = $this->region_model->get_selected_regions($data['coop_info']->regions);
                                    } 
                  $this->load->view('./templates/admin_header', $data);
                  $this->load->view('cooperative/amendment_details', $data);
                  $this->load->view('amendment/evaluation/approve_modal_cooperative',$data);
                  $this->load->view('amendment/evaluation/deny_modal_cooperative',$data);
                   $this->load->view('amendment/evaluation/revert_modal',$data);
                  $this->load->view('amendment/evaluation/defer_modal_cooperative',$data);
                  $this->load->view('./templates/admin_footer');
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The application you trying to view is not yet submitted for evaluation.');
                  redirect('amendment');
                }
              }else{ 
                $this->session->set_flashdata('redirect_applications_message', 'The cooperative you viewed is already expired.');
                redirect('amendment');
              }
            }
            else
            {
              redirect('admins/login');
            }
          }
        }else{
          show_404();
        }
    }
    
    //json
  public function check_is_uploaded($amendment_id,$document_num)
  {
    $query = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id,'document_num'=>$document_num));
    if($query->num_rows()>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

    public function delete_amendment(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('deleteAmendmentBtn')){
          if($this->session->userdata('client')){
            $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
            $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
            $user_id = $this->session->userdata('user_id');
            if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
              // echo $this->decoded_id;
              if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
                if(!$this->amendment_model->check_submitted_for_evaluation_client($cooperative_id,$this->decoded_id)){
                  $query= $this->db->get_where('users', array('id' => $user_id));
                  $row = $query->row();
                  if(password_verify($this->input->post('password'), $row->password))
                  {
                    
                      //remove uploaded file
                      $this->remove_uploaded_file($this->decoded_id);//remove file
                      $success = $this->amendment_model->delete_cooperative($this->decoded_id);
                      if($success){
                        $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                        redirect('amendment');
                      }else{
                        $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                        redirect('amendment');
                      }
                  }
                  else
                  {
                       $this->session->set_flashdata('list_error_message', 'Unable to Delete. Password not Matched.');
                        redirect('amendment');
                  }
                  
                }else{
                  if(!$this->amendment_model->check_if_denied($this->decoded_id)){
                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                    redirect('amendment/'.$this->input->post('cooperativeID',TRUE));
                  }else{
                      $this->remove_uploaded_file($this->decoded_id); //remove file
                      $success = $this->amendment_model->delete_cooperative($this->decoded_id);
                      if($success){
                        $this->session->set_flashdata('list_success_message', 'Amendment has been deleted.');
                        redirect('amendment');
                      }else{
                        $this->session->set_flashdata('list_error_message', 'Unable to delete cooperative.');
                        redirect('amendment');
                      }
                  }
                }
              }
            }
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              redirect('amendment');
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }

    public function remove_uploaded_file($amendment_id)
    {
      $qry_file = $this->db->get_where('amendment_uploaded_documents',array('amendment_id'=>$amendment_id));
      if($qry_file->num_rows()>0)
      {
        foreach($qry_file->result_array() as $row_file)
        {
        $file=APPPATH.'../uploads/amendment/'.$row_file['filename'];
          if(is_readable($file))
          {
            unlink($file);
          }

        }
      }
    }

    public function evaluate($id = null){
        $this->load->model('amendment_union_model');
        $this->load->model('amendment_affiliators_model');
        $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $user_id = $this->session->userdata('user_id');
        $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
        if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
          if($this->session->userdata('client')){
            if($this->amendment_model->check_own_cooperative($cooperative_id,$this->decoded_id,$user_id)){
              if(!$this->amendment_model->check_expired_reservation($cooperative_id,$this->decoded_id,$user_id)){
                $data['coop_info'] = $this->amendment_model->get_cooperative_info($cooperative_id,$user_id,$this->decoded_id);
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
                      $data['article_complete'] = ($data['coop_info']->category_of_cooperative=="Primary") ? $this->amendment_article_of_cooperation_model->check_article_primary_complete($this->decoded_id) : true;
                      if($data['article_complete']){
                        $data['committees_complete'] = $this->amendment_committee_model->committee_complete_count_amendment($this->decoded_id);
                        if($data['committees_complete']){
                        
                                if($this->amendment_model->check_if_deferred($this->decoded_id)){
                                  if($this->amendment_model->submit_for_reevaluation($user_id,$this->decoded_id,$data['coop_info']->rCode)){
                                    $this->session->set_flashdata('cooperative_success','Successfully resubmitted your application. Please wait again for an e-mail of either the payment procedure or the list of documents for compliance');
                                    redirect('amendment/'.$id);
                                  }else{
                                    $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                    redirect('amendment/'.$id);
                                  }
                                }else{ 
                                    
                                  if(!$this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                                    $success = $this->amendment_model->submit_for_evaluation($user_id,$this->decoded_id,$data['coop_info']->rCode);
                            
                                    if($success){
                                      $this->session->set_flashdata('cooperative_success','Successfully submitted your application. Please wait for an e-mail of either the payment procedure or the list of documents for compliance');
                                      redirect('amendment/'.$id);
                                    }else{
                                      $this->session->set_flashdata('cooperative_error','Unable to submit your application');
                                     redirect('amendment/'.$id);
                                    }
                                  }else{
                                    $this->session->set_flashdata('redirect_message', 'You already submitted this for evaluation. Please wait for an e-mail of either the payment procedure or the list of documents for compliance.');
                                    redirect('amendment/'.$id);
                                  }
                                }
                          
                        }else{
                          $this->session->set_flashdata('redirect_message', 'Please complete first your list of committee.');
                          redirect('amendment/'.$id);
                        }
                      }else{
                        $this->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
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
              }else{
                redirect('amendment/'.$id);
              }
            }else{
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.lll');
              redirect('amendment');
            }
          }
        }else{
          show_404();
        }

    }

    public function payment(){
      $this->decoded_id =  $this->encryption->decrypt(decrypt_custom($this->input->post('coop_id')));
      $data = $this->amendment_model->get_payment_info($this->decoded_id);
      $data->amendment_id = encrypt_custom($this->encryption->encrypt($data->amendment_id));
      echo json_encode($data);
    }

    

    public function specialist(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->post('assignSpecialistBtn')){
          if($this->session->userdata('client')){
            $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
            redirect('amendment');
          }else{
            if($this->session->userdata('access_level')==5){
              redirect('admins/login');
            }else{
              if($this->session->userdata('access_level')!=2){
                $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
                redirect('amendment');
              }else{
                $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id',TRUE)));
                $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
                $user_id = $this->session->userdata('user_id');
                // $admin_info = $this->admin_model->get_admin_info($user_id);
                if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
                  if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                    $decoded_specialist_id = $this->encryption->decrypt(decrypt_custom($this->input->post('specialistID',TRUE)));
                    $coop_full_name = $this->input->post('amdName',TRUE);
                    if((is_numeric($this->decoded_id) && $this->decoded_id!=0) && (is_numeric($decoded_specialist_id) && $decoded_specialist_id!=0)){
                      if($this->amendment_model->check_not_yet_assigned($this->decoded_id)){
                        if($this->amendment_model->assign_to_specialist($this->decoded_id,$decoded_specialist_id)){
                          $this->session->set_flashdata('list_success_message', 'Successfully assigned the application to an validator.');
                          redirect('amendment');
                        }else{
                          $this->session->set_flashdata('list_error_message', 'Unable to assign the application to an evaluator.');
                          redirect('amendment');
                        }
                      }else{
                        $this->session->set_flashdata('redirect_applications_message', 'You already assigned the amendment cooperative to an validator.');
                        redirect('amendment');
                      }
                    }else{
                      show_404();
                    }
                  }else{
                    $this->session->set_flashdata('redirect_applications_message', 'The  you trying to assign to an evaluator is not yet submitted for evaluation.');
                    redirect('amendment');
                  }
                }else{
                  $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is already expired.');
                  redirect('amendment');
                }
              }
            }
          }
        }else{
          redirect('amendment');
        }
      }
    }
    public function approve_cooperative(){
      // if(!$this->session->userdata('logged_in')){
      //   redirect('users/login');
      // }else{
        if($this->input->post('approveCooperativeBtn')){
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $user_id = $this->session->userdata('user_id');
          // $data['is_client'] = $this->session->userdata('client');
          $data['coop_info'] = $this->amendment_model->cooperative_info_admin($this->decoded_id);
          if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
              redirect('amendment');
            }else{
            //   if($this->session->userdata('access_level')==5){
            //     redirect('admins/login');
            //   }else{
                // if(!$this->amendment_model->check_expired_reservation_by_admin($cooperative_id,$this->decoded_id)){
                //   if($this->amendment_model->check_submitted_for_evaluation($cooperative_id,$this->decoded_id)){
                //     if(!$this->amendment_model->check_if_denied($this->decoded_id)){
                      $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2,3,4]);
                      $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                      $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                      $this->amendment_model->check_if_denied_($this->decoded_id);
                      $coop_full_name = $this->input->post('cName',TRUE);
                      $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                      if($this->session->userdata('access_level')==4){
                        // if($this->amendment_model->check_first_evaluated($this->decoded_id)){
                        //   if($this->amendment_model->check_second_evaluated($this->decoded_id)){
                        //     if($this->amendment_model->check_last_evaluated($this->decoded_id)){
                        //       $this->session->set_flashdata('redirect_applications_message', 'Amendment Cooperative already evaluated by a Director/Supervising CDS.');
                        //       redirect('amendment');
                        //     }else{
                              $this->amendment_model->check_first_evaluated_($this->decoded_id);
                              $this->amendment_model->check_second_evaluated_($this->decoded_id);
                              $this->amendment_model->check_last_evaluated_($this->decoded_id,$this->input->post('cooperativeID'));
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $success = $this->amendment_model->approve_by_supervisor($data['admin_info'],$this->decoded_id,$coop_full_name);

                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve Amendment cooperative.');
                                  redirect('amendment');
                                }
                              }else{ 
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                redirect('amendment');
                              }
                        //     }
                        //   }else{
                        //     $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                        //     redirect('amendment');
                        //   }
                        // }else{
                        //   $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                        //   redirect('amendment');
                        // }
                      }else if($this->session->userdata('access_level')==3){
                        // if($this->amendment_model->check_first_evaluated($this->decoded_id)){
                        //   if($this->amendment_model->check_second_evaluated($this->decoded_id)){
                        //     if($this->amendment_model->check_last_evaluated($this->decoded_id)){
                        //       $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.ccc');
                        //       redirect('amendment');
                        //     }else{
                              $this->amendment_model->check_first_evaluated_($this->decoded_id);
                              $this->amendment_model->check_second_evaluated_($this->decoded_id);
                              $this->amendment_model->check_last_evaluated_($this->decoded_id,$this->input->post('cooperativeID'));
                              if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $data_comment ='';
                                
                                $director_info = $this->amendment_model->get_specific_admin_info($user_id);
                                $success = $this->amendment_model->approve_by_director($director_info,$this->decoded_id,$data_comment);
                          
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been approved.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to approve amendment cooperative.');
                                  redirect('amendment');
                                }
                              }else{
                                $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                redirect('amendment');
                              }
                        //     }
                        //   }else{
                        //     $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Senior Cooperative Development Specialist.');
                        //     redirect('amendment');
                        //   }
                        // }else{
                        //   $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated first by a Cooperative Development Specialist II.');
                        //   redirect('amendment');
                        // }
                      }else if($this->session->userdata('access_level')==2){
                        // if($this->amendment_model->check_first_evaluated($this->decoded_id)){
                        //   if($this->amendment_model->check_second_evaluated($this->decoded_id)){
                        //     $this->session->set_flashdata('redirect_applications_message', 'Amendment Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                        //     redirect('amendment');
                        //   }else{
                          $this->amendment_model->check_first_evaluated_($this->decoded_id);
                          
                          $comment = rtrim(ltrim($this->input->post('comment')));
                           $data_comment = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'amendment_id' => $this->decoded_id,
                            'access_level' => $this->session->userdata('access_level'),
                            'status'=> 9,
                            'documents'=> rtrim(ltrim($this->input->post('documents'))),
                            'comment' => $comment,
                            'rec_action' => rtrim(ltrim($this->input->post('recomended_action'))),
                            'tool_findings' => $this->input->post('tool_findings'),
                            'created_at' => date('Y-m-d h:i:s'),
                            'author' => $this->session->userdata('user_id')
                            );
                         
                              $coop_types = $data['coop_info']->type_of_cooperative;
                              $coop_types_arr= explode(',', $coop_types);
                              foreach($coop_types_arr as $rowtype)
                              {
                                $ho[] =$this->amendment_model->checking_ho($rowtype);
                              }
                              //confirm in ho
                              if(in_array('true',$ho))
                              {
                                 $regioncode = '00';
                                 $data['admin_info'] =$this->admin_model->get_senior_info($regioncode);
                                
                              }
                              else
                              {
                                $previous_coop_info = $this->amendment_model->previous_coop_info($data['coop_info']->cooperative_id,$this->decoded_id,$data['coop_info']->regNo);
                                
                                $previous_regions_array = explode(',',$previous_coop_info->regions);
                                 //not in change region
                                 if(in_array($data['coop_info']->rCode,$previous_regions_array))
                                {
                                  
                                  $data['admin_info'] = $this->amendment_model->get_specific_admin_info($user_id);
                                   
                                }
                                else
                                { //in change region
                                  $data['admin_info'] =$this->amendment_model->get_specific_admin_info($user_id); 
                                }
                              }
                            
                           
                            $success = $this->amendment_model->approve_by_senior($data['admin_info'],$this->decoded_id,$coop_full_name,$data_comment);
                            // $this->debug($success);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been submitted.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to submit cooperative.');
                              redirect('amendment');
                            }
                        //   }
                        // }else{
                        //   $this->session->set_flashdata('redirect_applications_message', 'The application must evaluated first by a Cooperative Development Specialist II.');
                        //   redirect('amendment');
                        // }
                      }else{
                        if($this->amendment_model->check_first_evaluated($this->decoded_id)){
                          $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          redirect('amendment');
                        }else{
                          $comment = rtrim(ltrim($this->input->post('comment')));
                          $data_comment = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'amendment_id' => $this->decoded_id,
                            'access_level' => $this->session->userdata('access_level'),
                            'status'=> 6,
                            'documents'=> rtrim(ltrim($this->input->post('documents'))),
                            'comment' => $comment,
                            'rec_action' => rtrim(ltrim($this->input->post('recomended_action'))),
                            'tool_findings' => $this->input->post('tool_findings'),
                            'created_at' => date('Y-m-d h:i:s'),
                            'author' => $this->session->userdata('user_id')
                            );
                          // $this->debug($data_comment);
                          if($this->db->insert('amendment_comment',$data_comment))
                          {
                            $coop_types = $data['coop_info']->type_of_cooperative;
                            $coop_types_arr= explode(',', $coop_types);
                            foreach($coop_types_arr as $rowtype)
                            {
                              $ho[] =$this->amendment_model->checking_ho($rowtype);
                            }
                            //confirm in ho
                            if(in_array('true',$ho))
                            {
                              //true
                               $regioncode = '00';
                               //get senior admin info
                               $data['admin_info_senior'] =$this->admin_model->get_senior_info($regioncode); 
                            }
                            else
                            {
                             
                                 $previous_coop_info = $this->amendment_model->previous_coop_info($data['coop_info']->cooperative_id,$this->decoded_id,$data['coop_info']->regNo);
                                // return $previous_coop_info;
                                $previous_regions_array = explode(',',$previous_coop_info->regions);
                                 //not in change region
                                 if(in_array($data['coop_info']->rCode,$previous_regions_array))
                                {
                                  $data['admin_info_senior'] =$this->admin_model->get_senior_info($data['coop_info']->rCode); 
                                   
                                }
                                else
                                { //in change region
                                  $data['admin_info_senior'] =$this->admin_model->get_senior_info($previous_coop_info->rCode); 
                                }

                                // $data['admin_info_senior'] =$this->admin_model->get_senior_info($data['admin_info']->region_code);
                            }
                            $specialist_info = $this->admin_model->get_admin_info($data['coop_info']->evaluated_by);
                            
                            $success = $this->amendment_model->approve_by_specialist($data['admin_info_senior'],$this->decoded_id,$coop_full_name,$data['coop_info']->type_of_cooperative,$specialist_info);

                        
                            if($success && $this->sendEmail($data['admin_info_senior'],$this->decoded_id,$specialist_info)){
                              $this->session->set_flashdata('list_success_message', 'Amendment Cooperative has been submitted.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to approve cooperative.');
                              redirect('amendment');
                            }

                          }
                          else
                          {
                            $this->session->set_flashdata('list_error_message', 'Failed to approve cooperative.');
                              redirect('amendment');
                          }
                          
                        }
                      }
                //     }else{
                //       $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is already denied.');
                //       redirect('amendment');
                //     }
                //   }else{
                //     $this->session->set_flashdata('redirect_applications_message', 'The cooperative you trying to approve is not yet submitted for evaluation.');
                //     redirect('amendment');
                //   }
                // }else{
                //   $this->session->set_flashdata('redirect_applications_message', 'The amendment cooperative is already expired.');
                //   redirect('amendment');
                // }
              }
            // }
          }else{
            show_404();
          }
        }else{
          redirect('amendment');
        }
      // }
    }

    public function sendEmail($admin_info_senior,$decoded_id,$specialist_info)
    {
      $this->load->model('email_model');
    // $cooperative_id = $this->amendment_model->coop_dtl($decoded_id);
    $amendment_info =$this->amendment_model->get_amendment_info($this->decoded_id);
    $client_qry = $this->db->get_where('users',array('id'=>$amendment_info->users_id));
    $client_info = $client_qry->row();
      $process =0;
      $success = 0;
      foreach($admin_info_senior as $row)
      {$process ++;
        if($this->email_model->sendEmailToSeniorAmendment($row['email'],$client_info,$amendment_info,$specialist_info))
        {
          $success++;
          // return true;
        }
        else
        {
          return false;
        }
      }
     unset($row);
     unset($client_qry);

      if($process == $success &&  $this->email_model->sendEmailtoClientFromCds($client_info,$amendment_info))
      {
        return true;
      }
      unset($client_info);
      unset($amendment_info);
      unset($specialist_info);
      unset($process);
      unset($success);
    }

    // public function sendEmailToSenior($region_code)
    // {
    //   // $data = null;
    //   $senior_info = $this->amendment_model->senior_info($region_code);
      
    //     foreach($senior_info as $row)
    //     {
    //       echo $row['email'];
    //     }
      
    
    // }
    public function deny_cooperative(){
        // if($this->form_validation->run() == TRUE){
          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $user_id = $this->session->userdata('user_id');
          $data['is_client'] = $this->session->userdata('client');
          if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.');
               redirect('amendment/'.$this->decoded_id);
            }else{

                    $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2,3,4]);  
                    $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                    $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                      //if(!$this->cooperatives_model->check_if_denied($this->decoded_id)){
                        $reason_commment = $this->input->post('comment',TRUE);
                        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
                        if($this->session->userdata('access_level')==4){
                          // if($this->cooperatives_model->check_first_evaluated($this->decoded_id)){
                            $this->amendment_model->check_first_evaluated_($this->decoded_id);
                            $this->amendment_model->check_second_evaluated_($this->decoded_id);
                            $this->amendment_model->check_last_evaluated_($this->decoded_id,$this->input->post('cooperativeID'));
                        
                                if(!$this->admin_model->check_if_director_active($user_id)){
                                  $success = $this->cooperatives_model->deny_by_admin($user_id,$this->decoded_id,$reason_commment,3);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                     redirect('amendment/'.$this->decoded_id);
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                     redirect('amendment/'.$this->decoded_id);
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                  redirect('amendment/'.$this->decoded_id);
                                }
                          
                        }else if($this->session->userdata('access_level')==3){

                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                  $comment = rtrim(ltrim($this->input->post('comment')));
                                $data_comment = array(
                                'user_id' => $this->session->userdata('user_id'),
                                'amendment_id' => $this->decoded_id,
                                'access_level' => $this->session->userdata('access_level'),
                                'status'=> 10,
                                'documents'=> rtrim(ltrim($this->input->post('documents'))),
                                'comment' => $comment,
                                'rec_action' => rtrim(ltrim($this->input->post('recomended_action'))),
                                'tool_findings' => $this->input->post('tool_findings'),
                                'created_at' => date('Y-m-d h:i:s'),
                                'author' => $this->session->userdata('user_id')
                                );
                               
                                  $success = $this->amendment_model->deny_by_admin($user_id,$this->decoded_id,$data_comment,3,$data['admin_info']);

                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                   redirect('amendment');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                   redirect('amendment');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('amendment');
                                }
                      
                        }else if($this->session->userdata('access_level')==2){
                            $this->amendment_model->check_first_evaluated_($this->decoded_id);
                            $this->amendment_model->check_second_evaluated_($this->decoded_id);
                            //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Senior Cooperative Development Specialist.');
                            //   redirect('cooperatives');
                            // }else{
                              $success = $this->cooperatives_model->deny_by_admin($user_id,$this->decoded_id,$reason_commment,2);
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                                redirect('amendment');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                                redirect('amendment');
                              }
                       
                        }else{
                          // if($this->cooperatives_model->check_first_evaluated($this->decoded_id)){
                          //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Cooperative Development Specialist II.');
                          //   redirect('amendment');
                          // }else{
                            $this->amendment_model->check_first_evaluated_($this->decoded_id);
                            $success = $this->cooperatives_model->deny_by_admin($user_id,$this->decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been denied.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to deny cooperative.');
                              redirect('amendment');
                            }
                          // }
                        }

            }
          }else{
            show_404();
          }
    }
    public function defer_cooperative(){

          $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('cooperativeID',TRUE)));
          $cooperative_id =   $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
          $user_id = $this->session->userdata('user_id');
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          $data['is_client'] = $this->session->userdata('client');
          $data['coop_info'] = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
          if(is_numeric($this->decoded_id) && $this->decoded_id!=0){
            if($this->session->userdata('client')){
              $this->session->set_flashdata('redirect_applications_message', 'Unauthorized!!.sss');
              redirect('amendment');
            }else{
 
                        $this->auth->authuserLevelAmd($this->session->userdata('access_level'),[1,2,3,4]);
                        $this->amendment_model->check_expired_reservation_by_admin_($this->decoded_id);
                        $this->amendment_model->check_submitted_for_evaluation_($this->decoded_id);
                        $this->amendment_model->check_if_denied_($this->decoded_id);
                        $reason_commment = $this->input->post('comment',TRUE);
                        if($this->session->userdata('access_level')==4){
                              $this->amendment_model->check_first_evaluated_($this->decoded_id);
                              $this->amendment_model->check_second_evaluated_($this->decoded_id);
                              $this->amendment_model->check_last_evaluated_($this->decoded_id,$this->input->post('cooperativeID'));
                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                  $comment = rtrim(ltrim($this->input->post('comment')));
                                  $data_comment = array(
                                  'user_id' => $this->session->userdata('user_id'),
                                  'amendment_id' => $this->decoded_id,
                                  'access_level' => $this->session->userdata('access_level'),
                                  'status'=> 11,
                                  'documents'=> rtrim(ltrim($this->input->post('documents'))),
                                  'comment' => $comment,
                                  'rec_action' => rtrim(ltrim($this->input->post('recomended_action'))),
                                  'tool_findings' => $this->input->post("tool_findings"),
                                  'created_at' => date('Y-m-d h:i:s'),
                                  'author' => $this->session->userdata('user_id')
                                  );
                                
                                  $success = $this->amendment_model->defer_by_admin($user_id,$this->decoded_id,$reason_commment,3,$data_comment);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('amendment');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('amendment');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Director.');
                                  redirect('amendment');
                                }

                        }else if($this->session->userdata('access_level')==3){
                              $this->amendment_model->check_first_evaluated_($this->decoded_id);
                              $this->amendment_model->check_second_evaluated_($this->decoded_id);
                              $check_last_evaluated=  $this->amendment_model->check_last_evaluated_($this->decoded_id,$this->input->post('cooperativeID'));
                             
                              // if($data['coop_info']->status != 17){
                              //   $this->session->set_flashdata('redirect_applications_message', 'Cooperative already evaluated by a Director/Supervising CDS.');
                              //   redirect('amendment');
                              // }else{
                                if($this->admin_model->check_if_director_active($user_id,$data['admin_info']->region_code)){
                                $comment = rtrim(ltrim($this->input->post('comment')));
                                 $data_comment = array(
                                  'user_id' => $this->session->userdata('user_id'),
                                  'amendment_id' => $this->decoded_id,
                                  'access_level' => $this->session->userdata('access_level'),
                                  'status'=> 11,
                                  'documents'=> rtrim(ltrim($this->input->post('documents'))),
                                  'comment' => $comment,
                                  'rec_action' => rtrim(ltrim($this->input->post('recomended_action'))),
                                   'tool_findings' => $this->input->post("tool_findings"),
                                  'created_at' => date('Y-m-d h:i:s'),
                                  'author' => $this->session->userdata('user_id')
                                  );
                                 
                              
                                  $success = $this->amendment_model->defer_by_admin($user_id,$this->decoded_id,$reason_commment,3,$data_comment);
                                  if($success){
                                    $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                    redirect('amendment');
                                  }else{
                                    $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                    redirect('amendment');
                                  }
                                }else{
                                  $this->session->set_flashdata('redirect_applications_message', 'The application must be evaluated by the Supervising CDS.');
                                  redirect('amendment');
                                }
                              // }
                       
                        }else if($this->session->userdata('access_level')==2){
                          $comment = $this->input->post('comment');
                          $data_comment = array(
                                  'user_id' => $this->session->userdata('user_id'),
                                  'amendment_id' => $this->decoded_id,
                                  'access_level' => $this->session->userdata('access_level'),
                                  'status'=> 6,
                                  'documents'=> $this->input->post('documents'),
                                  'comment' => $comment,
                                  'rec_action' => $this->input->post('recomended_action'),
                                  'created_at' => date('Y-m-d h:i:s'),
                                  'author' => $this->session->userdata('user_id')
                                  );

                          if($this->amendment_model->check_first_evaluated($this->decoded_id)){
                            if($data['coop_info']->status ==12)
                            {
                              $data_comment = array(
                                  'user_id' => $this->session->userdata('user_id'),
                                  'amendment_id' => $this->decoded_id,
                                  'access_level' => $this->session->userdata('access_level'),
                                  'status'=> 17,
                                  'documents'=> $this->input->post('documents'),
                                  'comment' => $comment,
                                  'rec_action' => $this->input->post('recomended_action'),
                                  'tool_findings' => $this->input->post('tool_findings'),
                                  'created_at' => date('Y-m-d h:i:s'),
                                  'author' => $this->session->userdata('user_id')
                                  );
             
                               $success = $this->amendment_model->defer_by_admin($user_id,$this->decoded_id,$reason_commment,4,$data_comment);
                    
                              if($success){
                                $this->session->set_flashdata('list_success_message', 'Cooperative has been revert.');
                                redirect('amendment');
                              }else{
                                $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                redirect('amendment');
                              }
                            }
                            else
                            {
              
                                $data_comment = array(
                                  'user_id' => $this->session->userdata('user_id'),
                                  'amendment_id' => $this->decoded_id,
                                  'access_level' => $this->session->userdata('access_level'),
                                  'status'=> 6,
                                  'documents'=> $this->input->post('documents'),
                                  'comment' => $comment,
                                  'rec_action' => $this->input->post('recomended_action'),
                                  'created_at' => date('Y-m-d h:i:s'),
                                  'author' => $this->session->userdata('user_id')
                                  );
                                $success = $this->amendment_model->defer_by_admin($user_id,$this->decoded_id,$reason_commment,2);
                                if($success){
                                  $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                                  redirect('amendment');
                                }else{
                                  $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                                  redirect('amendment');
                                }
                              // }
                            }
                            
                          }else{
                            $this->session->set_flashdata('redirect_applications_message', 'The application must evaluate first by a Cooperative Development Specialist II.');
                            redirect('amendment');
                          }
                        }else{
               
                            $this->amendment_model->check_first_evaluated($this->decoded_id);
                            $success = $this->cooperatives_model->defer_by_admin($user_id,$this->decoded_id,$reason_commment,1);
                            if($success){
                              $this->session->set_flashdata('list_success_message', 'Cooperative has been deferred.');
                              redirect('amendment');
                            }else{
                              $this->session->set_flashdata('list_error_message', 'Unable to defer cooperative.');
                              redirect('amendment');
                            }
                         
                        }
    
            }
          }else{
             // $this->session->set_flashdata('redirect_applications_message', 'No data found.');
             //  redirect('amendment');
            show_404();
          }

    }


    public function type_of_cooperative_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      if(strlen($typeOfCooperative) > 0){
        $typeName = $this->cooperative_type_model->get_cooperative_type_name_by_id($typeOfCooperative);
        if(preg_match('/('.$typeName->name.')/i',$proposedName)){
          $this->form_validation->set_message('coop_name_exists_check', 'Dont include the type of cooperative in your proposed name.');
          return FALSE;
        }else{
          return true;
        }
      }else{
        $this->form_validation->set_message('coop_name_exists_check', 'Please select first your type of cooperative.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $data = array(
        'fieldId'=>"proposedName",
        'fieldValue'=>$proposedName,
        'typeOfCooperative'=> $typeOfCooperative,
      );
      $result = $this->cooperatives_model->is_name_unique($data);
      if($result[1]==true){
        return true;
      }else{
        $this->form_validation->set_message('cooperative_name_exists_check', 'Cooperative Name already exists.');
        return FALSE;
      }
    }
    public function cooperative_name_exists_update_check($proposedName){
      $typeOfCooperative = $this->input->post('typeOfCooperative');
      $cooperativeID = $this->input->post('cooperativeID');
      $status =  $this->encryption->decrypt(decrypt_custom($this->input->post('status')));
      if($status >= 1){
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
          'cooperativeID'=> $this->input->get('cooperativeID'),
        );
        $result = $this->cooperatives_model->is_name_update_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }else{
        $data = array(
          'fieldId'=>"proposedName",
          'fieldValue'=>$proposedName,
          'typeOfCooperative'=> $typeOfCooperative,
        );
        $result = $this->cooperatives_model->is_name_unique($data);
        if($result[1]==true){
          return true;
        }else{
          $this->form_validation->set_message('cooperative_name_exists_update_check', 'Cooperative Name already exists.');
          return FALSE;
        }
      }
    }
    public function cooperative_word_check($proposedName){
      if(preg_match('/(cooperative|cooperatives|kooperatiba|cooperativa|cooperatiba)/i',$proposedName)){
        $this->form_validation->set_message('coop_name_exists_check', 'Please dont include the word cooperative.');
        return false;
      }else{
        return TRUE;
      }
    }
    public function check_coop_name_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
          );
          $result = $this->cooperatives_model->is_name_unique($data);
          echo json_encode($result);
        }else{
          $this->session->set_flashdata('redirect_applications_message', 'Server error code 500.');
          redirect('cooperatives');
        }
      }
    }
    public function check_coop_name_update_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('typeOfCooperative') && $this->input->get('cooperativeID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'typeOfCooperative'=>$this->input->get('typeOfCooperative'),
            'cooperativeID'=> $this->input->get('cooperativeID'),
          );
          $result = $this->amendment_model->is_name_update_unique($data);
          echo json_encode($result);
        }else{
          echo json_encode(array($ajax['fieldId'],false,"Error 500. Server error"));
        }
      }
    }
    public function get_cooperative_info(){
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          // if($this->input->post('id') && $this->input->post('user_id')){
          if($this->input->post('id')){
            $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $decoded_user_id = $this->encryption->decrypt(decrypt_custom($this->input->post('user_id')));
            $cooperative_id = $this->amendment_model->coop_dtl($this->decoded_id);
             $result = $this->amendment_model->get_cooperative_info23($cooperative_id,$this->decoded_id);

            $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
            $this->db->from('business_activities_cooperative_amendment');
            $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
            $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
            $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
            $this->db->where('business_activities_cooperative_amendment.amendment_id', $this->decoded_id);
           $qrys  = $this->db->get();
           $data2 = $qrys->result_array();
            $result->business_activities = $data2;
            unset($decoded_user_id);
            unset($cooperative_id);
            unset($qrys);
            unset($data2);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }

    }
    public function get_cooperative_info_by_admin(){
      if(!$this->session->userdata('logged_in')){
        redirect('admins/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }

    public function load_major($cooperative_type_id)
    {
      $data =null;
      $qry= $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id in({$cooperative_type_id})");
      foreach($qry->result_array() as $row)
      {
        $row['major_description'] =$this->amendment_model->major_industry_description2($row['major_industry_id']);
        // $row['subclass_id'] =$this->g_subclass($row['major_industry_id']);
        $data[] = $row;
      }
      return $data;
    }
    public function load_subclass($cooperative_type_id)
    {
      $data =null;
      $qry= $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where cooperative_type_id in({$cooperative_type_id})");
      foreach($qry->result_array() as $row)
      {
        $row['subclass_descriptions'] = $this->major_industry_description_subclass22($row['subclass_id']);
        $data[] = $row;
      }
      return $data;
    }
    public function business_activity($regNo){
      $data = $this->amendment_model->get_business_activity_coop($regNo);
      echo json_encode($data);
    }
    public function coop_info($regNo){
       $user_id = $this->session->userdata('user_id');
      $datas['client_info'] = $this->user_model->get_user_info($user_id);

                if(strlen($datas['client_info']->regno)<1)
                {
                  $qr =$this->db->query("select application_id from registeredcoop where regNo='$regNo' order by id desc limit 1");
                  foreach($qr->result() as $c)
                  {
                    $cooperative_id = $c->application_id;
                  }

                }
                else
                {
                  //FOR MIGRATED AMENDMENT data
                   $qr =$this->db->query("select amendment_id from registeredamendment where regNo='$regNo' order by id desc limit 1");
                  foreach($qr->result() as $c)
                  {
                    $cooperative_id = $c->amendment_id;
                  }
                }

      if($this->amendment_model->if_had_amendment_new($regNo))
      {

        $a_qty = $this->db->query("select amendment_id from registeredamendment where regNo='$regNo' order by id desc limit 1");
        foreach($a_qty->result() as $a)
        {
          $amendment_id = $a->amendment_id;
        }
         $data = $this->amendment_model->get_amendment($amendment_id);

         // get business activity
         $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
          $this->db->from('business_activities_cooperative_amendment');
          $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative_amendment.industry_subclass_by_coop_type_id','inner');
          $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
          $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
          $this->db->where('business_activities_cooperative_amendment.amendment_id',$amendment_id);
          $qry  = $this->db->get();
          $data2 = $qry->result_array(); 
          $data->business_activities = $data2;
         //end busineess activity
         echo json_encode($data);
      }
      else
      {
        
         $data = $this->amendment_model->get_coop($regNo);
        $this->db->select('major_industry.id as bactivity_id, major_industry.description as bactivity_name, subclass.id as bactivitysubtype_id, subclass.description as bactivitysubtype_name');
          $this->db->from('business_activities_cooperative');
          $this->db->join('industry_subclass_by_coop_type' , 'industry_subclass_by_coop_type.id = business_activities_cooperative.industry_subclass_by_coop_type_id','inner');
          $this->db->join('major_industry', 'major_industry.id = industry_subclass_by_coop_type.major_industry_id','inner');
          $this->db->join('subclass', 'subclass.id = industry_subclass_by_coop_type.subclass_id','inner');
          $this->db->where('business_activities_cooperative.cooperatives_id',$cooperative_id);
          $query = $this->db->get();
          $data2 = $query->result_array();
          $data->business_activities = $data2;
          echo json_encode($data);
      }//end if had amendment
    }
          

    public function composition(){
      $result = $this->amendment_model->get_composition();
      echo json_encode($result);
    }

    public function get_business_activities_of_coop(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->method(TRUE)==="GET"){
          if($this->session->userdata('access_level')==5){
            redirect('admins/login');
          }else{
            redirect('amendment');
          }
        }else{
          if($this->input->post('id')){
            $this->decoded_id = $this->encryption->decrypt(decrypt_custom($this->input->post('id')));
            $result = $this->amendment_model->get_all_subclasses($this->decoded_id);
            echo json_encode($result);
          }else{
            echo json_encode(array('error'=>'Internal Server Error.'));
          }
        }
      }
    }
    public function check_minimum_regular_subscription_amendment(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        if($this->input->get('fieldId') && $this->input->get('fieldValue') && $this->input->get('cooperativesID')){
          $data = array(
            'fieldId'=>$this->input->get('fieldId'),
            'fieldValue'=>$this->input->get('fieldValue'),
            'coop_id'=>$this->input->get('cooperativesID')
          );
          $result = $this->bylaw_model->check_minimum_regular_subscription_amendment($data);
          echo json_encode($result);
        }else{
          show_404();
        }
      }
  	}

  	
  	public function coop_type($existing_type,$category)
  	{
  		if($category == 'Primary')
      { 
        $except_type = array('Bank','Cooperative Bank','Insurance','Multi-Purpose','Federation','Union');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      elseif($category == 'Secondary')
      { 
       $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');

      }
      elseif($category == 'Tertiary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
      else
      {
        $except_type = array('Bank','Insurance','Union');
        $this->db->select('*');
        $this->db->where_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $coop_type = $this->db->get('cooperative_type');
      }
  		foreach($coop_type->result_array() as $row)
  		{
  			$row['amended_type'] = explode(',',$existing_type);
  			$data[] = $row;
  		}
  		return $data;
  	}

  	public function CompositionOfmembers($existing_Composition)
  	{
  		
  		$coop_type = $this->db->get('composition_of_members');
  		foreach($coop_type->result_array() as $row)
  		{
  			$row['amended_composition'] = $existing_Composition;
  			$data[] = $row;
  		}
  		return $data;
  	}

    public function get_specific_CompositionOfmembers()
    {
      $comp_id = $this->input->post('comp_id'); 
      $query= $this->db->get_where('composition_of_members',array('id'=>$comp_id));
      foreach($query->result() as $row)
      {
        $data = $row;
      }
      echo json_encode($data);
    }


    public function composition_of_members_()
    {
      $coopid =$this->input->post('coop_ids');
      $qry=$this->db->query("select members_composition_of_cooperative.coop_id as cooperative_id,composition_of_members.* from members_composition_of_cooperative left join composition_of_members on members_composition_of_cooperative.composition=composition_of_members.id  where members_composition_of_cooperative.coop_id='$coopid'");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data[]=$row;
        }
      }
      else
      {
        $data = NULL;
      }
      echo json_encode($data);
    }

    public function get_major_industry($amended_major_industry)
    {
      $query = $this->db->get('major_industry');
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $row['amended_major_industry'] = $amended_major_industry;
          $data[] = asort($row);
        }
      
      }
      else
      {
        $data =NULL;
      }
        return $data;

    }

    public function get_coopTypeID($type_name)
    {
      // $qry=$this->db->query("select id from cooperative_type where name IN('$type_name')");//'cooperative_type',array('name'=>$type_name));
      $qry = $this->db->select('id')->where_in('name',$type_name)->get('cooperative_type');

      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data = $row['id'];
        }
      }
      else
      {
        $data = NULL;
      }
      return $data;
    }

    public function industry_subclass_per_coop_type($cooptype_ID)
    {
      $data = null;
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id={$cooptype_ID}");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data[]= $row;
        }
      }
      else
      {
        $data;
      }
      return $data;
    }

    public function major_industry_description($major_id)
    {
      $query = $this->db->get_where('major_industry',array('id'=>$major_id));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

    // public function major_industry_description2($major_id)
    // {
    //   $query = $this->db->query("select * from major_industry where id=".$major_id);
    //   if($query->num_rows()>0)
    //   {
    //     foreach($query->result_array() as $row)
    //     {
    //       $data = $row['description'];
    //     }
    //   }
    //   else
    //   {
    //     $data= NULL;
    //   }
    //   return $data;
    // }

    public function major_industry_subclass_id($major_id)
    {
      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }

    public function major_industry_description_subclass3($subclass_id)
    {
      $query = $this->db->query("select description from subclass where id=".$subclass_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    // public function major_industry_description_subclass($subclass_id)
    // {
    //   $query = $this->db->query("select * from subclass where id=".$subclass_id);
    //   if($query->num_rows()>0)
    //   {
    //     foreach($query->result_array() as $row)
    //     {
    //       $data = $row;
    //     }
    //   }
    //   else
    //   {
    //     $data= NULL;
    //   }
    //   return $data;
    // }
    public function major_industry_description_subclass22($subclass_id)
    {
      $query = $this->db->query("select description from subclass where id=".$subclass_id);
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    public function major_industry_description_subclass2($subclass_id)
    {
      $query = $this->db->get_where('subclass',array('id'=>$subclass_id));
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row['description'];
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }
    //AJAX REQUEST
    //for registration
    public function get_major_industry_ajax()
    {
    	$coop_type_id = $this->input->post('cooptype_');
    	$qry = $this->db->query("select distinct industry_subclass_by_coop_type.major_industry_id,major_industry.description from industry_subclass_by_coop_type left join major_industry on industry_subclass_by_coop_type.major_industry_id = major_industry.id where cooperative_type_id='$coop_type_id'");
    	if($qry->num_rows()>0)
    	{
    		foreach($qry->result_array() as $row)
    		{
    			// $row['description'] = $this->major_industry_subclass_id($row['major_industry_id']);
    			$data[] = $row;
    		}
    		echo json_encode($data);
    	}
    }

    public function get_coopTypeID_ajax()
    {
      $coop_type_name = $this->input->post('cooptype_');

      $qry=$this->db->get_where('cooperative_type',array('name'=>$coop_type_name));
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
         $cooptype_id= $row['id'];
        }
        $qry_major_ins_id = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id={$cooptype_id}");
          foreach($qry_major_ins_id->result_array() as $mrow)
          {
            $major_id[] = $mrow['major_industry_id'];
          }
          // $this->debug($major_id);
          foreach($major_id as $row_id_major)
          {
           $major_description[] = $this->major_industry_description_ajax($row_id_major);
           $subclass_ID[] = $this->major_industry_subclass_id_ajax($row_id_major);
          }
          // $this->debug($subclass_ID);
      }
      else
      {
        $data = "no data";
      }
      $major_description = array_filter($major_description);
     echo json_encode(array_filter($major_description));
    }

    //for update
    public function major_industry_ajax_()
    {
      // $amendment_id= $this->encryption->decrypt(decrypt_custom($this->input->post('ids')));
       $amendment_id =96;
      $qry=$this->db->get_where('business_activities_cooperative_amendment',array('amendment_id'=>$amendment_id));
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $data_cooperative_type_id[] = $row['cooperative_type_id'];
          $data[] = $row;
        }
        foreach($data_cooperative_type_id as $row_cid)
        {
          
          $mj[]=$this->amendment_model->list_of_majorindustry($row_cid);
        }
        echo json_encode($mj);
      }
      
    }
    //end updata
    //list of major industry
    public function list_of_majorindustry2($cooperativetype_id)
    {
      $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id='$cooperativetype_id'");
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['major_description'] = $this->amendment_model->major_industry_description2($row['major_industry_id']);
          $data[] =$row;
        }
        return $data;
      }

    }
    //list of major subclass 

    // //list of major industry
    // public function list_of_majorindustry($cooperativetype_id)
    // {
    //   $qry = $this->db->query("select distinct major_industry_id from industry_subclass_by_coop_type where cooperative_type_id='$cooperativetype_id'");
    //   if($qry->num_rows()>0)
    //   {
    //     foreach($qry->result_array() as $row)
    //     {
    //       $row['major_description'] = $this->major_industry_description2($row['major_industry_id']);
    //       $data =$row;
    //     }
    //     return $data;
    //   }

    // }
    //list of major subclass 
    // public function list_of_subclasss($major_id)
    // {
    //   $qry = $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where major_industry_id=".$major_id);
    //   // return $this->db->last_query();
    //   if($qry->num_rows()>0)
    //   {
    //     foreach($qry->result_array() as $row)
    //     {
    //       // $row['subclass_description']= $this->major_industry_description_subclass($row['subclass_id']);
    //       $data[] =$row;
    //     }
    //     return $data;
    //   }

    // }
    //list of major subclass per coop type
    public function list_of_subclasss_per_coop_type($cooperative_type_id)
    {
      $qry = $this->db->query("select distinct subclass_id from industry_subclass_by_coop_type where cooperative_type_id=".$cooperative_type_id);
      // return $this->db->last_query();
      if($qry->num_rows()>0)
      {
        foreach($qry->result_array() as $row)
        {
          $row['subclass_description']= $this->major_industry_description_subclass22($row['subclass_id']);
          $data[] =$row;
        }
        return $data;
      }

    }

    public function major_industry_subclass_id_ajax($major_id)
    {
      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return $data;
    }


     public function major_industry_description_ajax($major_id)
    {
      $query = $this->db->query("select id,description from major_industry where id={$major_id}");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $data = $row;
        }
      }
      else
      {
        $data= NULL;
      }
      return array_filter($data);
    }

    public function major_industry_description_subclass_ajax()
    {
    $id_subclass= $this->input->post('major_types');

      $query = $this->db->query("select subclass_id from industry_subclass_by_coop_type where major_industry_id='$id_subclass'");
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $row)
        {
          $sub_class_id[] = $row['subclass_id'];
        }
        unset($row);
        unset($query);
        foreach($sub_class_id as $index=> $row_subclass_id)
        {
        	$query_subclass = $this->db->query("select id as sub_class_id,description as subclass_description from subclass where id={$row_subclass_id}");
        	if($query_subclass->num_rows()>0)
        	{
        		foreach($query_subclass->result_array() as $row_subclass)
        		{
        			$data[]=$row_subclass;
        		}
        	}
        }
        unset($sub_class_id);
        unset($query_subclass);
        unset($row_subclass_id);
        unset($row_subclass);
        unset($query_subclass);
      } 
      echo json_encode($data);
    // die();
    }

    public function get_specific_subclassAjax()
    {
    	$id = $this->encryption->decrypt(decrypt_custom($this->input->post("amd_id"))); 
    	$qry = $this->db->query("select amt_baca.*, industry_subclass_by_coop_type.id as ins_id, industry_subclass_by_coop_type.major_industry_id as ins_major_ins_id, industry_subclass_by_coop_type.subclass_id as ins_subclass_id,subclass.description as subclass_description from business_activities_cooperative_amendment as amt_baca left join industry_subclass_by_coop_type on amt_baca.industry_subclass_by_coop_type_id= industry_subclass_by_coop_type.id left join subclass on industry_subclass_by_coop_type.subclass_id=subclass.id where amt_baca.amendment_id='$id'");
    	if($qry->num_rows()>0)
    	{
    		foreach($qry->result() as $row)
    		{
    			echo json_encode($row);
    		}
    	}
    	// echo json_encode($id);
    }

    public function cooperative_type_ajax()
    {
      // $this->db->order_by("name", "asc");
      // $qry = $this->db->get('cooperative_type');
      // if($qry->num_rows()>0)
      // {
      //   foreach($qry->result_array() as $row)
      //   {
      //     $data[] = $row;
      //   }
      // }
      // echo json_encode($data);
      $category =  $this->input->post('category');
      if($category == 'Primary')
      { 
        $except_type = array('Bank','Cooperative Bank','Insurance','Multi-Purpose','Federation','Union');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      elseif($category == 'Secondary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      elseif($category == 'Tertiary')
      { 
        $except_type = array('Bank','Insurance','Union','Multi-Purpose','Federation');
        $this->db->select('*');
        $this->db->where_not_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      else
      {
        $except_type = array('Bank','Insurance','Union');
        $this->db->select('*');
        $this->db->where_in('name',$except_type);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
      
    }
    //END AJAX REQUEST

    public function load_coop_type_ajax()
    {
      $category =  $this->input->post('category');
      if($category == 'Primary')
      { 
        $this->db->select('*');
        $this->db->where_not_in('name', 'Cooperative Bank');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('cooperative_type');
        foreach($query->result_array() as $row)
        {
          $data[] = $row;
        }
        echo json_encode($data);
      }
    }

    public function check_amendment_name_exists(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        ini_set('memory_limit', '-1');
        $data=true;
        $acronym = $this->input->get('acronym_names');
        $proposed_name = $this->input->get('fieldValue');
        $regNo = $this->input->get('regNo');
        $type_of_coop_id = $this->input->get('typeOfCooperative_value');
        $qry = $this->db->query("select regNo,CONCAT(proposed_name,' ',acronym) as reg_propose_name,cooperative_type_id from amend_coop where status =15 or status =14");

        if($qry->num_rows()>0)
        {
            foreach($qry->result_array() as $row)
            {
              $reg_regNo = $row['regNo'];
              $reg_proposed_name = ltrim(rtrim($row['reg_propose_name']));
              $reg_cooperative_type_id = $row['cooperative_type_id'];
              if(strcasecmp($reg_regNo, $regNo)>0 && strcasecmp($proposed_name,ltrim(rtrim($reg_proposed_name)))==0 && strcasecmp($reg_cooperative_type_id, $type_of_coop_id)==0)
              {
                 $data = false;
                 echo  json_encode(array($this->input->get("fieldId"),$data));
                 exit;
              }
            }
            unset($row);
        }

         $qrow = $this->db->query("SELECT coop.id as cooID,r.regNo,coop.proposed_name,coop.acronym_name,cooperative_type.id AS type_id,coop.type_of_cooperative FROM registeredcoop AS r LEFT JOIN cooperatives coop ON coop.id = r.application_id LEFT JOIN cooperative_type ON cooperative_type.name = coop.type_of_cooperative WHERE  coop.status =15 or coop.status=14");
         foreach($qrow->result_array() as $arow)
         {
            $reg_coop_regNo = $arow['regNo'];
            $reg_coop_proposed_name = $arow['proposed_name'];
            $reg_acronym = $arow['acronym_name'];
            $reg_coop_type_of_coop_id = $arow['type_id'];
            if(strcasecmp($reg_coop_regNo, $regNo)>0 && strcasecmp(rtrim(ltrim($reg_coop_proposed_name)), rtrim(ltrim($proposed_name)))==0 && strcasecmp($type_of_coop_id,$reg_coop_type_of_coop_id)==0 && strcasecmp($reg_acronym,  $acronym)==0)
            {
              $data = false;  
            }  
         }
         unset($arow);
         echo json_encode(array($this->input->get("fieldId"),$data));
           

      }
    }

    public  function doThis($reg_coop_regNo,$reg_coop_proposed_name,$reg_acronym,$reg_coop_type_of_coop_id)
    {
      if(strcasecmp($reg_coop_regNo, $regNo)>0 && strcasecmp($reg_coop_proposed_name, $proposed_name)==0 && strcasecmp($type_of_coop_id,$reg_coop_type_of_coop_id)==0 && strcasecmp($reg_acronym,  $acronym)==0)
      {
        return false;   
      }
        return true;
    }

    public function check_amendment_name_exists_coop_table()
    {
       ini_set('memory_limit', '-1');
        $data=true;
        $acronym = $this->input->get('acronym_names');
        $proposed_name = strtolower($this->input->get('fieldValue').' '.$acronym);
        $regNo = $this->input->get('regNo');
        $type_of_coop_id = $this->input->get('typeOfCooperative_value');
        echo json_encode(array($this->input->get("fieldId"),$data));
    }

    public function amendment_info()
    {
    	$amendment_id = $this->encryption->decrypt(decrypt_custom($this->input->post('amd_id')));
    	$result = $this->amendment_model->amendment_info($amendment_id);
    	echo json_encode($result);
    }

    // public function coop_capitalization($cooperative_id)
    // {
    //   $data =null;
    //   $qry =$this->db->query("select * from capitalization where cooperatives_id='$cooperative_id'");
    //   if($qry->num_rows()>0)
    //   {
    //     $data = $qry->row();
    //   }
    //   return $data;
    // }
    public function amendment_capitalization($amendment_id)
    {
      $qry =$this->db->query("select * from amendment_capitalization where amendment_id='$amendment_id'");
      if($qry->num_rows()>0)
      {
        $data = $qry->row();
      }
      else
      {
        $data  ='No data found.';
      }
      return $data;
    }

  public function orderPaymentNo($amendment_id)
  {
     $amendment_info = $this->amendment_model->get_cooperative_info_by_admin($amendment_id);
      $query= $this->db->query("select refNo from payment where refNo is not NULL order by id desc limit 1");
      foreach($query->result() as $row)
      {
       if(strlen($row->refNo)>0)
       {
        return $row->refNo;
        $last_ref = substr($row->refNo, -1,1) +1;
       }
       else
       {
        $last_ref =1;
       }
       
      }
      unset($row);
      $region_code =substr($amendment_info->rCode,1);
     $ref_no =$region_code.'-'.date('Y-m',now('Asia/Manila')).'-'.$last_ref;
  }

  public function debug($array)
  {
    		echo"<pre>";
    		print_r($array);
    		echo"</pre>";
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
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#" style="height:3.5rem;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config); 
        $links = $this->pagination->create_links();
        return $links;
    }

  }
 ?>
