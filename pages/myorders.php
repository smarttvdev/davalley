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

<link rel="stylesheet" href="/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="/js/js/jquery-ui-1.10.4.custom.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<h2>Shopping Cart List</h2>
<?php
if (isset($_SESSION['tableSelected']) && $_SESSION['tableSelected'] == false){
    $_SESSION['products'] = array();
    unset($_SESSION['tableSelected']);
    $_SESSION['flag_uniqueINV'] = false;
}
if(isset($_SESSION['products']) && is_array($_SESSION['products'])) {
    ?>
    <script type="text/javascript">
        var barcode='';
        var swipe_state=0;
        function download(filename, url) {
            var element = document.createElement("a");
            element.setAttribute("href", url);
            element.setAttribute("download", filename);
            element.style.display = "block";
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);}

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
            // $("#checkoutbtn").click();
            $( "#checkOutSubmit" ).submit();
        }
        //%B4100400023962734^TANG/ERIC Y             ^191220121801111884970357446000000?
        //5b41004000239627346tang/eric y             6191220121801111884970357446000000/
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

        document.onkeyup = function(d) {
            if (swipe_state==1){
                // if(d.key!="Shift"){
                    var charcode=d.key;
                    barcode=barcode+charcode.replace('Shift','');
                    console.log(barcode);
                    $("#txtSwipe").val(barcode);
                    console.log(barcode);
                    if (barcode.length==78){
                        alert(barcode);
                        swipe_state=0;
                        processSwipe(barcode);
                        $("#checkOutSubmit").submit();
                    }
                // }

            }
        };


        $(function() {
            $("#swipe-dialog").dialog({
                autoOpen: false,
                height: 200,
                width: 280,
                modal: true,
                open: function(event, ui) {
                    barcode='';
                    swipe_state=1;
                    console.log(barcode);

                },
                buttons: {
                    Cancel: function() {
                        $(this).dialog("close");
                    },
                    Test: function() {
//					processSwipe("%B6543210000000000^DOE/JOHN                  ^0000000000000000000ABC123456789?");
//					$("#checkOutSubmit").submit();
                    }
                }
            });
        });


        $(function() {
//             $("#swipe-dialog").dialog({
//                 autoOpen: false,
//                 height: 200,
//                 width: 280,
//                 modal: true,
//                 open: function(event, ui) {
//                     $("#txtSwipe").val('');
//                     $("#txtSwipe").focus();
//
//                     $("#txtSwipe").on('keypress',function() {
//                         console.log($(this).val())
//                         if ($(this).val().length == 78) {
//                             $(this).blur();
//                             // processSwipe($(this).val());
//                             // $("#checkOutSubmit").submit();
//                         }
//                     });
//
//                     $("body").click(function() {
//                         $('#txtSwipe').focus();
//                     });
//                 },
//                 buttons: {
//                     Cancel: function() {
//                         $(this).dialog("close");
//                         $("body").unbind("click");
//                     },
//                     Test: function() {
// //					processSwipe("%B6543210000000000^DOE/JOHN                  ^0000000000000000000ABC123456789?");
// //					$("#checkOutSubmit").submit();
//                     }
//                 }
//             });

            $("#swipecardbtn").click(function() {
                $.getJSON( API + "?action=checkPhone", function( data ) {
                    if(data.success) {
                        var phone_filtered = data.success.phone;
                        $('input[name=x_cust_id]').val(phone_filtered);
                    }
                    else {
                        var phone = prompt("Enter contact phone number :\ni.e. 1 234 567 8901");
                        if(phone==null || phone==''){
                            phone='9999';
                        }
                        if(phone!=null && phone!='') {
                            var phone_filtered = phone.replace(' ','');
                            phone_filtered = phone_filtered.replace('+','');
                            $.getJSON( API + "?action=setPhone&phone=" + phone, function( data ) {
                                if(data.error) {
                                    alert('Please write a valid phone number');
                                } else {
                                    $('input[name=x_cust_id]').val(phone_filtered);

                                }
                            });
                        }
                    }
                    $("#swipe-dialog").dialog("open");
                });

            });
        });

    </script>
    <div id="swipe-dialog" style="display:none;">
        <input id="txtSwipe" type="text" style="position: absolute; top: -1000px;" readonly/>
