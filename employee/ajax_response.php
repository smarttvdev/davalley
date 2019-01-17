<?php
include('classes.php');
$obj=new Classes();
/*Login*/
if(isset($_REQUEST['login'])){
$uname   =	$_POST['username'];
$passwrd =	$_POST['password'];
echo $row=$obj->login($uname,$passwrd);
}
/**/
/*New Order*/
if(isset($_REQUEST['create_new_order'])){
	$create_order = $obj->create_new_order($_REQUEST['table_number']);
	$_SESSION['order_id'] = $create_order;
	if($create_order!=""){
		echo "1";
	}else{
		echo "0";
	}
}
/*New Order*/

/*add_to_cart_add_ons*/

if(isset($_REQUEST['add_to_cart_add_ons'])){
$get_addons = $obj->get_addons($_REQUEST['id']);
$get_item = $obj->get_item_by_id($_REQUEST['id']);
$get_category = $obj->get_category_by_id($get_item['sideOrderCat']);
?>
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"><?php echo $get_item['itemName']; ?></h4>
	</div>
	<div class="modal-body">
		<div class="demo">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<form id="addon_item_form">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<i class="more-less glyphicon glyphicon-plus"></i>
						<?php echo $get_category['CategoryNote']; ?>
						</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<?php
							foreach ($get_addons as $key => $value) {
								echo '<p><input type="checkbox" name="item_checkbox[]" id="item_checkbox" onclick="find_checked_checkbox()" value="'.$value['itemID'].'"> '.$value['itemName'].'</p>';
							}
							?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<i class="more-less glyphicon glyphicon-plus"></i>
						Message
						</a>
					</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<textarea Placeholder="Cook Message" style="width:100%" name="cook_message"></textarea>
						</div>
					</div>
				</div>
				<input type="button" name="add_to_cart" onclick="add_to_cart_item_final(<?php echo $_REQUEST['id']; ?>,'<?php echo $_REQUEST['panel']; ?>')" value="Add to Cart" >
				</form>
			</div><!-- panel-group -->
		</div><!-- container -->
	</div>
	<div class="modal-footer"><button type="button" class="btn btn-default new_btn" data-dismiss="modal">Close</button>
	</div>
</div>
<script type="text/javascript">
function find_checked_checkbox () {
if($("[type='checkbox']:checked").length>=2){
	$("input[type=checkbox]").not(':checked').attr('disabled',true);
}else{
	$("input[type=checkbox]").not(':checked').attr('disabled',false);
}
}



</script>
<?php
}

/*add_to_cart_add_ons*/




