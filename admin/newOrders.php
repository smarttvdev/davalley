<?php

// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
session_start();
require_once("../SMS_Module/twilio/Services/Twilio.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/paginare.class.php");
if($_SESSION['logat'] == false) { header("Location: login.php"); exit();}
$new_orders = orderPaidListBuzz(null,null,0);
header("Content-Type: application/json");
if(count($new_orders)>0) {
    echo json_encode($new_orders);
} else {
    echo json_encode(array());
}
