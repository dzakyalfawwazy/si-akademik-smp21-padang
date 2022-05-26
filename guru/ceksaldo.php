<?php
        ob_start();
        // setting
        $apikey = '6095c759a770a7afb452ef793b5371593b81'; // api key
        $urlendpoint = 'http://sms241.xyz/sms/api_sms_reguler_balance_json.php'; // url endpoint api

        // create header json
        $senddata = array(
            'apikey' => $apikey,
        );

        // get balance
        $data = json_encode($senddata);
        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $responjson = curl_exec($curlHandle);
        curl_close($curlHandle);
        header('Content-Type: application/json');
        echo $responjson;
    
?>