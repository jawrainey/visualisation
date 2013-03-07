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
        $this->session->set_userdata(array('user_id' => 2, 'user_type' => 1));
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
        
        //If there are errors, show them!
        if($this->form_validation->run('create') == FALSE)
        {
            $this->load->template('dashboard/create', $data);
        }
        else
        {
            //Otherwise submit the form
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
        $uri or show_404(); //If uri is false, show an error!
        
        $data = array(
            'title'   => 'Select attributes',
            'content' => $this->dashboard_model->set_atts($uri)
        );
        
        if($this->form_validation->run('select') == FALSE)
        {
            $this->load->template('dashboard/select', $data);
        }
        else
        {
            $this->dashboard_model->update_atts($this->input->post('selectedAtts', TRUE), $data['content']['content']['vis_name']);
            redirect('dashboard/view/' . $uri . '/', 'refresh');
        }
    }
    
    /**
     * View unique visualistion
     *
     * @param  boolean  $uri  visualistion namie
    */
    public function view($uri = FALSE)
    {
        $uri or show_404();
        $content = $this->dashboard_model->view($uri);
        $data = array(
            'title' => $content['title']['vis_name'],
            'content' => $content['vis_data'],
            'recommendations' => $this->dashboard_model->recommendation($uri));
        
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
        //make userid also delete...
        $this->dashboard_model->delete($uri, $this->session->userdata('user_id'));
        redirect('dashboard');
    }

    /**
     * TODO: Allows the user to upload their own data (in csv or json) to visualise.
    */
    public function upload() {}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
