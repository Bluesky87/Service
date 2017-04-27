<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Kasperek
 */


$data = array(
    'first_name'      => 'Aleksandra',
    'last_name'       => 'Testowa',
    'phone'           => '1212314'
);

$data_string = json_encode($data);


$curl = curl_init('http://service/api/customer/add');

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); // DELETE

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

// Send the request
$result = curl_exec($curl);

// Free up the resources $curl is using
curl_close($curl);

echo $result;
