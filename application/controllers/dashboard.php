<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dashboard controller (Let the user visualise things!)
*/
class Dashboard extends CI_Controller
{
	function __construct()
	{
        parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('dashboard_model');

		//only doing this to see if my query works - still need a damn login system!
		$this->session->set_userdata(array('user_id' => 1, 'user_type' => 1));

		$this->form_validation->set_error_delimiters('<ul class="error"><li>', '</li></ul>');
		$this->form_validation->set_message('_selected', 'The default dataset option "%s" was selected.');
		$this->form_validation->set_message('_check_visname', 'A visualistion with this name exists.');
		$this->form_validation->set_message('_same_options', 'Dataset one and %s can not be the same.');
		$this->form_validation->set_message('_count_select', '%s cannot exceed 3.');
    }

    /**
     * User area - Create/View/Update/Delete visualistions
     */
	public function index()
	{
		$data = array('title' => 'Dashboard', 'content' => $this->dashboard_model->index($this->session->userdata('user_id')));
		$this->load->template('dashboard/index', $data);
	}

    /**
     * Create a new visualisation for the user to manipulate.
     *
     * @return user to next stage of data visualistion (select attributes).
    */
	public function create()
	{
		$data = array(
			'title' => 'Create visualisation',
			'content' => $this->dashboard_model->select_datasets()
		);

		//Form has been posted. Are there any errors? Yeah? DISPLAY THEM!!
		if($this->form_validation->run('create') == FALSE)
		{
			$this->load->template('dashboard/create', $data);
		}
		else
		{	//otherwise we shall do our stuff!
			$content = array(
				'uri'      => $this->dashboard_model->hyphenate($this->input->post('visname')),
				'vis_name' => $this->input->post('visname'),
	   			'user_id'  => $this->session->userdata('user_id'),
	   			'db_one'   => $this->input->post('datasetOne') ,
	   			'db_two'   => $this->input->post('datasetTwo')
			);

			$this->dashboard_model->create_vis($content);
			redirect('dashboard/select/' . $content['uri'], 'refresh');
		}
	}

    /**
     * Select attributes from specified tables.
     *
     * @param boolean $uri visualisation name
     * @return user to next stage of data visualistion (view visualistion).
    */
	public function select($uri = FALSE)
	{
		$uri or show_404();

		$data = array(
			'title'   => 'Select attributes',
			'content' => $this->dashboard_model->set_atts($uri)
		);

		//check the form for errors, if they are any then fire them
		if($this->form_validation->run('select') == FALSE)
		{
			$this->load->template('dashboard/select', $data);
		}
		else
		{	//otherwise we are good to update and move on!
			$this->dashboard_model->update_atts($this->input->post('selectedAtts', TRUE), $data['content']['content']['vis_name']);
			redirect('dashboard/view/' . $uri . '/', 'refresh');
		}
	}

    /**
     * View unique visualistion
     *
     * @param  boolean  $uri  visualistion name
    */
	public function view($uri = FALSE)
	{
		$uri or show_404();

        $data = array('title' => 'hi', 'content' => $this->dashboard_model->view($uri));
        $this->load->template('dashboard/view', $data);
	}


































    /**
     * Delete visualisation
     *
     * @param  string  $uri  uri of visualisation - vis_name hyphenated.
    */
	public function delete($uri = FALSE)
	{
		$uri or show_404();
		$this->dashboard_model->delete($uri);
		redirect('dashboard');
	}































	public function upload()
	{
		
	}






















    


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
	function _check_visname($visname)
	{
		return $this->dashboard_model->check_visname($visname, $this->session->userdata('user_id'));
	}

    /**
     * Form helper function to prevent user selecting first fields.
     *
     * @param $field string The field we will compare
     * @return true or false. False throws an error.
    */
	function _selected($field)
	{
		return $field == '0' ? FALSE : TRUE;
	}

    /**
     * Form helper function to prevent user comparing the same table for visualistion.
     *
     * @return true or false. False throws an error.
    */
	function _same_options()
	{
		if ( $this->input->post('datasetOne') != '0' && $this->input->post('datasetOne') == $this->input->post('datasetTwo') )
		{
			return FALSE;
		}
		return TRUE;
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
	function _count_select($array)
	{
		return count($array) > 3 ? FALSE : TRUE;
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */