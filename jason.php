<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Map API V3 with markers</title>
<style type="text/css">
body { font: normal 10pt Helvetica, Arial; }
#map { width: 350px; height: 300px; border: 0px; padding: 0px; }
</style>
<script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
<script type="text/javascript">
//Sample code written by August Li
var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
                                       new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                                       new google.maps.Point(16, 32));
var center = null;
var map = null;
var currentPopup;
var bounds = new google.maps.LatLngBounds();

function addMarker(lat, lng, info)
{
    var pt = new google.maps.LatLng(lat, lng);
    bounds.extend(pt);
    var marker = new google.maps.Marker({
                                        position: pt,
                                        icon: icon,
                                        map: map
                                        });
    var popup = new google.maps.InfoWindow({
                                           content: info,
                                           maxWidth: 300
                                           });
    google.maps.event.addListener(marker, "click", function() {
                                  if (currentPopup != null) {
                                  currentPopup.close();
                                  currentPopup = null;
                                  }
                                  popup.open(map, marker);
                                  currentPopup = popup;
                                  });
    google.maps.event.addListener(popup, "closeclick", function() {
                                  map.panTo(center);
                                  currentPopup = null;
                                  });
}

function initMap()
{
    map = new google.maps.Map(document.getElementById("map"), {
                              center: new google.maps.LatLng(0, 0),
                              zoom: 14,
                              mapTypeId: google.maps.MapTypeId.ROADMAP,
                              mapTypeControl: false,
                              mapTypeControlOptions: {
                              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                              },
                              navigationControl: true,
                              navigationControlOptions: {
                              style: google.maps.NavigationControlStyle.SMALL
                              }
                              });
    <?php
//    ini_set("memory_limit","800M"); // needed if outputing entire dataset to screen.
//    require 'core/libraries/Database.php';
//    
//    $db = new Database();
//    $cosmos = $db->select("SELECT * FROM cosmos WHERE `latitude` AND `location` != '-'");
//    
//    foreach ($cosmos as $row)
//    {
//        $name = $row['tweet_id'];
//        $lat  = $row['latitude'];
//        $long = $row['longitude'];
//        $desc = $row['location'];
//        echo ("addMarker($lat, $long,'<b>$name</b><br/>$desc');\n");
//    }
    
    ?>
    
    addMarker(51.514980, -0.144328,'<b>100 Club</b><br/>Oxford Street, London  W1&lt;br/&gt;3 Nov 2010 : Buster Shuffle&lt;br/&gt;');
    addMarker(51.521710, -0.071737,'<b>93 Feet East</b><br/>150 Brick Lane, London  E1 6RU&lt;br/&gt;7 Dec 2010 : Jenny &amp; Johnny&lt;br/&gt;');
    addMarker(51.511010, -0.120140,'<b>Adelphi Theatre</b><br/>The Strand, London  WC2E 7NA&lt;br/&gt;11 Oct 2010 : Love Never Dies');
    addMarker(51.521620, -0.143394,'<b>Albany, The</b><br/>240 Gt. Portland Street, London  W1W 5QU');
    addMarker(51.513170, -0.117503,'<b>Aldwych Theatre</b><br/>Aldwych, London  WC2B 4DF&lt;br/&gt;11 Oct 2010 : Dirty Dancing');
    addMarker(51.596490, -0.109514,'<b>Alexandra Palace</b><br/>Wood Green, London  N22&lt;br/&gt;30 Oct 2010 : Lynx All-Nighter');
    
    center = bounds.getCenter();
    map.fitBounds(bounds);
    
}
</script>
</head>
<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
<div id="map"></div>
</html>
