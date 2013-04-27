<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Settings controller (Let the user fix things!)
*/
class Settings extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'session', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    /**
     * Settings home page
    */    
    public function index()
    {
        $this->data['title'] = 'Settings';
        $this->load->template('settings/index', $this->data);
    }
    
    /**
     * Allow the user to change their level: Advanced or Beginner
    */
    public function level()
    {
    
    }


    public function change_password()
    {
        echo 1;
    }
    
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */
