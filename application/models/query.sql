/*check user and password*/
$this->db->where('username', $this->input->post('username'));
$this->db->where('password', md5($this->input->post('password')));
$query = $this->db->get('user_table');


$query = $this->db->get('user_table');
$id = $this->session->userdata('userid');		
$this->db->select('username, address, contactno, emailid, country');
$results = $this->db->get_where('user_table', array('id' => $id));



$this->db->where('user_id', $id);
$query = $this->db->get('cabinet_list');


$this->db->where('cabinet_id', $id);
$query = $this->db->get('cabinet_files');



$this->db->where('id', $id);
$this->db->where('password', md5($pass));
$query = $this->db->get('cabinet_list');


$new_cabinet = array(
	'cname' => $this->input->post('name'),
	'protected' => $this->input->post('protect'),
	'password' => md5($this->input->post('pass')),
	'description' => $this->input->post('description'),
	'user_id' => $this->input->post('id')
);
$this->db->where('cname', $cbname);
$query = $this->db->get('cabinet_list');


$qu = $this->db->insert('cabinet_list', $new);
		

$this->db->where($array); 
$query = $this->db->get('cabinet_files');	
return $query->num_rows;



$this->db->where('cabinet_id', $id);
$query = $this->db->get('cabinet_files');


// DELETE
$this->db->where('cabinet_id', $cid);
$this->db->where('file_name', $files);
$this->db->delete('cabinet_files');



$this->db->where('cabinet_id', $cab_id);
$this->db->where_in('file_name', $files_arr);
$this->db->delete('cabinet_files');		


// GET WHERE
$userid = $this->session->userdata('userid');		
$cabid = $this->input->post('cab_id');
$query = $this->db->get_where('cabinet_list', array('id' => $cabid, 'user_id' => $userid, 'password' => $pass));


// UPDATE
$val = array('id' => $cabID, 'cname' => $cabName, 'user_id' => $userID, 'password' => $cabPass);
$data = array('password' => $cabPassNew);
$this->db->where($val); 			
$this->db->update('cabinet_list', $data); 
