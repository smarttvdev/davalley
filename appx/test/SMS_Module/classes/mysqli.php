<?php
//$mysqli = new mysqli("myorders.db.11874827.hostedresource.com", "myorders", "Davalley7!", "myorders");
$mysqli = new mysqli("localhost", "greg", "siboco1T", "myorders");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
#echo $mysqli->host_info . "\n";
 
?>