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

if($_GET['action'] == 'logout') { 
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
<!-- Theme End -->
</head>
<body id="homepage">
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
//console.log(src);
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
switch($_GET['action']) {
case 'additems':
if($_POST['action'] == 'additems') {

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
$cooktime = $_POST['timehr'].':'.$_POST['timemin'].':'.$_POST['timesec'];

    $query_update = "INSERT INTO `items` (categoryID, itemName, itemDescription, itemPrice, cooktime, itemCode, itemImage, itemAudio, cook_time) VALUES ('".$_POST['cid']."','".$_POST['itemname']."','".$_POST['itemdescription']."','".$_POST['itemprice']."','".$cooktime."','".$_POST['itemcode']."' ".$img . $audio ."','".$_POST['cook_time']. ");";
    $result = $mysqli->query($query_update);
    if($mysqli->affected_rows > 0) { $success =1; } 


if($success == 1) {
echo '
        <div class="status success">
        	<p class="closestatus"><a href="" title="Close">x</a></p>
        	<p><img src="img/icons/icon_success.png" alt="Correct" /><span>Success!</span> Item has been added.</p>
        </div>
';
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
					<label for="smallbox"><strong>Set Cook Time:</strong></label>
					   <select name="timehr">
                    	<option value="">Hour</option>';
for($i=0;$i<=24;$i++) {
echo '<option value="'.$i.'">'.$i.'</option>';
}                    	              
echo '                    
                    </select> 
					   <select name="timemin">
                    	<option value="">Min</option>';
for($i=0;$i<=60;$i++) {
echo '<option value="'.$i.'">'.$i.'</option>';
}                    	              
echo '                    
                    </select> 
					   <select name="timesec">
                    	<option value="">Sec</option>';
for($i=0;$i<=60;$i++) {
echo '<option value="'.$i.'">'.$i.'</option>';
}                    	              
echo '                    
                    </select> <br /> <br />
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
            </div>
';

break;
case 'addcategories':
if($_POST['action'] == 'addcategories') {
    $query_update = "INSERT INTO `categories` (CategoryName, CategoryNote, OrderID) VALUES ('".$_POST['cname']."','".$_POST['cnote']."','".$_POST['oid']."');";
#    exit($query_update);
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
            </div>
';


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
$cooktime = $_POST['timehr'].':'.$_POST['timemin'].':'.$_POST['timesec'];
    $query_update = "UPDATE `items` SET sideOrderCat='".$_POST['sideOrderCat']."', sideOrderLimit='".$_POST['sideOrderLimit']."', categoryID='".$_POST['category']."', itemName='".$_POST['name']."', cooktime='".$cooktime."', itemDescription='".$_POST['description']."', itemPrice='".$_POST['price']."' ".$img . $audio . ",cook_time = '".$_POST['cook_time']."' WHERE itemID='".$_GET['id']."'";

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

echo '               </p>                
                   
							<p>
                        <label for="smallbox"><strong>Audio File:</strong></label>
                        <input type="file" id="uploader" value="" name="audiofile" /> *.mp3'; if($item_details['itemAudio'] != '') { echo '<audio id="product'.$_GET['id'].'_play" src="'.$CONFIG['image_location'] . "/" . $item_details['itemAudio'].'" type="audio/mp3"></audio> - <a href="javascript:;" onclick="playAudio(\''.$_GET['id'].'\');" id="play">Play audio</a>'; }  echo '&nbsp;&nbsp;&nbsp;&nbsp; <a href="audioRecord.html" title="Record Voice then Upload it" target="_blank">Record Voice Now</a>'; 
echo '                    </p>                

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
					 <label for="smallbox"><strong>Set Cook Time:</strong></label>
					   <select name="timehr">
                    	<option value="">Hour</option>';
for($i=0;$i<=24;$i++) {
	$selected = ($i == $timehr) ? "selected" : "";
echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
}                    	              
echo '                    
                    </select> 
					   <select name="timemin">
                    	<option value="">Min</option>';
for($i=0;$i<=60;$i++) {
	$selected = ($i == $timemin) ? "selected" : "";
echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
}                     	              
echo '                    
                    </select> 
					   <select name="timesec">
                    	<option value="">Sec</option>';
for($i=0;$i<=60;$i++) {
	$selected = ($i == $timesec) ? "selected" : "";
echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
}                    	              
echo '                    
                    </select> <br /> <br />
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
			var $newRow = $('<tr data-id="'+value.id+'" class="' + isCompleted + '"><td>'+value.id+'</td><td>'+value.orderID+'</td><td>'+value.phone+'</td><td>'+value.name+' - '+value.description+'</td><td>'+value.cookWith+'</td><td>'+value.quantity+'</td><td>'+value.cash+'</td><td>'+value.dateOrdered+'</td></tr>');
			$('#latestOrders tr:first').after($newRow);
			$newRow.effect("highlight", {}, 10000);            

Buzz();
if(value.itemAudio != '') {
  var audio = $('<audio />', {
       //autoPlay : 'autoplay',
       OnLoadedData : 'var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, '+delay+')'
      // controls : 'controls'
  
     });
addSource(audio, '/images/products/' + value.itemAudio);
audio.appendTo('body');
//playSrc('/images/products/' + value.itemAudio);
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
									 <th style="width: 1px;">Order Number</th>  	     	                    	 
								 	 <th>Unique Number</th>									 
<!--    	                    	 <th>Owner Name</th>  	                    -->
                            <th>Phone Number</th>			
                            <th>Item Ordered</th>
                            <th>Cook With</th>
                            <th  style="width: 1px;">Quantity</th>
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
                            <td>'.$order['name'].' - '.$order['description'].'</td>
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
                </ul>
            </li>
        </ul>
    </div>
    <!-- Left Dark Bar End --> 
    
    
    <script type="text/javascript" src="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js"></script>	
    <script type='text/javascript' src='http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js'></script>
	<script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
    <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
    <script type="text/javascript" src='scripts/functions.js'></script>
    
    <!--[if IE 6]>
    <script type='text/javascript' src='scripts/png_fix.js'></script>
    <script type='text/javascript'>
      DD_belatedPNG.fix('img, .notifycount, .selected');
    </script>
    <![endif]--> 
</body>
</html>
