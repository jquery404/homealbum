<?php

class Admin extends CI_Controller
{
	function ___construct()
	{
		parent::___construct();
		$this->is_logged_in();
	}
	
	function index()
	{
		$this->load->model("admins");
		$check = $this->admins->checkAdmin();
		if($check)
		{
			$orderlist = $this->admins->getOrders();
			
			// show files 
			$this->load->library('pagination');
			$this->load->library('table');
			$tmpl = array (
				 'table_open'  => '<table class="table table-striped table-bordered bootstrap-datatable datatable">',
				 'table_close' => '</table>'
			 );
			$this->table->set_template($tmpl);
			
			$data['records'] = $orderlist;			
			$this->load->view('admin/adminpage', $data);
		}
		else
		{
			redirect('login');
		}
		
		
		
	}
	
	function eLocalPhotos()
	{
		$this->form_validation->set_rules('lp_name', 'Package Name', 'trim|required|min_length[2]|max_length[25]');
		$this->form_validation->set_rules('lp_price', 'Price', 'trim|required|decimal');		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->packages();
		}
		else
		{
   			$this->load->model('admins');
			$query = $this->admins->manageLP();
			
			$this->session->set_flashdata('msgs', $query['msg']);
			redirect('admin/eLocalPhotos');
		}
	}
	
	function eInterPhotos()
	{
		$this->form_validation->set_rules('ip_name', 'Package Name', 'trim|required|min_length[2]|max_length[25]');
		$this->form_validation->set_rules('ip_no_discount', 'No Discount', 'trim|required');		
		$this->form_validation->set_rules('ip_discount_form', 'Discount From', 'trim|required');		
		$this->form_validation->set_rules('ip_discount_price', 'Discount Price', 'trim|required|decimal');		
		$this->form_validation->set_rules('ip_no_discount_price', 'Without Discount Price', 'trim|required|decimal');		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->packages();
		}
		else
		{
   			$this->load->model('admins');
			$query = $this->admins->manageIP();
			
			$this->session->set_flashdata('msgs', $query['msg']);
			redirect('admin/eInterPhotos');
		}
	}
	
	function eLocalDocs()
	{
		$this->form_validation->set_rules('ld_name', 'Package Name', 'trim|required|min_length[2]|max_length[25]');
		$this->form_validation->set_rules('ld_price', 'Price', 'trim|required|decimal');		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->packages();
		}
		else
		{
   			$this->load->model('admins');
			$query = $this->admins->manageLD();
			
			$this->session->set_flashdata('msgs', $query['msg']);
			redirect('admin/eLocalDocs');
		}
	}
	
	function eInterDocs()
	{
		$this->form_validation->set_rules('id_name', 'Package Name', 'trim|required|min_length[2]|max_length[25]');
		$this->form_validation->set_rules('id_price', 'Price', 'trim|required|decimal');		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->packages();
		}
		else
		{
   			$this->load->model('admins');
			$query = $this->admins->manageID();
			
			$this->session->set_flashdata('msgs', $query['msg']);
			redirect('admin/eInterDocs');
		}
	}
		
	function eOtherFees()
	{
		$this->form_validation->set_rules('of_name', 'Package Name', 'trim|required|min_length[2]|max_length[25]');		
		$this->form_validation->set_rules('of_finish_cost', 'Finishing Cost', 'trim|required|decimal');		
		$this->form_validation->set_rules('of_firstpage_color', 'Firstpage Color', 'trim|required|decimal');		
		$this->form_validation->set_rules('of_courier_nodiscount', 'Courier Amount (without Discount)', 'trim|required');		
		$this->form_validation->set_rules('of_courier_discount', 'Courier Amount', 'trim|required');		
		$this->form_validation->set_rules('of_courier_price_a', 'Courier Price No Discount', 'trim|required|decimal');		
		$this->form_validation->set_rules('of_courier_price_b', 'Courier Price Discount', 'trim|required|decimal');		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->packages();
		}
		else
		{
   			$this->load->model('admins');
			$query = $this->admins->manageOF();
			
			$this->session->set_flashdata('msgs', $query['msg']);
			redirect('admin/eOtherFees');
		}
	}
	
	
	function dLocalPhotos()
	{
		$this->load->model('admins');
		if($this->admins->deleteLP())
			echo "1";
		else
			echo "0";
	}
	
	function dInterPhotos()
	{
		$this->load->model('admins');
		if($this->admins->deleteIP())
			echo "1";
		else
			echo "0";
	}
	
	function dLocalDocs()
	{
		$this->load->model('admins');
		if($this->admins->deleteLD())
			echo "1";
		else
			echo "0";
	}
	
	function dInterDocs()
	{
		$this->load->model('admins');
		if($this->admins->deleteID())
			echo "1";
		else
			echo "0";
	}
	
	function dOtherFees()
	{
		$this->load->model('admins');
		if($this->admins->deleteOF())
			echo "1";
		else
			echo "0";
	}
	
	
	function getOrder($id)
	{
		$this->load->model("admins");
		$results = $this->admins->getOrderbyId($id);	
		$file_id; $file_type; $file_pack; 
		$total_copy; $recip_id; $sender_id;
		//print_r($results);	
		
		$orderDetails = $fileLists = array();
		
		foreach($results as $res)
		{			
			foreach($res as $i=>$r)
			{
				if($i == "file_id")
					$file_id= $r;
				else if($i == "file_type")
					$file_type= $r;	
				else if($i == "file_pack")
					$file_pack= $r;	
				else if($i == "total_copy")
					$total_copy= $r;					
				else if($i == "sender_id")
					$sender_id= $r;					
				else if($i == "recip_id")
					$recip_id= $r;										
			}			
		}
		
		$file_id = explode(",", $file_id);
		$file_type = explode(",", $file_type);
		$file_pack = explode(",", $file_pack);
		$total_copy = explode(",", $total_copy);		
		$recip_id = explode(",", $recip_id);		
		
		$fInfo = $this->getFileInfoById($file_id);		
					
		for($i = 0; $i< count($file_id); $i++)
		{
			array_push($fileLists, 
					$fInfo['file_cat_id'][$i]. ",". $fInfo['file_name'][$i]. "," . 
					$file_type[$i] . ",". $file_pack[$i]. ",". $total_copy[$i]);
					//$file_id[$i] . ",". 
		}
		
		
		
		// sender contact
		if($sender_id < 0)
		{		
			$this->load->model("admins");
			$results = $this->admins->userContact(abs($sender_id));
			$sender = $results;
		}	
		else
		{
			$sender_id = explode(',', $sender_id);
			$this->load->model("admins");
			$results = $this->admins->addressbookContact($sender_id);
			$sender = $results;
		}
		
		
		
		$receiver = array();
		// recep_contact
		for($i = 0; $i< count($recip_id); $i++)
		{
			if($recip_id[$i] < 0)
			{	
				$myId = abs($recip_id[$i]);
				array_splice($recip_id, $i, 1);
				
				$this->load->model("admins");
				$results = $this->admins->userContact($myId);
				array_push($receiver, $results[0]);
			}				
		}
		
		if(count($recip_id) >= 1)
		{			
			$this->load->model("admins");
			$results = $this->admins->addressbookContact($recip_id);
			for($i = 0; $i< count($results); $i++)
				array_push($receiver, $results[$i]);
		}
		
		$orderDetails['allfiles'] = $fileLists;		
		$orderDetails['sender'] = $sender;
		$orderDetails['receiver'] = $receiver;
		
		
		
		echo json_encode($orderDetails);
		
		
	}
	
	
	function editOrderStatus($id)
	{
		$this->load->model("admins");
		$results = $this->admins->cngOrderStatus($id);
		
		echo "true";
	}
	
	function delOrder($id)
	{
		$this->load->model("admins");
		$results = $this->admins->deleteOrder($id);
		
		echo "true";
	}
	
	
	
	
	function getFileInfoById($ids)
	{
		$this->load->model("admins");
		$results = $this->admins->loadFilebyId($ids);
		
		$file_info = $file_name = $file_cat_id = array();
		
		foreach($results as $res)
		{			
			foreach($res as $i=>$r)
			{
				if($i == "cabinet_id")
				{
					array_push($file_cat_id, $r);
				}
				else if($i == "file_name")
				{
					array_push($file_name, $r);
				}
			}
		}
		
		$file_info['file_cat_id'] = $file_cat_id;
		$file_info['file_name'] = $file_name;
		
		return $file_info;	
	}
	
	
	function packages()
	{
		$this->load->model('admins');
		$totalPackages = array();
		$localPhotos = $this->admins->getLocalPhotos();			
		$localDocs = $this->admins->getLocalDocs();
		$interPhotos = $this->admins->getInterPhotos();
		$interDocs = $this->admins->getInterDocs();
		$orderFees = $this->admins->getOrderFees();
		
		$totalPackages['local_photos'] = $localPhotos;
		$totalPackages['local_docs'] = $localDocs;
		$totalPackages['inter_photos'] = $interPhotos;
		$totalPackages['inter_docs'] = $interDocs;
		$totalPackages['order_fees'] = $orderFees;
		
		$data['allpackages'] = $totalPackages;
		$data['msg'] = $this->session->flashdata('msgs');
		
		
		$this->load->view('admin/packages', $data);		
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