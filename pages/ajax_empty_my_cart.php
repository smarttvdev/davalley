<?php 
session_start();
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

//echo "<pre>";print_r($_SESSION['products']);die;

unset($_SESSION['products']);

echo '1';
?>