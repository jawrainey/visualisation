<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Settings controller (Let the user fix things!)
*/
class Settings extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
    }

    /**
     * Settings home page
     *
     * @param  string  $uri  hyphenated article name
     * @return admin to updated blog
    */    
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('settings/index');
		$this->load->view('layouts/footer');
	}

    /**
     * Allow the user to change their level:
     * Advanced or Beginner
     *
     * @param  string  $uri  hyphenated article name
     * @return admin to updated blog
    */    
	public function level()
	{

	}

}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */