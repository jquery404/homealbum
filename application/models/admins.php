<?php

class Admins extends CI_Model
{
		
	function checkAdmin()
	{
		$userID = $this->session->userdata('userid');
		$q = $this->db->get_where('user_table', array('id' => $userID, 'admin' => 1));
		if($q->num_rows() == 1)
			return true;
			
		return false;
	}

	
	function getOrders()
	{
		$query = $this->db->get('local_order');
		
		return $query->result();
	}
	
	function getOrderbyId($id)
	{
		$this->db->select('file_id, file_type, file_pack, total_copy, sender_id, recip_id, user_id');
		$q = $this->db->get_where('local_order', array('id' => $id));
		//return json_encode($q->result());
		return $q->result();
	}

	function loadFilebyId($ids)
	{
		$this->db->select('cabinet_id, file_name');	
		$this->db->where_in('id', $ids);
		$q = $this->db->get('cabinet_files');
		
		return $q->result();
	}	
	
	function userContact($id)
	{		
		$this->db->select('username, address, contactno, emailid, country');
		$results = $this->db->get_where('user_table', array('id' => $id));
		 
		return $results->result();
	}
	
	function addressbookContact($ids)
	{	
		$this->db->select('name, address, number, mail, country');
		$this->db->where_in('id', $ids);
		$results = $this->db->get('my_contact');
		
		return $results->result();
	}
	
	function cngOrderStatus($id)
	{
		$val = array('id' => $id);
		$data = array('printed' => 1);
		$this->db->where($val); 			
		$this->db->update('local_order', $data); 
	}
	
	function deleteOrder($id)
	{
		$this->db->where('id', $id);		
		$this->db->delete('local_order');		
	}
	
	function getLocalPhotos()
	{
		$results = $this->db->get('local_photo');		
		return $results->result();
	}
	
	function getLocalDocs()
	{
		$results = $this->db->get('local_doc');		
		return $results->result();
	}
	
	function getInterPhotos()
	{
		$results = $this->db->get('inter_photo');		
		return $results->result();
	}
	
	function getInterDocs()
	{
		$results = $this->db->get('inter_doc');		
		return $results->result();
	}
	
	function getOrderFees()
	{
		$results = $this->db->get('order_fees');		
		return $results->result();
	}
	
	function manageLP()
	{
		$lp_id = $this->input->post('lp_id');
		$lp_name = $this->input->post('lp_name');
		$lp_price = $this->input->post('lp_price');
		
		$results = $this->db->get_where('local_photo', array('type'=>$lp_name));
		
		if($results->num_rows > 0)
		{
			if($lp_id != '')
			{
				$udata = array(
					'type' 		=> $lp_name,
					'price' 	=> $lp_price
				);
				
				$this->db->where(array('id'=>$lp_id));
				$this->db->update('local_photo', $udata); 
			
				$res = array(
					'error' => false,
					'msg'	=> 'Updated succesfully'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Package name already exists'
				);
			}			
		}
		else
		{
			$userdata = array(
				'type' 		=> $lp_name,
				'price' 	=> $lp_price
			);
			
			if($this->db->insert('local_photo', $userdata))
			{
				$res = array(
					'error' => false,
					'msg'	=> 'New package added'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Something went wrong'
				);
			}
		}
		
		return $res;
	}

	function manageIP()
	{
		$ip_id = $this->input->post('ip_id');
		$ip_name = $this->input->post('ip_name');
		$ip_no_discount = $this->input->post('ip_no_discount');
		$ip_discount_form = $this->input->post('ip_discount_form');
		$ip_discount_price = $this->input->post('ip_discount_price');
		$ip_no_discount_price = $this->input->post('ip_no_discount_price');
	
		
		$results = $this->db->get_where('inter_photo', array('type'=>$ip_name));
		
		if($results->num_rows > 0)
		{
			if($ip_id != '')
			{
				$udata = array(
					'type' 				=> $ip_name,
					'discount_until' 	=> $ip_no_discount,
					'discount_from' 	=> $ip_discount_form,
					'price_a' 			=> $ip_discount_price,
					'price_b' 			=> $ip_no_discount_price
				);
				
				$this->db->where(array('id'=>$ip_id));
				$this->db->update('inter_photo', $udata); 
			
				$res = array(
					'error' => false,
					'msg'	=> 'Updated succesfully'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Package name already exists'
				);
			}			
		}
		else
		{
			$udata = array(
				'type' 				=> $ip_name,
				'discount_until' 	=> $ip_no_discount,
				'discount_from' 	=> $ip_discount_form,
				'price_a' 			=> $ip_discount_price,
				'price_b' 			=> $ip_no_discount_price
			);
			
			if($this->db->insert('inter_photo', $userdata))
			{
				$res = array(
					'error' => false,
					'msg'	=> 'New package added'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Something went wrong'
				);
			}
		}
		
		return $res;
	}

