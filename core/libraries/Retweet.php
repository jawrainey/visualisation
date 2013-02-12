<?php
/**
* Obtain the most re-tweeted tweet from a given dataset.
*/
class Retweet
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Most re-tweeted tweet
     *
     * @return the date/time, and location of all the most repeated sentences 
     */
    public function most_retweet($hashtags = False)
    {
        $cosmos   = $this->db->select('SELECT * FROM cosmos');
        $retweets = array();
        $rts      = array();
        
        //creates an array of ALL retweets.
        foreach ($cosmos as $row)
        {
            if (preg_match("/RT/", $row['tweet_text']))
            {
                array_push($rts, $row['tweet_text']);
            }
        }

        //this is the most repeated sentence in the given field above.
        $mostrt = array_keys(array_count_values($rts), max(array_count_values($rts)))[0];
        
        //Filter's the array 
        //Not the best routine as:
        //1. Second database connection is made.
        //2. Could push the same rows in the above foreach, then extract the 
        //mostrt from this foreach - reducing sample space.
        foreach ($cosmos as $row)
        {
            if (preg_match('/'.$mostrt.'/', $row['tweet_text']))
            {
                echo "<pre>";
                echo $row;
                echo "</pre>";
                array_push($retweets, array('datetime' => date('Y-m-d H:i:s',$row['timestamp']), 'location' => $row['location']));
            }
        }   
        
        $origin = new DateTime($retweets[0]['datetime']);
        
        foreach ($retweets as &$array)
        {
            //current retweet datetime minus origin datetime
            //This is probably not the most efficent solution:
            //(creating two DateTime objects just to calculate the difference.)
            $array['datetime'] = $origin->diff(new DateTime($array['datetime']))->format('%h hours, %i minutes, %s seconds');
        }
        
        return $retweets;
    }

}
