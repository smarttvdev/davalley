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
    <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
 <!--   <script type="text/javascript" src="/js/js/jquery-1.10.2.js"></script> -->
    <script type="text/javascript" src="<?php echo $CONFIG['site'];?>/js/js/jquery-ui-1.10.4.custom.min.js"></script>
 
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
<div class="popup-div clearfix" id="paycash-dialog" style="display:none;">
	<div class="popup-close clearfix">Tender<a href="javascript:void(0)" onclick="paycashCancel();"><img src="<?php echo $CONFIG['site'];?>/pages/cross.png" alt=""></a></div>
	<form>
	<div class="popup-content clearfix">
	
		<label class="popup-label">Tender</label>
		<input name="txtpaycash" id="txtpaycash" type="text" class="popup-input">
		
	</div>
	<div class="popup-bottom">
		<input type="button" id="paycash-cancel" class="popup-cancel" value="Cancel" onclick="paycashCancel();">
		<input type="button" id="paycash-submit" class="popup-submit" value="Submit" onclick="paycashSubmit_new();">
	</div>
	</form>
</div>

<div class="popup-div clearfix" id="finalpaycash-dialog-new" style="display:none;">

	<div class="popup-close clearfix" style="margin:0;">Print - Final Paycash<a href="javascript:void(0)" onclick="finalpaycashCancel();"><img src="pages/cross.png" alt=""></a></div>
	<form>
	<div class="popup-contentfinal clearfix" id="mydiv">
	  
		 
<table border="0" style="width:216px; border:none !important;">
  <tr style="font-weight:bold; color:#000; padding:0;">
    <td colspan="4" align="center" style="font-size:20px;font-family: arial; color:#000; padding:0;">DaValleyGrill</td>
  </tr>
  <tr style="font-weight:bold;font-size:15px; color:#000; padding:0;">
    <td  style="color:#000; padding:0;" colspan="4" align="center">Hawalian Style Asian Food.</td>
  </tr>
   
  <tr style="color:#000; padding:0; font-size:12px;">
    <td  style="color:#000; padding:0;" colspan="4" align="center">2040 W, Dear Valley Road.</td>
  </tr>
  <tr style="color:#000; padding:0; font-size:12px;">
    <td  style="color:#000; padding:0;" colspan="4" align="center">Phoenix, AZ 85032</td>
  </tr>
 
  <tr style="color:#000; padding:0;">
    <td  style="color:#000; font-family: arial; text-align:right; padding:0;font-size: 12px;" colspan="4" align="right">Invoice :#<?php echo GetUniqueID(); ?></td>
  </tr>
 
  <tr style="font-weight:bold;font-family: arial; font-size: 12px; color:#000; padding:0;">
    <td style="color:#000; padding:0;">#</td>
	<td style="color:#000; padding: 0 10px;">Qty</td>
    <td style="color:#000; padding: 0 10px;">Products</td>
    
    <td style="color:#000; padding:0;">Price</td>
  </tr>
  <?php
$i = 1;
$totalPrice = 0;
 
foreach($_SESSION['products'] as $item) {

    if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }

echo '<tr style="color:#000; padding:0; font-size: 10px;">
	<td style="color:#000; padding:0;">'.$i.'.</td>
	<td style="color:#000; padding: 0 10px;">'.$item['quantity'].'</td>	
	<td style="color:#000; padding: 0 10px;">'.$item['itemName'] . $cookWith . '</td>
		
	<td  style="color:#000; padding:0;" align="right">$'.$item['itemPrice'].'</td>	
      </tr>
';
$i++;
$totalPrice += ($item['itemPrice'] * $item['quantity']);
}
$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
$totalPrice += $total_tax;
$totalPrice = round($totalPrice,2);
$total_tax = round($total_tax, 2);
?>

    <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Tax</td>
    <td style="color:#000; padding:0;" align="right">$<?php echo $total_tax; ?></td>
  </tr>
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Total Price</td>
    <td style="color:#000; padding:0;" align="right">$<?php echo number_format($totalPrice,2); ?></td>
  </tr>
  <tr>
	<td style="color:#000; padding:2px 0;" colspan="4">&nbsp;</td>
  </tr>
 
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Tips</td>
    <td style="color:#000; padding:0;" id="finalTips1" align="right"></td>
  </tr>
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Total</td>
    <td style="color:#000; padding:0;" id="finalTotal" align="right"></td>
  </tr>
  <tr>
	<td style="color:#000; padding:2px 0;" colspan="4">&nbsp;</td>
  </tr>
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Tender</td>
    <td style="color:#000; padding:0;" id="finalTender1" align="right"></td>
  </tr>
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 0 10px;" align="left">Change</td>
    <td style="color:#000; padding:0;" id="finalChange1" align="right"></td>
  </tr>
  <tr>
	<td style="color:#000; padding:2px 0;" colspan="4">&nbsp;</td>
  </tr>
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding:0;" align="left">&nbsp;</td>
    <td style="color:#000; padding: 3px 10px;" align="left">Signature</td>
    <td style="color:#000; padding:3px 0;" align="right">____</td>
  </tr>
  
  <tr style="color:#000; padding:0; font-size: 10px;">
    <td style="color:#000; text-align:center; padding:5px 0;" colspan="4">Copyright @ <?php echo Date('Y') ?> by Davallergrill</td>
  </tr>
