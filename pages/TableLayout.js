
function saveTableLayout(tableNumber,state){
    var tableLayout=document.getElementById('table'+tableNumber);
    var occupied=$(document.getElementById('tableLabel'+tableNumber)).val();
    console.log(state);
    var data={'OperationType':'saveTableLayout',
        'tableNumber':tableNumber,'occupied':state};
    data=JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "pages/tableOperation.php",
        data:"data=" + data,
        success: function(result) {
            // console.log(result);
        },
        error:function (e) {
            console.log(e);
        }
    });
}





function drawTableLayout() {
    var OccupiedTable=[];
    var k=0;
    $("#tableArea").empty();
    var data = {'OperationType': 'drawTable'};
    data = JSON.stringify(data);
    $.ajax({
        type: 'POST',
        url: "tableOperation.php",
        data: "data=" + data,
        // async: false,
        success: function (result) {
            var tabelNumber1;
            var ObjectLayoutNumber1;
            var result = JSON.parse(result);
            var Layout = result['objectLayout'];
            console.log(Layout);
            var table = result['table'];
            // var parentWidth = $('#tableArea').width();
            var parentWidth = 100;
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
                // $(ObjectLayout).css('width', Layout[i]['width'] * parentWidth);
                // $(ObjectLayout).css('height', Layout[i]['height'] * parentWidth);
                $(ObjectLayout).css('width', 200);
                $(ObjectLayout).css('height', 200);

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
                    if (!checkIfOccupied(tableNumber1,OccupiedTable)){
                        var action=confirm("Will you select this table");
                        if (action){
                            var state='';
                            if (occupied=='Open'){
                                state='Used';
                                $(this).css('background','#ff3333');
                                new_order(tableNumber1);
                            }
                            else{
                                state='Open';
                                $(this).css('background','green');
                            }
                            $(tableLabel).val(state);
                            saveTableLayout(tableNumber1,state);
                        }
                    }
                    else{
                        alert("This table is already occupied");
                    }

                })
            }
            console.log(OccupiedTable);
        }
    })
}

function checkIfOccupied(k,occupiedTable) {
    for(var i=0;i<occupiedTable.length;i++){
        if(parseInt(k)==occupiedTable[i]){
            return true;
        }
    }
    return false;
}