<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

error_reporting(0);

$requestmethod=$_SERVER['REQUEST_METHOD'];
include_once("connectSqol.php");
$arr = array();
if (isset($_COOKIE['PHPSESSID'])) {
    $sesion_id=$_COOKIE['PHPSESSID'];
  }

  else{
   $new_session_id=session_create_id();
  
   setcookie("PHPSESSID",$new_session_id,time()+(86400*30));
}

$session_id= $_COOKIE['PHPSESSID'];
if ($conn && $requestmethod==='GET' && isset($_GET['session_id'])) {
   

        $delete="delete from addtocart where session_id ='$_GET[session_id]' ";
        $result=mysqli_query($conn,$delete);
        $select="select * from  addtocart  where session_id ='$_GET[session_id]'";
        $results=mysqli_query($conn,$select);
    while ($row=mysqli_fetch_assoc($results)) {
        $arr[]=[
            $status=>200,

            $message=>" all products are deleted",
            $data=>[]


        ];
        
    }
       
    }
    
    echo json_encode($arr,JSON_PRETTY_PRINT);



?>