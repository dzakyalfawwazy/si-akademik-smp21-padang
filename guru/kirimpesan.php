<?php 

$number = trim($_GET['number']);
$message = 'Kepada Orang Tua dari ' . $_GET['siswa'] . ' anak anda memiliki nilai rapor '. $_GET['nilai'];

		$userkey = '3b5371593b81';
		$passkey = '6095c759a770a7afb452ef79';
		$telepon = $_GET['number'];
		$message = "Kepada Orang Tua dari " . $_GET['siswa'] . " anak anda memiliki nilai rapor ". $_GET['nilai'];
		$url = 'https://console.zenziva.net/reguler/api/sendsms/';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
			'userkey' => $userkey,
			'passkey' => $passkey,
			'to' => $telepon,
			'message' => $message
		));
		$results = json_decode(curl_exec($curlHandle), true);
		curl_close($curlHandle);
	
		// var_dump ($results);

// echo $number1;
 ?>
<script type="text/javascript">window.alert('SMS dalam proses kirim!')';</script>


