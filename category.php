<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");
$requestmethod=$_SERVER['REQUEST_METHOD'];
$results=array();
if ($conn && $requestmethod=='GET') {
    if (isset($_GET['category'])) {
        $category="select * from products1 where category='$_GET[category]'";
        $result=mysqli_query($conn,$category);
        while($row=mysqli_fetch_assoc($result)){
            $results[]=array(
               
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
            );
        }
       echo json_encode($results,JSON_PRETTY_PRINT);
    }
    else{

    }
}



?>