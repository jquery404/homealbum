<?php
	require_once('homealbum.php');
	
	class Login extends Homealbum
	{
		var $loggedIn = false;
		var $userMail;
		var $userID;
		
		
		function index()
		{
			if($this->getLogged())
			{			
				$data['title'] = "Welcome | Home Album";				
								
				$data['title'] = 'Memberpage | Homealbum';
				
				$data['cabinet_info'] = $this->show_cabinet($this->session->userdata('userid'));
				
				$data['main_content'] = "homepage";
				
				$this->load->view('include/template', $data);
			}
			else
			{
				$data['title'] = "Login | Home Album";
				
				$data['main_content'] = "login/loginpage";
				
				$this->load->view('include/template', $data);
			}
			
		}
		
		function signup()
		{
			if(!$this->getLogged())
			{
				$data['title'] = "Sign up | Home Album";
				$data['header'] = "Welcome to Home Album";
				$data['main_content'] = "login/signup";						
				
				$this->load->view('include/template', $data);
			}
			else
			{
				redirect('/login');
			}
		
		}
		
		function forget_password()
		{
			if(!$this->getLogged())
			{
				$data['title'] = "Forget password | Home Album";
				$data['header'] = "Welcome to Home Album";
				$data['main_content'] = "login/forget_password";
							
				$this->load->view('include/template', $data);
			}
			else
			{
				redirect('/login');
			}
		
		}
		
		// validate email credentials
		function validate_forget()
		{
			$this->form_validation->set_rules('uemail', 'Email', 'trim|required|valid_email');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->forget_password();			
			}
			else
			{
				// send a mail to the user with the password				
				$this->load->model('membership');
				if($this->membership->forgetPassword())
				{
				
					$msg  = "<h3>Check Your Email</h3>";
					$msg .= "Check your email - we sent you an email with a confirmation link. Follow that link to reset your password.";
					
					$this->MessageBox($msg);
					
				}
				else
				{
					redirect('login/forget_password');
				}				
			}
			
		
		}
		
		
		function recover()
		{			
			$this->load->model('membership');
			$msg = $this->membership->recover();
			
			$this->MessageBox($msg);
		}
		
		
		// validate login credentials
		function validate_login()
		{
		
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
			
			if($this->form_validation->run() == FALSE)
			{
			
				$this->index();
			
			}
			else
			{			
				$this->load->model('membership');
				$query = $this->membership->validate();
				$fullname;	$address; $contactno; $country;
				
				if($query != null)	
				{
					foreach($query as $row)
					{
						$this->userMail = $row->emailid;
						$this->userID = $row->id;
						
						$fullname = $row->fullname;
						$address =  $row->address;
						$contactno = $row->contactno;
						$country = $row->country;
					}
					
					$ses_data = array(
						'is_logged_in' => true,
						'username' => $this->input->post('username'),
						'usermail' => $this->userMail,
						'userid' => $this->userID,
						'fullname' => $fullname,
						'address' => $address,
						'contactno' => $contactno,
						'country' => $country
					);
					
					$this->session->set_userdata($ses_data);

					redirect('/login');
				}
				else
				{
				
					$data['error_msg'] = "The username or password you entered is incorrect. ";
					$data['title'] = "Home Album";
			
					$data['main_content'] = "login/loginpage";
			
					$this->load->view('include/template', $data);
					
					
				}	

			}

		}
		
		function download()
		{
			
			if($this->session->userdata("is_logged_in"))
			{
				$user = $this->session->userdata("usermail");
				$file_path = "application" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . $user . DIRECTORY_SEPARATOR;				
				$cabid = $this->uri->segment(3);
				$url = $this->uri->segment(4);
				$data['download_path'] = $file_path . $cabid . DIRECTORY_SEPARATOR . $url;
				$data['download_name'] = $url;
				
				$this->load->view("userarea/download", $data);
			}
			else
			{
				die("wrong id");
			}
			
		
		
		}
		
		// find cabinets list
		function show_cabinet($userID)
		{	
			$this->load->model('cabinets');
			$query = $this->cabinets->getCabinet($userID);
			
			if($query == NULL)
			{
				$str = "You do not have any Cabinet";
				return $str;
			}
			else
			{
				return $query;				
			}
		}
		
		// validate signup credentials
		function validate_signup()
		{			
			$this->form_validation->set_rules('fullname', 'Name', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('uemail', 'Email address', 'trim|required|valid_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
			$this->form_validation->set_rules('password_clone', 'Retype Password', 'trim|required|matches[password]');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');			
			$this->form_validation->set_rules('phonenumber', 'Contact Number', 'trim|required|is_natural');			
			$this->form_validation->set_rules('reg_country', 'Country', 'trim|required|alpha');			
					
			
			if($this->form_validation->run() == FALSE)
			{
				$this->signup();
			
			}
			else
			{
				$this->load->model('membership');
				
				if($this->membership->addUser())
				{
					$data['title'] = "Confirm Activation | Home Album";
					$data['header'] = "Welcome to Home Album";
					$data['main_content'] = "login/successful";
					$data['message'] = "<p>Thanks for visiting our website and signing up!</p>
					<p>Please check your email for confirmation mail to activate your account and go to ". anchor('login', 'Login') ." page.</p>";
				
					$this->load->view('include/template', $data);
				}
				else
				{
					$data['title'] = "Sign up | Home Album";
					$data['header'] = "Welcome to Home Album";
					$data['user_error'] = "User already exists!";						
					$data['main_content'] = "login/signup";						
					
					$this->load->view('include/template', $data);
				}
				
				
			}
			
		}
		
		
		function confirm()
		{
			$this->load->model('membership');
			$this->membership->confirmation();
		}
		
		function changePassword()
		{
			$this->form_validation->set_rules('old_pass', 'Password', 'trim|required|min_length[6]|max_length[25]');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[6]|max_length[32]');
			$this->form_validation->set_rules('conf_new_pass', 'Confirm Password', 'trim|required|min_length[6]|max_length[32]|matches[new_pass]');
			
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
				$this->load->model('membership');
				if($this->membership->changePassword())
				{						
					$data = array(				
						'results' => 'success',
						'msg' => 'Your password has been changed.'
					);
					echo json_encode($data);
					
				}
				else
				{					
					$data = array(				
						'results' => 'error',
						'msg' => 'Password didnot match'
					);
					echo json_encode($data);
					
				}	
			}
		}
		
		function editProfile()
		{ 
			$this->load->model("membership");
			$q = $this->membership->editProfile();
			
			if($q) echo 1;			
		 	else echo 0;
		}
		
		function logout()  
		{  
			$this->session->sess_destroy();  
			redirect('/login');
		}  

		
	}

?>