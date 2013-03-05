<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Add additional functional to CI_loader
*/
class MY_Loader extends CI_Loader
{
    /**
     * Template function to prevent repeated coded when creating views.
     *
     * @param  string  $template_name  Name of file to use.
     * @param  array   $vars  Data to send to view.
     * @param  boolean $return  If true data ($vars) as a string.
     * @return view to the user
    */
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $content  = $this->view('layouts/header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('layouts/footer', $vars, $return);
        
        if ($return)
        {
            return $content;
        }
    }
}

/* End of file MY_loader.php */
/* Location: ./application/core/MY_loader.php */
