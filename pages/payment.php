<?php
include("include/head.php");
if(isset($_REQUEST['order_id']) and $_REQUEST['order_id']!=""){
$_SESSION['order_id'] = $_REQUEST['order_id'];
}
if($_SESSION['order_id']==""){
    echo "<script>alert('Please Select Or make any order'); window.location.href='".base_url()."search.php';</script>";
}
$current_order_total = $obj->get_order_total_amount_by_id($_SESSION['order_id']);

$order_history = $obj->get_order_item_list($_REQUEST['order_id']);
$get_payment_info = $obj->get_payment_info($_REQUEST['order_id']);
//print_r($get_payment_info);
//print_r($get_payment_info);
?>

<div class="PaymentInfo" style="margin-bottom: 65px;">
	<div class="container-fluid">
    	<div class="TotalPayment">
        	<h4>Total Bill : <span><?php echo $current_order_total; ?></span></h4>
        </div>
        <div class="Invoicetable">
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Qty</th>
                    <th>Products</th>
                    <th>Price</th>
                   
                </tr>
                
            </thead>
            <tbody>
                <?php
                $i=1;
                while ($items = mysql_fetch_array($order_history)) {                
                ?>
                <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td class="text-center"><?php echo $items['quantity']; ?></td>
                    <td><?php echo $items['itemName']; ?><br><span><?php echo $items['itemDescription']; ?></span></td>
                    <td>$<?php echo $items['itemPrice']*$items['quantity']; ?></td>                     
                </tr>
                <?php
                    if($items['item_discount_amount']>0){
                ?>
                 <tr>
                    <td class="text-center"></td>
                    <td class="text-center">D</td>
                    <td><?php echo $items['item_discount_percent']; ?>% Discount</td>
                    <td>$<?php echo $items['item_discount_amount']; ?></td>                     
                </tr>               
                <?php
                    }
                $i++;
                }
                ?>
                <?php
                $taxes = $obj->get_tax();
                $i=1;
                while ($tax = mysql_fetch_array($taxes)) {
                ?>
                <tr <?php if($i==1){echo 'style="border-top:1px solid #000;"';}?>>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td><b><?php echo $tax['tax_type']; ?></b></td>
                    <td><b><?php echo $tax['tax_percent']; ?>%</b></td>                     
                </tr>
                <?php
                $i++;
                }
                ?>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td><b>Total Amount</b></td>
                    <td><b>$<?php echo $current_order_total; ?></b></td>                     
                </tr>
            </tbody>
        </table>
      
        </div>
        <hr>
        <div class="container">
        <form method="POST" name="payment_form" id="payment_form">
            <input type="hidden" name="order_total" value="<?php echo $current_order_total; ?>" >
            <div class="TipTab">
                <div class="col-xs-3"><label>Discount&nbsp;:</label></div>
                <div class="col-xs-1"><input type="radio" name="discount_in_percent" value="10" <?php if(isset($get_payment_info['discount_percent']) and $get_payment_info['discount_percent']=="10"){echo "checked='checked'";}?>><span>10%</span></div>
                <div class="col-xs-1"> <input type="radio" name="discount_in_percent" value="15" <?php if(isset($get_payment_info['discount_percent']) and $get_payment_info['discount_percent']=="15"){echo "checked='checked'";}?>><span>15%</span></div>
                 <div class="col-xs-1"><input type="radio" name="discount_in_percent" value="20" <?php if(isset($get_payment_info['discount_percent']) and $get_payment_info['discount_percent']=="20"){echo "checked='checked'";}?>><span>20%</span></div>
                 <div class="form-group">
                   
                    <input type="number"  style="width:20%;" step=".01" placeholder="Calculated Or Input" name="discount_percent_amt" value="<?php if(isset($get_payment_info['discount_amt'])){echo $get_payment_info['discount_amt'];}else{echo '0';}?>" id="discount_percent_amt">
                </div> 

            </div>
            <!-- <div class="Manual-tip">            
                <div class="form-group">
                    <label>Enter Discount Amount</label>
                    <input type="number" step=".01" placeholder="Calculated Or Input" name="discount_percent_amt" value="<?php if(isset($get_payment_info['discount_amt'])){echo $get_payment_info['discount_amt'];}else{echo '0';}?>" id="discount_percent_amt">
                </div> 
            </div> -->


            <div class="TipTab">
            	<div class="col-xs-3"><label>Tips&nbsp;:</label></div>
                <div class="col-xs-1"><input type="radio" name="tip_in_percent" value="10" <?php if(isset($get_payment_info['tip_percent']) and $get_payment_info['tip_percent']=="10"){echo "checked='checked'";}?>><span>10%</span></div>
                <div class="col-xs-1"> <input type="radio" name="tip_in_percent" value="15" <?php if(isset($get_payment_info['tip_percent']) and $get_payment_info['tip_percent']=="15"){echo "checked='checked'";}?>><span>15%</span></div>
                 <div class="col-xs-1"><input type="radio" name="tip_in_percent" value="20" <?php if(isset($get_payment_info['tip_percent']) and $get_payment_info['tip_percent']=="20"){echo "checked='checked'";}?>><span>20%</span></div>
                 <div class="">
                  
                    <input type="number" style="width:20%;" step=".01" placeholder="Calculated Or Input" name="calculate_percent_amt" value="<?php if(isset($get_payment_info['tip_amt'])){echo $get_payment_info['tip_amt'];}else{echo '0';}?>" id="calculate_percent_amt">
                </div>
            </div>


            <div class="TipTab" style="margin-top:3%;">
                <div class="col-xs-6" style="text-align:center;"><b>Balance Amount</b></div>
                <div class="" >                    
                    <input type="number" style="width:20%;" step=".01" placeholder="Input Amount" name="balance_amt" id="balance_amt"  value="<?php if(isset($get_payment_info['balance_amt'])){echo $get_payment_info['balance_amt'];}else{ echo $current_order_total;} ?>">
                </div>

            </div>



            <div class="Manual-tip" style="margin-top:3%;">
                <div class=" col-xs-11 col-sm-11 ">
                    <div><b>Tendered Amount</b></div>
                    <input type="number" step=".01" placeholder="Input Amount" name="tendered_amt" id="tendered_amt" value="<?php if(isset($get_payment_info['tendered_amt'])){echo $get_payment_info['tendered_amt'];}else{ echo 0;} ?>">
                </div>          	
                
                <div class="col-xs-11 col-sm-11 ">
                    <div><b>Credit/Debit</b></div>
                    <input type="number" step=".01" placeholder="Input Amount" name="card_pay_amt" id="card_pay_amt" value="">
                </div>
                
                <div class="col-xs-11 col-sm-11 ">
                	<div><b>Cash</b></div>
                    <?php //if(isset($get_payment_info['cash_change']) && ){echo $get_payment_info['cash_change'];}else{ echo 0;} ?>
                    <input type="number" step=".01" placeholder="Calculated" name="cash_change" id="cash_change" value="">
                </div>
                           
            </div>

             <div style="clear:both;"></div>
             <div class="Manual-tip"  style="margin-top:3%;"> 

                    <div class="form-group text-center GroupBttn">
                    <!-- <button  type="button" style="" name="payment_button" id="payment_button">Swipe Card</button><br> -->
                    <button  type="button" style="" name="payment_button" id="payment_button" data-toggle="modal" data-target="#cart_payment_modal">Swipe Card</button><br>
                    <button type="button" name="save_order_payment" id="save_order_payment">Cash Payment</button><br>
                    <button type="button" name="cancel_order_payment" id="cancel_order_payment">Cancle</button>                
                </div>  

             </div>

        </form>

       </div>
    </div>
