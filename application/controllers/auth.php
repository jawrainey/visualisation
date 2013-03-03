<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Auth controller (Let the user see things (if allowed)!)
*/
class Auth extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('auth_model');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }
    
	public function index()
	{
		$this->load->view('home/index');

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

	public function logout()
	{
		
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */