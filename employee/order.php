<?php
include("include/head.php");
?>

<div class="Order-history">
<div class="container paddTop50">
<p class="">
    <a href="javascript:void(0)" class="button1" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">New Order</a>
    <!-- <a href="javascript:void(0)" class="button1" onclick="new_order()">New Order</a> -->
</p>
<?php
if(isset($_SESSION['order_id'])){
?>
<p class="">
    <a href="<?php echo base_url(); ?>payment.php" class="button2">Place Order</a>
</p>
<p class="">
    <a href="#" class="button3">Contact</a>
</p>
<?php
}
?>
</div>

</div>

<?php
include("ajax_request.php");
include("include/footer.php");
?>
<!-- Order Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Table</h4>
      </div>
      <div class="modal-body">
        <select id="table_no_select">
        	<option value="">Select Table</option>
          <?php
          for ($i=1; $i < 100; $i++) { 
          echo '<option value="'.$i.'">Table '.sprintf("%02d", $i).'</option>';
          }
          ?>
        	

        </select>
        <a href="javascript:void(0)" onclick="new_order()" class="btn-info" style="padding: 5px 10px;border-radius: 5px;">Done</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>