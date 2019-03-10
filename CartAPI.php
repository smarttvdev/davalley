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
	
	if($_GET["action"] == "removeInvoice") {
	$result['success']['msg'] = json_encode($_SESSION);	
		if(isset($_SESSION['gone_table'])){
			unset($_SESSION['gone_table']);	
			//$_SESSION['flag_uniqueINV'] = false;
			//$_SESSION['uniqueINV'] = 0;	
			clearOrder($_SESSION['phoneNumber']);
//			session_destroy();
            if (isset($_SESSION['uniqueINV']))
                unset($_SESSION['uniqueINV']);
            if (isset($_SESSION['flag_uniqueINV']))
                unset($_SESSION['flag_uniqueINV']);
            if (isset($_SESSION['orderID']))
                unset($_SESSION['orderID']);
            if (isset($_SESSION['tableSelected']))
                unset($_SESSION['tableSelected']);
            if (isset($_SESSION['tipType']))
                unset($_SESSION['tipType']);
            if (isset($_SESSION['phoneNumber']))
                unset($_SESSION['phoneNumber']);
            if (isset($_SESSION['orderID']))
                unset($_SESSION['orderID']);
            if (isset($_SESSION['gone_table']))
                unset($_SESSION['gone_table']);
            if (isset($_SESSION['products']))
                unset($_SESSION['products']);

		}
		
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
    if (!empty($_GET['phone'])) {
        $result['success']['msg'] = $phone;
        $_SESSION['phoneNumber'] = $phone;

        foreach($_SESSION['products'] as $order) {
            $order['phoneNumber'] = $_SESSION['phoneNumber'];
            placeOrder($order);
        }
    }
}
//Tai's hand
elseif($_GET['action'] == 'tableSelected'){
    $orderID = $_SESSION['uniqueINV'];

    if (empty($orderID) || !isset($orderID)){
        $result['error']['msg'] = "Failed to get unique ID";
    }
    $tableNum = $_GET['tableNum'];
    $update_result = updateTable($orderID , $tableNum);//$_SESSION['orderID']
    $_SESSION['tableSelected'] = true;
    
    $result['test']['orderID'] = $orderID;
    $result['test']['SS_orderID']=$_SESSION['orderID'];
    $result['test']['flag'] = $_SESSION['flag_uniqueINV'];
    $result['test']['uniqueID'] = $_SESSION['uniqueINV'];
    
    $_SESSION['products'] = array();
 
    if ($update_result){
        $result['success']['msg'] = 'OK';
	//$_SESSION['flag_uniqueINV'] = false;
        //$_SESSION['uniqueINV'] = 0;	
    }
    else 
        $result['error']['msg'] = 'Failed to update table.';
}
elseif($_GET['action'] == 'checkPhone') {
    if (!isset($_SESSION['phoneNumber'])) {
        $result['error']['msg'] = "Not phone set";
    } else {
        $result['success']['msg'] = "OK";
        $result['success']['phone'] = $_SESSION['phoneNumber'];
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


echo json_encode($result);