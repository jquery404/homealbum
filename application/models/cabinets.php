<?php

class Cabinets extends CI_Model
{
	
	
	function getCabinet($id)
	{
		$this->db->where('user_id', $id);
		$query = $this->db->get('cabinet_list');
		
		if($query->num_rows >= 1)
		{
			return $query->result();
		
		}
		else
		{ 
			return null;
		}
	
	}
	
	function getCabinetFile($id)
	{
	
		$this->db->where('cabinet_id', $id);
		$query = $this->db->get('cabinet_files');
		if($query->num_rows >= 1)
		{
			return $query->result();		
		}
		else
		{ 
			return null;
		}
		
	}
	
	function getCabinetFileWithPass($id, $pass)
	{
		$this->db->where('id', $id);
		$this->db->where('password', md5($pass));
		
		$query = $this->db->get('cabinet_list');
		
		
		
		if($query->num_rows >= 1)
		{
			$qr = $this->getCabinetFile($id);
			
			return $qr;
			
		
		}
		else
		{ 
			return null;
		}
		
	}
	
	function setCabinetData()
	{
		$cbname = $this->input->post('name');
		
		$new_cabinet = array(
			'cname' => $this->input->post('name'),
			'protected' => $this->input->post('protect'),
			'password' => md5($this->input->post('pass')),
			'description' => $this->input->post('description'),
			'user_id' => $this->input->post('id')
		);
		$this->db->where('cname', $cbname);
		$query = $this->db->get('cabinet_list');
		
		if ($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$qu = $this->setCabinetList($new_cabinet);
			return $qu;
		}
	}
	
	function setCabinetList($new)
	{
		$qu = $this->db->insert('cabinet_list', $new);
		return $qu;		
	}	

	function isCabFileExists($id, $name, $type)
	{		
		$array = array('cabinet_id' => $id, 'file_name' => $name, 'file_type' => $type);
		$this->db->where($array); 
		$query = $this->db->get('cabinet_files');	
		
		return $query->num_rows;		
	}
	
	function isCabinet()
	{
		$id = $this->session->userdata('userid');
		$cabid = $this->input->post('cab_id');
		$cabpass = md5($this->input->post('cab_pass'));
		
		$this->db->where('user_id', $id);
		$this->db->where('id', $cabid);
		$this->db->where('password', $cabpass);
		
		$query = $this->db->get('cabinet_list');
		
		if($query->num_rows > 0)
		{
			$rows = $this->fetch_cabinet_files($cabid);
			return $rows;
		}
		else 
			return null;
	}
	
	function fetch_cabinet_files($id)
	{
		$this->db->where('cabinet_id', $id);
		$query = $this->db->get('cabinet_files');
		
		if($query->num_rows >= 1)
		{
			$results = array(
				'errors' => 0,
				'files' => $query->result()
			);			
		}
		else 
		{
			$results = array(
				'errors' => 1,
				'files' => ''
			);			
		}
		
		return $results;
		
		
	}
	
	
	
	function delete_cab_files($cid, $files)
	{
		$this->db->where('cabinet_id', $cid);
		$this->db->where('file_name', $files);
		$this->db->delete('cabinet_files');
	}
	
	
	
	/*
	* Cabinet Utility Check
	*/
	
	function validateCabinet($pass)
	{
		$userid = $this->session->userdata('userid');		
		$cabid = $this->input->post('cab_id');
				
		$query = $this->db->get_where('cabinet_list', array('id' => $cabid, 'user_id' => $userid, 'password' => $pass));
		
		return $query->num_rows;
	}
	
	function hasFile()
	{
		$userid = $this->session->userdata('userid');		
		$cabid = $this->input->post('cab_id');
		
	
		if($cabid)
		{
			/* 
			SELECT  `file_name` 
			FROM  `cabinet_files` 
			WHERE  `cabinet_id` = 2 
			*/
			
			$query = $this->db->get_where('cabinet_files', array('cabinet_id' => $cabid));				
			
			
			if($query->num_rows > 0)
			{							
				$data = array(
					'response' => 1, 
					'message' => $query->num_rows,
					'data' => $query->result()
				);
			}
			else 
			{
				$data = array(
					'response' => 0, 
					'message' => 'No files under this cabinet'
				);
			}
			
			return $data;
			
		}
		else 
		{
			$data = array(
				'response' => 0, 
				'message' => '<h4>Invalid request</h4>'
			);
			return $data;
		}
		
		//echo $userid. " - ". $cabid;
		//$cabpass = md5($this->input->post('cab_pass'));
	}
	
	
	
	
	
	
	
	
	
