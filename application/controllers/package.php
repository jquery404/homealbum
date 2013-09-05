<?php

require_once('homealbum.php');

class Package extends Homealbum
{

	function __construct()
	{
		parent::__construct();		
		if(!$this->getLogged())
			redirect('/login');			
	}
	
	function quickdoc()
	{		
		$data['title'] = 'Send a Quick Message';
		$data['contact_list'] = $this->contactShow();
		$data['user_contact'] = $this->myAddress();
		
		$data['main_content'] = 'userarea/quickdoc';
		
		$this->load->view('include/template', $data);
	
	}
	
	
	function photos($val = 3)
	{	
		$data['title'] = 'Send a Photos';
		$data['type'] = $val;
		$data['contact_list'] = $this->contactShow();
		$data['user_contact'] = $this->myAddress();
		$data['main_content'] = 'userarea/photos_package';
		$this->load->view('include/template', $data);
	
	}
	
	function do_packup()
	{
		/* print_r($_POST);
		print_r($_FILES);
	 */
		if($this->input->post('submit'))
		{
			$pack = 'international';
			$msg = $this->input->post('write_mail');
			$totalprice = $this->input->post('tcosting');
			$senderId = $this->input->post('sender_id');
			$recipId = $this->input->post('recip_id');
			
			$data['order_id'] = rand(111111,999999)."-".rand(100,999)."-".rand(1000,9999);			
			$data['total_amount'] = $totalprice;	
			$data['pack'] = $pack;	
			$data['sender'] = $senderId;	
			$data['recipent'] = $recipId;	
			$data['title'] = 'Your cabinet';	
			$data['main_content'] = 'userarea/payment_lists';
			$this->load->view('include/template', $data); 
		
		}
	}
	
	function payment()
	{
		
	
	}
	
	function do_upload()
	{
		//print_r($_POST);
		//print_r($_FILES);
		
		$msg = "<br/><br/>Your order has been submitted. Thanks for using Homealbum.";
		$msg .= "<br/><br/>". anchor("/login", 'Back to Cabinet'). ".";
		$msg .= "<br/><br/>";
		$this->MessageBox($msg);
	}
	
	
	/*
	* Contacts 
	*/
	
	function contactShow()
	{
		$this->load->model('contacts');
		$res = $this->contacts->gets_srcOrder();		
		return $res;
	}
	
	function myAddress()
	{
		$this->load->model('membership');
		$res = $this->membership->getContact();		
		return $res;
	}
	
	




}