<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    //
    //
    // BELOW ARE FORM HELPERS FOR MY CREATE FORM!
    //
    //

    /**
     * Form helper function to check database to see if visualisation exists.
     *
     * @param $visname string visualisation name to compare with database
     * @return true or false. False throws an error.
    */
    if ( ! function_exists('_check_visname'))
    {
        function _check_visname($visname)
        {
            return $this->dashboard_model->check_visname($visname, $this->session->userdata('user_id'));
        }
    }
    /**
     * Form helper function to prevent user selecting first fields.
     *
     * @param $field string The field we will compare
     * @return true or false. False throws an error.
    */
    if ( ! function_exists('_selected'))
    {
        function _selected($field)
        {
            return $field == '0' ? FALSE : TRUE;
        }
    }
    /**
     * Form helper function to prevent user comparing the same table for visualistion.
     *
     * @return true or false. False throws an error.
    */
    if ( ! function_exists('_same_options'))
    {
        function _same_options()
        {
            if ( $this->input->post('datasetOne') != '0' && $this->input->post('datasetOne') == $this->input->post('datasetTwo') )
            {
                return FALSE;
            }
            return TRUE;
        }
    }
    //
    //
    // BELOW ARE FORM HELPERS FOR MY SELECT FORM!
    //
    //

    /**
     * Form helper function to prevent user selecting more than three fields.
     *
     * @param $array array The selectedAtts field (right column).
     * @return true or false. False throws an error.
    */
    if ( ! function_exists('_count_select'))
    {
        function _count_select($array)
        {
            return count($array) > 3 ? FALSE : TRUE;
        }
    }    