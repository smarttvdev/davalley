<?php
session_start();
include_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

    $invoice = GetUniqueID();
    $_SESSION['orderID'] = $invoice;

    $conf_number = "";
    if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
        $orderID = orderPaid($_SESSION['phoneNumber']);
        clearOrder($_SESSION['phoneNumber']);
       // $_SESSION['flag_uniqueINV'] = false;
        $_SESSION['tableSelected'] = false;
        $_SESSION['gone_table']=true;
        echo('<script>console.log('.json_encode($_SESSION).')</script>');
?>

<link rel="stylesheet" href="/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="/js/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="/pages/TableLayout.js"></script>
<style>
    .tableLayout{
        border:1px #333333 solid;
        box-sizing: border-box;
        text-align:center;
    }

    .displayTableNumber{
        font-size:15px;
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
        width:17px;
        position: absolute;
        top: 50%;
        left: 65%;
        right: 0;
        transform: translateY(-50%);
        background:transparent;
        font-size:10px !important;
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
        width:300px;
        /*height:70vh;*/
        height:300px;
        border-none;
        /*overflow-x:auto;*/
        position: relative;
        cursor: pointer;
        left:50%;
        top:50%;
        transform:translate(-50%,-50%);
        /*transform: translateY(-50%);*/
    }


</style>



<div id="entertable-dialog" style="display:none;">
    <div class="tables-container" id="tableArea">

    </div>
<!--    <p class="alert-text">You selected table#<span class="table-selected"></span></p>-->
</div>
</div>


    <h2>Thank You!</h2>
    <h3>Your transaction was successfully ! <?php echo $conf_number;?>
        <input type='button' id='EnterTableBtn' class='button button2' value='Enter Table#' style="float:right;">
    </h3>
    <div class="divider"></div>
    <a href="#">Back</a>



<!--4007000000027-->