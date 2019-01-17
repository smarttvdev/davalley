<?php
session_start();
include_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");


$invoiceNum = GetUniqueID();
$conf_number = "";
$query = "select download_type from sysfile limit 1";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$download_type= $row['download_type'];
if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
    $i =0;
    $totalPrice = 0;
    foreach($_SESSION['products'] as $item) {
        if(!empty($item['cookWith'])){
       	    $cookWith = " with ". $item['cookWith'];
		}else {
 	   		$cookWith = "";
    	}  	
	$i++;
	$totalPrice += ($item['itemPrice'] * $item['quantity']);
    }				
    $total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
    if($_SESSION["tipType"] == "percentage") {
        $tipValue = $_SESSION["tipValue"];
	$tip = '$'.number_format($tipAmount = ( ($totalPrice*$tipValue)/100 ), 2);
	$totalPrice += $tipAmount;
    } else {
	$tipValue = $_SESSION["tipValue"];
	$tip = '$'.(number_format($tipValue,2));
	$totalPrice += $tipValue;
    }
    $totalPrice += $total_tax;
    $totalPrice = round($totalPrice,2);
    $total_tax = round($total_tax, 2);
    $total_tax_print = '$'.$total_tax;
    $totalPrice_print ='$'. $totalPrice;


    $txt_receipt = '---------------Receipt#    '.$invoiceNum.'<br>Da Valley Grill<br>
    Hawaiian Style Asian Food<br>
    2040 W.Deer Vallery Rd.<br> Phoenix, AZ 85032<br>
    Phoenix, AZ 85032<br>
    ----------------------------------------------------<br>
    #        Items    ........Qty ......Amount<br>

    		            Tax:'.$total_tax_print.'<br>
    		            Tip:'.$tip.'<br>
    		            Total:'.$totalPrice_print;

	function stredit($str,$len=30){
	    if (strlen($str)<$len){
	    	$str_return = $str;
	    	for ($i=0 ; $i< $len- strlen($str) ; $i++)
	    	   $str_return.=" ";
	    	return $str_return;
	    }else{
	    	return substr($str , 0 , $len);
	    }
	}
	
	$items_txt = "";
	$i =0;
//	$totalPrice = 0;
	foreach($_SESSION['products'] as $item) {
		if(!empty($item['cookWith'])){
      			$cookWith = " with ". $item['cookWith'];
      		} 
       		else { 
       			$cookWith = "";
    		}  	

//	$items_txt .=($i+1)."  ".stredit($item['itemName'].$cookWith ,35)." ".$item['quantity']." ".$item['itemPrice']."\r\n";
	$i +=1; $items_txt .= $i." ".stredit($item['itemName'],35)." ".$item['quantity']."  ".$item['quantity']*$item['itemPrice']."\r\n ".$cookWith."\r\n";

	}				
	
	//text receipt
    	$txt_receipt = "------------------Receipt# ".$invoiceNum."\r\nDa Valley Grill\r\n
Hawaiian Style Asian Food\r\n
2040 W.Deer Vallery Rd.\r\n
Phoenix, AZ 85032\r\n
\r\n
#--Items----------------------------Qty-Amount\r\n".$items_txt.

"\r\n    		            	    Tax:".$total_tax_print."\r\n\r\n
    		            	    Tip:".$tip."\r\n\r\n
    		            	Total: $".$totalPrice;
    	$tempfile_txt = '1_tmp'.date('YmdHis');
    	$txt_url = '../tmp/'.$tempfile_txt.'.txt';
    	$f_txt = fopen($txt_url,'wb');
        fwrite($f_txt, $txt_receipt);
        fclose($f_txt);
        

	$print_text_receipt_script = '<html><body>
        <script type="text/javascript">
		function download(filename, url) {
		  var element = document.createElement("a");
		  element.setAttribute("href", url);
		  element.setAttribute("download", filename);
		  
		  element.style.display = "block";
		  document.body.appendChild(element);
		  element.click();
		  document.body.removeChild(element);
		}
			download("receipt1.txt","https://davalleygrill.com/tmp/'.$tempfile_txt .'.txt");console.log("downloaded?");
			
	</script>
	</body></html>
        ';
	$result=Array();
	$result['type']=$download_type;
    $result['textfile']=$tempfile_txt;
	echo json_encode($result);
?>

   

			

