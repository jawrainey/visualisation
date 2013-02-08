<?php
require 'Database.php';
ini_set("memory_limit","800M");
/**
 * Obtain the most re-tweeted tweet from a given dataset...
 **/
class Retweet
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    
    function most_retweet()
    {
        //cosmos holds the database rows in an array - thus it's an array of arrays
        $cosmos = $this->db->select('SELECT * FROM cosmos');
        
        $retweets = array();

        foreach ($cosmos as $row)
        {
            if (preg_match("/RT/", $row['tweet_text']))
            {
                array_push($retweets, $row['tweet_text']);
                //echo "<pre>".print_r($row['tweet_text'],true)."</pre>";
            }
        }

        foreach ($retweets as $tweet)
        {
            // code...
        }
        echo "<pre>".print_r($retweets)."</pre>";    
    }
}

$db = new Database();
$rt = new Retweet($db);

print $rt->most_retweet();
