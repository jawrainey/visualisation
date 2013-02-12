<?php
// Here's an array containing some data to plot
$test_data=array(0.5,6,12,17,2,0.3,9);

// Here's where we call the chart, and return the encoded chart data
echo "<img src=http://chart.apis.google.com/chart?chtt=".urlencode("It's an example!")."&cht=lc&chs=450x125&chd=".chart_data($test_data).">";

// And here's the function

function chart_data($values) {

// Port of JavaScript from http://code.google.com/apis/chart/
// http://james.cridland.net/code

// First, find the maximum value from the values given

$maxValue = max($values);

// A list of encoding characters to help later, as per Google's example
$simpleEncoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 
$chartData = "s:";
  for ($i = 0; $i < count($values); $i++) {
    $currentValue = $values[$i];

    if ($currentValue > -1) {
    $chartData.=substr($simpleEncoding,61*($currentValue/$maxValue),1);
    }
      else {
      $chartData.='_';
      }
  }

// Return the chart data - and let the Y axis to show the maximum value
return $chartData."&chxt=y&chxl=0:|0|".$maxValue;
}
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'></script>
    
	<script type="text/javascript">
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);


      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

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

</script>
  
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