</table>

 
	</div>
	<div class="popup-bottom">
		<input type="button" id="print-cancel" class="popup-cancel" value="Cancel" onclick="print_cancel();">
		<input type="button" id="print-submit" class="popup-submit button2" value="Print" onclick="PrintElem('#mydiv')">
	</div>
	</form>
</div> 


<div class="popup-div clearfix" id="finalpaycash-dialog" style="display:none;">
	<div class="popup-close clearfix">Final Paycash<a href="javascript:void(0)" onclick="finalpaycashCancel();"><img src="pages/cross.png" alt=""></a></div>
	<form>

	<div class="popup-contentfinal clearfix">
	
		<label class="popup-labelfinal">Tender:</label>
		<label class="popup-labelfinaltxt" id="finalTender"></label>
		<label class="popup-labelfinal">Tips:</label>
		<label class="popup-labelfinaltxt" id="finalTips"></label>
		<label class="popup-labelfinal">Total Price:</label>
		<label class="popup-labelfinaltxt" id="finalTotalPrice"></label>
		<label class="popup-labelfinal">Change:</label>
		<label class="popup-labelfinaltxt" id="finalChange"></label>
		
	</div>
	<div class="popup-bottom">
		<input type="button" id="finalpaycash-cancel" class="popup-cancel" value="Back" onclick="finalpaycashBack();">
		<input type="button" id="finalpaycash-submit" class="popup-submit" value="Confirm" onclick="finalpaycashSubmit();">
	</div>
	</form>
</div>

<div class="popup-div clearfix" id="tips-dialog" style="display:none;">
	<div class="popup-close clearfix">Tips<a href="javascript:void(0)" onclick="tipsCancel();"><img src="pages/cross.png" alt=""></a></div>
	<form>
	<div class="popup-content clearfix">
	
		<label class="popup-label">Tips</label>
		<input name="txttips" id="txttips" type="text" class="popup-input">
		
	</div>
	<div class="popup-bottom">
	<input type="hidden" id="tips-hidden" value="">
		<input type="button" id="tips-cancel" class="popup-cancel" value="Cancel" onclick="tipsCancel();">
		<input type="button" id="tips-submit" class="popup-submit" value="Submit" onclick="tipsSubmit();">
	</div>
	</form>
</div>

<div class="popup-div clearfix" id="confirmPay-dialog" style="display:none;">
	<div class="popup-close clearfix">Thank You!<a href="javascript:void(0)" onclick="confirmPayCancel();"><img src="pages/cross.png" alt=""></a></div>
	<form>
	<div class="popup-content clearfix">
		<p style="text-align:center; color:green;"><strong>Your transaction was successfully! <br />
		Your Order ID is #<?php echo GetUniqueID(); ?></strong> </p>
		
		
	</div>
	<div class="popup-bottom">
		<input type="button" id="tips-cancel" class="popup-cancel" value="OK" onclick="confirmPayCancel();">
	</div>
	</form>
</div>
<input type="hidden" id="ConfirmPayInput" value="0" />
       <table class="table3" width="99%">
            <tr>
                <thead>
                    <th>#</th>
                    <th colspan="3">Product</th>
<!--                    <th>Description</th> -->
                    <th>Qty</th>
                    <th>Price</th>
                </thead>
              
                    </tr><tbody id="closeid1">
<?php
$i = 1;
$totalPrice = 0;
 
foreach($_SESSION['products'] as $item) {

    if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }

echo '<tr>
	<td>'.$i.'.</td>
	<td colspan="3">'.$item['itemName'] . $cookWith . '</td>
	<td>'.$item['quantity'].'</td>		
	<td>$'.$item['itemPrice'].'</td>	
      </tr>
