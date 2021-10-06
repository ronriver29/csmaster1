<?php
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');

class coc extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('user_model', 'user');
  }

  function index($id = null){
    if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }else{
        $user_id = $this->session->userdata('user_id');
        $decoded_id = $this->encryption->decrypt(decrypt_custom($id));
        $coop_info = $this->cooperatives_model->get_registeredcoop_coc($decoded_id);
        $data['admin_info'] = $this->admin_model->get_admin_info($user_id);

        if($data['admin_info']->region_code=="00"){
          // Registered Coop Process by Head Office
            $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
          // End Registered Coop Process by Head Office
          $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_ho_director($data['admin_info']->region_code);
          $data['list_specialist'] = $this->admin_model->get_inspector($data['admin_info']->region_code);
        } else {
          // Registered Coop Process by Head Office
            $data['list_cooperatives_registered_by_ho'] = $this->cooperatives_model->get_all_cooperatives_registration_by_ho($data['admin_info']->region_code); 
          // End Registered Coop Process by Head Office
          $data['list_cooperatives_registered'] = $this->cooperatives_model->get_all_cooperatives_registration($data['admin_info']->region_code);
          $data['list_cooperatives'] = $this->cooperatives_model->get_all_cooperatives_by_director($data['admin_info']->region_code);
          $data['list_specialist'] = $this->admin_model->get_inspector($data['admin_info']->region_code);
        }

        $data1['coop'] = $user_id;
        $data1['region_code'] = str_replace('0', '',$data['admin_info']->region_code);
        $data1['registered_no'] = $coop_info->regNo;
        // $data1['coc_number'] = 01;

        $this->db->select('*');
        $this->db->from('signatory');
        $this->db->where('region_code',$data['admin_info']->region_code);
        $this->db->where('active',1);
        $query = $this->db->get();
        $signatorys = $query->row();
        // echo json_encode($query->num_rows());
        $data1['coopName'] = $coop_info->coopName;

        if($query->num_rows() != 0){
          if($coop_info->noStreet == ''){
            $noStreet = '';
          } else {
            $noStreet = $coop_info->noStreet.' ';
          }

          if($coop_info->Street == ''){
            $street = '';
          } else {
            $street = $coop_info->Street.', ';
          }

          $region2 = preg_replace("/\([^)]+\)/","",$coop_info->region); // 'ABC '

          $data1['extension'] = $region2.' Office';
          $data1['address'] = $noStreet.$street.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province.', '.$coop_info->region;

          $timestamp = str_replace('-', '/', $coop_info->date_of_or);
          $data1['date_registered'] = date('F d, Y',strtotime($timestamp));

          $data1['validity'] = date('Y') + 1;

          $data1['full_name'] = $signatorys->signatory;

          $data1['signatory'] = $signatorys->signatory_designation;

          $data1['issued'] = $coop_info->date_of_or;

          $report_exist = $this->db->where(array('regNo'=>$coop_info->regNo,'coopName'=>$coop_info->coopName))->get('coopris_report');
          if($report_exist->num_rows()==0){

            $this->db->select('*');
            $this->db->from('coopris_report');
            $series = $this->db->count_all_results();
            $series = $series + 1;

            $data1['coc_number'] = $series;

            $coc_number = 'N-'.$data1['region_code'].'-'.date("Y",strtotime($data1['date_registered'])).'-'.$series;

            $data1['coc_number'] = $coc_number;

            $data_field = array(
              'regNo' => $coop_info->regNo,
              'coopName' => $coop_info->coopName,
              'application_id' => $decoded_id,
              'signatory' => $signatorys->signatory_designation,
              'full_name' => $signatorys->signatory,
              'validity' => $data1['validity'],
              'coc_number' => $coc_number
            );

            $success = $this->cooperatives_model->insert_coc_report($data_field);
            
          } else {

            $this->db->select('*');
            $this->db->from('coopris_report');
            $this->db->where('regNo',$coop_info->regNo);
            $this->db->where('coopName',$coop_info->coopName);
            $query = $this->db->get();
            $coc_number_update = $query->row();

            // print_r($coc_number_update);
            $data1['coc_number'] = $coc_number_update->coc_number;

            // $data_field = array(
            //   'regNo' => $coop_info->regNo,
            //   'coopName' => $coop_info->coopName,
            //   'application_id' => $decoded_id,
            //   'signatory' => $signatorys->signatory_designation,
            //   'full_name' => $signatorys->signatory,
            //   'validity' => $data1['validity'],
            //   // 'coc_number' => $coc_number
            // );

            // $success = $this->cooperatives_model->update_coc_report($coop_info->regNo,$coop_info->coopName,$data_field);
          }

          $data1['region_code'] = 'asdasdasdsad';
          // $this->load->view('report/coc_view','');

            // $html2 = $this->load->view('report/coc_view', $data1);

              $html2 = $this->load->view('report/coc_view', $data1, TRUE);
              $J = new pdf();
              $J->set_option('isRemoteEnabled',TRUE);
              $J->setPaper(array(0,0,595.28,841.89), 'landscape');
              $J->load_html($html2);
              $J->render();
              $J->stream("certificate.pdf", array("Attachment"=>0));
        } else {
          $this->session->set_flashdata('delete_admin_success', 'Signatory not Assigned. Please Contact System Administrator!');
          redirect('cooperatives');
        }
      }
  }
}