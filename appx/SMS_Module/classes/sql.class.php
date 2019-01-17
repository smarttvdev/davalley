<?php
// SQL Functions
function categoryList() {
global $mysqli;
    $categoryList = array();
    $query = "SELECT * FROM categories ORDER BY OrderID ASC";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $i=0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$categoryList[$i]['id'] = $row['CategoryID'];
	$categoryList[$i]['name'] = $row['CategoryName'];
	$categoryList[$i]['note'] = $row['CategoryNote'];
	$categoryList[$i]['orderID'] = $row['OrderID'];	
	$i++;
	}
	
return $categoryList;
}
function picList() {
global $mysqli;
    $imageList = array();
    $query = "SELECT itemName, itemImage FROM items WHERE itemImage != ''";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $i=0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$imageList[$i]['name'] = $row['itemName'];
	$imageList[$i]['image'] = $row['itemImage'];
	$i++;
	}
	
return $imageList;
}
 
function getPage($phone) {
global $mysqli;
    $query = "SELECT counter FROM `customers` WHERE cPhone='".$phone."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['counter'];
	} else {
	return 0;
	}
}
function GetUniqueID() {
global $mysqli, $CONFIG;
    $query = "SELECT MAX(OrderID) as last FROM ordersPaid";
    $result = $mysqli->query($query);
	 $row = $result->fetch_array(MYSQLI_ASSOC);
return $row['last'] + 1;
}
function NextPage($phone) {
global $mysqli, $CONFIG;
    $query = "SELECT * FROM items";
    $result = $mysqli->query($query);
    $totalRows =  $result->num_rows;
    $totalpages = ceil($totalRows/$CONFIG['pageRows']);
    if (getPage($phone) >= $totalpages)  { 
    $query = "UPDATE `customers` SET counter=1 WHERE cPhone='".$phone."'";
    $result = $mysqli->query($query);
    } else {
    $query = "UPDATE `customers` SET counter=counter+1 WHERE cPhone='".$phone."'";
    $result = $mysqli->query($query);
    }
}
function PreviousPage($phone) {
global $mysqli, $CONFIG;
    $query = "SELECT * FROM items";
    $result = $mysqli->query($query);
    $totalRows =  $result->num_rows;
    $totalpages = ceil($totalRows/$CONFIG['pageRows']);
    if (getPage($phone) > $totalpages)  { 
    $query = "UPDATE `customers` SET counter='".$totalpages."' WHERE cPhone='".$phone."'";
    $result = $mysqli->query($query);
    } else {
    $query = "UPDATE `customers` SET counter=counter-1 WHERE cPhone='".$phone."'";
    $result = $mysqli->query($query);
    }
    
}
function countItems($cat=0) {
	global $mysqli, $CONFIG;
	$cat_query = ($cat > 0) ? ' LEFT JOIN `categories` ON (items.categoryID=categories.CategoryID) WHERE items.CategoryID=\''.intval($cat).'\'' : '';
    $itemsList = array();
    $query = "SELECT * FROM items" . $cat_query;
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
	return $num_rows;	
}
function itemsList($page=0,$cat=0) {
global $mysqli, $CONFIG;
    $itemsList = array();
	$cat_query = ($cat > 0) ? ' LEFT JOIN `categories` ON (items.categoryID=categories.CategoryID) WHERE items.CategoryID=\''.intval($cat).'\'' : '';
    $query = "SELECT * FROM items" . $cat_query;
	
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
	if($num_rows == 0) { return array(); }
    $totalpages = ceil($num_rows/$CONFIG['pageRows']);

    if ($page < 1) { $page = 1;  } elseif ($page > $totalpages)  { $page = $totalpages; } 
    $cat_query1 = ($cat>0) ? ' WHERE items.CategoryID=\''.intval($cat).'\'' : '';
    $query = "SELECT items.*,categories.CategoryName FROM `items` LEFT JOIN `categories` ON (items.categoryID=categories.CategoryID) ".$cat_query1." ORDER BY itemCode ASC LIMIT ".($page - 1) * $CONFIG['pageRows'].",".$CONFIG['pageRows']."";
	
	$result = $mysqli->query($query);
	$i=0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$itemsList[$i]['id'] = $row['itemID'];
	$itemsList[$i]['itemCode'] = $row['itemCode'];	
	$itemsList[$i]['catID'] = $row['categoryID'];
	$itemsList[$i]['categoryName'] = $row['CategoryName'];
    $itemsList[$i]['sideOrderCat'] = $row['sideOrderCat'];
	$itemsList[$i]['name'] = $row['itemName'];
	$itemsList[$i]['description'] = $row['itemDescription'];
	$itemsList[$i]['price'] = $row['itemPrice'];
	$itemsList[$i]['image'] = $row['itemImage'];
	$i++;
	}
