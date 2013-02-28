<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dashboard controller (Let the user visualise things!)
*/
class Dashboard extends CI_Controller
{
	function __construct()
	{
        parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('dashboard/index');
		$this->load->view('layouts/footer');
	}

	public function create()
	{
		//Allow the user to create a visualistion in the database.
		//Stores the name of the visualistion, and both datasets chosen to the database.
		// (Three post variables need to be stored in the "user visualization" table.)
		//

		//GRAB ALL THE DATA
		//INSERT IT INTO THE DATABASE...
		if( $this->form_validation->run('create') == FALSE )
		{
			//echo 'an error occured...';
		}
		else
		{
			//echo 'sucess!';
		}
		//print_r($this->input->post(NULL, TRUE)); // returns all POST items with XSS filter 

		$this->load->view('layouts/header');
		$this->load->view('dashboard/create');
		$this->load->view('layouts/footer');

	}

	public function select()
	{
		$this->load->view('layouts/header');
		$this->load->view('dashboard/select');
		$this->load->view('layouts/footer');

	}

	public function show()
	{
		$this->load->view('layouts/header');
		$this->load->view('dashboard/vis');
		$this->load->view('layouts/footer');

	}

	public function delete($param)
	{

	}

	public function upload()
	{
		
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */