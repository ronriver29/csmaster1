<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeding_data extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {
  	$data = array(
  				array(
  					'name' => 'Cooperative Bank',
  					'active' => 1
  				),
  				array(
  					'name' => 'Insurance Cooperative',
  					'active' => 1
  				),
  				array(
  					'name' => 'CSF',
  					'active' => 1
  				),

  	);

  	if($this->db->insert_batch('head_office_coop_type',$data))
  	{
  		echo"Data seeded successfully";

  	}
  	else
  	{
  		echo"failed to seed data";
  	}
  }
}