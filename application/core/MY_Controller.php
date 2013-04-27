<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Redirect user if they're not authenticated.
*/
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        if(!$this->ion_auth->logged_in())
        {
            redirect('/');
        }
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
