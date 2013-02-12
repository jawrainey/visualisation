<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Home &middot; Group Seven</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="./css/style.css" />
<!--Load the AJAX API-->
<script type="text/javascript" src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'></script>

<script type="text/javascript">
// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);


// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart()
{
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'City');
    data.addColumn('number', 'Number of Crimes');
    data.addRows([
                 ['Cardiff', 300],
                 ['London', 900],
                 ['Manchester', 500],
                 ['Dublin', 400],
                 ['Liverpool', 600]
                 ]);
    
    // Set Chart Options
    var options = {
        'legend': 'left',
        'title': 'Crimes (per day)',
        'is3D': 'True',
        'width':400,
        'height':300
    };
    
    // Instantiate and Draw Chart.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

hs.graphicsDir = '';
hs.align = 'right';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;

// The Restraining Box
hs.useBox = true;
hs.width = 700;
hs.height = 500;

function myfunction(text) {confirm(text)};
</head>

  <body>
    <div id="chart_div" style="width:400; height:300"></div>

	<form action="" method="post">
	<input type="button" onclick="javascript:history.go(-1)" value="Back">
	<input name="Save" type="submit" class="button" value="Save" onclick="myfunction('Do you want to save it?')">
	</form>
		
	<div class="highslide-gallery">
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 2"title="Click to enlarge" /></a>
	<div class="highslide-caption">Second Chart</div>
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 3"title="Click to enlarge" /></a>
	<div class="highslide-caption">Third Chart</div>
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 4"title="Click to enlarge" /></a>
	<div class="highslide-caption">Fourth Chart</div>
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 5"title="Click to enlarge" /></a>
	<div class="highslide-caption"> Fifth Chart</div>
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 6"title="Click to enlarge" /></a>
	<div class="highslide-caption">Sixth Chart</div>
		<a href="" class="highslide" onclick="return hs.expand(this)"><img src="" alt="Chart 7"title="Click to enlarge" /></a>
	<div class="highslide-caption">Seventh Chart</div>
	</div>
  </body>
</html>
