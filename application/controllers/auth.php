<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Auth controller (Let the user see things (if allowed)!)
*/
class Auth extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
    }
    
	public function index()
	{
		$this->load->view('home/index');
	}

	public function login()
	{
		$this->load->view('home/index');
	}

	public function process()
	{

	}
	
	public function change_password()
	{


	}
	
	public function forgot_password()
	{

	}

	public function register()
	{


	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */