<?php
session_start();
include_once("../SMS_Module/classes/config.php");
$conf_number = "";
if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
?>
    <h2 style="margin: 0">Da Valley Grill</h2>
    <h3 style="margin: 0">Hawaiian Style Asian Food</h3>
    <h5 style="margin: 0">2040 W.Deer Vallery Rd.<br> Phoenix, AZ 85032</h5>
    <script>
    	window.print();
    </script>
		    <table class="table3" width="99%">
            <tr>
                <thead>
                    <th>#</th>
                    <th>Product</th>
<!--                    <th>Description</th> -->
                    <th>Qty</th>
                    <th>Price</th>
                </thead>
                <tbody></tbody>
            </tr>
    <?php
	
	foreach($_SESSION['products'] as $item) {

    if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }

echo '<tr valign="top">
	<td style="font-size:18px">'.($i+1).'.</td>
	<td style="font-size:18px">'.$item['itemName'] . $cookWith . '</td>
	<td style="font-size:18px"> '.$item['quantity'].' </td>		
	<td style="font-size:18px">'.$item['itemPrice'].'</td>	
      </tr>
';
$i++;
$totalPrice += ($item['itemPrice'] * $item['quantity']);
}
$total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
$totalPrice += $total_tax;
$totalPrice = round($totalPrice,2);
$total_tax = round($total_tax, 2);

echo '<tr valign="top"><td></td><td></td><td style="font-size:18px"><b>Tax:</b></td><td style="font-size:18px">$'.$total_tax.'</td></tr>';
?>
	<tr>
		<td></td>
		<td></td>
		<td>
			<strong>Tip:</strong>
		</td>
		<td>
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
		</td>
	</tr>
<?php
echo '<tr><td></td><td></td><td><b>Total Price:</b></td><td>$'.$totalPrice.'</td></tr>';
?>