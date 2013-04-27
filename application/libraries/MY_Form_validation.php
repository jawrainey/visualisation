<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom validation rules for multiple select form elements.
*/
class MY_Form_validation extends CI_Form_validation
{
    function __construct($config = array())
    {
        parent::__construct($config);
        $this->set_error_delimiters('<ul class="error"><li>', '</li></ul>');    
    }
    
    /**
     * Check database to see if visualisation exists.
     *
     * @param $visname string visualisation name to compare with database.
     * @return true or false. False throws an error.
    */
    public function check_visname($visname)
    {
        $this->set_message('check_visname', 'A visualistion with this name exists.');
        return $this->CI->dashboard_model->check_visname(array('vis_name' => $visname, 'user_id' => $this->CI->session->userdata('user_id')));
    }

    /**
     * Prevent user selecting first fields.
     *
     * @param $field string The field we will compare.
     * @return true or false. False throws an error.
    */
    public function selected($field)
    {
        $this->set_message('selected', 'The default dataset option "%s" was selected.');
        return $field == '0' ? FALSE : TRUE;
    }
    
    /**
     * Prevent user comparing the same table for visualistion.
     *
     * @return true or false. False throws an error.
    */
    public function same_options()
    {
        $this->set_message('same_options', 'Dataset one and %s can not be the same.');
    
        if ( $this->CI->input->post('datasetOne') != '0' && $this->CI->input->post('datasetOne') == $this->CI->input->post('datasetTwo') )
        {
            return FALSE;
        }
        return TRUE;
    }
    
    /**
     * Prevent user selecting more than three fields.
     *
     * @param $array array The selectedAtts field (right column).
     * @return true or false. False throws an error.
    */
    public function count_select($array)
    {
        $this->set_message('count_select', '%s cannot exceed 3.');
        return count($array) > 3 ? FALSE : TRUE;
    }
}

/* End of file MY_Form_validation_.php */
/* Location: ./application/libraries/MY_Form_validation_.php */
