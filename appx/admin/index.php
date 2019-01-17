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
if($_SESSION['logat'] == false) { header("Location: login.php"); exit();}
if(isset($_GET['action']) and $_GET['action'] == 'logout') { 
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
<link href="themes/blue/styles.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="http://code.jquery.com/jquery-2.0.2.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

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
if(!isset($_GET['action'])){
    $_GET['action'] = "";
}
switch($_GET['action']) {
    case 'additems':
        if (!empty($_POST)) {
            if ($_POST['action'] == 'additems') {
                if (empty($_POST['itemcode'])) {
                    die('Item Code is empty');
                }
                $select = $mysqli->query("SELECT * FROM `items` WHERE itemCode = '" . $_POST['itemcode'] . "'");
                if ($select->num_rows > 0) {
                    die('Item Code already exists in database');
                }
                if (isset($_FILES['thumb']['tmp_name'])) {
                    if (!move_uploaded_file($_FILES["thumb"]["tmp_name"], dirname(__DIR__) . "/images/products/" . $_FILES["thumb"]["name"])) {
                        $success = 0;
                    }
                }
                if (isset($_FILES['audiofile']['tmp_name'])) {
                    if (!move_uploaded_file($_FILES["thumb"]["tmp_name"], dirname(__DIR__) . "/images/products/" . $_FILES["audiofile"]["name"])) {
                        $success = 0;
                    }
                }
                $img = isset($_FILES['thumb']['name']) ? ', \'' . $_FILES['thumb']['name'] . '\'' : '';
                $audio = isset($_FILES['audiofile']['name']) ? ', \'' . $_FILES['audiofile']['name'] . '\'' : '';

                $query_update = "INSERT INTO `items` (categoryID, itemName, itemDescription, itemPrice, itemCode, itemImage, itemAudio) VALUES ('" . $_POST['cid'] . "','" . $_POST['itemname'] . "','" . $_POST['itemdescription'] . "','" . $_POST['itemprice'] . "','" . $_POST['itemcode'] . "' " . $img . $audio . ");";
                $result = $mysqli->query($query_update);
                if ($mysqli->affected_rows > 0) {
                    $success = 1;
                }
                if ($success == 1) {
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
                        </div>';
                }
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
        if (!empty($_POST)) {
            if ($_POST['action'] == 'addcategories') {
                $query_update = "INSERT INTO `categories` (CategoryName, CategoryNote, OrderID) VALUES ('" . $_POST['cname'] . "','" . $_POST['cnote'] . "','" . $_POST['oid'] . "');";
                #    exit($query_update);
                $result = $mysqli->query($query_update);
                if ($mysqli->affected_rows > 0) {
                    $success = 1;
                }
                if ($success == 1) {
                    echo '        
                        <div class="status success">
                            <p class="closestatus"><a href="" title="Close">x</a></p>
                            <p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Category has been added.</p>
                        </div>';

                } else {
                    echo '
                        <div class="status error">
                            <p class="closestatus"><a href="" title="Close">x</a></p>
                            <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Category couldn\'t be  added.</p>
                        </div>';
                }
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
                    </div> ';
            } else {
                echo '
                    <div class="status error">
                        <p class="closestatus"><a href="" title="Close">x</a></p>
                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Item couldn\'t be  modified. Nothing to change</p>
                    </div>';
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
                        <input type="file" id="uploader" value="'.$item_details['itemImage'].'" name="thumb" />';
                        if($item_details['itemImage'] != '') { echo '<a href="'.$CONFIG['image_location'] . "/" . $item_details['itemImage'].'" target="_blank"><img src="'.$CONFIG['image_location'] . "/" . $item_details['itemImage'].'" height="100"/></a>'; }
        echo '      </p>                  
                    <p>
                        <label for="smallbox"><strong>Audio File:</strong></label>
                        <input type="file" id="uploader" value="" name="audiofile" /> *.mp3'; if($item_details['itemAudio'] != '') { echo '<audio id="product'.$_GET['id'].'_play" src="'.$CONFIG['image_location'] . "/" . $item_details['itemAudio'].'" type="audio/mp3"></audio> - <a href="javascript:;" onclick="playAudio(\''.$_GET['id'].'\');" id="play">Play audio</a>'; }  echo '&nbsp;&nbsp;&nbsp;&nbsp; <a href="audioRecord.html" title="Record Voice then Upload it" target="_blank">Record Voice Now</a>';
        echo '                   
                    </p>
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
            </div>';
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
                    </div>';
            } else {
                echo '
                    <div class="status error">
                        <p class="closestatus"><a href="" title="Close">x</a></p>
                        <p><img src="img/icons/icon_error.png" alt="Error" /><span>Error!</span> Customer couldn\'t be  modified. Nothing to change</p>
                    </div>';
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
            </div>';
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
        $page = $_GET['page'];
        $nextpage = $_GET['page'] + 1;
        $prevpage = $_GET['page'] - 1;
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
        $page = $_GET['page'];
        $nextpage = $_GET['page'] + 5;
        $prevpage = $_GET['page'] - 5;
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
    case 'manageorders':
        ?>
         <div class="contentcontainer">
            <div class="headings altheading">
                <h2>Latest Orders</h2>
            </div>
            <div class="contentbox">
            <table id="manageordertbl" class="display nowrap" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Ticket No</th>
                    <th>Invoice</th>
                    <th>Item Ordered</th>
                    <th>Cook With</th>
                    <th>Qty</th>
                    <th>Paid</th>
                    <th>Date Ordered</th>                                                                               
                </tr>
            </thead>
            <tbody>
        <?php
        $olist = allOrderList();
        if(!empty($olist)){
            $i=1;
            foreach($olist as $order) {
                echo '
                <tr>
                    <td>'.$order['ticket_id'] .'</td>
                    <td>'.$order['id'] .'</td>
                    <td>'.$order['itemCode'].' - '.$order['itemName'].'</td>
                    <td>';
                ?>
                <?php if(!empty($order['side_order_items'])){ foreach($order['side_order_items'] as $side_order_item){ ?>
                    <?php echo $side_order_item['itemCode'] .' - '. $side_order_item['itemName']; ?> <br>
                    <?php } } ?>
                <?php
                echo        '
                </td>
                <td>'.$order['quantity'].'</td>                
                <td>'.$order['order_status'].'</td>                           
                <td>'.$order['added_date'].'</td>                          
            </tr>';
                $i++;
            }
        }
        ?>
             </tbody>
        </table>
                <!--
                <div class="pagination">

                <?php //echo $pages->display_pages(); ?>
                </div>-->
                <div style="clear: both;"></div>
            </div>
            
        </div>
        <!-- Alternative Content Box End -->
        <?php
        break;
    case 'addtax':
        $query_insert = "INSERT INTO apx_tax(tax_type,tax_percent,edate,status) VALUES('$_POST[taxtype]','$_POST[taxpercent]',NOW(),'$_POST[tax_status]')";
        $result = $mysqli->query($query_insert);
        if($result){
            echo '<script>window.location.href = "?action=managetax";</script>';
        }else{
            echo "Server Error";
        }
        break;
    case 'updatetax':
        $query_insert = "UPDATE apx_tax SET tax_type='$_POST[taxtype]', tax_percent='$_POST[taxpercent]', edate=NOW(), status='$_POST[tax_status]' WHERE tax_id='$_POST[action]'";
        $result = $mysqli->query($query_insert);
        if($result){
            echo '<script>window.location.href = "?action=managetax";</script>';
        }else{
            echo "Server Error";
        }
        break;
    case 'delete_tax':
        $query = "DELETE FROM apx_tax WHERE tax_id='$_REQUEST[del_id]'";
        $result = $mysqli->query($query);
        echo '<script>window.location.href = "?action=managetax";</script>';
        break;
    case 'managetax':
        if(isset($_REQUEST['edit_tax'])){
            $query = "SELECT * FROM apx_tax WHERE tax_id='$_REQUEST[edit_tax]'";
            $result = $mysqli->query($query);
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="contentcontainer">
            <div class="headings altheading">
                <h2>Tax Settings</h2>
            </div>
            <div class="contentbox">
                <div class="contentbox">
                    <form action="?action=<?php if(isset($_REQUEST['edit_tax'])){echo 'updatetax';}else{echo 'addtax';}?>" method="post">
                        <p>
                            <label for="textfield"><strong>Tax Type:</strong></label>
                            <input type="text" name="taxtype" id="textfield" value="<?php if(isset($_REQUEST['edit_tax'])){echo $row['tax_type'];}?>" class="inputbox" required="required" /> <br />
                        </p>
                        <p>
                            <label for="textfield"><strong>Tax Percentage</strong></label>
                            <input type="number" step=".01" name="taxpercent" id="textfield" value="<?php if(isset($_REQUEST['edit_tax'])){echo $row['tax_percent'];}?>" class="inputbox" required='required' style="width:5%;" /> % <br />
                        </p>
                        <p>
                            <label for="textfield"><strong>Staus</strong></label>
                            <select name="tax_status" required>
                                <option value="">Select Status</option>
                                <option value="on" <?php if(isset($_REQUEST['edit_tax']) and $row['status']=='on'){echo "Selected";}?>>ON</option>
                                <option value="off" <?php if(isset($_REQUEST['edit_tax']) and $row['status']=='off'){echo "Selected";}?>>OFF</option>
                            </select>
                        </p>
                        <p>
                        <input type="hidden" name="action" value="<?php if(isset($_REQUEST['edit_tax'])){echo $row['tax_id'];}else{echo "addtax";}?>"/>
                        </p>
                    <input type="submit" value="<?php if(isset($_REQUEST['edit_tax'])){echo 'Update Tax';}else{echo 'Add Tax';}?>" class="btn" name="tax_btn" />
                    </form>
                </div>
                <?php
                    if(!isset($_REQUEST['edit_tax'])){
                    ?>
                    <div class="contentbox">
                        <table id="" class="display nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tax Type</th>
                                    <th>Tax Percentage</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo $res = get_tax();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
        <?php
        break;
    case 'addemployee':
        if (!empty($_POST)){
            if($_POST['action'] == 'addemployee') {
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
    case 'deleteemployee':
        if(empty($_GET['id'])) { echo '<script>window.location.href=\'index.php?action=manageemployee\';</script>'; exit; }
        $mysqli->query("DELETE FROM `employee` WHERE ID='".$_GET['id']."'");
        echo '<script>window.location.href=\'index.php?action=manageemployee\';</script>';
        exit();
        break;
    case 'editemployee':
        if (!empty($_POST)){
            if($_POST['action'] == 'editemployee') {
                echo "Edit Employee";
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
                <table id="manageordertbl" class="display nowrap" width="100%" cellspacing="0">
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
            border:1px solid red;
            padding:0px;
            height:40vmax;
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
            border:5px black solid;
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
        }
        .showMaxguest{
            width:20px;
            position: absolute;
            top: 50%;
            left: 60%;
            right: 0;
            transform: translateY(-50%);
            background:transparent;
            font-size:17px;
            border:none;
        }
        .tableLabel{
            width:30px;
            padding:0;
            border:none;
            text-align:center;
            font-size:17px;
            width:70px;
            font-weight:bold;
            color:#ff3333;
        }
    </style>
        <div class="contentcontainer">
            <div class="headings altheading">
                <h2>Manage Table</h2>
            </div>
            <div class="contentbox">
                <div id="tableArea"></div>
                <div class="bottom-part">
                    <div id="create-table-part">
                        <p id="create-table-label">Create Table</p>
                        <div id="rect"></div>
                        <div id="circle"></div>
                    </div>
                    <div id="create-label-part">
                        <p id="create-object-label">Draw Objects</p>
                        <div id="label">
                            <div id="label-draw"></div>
                            <p id="label-text">Label</p>
                        </div>
                        <div id="object-part">
                            <canvas id="object"></canvas>
                                <script>
                                    var canvas = document.getElementById('object');
                                    var context = canvas.getContext('2d');
                                    context.beginPath();
                                    context.moveTo(0, 60);
                                    context.bezierCurveTo(90, -60, 180, 125,320, 0);
                                    context.lineWidth = 15;
                                    context.strokeStyle = 'black';
                                    context.stroke();
                                </script>
                            <p id="object-label">Object</p>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        // var tableTypeArray=[];
                        var tableTypeArray=new Array(20);
                        tableTypeArray[0]=0;
                        var tableNumber=0;
                        var tableLayout='';
                        var parentX=$("#tableArea").offset().left;
                        var parentY=$('#tableArea').offset().top;
                        var parentRight=parentX+$("#tableArea").width();
                        var parentBottom=parentY+$("#tableArea").height();
                        var tableLayoutX=0;
                        var tableLayoutY=0;
                        var mousedown=false;
                        var tableType=0;
                        var isCreate=false;
                        var scrollX=0;
                        var scrollY=0;
                        $('#rect').click(function () {
                            isCreate=true;
                            tableType=1;
                            $('#tableArea').css('cursor','crosshair');
                            tableTypeArray[tableNumber]=tableType;
                        });
                        
                        $('#circle').click(function () {
                            isCreate=true;
                            tableType=2;
                            $('#tableArea').css('cursor','crosshair');
                            tableTypeArray[tableNumber]=tableType;
                        })

                        $('#tableArea').on('mousedown',function (e) {
                            if (isCreate==true){
                                mousedown=true;
                                tableNumber++;
                                tableLayout=document.createElement('div');
                                tableLayout.className='ui-widget-content tableLayout';
                                tableLayout.id='table'+tableNumber.toString();
                                $(tableLayout).css('position','absolute');
                                $(tableLayout).hide();
                                $('#tableArea').append(tableLayout);
                                scrollX=window.pageXOffset;
                                scrollY=window.pageYOffset;
                                tableLayoutX=parseInt(e.clientX-parentX);
                                tableLayoutY=parseInt(e.clientY-parentY);
                                $(tableLayout).css('left',tableLayoutX+scrollX);
                                $(tableLayout).css('top',tableLayoutY+scrollY);

                            }
                        })
                        $('#tableArea').on('mouseup',function (e) {
                            $('#tableArea').css('cursor','default');
                            if (mousedown){
                                var displayTableNumber=document.createElement('h6');
                                displayTableNumber.className='displayTableNumber';
                                displayTableNumber.id='displayTableNumber'+tableNumber.toString();
                                $(displayTableNumber).text(tableNumber.toString())
                                $(tableLayout).append(displayTableNumber);

                                var showMaxguest=document.createElement('input');
                                showMaxguest.setAttribute("type", "text");
                                showMaxguest.className='showMaxguest';
                                showMaxguest.id='showMaxguest'+tableNumber.toString();
                                $(showMaxguest).val('(0)');
                                $(tableLayout).append(showMaxguest);

                                var label=document.createElement('input');
                                label.id='tableLabel'+tableNumber;
                                label.className='tableLabel';
                                label.setAttribute("type", "text");
                                $(label).val('');
                                $(label).css('border','1px solid #999999');
                                $(label).css('left',tableLayoutX+scrollX+$(tableLayout).width()+15);
                                $(label).css('top',tableLayoutY+scrollY+$(tableLayout).height()/2);
                                $(label).css('position','absolute');
                                $('#tableArea').append(label);
                                $(label).blur(function () {
                                    var text=$(this).val();
                                    if (text!=''){
                                        $(this).css('border','none');
                                    }
                                })
                            }
                            mousedown=false;
                            isCreate=false;
                            $(tableLayout).draggable({
                                drag:function () {
                                    var offset=$(this).offset();
                                    var xpos=offset.left;
                                    var ypos=offset.top;
                                    var number=$(this.getElementsByTagName('h6')).text();
                                    var tableLabel=document.getElementById('tableLabel'+number);
                                    $(tableLabel).css('left',xpos-parentX+scrollX+$(this).width()+15);
                                    $(tableLabel).css('top',ypos-parentY+scrollY+$(this).height()/2);
                                    if (parentX>=xpos || xpos+$(this).width()>=parentRight || parentY>=ypos || ypos+$(this).height()>=parentBottom){
                                        alert("Do you really want to delete");
                                        $(this).remove();
                                        $(tableLabel).remove();
                                    }
                                }
                            });
                            $(tableLayout).resizable({
                                resize:function (e,ui) {
                                    var number=$(this.getElementsByTagName('h6')).text();
                                    var tableLabel=document.getElementById('tableLabel'+number);
                                    var type=tableTypeArray[parseInt(number)-1];
                                    var offset=$(this).offset();
                                    var xpos=offset.left;
                                    var ypos=offset.top;
                                    if (type==2){
                                        $(this).css('width',(ui.size.height+ui.size.width)/2);
                                        $(this).css('height',(ui.size.height+ui.size.width)/2);
                                        $(this).css('border-radius',(ui.size.height+ui.size.width)/4);
                                    }
                                    $(tableLabel).css('left',xpos-parentX+scrollX+$(this).width()+15);
                                    $(tableLabel).css('top',ypos-parentY+scrollY+$(this).height()/2);
                                }
                            });
                        })
                        $('#tableArea').on('mousemove',function (e) {
                            if(mousedown){
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

                        })

                    })

                </script>

            </div>
        </div>
        <?php
        break;




    default:
        ?>
	<!-- <meta http-equiv="refresh" content="5">  -->
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
                $.each(data, function (index, value) {
                    isCompleted = (value.orderCompleted == 1) ? 'completed' : '';
                    if(value.cash == 0) {
                        value.cash = '<font color="green">Y</font>';
                        } else{
                            value.cash = '<font color="red">N</font>';
                            }
                        var $newRow = $('<tr data-id="'+value.id+'" class="' + isCompleted + '"><td>'+value.id+'</td><td>'+value.orderID+'</td><td>'+value.phone+'</td><td>'+value.itemCode+' - '+value.name+'</td><td>'+value.cookWith+'</td><td>'+value.quantity+'</td><td>'+value.cash+'</td><td>'+value.dateOrdered+'</td></tr>');
                        $('#latestOrders tr:first').after($newRow);
                        $newRow.effect("highlight", {}, 10000);
                    Buzz();
                    if(value.itemAudio != '') {
                      var audio = $('<audio/>', {
                           autoPlay : 'autoplay',
                           OnLoadedData : 'var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, '+delay+')'
                           controls : 'controls'
                         });
                        addSource(audio, '/images/products/' + value.itemAudio);
                        audio.appendTo('body');
                        playSrc('/images/products/' + value.itemAudio);
                        delay = delay + CONFIG_DELAY;
                    }
                });
            });
        }
        check = setInterval(checkForMessages, REFRESH_DELAY);

        </script>
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
                    <li><a href="?action=manageorders" title="">Manage Orders</a></li>  
                    <li><a href="?action=managetax" title="">Manage Tax</a></li>                    
                    <li><a href="?action=addemployee" title="">Add Employee</a></li>  
                    <li><a href="?action=manageemployee" title="">Manage Employee</a></li>
                    <li><a href="?action=managetable" title="">Manage Table Layout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <script type="text/javascript" src="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js"></script>
    <script type='text/javascript' src='http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js'></script>
	<script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
    <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
    <script type="text/javascript" src='scripts/functions.js'></script>
    

    <!--Datatable code start-->

    <script>
    $(document).ready(function() {
        $('#manageordertbl').DataTable( {
            "scrollX": true
        } );
    } );
    function delete_tax(id){
        if (confirm("Are you sure want to delete ?") == true) {
            window.location.href = "?action=delete_tax&del_id="+id;
        }
    }
    </script>
    <!--Datatable code ends-->


    <!--[if IE 6]>
    <script type='text/javascript' src='scripts/png_fix.js'></script>
    <script type='text/javascript'>
      DD_belatedPNG.fix('img, .notifycount, .selected');
    </script>
    <![endif]--> 
</body>
</html>
