
function saveTableLayout(prevNumber,tableNumber){

    var tableLayout=document.getElementById('table'+tableNumber);
    var position=$(tableLayout).position();
    var parentWidth=$('#tableArea').width();
    var x=position.left/parentWidth;
    var y=position.top/parentWidth;
    var width=$(tableLayout).outerWidth()/parentWidth;
    var height=$(tableLayout).outerHeight()/parentWidth;
    var occupied=$(document.getElementById('tableLabel'+tableNumber)).val();
    var maxguest=$(document.getElementById('showMaxguest'+tableNumber)).val();

    var type=1;
    var border_radius=$(tableLayout).css('border-radius');
    if (border_radius!='0px')
        type=2;

    maxguest=maxguest.replace('(','');
    maxguest=maxguest.replace(')','');

    var data={'operationType':'saveTableLayout',
        'tableNumber':tableNumber,
        'prevNumber':prevNumber,
        'x':x,'y':y,'width':width,'height':height,'type':type,'maxguest':maxguest,'occupied':occupied };
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data:"data=" + data,
        success: function(result) {
        },
        error:function (e) {
            console.log(e);
        }
    });
}

function removeTableLayout(tableNumber1){
    var data={'operationType':'removeTableLayout',
        'tableNumber':tableNumber1};
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data:"data=" + data,
        // async:false,
        success: function(result) {

        },
        error:function (e) {
            console.log(e);
        }
    });
}

function removeObjectLayout(objectLayoutNumber){
    ObjectLayoutNumber--;
    var data={'operationType':'removeObjectLayout',
        'objectLayoutNumber':objectLayoutNumber};
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data:"data=" + data,
        // async:false,
        success: function(result) {
            drawTableLayout();
        },
        error:function (e) {
            console.log(e);
        }
    });
}

function saveObjectLayout(objectNumber) {
    var ObjectLayout=document.getElementById('ObjectLayout'+objectNumber);
    var position=$(ObjectLayout).position();
    var parentWidth=$('#tableArea').width();

    var x=position.left/parentWidth;
    var y=position.top/parentWidth;
    var width=$(ObjectLayout).outerWidth()/parentWidth;
    var height=$(ObjectLayout).outerHeight()/parentWidth;
    var ObjectLabel=$(document.getElementById('LayoutObjectLabel'+objectNumber)).val();
    var data={'operationType':'saveObjectLayout',
        'objectNumber':objectNumber,
        'x':x,'y':y,'width':width,'height':height,'objectLabel':ObjectLabel,'number':objectNumber};
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data:"data=" + data,
        success: function(result) {
            console.log(result);
        },
        error:function (e) {
            console.log(e);
        }
    });
}

