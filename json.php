<?php include "_config.php";
//get data
	$getnodes = $db->query("CALL wallets_getexpired()");
  	while($datanode = $getnodes->fetch_object()){
	    //wallet id
	    $wid=$datanode->wallet_id;
		//wallet nodes
		$waddress=$datanode->wallet_nodeaddress;
		//status
		if($datanode->wallet_status==1){
	    	$wstats="To Be Removed";
	    }
		else{
			$wstats="Already Destroyed";
		}
		$datanodes[]=[strtoupper(substr($wid,0,12))."XXXXXXXXXX".strtoupper(substr($wid,-10)), $waddress, $wstats];
	}
	//foreach ($datanodes as $dno) {

	//}
header('Content-Type: application/json');//set header as json
echo json_encode($datanodes);
exit;
?>