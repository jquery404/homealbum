<?php

	class Membership extends CI_Model
	{
	
		var $user_email;
	
		function ___constructor()
		{
			parent::___constructor;			
		}
	
		function index()
		{
		
			
		
		
		}
		
		function validate()
		{
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			$this->db->where('user_status', 1);
			$query = $this->db->get('user_table');
			
			if($query->num_rows == 1)
			{
			
				return $query->result();
			}
		
		}
		
		// register user
		function addUser()
		{
			$fullname = $this->input->post('fullname');
			$username = $this->input->post('username'); 
			$useremail = $this->input->post('uemail');
			$password = md5($this->input->post('password'));
			$address = $this->input->post('address');
			$phonenumber = $this->input->post('phonenumber');
			$country = $this->input->post('reg_country');
					
			$query = $this->db->get_where('user_table', array('username' => $username, 'emailid' => $useremail, 'user_status' => 0));			
			if($query->num_rows > 0)
			{
				return false;
			}
			else
			{
				$generatedKey = sha1(mt_rand(10000,99999).time().$useremail);
				$time = date("m/d/Y H:i:s");
				
				$userdata = array(
					'fullname' => $fullname, 
					'username' => $username,
					'emailid' => $useremail,
					'password' => $password,
					'address' => $address,
					'contactno' => $phonenumber, 
					'country' => $country,
					'user_registered' => $time,
					'user_activation_key' => $generatedKey,
					'user_status' => 0
				);
				 
				$this->db->insert('user_table', $userdata);
				
				
				$message = "Welcome to Homealbum.org !  \r\n\r\nYou're receiving this email because your email address was linked to a newly created Homealbum account, with username '";
				$message .= $username."'. If you don't know anything about it, please just ignore this email and we won't bother you again.\r\n \r\n";
				$message .= "To activate your account and start on Homealbum, PLEASE CONFIRM your email subscription here:\r\n\r\n";
				$message .= "http://login.homealbum.org/index.php?/login/confirm/".$username."/".$generatedKey ." \r\n \r\n";
				$message .= "Thanks for using Homealbum!\r\n\r\n";			
				$message .= "Kind Regards, \r\n\r\n";
				$message .= "Homealbum Customer Support \r\n";
				$message .= "http://homealbum.org/ \r\n \r\n";
				
				$from = 'admin@homealbum.org';
				$subject = 'Complete Your Registration';
				
				
				// send email to the user
				$this->sendEmail($from, 'Homealbum.org', $useremail, $subject, $message);
				return true;
			}
			
			
		}
		
		function confirmation()
		{
			$user = $this->uri->segment(3);
			$key = $this->uri->segment(4);
			
			$data['title'] = "Confirm Activation | Home Album";
			$data['header'] = "Welcome to Home Album";
			$data['main_content'] = "login/successful";
				
			if($user && $key)
			{
				$this->db->where('username', $user);
				$this->db->where('user_activation_key', $key);
				$this->db->where('user_status', 0);
				$query = $this->db->get('user_table');
				
				if($query->num_rows > 0)
				{
					$info = array('user_status' => 1, 'user_activation_key' => '');					
						
					if($q = $this->db->update('user_table', $info))
					{
						$results = $query->result();					
						$user_email = $results[0]->emailid;					
						$file_path = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . $user_email . DIRECTORY_SEPARATOR;
						// if dir does't exists create one
						if(!is_dir($file_path)) 
							mkdir($file_path, 0777);	
					}
					
					$data['message'] = "
					<h2>Account activated!</h2>
					<p>Your account has been activated.</p>

					<p>Please go to the ".anchor('login', 'Login page')." to get started.</p>";					
					
				}
				else
				{			
					$data['message'] = "
					<h2>The page you were looking for does not exist</h2>
					<p>You've followed a link to a URL that does not exist on this website. There could be a number of possible reasons for this:</p>

					<p>The page may have existed at some point in the past and is still linked to from other websites.
					The content may have been removed. Go to the ".anchor('login', 'home page')."</p>";
				}
			}
			else 
			{
				$data['message'] = "
				<h2>The page you were looking for does not exist</h2>
				<p>You've followed a link to a URL that does not exist on this website. There could be a number of possible reasons for this:</p>

				<p>The page may have existed at some point in the past and is still linked to from other websites.
				The content may have been removed. Go to the ".anchor('login', 'home page')."</p>";		
				
			}
			
			$this->load->view('include/template', $data);
		}
		
		function randomPassword() {
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		}
		
		function forgetPassword()
		{
			$email = $this->input->post('uemail');
			$this->db->select('password');
			$results = $this->db->get_where('user_table', array('emailid' => $email, 'user_status' => 1));
			if($results->num_rows > 0)
			{
				//echo $this->randomPassword();	
				$generatedKey = (mt_rand(10,99).time());
				$recoverKey = (mt_rand(100555,548991));
								
				$this->db->select('password');
				$this->db->where(array('emailid' => $email, 'user_status' => 1));
				$data = array('user_key' => $generatedKey, 'recover' => $recoverKey);				
				$this->db->update('user_table', $data); 
				
				$url = site_url() . "/login/recover/".$generatedKey."/".$recoverKey;
				
				$message = "Hi ,\r\n\r\n";
				$message .= "You recently asked to reset your Homealbum password.\r\n \r\n";
				$message .= "Click here to change your password:\r\n\r\n";
				$message .= $url ." \r\n \r\n";
				$message .= "Thanks for using Homealbum!\r\n\r\n";			
				$message .= "Kind Regards, \r\n\r\n";
				$message .= "Homealbum Customer Support \r\n";
				$message .= "http://homealbum.org/ \r\n \r\n";
				
				$from = 'admin@homealbum.org';
				$subject = 'You requested a new Homealbum password';

				// send email to the user
				$this->sendEmail($from, 'Homealbum.org', $email, $subject, $message);
				return true;
			}
			
			
			return false;		
		}
		
		function sendEmail($from, $fName, $to, $subject, $message)
		{
		
			$this->load->library('email');

			$this->email->from($from, $fName);
			$this->email->to($to); 			
			$this->email->subject($subject);
			$this->email->message($message);	

			$this->email->send();

			//echo $this->email->print_debugger();
		}
		
		
		function getMail()
		{
			$query = $this->db->get('user_table');
			$this->user_email = $query->row_data;
			echo "<br />asd";
			echo $this->user_email;
		}
		
		function recover()
		{
			$user = $this->uri->segment(3);
			$key = $this->uri->segment(4);
			if($user && $key)
			{
			

				$this->db->where('user_key', $user);
				$this->db->where('recover', $key);
				$this->db->where('user_status', 1);
				$query = $this->db->get('user_table');
				
				if($query->num_rows > 0)
				{
					$this->db->where('user_key', $user);
					$this->db->where('recover', $key);
					$this->db->where('user_status', 1);
					
					$pass = $this->randomPassword();
					
					$data = array('password' => md5($pass), 'user_key' => '', 'recover' => '');
					$this->db->update('user_table', $data); 
					$msg = "
					<h2>Your Homealbum Password</h2>
					<p>Your Homealbum password hasbeen reset. Please use the following password to login:</p><br/>Password: <strong>".$pass."</strong>
					
					<p>and please change your password after login. ".anchor('login', 'home page')."</p>";		
					
					return $msg;
				}
			}
			
			$msg = "
			<h2>The page you were looking for does not exist</h2>
			<p>You've followed a link to a URL that does not exist on this website. There could be a number of possible reasons for this:</p>

			<p>The page may have existed at some point in the past and is still linked to from other websites.
			The content may have been removed. Go to the ".anchor('login', 'home page')."</p>";	
			
			return $msg;		
			
		}
		
		
		function editProfile()
		{		
			$email = $this->session->userdata("usermail");
			$userid = $this->session->userdata('userid');
			$fullname = $this->input->post('user_fullname');
			$username = $this->input->post('user_name');
			$address = $this->input->post('user_address');
			$phone = $this->input->post('user_contact');
			$country = $this->input->post('user_country');
			
			
			
			$val = array(
				'fullname' => $fullname, 
				'username' => $username, 
				'address' => $address, 
				'contactno' => $phone,
				'country' => $country
			);
			
			$ses_data = array(
				'fullname' => $fullname,
				'address' => $address,
				'contactno' => $phone,
				'country' => $country
			);
			
			$this->session->set_userdata($ses_data);
			
			
			$this->db->where('id', $userid);
			$this->db->where('emailid', $email);
			
			$this->db->update('user_table', $val); 
			if($this->db->affected_rows()>0) return true;
			
			return false;
		}
		
		function changePassword()
		{
			$id = $this->input->post('user_id');
			$oldPass = $this->input->post('old_pass');
			$newPass = $this->input->post('new_pass');
			
			$this->db->where('id', $id);
			$this->db->where('password', md5($oldPass));
			$this->db->where('user_status', 1);
			$query = $this->db->get('user_table');
			
			if($query->num_rows > 0)
			{
				$this->db->where('id', $id);
				$this->db->where('password', md5($oldPass));
				$this->db->where('user_status', 1);					
				$info = array('password' => md5($newPass));
				$this->db->update('user_table', $info);
				
				return true;
			}
			
			return false;		
		}
		
		/* 
		* User Contact
		*/
		
		function getContact()
		{
			$query = $this->db->get('user_table');
			$id = $this->session->userdata('userid');		
			$this->db->select('username, address, contactno, emailid, country');
			$results = $this->db->get_where('user_table', array('id' => $id));
			 
			return $results->result();
		}
		
		
	
	
	}


?>