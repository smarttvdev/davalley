<?php
session_start();
if(!isset($_GET['orderID'])) { header('Location: /'); }
else{
$_SESSION['orderID'] = $_GET['orderID'];

 unset($_SESSION['tipsval']);
 unset($_SESSION['tenderval']);
 unset($_SESSION['confirm_payment']);

}
//if(!isset($_SESSION['orderID']) || $_SESSION['orderID'] == 0) {  $_SESSION['orderID'] = $_GET['orderID']; }
if(isset($_GET['success'])) {
    unset($_SESSION['products']);
header("Location: /#success");
}
elseif(isset($_GET['ordersent'])) {
header("Location: /#ordersent");
}