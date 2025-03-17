<?php

use Dompdf\Options;

defined('BASEPATH') OR exit('No direct script access allowed');



class Amendment_registration extends CI_Controller{
public $decoded_id =null;
  public function __construct()
  {
    parent::__construct();

    //Codeigniter : Write Less Do More

  
    $this->load->model('user_model', 'user');
    $this->load->model('amendment_model');
    $this->load->library('ci_qr_code');
    $this->config->load('qr_code');
    $this->load->model('Amendment_registration_model','amendment_registration_model');
  }



  function index($id = null){
    if(!$this->session->userdata('logged_in')){
      redirect('users/login');
    }else{
        $this->load->library('pdf');
        $this->load->model('amendment_model');
        $this->load->model('charter_model');
        $this->load->model('registration_model');
        $this->load->model('amendment_bylaw_model');
        $this->load->model('amendment_capitalization_model');
        $this->load->model('amendment_cooperator_model');
        $this->load->model('amendment_purpose_model');
        $this->load->model('cooperatives_model');
        $this->load->model('capitalization_model');
        $this->load->model('cooperator_model');
        $this->load->model('bylaw_model');
      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));
      $user_id = $this->session->userdata('user_id');
       $cooperative_id =$this->amendment_model->coop_dtl($this->decoded_id);
      //add to registered cooop
      $coop_info = $this->amendment_model->get_cooperative_info_by_admin_payment($this->decoded_id);
      if ($coop_info->category_of_cooperative =='Primary')
          $pst="1";
      else if ($coop_info->category_of_cooperative =='Secondary')  
        $pst="2";
      else
        $pst="3";

      $rCode = $coop_info->rCode;
      $x=$this->amendment_registration_model->registered_coop_count()+1;
      $j='9520-'.$pst.$rCode;
      for($a=strlen($x);$a<8;$a++) 
      $j=$j.'0';
      $j=$j.$x;
      unset($a);

      // $amendment_no = $this->amendment_registration_model->get_last_reg_amendment($coop_info->regNo);
      if(!$this->amendment_registration_model->in_registeredamendment($this->decoded_id))
      {
        $type_Coop = '';
        $acronym ='';
        if(strlen($coop_info->acronym)>0)
        {
          $acronym = ' ('.$coop_info->acronym.')';
        }
        if(count(explode(',',$coop_info->type_of_cooperative))>1)
        {

          $type_Coop = 'Multipurpose Cooperative'.$acronym;
        }
        else
        {
          $type_Coop = $coop_info->type_of_cooperative.' Cooperative'.$acronym;
        }

      $data_reg = array(

              'coopName'=>$coop_info->proposed_name.' '.$type_Coop,

              'acronym'=> $acronym,

              'regNo'=> $coop_info->regNo,

              // 'amendment_no'=>$amendment_no,

              'category'=> $coop_info->category_of_cooperative,

              'type'=> $coop_info->type_of_cooperative,

               'date_printed'=> date('Y=m-d',now('Asia/Manila')),

              'dateRegistered'=>$coop_info->dateRegistered,

              'commonBond'=> $coop_info->common_bond_of_membership,

              'areaOfOperation'=>$coop_info->area_of_operation,

              'noStreet'=> $coop_info->house_blk_no,

              'Street' => $coop_info->street,

              'addrCode'=> $coop_info->refbrgy_brgyCode,

              'compliant'=>'Compliant',

              // 'qr_code'=>$j,

              'cooperative_id'=>$coop_info->cooperative_id,

              'amendment_id'=>$this->decoded_id

              );

              $this->amendment_registration_model->register_coop_amendment($this->decoded_id,$data_reg,$pst);

         



      }

       if($coop_info->status == 14)

          {

            $this->db->update('amend_coop',array('status'=>15),array('id'=>$this->decoded_id));

          }

            $cName=$coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping;

            $coop_details = $this->amendment_registration_model->get_coop_info_amendment($this->decoded_id);

           

            if (strlen($coop_details->qr_code)<1 || $coop_info->qr_code='')

