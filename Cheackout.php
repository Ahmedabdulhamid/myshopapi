<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
include_once("connectSqol.php");
$data=json_decode(file_get_contents("php://input"));
$insert="insert into checkout values(NULL,'$data->paymentmode')";
mysqli_query($conn,$insert);
$select ="select * from checkout";
$result=mysqli_query($conn,$select);
while ($row=mysqli_fetch_assoc($result)) {
    $data=[
        "status"=>201,
        "data"=>[
            "id"=>(int)$row['id'],
           
            'paymentmode'=>$row['paymentmode'],



        ]
       
    ];
   
}

echo json_encode($data,JSON_PRETTY_PRINT);

?>