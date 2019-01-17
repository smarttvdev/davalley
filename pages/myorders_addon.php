<?php
session_start();
$_SESSION['tipsval'] = $_POST['indoortips'];
$_SESSION['tenderval'] = $_POST['indoortender'];
$_SESSION['confirm_payment'] = 1;
header("Location: /#myorders");