';
$i++;
$totalPrice += ($item['itemPrice'] * $item['quantity']);
}
$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
$totalPrice += $total_tax;
$totalPrice = round($totalPrice,2);
$total_tax = round($total_tax, 2);
echo '<tr><td></td><td></td><td></td><td></td><td><b>Tax:</b></td><td>$'.$total_tax.'</td></tr>';
echo '<tr><td></td><td></td><td></td><td></td><td><b>Total Price:</b></td><td>$'.$totalPrice.'</td></tr>';
echo '<tr id="tipsshowcart" style="display:none;"></tr>';
echo '<tr id="finaltotalshowcart" style="display:none;"></tr>';
echo '<tr id="tendershowcart" style="display:none;"></tr>';
echo '<tr id="changeshowcart" style="display:none;"></tr></tbody>';
echo "<tbody><tr><td><input type='button' id='swipecardbtn' class='button button2' value='Swipe Card'></td>";
if($_SESSION['UserLogin'] == 'TRUE'){
echo "<td><input type='button' id='paycashbtn' class='button button2' value='Pay cash' onclick='mypayCash();'></td><td><input type='button' id='tipsbtn' class='button button2' value='Tips' onclick='mytips();'></td><td><input type='button' id='printbtn' class='button button2' value='Print' onclick='print();'></td>";
}else{
echo "<td></td><td></td><td></td>";
}
echo "<td>"; 

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
echo "</td><td>	<input type='button' class='button button3' id='emptycartbtn' onClick='emptyCart();' value='Empty cart'></td></tr></tbody>"; 
?>
           
        </table>

 <?php
 } else {
 ?>
<h3>Your Cart is empty! <a href="#menu" title="Menu">Check our menu</a></h3>
 <?php } ?> 
 <h3 style="display:none;" id="finalrowid">Your order has been submitted successfully. Cart is empty now</h3>
        <div class="divider"></div>
        
        <a href="#">Back</a>
<script>
function mypayCash()
{
	var ConfirmPayInput = $('#ConfirmPayInput').val();
	if(ConfirmPayInput == 1){
		alert("Order already completed. Plesae collect bill by Print.");
	}else{
		$('#paycash-dialog').show();
	}
}
function paycashCancel()
{
	$('#paycash-dialog').hide();
}
function paycashSubmit_new()
{
	var tipsval = $('#txttips').val(); 
	if(tipsval>0){
		paycashSubmit();
	} else {
		$('#tips-dialog').show();
		$('#tips-hidden').val(1);
	}
	
}
function paycashSubmit()
{
	
	var tenderval = $('#txtpaycash').val();
	var tipsval = $('#txttips').val();
	var totalpricecal = <?php echo $totalPrice;?>;
	if(tipsval>0){
		
		var totalprice = parseFloat(tipsval)+parseFloat(totalpricecal);
	}else{
		var totalprice = <?php echo $totalPrice;?>;
	}
	if(tenderval==''){
		alert("Please Enter Tender value!");
		$('#txtpaycash').focus();
		return false;
	}
	if(tenderval < totalprice){
		alert("Please Enter Tender value greater then Total Price!");
		$('#txtpaycash').focus();
		return false;
	}
	var changevalcal = parseFloat(tenderval)-parseFloat(totalprice);
	var changeval = changevalcal.toFixed(2);
	var tenderval = parseFloat(tenderval).toFixed(2);
	var trTenderval = '<td></td><td></td><td></td><td></td><td><b>Tender:</b></td><td>$'+tenderval+'</td>';
	var trChangeval = '<td></td><td></td><td></td><td></td><td><b>Change:</b></td><td>$'+changeval+'</td>';
	$('#tendershowcart').html(trTenderval);
	$('#changeshowcart').html(trChangeval);
	$('#tendershowcart').show();
	$('#changeshowcart').show();
	$('#paycash-dialog').hide();
	
	$('#finalpaycash-dialog').show();
	
	if(tipsval>0){
		var finaltipsval = tipsval;
	}else{
		var finaltipsval = '0';
	}
	
	$('#finalTender').html('$'+tenderval);
	//$('#finalTender').show();
	
	$('#finalTotalPrice').html('$<?php echo $totalPrice;?>');
	//$('#finalTotalPrice').show();
	$('#finalChange').html('$'+changeval);
	//$('#finalChange').show();
	$('#finalTips').html('$'+finaltipsval);
	//$('#finalTips').show();
}

