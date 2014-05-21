<?php
if (!isset ($_SESSION)){
	ob_start();
	session_start();
}

$hostname="localhost"; //MySQL Host Address
$basename=""; //MySQL Username
$basepass=""; //MySQL Password
$database=""; //MySQL Databasename

$conn=mysql_connect($hostname,$basename,$basepass)or die("error!"); //Connect MySQL              
	mysql_select_db($database,$conn); //Select Database
	mysql_query("set names 'utf8'");//MySQL Encoding
?>