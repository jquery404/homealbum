<?php

class Contacts extends CI_Model
{

	function gets()
	{
		$id = $this->session->userdata('userid');		
		$this->db->where('user_id', $id);
		$results = $this->db->get('my_contact');
		return $results->result();
	}	
	
	function gets_srcOrder()
	{
		$id = $this->session->userdata('userid');		
		$this->db->select('id, name, address, number, mail, country');
		$results = $this->db->get_where('my_contact', array('user_id' => $id));
		 
		return $results->result();
	}	
	
	function add()
	{
		$id = $this->session->userdata('userid');
		$fullname = $this->input->post('c_full_name');
		$address = $this->input->post('c_address');
		$emailid = $this->input->post('c_emailid');
		$phonenumber = $this->input->post('c_pnumber');
		$country = $this->input->post('c_country');
		
		$this->db->where('user_id', $id);
		$this->db->where('mail', $emailid);
		$query = $this->db->get('my_contact');
		if($query->num_rows > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'name' => $fullname,
				'address' => $address,
				'number' => $phonenumber,
				'mail' => $emailid,
				'country' => $country,
				'user_id' => $id
			);
			
			$results = $this->db->insert('my_contact', $data);
			
			$this->db->where('user_id', $id);
			$this->db->where('mail', $emailid);
			$this->db->select('id');
			$newq = $this->db->get('my_contact');			
			$q = $newq->result();		
			
			return $q[0]->id;
		}
		
	}

	function edit()
	{
		$id = $this->input->post('con_id');
		$name = $this->input->post('con_name');
		$address = $this->input->post('con_address');
		$phone = $this->input->post('con_phone');
		$email = $this->input->post('con_email');
		$country = $this->input->post('con_country');
		
		$userid = $this->session->userdata('userid');
		
		$val = array(
			'name' => $name, 
			'address' => $address, 
			'number' => $phone, 
			'mail' => $email,
			'country' => $country
		);
		
		$this->db->where('id', $id);
		$this->db->where('user_id', $userid);
		return $this->db->update('my_contact', $val); 
		
	}
	
	function del()
	{
		$id = $this->session->userdata('userid');
		$cont = $this->input->post('contacts');				
		
		$this->db->where('user_id', $id);
		$this->db->where_in('mail', $cont);
		return $this->db->delete('my_contact');	
	}
}
