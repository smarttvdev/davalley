<?php
include('classes.php');
if(isset($_SESSION['username'])){
//header("Location:index.php");
}
$obj    =   new Classes();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Reastaurant</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!---->
<!--<!--Keyboard Part-->
<!--    <link href="js/Keyboard/docs/css/jquery-ui.min.css" rel="stylesheet">-->
<!--    <script src="js/Keyboard/docs/js/jquery-ui.min.js"></script>-->
<!--    <link href="js/Keyboard/css/keyboard.css" rel="stylesheet">-->
<!--    <script src="js/Keyboard/js/jquery.keyboard.js"></script>-->


</head>

<body id="Main">

<div class="container-fluid">
    <div class="Rs-Login" id="Rs-Login">
        <h4>
            Login To Your Account
        </h4>
        <form id="login_form" autocomplete="off">
            <div class="form-group">
                <span class="inputIcon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" style="background: white;color:black" id="username" name="username" placeholder="Username" class="user" autocomplete="new-username" >
            </div>
            <div class="form-group">
                <span class="inputIcon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input  type="password" id="password" style="background: white;color:black" name="password" placeholder="Password" class="password" autocomplete="new-password">
            </div>
            <div class="form-group text-center">
                <a href="#" class="clockin" id="clockin">Clock In</a>
                <a href="#" class="clockout">Clock Out</a>
            </div>
            <div class="error">Invalid Username and Password</div>
        </form>
    </div>
    <div class="rs-loader Rs-Login" id="rs-loader">
        <img src="<?php echo base_url(); ?>images/loadingWait.gif" class="img-responsive">
    </div>

</div>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<?php
//include('ajax_request.php');
//?>
<script>
    // $(function(){
    //     $('#username').keyboard({
    //         initialFocus: false,
    //     });
    //     $('#password').keyboard({
    //             initialFocus: false,
    //     });
    // })
    $(document).ready(function(){
        $('#username').val('');
        $('#password').val('');
        $("#clockin").click(function(){
            var username=$('#username').val();
            var password=$('#password').val();
            var data={'OperationType':'login','username':username,'password':password};
            data=JSON.stringify(data);

            $("#Rs-Login").hide();
            $("#rs-loader").show();
    // 1        console.log(data);
            $.ajax({
                type: "POST",
                url: "ajaxServer.php",
                data: 'data='+data,
                success: function(response){
                    // console.log(response);
                    $("#Rs-Login").show();
                    $("#rs-loader").hide();
                    if(response=='1'){
                        window.location.href = "<?php echo base_url(); ?>";
                    }else{
                        $(".error").show();
                    }
                }
            });
        });
    });
</script>
</body>
</html>
