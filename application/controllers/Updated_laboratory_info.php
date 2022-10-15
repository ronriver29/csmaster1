<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Updated_laboratory_info extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->library('pagination');
      $this->load->library('pagination');
      $this->load->model('admin_model');
      $this->load->model('region_model');
      $this->load->model('cooperatives_update_model');
      $this->load->model('laboratory_update_model');
      //Codeigniter : Write Less Do More
    }
    public function index(){
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $data['is_client'] = $this->session->userdata('client');
        
          $data['title'] = 'Updated Laboratory Information';
          $data['header'] = 'Updated Laboratory Information';
          $data['admin_info'] = $this->admin_model->get_admin_info($user_id);
          
          $this->benchmark->mark('code_start');
            if($data['admin_info']->region_code=="00"){
            //   // Registered Coop Process by Head Office
            //     $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
            //   // End Registered Coop Process by Head Office
            //   $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
            //   $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_senior($data['admin_info']->region_code);
            //   $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);

            // Head Office
              // $data['list_cooperatives_registered'] = $this->cooperatives_update_model->get_all_cooperatives_registration_ho($data['admin_info']->region_code);
              $data['list_branches'] = '';
              
              if($this->input->post('submit')) {
                $coopname = $this->input->post('coopname');
                $limit = $this->input->post('limit');

                $array =array(
                'url'=>base_url()."updated_branch_info",
                'total_rows'=>$this->laboratory_update_model->get_all_updated_lab_info_count($data['admin_info']->region_code,$coopname),
                'per_page'=>$config['per_page']=4,
                'url_segment'=>2
                );
                if(isset($_GET['per_page'])){
                  $per_page = $_GET['per_page'];
                } else {
                  $per_page = 0;
                }
                $data['links']=$this->paginate($array);
                $data['list_branches'] = $this->cooperatives_update_model->get_all_updated_coop_info_ho2($data['admin_info']->region_code,$coopname,$limit);
              }
              // $data['list_cooperatives_defer_deny'] = $this->cooperatives_update_model->get_all_cooperatives_by_senior_defer_deny($data['admin_info']->region_code);
            } else {
            //   // Registered Coop Process by Head Office
            //     $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
            //   // End Registered Coop Process by Head Office

            // Head Office
              // $data['list_cooperatives_registered'] = $this->cooperatives_update_model->get_all_cooperatives_registration($data['admin_info']->region_code);
              $data['list_branches'] = '';

              if($this->input->post('submit')) {
                $coopname = $this->input->post('coopname');
                $limit = $this->input->post('limit');

                $array =array(
                'url'=>base_url()."updated_cooperative_info",
                'total_rows'=>$this->laboratory_update_model->get_all_updated_lab_info_count($data['admin_info']->region_code,$coopname),
                'per_page'=>$config['per_page']=4,
                'url_segment'=>2
                );
                if(isset($_GET['per_page'])){
                  $per_page = $_GET['per_page'];
                } else {
                  $per_page = 0;
                }
                $data['links']=$this->paginate($array);
                $data['list_branches'] = $this->laboratory_update_model->get_all_updated_Lab_info2($data['admin_info']->region_code,$coopname,$limit,$per_page);
                // echo $this->db->last_query();
              }
              // $data['list_cooperatives_defer_deny'] = $this->cooperatives_update_model->get_all_cooperatives_by_senior_defer_deny($data['admin_info']->region_code);
              // $data['list_specialist'] = $this->admin_model->get_all_specialist_by_region($data['admin_info']->region_code);
            }
          $this->benchmark->mark('code_end');
          $data['resources'] = array('elapstime'=>$this->benchmark->elapsed_time('code_start', 'code_end'),'memory usage'=>$this->benchmark->memory_usage()); 
    }
          $this->load->view('templates/admin_header', $data);
          $this->load->view('applications/list_of_updated_lab_info', $data);
          $this->load->view('applications/assign_admin_modal');
          $this->load->view('templates/admin_footer');
        
    }

    public function paginate($array)
    {
      // $result =null;
        $config["base_url"] = $array['url'];
        $config["total_rows"] =$array['total_rows'];
        $config["per_page"] = $array['per_page'];
        $config["uri_segment"] = $array['url_segment'];
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">asfasd<span class="page-link">';
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
}