return $itemsList;
}
function customerList($page=0) {
global $mysqli, $CONFIG;
    $customerList = array();
    $query = "SELECT * FROM customers";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $totalpages = ceil($num_rows/$CONFIG['pageRows']);

    if($page != 0) {   $start = ($page - 1 * $CONFIG['pageRows']); } else { $start = 0; } 
    if($start <= 0 ) { $start = 0; }
    $query = "SELECT * FROM `customers` LIMIT $start,".$CONFIG['pageRows']."";
    $result = $mysqli->query($query);
	$i=0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$customerList[$i]['id'] = $row['cID'];
	$customerList[$i]['name'] = $row['cName'];	
	$customerList[$i]['phone'] = $row['cPhone'];
	$customerList[$i]['email'] = $row['cEmail'];	
	$customerList[$i]['country'] = $row['cCountry'];
	$customerList[$i]['city'] = $row['cCity'];
	$customerList[$i]['zip'] = $row['cZip'];
	$customerList[$i]['dateadded'] = $row['cDateAdded'];
	$customerList[$i]['itemprefered'] = $row['cItemPrefered'];	
	$i++;
	}
return $customerList;
}
function orderList($phoneNumber='') {
global $mysqli;
    $orderList = array();
    $query = "SELECT orders.*, items.itemName, items.itemDescription, items.itemPrice, items.itemID, items.itemCode, items.itemAudio FROM orders LEFT JOIN `items` ON (items.itemCode=orders.itemID) WHERE orders.phoneNumber='".$phoneNumber."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
	$i=0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$orderList[$i]['cookWith'] = $row['cookWith'];
	$orderList[$i]['itemAudio'] = $row['itemAudio'];	
	$orderList[$i]['itemID'] = $row['itemID'];
	$orderList[$i]['itemCode'] = $row['itemCode'];	
	$orderList[$i]['orderID'] = $row['orderID'];
	$orderList[$i]['phone'] = $row['phoneNumber'];	
	$orderList[$i]['name'] = $row['itemName'];
	$orderList[$i]['description'] = $row['itemDescription'];
	$orderList[$i]['quantity'] = $row['quantity'];
	$orderList[$i]['price'] = $row['itemPrice'];
	$orderList[$i]['dateOrder'] = $row['dateOrdered'];	
	$i++;
	}
return $orderList;
}
function employeeList($phoneNumber='') {
    global $mysqli;
    $employeeList = array();
    $query = "SELECT * FROM employee";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $i=0;
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $employeeList[$i]['firstname'] = $row['firstname'];
        $employeeList[$i]['lastname'] = $row['lastname'];
        $employeeList[$i]['initial'] = $row['initial'];
        $employeeList[$i]['ssn'] = $row['ssn'];
        $employeeList[$i]['phone'] = $row['phone'];
        $employeeList[$i]['credentials'] = $row['credentials'];
        $employeeList[$i]['loginid'] = $row['loginid'];
        $employeeList[$i]['password'] = $row['password'];
        $employeeList[$i]['pin'] = $row['pin'];
        $employeeList[$i]['jobtype'] = $row['jobtype'];
        $employeeList[$i]['paygrade'] = $row['paygrade'];
        $employeeList[$i]['id'] = $row['ID'];
        $i++;
    }
    return $employeeList;
}



