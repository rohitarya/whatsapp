<?php
require_once('../includes/curl.php');
require_once('../includes/whatsapp.php');
$wa=new Whatsapp();
$data['name']='Rohit Arya';  // Name of User
$data['cname']='Test Company';  // Company Name
$data['email']='test@test.com'; // Email Address 
$data['phone']='9999999999'; // Phone Number
$res=$wa->createAccount($data);
echo "<pre>";
print_r($data);
?>