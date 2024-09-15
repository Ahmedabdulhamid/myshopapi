<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
session_start();
include_once("connectSqol.php");
$arr = array();
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
$servermethod=$_SERVER['REQUEST_METHOD'];
if ($servermethod==="GET" && isset($_GET['session_id'])) {
  if (isset($_COOKIE['PHPSESSID']) ) {
    $sesion_id=$_COOKIE['PHPSESSID'];
  }
  else{
    $new_session_id=session_create_id();
   
    setcookie("PHPSESSID",$new_session_id,time()+(86400*30));
 }
 $session_id= $_COOKIE['PHPSESSID'];

  
    $select="select * from addtocart where session_id ='$_GET[session_id]'";
    $result=mysqli_query($conn,$select);
      while ($row1=mysqli_fetch_assoc($result)) {
          $arr[] = [
              "status" => 200,
              "message" => "successfuly",
              "data" => [
                'id' => (int) ($row1['id']),
                'titel' => $row1['titel'],
                'image' => $row1['image'],
                'category' => $row1['category'],
                'stock' => (int) $row1['stock'],
                'count' => (int) $row1['count'],
                'discountprecentage' => (int) $row1['discountprecentage'],
                'description' => $row1['description'],
                'price' => round($row1['price'],2) ,
                'totalprice' => round($row1['totalprice'],2) ,
                "session_id"=>$row1['session_id']
                
                
                
              ]
            ];
      }
      echo json_encode($arr, JSON_PRETTY_PRINT);
  
  
}
    
  
 



?>

