<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_dev extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {

  }
  public function show_fields_($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
     $header_query = $this->db->query("SELECT DISTINCT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'"); 
      foreach($header_query->result() as $hrow)
      {
        $header_data[] = $hrow->COLUMN_NAME;
      }
      if($this->uri->segment(2)=='show_fields')
      {
        $this->debug($header_data);
      }
      else
      {
        return null;
      }
    }  
  }

  public function show_tables_()
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      $tables=$this->db->list_tables(); 
      if($this->uri->segment(2)=='show_tables')
      {
        foreach($tables as $list_of_tables)
        {
        $this->debug($list_of_tables);
        }
      }
      else
      {
        return null;
      }
    }
  }



  public function select_where($table,$id)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select_where')
      {
        $query = $this->db->query("select * from ".$table." where id =".$id);
        if($query->num_rows()>0)
        {
          $this->debug($query->result_array());
        }
        else
        {
          return "no data found";
        }
      } 
      else
      {
        return null;
      } 
    }

  }

  public function select_where2($table,$id,$limit)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select_where2')
      {
        $query = $this->db->query("select * from ".$table." where id >".$id." limit ".$limit);
        if($query->num_rows()>0)
        {
          $this->debug($query->result_array());
        }
        else
        {
          echo "no data found";
        }
      } 
      else
      {
        return null;
      } 
    }

  }
   public function select_where3($table,$column,$value)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select_where3')
      {
        $query = $this->db->query("select * from ".$table." where ".$column." like '%".$value."%'");
        if($query->num_rows()>0)
        {
          $this->debug($query->result_array());
        }
        else
        {
          echo "no data found";
        }
      } 
      else
      {
        return null;
      } 
    }

  }

  public function delete_data($table,$id)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='delete_data')
      {
        if($this->db->query("delete from ".$table." where id =".$id))
        {
          echo $table." data successfully removed";
        }
        else
        {
          echo"failed to delete data in ".$table;
        }
      } 
      else
      {
        return null;
      } 
    }

  }

  public function qry()
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='qry')
      {
         if(isset($_POST['submit']))
        {
          $query = $this->input->post('qry');
          $q = $this->db->query($query);
          if($q->num_rows()>0)
          {
            $this->debug($q->result_array());
          }
          else
          {
            echo "please check your query";
          }
        }
        else
        {
        echo'<form method="post" action="qry">';
        echo'<input type="text" name="qry"/><br>';  
        echo'<input type="submit" name="submit" value="submit"/><br>';
        echo'</form>';
        }
      }
    }

  }

  public function replicate_to_temp_table($regNo)
  {
    $query = $this->db->query("select * from registeredcoop where regNo='$regNo'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        unset($row['grouping']);
        unset($row['migrated']);
        $data[] = $row;
      }
      // $this->debug($data);

       $this->db->delete('temp_registeredcoop',array('regNo'=>$regNo));
       
          if($this->db->insert_batch('temp_registeredcoop',$data))
          {
            echo'success';
          }
          else
          {
            echo'failed';
          }
     
        
    }
    else
    {
      echo'no data found';
    }

  }

 public function seed_migration($regNo,$users_id)
    { 
      if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='seed_migration')
      {
        $qry = $this->db->query("select application_id,coopName,acronym,regNo,category,type,commonBond,areaOfOperation,noStreet,Street,addrCode,compliant, DATE(CASE WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 3 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%m-%d-%Y') WHEN LOCATE('-', temp_registeredcoop.dateRegistered) = 5 THEN STR_TO_DATE(temp_registeredcoop.dateRegistered, '%Y-%m-%d') ELSE STR_TO_DATE(temp_registeredcoop.dateRegistered, '%d/%m/%Y') END) as dateRegistered from temp_registeredcoop  where dateRegistered <> '0000-00-00' AND  regNo='$regNo'");

        $process = 0;
        $success =0;
         foreach($qry->result_array() as $row)
         {
            unset($row['id']);
          $data=Array (
                'cooperative_id' => $row['application_id'],
                // 'amendment_no' => $row['']
                'coopName' =>$row['coopName'],
                'acronym' => $row['acronym'],
                'regNo' => $row['regNo'],
                'category' => $row['category'],
                'type' => $row['type'],
                'date_printed' => $row['dateRegistered'],
                'dateRegistered' =>$row['dateRegistered'],
                'commonBond' =>$row['commonBond'],
                'areaOfOperation' => $row['areaOfOperation'],
                'noStreet' => $row['noStreet'],
                'Street' => $row['Street'],
                'addrCode' => $row['addrCode'],
                'compliant' => $row['compliant'],
                'migrated'=>1
              );
            $this->debug($data);
            if($row['dateRegistered']!=null)
            { 
              $process++;
              if($this->db->insert('registeredamendment',$data))
              {
                $success++;
              }
            }

         }
        
           if($success == $process)
           {
            echo"successfully inserted in registeredamendment process :".$process." success :".$success;
            echo"<br>";
                $query2 = $this->db->query("select registeredamendment.regNo,cooperatives.id,cooperatives.users_id, cooperatives.category_of_cooperative,cooperatives.type_of_cooperative,cooperatives.grouping,cooperatives.proposed_name,cooperatives.acronym_name,cooperatives.common_bond_of_membership,cooperatives.field_of_membership,cooperatives.name_of_ins_assoc,cooperatives.area_of_operation,cooperatives.refbrgy_brgyCode,cooperatives.interregional,cooperatives.regions,cooperatives.street,cooperatives.house_blk_no,cooperatives.status from registeredamendment left join cooperatives on registeredamendment.cooperative_id = cooperatives.id where registeredamendment.regNo = '$regNo'");
                $process2=0;
                $success2 =0;
                if($query2->num_rows()>0)
                {  
                foreach($query2->result_array() as $rows)
                {
                  $data_amendment =array(
                    'cooperative_id' =>  $rows['id'],
                    'regNo'=>$rows['regNo'],
                    'amendmentNo' =>'' ,
                    'users_id' => $users_id,
                    'category_of_cooperative' => $rows['category_of_cooperative'],
                    'type_of_cooperative' =>$rows['type_of_cooperative'],
                    'cooperative_type_id'=>'',
                    'grouping' =>$rows['grouping'],
                    'proposed_name' => $rows['proposed_name'],
                    'acronym' => $rows['acronym_name'],
                    'common_bond_of_membership' => $rows['common_bond_of_membership'],
                    // 'comp_of_membership',
                    // 'field_of_membership',
                    // 'name_of_ins_assoc',
                    'area_of_operation' => $rows['area_of_operation'],
                    'refbrgy_brgyCode' => $rows['refbrgy_brgyCode'],
                    // 'interregional',
                    'regions' => $rows['regions'],
                    'street' => $rows['street'],
                    'house_blk_no'=> $rows['house_blk_no'],
                    'status' => 15,
                    'created_at' => date('Y-m-d h:i:s',now('Asia/Manila')),
                    'ho'=>0,
                    'migrated'=>1
                  );
                  $process2++;
                  if($this->db->insert('amend_coop',$data_amendment))
                  {
                    $success2++;
                  }
                }
                // $this->debug($data_amendment);
                if($success2 == $process2)
                {
                  echo "Successfully inserted in amend_coop : success : ".$success2 .' '."process :".$process2;
                }
                else
                {
                  echo"failed : success : ".$success2 .' '."process :".$process2;
                }
               }
               else
               {
                 echo"record found in registeredamendment table<br>".$this->db->last_query();
               }
              }

           }
           else
           {
            echo"failed";
           }
           

           //insert into amnd_coop table
           
     }    
        
    }
           
  public function select_($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select')
      {
        $qry = $this->db->query("select * from ".$table);
        foreach($qry->result_array() as $row)
        {
          $data[] = $row;
        }
        $this->debug($data);
      } 
      else
      {
        return null;
      } 
    }
  }
  public function select_2($table,$limit)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select2')
      {
        $qry = $this->db->query("select * from ".$table." order by id desc limit ".$limit);
        foreach($qry->result_array() as $row)
        {
          $data[] = $row;
        }
        $this->debug($data);
      } 
      else
      {
        return null;
      } 
    }
  }

  public function truncate_($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='truncate_')
      { 
         if($this->db->query("TRUNCATE ".$table))
         {
          echo $table.' truncated successfully';
         }
         else
         {
          echo 'failed to truncate '.$table;
         }
        
      } 
      else
      {
        return null;
      } 
    }
  }

  public function update_()
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='update')
      {
       

        if(isset($_POST['submit']))
        {
          $table = $this->input->post('table');
          $field = $this->input->post('field');
          $value= $this->input->post('value');
          $id = $this->input->post('id');
          if($id>0)
          {
           if($this->db->update($table,array($field=>$value),array('id'=>$id)))
            {
            echo"successfully updated";
            }
            else
            {
              echo "failed to update";
            }
          }
          else
          {
            echo"failed id must set";
          }
        }
        else
        {
          echo'<form method="post" action="update">';
            echo'<input type="text" name="table"/><br>';
            echo'<input type="text" name="field"/><br>';
            echo'<input type="text" name="value"/><br>';
            echo'<input type="text" name="id"/><br>';
            echo'<input type="submit" name="submit" value="submit"/><br>';
          echo'</form>';
        }   
        // if($this->db->update($table,$array1,$arry2))
        // {
        //   echo "successfully updated.";
        // }
        // else
        // {
        //   echo"failed to update data";
        // }
        
      } 
      else
      {
        return null;
      } 
    }
  }

  public function rename_table($table,$t_name)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='rename_table')
      {
        if($qry = $this->db->query(" ALTER TABLE ".$table." RENAME TO ".$t_name))
        {
          echo " successfully alter table to ".$t_name;
        }
        else
        {
          echo"failed to rename column";
        }
        
      } 
      else
      {
        return null;
      } 
    }
  }

  public function drop_column($table,$column)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='drop_column')
      {
        if($qry = $this->db->query(" ALTER TABLE ".$table." DROP ".$column))
        {
          echo $column. " column successfully drop in ".$table;
        }
        else
        {
          echo"failed to drop column";
        }
        
      } 
      else
      {
        return null;
      } 
    }
  }
  public function custom_query()
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
        if($this->uri->segment(2)=='custom_query')
        {
          if(isset($_POST['submit']))
          {
            $query = $this->input->post('qry');
            $result = $this->db->query($query);
              $this->debug($result->result_array());
          }
          else
          {
            echo'<form method="post">';
            echo'<input type="text" name="qry"/><br>';
            echo'<input type="submit" name="submit" value="submit"/><br>';
            echo'</form>';
          }
        
        }
   }
  }
  public function spec_table($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
        if($this->uri->segment(2)=='spec_table')
        {
          $query= $this->db->query("select COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, 
             NUMERIC_PRECISION, DATETIME_PRECISION, 
             IS_NULLABLE 
              from INFORMATION_SCHEMA.COLUMNS
              where TABLE_NAME='$table'");
          if($query->num_rows()>0)
          {
             $this->debug($query->result_array());
          }
         

        }
    }      

  }
  public function php_info()
  {
    echo phpinfo();
  }

  public function acbl()
  {
      if(isset($_POST['submit']))
      {
          $amendment_id = $this->input->post('amendment_id');
          $this->acbl_query($amendment_id);
      }
      else
      {
           echo'<form method="post" action="acbl">';
            echo' <input type="text" name="amendment_id" placeholder="Amendment ID"/><br>';
            echo'<input type="submit" name="submit" value="submit"/><br>';
            echo'</form>';
      }
           
  }
   public function compare_param($param1,$param2)
  {   
    if(strcasecmp(trim(preg_replace('/\s\s+/', ' ',$param1)),trim(preg_replace('/\s\s+/', ' ',$param2)))!=0)
    {
          return 'true';
    }
    else
    {
          return 'false';
    } 
  }
  public function acbl_query($amendment_id)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
        $amendment_info = $this->amendment_model->get_amendment_info($amendment_id);
        $last_amendment_info = $this->amendment_model->get_last_amendment_info($amendment_info->cooperative_id,$amendment_info->id);
        $bylaw_info = $this->amendment_bylaw_model->get_bylaw_by_coop_id($amendment_info->cooperative_id,$amendment_id);
        $capitalization_info= $this->amendment_capitalization_model->get_capitalization_by_coop_id($amendment_info->cooperative_id,$amendment_id);
     
        $no_of_bod = $this->amendment_cooperator_model->check_directors_odd_number_amendment($amendment_id);
        $purposes =$this->amendment_purpose_model->get_purposes($amendment_id);
        if($this->amendment_model->if_had_amendment($amendment_info->regNo,$amendment_id))
        {
        //next amendment
          $coop_info_orig= $this->amendment_model->amendment_info_not_own_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
          $capitalization_info_orig = $this->amendment_capitalization_model->get_capitalization_by_coop_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
          $no_of_bod_orig = $this->amendment_cooperator_model->check_directors_odd_number($last_amendment_info->cooperative_id,$last_amendment_info->id);
          $purposes_orig=$this->amendment_purpose_model->get_purposes($last_amendment_info->id);
          //BYLAW
          $bylaw_info_orig = $this->amendment_bylaw_model->get_bylaw_by_coop_id($last_amendment_info->cooperative_id,$last_amendment_info->id);
          if($this->charter_model->in_charter_city($coop_info_orig->cCode))
          {
          $in_chartered_cities_orig=true;
          $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);
          }
        }
        else
        {
        //first amendment
          $coop_info_orig= $this->cooperatives_model->get_cooperative_info_by_admin($amendment_info->cooperative_id);
          $capitalization_info_orig = $this->capitalization_model->get_capitalization_by_coop_id($amendment_info->cooperative_id);
          $no_of_bod_orig = $this->cooperator_model->check_directors_odd_number($amendment_info->cooperative_id);
          $purposes_orig=$this->purpose_model->get_all_purposes2($amendment_info->cooperative_id);
          //BYLAWS
          $bylaw_info_orig = $this->bylaw_model->get_bylaw_by_coop_id($amendment_info->cooperative_id);
          //END BYLAWS
            if($this->charter_model->in_charter_city($coop_info_orig->cCode))
            {
            $in_chartered_cities_orig=true;
            $chartered_cities_orig =$this->charter_model->get_charter_city($coop_info_orig->cCode);
            }
        }

        if($amendment_info->house_blk_no==null && $amendment_info->street==null) $x=''; else $x=', ';
              if($coop_info_orig->house_blk_no==null && $coop_info_orig->street==null) $x=''; else $x=', ';
              $address = $amendment_info->house_blk_no.' '.ucwords($amendment_info->street).$x.' '.$amendment_info->brgy.' '.$amendment_info->city.', '.$amendment_info->province.' '.$amendment_info->region;
              $address_orig = $coop_info_orig->house_blk_no.' '.ucwords($coop_info_orig->street).$x.' '.$coop_info_orig->brgy.' '.$coop_info_orig->city.', '.$coop_info_orig->province.' '.$coop_info_orig->region;
              //basic info
              $typeOfcoop = $this->compare_param($amendment_info->type_of_cooperative,$coop_info_orig->type_of_cooperative);
              $proposeName = $this->compare_param($amendment_info->proposed_name,$coop_info_orig->proposed_name);
              $acronym_c = $this->compare_param($amendment_info->acronym,$coop_info_orig->acronym_name);
              $common_bond = $this->compare_param($amendment_info->common_bond_of_membership,$coop_info_orig->common_bond_of_membership);
              $areaOf_operation = $this->compare_param($amendment_info->area_of_operation,$coop_info_orig->area_of_operation);
              $fieldOfmemship = $this->compare_param($amendment_info->field_of_membership,$coop_info_orig->field_of_membership);
              //capitalization
              $authorized_share_capital=$this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);
              $common_share= $this->compare_param($capitalization_info->common_share,$capitalization_info_orig->common_share);
              $preferred_share= $this->compare_param($capitalization_info->preferred_share,$capitalization_info_orig->preferred_share,$amendment_id);
              $par_value= $this->compare_param($capitalization_info->par_value,$capitalization_info_orig->par_value);
              $authorized_share_capital= $this->compare_param($capitalization_info->authorized_share_capital,$capitalization_info_orig->authorized_share_capital);
              $total_amount_of_subscribed_capital = $this->compare_param($capitalization_info->total_amount_of_subscribed_capital,$capitalization_info_orig->total_amount_of_subscribed_capital);
              // $amount_of_common_share_subscribed= $this->compare_param($capitalization_info->amount_of_common_share_subscribed,$capitalization_info_orig->amount_of_common_share_subscribed);
              $amount_of_preferred_share_subscribed = $this->compare_param($capitalization_info->amount_of_preferred_share_subscribed,$capitalization_info_orig->amount_of_preferred_share_subscribed);
              $total_amount_of_paid_up_capital =  $this->compare_param($capitalization_info->total_amount_of_paid_up_capital,$capitalization_info_orig->total_amount_of_paid_up_capital);
              // $amount_of_common_share_paidup = $this->compare_param($capitalization_info->amount_of_common_share_paidup,$capitalization_info_orig->amount_of_common_share_paidup);
              $amount_of_preferred_share_paidup =$this->compare_param($capitalization_info->amount_of_preferred_share_paidup,$capitalization_info_orig->amount_of_preferred_share_paidup);
              //cooperator
              $no_of_bod = $this->compare_param($no_of_bod,$no_of_bod_orig);
               //BYLAW
              $kinds_of_members = $this->compare_param($bylaw_info->kinds_of_members,$bylaw_info_orig->kinds_of_members);
              $additional_requirements_for_membership = $this->compare_param($bylaw_info->additional_requirements_for_membership,$bylaw_info_orig->additional_requirements_for_membership);
              $regular_qualifications = $this->compare_param($bylaw_info->regular_qualifications,$bylaw_info_orig->regular_qualifications);
              $associate_qualifications = $this->compare_param($bylaw_info->associate_qualifications,$bylaw_info_orig->associate_qualifications);
              $membership_fee = $this->compare_param($bylaw_info->membership_fee,$bylaw_info_orig->membership_fee);

              $act_upon_membership_days = $this->compare_param($bylaw_info->act_upon_membership_days,$bylaw_info_orig->act_upon_membership_days);
              $additional_conditions_to_vote = $this->compare_param($bylaw_info->additional_conditions_to_vote,$bylaw_info_orig->additional_conditions_to_vote);  
              $annual_regular_meeting_day = $this->compare_param($bylaw_info->annual_regular_meeting_day,$bylaw_info_orig->annual_regular_meeting_day);
        
              $members_percent_quorom = $this->compare_param($bylaw_info->members_percent_quorom,$bylaw_info_orig->members_percent_quorom);
              $number_of_absences_disqualification = $this->compare_param($bylaw_info->number_of_absences_disqualification,$bylaw_info_orig->number_of_absences_disqualification);
              $percent_of_absences_all_meettings = $this->compare_param($bylaw_info->percent_of_absences_all_meettings,$bylaw_info_orig->percent_of_absences_all_meettings);
              $director_hold_term = $this->compare_param($bylaw_info->director_hold_term,$bylaw_info_orig->director_hold_term);
              $member_invest_per_month = $this->compare_param($bylaw_info->member_invest_per_month,$bylaw_info_orig->member_invest_per_month);
              $member_percentage_annual_interest = $this->compare_param($bylaw_info->member_percentage_annual_interest,$bylaw_info_orig->member_percentage_annual_interest);
              $member_percentage_service = $this->compare_param($bylaw_info->member_percentage_service,$bylaw_info_orig->member_percentage_service);
              $percent_reserve_fund = $this->compare_param($bylaw_info->percent_reserve_fund,$bylaw_info_orig->percent_reserve_fund);
              $percent_education_fund = $this->compare_param($bylaw_info->percent_education_fund,$bylaw_info_orig->percent_education_fund);
              $percent_community_fund = $this->compare_param($bylaw_info->percent_community_fund,$bylaw_info_orig->percent_community_fund);
              $percent_optional_fund = $this->compare_param($bylaw_info->percent_optional_fund,$bylaw_info_orig->percent_optional_fund);
              $non_member_patron_years = $this->compare_param($bylaw_info->non_member_patron_years,$bylaw_info_orig->non_member_patron_years);
              $amendment_votes_members_with = $this->compare_param($bylaw_info->amendment_votes_members_with,$bylaw_info_orig->amendment_votes_members_with);
              $minimum_subscribed_share_regular =$this->compare_param($capitalization_info->minimum_subscribed_share_regular,$capitalization_info_orig->minimum_subscribed_share_regular);
              $minimum_paid_up_share_regular =$this->compare_param($capitalization_info->minimum_paid_up_share_regular,$capitalization_info_orig->minimum_paid_up_share_regular);
              $minimum_subscribed_share_associate =$this->compare_param($capitalization_info->minimum_subscribed_share_associate,$capitalization_info_orig->minimum_subscribed_share_associate);
              $minimum_paid_up_share_associate =$this->compare_param($capitalization_info->minimum_paid_up_share_associate,$capitalization_info_orig->minimum_paid_up_share_associate);
              $purposes_=false;
              $purposes_ = $this->compare_param($purposes_orig->content,$purposes->content);
                $purposes_='false';
              $this->amendment_model->commitee_others($amendment_id);
              if(strcasecmp($address, $address_orig)!=0)
              {
                $address1 = 'true';
              }
              else
              {
                $address1 = 'false';
              }
             
        $artilces_array = array(
                          'typeOfcoop'=>$typeOfcoop,
                          'proposeName'=>$proposeName,
                          'acronym_c'=>$acronym_c,
                          'common_bond'=>$common_bond,
                          'areaOf_operation'=>$areaOf_operation,
                          'fieldOfmemship'=>$fieldOfmemship,
                          'address1'=>$address1,
                          'authorized_share_capital'=>$authorized_share_capital,
                          'common_share'=>$common_share,
                          'preferred_share'=>$preferred_share,
                          'par_value'=>$par_value,
                          'authorized_share_capital'=>$authorized_share_capital,
                          'total_amount_of_subscribed_capital'=>$total_amount_of_subscribed_capital,
                          // 'amount_of_common_share_subscribed'=>$amount_of_common_share_subscribed,
                          'amount_of_preferred_share_subscribed'=>$amount_of_preferred_share_subscribed,
                          'total_amount_of_paid_up_capital'=>$total_amount_of_paid_up_capital,
                          // 'amount_of_common_share_paidup'=>$amount_of_common_share_paidup,
                          'amount_of_preferred_share_paidup'=>$amount_of_preferred_share_paidup,
                          'purposes_'=>$purposes_,
                          'no_of_bod'=>$no_of_bod
                         );

        $bylaws_array = array(
                        'no_of_bod' => $no_of_bod,
                        'kinds_of_members'=>$kinds_of_members,
                        'additional_requirements_for_membership'=>$additional_requirements_for_membership,
                        'regular_qualifications'=>$regular_qualifications,
                        'associate_qualifications'=>$associate_qualifications, 
                        'membership_fee'=>$membership_fee,
                        'act_upon_membership_days'=>$act_upon_membership_days,
                        'additional_conditions_to_vote'=>$additional_conditions_to_vote,  
                        'annual_regular_meeting_day'=>$annual_regular_meeting_day, 
                        // $annual_regular_meeting_day_date,
                        // $annual_regular_meeting_day_venue, 
                        'members_percent_quorom'=>$members_percent_quorom,
                        'number_of_absences_disqualification'=>$number_of_absences_disqualification,
                        'percent_of_absences_all_meettings'=>$percent_of_absences_all_meettings, 
                        'director_hold_term'=>$director_hold_term,
                        'member_invest_per_month'=>$member_invest_per_month, 
                        'member_percentage_annual_interest'=>$member_percentage_annual_interest, 
                        'member_percentage_service'=>$member_percentage_service, 
                        'percent_reserve_fund'=>$percent_reserve_fund, 
                        'percent_education_fund'=>$percent_education_fund, 
                        'percent_community_fund'=>$percent_community_fund,
                        'percent_optional_fund'=>$percent_optional_fund, 
                        'non_member_patron_years'=>$non_member_patron_years, 
                        'amendment_votes_members_with'=>$amendment_votes_members_with,
                        'minimum_subscribed_share_regular'=>$minimum_subscribed_share_regular, 
                        'minimum_paid_up_share_regular'=>$minimum_paid_up_share_regular, 
                        'minimum_subscribed_share_associate'=>$minimum_subscribed_share_associate,
                        'minimum_paid_up_share_associate'=>$minimum_paid_up_share_associate, 
            );

             // $this->debug($amendment_info);
             echo'
              <style>
                td{
                  padding:2px;
                  text-align:center;
                }
              ul li{
                  display:inline;
                }
              </style>
                <table border="1" align="center">
                  <thead>
                    <tr><td colspan="11" style="color:green;text-align:center;"><b>Amendment Basic Information</b></td></tr>
                    <tr>
                      <th>Coop. ID</th>
                      <th>Amendt. ID</th>
                      <th>Registration No</th>
                      <th>Proposed Name</th>
                      <th>Acronym</th>
                      <th>Type of Coop</th>
                      <th>Area of Operation</th>
                      <th>Brgy</th>
                      <th>City</th>
                      <th>Province</th>
                      <th>Region</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>'.$amendment_info->cooperative_id.'</td>
                      <td>'.$amendment_info->id.'</td>
                      <td>'.$amendment_info->regNo.'</td>
                      <td>'.$amendment_info->proposed_name.'</td>
                      <td>'.$amendment_info->acronym.'</td>
                      <td>'.$amendment_info->type_of_cooperative.'</td>
                      <td>'.$amendment_info->area_of_operation.'</td>
                      <td>'.$amendment_info->brgy.'</td>
                      <td>'.$amendment_info->city.'</td>
                      <td>'.$amendment_info->province.'</td>
                      <td>'.$amendment_info->region.'</td>
                    </tr>
                  </tbody>
               
                </table>
             '; 

             // echo '<br><br><ul><li>
             // <table border="1" >
                 
             //      <tbody>
             //        <tr><td colspan="2"><b>ARTICLES (AC)</b></td></tr>
             //        <tr><b><td>Field</td><td>Status</td></b></tr>
             //        <tr><td>typeOfcoop</td><td>'. $artilces_array['typeOfcoop'].'</td></tr>
             //        <tr><td>proposeName</td><td>'. $artilces_array['proposeName'].'</td></tr>
             //        <tr><td>acronym_c</td><td>'. $artilces_array['acronym_c'].'</td></tr>
             //        <tr><td>common_bond</td><td>'. $artilces_array['common_bond'].'</td></tr>
             //        <tr><td>areaOf_operation</td><td>'. $artilces_array['areaOf_operation'].'</td></tr>
             //        <tr><td>fieldOfmemship</td><td>'. $artilces_array['fieldOfmemship'].'</td></tr>
             //        <tr><td>address1</td><td>'. $artilces_array['address1'].'</td></tr>
             //        <tr><td>authorized_share_capital</td><td>'. $artilces_array['authorized_share_capital'].'</td></tr>
             //        <tr><td>common_share</td><td>'. $artilces_array['common_share'].'</td></tr>
             //        <tr><td>preferred_share</td><td>'. $artilces_array['preferred_share'].'</td></tr>
             //        <tr><td>par_value</td><td>'. $artilces_array['par_value'].'</td></tr>
             //        <tr><td>total_amount_of_subscribed_capital</td><td>'. $artilces_array['total_amount_of_subscribed_capital'].'</td></tr>
             //        <tr><td>amount_of_common_share_subscribed</td><td>'. $artilces_array['amount_of_common_share_subscribed'].'</td></tr>
             //        <tr><td>amount_of_preferred_share_subscribed</td><td>'. $artilces_array['amount_of_preferred_share_subscribed'].'</td></tr>
             //        <tr><td>total_amount_of_paid_up_capital</td><td>'. $artilces_array['total_amount_of_paid_up_capital'].'</td></tr>
             //        <tr><td>amount_of_common_share_paidup</td><td>'. $artilces_array['amount_of_common_share_paidup'].'</td></tr>
             //        <tr><td>amount_of_preferred_share_paidup</td><td>'. $artilces_array['amount_of_preferred_share_paidup'].'</td></tr>
             //        <tr><td>purposes_</td><td>'. $artilces_array['purposes_'].'</td></tr>
             //        <tr><td>no_of_bod</td><td>'. $artilces_array['no_of_bod'].'</td></tr>

             //      </tbody>
               
             //    </table>
             //    </li>
             // '; 
             // // $this->debug($artilces_array);

             // echo'<li>
             //     <table border="1">
                 
             //      <tbody>
             //        <tr><td colspan="2"><b>BYLAWS (BL)</b></td></tr>
             //        <tr><b><td>Field</td><td>Status</td></b></tr>
             //        <tr><td>no_of_bod</td><td>'.$bylaws_array['no_of_bod'].'</td></tr>
             //          <tr><td>kinds_of_members</td><td>'.$bylaws_array['kinds_of_members'].'</td></tr>
             //          <tr><td>additional_requirements_for_membership</td><td>'.$bylaws_array['additional_requirements_for_membership'].'</td></tr> 
             //          <tr><td>regular_qualifications</td><td>'.$bylaws_array['regular_qualifications'].'</td></tr>
             //          <tr><td>associate_qualifications</td><td>'.$bylaws_array['associate_qualifications'].'</td></tr>
             //          <tr><td>membership_fee</td><td>'.$bylaws_array['membership_fee'].'</td></tr>
             //          <tr><td>act_upon_membership_days</td><td>'.$bylaws_array['act_upon_membership_days'].'</td></tr>
             //          <tr><td>additional_conditions_to_vote</td><td>'.$bylaws_array['additional_conditions_to_vote'].'</td></tr>
             //          <tr><td>annual_regular_meeting_day</td><td>'.$bylaws_array['annual_regular_meeting_day'].'</td></tr> 
             //          <tr><td>members_percent_quorom</td><td>'.$bylaws_array['members_percent_quorom'].'</td></tr> 
             //          <tr><td>number_of_absences_disqualification</td><td>'.$bylaws_array['number_of_absences_disqualification'].'</td></tr>
             //          <tr><td>percent_of_absences_all_meettings</td><td>'.$bylaws_array['percent_of_absences_all_meettings'].'</td></tr>
             //          <tr><td>director_hold_term</td><td>'.$bylaws_array['director_hold_term'].'</td></tr>
             //          <tr><td>member_invest_per_month</td><td>'.$bylaws_array['member_invest_per_month'].'</td></tr>
             //          <tr><td>member_percentage_annual_interest</td><td>'.$bylaws_array['member_percentage_annual_interest'].'</td></tr>
             //          <tr><td>member_percentage_service</td><td>'.$bylaws_array['member_percentage_service'].'</td></tr>
             //          <tr><td>percent_reserve_fund</td><td>'.$bylaws_array['percent_reserve_fund'].'</td></tr>
             //          <tr><td>percent_education_fund</td><td>'.$bylaws_array['percent_education_fund'].'</td></tr>
             //          <tr><td>percent_community_fund</td><td>'.$bylaws_array['percent_community_fund'].'</td></tr>
             //          <tr><td>percent_optional_fund</td><td>'.$bylaws_array['percent_optional_fund'].'</td></tr>
             //          <tr><td>non_member_patron_years</td><td>'.$bylaws_array['non_member_patron_years'].'</td></tr>
             //          <tr><td>amendment_votes_members_with</td><td>'.$bylaws_array['amendment_votes_members_with'].'</td></tr>
             //          <tr><td>minimum_subscribed_share_regular</td><td>'.$bylaws_array['minimum_subscribed_share_regular'].'</td></tr>
             //          <tr><td>minimum_paid_up_share_regular</td><td>'.$bylaws_array['minimum_paid_up_share_regular'].'</td></tr> 
             //          <tr><td>minimum_subscribed_share_associate</td><td>'.$bylaws_array['minimum_subscribed_share_associate'].'</td></tr>
             //          <tr><td>minimum_paid_up_share_associate</td><td>'.$bylaws_array['minimum_paid_up_share_associate'].'</td></tr>
             //      </tbody>
             //    </table> 
             //    </li>
             //    </ul>
             // ';
             $this->debug($artilces_array);
             $this->debug($bylaws_array);
              $and = '';
              $bylaws = false;
              $articles = false;
              if(in_array('true',$bylaws_array))
              {
                $bylaws = true;
              }
              if(in_array('true',$artilces_array))
              {
                $articles = true;
              }
              if($articles && $bylaws)
              {
                $and=' AND ';
              }  
             
              $acbl = array('articles'=>$articles,'bylaws'=>$bylaws); 
              var_dump($acbl);        
    }
  }

  public function amendment_users()
  {
    $query =$this->db->query("SELECT  users.email as user_email,amend_coop.regNo,`amend_coop`.`proposed_name`,`amend_coop`.`acronym`,amend_coop.type_of_cooperative,
    `refbrgy`.`brgyDesc` as `brgy`, `refcitymun`.`citymunDesc` as `city`, 
     `refprovince`.`provDesc` as `province`, `refregion`.`regCode` as `rCode`,
     `refregion`.`regDesc` as `region`
    FROM `amend_coop` 
    LEFT JOIN users ON amend_coop.users_id = users.id
    INNER JOIN `refbrgy` ON `refbrgy`.`brgyCode` = `amend_coop`.`refbrgy_brgyCode` 
    INNER JOIN `refcitymun` ON `refcitymun`.`citymunCode` = `refbrgy`.`citymunCode` 
    INNER JOIN `refprovince` ON `refprovince`.`provCode` = `refcitymun`.`provCode` 
    JOIN `refregion` ON `refregion`.`regCode` = `refprovince`.`regCode` 
    ");
    $data = null;
    $count =1;
       if($query->num_rows()>0)
       {
            echo '
                  <table border="1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>user email</th>
                      <th>Reg. No</th>
                      <th>Proposed_name</th>
                      <th>Acronym</th>
                      <th>Type Cooperative</th>
                      <th>Brgy</th>
                      <th>City</th>
                      <th>Province</th>
                      <th>Region</th>
                      <th>Region code</th>
                    </tr>
                    </thead>
                    <tbody>
            ';
            foreach($query->result() as $row)
            {
              echo'
                
                    <tr><small>
                      <td>'.$count++.'</td>
                      <td>'.$row->user_email.'</td>
                      <td>'.$row->regNo.'</td>
                      <td>'.$row->proposed_name.'</td>
                      <td>'.$row->acronym.'</td>
                      <td>'.$row->type_of_cooperative.'</td>
                      <td>'.$row->brgy.'</td>
                      <td>'.$row->city.'</td>
                      <td>'.$row->province.'</td>
                      <td>'.$row->region.'</td>
                      <td>'.$row->rCode.'</td>
                      </small>
                    </tr>
                  
              ';
            }
            echo '</tbody></table>';
       }
   // $this->debug($data);
  }
  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }

   public function amd_migration($id,$limit)
   {
   
    $data['header_fields'] = $this->db->list_fields("amend_coop");
    $query =$this->db->query("select amend_coop.* From amend_coop where id > '$id' order by regNo limit ".$limit);
    // $this->debug($data['header_fields']);
    $data['result'] = $query->result_array();
    // $this->debug($data['result']);
    $this->load->view('./template/header', $data);
    $this->load->view('client/amendment_migration', $data);
    $this->load->view('./template/footer');
   }
}
