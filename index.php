<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

include_once("connectSqol.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];

if ($conn && $requestmethod == 'GET') {
   if (isset($_GET['id']) ) {


      $query = "select * from products1 where id=$_GET[id]";

      $result = mysqli_query($conn, $query);




      while ($row = mysqli_fetch_assoc($result)) {
         $results = [
            "status" => 200,
            "message" => 'succeded',
            "data" => [
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
            ]


         ];

      }
      ;


      $json = json_encode($results, JSON_PRETTY_PRINT);
      echo $json;

   } else {
      $data = [
         "status" => 404,
         "messagee" => "invalid id"
      ];
      echo json_encode($data, JSON_PRETTY_PRINT);
   }


} else {
   echo "not connected";
}



?>