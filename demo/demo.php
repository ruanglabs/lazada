<?php
//Config

date_default_timezone_set("UTC"); //Set zona waktu ke UTC
$now = new DateTime(); //Mendapatkan waktu saat ini
$url = "https://api.sellercenter.lazada.co.id/"; //end-point API Lazada
$api_key = '-VlTLjyCj3PP87bc4PqCvtwkNsvOeXzIn_-JJegGTNDAcwddrel6wXE3'; //Masukan API anda disini
$parameters = array(
	'UserID' => 'farry.ram.tokonline@gmail.com', //Masukan email API user anda
	'Version' => '1.0', //versi API, biarkan 1.0
	'Action' => 'GetSeller', //data yang di minta ke server
	'Format' => 'JSON', //format output
	'Timestamp' => $now->format(DateTime::ISO8601) //timestamp untuk membuat Signature
);

//CURL Function
function curl_get ($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($ch);
	$err  = curl_error($ch);
	curl_close($ch);
	if ($err) {
		return $err;
	} else {
		return $data;
	}
}

//Membuat url untuk request data
ksort($parameters); //urutkan parameters sesuai abjad
$encoded = array();
foreach ($parameters as $name => $value) {
	$encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
}
$concatenated = implode('&', $encoded);
$parameters['Signature'] = rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false)); //membuat signature
$queryString = http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);

//Output
$response = curl_get($url."?".$queryString);
$decoded = json_decode($response);

//Print Output
echo '<b>URL GET Request: </b><br><input type="text" style="width:100%;" value="'.$url."?".$queryString.'"/><br><br><b>Response:</b><br>';
echo '<textarea style="width:100%;height:200px;">'.$response.'</textarea><br><br><b>Decoded:</b><br><br>';
print_r($decoded);

?>