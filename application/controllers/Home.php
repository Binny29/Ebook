<?php
//echo phpinfo();die;
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		error_reporting(E_ALL);
      	parent::__construct();
      	$this->load->model('home_model');
		$this->load->library("pagination");
    }

    function index(){
    	
    	$this->load->view('common/Home',$data);
    }

}




