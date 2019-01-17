<?php
session_start();
class Conn
{
	// var	$servername='localhost';
	// var	$dbusername='appx';
	// var	$dbpassword='Vc!DBEEtU~lE';
	// var	$dbname    ='appx';	 

	var	$servername='localhost';
	var	$dbusername='myorders';
	var	$dbpassword='Davalley7!';
	var	$dbname    ='myorders';	 
	function __construct()
	{
	$this->dblink = mysql_connect ($this->servername, $this->dbusername,$this->dbpassword) or die('CONNECTION ERROR: Could not connect to MySQL');
	mysql_select_db($this->dbname,$this->dblink) or die ('Could not open database '.mysql_error());
	}
}
function base_url(){
	return $url = "https://davalleygrill.com/cr/employee/";
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
