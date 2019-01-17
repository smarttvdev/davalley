<?php 
session_start();
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

//echo "<pre>";print_r($_SESSION['products']);die;

function orderOflinePaid($phone, $cash='0') {
global $mysqli;
	
    $data = $_SESSION['products'];
    $num_rows = count($_SESSION['products']);
    if($num_rows == 0) { return; }
    $uniqueID = GetUniqueID();
	foreach($data as $row) {
		if(count($row['sideOrder'])>0){
			$sideOrderval = implode(',',$row['sideOrder']);
		}else{
			$sideOrderval = '';
		}
		$sql = "INSERT INTO `ordersPaid` (phone, orderID, itemID, cookWith, sideOrder, quantity, dateOrdered, cash, orderCompleted,orderBy) VALUES ('".$phone."','".$uniqueID."','".$row['itemCode']."','".$row['cookWith']."','".$sideOrderval."','".$row['quantity']."',now(),'".$cash."','1','".$_SESSION['UserID']."')";
		$mysqli->query($sql);
	}
	
return $uniqueID;
}

echo $sql = orderOflinePaid('Indoor');
?>