<html>
<head>
	<title>Retrieve</title>
	<?php
		$dbc = mysql_connect("ephesus.cs.cf.ac.uk", "g7y2012", "Cagyov") or die("Error");
		mysql_select_db("g7y2012db") or die("Error Selecting DB");
	?>
</head>
<body>
	<?php
		$result = mysql_query("SELECT * FROM cosmos WHERE latitude IS NOT NULL AND longitude IS NOT NULL ORDER BY latitude DESC");
		while($row = mysql_fetch_array($result))
		{
			echo $row['latitude'] . " latitude <br/>";
			echo $row['longitude'] . " longitude <br/>";
			echo $row['timestamp'] . " timestamp <br/>";
			echo $row['tweet_id'] . " tweet ID <br/>";
			echo $row['location'] . " location <br/>";
			echo $row['tweet_text'] . " tweet <br/>";
			echo "<br/><br/>";
		}
	?>
</body>
</html>