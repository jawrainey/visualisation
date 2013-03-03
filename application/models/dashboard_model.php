<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	function __construct()
	{
        parent::__construct();
	}

    /**
     * Select vis name to use for navigation of user's operations (CRUD)
     * 
     * @param  filters the dashboard - only showing the user's specific visualisations
     * @return associative array of vis_name => visualization's name
    */
	public function index($userid)
	{
		return $this->db->select('vis_name, uri')->get_where('user_visualisation', array('user_id' => $userid))->result_array();
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
     * Create user visualisation from selected data - STAGE ONE
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
     * @return array containing table names that are not those specified.
    */
	public function select_datasets()
	{
		return array_diff($this->db->list_tables(), array('users', 'user_visualisation'));
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
        
        //if result is not empty - a visualistion of the same name exists!
        if ( count($result) > 0)
        {
        	return FALSE;
        }
        return TRUE;
    }

    /**
     * Select attributes stored in database - STAGE TWO
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
        //return three arrays. 
        return array('content' => $data, 'attributes' => array_diff($left, $right), 'set_attributes' => $right);
    }

    /**
     * Update attributes stored in database as user may change visualistion - STAGE TWO
     * 
     * @param  $content array  $_POST data containing visualistion attributes 
     * @param  $visname string used as primary key
    */
	public function update_atts($content, $visname)
	{
        //LOL This is shocking, but oh well - YOLO!
        //(Note: MUST refactor later)
        //Perhaps ask stackoverflow for help...
        //How can I change posted keys?
        $data = array(
            'att_one' => $content[0],
            'att_two' => isset($content[1]) ? $content[1] : '',
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

        //run ONE query for each table...
        //check to see if attributes are in list_fields.
        //those that are, use them in the query...


        //get database names and attribute names from current user's vis...
        $data = $this->db->get_where('user_visualisation', array('uri' => $uri))->row();

        //echo "'$data['db_one']'";
        //$this->db->select($data['db_one'], content, date');

        // $results = array();
        $select = array($data->att_one, $data->att_two, $data->att_three);
        // $tables = array($data->db_one, $data->db_two);

        // foreach ($tables as $tableName)
        // {
        //     $results[$tableName] = $this->db->select($select)
        //         ->get($tableName)
        //         ->result_array();
        // }

        $fields1 = $this->db->list_fields($data->db_one);
        $fields2 = $this->db->list_fields($data->db_two);

        echo "<pre>";
        $tbl1 = array_intersect($fields1, $select);
        $tbl2 = array_intersect($fields2, $select); 

        //print_r($tbl1);
        //print_r($tbl2);

        print_r($this->db->select($tbl1)->get($data->db_one)->result());
                print_r(json_encode($this->db->select($tbl1)->get($data->db_one)->result(), JSON_PRETTY_PRINT));
        //print_r($this->db->select($tbl2)->get($data->db_two)->result());

        //$ar = array_merge($this->db->select($tbl1)->get($data->db_one)->result_array(), $this->db->select($tbl1)->get($data->db_two)->result_array());
        echo "</pre>";

        //result should be an array like this:
        //array(=>)




        //SELECT * FROM DB_ONE, DB_TWO WHERE attribute = att_one, att_two, att_three
		return $this->db->get_where('user_visualisation', array('uri' => $uri))->result_array();		
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
/* Location: ./application/controllers/dashboard_model.php */