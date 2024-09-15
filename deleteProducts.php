<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
include_once("connectSqol.php");;
$requestmethod=$_SERVER['REQUEST_METHOD'];
$arr=array();
if ($conn && $requestmethod==='GET') {
    if (isset($_GET['id'])) {

        $delete="delete from products1 where id=$_GET[id]";
        $result=mysqli_query($conn,$delete);
      
    }
    $getProducts="SELECT * FROM products LIMIT 50";
    $result=mysqli_query($conn,$getProducts);
    while($row=mysqli_fetch_assoc($result)){
        $arr[]=array(
           
            'id' => (int) ($row['id']),
            'titel' => $row['titel'],
            'image' => $row['image'],
            'category' => $row['category'],
            'stock' => (int) $row['stock'],
            'count' => (int) $row['count'],
            'rate' => (float) $row['rate'],
            'discountprecentage' => (int) $row['discountprecentage'],
            'description' => $row['description'],
            'price' => (float) round($row['price']*0.021,00)
     

        );
    }
   echo json_encode($arr,JSON_PRETTY_PRINT);
}


?>