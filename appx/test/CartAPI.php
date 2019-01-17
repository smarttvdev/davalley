<?php
session_start();
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
// Shopping Cart API

require_once("SMS_Module/classes/paginare.class.php");
require_once("SMS_Module/classes/config.php");
require_once("SMS_Module/classes/mysqli.php");
require_once("SMS_Module/classes/sql.class.php");


dumpSession( "cartAPI" );
$logString = "";
$result = array();

	if($_GET["action"] == "updateCartQuantityMiuns") {		
		$id = $_GET['id'];
		
		if(isset($_SESSION['temp_products']))
			unset($_SESSION['temp_products']);
		
		foreach($_SESSION['products'] as $item) {
			if($item["itemCode"] == $id) {
				if($item["quantity"] <= 1)
					unset($item);
				else
					$item["quantity"] = ($item["quantity"] - 1);
			}
			if($item["quantity"] > 0)
				$_SESSION["temp_products"][] = $item;
		}
		
		unset($_SESSION["products"]);
		$_SESSION["products"] = $_SESSION["temp_products"];
		$result['success']['msg'] = "OK";
	}
	
	if($_GET["action"] == "updateCartQuantityPlus") {
		$id = $_GET['id'];		
		
		if(isset($_SESSION['temp_products']))
			unset($_SESSION['temp_products']);
		
		foreach($_SESSION['products'] as $item) {
			if($item["itemCode"] == $id) {
				$item["quantity"] = ($item["quantity"] + 1);
			}
			$_SESSION["temp_products"][] = $item;
		}
		
		unset($_SESSION["products"]);
		$_SESSION["products"] = $_SESSION["temp_products"];
		$result['success']['msg'] = "OK";
	}
	
	if($_GET["action"] == "updateTip") {
		$tip = $_GET["tip"];
		$tipAmount = $_GET["tipAmount"];
		
		if($tip == "10") {
			$_SESSION["tipType"] = "percentage";
			$_SESSION["tipValue"] = "10";
		} else if($tip == "15") {
			$_SESSION["tipType"] = "percentage";
			$_SESSION["tipValue"] = "15";
		} else if($tip == "0") {
			$_SESSION["tipType"] = "amount";
			$_SESSION["tipValue"] = $tipAmount;
		}
		 else if($tip == "-1") {
			$_SESSION["tipType"] = "notip";
			$_SESSION["tipValue"] = 0;
		}
		$result['success']['msg'] = "OK";
	}

if($_GET['action'] == 'add') {
    if (empty($_GET['id'])) {
        $result['error']['msg'] = "No ID specified";
    } else {

        $sideOrder = (isset($_GET['sideOrder'])) ? explode(',',$_GET['sideOrder']) : '';
        $cookWith = "";
        if(is_array($sideOrder)) {
            foreach ($sideOrder as $so) {
                $_item = itemByRealID($so);
                $cookWith .= sprintf("%s & ", $_item['itemName']);
            }
        }

        $item = itemByID($_GET['id']);
        $cookWith .= $_GET['cookWith'];
        $item['quantity'] = 1;
        $item['cookWith'] = ($cookWith != '') ? trim($cookWith) : "";
        $item['sideOrder'] = $sideOrder;
        if (changeQuantity($item['itemCode'], $item['cookWith']) == false) {
            $_SESSION['products'][] = $item;
        }
        if ($item > 0) {
            $result['success']['msg'] = $item['itemName'] . " added to cart";
        }
    }

}
elseif($_GET['action'] == 'getSideOrder') {
    $id = $_GET['id'];
    $item = itemByID($id);
    $sideOrderCat = $item['sideOrderCat'];
    $sideOrderLimit = $item['sideOrderLimit'];
    $result['list'] = itemsByCategory($sideOrderCat);
    $result['sideOrderLimit'] = $sideOrderLimit;
}
elseif($_GET['action'] == 'count') {
	$logString = 'count called ' . count( $_SESSION['products'] );
    $result['success']['msg'] = count($_SESSION['products']);

}
elseif($_GET['action'] == 'complete') {
    $isCompleted = $_GET['complete'];
    $id = $_GET['id'];
    markComplete(array(
        'id'=>$id,
        'isCompleted'=>$isCompleted
    ));
}
elseif($_GET['action'] == 'setPhone') {
    $phone = str_replace(array(' ', '+'), array(''), $_GET['phone']);
$logString .= "setPhone ";
    if (!empty($_GET['phone'])) {
        $result['success']['msg'] = $phone;
        $_SESSION['phoneNumber'] = $phone;
$logString .= "phoneNumber set to " . $phone;
if( count( $_SESSOIN['products'] ) > 0 )
{
	$logString .= "will be calling placeOrder";
}
        foreach($_SESSION['products'] as $order) {
            $order['phoneNumber'] = $_SESSION['phoneNumber'];
            placeOrder($order);
        }
    }
}

elseif($_GET['action'] == 'checkPhone') {
$logString .= "checkPhone ";
    if (!isset($_SESSION['phoneNumber'])) {
$logString .= " phone not set";
        $result['error']['msg'] = "Not phone set";
    } else {
        $result['success']['msg'] = "OK";
        $result['success']['phone'] = $_SESSION['phoneNumber'];
$logString .= " phone is set";
if( count( $_SESSION['products'] ) > 0 )
{
	$logString .= "will be calling placeOrder";
}
        foreach($_SESSION['products'] as $order) {
            $order['phoneNumber'] = $_SESSION['phoneNumber'];
            placeOrder($order);
        }
    }
}
elseif($_GET['action'] == 'empty') {
clearOrder($_SESSION['phoneNumber']);
session_destroy();
$result['success']['msg'] = 'OK';
} else {
    $result['error']['msg'] = 'Not implemented';
}

if( strlen( $logString ) > 0 )
{
	$result['log'] = $logString;
}
echo json_encode($result);
?>
