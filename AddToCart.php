<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

$arr=[];
session_start();
error_reporting(0);
include_once("connectSqol.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {
 

  setcookie("PHPSESSID",$new_session_id,time()+(60*60*24),"/","localhost");
    if( isset($_GET['id']) && isset($_GET['session_id']) ){
    
    
      $data = json_decode(file_get_contents("php://input"));
      $titel = addslashes($data->titel);
      $image = addslashes($data->image);
      $category = addslashes($data->category);
      $description = addslashes($data->description);
      $description1 = trim($description, '"');
     
      $getitems = "select * from addtocart where id=$_GET[id] and session_id='$_GET[session_id]' ";
      $result = mysqli_query($conn, $getitems);
      $row = mysqli_fetch_assoc($result);
       
      if ($row) {
        if ($row['id'] == $_GET['id'] && $row['session_id']==$_GET['session_id']) {
       
          $arr1=[];
          $update = "update addtocart set count=count+1 ,totalprice= totalprice+price where id=$_GET[id] and session_id='$_GET[session_id]'";
          $result2 = mysqli_query($conn, $update);
          $getCarts="select * from addtocart where session_id='$_GET[session_id]'";
          $resultCart=mysqli_query($conn,$getCarts); 
          while ($row1=mysqli_fetch_assoc($resultCart)) {
            $arr1[]=[
                    "status" => 200,
                    "message" => "you have ".$row1['count']."from this item",
                    "data" => [
                        'id' => (int) ($row1['id']),
                        'titel' => $row1['titel'],
                        'image' => $row1['image'],
                        'category' => $row1['category'],
                        'stock' => (int) $row1['stock'],
                        'count' => (int) $row1['count'],
                        'discountprecentage' => (float) $row1['discountprecentage'],
                        'description' => $row1['description'],
                        'price' => round($row1['price'],2) ,
                        'totalprice' => round($row1['totalprice'],2),
                        "session_id"=> $row1['session_id'] ,
                        
                      ]     
                  ];
          }
          
          echo json_encode($arr1, JSON_PRETTY_PRINT);
        }
      }
        else{
          $arr2=[];
          $price=round($data->price-($data->price*$data->discountprecentage)/100,2);
          $totalprice=round($data->price-($data->price*$data->discountprecentage)/100,2);       
          $insert = "INSERT INTO addtocart VALUES ($_GET[id],'$titel','$image','$category',1,'$data->stock','$data->discountprecentage','$description1','$price', '$totalprice','$_GET[session_id]')";
              mysqli_query($conn, $insert);
              $getCarts="select * from addtocart where session_id='$_GET[session_id]'";
              $resultCart=mysqli_query($conn,$getCarts); 
                while ($row2=mysqli_fetch_assoc($resultCart)) {
                  $arr2[]=[
                    "status" => 200,
                    "message" => "you have ".$row2['count']."from this item",
                    "data" => [
                        'id' => (int) ($row2['id']),
                        'titel' => $row2['titel'],
                        'image' => $row2['image'],
                        'category' => $row2['category'],
                        'stock' => (int) $row2['stock'],
                        'count' => (int) $row2['count'],                
                        'discountprecentage' => (int) $row2['discountprecentage'],
                        'description' => $row2['description'],
                        'price' =>  round($row2['price'],2),
                        'totalprice' => round($row2['totalprice'],2),
                        "session_id"=> $row2['session_id'] ,
                        
                      
                    
                    ]
                    ];
                }
               echo json_encode($arr2, JSON_PRETTY_PRINT);
        }
    }
 else{
   $arr[]=[
    "message"=>"You Should Have User_Id"
   ];
   echo json_encode($arr,JSON_PRETTY_PRINT);
 }
  
    
   
     
    
      
}

