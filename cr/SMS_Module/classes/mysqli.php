<?php
$mysqli = mysqli_connect("localhost", "root", "axtdev", "myorders");

// $mysqli = new mysqli("myorders.db.11874827.hostedresource.com", "myorders", "Davalley7!", "myorders");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
#echo $mysqli->host_info . "\n";
 
?>