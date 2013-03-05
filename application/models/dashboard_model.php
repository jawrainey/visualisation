<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Select vis name to use for navigation of user's operations (CRUD).
     *
     * @param  filters the dashboard - only showing the user's specific visualisations.
     * @return associative array of vis_name => visualization's name.
    */
    public function index($userid)
    {
        return $this->db->select('vis_name, uri')
                        ->order_by("vis_name", "asc")
                        ->get_where('user_visualisation', array('user_id' => $userid))
                        ->result_array();
    }
    
    /**
     * Hyphenates a title to create a nice URI
     * (It's a helper function more than anything)
     *
     * @param  string  $title  title to convert
     * @return parsed title to uri
    */
    public function hyphenate($title)
    {
        $title = strtolower(str_replace(array("%20", " "), '-', $title));
        $title = preg_replace('/[^a-z\-]/i','',$title);
        return $title;
    }
    
    /**
     * Create user visualisation from selected data - STAGE ONE.
     * 
     * @param  array  $data Visualization specific data to be inserted.
    */
    public function create_vis($data)
    {
        $this->db->insert('user_visualisation', $data);
    }
    
    /**
     * Create user visualisation from selected data - STAGE ONE
     *
     * @return array containing table names that are not those specified
     * (e.g. the ones the user should not be able to visualise, such as user's in the database).
    */
    public function select_datasets()
    {
        return array_diff($this->db->list_tables(), array('users', 'user_visualisation', 'places'));
    }
    
    /**
     * Checks database to see if a visualistion name is already in use
     *
     * @param  string  $visname  visualistion name to compare with database
     * @return true or false based on the result
    */
    public function check_visname($visname, $userid)
    {
        $result = $this->db->get_where('user_visualisation', array('vis_name' => $visname, 'user_id' => $userid))->row_array();
        
        if (count($result) > 0)
        {
            return FALSE;
        }
        return TRUE;
    }
    
    /**
     * Select attributes stored in database - STAGE TWO.
     * Provide user with all attributes of their chosen tables to select for their visualisation.
     * 
     * @param  string  $uri Select attributes to use based on uri.
     * @return 3D associative array: content (to use in parts of page), attributes (to fill left box) and set_attributes (to fill in right box).
    */
    public function set_atts($uri)
    {
        //select vis_name, and both database names that contain the unique uri. Return as one array.
        $data = $this->db->get_where('user_visualisation', array('uri' => $uri))->row_array();
        //set the left and right attributes using the data just selected from the database...
        $left  = array_merge($this->db->list_fields($data['db_one']), $this->db->list_fields($data['db_two']));
        $right = array('att_one' => $data['att_one'], 'att_two' => $data['att_two'], 'att_three' => $data['att_three']);
        return array('content' => $data, 'attributes' => array_diff($left, $right), 'set_attributes' => $right);
    }
    
    /**
     * Update attributes stored in database as user may change visualistion - STAGE TWO 
     * @param  $content array  $_POST data containing visualistion attributes.
     * @param  $visname string used as primary key.
    */
    public function update_atts($content, $visname)
    {
        //(Note: MUST refactor later)
        // How can I change posted keys (names, values of course...)
        // but then that makes code repeated more... -_-
        $data = array(
            'att_one'   => $content[0],
            'att_two'   => isset($content[1]) ? $content[1] : '',
            'att_three' => isset($content[2]) ? $content[2] : ''
        );
        $this->db->update('user_visualisation', $data, array('vis_name' => $visname));
    }
    
    /**
     * Selects unique specified visualisation based on parameters.
     * This data will be used for user visualistions (main, and thumbnails).
     *
     * @param  string  $uri  visualisation name to search for in database to select unique row.
     * @return associative array of selected visualistion data
    */
    public function view($uri)
    {
        $data = $this->db->get_where('user_visualisation', array('uri' => $uri))->row();
        $attributes = array($data->att_one, $data->att_two, $data->att_three);
        
        //SO IF ALL ITEMS ARE NOT IN ARRAY... THROW AN ERROR?
        $db_one_fields = $this->db->list_fields($data->db_one);
        $db_two_fields = $this->db->list_fields($data->db_two);
        //find the elements that are the both...
        $select_one = array_intersect($db_one_fields, $attributes);
        $select_two = array_intersect($db_two_fields, $attributes);
        //run both queries against their relevant
        $query_one = $this->db->select($select_one)->get($data->db_one)->result_array();
        $query_two = $this->db->select($select_two)->get($data->db_two)->result_array();
        //...so... if all attributes are not in both, then just use the ones they're in?
        return array('title' => array('vis_name' => $data->vis_name), 'vis_data' => array_merge($query_one, $query_two));   
    }
    
    /**
     * Our hard-coded recommendation system
     *
     * @param  array attributes  All the attributes that the user has selected.
     * @return array $visit An array of all possible visualisations for the given dataset.
    */
    public function recommendation($uri)
    {
        //It's more of a classification system. The two queries are repeated in 
        //the view function above... bad times.
        $data = $this->db->get_where('user_visualisation', array('uri' => $uri))->row();
        $attributes = array($data->att_one, $data->att_two, $data->att_three);
        
        //We are currently hardcoding in the visualisations. Our plan is to make this "dynamic"
        //This would be achieved with an ontology for each attribute in the database grouped by type.
        $visualisations = array(
            'bar_chart'  => array('pos_sentiment', 'neg_sentiment'),
            'pie_chart'  => array('gender', 'location', 'pos_sentiment', 'neg_sentiment'),
            'line_chart' => array('pos_sentiment', 'neg_sentiment','location','crimes','officers'),
            'maps'       => array('lat', 'long', 'location'),
            'network'    => array('tweet_text', 'timestamp', 'location')
        );
        
        $recommendations  = array();
        
        foreach ($visualisations as $key => $array)
        {
            if (count(array_intersect(array_filter($attributes), $array)) == count(array_filter($attributes)))
            {
                $recommendations[] = $key;
            }
        }
        return $recommendations;
    }
    
    /**
     * Deletes a visualisation
     *
     * @param  string  $uri  Delete visualisation by the given uri
    */
    public function delete($uri)
    {
        return $this->db->delete('user_visualisation', array('uri' => $uri)); 
    }
}

/* End of file dashboard_model.php */
/* Location: ./application/models/dashboard_model.php */
