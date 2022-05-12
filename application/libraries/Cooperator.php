<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cooperator {
 	

 	public function ci()
 	{
 		$CI =& get_instance();
    	return $CI;
 	}
 	public function __contruct()
 	{
 		$this->CI->load->library('pagination');
 	}

		public function check_equal_shares($amendment_id)
		{
			// $CI = & get_instance();
			$query= $this->ci()->db->query("select cap.id, cap.total_no_of_subscribed_capital as cap_total_subscribed_capital,cap.total_no_of_paid_up_capital as cap_total_paidup_capital,
			sum(amendment_cooperators.number_of_subscribed_shares) as coop_total_subscribed_shares,
			sum(amendment_cooperators.number_of_paid_up_shares) as coop_total_paid_up
			from amendment_capitalization as cap
			left join amendment_cooperators on cap.amendment_id = amendment_cooperators.amendment_id
			where cap.amendment_id='$amendment_id' group by cap.id");
			if($query->num_rows()>0)
			{
				foreach($query->result_array() as $row)
				{
					if($row['cap_total_subscribed_capital']==$row['coop_total_subscribed_shares'] && $row['cap_total_paidup_capital']==$row['coop_total_paid_up'])
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			else
			{
				return false;
			}
		}
	
	public function check_no_of_directors($cooperatives_id,$amendment_id){
	    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
	    $cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
	   $this->ci()->db->where('cooperatives_id',$cooperatives_id);
	    $this->ci()->db->where('amendment_id',$amendment_id);
	   $this->ci()->db->where_in('position', $position);
	    $this->ci()->db->from('amendment_cooperators');
	    if($this->ci()->db->count_all_results()>=5 &&  $this->ci()->db->count_all_results()<=15){
	      return true;
	    }else{
	      return false;
	    }
    }

    public function check_directors_odd_number($cooperatives_id,$amendment_id){
	    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
	    $this->ci()->db->where('cooperatives_id',$cooperatives_id);
	    $this->ci()->db->where('amendment_id',$amendment_id);
	    $this->ci()->db->where_in('position', $position);
	    $this->ci()->db->from('amendment_cooperators');
	    $count = $this->ci()->db->count_all_results();
	    if($count%2==1){
	      return true;
	    }else{
	      return false;
	    }
	}
    public function no_of_directors($cooperatives_id,$amendment_id){
    $position = array('Chairperson', 'Vice-Chairperson', 'Board of Director');
    $cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
   $this->ci()->db->where('cooperatives_id',$cooperatives_id);
    $this->ci()->db->where('amendment_id',$amendment_id);
   $this->ci()->db->where_in('position', $position);
    $this->ci()->db->from('amendment_cooperators');
    return $this->ci()->db->count_all_results();
  
  }

  public function check_chairperson($cooperatives_id,$amendment_id){
    $position = array('Chairperson');
    $cooperatives_id =  $this->ci()->security->xss_clean($cooperatives_id);
    $this->ci()->db->where('cooperatives_id',$cooperatives_id);
     $this->ci()->db->where('amendment_id',$amendment_id);
     $this->ci()->db->where_in('position', $position);
    $this->ci()->db->from('amendment_cooperators');
    if( $this->ci()->db->count_all_results()==1){
      return true;
    }else{
      return false;
    }
  }

	public function check_associate_not_exists($cooperatives_id,$amendment_id){
		$this->ci()->db->where('cooperatives_id',$cooperatives_id);
		$this->ci()->db->where('amendment_id',$amendment_id);
		$this->ci()->db->where('type_of_member', "Associate");
		$this->ci()->db->from('amendment_cooperators');
		$count =  $this->ci()->db->count_all_results();
		if($count==0){
			return true;
		}else{
			return false;
		}
	}

	public function get_total_regular($cooperative_id,$amendment_id){
    $cooperative_id = $this->ci()->security->xss_clean($cooperative_id);
    $this->ci()->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->ci()->db->get_where('amendment_cooperators',array('cooperatives_id'=>$cooperative_id,'amendment_id' => $amendment_id,'type_of_member'=>'Regular'));
    $data = $query->row();
    $query2 = $this->ci()->db->get_where('amendment_capitalization',array('cooperatives_id' => $cooperative_id,'amendment_id'=>$amendment_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = $data->total_subscribed;
    $totalPaid = $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }

  public function get_total_associate($cooperatives_id,$amendment_id){
    $cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
    $amendment_id = $this->ci()->security->xss_clean($amendment_id);
    $this->ci()->db->select('SUM(number_of_subscribed_shares) as total_subscribed, SUM(number_of_paid_up_shares) as total_paid');
    $query = $this->ci()->db->get_where('amendment_cooperators',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id,'type_of_member'=>'Associate'));
    $data = $query->row();
    $query2 = $this->ci()->db->get_where('amendment_articles_of_cooperation',array('cooperatives_id' => $cooperatives_id,'amendment_id'=>$amendment_id));
    $article = $query2->row();
    $totalSubscribed = 0;
    $totalPaid = 0;
    $totalSubscribed = ($data->total_subscribed==null) ? 0 : $data->total_subscribed;
    $totalPaid = ($data->total_paid==null) ? 0 : $data->total_paid;
    return array('total_subscribed' => $totalSubscribed,'total_paid'=> $totalPaid);
  }

  public function check_regular_total_shares_paid_is_correct($data){
    $temp = $data;
    if($temp['total_paid'] >= ceil($temp['total_subscribed']*0.25)){
      return true;
    }else{
      return false;
    }
  }

	public function check_vicechairperson($cooperatives_id,$amendment_id){
	$position = array('Vice-Chairperson');
	$cooperatives_id =$this->ci()->security->xss_clean($cooperatives_id);
	$amendment_id = $this->ci()->security->xss_clean($amendment_id);
		$this->ci()->db->where('cooperatives_id',$cooperatives_id);
		$this->ci()->db->where('amendment_id',$amendment_id);
		$this->ci()->db->where_in('position', $position);
		$this->ci()->db->from('amendment_cooperators');
		if($this->ci()->db->count_all_results()==1){
			return true;
		}else{
			return false;
		}
	}

	public function check_with_associate_total_shares_paid_is_correct($data_reg,$data_assoc){
	$temp = $data_reg;
	$temp_assoc = $data_assoc;
		if(($temp['total_paid'] + $temp_assoc['total_paid']) >= ceil(($temp['total_subscribed'] + $temp_assoc['total_subscribed']) * 0.25)){
			return true;
		}else{
			return false;
		}
	}

	public function check_treasurer($cooperatives_id,$amendment_id){
	$position = array('Treasurer');
	$cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
		$this->ci()->db->where('cooperatives_id',$cooperatives_id);
		$this->ci()->db->where('amendment_id',$amendment_id);
		$this->ci()->db->where_in('position', $position);
		$this->ci()->db->from('amendment_cooperators');
		if($this->ci()->db->count_all_results()==1){
			return true;
		}else{
			return false;
		}
	}
	public function check_secretary($cooperatives_id,$amendment_id){
	$position = array('Secretary');
	$cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
		$this->ci()->db->where('cooperatives_id',$cooperatives_id);
		$this->ci()->db->where('amendment_id',$amendment_id);
		$this->ci()->db->where_in('position', $position);
		$this->ci()->db->from('amendment_cooperators');
		if($this->ci()->db->count_all_results()==1){
			return true;
		}else{
			return false;
		}
	}

	public function get_all_cooperator_of_coop_regular_count($cooperatives_id,$amendment_id){
	$cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
	$this->ci()->db->where('type_of_member = "Regular" AND cooperatives_id ='.$cooperatives_id.' AND amendment_id='.$amendment_id);
	$this->ci()->db->from('amendment_cooperators');
	return $this->ci()->db->count_all_results();
	}

	public function get_all_cooperator_of_coop_regular($cooperatives_id,$amendment_id,$limit,$start){
	$cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
		$this->ci()->db->limit($limit, $start);
		$this->ci()->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
		$this->ci()->db->from('amendment_cooperators');
		$this->ci()->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');
		$this->ci()->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
		$this->ci()->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
		$this->ci()->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
		$this->ci()->db->where('type_of_member = "Regular" AND cooperatives_id = '.$cooperatives_id.' AND amendment_id='.$amendment_id);
		$this->ci()->db->order_by('full_name','asc');
		$query=$this->ci()->db->get();
		// $this->last_query = $this->db->last_query();
		$data = $query->result_array();
		return $data;
	}

	public function get_all_cooperator_of_coop_associate_count($amendment_id){
	$amendment_id= $this->ci()->security->xss_clean($amendment_id);
	$this->ci()->db->where('type_of_member = "Associate" AND amendment_id ='.$amendment_id.'');
	$this->ci()->db->from('amendment_cooperators');
	return $this->ci()->db->count_all_results();
	}

	public function get_all_cooperator_of_coop_associate($cooperatives_id,$amendment_id){
    $cooperatives_id = $this->ci()->security->xss_clean($cooperatives_id);
    $this->ci()->db->select('amendment_cooperators.*,refbrgy.brgyCode as bCode, refbrgy.brgyDesc as brgy, refcitymun.citymunCode as cCode,refcitymun.citymunDesc as city, refprovince.provCode as pCode,refprovince.provDesc as province, refregion.regCode as rCode, refregion.regDesc as region');
    $this->ci()->db->from('amendment_cooperators');
    $this->ci()->db->join('refbrgy','refbrgy.brgycode=amendment_cooperators.addrCode','left');
    $this->ci()->db->join('refcitymun', 'refcitymun.citymunCode = refbrgy.citymunCode','left');
    $this->ci()->db->join('refprovince', 'refprovince.provCode = refcitymun.provCode','left');
    $this->ci()->db->join('refregion', 'refregion.regCode = refprovince.regCode','left');
    $this->ci()->db->where('type_of_member = "Associate" AND cooperatives_id = '.$cooperatives_id.' AND amendment_id='.$amendment_id);
    $this->ci()->db->order_by('full_name','asc');
    $query=$this->ci()->db->get();
    // $this->last_query = $this->db->last_query();
    $data = $query->result_array();
    return $data;
  }

  public function count_total_cptr_capitalization($amendment_id)
  {
    $total = 0;
    $reg = 0;
    $assoc = 0;
    $query =  $this->ci()->db->query("select regular_members,associate_members from amendment_capitalization where amendment_id ='$amendment_id'");
    if($query->num_rows()>0)
    {
      foreach($query->result_array() as $row)
      {
        $reg = $row['regular_members'];
        if($row['associate_members']!=NULL)
        {
          $assoc = $row['associate_members'];
        }
        $total = $reg+$assoc;
      }
    }
    
    return $total;
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
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        return $links;
    }
}