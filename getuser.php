<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("./connect.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];
if ($requestmethod == "GET" && isset($_GET['id'])) {

        $connect=new ConnectModel();
        $query="SELECT * FROM users WHERE id=? ";
        $getUser=$connect->get_users($query,[$_GET['id']]);
        echo json_encode($getUser,JSON_PRETTY_PRINT);




}