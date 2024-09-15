<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

$arr=[];
include_once("connectSqol.php");
if ($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['user_id'])) {
   $getorders="SELECT * FROM orders WHERE user_id=$_GET[user_id]";
   $result=mysqli_query($conn,$getorders);
   while ($row=mysqli_fetch_assoc($result)) {
   $arr[]=[
    "id"=>(int)$row['id'],
    "fname"=>$row['fname'],
    "lname"=>$row['lname'],
    "phonenumbers"=>$row['phonenumbers'],
    "created_at"=>$row['created_at'],
    "user_id"=>(int)$row['user_id'],
    "product_name"=>$row['product_name'],
    "product_quantity"=>$row['product_quantity'],
    "product_image"=>$row['product_image'],
    "total_price"=>number_format($row['total_price'],2),
    "Address"=>$row['Address']

   ];
   }
   echo json_encode($arr,JSON_PRETTY_PRINT);
}