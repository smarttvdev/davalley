<?php

require_once("mysqli.php");
require_once("sql.class.php");
require_once("config.php");


$data= json_decode($_POST['data'],true);
$operationType=$data['operationType'];
switch($operationType) {
    case 'saveTableLayout':
        saveTableLayout($data);
        break;
    case 'removeTableLayout':
        removeTableLayout($data);
        break;
    case 'drawTable':
        $tables=drawTableLayout($data);
        print_r($tables);
        break;
    case 'changeOccupiedState':
        changeOccupiedState($data);
        break;
    case 'saveObjectLayout':
        saveObjectLayout($data);
        break;
    case 'removeObjectLayout':
        removeObjectLayout($data);
        break;

}


function saveTableLayout($data) {
    global $mysqli;
    $query = "SELECT * FROM tableLayout WHERE number='".$data['prevNumber']."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if ($num_rows==0){
        $sql = "INSERT INTO `tableLayout` (number, x, y, width, height, type, maxguest, occupied) 
            VALUES ('".$data['tableNumber']."','".$data['x']."','".$data['y']."','".$data['width']."','".$data['height']."','".$data['type']."','".$data['maxguest']."','".$data['occupied']."')";
    }
    else{
        $sql="update tableLayout set x='".$data['x']."', y='".$data['y'] ."', width='".$data['width']."', height='".$data['height']."', type='".$data['type']."', maxguest='".$data['maxguest']."', occupied='".$data['occupied']."', number='".$data['tableNumber']."'  where number='".$data['prevNumber']."'";
    }
    echo $sql;
    $mysqli->query($sql);
}

function removeTableLayout($data){
    global $mysqli;
    $sql = "DELETE FROM tableLayout WHERE number="."'".$data['tableNumber']."'";
    $mysqli->query($sql);
}


function changeOccupiedState($data) {
    global $mysqli;
    $query = "SELECT * FROM tableLayout WHERE number='".$data['tableNumber']."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if ($num_rows!=0){
        $sql="update tableLayout set occupied='".$data['occupied']."'  where number='".$data['tableNumber']."'";
    }
    echo $sql;
    $mysqli->query($sql);
}


function removeObjectLayout($data){
    global $mysqli;
    $sql = "DELETE FROM objectLayout WHERE number="."'".$data['objectLayoutNumber']."'";
    $mysqli->query($sql);
}





function drawTableLayout() {
    global $mysqli;
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


function saveObjectLayout($data) {
    global $mysqli;
    $query = "SELECT * FROM objectLayout WHERE number='".$data['number']."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if ($num_rows==0){
        $sql = "INSERT INTO `objectLayout` (number, x, y, width, height,label) 
            VALUES ('".$data['number']."','".$data['x']."','".$data['y']."','".$data['width']."','".$data['height']."','".$data['objectLabel']."')";
    }
    else{
        $sql="update objectLayout set x='".$data['x']."', y='".$data['y'] ."', width='".$data['width']."', height='".$data['height']."', label='".$data['objectLabel']."' where number='".$data['number']."'";
    }
    echo $sql;
//    echo 'object Number='.$data['number'];
//    echo '<br>'.$num_rows;
    $mysqli->query($sql);
}

