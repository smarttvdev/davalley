var OrderID = 0;
var API = "CartAPI.php";
var App = {
   Config: {
      splashScreenDuration: 2000,
      pagesViaAjax: true,
      OrderID: 0
   },
   init: function() {
      $("body").css({"scrollTop": 0});
      MBP.hideUrlBarOnLoad();
      App.navInit();
      setTimeout(function() {
         $("#splash").fadeOut();
      }, App.Config.splashScreenDuration);
      App.windowLoaded();
   },
   pageInit: function() {
      $("body").scrollTop(0);
      
      $('.flexslider:not(.flexslidered)').addClass("flexslidered").flexslider({
         animation: "slide",
         controlNav: false
       });
      
      //custom checkboxes
      $('.on-off:not(.iphoneStyled)').addClass("iphoneStyled").iphoneStyle();
      
      //initialize photoswipe for portfolio page
      if ($(".pictures a:not(.photoSwiped)").length) //dont run if already ran before
         $(".pictures a:not(.photoSwiped)").addClass("photoSwiped").photoSwipe({});
       //initialize photoswipe for menu page
       if ($(".menu a:not(.photoSwiped)").length) //dont run if already ran before
           $(".menu a:not(.photoSwiped)").addClass("photoSwiped").photoSwipe({});
   
     $(".pagination a").click(function() {	    		
      
            if (!$(this).hasClass("current")) {
               var me = this;
               App.Util.activateMenu(me);
               App.Util.showLoading(function() { //once loading graphic is shown, do ajax request to get page
               //alert($(me).attr("href").replace("#", ""));
                  $.ajax({
                     url: $(me).attr("href").replace("#", ""),
                     success: function(r) {
                        $(".page").html(r);
                        App.Util.doneLoading(App.pageInit);
                     }
                  })
               });

           }
            $(window).bind("hashchange", App.processHash);
            return false;
         });
         
	$("#checkoutbtn").unbind().click(function(e) {
		//e.preventDefault();

		$.getJSON( API + "?action=checkPhone", function( data ) {
			if(data.success) {
				var phone_filtered = data.success.phone;
				$('input[name=x_cust_id]').val(phone_filtered);
				$( "#checkOutSubmit" ).submit();
			}
			else {
				var phone = prompt("Enter contact phone number :\ni.e. 1 234 567 8901");
				if(phone==null || phone==''){
				phone='9999';
				}
				if(phone!=null && phone!='') {
					// Set up Phone Number
					var phone_filtered = phone.replace(' ','');
					phone_filtered = phone_filtered.replace('+','');
					$.getJSON( API + "?action=setPhone&phone=" + phone, function( data ) {
						if(data.error) {
							alert('Please write a valid phone number');
						} else {
							$('input[name=x_cust_id]').val(phone_filtered);
							$( "#checkOutSubmit" ).submit();
						}
					});
				}
			}
		});
	});


//Print text receipt
$('#printbtn').click(function(){
    //alert('want text version also?');
    

});



$("#categoryChange").change(function() {
  var myselect = document.getElementById("categoryChange");
               App.Util.showLoading(function() { //once loading graphic is shown, do ajax request to get page
              
                  $.ajax({
                     url: "pages/menu.php?page=1&cat=" + myselect.options[myselect.selectedIndex].value,
                     success: function(r) {
                        $(".page").html(r);
                        App.Util.doneLoading(App.pageInit);
                     }
                  })
               });
    //$(window).bind("hashchange", App.processHash);
    return false;
    });         
         
      //initialize sharethis for new loaded content, if any
      // stButtons.locateElements();
      
      //bind form validations
      App.Forms.bind();
   },
   navInit: function() {
      
      //if nav-items are more than default (5), resize width to fit:
      $(".navigation a").css({width: ((100 / $(".navigation a").length) + 7) + "%"});
      
      if (App.Config.pagesViaAjax) {
         $(".navigation a").click(function() {   
         
           // console.log("page move");
           
          // removeInvoice(); 
                

			          
                var me = this;
                App.Util.activateMenu(me);
                App.Util.showLoading(function() { //once loading graphic is shown, do ajax request to get page
              
                  $.ajax({
                     url: $(me).attr("href").replace("#", ""),
                     success: function(r) {
                        $(".page").html(r);
                        App.Util.doneLoading(App.pageInit);
                     }
                  });
               });               
            
          
            return false;
         });
// paginare
         $(".paginate").click(function() {
      
            //if (!$(this).hasClass("current")) {
               var me = this;
               App.Util.activateMenu(me);
               App.Util.showLoading(function() { //once loading graphic is shown, do ajax request to get page
               //alert($(me).attr("href").replace("#", ""));
                  $.ajax({
                     url: $(me).attr("href").replace("#", ""),
                     success: function(r) {
                        $(".page").html(r);
                        App.Util.doneLoading(App.pageInit);
                     }
                  });
               });
               
//            }
            $(window).bind("hashchange", App.processHash);
            return false;
         });

      }

      
      
      $("#menu-trigger").click(function() {         
         
         if ($("header, #header").is(":visible")) {
            $("header, #header").slideUp();
            $("body").animate({paddingTop: 0});
         } else {
            $("header, #header").slideDown();
            $("body").animate({paddingTop: 50});
         }
      });
   },
   processHash: function() {

      var hash = window.location.hash;

      $(hash).click();
   },
   windowLoaded: function() {
      var hash = window.location.hash;
      
      if (hash && $(hash).length) {
         App.processHash();
        // alert("i am hash");
      } else {
         $(".navigation a:first").click();         
         setTimeout(function() {
            $("#splash").hide();
         }, App.Config.splashScreenDuration);
         
      }
   },
   Util: {
      showLoading: function(callback) {
         $(".page").slideUp(callback);
         $(".page-loader").slideDown();
      },
      doneLoading: function(callback) {
         $(".page-loader").slideUp();
         $(".page").slideDown(callback);
      },
      activateMenu: function(el) {
         $(document).ready(function() {
            $(".navigation .active").removeClass("active");
            $(el).addClass("active");
            window.location.hash = ($(el).attr("id") != undefined ? $(el).attr("id") : "");
         });
      }
   },
   Forms: {
      bind: function() {
         // Add required class to inputs
         $(':input[required]').addClass('required');
         
         // Block submit if there are invalid classes found
         $('#form:not(.html5enhanced)').addClass("html5enhanced").submit(function() {
               var formEl = this;
                 $('input,textarea').each(function() {
                         App.Forms.validate(this);
                 });
                 
                 if(($(this).find(".invalid").length) == 0){
                         // Delete all placeholder text
                         $('input,textarea').each(function() {
                                 if($(this).val() == $(this).attr('placeholder')) $(this).val('');
                         });
                         
                         //now submit form via ajax
                         $.ajax({
                           url: $(formEl).attr("action"),
                           type: $(formEl).attr("method"),
                           data: $(formEl).serialize(),
                           success: function(r) {
                              if (r) {
                                 $(".success-message").slideDown().removeClass("hidden");
                              }
                           }
                         })
                         return false;
                 }else{
                         return false;
                 }
         });

      },
      is_email: function(value){
	return (/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/).test(value);
      },
      is_url: function(value){
              return (/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i).test(value);
      },
      is_number: function(value){
              return (typeof(value) === 'number' || typeof(value) === 'string') && value !== '' && !isNaN(value);
      },
      validate: function(element) {
         var $$ = $(element);
         var validator = element.getAttribute('type'); // Using pure javascript because jQuery always returns text in none HTML5 browsers
         var valid = true;
         var apply_class_to = $$;
         
         var required = element.getAttribute('required') == null ? false : true;
         switch(validator){
                 case 'email': valid = App.Forms.is_email($$.val()); break;
                 case 'url': valid = App.Forms.is_url($$.val()); break;
                 case 'number': valid = App.Forms.is_number($$.val()); break;
         }
         
         // Extra required validation
         if(valid && required && $$.val().replace($$.attr('placeholder'), '') == ''){
                 valid = false;
         }
         
         // Set input to valid of invalid
         if(valid || (!required && $$.val() == '')){
                 apply_class_to.removeClass('invalid');
                 apply_class_to.addClass('valid');
                 return true;
         }else{
                 apply_class_to.removeClass('valid');
                 apply_class_to.addClass('invalid');
                 return false;
         }
      }

   }
} // end of App variable.

