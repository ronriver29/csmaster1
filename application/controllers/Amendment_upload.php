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
						$inserdata[$i]['type_of_cooperative']= $value['F'];
						$inserdata[$i]['cooperative_type_id']=null;
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
						$inserdata[$i]['status']=1;

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
							 $business_data=  array(
							 	'cooperatives_id' => 0,
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
					// $this->db->insertBatch('amend_coop') 
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
}
?>