<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Amendment_upload extends CI_Controller {
// construct
public function __construct() {
parent::__construct();
// load model
$this->load->model('Import_model', 'import');
$this->load->helper(array('url','html','form'));
 $this->load->database();
}    
public function index() {
	$this->load->view('amendment/v_upload');
}
public function importFile(){
	if ($this->input->post('submit')) {
		$path = UPLOAD_DIR;
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);    
		$qtype = $this->db->query("select id,name from cooperative_type");
		// $coop_type_data = array();
		// foreach($qtype->result_array() as $row)
		// {
		// 	$coop_type_data[] = array($row['id'] =>$row['name']);
		// }       
		// $this->debug($coop_type_data); 
		// foreach($coop_type_data as $row)
		// {
		// 	echo array_search('Bank',$row);
		// }
		
		if (!$this->upload->do_upload('uploadFile')) 
		{
			$error = array('error' => $this->upload->display_errors());
		} 
		else 
		{
			$data = array('upload_data' => $this->upload->data());
		}
	
		if(empty($error))
		{
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			}
			else 
			{
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;
			try 
			{
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$flag = true;
				$i=2;
				// $this->debug($allDataInSheet);

				//last amendment id 
				$amendment_id =1;
				$aq = $this->db->query("select id from amend_coop order by id desc limit 1");
				if($aq->num_rows()>0)
				{
					foreach($aq->result() as $row_id)
					{
						$amendment_id = $row_id->id;
					}
					// echo"las ID: ".$amendment_id;
				}

				foreach ($allDataInSheet as $value) 
				{
					$data_type = array();
					// $found_id = array();
					// $found_id='';
					if($flag){
					$flag =false;
					continue;
					}
					if(strlen($value['B'])>0)
					{	
						$amendment_id++;
						$inserdata[$i]['id'] = $value['A'];
						$inserdata[$i]['regNo'] = $value['B'];
						$inserdata[$i]['amendmentNo']=$value['C'];
						$inserdata[$i]['users_id']=null;
						$inserdata[$i]['category_of_cooperative'] = $value['E'];

						$typeOfCoop_array = explode(',',$value['F']);

						if(count($typeOfCoop_array)>1)
						{

							foreach($typeOfCoop_array as $typCoop)
							{
								$type_of_cooperative_id = array();
								$qtype = $this->db->query("select id from cooperative_type where name='$typCoop'");
								foreach($qtype->result() as $row_type)
								{
									$data_type[]=$row_type->id;
								}
							}
							$inserdata[$i]['cooperative_type_id'] = implode(',',$data_type);
							// $this->debug($data_types);
						}
						else
						{ 
							$typCoopSingle = $value['F'];
							// $qtype = $this->db->query("select id from cooperative_type where name='$typCoopSingle'");
							// 	foreach($qtype->result() as $row_type)
							// 	{
							// 		$type_of_cooperative_id = $row_type->id;
							// 	}
							$single_type_id= $this->find_id($typCoopSingle);
							$inserdata[$i]['cooperative_type_id'] =$single_type_id;
						}
						
						
						$inserdata[$i]['type_of_cooperative']= $value['F'];
						
						$inserdata[$i]['grouping']=null;
						$inserdata[$i]['proposed_name'] =$value['D'];
						$inserdata[$i]['acronym']=$value['G'];
						$inserdata[$i]['common_bond_of_membership']= $value['J'];
						$inserdata[$i]['comp_of_membership'] = $value['K'];
						$inserdata[$i]['field_of_membership']= $value['L'];
						$inserdata[$i]['name_of_ins_assoc']=$value['M'];
						$type = explode(',',$value['F']);
						$final_type = 'Single';
						if(count($type)>1)
						{
							$final_type = 'Multipurpose';
						}
						$inserdata[$i]['type']=$final_type;
						$inserdata[$i]['area_of_operation']=$value['N'];
						$inserdata[$i]['refbrgy_brgyCode']='';
						$inserdata[$i]['street']=$value['Q'];
						$inserdata[$i]['house_blk_no']=$value['P'];
						$inserdata[$i]['status']=15;

						$insertdataReg[$i]['coopName'] = $value['D'];
						$insertdataReg[$i]['acronym'] = $value['G'];
						$insertdataReg[$i]['regNo'] = $value['B'];
						$insertdataReg[$i]['category'] = $value['E'];
						$insertdataReg[$i]['type'] = $value['F'];
						$insertdataReg[$i]['dateRegistered'] = $value['R'];
						$insertdataReg[$i]['commonBond'] = $value['J'];
						$insertdataReg[$i]['areaOfOperation'] = $value['N'];
						$insertdataReg[$i]['noStreet'] = $value['P'];
						$insertdataReg[$i]['Street'] = $value['P'];
						$insertdataReg[$i]['addrCode'] = $value['O'];
						$insertdataReg[$i]['amendment_id'] = $value['A'];
						$insertdataReg[$i]['addrCode'] = $value['O'];
						$insertdataReg[$i]['addrCode'] = 0;




						//major industry
						if(strlen($value['H'])>0)
						{
							$q = $this->db->get_where('major_industry',array('description'=> $value['H']));
							if($q->num_rows()>0)
							{
								foreach($q->result() as $qrow)
								{
									$major_industry_id = $qrow->id;
								}


								$qs = $this->db->get_where('subclass',array('description'=>$value['I']));
								if($qs->num_rows()>0)
								{
									foreach($qs->result() as $srow)
									{
										$subclass_id = $srow->id;
										
									}
								}

							}

							//get coop type id 
							$sql = $this->db->query("select cooperative_type_id from industry_subclass_by_coop_type where subclass_id='$subclass_id'");
							if($sql->num_rows()>0)
							{
								foreach($sql->result() as $trow)
								{
									$coop_typeID = $trow->cooperative_type_id;
								}
							}
							 $business_data=  array(
							 	'cooperatives_id' => 0,
							 	'industry_subclass_by_coop_type_id'=>$coop_typeID,
							 	'amendment_id' => $value['A'],
							 	'major_industry_id' => $major_industry_id,
							 	'subclass_id' => $subclass_id
							 );
						}
						// $this->debug($business_data);
						if(!$this->db->insert('business_activities_cooperative_amendment',$business_data))
						{
							echo "failed to insert business activity Amendment data";
						}
					}//end if		
					
					// $this->debug('amendment_id :'. $amendment_id);
					$i++;
				}      
					// $this->debug($inserdata);
					if($this->db->insert_batch('registeredcoop',$insertdataReg))
					{
						$result = $this->import->insert($inserdata);   
					// // echo $this->db->last_query();
						if($result){
						echo "Imported successfully";
						}else{
						echo "ERROR !";
						}       
					}        
					      
			} 
			catch (Exception $e) 
			{
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
			. '": ' .$e->getMessage());
			}
		}
		else
		{
			echo $error['error'];
		}
	}//end of submit
		$this->load->view('amendment/v_upload');
   } //end of public
	
	// public function get_coop_id($regNo)
	// {
	// 	$query = $this->db->query('');
	// }		
 	public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
    public function update_migration($version)
    {
    	if($this->db->query("UPDATE migrations SET version='$version'"))
    	{
    		echo"success";
    	}
    	else
    	{
    		echo"failed";
    	}
    }

    public function find_id($value)
    {
    
        $data =array(
            '1' => 'Credit',
            '2' => 'Producers',
            '3' => 'Service',
            '4' => 'Consumers', 
            '5' => 'Marketing',
            '6' => 'Multi-Purpose',   
            '7' => 'Advocacy',   
            '8' => 'Agrarian Reform',  
            '9' => 'Bank',
            '10' => 'Dairy',  
            '11' => 'Education',
            '12' => 'Electric',
            '13' => 'Financial Service',
            '14' => 'Fishermen',
            '15' => 'Health Service',
            '16' => 'Insurance',
            '17' => 'Transport',
            '18' => 'Water Service',  
            '19' => 'Workers',
            '20' => 'Housing',
            '21' => 'Labor Service',
            '22' => 'Professionals',
            '23' => 'Small Scale Mining',
            '24' => 'Agriculture',
            '25' => 'Federation',
            '26' => 'Union',
            '27' => 'Cooperative Bank'
        );

        return array_search($value, $data);
    }
}
?>