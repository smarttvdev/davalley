<?php
include("include/head.php");
require_once("authorize.net/AuthorizeNet.php");
$get_payment_info = $obj->get_payment_info($_SESSION['order_id']);
$get_order_info = $obj->get_current_order_detail();
$CONFIG['AUTHORIZENET_SANDBOX'] = TRUE;
$CONFIG['loginID'] = '5bJRn256f6'; // login
$CONFIG['transactionKey'] = '38926Zz4srr28ZTh'; // transactionKey
// END AUTHORIZE.NET CONFIG //
$CONFIG['site'] = base_url();
$CONFIG['image_location'] = "/images/products";
$CONFIG['company'] = "Da ValleyGrill";
$CONFIG['company_slogan'] = "Hawaiian style Asian Fusion ... Mon-Fri 9am-7:30pm  Sat 9-3pm";
$CONFIG['pageRows'] = 10;
$CONFIG['x_relay_url'] = $CONFIG['site'] . 'card_payment_info.php';
$CONFIG['AUTHORIZE_MD5_HASH'] = '16931504cd2a6403e8a7f9d951e04e98';
$CONFIG['state_tax'] = "8.6%";
$CONFIG['menu_url'] = $CONFIG['site'] . "/images/menu.png";


$url			= $CONFIG['AUTHORIZENET_SANDBOX'] ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL;
$loginID		= $CONFIG['loginID'];
$transactionKey 	= $CONFIG['transactionKey'];


/*$amount 		= $obj->get_order_total_amount()-$get_payment_info['tendered_amt'];*/
echo $amount         = $_REQUEST['cart_manual_amount'];


$description 		= "Transaction Order for " . $CONFIG['company'];
$label 			= "Checkout"; // The is the label on the 'submit' button
$testMode		= "false"; // authorize.net test mode
//$invoice	= date(YmdHis);
$invoice = $_SESSION['order_id'];
$time = time();
$fp_sequence = $time;
if( phpversion() >= '5.1.2' )
	$fingerprint = hash_hmac("md5", $loginID . "^" . $fp_sequence . "^" . $time . "^" . $amount . "^", $transactionKey); 
else 
	$fingerprint = bin2hex(mhash($CONFIG['AUTHORIZE_MD5_HASH'], $loginID . "^" . $fp_sequence . "^" . $time . "^" . $amount . "^", $transactionKey));

?>
					

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
                        //alert();
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



function cancel_btn(){
	window.location.href = "<?php echo base_url(); ?>payment.php";
}

function cheh() {
                    	processSwipe("%B6543210000000000^DOE/JOHN                  ^0000000000000000000ABC123456789?");                    	
                    	$("#checkOutSubmit").submit();
                    }
			$(document).ready(function() {

                $("#txtSwipe").val('');
                    $("#txtSwipe").focus();
                    $("#txtSwipe").keypress(function() {
                        alert();
                        if ($(this).val().length == 78) {
                            processSwipe($(this).val());
                            $("#checkOutSubmit").submit();
                        }
                    });
                    $("body").click(function() {
                        $('#txtSwipe').focus();
                    });
            });
    </script>
<div id="swipe-dialog" style="    width: 50%;
    margin: 0 auto;
    text-align: center;
    position: absolute;
    top: 25%;
    left: 25%;">
    <input id="txtSwipe" type="text" style="position: absolute; top: -1000px;"  />
    <div style="padding: 10px 0 0 10px;">
        Please swipe your credit card...
    </div>
    <input type="button" value="Cancel" onclick="cancel_btn()"> <input type="button" value="Test" onclick="cheh()"> 
</div>

					<form id='checkOutSubmit' method='post' action='<?php echo $url; ?>' style="display:none" >				   
						<input type='hidden' name='x_login' value='<?php echo $loginID; ?>' />
                        <input type='hidden' name='x_duplicate_window' value='120' />
						<input type='hidden' name='x_amount' value='<?php echo $amount;  //echo $_GET['cart_manual_amount']; ?>' />
						<input type='hidden' name='x_description' value='<?php echo $description; ?>' />
						<input type='hidden' name='x_invoice_num' value='<?php echo $invoice; ?>' />
						<input type='hidden' name='x_fp_sequence' value='<?php echo $fp_sequence; ?>' />
						<input type='hidden' name='x_fp_timestamp' value='<?php echo $time; ?>' />
						<input type='hidden' name='x_fp_hash' value='<?php echo $fingerprint; ?>' />
						<input type='hidden' name='x_test_request' value='<?php echo $testMode; ?>' />
						<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
						<input type='hidden' name='x_receipt_link_method' id='x_receipt_link_method' value='post' />
						<input type="hidden" name="x_receipt_link_url" value="<?php echo $CONFIG['x_relay_url']; ?>" >
						<input type='hidden' name='x_relay_response' value='true' />
						<input type='hidden' name='x_relay_url' value="<?php echo $CONFIG['x_relay_url']; ?>"/>
						<input type='hidden' name='x_cust_id' id='x_cust_id' value='<?php echo $get_order_info['ticket_id']; ?>' />  

						<INPUT TYPE='hidden' name='x_version' VALUE='3.1' />
						<!-- Swipe Details -->
						<INPUT TYPE='hidden' name='x_first_name' id='x_first_name' VALUE='' />
						<INPUT TYPE='hidden' name='x_last_name' id='x_last_name' VALUE='' />
						<INPUT TYPE='hidden' name='x_card_num' id='x_card_num' VALUE='' />
						<INPUT TYPE='hidden' name='x_exp_date' id='x_exp_date' VALUE='' />
						<INPUT TYPE='hidden' name='x_card_code' id='x_card_code' VALUE='' />

<?php
$i=1;
$get_order_items = $obj->get_order_item_list_checkout($_SESSION['order_id']);
foreach($get_order_items as $order){
	echo "<INPUT TYPE='HIDDEN' name='x_line_item' VALUE='".$i."<|>".substr(($order['itemName']),0,30)."<|>".substr(($order['itemDescription']),0,30)."<|>".$order['quantity']."<|>".$order['itemPrice']."<|>Y'>\n";
	if($order['item_discount_amount']>0){
	echo "<INPUT TYPE='HIDDEN' name='x_line_item' VALUE='".$i."<|>".substr(($order['item_discount_percent']),0,30)."% Discount<|><|>".$order['quantity']."<|>".$order['item_discount_amount']."<|>Y'>\n";
	}
	$i++;
}
?>
						<INPUT TYPE='HIDDEN' name='x_tax' VALUE='Tax<|>state tax<|><?php echo $obj->get_tax_amount(); ?>'>
						<INPUT TYPE='HIDDEN' name='x_duty' VALUE='Tip<|>     Tip<|><?php echo $get_payment_info['tip_amt']; ?>'>
						<input type='submit' id='checkoutbtn' class='button button2' value='<?php echo $label; ?>'>
	
					</form>
<?php
include("include/footer.php");
?>