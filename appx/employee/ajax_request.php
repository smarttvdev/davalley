<script type="text/javascript">



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

/*Add item to cart*/

/*Add item to cart*/




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