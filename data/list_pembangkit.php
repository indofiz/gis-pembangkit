<?php
header("Content-Type:application/json");
require "../config/database.php";


$query = mysqli_query($db, "SELECT * FROM informasi_pembangkit ORDER BY id_pembangkit DESC")
                               or die('Ada kesalahan pada query jumlah_record: ' . mysqli_error($db));

response(200,"Pembangkit List Found",$query);

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	// list
	$list_pem = array();
	while ($result = mysqli_fetch_assoc($data)) {
		$list_pem[] = $result;
	}
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$list_pem;
	$json_response = json_encode($response);
	echo $json_response;
}
?>