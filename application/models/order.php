<?php

class Order extends CI_Model
{

	// Generate Guid 
	function NewGuid() { 
		$s = strtoupper(md5(uniqid(rand(),true))); 
		$guidText =        
			substr($s,8,4) . '-' . 
			substr($s,12,4). '-' . 
			substr($s,16,4);
		   
		return $guidText;
	}
	
	function placeOrder()
	{
		$userID = $this->session->userdata('userid');
		$pack = ($this->input->post('package_n') == 'local') ? 'local' : 'international';
		$files_id = $this->input->post('file_id');
		$file_type = $this->input->post('file_type');
		$file_pack = $this->input->post('file_pack');
		$file_number = $this->input->post('file_number');
		
		$totalprice = $this->input->post('tcosting');
		$binding = $this->input->post('binding');
		$fpageclr = $this->input->post('fpageclr');
		$spInstruction = $this->input->post('spinstruction');
		$senderId = $this->input->post('sender_id');
		$recipId = $this->input->post('recip_id');		
		$Guid = $this->NewGuid();
		$time = date("m/d/Y H:i:s");
		if($pack == "local")
		{
			$order = array(
					'user_id' => $userID, 
					'file_id' => $files_id, 
					'file_type' => $file_type, 
					'file_pack' => $file_pack, 
					'total_copy' => $file_number,
					'sender_id' => $senderId,
					'recip_id' => $recipId,
					'binding' => $binding,
					'colorpage' => $fpageclr,
					'instruction' => $spInstruction,
					'price' => $totalprice,
					'create_date' => $time,
					'order_id' => $Guid
					);
					
			$q = $this->db->insert('local_order', $order);
		
		}
		
		return $Guid;
	}

	function getPackDetails()
	{
		$this->db->select('type, price');
		$local_docs = $this->db->get('local_doc');
		$this->db->select('type, price');
		$inter_docs = $this->db->get('inter_doc');
		$this->db->select('type, price');
		$local_photo = $this->db->get('local_photo');
		$this->db->select('type, discount_until, discount_from, price_a, price_b');
		$inter_photo = $this->db->get('inter_photo');
		$this->db->select('pack, finishing_cost, firstpage_color, discount_until, courier_discount_from, courier_price_a, courier_price_b');
		$other_fees = $this->db->get('order_fees');
		
		$ld_res = $local_docs->result();
		$id_res = $inter_docs->result();
		$lp_res = $local_photo->result();
		$ip_res = $inter_photo->result();
		$of_res = $other_fees->result();
		
				
		$ld_arr = array();
		foreach($ld_res as $i=>$res)
		{
			foreach($res as $j=>$r)
			{
				if($j == 'type')
					$temp = $r;
				if($j == 'price')
					$ld_arr[$temp] = $r;
			}	
		}
		
		$id_arr = array();
		foreach($id_res as $i=>$res)
		{
			foreach($res as $j=>$r)
			{
				if($j == 'type')
					$temp = $r;
				if($j == 'price')
					$id_arr[$temp] = $r;
			}	
		}
		
		$lp_arr = array();
		foreach($lp_res as $i=>$res)
		{
			foreach($res as $j=>$r)
			{
				if($j == 'type')
					$temp = $r;
				if($j == 'price')
					$lp_arr[$temp] = $r;
			}	
		}
		
		
		$ip_arr = array();
		foreach($ip_res as $i=>$res)
		{
			foreach($res as $j=>$r)
			{
				if($j == 'type')
					$temp = $r;
				
				if($j == 'price_a')
					$pr['a'] = $r;
				else if($j == 'price_b')	
					$pr['b'] = $r;				
			}	
				
			$pd['a'] = $pr['a'];
			$pd['b'] = $pr['b'];
			
			$ip_arr[$temp] = $pd;
		}
		
		$of_arr = array();
		foreach($of_res as $i=>$res)
		{
			foreach($res as $j=>$r)
			{
				if($j == 'pack')
					$temp = $r;
				
				if($j == 'courier_price_a')
					$pr['a'] = $r;
				else if($j == 'courier_price_b')	
					$pr['b'] = $r;
				else if($j == 'courier_discount_from')	
					$pr['courier_discount_from'] = $r;
				else if($j == 'finishing_cost')	
					$pr['finishing_cost'] = $r;
				else if($j == 'firstpage_color')	
					$pr['firstpage_color'] = $r;
			}	
				
			$pd['a'] = $pr['a'];
			$pd['b'] = $pr['b'];
			$pd['discount_from'] = $pr['courier_discount_from'];			 
		
			$pc['courier'] = $pd;
			$pc['finishing_cost'] = $pr['finishing_cost'];			 
			$pc['firstpage_color'] = $pr['firstpage_color'];			 
			$of_arr[$temp] = $pc;
		}
		
		$pack['localDoc'] = $ld_arr;
		$pack['interDoc'] = $id_arr;
		$pack['localPhoto'] = $lp_arr;
		$pack['interPhoto'] = $ip_arr;
		$pack['otherFees'] = $of_arr;
		
		return json_encode($pack);
	}
	
	
	function checkOut()
	{
	
	
	}
	
	function localOrder()
	{
	
	}
	
	function initOrder()
	{
	
	}
	
}