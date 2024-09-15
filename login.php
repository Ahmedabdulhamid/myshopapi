<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
session_start();
error_reporting(0);
include_once("connectSqol.php");
$data = json_decode(file_get_contents("php://input"));


if ($conn) {
  $email=strip_tags($data->email);
  $password=strip_tags( sha1($data->password));
  $select = "select * from users where `email`='$email' and password ='$password' ";
  $result = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($result);

  if ($password!==$row['password'] ||$data->email!==$row['email']) {
    $arr = [
      "status" => 404,
      "message" => 'invalid email or password',
     
    ];
  }
 
  else{
    if ($row['active']==false) {
      $arr = [
        "status" => 404,
        "message" => 'You Need To active Your Email First',
       
      ];
    }
    else{
      $_SESSION['user_id']=$row['id'];
      $_SESSION['email']=$row['email'];
     
      $arr = [
        "status" => 200,
        "message" => 'login successfully...',
        "data" => [
          "id"=>(int) $row['id'],
          "email" => $row['email'],
          "password" => $row['password'],
          "fname"=>$row['fname'],
          "lname"=>$row['lname'],
          "phoneNumber"=>$row['phonenumber'],
          "Address"=>$row['Address'],
          "active"=>(bool)$row['active'],
          "admin"=>(bool)$row['admin']
        ]
      ];
    }
   
  }
  $json = json_encode($arr, JSON_PRETTY_PRINT);
  echo $json;
}
?>