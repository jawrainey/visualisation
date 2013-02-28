<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'create' => array(
        array(
            'field' => 'visname',
            'label' => 'visualization name',
            'rules' => 'trim|required|min_length[5]|max_length[30]|xss_clean'
        ),
        array(
            'field' => 'datasetOne',
            'label' => 'trim|required|xss_clean',
            'rules' => 'Dataset two'
        ),
        array(
            'field' => 'datasetTwo',
            'label' => 'trim|required|xss_clean',
            'rules' => 'Dataset two'
        )
    )                         
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
