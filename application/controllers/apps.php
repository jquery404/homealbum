<?php

	class Apps extends CI_Controller
	{
	
		function __construct()
		{
			parent::__construct();
		}
		
		function index()
		{
			$data['title'] = "Home Album";
			$data['header'] = "Welcome to Home Album";
			
			
			
			
			if($this->is_logged_in())
			{
				$data['logged_in'] = true;
				$data['main_content'] = "homepage";
			} 
			else 
			{
				$data['main_content'] = "login/loginpage";
			}
			
			$this->load->view('include/template', $data);
			
			
		
		}
		
		function is_logged_in()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in != true)
			{
				return false;
			}
			else 
			{
				return true;
			}
		}
		
		
	
	
	}


?>