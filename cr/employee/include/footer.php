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
            <div class="footerMenu hvr-grow">
            	<a href="javascript:void(0)" onclick="add_discout_for_item()" data-rel="" id="discount_footer_btn">
                    <img src="<?php echo base_url(); ?>images/discount.png" class="img-responsive">
                </a>
            </div>
            <div class="footerMenu  hvr-grow">
            	
                <img src="<?php echo base_url(); ?>images/Settings-icon.png" class="img-responsive">

            </div>
            <div class="footerMenu hvr-grow">
            	<a href="javascript:void(0)" onclick="logout()">
                    <img src="<?php echo base_url(); ?>images/logout.png" class="img-responsive">
                </a>
            </div>
            
            
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

function add_discout_for_item(){
    var item_id = $("#discount_footer_btn").attr("data-rel");
    if(item_id==""){

    }else{
    if(document.location.pathname.match(/[^\/]+$/)[0]=="index.php"){
       $.ajax({
            type: "POST",
            url: "ajax_response.php?add_discout_for_item="+item_id,    
            success: function(response){
                $("#discount_footer_btn").attr("data-rel",'');
                $('#discount_modal').modal('show');
                $('.discount_modal_body').html(response);

            }
          });        
    }else{

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
    var card_pay_amt = parseFloat($("#card_pay_amt").val());
    //alert(card_pay_amt);
    var total_order_amount = parseFloat('<?php echo $current_order_total; ?>')-card_pay_amt;    
    var cash_change = (parseFloat($('#tendered_amt').val())-((total_order_amount+tip_amt)-dis_amt)).toFixed(2);
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
