<?php

class User extends CI_Controller{

	function orderpage(){
	
		$data['header'] = "Welcome to orderpage";
		$data['title'] = "Home Album";

		$data['main_content'] = "userarea/orderpage";

		$this->load->view('include/template', $data);
	
	}

	function iframe(){
	
		$data['header'] = "Welcome to orderpage";
		$data['title'] = "Home Album";

		$data['main_content'] = "userarea/iframe";

		$this->load->view('include/template', $data);
	
	}




}

