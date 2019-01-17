<?php
session_start();

$data=json_decode($_POST['data'],true);
$operationType=$data['OperationType'];
switch ($operationType){
    case 'saveTableLayout':
        saveTableLayout($data);
        break;

    case 'drawTable':
        $tables=drawTableLayout($data);
        print_r($tables);
        break;
    case 'checkCredentialForDiscount':
        $result=checkCredentialForDiscount();
        echo $result;
//            echo 'success';
        break;
}


function saveTableLayout($data) {
    $mysqli = new mysqli("localhost", "myorders", "Davalley7!", "myorders");
    $sql="update tableLayout set occupied='$data[occupied]'  where number='$data[tableNumber]'";
    $mysqli->query($sql);
}




function drawTableLayout() {
    $mysqli = new mysqli("localhost", "myorders", "Davalley7!", "myorders");
    $Result=Array();
    $table=Array();
    $objectLayout=Array();

    //Getting Table Data
    $query = "SELECT * FROM tableLayout ORDER BY number ASC";
    $result = $mysqli->query($query);
    $i=0;
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $table[$i]['tableNumber']=$row['number'];
        $table[$i]['x']=$row['x'];
        $table[$i]['y']=$row['y'];
        $table[$i]['width']=$row['width'];
        $table[$i]['height']=$row['height'];
        $table[$i]['maxguest']=$row['maxguest'];
        $table[$i]['occupied']=$row['occupied'];
        $table[$i]['type']=$row['type'];
        $i++;
    }

    //Getting Layout Data
    $query = "SELECT * FROM objectLayout ORDER BY number ASC";
    $result = $mysqli->query($query);
    $i=0;
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $objectLayout[$i]['number']=$row['number'];
        $objectLayout[$i]['x']=$row['x'];
        $objectLayout[$i]['y']=$row['y'];
        $objectLayout[$i]['width']=$row['width'];
        $objectLayout[$i]['height']=$row['height'];
        $objectLayout[$i]['label']=$row['label'];
        $i++;
    }
    $Result['table']=$table;
    $Result['objectLayout']=$objectLayout;
    return json_encode($Result);
}