<!--        <input id="txtSwipe" type="text" style="position: absolute; top: -1000px;"/>-->
        <div style="padding: 10px 0 0 10px;">
            Please swipe your credit card...
        </div>
    </div>

    <table class="table3" width="99%">
        <tr>
            <thead>
            <th>#</th>
            <th>Product</th>
            <!--<th>Description</th> -->
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Price</th>
            </thead>
            <tbody>
            </tbody>
        </tr>
        <?php
        $i = 1;
        $totalPrice = 0;

        foreach($_SESSION['products'] as $item) {
            if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item['itemName'] . $cookWith ?></td>
                <td>
                    <a href="#" data-id="<?php echo trim($item['itemCode']); ?>" class="updateCartQtyMinus"><img src="images/icn_minus.png"></a>
                    <?php echo $item['quantity'];?>
                    <a href="#" data-id="<?php echo trim($item['itemCode']);?>" class="updateCartQtyPlus"><img src="images/icn_plus.png"></a>
                </td>
                <td>$<?php echo $item['itemPrice']; ?></td>
                <td>$<?php echo $item['itemPrice']*$item['quantity']; ?></td>
            </tr>

            <?php
            $i++;
            $totalPrice += ($item['itemPrice'] * $item['quantity']);
        }
        $total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
        $totalPrice += $total_tax;
        $totalPrice = round($totalPrice,2);
        $total_tax = round($total_tax, 2);

        if(!isset($_SESSION["tipType"]))
        {
            $_SESSION["tipType"] = "none";
            $_SESSION["tipValue"] = "0";
        }

        ?>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><b>Tax:</b></td>
            <td>$<?php echo $total_tax; ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">
                <input type="button" name="btnUpdateTip" id="btnUpdateTip" value="Tip"/>
            </td>
            <td>
                <?php
                $tipAmount = 0;
                if($_SESSION["tipType"] == "percentage") {
                    $tipValue = $_SESSION["tipValue"];
                    echo '$'.$tipAmount = number_format($tipAmount = ( ($totalPrice*$tipValue)/100 ), 2);

                    $totalPrice += $tipAmount;
                } else if($_SESSION["tipType"] == "none") {
                    $tipValue = $_SESSION["tipValue"];
                    echo '$'.$tipAmount = number_format($tipAmount,2);
                    $totalPrice += $tipAmount;
                } else {
                    $tipValue = $_SESSION["tipValue"];
                    echo '$'.$tipAmount = (number_format($tipValue,2));
                    $totalPrice += $tipValue;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2" ><b>Total Price:</b></td>
            <td>$<?php echo $totalPrice; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>

                <input type='button' id='swipecardbtn' class='button button2' value='Swipe Card'>
                <input type='button' id='printbtn' class='button button2' value='Print'>

                <script type="text/javascript">
                    $('#printbtn').click(function(){
                        $.ajax({
                            type: "get",
                            url: "pages/print.php",
                            success:function(msg){
                                console.log(msg);
                                msg1=JSON.parse(msg);
                                download("receipt1.txt","https://davalleygrill.com/tmp/"+msg1['textfile']+'.txt');
                                window.location.href=("pages/print_pdf.php");
                            }
                        });
                    });
                </script>
                <?php

                if(isset($_SESSION['UserLogin']) && $_SESSION['UserLogin'] == 'TRUE'):
                    ?>
                    <button type='button' class='button button2' data-toggle="modal" data-target="#paycashmodal">Pay cash</button>
                <?php
                endif;
                ?>
            </td>
            <td>
                <?php
                $url			= $CONFIG['AUTHORIZENET_SANDBOX'] ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL;

                $loginID		= $CONFIG['loginID'];
                $transactionKey = $CONFIG['transactionKey'];

                $signature_key=$CONFIG['signature_key'];
                $amount 		= $totalPrice;
                $textToHash="^". $loginID."^". $transactionKey ."^". $amount."^";
                $description 	= "Transaction Order for " . $CONFIG['company'];
                $label 			= "Place Order"; // The is the label on the 'submit' button
                $testMode		= "true"; // authorize.net test mode
                $invoice = GetUniqueID();
                $_SESSION['orderID'] = $invoice ;
                $time = time();
                $fp_sequence = $time;
                $fingerprint = AuthorizeNetSIM_Form::getFingerprint($loginID, $transactionKey, $amount, $fp_sequence, $time);
                ?>

                <form id='checkOutSubmit' method='post' action='<?php echo $url; ?>' >
                    <input type='hidden' name='x_login'  value='<?php echo $loginID; ?>' readonly/>
                    <input type='hidden' name='x_amount'  value='<?php echo $amount; ?>' readonly/>
                    <input type='hidden' name='x_description'  value='<?php echo $description; ?>' readonly/>
                    <input type='hidden' name='x_invoice_num'  value='<?php echo $invoice; ?>' readonly/>
                    <input type='hidden' name='x_fp_sequence'  value='<?php echo $fp_sequence; ?>' readonly/>
                    <input type='hidden' name='x_fp_timestamp'  value='<?php echo $time; ?>' readonly/>
                    <input type='hidden' name='x_fp_hash'  value='<?php echo $fingerprint; ?>' readonly/>
                    <input type='hidden' name='x_test_request'  value='<?php echo$testMode; ?>' readonly/>
                    <input type='hidden' name='x_show_form'  value='PAYMENT_FORM' readonly/>
                    <input type='hidden' name='x_relay_response'  value='TRUE' readonly/>
                    <input type='hidden' name='x_relay_url'  value='<?php echo $CONFIG['x_relay_url']; ?>' readonly/>
                    <input type='hidden' name='x_cust_id' id='x_cust_id'  value='<?php echo $_SESSION['phoneNumber']; ?>' readonly/>
                    <INPUT TYPE='hidden' name='x_version' VALUE='3.1'  readonly/>
                    <!-- Swipe Details -->
                    <INPUT TYPE='hidden' name='x_first_name' id='x_first_name'  VALUE=''  readonly/>
                    <INPUT TYPE='hidden' name='x_last_name' id='x_last_name'  VALUE='' readonly />
                    <INPUT TYPE='hidden' name='x_card_num' id='x_card_num'  VALUE='' readonly/>
                    <INPUT TYPE='hidden' name='x_exp_date' id='x_exp_date'  VALUE='' readonly/>
                    <INPUT TYPE='hidden' name='x_card_code' id='x_card_code'  VALUE='' readonly/>

                    <?php
                    $i=1;
                    foreach($_SESSION['products'] as $order):
                        echo "<INPUT TYPE='HIDDEN'  readonly name='x_line_item' VALUE='".$i."<|>".substr(clean($order['itemName']),0,30)."<|>".substr(clean($order['itemDescription']),0,30)."<|>".$order['quantity']."<|>".$order['itemPrice']."<|>Y'>\n";
                        //echo '<tr><td>'.$i.'.</td><td>'.$order['name'].'</td><td>'.$order['description'].'</td><td>'.$order['quantity'].'</td><td>$'.$order['price'].'</td></tr>';
                        $i++;
                    endforeach;
                    ?>
                    <INPUT TYPE='HIDDEN' readonly name='x_tax' VALUE='Tax<|>state tax<|><?php echo $total_tax; ?>'>
                    <INPUT TYPE='HIDDEN' readonly name='x_duty' VALUE='Tip<|>     Tip<|><?php echo $tipAmount; ?>'>
                    <input type='button' readonly id='checkoutbtn' class='button button2' value='<?php echo $label; ?>'>

                </form>
            </td>
            <td><input type='button' class='button button3' onClick='emptyCart();' value='Empty cart'></td>
        </tr>
    </table>

    <?php
} else {
    ?>
    <h3>Your Cart is empty! <a href="#menu" title="Menu">Check our menu</a></h3>
<?php } ?>
<div class="divider"></div>

