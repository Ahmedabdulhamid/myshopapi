<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Acsses-Control-Allow-Method: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
include_once("connectSqol.php");
$requestmethod = $_SERVER['REQUEST_METHOD'];
$arr = array();
$mail = new PHPMailer(true);
$data = json_decode(file_get_contents("php://input"));
if ($conn && $requestmethod === "POST") {
    $insert = "insert into contact values(NULL,'$data->fullname','$data->email','$data->subject','$data->message',$data->user_id)";
    mysqli_query($conn, $insert);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ahmedabdulhamidff21@gmail.com';                     //SMTP username
    $mail->Password   = 'xetromkhylgkplvs';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465; 
 
    $mail->isHTML(true); 
    $mail->setFrom($data->email,$data->fullname);
    $mail->addAddress("ahmedabdulhamidff21@gmail.com");                                 
    $mail->Subject ="$data->email ($data->subject)";
    $mail->Body    = ucwords($data->message);     
    $mail->send();
    $selet = "select * from contact";
    $result = mysqli_query($conn, $select);
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = array(
            "id" => (int) $row['id'],
            "fullname" => $row['fullname'],
            "email" => $row['email'],
            "subject" => $row['subject'],
            "message" => $row['message'],
            "user_id" => (int) $row['user_id']
        );
    }
    echo json_encode($arr, JSON_PRETTY_PRINT);
}

?>