function markComplete($data) {
    global $mysqli;
    $mysqli->query("UPDATE `ordersPaid` SET `orderCompleted`='".$data['isCompleted']."' WHERE id='".$data['id']."'");
}
function orderPaidList($phone='',$limit='',$read='1') {
global $mysqli;
    $phoneNumber = ($phone != '') ? ' AND ordersPaid.phoneNumber=\''.$phone.'\'' : '';
    $orderList = array();
    $q = "SELECT ordersPaid.*, items.itemName, items.itemDescription, items.itemPrice, items.itemID, items.itemCode, items.itemAudio, customers.cName FROM ordersPaid LEFT JOIN `items` ON (items.itemCode=ordersPaid.itemID) LEFT JOIN `customers` ON (ordersPaid.phone=customers.cPhone) ".$phoneNumber." ORDER BY orderID DESC " . $limit;
    $res = $mysqli->query($q) or trigger_error($mysqli->error."[$q]");;
    $num_rows = $res->num_rows;
	$i=0;
	while($row = $res->fetch_assoc()) {
        if($read==0) {
                $mysqli->query("UPDATE `ordersPaid` SET `orderRead`=1 WHERE orderRead='0' AND id='".$row['id']."'");
            }
	$orderList[$i]['orderID'] = $row['orderID'];	
	$orderList[$i]['id'] = $row['id'];	
	$orderList[$i]['itemAudio'] = $row['itemAudio'];
	$orderList[$i]['cookWith'] = $row['cookWith'];
    $orderList[$i]['sideOrder'] = $row['sideOrder'];
    $orderList[$i]['phone'] = $row['phone'];
	$orderList[$i]['name'] = $row['itemName'];
	$orderList[$i]['itemCode'] = $row['itemCode'];
	$orderList[$i]['cName'] = $row['cName'];	
	$orderList[$i]['description'] = $row['itemDescription'];
	$orderList[$i]['quantity'] = $row['quantity'];
	$orderList[$i]['price'] = $row['itemPrice'];
	$orderList[$i]['dateOrdered'] = $row['dateOrdered'];	
	$orderList[$i]['cash'] = $row['cash'];
    $orderList[$i]['orderCompleted'] = $row['orderCompleted'];
	$i++;
	}
return $orderList;
}
function orderPaid($phone, $cash='0') {
	global $mysqli;
    $query = "SELECT phoneNumber, itemID, quantity, cookWith, sideOrder FROM `orders` WHERE phoneNumber='".$phone."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows == 0) { return; }
    $uniqueID = GetUniqueID();
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$sql = "INSERT INTO `ordersPaid` (phone, orderID, itemID, cookWith, sideOrder, quantity, dateOrdered, cash) VALUES ('".$row['phoneNumber']."','".$uniqueID."','".$row['itemID']."','".$row['cookWith']."','".$row['sideOrder']."','".$row['quantity']."',now(),'".$cash."')";
		$mysqli->query($sql);
	}
	return $uniqueID;
}
function orderPaidCash($list)
{
	global $mysqli;
	$uniqueID = GetUniqueID();
	if(!empty($list))
	{
		for($i = 0; $i < count($list["xx_itemcode"]); $i++){
			$sql = "INSERT INTO `ordersPaid` (phone, orderID, itemID, cookWith, sideOrder, quantity, dateOrdered, cash, orderRead, orderCompleted) VALUES (
				'Indoor',
				'".$uniqueID."',
				'".$list["xx_itemcode"][$i]."',
				'".$list["xx_cookWith"][$i]."',
				'".$list["xx_sideOrder"][$i]."',
				'".$list["xx_quantity"][$i]."',
				'".date('Y-m-d h:i:s')."',
				'0',
				'1',
				'1'
			);";
			//echo $sql;
			$mysqli->query($sql);
		}
	}
	return $uniqueID;
}

function itemsByCategory($categoryID, $page=0) {
global $mysqli, $CONFIG;
    $query = "SELECT * FROM items WHERE categoryID='".intval($categoryID)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $totalpages = ceil($num_rows/$CONFIG['pageRows']);

    if($page != 0) {   $start = ($page - 1 * $CONFIG['pageRows']); } else { $start = 0; } 
    
    $itemsList = array();
    $query = "SELECT * FROM items WHERE categoryID='".intval($categoryID)."' ORDER BY itemCode ASC LIMIT ".$page.", ".$CONFIG['pageRows']."";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
	$i=0;
    if($num_rows > 0) {
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$itemsList[$i]['id'] = $row['itemID'];
	$itemsList[$i]['itemCode'] = $row['itemCode'];	
	$itemsList[$i]['image'] = $row['itemImage'];	
	$itemsList[$i]['catID'] = $row['categoryID'];
	$itemsList[$i]['name'] = $row['itemName'];
	$itemsList[$i]['description'] = $row['itemDescription'];
	$itemsList[$i]['price'] = $row['itemPrice'];
	$i++;
	}
     }
return $itemsList;
}
function itemNameByID($id) {
global $mysqli;
    $query = "SELECT itemName FROM items WHERE itemCode='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['itemName'];
	} else {
return "";	
	}
}
function CatByItemID($id) {
global $mysqli;
    $query = "SELECT CategoryID FROM items WHERE itemCode='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['CategoryID'];

	}
}
function itemByID($id) {
global $mysqli;
    $query = "SELECT * FROM items WHERE ItemCode='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row;

	}
}
function customerById($id) {
global $mysqli;
    $query = "SELECT * FROM `customers` WHERE cID='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row;
	}
}

