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
     * @return the most repeated sentence in a given column.
     */
    public function most_retweet($hashtags = False)
    {
        //cosmos holds the database rows in an array - thus it's an array of arrays
        $cosmos = $this->db->select('SELECT * FROM cosmos');
        $retweets = array();
        
        foreach ($cosmos as $row)
        {
            if (preg_match("/RT/", $row['tweet_text']))
            {
                array_push($retweets, $row['tweet_text']);
            }
        }
        return array_keys(array_count_values($retweets), max(array_count_values($retweets)))[0];
    }

    /**
     * Extract twitter username from tweet.
     *
     * @return username from twitter tweet.
     */
    public function getName($tweet)
    {
        preg_match('/@([A-Za-z0-9_]{1,15})/', call_user_func($tweet), $username);
        return $username[0];
    }

    /*
     * 
     *
     * @return ...?
     */    
    public function graphit()
    {
        $retweets = array();
        $cosmos = $this->db->select('SELECT * FROM cosmos');
        $mostrt = $this->most_retweet();

        foreach ($cosmos as $row)
        {
            if (preg_match('/'.$mostrt.'/', $row['tweet_text']))
            {
                array_push($retweets, array('datetime' => date('Y-m-d H:i:s',$row['timestamp']), 'location' => $row['location']));
            }
        }

        $origin = $retweets[0]['datetime'];
        
        foreach ($retweets as $array)
        {
            $next_datetime = $array[0][0];
            $res = $next_datetime - $origin;
        }
    }
}