function drawTableLayout() {
    // $("#tableArea").empty();
    var data = {'operationType': 'drawTable'};
    data = JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data: "data=" + data,
        success: function (result) {
            console.log(result);
            var tabelNumber1;
            var ObjectLayoutNumber1;
            var result = JSON.parse(result);
            var Layout = result['objectLayout'];
            console.log(Layout);
            var table = result['table'];
            var parentWidth = $('#tableArea').width();
            var scrollX = 0;
            var scrollY = 0;
            var parentX = $("#tableArea").offset().left;
            var parentY = $('#tableArea').offset().top;

            var n = table.length;
            tableNumber = n;
            var n1 = Layout.length;
            ObjectLayoutNumber = n1;


            //Draw Object Layout
            for (var i = 0; i < n1; i++) {
                var ObjectLayout;
                var objectLayoutX;
                var objectLayoutY;
                ObjectLayoutNumber1 = Layout[i]['number'];
                ObjectLayout = document.createElement('div');
                ObjectLayout.className = 'ui-widget-content ObjectLayout';
                ObjectLayout.id = 'ObjectLayout' + ObjectLayoutNumber1;
                $('#tableArea').append(ObjectLayout);
                objectLayoutX = parseInt(Layout[i]['x'] * parentWidth);
                objectLayoutY = parseInt(Layout[i]['y'] * parentWidth);
                $(ObjectLayout).css('left', objectLayoutX);
                $(ObjectLayout).css('top', objectLayoutY);
                $(ObjectLayout).css('width', Layout[i]['width'] * parentWidth);
                $(ObjectLayout).css('height', Layout[i]['height'] * parentWidth);
                $(ObjectLayout).draggable({
                    stop: function () {
                        var id = this.id;
                        var objectLayoutNumber = id.replace('ObjectLayout', '');
                        saveObjectLayout(objectLayoutNumber);
                    }
                });
                $(ObjectLayout).draggable("disable");

                $(ObjectLayout).dblclick(function () {
                    // $(this).draggable( 'disable' );
                    // if ($(this).toggleClass('disableDrag'));
                    var isDisabled = $(this).draggable('option', 'disabled');
                    if (isDisabled){
                        $(this).draggable("enable");
                    }
                    else{
                        $(this).draggable("disable");
                    }
                });
                $(ObjectLayout).resizable({
                    stop:function () {
                        var id=this.id;
                        var objectLayoutNumber=id.replace('ObjectLayout','');
                        saveObjectLayout(objectLayoutNumber);
                    }
                });
                $(ObjectLayout).contextmenu(function(e) {
                    var id=this.id;
                    var objectLayoutNumber=id.replace('ObjectLayout','');
                    $(this).remove();
                    removeObjectLayout(objectLayoutNumber);
                    e.preventDefault();
                });
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
                $(LayoutObjectLabel).blur(function () {
                    var text=$(this).val();
                    if (text){
                        $(this).css('border','none');
                    }
                    else
                    {
                        $(this).css('border','1px solid #888888');
                        this.style.width = '8ch';
                    }
                    var id=this.id;
                    var ObjectLayoutNumber=id.replace('LayoutObjectLabel','');
                    saveObjectLayout(ObjectLayoutNumber);
                });
                $(LayoutObjectLabel).keypress(function () {
                    var inputWidth = this.value.length + "ch";
                    if (parseInt(inputWidth)>8){
                        this.style.width = inputWidth;
                    }
                })
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
                tableLayout.className='ui-widget-content tableLayout';
                tableLayout.id='table'+tableNumber1;
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
                    $(tableLayout).css('border-radius',table[i]['width']*parentWidth/2);
                }

                //Show Table Number
                var displayTableNumber=document.createElement('input');
                displayTableNumber.className='displayTableNumber';
                displayTableNumber.id='displayTableNumber'+tableNumber1;
                $(displayTableNumber).val(tableNumber1)
                $(tableLayout).append(displayTableNumber);

                $(displayTableNumber).blur(function(){
                        var prevId=$(this).parent().attr('id');
                        var prevTableNumber=prevId.replace('table','');
                        var tableNumber=$(this).val();
                        $(this).attr('id','displayTableNumber'+tableNumber);
                        $(this).parent().attr('id','table'+tableNumber);
                        $(this).next().attr('id','showMaxguest'+tableNumber);
                        $(this).next().next().attr('id','tableLabel'+tableNumber);
                        saveTableLayout(prevTableNumber,tableNumber);
                    }
                )

                //Show Maximum Guest
                var showMaxguest=document.createElement('input');
                showMaxguest.setAttribute("type", "text");
                showMaxguest.className='showMaxguest';
                showMaxguest.id='showMaxguest'+tableNumber1.toString();
                $(showMaxguest).val('('+table[i]['maxguest']+')');
                $(showMaxguest).blur(function () {
                    var id=$(this).parent().attr('id');
                    var tableNumber=id.replace('table','');
                    saveTableLayout(tableNumber,tableNumber);

                })
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
                if (table[i]['occupied']=='Open'){
                    $(tableLayout).css('background','green');
                }
                if (table[i]['occupied']=='Used'){
                    $(tableLayout).css('background','red');
                }

                $(tableLayout).append(label);


                $(tableLayout).draggable({
                    drag:function () {
                        scrollX=window.pageXOffset;
                        scrollY=window.pageYOffset;
                        parentX=$("#tableArea").offset().left;
                        var offset=$(this).offset();
                        var xpos=offset.left;
                        var ypos=offset.top;
                        var number=$(this.getElementsByTagName('h6')).text();
                        // if (parentX>=xpos || xpos+$(this).width()>=parentRight || parentY>=ypos || ypos+$(this).height()>=parentBottom){
                        //     removeTableLayout(number);
                        //     $(this).remove();
                        //     $(tableLabel).remove();
                        // }
                    },
                    stop:function () {
                        var id=$(this).attr('id');
                        var tableNumber=id.replace('table','');
                        saveTableLayout(tableNumber,tableNumber);
                    }
                });

                $(tableLayout).contextmenu(function (event) {
                    console.log('context-menu');
                    var id=this.id;
                    currentTableNumber=id.replace('table','');
                    var parentX = $("#tableArea").offset().left;
                    var parentY = $('#tableArea').offset().top;
                    event.preventDefault();
                    var id=this.id;
                    $(".obj-menu").finish().toggle(300).
                    css({
                        top: (event.pageY-parentY) + "px",
                        left: (event.pageX-parentX) + "px"
                    });
                });

                $(tableLayout).on("mousedown", function (e) {
                    if (!$(e.target).parents(".context-menu").length > 0) {
                        $(".context-menu").hide(300);
                    }
                });

                $('#tableArea').on("mousedown", function (e) {
                    if (!$(e.target).parents(".context-menu").length > 0) {
                        $(".context-menu").hide(300);
                    }
                });






                $(tableLayout).resizable({
                    resize:function (e,ui) {
                        scrollX=window.pageXOffset;
                        scrollY=window.pageYOffset;
                        var border_radius=$(this).css('border-radius');
                        var offset=$(this).offset();
                        var xpos=offset.left;
                        var ypos=offset.top;
                        if (border_radius!='0px'){
                            $(this).css('width',(ui.size.height+ui.size.width)/2);
                            $(this).css('height',(ui.size.height+ui.size.width)/2);
                            $(this).css('border-radius',(ui.size.height+ui.size.width)/4);
                        }

                    },
                    stop:function () {
                        var id=$(this).attr('id');
                        var number=id.replace('table','');
                        saveTableLayout(number,number);
                    }
                });
            }

        }
    })
}


function changeOccupiedState(tableNumber,currentState){
    var newState;
    if (currentState=='Open')
        newState='Used';
    else
        newState='Open';

    var data={'operationType':'changeOccupiedState',
        'tableNumber':tableNumber,
        'occupied':newState };
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data:"data=" + data,
        success: function(result) {
        },
        error:function (e) {
            console.log(e);
        }
    });


}

$(document).ready(function () {
    $(".obj-menu li").on('click',function() {
        switch ($(this).attr("data-action")) {
            case "Change_State":
                var table=$('#table'+currentTableNumber);
                var currentState=$('#tableLabel'+currentTableNumber).val();
                var newState;

                if (currentState=='Open'){
                    table.css('background','red');
                    newState='Used';

                }
                else{
                    table.css('background','green');
                    newState='Open';

                }
                $('#tableLabel'+currentTableNumber).val(newState);
                changeOccupiedState(currentTableNumber,currentState);

                break;
            case "Remove":
                var table=$('#table'+currentTableNumber);
                table.remove();
                removeTableLayout(currentTableNumber);
                break;
        }
        $(".context-menu").hide(300);
    });

})