if(isset($_REQUEST['add_to_cart'])){
	$add_item_to_order = $obj->add_item_to_order($_REQUEST['add_to_cart'],$_POST);
	if($add_item_to_order=="exist"){
		echo "exist";
	}else{
    $get_total_order_item = $obj->get_total_order_item();
	if(sizeof($_POST['item_checkbox'])>=1){
    $get_side_order_detail = $obj->get_side_order_detail(implode(',', $_POST['item_checkbox']));
    }
    $_SESSION['item_id_f_d'] = $_REQUEST['add_to_cart'];
    ?>
    <tr id="item_row_<?php echo $add_item_to_order["itemID"]; ?>">

                                <td class="text-center"><span><?php echo $get_total_order_item; ?></span></td>

                                <td><?php echo $add_item_to_order["side_order_item_ids"]; ?></td>

                                <td class="_title"><?php echo $add_item_to_order["itemName"]; ?><br>

                                    <span><?php
                                    //print_r($get_side_order_detail);
                                    if(sizeof($_POST['item_checkbox'])>=1){
                                    foreach ($get_side_order_detail as $key => $value) {
                                    echo $value['itemName'] .' & ';
                                    }
                                    }
                                    echo $_POST['cook_message'];
                                    ?></span>

                                </td>

                                <td class="QTY">

                                    <div class="input-group">

                                        <span class="input-group-btn">

                                        <button type="button" class="quantity-left-minus btn btn-number" data-type="minus" data-field="" onclick="quantity_minus(<?php echo $add_item_to_order["itemID"]; ?>)">

                                              <span class="glyphicon glyphicon-minus"></span>

                                            </button>

                                        </span>

                                        <input type="text" id="quantity_<?php echo $add_item_to_order["itemID"]; ?>" name="quantity" class="form-control input-number" value="1" min="1" max="100">

                                        <span class="input-group-btn">

                                        <button type="button" class="quantity-right-plus btn  btn-number" data-type="plus" data-field="" onclick="quantity_plus(<?php echo $add_item_to_order["itemID"]; ?>)">

                                                <span class="glyphicon glyphicon-plus"></span>

                                            </button>

                                        </span>

                                    </div>

                                </td>

                                <td>

                                    <span id="item_total_price_<?php echo $add_item_to_order["itemID"]; ?>">

                                    	<?php echo $add_item_to_order["itemPrice"]; ?>

                                    </span>

                                    <span style="display:none;" id="original_item_price_<?php echo $add_item_to_order["itemID"]; ?>">
                                    	<?php echo $add_item_to_order["itemPrice"]; ?>
                                    </span>

                                </td>

                                <td class="remove"><a href="javascript:void(0)" onclick="remove_item_from_order(<?php echo $add_item_to_order["itemID"]; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

                            </tr>

    <?php
	/*echo $order_item_list = '<tr id="item_row_'.$add_item_to_order["itemID"].'"><td class="text-center"><span>'.$get_total_order_item.'</span></td><td>'.$add_item_to_order["itemCode"].'</td><td class="_title">'.$add_item_to_order["itemName"].'<br><span>'.$add_item_to_order["itemDescription"].'</span></td><td class="QTY"><div class="input-group"><span class="input-group-btn"><button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="" onclick="quantity_minus('.$add_item_to_order["itemID"].')"><span class="glyphicon glyphicon-minus"></span></button></span><input type="text" id="quantity_'.$add_item_to_order["itemID"].'" name="quantity" class="form-control input-number" value="1" min="1" max="100"><span class="input-group-btn"><button type="button" class="quantity-right-plus btn  btn-number" data-type="plus" data-field="" onclick="quantity_plus('.$add_item_to_order["itemID"].')"><span class="glyphicon glyphicon-plus"></span></button></span></div></td><td><span id="item_total_price_'.$add_item_to_order["itemID"].'">'.$add_item_to_order["itemPrice"].'</span><span style="display:none;" id="original_item_price_'.$add_item_to_order["itemID"].'">'.$add_item_to_order["itemPrice"].'</span></td><td class="remove"><a href="javascript:void(0)" onclick="remove_item_from_order('.$add_item_to_order["itemID"].')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';*/
	}
	
	/*$get_item_by_id = $obj->get_item_by_id($_REQUEST['add_to_cart']);
	//print_r($get_item_by_id);
	$item_row = 
	$_SESSION['cart_items'][] = $item_row;
	$resp_arr = array('item_row' => $item_row, 'total' => '0');
	echo json_encode($resp_arr);*/
}


/*Update Quantity*/

if(isset($_REQUEST['update_qty'])){
	$update_item_qty = $obj->update_item_qty($_REQUEST['item_id'],$_REQUEST['qty']);
	echo $obj->get_order_total_amount();
}

/*Update Quantity*/
/*Remove Item from  Order*/
if(isset($_REQUEST['remove_item_from_order'])){
    $remove_item_from_order = $obj->remove_item_from_order($_REQUEST['id']);
    echo $obj->get_order_total_amount();
}
/*Remove Item from  Order*/

/*Get Total amount For add to cart*/

if(isset($_REQUEST['get_total_for_add_to_cart'])){
    //$update_item_qty = $obj->update_item_qty($_REQUEST['item_id'],$_REQUEST['qty']);
    echo $obj->get_order_total_amount();
}

/*Get Total amount For add to cart*/

