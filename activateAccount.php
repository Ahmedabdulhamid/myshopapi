<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods:PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include_once("connectSqol.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"));
if ($requestmethod === "PUT" && isset($_GET['email'])) {
    $update = "update users set active=true where email='$_GET[email]'";
    mysqli_query($conn, $update);
    $select = "select * from users where email='$_GET[email]' ";
    $result2 = mysqli_query($conn, $select);
    $row2 = mysqli_fetch_assoc($result2);
    $arr = [
        "message" => "You Activated Your Account Successfully.......",
        "data" => [
            "email" => $row2['email'], 
        ]
    ];
    echo json_encode($arr, JSON_PRETTY_PRINT);
}