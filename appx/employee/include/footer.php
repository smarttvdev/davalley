
<footer>
	<div class="col-md-12">
    	<div class="row">
        	<div class="footerMenu hvr-grow">
            	<a href="<?php echo base_url(); ?>search.php">
                    <img src="<?php echo base_url(); ?>images/search.png" class="img-responsive">
                </a>
            </div>
            <div class="footerMenu hvr-grow">
            	<a href="<?php echo base_url(); ?>invoice.php">
                    <img src="<?php echo base_url(); ?>images/printer.png" class="img-responsive">
                </a>
            </div>
            <div class="footerMenu hvr-grow">
            	<a href="<?php echo base_url(); ?>payment.php">
                    <img src="<?php echo base_url(); ?>images/payment.png" class="img-responsive">
                </a>
            </div>
            <div class="footerMenu hvr-grow">
            	<a href="<?php echo base_url(); ?>order.php">
                    <img src="<?php echo base_url(); ?>images/order.png" class="img-responsive">
                </a>
            </div>
<!--            <div class="footerMenu hvr-grow">-->
<!--            	<a href="javascript:void(0)" onclick="add_discout_for_item()" data-rel="" id="discount_footer_btn">-->
<!--                    <img src="--><?php //echo base_url(); ?><!--images/discount.png" class="img-responsive">-->
<!--                </a>-->
<!--            </div>-->
            <div class="footerMenu hvr-grow">
                <a href="#" onclick="add_discout_for_item()" data-rel="" id="discount_footer_btn">
                    <img src="<?php echo base_url(); ?>images/discount.png" class="img-responsive">
                </a>
            </div>
            <div class="footerMenu  hvr-grow">
            	
                <img src="<?php echo base_url(); ?>images/Settings-icon.png" class="img-responsive">

            </div>
<!--            <div class="footerMenu hvr-grow">-->
<!--            	<a href="javascript:void(0)" onclick="logout()">-->
<!--                    <img src="--><?php //echo base_url(); ?><!--images/logout.png" class="img-responsive">-->
<!--                </a>-->
<!--            </div>-->

            <div class="footerMenu hvr-grow">
                <a href="javascript:void(0)" onclick="displayDialogue()">
                    <img src="<?php echo base_url(); ?>images/logout.png" class="img-responsive">
                </a>
            </div>
        </div>
        <style>
            .ui-draggable .ui-dialog-titlebar{
                text-align:center;
                color:#eeeeee;
                background: #005454;
            }
            .ui-dialog{
                padding:0;
            }
            #PINcode input:focus,
            #PINcode select:focus,
            #PINcode textarea:focus,
            #PINcode button:focus {
                outline: none;
            }
            #PINcode {
                background: #ededed;
                width:100%;
                text-align:center;
                padding: 0px;
                padding-bottom:5px;
                -webkit-box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
                -moz-box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
                box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
                border-radius: 0 0 6px 6px;
            }
            #PINbox {
                background: #ededed;
                margin: 15px 20px;
                width: 80%;
                font-size: 20px;
                text-align: center;
                border: 1px solid #d5d5d5;
            }
            .PINbutton {
                background: #ededed;
                color: #7e7e7e;
                border: none;
                /*background: linear-gradient(to bottom, #fafafa, #eaeaea);
                  -webkit-box-shadow: 0px 2px 2px -0px rgba(0,0,0,0.3);
                     -moz-box-shadow: 0px 2px 2px -0px rgba(0,0,0,0.3);
                          box-shadow: 0px 2px 2px -0px rgba(0,0,0,0.3);*/
                border-radius: 50%;
                /*font-size: 1.5em;*/
                font-size: 20px;
                text-align: center;
                width: 45px;
                height: 45px;
                margin: 2px 4px;
                padding: 0;
            }
            input.PINbutton{
                font-size:20px;
            }
            input.PINbutton.back, input.PINbutton.enter {
                font-size: 12px;
            }
            .PINbutton:hover {
                box-shadow: #506CE8 0 0 1px 1px;
            }
            .PINbutton:active {
                background: #506CE8;
                color: #fff;
            }
            .back:hover {
                box-shadow: #ff3c41 0 0 1px 1px;
            }
            .back:active {
                background: #ff3c41;
                color: #fff;
            }
            .enter:hover {
                box-shadow: #47cf73 0 0 1px 1px;
            }
            .enter:active {
                background: #47cf73;
                color: #fff;
            }
            .shadow{
                -webkit-box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
                -moz-box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
                box-shadow: 0px 5px 5px -0px rgba(0,0,0,0.3);
            }
            div.PIN-modal.modal-dialog {
                position:absolute;
                top:50% !important;
                transform: translate(-50%, -50%) !important;
                -ms-transform: translate(0, -50%) !important;
                -webkit-transform: translate(0, -50%) !important;
                left:calc(50vw - 114px);
                width:230px;
                height:250px;
                padding-bottom:0;
            }



        </style>

        <div id="dialog" title="Enter PIN" style="padding:0;" class="modal" role="dialog">
            <div class="PIN-modal modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style=" background: #ededed!important;border-radius:6px 6px 0 0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Enter PIN</h4>
                    </div>
                    <div class="modal-body" style="height:250px;padding:0">
                        <div id='PINcode'>
                            <input id='PINbox' type='password' value='' name='PINbox' disabled />
                            <br>
                            <input type='button' class='PINbutton' name='1' value='1' id='1'  />
                            <input type='button' class='PINbutton' name='2' value='2' id='2' />
                            <input type='button' class='PINbutton' name='3' value='3' id='3' />
                            <br>
                            <input type='button' class='PINbutton' name='4' value='4' id='4'  />
                            <input type='button' class='PINbutton' name='5' value='5' id='5'  />
                            <input type='button' class='PINbutton' name='6' value='6' id='6' />
                            <br>
                            <input type='button' class='PINbutton' name='7' value='7' id='7'/>
                            <input type='button' class='PINbutton' name='8' value='8' id='8'/>
                            <input type='button' class='PINbutton' name='9' value='9' id='9'/>
                            <br>

                            <input type='button' class='PINbutton back' name='-' value='CLEAR' id='-'/>
                            <input type='button' class='PINbutton' name='0' value='0' id='0'/>
                            <input type='button' class='PINbutton enter' name='+' value='ENTER' id='+' onClick=submitForm(); />
                            <h6 id="pin-error" style="visibility: hidden;color:red;margin-top:5px;margin-bottom:10px">Pin code is not correct</h6>
                        </div>
                    </div>
                </div>
            <script>
                $(document).on('click','.PINbutton',function() {
                    var number=$(this).val();
                    var v = $( "#PINbox" ).val();
                    if (!($(this).hasClass('enter'))){
                        $( "#PINbox" ).val( v + number);
                    }
                })

                $(document).on('click','.back',function() {
                    $( "#PINbox" ).val('');
                })
                function submitForm() {
                    var result;
                    var pinCode=$('#PINbox').val();
                    result=isLogedIn(pinCode);
                    console.log(result);
                    var state=result['state'];
                    var employee_id=result['employee_id'];
                    if (state==0){
                        $('#pin-error').css('visibility','visible');
                    }
                    else{
                        if (employee_id=='0'){
                           location.href='login.php';
                        }
                        else{
                            $('#dialog').modal('toggle');
                            location.reload();
                        }
                    }
                };


                // var dialog = $( "#dialog" ).dialog({
                //     autoOpen: false,
                //     height: 335,
                //     width: 220,
                //     modal: true,
                // });
                function displayDialogue(){
                    // $('#PINbox').val('');
                    $('#dialog').modal('show');

                }
                $( "#dialog" ).on('show', function(){
                    $('#PINbox').val('');
                });
                $('#dialog').on('shown.bs.modal', function() {
                    $('#PINbox').val('');
                }) ;

                function getPincode(pinCode){
                    return pinCode;
                }
                function isLogedIn(pinCode){
                    var data={'OperationType':'checkPinCode',
                          'pinCode':pinCode};
                    data=JSON.stringify(data);

                    var result;
                    $.ajax({
                        url:'ajaxServer.php',
                        method:"POST",
                        data:'data='+data,
                        async:false,
                        success:function(result1) {
                            result=JSON.parse(result1);
                        }
                    })
                    return result;
                }
            </script>
        </div>
    </div>
