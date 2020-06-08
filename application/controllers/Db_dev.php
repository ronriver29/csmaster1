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
  public function select_2($table)
  {
    if(!$this->session->userdata('logged_in'))
    {
      redirect('users/login');
    }
    else
    {
      if($this->uri->segment(2)=='select2')
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
          // echo $table.$field.$value.$id;
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
        if($qry = $this->db->query(" ALTER TABLE ".$table." dDROP ".$column))
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
