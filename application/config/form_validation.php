<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'trim|required|min_length[5]|max_length[15]|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required|min_length[6]|max_length[25]|xss_clean|callback_hash'
        )
    ),
    'create' => array(
        array(
            'field' => 'visname',
            'label' => 'visualisation name',
            'rules' => 'trim|required|min_length[5]|max_length[50]|xss_clean|check_visname'
        ),
        array(
            'field' => 'datasetOne',
            'label' => 'dataset one',
            'rules' => 'require|xss_clean|selected'
        ),
        array(
            'field' => 'datasetTwo',
            'label' => 'dataset two',
            'rules' => 'required|xcc_clean|selected|same_options'
        )
    ),
    'select' => array(
        array(
            'field' => 'selectedAtts',
            'label' => 'selected attributes',
            'rules' => 'required|count_select'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