	/*
	* Cabinet Sections
	*/
	
	// cabinet file search
	function cabFileSearch($query, $limit, $offset, $sortorder)
	{
		$search_by =  $query['search_type'];
		$search_term = $query['search_term'];
		
		
		// gets results
		$q = $this->db->select('cabinet_id, file_name, file_type, file_create_date, file_modify_date, file_size')
			->from('cabinet_files')
			->limit($limit, $offset)
			->order_by('file_name', $sortorder);
		
		$q->like($search_by, $search_term);	
		
		$out['results'] = $q->get()->result();
		
		// counts
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('cabinet_files');
			
		$q->like($search_by, $search_term);				
		
		$tmp = $q->get()->result();
		$out['num_rows'] = $tmp[0]->count;
		
		return $out;
	}
		
	// open cabinet
	function cabOpen()
	{
		// check if password protected		
		$cabpass = (!$this->input->post('cab_pass')) ?  null : md5($this->input->post('cab_pass'));

		if($cabpass != null):
			$check = $this->validateCabinet($cabpass);
			
			if($check):
				// check if this cabinet has files 
				$cabcheck = $this->hasFile();
				return $cabcheck;
			else:
				$data = array(
					'response' => 0, 
					'message' => "Your cabinet password didnot match"
				);
				return $data;
			endif;
			
		else:
			// check if this cabinet has files 
			$cabcheck = $this->hasFile();
			
			return $cabcheck;
			
		endif;	
	}
	
	
	// delete cabient
	function cabDelete()
	{
	
		// check if there are any files inside this cabinet	
		$user_id = $this->session->userdata('userid');
		$cabinet_id = $this->input->post('cab_id');
		
		$user = $this->session->userdata("usermail");
		$cab_file_root = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR;				
		$path = $cab_file_root . $user . DIRECTORY_SEPARATOR . $cabinet_id . DIRECTORY_SEPARATOR;				
		
		$query = $this->db->get_where('cabinet_files', array('cabinet_id' => $cabinet_id));
		
		// if files exists
		if($query->num_rows > 0)
		{ 		
		$this->recursive_remove_directory($path);
		return $this->db->query("DELETE cabinet_files, cabinet_list 
						FROM cabinet_files, cabinet_list 
						WHERE cabinet_list.id=". $cabinet_id. " AND cabinet_files.cabinet_id= " . $cabinet_id. " AND cabinet_list.user_id=". $user_id); 
		}
		// no files
		else
		{
		$this->recursive_remove_directory($path);
		return $this->db->delete('cabinet_list', array('id' => $cabinet_id, 'user_id' => $user_id)); 
		}
	
	}
	
	// rename cabinet
	function cabRename()
	{
		$userID = $this->session->userdata('userid');
		$cabID = $this->input->post('cab_id');
		$cabName = $this->input->post('cab_name');
		$cabNameNew = $this->input->post('cab_name_new');
		
		if($cabID!='' && $cabName!='' && $cabNameNew!='')
		{
			$val = array('id' => $cabID, 'cname' => $cabName, 'user_id' => $userID);
			$data = array('cname' => $cabNameNew);
			$this->db->where($val); 			
			$this->db->update('cabinet_list', $data); 
			
			if($this->db->_error_number())
				return false;
			else return true;	
			
		}
		else
		{
			return false;
		}
	
	}
	
	// edit cabinet password 
	function cabRepass()
	{
		$userID = $this->session->userdata('userid');
		$cabID = $this->input->post('cab_id');
		$cabName = $this->input->post('cab_name');
		$cabPass = md5($this->input->post('cabinet_pass_prev'));
		$cabPassNew = md5($this->input->post('cabinet_pass'));
		
		if($cabID!='' && $cabName!='' && $cabPass!='' && $cabPassNew!='')
		{			
			$check = $this->validateCabinet($cabPass);
			if($check):
			$val = array('id' => $cabID, 'cname' => $cabName, 'user_id' => $userID, 'password' => $cabPass);
			$data = array('password' => $cabPassNew);
			$this->db->where($val); 			
			$this->db->update('cabinet_list', $data); 
			return true;
			else:
			return false;
			endif;
		}
		else
		{
			return false;
		}
	}
	
	// insert file to cabinet
	function cabFileInsert($data, $path)
	{					
		$length =  count($data['file_list']['name']);
		$filetree; $message = array();
		
		for($i=0; $i < $length; $i++){
		
			foreach($data['file_list'] as $j=>$file)
			{
				//&& $j != "tmp_name"
				if($j != "error"){
					$f[$j] = $file[$i];
				}				
			}
			$filetree[$i] = $f;
		}
		
		for($i=0; $i < $length; $i++){
		
			//check if file exists
			if($this->isCabFileExists($data['cabinet_id'], $filetree[$i]['name'], $filetree[$i]['type']))
			{
				// file_exists
				$val = "<p class='error'><strong>" .$filetree[$i]['name']. "</strong> already exists !</p>";
				array_push($message, $val);
			}
			else
			{
				$f_ext = pathinfo($filetree[$i]['name']);
				
				$new_cabinet_file = array(
					'cabinet_id' => $data['cabinet_id'],
					'file_name' => $filetree[$i]['name'],
					'file_type' => $f_ext['extension'],
					'file_create_date' => $data['file_create_date'],
					'file_modify_date' => $data['file_modify_date'],		
					'file_size' => $filetree[$i]['size']
					//'tag_name' => $data['tag_name']
				);
				
				// insert into database
				$this->db->insert('cabinet_files', $new_cabinet_file);
				
				// upload files to the folder					
				$temp=$path;
				$tmp=$filetree[$i]['tmp_name'];			
				$temp=$temp.basename($new_cabinet_file['file_name']);
				move_uploaded_file($tmp,$temp);
				$temp=''; $tmp='';
				
				$val = "<p class='success'><strong>" .$filetree[$i]['name']. "</strong> uploaded successfully !</p>";
				array_push($message, $val);
			}			
		}
		
		return $message;
	}


	// upload file to cabinet
	function cabFileUpload($path)
	{
		$id = $this->input->post('cabid');
		$time = date("m/d/Y H:i:s");
		
		foreach($_FILES['mystuff'] as $i=>$file)
		{			
			foreach($file as $j=>$f)
			{
				$files[$i][$j] = $f;				
			}				
		}
		
		$uploadData = array(
			'cabinet_id' => $id,
			'file_list' => $files,		
			'file_create_date' => $time,
			'file_modify_date' => $time
			//'tag_name' => 'hello'
		);		
		
		//upload files to the server
		$uploading = $this->cabFileInsert($uploadData, $path);
		
		return $uploading;
		
	}
	
	//cab file delete
	function cabFileDelete()
	{
		$this->load->helper('file');
		$cab_id = $this->input->post('cab_id');
		$user = $this->session->userdata("usermail");
		$files =  $this->input->post('files');
		$files_arr = explode(',', $files);
		
		$this->db->where('cabinet_id', $cab_id);
		$this->db->where_in('file_name', $files_arr);
		$this->db->delete('cabinet_files');		

		$cab_file_root = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR;				
		$path = $cab_file_root . $user . DIRECTORY_SEPARATOR . $cab_id . DIRECTORY_SEPARATOR;
		
		foreach($files_arr as $file)
		{
			unlink($path . $file);
		}
	}
	
	function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
	
	
	function mime_content_type($filename) 
	{

		$mime_types = array(

			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',			
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',

			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		$ext = strtolower(array_pop(explode('.',$filename)));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return $filename;
		}
	}


	
	// ------------------------------------------------------------
	// recursive_remove_directory( directory to delete, empty )
	// expects path to directory and optional TRUE / FALSE to empty
	// ------------------------------------------------------------
	function recursive_remove_directory($directory, $empty=FALSE)
	{
		if(substr($directory,-1) == '/')
		{
			$directory = substr($directory,0,-1);
		}
		if(!file_exists($directory) || !is_dir($directory))
		{
			return FALSE;
		}elseif(is_readable($directory))
		{
			$handle = opendir($directory);
			while (FALSE !== ($item = readdir($handle)))
			{
				if($item != '.' && $item != '..')
				{
					$path = $directory.'/'.$item;
					if(is_dir($path)) 
					{
						recursive_remove_directory($path);
					}else{
						unlink($path);
					}
				}
			}
			closedir($handle);
			if($empty == FALSE)
			{
				if(!rmdir($directory))
				{
					return FALSE;
				}
			}
		}
		return TRUE;
	}
}

