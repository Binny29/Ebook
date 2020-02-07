<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
      	parent::__construct();
		$this->load->model('login_model');
      
    }
	function index()
    {

    	$this->load->library("form_validation");
		$this->form_validation->set_rules('EmailAddress', 'Username', 'required|valid_email');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$data['EmailAddress']=$this->input->post('EmailAddress');
		$data['Password']=$this->input->post('Password');
		 if($this->form_validation->run() == FALSE){
			if(validation_errors())
			{
				echo json_encode(array("status"=>"error","msg"=>validation_errors()));
			}
			
		}else
		{
               
            $login =$this->login_model->check_login();
		 //echo $login;die;
		if($login == '1')
		{
			 //echo site_url();
         	$this->session->set_flashdata('success','Admin Login successfully');
			redirect('home/dashboard');
             
		}
		elseif($login == '2')
		{
                   
          $this->session->set_flashdata('success','Admin Login successfully');
			redirect('home/dashboard');
			
		}
        elseif($login == '3')
		{
				$this->session->set_flashdata('error','Your account is Inactive. Please contact Administrator!');
           
		}
		else{
				$this->session->set_flashdata('error','Enter valid email and password');
                
		}
        }
		$this->load->view('common/login');
			
    }
    public function logout()
	{
		
			$this->session->sess_destroy();
			redirect('Login');
	

	}
	
	

	
}
