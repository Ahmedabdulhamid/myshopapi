<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");
if ($conn && $_SERVER['REQUEST_METHOD']=="GET") {
    $arr=[];
  if (isset($_GET['key'])) {
    $getUsers="SELECT * FROM users WHERE fname LIKE '%$_GET[key]%' OR lname LIKE '%$_GET[key]%' OR email LIKE '%$_GET[key]%'

    OR gender LIKE '%$_GET[key]%' OR phonenumber LIKE '%$_GET[key]%' OR birthday LIKE '%$_GET[key]%' OR Address LIKE '%$_GET[key]%'
    
    ";
   $result= mysqli_query($conn,$getUsers);
   while ($row =mysqli_fetch_assoc($result)) {
    $arr[]=[
        "id" => (int) $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "email" => $row['email'],
            "gender" => $row['gender'],
            "phonenumber" => $row['phonenumber'],
            "birthday" => $row['birthday'],
            "Address"=>$row['Address'],
            "admin"=>(bool)$row['admin']
        
    ];
   }
   echo json_encode($arr, JSON_PRETTY_PRINT);
  }
}