</div>



<?php
include("ajax_request.php");
include("include/footer.php");
?>
<script type="text/javascript">
$(document).ready(function(){
    if($('#tendered_amt').val()>0){
       $("#save_order_payment").hide();
       $("#payment_button").show();
    }
    $("#cash_change").val(calculatecashchange());
    $("input[name='tip_in_percent']").change(function(){
        var tip_percent = parseFloat($("input[name='tip_in_percent']:checked").val());
        var total_order_amount = parseFloat('<?php echo $current_order_total; ?>');
        $("#calculate_percent_amt").val(calculatePerc(total_order_amount,tip_percent));
        $("#cash_change").val(calculatecashchange());
        $("#balance_amt").val(total_balance());
    });
    $("input[name='discount_in_percent']").change(function(){
        var discount_percent = parseFloat($("input[name='discount_in_percent']:checked").val());
        var total_order_amount = parseFloat('<?php echo $current_order_total; ?>');
        $("#discount_percent_amt").val(calculatePerc(total_order_amount,discount_percent));
        $("#cash_change").val(calculatecashchange());
        $("#balance_amt").val(total_balance());
    });

    


    $('#discount_percent_amt').keyup(function() {        
        $("#cash_change").val(calculatecashchange());
        $("#balance_amt").val(total_balance());
    });
    $('#calculate_percent_amt').keyup(function() {        
        $("#cash_change").val(calculatecashchange());
        $("#balance_amt").val(total_balance());
    });
    $('#tendered_amt').keyup(function() {        
        $("#cash_change").val(calculatecashchange());
        $("#balance_amt").val(total_balance());
    });
    $('#payment_button').click(function() {
    	$(".cart_due_amount").html($("#cash_change").val().replace("-",""));
        $("#cart_due_amount").html($("#cash_change").val().replace("-",""));
    	var form_data = $("#payment_form").serialize();
                $.ajax({
                      type: "POST",
                      data: form_data,
                      url: "ajax_response.php?save_order_payment_with_due",    
                      success: function(response){
                        //window.location.href="<?php echo base_url(); ?>swipecart.php";
                      }
                    }); 
    
        
    });
    $('#save_order_payment').click(function() {
        if(parseFloat($('#tendered_amt').val())<parseFloat($('#balance_amt').val())){
            if(confirm("You are getting $"+$('#tendered_amt').val()+" Cash. Remainig Amount "+$('#cash_change').val()+" by Swipecart.")){
                var form_data = $("#payment_form").serialize();
                $.ajax({
                      type: "POST",
                      data: form_data,
                      url: "ajax_response.php?save_order_payment_with_due",    
                      success: function(response){
                        $("#save_order_payment").hide();
                        $("#payment_button").show();

                      }
                    });             

            }else{

            }

        }else if(confirm("You are getting complete $"+$('#tendered_amt').val()+" Cash. Remainig Amount "+$('#cash_change').val()+" back to customer.")){
            alert("ok"); 
            var form_data = $("#payment_form").serialize();
            $.ajax({
              type: "POST",
              data: form_data,
              url: "ajax_response.php?save_order_payment",    
              success: function(response){
                if(response=='1'){
                    alert("Payment success.");
                    window.location.href = "<?php echo base_url(); ?>search.php";
                }else if(response=='0'){
                    alert("Payment Not success. Please Try again.");
                }
                //alert(response);
              }
            });  
        }        
    });

    $(".swip_btn_submit").click(function(){

        var cart_due_amount = parseFloat($(".cart_due_amount").html());
        if($("#cart_manual_amount").val()=="" || $("#cart_manual_amount").val()<=0 || $("#cart_manual_amount").val()>cart_due_amount){
            alert("Please Enter Correct aount");
        }else{
            $("#manual_pay_form").submit();
        }

    });
});
</script>
<!-- Modal -->
<div id="cart_payment_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="GET" action="<?php echo base_url(); ?>swipecart.php" id="manual_pay_form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Total Due Amount : <span class="cart_due_amount"></span></h4>
        <input type="hidden" id="cart_due_amount" name="cart_due_amount" value="">
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label for="email">Enter Amount:</label>                
                <input type="number" step=".01" placeholder="Enter Amount" name="cart_manual_amount" id="cart_manual_amount" value="">
            </div>
            
            <button type="button" class="swip_btn_submit" >Submit</button>
            <button type="button" class="" data-dismiss="modal">Close</button>
        

      </div>
      <div class="modal-footer">
        
      </div>
      </form>
    </div>

  </div>
</div>