<?php include "_config.php";
//telegram bot setting
$botToken="";
$channelID="";




//get wallet expired
$getnodes = $db->query("CALL wallets_getexpired()");
$hitungdata = $getnodes->num_rows;
if($hitungdata>0){
	while($datanode = $getnodes->fetch_object()){
		$datanodes[]=$datanode;
	}
	$db->next_result();
	foreach ($datanodes as $dno) {
		//wallet id
		$wno=$dno->wallet_no;
		$wid=$dno->wallet_id;
		$waddress=$dno->wallet_nodeaddress;
		$widhash=md5($wid); //destroy wallet id as it's not used anymore.
		$tryingToDelete = curl_removeNodesWalletID($waddress,strtoupper($wid));
		$successDelete = json_decode($tryingToDelete, TRUE);
		if($successDelete["destroyed"]==1){
			//success
			$text="Success Removing SEED: ".strtoupper(substr($wid,0,12))."XXXXXXXXXX".strtoupper(substr($wid,-10));
			//$sendToLogs = http_request("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$channelID&text=$text");
			
			$removeFromDatabase = $db->query("CALL wallets_remove('$wid','$widhash')");
			if($removeFromDatabase){
				//success remove data
			}else{
				//error, notify
				$text="Oops SEED with number #".number_format($wno)." are already deleted but remover can't change the status on database.";
				//$sendToLogs = http_request("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$channelID&text=$text");
			}
		}else{
			//error
			$text="Error While Trying To Destroy Wallet With SEED: ".strtoupper(substr($wid,0,12))."XXXXXXXXXX".strtoupper(substr($wid,-10));
			//$sendToLogs = http_request("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$channelID&text=$text");
			die();
		}
		//add delay x second
		sleep(1);
	}
}else{
	//tidak ada yang harus dihapus
	echo "no data to be deleted.";
}
//remove from database


//function
function curl_removeNodesWalletID($url, $var){
	//persiapkan data yang akan dikirim
	$data = array(
	    'action' => 'wallet_destroy',
	    'wallet' => ''.$var.''
	);
	$payload = json_encode(($data));

    // persiapkan curl
    $ch = curl_init(); 
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);  
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    // set data yang akan dikirim
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    // set konten ke json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //bisa diisi 1 atau TRUE untuk dapat mengambil data hasil dari server tujuan
    // $output contains the output string 
    $output = curl_exec($ch); 
    // tutup curl 
    curl_close($ch);      
    // mengembalikan hasil curl
    return $output;
}
//contoh post data wallet id yang akan di kirimkan
//$removeNodesWalletId = curl_removeNodesWalletID("Address Nodes+Port","Wallet ID");
//echo $p = curl_removeNodesWalletID("https://nodes.banano.id/api.php","");


function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // $output contains the output string 
    $output = curl_exec($ch); 
    // tutup curl 
    curl_close($ch);      
    // mengembalikan hasil curl
    return $output;
}
?>