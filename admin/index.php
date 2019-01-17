<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
session_start();
ini_set('display_errors',1);
require_once("../SMS_Module/twilio/Services/Twilio.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/paginare.class.php");
//require_once("../SMS_Module/classes/TableLayout.php");
if($_SESSION['logat'] == false) { header("Location: login.php"); exit();}

if(isset($_GET['action']) && $_GET['action'] == 'logout') {
	$_SESSION['logat'] = false; 
	header("Location: login.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Dashboard</title>
<link href="styles/layout.css" rel="stylesheet" type="text/css" />
<link href="styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Theme Start -->
<link href="themes/blue/styles.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="http://code.jquery.com/jquery-2.0.2.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/TableLayoutOperation.js"></script>
<!-- Theme End -->
</head>
<body id="homepage">

    <style>
        .parent{
            display:flex;
            justify-content: space-around;
            max-width:1000px;
            margin:0 auto;
        }
        th, td{
            text-align: center;
        }
    </style>
    <audio id="buzzer" src="shiny-ding.mp3" type="audio/mp3"></audio>
    <audio id="product_sound" src="" type="audio/mp3"></audio>
	<div id="header">
    	<a href="" title=""><img src="img/cp_logo.png" alt="Control Panel" class="logo" /></a>
    </div>
       
    <!-- Top Breadcrumb Start -->
    <div id="breadcrumb">
    	<ul>	
        	<li><img src="img/icons/icon_breadcrumb.png" alt="Location" /></li>
        	<li><strong>Location:</strong></li>
            <li><a href="#" title="">Sub Section</a></li>
            <li>/</li>
            <li class="current">Control Panel</li>
        </ul>
    </div>
    <!-- Top Breadcrumb End -->
     
    <!-- Right Side/Main Content Start -->
    <div id="rightside">
        <?php
        $point = "";
        if(isset($_GET['action'])){
            $point = $_GET['action'];
           }
            switch($point) {
                case 'additems':
                    $action = "";
                    if(isset($_POST['action'])){
                        $action = $_POST['action'];
                    }
                    if($action == 'additems') {
                        if(empty($_POST['itemcode'])) { die('Item Code is empty'); }
                        $select = $mysqli->query("SELECT * FROM `items` WHERE itemCode = '".$_POST['itemcode']."'");
                        if($select->num_rows > 0) { die('Item Code already exists in database'); }
                        if(isset($_FILES['thumb']['tmp_name'])) {
                            if(!move_uploaded_file($_FILES["thumb"]["tmp_name"],dirname(__DIR__) . "/images/products/" . $_FILES["thumb"]["name"])) {
                                $success =0;
                            }
                        }
                        if(isset($_FILES['audiofile']['tmp_name'])) {
                            if(!move_uploaded_file($_FILES["thumb"]["tmp_name"],dirname(__DIR__) . "/images/products/" . $_FILES["audiofile"]["name"])) {
                                $success =0;
                            }
                        }
                        $img = isset($_FILES['thumb']['name']) ? ', \''.$_FILES['thumb']['name'].'\'' : '';
                        $audio = isset($_FILES['audiofile']['name']) ? ', \''.$_FILES['audiofile']['name'].'\'' : '';
                        $query_update = "INSERT INTO `items` (categoryID, itemName, itemDescription, itemPrice, itemCode, itemImage, itemAudio) VALUES ('".$_POST['cid']."','".$_POST['itemname']."','".$_POST['itemdescription']."','".$_POST['itemprice']."','".$_POST['itemcode']."' ".$img . $audio . ");";
                        $result = $mysqli->query($query_update);
                        if($mysqli->affected_rows > 0) { $success =1; }
                        if($success == 1) {
                            echo '
                                <div class="status success">
                                    <p class="closestatus"><a href="" title="Close">x</a></p>
                                    <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Item has been added.</p>
                                </div>';
                        } else {
                            echo '
                                <div class="status error">
                                    <p class="closestatus"><a href="" title="Close">x</a></p>
                                    <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Item couldn\'t be  added.</p>
                                </div>
                                ';
                        }
                    }
                    echo '
                        <div class="contentbox">
                            <form action="?action=additems" method="POST" enctype="multipart/form-data">
                                <p>
                                    <label for="textfield"><strong>Name:</strong></label>
                                    <input type="text" name="itemname" id="textfield" value="" class="inputbox" /> <br />
                                </p>
                                <p>
                                    <label for="textfield"><strong>Description:</strong></label>
                                    <input type="text" name="itemdescription" id="textfield" value="" class="inputbox" /> <br />
                                </p>
                                <p>
                                    <label for="smallbox"><strong>Item Price ($):</strong></label>
                                    <input type="text" id="smallbox" name="itemprice" value="" class="inputbox smallbox" />
                                </p>
                                <p>
                                    <label for="smallbox"><strong>Item Unique Code:</strong></label>
                                    <input type="text" id="smallbox" name="itemcode" value="" class="inputbox smallbox" /> Only numbers
                                </p>
                                <select name="cid">
                                <option value="">Category</option>';
                                    foreach(categoryList() as $cat) {
                                        echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
                                    }
                                echo '                    
                                </select>  <br /> <br />
                                <p>
                                    <label for="smallbox"><strong>Thumbnail Image:</strong></label>
                                    <input type="file" id="uploader" value="" name="thumb" />
                                </p>                
                                <p>
                                    <label for="smallbox"><strong>Audio File:</strong></label>
                                    <input type="file" id="uploader" value="" name="audiofile" /> *.mp3 <a href="audioRecord.html" title="Record Voice then Upload it" target="_blank">Record Voice Now</a>
                                </p>                
                                <p></p>
                                <input type="hidden" name="action" value="additems"/>
                                <input type="submit" value="Add Item" class="btn" />
                            </form>         
                        </div>';
                    break;

                case 'addcategories':
                    $action = "";
                    if(isset($_POST['action'])){
                        $action = $_POST['action'];
                    }
                    if($action == 'addcategories') {
                       $query_update = "INSERT INTO `categories` (CategoryName, CategoryNote, OrderID) VALUES ('".$_POST['cname']."','".$_POST['cnote']."','".$_POST['oid']."');";
                       $result = $mysqli->query($query_update);
                       if($mysqli->affected_rows > 0) { $success =1; }
                       if($success == 1) {
                            echo '
                                    <div class="status success">
                                        <p class="closestatus"><a href="" title="Close">x</a></p>
                                        <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Category has been added.</p>
                                    </div>
                            ';
                       } else {
                            echo '
                                    <div class="status error">
                                        <p class="closestatus"><a href="" title="Close">x</a></p>
                                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Category couldn\'t be  added.</p>
                                    </div>
                                    ';
                       }
                    }
                    echo '
                        <div class="contentbox">
                            <form action="?action=addcategories" method="POST">
                                <p>
                                    <label for="textfield"><strong>Category Name:</strong></label>
                                    <input type="text" name="cname" id="textfield" value="" class="inputbox" /> <br />
                                </p>
                                <p>
                                    <label for="textfield"><strong>Description:</strong></label>
                                    <input type="text" name="cnote" id="textfield" value="" class="inputbox" /> <br />
                                </p>
                                <p>
                                    <label for="smallbox"><strong>Order ID:</strong></label>
                                    <input type="text" id="smallbox" name="oid" value="0" class="inputbox smallbox" />
                                </p>
                            
                                <input type="hidden" name="action" value="addcategories"/>
                            <input type="submit" value="Add Category" class="btn" />
                            </form>         
                        </div>';
                    break;

                case 'deletecategory':
                    if(empty($_GET['id'])) { echo '<script>window.location.href=\'index.php?action=managecategories\';</script>'; exit;}
                    $mysqli->query("DELETE FROM `categories` WHERE CategoryID='".$_GET['id']."'");
                    ob_start();
                    echo '<script>window.location.href=\'index.php?action=managecategories\';</script>';
                    exit();
                    break;

                case 'deleteitem':
                if(empty($_GET['id'])) { echo '<script>window.location.href=\'index.php?action=manageitems\';</script>'; exit; }
                $mysqli->query("DELETE FROM `items` WHERE itemID='".$_GET['id']."'");
                echo '<script>window.location.href=\'index.php?action=manageitems\';</script>';
                exit();
                break;

                case 'edititem':
                if($_POST['action'] == 'edit') {
                $success = null;
                if(isset($_FILES['thumb']['tmp_name']) && $_FILES['thumb']['tmp_name'] != '') {
                if(!move_uploaded_file($_FILES["thumb"]["tmp_name"],dirname(__DIR__) . "/images/products/" . $_FILES["thumb"]["name"])) {
                $success =0;
                }
                }
                if(isset($_FILES['audiofile']['tmp_name']) && $_FILES['audiofile']['tmp_name'] != '') {
                if(!move_uploaded_file($_FILES["audiofile"]["tmp_name"],dirname(__DIR__) . "/images/products/" . $_FILES["audiofile"]["name"])) {
                $success =0;
                }
                }

                $img = (isset($_FILES['thumb']['name']) && $_FILES['thumb']['name'] != '') ? ', itemImage=\''.$_FILES['thumb']['name'].'\'' : '';
                $audio = (isset($_FILES['audiofile']['name']) && $_FILES['audiofile']['name'] != '') ? ', itemAudio=\''.$_FILES['audiofile']['name'].'\'' : '';
                    $query_update = "UPDATE `items` SET sideOrderCat='".$_POST['sideOrderCat']."', sideOrderLimit='".$_POST['sideOrderLimit']."', categoryID='".$_POST['category']."', itemName='".$_POST['name']."', itemDescription='".$_POST['description']."', itemPrice='".$_POST['price']."' ".$img . $audio . " WHERE itemID='".$_GET['id']."'";
                    $result = $mysqli->query($query_update);
                    if($mysqli->affected_rows > 0) { $success =1; }
                if($success == 1) {
                    echo '
                            <div class="status success">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Item has been modified.</p>
                            </div>
                    ';
                } else {
                echo '
                    <div class="status error">
                        <p class="closestatus"><a href="" title="Close">x</a></p>
                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Item couldn\'t be  modified. Nothing to change</p>
                    </div>
                    ';
                }
                }
                if(empty($_GET['id'])) { die('invalid item'); }
                $item_details = itemByRealID($_GET['id']);
                $cat_id = $item_details['categoryID'];
                $sideOrderCat = $item_details['sideOrderCat'];
                echo '
                    <div class="contentbox">
                        <form action="?action=edititem&id='.$_GET['id'].'" method="POST" enctype="multipart/form-data">
                            <p>
                                <label for="textfield"><strong>Name:</strong></label>
                                <input type="text" name="name" id="textfield" value="'.$item_details['itemName'].'" class="inputbox" /> <br />
                            </p>
                            <p>
                                <label for="textfield"><strong>Description:</strong></label>
                                <input type="text" name="description" id="textfield" value="'.$item_details['itemDescription'].'" class="inputbox" /> <br />
                            </p>
                            <p>
                                <label for="smallbox"><strong>Item Price ($):</strong></label>
                                <input type="text" id="smallbox" name="price" value="'.$item_details['itemPrice'].'" class="inputbox smallbox" />
                            </p>
                            <select name="category">
                                <option value="">Category</option>';
                            foreach(categoryList() as $cat) {
                                $selected = ($cat['id'] == $cat_id) ? "selected" : "";
                                echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['name'].'</option>';
                            }
                echo '                    
                            </select>  <br /> <br />
                            <p>
                                <label for="smallbox"><strong>Thumbnail Image:</strong></label>
                            <input type="file" id="uploader" value="'.$item_details['itemImage'].'" name="thumb" />'; if($item_details['itemImage'] != '') { echo '<a href="'.$CONFIG['image_location'] . "/" . $item_details['itemImage'].'" target="_blank"><img src="'.$CONFIG['image_location'] . "/" . $item_details['itemImage'].'" height="100"/></a>'; }
                echo '              </p>                
                                    <p>
                                        <label for="smallbox"><strong>Audio File:</strong></label>
                                        <input type="file" id="uploader" value="" name="audiofile" /> *.mp3'; if($item_details['itemAudio'] != '') { echo '<audio id="product'.$_GET['id'].'_play" src="'.$CONFIG['image_location'] . "/" . $item_details['itemAudio'].'" type="audio/mp3"></audio> - <a href="javascript:;" onclick="playAudio(\''.$_GET['id'].'\');" id="play">Play audio</a>'; }  echo '&nbsp;&nbsp;&nbsp;&nbsp; <a href="audioRecord.html" title="Record Voice then Upload it" target="_blank">Record Voice Now</a>';
                echo '              </p>                
                
                                                            <p>
                                        <label for="smallbox"><strong>Side Order Category:</strong></label>
                                           <select name="sideOrderCat">
                                        <option value="0" selected>Category</option>';
                                            foreach(categoryList() as $cat) {
                                                $selected = ($cat['id'] == $sideOrderCat) ? "selected" : "";
                                                echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['name'].'</option>';
                                            }
                    echo '
                                    </select>
                                    </p>
                
                                     <p>
                                        <label for="smallbox"><strong>Side Order Limit:</strong></label>
                                        <input type="text" id="smallbox" name="sideOrderLimit" value="'.$item_details['sideOrderLimit'].'" class="inputbox smallbox" />
                                    </p>
                
                                    <p></p>
                                    <input type="hidden" name="action" value="edit"/>
                                <input type="submit" value="Edit Item" class="btn" />
                                </form>         
                            </div>
                ';
                break;

                case 'editcustomer':
                    if($_POST['action'] == 'edit') {
                    $success = null;
                        $query_update = "UPDATE `customers` SET cName='".$_POST['name']."', cPhone='".$_POST['phone']."', cEmail='".$_POST['email']."', cCountry='".$_POST['country']."' WHERE cID='".$_GET['id']."'";

                        $result = $mysqli->query($query_update);
                        if($mysqli->affected_rows > 0) { $success =1; }
                    if($success == 1) {
                    echo '
                            <div class="status success">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Customer has been modified.</p>
                            </div>
                    ';
                    } else {
                    echo '
                            <div class="status error">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Customer couldn\'t be  modified. Nothing to change</p>
                            </div>
                            ';

                    }
                    }

                    if(empty($_GET['id'])) { die('invalid item'); }
                    $customer_details = customerById($_GET['id']);
                    echo '
                                <div class="contentbox">
                                    <form action="?action=editcustomer&id='.$_GET['id'].'" method="POST" enctype="multipart/form-data">
                                 <p>
                                            <label for="textfield"><strong>Name:</strong></label>
                                            <input type="text" name="name" id="textfield" value="'.$customer_details['cName'].'" class="inputbox" /> <br />
                                        </p>
                                        <p>
                                            <label for="textfield"><strong>Phone:</strong></label>
                                            <input type="text" name="phone" id="textfield" value="'.$customer_details['cPhone'].'" class="inputbox" /> <br />
                                        </p>
                    
                                        <p>
                                            <label for="textfield"><strong>E-Mail:</strong></label>
                                            <input type="text" name="email" id="textfield" value="'.$customer_details['cEmail'].'" class="inputbox" /> <br />
                                        </p>
                    
                                        <p>
                                            <label for="textfield"><strong>Country:</strong></label>
                                            <input type="text" name="country" id="textfield" value="'.$customer_details['cCountry'].'" class="inputbox" /> <br />
                                        </p>
                                         
                                       
                                        <p></p>
                                        <input type="hidden" name="action" value="edit"/>
                                    <input type="submit" value="Edit Customer" class="btn" />
                                    </form>         
                                </div>
                    ';
                    break;

                case 'managecategories':
                     ?>
                        <!-- Alternative Content Box Start -->
                     <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Menu Categories</h2>
                        </div>
                        <div class="contentbox">
                            <table width="100%">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                        <th>Name</th>
                                        <th>Note</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                    $clist = categoryList();
                    if(count($clist) == 0) { echo '
                            <div class="status error">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> No categories available.</p>
                            </div>';
                    } else {
                    foreach($clist as $cat) {
                    echo '
                                        <tr>
                                            <td>'.$cat['id'].'</td>
                                                <td>'.$cat['name'].'</td>
                                                <td>'.$cat['note'].'</td>
                                                <td>'.$cat['orderID'].'</td>                                                        
                                                <td>
                                                    <a href="?action=editcategory&id='.$cat['id'].'" title=""><img src="img/icons/icon_edit.png" alt="Edit" /></a>
                                                    <a href="?action=deletecategory&id='.$cat['id'].'" title=""><img src="img/icons/icon_delete.png" alt="Delete" /></a>
                                                </td>
                                            </tr>';

                    }
                    }
                    ?>
                                         </tbody>
                                    </table>
                                    <div class="extrabottom">
                                        <ul>
                                            <li><img src="img/icons/icon_edit.png" alt="Edit" /> Edit</li>
                                            <li><img src="img/icons/icon_delete.png" alt="Delete" /> Remove</li>
                                        </ul>
                                    </div>
                                    <ul class="pagination">
                                        <li class="text">Previous</li>
                                        <li class="page"><a href="#" title="">1</a></li>
                                        <li><a href="#" title="">2</a></li>
                                        <li><a href="#" title="">3</a></li>
                                        <li><a href="#" title="">4</a></li>
                                        <li class="text"><a href="#" title="">Next</a></li>
                                    </ul>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>
                            <!-- Alternative Content Box End -->
                    <?php
                    break;
                case 'manageitems':
                     ?>
                <!-- Alternative Content Box Start -->
                     <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Menu Items</h2>
                        </div>
                        <div class="contentbox">
                            <table width="100%">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                        <th>Name</th>
                                        <th>Note</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Unique Code</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                     <?php
                    $page = 1;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                       }
                       else{
                        $page = 1;
                       }
                    $nextpage = $page + 1;
                    $prevpage = $page - 1;
                    $clist = itemsList($page);
                    if(count($clist) == 0) { echo '
                            <div class="status error">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> No menu items available.</p>
                            </div>';
                    } else {
                    foreach($clist as $cat) {
                    $img = ($cat['image'] != '') ? '<a href="'.$CONFIG['image_location'] . "/" . $cat['image'].'" target="_blank"><img src="'.$CONFIG['image_location'] . "/" . $cat['image'].'" height="42"/></a>' : 'No image available';
                    echo '
                                        <tr>
                                            <td>'.$cat['id'].'</td>
                                                <td>'.$cat['name'].'</td>
                                                <td>'.$cat['description'].'</td>
                                                <td>'.$cat['categoryName'].'</td>                                                        
                                                <td>'.$cat['price'].'</td>                                                                                    
                                                <td>'.$img.'</td>                                                                                    
                                                <td>'.$cat['itemCode'].'</td>                                                                                                                
                                                <td>
                                                    <a href="?action=edititem&id='.$cat['id'].'" title=""><img src="img/icons/icon_edit.png" alt="Edit" /></a>
                                                    <a href="?action=deleteitem&id='.$cat['id'].'" title=""><img src="img/icons/icon_delete.png" alt="Delete" /></a>
                                                </td>
                                            </tr>';

                    }
                    }
                    ?>
                                         </tbody>
                                    </table>
                                    <div class="extrabottom">
                                        <ul>
                                            <li><img src="img/icons/icon_edit.png" alt="Edit" /> Edit</li>
                                            <li><img src="img/icons/icon_delete.png" alt="Delete" /> Remove</li>
                                        </ul>
                                    </div>
                                    <ul class="pagination">
                                        <li class="text"><a href="?action=manageitems&page=<?=$prevpage;?>">Previous</a></li>
                                        <li class="text"><a href="?action=manageitems&page=<?=$nextpage;?>" title="">Next</a></li>
                                    </ul>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>
                            <!-- Alternative Content Box End -->
                    <?php
                    break;

                case 'managecustomers':
                    ?>
                <!-- Alternative Content Box Start -->
                     <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Customers</h2>
                        </div>
                        <div class="contentbox">
                            <table width="100%">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>eMail</th>
                                        <th>Date Added</th>
                                        <th>Item Prefered</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                    $page = 0;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                       }
                       else{
                        $page = 5;
                       }
                    $nextpage = $page + 5;
                    $prevpage = $page - 5;

                    $clist = customerList($page);
                    if(count($clist) == 0) { echo '
                            <div class="status error">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> No customers available.</p>
                            </div>';
                    } else {
                    foreach($clist as $cat) {
                        echo '
                                        <tr>
                                            <td>'.$cat['id'].'</td>
                                                <td>'.$cat['name'].'</td>
                                                <td>'.$cat['phone'].'</td>
                                                <td>'.$cat['email'].'</td>                                                        
                                                <td>'.$cat['dateadded'].'</td>                                                                                                                                            
                                                <td>'.$cat['itemprefered'].'</td>                                                                                                                
                                                <td>
                                                    <a href="?action=editcustomer&id='.$cat['id'].'" title=""><img src="img/icons/icon_edit.png" alt="Edit" /></a>
                                                    <a href="?action=deletecustomer&id='.$cat['id'].'" title=""><img src="img/icons/icon_delete.png" alt="Delete" /></a>
                                                </td>
                                            </tr>';
                    }
                    }
                    ?>
                                         </tbody>
                                    </table>
                                    <div class="extrabottom">
                                        <ul>
                                            <li><img src="img/icons/icon_edit.png" alt="Edit" /> Edit</li>
                                            <li><img src="img/icons/icon_delete.png" alt="Delete" /> Remove</li>
                                        </ul>
                                    </div>
                                    <ul class="pagination">
                                        <li class="text"><a href="?action=managecustomers&page=<?=$prevpage;?>">Previous</a></li>
                                        <li class="text"><a href="?action=managecustomers&page=<?=$nextpage;?>" title="">Next</a></li>
                                    </ul>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>
                            <!-- Alternative Content Box End -->
                     <?php
                     break;

                case 'addemployee':
                    $action = "";
                    if(isset($_POST['action'])){
                        $action = $_POST['action'];
                    }
                    if($action == 'addemployee') {
                        $query_update = "INSERT INTO `employee` (firstname,lastname,initial,ssn,phone,credentials,loginid,password,pin,jobtype,paygrade) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['initial']."','".$_POST['ssn']."','".$_POST['phone']."','".$_POST['credentials']."','".$_POST['loginid']."','".$_POST['password']."','".$_POST['pin']."','".$_POST['jobtype']."','".$_POST['paygrade']."');";
                        $result = $mysqli->query($query_update);
                        if($mysqli->affected_rows > 0) { $success =1; }
                        if($success == 1) {
                            echo '        
                        <div class="status success">
                        <p class="closestatus"><a href="" title="Close">x</a></p>
                        <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Employee has been added.</p>
                        </div>';
                        }
                        else {
                            echo '
                        <div class="status error">
                        <p class="closestatus"><a href="" title="Close">x</a></p>
                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Item couldn\'t be  added.</p>
                        </div>';
                        }
                    }
                    echo '
                        <div class="contentbox">
                            <form action="?action=addemployee" method="POST" enctype="multipart/form-data">
                            <div class="parent">
                                <div class="child1">
                                   <p>
                                    <label for="textfield"><strong>First Name:</strong></label>
                                    <input type="text" name="firstname" id="textfield" value="" class="inputbox" /> <br/>
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Last Name:</strong></label>
                                        <input type="text" name="lastname" id="textfield" value="" class="inputbox" /> <br />
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Initial:</strong></label>
                                        <input type="text" name="initial" id="textfield" value="" class="inputbox" /> <br />
                                    </p>                     
                                     <p>
                                        <label for="textfield"><strong>SSN:</strong></label>
                                        <input type="text" name="ssn" id="textfield" value="" class="inputbox" /> <br />
                                    </p>  
                                     <p>
                                        <label for="textfield"><strong>Phone:</strong></label>
                                        <input type="text" name="phone" id="textfield" value="" class="inputbox" /> <br />
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Credentials:</strong></label>
                                        <input type="text" name="credentials" id="textfield" value="" class="inputbox" /> <br />
                                    </p>      
                                     <input type="hidden" name="action" value="addemployee"/>
                                    <input type="submit" value="Add Employee" class="btn" />                         
                                </div>
                                <div class="child2">                   
                                    <p>
                                        <label for="textfield"><strong>Login ID:</strong></label>
                                        <input type="text" name="loginid" id="textfield" value="" class="inputbox" /> <br />
                                    </p>   
                                    <p>
                                        <label for="textfield"><strong>PIN:</strong></label>
                                        <input type="text" name="pin" id="textfield" value="" class="inputbox" /> <br />
                                    </p>
                                    <p>
                                        <label for="jobtype"><strong>Job Type:</strong></label>                        
                                           <select name="jobtype" id="jobtype">                       
                                           <option value=""></option>
                                           <option value="Manager" '.''.'>Manager</option>
                                           <option value="Waitress">Waitress</option>
                                           <option value="Cook">Cook</option>
                                           </select>
                                    </p>   
                                    <p>
                                        <label for="textfield"><strong>Paygrade:</strong></label>
                                        <input type="text" name="paygrade" id="textfield" value="" class="inputbox" /> <br />
                                    </p>     
                                    <p>
                                        <label for="textfield"><strong>Password:</strong></label>
                                        <input type="text" name="password" id="textfield" value="" class="inputbox" /> <br />
                                    </p>                             
                                </div>           
                            </div>                  
                          </form>
                        </div>';
                        break;

                case 'editemployee':
                    if (!empty($_POST)){
                        if($_POST['action'] == 'editemployee') {
                            $success = null;
                            $query_update = "UPDATE `employee` SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', initial='".$_POST['initial']."', 
                                ssn='".$_POST['ssn']."', phone='".$_POST['phone']."', credentials='".$_POST['credentials']."', loginid='".$_POST['loginid']."', 
                                password='".$_POST['password']."', pin='".$_POST['pin']."', jobtype='".$_POST['jobtype']."', paygrade='".$_POST['paygrade']."'"." WHERE ID='".$_GET['id']."'";
                            $result = $mysqli->query($query_update);
                            if($mysqli->affected_rows > 0) { $success =1; }
                            if($success == 1) {
                                echo '
                                    <div class="status success">
                                        <p class="closestatus"><a href="" title="Close">x</a></p>
                                        <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Employee has been modified.</p>
                                    </div>';
                                } else {
                                    echo '
                                    <div class="status error">
                                        <p class="closestatus"><a href="" title="Close">x</a></p>
                                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Employee couldn\'t be  modified. Nothing to change</p>
                                    </div>';
                                    }
                                }

                    }

                    if(empty($_GET['id'])) { die('invalid item'); }
                    $employee = employeeById($_GET['id']);
                    echo '
                        <div class="contentbox">
                            <form action="?action=editemployee&id='.$_GET['id'].'" method="POST" enctype="multipart/form-data">
                                <div class="parent">
                                <div class="child1">
                                   <p>
                                    <label for="textfield"><strong>First Name:</strong></label>
                                    <input type="text" name="firstname" id="textfield" value="'.$employee['firstname'].'" class="inputbox" /> <br/>
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Last Name:</strong></label>
                                        <input type="text" name="lastname" id="textfield" value="'.$employee['lastname'].'" class="inputbox" /> <br />
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Initial:</strong></label>
                                        <input type="text" name="initial" id="textfield" value="'.$employee['initial'].'" class="inputbox" /> <br />
                                    </p>                     
                                     <p>
                                        <label for="textfield"><strong>SSN:</strong></label>
                                        <input type="text" name="ssn" id="textfield" value="'.$employee['ssn'].'" class="inputbox" /> <br />
                                    </p>  
                                     <p>
                                        <label for="textfield"><strong>Phone:</strong></label>
                                        <input type="text" name="phone" id="textfield"value="'.$employee['phone'].'" class="inputbox" /> <br />
                                    </p>
                                     <p>
                                        <label for="textfield"><strong>Credentials:</strong></label>
                                        <input type="text" name="credentials" id="textfield" value="'.$employee['credentials'].'" class="inputbox" /> <br />
                                    </p>      
                                    <input type="hidden" name="action" value="editemployee"/>
                                    <input type="submit" value="Edit Employee" class="btn" />                         
                                </div>
                                 <div class="child2">                   
                                    <p>
                                        <label for="textfield"><strong>Login ID:</strong></label>
                                        <input type="text" name="loginid" id="textfield" value="'.$employee['loginid'].'" class="inputbox" /> <br />
                                    </p>   
                                    <p>
                                        <label for="textfield"><strong>PIN:</strong></label>
                                        <input type="text" name="pin" id="textfield" value="'.$employee['pin'].'" class="inputbox" /> <br />
                                    </p>
                                    <p>
                                        <label for="jobtype"><strong>Job Type:</strong></label>                        
                                           <select name="jobtype" id="jobtype">';
                                    $options=['','Manager','Waitress','Cook'];
                                    for ($i=0;$i<count($options);$i++){
                                        if ($employee['jobtype']==$options[$i]){
                                            echo '<option value="'.$options[$i].'" selected="selected"'.'>'.$options[$i].'</option>';
                                        }
                                        else{
                                            echo '<option value="'.$options[$i].'"'.'>'.$options[$i].'</option>';
                                        }
                                    }
                                    echo '
                                           </select>
                                    </p>   
                                    <p>
                                        <label for="textfield"><strong>Paygrade:</strong></label>
                                        <input type="text" name="paygrade" id="textfield" value="'.$employee['paygrade'].'" class="inputbox" /> <br />
                                    </p>     
                                    <p>
                                        <label for="textfield"><strong>Password:</strong></label>
                                        <input type="text" name="password" id="textfield" value="'.$employee['password'].'" class="inputbox" /> <br />
                                    </p>  
                                           
                                 </div>           
                            </div>       
                            </form>         
                        </div>';
                    break;

                case 'manageemployee':
                    ?>
                    <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Latest Orders</h2>
                        </div>
                        <div class="contentbox">
                            <table id="manageEmployeeTable" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Initial</th>
                                    <th>SSN</th>
                                    <th>Phone Number</th>
                                    <th>Credentials</th>
                                    <th>Login ID</th>
                                    <th>PIN</th>
                                    <th>Job Type</th>
                                    <th>Pay Grade</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $employeeList = employeeList();
                                if(!empty($employeeList)){
                                    $i=1;
                                    foreach($employeeList as $employee) {
                                        echo '
                                <tr>
                                    <td>'.(string)$i.'</td>
                                    <td>'.$employee['firstname'] .'</td>
                                    <td>'.$employee['lastname'] .'</td>
                                    <td>'.$employee['initial'] .'</td>
                                    <td>'.$employee['ssn'] .'</td>
                                    <td>'.$employee['phone'] .'</td>
                                    <td>'.$employee['credentials'] .'</td>
                                    <td>'.$employee['loginid'] .'</td>
                                    <td>'.$employee['password'] .'</td>
                                     <td>'.$employee['jobtype'] .'</td>
                                    <td>'.$employee['pin'] .'</td>                                   
                                    <td>'.$employee['paygrade'] .'</td>
                                    <td>
                                        <a href="?action=editemployee&id='.$employee['id'].'" title=""><img src="img/icons/icon_edit.png" alt="Edit" /></a>
                                        <a href="?action=deleteemployee&id='.$employee['id'].'" title=""><img src="img/icons/icon_delete.png" alt="Delete" /></a>
                                    </td>            
                                </tr>';
                                        $i++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                    <?php
                    break;

                case 'deleteemployee':
                    if(empty($_GET['id'])) { echo '<script>window.location.href=\'index.php?action=manageemployee\';</script>'; exit; }
                    $mysqli->query("DELETE FROM `employee` WHERE ID='".$_GET['id']."'");
                    echo '<script>window.location.href=\'index.php?action=manageemployee\';</script>';
                    exit();
                    break;

                case 'managetable':
                    ?>
                    <style>
                        .contentcontainer{
                            width:70vmax;
                            margin:30px auto;
                        }
                        .contentbox{
                            /*height:40vmax;*/
                            /*position:relative;*/
                            /*display:flex;*/
                            /*flex-direction: column;*/
                        }

                        #tableArea{
                            /*flex-grow:1;*/
                            width:600px;

                            border:1px solid red;
                            padding:0px;
                            /*height:40vmax;*/
                            height:600px;
                            left:50%;
                            top:50%;
                            transform:translateX(-50%);
                            position: relative;
                        }

                        .bottom-part{
                            display: flex;
                            justify-content: space-between;
                        }
                        #create-table-part{
                            display:flex;
                        }
                        #create-label-part{
                            display:flex;
                        }
                        #create-table-label{
                            font-size:20px;
                            border:3px solid;
                            text-align: center;
                            padding:5px;
                            padding-top:13px;
                        }
                        #rect{
                            width:80px;
                            height:50px;
                            border:3px solid #000000;
                            margin-left:20px;
                        }
                        #circle{
                            width:50px;
                            height:50px;
                            border:3px solid #000000;
                            border-radius:50px;
                            margin-left:20px;
                        }

                        #create-object-label{
                            font-size:20px;
                            border:3px solid;
                            text-align: center;
                            padding:5px;
                            padding-top:13px;
                        }
                        #label{
                            display:flex;
                            flex-direction: column;
                            justify-content: space-between;
                            margin-left:20px;
                            padding-bottom:0px;
                            width:70px;
                        }
                        #label-draw{
                            border-top:3px solid #000000;
                            height:20px;
                        }
                        #label-text{
                            text-align: center;
                            font-size:20px;
                            padding-bottom:0px;
                            margin-bottom:0px;
                        }

                        #object-part{
                            display:flex;
                            flex-direction: column;
                            justify-content: space-between;
                            margin-left:20px;
                            /*width:70px;*/
                        }

                        #object{
                            width:70px;
                            height:30px;
                            padding:0;

                        }

                        #object-label{
                            text-align: center;
                            font-size:20px;
                            padding-bottom: 0px;
                            margin:0 auto;
                        }

                        canvas{

                        }
                        .tableLayout{
                            border:1px #333333 solid;
                            box-sizing: border-box;
                            text-align:center;
                        }

                        .displayTableNumber{
                            font-size:23px;
                            margin:auto;
                            width:fit-content;
                            position: absolute;
                            top: 50%;
                            left: 0;
                            right: 0;
                            transform: translateY(-50%);
                            color:#eeeeee;
                        }
                        .showMaxguest{
                            width:30px;
                            position: absolute;
                            top: 50%;
                            left: 60%;
                            right: 0;
                            transform: translateY(-50%);
                            background:transparent;
                            font-size:17px;
                            border:none;
                            color:#eeeeee;
                        }
                        .tableLabel{
                            padding:0;
                            border:none;
                            text-align:center;
                            font-size:17px;
                            width:70px;
                            font-weight:bold;
                            color:#ff3333;
                            background:transparent;
                            cursor:pointer;
                            display:none;
                        }
                        .ObjectLayout{
                            border:5px black solid;
                            box-sizing: border-box;
                            text-align:center;
                            position:absolute;
                            background:none;
                        }
                        .ObjectLabel{
                            position:absolute;
                        }
                        .LayoutObjectLabel{
                            width:8ch;
                            float:right;
                            font-size:20px;
                            border:none;
                            color:red;
                            padding:0;
                            text-align: right;
                            border:1px solid #888888;
                        }
                        .displayTableNumber{
                            background:none;
                            border:none;
                            outline:none;
                            text-align: center;
                            color:white;
                            width:30px;
                        }
                        .context-menu {
                            display: none;
                            z-index: 1000;
                            position: absolute;
                            overflow: hidden;
                            border: 1px solid #CCC;
                            white-space: nowrap;
                            font-family: sans-serif;
                            background: #FFF;
                            color: #333;
                            border-radius: 5px;
                            list-style-type: none;
                            padding-left:0px;
                        }

                        .context-menu li {
                            padding: 8px 0px;
                            padding-right:12px;
                            padding-left:25px;
                            cursor: pointer;
                            list-style-type: none;
                        }

                        .context-menu li:hover {
                            background-color: #DEF;
                        }
                    </style>
                    <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Manage Table</h2>
                        </div>
                        <div class="contentbox">
                            <div id="tableArea">
                                <ul class='obj-menu context-menu'>
                                    <li data-action = "Change_State">Change Occupied State</li>
                                    <li data-action = "Remove">Remove Table</li>
                                </ul>
                            </div>
                            <div class="bottom-part">
                                <div id="create-table-part">
                                    <p id="create-table-label">Create Table</p>
                                    <div id="rect"></div>
                                    <div id="circle"></div>
                                </div>
                                <div id="create-label-part">
                                    <p id="create-object-label">Draw Objects</p>
