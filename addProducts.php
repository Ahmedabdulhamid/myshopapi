<?php
header("Access-Control-Allow-Origin: *"); // Change this to your React app's URL
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("connectSqol.php");

if ($conn) {
    // Log the request method and files received
    error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
    error_log("Files: " . print_r($_FILES, true));
    error_log("Post Data: " . print_r($_POST, true));

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
        $fileName = $_FILES['image']['name'];
        $fileType = $_FILES['image']['type'];
        
        $fileTempName = $_FILES['image']['tmp_name'];
        $fileUrl = uniqid("IMG-", true) . "." . $fileName;
        $file_path = "images/" . $fileUrl;
        //move_uploaded_file($fileTempName, $file_path);
        $title = addslashes($_POST['title']);
        $category = addslashes($_POST['category']);
        $stock = intval($_POST['stock']);
        $count = intval($_POST['count']);
        $rate = floatval($_POST['rate']);
        $discountprecentage = floatval($_POST['discountprecentage']);
        $description = addslashes($_POST['description']);
        $price = floatval($_POST['price']);
       
        if (move_uploaded_file($fileTempName, $file_path)) {
            $insert = "INSERT INTO products1 (titel, image, category, stock, count, rate, discountprecentage, description, price) VALUES (
                '$title', 
                'http://localhost/products/$file_path', 
                '$category', 
                $stock, 
                $count, 
                $rate, 
                $discountprecentage, 
                '$description', 
                $price
            )";

            if (mysqli_query($conn, $insert)) {
                $arr = [
                    "status" => 200,
                    "msg" => "Your Product has been added successfully"
                ];
                echo json_encode($arr, JSON_PRETTY_PRINT);
            } else {
                $arr = [
                    "status" => 500,
                    "msg" => "Error adding product: " . mysqli_error($conn)
                ];
                echo json_encode($arr, JSON_PRETTY_PRINT);
            }
        } else {
            $arr = [
                "status" => 500,
                "msg" => "Error uploading file"
            ];
            echo json_encode($arr, JSON_PRETTY_PRINT);
        }
    } else {
        $arr = [
            "status" => 400,
            "msg" => "Invalid request"
        ];
        echo json_encode($arr, JSON_PRETTY_PRINT);
    }
} else {
    $arr = [
        "status" => 500,
        "msg" => "Database connection failed"
    ];
    echo json_encode($arr, JSON_PRETTY_PRINT);
}
?>
