<?php

class Cabinet extends CI_Controller
{
	var $path;
	var $foldername;
	var $userID;
	
	function ___construct()
	{
		$this->load->helper('directory');
		parent::___construct;
		$this->is_logged_in();
	}
	
	
	function create_cab()
	{
		$this->foldername = $this->session->userdata('usermail');	
		$this->path = 'application';		// . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . $this->foldername
		$files = directory_map($this->path);
		$data['filelists'] = $files;
		$data['title'] = 'Your cabinet';
		$data['main_content'] = 'userarea/cabinet';
		
		$this->load->view('include/template', $data);
	}
	
	function create()
	{
		
		$this->load->model('cabinets');
		
		if($query = $this->cabinets->setCabinetData())
		{
			echo "true";
		}
		else 
		{
			echo "false";
		}
		
	}
	
	function cabinate_files()
	{
		if (count($_POST) > 0)
		{		
			$this->session->set_userdata('cab_files', $_POST);			
			redirect('cabinet/cabinate_files');
		}
		else
		{
			if($this->session->userdata('cab_files'))
			{
				$_POST = $this->session->userdata('cab_files');
				
				$this->load->model('cabinets');
				$query = $this->cabinets->cabOpen();
				
				if($query['response'])
				{			
					$total_files = $query['message'];
					$files = $query['data'];
					$totalpage = $query['message'];
					$data['root'] = 1;  
					$data['cabinet_info'] = $files;
					$data['username'] = $this->session->userdata('username');
					$data['cab_name'] = $this->input->post('cab_head');
					$data['cab_id'] = $this->input->post('cab_id');	
					
					//print_r($files);
					
					// show files 
					$this->load->library('pagination');
					$this->load->library('table');
					$tmpl = array (
						 'table_open'  => '<table id="minimalist" class="cabinet_tree_list">',
						 'table_close' => '</table>'
					 );
					$this->table->set_template($tmpl);
					
					$data['records'] = $files;
				
				}
				else
				{
					$data['root'] = 0;  
					$data['cabinet_info'] = $query['message'];
					$data['username'] = $this->session->userdata('username');
					$data['cab_name'] = $this->input->post('cab_name');			
					$data['cab_id'] = $this->input->post('cab_id');	
				}
				 
				$data['title'] = 'Your cabinet';
				$data['main_content'] = 'userarea/cabinet_file_list';
				$this->load->view('include/template', $data);
				
				//$this->session->unset_userdata('cab_files');
			}
			else
			{
				redirect('login');
			}
		}
	
	}
	
	function search_file($offset = 0)
	{		
		if(count($_POST) > 0)
		{
			$search_query = array(
				'search_type' => $this->input->post('search_by'),
				'search_term' => $this->input->post('cab_file_search')
			);
			
			$this->session->set_userdata('search_q', $search_query);
			redirect('cabinet/search_file');
		}
		else
		{
			if($this->session->userdata('search_q'))
			{				
				$limit = 10;							
				$sort_order = "asc";
				
				$s_query = $this->session->userdata('search_q');
				
				$this->load->model('cabinets');				
				$results = $this->cabinets->cabFileSearch($s_query, $limit, $offset, $sort_order);
								
				
				$this->load->library('pagination');
				$config['base_url'] = site_url('/cabinet/search_file/');
				$config['total_rows'] = $results['num_rows'];
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';
				
				
				$this->pagination->initialize($config);
								
				
				$this->load->library('table');
				$tmpl = array (
					 'table_open'          => '<table id="minimalist" class="cabinet_tree_list">',
					 'table_close'         => '</table>'
				 );
				$this->table->set_template($tmpl);
				
				
				$data['records'] = $results['results'];

				$data['title'] = 'Your cabinet';
				$data['search_for'] = $s_query['search_term'];
				$data['main_content'] = 'userarea/cabfile_search_results';
				
				$this->load->view('include/template', $data); 
				
				
			}
			else
			{
				redirect('login');
			}
			
		}
		
		
	
	
	
		
		
		
		/* 
		
		$config['base_url'] = 'http://localhost/homealbum/index.php/cabinet/search_file';
		
		$this->db->like($search_type, $search_term); 
		$config['total_rows'] = $this->db->get('cabinet_files')->num_rows();		
		$config['per_page'] = 2;
		$config['num_links'] = 4;
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		 */
		//$this->db->like($search_type, $search_term); 
		/* $records = $this->db->get('cabinet_files', $config['per_page'], $this->uri->segment(3));
		foreach ($records->result() as $item)
        {
            $q[] = $item;
        }
        $data['records'] = $q;

		$data['title'] = 'Your cabinet';
		$data['search_for'] = $search_term;
		$data['main_content'] = 'userarea/cabfile_search_results';
		
		$this->load->view('include/template', $data); */
	}
	
