<?php
session_start();
include_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

$invoiceNum = GetUniqueID();
$conf_number = "";
$download_type=1;  //0=>pdf, 1=>txt
if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
?>
<?php
	$htmlRow = "";
	$i =0;
	$totalPrice = 0;
	foreach($_SESSION['products'] as $item) {
		if(!empty($item['cookWith']))
		{
			$cookWith = " with ". $item['cookWith'];
		}
		else {
			$cookWith = "";
		 }


		$htmlRow .= '<div class="label">
						<div class="no">'.($i+1).'</div>
						<div class="name">'.$item['itemName'] . $cookWith . '</div>
						<div class="amount">'.$item['quantity'].'</div>
						<div class="price">$'.$item['itemPrice'].'</div>
					</div>
			<div style="clear:both"></div>';

			$i++;
			$totalPrice += ($item['itemPrice'] * $item['quantity']);
	}

		if($_SESSION["tipType"] == "percentage") {
			$tipValue = $_SESSION["tipValue"];
			$tip = '$'.number_format($tipAmount = ( ($totalPrice*$tipValue)/100 ), 2);
			$totalPrice += $tipAmount;
		} else {
			$tipValue = $_SESSION["tipValue"];
			$tip = '$'.(number_format($tipValue,2));
			$totalPrice += $tipValue;
		}
		$totalPrice_print ='$'. $totalPrice;
		$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
		$totalPrice += $total_tax;
		$totalPrice = round($totalPrice,2);
		$total_tax = round($total_tax, 2);
		$total_tax_print = '$'.$total_tax;

    	$html = '
			<html>
			<body>

			 <div id ="pdf" style="width:300px;">
			    <h6 style="margin: 0">---------------Receipt#&nbsp;&nbsp;&nbsp;&nbsp;'.$invoiceNum.'</h6>
			 	<br>
				<h4 style="margin: 0">Da Valley Grill</h4>
			    <h6 style="margin: 0">Hawaiian Style Asian Food</h6>
			    <h6 style="margin: 0">2040 W.Deer Vallery Rd.<br> Phoenix, AZ 85032</h6>

			    <hr/>

				<div class="label">
					<div class="no"><b>#</b></div>
					<div class="name"><b>Items</b></div>
					<div class="amount"><b>............Qty</b></div>
					<div class="price"><b>...Price</b></div>
				</div>
				<div style="clear:both"></div>'.$htmlRow.'
				<div class="foot">
					<div class="left"></div>
					<div class="right">
						<div class="row">
							<div class="title"><b>Tax:</b></div>
							<div class="value">'.$total_tax_print.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Tip:</b></div>
							<div class="value">'.$tip.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Total:</b></div>
							<div class="value">'.$totalPrice_print.'</div>
						</div>
						
					</div>
				</div>
			</div>
			</body>
			</html>
    	';


	include("../mpdf/mpdf.php");
	  $mpdf=new mPDF();
	  $mpdf->SetDisplayMode('fullpage');
	  $stylesheet = file_get_contents('print.css');
	  $mpdf->WriteHTML($stylesheet,1);
	  $mpdf->WriteHTML($html);
	  $mpdf->Output('receipt.pdf','D');

?>	

   

			

