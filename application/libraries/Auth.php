<?php
Class Auth {
	public function ci()
 	{
 		$CI =& get_instance();
    	return $CI;
 	}

 	public function checkLogin()
 	{
 		 if(!$this->ci()->session->userdata('logged_in')){
      		return redirect('users/login');
   		 }
 	}

 	public function check_access_level($access_level)
 	{
 		 if($access_level==5){
             return redirect('admins/logout');
          }

 	}

 	public function authuserLevelAmd($access_level,$allowUser)
 	{
 		 if($access_level==5){
           $this->adminLogout();
          }

 		 if(!in_array($access_level,$allowUser))
 		 {
 		 	return redirect('amendment');
 		 }

 	}

 	private function adminLogout()
 	{
	    $this->ci()->session->unset_userdata('logged_in');
	    $this->ci()->session->unset_userdata('user_id');
	    $this->ci()->session->unset_userdata('username');
	    $this->ci()->session->unset_userdata('client');
	    $this->ci()->session->unset_userdata('access_level');
	    $this->ci()->session->unset_userdata('pagecount');
	    redirect('admins/login');
 	}
 	
}
?>