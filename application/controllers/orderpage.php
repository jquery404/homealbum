<?php

class Orderpage extends CI_Controller
{
	function ___construct()
	{
		parent::___construct();
		$this->is_logged_in();
	}
	
	function place()
	{
		$this->load->model('order');
		$fileList = $this->input->post('filelist');		
		$fileId = $this->input->post('fileid');
		$fileList = explode(",", $fileList);
		$fileId = explode(",", $fileId);
		
		$data['package_list'] = $this->order->getPackDetails();
		$data['file_list'] = $fileList;
		$data['file_id'] = $fileId;
		$data['contact_list'] = $this->contactShow();
		$data['user_contact'] = $this->myAddress();
		$data['title'] = 'Your cabinet';
		$data['main_content'] = 'userarea/orderpage';
		
		$this->load->view('include/template', $data);		
	}
	
	
	function success()
	{
		//echo "Your order has been submitted successfully . Now <a href='".base_url()."index.php/cabinet/show_cabinate_files'>Go Back</a>";
		echo "<br/><br/><br/><br/><center><img src=".base_url()."assets/imgs/preloader.gif /></center>";
	}	
	
	function package()
	{
		$data['title'] = 'Your cabinet';
		$data['main_content'] = 'userarea/package';
		
		$this->load->view('include/template', $data);
	}
	
	function payment()
	{
		if($this->input->post('submit'))
		{	
			$this->load->model("order");
			$orderID = $this->order->placeOrder();
			
			$pack = ($this->input->post('package_n') == 'local') ? 'local' : 'international';
			$totalprice = $this->input->post('tcosting');
			$senderId = $this->input->post('sender_id');
			$recipId = $this->input->post('recip_id');	
			
			$data['order_id'] = $orderID;
			$data['total_amount'] = $totalprice;	
			$data['pack'] = $pack;	
			$data['sender'] = $senderId;	
			$data['recipent'] = $recipId;	
			$data['title'] = 'Your cabinet';	
			$data['main_content'] = 'userarea/payment_lists';
			$this->load->view('include/template', $data); 
		
		}
	
	}
	
	
	function confirmation()
	{
		$data['title'] = 'Your cabinet';
	
		if($this->input->post('submit')){
			$data['payment_id'] = $this->input->post('p_choosed');
			$data['total_amount'] = $this->input->post('p_amount');
			$data['pack'] = $this->input->post('p_pack');
			$sender = $this->input->post('p_sender');
			$receiver = $this->input->post('p_receiver');			
			
			if($sender < 0)			
				$sender_contact = $this->myAddress();			
			else{ 			
				$se = explode( ',', $sender);
				$sender_contact = $this->getsContactById($se);
			}
			
			$ra = explode( ',', $receiver);
			foreach ($ra as $val)
			{
				if($val < 0){// mycontact					
					$user_contact = $this->myAddress();
					$data['extracon'] = $user_contact;
				}			
			}
			
			$receiver = str_replace('-1,', '', $receiver);
			$receiver = str_replace(',-1', '', $receiver);
			
			$re = explode( ',', $receiver);
			
			$receiveContact = $this->getsContactById($re);
			
			/* print_r($user_contact);*/
			
			 
			$data['sender'] = $sender_contact;						
			$data['receiver'] = $receiveContact;
			
			$data['order_date'] = date("m/d/Y H:i:s");		
			$data['order_number'] = rand(111111,999999)."-".rand(100,999)."-".rand(1000,9999);				

			$data['file_details'] = "Cartoon Cake<br />
								Select Cake Weight - 1.5 kg<br/>
								Select Cake Flavor - Vanilla<br/>";	
		}
		else
		{
			$data['payment_id'] = null;			
		}
		
		$data['main_content'] = 'userarea/payment_confirmed';
		$this->load->view('include/template', $data);
	}

	
	/*
	* Contact Options
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
	
	function getsContactById($cID)
	{
		$id = $this->session->userdata('userid');				
		$this->db->where_in('id', $cID);	
		$this->db->select('name, address, number, mail, country');
		$results = $this->db->get('my_contact');
		
		return $results->result();	
		
	}	
	
	
	/*
	* Global Section
	*/
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || !$is_logged_in)
		{
			//die();
			redirect('/login');
		}
		else
			$this->loggedIn = true;			
	}
	
	
}