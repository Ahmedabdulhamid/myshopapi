<?php
include_once("./connect.php");
header("Access-Control-Allow-Origin: "); // Adjust '*' to your domain for security
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow methods as needed
header("Access-Control-Allow-Headers: Content-Type, Authorization");
error_reporting(0);
if ($_SERVER['REQUEST_METHOD']==="GET") {
   $connect=new ConnectModel();
   $query="select * from products1 ORDER BY id DESC  ";
   $prducts=$connect->get_products($query);
   echo json_encode($prducts,JSON_PRETTY_PRINT);
}
else{
   echo json_encode(["message"=>"ERROR_REQUEST_METHOD"],JSON_PRETTY_PRINT);
}
   