function employeeById($id) {
    global $mysqli;
    $query = "SELECT * FROM `employee` WHERE ID='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    }
}





function itemByRealID($id) {
global $mysqli;
    $query = "SELECT * FROM items WHERE ItemID='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    if($num_rows > 0) {
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row;

	}
}
function catNameByID($categoryID) {
global $mysqli;
    $query = "SELECT CategoryName FROM categories WHERE CategoryID='".intval($categoryID)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($num_rows > 0) {
	return $row['CategoryName'];		
     } else {
     return false;     
     }
}

function placeOrder($vars, $noUpdate=false) {
global $mysqli;
$sideOrder = (is_array($vars['sideOrder'])) ? implode(',',$vars['sideOrder']) : '';
$with = (isset($vars['cookWith'])) ? " AND cookWith='".$vars['cookWith']."' " : " AND cookWith=''";
    // Select same phone and item if exist
    $query = "SELECT * FROM `orders` WHERE itemID='".$vars['itemCode']."' ".$with." AND phoneNumber='".$vars['phoneNumber']."'";
    $result = $mysqli->query($query);
    if($result->num_rows > 0) {
    // An item exist already , update quantity
    $query_update = "UPDATE `orders` SET quantity=quantity+1, cookWith=IFNULL(CONCAT(`cookWith`, ' ".$vars['cookWith']."'), '".$vars['cookWith']."') WHERE itemID='".$vars['itemCode']."' AND phoneNumber='".$vars['phoneNumber']."' ".$with."";
    $result = $mysqli->query($query_update);
    if($mysqli->affected_rows > 0) { return true; } else { return false; }
    } else {
    // An item is not exist , add it
    $query = "INSERT INTO orders (itemID, phoneNumber, cookWith, sideOrder, quantity) VALUES ('".$vars['itemCode']."', '".$vars['phoneNumber']."','".$vars['cookWith']."','".$sideOrder."','".$vars['quantity']."');";
        $result = $mysqli->query($query);
    if($mysqli->affected_rows > 0) {
	return true;	
     } else {
     return false;     
     }
         }
}
function placePayment($vars) {
global $mysqli;
    $query_update = "INSERT INTO `payments` (phone,invoicenum) VALUES ('".$vars['phoneNumber']."','".$vars['invoiceNum']."')";
    $result = $mysqli->query($query_update);
    if($mysqli->affected_rows > 0) { return true; } else { return false; }
}
function addCustomer($vars) {
global $mysqli;
	// Select same phone and item if exist
    $query = "SELECT * FROM `customers` WHERE cPhone='".$vars['phoneNumber']."'";
    $result = $mysqli->query($query);
    if(!$result->num_rows > 0) {
    // An item is not exist , add it
    $query = "INSERT INTO `customers` (cPhone, cCountry, cCity, cZip) VALUES ('".$mysqli->real_escape_string($vars['phoneNumber'])."', '".$mysqli->real_escape_string($vars['country'])."', '".$mysqli->real_escape_string($vars['city'])."', '".$vars['zip']."');";
    $result = $mysqli->query($query);
    if($mysqli->affected_rows > 0) {
	return true;	
     } else {
     return false;     
     }
         }
}
function updateCustomer($vars) {
global $mysqli;
	// Select same phone and item if exist
    $query = "SELECT * FROM `customers` WHERE cPhone='".$mysqli->real_escape_string($vars['phoneNumber'])."'";
    $result = $mysqli->query($query);
    if($result->num_rows > 0) {
    // An item is not exist , add it
   $query = "UPDATE `customers` SET 
   cName='".$mysqli->real_escape_string($vars['name'])."', 
   cEmail='".$mysqli->real_escape_string($vars['email'])."' 
   WHERE 
   cPhone='".$mysqli->real_escape_string($vars['phoneNumber'])."';";
//   cCountry='".$mysqli->real_escape_string($vars['country'])."', 
//   cCity='".$mysqli->real_escape_string($vars['city'])."', 
//   cZip='".$mysqli->real_escape_string($vars['zip'])."', 

    $result = $mysqli->query($query);
    if($mysqli->affected_rows > 0) {
	return true;	
     } else {
     return false;     
     }
         }
}
function clearOrder($phone) {
global $mysqli;
$query = "DELETE FROM `orders` WHERE phoneNumber='".$phone."'";

$result = $mysqli->query($query);
if($mysqli->affected_rows > 0) { return true; } else { return false; }
}
function checkItem($id) {
global $mysqli;
    $query = "SELECT * FROM items WHERE itemCode='".intval($id)."'";
    $result = $mysqli->query($query);
    $num_rows = $result->num_rows;
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($num_rows > 0) {
	return true;
     } else {
     return false;     
     }
}
function clean($string) {
$string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
$string = str_replace('  ', ' ', $string);
return $string;
}

