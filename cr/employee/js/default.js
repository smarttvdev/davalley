function quantity_plus(q_id){
  var quantitiy=0;
  var e;
  //get data attr
       // var q_id = $(this).attr('data-field');
        // Stop acting like a button
        //e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity_'+q_id).val());  
        var price =  parseFloat($('#original_item_price_'+q_id).text());  
        // If is not undefined            
            $('#quantity_'+q_id).val(quantity + 1);          
            // Increment        
            $.ajax({
            type: "POST",
            url: "ajax_response.php?update_qty&item_id="+q_id+"&qty="+(quantity + 1),    
            success: function(response){
              $('#total_price').html(response);
              $('#item_total_price_'+q_id).html(((quantity + 1)*price).toFixed(2));
              }
            });
}
function quantity_minus(q_id){
var e;
var quantitiy=0;
// Stop acting like a button
        //e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity_'+q_id).val()); 
        var price =  parseFloat($('#original_item_price_'+q_id).text());       
        // If is not undefined      
            // Increment
            if(quantity>1){
            $('#quantity_'+q_id).val(quantity - 1);
            $.ajax({
            type: "POST",
            url: "ajax_response.php?update_qty&item_id="+q_id+"&qty="+(quantity - 1),    
            success: function(response){
              $('#total_price').html(response);
              $('#item_total_price_'+q_id).html(((quantity - 1)*price).toFixed(2));
              }
            });
            }
}