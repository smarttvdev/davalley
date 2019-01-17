<?php
//ini_set('display_errors', true);
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro

require_once("twilio/Services/Twilio.php");
require_once("classes/mysqli.php");
require_once("classes/sql.class.php");
require_once("classes/config.php");
// Your Account Sid and Auth Token from twilio.com/user/account

$sendFrom = $CONFIG['phoneNumber'];
$sid = $CONFIG['sid']; 
$token = $CONFIG['token']; 
$client = new Services_Twilio($sid, $token);
// Some useful functions

function showDefaultList() { // Shows if body message is empty 
global $CONFIG;
	$string = $CONFIG['company'] . "\n";
	
foreach(itemsByCategory(3) as $item) {
	#$note = ($item['description'] != '') ? " - " . $item['description'] : "";
	$string .= $item['itemCode'] . ". " . $item['name'] . $note . "\n";	
	}
	$string .= "\nTo order, just text item number.\n";
	$string .= "H.Help\n";
	$string .= "N.Next\n";	
	$string .= "M.menu\n";		
	$string .= "C.CheckOut";			
	return $string;
}
function replyWithMessage($msg) { // Construct Function for XML reply 
ob_start();
header("Content-Type: text/xml");
$return = '<?xml version="1.0" encoding="UTF-8"?>';
$return .= "
<Response>
<Sms><![CDATA[".$msg."]]></Sms>
</Response>";
return $return;
ob_end();
}
function replyWithMessageAPI($msg,$media="") { // Construct function for GSM Format
global $client, $sendFrom;
if($media != '') {
$client->account->messages->sendMessage($sendFrom, $_GET['From'], $msg, $media);
} else {
var_dump($client->account->messages->sendMessage($sendFrom, $_GET['From'], $msg));
}
}
//function replyWithMessageAPI($msg, $media="") { // Used for Debug
//return replyWithMessage($msg);
//}

function showItemsByCategory($categoryId) { // Show Items by Category ID
global $client, $CONFIG;
		$item_list = "Items from " . catNameByID($categoryId);
		foreach(itemsByCategory($categoryId) as $item) {
#		$note = ($item['note'] != '') ? " - " . $item['note'] : "";

$item_list .= "
	4" . $categoryId . $item['id'] . ". " . $item['name'] . $note;
		}
$item_list .= "
	9. Back
To see all items from this category click on the following link: ".$CONFIG['site']."/#menu";		
		return $item_list;
}
function showCategories() { // Show Categories
global $client, $From;
		$cat_list = "Business Name:";
		foreach(categoryList() as $item) {
#		$note = ($item['note'] != '') ? " - " . $item['note'] : "";
$cat_list .= "
	4" . $item['id'] . ". " . $item['name'] . $note;
		}
		$listItemPage = $listItemPage + 1; 
		echo replyWithMessageAPI($cat_list);
}


