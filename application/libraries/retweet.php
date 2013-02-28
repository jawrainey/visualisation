<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Obtain the most re-tweeted tweet from a given dataset.
*/
class Retweet
{
    private $db;

    public $nodes;

    function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Most re-tweeted tweet
     *
     * @return the time from origin retweet, and location of all the most repeated tweets
     */
    public function most_retweet($hashtags = False)
    {

        #$cosmos   = $hashtags ? $this->db->select('SELECT * FROM cosmos WHERE `tweet_id` IN {$hashtags}') : $this->db->select('SELECT * FROM cosmos');

        $cosmos   = $this->db->select("SELECT * FROM cosmos WHERE `location` != '-'");
        $retweets = array();
        $rts      = array();
        
        //creates an array of ALL retweets.
        foreach ($cosmos as $row)
        {
            // if (stripos("/RT/", $row['tweet_text']) === 0 )
            if (preg_match("/RT/", $row['tweet_text']))
            {
                array_push($rts, $row['tweet_text']);
            }
        }

        //this is the most repeated sentence in the given field above.
        $mostrt = array_keys(array_count_values($rts), max(array_count_values($rts)))[0];

        //print_r($mostrt);

        foreach ($cosmos as $row)
        {
            if (preg_match('/'.$mostrt.'/', $row['tweet_text']))
            {
                array_push($retweets, array('datetime' => date('Y-m-d H:i:s',$row['timestamp']), 'location' => $row['location'], 'group' => 3));
            }
        }   
        
        //print_r($retweets);

        $origin = new DateTime($retweets[0]['datetime']); //first re-tweet time
        
        $nodes = array();

        array_push($nodes, array('name' => $mostrt, 'group' => 1)); //most retweeted tweet - origin (center node)

        foreach ($retweets as &$array)
        {
            //current retweet datetime minus origin datetime
            //This is probably not the most efficent solution:
            //(creating two DateTime objects just to calculate the difference.)
            $array['datetime'] = $origin->diff(new DateTime($array['datetime']))->format('%h hours, %i minutes, %s seconds');
        }

        //All the citites that branch from origin. (Locations retweets took place)
        foreach ($retweets as $array)
        {
            if (!in_array($array['location'], $nodes))
            {
                array_push($nodes, array('location' => $array['location'], 'group' => 2));
            }
        }

        Echo 'this is the locations before anything...';
        $j = 0;
        foreach ($retweets as $array)
        {
            array_push($nodes, $array);
            $j++;
            print_r(array($j => $array['location']));
        }


        $links = array();
        $cities = array();
        $source = 0; // +1 for each group...
        $target = 0;

        foreach ($nodes as $array)
        {
            //print_r($array);

            //ORIGIN
            if ($array['group'] == 1)
            {
                array_push($links, array('source' => 0, 'target' => 0));
            }
            //LOCATION OF TWEETS
            elseif ($array['group'] == 2 && !in_array($array['location'], $cities))
            {
                array_push($links, array('source' => ++$source, 'target' => 0));
                $cities[++$target] = $array['location'];
            }
            //RETWEETS - GROUPING BY LOCATION
            elseif($array['group'] == 3 && in_array($array['location'], $cities))
            {
                echo key($cities); 
                //since city exists
                //add it to the links JSON list
                array_push($links, array('source' => ++$source, 'target' => key($cities)));
                //now we must add city to the cities list, making the index the same number as targett
                //echo $array['location'];
                //echo "</br>";
            }//OH SHIT, CITY IS IN THE ARRAY ALREADY!
            else
            {
                array_push($links, array('source' => ++$source, 'target' => key($cities)));
            }
        }

        print_r($cities);
        //print_r($links);
        //print_r(count($nodes)); 
        //print_r(count($links) - 1);       
        return $links;
        //return $nodes;
    }
 

    /**
     * Nodes to map with D3.js
     *
     * @return D3.force network JSON type compatable array
     */   
    public function nodes()
    {

    }
    
    public function links()
    {

    }

    public function map()
    {
        return array($this->nodes(), $this->links());
    }

}

/* End of file retweet.php */
/* Location: ./application/controllers/retweet.php */
