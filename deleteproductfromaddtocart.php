<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];
error_reporting(0);
$arr=[];

    if (isset($_COOKIE['PHPSESSID'])) {
        $sesion_id=$_COOKIE['PHPSESSID'];
    }

  else{
   $new_session_id=session_create_id();
  
   setcookie("PHPSESSID",$new_session_id,time()+(86400*30));
}
$session_id= $_COOKIE['PHPSESSID'];
if ($conn && $requestmethod === "GET") {
    if (isset($_GET['id']) && isset($_GET['session_id'])) {
            $sqldelete = "delete  from addtocart where id=$_GET[id] and session_id ='$_GET[session_id]'";
            mysqli_query($conn, $sqldelete);
            $sqlget = "select * from addtocart where session_id ='$_GET[session_id]'";
            $result = mysqli_query($conn, $sqlget);
            while ($row1 = mysqli_fetch_assoc($result)) {
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
                        'price' => (float) $row1['price'],
                        'totalprice' => (float) $row1['totalprice'],
                        "session_id"=> $row1['session_id']

                    ]
                ];
            }
            
            echo json_encode($arr, JSON_PRETTY_PRINT);
        
    }

}







?>