	function file_list()
	{
		$is_ajax = $this->input->post('ajax');
		$id = $this->input->post('id');
		$pass = $this->input->post('pass');

		
		if($is_ajax)
		{
			$this->load->model('cabinets');
			$query = $this->cabinets->getCabinetFileWithPass($id, $pass);
			
			
			
			if($query == NULL)
			{
				echo "password didn't match";
			}
			else if($query == false)
			{
				echo "no files";
			}
			else
			{
				echo json_encode($query);
			}		
		} 
		
		
	}

	function add_files()
	{
		if($this->input->post('upload'))
		{
			
		}
		
		$data['title'] = 'Cabinet Files | Homealbum';
		$data['header'] = '';
			
		$data['main_content'] = 'userarea/cabinet_files';					
				
		$this->load->view('include/template', $data);
	
	}
	
	function show_files($id)
	{
		$this->load->model('cabinets');
		$query = $this->cabinets->getCabinetFile($id);
		if($query == NULL)
		{
			$data['status'] = "No files under this cabinet. Back to cabinet page <a href='javascript:window.history.go(-1);'>Go back</a>";
		}
		else
		{
			$data['filelist'] = $query;
		
		}
		
		$data['title'] = 'Cabinet Files | Homealbum';
		$data['header'] = '';
			
		$data['main_content'] = 'userarea/cabinet_files';					
				
		$this->load->view('include/template', $data);
	}
	
	
	function delete_file()
	{			
		$this->load->model('cabinets');
		$this->cabinets->cabFileDelete();	
		echo "Deleted successfully";		
	}
	
	
	function do_upload()
	{
	
		if (count($_POST) > 0)
		{	
			$user = $this->session->userdata("usermail");
			$cab_id = $this->input->post('cabid');
			$file_path = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . $user . DIRECTORY_SEPARATOR . $cab_id . DIRECTORY_SEPARATOR;			
			
			// if dir does't exists create one
			if(!is_dir($file_path)) 
				mkdir($file_path, 0777);
			
			$this->load->model('cabinets');
			$upload = $this->cabinets->cabFileUpload($file_path);
			
			$this->session->set_userdata('upload_cabfile', $upload);
			
			redirect('cabinet/do_upload');
		}		
		
		else
		{			
			if($this->session->userdata('upload_cabfile'))				
			{
				$data['msgs'] = $this->session->userdata('upload_cabfile');
				$data['title'] = 'Upload Files | Homealbum';				
				$data['main_content'] = 'userarea/upload_cabinet';
				$this->load->view('include/template', $data);
			}
			else
			{
				redirect('login');
			}
		}
		
	}
	
	
	
	/*
	* Cabinet Sections
	*/
	
	
	function delete_cabinet()
	{	                                                                                                  	
		$this->load->model('cabinets');
		$this->cabinets->cabDelete();
		
		redirect('/login');	
	}
	
	function repass_cabinet()
	{
		$this->load->model('cabinets');
		
		if($this->cabinets->cabRepass())
		{
			echo "Password Changed";
		}
		else
		{
			echo "Somethings went wrong";
		}
	}
	
	function edit_cabinet()
	{
	
	
	}
	
	function rename_cabinet()
	{		
		$this->load->model('cabinets');
		if($this->cabinets->cabRename())
		{
			echo "Update Successfull";
		}
		else
		{
			echo "Somethings went wrong";
		}
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
	
	
	
	/* $config['base_url'] = 'http://localhost/homealbum/index.php/cabinet/cabinate_files';
			$config['total_rows'] = $total_files;
			$config['per_page'] = 2;
			$config['num_links'] = 20;
			$config['full_tag_open'] = '<div class="pagination">';
			$config['full_tag_close'] = '</div>';
			$this->pagination->initialize($config); 			
			
			$this->db->select('cabinet_id, file_name, file_type, file_size, file_create_date, file_modify_date, tag_name');
			$records = $this->db->get_where('cabinet_files', array('cabinet_id' => $data['cab_id']));
			
			if($records->num_rows > 0):
				foreach ($records->result() as $item) 
					$q[] = $item;        
				$data['records'] = $q;	
			endif; */
	
}