	function manageLD()
	{
		$ld_id = $this->input->post('ld_id');
		$ld_name = $this->input->post('ld_name');
		$ld_price = $this->input->post('ld_price');
		
		$results = $this->db->get_where('local_doc', array('type'=>$ld_name));
		
		if($results->num_rows > 0)
		{
			if($ld_id != '')
			{
				$udata = array(
					'type' 		=> $ld_name,
					'price' 	=> $ld_price
				);
				
				$this->db->where(array('id'=>$ld_id));
				$this->db->update('local_doc', $udata); 
			
				$res = array(
					'error' => false,
					'msg'	=> 'Updated succesfully'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Package name already exists'
				);
			}			
		}
		else
		{
			$userdata = array(
				'type' 		=> $ld_name,
				'price' 	=> $ld_price
			);
			
			if($this->db->insert('local_doc', $userdata))
			{
				$res = array(
					'error' => false,
					'msg'	=> 'New package added'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Something went wrong'
				);
			}
		}
		
		return $res;
	}

	function manageID()
	{
		$id_id = $this->input->post('id_id');
		$id_name = $this->input->post('id_name');
		$id_price = $this->input->post('id_price');
		
		$results = $this->db->get_where('inter_doc', array('type'=>$id_name));
		
		if($results->num_rows > 0)
		{
			if($id_id != '')
			{
				$udata = array(
					'type' 		=> $id_name,
					'price' 	=> $id_price
				);
				
				$this->db->where(array('id'=>$id_id));
				$this->db->update('inter_doc', $udata); 
			
				$res = array(
					'error' => false,
					'msg'	=> 'Updated succesfully'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Package name already exists'
				);
			}			
		}
		else
		{
			$userdata = array(
				'type' 		=> $id_name,
				'price' 	=> $id_price
			);
			
			if($this->db->insert('inter_doc', $userdata))
			{
				$res = array(
					'error' => false,
					'msg'	=> 'New package added'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Something went wrong'
				);
			}
		}
		
		return $res;
	}

	function manageOF()
	{
		$of_id = $this->input->post('of_id');
		$of_name = $this->input->post('of_name');
		$of_finish_cost = $this->input->post('of_finish_cost');
		$of_firstpage_color = $this->input->post('of_firstpage_color');
		$of_courier_nodiscount = $this->input->post('of_courier_nodiscount');
		$of_courier_discount = $this->input->post('of_courier_discount');
		$of_courier_price_a = $this->input->post('of_courier_price_a');
		$of_courier_price_b = $this->input->post('of_courier_price_b');
		
		$results = $this->db->get_where('order_fees', array('pack'=>$of_name));
		
		if($results->num_rows > 0)
		{
			if($of_id != '')
			{
				$udata = array(
					'pack' 						=> $of_name,
					'finishing_cost' 			=> $of_finish_cost,
					'firstpage_color' 			=> $of_firstpage_color,
					'discount_until' 			=> $of_courier_nodiscount,
					'courier_discount_from' 	=> $of_courier_discount,
					'courier_price_a' 			=> $of_courier_price_a,
					'courier_price_b' 			=> $of_courier_price_b
				);
				
				$this->db->where(array('id'=>$of_id));
				$this->db->update('order_fees', $udata); 
			
				$res = array(
					'error' => false,
					'msg'	=> 'Updated succesfully'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Package name already exists'
				);
			}			
		}
		else
		{
			$udata = array(
				'pack' 						=> $of_name,
				'finishing_cost' 			=> $of_finish_cost,
				'firstpage_color' 			=> $of_firstpage_color,
				'discount_until' 			=> $of_courier_nodiscount,
				'courier_discount_from' 	=> $of_courier_discount,
				'courier_price_a' 			=> $of_courier_price_a,
				'courier_price_b' 			=> $of_courier_price_b
			);
			
			if($this->db->insert('order_fees', $userdata))
			{
				$res = array(
					'error' => false,
					'msg'	=> 'New package added'
				);
			}
			else
			{
				$res = array(
					'error' => true,
					'msg'	=> 'Something went wrong'
				);
			}
		}
		
		return $res;
	}

	function deleteLP()
	{
		$id = $this->input->post('id');		
		$data = array('id' => $id);
		$q = $this->db->get_where('local_photo', $data);
		
		if($q->num_rows > 0)
		{
			$this->db->where('id', $id);
			return $this->db->delete('local_photo'); 
		}
		
		return false;
	}
	
	function deleteIP()
	{
		$id = $this->input->post('id');		
		$data = array('id' => $id);
		$q = $this->db->get_where('inter_photo', $data);
		
		if($q->num_rows > 0)
		{
			$this->db->where('id', $id);
			return $this->db->delete('inter_photo'); 
		}
		
		return false;
	}
	
	function deleteLD()
	{
		$id = $this->input->post('id');		
		$data = array('id' => $id);
		$q = $this->db->get_where('local_doc', $data);
		
		if($q->num_rows > 0)
		{
			$this->db->where('id', $id);
			return $this->db->delete('local_doc'); 
		}
		
		return false;
	}
	
	function deleteID()
	{
		$id = $this->input->post('id');		
		$data = array('id' => $id);
		$q = $this->db->get_where('inter_doc', $data);
		
		if($q->num_rows > 0)
		{
			$this->db->where('id', $id);
			return $this->db->delete('inter_doc'); 
		}
		
		return false;
	}
	
	function deleteOF()
	{
		$id = $this->input->post('id');		
		$data = array('id' => $id);
		$q = $this->db->get_where('order_fees', $data);
		
		if($q->num_rows > 0)
		{
			$this->db->where('id', $id);
			return $this->db->delete('order_fees'); 
		}
		
		return false;
	}
	
	
}


		