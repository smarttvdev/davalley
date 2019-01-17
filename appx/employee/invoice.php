<?php
    session_start();
    include("include/head.php");

    if(isset($_REQUEST['order_id'])){
    $order_history = $obj->get_order_item_list($_REQUEST['order_id']);
    $order_detail = $obj->get_payment_detail($_REQUEST['order_id']);
    $_SESSION['order_id']=$_REQUEST['order_id'];
?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>-->
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="js/functions.js"></script>

<div class="" id="print">
    <div class="container" style="padding-bottom: 90px;" id="DivIdToPrint">
        <div class="InvoiceTitle text-center">
            <h3><b>DaValleyGrill</b></h3>
            <p style="margin-bottom:0;">Hawalian Style Asian Food</p>
            <span>2040 W, Dear Valley Road.<br>Phoenix, Az 85032</span>
            <p class="pull-right" style="width: 100%;text-align: right;margin-top: 15px;">Invoice# : <?php echo $_REQUEST['order_id']; ?></p>
        </div>

        <div class="Invoicetable">
            <table width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Qty</th>
                        <th>Products</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    while ($items = $order_history->fetch_array()) {
                    ?>

                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $items['quantity']; ?></td>
                        <td><?php echo $items['itemName']; ?><br><span><?php echo $items['itemDescription']; ?></span></td>
                        <td>$<?php echo $items['itemPrice']; ?></td>
                    </tr>
                    <?php
                    if($items['item_discount_amount']>0){
                    ?>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center">D</td>
                        <td><?php echo $items['item_discount_percent']; ?>% Discount </td>
                        <td>- <?php echo $items['item_discount_amount']; ?></td>
                    </tr>
                    <?php  }
                        $i++;
                    }
                    ?>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style="padding-top:30px;">Discount</td>
                        <td style="padding-top:30px;">$<?php echo $order_detail['discount_amt']; ?></td>
                    </tr>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style="">Tips</td>
                        <td style="">$<?php echo $order_detail['tip_amt']; ?></td>
                    </tr>
                    <?php
                    $taxes = $obj->get_paid_tax_detail($_REQUEST['order_id']);
                    while ($tax = $taxes->fetch_array()) {
                    ?>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style=""><?php echo $tax['tax_type']; ?></td>
                        <td style=""><?php echo $tax['tax_percent']; ?>%</td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>$<?php echo $order_detail['balance_amt']; ?></td>
                    </tr>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style="padding-top:30px;">Tender</td>
                        <td style="padding-top:30px;">$<?php echo $order_detail['tendered_amt']; ?></td>
                    </tr>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style="">Cash Cahnge</td>
                        <td style="">$<?php echo $order_detail['cash_change']; ?></td>
                    </tr>

                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td>Charge</td>
                        <td>$<?php echo $obj->get_order_total_amount_by_id($_REQUEST['order_id']); ?></td>
                    </tr>
                    <tr style="line-height:8px;">
                        <td></td>
                        <td></td>
                        <td style="padding-top:50px;">Signature</td>
                        <td style="padding-top:50px;">-------</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-center" style="line-height:8px;margin-top:20px;margin-bottom:20px;">Copyright @ 2015 by DaValleyGrill </p>
        </div>
<!--        <div class="col-md-12" style="text-align:center"><input type='button' id='btn' value='Print Invoice' onclick='printDiv();'>-->
        <div class="col-md-12" style="text-align:center"><input type='button' id='btn' value='Print Invoice'>
        </div>
    </div>
</div>

<?php

}
else{
?>
<div class="container">
    <div class="_invoice">
        <div class="select_order_for_print">
            <form class="form-horizontal" method="GET">
                <div class="">
                  <label for="sel1">Select Ticket Number:</label><br>
                  <select class="" id="sel1" name="order_id" required>
                    <option value="">Select Tickit Number</option>
                    <?php
                    $get_today_orders = $obj->get_today_orders();
                    while ($order = $get_today_orders->fetch_array()){
                        if($order['order_status']=="complete"){
                            echo '<option value="'.$order['id'].'">'.$order['ticket_id'].'</option>';
                        }
                        else{
                            echo '<option value="'.$order['id'].'">'.$order['ticket_id'].'</option>';
                        }
                    }
                    ?>
                  </select>
                </div>
                <div class="">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}
include("include/footer.php");
?>
<script type="text/javascript">
    $(document).ready(function () {
        // var doc = new jsPDF({
        //     unit: 'mm',
        // });
        //
        // var specialElementHandlers = {
        //     '#editor': function(element, renderer){
        //         return true;
        //     }
        // };
        $('#btn').click(function () {
            $.ajax({
                type: "get",
                url: "print.php?order_id="+"<?php echo $_REQUEST['order_id']?>",
                success:function(result1){
                    console.log(result1);
                    var result=JSON.parse(result1);
                    console.log(result);
                    var msg=result['text_file'];
                    console.log(msg);
                    download("receipt1.txt","https://davalleygrill.com/tmp/"+msg+".txt");
                    window.location.href=("print_pdf.php?order_id="+"<?php echo $_REQUEST['order_id']?>");
                }
            });
        });


            //doc.setFontSize(25);
            //doc.text('DaValleyGrill', 80, 30);
            //doc.setFontSize(13);
            //doc.text('Hawalian Style Asian Food',75,40);
            //doc.text('2040 W, Dear Valley Road',75,47);
            //doc.text('Phoenix, Az 85032',85,54);

            //   console.log(order_history);
            //doc.save('sample-file.pdf');

    })

    // function printDiv(){
    //   // var divToPrint=document.getElementById('DivIdToPrint');
    //   // var newWin=window.open('','Print-Window');
    //   // newWin.document.open();
    //   // newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    //   // newWin.document.close();
    //   // setTimeout(function(){newWin.close();},10);
    //     doc.fromHTML($('body').get(0), 15, 15, {
    //         'width': 170,
    //         'elementHandlers': specialElementHandlers
    //     });
    // }
</script>