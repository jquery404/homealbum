<?php

class Upload extends CI_Controller
{
	function ___construct()
	{
		parent::___construct();
		$this->is_logged_in();	
	}
	
	function add($id)
	{	
		$data['title'] = "Upload files | Home Album";
		$data['header'] = "Welcome to Home Album";
		$data['id'] = $id;
		$data['main_content'] = "userarea/upload_cabinet";
					
		$this->load->view('include/template', $data);
	
	}
	
	function do_upload()
	{
		$user = $this->session->userdata("usermail");
		$file_path = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . $user . DIRECTORY_SEPARATOR;		
		$config['upload_path'] = $file_path; 
		$config['allowed_types'] = 'ai|ait|bmp|cdr|cgm|dwg|dxf|doc|docx|eps|epsf|emf|pdf|
									fxg|html|gif|jpg|png|pct|psd|pdd|pcx|pxr|ppt|pptx|
									swf|tif|tiff|tga|txt|svgz|svg|wmf|xl|xls';
		$config['max_size']	= '100000';
		$config['max_width']  = '10024';
		$config['max_height']  = '10768';
		$time = date("m/d/Y H:i:s");;
		$id = $this->input->post('cabid');
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$data['title'] = "Upload files | Home Album";
			$data['header'] = "Welcome to Home Album";
			$data['id'] = $id;
			$data['main_content'] = "userarea/upload_cabinet";
			$data['error'] = $error;
			
			$this->load->view('include/template', $data);			
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//print_r($data);
			
			$new_cabinet_file = array(
				'cabinet_id' => $id,
				'file_name' => $data['upload_data']['file_name'],
				'file_type' =>  $data['upload_data']['file_type'],
				'file_create_date' => $time,
				'file_modify_date' => $time,
				'file_size' => $data['upload_data']['file_size'],
				'tag_name' => 'hello'
			);
			$this->load->model('cabinets');
			$this->cabinets->addCabinetFileList($new_cabinet_file);
			
			$data['username'] = $this->session->userdata('username');
			$data['cab_name'] = $this->input->post('cab_head');
			$data['cab_id'] = $id;

			$data['title'] = 'Your cabinet';
			$data['main_content'] = 'userarea/cabinet_file_list';
			
			
			//$this->load->view('upload_success', $data);
		}
	}
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || !$is_logged_in)
		{
			die();
		}
		else
		{			
			
			
		}
	}
	

}