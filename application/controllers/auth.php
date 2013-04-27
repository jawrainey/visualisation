<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User authentication (with ion auth)
*/
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'session', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }
    
    /**
     * Allows a user to log in to the site.
    */
    public function index()
    {
        if($this->form_validation->run('login') == TRUE)
        {
            //Try to log the user in as there are no form errors.
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), (bool) $this->input->post('remember')))
            {
                redirect('dashboard/', 'refresh');
            }
            else
            {
				$this->session->set_flashdata('errors', 'Username & password not recognised.');
            	redirect('', 'refresh');
            }
        }
        else
        {
			$this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
        	$this->load->view('auth/index', $this->data);
        }
    }

    public function change_password()
    {
        //IF THERE ARE NO ERRORS...
        if ($this->form_validation->run('change_password') == TRUE)
        {
            $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
            $change = $this->ion_auth->change_password($identity, $this->input->post('curpassword'), $this->input->post('newpassword'));

            if ($change)
            {
                $this->session->set_flashdata('errors', 'sucess!');
                $this->logout();
            }
            else
            {
                //$this->session->set_flashdata('errors', 'oh shit!');
                redirect('settings', 'refresh');
            }
        }
        else
        {
            redirect('settings', 'refresh');
            $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
            $this->load->view('settings/index', $this->data);
        }
    }

    /**
     * Sends the user a 'forgotten password' email if the email is valid.
    */
    function forgot_password()
    {
        if ($this->form_validation->run('forgot_password') == FALSE)
        {
            $this->data['email'] = array('name' => 'email', 'id' => 'email');

            if ( $this->config->item('identity', 'ion_auth') == 'username' )
            {
                $this->data['identity_label'] = 'Username';
            }
            else
            {
                $this->data['identity_label'] = 'Email';
            }

            //set any errors and display the form
            $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
            $this->load->view('auth/forgot_password', $this->data);
        }
        else
        {
            // get identity for that email
            $config_tables = $this->config->item('tables', 'ion_auth');
            $identity = $this->db->where('email', $this->input->post('email'))->limit('1')->get($config_tables['users'])->row();

            // If no errors, run the email functions
            if ($this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')}))
            {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("", 'refresh');
            }
            else
            {
                $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
                $this->load->view('auth/forgot_password', $this->data);
            }
        }
    }
    

    /**
     * Sends the user a 'forgotten password' email if the email is valid.
    */
    public function reset_password($code = NULL)
    {
        $code or show_404();

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user)
        {
            //if the code is valid then display the password reset form

            if ($this->form_validation->run('reset_password') == FALSE)
            {

                $this->data['user_id'] = array(
                    'name'  => 'user_id',
                    'id'    => 'user_id',
                    'type'  => 'hidden',
                    'value' => $user->id,
                );

                $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                $this->load->view('auth/reset_password', $this->data);
            }
            else
            {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
                {
                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error('This form post did not pass our security checks.');
                }
                else
                {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change)
                    {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('reset-password/' . $code, 'refresh');
                    }
                }
            }
        }
        else
        {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("forgot-password", 'refresh');
        }
    }

    /**
     * Allows a user to securely log out.
    */
    public function logout()
    {
        $this->ion_auth->logout();
        redirect('/');
    }

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
