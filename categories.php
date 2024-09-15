<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");
$requestmethod=$_SERVER['REQUEST_METHOD'];
$arr=array();
if ($conn && $requestmethod=='GET') {
    
        $category="select  DISTINCT category from products1 ";
        $result=mysqli_query($conn,$category);
        while($row=mysqli_fetch_assoc($result)){
            $arr[]=$row['category'];
        }
       echo json_encode($arr,JSON_PRETTY_PRINT);
    }
    


