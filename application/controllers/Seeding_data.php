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

  public function luba()
  {
  	$data = array(
  		'id'=>1648,
  		'psgcCode' => 140114000,
  		'citymunDesc' => 'Luba',
  		'regCode' => 014,
  		'provCode' => 1401,
  		'citymunCode' => 140114
  	);
  	if($this->db->insert('refcitymun',$data))
  	{
  		echo" Successfully added City of Luba";
  	}
  	else
  	{
  		echo "failed to seed data";
  	}
  }
}