function ShowMenuDefault() {
	$("header, #header").slideDown();
    $("body").animate({paddingTop: 50});
	
}
$(document).on("click", ".AddToCart", function() {
   var id = $(this).data('id');
    var name = $(this).data('name');
    var sideOrderCat = $(this).data('sideordercat');
    if(sideOrderCat == 0) {
        addToCart(id, name, null);
    } else {
        SideOrder(id, name);
    }

});

/**
 * Limit Checkboxes
 */
var sideOrderLimit = 0;
$(document).on("click", 'input[type="checkbox"][name="sideOrder"]', function() {
    $("#sideorder-dialog p").hide();
    if(sideOrderLimit > 0)
        var bol = $("input[type=checkbox][name=sideOrder]:checked").length >= sideOrderLimit;
        $("input[type=checkbox][name=sideOrder]").not(":checked").attr("disabled", bol);

    //if(bol) {
            //$("#sideorder-dialog p").html("You reached maximum limit").css('color', 'red').show();
    //    } else {
            //$("#sideorder-dialog p").hide();
    //    }

});
/**
 *
 * @param id
 * @param name
 * @constructor
 */
function SideOrder(id, name) {
     var $SideOrderDialog = $("#sideorder-dialog");
    var $form = $("#sideorder-dialog form#sideOrders");
    $form.html('<img src="images/general-loader.gif" />');
    $SideOrderDialog.dialog({
        autoOpen: false,
        height: 300,
        width: 320,
        modal: true,
        open: function (event, ui) {
            $("#sideorder-dialog p").hide();
            $.getJSON(API + "?action=getSideOrder&id=" + id, function (data) {
                sideOrderLimit = data.sideOrderLimit;
                $SideOrderDialog.dialog('option', 'title', "Select " + sideOrderLimit + " side order(s)");
                $form.html('');
                var list = $('<ul/>').appendTo($form);
                $.each(data.list, function(k,v) {
                    var $input = $('<li><label><input type="checkbox" name="sideOrder" id="checkbox-' + k + '" style="min-height:40px;min-width:40px;vertical-align:middle;" value="'+ v.id +'" /> '+ v.name +'</label></li>');
                    list.append($input);
                });

            });
        },
        buttons: {
            Cancel: function () {
                $(this).dialog("close");
                $("body").unbind("click");
            },
            Select: function () {
                var checkedValues = $form.find('input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                addToCart(id, name, checkedValues.join(','));
                $SideOrderDialog.dialog("close");
            }
        }
    });
	$SideOrderDialog.dialog("open");
}


$(document).on("click", ".updateCartQtyMinus", function() {
	var id = $(this).data('id');
	
	$.getJSON( API + "?action=updateCartQuantityMiuns&id=" + id, function( data ) {
		if(data.success) {
			updateCount();
			alert(data.success.msg);
			App.Util.showLoading(function()
        { 
              
            $.ajax({
               url:  "pages/myorders.php",
               success: function(r)
                {
                  $(".page").html(r);
                  App.Util.doneLoading(App.pageInit);
               }
            });
        }); 
		}
	});
});


$(document).on("click", ".updateCartQtyPlus", function() {
	var id = $(this).data('id');
	
	$.getJSON( API + "?action=updateCartQuantityPlus&id=" + id, function( data ) {
		if(data.success)
     {
			 updateCount();
			 alert(data.success.msg);
			 App.Util.showLoading(function()
        { 
              
            $.ajax({
               url:  "pages/myorders.php",
               success: function(r)
                {
                  $(".page").html(r);
                  App.Util.doneLoading(App.pageInit);
               }
            });
        });         
		}
	});
});

$(document).on("click", "#btnUpdateTip", function() {
	var $AddToCartDialog = $("#tips-dialog");
    $AddToCartDialog.dialog({
        autoOpen: false,
        height: 200,
        width: 320,
        modal: true,
        open: function(event, ui) {
            $("#cookWith").val('');
            $("#cookWith").focus();
            $("body").click(function() {
                $('#cookWith').focus();
            });
        },
        buttons: {
			 Cancel: function() {
                $(this).dialog("close");
                $("body").unbind("click");
            },
            OK: function() {
                var tip = $("input[name='rdTip']:checked").val();

				if(tip == 0) {
					if($.trim($('#txtTipAmount').val()) == "") {
						alert("Please enter an amount");
					} else if(isNaN($.trim($('#txtTipAmount').val()))) {
						alert("Please enter only numeric value");
					} else {
						$.getJSON( API + "?action=updateTip&tip="+ tip + "&tipAmount=" + $.trim($('#txtTipAmount').val()), function( data ) {
							if(data.success) {
								updateCount();
								App.Util.showLoading(function()
                     { 
              
                      $.ajax({
                         url:  "pages/myorders.php",
                         success: function(r)
                          {
                            $(".page").html(r);
                            App.Util.doneLoading(App.pageInit);
                         }
                     });
                 }); 
							}
						});
					}
				} else {
					$("#txtTipAmount").attr("disabled", "disabled"); 
					$.getJSON( API + "?action=updateTip&tip="+ tip + "&tipAmount=" + $.trim($('#txtTipAmount').val()), function( data ) {
						if(data.success) {
							updateCount();
              $AddToCartDialog.dialog("close");
							App.Util.showLoading(function()
                { 
              
                    $.ajax({
                       url:  "pages/myorders.php",
                       success: function(r)
                        {
                          $(".page").html(r);
                          App.Util.doneLoading(App.pageInit);
                       }
                    });
               }); 
						}
					});
				}
            }
        }
    });
    $AddToCartDialog.dialog('option', 'title', "Tip");
    $AddToCartDialog.dialog("open");
});

function addToCart(id,name,sideOrders) {
	var $AddToCartDialog = $("#addtocart-dialog");
    $AddToCartDialog.dialog({
        autoOpen: false,
        height: 200,
        width: 320,
        modal: true,
        open: function(event, ui) {
            $("#cookWith").val('');
            $("#cookWith").focus();
            $("body").click(function() {
                $('#cookWith').focus();
            });
        },
        buttons: {
            Cancel: function() {
                $(this).dialog("close");
                $("body").unbind("click");
            },
            Add: function() {
                  var k  = document.getElementById("cookWith").value;
                 console.log($(this).children("textarea").val());
                 k = $(this).children("textarea").val();
               
                    var paramsUrl = API + "?action=add&id=" + id + "&cookWith=" + k;
                    if(sideOrders != null)  paramsUrl += "&sideOrder=" + sideOrders;
                    $.getJSON(paramsUrl, function (data) {
                        if (data.error) {
                            alert(data.error.msg);
                        } else {
                            alert(data.success.msg);
                            updateCount();
                            $AddToCartDialog.dialog("close");
                        }

                    });
                
            }
        }
    });
    $AddToCartDialog.dialog('option', 'title', id + ". "+name);
    $AddToCartDialog.dialog("open");
}
 
 

/**
* Enter Table # --Tai's hand;
*/
$(document).on("click" , '#EnterTableBtn', function(){
    //alert("please enter a table.");
    openEnterTable('','','');
});



var selectedTable='0';
function openEnterTable(id,name,sideOrders) {
    var $AddToCartDialog = $("#entertable-dialog");

    $AddToCartDialog.dialog({
        autoOpen: false,
        height: 440,
        width: 340,
        modal: true,
        open: function (event, ui) {
            var OccupiedTable=[];
            var k=0;
            $("#tableArea").empty();
            var data = {'OperationType': 'drawTable'};
            data = JSON.stringify(data);
            $.ajax({
                type: 'POST',
                url: "pages/tableOperation.php",
                data: "data=" + data,
                async: false,
                success: function (result) {
                    var tabelNumber1;
                    var ObjectLayoutNumber1;
                    var result = JSON.parse(result);
                    var Layout = result['objectLayout'];
                    var table = result['table'];
                    // var parentWidth = $('#tableArea').width();
                    var parentWidth = 300;

                    var scrollX = 0;
                    var scrollY = 0;
                    var parentX = $("#tableArea").offset().left;
                    var parentY = $('#tableArea').offset().top;

                    var n = table.length;
                    var n1 = Layout.length;

                    //Draw Object Layout
                    for (var i = 0; i < n1; i++) {
                        var ObjectLayout;
                        var objectLayoutX;
                        var objectLayoutY;
                        ObjectLayoutNumber1 = Layout[i]['number'];
                        ObjectLayout = document.createElement('div');
                        ObjectLayout.className = 'ObjectLayout';
                        ObjectLayout.id = 'ObjectLayout' + ObjectLayoutNumber1;
                        $('#tableArea').append(ObjectLayout);
                        objectLayoutX = parseInt(Layout[i]['x'] * parentWidth);
                        objectLayoutY = parseInt(Layout[i]['y'] * parentWidth);
                        $(ObjectLayout).css('left', objectLayoutX);
                        $(ObjectLayout).css('top', objectLayoutY);
                        $(ObjectLayout).css('width', Layout[i]['width'] * parentWidth);
                        $(ObjectLayout).css('height', Layout[i]['height'] * parentWidth);

                        var LayoutObjectLabel=document.createElement('input');
                        LayoutObjectLabel.className='LayoutObjectLabel';
                        LayoutObjectLabel.setAttribute('type','text');
                        LayoutObjectLabel.id='LayoutObjectLabel'+ObjectLayoutNumber1.toString();
                        var labelWidth=Layout[i]['label'].length;
                        if (labelWidth>8){
                            LayoutObjectLabel.style.width=labelWidth+'ch';
                            $(LayoutObjectLabel).css('border','none');
                        }
                        if (labelWidth>0){
                            $(LayoutObjectLabel).css('border','none');
                        }
                        $(LayoutObjectLabel).val(Layout[i]['label']);
                        $(ObjectLayout).append(LayoutObjectLabel);
                    }

                    //Draw Table Layout

                    var type=0;
                    for (var i=0;i<n;i++){
                        tableNumber1=parseInt(table[i]['tableNumber']);
                        var tableLayoutX=0;
                        var tableLayoutY=0;
                        var tableLayout='';
                        type=parseInt(table[i]['type']);


                        //Create Table Layout
                        tableLayout=document.createElement('div');
                        tableLayout.className='tableLayout';
                        tableLayout.id='table'+tableNumber1.toString();
                        $(tableLayout).css('position','absolute');
                        $('#tableArea').append(tableLayout);
                        scrollX=window.pageXOffset;
                        scrollY=window.pageYOffset;
                        tableLayoutX=parseInt(table[i]['x']*parentWidth);
                        tableLayoutY=parseInt(table[i]['y']*parentWidth);
                        $(tableLayout).css('left',tableLayoutX);
                        $(tableLayout).css('top',tableLayoutY);
                        if (type==1){
                            $(tableLayout).css('width',table[i]['width']*parentWidth);
                            $(tableLayout).css('height',table[i]['height']*parentWidth);
                        }
                        else{
                            $(tableLayout).css('width',table[i]['width']*parentWidth);
                            $(tableLayout).css('height',table[i]['width']*parentWidth);
                            $(tableLayout).css('border-radius',table[i]['width']*parentWidth);
                        }

                        //Show Table Number
                        var displayTableNumber=document.createElement('h6');
                        displayTableNumber.className='displayTableNumber';
                        displayTableNumber.id='displayTableNumber'+tableNumber1.toString();
                        $(displayTableNumber).text(tableNumber1.toString())
                        $(tableLayout).append(displayTableNumber);

                        //Show Maximum Guest
                        var showMaxguest=document.createElement('input');
                        showMaxguest.setAttribute("type", "text");
                        showMaxguest.className='showMaxguest';
                        showMaxguest.id='showMaxguest'+tableNumber1.toString();
                        $(showMaxguest).val('('+table[i]['maxguest']+')');
                        $(tableLayout).append(showMaxguest);

                        //Show Used State
                        var label=document.createElement('input');
                        label.id='tableLabel'+tableNumber1;
                        label.className='tableLabel';
                        label.setAttribute("type", "text");
                        $(label).val(table[i]['occupied']);
                        $(label).css('left',tableLayoutX+$(tableLayout).width()+0);
                        $(label).css('top',tableLayoutY+$(tableLayout).height()/2);
                        $(label).css('position','absolute');
                        $(label).attr("readonly", true);
                        $(tableLayout).append(label);
                        if (table[i]['occupied']=='Open'){
                            if (tableNumber1==selectedTable){   //This means this table selected already
                                $(tableLayout).css('background','#00e600');
                            }
                            else
                                $(tableLayout).css('background','green');
                        }
                        if (table[i]['occupied']=='Used'){
                            $(tableLayout).css('background','red');
                            OccupiedTable[k]=i+1;
                            k++;
                        }
                        $(tableLayout).click(function () {
                            var tableNumber1=$(this.getElementsByTagName('h6')).text();
                            var tableLabel=$(document.getElementById('tableLabel'+tableNumber1));
                            var occupied=$(tableLabel).val();
                            // if (!checkIfOccupied(tableNumber1,OccupiedTable)){
                            //     console.log(selectedTable);
                            //     if (selectedTable!='0'){
                            //         var alreadySelectedTable=document.getElementById('table'+selectedTable);
                            //         $(alreadySelectedTable).css('background','green');
                            //     }
                            //     $(this).css('background','red');
                            if (selectedTable!=tableNumber1 && selectedTable!=0){
                                var occupied1=$(document.getElementById('tableLabel'+selectedTable)).val();
                                if (occupied1!='Used')
                                    $('#table'+selectedTable).css('background','green');
                            }
                            selectedTable=tableNumber1;
                            if (occupied!='Used')
                                $(this).css('background','#00e600');
                            // }
                            // else{
                            //     alert("This table is already occupied");
                            // }

                        })
                    }
                }
            })

        },
        buttons: {
            Cancel: function () {
                $(this).dialog("close");
                $("body").unbind("click");
            },
            Ok: function () {
                // saveTableLayout(selectedTable,'Used');
                var paramsUrl = API + "?action=tableSelected&tableNum=" + selectedTable;
                if (selectedTable !== undefined) {
                    $.getJSON(paramsUrl, function (data) {
                        console.log('data=');
                        console.log(data);
                        if (data.error) {
                            alert(data.error.msg);
                        } else {
                            // alert(data.success.msg);
                            alert("You selected table"+selectedTable);
                            $AddToCartDialog.dialog("close");
                        }
                    });
                }
            }

        }
    });
    $AddToCartDialog.dialog('option', 'title',"Select table#");
    $AddToCartDialog.dialog("open");
}

// function openEnterTable(id,name,sideOrders) {
//     var $AddToCartDialog = $("#entertable-dialog");
//     var selectedTable , selectedSelector = '.table-' + selectedTable;
//     $AddToCartDialog.dialog({
//         autoOpen: false,
//         height: 440,
//         width: 320,
//         modal: true,
//         open: function(event, ui) {
// 	        //$(selectedSelector).css('color','#ee1981');
// 	        //$(selectedSelector ).css('border-color' , '#ee1981');
// 	    $('.entertable').click(function(){
// 	       if (selectedTable !== undefined){
// 	           selectedSelector = '.table-' + selectedTable;
// 	           $(selectedSelector).css('color' , '#000');
// 	           $(selectedSelector).css('border-color' , '#000');
// 	        }
// 	    	var currentSelector = '.table-' + $(this).html();
// 	        $(currentSelector ).css('color' , '#ee1981');
// 	        $(currentSelector ).css('border-color' , '#ee1981');
//
// 	    	selectedTable = $(this).html();
// 	    	$('.table-selected').html(selectedTable);
// 	    });
//             $("body").click(function() {
//                 $('#cookWith').focus();
//             });
//         },
//         buttons: {
//             Cancel: function() {
//                 $(this).dialog("close");
//                 $("body").unbind("click");
//             },
//             Ok: function() {
// 		//alert("hi");
//                 var paramsUrl = API + "?action=tableSelected&tableNum=" + selectedTable;
//                 if (selectedTable !== undefined){
//                     $.getJSON(paramsUrl, function (data) {
//                         console.log(data);
//                         if (data.error) {
//                             alert(data.error.msg);
//                         } else {
//                             alert(data.success.msg);
//                             $AddToCartDialog.dialog("close");
//                         }
//
//                     });
//                 }
//             }
//         }
//     });
//     $AddToCartDialog.dialog('option', 'title',"Select table#");
//     $AddToCartDialog.dialog("open");
// }


 
 
function setPhoneDialog() {
	var phone = prompt("Enter contact phone number :\ni.e. 1 234 567 8901");
	
	if(phone!=null && phone!='') {
		// Set up Phone Number
		setPhone(phone);
	} else {
		setPhoneDialog();
	}
}
function setPhone(phone) {
	$.getJSON( API + "?action=setPhone&phone=" + phone, function( data ) {	
		if(data.error) {
			alert('Please enter a valid phone number');
			setPhoneDialog();
		} else {
			$( "#checkOutSubmit" ).submit();
		}
	});
}

function updateCount() {
	$.getJSON( API + "?action=count", function( data ) {
		if(data.success) {
			$("#addedtocart").html(data.success.msg);
		}
	});
}


function removeInvoice(){
	$.getJSON( API + "?action=removeInvoice", function( data ) {
	console.log(data);
});
}


function emptyCart() {
	var result = confirm("Are you sure want to empty cart ?");
	
	if(result) {
		$.getJSON( API + "?action=empty", function( data ) {
			if(data.success.msg == "OK") {
				updateCount();
				//window.location.hash = "menu";
				App.Util.showLoading(function()
        { 
              
            $.ajax({
               url:  "pages/menu.php",
               success: function(r)
                {
                  $(".page").html(r);
                  App.Util.doneLoading(App.pageInit);
               }
            });
        }); 
			}
		});
	}
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
updateCount();
$(document).ready(App.init);

//$(window).load(App.windowLoaded);