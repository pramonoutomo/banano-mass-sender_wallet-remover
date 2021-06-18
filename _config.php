<?php session_start();
/* Database Connection */
//error_reporting(E_ALL);
//connection begin
$serverhost="localhost"; // Host name 
$serverusername="root"; // Mysql username 
$serverpassword="mysql"; // Mysql password  
$serverdatabase="banano_walletidremover"; // Database name   
//connection end


	$db = new mysqli($serverhost, $serverusername, $serverpassword, $serverdatabase);
	if ($db->connect_errno) {
    	echo $db->connect_error;
	}

//setting default dalam system
	
	
?>