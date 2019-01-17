<?php
require_once("SMS_Module/twilio/Services/Twilio.php");
require_once("SMS_Module/classes/mysqli.php");
require_once("SMS_Module/classes/sql.class.php");
require_once("SMS_Module/classes/config.php");


$id = $_GET['id'];
if(empty($id)) { die('Invalid id'); }

$orderList = orderList($id);

echo <<<HTML
<table border="1">
<tr><td>No.</td><td>Name</td><td>Description</td><td>Qty</td><td>Price</td></tr>
HTML;
$i=1;
$totalprice=0;
foreach($orderList as $order) {
echo '<tr><td>'.$i.'.</td><td>'.$order['name'].'</td><td>'.$order['description'].'</td><td>'.$order['quantity'].'</td><td>$'.$order['price'].'</td></tr>';
$i++;
$totalprice += ($order['price'] * $order['quantity']);
}
$total_tax = $totalprice * $CONFIG['state_tax'] / 100;
$totalprice += $total_tax;
$totalprice = round($totalprice,2);
$total_tax = round($total_tax, 2);
echo '<tr><td></td><td></td><td></td><td><b>Tax:</b></td><td>$'.$total_tax.'</td></tr>';
echo '<tr><td></td><td></td><td></td><td><b>Total Price:</b></td><td>$'.$totalprice.'</td></tr>';
echo <<<HTML
</table>

HTML;

switch($_GET['t']) {
  
default:
include_once("authorize.net/AuthorizeNet.php");
 

// Get Transaction Details
$url			= $CONFIG['AUTHORIZENET_SANDBOX'] ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL;

// If an amount or description were posted to this page, the defaults are overidden
$loginID		= $CONFIG['loginID'];
$transactionKey 	= $CONFIG['transactionKey'];
$amount 		= $totalprice;
$description 		= "Transaction Order for " . $CONFIG['company'];
$label 			= "FINISH ORDER"; // The is the label on the 'submit' button
$testMode		= "false";


//$invoice	= date(YmdHis);
$invoice = GetUniqueID();

 
    
    

	$time = time();
        $fp_sequence = $time;

if( phpversion() >= '5.1.2' )
	{ $fingerprint = hash_hmac("md5", $loginID . "^" . $fp_sequence . "^" . $time . "^" . $amount . "^", $transactionKey); }
else 
	{ $fingerprint = bin2hex(mhash($CONFIG['AUTHORIZE_MD5_HASH'], $loginID . "^" . $fp_sequence . "^" . $time . "^" . $amount . "^", $transactionKey)); }
echo "
<form method='post' action='".$url."' >
 
	<input type='hidden' name='x_login' value='".$loginID."' />
	<input type='hidden' name='x_amount' value='".$amount."' />
	<input type='hidden' name='x_description' value='". $description."' />
	<input type='hidden' name='x_invoice_num' value='". $invoice."' />
	<input type='hidden' name='x_fp_sequence' value='". $fp_sequence."' />
	<input type='hidden' name='x_fp_timestamp' value='". $time."' />
	<input type='hidden' name='x_fp_hash' value='". $fingerprint."' />
	<input type='hidden' name='x_test_request' value='".$testMode."' />
	<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
	<input type='hidden' name='x_relay_response' value='true' />
	<input type='hidden' name='x_relay_url' value='".$CONFIG['x_relay_url']."' />
	<input type='hidden' name='x_cust_id' value='".$id."' />
	<INPUT TYPE='hidden' name='x_version' VALUE='3.1'>

		
";
$i=1;
foreach($orderList as $order) {
echo "<INPUT TYPE='HIDDEN' name='x_line_item' VALUE='".$i."<|>".substr(clean($order['name']),0,30)."<|>".substr(clean($order['description']),0,30)."<|>".$order['quantity']."<|>".$order['price']."<|>Y'>\n";
//echo '<tr><td>'.$i.'.</td><td>'.$order['name'].'</td><td>'.$order['description'].'</td><td>'.$order['quantity'].'</td><td>$'.$order['price'].'</td></tr>';
$i++;
}
echo "	 
	<INPUT TYPE='HIDDEN' name='x_tax' VALUE='Tax<|>state tax<|>".$total_tax."'>
	<input type='submit' value='".$label."' />
</form>
";
break;



}

?>