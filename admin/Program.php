<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program extends CI_Controller 
{ 
	public function __construct() {
        parent::__construct();
				$this->load->model('Program_model');
		}

		function Programlist()
		{	
			if(!check_admin_authentication()){
             
				redirect(base_url());
			}else{
					$data['programData']=$this->Program_model->getprogram();
					$this->load->view('Program/ProgramList',$data);
			}	
			
			
		}

	public function Programadd()
	{    
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{      
				$data='';
				$data['ProgramId']=$this->input->post('ProgramId');
				$data['StreamTypeId']=$this->input->post('StreamTypeId');
				$data['ProgramName']=$this->input->post('ProgramName');
				$data['ProgramDescription']=$this->input->post('ProgramDescription');
				$data['ProgramPrice']=$this->input->post('ProgramPrice');
				
				//$data['ProgramImage']=$this->input->post('ProgramImage');
				$data['IsActive']=$this->input->post('IsActive');
				if($_POST){
					if($this->input->post('ProgramId')==''){
								
						$result=$this->Program_model->insertdata();	
						if($result)
						{
							$this->session->set_flashdata('success', 'Record has been Inserted Succesfully!');
							redirect('Program/Programlist');
						}
					}
					else
					{
						$result=$this->Program_model->updatedata();
						if($result)
						{
							$this->session->set_flashdata('success', 'Record has been Updated Succesfully!');
							redirect('Program/Programlist');
						} 

					}
			}
			$data['streamData']=$this->Program_model->getstream();
			$this->load->view('Program/ProgramAdd',$data);	
		}		
	}

	
	function Editprogram($ProgramId){
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{ 
				$data='';
				$data['streamData']=$this->Program_model->getstream();
				$result=$this->Program_model->getdata($ProgramId);	
				$data['ProgramId']=$result['ProgramId'];
				$data['StreamTypeId']=$result['StreamTypeId'];	
				$data['ProgramName']=$result['ProgramName'];	
				$data['ProgramDescription']=$result['ProgramDescription'];
				$data['ProgramPrice']=$result['ProgramPrice'];
			//	$data['ProgramImage']=$result['ProgramImage'];
				$data['IsActive']=$result['IsActive'];			
				$this->load->view('Program/ProgramAdd' ,$data);	
		}
	}

	function updatedata($ProgramId){
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{ 
			$result=$this->Program_model->updatedata($ProgramId);	
			if($result=='1'){
			$this->session->set_flashdata('success', 'Record has been updated Succesfully!');
				redirect('Program/Programlist');	
				}
				redirect('Program/Programlist');
			}
	}

	function deletedata(){
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{ 
				$id=$this->input->post('id');
				$this->db->where("ProgramId",$id);
				$res=$this->db->delete('tblprogramtype');
				echo json_encode($res);
				die;
		}
	}
	

}

