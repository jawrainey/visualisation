<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home &middot; Group Seven</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
<?php
ini_set("memory_limit","800M"); // needed if outputing entire dataset to screen.
require 'core/libraries/Database.php';
require 'core/libraries/Retweet.php';

$db = new Database();
$rt = new Retweet($db);
?>
<script> var dataa = <?php echo json_encode($rt->most_retweet()); ?>  </script>
<script src="./js/libs/d3.js"></script>
<script src="./js/libs/jquery.js"></script>
</body>
</html>

