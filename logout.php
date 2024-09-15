<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

session_start();
$arr=array();

$_SESSION = array();

session_unset();
  session_destroy();
$arr[]=[
  "message"=>"you logout succesfuly"
];
echo json_encode($arr,JSON_PRETTY_PRINT);