            {

              $qr_code_config = array();

              $qr_code_config['cacheable'] = $this->config->item('cacheable');

              $qr_code_config['cachedir'] = $this->config->item('cachedir');

              $qr_code_config['imagedir'] = $this->config->item('imagedir');

              $qr_code_config['errorlog'] = $this->config->item('errorlog');

              $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');

              $qr_code_config['quality'] = $this->config->item('quality');

              $qr_code_config['size'] = $this->config->item('size');

              $qr_code_config['black'] = $this->config->item('black');

              $qr_code_config['white'] = $this->config->item('white');

              $this->ci_qr_code->initialize($qr_code_config);

              // get full name and user details

              // $image_name = $coop_details->regNo . ".png";

              $image_name = $coop_details->regNo."-".$coop_details->amendment_no.".png";

              // create user content

              $codeContents = "Cooperative Name:";

              $codeContents .= $coop_details->coopName;

              $codeContents .= "\n";

              $codeContents .= "Registration No:";

              $codeContents .= $coop_details->regNo."-".$coop_details->amendment_no;

              $codeContents .= "\n";

              $codeContents .= "Date Registered:";

              $codeContents .= $coop_details->dateRegistered;

              $params['data'] = $codeContents;

              $params['level'] = 'H';

              $params['size'] = 2;



              $params['savename'] = $qr_code_config['imagedir'] . $image_name;

              $this->ci_qr_code->generate($params);



              $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;

              if(!$this->save_Qrcode_amendment($this->decoded_id,$image_name))

              {

                echo"Failed to generate QRCode";

                exit;

              }

              else

              {

                // echo"success";

              }

              // echo $this->db->last_query();



            } //end qr code

         // $this->debug( $coop_details);

        

       

        $data1['coop_info']=$coop_details;

        $query_or = $this->db->select('date_of_or')->from('payment')->where(['amendment_id'=>$this->decoded_id])->order_by('id','asc')->limit(1)->get();

        if($query_or->num_rows()>0)

        {

          foreach($query_or->result_array() as $o)

          {

            $date_OR = $o['date_of_or'];

          }
          unset($o);
        }

        else

        {

          $date_OR=now();

        }

        
      
        $data1['date_year']= date('Y',strtotime($date_OR));

        $data1['date_month'] =date('F',strtotime($date_OR));

        $dateDay = date('d',strtotime($date_OR));

        $data1['date_day']=$this->OrdinalIndicator($date_OR);

        $dt_data = substr($data1['date_day'],0,1);

        if($dt_data=="0")

        {

          $data1['date_day']=substr($data1['date_day'],1);

        }

      

        $data1['in_chartered_cities'] =false;

        // $this->debug($data1['coop_info']);

        if($this->charter_model->in_charter_city($coop_info->cCode))

        {

          $data1['in_chartered_cities']=true;

          $data1['chartered_cities'] =$this->charter_model->get_charter_city($data1['coop_info']->cCode);

        }

        

        if($date_OR >= "2025-03-01"){

        // $data1['mydateregistered'] = $coop_details->date_of_or;

        $data1['signature'] = "../assets/img/UsecAR2.png"; 

          $data1['chair'] = $this->registration_model->get_chairman()->chairman;

        } else {

          // $data1['mydateregistered'] = $registereddate;

          $data1['chair'] = $this->registration_model->get_chairman2()->chairman;

          $data1['signature'] = "../assets/img/AsecJoy.png"; 

        }    

          // $this->debug($data1['coop_info']);

          $data1['director']=$this->amendment_registration_model->get_director($coop_details->rCode);

          $data1['bylaw_info'] = $this->amendment_bylaw_model->get_bylaw_by_coop_id($this->decoded_id);

