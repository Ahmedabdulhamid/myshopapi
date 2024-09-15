<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
include_once("connectSqol.php");
$arr = array();
$data = json_decode(file_get_contents("php://input"));
$requestmethod = $_SERVER['REQUEST_METHOD'];
if ($requestmethod === "POST" && $conn) {

   $email=strip_tags($data->email);
   $fname=strip_tags($data->fname);
   $lname=strip_tags($data->lname);
   $Address=strip_tags($data->Address);
  
   $password=strip_tags( sha1($data->password));
   $gender=strip_tags($data->gender);
   $phoneNumber=strip_tags($data->phonenumber);
   $birthday= strip_tags($data->birthday);
  
   $insert = "insert into users values (NULL,'$fname','$lname','$email','$password','$gender','$phoneNumber','$birthday',false,$Address',true)";
   mysqli_query($conn, $insert);
    $select = "select * from users ";
    $resultSelect = mysqli_query($conn, $select);
    while ($row = mysqli_fetch_assoc($resultSelect)) {
        $arr[] = [

            "id" => (int) $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "email" => $row['email'],
            "password" => $row['password'],
            "gender" => $row['gender'],
            "phonenumber" => $row['phonenumber'],
            "birthday" => $row['birthday'],
            "Address"=>$row['Address'],
            "active"=>(bool)$row['active'],
            "admin"=>(bool)$row['admin']


        ];
    }
    echo json_encode($arr, JSON_PRETTY_PRINT);




}

?>