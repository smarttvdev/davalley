<?php
session_start();
//class Conn
//{
//	public $servername='localhost';
//	public	$dbusername='appx';
//	// var	$dbusername='myorders';
//	public 	$dbpassword='Vc!DBEEtU~lE';
//	//var	$dbpassword='Davalley7!';
//	//var	$dbname    ='myorders';
//	public	$dbname    ='myorders';
//	function __construct()
//	{
////	$this->dblink = mysql_connect ($this->servername, $this->dbusername,$this->dbpassword) or die('CONNECTION ERROR: Could not connect to MySQL');
//        $this->dblink=new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);
//        if ($this->dblink->connect_error) {
//            die("Connection failed: " . $this->dblink->connect_error);
//        }
////	mysql_select_db($this->dbname,$this->dblink) or die ('Could not open database '.mysql_error());
//	}
//}


$mysqli = new mysqli("localhost", "myorders", "Davalley7!", "myorders");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}




function base_url(){
	return $url = "https://davalleygrill.com/appx/employee/";
}
function dashboard_url(){
	return $url = base_url()."employee/";
}
function user_role(){
	$obj=new Functions();
	$role = $obj->getuser_by_email($_SESSION['username']);
	return $role['usertype'];
	//return $url = base_url()."dashboard/";
}
function file_path(){
	echo $path =  $base_dir  = __DIR__;
}
function redirect($url){
	echo "<script>window.location.href = '".$url."';</script>";
}
function character_limit($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
date_default_timezone_set('Asia/Kolkata');//or change to whatever timezone you want
?>
