<?php include "_config.php";
$wid=$db->real_escape_string($wid);
$waddress=$db->real_escape_string($waddress);
$c_wid=strlen($wid);
$c_waddress=strlen($waddress);

if(!empty($wid) and !empty($waddress)){
	if($c_wid==64){
		$addWallet = $db->query("CALL wallets_add('$wid','$waddress')");
		if($addWallet){
			$json = array("status" => 1, "msg" => "Success! Wallet ready to use for the next 24 hours.");
		}else{
			$json = array("status" => 0, "msg" => "Oops! Can't add wallet id into database.");
		}
	}else{
		$json = array("status" => 0, "msg" => "Invalid seed!");
	}
	
}else{
	$json = array("status" => 0, "msg" => "Wallet Not Found!");
}

header('Content-Type: application/json');//set header as json
echo json_encode($json);
exit;
?>