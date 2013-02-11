<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home &middot; Group Seven</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="./js/d3.js"></script>
  <script src="./js/jquery.js"></script>
  <script src="./js/arbor.js"></script>
  <script src="./js/arbor-tween.js"></script>
  <script src="./js/renderer.js"></script>
  <script src="./js/graphics.js"></script>
</head>
<body>
<?php

//ini_set("memory_limit","800M"); // needed if outputing entire dataset to screen.
//require 'core/libraries/Database.php';
//require 'core/libraries/Retweet.php';

//$db = new Database();
//$rt = new Retweet($db);

Echo '<pre>';
//print_r($rt->graphit());
Echo '</pre>';

?>
<?php 
//<script>
    //var dataa = <?php echo json_encode($rt->graphit()); ;
//</script>
?>
<canvas id="viewport" width="1200" height="500"></canvas>
<script src="..../js/main.js"></script>
<script>
var sys = arbor.ParticleSystem();
sys.parameters({stiffness:900, repulsion:2000, gravity:true, dt:0.015})
sys.renderer = Renderer("#viewport");

var origin = sys.addNode('Animals',{'color':'red','shape':'dot','label':'ORG'});
var retweet = sys.addNode('dog',{'color':'blue','shape':'dot','label':'FAR'});
var rt = sys.addNode('cat',{'color':'blue','shape':'dot','label':'CLOSE'});
var rt6 = sys.addNode('cast',{'color':'blue','shape':'dot','label':'CLOSE'});
var rt2 = sys.addNode('caat',{'color':'blue','shape':'dot','label':'CLOSE'});
sys.addEdge(origin, retweet, 2);
sys.addEdge(origin, rt, 0.5);
sys.addEdge(origin, rt6, 1);
sys.addEdge(origin, rt2, 1);
</script>
</body>
</html>

