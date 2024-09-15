<?php
include_once("./connect.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
if ($_SERVER['REQUEST_METHOD']==="GET") {
   $connect=new ConnectModel();
   $query="SELECT * FROM users ";
   $getUsers=$connect->get_users($query);
   echo json_encode($getUsers,JSON_PRETTY_PRINT);
}
else{
   echo json_encode(["message"=>"ERROR_REQUEST_METHOD"],JSON_PRETTY_PRINT);
}
   
   