<a href="#">Back</a>

<div id="tips-dialog" style="display:none;">
    <input type="radio" name="rdTip" id="rdTip" value="-1" <?php if($_SESSION["tipType"] == "none" && $_SESSION["tipValue"] == "-1") { echo "checked"; } ?>> No Tip
    <input type="radio" name="rdTip" id="rdTip" value="10" <?php if($_SESSION["tipType"] == "percentage" && $_SESSION["tipValue"] == "10") { echo "checked"; } ?>> 10%
    <input type="radio" name="rdTip" id="rdTip" value="15" <?php if($_SESSION["tipType"] == "percentage" && $_SESSION["tipValue"] == "15") { echo "checked"; } ?>> 15%
    <input type="radio" name="rdTip" id="rdTip" value="0" <?php if($_SESSION["tipType"] == "amount" ) { echo "checked"; } ?>> Amount
    <input type="text" name="txtTipAmount" id="txtTipAmount" value="<?php if($_SESSION["tipType"] == "amount" ) { echo $_SESSION["tipValue"]; } ?>">
</div>
<?php if(isset($totalPrice)): ?>
    <!-- Pay Cash Modal -->
    <div class="modal fade bs-example-modal-md" id="paycashmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form id="myForm" data-toggle="validator" role="form" method='post' action='<?php echo $CONFIG['x_relay_url']; ?>'>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Cash</h4>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="pm" value="cash" />
                        <input type='hidden' name='xx_amount' value='<?php echo $amount; ?>' />
                        <?php
                        $i=1;
                        foreach($_SESSION['products'] as $order):
                            echo "<INPUT TYPE='HIDDEN' name='xx_itemcode[]' VALUE='".$order['itemCode']."' />";
                            echo "<INPUT TYPE='HIDDEN' name='xx_cookWith[]' VALUE='".$order['cookWith']."' />";
                            echo "<INPUT TYPE='HIDDEN' name='xx_sideOrder[]' VALUE='".implode(',',$order['sideOrder'])."' />";
                            echo "<INPUT TYPE='HIDDEN' name='xx_quantity[]' VALUE='".$order['quantity']."' />";
                            $i++;
                        endforeach;
                        ?>
                        <div class="form-group has-feedback">
                            <label for="tender">Tender</label>
                            <table class="table table-sm">
                                <tr>
                                    <td>Cash :</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" pattern="[0-9]{1,5}\.[0-9]{2}$|[0-9]{1,5}$" class="form-control" id="cashval" data-error="The value must Be with two decmial" placeholder="0.00" />
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tip:</td>
                                    <td>
                                        <div class="input-group">
                                            <div id="tip" data-tip="<?php echo $tipAmoun; ?>"></div>
                                            $ <?php echo $tipAmount; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>total price:</td>
                                    <td>
                                        <div class="input-group">
                                            <div id="total-price" data-tp="<?php echo $totalPrice; ?>"></div>
                                            $ <?php echo $totalPrice; ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Net:</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" id="final-tp" placeholder="" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="button button2" id="comfirm" >Comfirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif;?>

<script type="text/javascript">
    $(function(){
        var paycash = {
            tenderPaid : function(){
                return parseFloat($("#cashval").val()).toFixed(2)
            },
            totalPrice : function(){
                return parseFloat($("#total-price").data("tp")).toFixed(2)
            },
            toString : function(selector){
                var t = 0;
                t = paycash.tenderPaid() - paycash.totalPrice()
                $("#"+selector).val(parseFloat(t).toFixed(2))
            }
        };
        $("#paycashmodal").on("click","#comfirm", function(e){
            //console.log(paycash.tenderPaid())
        });

        $("#paycashmodal").on('shown.bs.modal', function () {
            $('#cashval').focus();
        });
        $("#paycashmodal").on("focusout","#cashval", function(e){
            paycash.toString("final-tp")
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#emvchipbtn').click(function(){
            alert('i am emv chip');
        });
    });
    removeInvoice();
</script>