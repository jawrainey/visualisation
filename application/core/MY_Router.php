<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Add additional functional to CI_Router
*/
class MY_Router extends CI_Router
{
    /**
     * Convert underscore to hyphen in URI.
     * NOTE: Both underscore and hyphen can then be used
     *
     * @param  array  $segments  URI segment to match.
     * @return converted URI from underscore to hyphen
    */
    // function _set_request ($segments = array())
    // {
    //     // The str_replace() below goes through all our segments
    //     // and replaces the hyphens with underscores making it
    //     // possible to use hyphens in controllers, folder names and function names
    //     parent::_set_request(str_replace('-', '_', $segments));
    // }

}

/* End of file MY_Router.php */
/* Location: ./application/core/MY_Router.php */