$listItemPage = 0;
$allowed_replies = array('o', 'n', 'd','m','p','c','s','cc'); // Allow reply with the following words excluding numbers
$isMultiple = false; // If true then message contain backslash
$isSingle = false; // if is true then is Cooked with something
switch($_GET['action']) {

case 'SMSHandle':
// Number From Received

$From = str_replace('+','',$_GET['From']); // Number phone +122222222222
$vars = array();
$vars['phoneNumber'] = $From;
$vars['city'] = $_GET['FromCity'];
$vars['country'] = $_GET['FromCountry'];
$vars['zip'] = $_GET['FromZip'];
addCustomer($vars);
$body = $_GET['Body'];
if(empty($body)) { echo replyWithMessageAPI(showDefaultList()); die(); }
$msg = preg_replace("/[^a-zA-Z0-9\/\,]/", ' ', strtolower($body)); // Replace all invalid characters

if(preg_match("|".$CONFIG['multipleSeparator']."|", $msg)) { $isMultiple = true; }
if(preg_match("/[a-z]/i", $msg) && preg_match("/[0-9]/i", $msg) && $isMultiple == false) {
$isSingle = true;
$isSingle_CookWith = trim(preg_replace("/[0-9]/i", '', $msg));
$msg = preg_replace("/[^0-9]/u", "", $msg);
$msg = trim($msg);
}



//if(!in_array($msg, $allowed_replies)) {
//$result = preg_replace("/[^0-9]/u", " ", $msg);
//$msg = intval(trim($result));
//}

//exit(var_dump($isSingle));

if(is_numeric($msg) && intval($msg) == 0) {  echo replyWithMessageAPI(showDefaultList()); die(); }
$message = $msg;
	switch($message) {
	
	case ($isMultiple == true):
	$list = explode(''.$CONFIG['multipleSeparator'].'', $message);
	$items_added = array();
	$errors = array();
   	
	foreach($list as $product) {
	$product_number = preg_replace("/[^0-9]/u", "", $product);
	if(!checkItem($product_number)) { 
	$errors[] = "Out of stock (".$product_number.")";  
	continue;
	} // we don't inform him to save credits 
		
		
		$product_name_append = preg_replace('/[^\\/\-a-z\s]/i', '', $product);
		$order = array();
		$order['cookWith'] = trim($product_name_append);
		$order['itemCode'] = $product_number;
		$order['phoneNumber'] = $From;
		
		$with = (trim($order['cookWith']) != '') ? " with " . $order['cookWith'] : '';
		placeOrder($order);
		$items_added[] = itemNameById($product_number) . $with;		
		}
		$msg = implode(',',$items_added) . ' added. Text O to see order list or C to checkout!';
		// List Items From Category
		
		
		if(count($errors) > 0) { $msg .= "\n" . implode("\n",$errors);} 
		echo replyWithMessageAPI($msg);	
	break;
	
	case is_numeric($message): // Item Selected
		$order = array();
		if(!checkItem($message)) { echo replyWithMessageAPI("No such item."); die();  } // we don't inform him to save credits 
		$order['itemCode'] = $message;
		$order['phoneNumber'] = $From;

		if($isSingle == true) {   $order['cookWith'] = $isSingle_CookWith; }		
		placeOrder($order);
		$msg = itemNameByID($message) . ' added. Text O to see order list C to checkout!';
		// List Items From Category
		
		$categoryId = substr($message, 1, 1); // Skip first key
		
		echo replyWithMessageAPI($msg);	
	exit();
	
	break;
	case 'o': // Order list
	$msg = '';
	$msg .= "Your order:";
	$total_price = 0;
	$i=1;
$orderList = orderList($From);
if(count($orderList) == 0) { $msg = 'No order yet. Click on the following link to see our menu: '.$CONFIG['site'].'/#menu '; } else {
		foreach(orderList($From) as $order) {
		$total_price += ($order['price'] * $order['quantity']);
		#$note = ($order['description'] != '') ? " - " . $order['description'] : "";
		$with = (trim($order['cookWith']) != '') ? " w/ " . $order['cookWith'] : '';
		$show_x = ($order['quantity'] > 1) ? '(x'. $order['quantity'].')' : '';
$msg .= '
	'.$i.'.' . $order['name']  . $with . ' '.$show_x.' - $'.$order['price'];
	$i++;
		}
	    $msg .= "
	    Total $" . $total_price;
	    $msg .= "
Text c to checkout ";
		}			
		echo replyWithMessageAPI($msg);
	exit();
	break;
	case 'n':
	NextPage($From);
	$page = getPage($From);
	$items = itemsList($page);
	foreach($items as $item) {
	#$note = ($item['description'] != '') ? " - " . $item['description'] : "";
	
	$string .= $item['itemCode'] . ". " . clean($item['name']) . $note . "\n";	
	}
	$string .= "\nTo order, just text item number\n";
	$string .= "H.Help\n";
	$string .= "P.Previous\n";	
	$string .= "M.menu\n";		
	$string .= "C.CheckOut\n";				
	$string .= "S.StartOver";		
	
	echo replyWithMessageAPI($string);
	break;
	case 'p':
	PreviousPage($From);
	$page = getPage($From);
	$items = itemsList($page);
	foreach($items as $item) {
	#$note = ($item['description'] != '') ? " - " . $item['description'] : "";
	
	$string .= $item['itemCode'] . ". " . $item['name'] . $note . "\n";	
	}
	$string .= "\nTo order, just text item number\n";
	$string .= "H.Help\n";
	$string .= "N.Next\n";	
	$string .= "M.menu\n";	
	$string .= "C.CheckOut\n";					
	$string .= "S.StartOver";	
	echo replyWithMessageAPI($string);
	exit();
	break;
	case 'c':
	if(count(orderList($From)) == 0) { $msg = "No order yet. Click on the following link to see our menu: ".$CONFIG['site']."/#menu"; 
	} else {
	$msg = "Touch link to checkout with credit card: " . $CONFIG['site'] . "/checkout.php?id=" . $From . "\n\n";
//	$msg .= "or Touch link to pay at cash register : ".$CONFIG['site'] . "/?so=1&From=" . $From . "\n";	
	$msg .= "\nor\n";
	$msg .= "Text cc to checkout and pay at the cash register";
	}
	echo replyWithMessageAPI($msg);
	exit();
	break;
	case 'cc':
	if(count(orderList($From)) == 0) { $msg = "Your Order is Empty! Reply with blank text for menu.";  }
	else {
		$orderID = orderPaid($From, 1); // 1 - pay by cash ; 0 - pay online with credit card
		clearOrder($From);
	$msg = "Your order confirmation number is #".$orderID;
	}
		echo replyWithMessageAPI($msg);
	exit();
	break;
	case 's':
	clearOrder($From);
	$string = "Orders cleared!\n";
	$string .= "\nTo order, just text item number\n";
	$string .= "H.Help\n";
	$string .= "N.Next\n";	
	$string .= "M.Menu\n";	
	$string .= "C.CheckOut\n";					
	$string .= "S.StartOver"; 
	echo replyWithMessageAPI($string);
	exit();
	break;
	case 'h': //Texting help - how to text order
	$string = "To order, just text the menu item number\n\n";
//	$string .= "text 602-904-6356  menu# \n\n";
//	$string .= "menu#   - menu item number (download menu from davalleygrill.com)\n\n";
//	$string .= "options - c=Coleslaw p=potato salad  -rice -onions .. etc\n\n";
	$string .= "Example: To order menu item 7(Kalua Pork), text 602-904-6356 7\n";
//	$string .= "text 7 c +sriracha  will get you Kalua Pork with coleslaw \n";
	$string .= "To order multiple items, text orders separated by slashes(/)\n";
	$string .= "Example:  To order Kalua Pork,Kalbi and Ninja Bowl,  text 7/10/18\n\n";
	$string .= " For further help call 623-587-4706\n";		
	$string .= "\nN.Next\n";	
	$string .= "M.Menu\n";	
	$string .= "C.CheckOut\n";					
	$string .= "S.StartOver";	
	echo replyWithMessageAPI($string);
	exit();

	// Other definitions for list
	case 'm': // Send PDF menu
	//echo replyWithMessageAPI("Our menu daily updated", $CONFIG['menu_url']);
	echo replyWithMessageAPI("Touch link to view menu ".$CONFIG['menu_url']);
	exit();
	break;
	default: 
	echo replyWithMessageAPI(showDefaultList());
	exit();
	break;
	}
break;
default:
break;
}


?>
