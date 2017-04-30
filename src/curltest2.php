<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Kasperek
 */




$curl = curl_init('http://service/api/customers');

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET"); // DELETE
curl_setopt($curl, CURLOPT_USERPWD, "admin:admin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string

// Send the request
$result = curl_exec($curl);

// Free up the resources $curl is using
curl_close($curl);

echo $result;