</footer>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/custom.js"></script>
<script src="<?php echo base_url(); ?>js/default.js"></script>
<script type="text/javascript">
function logout() {
    if(confirm('Are you sure you want to Delete Item?')){
        window.location.href = "<?php echo base_url(); ?>logout.php";
        return true;
    }else{
        return false;
    }
}
// var pinCodeInput=document.getElementById('PINcode');
// document.getElementById('dialog').appendChild(pinCodeInput);

function add_discout_for_item() {
    var item_id = $("#discount_footer_btn").attr("data-rel");
    if(item_id==""){
        var path=(document.location.pathname.match(/[^\/]+$/)[0]);
        var data={'OperationType':'checkCredentialForDiscount'};
        data=JSON.stringify(data);
        if (path=='payment.php'){
            $.ajax({
                url:'ajaxServer.php',
                method:'POST',
                data:'data='+data,
                success:function (result) {
                    var credential=parseInt(result);
                    if (credential>80) {
                        $('.TipTab').show();
                        $('.Manual-tip').show();
                    }
                    else {
                        alert("Your credential is not enough to discount\n Please call manager");
                    }
                }
            });
        }
    }
}
function calculatePrice(total_order_amount,tip_percent) {
    var percentage = tip_percent;
    var price      = total_order_amount;
    var calcPrice  = (price + ( price * percentage / 100 )).toFixed(2);
    return calcPrice;
}

function calculatePerc(total_order_amount,tip_percent) {
    var percentage = tip_percent;
    var price    = total_order_amount;
    var calcPerc = ((total_order_amount*tip_percent)/100).toFixed(2);
    return calcPerc;
}

function calculatecashchange(){
    var dis_amt = parseFloat($("#discount_percent_amt").val());
    var tip_amt = parseFloat($("#calculate_percent_amt").val());

    // var card_pay_amt = parseFloat($("#card_pay_amt").val());
    //var total_order_amount = parseFloat('<?php //echo $current_order_total; ?>//')-card_pay_amt;

    var total_order_amount = parseFloat('<?php echo $current_order_total; ?>');
    var cash_change = (parseFloat($('#tendered_amt').val())-((total_order_amount+tip_amt)-dis_amt)).toFixed(2);

    // console.log("dis_amt="+dis_amt);
    // console.log("tip_amt="+tip_amt);
    // console.log("total_order_amount="+total_order_amount);
    // console.log("cash_change="+cash_change);

    return cash_change;

}
function total_balance(){
    var dis_amt = parseFloat($("#discount_percent_amt").val());
    var tip_amt = parseFloat($("#calculate_percent_amt").val());
    var total_order_amount = parseFloat('<?php echo $current_order_total; ?>');
    var total_balance = (((total_order_amount+tip_amt)-dis_amt)).toFixed(2);
    return total_balance;
}
</script>
</body>
</html>


<!--https://codepen.io/totalnerd_es/pen/AwKLk-->