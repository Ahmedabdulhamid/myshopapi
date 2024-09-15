<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);

include_once("connectSqol.php");


$array=array();



if ($conn && $_SERVER['REQUEST_METHOD']==="POST" ) {

  $data = json_decode(file_get_contents("php://input"));
 
    $addOrder=" insert into orders values(NULL,'$data->phonenumbers','$data->fname','$data->lname',$data->user_id,'$data->product_name','$data->product_quantity','$data->product_image','$data->total_price',NOW() ,'$data->Address') ";
    
    if (mysqli_query($conn,$addOrder)) {
      $getOrders = "select * from orders ";
      $getResult=mysqli_query($conn,$getOrders);
      while ($row=mysqli_fetch_assoc($getResult)) {
         $array[]=[
          "message"=>"Your Order Added Succefully",
          "status"=>200,
          "data"=>[
            "id"=>(int)$row['id'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "phonenumbers"=>$row['phonenumbers'],
            "created_at"=>$row['created_at'],
            "user_id"=>(int)$row['user_id'],
            "Address"=>$row['Address'],
            "product_name"=>$row['product_name'],
            "product_quantity"=>(int)$row['product_quantity'],
            "product_image"=>$row['product_image'],
            "total_price"=>number_format($row['total_price'],2)  , 
          ]
         ];
      }
      echo json_encode($array,JSON_PRETTY_PRINT);
    }
    
}



?>