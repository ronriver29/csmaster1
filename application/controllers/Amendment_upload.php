<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Amendment_upload extends CI_Controller {
// construct
public function __construct() {
parent::__construct();
// load model
$this->load->model('Import_model', 'import');
$this->load->helper(array('url','html','form'));
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
				foreach ($allDataInSheet as $value) 
				{
					if($flag){
					$flag =false;
					continue;
					}
					
					$inserdata[$i]['regNo'] = $value['C'];
					$inserdata[$i]['amendmentNo']=1;
					$inserdata[$i]['users_id']=null;
					$inserdata[$i]['category_of_cooperative'] = $value['D'];
					$inserdata[$i]['type_of_cooperative']= $value['E'];
					$inserdata[$i]['cooperative_type_id']=null;
					$inserdata[$i]['grouping']=null;
					$inserdata[$i]['proposed_name'] =$value['F'];
					$inserdata[$i]['acronym']=$value['G'];
					$inserdata[$i]['common_bond_of_membership']= $value['K'];
					$inserdata[$i]['field_of_membership']= $value['L'];
					$inserdata[$i]['name_of_ins_assoc']=$value['M'];
					$type = explode(',',$value['E']);
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
					$i++;
				}      
					$this->debug($inserdata);
					// $this->db->insertBatch('amend_coop')         
					// $result = $this->import->insert($inserdata);   
					// // // echo $this->db->last_query();
					// if($result){
					// echo "Imported successfully";
					// }else{
					// echo "ERROR !";
					// }             
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
 public function debug($array)
    {
        echo"<pre>";
        print_r($array);
        echo"</pre>";
    }
}
?>