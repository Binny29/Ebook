<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
      	parent::__construct();
		$this->load->model('login_model');
		$this->load->model('admin_model');
		$this->load->model('student_model');
      
    }
    public function dashboard()
	{

		if(!check_admin_authentication()){ 
				redirect(base_url());
		}
		$data=array();
		$data['inquiry']=$this->login_model->getinquery();
		$data['student']=$this->student_model->getstudent();		
		$this->load->view('common/dashboard',$data);
	}
	public function profile()
	{
    
		if(!check_admin_authentication())
		{
				redirect('login');
		}
               
		$data = array();
		//echo "<pre>";print_r($_POST);die;
        $this->load->library('form_validation');
		$this->form_validation->set_rules('EmailAddress', 'Email', 'required|valid_email|callback_adminmail_check');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('AdminContact', 'Contact', 'required');
		$this->form_validation->set_rules('EmailAddress', 'Email', 'required');		
		
		if($this->form_validation->run() == FALSE){	
		
			if(validation_errors())
			{
				$data["error"] = validation_errors();
				echo "<pre>";print_r($data);die;
			}else{
				$data["error"] = "";
			}
			if($_POST){			
				$data["EmailAddress"] = $this->input->post('EmailAddress');
				$data["first_name"]   = $this->input->post('first_name');
				$data["last_name"]    = $this->input->post('last_name');
				$data["phone"]        = $this->input->post('phone');
				$data["gender"]       = $this->input->post('gender');
    			$data['pre_profile_image']=$this->input->post('pre_profile_image');
			
			}else{

				$oneAdmin=get_one_admin(get_authenticateadminID());
				//print_r($oneAdmin);die;
				$data["EmailAddress"] 	= $oneAdmin->EmailAddress;
				$data["full_name"] = $oneAdmin->FullName;				
				$data["contact"]      = $oneAdmin->AdminContact;			
	           	$data['ProfileImage']=$oneAdmin->ProfileImage;
	           	$data['IsActive']=$oneAdmin->IsActive;
			 //echo "jhjfdfdh";die;  
			}
		}else{
			//echo "else fdf";die;
            $this->session->set_flashdata('successmsg','Profile has been updated successfully');
			$res=$this->login_model->updateProfile();
			redirect('home/profile/');
		}
		//$data['msg'] = $msg; //login success message
			//	echo "jhgjh";die;

        $this->load->view('common/profile',$data);   
	}
	 //change password
    public function change_password()
    {
        
   		if(!check_admin_authentication()){
			redirect('login');
		}
		
            
		$data = array();
        $this->load->library('form_validation');	
		$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]|min_length[5]');
		$this->form_validation->set_rules('cpassword', 'Password Confirm', 'required|min_length[5]');	
	
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
				echo "<pre>";print_r($data['error']);die;
			}else{
				$data["error"] = "";
			}
			if($_POST){
				
				$data["password"] = $this->input->post('password');
                $data["cpassword"] = $this->input->post('cpassword');
			}else{
				$data["password"] = '';
                $data["cpassword"] = '';
			}
			
		}else{
		   //echo "fghg";die;
            $res=$this->login_model->updateAdminPassword();
			if($res){
         		$this->session->set_flashdata('success', 'Your password change successfully');
				redirect('home/change_password');
			}
		}
	
        $this->load->view('common/ChangePassword',$data);    
	}
	function oldpassword_check() {
		$query = $this->db->query("select Password from " . $this->db->dbprefix('tbladmin') . " where Password = '".md5($this->input->post('password'))."' and AdminId!='" . $this->session->userdata('AdminId') . "'");
		//echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
			echo 1;die;
		} else {
			echo 0;die;
		}
	}

	public function Forgotpassword($msg='')
	{
		$this->form_validation->set_rules('EmailAddress', 'Email', 'required|valid_email');

			if($this->form_validation->run() == FALSE){			
				if(validation_errors())
				{
					echo json_encode(array("status"=>"error","msg"=>validation_errors()));
				}
			}
			else
			{ 
			// echo "jhjg";die;
				$chk_mail=$this->login_model->forgot_email();
				//echo $chk_mail;die;
				if($chk_mail==0)
				{
					$error=EMAIL_NOT_FOUND;
					 $this->session->set_flashdata('error',EMAIL_NOT_FOUND);
	              
				}
				elseif($chk_mail==2)
				{
				 	$error=EMAIL_NOT_FOUND;
					$this->session->set_flashdata('error',EMAIL_NOT_FOUND);   
				}elseif($chk_mail==3)
				{
					$error=ACCOUNT_INACTIVE;
					 $this->session->set_flashdata('error',ACCOUNT_INACTIVE);
					 
				}
				else
				{				
					$forget=FORGET_SUCCESS;
					//email_send();
					 $this->session->set_flashdata('success','Please check your email for reset the password!');
					redirect('login');

	                // $redirect=site_url('home/index/forget');
	                // echo json_encode(array("status"=>"success","msg"=> $forget,"redirect"=>$redirect));
				}
			}
		$this->load->view('common/ForgotPassword');
	}


	function reset_password($code='')
	{

		if(check_admin_authentication())
			{
				redirect('home/dashbord');
			}
			
			$admin_id=$this->login_model->checkResetCode($code);
			//print_r($admin_id);die;

			$data = array();
			$data['errorfail']=($code=='' || $admin_id=='')?'fail':'';
			$data['AdminId']=$admin_id;
			$data['code']=$code;
	        
            if($admin_id){
            	if($_POST){
				
				if($this->input->post('AdminId') != ''){
					$this->form_validation->set_rules('Password', 'Password', 'required');
					$this->form_validation->set_rules('Confrim_password', 'Re-type Password', 'required|matches[Password]');
				
					if($this->form_validation->run() == FALSE){			
						if(validation_errors()){
							echo json_encode(array("status"=>"error","msg"=>validation_errors()));
						}
					}else{
						
							$up=$this->login_model->updatePassword();
						if($up>0){
							$this->session->set_flashdata('success',RESET_SUCCESS); 
							redirect('login');
						}elseif($up=='') {
							
							$error = EXPIRED_RESET_LINK;
					      $this->session->set_flashdata('error',EXPIRED_RESET_LINK); die; 
						}
						else{
							//echo "gfgfdg";die;
							$error = PASS_RESET_FAIL;
		                    $this->session->set_flashdata('error',PASS_RESET_FAIL); die; 
						}

					
						
					}
				}else{
					//echo "hii";die;
					$error = EXPIRED_RESET_LINK;
					// $redirect=site_url('home/index');
					//$redirect=site_url();
	              $this->session->set_flashdata('error',EXPIRED_RESET_LINK); die; 
				}
				 $this->load->view('common/ResestPassword',$data);
		    }else{
		    	//echo 'dfdfds';die;
		    	$this->load->view('common/ResestPassword',$data);
		    }

            }else{

            	  //echo "hii";die;
					$error = EXPIRED_RESET_LINK;
					 $this->session->set_flashdata('error',EXPIRED_RESET_LINK); die; 
					 redirect('home');
		    }
	}

	function Adminlist()
	{	
		//echo "dsd ";
		if(!check_admin_authentication()){ 
			//echo "hghgfh";die;
			redirect(base_url());
		}else{	
		//echo "else dfdf";die;	
			$data['adminData']=$this->admin_model->getadmin();
			$this->load->view('Admin/AdminList',$data);
		}
	}

	public function AddAdmin()
	{      
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}   
			 	$data=array();		
		
			$this->load->library("form_validation");
			$this->form_validation->set_rules('FullName', 'Full Name', 'required');			
			$this->form_validation->set_rules('EmailAddress', 'EmailAddress', 'required|valid_email|callback_adminmail_check');
			$this->form_validation->set_rules('AdminContact', 'AdminContact', 'required');
			if($this->input->post("AdminId")=="")
			{	
				$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]|min_length[5]');
				$this->form_validation->set_rules('cpassword', 'Password Confirm', 'required|min_length[5]');
			}
			$this->form_validation->set_rules('status', 'Status', '');
			
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
				//echo "<pre>";print_r($data["error"]);die;
			}else{
				$data["error"] = "";
			}
            $data['redirect_page']='AdminList';
			$data['AdminId']=$this->input->post('AdminId');
			$data['FullName']=$this->input->post('FullName');
			$data['Password']=$this->input->post('password');
			$data['EmailAddress']=$this->input->post('EmailAddress');
			$data['Address']=$this->input->post('Address');
			$data['ProfileImage']=$this->input->post('ProfileImage');
			$data['AdminContact']=$this->input->post('AdminContact');
			$data['IsActive']=$this->input->post('IsActive');
            $data["pre_profile_image"] = $this->input->post('ProfileImage');
			
			}
			else
			{
				if($this->input->post("AdminId")!="")
			{	
				$this->admin_model->admin_update();
				$this->session->set_flashdata('success','Record has been Updated Succesfully!');
				redirect('home/Adminlist');
				
			}
			else
			{  
				//echo "dsfdf";die;
				$this->admin_model->admin_insert();
				$this->session->set_flashdata('success', 'Record has been Inserted Succesfully!');
				redirect('home/Adminlist');
			
			}
				
			}
			//echo "<pre>";print_r($data);die;
			$this->load->view('Admin/AdminAdd',$data);
				
	}
	
	function Editadmin($AdminId){
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{
			$data=array();
			$result=$this->admin_model->getdata($AdminId);	
			$data['redirect_page']='AdminList';
			$data['AdminId']=$result['AdminId'];
			$data['FullName']=$result['FullName'];	
			$data['EmailAddress']=$result['EmailAddress'];	
			$data['Address']=$result['Address'];
			$data['ProfileImage']=$result['ProfileImage'];	
			$data['AdminContact']=$result['AdminContact'];
			$data['IsActive']=$result['IsActive'];			
			$this->load->view('Admin/AdminAdd',$data);	
		}
	}

	

	function deletedata(){
		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{

			if($this->input->post('gallery_image')!='')
			{
					if(file_exists(base_path().'upload/galleryimage/'.$this->input->post('gallery_image')))
					{
						$link=base_path().'upload/galleryimage/'.$this->input->post('gallery_image');
						unlink($link);
					}
			}
			$id=$this->input->post('id');
			$this->db->where("AdminId",$id);
			$res=$this->db->delete('tbladmin');
			echo json_encode($res);
			die;
		}
	}

	function adminmail_check($EmailAddress)
    {

		$query = $this->db->query("select EmailAddress from ".$this->db->dbprefix('tbladmin')." where EmailAddress = '$EmailAddress' and AdminId!='".$this->input->post('AdminId')."'");

		if($query->num_rows() == 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('adminmail_check', 'Email address is already exist.');
			return FALSE;
		}
    }
     

    function inquerylist()
	{
		if(!check_admin_authentication()){ 
			
			redirect(base_url());
		}else{	
		
			$data['result']=$this->login_model->getinquery();
			$this->load->view('Inquery/inquerylist',$data);
		}
	}
	 function email_check() {
		$query = $this->db->query("select EmailAddress from " . $this->db->dbprefix('tbladmin') . " where EmailAddress= '".$this->input->post('email')."'");
		//echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
			echo 1;die;
		} else {
			echo 0;die;
		}
	}

	function deleteinquery(){

		if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{

			$data= array('Is_deleted'=>'1');
			$id=$this->input->post('id');
			$this->db->where("inquery_id",$id);
			$res=$this->db->update('tblinquery',$data);
			//echo $this->db->last_query(); die;
			echo json_encode($res);
			die;
		}
	}
	function viewinquery($inqueryid){
			if(!check_admin_authentication()){ 
			redirect(base_url());
		}else{
			$data=array();
			$result=$this->login_model->getinquerydata($inqueryid);	
			$data['redirect_page']='inquerylist';
			$data['name']=$result['name'];
			$data['phone']=$result['phone'];	
			$data['email']=$result['email'];	
			$data['subject']=$result['subject'];
			$data['create_date']=$result['create_date'];					
			$this->load->view('Inquery/viewinquery',$data);	
		}
	}

	function importotp()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$otpcode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					
					$data[] = array(
					'otpcode'  => $otpcode,				
					);
				}
			}
			$data=insert_record('tblotpcode',$data);
			$this->session->set_flashdata('success', 'Record has been Inserted Succesfully!');
			redirect('home/Adminlist');

		} 
	}

	function importotpdata(){
		if(!check_admin_authentication()){ 
				redirect(base_url());
			}
			$data=array();
			$data['inquiry']=$this->login_model->getinquery();

			$data['student']=$this->student_model->getstudent();
			//echo "<pre>";print_r(count($data['student']));die;
		$this->load->view('common/addotpimport',$data);
	}

	function setting(){
    
    	if(!check_admin_authentication())
		{
			redirect('login');
		}                
		
		$data=array();
		$result=$this->login_model->getdatasite($this->session->userdata('AdminId'));
		//echo "<pre>";print_r($result);die;
		//$result=get_one_record('tblsitesetting',$this->session->userdata('AdminId'));
		$data['sitesetting_id']	=$result['sitesetting_id'];
		$data['mentor_step_link']=$result['mentor_step_link'];
		$data['student_payment']=$result['student_payment'];	
		$data['tollfree_number']=$result['tollfree_number'];
		$data["facebook_link"] 	= $result['facebook_link'];
		$data["whatsapp_link"] 	= $result['whatsapp_link'];
		$data["twitter_link"] 	= $result['twitter_link'];				
		$data["youtube_link"]	= $result['youtube_link'];
		$data["site_address"] 	= $result['site_address'];
		$data["site_choosementor"] 	= $result['site_choosementor'];	
		$data["status"] 		= $result['status'];
		$data["Is_deleted"] 	= $result['Is_deleted'];				
		$data["created_date"]   = $result['created_date'];			
	
		//$data['gstnumber']=$result->gstnumber;
		if($_POST){	
			
				$result=$this->login_model->update_setting($this->session->userdata('AdminId'));
				if($result==1)
				{
					$this->session->set_flashdata('success', 'Bank detail has been Updated Successfully!');
					redirect('home/setting');
				}
				
				else if($result==2)
				{
					$this->session->set_flashdata('error', 'Your data was not Update!');
					redirect('home/setting');
				}	
		}
        $this->load->view('common/site_setting',$data);    
    }

    function career_mentor(){
    	if(!check_admin_authentication())
		{
			redirect('login');
		}               
		
		$data=array();
		$result=$this->login_model->getdatasite($this->session->userdata('AdminId'));
		//echo "<pre>";print_r($result);die;
		//$result=get_one_record('tblsitesetting',$this->session->userdata('AdminId'));
		$data['sitesetting_id']	=$result['sitesetting_id'];
		$data['student_payment']=$result['student_payment'];	
		$data['tollfree_number']=$result['tollfree_number'];
		$data["facebook_link"] 	= $result['facebook_link'];
		$data["whatsapp_link"] 	= $result['whatsapp_link'];
		$data["twitter_link"] 	= $result['twitter_link'];				
		$data["youtube_link"]	= $result['youtube_link'];
		$data["site_address"] 	= $result['site_address'];
		$data["site_choosementor"] 	= $result['site_choosementor'];	
		$data["status"] 		= $result['status'];
		$data["Is_deleted"] 	= $result['Is_deleted'];				
		$data["created_date"]   = $result['created_date'];			
	
		//$data['gstnumber']=$result->gstnumber;
		if($_POST){
			$result=$this->login_model->update_setting($this->session->userdata('AdminId'));
			if($result==1)
			{
				$this->session->set_flashdata('success', 'Bank detail has been Updated Successfully!');
				redirect('home/career_mentor');
			}
			
			else if($result==2)
			{
				$this->session->set_flashdata('error', 'Your data was not Update!');
				redirect('home/career_mentor');
			}	
		}
        $this->load->view('career/career_mentor',$data);    
    }

}
?>