<?php

class Mycontact extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}


	function init()
	{
		
		$data['userid'] = $this->session->userdata('userid');
		$data['title'] = 'Your cabinet';
		$data['main_content'] = 'userarea/my_contact';		
		$data['contact_list'] = $this->show();
		$this->load->view('include/template', $data);
		
		
	}
	
	
	function addnew()
	{
		if($this->input->post('submit'))
		{
			$this->load->model('contacts');
			$response = $this->contacts->add();		
			/* if($response)
			{
				redirect('mycontact/init');
			} */
		}
	}
	
	function addContact()
	{
		$this->form_validation->set_rules('c_full_name', 'Name', 'trim|required|min_length[6]|max_length[25]');		
		$this->form_validation->set_rules('c_address', 'Address', 'trim|required');			
		$this->form_validation->set_rules('c_emailid', 'Email address', 'trim|required|valid_email');		
		$this->form_validation->set_rules('c_pnumber', 'Contact Number', 'trim|required|is_natural');			
		$this->form_validation->set_rules('c_country', 'Country', 'trim|required|alpha');			
	
		if($this->form_validation->run() == FALSE)
		{
			$data = array(				
				'results' => 'error',
				'msg' => validation_errors('<p class="error">')
			);
			
			echo json_encode($data);
		}
		else
		{
			// -1 for user already exists			
			$this->load->model('contacts');
			$q = $this->contacts->add();
			if(!$q)
			{
				$data = array(				
					'results' => 'error',
					'msg' => 'Contact already exists'
				);
				echo json_encode($data);
			}
			else
			{
				$data = array(				
					'results' => 'success',
					'msg' => $q
				);
				echo json_encode($data);
			}	
			
		}	
	}
	
	
	
	
	function show()
	{
		$this->load->model('contacts');
		$res = $this->contacts->gets();		
		return $res;
	}
	
	function delete()
	{
		
		$this->load->model('contacts');
		if($this->contacts->del())
			return true;
		else 
			return false;
	
	}
	
	function edit_contact()
	{
		$this->load->model('contacts');
		if($this->contacts->edit())
		{
			echo "Update Successful";
		}
		else 
		{
			echo "Error Occured!";
		}
	
	}
	
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


