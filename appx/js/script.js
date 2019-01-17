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
			//alert(data);
			if(data.success) {
				var phone_filtered = data.success.phone;
				$('input[name=x_cust_id]').val(phone_filtered);
				$( "#checkOutSubmit" ).submit();	
			}
			else {
				var phone = prompt("Write your phone number where you can be reached:\ni.e. 1 234 567 8901");
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


$("#categoryChange").change(function() {
  var myselect = document.getElementById("categoryChange");
               App.Util.showLoading(function() { //once loading graphic is shown, do ajax request to get page
               //alert($(me).attr("href").replace("#", ""));
                  $.ajax({
                     url: "pages/menu.php?page=1&cat=" + myselect.options[myselect.selectedIndex].value,
                     success: function(r) {
                        $(".page").html(r);
                        App.Util.doneLoading(App.pageInit);
                     }
                  })
               });
    $(window).bind("hashchange", App.processHash);
    return false;
    });         
         
      //initialize sharethis for new loaded content, if any
      stButtons.locateElements();
      
      //bind form validations
      App.Forms.bind();
   },
   navInit: function() {
      
      //if nav-items are more than default (5), resize width to fit:
      $(".navigation a").css({width: ((100 / $(".navigation a").length) + 7) + "%"});
      
      if (App.Config.pagesViaAjax) {
         $(".navigation a").click(function() {
            
			//if (!$(this).hasClass("active")) {				
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
            //}
            $(window).bind("hashchange", App.processHash);
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
                  })
               });
               
//            }
            $(window).bind("hashchange", App.processHash);
            return false;
         });

      }
      
      
      $("#menu-trigger").click(function() {
         //$("body").toggleClass("menu-shown");
         
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
//var hash = "";
//if(hash.indexOf("?")) {
//var __hash = _hash.split("?");
//hash = __hash[0];
//OrderID = __hash[1];
//$.get( "pages/success.php?setOrder=" + __hash[1], function( data ) {});
//} else {
//hash = _hash;
//}

$(hash).click();
   },
   windowLoaded: function() {
var hash = window.location.hash;
//var hash = "";
//if(hash.indexOf("?")) {
//var __hash = _hash.split("?");
//hash = __hash[0];
//OrderID = __hash[1];
//} else {
//hash = _hash;
//}

	//console.log(hash);

      
      if (hash && $(hash).length) {
         App.processHash();
      } else {
         $(".navigation a:first").click();
         //$(".page").slideDown();
         //App.pageInit();
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
			window.location.hash = "myorders";
		}
	});
});


$(document).on("click", ".updateCartQtyPlus", function() {
	var id = $(this).data('id');
	
	$.getJSON( API + "?action=updateCartQuantityPlus&id=" + id, function( data ) {
		if(data.success) {
			updateCount();
			alert(data.success.msg);
			window.location.hash = "myorders";
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
								//alert(data.success.msg);
								window.location.reload(); 
							}
						});
					}
				} else {
					$("#txtTipAmount").attr("disabled", "disabled"); 
					$.getJSON( API + "?action=updateTip&tip="+ tip + "&tipAmount=" + $.trim($('#txtTipAmount').val()), function( data ) {
						if(data.success) {
							updateCount();
							//alert(data.success.msg);
							window.location.reload(); 
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
                if($("#cookWith").val() != null) {
                    var paramsUrl = API + "?action=add&id=" + id + "&cookWith=" + $("#cookWith").val();
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
                } else {
                    return;
                }
            }
        }
    });
    $AddToCartDialog.dialog('option', 'title', id + ". "+name);
    $AddToCartDialog.dialog("open");
}
 
function setPhoneDialog() {
	var phone = prompt("Write your phone number where you can be reached:\ni.e. 1 234 567 8901");
	
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
			alert('Please write a valid phone number');
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

function emptyCart() {
	var result = confirm("Are you sure want to empty cart ?");
	
	if(result) {
		$.getJSON( API + "?action=empty", function( data ) {
			if(data.success.msg == "OK") {
				updateCount();
				window.location.hash = "menu";
			}
		});
	}
}

updateCount();
$(document).ready(App.init);
//$(window).load(App.windowLoaded);