<?php
session_start();

if(!isset($_GET['orderID'])) { header('Location: /'); }
if(!isset($_SESSION['orderID']) || $_SESSION['orderID'] == 0) { $_SESSION['orderID'] = $_GET['orderID']; }
if(isset($_GET['success'])) {
    unset($_SESSION['products']);
header("Location: /#success");
}
elseif(isset($_GET['ordersent'])) {
header("Location: /#ordersent");
}