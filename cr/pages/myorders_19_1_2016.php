<?php
session_start();

// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
// My Orders

require_once("../SMS_Module/classes/paginare.class.php");
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");
require_once("../authorize.net/AuthorizeNet.php");

  

?>
        <h2>Shopping Cart List</h2>
<?php
if(isset($_SESSION['products']) && is_array($_SESSION['products'])) {
?>
    <link rel="stylesheet" href="/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
 <!--   <script type="text/javascript" src="/js/js/jquery-1.10.2.js"></script> -->
    <script type="text/javascript" src="/js/js/jquery-ui-1.10.4.custom.min.js"></script>
 
 <script type="text/javascript">
        function processSwipe(value) {
            var parsedSwipe = parseSwipe(value);
            if (parsedSwipe.CreditCardNumber) {
                $("#x_card_num").val(parsedSwipe.CreditCardNumber);
                $("#x_exp_date").val("");
                $("#x_first_name").val("");
                $("#x_last_name").val("");
            }
            if (parsedSwipe.ExpirationDate) {
                $("#x_exp_date").val(parsedSwipe.ExpirationDate);
            }
            if (parsedSwipe.FirstName) {
                $("#x_first_name").val(parsedSwipe.FirstName);
            }
            if (parsedSwipe.LastName) {
                $("#x_last_name").val(parsedSwipe.LastName);
            }
            $("#swipe-dialog").dialog("close");
            $("body").unbind("click");
        }

        function parseSwipe(swipe) {
            var swipeData = {};
            if (swipe.indexOf('^') > -1) {
                var cardData = swipe.split('^');
                swipeData.CreditCardNumber = $.trim(cardData[0].replace(/[^0-9]/g, ''));
                if (swipe.length > 1)
                    var _fullName = $.trim(cardData[1].split('/'));
                    var fullName = _fullName.split(',');
                    
                    swipeData.FirstName = $.trim(fullName[1]);
                    swipeData.LastName = $.trim(fullName[0]);
                if (swipe.length > 2)
                    swipeData.ExpirationDate = $.trim(cardData[2].substring(2, 4) + cardData[2].substring(0, 2)); // format: mmyy
            }
            else if (swipe.indexOf('=') > -1) {
                var cardData = swipe.split('=');
                swipeData.CreditCardNumber = $.trim(cardData[0].replace(/[^0-9]/g, ''));
                if (swipe.length > 1)
                    swipeData.ExpirationDate = $.trim(cardData[1].substring(2, 4) + cardData[1].substring(0, 2)); // format: mmyy
            }
            return swipeData;
        }

        $(function() {
            $("#swipe-dialog").dialog({
                autoOpen: false,
                height: 200,
                width: 280,
                modal: true,
                open: function(event, ui) {
                    $("#txtSwipe").val('');
                    $("#txtSwipe").focus();
                    $("#txtSwipe").keypress(function() {
                        if ($(this).val().length == 78) {
                            processSwipe($(this).val());
                            $("#checkOutSubmit").submit();
                        }
                    });
                    $("body").click(function() {
                        $('#txtSwipe').focus();
                    });
                },
                buttons: {
                    Cancel: function() {
                        $(this).dialog("close");
                        $("body").unbind("click");
                    },
                Test: function() {
                    	processSwipe("%B6543210000000000^DOE/JOHN                  ^0000000000000000000ABC123456789?");                    	
                    	$("#checkOutSubmit").submit();
                    }
                }
            });

            $("#swipecardbtn").click(function() {
                $("#swipe-dialog").dialog("open");
            });
        });
    </script>
<div id="swipe-dialog" style="display:none;">
    <input id="txtSwipe" type="text" style="position: absolute; top: -1000px;" />
    <div style="padding: 10px 0 0 10px;">
        Please swipe your credit card...
    </div>
</div>
       <table class="table3" width="99%">
            <tr>
                <thead>
                    <th>#</th>
                    <th>Product</th>
<!--                    <th>Description</th> -->
                    <th>Qty</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    </tbody></tr>
<?php
$i = 1;
$totalPrice = 0;
 
foreach($_SESSION['products'] as $item) {

    if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }

echo '<tr>
	<td>'.$i.'.</td>
	<td>'.$item['itemName'] . $cookWith . '</td>
	<td>'.$item['quantity'].'</td>		
	<td>'.$item['itemPrice'].'</td>	
      </tr>
';
$i++;
$totalPrice += ($item['itemPrice'] * $item['quantity']);
}
$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
$totalPrice += $total_tax;
$totalPrice = round($totalPrice,2);
$total_tax = round($total_tax, 2);
echo '<tr><td></td><td></td><td><b>Tax:</b></td><td>$'.$total_tax.'</td></tr>';
echo '<tr><td></td><td></td><td><b>Total Price:</b></td><td>$'.$totalPrice.'</td></tr>';

echo "<tr><td></td><td><input type='button' id='swipecardbtn' class='button button2' value='Swipe Card'></td><td>"; 

$url			= $CONFIG['AUTHORIZENET_SANDBOX'] ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL;
$loginID		= $CONFIG['loginID'];
$transactionKey 	= $CONFIG['transactionKey'];
$amount 		= $totalPrice;
$description 		= "Transaction Order for " . $CONFIG['company'];
$label 			= "Checkout"; // The is the label on the 'submit' button
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
<form id='checkOutSubmit' method='post' action='".$url."' >
 
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
	<input type='hidden' name='x_cust_id' id='x_cust_id' value='".$_SESSION['phoneNumber']."' />
	<INPUT TYPE='hidden' name='x_version' VALUE='3.1'>
	<!-- Swipe Details -->
	<INPUT TYPE='hidden' name='x_first_name' id='x_first_name' VALUE=''>
	<INPUT TYPE='hidden' name='x_last_name' id='x_last_name' VALUE=''>
	<INPUT TYPE='hidden' name='x_card_num' id='x_card_num' VALUE=''>
	<INPUT TYPE='hidden' name='x_exp_date' id='x_exp_date' VALUE=''>
	<INPUT TYPE='hidden' name='x_card_code' id='x_card_code' VALUE=''>
	
		
";
$i=1;
foreach($_SESSION['products'] as $order) {
echo "<INPUT TYPE='HIDDEN' name='x_line_item' VALUE='".$i."<|>".substr(clean($order['itemName']),0,30)."<|>".substr(clean($order['itemDescription']),0,30)."<|>".$order['quantity']."<|>".$order['itemPrice']."<|>Y'>\n";
//echo '<tr><td>'.$i.'.</td><td>'.$order['name'].'</td><td>'.$order['description'].'</td><td>'.$order['quantity'].'</td><td>$'.$order['price'].'</td></tr>';
$i++;
}
echo "	 
	<INPUT TYPE='HIDDEN' name='x_tax' VALUE='Tax<|>state tax<|>".$total_tax."'>
	<input type='button' id='checkoutbtn' class='button button2' value='".$label."'>
</form>
";
echo "</td><td>	<input type='button' class='button button3' onClick='emptyCart();' value='Empty cart'></td></tr>"; 
?>
           
        </table>

 <?php
 } else {
 ?>
<h3>Your Cart is empty! <a href="#menu" title="Menu">Check our menu</a></h3>
 <?php } ?> 
        <div class="divider"></div>
        
        <a href="#">Back</a>
        
    
