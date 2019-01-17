
function saveTableLayout(tableNumber,type){

    var tableLayout=document.getElementById('table'+tableNumber);
    var position=$(tableLayout).position();
    var parentWidth=$('#tableArea').width();
    var x=position.left/parentWidth;
    var y=position.top/parentWidth;
    var width=$(tableLayout).outerWidth()/parentWidth;
    var height=$(tableLayout).outerHeight()/parentWidth;
    var occupied=$(document.getElementById('tableLabel'+tableNumber)).val();
    var maxguest=$(document.getElementById('showMaxguest'+tableNumber)).val();

    maxguest=maxguest.replace('(','');
    maxguest=maxguest.replace(')','');
    console.log(maxguest);
    var data={'operationType':'saveTableLayout',
        'tableNumber':tableNumber,
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
    tableNumber--;
    var data={'operationType':'removeTableLayout',
        'tableNumber':tableNumber1};
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
    $("#tableArea").empty();
    var data = {'operationType': 'drawTable'};
    data = JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "../SMS_Module/classes/TableLayout.php",
        data: "data=" + data,
        async: false,
        success: function (result) {
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
            var preTableNumber=0;
            var type=0;
            for (var i=0;i<n;i++){
                tableNumber1=parseInt(table[i]['tableNumber']);
                var tableLayoutX=0;
                var tableLayoutY=0;
                var tableLayout='';
                if (tableNumber1-preTableNumber>1){
                    tableNumber1=preTableNumber+1;
                }
                preTableNumber=tableNumber1;
                type=parseInt(table[i]['type']);
                tableTypeArray[tableNumber1]=type;

                //Create Table Layout
                tableLayout=document.createElement('div');
                tableLayout.className='ui-widget-content tableLayout';
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
                    $(tableLayout).css('border-radius',table[i]['width']*parentWidth/2);
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
                $(showMaxguest).blur(function () {
                    var id=this.id;
                    var tableNumber1=id.replace('showMaxguest','');
                    var tableType=tableTypeArray[parseInt(tableNumber1)];
                    saveTableLayout(tableNumber1,tableType);
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

                $('#tableArea').append(label);
                // $(label).click(function () {
                //     var id=this.id;
                //     var tableNumber1=id.replace('tableLabel','');
                //     var type=tableTypeArray[parseInt(tableNumber1)];
                //     var text=$(this).val();
                //     if (text=='Open'){
                //         $(this).val('Used');
                //     }
                //     else
                //         $(this).val('Open');
                //     saveTableLayout(tableNumber1,type);
                // });

                $(tableLayout).draggable({
                    drag:function () {
                        scrollX=window.pageXOffset;
                        scrollY=window.pageYOffset;
                        parentX=$("#tableArea").offset().left;
                        var offset=$(this).offset();
                        var xpos=offset.left;
                        var ypos=offset.top;
                        var number=$(this.getElementsByTagName('h6')).text();
                        var tableLabel=document.getElementById('tableLabel'+number);
                        $(tableLabel).css('left',xpos-parentX+$(this).width()+0);
                        $(tableLabel).css('top',ypos-parentY+$(this).height()/2);
                        // if (parentX>=xpos || xpos+$(this).width()>=parentRight || parentY>=ypos || ypos+$(this).height()>=parentBottom){
                        //     removeTableLayout(number);
                        //     $(this).remove();
                        //     $(tableLabel).remove();
                        // }
                    },
                    stop:function () {
                        var tableNumber1=$(this.getElementsByTagName('h6')).text();
                        var type=tableTypeArray[parseInt(tableNumber1)];
                        saveTableLayout(tableNumber1,type);
                    }
                });

                $( tableLayout ).contextmenu(function(e) {
                    var tableNumber1=$(this.getElementsByTagName('h6')).text();
                    $(this).remove();
                    var tableLabel=document.getElementById('tableLabel'+tableNumber1);
                    $(tableLabel).remove();
                    removeTableLayout(tableNumber1);
                    e.preventDefault();
                });

                $(tableLayout).resizable({
                    resize:function (e,ui) {
                        scrollX=window.pageXOffset;
                        scrollY=window.pageYOffset;
                        var number=$(this.getElementsByTagName('h6')).text();
                        var tableLabel=document.getElementById('tableLabel'+number);
                        var type=tableTypeArray[parseInt(number)];
                        var offset=$(this).offset();
                        var xpos=offset.left;
                        var ypos=offset.top;
                        if (type==2){
                            $(this).css('width',(ui.size.height+ui.size.width)/2);
                            $(this).css('height',(ui.size.height+ui.size.width)/2);
                            $(this).css('border-radius',(ui.size.height+ui.size.width)/4);
                        }
                        $(tableLabel).css('left',xpos-parentX+$(this).width()+0);
                        $(tableLabel).css('top',ypos-parentY+$(this).height()/2);
                    },
                    stop:function () {
                        var tableNumber1=$(this.getElementsByTagName('h6')).text();
                        var type=tableTypeArray[parseInt(tableNumber1)];
                        saveTableLayout(tableNumber1,type);
                    }
                });
            }

        }
    })
}

