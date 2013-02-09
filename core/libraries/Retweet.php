<?php
require 'Database.php';
ini_set("memory_limit","800M"); // needed if outputing entire dataset to screen.
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
    public function most_retweet()
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
        preg_match('/@([A-Za-z0-9_]{1,15})/', $tweet, $matches);
        return $matches[0];
    }
}

$db = new Database();
$rt = new Retweet($db);

Echo "<pre>";
print_r($rt->most_retweet());
Echo "</br>";
print_r($rt->getName());
Echo "</pre>";

