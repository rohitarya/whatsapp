<?php
require_once('../includes/curl.php');
require_once('../includes/whatsapp.php');
$wa=new Whatsapp();
$data['api_key']='XXXXXXXXXXXXX';  // Key received at the time of account creation
$data['phone']='Receiver Mobile Number with country code and without + symbol';  // Receiver Mobile Number
$data['message']='Your Message Here';  // Message to be send
$data['filePathUrl']= 'File URL Here'; // Public URL of File
$res=$wa->sendwhatsapp($data);
echo "<pre>";
print_r($data);
?>