// Shopping Cart API


function changeQuantity($itemCode, $cookWith="") {
$found=false;
$i=0;
if(!is_array($_SESSION['products'])) { return $found; }
foreach($_SESSION['products'] as $item) {
if(($item['itemCode'] == $itemCode) && (isset($item['cookWith']) && $item['cookWith'] == $cookWith))  { 
$found=true;
$_SESSION['products'][$i]['quantity'] += 1;
return $found;
}
$i++;
}
return $found;
}


//manage order
function allOrderList() {
    global $mysqli;
    
    $orderList = array();
    $q = "SELECT ao.id as order_id, ao.user_id, ao.ticket_id, ao.order_status, ao.added_date, ao.added_time, aoh.item_id, aoh.side_order_item_ids, aoh.quantity, itm.itemName, itm.itemPrice, itm.itemCode, itm.itembarcode FROM apx_order as ao   
    LEFT JOIN `apx_order_history` as aoh ON ao.id = aoh.order_id
    LEFT JOIN `items` as itm ON aoh.item_id = itm.itemID     
    ORDER BY ao.id DESC ";

    $res = $mysqli->query($q) or trigger_error($mysqli->error."[$q]");
    $num_rows = $res->num_rows;
    $i=0;
    while($row = $res->fetch_assoc()) {
        $orderList[$i]['id'] = $row['order_id'];    
        //$orderList[$i]['user_id'] = $row['user_id'];        
        $orderList[$i]['ticket_id'] = $row['ticket_id'];
        $orderList[$i]['order_status'] = $row['order_status'];
        //$orderList[$i]['item_id'] = $row['item_id'];
        $side_order_item_ids = $row['side_order_item_ids'];
        $sideItemList = array();
        $sid=0;
        if(isset($side_order_item_ids) && $side_order_item_ids!=''){
            $query = "SELECT * FROM items WHERE itemID IN ($side_order_item_ids)";
            $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
            while($srow = $result->fetch_assoc()) { 
                //$sideItemList[$sid]['itemID']=$srow['itemID'];
                //$sideItemList[$sid]['categoryID']=$srow[''];
                $sideItemList[$sid]['itemName']=$srow['itemName'];
                $sideItemList[$sid]['itemPrice']=$srow['itemPrice'];
                $sideItemList[$sid]['itemCode']=$srow['itemCode'];
                //$sideItemList[$sid]['SalesCount']=$srow['SalesCount'];
                //$sideItemList[$sid]['itembarcode']=$srow['itembarcode'];
                $sid++;
            }
        }

        $orderList[$i]['side_order_items'] = $sideItemList; //R
        $orderList[$i]['added_date'] = $row['added_date']; //R
        $orderList[$i]['quantity'] = $row['quantity']; //R
        $orderList[$i]['itemName'] = $row['itemName']; //R
        //$orderList[$i]['itemPrice'] = $row['itemPrice'];
        $orderList[$i]['itemCode'] = $row['itemCode']; //R
        //$orderList[$i]['itembarcode'] = $row['itembarcode'];    

        $i++;
    }

    //print_r($orderList); die();


return $orderList;
}

function get_tax(){
    global $mysqli;
    $q = "Select * from apx_tax where status='on' OR status='off'";
    $res = $mysqli->query($q);
    $i=1;
    while($row = $res->fetch_assoc()) {
        echo '<tr>
                <td>'.$i.'</td>
                <td>'.$row['tax_type'].'</td>
                <td>'.$row['tax_percent'].' %</td>
                <td>'.$row['status'].'</td>
                <td><a href="?action=managetax&edit_tax='.$row['tax_id'].'">Edit</a> | <a href="#" onclick="delete_tax('.$row['tax_id'].')">Delete</a> </td>
              </tr>';
              $i++;
    }
}

?>