function print()
{
	
	var tenderval = $('#txtpaycash').val();
	var tipsval = $('#txttips').val();
	var totalpricecal = <?php echo $totalPrice;?>;
	if(tipsval>0){
		
		var totalprice = parseFloat(tipsval)+parseFloat(totalpricecal);
	}else{
		var totalprice = <?php echo $totalPrice;?>;
	}
	var changevalcal = parseFloat(tenderval)-parseFloat(totalprice);
	var changeval = changevalcal.toFixed(2);
	var tenderval = parseFloat(tenderval).toFixed(2);
	var trTenderval = '<td></td><td></td><td></td><td></td><td><b>Tender:</b></td><td>$'+tenderval+'</td>';
	var trChangeval = '<td></td><td></td><td></td><td></td><td><b>Change:</b></td><td>$'+changeval+'</td>';
	$('#tendershowcart').html(trTenderval);
	$('#changeshowcart').html(trChangeval);
	if(tenderval>0)
	{
	//$('#tendershowcart').show();
	//$('#changeshowcart').show();
	}
	$('#paycash-dialog').hide();
	$('#final_desc_show').show();
	
	//$('#finalpaycash-dialog-new').show();

	
	if(tipsval>0){
		var finaltipsval = '$'+parseFloat(tipsval).toFixed(2);
		var totalprice = '$'+parseFloat(totalprice).toFixed(2);
		
	
	}else{
		var finaltipsval = '___';
		var totalprice = '___';
	}
	if(tenderval>0){
	var tenderval = ('$'+tenderval);
	
	} else {
	var tenderval = '___';
	
	}
	if(changeval >0){
	var changeval = ('$'+changeval);
	
	} else if (changeval == 'NaN') {
	var changeval = '___';
	
	}
	
	$('#finalTender1').html(tenderval);
	$('#finalTotalPrice1').html('$<?php echo $totalPrice;?>');
	$('#finalChange1').html(changeval);
	$('#finalTips1').html(finaltipsval);
	$('#finalTotal').html(totalprice);
	

var html = $("#mydiv").html();
var mywindow = window.open('', 'my div', 'width=300');
mywindow.document.write('<html><head><title>my div</title>');
mywindow.document.write('</head><body >');
mywindow.document.write(html);
mywindow.document.write('</body></html>');
mywindow.document.close(); // necessary for IE >= 10
mywindow.focus(); // necessary for IE >= 10
mywindow.print();
mywindow.close();
return true;
	
}

function print_cancel()
{
	$('#finalpaycash-dialog-new').hide();
}

function finalpaycashBack(){
	$('#finalpaycash-dialog').hide();
	$('#paycash-dialog').show();
}
function finalpaycashCancel()
{
	$('#finalpaycash-dialog').hide();
}

function mytips()
{
	var ConfirmPayInput = $('#ConfirmPayInput').val();
	if(ConfirmPayInput == 1){
		alert("Order already completed. Plesae collect bill by Print.");
	}else{
		var tenderval = $('#txtpaycash').val();
		/*if(tenderval == ''){
			alert("Please first click on Pay cash and Enter Tender value!");
			return false;
		}*/
		$('#tips-dialog').show();
	}
}
function tipsCancel()
{
	$('#tips-dialog').hide();
}
function tipsSubmit()
{
	var totalprice = <?php echo $totalPrice;?>;
	var tenderval = $('#txtpaycash').val();
	var tipsval = $('#txttips').val();
	var tipshidden = $('#tips-hidden').val();
	if (tipshidden != 1)
	{
	if(tipsval==''){
		alert("Please Enter Tips value!");
		$('#txttips').focus();
		return false;
	}
	else if(tipsval <= 0){
		alert("Please Enter Tips value greater then 0!");
		$('#txttips').focus();
		return false;
	}
	}
	var tipstotalvalcal = parseFloat(tipsval)+parseFloat(totalprice);
	var tipstotalval = tipstotalvalcal.toFixed(2);
	var changevalcal = parseFloat(tenderval)-parseFloat(tipstotalvalcal);
	var changeval = changevalcal.toFixed(2);
	
	if(tipsval>0){
	var tipsval = parseFloat(tipsval).toFixed(2);
	var tipstotalval = tipstotalval;


	} else {
	var tipsval = '0.00';
	var tipstotalval = <?php echo $totalPrice;?>;
	}
	var tenderval = parseFloat(tenderval).toFixed(2);
	var trTipsval = '<td></td><td></td><td></td><td></td><td><b>Tips:</b></td><td>$'+tipsval+'</td>';
	var trTotalval = '<td></td><td></td><td></td><td></td><td><b>Total:</b></td><td>$'+tipstotalval+'</td>';
	var trTenderval = '<td></td><td></td><td></td><td></td><td><b>Tender:</b></td><td>$'+tenderval+'</td>';
	var trChangeval = '<td></td><td></td><td></td><td></td><td><b>Change:</b></td><td>$'+changeval+'</td>';
	$('#tipsshowcart').html(trTipsval);
	$('#finaltotalshowcart').html(trTotalval);
	$('#tendershowcart').html(trTenderval);
	$('#changeshowcart').html(trChangeval);
	
	$('#tipsshowcart').show();
	$('#finaltotalshowcart').show();
	if (tipshidden == 1)
	{
		paycashSubmit();
	}
	else {
	if(tenderval>=tipstotalval){
		//$('#tendershowcart').show();
		//$('#changeshowcart').show();
	}else{
		$('#tendershowcart').hide();
		$('#changeshowcart').hide();
		//alert('Please Enter Tender Value greater than Total Price!');
	}
	 }
	$('#tips-dialog').hide();
	
}

