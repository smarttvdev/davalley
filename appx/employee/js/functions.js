$(document).ready(function () {
    checkEmployee();
    $('#myModal').on('shown.bs.modal', function (e) {
        drawTableLayout();
    })

})

//New Order
    function new_order(table_number){
        if(table_number!=""){
            $.ajax({
                type: "POST",
                url: "ajax_response.php?create_new_order&table_number="+table_number,
                success: function(response){
                    console.log(response);
                    if(response=='1'){
                        window.location.href ="index.php";
                    }
                }
            });
        }else{
            alert("Please Select Table");
        }
    }

//Check if user entered PIN
    function checkEmployee() {
        var data={'OperationType':'checkEmployee'}
        data=JSON.stringify(data);
        var result;
        $.ajax({
            url:'ajaxServer.php',
            method:"POST",
            data:'data='+data,
            async:false,
            success:function(result1) {
                result=result1;
                if (result=='0'){
                    alert('You are not logged in. Please enter pin and log in.');
                    $('#PINcode').show();
                    $( dialog).dialog('open')
                }
            }
        })
    }

    function add_to_cart_item(item_id,panel=''){
        var hidden = $('.RightSideBar');
        if (hidden.hasClass('visible')){
            hidden.animate({"right":"-310px"}, "slow").removeClass('visible');
        }
        $.ajax({
            type: "POST",
            url: "ajax_response.php?add_to_cart_add_ons&id="+item_id+"&panel="+panel,
            success: function(response){
                console.log(response);
                $('#item_addons_modal').modal('show');
                $('#modal_body').html(response);
            }
        });
    }


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

function download(filename, url) {
    var element = document.createElement('a');
    element.setAttribute('href', url);
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}




