<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
include_once("connectSqol.php");
$results=array();
$requestmethod = $_SERVER['REQUEST_METHOD'];
if ($conn && $requestmethod == 'GET'){
    if (isset($_GET['search'])  && $_GET['search'] !==""){
        $query="select * from products1 where  category like'%$_GET[search]%' or description like '%$_GET[search]%'";
       
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_assoc($result)) {
           $results[]=[
            
           
                'id' => (int) ($row['id']),
                'titel' => $row['titel'],
                'image' => $row['image'],
                'category' => $row['category'],
                'stock' => (int) $row['stock'],
                'count' => (int) $row['count'],
                'rate' => (float) $row['rate'],
                'discountprecentage' => (int) $row['discountprecentage'],
                'description' => $row['description'],
                'price' => round($row['price'],2 ),
                "discountprice" => round($row['price'] - $row['price'] * $row['discountprecentage'] / 100,2)
     
            ];
           
        }        
        echo json_encode($results,JSON_PRETTY_PRINT);
    }
    else{
        $results=[];
        echo json_encode($results,JSON_PRETTY_PRINT);
    }
}

?>