<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
include_once("connectSqol.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];
if ($conn && $requestmethod == 'GET' && isset ($_GET['user_id'])&& isset($_GET['user_id'])) {

    $select = "select * from addtocart where user_id=$user_id and id=$GET[id]";
    $query = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($query);
    $data = [
        "status" => 200,
        "message" => "success",
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
            'price' => (float) $row['price'],
            'totalprice' => (float) $row2['totalprice'],
            'user_id' => (int) $row2['user_id	']
        ]
    ];
}
echo json_encode($data, JSON_PRETTY_PRINT);




?>