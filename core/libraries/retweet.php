<?php
require 'Database.php';
/**
 * i 
 **/
ini_set("memory_limit","800M");

class Retweet
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    
    function most_retweet()
    {
        $cosmos = $this->db->select('SELECT * FROM cosmos');
        
        print_r($cosmos);
    }
}

$db = new Database();
$rt = new Retweet($db);

print $rt->most_retweet();
