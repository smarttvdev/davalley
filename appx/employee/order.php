<?php
include("include/head.php");
include ("include/functions.php");
//var_dump($_SESSION);

?>

<script src="js/displayTableLayout.js"></script>
<script src="js/functions.js"></script>

<style>
    .tableLayout{
        border:1px #333333 solid;
        box-sizing: border-box;
        text-align:center;
    }

    .displayTableNumber{
        font-size:17px !important;
        margin:auto;
        width:fit-content;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        color:#eeeeee;
    }
    .showMaxguest{
        width:20px;
        position: absolute;
        top: 50%;
        left: 65%;
        right: 0;
        transform: translateY(-50%);
        background:transparent;
        font-size:12px !important;
        border:none;
        color:#eeeeee;
        pointer-events: none;
    }
    .tableLabel{
        padding:0;
        border:none;
        text-align:center;
        font-size:17px;
        width:70px;
        font-weight:bold;
        color:#ff3333;
        background:transparent;
        cursor:pointer;
        display:none;
    }
    .ObjectLayout{
        border:5px black solid;
        box-sizing: border-box;
        text-align:center;
        position:absolute;
        background:none;
    }
    .ObjectLabel{
        position:absolute;
    }
    .LayoutObjectLabel{
        width:8ch;
        float:right;
        font-size:20px;
        border:none;
        color:red;
        padding:0;
        text-align: right;
        border:1px solid #888888;
        pointer-events: none;
    }
    h4.modal-title{
        text-align: center;
    }
    div.modal-body{
        padding:0;
        padding-bottom:10px;
    }

    #tableArea{
        padding:0;
        width:305px;
        height:310px;
        border-none;
        overflow-x:auto;
        position: relative;
        cursor: pointer;
        top:50%;
        left:50%;
        transform:translate(-45%,20px);
    }
    .select-table.modal-content{
        width:340px;
        height:440px;
        padding:0;
    }

</style>
<div class="Order-history">
<div class="container paddTop50">
<p class="">
<!--    <a href="javascript:void(0)" class="button1" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">New Order</a>-->
<!--    <a href="#" class="button1" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">New Order</a>-->
    <a href="#" class="button1"  id="button1">New Order</a>
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

<div id="myModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="select-table modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Table</h4>
      </div>
      <div class="modal-body" >
          <div id="tableArea"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
$('#button1').click(function () {
    $('#myModal').modal('show');
})
</script>
<!---->
<?php
//echo(checkPIN());
//?>
<!--<!---->
