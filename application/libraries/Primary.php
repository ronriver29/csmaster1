<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Primary {
 	
	public function ci()
 	{
 		$CI =& get_instance();
    	return $CI;
 	}

	public function __construct()
	{
		$this->ci()->load->model('amendment_cooperator_model');
		$this->ci()->load->model('amendment_bylaw_model');
		$this->ci()->load->model('amendment_purpose_model');
		$this->ci()->load->model('amendment_article_of_cooperation_model');
	}
 	

  public function check_complete($id,$cooperative_id,$decoded_id,$category,$page)
  {
	switch ($page) {
		case '':
			# code...
			break;
		case 'purposes':
				switch ($category) {
					case 'Primary':
						(!$this->ci()->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first the list of cooperators.') : true);
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true)
						(!$this->ci()->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your cooperative&apos;s purpose.') :true); 
					break;
					case 'Others':
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
					break;
					default:
						//Federation
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
					break;
				}
			break;	
		case 'articles':
				switch ($category) {
					case 'Primary':
						(!$this->ci()->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first the list of cooperators.') : true);
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true)
						(!$this->ci()->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your cooperative&apos;s purpose.') :''); 
					break;
					case 'Others':
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
					break;
					default:
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
						(!$this->ci()->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your cooperative&apos;s purpose.') :''); 
					break;
				}
			break;
		case 'committees':
			switch ($category) {
					case 'Primary':
						(!$this->ci()->amendment_cooperator_model->is_requirements_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first the list of cooperators.') : true);
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true)
						(!$this->ci()->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your cooperative&apos;s purpose.') :true); 
					break;
					case 'Others':
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
					break;
					default:
						(!$this->ci()->amendment_bylaw_model->check_bylaw_primary_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your bylaw additional information.') :true);
						(!$this->ci()->amendment_purpose_model->check_purpose_complete($cooperative_id,$decoded_id) ? $this->ci()->returnPage($id,'Please complete first your cooperative&apos;s purpose.') :''); 
						switch ($this->ci()->amendment_article_of_cooperation_model->check_article_primary_complete($decoded_id)) {
							case false:
								$this->ci()->session->set_flashdata('redirect_message', 'Please complete first your article of cooperation additional information.');
	      					redirect('amendment/'.$id);
								break;
							
							default:
								# code...
								break;
						}
					break;
				}
			break;	
		default:
			# code...
			break;
	}
  }

  public function returnPage($id,$message)
  {
   return $this->ci()->session->set_flashdata('redirect_message', $message);
	      redirect('amendment/'.$id);
  }

}
 	