/*Make First Order*/
if(isset($_REQUEST['make_first_order'])){
	echo $_SESSION['order_id'] = $_REQUEST['id'];
}
/*Make First Order*/


/*Edit Order*/

if(isset($_REQUEST['edit_order_from_front'])){
	echo $edit_order_from_front = $obj->edit_order_from_front($_REQUEST['id']);
}

/*Edit Order*/


/*save_order_payment*/

if(isset($_REQUEST['save_order_payment'])){
	$order_payment = $obj->save_order_payment($_POST);
}

/*save_order_payment*/

/*save_order_payment With Due*/

if(isset($_REQUEST['save_order_payment_with_due'])){
    $order_payment = $obj->save_order_payment_with_due($_POST);
}

/*save_order_payment With Due*/


/* add_discout_for_item */
if(isset($_REQUEST['add_discout_for_item'])){
$item = $obj->get_item_by_id($_SESSION['item_id_f_d']);
$order_item = $obj->get_order_item_by_id($_SESSION['item_id_f_d']);
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?php echo $item['itemName']; ?> - <span id="item_d_qty"><?php echo $order_item['quantity']; ?></span> X <span id="item_d_price"><?php echo $item['itemPrice']; ?></span> = <span id="item_d_total_price"><?php echo $order_item['quantity']*$item['itemPrice']; ?></span></h4>
    </div>
    <div class="modal-body">
        <div class="demo">
        	<form method="POST" id="discount_form_save">
                <div id="div_for_d">
                    <div class="row ">
                    	<div class="col-md-12">Discount</div><br>
                    	<div class="col-md-4">
                        5% <input type="radio" name="modal_item_disc" value="5">
                        </div>
                        <div class="col-md-4">
                        10% <input type="radio" name="modal_item_disc" value="10">
                        </div>
                        <div class="col-md-4">
                        15% <input type="radio" name="modal_item_disc" value="15">
                    	</div>
                    </div>
                    <div><br>
                        <input type="number" step=".01" placeholder="Calculated Or Input" name="item_disc_custom" value="0" id="item_disc_custom">
                    </div>
                    <div style="margin: 25px 0;">
                        <button type="button" class="save_discount">Save</button>
                        <button type="button" class="" data-dismiss="modal">Close</button>
                    </div>
                </div>
               </form>
        </div><!-- container -->
    </div>
    <div class="modal-footer">
    	
    </div>
<script type="text/javascript">
$("input[name='modal_item_disc']").change(function(){
    var discount_percent = parseFloat($("input[name='modal_item_disc']:checked").val());
    var total_order_amount = parseFloat($("#item_d_total_price").text());
    $("#item_disc_custom").val(calculatePerc(total_order_amount,discount_percent));        
});
$(".save_discount").click(function(){
	$.ajax({
	    type: "POST",
	    data: $("#discount_form_save").serialize(),
	    url: "ajax_response.php?save_discount=<?php echo $order_item['id']; ?>&item_id=<?php echo $_REQUEST['add_discout_for_item']; ?>",    
	    success: function(response){
            $("#order_list_items").append(response);
	    }
	  });
    $.ajax({
        type: "POST",
        url: "ajax_response.php?get_total_for_add_to_cart",    
        success: function(response){  
        $('#total_price').html(response);    
        $('#discount_modal').modal('hide');
        }
      });
});
</script>
<?php
}
/* add_discout_for_item */


if(isset($_REQUEST['save_discount'])){
$save_discount = $obj->save_discount($_POST,$_REQUEST['save_discount']);
?>
<tr id="item_row_d_<?php echo $_REQUEST['item_id']; ?>" class="">
    <td class="text-center"><span></span></td>
    <td>D</td>
    <td class=""> 
       <?php echo $_POST['modal_item_disc']; ?>% Discount    	
    </td>
    <td class="QTY">
    </td>
    <td>
        <span id="item_disc_price_<?php echo $_REQUEST['item_id']; ?>"><?php echo $_POST['item_disc_custom']; ?></span>
    </td>
    <td class="remove"></td>
</tr>
<?php
}
?>