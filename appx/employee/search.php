<?php
session_start();
include("include/head.php");
?>
<div class="paddTop50">
  <div class="_userinfo _search col-md-12">
    <div class="row">
      <div class="col-md-6 col-xs-6 col-sm-6">
        <p>
          <label>User:</label>
          <?php echo $_SESSION['employee_name']; ?></p>
      </div>
      <div class="col-md-6 col-xs-6 col-sm-6">
        <p>
          <label><?php echo date('F'); ?></label>
          <?php echo date('d'); ?></p>
      </div>
    </div>
  </div>
  <div class="ordertable _searchListing">
  <div class="Scroll">
    <table width="100%" class="text-center">
      <thead>
        <tr>
          <th></th>
          <th>Ticket#</th>
          <th>Table#</th>
          <th>Status</th>
          <th>Total Bill</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody style="background:white;">
        <?php
        $get_today_orders = $obj->get_today_orders();
        while ($order = $get_today_orders->fetch_array())
        {
        ?>
        <tr>
          <td>
            <?php
            if($order['order_status']!="complete"){
            ?>
            <input <?php if(isset($_SESSION['order_id']) and $_SESSION['order_id']==$order['id']){echo "checked";}?> type="radio" id="order_id" onclick="make_first_order(<?php echo $order['id']; ?>)" name="order_id" value="<?php echo $order['id']; ?>" >
            <?php
            }
            ?>
          </td>
          <td><?php echo $order['ticket_id']; ?></td>
          <td><?php echo $order['table_id']; ?></td>
          <td>
            <img src="<?php echo base_url()."images/";if($order['order_status']=="complete"){echo "complete.png";}if($order['order_status']=="cancel"){echo "cancel.png";}if($order['order_status']=="Pending"){echo "pending.png";}?>" width="10%">
          </td>
          <td><?php echo $obj->get_order_total_amount_by_id($order['id']); ?></td>
          <td><?php echo date('h:i A', strtotime($order['added_time'])); ?></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>
    
    <div class="EditInfo">
    	<button onclick="edit_order();">Edit<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><br>
        <a href="<?php echo base_url(); ?>index.php" class="back"><i class="fa fa-angle-left" aria-hidden="true"></i>Back</a>
    </div>
    
    
  </div>
</div>
<?php
include("ajax_request.php");
include("include/footer.php");
?>
