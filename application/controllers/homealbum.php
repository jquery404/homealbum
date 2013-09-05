<?php
class Homealbum extends CI_Controller
{

	private $loggedIn;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		
	}
	
	
	
	/**********
	*
	* SETTER
	*
	***********/
	
	private function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || !$is_logged_in)
		{
			//die();
			$this->loggedIn = false;
		}
		else
			$this->loggedIn = true;		
	
	}
	
	
	
	/**********
	*
	* GETTER
	*
	***********/
	
	public function getLogged()
    {
        if ($this->loggedIn)
        {
            return true;
        }

        return false;
    }
	
	public function MessageBox($message)
	{
		$data['title'] = "Home Album";
		$data['message'] = $message;

		$data['main_content'] = "message";
		$this->load->view('include/template', $data);
	
	}

	
}