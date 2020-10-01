<?php
require_once('../includes/curl.php');
require_once('../includes/whatsapp.php');
$wa=new Whatsapp();
$api_key='XXXXXXXXXXXXX';  // Key received at the time of account creation
$url='URL at which you want to receive new whatsapp messge';  // Company Name
$res=$wa->setWhatsappHook($api_key,$url);
echo "<pre>";
print_r($data);
?>