<?php
require_once('../includes/curl.php');
require_once('../includes/whatsapp.php');
$wa=new Whatsapp();
$api_key='XXXXXXXXXXXXX';  // Key received at the time of account creation
$res=$wa->getWhatsappBalance($api_key);
echo $res;
?>