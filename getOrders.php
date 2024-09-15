<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");
$requestmethod=$_SERVER['REQUEST_METHOD'];
$arr=array();
$array=[];

if ($conn && $requestmethod==="GET") {
   
          
        
          $getData="SELECT * FROM orders ORDER BY created_at DESC";
          $getResult=mysqli_query($conn,$getData);
          while ($row=mysqli_fetch_assoc($getResult)) {
            $array[]=[
            
            
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
         echo json_encode($array,JSON_PRETTY_PRINT);
    
   

}