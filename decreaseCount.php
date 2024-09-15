<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: *");
session_start();
error_reporting(0);
include_once("connectSqol.php");
$methodrequest = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"));
if (isset($_COOKIE['PHPSESSID'])) {
     $sesion_id=$_COOKIE['PHPSESSID'];
   }

   else{
    $new_session_id=session_create_id();
   
    setcookie("PHPSESSID",$new_session_id,time()+(86400*30));
 }

$session_id= $_COOKIE['PHPSESSID'];
if (isset($_GET['id']) && isset($_GET['session_id']) ){
   
    $update = "update addtocart set count=count-1 , totalprice= totalprice-price where id =$_GET[id] and session_id ='$_GET[session_id]' and count>1 ";
    mysqli_query($conn,$update);
    $select = "select * from addtocart where session_id ='$_GET[session_id]' ";
    $results = mysqli_query($conn, $select);
 
    $data1=array();
    while ( $row = mysqli_fetch_assoc($results)) {
      
        $data1[] = [
            "status" => 200,
            "message" =>  "you have ".$row['count']."from this item",
            "totalprice2"=>number_format($totalprice2,2),
            "data" => [
                'id' => (int) ($row['id']),
                'titel' => $row['titel'],
                'image' => $row['image'],
                'category' => $row['category'],
                'stock' => (int) $row['stock'],
                'count' => (int) $row['count'],
                'discountprecentage' => (int) $row['discountprecentage'],
                'description' => $row['description'],
                'price' => ( float)round($row['price'],2) ,
               'totalprice' => ( float)round($row['totalprice'],2)  ,
                'session_id'=> $row['session_id'],
                
            ]
            ];
          
    }

}
echo json_encode($data1, JSON_PRETTY_PRINT);

?>