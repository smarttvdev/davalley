<?php
session_start();
include_once("../SMS_Module/classes/config.php");
$conf_number = "";
if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
?>


<head>
  		<link rel="stylesheet" type="text/css" href="print.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/niklasvh/html2canvas/0.5.0-alpha2/dist/html2canvas.min.js"></script>
		<script type="text/javascript" src="http://cdn.rawgit.com/MrRio/jsPDF/master/dist/jspdf.min.js"></script>
	
</head>
<body  >

 <div id ="pdf" style="width:200px;">
	<h4 style="margin: 0">Da Valley Grill</h4>
    <h6 style="margin: 0">Hawaiian Style Asian Food</h6>
    <h6 style="margin: 0">2040 W.Deer Vallery Rd.<br> Phoenix, AZ 85032</h6>
    <hr/>

	<div class="label">
		<div class="no"><b>No</b></div>
		<div class="name"><b>Product</b></div>
		<div class="amount"><b>Quantity</b></div>
		<div class="price"><b>Price</b></div>
	</div>
	<div style="clear:both"></div>'

	 <?php
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
    

    
			    	echo '<div class="label">
							<div class="no">'.($i+1).'</div>
							<div class="name">'.$item['itemName'] . $cookWith . '</div>
							<div class="amount">'.$item['quantity'].'</div>
							<div class="price">'.$item['itemPrice'].'</div>
						</div>
						<div style="clear:both"></div>';

						$i++;
						$totalPrice += ($item['itemPrice'] * $item['quantity']);
				}


				$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
				$totalPrice += $total_tax;
				$totalPrice = round($totalPrice,2);
				$total_tax = round($total_tax, 2);


    ?>				 



	<div class="foot">
		<div class="left"></div>
		<div class="right">
			<div class="row">
				<div class="title"><b>Tax:</b></div>
				<div class="value"><?php echo '$'.$total_tax;?></div>
			</div>
			<div class="row">
				<div class="title"><b>Tip:</b></div>
				<div class="value">
					<?php
							if($_SESSION["tipType"] == "percentage") {
								$tipValue = $_SESSION["tipValue"];
								echo '$'.number_format($tipAmount = ( ($totalPrice*$tipValue)/100 ), 2);
								$totalPrice += $tipAmount;
							} else {
								$tipValue = $_SESSION["tipValue"];
								echo '$'.(number_format($tipValue,2));
								$totalPrice += $tipValue;
							}
					?>
				</div>
			</div>
			<div class="row">
				<div class="title"><b>Total Price:</b></div>
				<div class="value"><?php echo '$'.$totalPrice; ?></div>
			</div>
			
		</div>
	</div>
</div>

	<div id="editor"></div>
		
		  <script type="text/javascript">
		 	window.print();
		</script>
	</body>
</html>

