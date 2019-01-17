<?php
    session_start();
    include_once 'config.php';
    $data=json_decode($_POST['data'],true);
    $operationType=$data['OperationType'];
    switch ($operationType){
        case 'checkPinCode':
            $result=checkPinCode($data);
            echo $result;
            break;
        case 'login':
            $result=Login($data);
            echo $result;
            break;
        case 'checkEmployee':
            $result=checkEmployee();
            echo $result;
            break;
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


    function checkPinCode($data){
        global $mysqli;
        $pinCode=$data['pinCode'];
        $result=array();
        $query = "SELECT * FROM employee where pin='".$pinCode."'";
        $query_result = $mysqli->query($query);
        $num_rows = $query_result->num_rows;
        if ($num_rows==0){
            $result['state']=0;
            $result['employee_id']=0;
        }
        else{

            $row1 = $query_result->fetch_array(MYSQLI_ASSOC);
            $user_id=$row1['ID'];
            $time=new DateTime();
            $time=$time->setTime(1,0);
            $today_start_time=$time->format('Y-m-d H:i');
            $result['today_start_time']=$today_start_time;
            $time=$time->setTime(23,59);
            $today_end_time=$time->format('Y-m-d H:i');
            $result['end_time']=$today_end_time;
            $query="SELECT * From usertimesheets where UserID='".$user_id."' and clockInTime between '".$today_start_time."' and '".$today_end_time."'";
            $query_result=$mysqli->query($query);
            $num_rows1=$query_result->num_rows;
            if ($num_rows1==0){
                $result['state']=1;
                $result['employee_id']=0;
                $_SESSION['pinCode']=$pinCode;
            }
            else{
                if(isset($_SESSION['order_id'])){
                    unset($_SESSION['order_id']);
                }
                if (isset($_SESSION['item_id_f_d'])){
                    unset($_SESSION['item_id_f_d']);
                }
                $result['state']=1;
                $result['employee_id']=$user_id;
                $_SESSION['employee_id']=$user_id;
                $_SESSION['pinCode']=$pinCode;
            }
        }
        return json_encode($result);
    }

    function Login($data){
        global $mysqli;
        $username=$data['username'];
        $password=$data['password'];

        $position= strpos($username," ");
        $first_name=substr($username,0,$position);
        $last_name=substr($username,$position+1);

        $query = "SELECT * FROM employee where firstname='".$first_name."' and lastname='".$last_name."' and password='".$password."'";
        $query_result=$mysqli->query($query);
        $num_rows=$query_result->num_rows;
        $row1=array();
        if($num_rows==1){
            if(isset($_SESSION['order_id'])){
                unset($_SESSION['order_id']);
            }
            if (isset($_SESSION['item_id_f_d'])){
                unset($_SESSION['item_id_f_d']);
            }
           $row1 = $query_result->fetch_array(MYSQLI_ASSOC);
           $_SESSION['employee_id']=$row1['ID'];
           $_SESSION['employee_name']=$username;
        }
        $now=(new DateTime())->format('Y-m-d h:i');
        $query="Insert Into usertimesheets(UserID,clockInTime)
                values ('".$row1['ID']."','".$now."')";
        $query_result=$mysqli->query($query);
        return $num_rows;
    }

    function checkEmployee(){
        if (isset($_SESSION['employee_id'])){
            return 1;
        }
        else
            return 0;
    }


function saveTableLayout($data) {
    global $mysqli;
    $sql="update tableLayout set occupied='$data[occupied]'  where number='$data[tableNumber]'";
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

function checkCredentialForDiscount(){
    global $mysqli;
    $employee_id=$_SESSION['employee_id'];
    $query="SELECT credentials FROM employee where ID='$employee_id'";
    $query_result=$mysqli->query($query);
    $num_rows=$query_result->num_rows;
    $credential='';
    if ($num_rows>0){
        $row=$query_result->fetch_array(MYSQLI_ASSOC);
        $credential=$row['credentials'];
    }
    return $credential;
}

