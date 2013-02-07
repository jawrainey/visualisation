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
    
    $numbers = array(1,2,3,4,5,6,7,8,9);
    foreach ($numbers as $num)
    {
        if ($num % 2 != 0)
        {
            echo 'It is an odd number: ' + $num;
        }
    }

?>

</body>
</html>

