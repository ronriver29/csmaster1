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
      if($this->uri->segment(2)=='show_fields_')
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

  public function drop_table_($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='drop_table')
      {
        if($this->db->query("drop table ".$table))
        {
          echo $table." table successfully removed";
        }
        else
        {
          echo"failed to drop ".$table." may be table not exist";
        }
      } 
      else
      {
        return null;
      } 
    }

  }

  public function php_info()
  {
    echo phpinfo();
  }

  public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