function finalpaycashSubmit(){
	confirm("Are you confirm to complete Payment?");

	$('#finalpaycash-dialog').hide();
	$.ajax({
			url: "<?php echo $CONFIG['site'];?>/pages/ajax_confirm_hand_payment.php",
			type: "post",
			data: { country: 'helo'},
			success:function(data){
				//alert(data);
				if(data>0){
					$('#ConfirmPayInput').val(1);
					$('#confirmPay-dialog').show();
					
				}
				
			}
		});
}
function confirmPayCancel()
{
	$('#confirmPay-dialog').hide();
	$('#closeid1').hide();
	$('#tipsshowcart').hide();
	$('#finaltotalshowcart').hide();
	$('#tendershowcart').hide();
	$('#changeshowcart').hide();
	$('#swipecardbtn').hide();
	$('#checkoutbtn').hide();
	$('#emptycartbtn').hide();
	$('#finalrowid').show();
	$.ajax({
			url: "<?php echo $CONFIG['site'];?>/pages/ajax_empty_my_cart.php",
			type: "post",
			data: { country: 'helo'},
			success:function(data){
				//alert(data);
				if(data==1){
					$('#addedtocart').html(0);
					
				}
				
			}
		});
	
}
</script>

<style>
.clear {
	clear:both;
	line-height:0;
	font-size:0;
}
.clearfix {
	clear:both;
}

/* Clearfix */
.clearfix:before,
.clearfix:after {
    content: " ";
    display: table;
}
.clearfix:after {
    clear: both;
}
.clearfix {
    *zoom: 1;
}

*::-moz-selection {
    background:#000;
    color: #fff00f;
}

div.popup-div {
	margin:50px auto 0;
	padding:5px;
	width:300px;
	background:#fff;
	border:1px solid #777;
	border-radius:5px;
	position:absolute;
	left:25%;
	z-index:50;
}
div.popup-close {
	margin:0 0 20px;
	padding:6px;
	background:#aaa;
	border-radius:5px;
	text-align:center;
	font-size:15px;
	font-weight:bold;
	color:#fff;
}
div.popup-close a{
	margin:0;
	padding:0;
	background:url(cross.png) no-repeat;
	float:right;
	border-radius:5px;
}
div.popup-content {
	margin:0 0 15px;
	padding:30px 0;
	border-bottom:1px solid #aaa;
}
div.popup-contentfinal {
	margin:0 0 15px;
	padding:15px 0;
	border-bottom:1px solid #aaa;
}
.popup-label {
	margin:0;
	padding:0;
	float:left;
	height:30px;
	width:100px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-labelfinal {
	margin: 0 0 0 20px;
	padding:0;
	float:left;
	height:30px;
	width:100px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-labelfinaltxt {
	margin:0;
	padding:0;
	float:left;
	height:30px;
	width:120px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-input {
	margin:0;
	padding:0 5px;
	float:right;
	width:180px;
	background:none;
	border:1px solid #aaa;
	height:30px;
	border-radius:5px;
}
.popup-bottom {
	float:right;
	width:200px;
	margin:0 0 8px;
	padding:0;
}
.popup-cancel {
	float:left;
	width:95px;
	margin:0;
	padding:0;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:center;
	cursor:pointer;
	border:1px solid #aaa;
	border-radius:5px;
}
.popup-submit {
	float:right;
	width:95px;
	margin:0;
	padding:0;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:center;
	cursor:pointer;
	border-radius:5px;
	border:1px solid #aaa;
}
</style>
