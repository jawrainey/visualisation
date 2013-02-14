<?php

ini_set("memory_limit", "800M"); // needed to output large dataset on screen.
//Included the database class to use it below
require 'core/libraries/Database.php';
//Includes YOUR class (YOU SHOULD SPECIFY YOUR OWN!
require 'core/libraries/Retweet.php';

//Creating new "instance" of the database object, and storing it in the 
//variable $database.
$database = new Database();
//I then create a new instance of my specific class, in this case retweet.
//I pass the database instance to the Retweet object.
//Inside the RETWEET class the object is created, and the variable "db" in that 
//class now contains a link to the database object.
//This is known as dependency injection, and is useful as it prevents 
//dependencies amongst objects. This way, we do not create a new instance of 
//database in each individual class, but rather, just pass the one we created
$retweet  = new Retweet($database);

//To access connect from the database and store it in a variable you would 
//write the following:
$cosmos = $database->select("SELECT * FROM cosmos");
//This uses the database instance, and calls the select function from that 
//class, passing the specific SQL query to it. The result of this query is then 
//stored in the variable $cosmos. This is in an assoative array such as:
//"location" => belfast
// The syntax used is just like java - class.function(parameter)

//Now $cosmos stores all the data in our database we can do some logic on it, 
//such as displaying each row to the user.
//Note: This may take a few seconds to run.
foreach ($cosmos as $row)
{
    //echo is not used as row is an array, and you cannot print arrays like 
    //strings.
    echo "<pre>"; 
    print_r($row);
    echo "</pre>";
}

//I have created a class for each group to use, and you should put your logic 
//into it, then create an instance of that class as above.
//You could then call a specific function, and store thoses results to 
//a javascript object, such as:
?>
<script> var data = <?php echo json_encode($rt->most_retweet()); ?>  </script>
