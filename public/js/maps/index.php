<!DOCTYPE html>
<html>
  <head>

	<title>Map Visualisation</title> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_XDIuyANwbDmupuR-sFVYSTmiydhiQLE&sensor=false">
    </script>
	</head>
	
	
	<body onload="initialise()">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
	

     <?php
	header("Content-type: text/xml");
	echo '<markers>';
		while($row = mysql_fetch_array($result))
	{
		if ($row['lat'] != "-")
		{
		echo '<marker ';
		echo 'lat="' . $row['lat'] . '" ';
		echo 'long="' . $row['long'] . '" ';
		echo '/>';
		}
		
	}
	echo '</markers>';

     ?>
	  var map = null;
	  
	  //function to display a plain map on page load
	  function initialise() 
		{
		//sets the center of the map to be the Isle of Man 
		//(roughly in the middle of the UK)
		var MapCenter=new google.maps.LatLng(53.800651,-4.724121);
		
		//removes unnecesary controls (street view etc)
		//zooms in to the UK
		//Road map looked more applicable than satelite for the visualisation
        var mapOptions = 
		{
		  disableDefaultUI: true,
          center:MapCenter,
          zoom: 6,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
		map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

	//AJAX to the php script for marker positions
	//Returns an XML file containg Lat & Long info
	//Iterates through the XML creating and ploting the 
	//markers on the previously created map
	//Uses drop animation for a less static effect 
	$.ajax(
			{
				type : 'POST', 
				url : "markerMaker.php", 
				dataType : 'xml',
		
				success : function(data)
				{
					var xml = data
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) 
						{	
						var MarkerPos = new google.maps.LatLng(
						parseFloat(markers[i].getAttribute("lat")),
						parseFloat(markers[i].getAttribute("long")));
						var marker = new google.maps.Marker
						({
							map:map,
							position:MarkerPos,
							animation:google.maps.Animation.DROP
						});
						marker.setMap(map);
						}
				}
			});
		};

	</script>
	
	
	<div id = "control">
	<hr />
	<h1>Map Visualisation</h1>
	<button id = "plot">Use Geocoding</button>
	<hr />
	</div>
	<div id="map_canvas" style="width:70%; height:80%"></div>
	</body>
</html>