          //bylaws no of pages
          switch ($coop_details->category_of_cooperative) {
            case 'Others':
              $data1['bylaws_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'bylaws_union');
              $data1['articles_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'articles_union');
              break;
            case 'Tertiary':
            case 'Secondary':
              $data1['bylaws_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'bylaws_federation');
              $data1['articles_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'articles_federation');
              break;
            
            default:
              $data1['bylaws_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'bylaws');
              $data1['articles_pages'] = $this->amendment_model->no_of_doc($this->decoded_id,'articles');
              break;
          }
         

          $amendment_info = $this->amendment_model->get_cooperative_info_by_admin($this->decoded_id);

          $capitalization_info= $this->amendment_capitalization_model->get_capitalization_by_coop_id($this->decoded_id);

           $in_chartered_cities_orig = false;

          $no_of_bod = $this->amendment_cooperator_model->check_directors_odd_number_amendment($this->decoded_id);

          $purposes =$this->amendment_purpose_model->get_purposes($this->decoded_id);

      

         

          // $this->debug($this->amendment_model->if_had_amendment_for_cor($amendment_info->regNo,$this->decoded_id));

         



          $next_amendment_ = false;

          if($this->amendment_model->if_had_amendment_for_cor($amendment_info->regNo,$this->decoded_id))

          {



            //next amendment

            $next_amendment_ = true;

            $last_amendment_info = $this->amendment_model->get_last_amendment_info($this->decoded_id,$amendment_info->regNo);

            

            $coop_info_orig= $this->amendment_model->get_cooperative_info_by_admin($last_amendment_info->id);

           

            $capitalization_info_orig = $this->amendment_capitalization_model->get_capitalization_by_coop_id($last_amendment_info->id);

            $no_of_bod_orig = $this->amendment_cooperator_model->check_directors_odd_number($last_amendment_info->cooperative_id, $last_amendment_info->id);

            $purposes_orig=$this->amendment_purpose_model->get_purposes($last_amendment_info->id);

            //BYLAW

            $bylaw_info_orig = $this->amendment_bylaw_model->get_bylaw_by_coop_id($last_amendment_info->id);

            if($this->charter_model->in_charter_city($coop_info_orig->cCode))

            {

            $in_chartered_cities_orig=true;

            $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);

            }

            

          }

          else

          { 

            //first amendment  

            $coop_info_orig= $this->cooperatives_model->get_cooperative_info_by_admin($cooperative_id);

            $capitalization_info_orig = $this->capitalization_model->get_capitalization_by_coop_id($cooperative_id);

            $no_of_bod_orig = $this->cooperator_model->check_directors_odd_number($cooperative_id);

            $purposes_orig=$this->amendment_purpose_model->get_purposes2($cooperative_id);

            //BYLAWS

            $bylaw_info_orig = $this->bylaw_model->get_bylaw_by_coop_id($cooperative_id);  

            //END BYLAWS

            if($this->charter_model->in_charter_city($coop_info_orig->cCode))

            {

            $in_chartered_cities_orig=true;

            $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);

            }

          }



            $in_chartered_cities =false;

            if($this->charter_model->in_charter_city($coop_info->cCode))

            {

            $in_chartered_cities=true;

            $chartered_cities =$this->charter_model->get_charter_city($coop_info->cCode);

            }

          
          $data1['acbl']=$this->amendment_model->get_acbl($coop_info->id,$coop_info->category_of_cooperative);

          // if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

          // if($coop_info_orig->house_blk_no==null && $coop_info_orig->street==null) $x=''; else $x=', ';

          // $address = $coop_info->house_blk_no.' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.' '.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region;

          // $address_orig = $coop_info_orig->house_blk_no.' '.ucwords($coop_info_orig->street).$x.' '.$coop_info_orig->brgy.' '.$coop_info_orig->city.', '.$coop_info_orig->province.' '.$coop_info_orig->region;

          // //basic info

          // $data1['typeOfcoop'] = $this->compare_param($amendment_info->type_of_cooperative,$coop_info_orig->type_of_cooperative);

          // $data1['proposeName'] = $this->compare_param($amendment_info->proposed_name,$coop_info_orig->proposed_name);

          // if($next_amendment_)

          // {

          // $data1['acronym_c'] = $this->compare_param($amendment_info->acronym,$coop_info_orig->acronym);

          // }

          // else

          // {

          //     $data1['acronym_c'] = $this->compare_param($amendment_info->acronym,$coop_info_orig->acronym_name);

          // }

        

          // $data1['common_bond'] = $this->compare_param($amendment_info->common_bond_of_membership,$coop_info_orig->common_bond_of_membership);

          // $data1['areaOf_operation'] = $this->compare_param($amendment_info->area_of_operation,$coop_info_orig->area_of_operation);

          // $data1['fieldOfmemship'] = $this->compare_param($amendment_info->field_of_membership,$coop_info_orig->field_of_membership);

          // //capitalization

          // $data1['authorized_share_capital']=$this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);

          // $data1['common_share']= $this->compare_param($capitalization_info->common_share,$capitalization_info_orig->common_share);

          // $data1['preferred_share']= $this->compare_param($capitalization_info->preferred_share,$capitalization_info_orig->preferred_share,$this->decoded_id);

          // $data1['par_value']= $this->compare_param($capitalization_info->par_value,$capitalization_info_orig->par_value);

          // $data1['authorized_share_capital']= $this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);

          // $data1['total_amount_of_subscribed_capital'] = $this->compare_param($capitalization_info->total_amount_of_subscribed_capital,$capitalization_info_orig->total_amount_of_subscribed_capital);

          // // $data1['amount_of_common_share_subscribed']= $this->compare_param($capitalization_info->amount_of_common_share_subscribed,$capitalization_info_orig->amount_of_common_share_subscribed);

          // $data1['amount_of_preferred_share_subscribed'] = $this->compare_param($capitalization_info->amount_of_preferred_share_subscribed,$capitalization_info_orig->amount_of_preferred_share_subscribed);

          // $data1['total_amount_of_paid_up_capital'] =  $this->compare_param($capitalization_info->total_amount_of_paid_up_capital,$capitalization_info_orig->total_amount_of_paid_up_capital);

          // // $data1['amount_of_common_share_paidup'] = $this->compare_param($capitalization_info->amount_of_common_share_paidup,$capitalization_info_orig->amount_of_common_share_paidup);

          // $data1['amount_of_preferred_share_paidup'] =$this->compare_param($capitalization_info->amount_of_preferred_share_paidup,$capitalization_info_orig->amount_of_preferred_share_paidup);

          // //cooperator

          // $data1['no_of_bod'] = $this->compare_param($no_of_bod,$no_of_bod_orig);

          //  //BYLAW

          // $data1['kinds_of_members'] = $this->compare_param($data1['bylaw_info']->kinds_of_members,$bylaw_info_orig->kinds_of_members);

          // $data1['additional_requirements_for_membership'] = $this->compare_param($data1['bylaw_info']->additional_requirements_for_membership,$bylaw_info_orig->additional_requirements_for_membership);

          // $data1['regular_qualifications'] = $this->compare_param($data1['bylaw_info']->regular_qualifications,$bylaw_info_orig->regular_qualifications);

          // $data1['associate_qualifications'] = $this->compare_param($data1['bylaw_info']->associate_qualifications,$bylaw_info_orig->associate_qualifications);

          // $data1['membership_fee'] = $this->compare_param($data1['bylaw_info']->membership_fee,$bylaw_info_orig->membership_fee);



          // $data1['act_upon_membership_days'] = $this->compare_param($data1['bylaw_info']->act_upon_membership_days,$bylaw_info_orig->act_upon_membership_days);

          // $data1['additional_conditions_to_vote'] = $this->compare_param($data1['bylaw_info']->additional_conditions_to_vote,$bylaw_info_orig->additional_conditions_to_vote);  

          // $data1['annual_regular_meeting_day'] = $this->compare_param($data1['bylaw_info']->annual_regular_meeting_day,$bylaw_info_orig->annual_regular_meeting_day);

          // // $data1['annual_regular_meeting_day_date'] = $this->compare_param($data1['bylaw_info']->annual_regular_meeting_day_date,$bylaw_info_orig->annual_regular_meeting_day_date);

          // // $data1['annual_regular_meeting_day_venue'] = $this->compare_param($data1['bylaw_info']->annual_regular_meeting_day_venue,$bylaw_info_orig->annual_regular_meeting_day_venue);

          // $data1['members_percent_quorom'] = $this->compare_param($data1['bylaw_info']->members_percent_quorom,$bylaw_info_orig->members_percent_quorom);

          // $data1['number_of_absences_disqualification'] = $this->compare_param($data1['bylaw_info']->number_of_absences_disqualification,$bylaw_info_orig->number_of_absences_disqualification);

          // $data1['percent_of_absences_all_meettings'] = $this->compare_param($data1['bylaw_info']->percent_of_absences_all_meettings,$bylaw_info_orig->percent_of_absences_all_meettings);

          // $data1['director_hold_term'] = $this->compare_param($data1['bylaw_info']->director_hold_term,$bylaw_info_orig->director_hold_term);

          // $data1['member_invest_per_month'] = $this->compare_param($data1['bylaw_info']->member_invest_per_month,$bylaw_info_orig->member_invest_per_month);

          // $data1['member_percentage_annual_interest'] = $this->compare_param($data1['bylaw_info']->member_percentage_annual_interest,$bylaw_info_orig->member_percentage_annual_interest);

          // $data1['member_percentage_service'] = $this->compare_param($data1['bylaw_info']->member_percentage_service,$bylaw_info_orig->member_percentage_service);

          // $data1['percent_reserve_fund'] = $this->compare_param($data1['bylaw_info']->percent_reserve_fund,$bylaw_info_orig->percent_reserve_fund);

          // $data1['percent_education_fund'] = $this->compare_param($data1['bylaw_info']->percent_education_fund,$bylaw_info_orig->percent_education_fund);

          // $data1['percent_community_fund'] = $this->compare_param($data1['bylaw_info']->percent_community_fund,$bylaw_info_orig->percent_community_fund);

          // $data1['percent_optional_fund'] = $this->compare_param($data1['bylaw_info']->percent_optional_fund,$bylaw_info_orig->percent_optional_fund);

          // $data1['non_member_patron_years'] = $this->compare_param($data1['bylaw_info']->non_member_patron_years,$bylaw_info_orig->non_member_patron_years);

          // $data1['amendment_votes_members_with'] = $this->compare_param($data1['bylaw_info']->amendment_votes_members_with,$bylaw_info_orig->amendment_votes_members_with);

         

          // $data1['minimum_subscribed_share_regular'] =$this->compare_param($capitalization_info->minimum_subscribed_share_regular,$capitalization_info_orig->minimum_subscribed_share_regular);

          // $data1['minimum_paid_up_share_regular'] =$this->compare_param($capitalization_info->minimum_paid_up_share_regular,$capitalization_info_orig->minimum_paid_up_share_regular);

          // $data1['minimum_subscribed_share_associate'] =$this->compare_param($capitalization_info->minimum_subscribed_share_associate,$capitalization_info_orig->minimum_subscribed_share_associate);

          // $data1['minimum_paid_up_share_associate'] =$this->compare_param($capitalization_info->minimum_paid_up_share_associate,$capitalization_info_orig->minimum_paid_up_share_associate);

           

          //  $data1['committees_others'] =  $this->amendment_model->commitee_others($this->decoded_id);

         

          //  //END BYLAW 

          // // $this->debug($purposes_orig); $this->debug($purposes);

          // //purposes under artilces of cooperation

          // $data1['purposes'] =false;

          // $data1['purposes'] = $this->compare_param($purposes_orig->content,$purposes->content);

          // if(strcasecmp($address, $address_orig)!=0)

          // {

          //   $data1['address1'] = 'true';

          // }

          // else

          // {

          //   $data1['address1'] = 'false';

          // }

          

       

          // // $this->debug($coop_info_orig);         

          // set_time_limit(0);

          // $this->load->view('amendment/cor_view', $data1);

          $html2 = $this->load->view('amendment/cor_view', $data1, TRUE);

          $J = new pdf();       

          $J->set_option('isRemoteEnabled',TRUE);

          $J->setPaper('folio', 'portrait');

          $J->load_html($html2);

          $J->render();

          $J->stream("certificate.pdf", array("Attachment"=>0));

    }

  }

  



  public function compare_param($param1,$param2)

  {   

    if(strcasecmp($param1,$param2)!=0)

    {

          return 'true';

    }

    else

    {

          return 'false';

    }  

  }

  public function OrdinalIndicator($dateRegistered)

  {

        $date_day = date('d',strtotime($dateRegistered));

        $num_day= substr($date_day,-1);

        $char_length = strlen($date_day);

        $ordinal_indicator='';

        $nums ='';

        $num_array = array(10,11,12,13,14,15,16,17,18,19,20,30);

        if(in_array($date_day,$num_array))

        {

          $ordinal_indicator ='th';

        }

        else

        {

            switch ($num_day) {

            case 1:

              $ordinal_indicator='st';

              break;

            case 2:

              $ordinal_indicator='nd';

              break;  

            case 3:

              $ordinal_indicator='rd';

              break;

            default:

               $ordinal_indicator='th';

              break;

          }

        }

        

        return $date_day.$ordinal_indicator;//$num_day.$ordinal_indicator;

  }





  function branch($id = null) {

    if(!$this->session->userdata('logged_in')){

      redirect('users/login');

    }else{

      $this->decoded_id = $this->encryption->decrypt(decrypt_custom($id));

      $user_id = $this->session->userdata('user_id');



      //add to registered cooop

      $branch_info = $this->branches_model->get_branch_info_by_admin($this->decoded_id);

      if ($branch_info->category_of_cooperative =='Primary')

          $pst="1";

      else if ($branch_info->category_of_cooperative =='Secondary')  

        $pst="2";

      else

        $pst="3";

      $type=substr($branch_info->branchName, -7);

      

      if ($branch_info->status==20)

        $this->registration_model->register_branch($type,$this->decoded_id,$branch_info->rCode,$pst);

      



        $branch_details = $this->branches_model->get_branch_info_by_admin($this->decoded_id);

        $cName=$branch_details->coopName.' - '.$branch_details->branchName;

        

        

        if ($branch_details->qr_code==null){

          if ($type=='Branch '){

            $label='Certificate of Authority No:'; 

          }else{

            $label='Letter of Authority No:'; 

          }

          $qr_code_config = array();

          $qr_code_config['cacheable'] = $this->config->item('cacheable');

          $qr_code_config['cachedir'] = $this->config->item('cachedir');

          $qr_code_config['imagedir'] = $this->config->item('imagedir');

          $qr_code_config['errorlog'] = $this->config->item('errorlog');

          $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');

          $qr_code_config['quality'] = $this->config->item('quality');

          $qr_code_config['size'] = $this->config->item('size');

          $qr_code_config['black'] = $this->config->item('black');

          $qr_code_config['white'] = $this->config->item('white');

          $this->ci_qr_code->initialize($qr_code_config);



          // get full name and user details

          $image_name = $branch_details->certNo . ".png";



          // create user content

          $codeContents = "Name:";

          $codeContents .= $cName;

          $codeContents .= "\n";

          $codeContents .= $label;

          $codeContents .= $branch_details->certNo;

          $codeContents .= "\n";

          $codeContents .= "Date Registered:";

          $codeContents .= $branch_details->dateRegistered;



          $params['data'] = $codeContents;

          $params['level'] = 'H';

          $params['size'] = 2;



          $params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;

          $this->ci_qr_code->generate($params);



          $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;



          // save image path in tree table

          $this->registration_model->save_branch_qr_code($branch_details->certNo, $image_name);

        }

        

        $data1['chair'] = $this->registration_model->get_chairman()->chairman;

        $data1['branch_info']=$branch_details;

        $data1['director']=$this->registration_model->get_director($user_id)->full_name;

        $data1['type']=$type;

        

        set_time_limit(0);



        $html2 = $this->load->view('cooperative/CA_view', $data1, TRUE);

        $J = new pdf();       

        $J->set_option('isRemoteEnabled',TRUE);

        $J->setPaper('folio', 'portrait');

        $J->load_html($html2);

        $J->render();

        $J->stream("certificate.pdf", array("Attachment"=>0));

      

    }

  }



  public function save_Qrcode_amendment($id,$qr_code)

  {

      if($this->db->update('registeredamendment', array('qr_code'=>$qr_code),array('amendment_id'=>$id)))

      {

          return true;

      }

      else{

        return false;

      }
  }





  public function debug($array)

    {

        echo"<pre>";

        print_r($array);

        echo"</pre>";

    }

}