<?php

class Share extends CI_Controller
{

	function ___construct()
	{
		parent::___construct();
		$this->is_logged_in();	
	}

	
	function files()
	{
		$this->form_validation->set_rules('share_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('share_msg', 'Message', 'trim|required|min_length[6]|max_length[150]');
		$this->form_validation->set_rules('share_attachement', 'Attachement', 'trim|required');
		

		if($this->form_validation->run() == FALSE)
		{
			$data = array(				
				'results' => 'error',
				'msg' =>  ''
			);
			
			echo json_encode($data);
			
		}
		else
		{
			$this->load->library('email');

			$this->email->from('admin@homealbum.org', 'Homealbum.org');
			$this->email->to($this->input->post('share_email')); 
			$this->email->subject('Homealbum Share');
			$this->email->message('Thanks for sharing.');	

			$attach = $this->input->post('share_attachement');
			$attach_arr = explode(',', $attach);
			
			$user = $this->session->userdata("usermail");
			$cab = $this->session->userdata('cab_files');
			$cab_id = $cab['cab_id'];
			$file_path = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . $user . DIRECTORY_SEPARATOR . $cab_id . DIRECTORY_SEPARATOR;			
			
			foreach ($attach_arr as $arr)
				$this->email->attach($file_path . $arr);
				
			$this->email->send();
			
			$data = array(				
				'results' => 'success',
				'msg' => ''
			);
			
			echo json_encode($data);
		}
		
		
		//echo $this->email->print_debugger();
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

