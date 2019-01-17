<?php
session_start();
include("classes.php");
$obj=new Classes();

if(isset($_REQUEST['order_id'])){
    $order_history = $obj->get_order_item_list($_REQUEST['order_id']);
    $order_detail = $obj->get_payment_detail($_REQUEST['order_id']);
}


$htmlRow = "";
$invoiceNum=$_REQUEST['order_id'];
$i=0;
$items_txt='';
while ($item = $order_history->fetch_array()) {
    $htmlRow .= '<div class="label">
						<div class="no">'.($i+1).'</div>
						<div class="name">'.$item['itemName'] . $cookWith . '</div>
						<div class="amount">'.$item['quantity'].'</div>
						<div class="price">$'.$item['itemPrice'].'</div>
					</div>
			<div style="clear:both"></div>';
    $i++;
}
echo $htmlRow;


$discount_amt= $order_detail['discount_amt'];
$tip_amt=$order_detail['tip_amt'];
$balance_amt=$order_detail['balance_amt'];
$tendered_amt=$order_detail['tendered_amt'];
$cash_change=$order_detail['cash_change'];
$charge=$obj->get_order_total_amount_by_id($_REQUEST['order_id']);


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
							<div class="title"><b>Discount:</b></div>
							<div class="value">'."$".$discount_amt.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Tip:</b></div>
							<div class="value">'."$".$tip.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Total:</b></div>
							<div class="value">'."$".$balance_amt.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Tender:</b></div>
							<div class="value">'."$".$tendered_amt.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Cach Change:</b></div>
							<div class="value">'."$".$cash_change.'</div>
						</div>
						<div class="row">
							<div class="title"><b>Charge:</b></div>
							<div class="value">'."$".$charge.'</div>
						</div>

					</div>
				</div>
			</div>
			</body>
			</html>
    	';


include("../../mpdf/mpdf.php");
$mpdf=new mPDF();
$mpdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('print.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->Output('receipt.pdf','D');

?>





