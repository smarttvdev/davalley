<script type="text/javascript">
/*New Order*/
function new_order(){
  var table_number = $("#table_no_select").val();
  if(table_number!=""){
  $.ajax({
    type: "POST",
    url: "ajax_response.php?create_new_order&table_number="+table_number,    
    success: function(response){
      if(response=='1'){
        window.location.href = "<?php echo base_url(); ?>index.php";
      }
    }
  });
  }else{
    alert("Please Select Table");
  }
}
/*New Order*/

/*add_to cart item addons*/
function add_to_cart_item(item_id,panel=''){
  //alert(panel);
var hidden = $('.RightSideBar');

    if (hidden.hasClass('visible')){

        hidden.animate({"right":"-310px"}, "slow").removeClass('visible');

    } 
  $.ajax({
    type: "POST",
    url: "ajax_response.php?add_to_cart_add_ons&id="+item_id+"&panel="+panel,    
    success: function(response){
      $('#item_addons_modal').modal('show');
      $("#modal_body").html(response);
    }
  });
  
}

/*add_to cart item addons*/

/*Add item to cart*/
function add_to_cart_item_final(item_id,panel=''){
  ////alert();
  var addon_item_form = $("#addon_item_form").serialize();
  $.ajax({
    type: "POST",
    data: addon_item_form,
    url: "ajax_response.php?add_to_cart="+item_id,    
    success: function(response){
      if(response=="exist"){
        $(".close").trigger("click");
        alert("Item Alredy Exist");
      }else{
        //alert(response);
        $('#item_addons_modal').modal('hide');
        $("#order_list_items").append(response);
        $("#discount_footer_btn").attr("data-rel",item_id);
      }
      if(panel!="" && panel=="slide_panel"){
        $("#SidebarToggle").trigger("click");
      }
    }
  });
  /*Total Amount*/
  $.ajax({
    type: "POST",
    url: "ajax_response.php?get_total_for_add_to_cart",    
    success: function(response){  
    $('#total_price').html(response);    
    }
  });
  
}
/*Add item to cart*/
/* Remove Item From order*/
function remove_item_from_order(item_id){
  if(!confirm('Are you sure you want to Delete Item?')){
    return false;
  }else{
    $.ajax({
      type: "POST",
      url: "ajax_response.php?remove_item_from_order&id="+item_id,    
      success: function(response){
        $("#item_row_"+item_id).remove();
        $("#item_row_d_"+item_id).remove();        
        $('#total_price').html(response);
        alert("Item Removed");
      }
    });  
  }  
}
/* Remove Item  From order*/

/*Make First Order*/

function make_first_order(order_id){
  $.ajax({
    type: "POST",
    url: "ajax_response.php?make_first_order&id="+order_id,    
    success: function(response){
      console.log(response);
    }
  });
}


/*Make First Order*/


/*Edit Order*/

function edit_order(){
  if ($("input:radio[name='order_id']").is(":checked")) {
    var order_id = $("input[name='order_id']:checked").val();
    $.ajax({
      type: "POST",
      url: "ajax_response.php?edit_order_from_front&id="+order_id,    
      success: function(response){
        if(response=='1'){
          alert("Order can not be Edited. Because Its Completed Or Canceled");
        }else{
          window.location.href = "<?php echo base_url(); ?>index.php";
        }
      }
    });
  }
  else {
    alert("Please Select Anyone Ticket");
  }
}
/*Edit Order*/




/*Login Processs*/
$(document).ready(function(){
    $("#clockin").click(function(){        
        var info = $('#login_form').serialize();
        $("#Rs-Login").hide();
        $("#rs-loader").show();
        $.ajax({
           type: "POST",
           url: "ajax_response.php?login",
           data: info,
           success: function(response){
            $("#Rs-Login").show();
            $("#rs-loader").hide();
            if(response=='1'){
                window.location.href = "<?php echo base_url(); ?>";
            }else{
                $(".error").show();
            }            
         }
        });
    });

});
</script>