<!--                                    <div id="label">-->
<!--                                        <div id="label-draw"></div>-->
<!--                                        <p id="label-text">Label</p>-->
<!--                                    </div>-->
<!--                                    <div id="object-part">-->
<!--                                        <canvas id="object"></canvas>-->
<!--                                        <script>-->
<!--                                            var canvas = document.getElementById('object');-->
<!--                                            var context = canvas.getContext('2d');-->
<!--                                            context.beginPath();-->
<!--                                            context.moveTo(0, 60);-->
<!--                                            context.bezierCurveTo(90, -60, 180, 125,320, 0);-->
<!--                                            context.lineWidth = 15;-->
<!--                                            context.strokeStyle = 'black';-->
<!--                                            context.stroke();-->
<!--                                        </script>-->
<!--                                        <p id="object-label">Object</p>-->
<!--                                    </div>-->
                                </div>
                            </div>

                            <script>
                                var tableNumber=0;
                                var ObjectLayoutNumber=0;
                                var currentTableNumber=0;

                                function getMaxTableNumber(){
                                    var tables=$('.tableLayout');
                                    var max=0;
                                    if (tables.length!=0){
                                        for (var i=0;i < tables.length;i++){
                                            var id=$(tables)[i].id;
                                            var temp=parseInt(id.replace('table',''));
                                            if (temp>max){
                                                max=temp;
                                            }
                                        }
                                    }
                                    return max+1;
                                }
                                $(document).ready(function () {
                                    drawTableLayout();
                                    var tableLayout='';
                                    var tableLayoutX=0;
                                    var tableLayoutY=0;
                                    var tableType=0;
                                    var isTableCreate=false;

                                    var ObjectLayout='';
                                    var isObjectCreate=false;
                                    var ObjectLayoutX=0;
                                    var ObjectLayoutY=0;

                                    var ObjectLabel='';
                                    var ObjectLabelX=0;
                                    var ObjectLabelY=0;
                                    var isObjectLabelCreate=false;

                                    var parentX=$("#tableArea").offset().left;
                                    var parentY=$('#tableArea').offset().top;
                                    var parentRight=parentX+$("#tableArea").width();
                                    var parentBottom=parentY+$("#tableArea").height();
                                    var mousedown=false;
                                    var scrollX=0;
                                    var scrollY=0;
                                    var ObjectDraggable=true;

                                    $( window ).scroll(function() {
                                        scrollX=window.pageXOffset;
                                        scrollY=window.pageYOffset;
                                    });


                                    $('#rect').click(function () {
                                        isTableCreate=true;
                                        if (isObjectCreate==true){
                                            isObjectCreate=false;
                                        }
                                        if (isObjectLabelCreate==true){
                                            isObjectLabelCreate=false;
                                        }
                                        tableType=1;
                                        $('#tableArea').css('cursor','crosshair');

                                    });

                                    $('#circle').click(function () {
                                        isTableCreate=true;
                                        if (isObjectCreate==true){
                                            isObjectCreate=false;
                                        }
                                        if (isObjectLabelCreate==true){
                                            isObjectLabelCreate=false;
                                        }
                                        tableType=2;
                                        $('#tableArea').css('cursor','crosshair');

                                    })


                                    
                                    $('#create-object-label').click(function () {
                                        if (isTableCreate==true){
                                            isTableCreate=false;
                                        }
                                        if (isObjectLabelCreate==true){
                                            isObjectLabelCreate=false;
                                        }
                                        isObjectCreate=true;
                                        $('#tableArea').css('cursor','crosshair');
                                    })

                                    // $('#label').click(function () {
                                    //     if (isTableCreate==true){
                                    //         isTableCreate=false;
                                    //     }
                                    //     if (isObjectCreate==true){
                                    //         isObjectCreate=false;
                                    //     }
                                    //     isObjectLabelCreate=true;
                                    //     $('#tableArea').css('cursor','crosshair');
                                    //
                                    // })


                                    $('#tableArea').on('mousedown',function (e) {
                                        if (isTableCreate==true){
                                            mousedown=true;
                                            tableNumber=getMaxTableNumber();
                                            console.log(tableNumber);


                                            tableLayout=document.createElement('div');
                                            tableLayout.className='ui-widget-content tableLayout';
                                            tableLayout.id='table'+tableNumber.toString();
                                            $(tableLayout).css('position','absolute');
                                            $(tableLayout).css('background','green');
                                            $(tableLayout).hide();
                                            $('#tableArea').append(tableLayout);
                                            scrollX=window.pageXOffset;
                                            scrollY=window.pageYOffset;
                                            tableLayoutX=parseInt(e.clientX-parentX);
                                            tableLayoutY=parseInt(e.clientY-parentY);
                                            $(tableLayout).css('left',tableLayoutX+scrollX);
                                            $(tableLayout).css('top',tableLayoutY+scrollY);
                                        }
                                        if (isObjectCreate==true){
                                            mousedown=true;
                                            ObjectLayoutNumber++;
                                            ObjectLayout=document.createElement('div');
                                            ObjectLayout.className='ui-widget-content ObjectLayout';
                                            ObjectLayout.id='ObjectLayout'+ObjectLayoutNumber.toString();
                                            $(ObjectLayout).hide();
                                            $('#tableArea').append(ObjectLayout);
                                            scrollX=window.pageXOffset;
                                            scrollY=window.pageYOffset;
                                            ObjectLayoutX=parseInt(e.clientX-parentX);
                                            ObjectLayoutY=parseInt(e.clientY-parentY);
                                            $(ObjectLayout).css('left',ObjectLayoutX+scrollX);
                                            $(ObjectLayout).css('top',ObjectLayoutY+scrollY);
                                        }

                                    });
                                    $('#tableArea').on('mouseup',function (e) {
                                        $('#tableArea').css('cursor','default');
                                        if (mousedown){
                                            if (isTableCreate){
                                                var displayTableNumber=document.createElement('input');
                                                displayTableNumber.className='displayTableNumber';
                                                $(displayTableNumber).val(tableNumber);
                                                displayTableNumber.id='displayTableNumber'+tableNumber;

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

                                                $(tableLayout).append(displayTableNumber);
                                                var showMaxguest=document.createElement('input');
                                                showMaxguest.id='showMaxguest'+tableNumber;
                                                showMaxguest.setAttribute("type", "text");
                                                showMaxguest.className='showMaxguest';
                                                $(showMaxguest).val('(0)');

                                                $(showMaxguest).blur(function () {
                                                    var id=$(this).parent().attr('id');
                                                    var tableNumber=id.replace('table','');
                                                    saveTableLayout(tableNumber,tableNumber);
                                                })

                                                $(tableLayout).append(showMaxguest);
                                                var label=document.createElement('input');
                                                label.id='tableLabel'+tableNumber;
                                                label.className='tableLabel';
                                                label.setAttribute("type", "text");
                                                $(label).val('Open');
                                                $(label).css('left',tableLayoutX+scrollX+$(tableLayout).width()+0);
                                                $(label).css('top',tableLayoutY+scrollY+$(tableLayout).height()/2);
                                                $(label).css('position','absolute');
                                                $(label).attr("readonly", true);
                                                $(tableLayout).append(label);

                                                saveTableLayout(tableNumber,tableNumber);

                                                mousedown=false;
                                                isTableCreate=false;
                                                $(tableLayout).draggable({
                                                    drag:function () {
                                                        scrollX=window.pageXOffset;
                                                        scrollY=window.pageYOffset;
                                                        parentX=$("#tableArea").offset().left;
                                                        var offset=$(this).offset();
                                                        var xpos=offset.left;
                                                        var ypos=offset.top;
                                                        var id=$(this).attr('id');
                                                        var number=id.replace('table','');

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
                                                        var id=$(this).attr('id');
                                                        var number=id.replace('table','');
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

                                            if (isObjectCreate){
                                                $(ObjectLayout).draggable({
                                                    stop:function () {
                                                        var id=this.id;
                                                        var objectLayoutNumber=id.replace('ObjectLayout','');
                                                        saveObjectLayout(objectLayoutNumber);
                                                    }
                                                });
                                                $(ObjectLayout).resizable({
                                                    stop:function () {
                                                        var id=this.id;
                                                        var objectLayoutNumber=id.replace('ObjectLayout','');
                                                        saveObjectLayout(objectLayoutNumber);
                                                    }
                                                });
                                                $(ObjectLayout).dblclick(function () {
                                                    // $(this).draggable( 'disable' );
                                                    var isDisabled = $(this).draggable('option', 'disabled');
                                                    if (isDisabled){
                                                        $(this).draggable("enable");
                                                    }
                                                    else{
                                                        $(this).draggable("disable");
                                                    }
                                                });
                                                $(ObjectLayout).contextmenu(function(e) {
                                                    var id=this.id;
                                                    var objectLayoutNumber=id.replace('ObjectLayout','');
                                                    $(this).remove();
                                                    removeObjectLayout(objectLayoutNumber);
                                                    e.preventDefault();
                                                });


                                            //Create Object Label
                                                var LayoutObjectLabel=document.createElement('input');
                                                LayoutObjectLabel.className='LayoutObjectLabel';
                                                LayoutObjectLabel.setAttribute('type','text');
                                                LayoutObjectLabel.id='LayoutObjectLabel'+ObjectLayoutNumber.toString();
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

                                                saveObjectLayout(ObjectLayoutNumber.toString());

                                                mousedown=false;
                                                isObjectCreate=false;
                                            }
                                            // if (isObjectLabelCreate){
                                            //     $(ObjectLabel).draggable({
                                            //         start: function( event, ui ) {
                                            //             $(this).data('preventBehaviour', true);
                                            //         }
                                            //     })
                                            //
                                            //     $(ObjectLabel).resizable();
                                            //     isObjectLabelCreate=false;
                                            //     mousedown=false;
                                            // }
                                        }
                                    })
                                    $('#tableArea').on('mousemove',function (e) {
                                        if(mousedown){
                                            if (isTableCreate){
                                                $(tableLayout).show();
                                                var currentX=e.clientX;
                                                var currentY=e.clientY;
                                                var width=currentX-tableLayoutX-parentX;
                                                var height=currentY-tableLayoutY-parentY;
                                                if (tableType==1){
                                                    $(tableLayout).css('width',width);
                                                    $(tableLayout).css('height',height);
                                                }
                                                else{
                                                    $(tableLayout).css('width',width);
                                                    $(tableLayout).css('height',width);
                                                    $(tableLayout).css('border-radius',width/2);
                                                }
                                            }
                                            if (isObjectCreate){
                                                $(ObjectLayout).show();
                                                var currentX=e.clientX;
                                                var currentY=e.clientY;
                                                var width=currentX-ObjectLayoutX-parentX;
                                                var height=currentY-ObjectLayoutY-parentY;
                                                $(ObjectLayout).css('width',width);
                                                $(ObjectLayout).css('height',height);
                                            }
                                            if (isObjectLabelCreate){
                                                $(ObjectLabel).show();
                                                var currentX=e.clientX;
                                                var currentY=e.clientY;
                                                var width=currentX-ObjectLabelX-parentX;
                                                var height=currentY-ObjectLabelY-parentY;
                                                $(ObjectLabel).css('width',width);
                                                $(ObjectLabel).css('height',height);
                                            }
                                        }
                                    })
                                })
                            </script>


                        </div>
                    </div>
                    <?php
                    break;
                default:
                    ?>
                <!-- Alternative Content Box Start -->
                     <div class="contentcontainer">
                        <div class="headings altheading">
                            <h2>Latest Orders</h2>
                        </div>
                        <div class="contentbox">
                            <table width="100%" id="latestOrders">
                                <thead>
                                    <tr>
                                         <th style="width: 1px;">OrderSeq#</th>
                                         <th>Invoice#</th>
    <!--    	                    	 <th>Owner Name</th>  	                    -->
                                        <th>Phone Number</th>
                                        <th>Item Ordered</th>
                                        <th>Cook With</th>
                                        <th  style="width: 1px;">Qty</th>
                                        <th  style="width: 1px;">Paid</th>
                                        <th style="width: 20px;">T#</th>
                                        <th>Date Ordered</th>

                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                     $pages = new Paginator;
                     $pages->items_total = count(orderPaidList());
                     $pages->mid_range = 10;
                     $pages->default_ipp = 10;
                     $pages->paginate();
                    $olist = orderPaidList('', $pages->limit);
                    if(count($olist) == 0) { echo '
                            <div class="status error">
                                <p class="closestatus"><a href="" title="Close">x</a></p>
                                <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> No orders available.</p>
                            </div>';
                    } else {
                    $i=1;
                    foreach($olist as $order) {
                    $isCompleted = ($order['orderCompleted'] == 1) ? 'complete' : '';
                    $name = (trim($order['cName']) == '') ? 'not registered' : $order['cName'];
                    $cash = ($order['cash'] == '0') ? '<font color="green">Y</font>' : '<font color="red">N</font>';
                    echo '
                                            <tr data-id="'.$order['id'] .'" class="'.$isCompleted.'">
                                                         <td>'.$order['id'] .'</td>
                                                         <td>'.$order['orderID'] .'</td>									 
                    
                                                <td>'.$order['phone'].'</td>
                                                <td>'.$order['itemCode'].' - '.$order['name'].'</td>
                                                <td>'.$order['cookWith'].'</td>
                                                <td>'.$order['quantity'].'</td>
                                                <td>'.$cash.'</td>
                                                <td>'.$order['tableNum'].'</td>                            
                                                <td>'.$order['dateOrdered'].'</td>                                                                                    
                                              
                                            </tr>';
                    $i++;
                    }
                    }
                    ?>

                                         </tbody>
                                    </table>
                                    <div class="pagination">
                           <?php echo $pages->display_pages(); ?>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>
                            <!-- Alternative Content Box End -->
                    <?php
                    break;
            }
            ?>

                <div style="clear:both;"></div>

                <!-- Content Box Start -->

                <!-- Content Box End -->
                <div id="footer">
                    &copy; Copyright 2013 DaValleyGrill
                </div>
    </div>
    <!-- Right Side/Main Content End -->
    
        <!-- Left Dark Bar Start -->
    <div id="leftside">
    	<div class="user">
        	<img src="img/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
            <p>Logged in as:</p>
            <p class="username">Administrator</p>
            <p class="userbtn"><a href="?action=logout" title="">Log out</a></p>
        </div>

        <ul id="nav">
        	<li>
                <ul class="navigation">
                    <li class="heading selected">Welcome</li>
                    <li><a href="index.php" title="">Latest Orders</a></li>
                    <li><a href="?action=addcategories" title="">Add Categories</a></li>
                    <li><a href="?action=managecategories" title="">Manage Categories</a></li>
                    <li><a href="?action=additems" title="">Add Items</a></li>                    
                    <li><a href="?action=manageitems" title="">Manage Items</a></li>
                    <li><a href="?action=managemenu" title="">Manage Menu</a></li>
                    <li><a href="?action=managecustomers" title="">Manage Customers</a></li>
                    <li><a href="?action=addemployee" title="">Add Employee</a></li>
                    <li><a href="?action=manageemployee" title="">Manage Employee</a></li>
                    <li><a href="?action=managetable" title="">Manage Table Layout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Left Dark Bar End --> 
    
    
    
<!--	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js'></script>-->
<!--    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js'></script>-->
	<script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
    <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
    <script type="text/javascript" src='scripts/functions.js'></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#manageEmployeeTable').DataTable({
                "scrollX": true
            })
        })
    </script>



   <script type='text/javascript' src='scripts/png_fix.js'></script>
   <script>
	function playAudio(id) {
		$('#product' + id + '_play').get(0).play();
	}
	function Buzz() {
		$('#buzzer').get(0).play();
	}
	function playSrc(src) {
	var videoUrl = src;
		$('#product_sound').attr('src', videoUrl);
		$('#product_sound').get(0).play();
	
	}
    </script>
    <script>
        function addSource(elem, path) {
          $('<source>').attr('src', path).appendTo(elem);
        }
        var check;
        var CONFIG_DELAY = <?php echo $CONFIG['sound_interval']; ?>;
        var REFRESH_DELAY = <?php echo $CONFIG['refresh_interval']; ?>;
        var isCompleted;
        function checkForMessages() {
            var delay = 1000;
            $.getJSON("newOrders.php", function(data) {
                // $.each(data, function (index, value) {
                //     isCompleted = (value.orderCompleted == 1) ? 'completed' : '';
                //     if(value.cash == 0) {
                //         value.cash = '<font color="green">Y</font>';
                //     } else{
                //             value.cash = '<font color="red">N</font>';
                //     }
                //     Buzz();
                //     if(value.itemAudio != '') {
                //         var audio = $('<audio>', {
                //            autoPlay : 'autoplay',
                //            OnLoadedData : 'var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, '+delay+')',
                //            controls : 'controls'
                //         });
                //         addSource(audio, '/images/products/' + value.itemAudio);
                //         audio.appendTo('body');
                //         playSrc('/images/products/' + value.itemAudio);
                //         delay = delay + CONFIG_DELAY;
                //     }
                // });

                if (data.length>0){
                    Buzz();
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            });
        }
        check = setInterval(checkForMessages, REFRESH_DELAY);
    </script>

    <script>
        DD_belatedPNG.fix('img, .notifycount, .selected');
    </script>

    </body>
</html>
