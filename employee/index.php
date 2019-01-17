<?php

include("include/head.php");

if(isset($_REQUEST['order_id']) and $_REQUEST['order_id']!=""){

$_SESSION['order_id'] = $_REQUEST['order_id'];

}

$current_order = $obj->get_current_order_detail();

if(isset($_REQUEST['check'])){
$get_payment_info = $obj->get_payment_info($_SESSION['order_id']);
if($get_payment_info['cash_change']>=0){
    unset($_SESSION['order_id']);
    redirect("search.php");
}else{
    redirect("payment.php");
}
}
?>

<div class="paddTop50">

    <?php

    if(isset($_SESSION['order_id'])){

    ?>

    <div class="_userinfo col-md-12">

        <div class="row">

        	<div class="col-md-4 col-xs-4 col-sm-4">

            	<p><label>User:</label> <?php echo $_SESSION['user_fullname']; ?></p>

            </div>

            <div class="col-md-4 col-xs-4 col-sm-4">

            	<p><label>Table:</label> <?php echo $current_order['table_id']; ?></p>

            </div>

            <div class="col-md-4 col-xs-4 col-sm-4">

            	<p><label>Ticket:</label> <?php echo $current_order['ticket_id']; ?></p>

            </div>

        </div>

    </div>


<div class="container_12 divider">
            
            <div class="grid_12 height250">
                <table class="fancyTable" id="myTable02" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Description</th>
                            <th >QTY</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                     <tbody id="order_list_items">

                            <?php
                            $get_order_items = $obj->get_order_item_list();
                            $index_table_num=1;
                            while ($list_items = mysql_fetch_array($get_order_items)) {
                            ?>
                            <tr id="item_row_<?php echo $list_items["itemID"]; ?>">
                                <td class="text-center"><span><?php echo $index_table_num; ?></span></td>
                                <td><?php echo $list_items["itemCode"]; ?></td>
                                <td class="_title"><?php echo $list_items["itemName"]; ?><br>
                                    <span><?php 
                                    if($list_items["side_order_item_ids"]!=""){
                                    $get_side_order_detail = $obj->get_side_order_detail($list_items["side_order_item_ids"]);
                                    foreach ($get_side_order_detail as $key => $value) {
                                    echo $value['itemName'] .' & ';
                                    }
                                    }
                                    echo $list_items["cook_message"];
                                    ?></span>
                                </td>
                                <td class="QTY">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="" onclick="quantity_minus(<?php echo $list_items["itemID"]; ?>)">
                                              <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity_<?php echo $list_items["itemID"]; ?>" name="quantity" class="form-control input-number" value="<?php echo $list_items["quantity"]; ?>" min="1" max="100">
                                        <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn  btn-number" data-type="plus" data-field="" onclick="quantity_plus(<?php echo $list_items["itemID"]; ?>)">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span id="item_total_price_<?php echo $list_items["itemID"]; ?>"><?php echo $list_items["itemPrice"]*$list_items["quantity"]; ?></span>
                                    <span style="display:none;" id="original_item_price_<?php echo $list_items["itemID"]; ?>"><?php echo $list_items["itemPrice"]; ?></span>
                                </td>
                                <td class="remove"><a href="javascript:void(0)" onclick="remove_item_from_order(<?php echo $list_items["itemID"]; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php
                            if($list_items['item_discount_amount']>0){
                            ?>
                                <tr id="item_row_d_<?php echo $list_items['item_id']; ?>" class="">
                                    <td class="text-center"><span></span></td>
                                    <td>D</td>
                                    <td class=""> 
                                         <?php echo $list_items['item_discount_percent']; ?>% Discount 
                                    </td>
                                    <td class="QTY">
                                    </td>
                                    <td>
                                        <span id="item_disc_price_<?php echo $list_items['item_id']; ?>">-<?php echo $list_items['item_discount_amount']; ?></span>
                                    </td>
                                    <td class="remove"></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <?php

                            $index_table_num++;

                            }

                            ?>

                        </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>


    <div class="orderListing">

    	<div class="ordertable">

            <div class="ItemTotal clearfix">

            <div class="col-md-3 col-xs-12 pull-right">

                <div class="col-md-6 col-xs-6">

                    <div class="row">
                        <?php
                        $taxes = $obj->get_tax_name();
                        foreach ($taxes as $key => $value) {
                        echo '<span class="Text1">'.$value.'</span>';
                        }
                        ?>
                        

                        <span class="Text1">Total</span>

                    </div>

                </div>                

                <div class="col-md-6 col-xs-6">

                    <div class="row">

                        <?php
                        $taxes = $obj->get_tax_percent();
                        foreach ($taxes as $key => $value) {
                        echo '<span class="Text2">'.$value.'%</span>';
                        }
                        ?>

                        <span class="Text2" id="total_price"><?php echo $obj->get_order_total_amount(); ?></span>

                    </div>

                </div>

            </div>

        </div>

        </div>



        <div class="Frequentyorder FrequentyorderNext">

            <div class="_userinfo col-md-12">

                <div class="row">

                    <h4>Most Frequent Items<span> <a href="javascript:void(0)" id="SidebarToggle"><i class="fa fa-bars" aria-hidden="true"></i></span></a></h4>

                </div>

            </div>

            <div class="TableScrollSecond">

                <?php

               $get_menu_items = $obj->get_top_selling_item(48);

               while($results = mysql_fetch_array($get_menu_items)){    

                ?>    

            	<a href="javascript:void(0)" onclick="add_to_cart_item('<?php echo $results["itemID"]; ?>')">

                    <div class="ItemList">

                    	<span><?php echo $results["itemCode"]; ?></span>

                        <p><?php echo character_limit($results["itemName"], 20); ?></p>

                    </div>

                </a>    

                <?php

                }

                ?>

            </div>

        </div>



<div class="RightSideBar">

   <span id="close">Close</span>

    <div class="FullItem">

      <div class="tabs-left">

        <ul class="nav nav-tabs">          

            <?php

            $get_all_item_category = $obj->get_all_item_category();

            $cat_array = array();

            $index = 1;

            while ( $category = mysql_fetch_array($get_all_item_category)){

                array_push($cat_array, $category['CategoryID']);

            ?>

            <li  <?php if($index==1){ echo 'class="active"';} ?>>

                <a href="#cat_tab_<?php echo $category['CategoryID']; ?>" data-toggle="tab">

                    <?php echo $category['CategoryName']; ?>

                </a>

            </li>

            <?php

            $index++;

            }

            ?>

         <!--  <li><a href="#d" data-toggle="tab">SODA</a></li>

          <li><a href="#e" data-toggle="tab">DESERT</a></li>   -->        

        </ul>

        <div class="tab-content">

            <?php

            foreach ($cat_array as $key => $value) {                            

            ?>

                <div class="tab-pane <?php if($key==0){ echo 'active';} ?>" id="cat_tab_<?php echo $value; ?>">

                    <div class="Frequentyorder itemFulllist">

                        <?php

                        $get_items_by_category = $obj->get_items_by_category($value);

                        while ($items_list = mysql_fetch_array($get_items_by_category)) {

                        ?>

                        <a href="#" onclick="add_to_cart_item('<?php echo $items_list["itemID"]; ?>','slide_panel')">

                        <div class="ItemList">

                            <span><?php echo $items_list['itemCode']; ?></span>

                            <p><?php echo character_limit($items_list["itemName"], 20); ?></p>

                        </div>

                        </a>

                        <?php

                        }

                        ?>

                    </div>

                </div>

            <?php                

            }

            ?>       

        </div><!-- /tab-content -->

      </div><!-- /tabbable -->   

    </div>

</div>









    </div>

    <?php

    }

    ?>

</div>

<?php

include("ajax_request.php");

include("include/footer.php");

?>
<script>

        $(document).ready(function(){

    $('#SidebarToggle').click(function(){

    var hidden = $('.RightSideBar');

    if (hidden.hasClass('visible')){


        hidden.animate({"right":"-310px"}, "slow").removeClass('visible');

    } else {

        hidden.animate({"right":"0px"}, "slow").addClass('visible');

    }

    });

});

        </script>

        

         <script>

        $(document).ready(function(){

    $('#close').click(function(){

    var hidden = $('.RightSideBar');

    if (hidden.hasClass('visible')){

        hidden.animate({"right":"-310px"}, "slow").removeClass('visible');

    } else {

        hidden.animate({"right":"0px"}, "slow").addClass('visible');

    }

    });

});
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);





</script>
<!-- Modal -->
<div id="item_addons_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="modal_body">

    

  </div>
</div>
<div id="discount_modal" class="modal fade" role="dialog">
  <div class="modal-dialog discount_modal_body" id="modal_body">

    

  </div>
</div>